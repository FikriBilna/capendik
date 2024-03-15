<?php 

if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

class Ekstrakurikuler_model extends MY_model
{
    public function __construct(){
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null){
        $this->db->select()->from('ekstrakurikuler');
        if ($id != null){
            $this->db->where('id', $id);
        }else{
            $this->db->order_by('id');
        }

        $query = $this->db->get();

        if($id != null){
            $ekskullist = $query->row_array();
        }else{
            $ekskullist = $query->result_array();
        }

        return $ekskullist;
    }

    public function remove($id){
        $this->db->trans_start(); #Starting Transaction
        $this->db->trans_strict(false); #See Note 01. If you wish can remove as well
        //====================Code Start=======================
        $this->db->delete('ekstrakurikuler');
        $this->db->where('id', $id);
        $message = DELETE_RECORD_CONSTANT . " On ekstrakurikuler id" . $id;
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

    public function add($data){
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //====================Code Start===================
        if(isset($data['id'])){
            $this->db->where('id', $data['id']);
            $this->db->update('ekstrakurikuler', $data);
            $message = UPDATE_RECORD_CONSTANT . " On rooms id " . $data['id'];
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
        }else{
            $this->db->insert('ekstrakurikuler', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On ekstrakurikuler id " . $id;
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

}