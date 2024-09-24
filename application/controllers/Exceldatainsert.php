<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Exceldatainsert extends CI_Controller
  {

    public function __construct()
    {
      parent::__construct();
      $this->load->library('excel');//load PHPExcel library 
    	//$this->load->model('upload_model');//To Upload file in a directory
      $this->load->model('excel_data_insert_model');
    }	

    public function index()
    {
      $data['pageTitle']       = 'Upload Excel - '.PROJECT_NAME;
      $data['page_title']      = 'Upload Excel - '.PROJECT_NAME;
      $data['middle_content']  = '/upload_excel';

      $this->load->view('template',$data);
    }
  	
    public	function exceldataadd()	
    {  
      //Path of files were you want to upload on localhost (C:/xampp/htdocs/ProjectName/uploads/excel/)	 
      $configUpload['upload_path'] = base_url().'uploads/excel/';
      $configUpload['allowed_types'] = 'xls|xlsx|csv';
      $configUpload['max_size'] = '5000';
      $this->load->library('upload', $configUpload);
      $this->upload->do_upload('userfile');	
      $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
      $file_name = $upload_data['file_name']; //uploded file name
    	$extension = $upload_data['file_ext'];    // uploded file extension
    		
      //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
      $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007
      //$objReader = $this->PHPExcel_IOFactory->createReader('Excel2007');
      //Set to read only
      $objReader->setReadDataOnly(true); 		  
      //Load excel file
      $objPHPExcel=$objReader->load(base_url().'uploads/excel/'.$file_name);		 
      $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
      $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
      //loop from first data untill last data
      for($i=2;$i<=$totalrows;$i++)
      {
        $id             = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();			
        $name           = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
        $username       = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
        $email          = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
        $password       = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
        $registerDate   = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 5
        $lastvisitDate  = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(); //Excel Column 6
        $data_user      = array('id'=>$id, 'name'=>$name ,'username'=>$username ,'email'=>$email , 'password'=>$password, 'registerDate'=>$registerDate, 'lastvisitDate'=>$lastvisitDate);

        $this->excel_data_insert_model->Add_User($data_user);
      }
      unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
      redirect(base_url() . "put link were you want to redirect");
    }

    public function exceldatainsert()
      {
          $config = array(
            'upload_path'=>'uploads/excel',
            'allowed_types'=>'xls|xlsx|csv',
            'max_size'=>5120
            );

          $this->load->library('upload',$config);
          $this->upload->initialize($config);
          $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
          $file_name = $upload_data['file_name']; //uploded file name
          $extension = $upload_data['file_ext'];

          //load library excel
          $this->load->library('excel');

          //Here i used microsoft excel 2007
          $objReader= PHPExcel_IOFactory::createReader('Excel2007');

          //Set to read only
          //$objReader->setReadDataOnly(true);

          //Load excel file
          //$objPHPExcel=$objReader->load(base_url().'uploads/excel/'.$file_name);
          $objPHPExcel=$objReader->load('./application/third_party/PHPExcel/user-master.xlsx');
          $objWorksheet   = $objPHPExcel->setActiveSheetIndex(0);

          //Count Numbe of rows avalable in excel
          $totalrows      = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

          //load model
          $this->load->model('excel_data_insert_model');

          //loop from first data untill last data
          for($i=2;$i<=$totalrows;$i++)
          {
              $id             = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(); //Excel Column 0
              $name           = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(); //Excel Column 1
              $username       = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(); //Excel Column 2
              $email          = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(); //Excel Column 3
              $password       = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(); //Excel Column 4
              $registerDate   = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(); //Excel Column 5
              $lastvisitDate  = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(); //Excel Column 6
              $data_user      = array('id'=>$id, 'name'=>$name ,'username'=>$username ,'email'=>$email , 'password'=>$password, 'registerDate'=>$registerDate, 'lastvisitDate'=>$lastvisitDate);

              $this->excel_data_insert_model->Add_User($data_user);
          }
          redirect(base_url());
      }
    	
  }
?>