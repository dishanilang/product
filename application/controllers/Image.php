<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Image extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('Image_model');
    }
    
    function index()
    {
        $this->load->view('Image');
    }
    
    function postData()
    {
        $fileArr = array();
        $config = array();
        $files = $_FILES;
        $path = FCPATH . 'Images/';
        
        $count = count($_FILES['uploadfile']['size']);
       echo '<pre>';print_r($_FILES);exit;
        //check directory and if not then give permission
        if(!is_dir($path))
        {
            mkdir($path, 0777);
        }
        
        //Configurations for image
        $config['allowed_types'] = 'gif|jpg|png';
        $config['upload_path'] = $path;
        $config['remove_spaces'] = TRUE;
        
        //load upload library for file
        $this->load->library('upload', $config);
        
        //upload multiple files
        if(count($_FILES['uploadfile']['name']) > 0 && $_FILES['uploadfile']['name'][0] != NULL) {
            //upload files in folder
            foreach ($_FILES as $key => $value) {
                for ($i = 0; $i <= $count - 1; $i++) {
    //            for($i = 0; $i < count($_FILES['uploadfile']['name']); $i++)
    //            {
                    $_FILES['uploadfile']['name'] = $value['name'][$i];
                    $_FILES['uploadfile']['type'] = $value['type'][$i];
                    $_FILES['uploadfile']['tmp_name'] = $value['tmp_name'][$i];
                    $_FILES['uploadfile']['error'] = $value['error'][$i];
                    $_FILES['uploadfile']['size'] = $value['size'][$i];

                    if($this->upload->do_upload('uploadfile'))
                    {
                        $fileArr[] = $this->upload->data();
                    }
                    else
                    {
                        echo 'error in upload image - ' . $this->upload->display_errors();
                    }
    //            }
                }
            }
        }
    }
}