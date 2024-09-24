<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advertisement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_sending');
	}
	
	public function index()
	{   

        $where =array('status'=>'1');
		$this->db->order_by('id','DESC');
		$data['adv']=$this->master_model->getRecords('tbl_advertisement',$where);
        $cnt=count($data['adv']);
         print_r($data['adv']);exit;
	    /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $cnt;
	    $config1['base_url']             = base_url() . "advertisement/index"; 
	    $config1['per_page']             = 10;
	    $config1['uri_segment']          = '3';
	    $config1['full_tag_open']        = '<div class="pagination pull-right"><ul class="pagination pagination-blog">';
	    $config1['full_tag_close']       = '</ul></div>';

	    $config1['first_link']           = '<i class="fa fa-angle-double-left" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['first_tag_open']       = '<li class="prev page">';
	    $config1['first_tag_close']      = '</li>';

	    $config1['last_link']            = '<i class="fa fa-angle-double-right" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['last_tag_open']        = '<li class="next page">';
	    $config1['last_tag_close']       = '</li>';

	    $config1['next_link']            = '<i class="fa fa-angle-right" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['next_tag_open']        = '<li class="next page">';
	    $config1['next_tag_close']       = '</li>';

	    $config1['prev_link']            = '<i class="fa fa-angle-left" style="font-size: 1.4em;"></i>';
	    $config1['prev_tag_open']        = '<li class="prev page">';
	    $config1['prev_tag_close']       = '</li>';

	    $config1['cur_tag_open']         = '<li ><a href="" class="act" style="color: rgb(242, 246, 249);background-color: #034A7B;" >';
	    $config1['cur_tag_close']        = '</a></li>';

	    $config1['num_tag_open']         = '<li class="page">';
	    $config1['num_tag_close']        = '</li>'; 
	    

	    $this->pagination->initialize($config1);
	    $page        = ($this->uri->segment(3));
	    /* end create pagination */

		$where=array('status'=>'1');
		$this->db->order_by('id','DESC');
		$data['adv']           = $this->master_model->getRecords('tbl_advertisement',$where,FALSE,FALSE,$page,$config1["per_page"]);
		echo $data['adv'];exit; 
      /*  $data['pageTitle']       = 'advertisement - '.PROJECT_NAME;
   	    $data['page_title']      = 'Blogs - '.PROJECT_NAME;*/
		$data['middle_content']  = "home";
		$this->load->view('template',$data);
	}

	
	

	
	

}