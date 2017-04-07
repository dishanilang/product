<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model
{
    function getData() {
        $this->db->select('i.i_name, p.p_name, p.total');
        $this->db->from('product AS p');
        $this->db->join('industry AS i', 'i.i_id = p.i_id', 'left');
        $this->db->order_by('p.p_id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}