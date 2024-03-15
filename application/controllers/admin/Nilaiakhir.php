<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilaiakhir extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model', 'student');
        $this->load->model('nilai_akhir_model', 'nilai_akhir');
        $this->load->model('subject_model', 'subject');
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
        $data['studentList']     = $this->student->get();

        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiAkhir/nilaiAkhir', $data);
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

                    $collectbtn = "<a href='" . base_url() . "admin/nilaiakhir/addnilai/" . $student->id . "' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='left' title='Add Nilai'><i class='fa fa-plus'></i></a>";

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

    public function listNilaiStudent($id)
    {
        $data = [
            'student' => $this->student->get($id),
            'sch_setting' => $this->sch_setting_detail,
            'listNilai' => $this->nilai_akhir->get($id),
            'id' => $id
        ];

        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiAkhir/listNilai', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addNilai($id)
    {
        $session_id = $this->setting_model->getCurrentSession();
        $student    = $this->student->get($id);
        $current_student_session = $this->student->get_studentsession($student['student_session_id']);

        $data = [
            'student'   => $this->student->get($id),
            'subjects'  => $this->subject->get(),
            'subject_groups'    => $this->subjectgroup_model->getSubject($session_id),
            'id'                => $id,
            'sch_setting'       => $this->sch_setting_detail,
            'session'           => $current_student_session["session"],
            'listNilai'         => $this->nilai_akhir->get($id)
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiAkhir/addNilaiAkhir', $data);
        $this->load->view('layout/footer', $data);
    }


    public function getNilai()
    {
        $student = $this->input->get('student_id');
        $subject = $this->input->get('subject_id');
        $jenis = $this->input->get('jenis_nilai');

        $dataNilai = $this->nilai_akhir->getNilai($student, $subject, $jenis);
        // echo "<table>";
        foreach ($dataNilai as $nilai) {
            echo "<tr>
                <td>" . $nilai['subjectName'] . "</td>
                <td>" . $nilai['lessonName'] . "</td>
                <td>" . $nilai['topicName'] . "</td>
                <td>" . $nilai['sumatif'] . "</td>
                <td>" . ($nilai['type_nilai'] == 0 ? 'Sumatif Lingkup Materi' : 'Sumatif Akhir Semester') . "</td>
                <td>
                    <input type='checkbox' name='id_nilai' value='" . $nilai['id'] . "'/>
                </td>
              </tr>";
        }
        // echo "</table>";
    }

    public function prosesNilai()
    {
        $datas = $this->input->post('id_nilai');
        $totalNilai = 0;

        foreach ($datas as $data) {
            $nilai = $this->nilai_akhir->getNilaibyId($data);
            $totalNilai += $nilai['sumatif'];
        }
        $jumlahData = count($datas);

        if ($jumlahData > 0) {
            $averageNilai = $totalNilai / $jumlahData;
            $data = array(
                'student_id' => $nilai['student_id'],
                'session_id' => $nilai['session_id'],
                'subject_group_subjects_id' => $nilai['subject_id'],
                'jenis_nilai_akhir' => $nilai['type_nilai'],
                'nilai_akhir' => $averageNilai,
            );
            $this->nilai_akhir->add($data);
        } else {
            echo "No data selected.";
        }
    }



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
        echo '<option value="">Select</option>';
        foreach ($data as $item) {
            echo "<option value=" . $item['subject_group_id'] . ">" . $item['name'] . "</option>";
        }
    }

    public function getSubject()
    {
        $subject_group_id = $this->input->post('subject_group_id');
        $subjects = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
        echo '<option value="">Select</option>';
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
