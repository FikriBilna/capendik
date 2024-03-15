<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class Nilairapor extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model', 'student');
        $this->load->model('lessonplan_model', 'lesson');
        $this->load->model('subjectgroup_model', 'subjectgroup');
        $this->load->model('subject_model', 'subject');
	$this->load->model('rapor_model', 'rapor');
	$this->load->model('nilaiekskul_model', 'nilaiekskul');
        $this->load->model('nilairapor_model', 'nilairapor');
        $this->load->model('setting_model');
        $this->sch_setting_detail = $this->setting_model->getSetting();
	$this->load->library('pdf_generator');
    }

    public function index()
    {
        if(!$this->rbac->hasPrivilege('nilai_rapor', 'can_view')){
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/nilai-rapor');
        $data['title']           = 'Student Nilai Rapor';
        $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
        $data['sch_setting']     = $this->sch_setting_detail;
        $data['fields']          = $this->customfield_model->get_custom_fields('students', 1);
        $class                   = $this->class_model->get();
        $data['classlist']       = $class;

        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiRapor', $data);
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
		$viewbtn = "<a href='" . base_url() . "admin/nilairapor/generateRapor/" . $student->id . "'   class='btn btn-default btn-xs'  data-toggle='tooltip' data-placement='left' title='" . $this->lang->line('genrate rapor') . "'><i class='fa fa-reorder'></i></a>";

                if ($this->rbac->hasPrivilege('student', 'can_add')) {

                    $collectbtn = "<a href='" . base_url() . "admin/nilairapor/addnilairapor/" . $student->id . "' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='left' title='Add Nilai'><i class='fa fa-plus'></i></a>";

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

    public function addNilaiRapor($id)
    {
        $session_id = $this->setting_model->getCurrentSession();
        $nilairapor = $this->nilairapor->get($id);
        $student    = $this->student->get($id);
        $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);
        $class_teacher           = $this->student_model->getClassTeacher($student['section_id'], $student['class_id']);

        $data = [
            'student'   => $this->student->get($id),
            'subjects'  => $this->subject->get(),
            'subject_groups'    => $this->subjectgroup_model->getSubject($session_id),
            'nilai_rapor'       => $nilairapor,
            'id'                => $id,
            'sch_setting'       => $this->sch_setting_detail,
            'session'           => $current_student_session["session"],
            'class_teacher'     => $class_teacher
        ];

        // var_dump($nilairapor);
        // return false;

        $this->load->view('layout/header', $data);
        $this->load->view('student/addNilaiRapor', $data);
        $this->load->view('layout/footer', $data);
    }

    public function prosesNilaiRapor($id)
    {
        $session_id = $this->setting_model->getCurrentSession();
        $student    = $this->student->get($id);
        $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);
        
        $data = [
            'student'   => $student,
            'subjects'  => $this->subject->get(),
            'subject_groups'    => $this->subjectgroup_model->getSubject($session_id),
            'id'                => $id,
            'sch_setting'       => $this->sch_setting_detail,
            'session'           => $current_student_session["session"],
            'session_id'        => $session_id
        ];
        
        if ($this->input->post('submit1')) {

            $subject_group_subjects_id = $this->input->post('subject_id');
            $nilai_akhir = $this->nilairapor->getNilaiAkhir($id, $subject_group_subjects_id);
            $raporname = $this->nilairapor->getRaporByClassId($student['class_id']);

            $data_post = [
                'raporname' => $raporname ,
                'subject_group_id' => $this->input->post('subject_group_id'),
                'subject_group_subjects_id' => $subject_group_subjects_id,
                'nilai_akhir'               => $nilai_akhir     
            ];

            $dataAll = array_merge($data, $data_post);

            // var_dump($dataAll);
            // return false;

            $this->load->view('layout/header', $dataAll);
            $this->load->view('student/prosesNilaiRapor', $dataAll);
            $this->load->view('layout/footer', $dataAll);   
        }else{
            $this->load->view('layout/header', $data);
            $this->load->view('student/prosesNilaiRapor', $data);
            $this->load->view('layout/footer', $data);

            return;
        }
    }

    public function saveNilaiRapor()
    {
        $this->form_validation->set_rules('raporname', 'Rapor Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('deskpen', 'Deskripsi Capaian Kompetensi', 'trim|required|xss_clean');

        if($this->form_validation->run() == false){
            $this->load->view('layout/header', $data);
            $this->load->view('student/prosesNilaiRapor', $data);
            $this->load->view('layout/footer', $data);
        }else{
            $student_id = $this->input->post('student_id');
            $session_id = $this->setting_model->getCurrentSession();

            $checkedval = $this->input->post('cb');                
            $avgval = count($checkedval) > 0 ? array_sum($checkedval) / count($checkedval) : 0;  
            $dataAdd = array(
                'student_id'    => $student_id,
                'session_id'    => $session_id,
                'rapor_id'      => $this->input->post('raporname'),
                'subject_group_subjects_id'  => $this->input->post('subject_group_subjects_id'),
                'nilai_rapor'   => $avgval,
                'deskripsi'     => $this->input->post('deskpen')
            );

            // var_dump($dataAdd);
            // return false;

            $this->nilairapor->add($dataAdd);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/nilairapor/addnilairapor/'.$student_id);
        }
    }
   
    public function generateRapor($id)
    {
        $data = [
            'session_id' => $this->setting_model->getCurrentSession(),
            'student' => $this->student->get($id),
            'raporList' => $this->rapor->getBySession($this->setting_model->getCurrentSession()),
            'id' => $id
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('student/generateRapor', $data);
        $this->load->view('layout/footer', $data);
    }

    public function processGenerate($id)
    {
        $data = [
            'session_id' => $this->setting_model->getCurrentSession(),
            'student' => $this->student->get($id),
            'raporList' => $this->rapor->getBySession($this->setting_model->getCurrentSession()),
            'id' => $id
        ];

        if ($this->input->post('submit1')) {
            $student_id = $this->input->post('student_id');
            $data_post = [
                'listRapor' => $this->nilairapor->get($student_id),
                'listEkskul' => $this->nilaiekskul->get($student_id,$this->setting_model->getCurrentSession())
            ];

            $dataAll = array_merge($data, $data_post);
            $this->load->view('layout/header', $dataAll);
            $this->load->view('student/generateRapor', $dataAll);
            $this->load->view('layout/footer', $dataAll);
        } elseif ($this->input->post('submit2')) {
            $student_id = $this->input->post('student_id');
            $data_post = [
                'listRapor' => $this->nilairapor->get($student_id),
                'listEkskul' => $this->nilaiekskul->get($student_id),
                'student' => $this->student->get($id),
            ];
            $session = [
                'session' => str_replace('-', '/', $data_post['student']['session'])
            ];
            $data_all = array_merge($data_post, $session);


            $this->load->view('student/pdf_template', $data_all);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('student/generateRapor', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function getGroupByClassandSection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->subjectgroup_model->getGroupByClassandSection($class_id, $section_id);
        echo '<option value="">'.$this->lang->line('select').'</option>';
        foreach ($data as $item) {
            echo "<option value=" . $item['subject_group_id'] . ">" . $item['name'] . "</option>";
        }
    }

    public function getSubject()
    {
        $subject_group_id = $this->input->post('subject_group_id');
        $subjects = $this->subjectgroup_model->getGroupsubjects($subject_group_id);
        echo '<option value="">'.$this->lang->line('select').'</option>';
        foreach ($subjects as $subject) {
            echo "<option value=" . $subject->id . ">" . $subject->name . "</option>";
        }
    }
}