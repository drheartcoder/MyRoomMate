<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('email_sending');

	}
	public function dashboard()
	{
		$this->master_model->IsLogged();
		
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        $data['pageTitle']       = 'Seller dashboard - '.PROJECT_NAME;
   	    $data['page_title']      = 'Seller dashboard - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/dashboard';
	    $this->load->view('template',$data);
	}
	public function edit()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }

        $data['pageTitle']       = 'Edit Profile - '.PROJECT_NAME;
   	    $data['page_title']      = 'Edit Profile - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/edit-profile';
	    $this->load->view('template',$data);
	}
	public function get_profile()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        $get_profile_data              = $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id')));
		$arr_response['status']        = "success";
        $arr_response['profile_data']  = isset($get_profile_data[0])?$get_profile_data[0]:[];
       	echo json_encode($arr_response);
		exit;
	}
	public function update()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        $logo_name = NULL;
        $arr_get_user = $this->master_model->getRecords('tbl_user_master',array('id' => $this->session->userdata('user_id')));
		if(isset($_FILES['user_image']))
		{
			$logo_name = $_FILES['user_image']['name'];
			if($arr_get_user[0]["user_image"] != $logo_name)
			{
				$this->load->library('upload');

				$config['upload_path']   = "images/seller_image/";
				$config['allowed_types'] = 'gif|jpg|png'; //'*';//;
				
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload("user_image"))
				{
					echo $this->upload->display_errors();
					$error = array('error' => $this->upload->display_errors());
					exit;
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					$logo_name = $data["upload_data"]["file_name"];
					$uploaddir = 'images/seller_image/';
					if (file_exists($uploaddir.$arr_get_user[0]["user_image"]) && $arr_get_user[0]["user_image"]!='') {
					    unlink($uploaddir.$arr_get_user[0]["user_image"]);
					}
				}
			}
		}
		else
		{
				$logo_name = $arr_get_user[0]["user_image"];
		}
      
        $name                              = $this->input->post('name');
        $email                             = $this->input->post('email');
        $user_image                        = $logo_name;
        $optional_email                    = $this->input->post('optional_email');
        $mobile_number                     = $this->input->post('mobile_number');
        $gender                            = $this->input->post('gender');
        $day                               = $this->input->post('day');
        $month                             = $this->input->post('month');
        $year                              = $this->input->post('year');
        $pincode                           = $this->input->post('pincode');
        $com_national_registration_number  = $this->input->post('com_national_registration_number');
        $address                           = $this->input->post('address');
        $city                              = $this->input->post('city');
        $state                             = $this->input->post('state');
        $country                           = $this->input->post('country');
        $company_website                   = $this->input->post('company_website');
        $company_description               = $this->input->post('company_description');
        $arr_Data  =array(

                    'name'                              => $name,
                    'email'                             => $email,
                    'user_image'                        => $user_image,
                    'optional_email'                    => $optional_email,
                    'mobile_number'                     => $mobile_number,
                    'day'                               => $day,
                    'month'                             => $month,
                    'year'                              => $year,
                    'gender'                            => $gender,
                    'pincode'                           => $pincode,
                    'com_national_registration_number'  => $com_national_registration_number,
                    'address'                           => $address,
                    'city'                              => $city,
                    'state'                             => $state,
                    'country'                           => $country,
                    'update_date'                       => date('Y-m-d h:m:s'),
                    'company_website'                   => $company_website,
                    'company_description'               => $company_description,
        );
        $this->db->where('id' , $this->session->userdata('user_id'));
        if($this->db->update('tbl_user_master',$arr_Data)){

            $user_data = array(
                   'user_name'      => $name,
                   'user_state'     => $state,
                   'user_city'      => $city,
                   'user_country'   => $country,
                   'user_address'   => $address,
                   'user_mobile'    => $mobile_number,
                   'user_image'     => $logo_name
            );
			$this->session->set_userdata($user_data);
        	if(isset($_FILES['user_image']))
		    {
		    	$arr_response['status'] = "success_with_reload";
		    }
		    else {
		    	$arr_response['status'] = "success";
		    }
	        $arr_response['msg']    = "Profile data updated successfully.";
	       	echo json_encode($arr_response);
			exit;
        } else {
        	$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
        }
	}
	public function change_password()
	{
        $this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
	    if(isset($_POST['oldpwd'])){

	        	$newpassword      = $this->input->post('newpwd');
	        	$oldpassword      = $this->input->post('oldpwd');


                $check_old_pass_is_correct = $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id') ,'password' => sha1($oldpassword)));

                if(sizeof($check_old_pass_is_correct) <= 0){

	        		$arr_response['status'] = "error";
			        $arr_response['msg']    = "Sorry , your old password does not match.";
			       	echo json_encode($arr_response);
					exit;
	        	}

	        	$get_current_pass =     $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id') ,'password' => sha1($newpassword)));

	        	if(sizeof($get_current_pass) > 0){

	        		$arr_response['status'] = "error";
			        $arr_response['msg']    = "Sorry , Please do not enter old password as current password.";
			       	echo json_encode($arr_response);
					exit;
	        	}

	            $arr_Data = array(

	                        'password'  => sha1($newpassword)
	        );
        	$this->db->where('id' , $this->session->userdata('user_id'));
            if($this->db->update('tbl_user_master',$arr_Data)){

                $arr_response['status'] = "success";
            	$arr_response['msg']    = "Password updated successfully.";
		       	echo json_encode($arr_response);
				exit;
            } 
            else {
	        	$arr_response['status'] = "error";
		        $arr_response['msg']    = "Something was wrong,Please try again.";
		       	echo json_encode($arr_response);
				exit;
            }
        }

		$data['pageTitle']       = 'Change Password - '.PROJECT_NAME;
   	    $data['page_title']      = 'Change Password - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/change-password';
	    $this->load->view('template',$data);
	}
	public function post_offer()
	{
        $this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['title'])) {

        	$this->load->model('callerservice');
            

			$this->db->where('pricing_name'  , 'Offer post');
			$this->db->where('membership_id' , 4);
			$get_pay_amt = $this->master_model->getRecords('tbl_pricing_master');

			if(isset($get_pay_amt[0]['membership_price'])){ $get_pay_amt[0]['membership_price']= $get_pay_amt[0]['membership_price'];} else{ $get_pay_amt[0]['membership_price'] = 0; }


        	if(isset($_POST['btn_cc_pay']))
			{
				$creditCardType 	= ($this->input->post('card_type',true));
				$creditCardNumber 	= ($this->input->post('cc_number',true));
				$creditCardNumber 	= str_replace(' ', '', $creditCardNumber);
				$cc_exp 			= $this->input->post('cc_exp',true);
				$cvv2Number 		= $this->input->post('cc_cvc',true);
				$cc_exp_arr 		= explode('/', $cc_exp);
				$currencyCode 		= currencyCode;
				$transaction_amt 	= $get_pay_amt[0]['membership_price'];
						
				$nvpstr="&PAYMENTACTION=Sale&AMT=$transaction_amt&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".trim($cc_exp_arr[0]).trim($cc_exp_arr[1])."&CVV2=$cvv2Number&CURRENCYCODE=$currencyCode";

				$resArray=$this->callerservice->hash_call("doDirectPayment",$nvpstr);
			
				if($resArray['ACK']=="Success")
				{
				
					$logo_name ="";
		        	if(isset($_FILES['req_image']))
					{
						$logo_name = $_FILES['req_image']['name'];
						$this->load->library('upload');
						$config['upload_path']   = "images/seller_post_offer_image/";
						$config['allowed_types'] = 'gif|jpg|png'; //'*';//;
						
						$this->upload->initialize($config);

						if ( ! $this->upload->do_upload("req_image"))
						{
							echo $this->upload->display_errors();
							$error = array('error' => $this->upload->display_errors());

							$arr_response['status'] = "error";
				        	$arr_response['msg']    = "Please give permition to upload folder.";
					       	echo json_encode($arr_response);
							exit;
						}
						else
						{
							$data      = array('upload_data' => $this->upload->data());
							$logo_name = $data["upload_data"]["file_name"];
							$uploaddir = 'images/seller_post_offer_image/';
							
						}
					}
					else
					{
						$arr_response['status'] = "error";
			        	$arr_response['msg']    = "Please select offer image.";
				       	echo json_encode($arr_response);
						exit;
					}

					$req_title         = $this->input->post('title');
					$req_subcat        = $this->input->post('subcategory_id');
					$qty               = $this->input->post('qty');
					$req_address       = $this->input->post('location');
					$req_desc          = $this->input->post('description');
					$image             = $logo_name;
					/*Category*/
					$this->db->where('subcategory_status' , '1');
					$this->db->where('is_delete' , '0');
					$this->db->where('subcategory_id' , $req_subcat);
					$getCategory = $this->master_model->getRecords('tbl_subcategory_master');
			        /**/

					$arr_req  = array(
						'seller_id'         => $this->session->userdata('user_id'),
						'category_id'      => $getCategory[0]['category_id'],
						'subcategory_id'   => $req_subcat,
						'title'            => $req_title, 
						'qty'              => $qty, 
						'description'      => $req_desc, 
						'req_image'        => $image,
						'location'         => $req_address,
						'created_date'     => date('Y-m-d h:m:s'),
						'status'           => 'Unblock'
				    );
				    $this->db->insert('tbl_seller_products_offers' , $arr_req);
				    $offer_id = $this->db->insert_id();
				    
					$transaction_arr = array('transaction_id'   => $resArray['TRANSACTIONID'],
											 'seller_id'	    => $this->session->userdata('user_id'),
											 'offer_id'		    => $offer_id,
											 'transaction_price'=> $resArray['AMT'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_seller_offer_transaction',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment and offer post successfully done.");
						redirect(base_url().'seller/post_offer');
		                exit;
					}
				}
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		           redirect(base_url().'seller/post_offer');
		           exit;
				}
			}

			if(isset($_POST['btn_pay']))
			{

				$currencyCode    = currencyCode;
				$final_price     = $get_pay_amt[0]['membership_price'];
				$offer_title 	 = $this->input->post('title');
				$returnUrl       = base_url().'seller/paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'seller/post_offer';
				$nvpstr          =""; 
				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";
				$resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			}
			if(isset($resArray["ACK"]))
	    	{
	    		$ack = strtoupper($resArray["ACK"]);
		    	if($ack=="SUCCESS")
		    	{

                    /* set session */
		    		$this->session->set_userdata($_POST);
		    		$logo_name ="";
		        	if(isset($_FILES['req_image']))
					{
						$logo_name = $_FILES['req_image']['name'];
						
						$this->load->library('upload');

						$config['upload_path']   = "images/seller_post_offer_image/";
						$config['allowed_types'] = 'gif|jpg|png'; //'*';//;
						
						$this->upload->initialize($config);

						if ( ! $this->upload->do_upload("req_image"))
						{
							echo $this->upload->display_errors();
							$error = array('error' => $this->upload->display_errors());

							$arr_response['status'] = "error";
				        	$arr_response['msg']    = "Please give permition to upload folder.";
					       	echo json_encode($arr_response);
							exit;
						}
						else
						{
							$data      = array('upload_data' => $this->upload->data());
							$logo_name = $data["upload_data"]["file_name"];
							$uploaddir = 'images/seller_post_offer_image/';
						}
					}
					else
					{
						$arr_response['status'] = "error";
			        	$arr_response['msg']    = "Please select offer image.";
				       	echo json_encode($arr_response);
						exit;
					}
					$this->session->set_userdata(array('logo_name' => $logo_name));
					/* set session */

		     		$token = urldecode($resArray["TOKEN"]);
		   	    	$payPalURL = PAYPAL_URL.$token;
		   	    	redirect($payPalURL);
		    	}
		    	else
		    	{
		    		$errorType=$resArray["L_LONGMESSAGE0"];
		    		$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		            redirect(base_url().'seller/post_offer');
		            exit;
				}
		    }
        }

		$data['pageTitle']       = 'Post Offer - '.PROJECT_NAME;
   	    $data['page_title']      = 'Post Offer - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-post-offer';

        
        $this->db->where('subcategory_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getSubcat'] = $this->master_model->getRecords('tbl_subcategory_master');


        $this->db->where('tbl_category_master.category_status' , '1');
        $this->db->where('tbl_category_master.is_delete' , '0');
        $this->db->where('subcategory_status' , '1');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->group_by('tbl_category_master.category_id');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.category_id=tbl_category_master.category_id');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');


	    $this->load->view('template',$data);
	}
	public function paypal_success()
	{
		
		$this->load->model('callerservice');
        $this->db->where('pricing_name'  , 'Offer post');
        $this->db->where('membership_id' , 4);
        $get_pay_amt = $this->master_model->getRecords('tbl_pricing_master');

        if(isset($get_pay_amt[0]['membership_price'])){ $get_pay_amt[0]['membership_price']= $get_pay_amt[0]['membership_price'];} else{ $get_pay_amt[0]['membership_price'] = 0; }
	
		$transaction_amt  = $get_pay_amt[0]['membership_price'];
		$currencyCode     = currencyCode;
		$returnUrl        = base_url().'seller/post_offer';
		$cancelUrl        = base_url().'seller/post_offer';
		$nvpstr           = "";



		$nvpstr.="&PAYMENTREQUEST_0_AMT=".$transaction_amt."&PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&TOKEN=".$_GET['token'].'&PAYERID='.$_GET['PayerID'];
		$resArray=$this->callerservice->hash_call('DoExpressCheckoutPayment',$nvpstr);

		if($resArray['ACK']=="Success")
		{
            
           
			$req_title         = $this->session->userdata('title');
			$req_subcat        = $this->session->userdata('subcategory_id');
			$qty               = $this->session->userdata('qty');
			$req_address       = $this->session->userdata('location');
			$req_desc          = $this->session->userdata('description');
			$image             = $this->session->userdata('logo_name');
			/*Category*/
			$this->db->where('subcategory_status' , '1');
			$this->db->where('is_delete' , '0');
			$this->db->where('subcategory_id' , $req_subcat);
			$getCategory = $this->master_model->getRecords('tbl_subcategory_master');
		
	        /**/

			$arr_req  = array(
				'seller_id'        => $this->session->userdata('user_id'),
				'category_id'      => $getCategory[0]['category_id'],
				'subcategory_id'   => $req_subcat,
				'title'            => $req_title, 
				'qty'              => $qty, 
				'description'      => $req_desc, 
				'req_image'        => $image,
				'location'         => $req_address,
				'created_date'     => date('Y-m-d h:m:s'),
				'status'           => 'Unblock'
		    );
		    $this->db->insert('tbl_seller_products_offers' , $arr_req);
		    $offer_id = $this->db->insert_id();

		    
			$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
									 'seller_id'	    => $this->session->userdata('user_id'),
									 'offer_id'		    => $offer_id,
									 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
									 'payment_status'	=> 'complete',
									 'payment_date'		=> date('Y-m-d H:i:s'),
									 'pament_type'		=> 'credit_card');
			if($this->master_model->insertRecord('tbl_seller_offer_transaction',$transaction_arr))
			{
				$this->session->set_flashdata('success',"Your payment and offer post successfully done.");
				redirect(base_url().'seller/post_offer');
                exit;
			}
		}
		else if($resArray['ACK']=="Failure")
		{
		   unlink('images/seller_post_offer_image/'.$this->session->userdata('logo_name'));
		   $this->session->unset_userdata($_POST);
		   $this->session->unset_userdata('logo_name');
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'seller/post_offer');
           exit;
		}
	}
	public function offers()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Posted offers - '.PROJECT_NAME;
   	    $data['page_title']      = 'Posted offers - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-posted-offers';


        $this->db->where('tbl_seller_products_offers.seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_seller_products_offers.status' , 'Unblock');
        $this->db->where('tbl_seller_products_offers.status <>' , 'Delete');
        $this->db->where('tbl_seller_products_offers.offer_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_products_offers.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getOffers']  = $this->master_model->getRecords('tbl_seller_products_offers');
        $Count = count($data['getOffers']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']          = $Count;
	    $config1['base_url']            = base_url().'seller/offers';
	    $config1['per_page']            = 2;
	    $config1['uri_segment']         = '3';
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

        $this->db->where('tbl_seller_products_offers.seller_id' , $this->session->userdata('user_id'));
        $this->db->order_by('tbl_seller_products_offers.id' , 'Desc');
        $this->db->where('tbl_seller_products_offers.status' , 'Unblock');
        $this->db->where('tbl_seller_products_offers.status <>' , 'Delete');
        $this->db->where('tbl_seller_products_offers.offer_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_products_offers.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getOffers'] = $this->master_model->getRecords('tbl_seller_products_offers',FALSE,FALSE,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}
	public function offer_detail($req_id=FALSE)
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Offer detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Offer detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-post-offer-details';

        $this->db->where('tbl_seller_products_offers.seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_seller_products_offers.id' , $req_id);
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_products_offers.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getOfferDetail']  = $this->master_model->getRecords('tbl_seller_products_offers');
        $Count = count($data['getOfferDetail']);


        /* offered buyers */ 

        $this->db->where('tbl_apply_for_offers.offer_id' ,  $req_id);
        $this->db->where('tbl_apply_for_offers.status'   , 'Unblock');
        $this->db->where('tbl_apply_for_offers.status !=', 'Accepted');
        $this->db->order_by('tbl_apply_for_offers.id'    , 'desc');
        $this->db->where('tbl_user_master.status'        , 'Unblock');
        $select = '
                   tbl_apply_for_offers.*,
                   tbl_user_master.user_image,
                   tbl_user_master.name,
                   tbl_user_master.email,
                   tbl_user_master.city,
                   tbl_user_master.country,
                   tbl_user_master.state
        ';
        $this->db->join('tbl_user_master' , 'tbl_user_master.id=tbl_apply_for_offers.offered_buyer_id');
        $data['offered_buyers'] = $this->master_model->getRecords('tbl_apply_for_offers',FALSE,$select);
        /* end offered buyers */ 



	    $this->load->view('template',$data);
	}
    public function sent_offers()
	{
    	$data['pageTitle']       = 'Sent Offers - '.PROJECT_NAME;
   	    $data['page_title']      = 'Sent Offers - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-sent-offers';


        $this->db->order_by('tbl_buyer_post_requirement.id' , 'Desc');
        $this->db->group_by('tbl_buyer_post_requirement.id');
        $this->db->order_by('tbl_apply_for_requirment.offered_seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_apply_for_requirment.offered_seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');

        $select = '
                  tbl_subcategory_master.*,
                  tbl_category_master.*,
                  tbl_apply_for_requirment.offered_seller_id,
                  (tbl_apply_for_requirment.id) as offer_id,
                  tbl_buyer_post_requirement.*
        ';

        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $this->db->join('tbl_apply_for_requirment' , 'tbl_apply_for_requirment.requirment_id = tbl_buyer_post_requirement.id');
        $data['sent_offers']  = $this->master_model->getRecords('tbl_buyer_post_requirement',FALSE,$select);
        $Count = count($data['sent_offers']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']          = $Count;
	    $config1['base_url']            = base_url().'seller/sent_offers';
	    $config1['per_page']            = 2;
	    $config1['uri_segment']         = '3';
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

        $this->db->order_by('tbl_buyer_post_requirement.id' , 'Desc');
        $this->db->group_by('tbl_buyer_post_requirement.id');
        $this->db->order_by('tbl_apply_for_requirment.offered_seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_apply_for_requirment.offered_seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $select = '
                  tbl_subcategory_master.*,
                  tbl_category_master.*,
                  tbl_apply_for_requirment.offered_seller_id,
                  (tbl_apply_for_requirment.id) as offer_id,
                  tbl_buyer_post_requirement.*
        ';
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $this->db->join('tbl_apply_for_requirment' , 'tbl_apply_for_requirment.requirment_id = tbl_buyer_post_requirement.id');
        $data['sent_offers'] = $this->master_model->getRecords('tbl_buyer_post_requirement',FALSE,$select,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}
	public function sent_offer_detail($req_id=FALSE)
	{
    	$data['pageTitle']       = 'Sent Offers detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Sent Offers detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-sent-offer-details';

        $this->db->where('tbl_buyer_post_requirement.id' , $req_id);
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['Sent_offer_detail']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['Sent_offer_detail']);


        /* offered sellers */ 

        $this->db->where('tbl_apply_for_requirment.requirment_id' , $req_id);
        $this->db->where('tbl_apply_for_requirment.offered_seller_id' , $this->session->userdata('user_id'));
        $this->db->order_by('tbl_apply_for_requirment.id' ,  'desc');
        $select = '
                   tbl_apply_for_requirment.*,
                   tbl_user_master.user_image,
                   tbl_user_master.name,
                   tbl_user_master.email,
                   tbl_user_master.city,
                   tbl_user_master.country,
                   tbl_user_master.state
        ';
        $this->db->join('tbl_user_master' , 'tbl_user_master.id=tbl_apply_for_requirment.offered_seller_id');
        $data['offered_sellers'] = $this->master_model->getRecords('tbl_apply_for_requirment',FALSE,$select);
        /* end offered sellers */ 
	    $this->load->view('template',$data);
	}
	public function offer_payment_history()/*----------T.A.. */
	{
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url().'login');
		}
        $day="";
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
       	$this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=',date('Y-m-d', strtotime('-'.$day.' days')));	
        }

        $select             ='  tbl_seller_products_offers.seller_id,
						        tbl_seller_products_offers.title,
						        tbl_seller_products_offers.qty,
						        tbl_seller_products_offers.description,
						        tbl_seller_products_offers.req_image,
						        tbl_seller_products_offers.location,
						        tbl_seller_products_offers.	created_date,
						        tbl_seller_products_offers.*,
						        tbl_seller_products_offers.*,
                                tbl_seller_offer_transaction.*
                             ';
	    $this->db->join('tbl_seller_products_offers' , 'tbl_seller_offer_transaction.offer_id=tbl_seller_products_offers.id');
	    $this->db->where('tbl_seller_products_offers.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_offer_transaction.id', 'desc');

		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_offer_transaction',FALSE,$select);
        $Count=count($getPaymentHistory['getPaymentHistory']);

        
         

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config['first_url'] = $_SERVER['QUERY_STRING']!="" ? base_url('seller/offer_payment_history/').'/?'.$_SERVER['QUERY_STRING'] : base_url('seller/offer_payment_history/');
	    $config['suffix'] = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'seller/offer_payment_history';
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
   
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
        $this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=', date('Y-m-d', strtotime('-'.$day.' days')));		
        }

        $select             ='  tbl_seller_products_offers.seller_id,
						        tbl_seller_products_offers.title,
						        tbl_seller_products_offers.qty,
						        tbl_seller_products_offers.description,
						        tbl_seller_products_offers.req_image,
						        tbl_seller_products_offers.location,
						        tbl_seller_products_offers.	created_date,
						        tbl_seller_products_offers.*,
						        tbl_seller_products_offers.*,
                                tbl_seller_offer_transaction.*
                             ';
	    $this->db->join('tbl_seller_products_offers' , 'tbl_seller_offer_transaction.offer_id=tbl_seller_products_offers.id');
	    $this->db->where('tbl_seller_products_offers.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_offer_transaction.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_offer_transaction',FALSE,$select,FALSE,$page,$config1["per_page"]);
        //echo $this->db->last_query();


		$data   =  array('middle_content' => 'seller/seller-transactions' , 'page_title' => 'Offers Payment History' , 'pageTitle' => 'Offers Payment History' , 'HistoryData'=> $getPaymentHistory['getPaymentHistory']);
		$this->load->view('template',$data);
	}

	public function upload_product()
	{
        $this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['title'])) {

            $this->db->where('seller_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount = $this->master_model->getRecords('tbl_seller_upload_product_count');

            if(sizeof($getAvailablePostCount) > 0){

            	if($getAvailablePostCount[0]['available'] <= 0){
                    
                    $url=base_url().'purchase/for_product';
					$arr_response['status'] = "error";
					$arr_response['msg']    = "Sorry!!, you not able to upload this product. your upload product limit has expire, if you upload this product then purchase ".PROJECT_NAME." premium membership. <a href='$url'><button style='height: 30px; max-width: 122px; margin:16px 0 2px 0' class='change-btn-pass'>Purchase</button></a>";
					echo json_encode($arr_response);
					exit;
            	}
            }
            else 
            {
            	$arr_response['status'] = "error";
	        	$arr_response['msg']    = "Sorry, you not able to post requirment.";
		       	echo json_encode($arr_response);
				exit;
            }


            $logo_name ="";
        	if(isset($_FILES['req_image']))
			{
				$logo_name = $_FILES['req_image']['name'];
				
				$this->load->library('upload');

				$config['upload_path']   = "images/seller_upload_product_image/";
				$config['allowed_types'] = 'gif|jpg|png'; //'*';//;
				
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload("req_image"))
				{
					echo $this->upload->display_errors();
					$error = array('error' => $this->upload->display_errors());

					$arr_response['status'] = "error";
		        	$arr_response['msg']    = "Please give permition to upload folder.";
			       	echo json_encode($arr_response);
					exit;
				}
				else
				{
					$data      = array('upload_data' => $this->upload->data());
					$logo_name = $data["upload_data"]["file_name"];
					$uploaddir = 'images/seller_upload_product_image/';
					
				}
				
			}
			else
			{
				$arr_response['status'] = "error";
	        	$arr_response['msg']    = "Please select requirment image.";
		       	echo json_encode($arr_response);
				exit;
			}


			$req_title         = $this->input->post('title');
			$req_subcat        = $this->input->post('subcategory_id');
			$price             = $this->input->post('price');
			$req_address       = $this->input->post('location');
			$req_desc          = $this->input->post('description');
			$image             = $logo_name;

			/*Category*/
			$this->db->where('subcategory_status' , '1');
			$this->db->where('is_delete' , '0');
			$this->db->where('subcategory_id' , $req_subcat);
			$getCategory = $this->master_model->getRecords('tbl_subcategory_master');
	        /**/

			$arr_req  = array(
				'seller_id'        => $this->session->userdata('user_id'),
				'category_id'      => $getCategory[0]['category_id'],
				'subcategory_id'   => $req_subcat,
				'title'            => $req_title, 
				'price'            => $price, 
				'description'      => $req_desc, 
				'req_image'        => $image,
				'location'         => $req_address,
				'created_date'     => date('Y-m-d h:m:s'),
				'status'           => 'Unblock'
		    );

		    if($this->db->insert('tbl_seller_upload_product' , $arr_req)){
              
                $minus_availble_post_count = $getAvailablePostCount[0]['available'] - 1;
                $plus_completed_post_count = $getAvailablePostCount[0]['competed']  + 1;

                $arr_post_update_data = array(
                   	 	'available'  => $minus_availble_post_count,
                   	 	'competed'   => $plus_completed_post_count,
               	);
               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
               	$this->db->update('tbl_seller_upload_product_count',$arr_post_update_data);


                $arr_response['status'] = "success";
	        	$arr_response['msg']    = "Your requirment successfully posted.";
		       	echo json_encode($arr_response);
				exit;
		    }else {
		    	$arr_response['status'] = "error";
		        $arr_response['msg']    = "Something was wrong,Please try again.";
		       	echo json_encode($arr_response);
				exit;
		    }
        }

		$data['pageTitle']       = 'Upload Listing - '.PROJECT_NAME;
   	    $data['page_title']      = 'Upload Listing - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-upload-product';

        
        $this->db->where('subcategory_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getSubcat'] = $this->master_model->getRecords('tbl_subcategory_master');


        $this->db->where('tbl_category_master.category_status' , '1');
        $this->db->where('tbl_category_master.is_delete' , '0');
        $this->db->where('subcategory_status' , '1');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->where('tbl_subcategory_master.is_delete' , '0');
        $this->db->group_by('tbl_category_master.category_id');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.category_id=tbl_category_master.category_id');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');

	    $this->load->view('template',$data);
	}
	public function product_payment_history()/*----------T.A.. */
	{
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url().'login');
		}
        $day="";
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
       	$this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=',date('Y-m-d', strtotime('-'.$day.' days')));	
        }

	    $this->db->where('tbl_seller_primum_membership_for_product_purchase_history.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_primum_membership_for_product_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_primum_membership_for_product_purchase_history');
        $Count=count($getPaymentHistory['getPaymentHistory']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config['first_url'] = $_SERVER['QUERY_STRING']!="" ? base_url('seller/product_payment_history/').'/?'.$_SERVER['QUERY_STRING'] : base_url('seller/product_payment_history/');
	    $config['suffix'] = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'seller/product_payment_history';
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
   
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
        $this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=', date('Y-m-d', strtotime('-'.$day.' days')));		
        }

        $this->db->where('tbl_seller_primum_membership_for_product_purchase_history.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_primum_membership_for_product_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_primum_membership_for_product_purchase_history',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        //echo $this->db->last_query();
         
		$data   =  array('middle_content' => 'seller/seller-product-transactions' , 'page_title' => 'Listing Payment History' , 'pageTitle' => 'Listing Payment History' , 'HistoryData'=> $getPaymentHistory['getPaymentHistory']);
		$this->load->view('template',$data);
	}

	public function make_offer_payment_history()/*----------T.A.. */
	{
		if($this->session->userdata('user_id')=="")
		{
			redirect(base_url().'login');
		}
        $day="";
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
       	$this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=',date('Y-m-d', strtotime('-'.$day.' days')));	
        }

	    $this->db->where('tbl_seller_primum_membership_for_make_offer_purchase_history.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_primum_membership_for_make_offer_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_primum_membership_for_make_offer_purchase_history');
        $Count=count($getPaymentHistory['getPaymentHistory']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config['first_url'] = $_SERVER['QUERY_STRING']!="" ? base_url('seller/make_offer_payment_history/').'/?'.$_SERVER['QUERY_STRING'] : base_url('seller/make_offer_payment_history/');
	    $config['suffix'] = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'seller/make_offer_payment_history';
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
   
        if(!empty($_REQUEST["sort_by"]))
        {
       	  if($_REQUEST["sort_by"]      =="Daily")
       	   {
       	   	 $day=0;
       	   }
       	  else if($_REQUEST["sort_by"] =="Weekly")
       	   {
       	   	 $day=7;
       	   }
       	  else if($_REQUEST["sort_by"] =="Monthly")
       	   {
       	   	 $day=30;
       	   }
       	  else if($_REQUEST["sort_by"] =="Yearly")
       	   {
       	   	 $day=365;
       	   }
       	  	
        $this->db->where('LEFT(payment_date , 10) <=', date('Y-m-d')); 
       	$this->db->where('LEFT(payment_date , 10) >=', date('Y-m-d', strtotime('-'.$day.' days')));		
        }

        $this->db->where('tbl_seller_primum_membership_for_make_offer_purchase_history.seller_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_seller_primum_membership_for_make_offer_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_seller_primum_membership_for_make_offer_purchase_history',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        //echo $this->db->last_query();
         
		$data   =  array('middle_content' => 'seller/make-offer-transactions' , 'page_title' => 'Make offer transactions' , 'pageTitle' => 'Make offer transactions' , 'HistoryData'=> $getPaymentHistory['getPaymentHistory']);
		$this->load->view('template',$data);
	}
	public function products()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Uploaded Listings - '.PROJECT_NAME;
   	    $data['page_title']      = 'Uploaded Listings - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-uploaded-products';


        $this->db->where('tbl_seller_upload_product.seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_seller_upload_product.status' , 'Unblock');
        $this->db->where('tbl_seller_upload_product.status <>' , 'Delete');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProducts']  = $this->master_model->getRecords('tbl_seller_upload_product');
        $Count = count($data['getProducts']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']          = $Count;
	    $config1['base_url']            = base_url().'seller/products';
	    $config1['per_page']            = 2;
	    $config1['uri_segment']         = '3';
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

        $this->db->where('tbl_seller_upload_product.seller_id' , $this->session->userdata('user_id'));
        $this->db->order_by('tbl_seller_upload_product.id' , 'Desc');
        $this->db->where('tbl_seller_upload_product.status' , 'Unblock');
        $this->db->where('tbl_seller_upload_product.status <>' , 'Delete');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProducts'] = $this->master_model->getRecords('tbl_seller_upload_product',FALSE,FALSE,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}
	public function product_detail($product_id=FALSE)
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Listing detail - '.PROJECT_NAME;
   	    $data['page_title']      = 'Listing detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/seller-uploaded-product-details';

        $this->db->where('tbl_seller_upload_product.seller_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_seller_upload_product.id' , $product_id);
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProductDetail']  = $this->master_model->getRecords('tbl_seller_upload_product');
        $Count = count($data['getProductDetail']);

	    $this->load->view('template',$data);
	}
    public function profile($seller_id=FALSE)
	{
        $data['get_profile_data'] = $this->master_model->getRecords('tbl_user_master',array('id'=>$seller_id));
 
        if(isset($data['get_profile_data'][0]['name'])) { $data['get_profile_data'][0]['name'] = $data['get_profile_data'][0]['name']; } else { $data['get_profile_data'][0]['name'] = "Unknown"; }


        $data['pageTitle']        = $data['get_profile_data'][0]['name'].' Profile - '.PROJECT_NAME;
   	    $data['page_title']       = $data['get_profile_data'][0]['name'].' Profile - '.PROJECT_NAME;
   	    $data['middle_content']   = 'seller/seller-front-search/seller-profile';
        $Count                    = count($data['get_profile_data']);


        $this->db->where('tbl_seller_upload_product.seller_id' , $seller_id);
        $this->db->order_by('tbl_seller_upload_product.id' , 'desc');
        $this->db->where('tbl_seller_upload_product.status' , 'Unblock');
        $this->db->where('tbl_seller_upload_product.status <>' , 'Delete');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProducts']  = $this->master_model->getRecords('tbl_seller_upload_product');


        /* review */
        $this->db->where('tbl_seller_rating.status <>' , 'Delete');
        $this->db->order_by('tbl_seller_rating.review_id' , 'desc');
        $this->db->where('tbl_seller_rating.seller_id' , $seller_id);
        $data['getreview']  = $this->master_model->getRecords('tbl_seller_rating');


        $this->db->where('category_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');
	    $this->load->view('template',$data);

	}	
	public function all_products($seller_id=FALSE)
	{
        $data['get_profile_data'] = $this->master_model->getRecords('tbl_user_master',array('id'=>$seller_id));

        if(isset($data['get_profile_data'][0]['name'])) { $data['get_profile_data'][0]['name'] = $data['get_profile_data'][0]['name']; } else { $data['get_profile_data'][0]['name'] = "Unknown"; }

        $data['pageTitle']        = $data['get_profile_data'][0]['name'].' all produts - '.PROJECT_NAME;
   	    $data['page_title']       = $data['get_profile_data'][0]['name'].' all produts - '.PROJECT_NAME;
   	    $data['middle_content']   = 'seller/seller-front-search/seller-all-product-listing';
        $Count                    = count($data['get_profile_data']);


        $this->db->where('tbl_seller_upload_product.seller_id' , $seller_id);
        $this->db->order_by('tbl_seller_upload_product.id' , 'desc');
        $this->db->where('tbl_seller_upload_product.status' , 'Unblock');
        $this->db->where('tbl_seller_upload_product.status <>' , 'Delete');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProducts']  = $this->master_model->getRecords('tbl_seller_upload_product');

        $Count = count($data['getProducts']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'seller/all_products/'.$seller_id;
	    $config1['per_page']             = 12;
	    $config1['uri_segment']          = '4';
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
	    $page        = ($this->uri->segment(4));
	    /* end create pagination */

	    $this->db->where('tbl_seller_upload_product.seller_id' , $seller_id);
        $this->db->order_by('tbl_seller_upload_product.id' , 'desc');
        $this->db->where('tbl_seller_upload_product.status' , 'Unblock');
        $this->db->where('tbl_seller_upload_product.status <>' , 'Delete');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProducts']  = $this->master_model->getRecords('tbl_seller_upload_product',FALSE,FALSE,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}
	public function reviews()
	{
        $data['get_profile_data'] = $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id')));

        if(isset($data['get_profile_data'][0]['name'])) { $data['get_profile_data'][0]['name'] = $data['get_profile_data'][0]['name']; } else { $data['get_profile_data'][0]['name'] = "Unknown"; }

        $data['pageTitle']        = $data['get_profile_data'][0]['name'].' all reviews - '.PROJECT_NAME;
   	    $data['page_title']       = $data['get_profile_data'][0]['name'].' all reviews - '.PROJECT_NAME;
   	    $data['middle_content']   = 'seller/review-ratings';
        $Count                    = count($data['get_profile_data']);


        $this->db->where('tbl_seller_rating.status <>' , 'Delete');
        $this->db->order_by('tbl_seller_rating.review_id' , 'desc');
        $this->db->where('tbl_seller_rating.seller_id' , $this->session->userdata('user_id'));
        $data['getreview']  = $this->master_model->getRecords('tbl_seller_rating');

        $Count = count($data['getreview']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'seller/reviews';
	    $config1['per_page']             = 12;
	    $config1['uri_segment']          = '4';
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
	    $page        = ($this->uri->segment(4));
	    /* end create pagination */

        $this->db->where('tbl_seller_rating.status <>' , 'Delete');
        $this->db->order_by('tbl_seller_rating.review_id' , 'desc');
        $this->db->where('tbl_seller_rating.seller_id' , $this->session->userdata('user_id'));
        $data['getreview']  = $this->master_model->getRecords('tbl_seller_rating',FALSE,FALSE,FALSE,$page,$config1["per_page"]);

	    $this->load->view('template',$data);
	}
	
	public function reviews_detail($review_id=FALSE)
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Reviews Details- '.PROJECT_NAME;
   	    $data['page_title']      = 'Reviews Details- '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/review-detail';
        
        $this->db->where('tbl_seller_rating.status !=' , 'Delete');
        $this->db->where('tbl_seller_rating.review_id' , $review_id);
        //$this->db->where('tbl_seller_rating.seller_id' , $this->session->userdata('user_id'));
        $data['getreviewes']  = $this->master_model->getRecords('tbl_seller_rating');
          


        $this->db->where('review_id' , $review_id);
        $this->db->update('tbl_seller_rating',array('is_read' => 'yes'));
     
	    $this->load->view('template',$data);
	}
	public function review_delete($review_id=FALSE){

		if($this->master_model->updateRecord('tbl_seller_rating',array('status'=>'Delete'),array('review_id'=>$review_id)))
	  	{
	  		$this->session->set_flashdata('success','Review deleted successfully.');
	  		redirect(base_url().'seller/reviews');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Review.');
	  		redirect(base_url().'seller/reviews');
	  	}

	}
	public function all_reviews($seller_id=FALSE)
	{
        $data['get_profile_data'] = $this->master_model->getRecords('tbl_user_master',array('id'=>$seller_id));

        if(isset($data['get_profile_data'][0]['name'])) { $data['get_profile_data'][0]['name'] = $data['get_profile_data'][0]['name']; } else { $data['get_profile_data'][0]['name'] = "Unknown"; }

        $data['pageTitle']        = $data['get_profile_data'][0]['name'].' all reviews - '.PROJECT_NAME;
   	    $data['page_title']       = $data['get_profile_data'][0]['name'].' all reviews - '.PROJECT_NAME;
   	    $data['middle_content']   = 'seller/seller-front-search/seller-all-review-listing';
        $Count                    = count($data['get_profile_data']);


        $this->db->where('tbl_seller_rating.status <>' , 'Delete');
        $this->db->order_by('tbl_seller_rating.review_id' , 'desc');
        $this->db->where('tbl_seller_rating.seller_id' , $seller_id);
        $data['getreview']  = $this->master_model->getRecords('tbl_seller_rating');

        $Count = count($data['getreview']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'seller/all_reviews/'.$seller_id;
	    $config1['per_page']             = 12;
	    $config1['uri_segment']          = '4';
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
	    $page        = ($this->uri->segment(4));
	    /* end create pagination */

        $this->db->where('tbl_seller_rating.status <>' , 'Delete');
        $this->db->order_by('tbl_seller_rating.review_id' , 'desc');
        $this->db->where('tbl_seller_rating.seller_id' , $seller_id);
        $data['getreview']  = $this->master_model->getRecords('tbl_seller_rating',FALSE,FALSE,FALSE,$page,$config1["per_page"]);

	    $this->load->view('template',$data);
	}
	public function product_details($product_id=FALSE , $seller_id=FALSE)
	{
        $this->db->where('tbl_seller_upload_product.id' , $product_id);
        $this->db->where('tbl_seller_upload_product.seller_id' , $seller_id);
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_seller_upload_product.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getProductDetail']  = $this->master_model->getRecords('tbl_seller_upload_product');

        $data['get_profile_data'] = $this->master_model->getRecords('tbl_user_master',array('id'=>$seller_id));
 
        if(isset($data['get_profile_data'][0]['name'])) { $data['get_profile_data'][0]['name'] = $data['get_profile_data'][0]['name']; } else { $data['get_profile_data'][0]['name'] = "Unknown"; }

        if(isset($data['getProductDetail'][0]['title'])) { $data['getProductDetail'][0]['title'] = $data['getProductDetail'][0]['title']; } else { $data['getProductDetail'][0]['title'] = "Unknown";}	

        $data['pageTitle']        = $data['get_profile_data'][0]['name'].' '.$data['getProductDetail'][0]['title'].' produts - '.PROJECT_NAME;
   	    $data['page_title']       = $data['get_profile_data'][0]['name'].' '.$data['getProductDetail'][0]['title'].' produts - '.PROJECT_NAME;
   	    $data['middle_content']   = 'seller/seller-front-search/seller-product-detail';

	    $this->load->view('template',$data);
	}

	public function my_inquires()
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'My Inquires - '.PROJECT_NAME;
   	    $data['page_title']      = 'My Inquires - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/my-inquiries';
        

        $this->db->where('tbl_seller_contact_inquires.status <>','Delete');
        $this->db->order_by('tbl_seller_contact_inquires.id' , 'desc');
        $this->db->where('tbl_seller_contact_inquires.seller_id' , $this->session->userdata('user_id'));
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_seller_contact_inquires.category_id');
        $data['my_inquires']  = $this->master_model->getRecords('tbl_seller_contact_inquires');
        $Count = count($data['my_inquires']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'seller/my_inquires';
	    $config1['per_page']             = 2;
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
        
        $this->db->where('tbl_seller_contact_inquires.status <>','Delete');
        $this->db->order_by('tbl_seller_contact_inquires.id' , 'desc');
        $this->db->where('tbl_seller_contact_inquires.seller_id' , $this->session->userdata('user_id'));
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_seller_contact_inquires.category_id');
        $data['my_inquires']  = $this->master_model->getRecords('tbl_seller_contact_inquires',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
	    $this->load->view('template',$data);
	}
	public function inquiry_details($inq_id=FALSE)
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Inquires Details- '.PROJECT_NAME;
   	    $data['page_title']      = 'Inquires Details- '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/my-inquiries-details';
        
        $this->db->order_by('tbl_seller_contact_inquires.id' , 'desc');
        $this->db->where('tbl_seller_contact_inquires.id' , $inq_id);
        $this->db->where('tbl_seller_contact_inquires.seller_id' , $this->session->userdata('user_id'));
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_seller_contact_inquires.category_id');
        $data['inquires_detail']  = $this->master_model->getRecords('tbl_seller_contact_inquires');

        $this->db->where('id' , $inq_id);
        $this->db->update('tbl_seller_contact_inquires',array('is_read' => 'yes'));
     
	    $this->load->view('template',$data);
	}
	public function inquiry_delete($inquiry_id=FALSE){

		if($this->master_model->updateRecord('tbl_seller_contact_inquires',array('status'=>'Delete'),array('id'=>$inquiry_id)))
	  	{
	  		$this->session->set_flashdata('success','Inquiry deleted successfully.');
	  		redirect(base_url().'seller/my_inquires');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Inquiry.');
	  		redirect(base_url().'seller/my_inquires');
	  	}

	}
	public function inquiry_reply(){

		$arr_req  = array(
			'buyer_id'        => $this->input->post('buyer_id'),
			'seller_id'       => $this->session->userdata('user_id'),
			'inquery_id'      => $this->input->post('inquiry_id'),
			'reply_desc'      => $this->input->post('description'), 
			'replyed_date'    => date('Y-m-d h:m:s'),
			'status'          => 'Unblock',
			'is_read'         => 'no'
	    );

	    if($this->db->insert('tbl_inquery_reply_to_buyer' , $arr_req)){

	    	/* insert notification */
            $arr_noti  = array(
            'seller_id'          => $this->session->userdata('user_id'),
            'buyer_id'           => $this->input->post('buyer_id'),
            'notification'       => $this->session->userdata('user_name').' '.'gives reply for your inquiry',
            'url'                => base_url().'buyer/sent_inquiry_detail/'.$this->input->post('inquiry_id'),
            'details'            => $this->input->post('description'),
            'created_date'       => date('Y-m-d H:m:s'),
            'status'             =>'Unblock',
            'is_read'            =>'no'
            );
            $this->db->insert('tbl_buyer_notifications' , $arr_noti);
            /* end insert notification */
          
            $arr_response['status'] = "success";
        	$arr_response['msg']    = "You replyed successfully.";
	       	echo json_encode($arr_response);
			exit;

	    }else {

	    	$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
	    }
	}
	
	public function notifications(){

    	$data['pageTitle']       = 'Seller notifications - '.PROJECT_NAME;
   	    $data['page_title']      = 'Seller notifications - '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/notifications';
   	    

        $this->db->where('status' , 'Unblock');
        $this->db->order_by('id' , 'desc');
        $this->db->where('seller_id' , $this->session->userdata('user_id'));
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_seller_notifications');
        $Count = count($data['get_notifications']);


   	    /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'seller/notifications';
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

	    $this->db->where('status' , 'Unblock');
	    $this->db->order_by('id' , 'desc');
        $this->db->where('seller_id' , $this->session->userdata('user_id'));
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_seller_notifications',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
   	    $this->load->view('template',$data);

    }

    public function notification_details($noti_id=FALSE){

    	$data['pageTitle']       = 'Notifications Detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Notifications Detail- '.PROJECT_NAME;
   	    $data['middle_content']  = 'seller/notifications-detail';
   	    

        $this->db->where('status' , 'Unblock');
        $this->db->where('id' , $noti_id);
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_seller_notifications');

        $this->db->where('id' , $noti_id);
        $this->db->update('tbl_seller_notifications',array('is_read' => 'yes'));

        $this->load->view('template',$data);
    }

    public function notification_delete($noti_id=FALSE){

		if($this->master_model->updateRecord('tbl_seller_notifications',array('status'=>'Delete'),array('id'=>$noti_id)))
	  	{
	  		$this->session->set_flashdata('success','Notification deleted successfully.');
	  		redirect(base_url().'seller/notifications');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Notification.');
	  		redirect(base_url().'seller/notifications');
	  	}

	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success' , 'Logout successfully');
		redirect(base_url().'login');
	}

} //  end class
