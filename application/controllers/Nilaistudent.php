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
        $this->load->model('subjectgroup_model', 'subject_group');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('nilai', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Nilai List';
        $data['student_list'] = $this->student->get();
        $this->load->view('layout/header', $data);
        $this->load->view('student/nilaiList', $data);
        $this->load->view('layout/footer', $data);
    }

    public function addNilai($id)
    {
        $session_id = $this->setting_model->getCurrentSession();
        $totalNilai = $this->nilai->sum_numbers($id);
        $jumlahNilai = $this->nilai->countBy($id);
        $listNilai = $this->nilai->get($id);
        $finalScore = 0;
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $subject_group = $this->subject_group->getGroupByClassandSection($class_id, $section_id);
        if ($listNilai != null) {
            $finalScore = round($totalNilai / $jumlahNilai);
        }
        $data = [
            'student' => $this->student->get($id),
            'subject' => $this->subject->get(),
            'lessons' => $this->lesson->getlessonBysessionid($this->setting_model->getCurrentSession()),
            'topic' => $this->lesson->getTopicBySession($session_id),
            'listNilai' => $listNilai,
            'finalScore' => $finalScore,
            'id' => $id,
            'subjectGroup' => $subject_group
        ];
        
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lesson_id', 'Lesson', 'trim|required|xss_clean');
        $this->form_validation->set_rules('topic_id', 'Topic', 'trim|required|xss_clean');
        $this->form_validation->set_rules('jenis_nilai', 'Jenis Nilai', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sumatif', 'Sumatif', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            // var_dump($subject_group);
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
            redirect('admin/nilaistudent');
        }
    }

    public function getsubject_group_class_sectionId($class_id, $section_id, $subject_group_id)
    {
        $sql = "SELECT subject_groups.name, subject_group_class_section.* FROM subject_group_class_section INNER JOIN class_section on class_section.id=subject_group_class_section.class_section_id INNER JOIN  subject_groups on subject_groups.id=subject_group_class_section.subject_group_id WHERE class_section.class_id=" . $this->db->escape($class_id) . "AND class_sections.section_id=" . $this->db->escape($section_id) . "AND subject_group.id=" . $this->db->escape($subject_group_id) . "AND subject_groups.session_id=" . $this->db->escape($this->current_session) . "ORDER BY subject_groups.id DESC";
        $query = $this->db->query($sql);

        return $query->row_array();
    }

    public function getTopic()
    {
        $data = $this->lesson->gettopicBylessonid($this->input->post('lesson_id'), $this->setting_model->getCurrentSession());
        echo json_encode($data);
    }
}
