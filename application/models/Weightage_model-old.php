<?php

if(!defined('BASEPATH')){
    exit('No direct script allowed');
}

class Weightage_model extends MY_model
{
    public function __construct(){
        parent::_construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null){
        $this->db->select()->from('weightages');
        if($id != null ){
            $this->db->where('id', $id);
        }else{
            $this->db->order_by('id');
        }

        $query = $this->db->get();

        if($id != null){
            $weightageList = $query->row_array();
        }else{
            $weightageList = $query->result_array();
        }

        return $weightageList;
    }

    public function add($data){
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //=====================Code Start==================
        if(isset($data['id'])){
            $this->db->where('id', $data['id']);
            $this->db->update('weightages', $data);
            $message = UPDATE_RECORD_CONSTANT . "On weightages id" . $data['id'];
            $action = "Update";
            $record_id = $data['id'];
            $this->log($message, $record, $action);

            $this->db->trans_complete(); #completing transaction

            if ($this->db->trans_status() === false){
                #something wrong
                $this->db->trans_rollback();
                return false;
            }else{
                //return $return_value;
            }
        }else{
            $this->db->insert('weightages', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . "On weightages id" . $id;
            $action = "Insert";
            $record_id = $id;
            $this->log($message, $record_id, $action);

            $this->db->trans_complete(); #completing transaction

            if($this->db->trans_status() === false){
                #something wrong
                $this->db->trans_rollback();
                return false;
            }else{
                #return $return_value;
            }
        }

    }

    public function remove($id){
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //=====================Code Start===============
        $this->db->where('id', $id);
        $this->db->delete('weightages');
        $message = DELETE_RECORD_CONSTANT."On weightages id".$id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);

        $this->db->trans_complete(); #completing transaction

        if($this->db->trans_status() === false){
            #something wrong
            $this->db->trans_rollback();
            return false;
        }else{
            // return $return_value;
        }
    }
    
}