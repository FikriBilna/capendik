<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dev extends CI_controller{
  public function __construct(){
      parent::__construct();
      $this->load->model("student_model");
      // $this->load->library('form_validation');

  }

  public function index(){
    $this->load->view('dev');
  }

  // public function getmurid(){
  //    $data['judul'] = "TEST DATA MURID";
  //    $murid_res = $this->student_model->getStudents();
  //    $data['listmurid'] = $murid_res;
  //
  //   $this->load->view('devstudent', $data);
  // }
}
