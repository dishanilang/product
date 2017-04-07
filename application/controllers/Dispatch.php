<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dispatch extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Dispatch_Model');
    }
    
    function index()
    {
        echo 'Dispatch Page';
    }
    
    function insertDispatch() {
        // multiple insertion of dispatch
        $pId = array(1, 2);
        $iId = array(1, 1);
        $pAmt = array(100, 250);
        
        $dataDispatch = array(
            'd_date' => date('Y-m-d', strtotime('4/6/2017'))
        );
        
        $dId = $this->Dispatch_Model->insertDispatch($dataDispatch);
        
        if($dId)
        {
            for($i = 0; $i < count($pId); $i++)
            {
                $dataProductionRltn = array(
                    'd_id' => $dId,
                    'p_id'  => $pId[$i],
                    'i_id'  => $iId[$i],
                    'd_amt' => $pAmt[$i]
                );
                $dRltnId = $this->Dispatch_Model->insertDispatchRltn($dataProductionRltn);

                if($dRltnId) 
                {
                    $dTotal = $this->Dispatch_Model->DispatchAmtSum($pId[$i], $iId[$i]);

                    $dataProduct = array(
                        'd_total' => $dTotal[0]['d_total']
                    );
                    $this->Dispatch_Model->updateProductTotal($pId[$i], $dataProduct);
                }
            }
        }
    }
    
    function updateDispatch()
    {
        // POST values
        $dRelId = 2; // get Production relation id
        $dId = 1; // get Production id
//        $pId = array(1 /*new product id*/, 2/*old product id*/);
//        $iId = array(1 /*new industry id*/, 1/*old industry id*/);
//        $pAmt = array(200/*new product amount*/, 250/*old product amount*/);
        $pIdNew = 1;
        $iIdNew = 1;
        $dAmtNew = 300;
        
        $pIdOld = 2;
        $iIdOld = 1;
        //$pAmtOld = 250;
        
        $dataDispatch = array(
            'd_date' => date('Y-m-d', strtotime('4/10/2017'))
        );
        
        $dResult = $this->Dispatch_Model->updateDispatch($dId, $dataDispatch);

        if($dResult)
        {
//            for($i = 0; $i < count($pId); $i++)
//            {
                $dataDispatchRltn = array(
                    'p_id' => $pIdNew,
                    'i_id' => $iIdNew,
                    'd_amt' => $dAmtNew,

                );
                $dRltnResult = $this->Dispatch_Model->updateDispatchRltn($dRelId, $dataDispatchRltn);
                
                if($dRltnResult)
                {
                    $pTotalNew = $this->Dispatch_Model->DispatchAmtSum($pIdNew, $iIdNew);
                    $pTotalOld = $this->Dispatch_Model->DispatchAmtSum($pIdOld, $iIdOld);

                    $dataProductNew = array(
                        'd_total' => $pTotalNew[0]['d_total'],
                    );
                    $this->Dispatch_Model->updateProductTotal($pIdNew, $dataProductNew);

                    $dataProductOld = array(
                        'd_total' => $pTotalOld[0]['d_total'],
                    );
                    $this->Dispatch_Model->updateProductTotal($pIdOld, $dataProductOld);
                }
//        }
        }
    }
}