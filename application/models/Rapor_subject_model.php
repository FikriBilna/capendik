<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rapor_subject_model extends MY_model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($rapor_id = null, $id = null)
    {
        $this->db->select()->from('rapor_subject');
        if ($rapor_id != null) {
            $this->db->where('rapor_id', $rapor_id);
        } else {
            $this->db->where('id', $id);
        }

        $query = $this->db->get();

        if ($rapor_id != null) {
            $raporList = $query->result_array();
        } else {
            $raporList = $query->row_array();
        }

        return $raporList;
    }

    public function remove($id)
    {
        $this->db->trans_start(); #Starting Transaction
        $this->db->trans_strict(false); #See Note 01. If you wish can remove as well
        //====================Code Start=======================
        $this->db->where('rapor_subject_id', $id);
        $this->db->delete('rapor_subject_weightage');
        $this->db->where('id', $id);
        $this->db->delete('rapor_subject');
        $message = DELETE_RECORD_CONSTANT . " On rapor_subject id" . $id;
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

    public function add($data)
    {
        $this->db->trans_start(); #starting transaction
        $this->db->trans_strict(false);
        //====================Code Start===================
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('rapor_subject', $data);
            $message = UPDATE_RECORD_CONSTANT . " On rapor_subject id " . $data['id'];
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
            $this->db->insert('rapor_subject', $data);
            $id = $this->db->insert_id();
            $message = INSERT_RECORD_CONSTANT . " On rapor_subject id " . $id;
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
