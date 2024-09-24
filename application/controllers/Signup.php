<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
		/*if($this->session->userdata('user_id') !=""){
			redirect(base_url().lcfirst($this->session->userdata('user_type')).'/dashboard');
		}*/
	}

	public function index()
	{
    $data['pageTitle']       ='Sign-up - '.PROJECT_NAME;
   	$data['page_title']      ='Sign-up - '.PROJECT_NAME;
   	$data['middle_content']  ='sign-up';

	  $this->load->view('template',$data);
	}


  /*
  Function : registartionn & sending the mail
  name:Ankit Aher
  date:6th june 2017*/
	public function register()
	{
    $firstname      = $this->input->post('firstname');
    $lastname       = $this->input->post('lastname');
    $mobile_number  = $this->input->post('mobile_number');
    $email    = $this->input->post('uemail');
    $gender   = $this->input->post('gender');
    $country  = $this->input->post('country');
    $username = $this->input->post('username');
    $password = $this->input->post('password1');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    // encryption system for password (same as joomla)
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $salt = '';
      for ($i = 0; $i < 32; $i++) {
          $salt .= $characters[rand(0, $charactersLength - 1)];
      }
    $encrypted = md5($password);
    $encrypted_password = $encrypted.':'.$salt;
    // end encryption
    
        $confirm_code = sha1(uniqid().$email);

        $arr_Data  =array(
          'firstname'           => $firstname,
          'lastname'            => $lastname,
          'email'               => $email,
          'mobile_number'       => $mobile_number,
          'gender'              => $gender,
          'countryofresidence'  => $country,
          'username'            => $username,
          'ip_address'          => $ip_address,
          'password'            => $encrypted_password,
          'verification_status' => 'Unverified',
          'status'              => 'Unblock',
          'confirm_code'        => $confirm_code,
          'created_date'        => date('Y-m-d H:m:s')
        );
        // print_r($arr_Data);exit;
        // Check User Already Exist 
        $arr_email_dump=$this->master_model->getRecords('tbl_user_master',array('email'=>trim($email), 'username' => $username));
    		if(sizeof($arr_email_dump) > 0)
    		{
    			if($arr_email_dump[0]["verification_status"] == "Unverified")
    			{
    				$arr_response['status'] = "error";
    				$arr_response['msg']    = "User already exits. your verification is pending. Please check verification mail in your email";
    				echo json_encode($arr_response);
    				exit;
    			}
    			else
    			{
    				$arr_response['status'] = "error";
    				$arr_response['msg']    = "Email Already Exits";
    				echo json_encode($arr_response);
    				exit;
    			}
    		}
            // Insert DaTa 
        if($this->master_model->insertRecord('tbl_user_master',$arr_Data)){

        	$last_inserted_id  =  $this->db->insert_id();

          // mail send
          $admin_email   	   =  $this->master_model->getRecords('admin_login', array('id'=>'1'));
          //$admin_contact_email=$email_info[0]['admin_email'];
        	$other_info        =  array(
								  "user_name"    => $email,
								  "user_email"   => $email,
								  "confirm_code" => $confirm_code,
								  "message"      =>"You Are Registered Successfully.",
  			  );
  			 
          $info_arr           = array(
  								  'from' 		=> $admin_email[0]['admin_email'],
  								  'to'		  => $email,
  								  'subject'	=> PROJECT_NAME.' - Account Creation',
  								  'view'		=> 'user-activation'
  			  );

          $send_mail = $this->email_sending->sendmail($info_arr,$other_info);
          /* Mail To  admin */
            $other_info_user=array(
                  "email"                   => $email,
                  //"subject"            => $subject,
                  //"mobile_no"          => $mobile_no,
                  "message"            => "Notification new user has done registeration successfully.",
                
          );
        
          $info_arr_user  =array(
                'from'              => $email,
                'to'                => $admin_email[0]['admin_email'],
                'subject'          => 'New Account Creation -'. PROJECT_NAME,
                'view'             => 'user-registaration'
        );
       $send_mail = $this->email_sending->sendmail($info_arr_user,$other_info_user);
    
    			if($send_mail == 'send'){

		  		  $arr_response['status'] = "success";  
			   	  $arr_response['msg']    = "Thanks for creating your ".PROJECT_NAME." account. A verification email is on its way to ".$email." Please check your email and verify your account using the link provided in the email.";
            $arr_response['URL']    = base_url().'user/dashboard';
				    echo json_encode($arr_response);
				    exit;

			    } else if($send_mail == 'not send'){

            $this->db->where('email' ,$email);
    				$this->db->delete('tbl_user_master');
		    		$arr_response['status'] = "error";
				    $arr_response['msg']    = "Network problem occured please try again";
				    echo json_encode($arr_response);
				    exit;
  			  }

        } else {

        	$arr_response['status'] = "error";
			    $arr_response['msg']    = "Problem occured please try again";
			    echo json_encode($arr_response);
			    exit;
        }
	}

	public function activate_user($confirm_code = FALSE)
  {
    if($confirm_code != "")
		{
			$arr_chk_confirmation=$this->master_model->getRecords('tbl_user_master',array('confirm_code'=>trim($confirm_code)));
			if(sizeof($arr_chk_confirmation)>0)
			{
				if($this->master_model->updateRecord('tbl_user_master',array("verification_status"=>"Verified",'confirm_code'=>NULL),array('confirm_code'=>"'".$confirm_code."'")))
				{
          $this->session->set_flashdata('success','Your account is activated successfully.');
					redirect(base_url().'thankyou');
				}
				else
				{
					$this->session->set_flashdata('error','Your account is already activated.');
					redirect(base_url().'thankyou');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Your account is already activated.');
				redirect(base_url().'thankyou');
			}
		}
		else
		{
			$this->session->set_flashdata('error','Error Occured.');
			redirect(base_url().'home');
		}
	}

  /*
  | Function : Check if username already exists or not
  | Author   : Deepak Arvind Salunke
  | Date     : 26/05/2017
  | Output   : Success or Failure
  */

  public function check_username()
  {
    $get_username = '';
    $arr_response = [];

    $username = $this->input->post('username');

    // get records with same username
    $get_username = $this->master_model->getRecords('tbl_user_master', array('username' => $username));
    if(count($get_username) > 0)
    {
      $arr_response['username_status'] = "error";
      //$arr_response['username_msg']    = "Username already exits. Please use some another Username.";
      echo json_encode($arr_response);
      exit;
    } // end if
    else
    {
      $arr_response['username_status'] = "success";
      //$arr_response['username_msg']    = "Username already exits. Please use some another Username.";
      echo json_encode($arr_response);
      exit;
    }
  } // end check_username

} //  end class
