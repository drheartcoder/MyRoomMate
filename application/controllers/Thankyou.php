<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allow');

class Thankyou extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
			
	}

	public function index()
	{
		$data['page_title']       ='Thank You';
		$data['middle_content']   ='thankyou';
		$this->load->view('template',$data);
	}
}