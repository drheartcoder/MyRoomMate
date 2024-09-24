<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
		$this->master_model->IsLogged();
	}
	
    /* seller section */

	public function for_product()
	{
		if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['card_type'])) {

           

        	$this->load->model('callerservice');
			$this->db->where('pricing_name'  , 'Premium');
			$this->db->where('membership_id' , 2);
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
					/* add 15 more products availabel qty */
                    $this->db->where('seller_id' , $this->session->userdata('user_id'));
		            $this->db->where('status'   , 'Unblock');
		            $getAvailablePostCount    = $this->master_model->getRecords('tbl_seller_upload_product_count');
	                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
	                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

	                $arr_post_update_data = array(
	                   	 	'available'   => $add_upload_qty,
	                   	 	'total'       => $add_total_qty,
	               	);
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_seller_upload_product_count',$arr_post_update_data);
                    /* end add 15 more products availabel qty */

                    
                    /* arr_expire_request */
                    $arr_expire_request = array(
	                   	 	'status'  => 'expire',
	               	);
	               	$this->db->where('status' , 'open');
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_sellers_upload_product_request',$arr_expire_request);
	               	/* arr_expire_request */

				    
					$transaction_arr = array('transaction_id'   => $resArray['TRANSACTIONID'],
											 'seller_id'	    => $this->session->userdata('user_id'),
											 'transaction_price'=> $resArray['AMT'],
											 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_seller_primum_membership_for_product_purchase_history',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to upload more ".$get_pay_amt[0]['upload_qty']." products.");
						redirect(base_url().'purchase/for_product');
		                exit;
					}
				}
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		           redirect(base_url().'purchase/for_product');
		           exit;
				}
			}

			if(isset($_POST['btn_pay']))
			{


				$currencyCode    = currencyCode;
				$final_price     = $get_pay_amt[0]['membership_price'];
				$offer_title 	 = 'Purchase Membership';
				$returnUrl       = base_url().'purchase/for_product_paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'purchase/for_product';
				$nvpstr          =""; 
				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";
				$resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			}
			if(isset($resArray["ACK"]))
	    	{
	    		$ack = strtoupper($resArray["ACK"]);
		    	if($ack=="SUCCESS")
		    	{
		   	    	
		     		$token = urldecode($resArray["TOKEN"]);
		   	    	$payPalURL = PAYPAL_URL.$token;
		   	    	redirect($payPalURL);
		    	}
		    	else
		    	{
		    		$errorType=$resArray["L_LONGMESSAGE0"];
		    		$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		            redirect(base_url().'purchase/for_product');
		            exit;
				}
		    }
        }
        /* get admin decided price */
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
		$data['get_pay_amt'] = $this->master_model->getRecords('tbl_pricing_master');

		
		/* get_last_payment_history */
		$this->db->order_by('id' , 'desc');
		$this->db->limit('1');
		$this->db->where('seller_id' , $this->session->userdata('user_id'));
		$data['get_last_payment_history'] = $this->master_model->getRecords('tbl_seller_primum_membership_for_product_purchase_history');

        /* get_request_is_accept */
		$this->db->where('seller_id' , $this->session->userdata('user_id'));
		$this->db->order_by('id' , 'desc');
		$this->db->where('status' , 'open');
		$this->db->limit('1');
		$data['get_request_is_accept'] = $this->master_model->getRecords('tbl_sellers_upload_product_request');

        $data['pageTitle']       = 'Premium Membership for Listing Purchase - '.PROJECT_NAME;
   	    $data['page_title']      = 'Premium Membership for Listing Purchase - '.PROJECT_NAME;
   	    $data['middle_content']  = 'memberships/seller/premium-membership-purchase-for-product';
	    $this->load->view('template',$data);
	}
	public function for_product_paypal_success()
	{
		
		$this->load->model('callerservice');
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
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
			    /* add 15 more products availabel qty */
                $this->db->where('seller_id' , $this->session->userdata('user_id'));
	            $this->db->where('status'   , 'Unblock');
	            $getAvailablePostCount    = $this->master_model->getRecords('tbl_seller_upload_product_count');
                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

                $arr_post_update_data = array(
                   	 	'available'  => $add_upload_qty,
                   	 	'total'      => $add_total_qty,
               	);
               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
               	$this->db->update('tbl_seller_upload_product_count',$arr_post_update_data);
                /* end add 15 more products availabel qty */

                /* arr_expire_request */
                $arr_expire_request = array(
                   	 	'status'  => 'expire',
               	);
               	$this->db->where('status' , 'open');
               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
               	$this->db->update('tbl_sellers_upload_product_request',$arr_expire_request);
               	/* arr_expire_request */

			    
				$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
										 'seller_id'	    => $this->session->userdata('user_id'),
										 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
										 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
										 'payment_status'	=> 'complete',
										 'payment_date'		=> date('Y-m-d H:i:s'),
										 'pament_type'		=> 'credit_card');
				if($this->master_model->insertRecord('tbl_seller_primum_membership_for_product_purchase_history',$transaction_arr))
				{
					$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to upload more ".$get_pay_amt[0]['upload_qty']." products.");
					redirect(base_url().'purchase/for_product');
	                exit;
				}
		}
		else if($resArray['ACK']=="Failure")
		{
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'purchase/for_product');
           exit;
		}
	}
	public function make_request_to_upload_product(){
        

		$request_array = array(
			'seller_id'       => $this->session->userdata('user_id'),
			'description'     => $this->input->post('description'),
			'requiested_date' => date('Y-m-d H:m:s')
		);
		if($this->db->insert('tbl_sellers_upload_product_request' ,$request_array )){

 
            /* Mail To  Admin */
            $this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{
				$admin_contact_email=$email_info[0]['admin_email'];
				$user_info = array(
				  				"name"               => $this->session->userdata('user_name'),
				  				"email"              => $this->session->userdata('user_email'),
				  				"subject"            => 'Request For Listing Upload',
				  				"mobile_no"          => $this->session->userdata('user_mobile'),
				  				"message"            => $this->input->post('description'),

	  			);
	  			$info_arr   =array(
						        'from'    		     => $this->session->userdata('user_email'),
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'Request For Listing Upload - '.PROJECT_NAME,
						        'view'		         => 'product-upload-request-mail-to-admin'
				);
				$this->email_sending->sendmail($info_arr,$user_info);
  		    }
  			/* End Mail To  Admin */

			$arr_response['status'] = "success";
	        $arr_response['msg']    = "your request is successfully send. when admin will approved your request then you will able to purchase this membership.";
	       	echo json_encode($arr_response);
			exit;
		}
		else{
			$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
		}
	}


	public function for_offers()
	{
        if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['card_type'])) {

        	$this->load->model('callerservice');
			$this->db->where('pricing_name'  , 'Premium');
			$this->db->where('membership_id' , 2);
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
					/* add 15 more products availabel qty */
                    $this->db->where('seller_id' , $this->session->userdata('user_id'));
		            $this->db->where('status'   , 'Unblock');
		            $getAvailablePostCount    = $this->master_model->getRecords('tbl_seller_offer_requirments_count');
	                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
	                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

	                $arr_post_update_data = array(
	                   	 	'available'   => $add_upload_qty,
	                   	 	'total'       => $add_total_qty,
	               	);
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_seller_offer_requirments_count',$arr_post_update_data);
                    /* end add 15 more products availabel qty */

                    
                    /* arr_expire_request */
                    $arr_expire_request = array(
	                   	 	'status'  => 'expire',
	               	);
	               	$this->db->where('status' , 'open');
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_sellers_make_offer_purchase_request',$arr_expire_request);
	               	/* arr_expire_request */

				    
					$transaction_arr = array('transaction_id'   => $resArray['TRANSACTIONID'],
											 'seller_id'	    => $this->session->userdata('user_id'),
											 'transaction_price'=> $resArray['AMT'],
											 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_seller_primum_membership_for_make_offer_purchase_history',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to make more ".$get_pay_amt[0]['upload_qty']." offer to buyers reuirements from marketpalce.");
						redirect(base_url().'purchase/for_offers');
		                exit;
					}
				}
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		           redirect(base_url().'purchase/for_offers');
		           exit;
				}
			}

			if(isset($_POST['btn_pay']))
			{

				$currencyCode    = currencyCode;
				$final_price     = $get_pay_amt[0]['membership_price'];
				$offer_title 	 = 'Purchase Membership';
				$returnUrl       = base_url().'purchase/for_make_offer_paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'purchase/for_offers';
				$nvpstr          =""; 
				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";
				$resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			}
			if(isset($resArray["ACK"]))
	    	{
	    		$ack = strtoupper($resArray["ACK"]);
		    	if($ack=="SUCCESS")
		    	{
		   	    	
		     		$token = urldecode($resArray["TOKEN"]);
		   	    	$payPalURL = PAYPAL_URL.$token;
		   	    	redirect($payPalURL);
		    	}
		    	else
		    	{
		    		$errorType=$resArray["L_LONGMESSAGE0"];
		    		$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		            redirect(base_url().'purchase/for_offers');
		            exit;
				}
		    }
        }
        /* get admin decided price */
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
		$data['get_pay_amt'] = $this->master_model->getRecords('tbl_pricing_master');

		
		/* get_last_payment_history */
		$this->db->order_by('id' , 'desc');
		$this->db->limit('1');
		$this->db->where('seller_id' , $this->session->userdata('user_id'));
		$data['get_last_payment_history'] = $this->master_model->getRecords('tbl_seller_primum_membership_for_make_offer_purchase_history');

        /* get_request_is_accept */
		$this->db->where('seller_id' , $this->session->userdata('user_id'));
		$this->db->order_by('id' , 'desc');
		$this->db->where('status' , 'open');
		$this->db->limit('1');
		$data['get_request_is_accept'] = $this->master_model->getRecords('tbl_sellers_make_offer_purchase_request');

        $data['pageTitle']       = 'Premium Membership for make offer - '.PROJECT_NAME;
   	    $data['page_title']      = 'Premium Membership for make offer - '.PROJECT_NAME;
   	    $data['middle_content']  = 'memberships/seller/premium-membership-make-offer-for-requirment';
	    $this->load->view('template',$data);
	}
	public function for_make_offer_paypal_success()
	{
		
		$this->load->model('callerservice');
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
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
					/* add 15 more products availabel qty */
                    $this->db->where('seller_id' , $this->session->userdata('user_id'));
		            $this->db->where('status'   , 'Unblock');
		            $getAvailablePostCount    = $this->master_model->getRecords('tbl_seller_offer_requirments_count');
	                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
	                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

	                $arr_post_update_data = array(
	                   	 	'available'   => $add_upload_qty,
	                   	 	'total'       => $add_total_qty,
	               	);
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_seller_offer_requirments_count',$arr_post_update_data);
                    /* end add 15 more products availabel qty */

                    
                    /* arr_expire_request */
                    $arr_expire_request = array(
	                   	 	'status'  => 'expire',
	               	);
	               	$this->db->where('status' , 'open');
	               	$this->db->where('seller_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_sellers_make_offer_purchase_request',$arr_expire_request);
	               	/* arr_expire_request */

				    
					$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
											 'seller_id'	    => $this->session->userdata('user_id'),
											 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
											 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_seller_primum_membership_for_make_offer_purchase_history',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to make more ".$get_pay_amt[0]['upload_qty']." offer to buyers reuirements from marketpalce.");
						redirect(base_url().'purchase/for_offers');
		                exit;
					}
		}
		else if($resArray['ACK']=="Failure")
		{
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'purchase/for_offers');
           exit;
		}
	}
	public function make_request_to_make_offers(){

		$request_array = array(
			'seller_id'       => $this->session->userdata('user_id'),
			'description'     => $this->input->post('description'),
			'requiested_date' => date('Y-m-d H:m:s')
		);
		if($this->db->insert('tbl_sellers_make_offer_purchase_request' ,$request_array )){


			/* Mail To  Admin */
            $this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{
				$admin_contact_email=$email_info[0]['admin_email'];
				$user_info = array(
				  				"name"               => $this->session->userdata('user_name'),
				  				"email"              => $this->session->userdata('user_email'),
				  				"subject"            => 'Request For Make Offer',
				  				"mobile_no"          => $this->session->userdata('user_mobile'),
				  				"message"            => $this->input->post('description'),

	  			);
	  			$info_arr   =array(
						        'from'    		     => $this->session->userdata('user_email'),
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'Request For Make Offer - '.PROJECT_NAME,
						        'view'		         => 'make-offer-request-mail-to-admin-from-seller'
				);
				$this->email_sending->sendmail($info_arr,$user_info);
  		    }
  			/* End Mail To  Admin */

			$arr_response['status'] = "success";
	        $arr_response['msg']    = "your request is successfully send. when admin will approved your request then you will able to purchase this membership.";
	       	echo json_encode($arr_response);
			exit;
		}
		else{
			$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
		}
	}


    /* end  seller section */



    /* buyer section */

	public function post_requirements()
	{
		if($this->session->userdata('user_type')!='Buyer')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['card_type'])) {

        	$this->load->model('callerservice');
			$this->db->where('pricing_name'  , 'Premium');
			$this->db->where('membership_id' , 2);
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
					/* add 15 more products availabel qty */
                    $this->db->where('buyer_id' , $this->session->userdata('user_id'));
		            $this->db->where('status'   , 'Unblock');
		            $getAvailablePostCount    = $this->master_model->getRecords('tbl_buyer_post_requirement_count');
	                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
	                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

	                $arr_post_update_data = array(
	                   	 	'available'   => $add_upload_qty,
	                   	 	'total'       => $add_total_qty,
	               	);
	               	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_buyer_post_requirement_count',$arr_post_update_data);
                    /* end add 15 more products availabel qty */

                    
                    /* arr_expire_request */
                    $arr_expire_request = array(
	                   	 	'status'  => 'expire',
	               	);
	               	$this->db->where('status' , 'open');
	               	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_buyer_post_requirement_request',$arr_expire_request);
	               	/* arr_expire_request */

				    
					$transaction_arr = array('transaction_id'   => $resArray['TRANSACTIONID'],
											 'buyer_id'	        => $this->session->userdata('user_id'),
											 'transaction_price'=> $resArray['AMT'],
											 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_buyer_primum_membership_for_requirements_purchase_history',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to post more ".$get_pay_amt[0]['upload_qty']." requirements.");
						redirect(base_url().'purchase/post_requirements');
		                exit;
					}
				}
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		           redirect(base_url().'purchase/post_requirements');
		           exit;
				}
			}

			if(isset($_POST['btn_pay']))
			{

				$currencyCode    = currencyCode;
				$final_price     = $get_pay_amt[0]['membership_price'];
				$offer_title 	 = 'Purchase Membership';
				$returnUrl       = base_url().'purchase/for_requirement_paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'purchase/post_requirements';
				$nvpstr          =""; 
				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";
				$resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			}
			if(isset($resArray["ACK"]))
	    	{
	    		$ack = strtoupper($resArray["ACK"]);
		    	if($ack=="SUCCESS")
		    	{
		   	    	
		     		$token = urldecode($resArray["TOKEN"]);
		   	    	$payPalURL = PAYPAL_URL.$token;
		   	    	redirect($payPalURL);
		    	}
		    	else
		    	{
		    		$errorType=$resArray["L_LONGMESSAGE0"];
		    		$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		            redirect(base_url().'purchase/for_product');
		            exit;
				}
		    }
        }
        /* get admin decided price */
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
		$data['get_pay_amt'] = $this->master_model->getRecords('tbl_pricing_master');

		
		/* get_last_payment_history */
		$this->db->order_by('id' , 'desc');
		$this->db->limit('1');
		$this->db->where('buyer_id' , $this->session->userdata('user_id'));
		$data['get_last_payment_history'] = $this->master_model->getRecords('tbl_buyer_primum_membership_for_requirements_purchase_history');

        /* get_request_is_accept */
		$this->db->where('buyer_id' , $this->session->userdata('user_id'));
		$this->db->order_by('id' , 'desc');
		$this->db->where('status' , 'open');
		$this->db->limit('1');
		$data['get_request_is_accept'] = $this->master_model->getRecords('tbl_buyer_post_requirement_request');

        $data['pageTitle']       = 'Premium Membership for Listing Purchase - '.PROJECT_NAME;
   	    $data['page_title']      = 'Premium Membership for Listing Purchase - '.PROJECT_NAME;
   	    $data['middle_content']  = 'memberships/buyer/premium-membership-purchase-for-requirements';
	    $this->load->view('template',$data);
	}
	public function for_requirement_paypal_success()
	{
		
		$this->load->model('callerservice');
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
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
			/* add 15 more requirements available qty */
            $this->db->where('buyer_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount    = $this->master_model->getRecords('tbl_buyer_post_requirement_count');
            $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
            $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

            $arr_post_update_data = array(
               	 	'available'   => $add_upload_qty,
               	 	'total'       => $add_total_qty,
           	);
           	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
           	$this->db->update('tbl_buyer_post_requirement_count',$arr_post_update_data);
            /* end add 15 more requirements available qty */

            
            /* arr_expire_request */
            $arr_expire_request = array(
               	 	'status'  => 'expire',
           	);
           	$this->db->where('status' , 'open');
           	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
           	$this->db->update('tbl_buyer_post_requirement_request',$arr_expire_request);
           	/* arr_expire_request */

		    
			$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
									 'buyer_id'	        => $this->session->userdata('user_id'),
									 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
									 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
									 'payment_status'	=> 'complete',
									 'payment_date'		=> date('Y-m-d H:i:s'),
									 'pament_type'		=> 'credit_card');
			if($this->master_model->insertRecord('tbl_buyer_primum_membership_for_requirements_purchase_history',$transaction_arr))
			{
				$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to post more ".$get_pay_amt[0]['upload_qty']." requirements.");
				redirect(base_url().'purchase/post_requirements');
                exit;
			}
		}
		else if($resArray['ACK']=="Failure")
		{
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'purchase/post_requirements');
           exit;
		}
	}
	public function make_request_to_post_requirements(){

		$request_array = array(
			'buyer_id'        => $this->session->userdata('user_id'),
			'description'     => $this->input->post('description'),
			'requiested_date' => date('Y-m-d H:m:s')
		);
		if($this->db->insert('tbl_buyer_post_requirement_request' ,$request_array )){


			/* Mail To  Admin */
            $this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{
				$admin_contact_email=$email_info[0]['admin_email'];
				$user_info = array(
				  				"name"               => $this->session->userdata('user_name'),
				  				"email"              => $this->session->userdata('user_email'),
				  				"subject"            => 'Request For Requirement Post',
				  				"mobile_no"          => $this->session->userdata('user_mobile'),
				  				"message"            => $this->input->post('description'),

	  			);
	  			$info_arr   =array(
						        'from'    		     => $this->session->userdata('user_email'),
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'Request For Requirement Post - '.PROJECT_NAME,
						        'view'		         => 'requirement-post-request-mail-to-admin'
				);
				$this->email_sending->sendmail($info_arr,$user_info);
  		    }
  			/* End Mail To  Admin */

			$arr_response['status'] = "success";
	        $arr_response['msg']    = "your request is successfully send. when admin will approved your request then you will able to purchase this membership.";
	       	echo json_encode($arr_response);
			exit;
		}
		else{
			$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
		}
	}

	public function market_offers()
	{
        if($this->session->userdata('user_type')!='Buyer')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        if(isset($_POST['card_type'])) {

        	$this->load->model('callerservice');
			$this->db->where('pricing_name'  , 'Premium');
			$this->db->where('membership_id' , 2);
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
					/* add 15 more products availabel qty */
                    $this->db->where('buyer_id' , $this->session->userdata('user_id'));
		            $this->db->where('status'   , 'Unblock');
		            $getAvailablePostCount    = $this->master_model->getRecords('tbl_buyer_offer_count');
	                $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
	                $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

	                $arr_post_update_data = array(
	                   	 	'available'   => $add_upload_qty,
	                   	 	'total'       => $add_total_qty,
	               	);
	               	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_buyer_offer_count',$arr_post_update_data);
                    /* end add 15 more products availabel qty */

                    
                    /* arr_expire_request */
                    $arr_expire_request = array(
	                   	 	'status'  => 'expire',
	               	);
	               	$this->db->where('status' , 'open');
	               	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
	               	$this->db->update('tbl_buyers_make_offer_purchase_request',$arr_expire_request);
	               	/* arr_expire_request */

				    
					$transaction_arr = array('transaction_id'   => $resArray['TRANSACTIONID'],
											 'buyer_id'	        => $this->session->userdata('user_id'),
											 'transaction_price'=> $resArray['AMT'],
											 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_buyer_primum_membership_for_make_offer_purchase_history',$transaction_arr))
					{
						$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to make more ".$get_pay_amt[0]['upload_qty']." offer to sellers offers from marketpalce.");
						redirect(base_url().'purchase/market_offers');
		                exit;
					}
				}
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		           redirect(base_url().'purchase/market_offers');
		           exit;
				}
			}

			if(isset($_POST['btn_pay']))
			{

				$currencyCode    = currencyCode;
				$final_price     = $get_pay_amt[0]['membership_price'];
				$offer_title 	 = 'Purchase Membership';
				$returnUrl       = base_url().'purchase/for_make_offer_to_seller_paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'purchase/market_offers';
				$nvpstr          =""; 
				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";
				$resArray=$this->callerservice->hash_call('SetExpressCheckout',$nvpstr);
			}
			if(isset($resArray["ACK"]))
	    	{
	    		$ack = strtoupper($resArray["ACK"]);
		    	if($ack=="SUCCESS")
		    	{
		   	    	
		     		$token = urldecode($resArray["TOKEN"]);
		   	    	$payPalURL = PAYPAL_URL.$token;
		   	    	redirect($payPalURL);
		    	}
		    	else
		    	{
		    		$errorType=$resArray["L_LONGMESSAGE0"];
		    		$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
		            redirect(base_url().'purchase/for_offers');
		            exit;
				}
		    }
        }
        /* get admin decided price */
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
		$data['get_pay_amt'] = $this->master_model->getRecords('tbl_pricing_master');

		
		/* get_last_payment_history */
		$this->db->order_by('id' , 'desc');
		$this->db->limit('1');
		$this->db->where('buyer_id' , $this->session->userdata('user_id'));
		$data['get_last_payment_history'] = $this->master_model->getRecords('tbl_buyer_primum_membership_for_make_offer_purchase_history');

        /* get_request_is_accept */
		$this->db->where('buyer_id' , $this->session->userdata('user_id'));
		$this->db->order_by('id' , 'desc');
		$this->db->where('status' , 'open');
		$this->db->limit('1');
		$data['get_request_is_accept'] = $this->master_model->getRecords('tbl_buyers_make_offer_purchase_request');

        $data['pageTitle']       = 'Premium Membership for make offer - '.PROJECT_NAME;
   	    $data['page_title']      = 'Premium Membership for make offer - '.PROJECT_NAME;
   	    $data['middle_content']  = 'memberships/buyer/premium-membership-make-offer-for-seller_offers';
	    $this->load->view('template',$data);
	}
	public function for_make_offer_to_seller_paypal_success()
	{
		
		$this->load->model('callerservice');
        $this->db->where('pricing_name'  , 'Premium');
		$this->db->where('membership_id' , 2);
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
			/* add 15 more products availabel qty */
            $this->db->where('buyer_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount    = $this->master_model->getRecords('tbl_buyer_offer_count');
            $add_upload_qty           = $getAvailablePostCount[0]['available']  + $get_pay_amt[0]['upload_qty'];
            $add_total_qty            = $getAvailablePostCount[0]['total']  + $get_pay_amt[0]['upload_qty'];

            $arr_post_update_data = array(
               	 	'available'   => $add_upload_qty,
               	 	'total'       => $add_total_qty,
           	);
           	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
           	$this->db->update('tbl_buyer_offer_count',$arr_post_update_data);
            /* end add 15 more products availabel qty */

            
            /* arr_expire_request */
            $arr_expire_request = array(
               	 	'status'  => 'expire',
           	);
           	$this->db->where('status' , 'open');
           	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
           	$this->db->update('tbl_buyers_make_offer_purchase_request',$arr_expire_request);
           	/* arr_expire_request */

		    
			$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
									 'buyer_id'	        => $this->session->userdata('user_id'),
									 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
									 'upload_qty'       => $get_pay_amt[0]['upload_qty'],
									 'payment_status'	=> 'complete',
									 'payment_date'		=> date('Y-m-d H:i:s'),
									 'pament_type'		=> 'credit_card');
			if($this->master_model->insertRecord('tbl_buyer_primum_membership_for_make_offer_purchase_history',$transaction_arr))
			{
				$this->session->set_flashdata('success',"Your payment done successfully. also you get facility to make more ".$get_pay_amt[0]['upload_qty']." offer to sellers offers from marketpalce.");
				redirect(base_url().'purchase/market_offers');
                exit;
			}
		}
		else if($resArray['ACK']=="Failure")
		{
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'purchase/market_offers');
           exit;
		}
	}
	public function admin_request_to_make_offers_for_sellers(){

		$request_array = array(
			'buyer_id'        => $this->session->userdata('user_id'),
			'description'     => $this->input->post('description'),
			'requiested_date' => date('Y-m-d H:m:s')
		);
		if($this->db->insert('tbl_buyers_make_offer_purchase_request' ,$request_array )){


			/* Mail To  Admin */
            $this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{
				$admin_contact_email=$email_info[0]['admin_email'];
				$user_info = array(
				  				"name"               => $this->session->userdata('user_name'),
				  				"email"              => $this->session->userdata('user_email'),
				  				"subject"            => 'Request For Make Offer',
				  				"mobile_no"          => $this->session->userdata('user_mobile'),
				  				"message"            => $this->input->post('description'),

	  			);
	  			$info_arr   =array(
						        'from'    		     => $this->session->userdata('user_email'),
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'Request For Make Offer - '.PROJECT_NAME,
						        'view'		         => 'make-offer-request-mail-to-admin-from-buyer'
				);
				$this->email_sending->sendmail($info_arr,$user_info);
  		    }
  			/* End Mail To  Admin */

			$arr_response['status'] = "success";
	        $arr_response['msg']    = "your request is successfully send. when admin will approved your request then you will able to purchase this membership.";
	       	echo json_encode($arr_response);
			exit;
		}
		else{
			$arr_response['status'] = "error";
	        $arr_response['msg']    = "Something was wrong,Please try again.";
	       	echo json_encode($arr_response);
			exit;
		}
	}

} //  end class
