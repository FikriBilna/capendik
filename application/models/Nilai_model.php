<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai_model extends MY_model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function countBy($id)
    {
        $this->db->where('student_id', $id);
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

    public function get($id = null)
    {
        $this->db->select('nilai.*,sessions.session as sessionName,students.firstname as name, subject_group_subjects.id as subjectGroupId, subject_group_subjects.subject_id as subjectGroupSubjectId, subjects.name as subjectName, topic.name as topicName, lesson.name as lessonName')->from('nilai');
        if ($id != null) {
            $this->db->where('student_id', $id);
        }

        $this->db->join('sessions', 'sessions.id=nilai.session_id');
        $this->db->join('students', 'students.id=nilai.student_id');
        $this->db->join('subject_group_subjects', 'subject_group_subjects.id=nilai.subject_id');
        $this->db->join('subjects', 'subjects.id=subject_group_subjects.subject_id');
        $this->db->join('topic', 'topic.id=nilai.topic_id', 'left');
        $this->db->join('lesson', 'lesson.id=nilai.lesson_id', 'left');

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
        } else {
            $this->db->order_by('id');
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
            $this->db->update('nilai', $data);
            $message = UPDATE_RECORD_CONSTANT . " On nilai id " . $data['id'];
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
            $this->db->insert('nilai', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On nilai id " . $id;
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
