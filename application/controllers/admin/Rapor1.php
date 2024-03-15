<?php

if (!defined('BASEPATH')) {
    exit("no direct script allowed");
}

class Rapor extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rapor_model', 'rapor');
        $this->load->model('session_model');
        $this->load->model('class_model', 'class');
        $this->load->model('subject_model', 'subject');
        $this->load->model('rapor_subject_model', 'rapor_subject');
        $this->load->model('Rapor_subject_weightage_model', 'subject_weightage');
        $this->load->model('weightage_model', 'weightage');
    }

    public function index()
    { //ADD ROOM
        if (!$this->rbac->hasPrivilege('rapor', 'can_view')) {
            access_denied();
        }

        $rapor_result = $this->rapor->get();
        $session_result = $this->session_model->get();
        $class_result = $this->class->get();

        $data = array(
            'title' => 'Rapor List',
            'raporList' => $rapor_result,
            'sessionList' => $session_result,
            'classList' => $class_result,
        );

        #VALIDATION
        $this->form_validation->set_rules('rapor_name', 'Rapor Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('session_id', 'Session', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/raporList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'rapor_name' => $this->input->post('rapor_name'),
                'session_id' => $this->input->post('session_id'),
                'class_id' => $this->input->post('class_id'),
            );
            $this->rapor->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/rapor');
        }
    }

    public function add_subject($id)
    {
        if (!$this->rbac->hasPrivilege('rapor', 'can_view')) {
            access_denied();
        }
        #UNDER MENU
        $subject_result = $this->subject->get();
        $raporName = $this->rapor->get($id);
        $raporSubjects = $this->rapor_subject->get($id, '');
        $data = array(
            'title' => 'Subject List',
            'rapor_id' => $id,
            'raporName' => $raporName,
            'subjects' => $subject_result,
            'raporSubjects' => $raporSubjects
        );

        #VALIDATION
        $this->form_validation->set_rules('rapor_id', 'Rapor', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/addSubject', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'rapor_id' => $this->input->post('rapor_id'),
                'subject_id' => $this->input->post('subject_id')
            );
            $this->rapor_subject->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/rapor/add_subject/' . $id);
        }
    }

    public function add_weightage($id)
    {
        if (!$this->rbac->hasPrivilege('rapor', 'can_view')) {
            access_denied();
        }
        $rapor_subject = $this->rapor_subject->get('', $id);
        $subjectName = $this->subject->get($rapor_subject['subject_id']);
        $raporName = $this->rapor->get($rapor_subject['rapor_id']);
        $subject_weightage = $this->subject_weightage->get('', $id, '');
        $weightage_result = $this->weightage->get($_GET['subject']);
        $data = array(
            'title' => 'Add Weightage',
            'id' => $id,
            'raporName' => $raporName,
            'subjectName' => $subjectName,
            'subjectWeightage' => $subject_weightage,
            'weightageList' => $weightage_result
        );

        #VALIDATION
        if ($this->input->post()) {
            $rapor_subject_id = $this->input->post('rapor_subject_id');
            $inputs = $this->input->post('inputs');
            foreach ($inputs as $input) {
                $weightage_id = $input['weightage_id'];
                $weightage_score = $input['weightage_score'];

                $data = array(
                    'rapor_subject_id' => $rapor_subject_id,
                    'weightage_id' => $weightage_id,
                    'weightage_score' => $weightage_score
                );

                $this->subject_weightage->add($data);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/rapor/add_subject/' . $this->input->post('subject_id'));
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/addWeightage', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function edit_weightage($id)
    {
        if (!$this->rbac->hasPrivilege('rapor', 'can_view')) {
            access_denied();
        }
        // $rapor_subject = $this->rapor_subject->get('', $id);
        // $subjectName = $this->subject->get($rapor_subject['subject_id']);
        $weightage = $this->subject_weightage->get('', '', $id);
        $rapor_subject = $this->rapor_subject->get('', $weightage['rapor_subject_id']);
        $weightages = $this->weightage->get($rapor_subject['subject_id']);
        $subject_weightage = $this->subject_weightage->get('', $_GET['rapor_subject'], '');
        $data = array(
            'title' => 'Add Weightage',
            'id' => $id,
            'subjectWeightage' => $weightage,
            'weightages' => $weightages,
            'weightageList' => $subject_weightage
        );

        #VALIDATION
        $this->form_validation->set_rules('weightage_id', 'Weightage', 'trim|required|xss_clean');
        $this->form_validation->set_rules('weightage_score', 'Weightage Score', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/rapor/weightageEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'weightage_id' => $this->input->post('weightage_id'),
                'weightage_score' => $this->input->post('weightage_score'),
            );
            $this->subject_weightage->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">' . $this->lang->line('success_message') . '</div>');
            redirect('admin/rapor/add_weightage/' . $this->input->post('rapor_subject') . '?aksi=' . $this->input->post('aksi') . '&subject=' . $this->input->post('subject'));
        }
    }

    public function delete_rapor($id)
    {
        if (!$this->rbac->hasPrivilege('room', 'can_delete')) {
            access_denied();
        }
        $data['title'] = "Room List";
        $this->rapor->remove($id);

        redirect('admin/rapor');
    }

    public function delete_subject($id)
    {
        if (!$this->rbac->hasPrivilege('rapor', 'can_delete')) {
            access_denied();
        }
        $this->rapor_subject->remove($id);

        redirect('admin/rapor/add_subject/' . $_GET['aksi']);
    }

    public function delete_weightage($id)
    {
        if (!$this->rbac->hasPrivilege('rapor', 'can_delete')) {
            access_denied();
        }
        $this->subject_weightage->remove($id);
        redirect('admin/rapor/add_weightage/' . $_GET['rapor_subject'] . '?aksi=' . $_GET['aksi'] . '&subject=' . $_GET['subject']);
    }
}
