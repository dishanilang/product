<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_Model');
    }
    
    function index() {
        $data['alldata'] = $this->Dashboard_Model->getData();
        $this->load->view('dashboard', $data);
    }
}