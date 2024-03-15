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
        $this->load->model('subject_model', 'subject');
    }

    public function index()
    {
        $data['title']       = 'Nilai List';
        $data['student_list'] = $this->student->get();
        // var_dump($this->student->get());
        // die;
        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addNilai($id)
    {
        $data = [
            'student' => $this->student->get($id),
            'subject' => $this->subject->get(),
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('student/addNilai', $data);
        $this->load->view('layout/footer', $data);
    }
}
