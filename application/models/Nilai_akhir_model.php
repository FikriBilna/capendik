<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai_akhir_model extends MY_model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function countBy($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('nilai');
        return $query->num_rows();
    }

    public function sum_numbers($id)
    {
        $this->db->select_sum('sumatif');
        $this->db->where('student_id', $id);
        $query = $this->db->get('nilai');
        return $query->row()->sumatif;
    }

    public function getNilai($student, $subject, $jenis)
    {
        $this->db->select('nilai.*, students.firstname as studentName, subjects.name as subjectName, lesson.name as lessonName, topic.name as topicName');
        $this->db->from('nilai');
        $this->db->join('students', 'students.id = nilai.student_id');
        $this->db->join('lesson', 'lesson.id = nilai.lesson_id');
        $this->db->join('topic', 'topic.id = nilai.topic_id');
        $this->db->join('subject_group_subjects', 'subject_group_subjects.id = nilai.subject_id');
        $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
        $this->db->where('nilai.student_id', $student);
        $this->db->where('nilai.subject_id', $subject);
        $this->db->where('nilai.type_nilai', $jenis);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get($id = null)
    {
        $this->db->select('nilai_akhir.*, subjects.name as subjectName');
        $this->db->from('nilai_akhir');
        $this->db->join('subject_group_subjects', 'subject_group_subjects.id = nilai_akhir.subject_group_subjects_id');
        $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
        $this->db->where('nilai_akhir.student_id', $id);


        $query = $this->db->get();

        if ($id != null) {
            $raporList = $query->result_array();
        } else {
            $raporList = $query->result_array();
        }

        return $raporList;
    }


    public function getNilaibyId($id)
    {
        $this->db->select('*')->from('nilai');
        if ($id != null) {
            $this->db->where('id', $id);
        }

        $query = $this->db->get();

        if ($id != null) {
            $raporList = $query->row_array();
        } else {
            $raporList = $query->result_array();
        }

        return $raporList;
    }

    public function add($data)
    {
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //====================Code Start===================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('nilai_akhir', $data);
            $message = UPDATE_RECORD_CONSTANT . " On nilai_akhir id " . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
        } else {
            $this->db->insert('nilai_akhir', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On nilai_akhir id " . $id;
            $action = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);
            //======================Code End==============================

            $this->db->trans_complete(); # Completing transaction
            /* Optional */

            if ($this->db->trans_status() === false) {
                # Something went wrong.
                $this->db->trans_rollback();
                return false;
            } else {
                //return $return_value;
            }
        }
    }

    public function remove($id)
    {
        $this->db->trans_start(); #Starting Transaction
        $this->db->trans_strict(false); #See Note 01. If you wish can remove as well
        //====================Code Start=======================
        $this->db->where('id', $id);
        $this->db->delete('nilai');
        $message = DELETE_RECORD_CONSTANT . " On nilai id" . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //====================End Code=========================
        $this->db->trans_complete(); #completing transaction
        /* Optional */
        if ($this->db->trans_status() === false) {
            # something went wrong
            $this->db->trans_rollback();
            return false;
        } else {
            // return $return_value;
        }
    }

    public function getTopicByLessonid($lesson_id)
    {
        $this->db->where('lesson_id', $lesson_id);
        $query = $this->db->get('topic');
        return $query->result_array();
    }

    public function getLessonBySubject($subject_id)
    {
        $this->db->where('subject_group_subject_id', $subject_id);
        $result = $this->db->get('lesson');
        return $result->result_array();
    }
}
