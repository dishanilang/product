<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production_Model extends CI_Model
{
    function insertProduction($data) {
        $this->db->insert('production', $data);
        return $this->db->insert_id();
    }
    
    function insertProductionRltn($data) {
        $this->db->insert('production_rltn', $data);
        return $this->db->insert_id();
    }
    
    function ProductionAmtSum($pId, $iId) {
        $condition = array(
            'p_id' => $pId,
            'i_id' => $iId
        );
        
        $this->db->select('sum(p_amt) AS total');
        $this->db->from('production_rltn');
        $this->db->where($condition);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function updateProductTotal($id, $updateData) {
        $this->db->where('p_id', $id);
        $this->db->update('product', $updateData); 
    }
    
    function updateProduction($id, $updateData) {
        $this->db->where('pr_id', $id);
        return $this->db->update('production', $updateData); 
    }
    
    function updateProductionRltn($id, $updateData) {
        $this->db->where('rel_id', $id);
        $this->db->update('production_rltn', $updateData);
    }
}