<?php if( !defined('BASEPATH')) exit('No direct script access allowed');

class Session_validator extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
    public function IsLogged()
    {
    	if($this->session->userdata('admin_username')=='' || $this->session->userdata('admin_id')=='')
		{
			$this->session->set_flashdata('error' , 'You need to login first..');
			/*$this->session->sess_destroy();*/
			redirect(base_url().ADMIN_PANEL_NAME."login");
		}
		
    }

}
?>