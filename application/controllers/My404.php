<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allow');

class My404 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
			
	}

	public function index()
	{
		$data['page_title']       ='404 Page Not Found';
		$data['middle_content']   ='my404';
		$this->load->view('template',$data);
	}
}