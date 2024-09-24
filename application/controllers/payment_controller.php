<?php
    function payment()
    {	

    	$this->load->model('callerservice');
		/*echo "<pre>";
    	print_r($_POST);
    	echo "</pre>";
    	exit();*/

    	$user_id      	= $this->session->userdata('user_id');
		$cat_id			= $this->input->post('category_name');
        $title        	= $this->input->post('title');
        $description    = $this->input->post('adddescription');
        $mobilenumber 	= $this->input->post('mobilenumber');
        $addemail     	= $this->input->post('addemail');
        $payment 		= $this->input->post('payment');
        $card_type		= $this->input->post('card_type');
        $cc_number		= $this->input->post('cc_number');
        $cc_exp			= $this->input->post('cc_exp');
        $cc_cvc			= $this->input->post('cc_cvc');

        /* Check Image Uploaded or not */
		$config=array(
			'upload_path'=>'uploads/addlisting_images',
			'allowed_types'=>'jpg|jpeg|png',
			'file_name'=>rand(1,9999999),
			'max_size'=>5120
			);
		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		$slugvalue_img = "noimage.jpg";

		if(isset($_FILES['mainphoto']) && $_FILES['mainphoto']['error']==0)
		{
			if($this->upload->do_upload('mainphoto'))
			{
				$dt=$this->upload->data();
				$file=$dt['file_name'];
				$slugvalue_img = $file;
			} // end if
		} // end if

		$arr_Data  =array(
				'cat_id'      => $cat_id,
				'user_id'     => $user_id,
				'title'    	  => $title,
				'description' => $description,
				'mainphoto'   => $slugvalue_img,
				'mobile'      => $mobilenumber,
				'email'       => $addemail,
				'status'      => '1',
				'is_delete'   => '0',
	        );

    	if($_POST['payment'] == 'Free') 
    	{
	        if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
	        {
        		$last_inserted_id  =  $this->db->insert_id();

        		$where = array('tbl_category_form_fields.cat_id'=>$_POST['category_name']);
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
				$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

				foreach ($catoptions as $key => $value) {
				
					$arr_Addlistdata  =array(
						'listing_id'      => $last_inserted_id,
						'attribute_id'    => $value['attribute_id'],
						'attribute_slug'  => $value['attribute_slug'],
						'attribute_value' => $_POST[$value['attribute_slug']],
			        );

	        		$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);
	        		$this->session->set_flashdata('success',"Your Listing is added successfully.");
	        		redirect(base_url().'user/addlisting');
	        		exit();

				} // end foreach

        	} // end if

    	} // end if
    	else 
    	{    		

	        // Check if payment is done using Card
    		if(isset($_POST['btn_cc_pay']))
    		{
    			$creditCardType 	= ($this->input->post('card_type',true));
				$creditCardNumber 	= ($this->input->post('cc_number',true));
				$creditCardNumber 	= str_replace(' ', '', $creditCardNumber);
				$cc_exp 			= $this->input->post('cc_exp',true);
				$cvv2Number 		= $this->input->post('cc_cvc',true);
				$cc_exp_arr 		= explode('/', $cc_exp);
				$currencyCode 		= 'USD';
				$transaction_amt 	= $payment;
						
				$nvpstr="&PAYMENTACTION=Sale&AMT=$transaction_amt&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".trim($cc_exp_arr[0]).trim($cc_exp_arr[1])."&CVV2=$cvv2Number&CURRENCYCODE=$currencyCode";

				$resArray = $this->callerservice->hash_call("doDirectPayment",$nvpstr);

				//print_r($resArray);exit;

				// Check Card Payment Success Or Failure
				if($resArray['ACK']=="Success")
				{
					// Insert data in tbl_addlisting table
					if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
			        {
		        		$last_inserted_id  =  $this->db->insert_id();

		        		$where = array('tbl_category_form_fields.cat_id'=>$_POST['category_name']);
						$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
						$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

						foreach ($catoptions as $key => $value) {
						
							$arr_Addlistdata  =array(
								'listing_id'      => $last_inserted_id,
								'attribute_id'    => $value['attribute_id'],
								'attribute_slug'  => $value['attribute_slug'],
								'attribute_value' => $_POST[$value['attribute_slug']],
					        );

			        		$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

						} // end foreach

		        	} // end if

					$transaction_arr = array('user_id'			=> $user_id,
											 'listing_id'		=> $last_inserted_id + '1',
											 'transaction_id'   => $resArray['TRANSACTIONID'],
											 'transaction_price'=> $resArray['AMT'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');
					if($this->master_model->insertRecord('tbl_addlisting_transection', $transaction_arr))
					{						
						$this->session->set_flashdata('success',"Your payment done successfully.");
						redirect(base_url().'user/addlisting');
						exit();
					}

				} // end if

				// Check Payment Success Or Failure
				else if($resArray['ACK']=="Failure")
				{
	               $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
	               redirect(base_url().'user/addlisting');
	               exit();
				} // end else if

    		} // end if


    		// Check if payment is done using Paypal
    		else if(isset($_POST['btn_pay']))
    		{    			
    			$currencyCode    = 'USD';
				$final_price     = $payment;
				$offer_title 	 = $title;
				//$returnUrl       = base_url().'user/paypal_success?totalAmt='.$final_price.'?arr_Data='.$arr_Data;
				$returnUrl       = base_url().'user/paypal_success?totalAmt='.$final_price;
				$cancelUrl       = base_url().'user/addlisting';
				$nvpstr          = "";




				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";

				$resArray = $this->callerservice->hash_call('SetExpressCheckout',$nvpstr);

    		} // end else if

    		// Check Paypal Payment Success Or Failure
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
		    		exit();
				}
		    }

    	} // end if else

    	$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
    	redirect(base_url().'user/addlisting');
    	exit();
    	
    } // end payament function

    public function paypal_success()
	{	
		$this->load->model('callerservice');
		//$arr_Data		  = $this->input->get('arr_Data');
		$final_price	  = $this->input->get('totalAmt');
		$transaction_amt  = $final_price;
		$currencyCode     = 'USD';
		$returnUrl        = base_url().'user/addlisting';
		$cancelUrl        = base_url().'user/addlisting';
		$nvpstr           = "";

		$nvpstr.="&PAYMENTREQUEST_0_AMT=".$transaction_amt."&PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&TOKEN=".$_GET['token'].'&PAYERID='.$_GET['PayerID'];
		$resArray=$this->callerservice->hash_call('DoExpressCheckoutPayment',$nvpstr);



		if($resArray['ACK']=="Success")
		{
			    
			// Insert data in tbl_addlisting table
			if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
	        {
        		$last_inserted_id  =  $this->db->insert_id();

        		$where = array('tbl_category_form_fields.cat_id'=>$_POST['category_name']);
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
				$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

				foreach ($catoptions as $key => $value) {
				
					$arr_Addlistdata  =array(
						'listing_id'      => $last_inserted_id,
						'attribute_id'    => $value['attribute_id'],
						'attribute_slug'  => $value['attribute_slug'],
						'attribute_value' => $_POST[$value['attribute_slug']],
			        );

	        		$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

				} // end foreach

        	} // end if
			    
			$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
									 'seller_id'	    => $this->session->userdata('user_id'),
									 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
									 'upload_qty'       => '1',
									 'payment_status'	=> 'complete',
									 'payment_date'		=> date('Y-m-d H:i:s'),
									 'pament_type'		=> 'paypal');

				if($this->master_model->insertRecord('tbl_addlisting_transection',$transaction_arr))
				{
					$this->session->set_flashdata('success',"Your payment done successfully.");
					redirect(base_url().'user/payment');
	                exit;
				}
		}
		else if($resArray['ACK']=="Failure")
		{
           $this->session->set_flashdata('error',"Something Wrong . Please try again later.");
           redirect(base_url().'user/payment');
	       exit;
		}
	}

	?>