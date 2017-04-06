<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Production_Model');
    }
    
    function index()
    {
        echo 'Production Page';
    }
    
    function insertProduction() {
        $dataProduction = array(
            'date' => date('Y-m-d', strtotime('4/6/2017'))
        );
        
        $pId = array(1, 2);
        $iId = array(1, 1);
        $pAmt = array(100, 250);
        $prId = $this->Production_Model->insertProduction($dataProduction);
        
        for($i = 0; $i < count($pId); $i++)
        {
            $dataProductionRltn = array(
                'pr_id' => $prId,
                'p_id'  => $pId[$i],
                'i_id'  => $iId[$i],
                'p_amt' => $pAmt[$i]
            );
            $prRltnId = $this->Production_Model->insertProductionRltn($dataProductionRltn);
            
            if($prRltnId) 
            {
                $pTotal = $this->Production_Model->ProductionAmtSum($pId[$i], $iId[$i]);
                
                $dataProduct = array(
                    'total' => $pTotal[0]['total']
                );
                $this->Production_Model->updateProductTotal($pId[$i], $dataProduct);
            }
        }
        
    }
}