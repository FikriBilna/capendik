<?php 

if (!defined('BASEPATH')) {
    exit("no direct script allowed");
}

Class Ekstrakurikuler extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('ekstrakurikuler_model', 'ekskul');
        $this->load->model('nilaiekskul_model', 'nilaiekskul');
        $this->load->model('student_model', 'student');
        $this->load->model('setting_model');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function index(){
        if (!$this->rbac->hasPrivilege('ekskul', 'can_view')) {
            access_denied();
        }

        $ekskul_list    = $this->ekskul->get();
        $data = [
            'tittle'        => 'Ekstrakurikuler',
            'ekskulList'    => $ekskul_list
        ];

        #VALIDATION
        $this->form_validation->set_rules('ekskulname', 'Ekstrakurikuler Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ekskulname', 'Ekstrakurikuler Code', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/ekstrakurikuler/ekskulList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array (
                'name' => $this->input->post('ekskulname'),
                'code' => $this->input->post('ekskulcode'),
            );
            $this->ekskul->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/ekstrakurikuler');
        }
    }

    public function delete($id)
    {
        $this->nilai->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('admin/nilaistudent');
    }

    public function edit($id){
        if (!$this->rbac->hasPrivilege('room', 'can_edit')){
            access_denied();
        }

        $ekskul_list1    = $this->ekskul->get($id);
        $ekskul_list2   = $this->ekskul->get();
        $data = [
            'id'            => $id,
            'tittle'        => 'Ekstrakurikuler',
            'ekskulList'    => $ekskul_list2,
            'ekskul'        => $ekskul_list1
        ];

        $this->form_validation->set_rules('ekskulname', 'Ekstrakurikuler Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ekskulname', 'Ekstrakurikuler Code', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/ekstrakurikuler/ekskulEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array (
                'id'    => $id,
                'name'  => $this->input->post('ekskulname'),
                'code'  => $this->input->post('ekskulcode'),
            );
            $this->ekskul->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/ekstrakurikuler');
        }
    }

    // NILAI EKSTRAKURIKULER //

    public function addNilaiEkskul($id = null){
        if (!$this->rbac->hasPrivilege('ekskul', 'can_edit')){
            access_denied();
        }

        if($id != null){
            $session_id = $this->setting_model->getCurrentSession();
            $data = [
                'id'        => $id,
                'student'   => $this->student->get($id),
                'ekskul'    => $this->ekskul->get(),
                'nilaiEkskul'   => $this->nilaiekskul->get($id),  
    
            ];
    
            // var_dump($data);
            // return false;
            $this->form_validation->set_rules('ekskul_id', 'Ekstrakurikuler', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ekskul_ket', 'Keterangan', 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/ekstrakurikuler/addNilaiEkskul', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data = array(
                    'session_id' => $session_id,
                    'student_id' => $this->input->post('student_id'),
                    'ekstrakurikuler_id' => $this->input->post('ekskul_id'),
                    'ket' => $this->input->post('ekskul_ket'),
                );
                $this->nilaiekskul->add($data);
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
                redirect('admin/ekstrakurikuler/addnilaiekskul/' . $id);
            }
        }else{
            $data['adm_auto_insert'] = $this->sch_setting_detail->adm_auto_insert;
            $data['sch_setting']     = $this->sch_setting_detail;
            $data['fields']          = $this->customfield_model->get_custom_fields('students', 1);
            $class                   = $this->class_model->get();
            $data['classlist']       = $class;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/ekstrakurikuler/nilaiEkskul', $data);
            $this->load->view('layout/footer', $data);
        }     
    }

    public function delNilaiEkskul($id){
        $this->nilaiekskul->remove($id);
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
        redirect('admin/ekstrakurikuler/addNilaiEkskul');
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

                    $collectbtn = "<a href='" . base_url() . "admin/ekstrakurikuler/addnilaiekskul/" . $student->id . "' class='btn btn-default btn-xs' data-toggle='tooltip' data-placement='left' title='Add Nilai'><i class='fa fa-plus'></i></a>";

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
}