<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rapor extends Admin_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('rapor_model');
        $this->load->model('classteacher_model');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    public function index(){ //ADD RAPOR
        if (!$this->rbac->hasPrivilege('rapor', 'can_view')) {
            access_denied();
        }

        $sch_setting = $this->setting_model->getSchoolDetail();
        $data['sch_setting'] = $this->sch_setting_detail;
        $class = $this->class_model->get('', $clasteacher = 'yes');
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if(!empty($data["classlist"])){
            foreach($data["classlist"] as $ckey => $cvalue){
                $carray[] = $cvalue['id'];
            }
        }

        $role_id = $userdata["role_id"];
        if(isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == 'yes')){
            if($userdata["class_teacher"] == 'yes'){
                $carray = array();
                $class = array();
                // $class = $this->teacher_model->get_daywiseattendanceclass($userdata["id"]);
            }
        }

        

        $data['title'] = "Rapor List";
        $data['classlist'] = $class;
        $data['class_id'] = "";

        $rapor_result = $this->rapor_model->get();
        $data['raporList'] = $rapor_result;

        #VALIDATION
        $this->form_validation->set_rules('class_id', $this->lang->line('class'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('raporname', 'Rapor Name', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false){
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/raporList', $data);
            $this->load->view('layout/footer', $data);
        }else{
            $class = $this->input->post('class_id');
            $data = array(
                'rapor_name' => $this->input->post('raporname'),
                'class_id' => $class,
            );
            $this->rapor_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">'.$this->lang->line('success_message').'</div>');
            redirect('admin/rapor');
        }
    }

    public function delete($id){
        if(!$this->rbac->hasPrivilege('rapor', 'can_delete')){
            access_denied();
        }
        $data['title'] = 'Rapor List';
        $this->rapor_model->remove($id);

        redirect('admin/rapor');
    }

    public function edit($id){
        if (!$this->rbac->hasPrivilege('rapor', 'can_edit')){
            access_denied();
        }

        $data['title']      = 'Rapor List';
        $rapor_result        = $this->rapor_model->get();
        $data['raporlist']   = $rapor_result;
        $data['title']      = 'Edit Rapor';
        $data['id']         = $id;
        $rapor               = $this->rapor_model->get($id);
        $data['rapor']       = $rapor;

         #VALIDATION
         $this->form_validation->set_rules('raporname', 'Rapor Name', 'trim|required|xss_clean');
         if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/raporEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'rapor_name' => $this->input->post('raporname'),
            );
            $this->rapor_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('update_message') . '</div>');
            redirect('admin/rapor');
        }
    }

}