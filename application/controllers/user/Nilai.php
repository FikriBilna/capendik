<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai extends Student_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_model', 'nilai_model');
        $this->load->model('Nilairapor_model', 'nilai_rapor');
    }

    public function index()
    {
        $student_id   = $this->customlib->getStudentSessionUserID();
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);
        $data = [
            'nilai' => $this->nilai_model->get($student_id),
            'student' => $student
        ];
        $this->load->view("layout/student/header");
        $this->load->view("user/nilai/index", $data);
        $this->load->view("layout/student/footer");
    }

    public function rapor()
    {
        $student_id   = $this->customlib->getStudentSessionUserID();
        $student_current_class = $this->customlib->getStudentCurrentClsSection();
        $student = $this->student_model->getStudentByClassSectionID($student_current_class->class_id, $student_current_class->section_id, $student_id);
        $data = [
            'nilai' => $this->nilai_rapor->get($student_id),
            'student' => $student
        ];
        $this->load->view("layout/student/header");
        $this->load->view("user/nilai/rapor", $data);
        $this->load->view("layout/student/footer");
    }
}
