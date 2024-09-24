<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('email_sending');

		/*if($this->session->userdata('user_id') !=""){
			redirect(base_url().lcfirst($this->session->userdata('user_type')).'/dashboard');
		}*/
	}

	public function index() 
	{	
        $data['pageTitle']       ='Login - '.PROJECT_NAME;
   	    $data['page_title']      ='Login - '.PROJECT_NAME;
   	    $data['middle_content']  ='login';
	    $this->load->view('template',$data);
	}

	public function login() 
	{
		$username			= $this->input->post('username');
		$email 				= $this->input->post('uemail');
		$pass 				= $this->input->post('password');
		$url 				= $this->input->post('url');
		$page_url_segment 	= $this->input->post('page_url_segment');

		// encryption system for password (same as joomla)
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	      $charactersLength = strlen($characters);
	      $salt = '';
	      for ($i = 0; $i < 32; $i++) {
	          $salt .= $characters[rand(0, $charactersLength - 1)];
	      }
	    $encrypted = md5($pass);
	    $encrypted_password = $encrypted.':'.$salt;

		/*$password_parts   	= explode( ':', $pass);
		$main_password    	= $password_parts[0];
		$salt   			= $password_parts[1];*/
		
		$arr_user_check = $this->master_model->getRecords('tbl_user_master',array('username'=>trim($username)));

		if(sizeof($arr_user_check)>0)
		{
			$get_password = explode( ':',$arr_user_check[0]['password']);
			$get_main_password = $get_password[0];

			if($get_main_password == $encrypted)
			{
				if($arr_user_check[0]['status'] == "Unblock")
				{
					if($arr_user_check[0]['verification_status'] == "Verified")
					{
					    $user_data = array(
		                   'user_id'        			=> $arr_user_check[0]['id'],
		                   'user_firstname' 			=> $arr_user_check[0]['firstname'],
		                   'user_lastname'  			=> $arr_user_check[0]['lastname'],
		                   'user_username'  			=> $arr_user_check[0]['username'],
		                   'user_gender'    			=> $arr_user_check[0]['gender'],
		                   'user_email'     			=> $arr_user_check[0]['email'],
		                   'user_age'       			=> $arr_user_check[0]['age'],
		                   'user_mobile_number' 		=> $arr_user_check[0]['mobile_number'],
		                   'user_nationality'   		=> $arr_user_check[0]['nationality'],
		                   'user_countryofresidence'    => $arr_user_check[0]['countryofresidence'],
		                   'user_address'     			=> $arr_user_check[0]['address'],
			            );

						$this->session->set_userdata($user_data);

						// check current page and redirect user to current page or user dashboard page during login
						// check user data is completed or not
						if($page_url_segment == 'home' || $page_url_segment == "")
						{
						    if($arr_user_check[0]['firstname'] == "" || $arr_user_check[0]['lastname'] == "" || $arr_user_check[0]['username'] == "" || $arr_user_check[0]['gender'] == "" || $arr_user_check[0]['email'] == "" || $arr_user_check[0]['age'] == "" || $arr_user_check[0]['mobile_number'] == "" || $arr_user_check[0]['nationality'] == "" || $arr_user_check[0]['countryofresidence'] == "" || $arr_user_check[0]['address'] == "")
							{
								$page_url = base_url().'user/dashboard';
							}
							else
							{
								$page_url = base_url().'user/addlisting';
							}
						}
						// redirect user to current page during login
						else
						{
						    $page_url   = $url;
						}

						$arr_response['status'] 	= "LoginSuccess";
						$arr_response['msg'] 		= "Login successfull";
						$arr_response['URL'] 		= $page_url;
						echo json_encode($arr_response);
						exit;
					}
					else 
					{
						$arr_response['status'] = "UnverifyUser";
						$arr_response['msg']    = "Please verify your account first";
						echo json_encode($arr_response);
						exit;
					}
				}
				else 
				{
					$arr_response['status'] = "BlockUser";
					$arr_response['msg']    = "You are blocked by admin";
					echo json_encode($arr_response);
					exit;
				}
			}
			else
			{
				$arr_response['status'] = "Error";
				$arr_response['msg']    = "Sorry, your using wrong password";
				echo json_encode($arr_response);
				exit;
			}
		}
		else
		{
			$arr_response['status'] = "notFound";
			$arr_response['msg']    = "User not found.";
			echo json_encode($arr_response);
			exit;
		}
    }

    public function googleLogin()
	{
		$email = $this->input->post('email');

		$userdata = array('user_type'=>$email);
	    $this->session->set_userdata($userdata);
	    $arr_response['status'] 	= "LoginSuccess";
		//$arr_response['msg'] 		= "Login successfull";
		//$arr_response['URL'] 		= $page_url;
		

		echo str_replace ( '\/', '/', json_encode ( $userdata ) );
	    exit ();
	}

	public function forgot_password() {
		
		if(isset($_POST['email'])) {
			
			$user_email = $this->input->post('email',true);
			
			$arr_user   = $this->master_model->getRecords('tbl_user_master',array('email'=>trim($user_email)));
			if(sizeof($arr_user) <= 0)
			{
				$arr_response['status'] = "error";
				$arr_response['msg']    = "User does not exits.";
				echo json_encode($arr_response);
				exit;
			}
			if($arr_user[0]["verification_status"] == "Verified")
			{
				$confirm_code = sha1(uniqid().$arr_user[0]['email']);
				$user_id      = $arr_user[0]['id'];
				$this->master_model->updateRecord('tbl_user_master',array('confirm_code'=>$confirm_code),array('id'=>$user_id));

				$admin_data=$this->master_model->getRecords('admin_login', array('id'=>'1'));
				
				    $other_info =array(
			  				           "user_name"    => $arr_user[0]['firstname'],
			  				           "user_email"   => $user_email,
			  				           'confirm_code' => $confirm_code
		  			);
		  		
		  			$info_arr  = array(
							           'from' 	      => $admin_data[0]['admin_email'],
							           'to'		      => $user_email,
							           'subject'      => PROJECT_NAME.' - Password Reset',
							           'view'	      => 'forgot-password-mail-to-user'
					);

	  				$this->email_sending->sendmail($info_arr,$other_info);

					$arr_response['status'] = "success";
					$arr_response['msg']    = "Password recovery mail sent to your email successfully.";
					$arr_response['URL']    = base_url().'home';
					echo json_encode($arr_response);
					exit;
			}
			else
			{
				
				$arr_response['status'] = "error";
				$arr_response['msg']    = "Your account verification is pending. please check your email to verify your account.";
				echo json_encode($arr_response);
				exit;
			}
			
		}

	}


	public function reset_password($confirm_code=FALSE) {



		if(isset($_POST['newpwd']))
		{

			$new_password = $this->input->post('newpwd',true);
			$conf_code    = $this->input->post('confirm_code',true);

			// encryption system for password (same as joomla)
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $salt = '';
		    for ($i = 0; $i < 32; $i++) {
		        $salt .= $characters[rand(0, $charactersLength - 1)];
		    }
		    $encrypted = md5($new_password);
		    $encrypted_password = $encrypted.':'.$salt;
		    // end encryption
		
			$this->master_model->updateRecord('tbl_user_master',array("password"=>$encrypted_password,'confirm_code'=>NULL),array('confirm_code'=>"'".$conf_code."'"));

			$arr_response['status'] = "success";
			$arr_response['msg']    = "Password change successfully.";
			$arr_response['URL']    = base_url().'home';
			echo json_encode($arr_response);
			exit;
		}

        
        $conf_code = trim($confirm_code);
        if(!empty($conf_code))
		{
			$arr_confcode_check = $this->master_model->getRecords('tbl_user_master',array('confirm_code'=>trim($conf_code)));
			if(sizeof($arr_confcode_check) <= 0)
			{
                $this->session->set_flashdata('Error' ,'Reset password link expire');
				redirect(base_url().'home');
			}
			else
			{
				$db_conf_code = $arr_confcode_check[0]['confirm_code'];
				if($conf_code != $db_conf_code)
				{
					$this->session->set_flashdata('Error' ,'Reset password link expire');
				    redirect(base_url().'home');
				}
				else
				{
					$data['conf_code'] = $db_conf_code;
					$data['pageTitle']       ='Reset Password - '.PROJECT_NAME;
			   	    $data['page_title']      ='Reset Password - '.PROJECT_NAME;
			   	    $data['middle_content']  ='reset-password';
				    $this->load->view('template',$data);
				}
			}
		}
		else {
			
			$this->session->set_flashdata('error' ,'Reset password link expire');
			redirect(base_url().'home');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success' , 'Logout successfully');
		redirect(base_url().'home');
	}

} //  end class
