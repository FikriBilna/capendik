<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilaistudent extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model', 'student');
        $this->load->model('nilai_model', 'nilai');
        $this->load->model('subject_model', 'subject');
        $this->load->model('lessonplan_model', 'lesson');
        $this->load->model('setting_model');
	$this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/search');
        $data['title']           = 'Student Nilai';
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['fields']          = $this->customfield_model->get_custom_fields('students', 1);
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;

        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function dtstudentlist()
    {
        $currency_symbol = $this->customlib->getSchoolCurrencyFormat();
        $class           = $this->input->post('class_id');
        $section         = $this->input->post('section_id');
        $search_text     = $this->input->post('search_text');
        $search_type     = $this->input->post('srch_type');
        $classlist       = $this->class_model->get();
        $classlist       = $classlist;
        $carray          = array();
        if (!empty($classlist)) {
            foreach ($classlist as $ckey => $cvalue) {
                $carray[] = $cvalue["id"];
            }
        }

        $sch_setting = $this->sch_setting_detail;
        if ($search_type == "search_filter") {
            $resultlist = $this->student_model->searchdtByClassSection($class, $section);
        } elseif ($search_type == "search_full") {
            $resultlist = $this->student_model->searchFullText($search_text, $carray);
        }

        $students = array();
        $students = json_decode($resultlist);
        $dt_data  = array();
        $fields   = $this->customfield_model->get_custom_fields('students', 1);
        if (!empty($students->data)) {
            foreach ($students->data as $student_key => $student) {

                $editbtn   = '';
                $deletebtn = '';
                $viewbtn   = '';
                $collectbtn   = '';

                if ($this->rbac->hasPrivilege('student', 'can_add')) {

                    $collectbtn = "<a href='" . base_url() . "admin/nilaistudent/addNilai/" . $student->id . "' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='left' title='Add Nilai'><i class='fa fa-plus'></i></a>";

                }

                $row   = array();
                $row[] = $student->admission_no;
                $row[] = "<a href='" . base_url() . "student/view/" . $student->id . "'>" . $this->customlib->getFullName($student->firstname, $student->middlename, $student->lastname, $sch_setting->middlename, $sch_setting->lastname) . "</a>";
                $row[] = $student->class . "(" . $student->section . ")";
                if ($sch_setting->father_name) {
                    $row[] = $student->father_name;
                }

                $row[] = $this->customlib->dateformat($student->dob);

                $row[] = $student->gender;
                if ($sch_setting->category) {
                    $row[] = $student->category;
                }
                if ($sch_setting->mobile_no) {
                    $row[] = $student->mobileno;
                }

                foreach ($fields as $fields_key => $fields_value) {

                    $custom_name   = $fields_value->name;
                    $display_field = $student->$custom_name;
                    if ($fields_value->type == "link") {
                        $display_field = "<a href=" . $student->$custom_name . " target='_blank'>" . $student->$custom_name . "</a>";
                    }
                    $row[] = $display_field;
                }

                $row[] = $viewbtn . '' . $editbtn . '' . $collectbtn;

                $dt_data[] = $row;
            }
        }
        $sch_setting         = $this->sch_setting_detail;
        $student_detail_view = $this->load->view('student/_searchDetailView', array('sch_setting' => $sch_setting, 'students' => $students), true);
        $json_data           = array(
            "draw"                => intval($students->draw),
            "recordsTotal"        => intval($students->recordsTotal),
            "recordsFiltered"     => intval($students->recordsFiltered),
            "data"                => $dt_data,
            "student_detail_view" => $student_detail_view,
        );

        echo json_encode($json_data);
    }

    public function addNilai($id)
    {
        $session_id = $this->setting_model->getCurrentSession();
        $totalNilai = $this->nilai->sum_numbers($id);
        $jumlahNilai = $this->nilai->countBy($id);
        $listNilai = $this->nilai->get($id);
        $finalScore = 0;
        if ($listNilai != null) {
            $finalScore = round($totalNilai / $jumlahNilai);
        }
        $data = [
            'student' => $this->student->get($id),
            'subjects' => $this->subject->get(),
            'lessons' => $this->lesson->getlessonBysessionid($this->setting_model->getCurrentSession()),
            'topic' => $this->lesson->getTopicBySession($session_id),
            'subject_groups' => $this->subjectgroup_model->getSubject($session_id),
            'listNilai' => $listNilai,
            'finalScore' => $finalScore,
            'id' => $id
        ];
        if ($this->input->post('jenis_nilai') == 0) {
            $this->form_validation->set_rules('lesson_id', 'Lesson', 'trim|required|xss_clean');
            $this->form_validation->set_rules('topic_id', 'Topic', 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis_nilai', 'Jenis Nilai', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sumatif', 'Sumatif', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/addNilai', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'session_id' => $session_id,
                'student_id' => $this->input->post('student_id'),
                'lesson_id' => $this->input->post('lesson_id'),
                'subject_id' => $this->input->post('subject_id'),
                'topic_id' => $this->input->post('topic_id'),
                'type_nilai' => $this->input->post('jenis_nilai'),
                'sumatif' => $this->input->post('sumatif'),
            );
            $this->nilai->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/nilaistudent/addnilai/' . $id);
        }
    }

    // public function editNilai($id)
    // {
    //     $session_id = $this->setting_model->getCurrentSession();
    //     $getNilai = $this->nilai->getNilaibyId($id);


    //     $totalNilai = $this->nilai->sum_numbers($getNilai['student_id']);
    //     $jumlahNilai = $this->nilai->countBy($getNilai['student_id']);
    //     $listNilai = $this->nilai->get($getNilai['student_id']);
    //     $finalScore = 0;
    //     if ($listNilai != null) {
    //         $finalScore = round($totalNilai / $jumlahNilai);
    //     }
    //     $data = [
    //         'student' => $this->student->get($getNilai['student_id']),
    //         'subject' => $this->subject->get(),
    //         'lessons' => $this->lesson->getlessonBysessionid($session_id),
    //         'topic' => $this->lesson->getTopicBySession($session_id),
    //         'nilai' => $getNilai,
    //         'listNilai' => $listNilai,
    //         'finalScore' => $finalScore,
    //         'id' => $id
    //     ];

    //     $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('lesson_id', 'Lesson', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('topic_id', 'Topic', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('jenis_nilai', 'Jenis Nilai', 'trim|required|xss_clean');
    //     $this->form_validation->set_rules('sumatif', 'Sumatif', 'trim|required|xss_clean');
    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('layout/header', $data);
    //         $this->load->view('student/editNilai', $data);
    //         $this->load->view('layout/footer', $data);
    //     } else {
    //         $data = array(
    //             'session_id' => $session_id,
    //             'student_id' => $this->input->post('student_id'),
    //             'lesson_id' => $this->input->post('lesson_id'),
    //             'subject_id' => $this->input->post('subject_id'),
    //             'topic_id' => $this->input->post('topic_id'),
    //             'type_nilai' => $this->input->post('jenis_nilai'),
    //             'sumatif' => $this->input->post('sumatif'),
    //             'id' => $this->input->post('id')
    //         );
    //         $this->nilai->add($data);
    //         $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
    //         redirect('admin/nilaistudent/editnilai/' . $id);
    //     }
    // }

    public function delete($id)
    {
        $this->nilai->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('admin/nilaistudent');
    }

    public function getGroupByClassandSection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->subjectgroup_model->getGroupByClassandSection($class_id, $section_id);
        echo '<option value="">--pilih subject--</option>';
        foreach ($data as $item) {
            echo "<option value=" . $item['subject_group_id'] . ">" . $item['name'] . "</option>";
        }
    }

    public function getSubject()
    {
        $subject_group_id = $this->input->post('subject_group_id');
        $subjects = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
        echo '<option value="">--pilih subject--</option>';
        foreach ($subjects as $subject) {
            echo "<option value=" . $subject->id . ">" . $subject->name . "</option>";
        }
    }

    public function getLessonBySubject($sub_id)
    {
        $subject_group_class_sectionsId = $this->lesson->getsubject_group_class_sectionsId($this->input->post('class_id'), $this->input->post('section_id'), $this->input->post('subject_group_id'));
        $data = $this->lesson->getlessonBysubjectid($sub_id, $subject_group_class_sectionsId['id']);
        echo '<option value="">--pilih lesson--</option>';
        foreach ($data as $lesson) {
            echo "<option value=" . $lesson['id'] . ">" . $lesson['name'] . "</option>";
        }
    }
    public function getTopic()
    {
        $lesson_id = $this->input->post('id_lesson');
        $topics = $this->nilai->getTopicByLessonid($lesson_id);
        echo '<option value="">--pilih topic--</option>';
        foreach ($topics as $topic) {
            echo "<option value=" . $topic['id'] . ">" . $topic['name'] . "</option>";
        }
    }
}
