<?php

if (!defined('BASEPATH')){
    exit("no direct script allowed");
}

class Weightage extends Admin_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('session_model');
        $this->load->model('weightage_model', 'weightage');
        $this->load->model('subject_model', 'subject');
    }

    public function index(){
        //ADD Weightages
        if(!$this->rbac->hasPrivilege('weightage', 'can_view')){
            access_denied();
        }

        $weightage_result = $this->weightage->get();
        $session_result = $this->session_model->get();
        $subject_result = $this->subject->get();

        $data = array(
            'title' => 'Weightage Name List',
            'weightageList' => $weightage_result, 
            'subjectList' => $subject_result,       
        );

        #VALIDATION
        $this->form_validation->set_rules('weightagename', 'Weightage Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weightage/weightageList', $data);
            $this->load->view('layout/footer', $data);
        }else{
            $data = array(
                'weightage_name' => $this->input->post('weightagename'),
                'subject_id' => $this->input->post('subject_id'),
            );
            $this->weightage->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/weightage');
        }
    }

    public function edit($id){
        if (!$this->rbac->hasPrivilege('weightage', 'can_edit')){
            access_denied();
        }

        $weightage_result = $this->weightage->get();
        $session_result = $this->session_model->get();
        $subject_result = $this->subject->get();
        $weightageGet = $this->weightage->get($id);

        // print_r($weightageGet);

        $data = array(
            'title' => 'Weightage Name List',
            'weightageList' => $weightage_result, 
            'subjectList' => $subject_result, 
            'id' => $id,
            'weightageGet' => $weightageGet,
        );

        $this->form_validation->set_rules('weightagename', 'Weightage Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        if($this->form_validation->run() == false){
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weightage/weightageEdit', $data);
            $this->load->view('layout/footer', $data);
        }else{
            $data = array(
                'id' => $id,
                'weightage_name' => $this->input->post('weightagename'),
                'subject_id' => $this->input->post('subject_id'),
            );
            $this->weightage->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/weightage');
        }
    }

    public function delete($id){
        if(!$this->rbac->hasPrivilege('weightage', 'can_delete')){
            access_denied();
        }
        $data['title'] = 'Weightage Name List';
        $this->weightage->remove($id);
        redirect('admin/weightage');
    }


}