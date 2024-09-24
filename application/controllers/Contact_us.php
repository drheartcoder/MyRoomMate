<?php if(!defined('BASEPATH')) exit('No Direct Script Access Allow');
ob_start();
class Contact_us extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$data['page_title']       ='Contact us - '.PROJECT_NAME;
		$data['pageTitle']        ='Contact us - '.PROJECT_NAME;
		$data['middle_content']   ='contact_us/contact-us';
		$this->load->view('template',$data);
	}
	public function submit_enquiry() 
	{ //echo'hh';exit;
		$name 	                = $this->input->post('contactname',TRUE);
		$email                  = $this->input->post('contactemail',TRUE);
		//$subject                = $this->input->post('sub',TRUE);
		//$mobile_no              = $this->input->post('mobile',TRUE);
		$message                = $this->input->post('contactdescription',TRUE);
	

		$arr_data['name'] 		        = $name;
		$arr_data['email'] 		        = $email;
		//$arr_data['subject'] 	        = $subject;
		//$arr_data['mobile_no'] 	        = $mobile_no;
		$arr_data['message'] 	        = $message;
		$arr_data['date_time'] 	        = date('Y-m-d H:m:s');

		if($this->master_model->insertRecord('tbl_contact_us',$arr_data))
		{
            $this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{
				/* Mail To  Admin */
				$admin_contact_email=$email_info[0]['admin_email'];
				$other_info =array(
				  				"name"               => $name,
				  				"email"              => $email,
				  				//"subject"            => $subject,
				  				//"mobile_no"          => $mobile_no,
				  				"message"            => $message,

	  			);
	  		
	  			$info_arr   =array(
						        'from'    		     => $email,
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'New Contact Enquiry Mail - '.PROJECT_NAME,
						        'view'		         => 'contactus-mail-to-admin'
				);

	  			$this->email_sending->sendmail($info_arr,$other_info);

	  			/* Mail To  User */
		  	    $other_info_user=array(
				  				"name"               => $name,
				  				"email"              => $email,
				  				//"subject"            => $subject,
				  				//"mobile_no"          => $mobile_no,
				  				"message"            => $message,
				  			
	  			);
	  		
	  			$info_arr_user  =array(
								'from' 		         => $admin_contact_email,
								'to'		         => $email,
								'subject'	         => 'Contact Enquiry Mail -'. PROJECT_NAME,
								'view'		         => 'contactus-mail-to-user'
				);
				$this->email_sending->sendmail($info_arr_user,$other_info_user);
			}

			//$arr_response['status'] = "success";
			//$arr_response['msg']    = " Your Contact Enquiry Send Successfully";
			//echo json_encode($arr_response);
			//exit;
			if($arr_response['status'] = "success") 
	            		{
							$this->session->set_flashdata('success',"Your Contact Enquiry Send Successfully!");
                            redirect(base_url().'contact_us/index/'.$this->uri->segment(3));	
						}		
		}
		else
		{
			$arr_response['status'] = "error";
			$arr_response['msg']    = "Problem Occured While  Sending Your Request, Please Try Again";
			echo json_encode($arr_response);
			exit;		
		}
	}



	
} // end Class