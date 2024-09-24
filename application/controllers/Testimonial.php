<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
	}

	public function testimonialdetails()
	{  
        //$cat_id = $this->uri->segment(3);

       // check if category is parent or not
        $where = array('testimonials_status' => '1', 'testimonials_front_status' => '1');
        $data['get_testimonial'] = $this->master_model->getRecords('tbl_testimonials_master', $where);
/*
        echo"<pre>";
        print_r($get_testimonial);exit;*/
        
        
        /*echo"<pre>";
        print_r($data['fetchcategory']);exit;  */

        //$data['addlisting'] = $this->master_model->getRecords('tbl_addlisting');
        
        $data['pageTitle']       = 'Testimonial Details - '.PROJECT_NAME;
        $data['page_title']      = 'Testimonial Details - '.PROJECT_NAME;
        $data['middle_content']  = 'testimonial-details.php';
        
        $this->load->view('template',$data);
	}

}
?>