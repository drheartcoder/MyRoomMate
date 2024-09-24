<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_sending');
		
	}
	public function index()
	{
		$data['page_title']='Login';
		$this->load->view('admin/login',$data);
	}
	public function doValidate()
	{
		$this->form_validation->set_rules('_userName', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('_passWord', 'Email', 'trim|required|xss_clean');
		if($this->form_validation->run())
		{
			$_userName   = 	$this->input->post('_userName',TRUE);
			$_passWord   = 	$this->input->post('_passWord',TRUE);
			$selectParam =  array('admin_username,admin_password');
			$input_array =  array('admin_username'=>$_userName,'admin_password'=>$_passWord);
			
			$user_info   =  $this->master_model->getRecords('admin_login',$input_array);

            
			if(count($user_info))
			{ 
				$mysqltime  =   date("H:i:s");
				$user_data  =   array(

					               'admin_username'  =>$user_info[0]['admin_username'],
					               'admin_id'        =>$user_info[0]['id'],
					               'admin_email'     =>$user_info[0]['admin_email']);
			
				$this->session->set_userdata($user_data);
				$jArray=array('_status'=>'true','msgString'=>'');
			}
			else {

				  $jArray=array('_status'=>'error','msgString'=>'Invalid username or password.');
			    }
		    	echo json_encode($jArray);
		}
		else
		{
			$_errorString = $this->form_validation->error_string();
			$jArray=array('_status'=>'error','msgString'=>$_errorString);
			echo json_encode($jArray);
		}
	}
	
	public function recover_password()
	{
		$this->form_validation->set_rules('_txtEmail','Email','required|valid_email|xss_clean');
		if($this->form_validation->run())
		{
			$admin_email=$this->input->post('_txtEmail',true);
			$result=$this->master_model->getRecordCount('admin_login',array('admin_email'=>$admin_email));
			if($result)
			{
				$whr=array('id'=>'1');
				$info_mail=$this->master_model->getRecords('admin_login',$whr,'*');
				$info_arr=array('from'=>$info_mail[0]['admin_email'],'to'=>$admin_email,'subject'=>'Password Recovery','view'=>'admin-forgot-password');
				$other_info=array('username'=>$info_mail[0]['admin_username'],'password'=>$info_mail[0]['admin_password']);
				if($this->email_sending->sendmail($info_arr,$other_info))
				{
					$jArray=array('_status'=>'done','msgString'=>'');
					echo json_encode($jArray);
				}
				else
				{
					$_errorString ='Unable to send email.<br> Please try after sometime.';
					$jArray=array('_status'=>'error','msgString'=>$_errorString);
					echo json_encode($jArray);
				}
			}
			else
			{
				$jArray=array('_status'=>'error','msgString'=>'Email not found.');
				echo json_encode($jArray);
			}
		}
		else
		{
			$_errorString = $this->form_validation->error_string();
			$jArray=array('_status'=>'error','msgString'=>$_errorString);
			echo json_encode($jArray);
		}
	}
	public function logout()
	{ 
		$user_data=array('admin_username'=>'',
		             	 'admin_id'=>'',
			             'admin_email'=>'');
	
		$this->session->set_userdata($user_data);
		redirect(base_url(ADMIN_PANEL_NAME));
	}


} // end of class