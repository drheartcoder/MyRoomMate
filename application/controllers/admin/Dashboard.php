<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent :: __construct();
		
		$this->session_validator->IsLogged();

	}
	public function index()
	{
		$data['page_title']='Dashboard';

		$data['middle_content']   ='dashboard';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}
	
} // End Class

