<?php 

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class Nilairapor_model extends MY_model 
{
    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null)
    {
        $this->db->select('nilai_rapor.* , subject_group_subjects.id, subject_group_subjects.subject_id, subjects.id, subjects.name as subjectName, rapor.id as raporId, rapor.rapor_name');
        $this->db->from('nilai_rapor');
        $this->db->join('subject_group_subjects', 'subject_group_subjects.id = nilai_rapor.subject_group_subjects_id');
        $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
        $this->db->join('rapor', 'rapor.id = nilai_rapor.rapor_id');
        $this->db->where('nilai_rapor.student_id', $id);

        $query = $this->db->get();

        if($id !== null){
            $nilairapor = $query->result_array();
        }else{
            $nilairapor = $query->result_array();
        }

        return $nilairapor;
    }

    public function add($data)
    {
        $this->db->trans_start();
        $this->db->trans_strict();

        if(isset($data['id'])){
            $this->db->where('id', $data['id']);
            $this->db->update('nilai_rapor', $data);
            $message = UPDATE_RECORD_CONSTANT . "On nilai_rapor id" . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record_id, $action);

            $this->db->trans_complete();

            if($this->db->trans_status() === false){
                $this->db->trans_rollback();
                return false;
            }else{
                // return $return_value;
            }
        }else{
            $this->db->insert('nilai_rapor', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . "on nilai_rapor id" . $id;
            $action = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);

            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
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
        $this->db->delete('nilai_rapor');
        $this->db->where('id', $id);
        $message = DELETE_RECORD_CONSTANT . " On nilai_rapor id" . $id;
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

    public function getNilaiAkhir($id, $subject_group_subject_id){
        $this->db->select('nilai_akhir.*, subjects.id AS subjectId, subjects.name AS subjectName, subject_group_subjects.id AS subjectGroupSubjectId')->from('nilai_akhir');
        $this->db->join('subject_group_subjects', 'subject_group_subjects.id = nilai_akhir.subject_group_subjects_id');
        $this->db->join('subjects', 'subjects.id = subject_group_subjects.subject_id');
        $this->db->where('nilai_akhir.student_id', $id);
        $this->db->where('nilai_akhir.subject_group_subjects_id', $subject_group_subject_id);

        $query = $this->db->get();

        if($id !== null){
            $nilaiakhir = $query->result_array();
        }else{
            $nilaiakhir = $query->result_array();
        }

        return $nilaiakhir;
    }

    public function getRaporByClassId($id){
        $this->db->select('*')->from('rapor');
        if ($id != null) {
            $this->db->where('class_id', $id);
        } else {
            $this->db->order_by('id');
        }

        $query = $this->db->get();

        if ($id != null) {
            $raporList = $query->result_array();
        } else {
            $raporList = $query->result_array();
        }

        return $raporList;
    }
}