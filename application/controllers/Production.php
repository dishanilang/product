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
        $pId = array(1, 2);
        $iId = array(1, 1);
        $pAmt = array(100, 250);
        
        $dataProduction = array(
            'date' => date('Y-m-d', strtotime('4/6/2017'))
        );
        
        $prId = $this->Production_Model->insertProduction($dataProduction);
        
        if($prId)
        {
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
    
    function updateProduction()
    {
        // POST values
        $prRelId = 2; // get Production relation id
        $prId = 1; // get Production id
//        $pId = array(1 /*new product id*/, 2/*old product id*/);
//        $iId = array(1 /*new industry id*/, 1/*old industry id*/);
//        $pAmt = array(200/*new product amount*/, 250/*old product amount*/);
        $pIdNew = 1;
        $iIdNew = 1;
        $pAmtNew = 300;
        
        $pIdOld = 2;
        $iIdOld = 1;
        //$pAmtOld = 250;
        
        $dataProduction = array(
            'date' => date('Y-m-d', strtotime('4/10/2017'))
        );
        
        $prResult = $this->Production_Model->updateProduction($prId, $dataProduction);

        if($prResult)
        {
//            for($i = 0; $i < count($pId); $i++)
//            {
                $dataProductionRltn = array(
                    'p_id' => $pIdNew,
                    'i_id' => $iIdNew,
                    'p_amt' => $pAmtNew,

                );
                $prRltnResult = $this->Production_Model->updateProductionRltn($prRelId, $dataProductionRltn);
                
                $pTotalNew = $this->Production_Model->ProductionAmtSum($pIdNew, $iIdNew);
                $pTotalOld = $this->Production_Model->ProductionAmtSum($pIdOld, $iIdOld);

                $dataProductNew = array(
                    'total' => $pTotalNew[0]['total'],
                );
                $this->Production_Model->updateProductTotal($pIdNew, $dataProductNew);
                
                $dataProductOld = array(
                    'total' => $pTotalOld[0]['total'],
                );
                $this->Production_Model->updateProductTotal($pIdOld, $dataProductOld);
//            }
        }
    }
}