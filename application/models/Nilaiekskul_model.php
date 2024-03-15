<?php 

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class Nilaiekskul_model extends MY_model
{
    public function __construct(){
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id){
        $this->db->select('nilai_ekskul.*, students.id AS students_id, ekstrakurikuler.id AS ekskul_id, ekstrakurikuler.name AS ekskul_name, ekstrakurikuler.code AS ekskul_code, sessions.id AS session_id, sessions.session AS session')->from('nilai_ekskul');
        $this->db->join('students', 'students.id=nilai_ekskul.student_id');
        $this->db->join('ekstrakurikuler', 'ekstrakurikuler.id=nilai_ekskul.ekstrakurikuler_id');
        $this->db->join('sessions', 'sessions.id=nilai_ekskul.session_id');
        if ($id != null){
            $this->db->where('students.id', $id);
        }else{
            $this->db->order_by('id');
        }

        $query = $this->db->get();

        if($id != null){
            $resultlist = $query->result_array();
        }else{
            $resultlist = $query->result_array();
        }

        return $resultlist;
    }

    public function add($data){
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //====================Code Start===================
        $this->db->insert('nilai_ekskul', $data);
        $id = $this->db->insert_id();
        $message = INSERT_RECORD_CONSTANT . " On nilai_ekskul id " . $id;
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

    public function remove($id){
        $this->db->trans_start(); #Starting Transaction
        $this->db->trans_strict(false); #See Note 01. If you wish can remove as well
        //====================Code Start=======================
        $this->db->where('id', $id);
        $this->db->delete('nilai_ekskul');
        $message = DELETE_RECORD_CONSTANT . " On nilai_ekskul id" . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        //====================End Code=========================
        $this->db->trans_complete(); #completing transaction
        /* Optional */
        if ($this->db->trans_status() === false){
            # something went wrong
            $this->db->trans_rollback();
            return false;
        }else{
            // return $return_value;
        }
    }
}