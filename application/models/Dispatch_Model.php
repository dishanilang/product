<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatch_Model extends CI_Model
{
    function insertDispatch($data) {
        $this->db->insert('dispatch', $data);
        return $this->db->insert_id();
    }
    
    function insertDispatchRltn($data) {
        $this->db->insert('dispatch_rltn', $data);
        return $this->db->insert_id();
    }
    
    function DispatchAmtSum($pId, $iId) {
        $condition = array(
            'p_id' => $pId,
            'i_id' => $iId
        );
        
        $this->db->select('sum(d_amt) AS d_total');
        $this->db->from('dispatch_rltn');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function updateProductTotal($id, $updateData) {
        $this->db->where('p_id', $id);
        $this->db->update('product', $updateData); 
    }
    
    function updateDispatch($id, $updateData) {
        $this->db->where('pr_id', $id);
        return $this->db->update('production', $updateData); 
    }
    
    function updateDispatchRltn($id, $updateData) {
        $this->db->where('rel_id', $id);
        $this->db->update('production_rltn', $updateData);
    }
}