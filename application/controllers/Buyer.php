<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('email_sending');
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Buyer')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }


	}
	public function dashboard()
	{
        $data['pageTitle']       = 'Buyer dashboard - '.PROJECT_NAME;
   	    $data['page_title']      = 'Buyer dashboard - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/dashboard';
	    $this->load->view('template',$data);
	}
	public function edit()
	{
        $data['pageTitle']       = 'Edit Profile - '.PROJECT_NAME;
   	    $data['page_title']      = 'Edit Profile - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/edit-profile';
	    $this->load->view('template',$data);
	}
	public function get_profile()
	{
        $get_profile_data = $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id')));
		$arr_response['status']        = "success";
        $arr_response['profile_data']  = isset($get_profile_data[0])?$get_profile_data[0]:[];
       	echo json_encode($arr_response);
		exit;
	}
	public function update()
	{
        $logo_name = NULL;
        $arr_get_user = $this->master_model->getRecords('tbl_user_master',array('id' => $this->session->userdata('user_id')));
		if(isset($_FILES['user_image']))
		{
			$logo_name = $_FILES['user_image']['name'];
			if($arr_get_user[0]["user_image"] != $logo_name)
			{
				$this->load->library('upload');

				$config['upload_path']   = "images/buyer_image/";
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
					$uploaddir = 'images/buyer_image/';
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
                    'company_website'                   => $company_website,
                    'update_date'                       => date('Y-m-d H:m:s'),
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
   	    $data['middle_content']  = 'buyer/change-password';
	    $this->load->view('template',$data);
	}
    
    public function post_requirment()
	{
        if(isset($_POST['title'])) {

            $this->db->where('buyer_id' , $this->session->userdata('user_id'));
            $this->db->where('status'   , 'Unblock');
            $getAvailablePostCount = $this->master_model->getRecords('tbl_buyer_post_requirement_count');

            if(sizeof($getAvailablePostCount) > 0){

            	if($getAvailablePostCount[0]['available'] <= 0){
                   
                    $url=base_url().'purchase/post_requirements';
					$arr_response['status'] = "error";
					$arr_response['msg']    = "Sorry!!, you not able to post this requirement. your post requirement limit has expire, if you post this requirement then purchase ".PROJECT_NAME." premium membership. <a href='$url'><button style='height: 30px; max-width: 122px; margin:16px 0 2px 0' class='change-btn-pass'>Purchase</button></a>";
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

				$config['upload_path']   = "images/buyer_post_requirment_image/";
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
					$uploaddir = 'images/buyer_post_requirment_image/';
					
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
				'buyer_id'         => $this->session->userdata('user_id'),
				'category_id'      => $getCategory[0]['category_id'],
				'subcategory_id'   => $req_subcat,
				'title'            => $req_title, 
				'price'            => $price, 
				'description'      => $req_desc, 
				'req_image'        => $image,
				'location'         => $req_address,
				'created_date'     => date('Y-m-d H:m:s'),
				'status'           => 'Unblock'
		    );

		    if($this->db->insert('tbl_buyer_post_requirement' , $arr_req)){
              
                $minus_availble_post_count = $getAvailablePostCount[0]['available'] - 1;
                $plus_completed_post_count = $getAvailablePostCount[0]['competed']  + 1;

                $arr_post_update_data = array(
                   	 	'available'  => $minus_availble_post_count,
                   	 	'competed'   => $plus_completed_post_count,
               	);
               	$this->db->where('buyer_id' , $this->session->userdata('user_id'));
               	$this->db->update('tbl_buyer_post_requirement_count',$arr_post_update_data);


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

		$data['pageTitle']       = 'Post requirements - '.PROJECT_NAME;
   	    $data['page_title']      = 'Post requirements - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/buyer-post-requirement';

        
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

	public function requirments()
	{
    	$data['pageTitle']       = 'Posted requirements - '.PROJECT_NAME;
   	    $data['page_title']      = 'Posted requirements - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/buyer-posted-requirement';


        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirments']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']          = $Count;
	    $config1['base_url']            = base_url().'buyer/requirments';
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

        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->order_by('tbl_buyer_post_requirement.id' , 'Desc');
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments'] = $this->master_model->getRecords('tbl_buyer_post_requirement',FALSE,FALSE,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}

	public function requirment_detail($req_id=FALSE)
	{
    	$data['pageTitle']       = 'Requirements detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Requirements detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/buyer-post-requirement-details';

        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.id' , $req_id);
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirmentsDetail']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirmentsDetail']);


        /* offered sellers */ 

        $this->db->where('tbl_apply_for_requirment.requirment_id' , $req_id);
        $this->db->where('tbl_apply_for_requirment.status'   , 'Unblock');
        $this->db->where('tbl_apply_for_requirment.status !='   , 'Accepted');
        $this->db->order_by('tbl_apply_for_requirment.id' ,  'desc');
        $this->db->where('tbl_user_master.status'   , 'Unblock');
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

	public function requirement_payment_history()/*----------T.A.. */
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

	    $this->db->where('tbl_buyer_primum_membership_for_requirements_purchase_history.buyer_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_buyer_primum_membership_for_requirements_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_buyer_primum_membership_for_requirements_purchase_history');
        $Count=count($getPaymentHistory['getPaymentHistory']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config['first_url'] = $_SERVER['QUERY_STRING']!="" ? base_url('buyer/requirement_payment_history/').'/?'.$_SERVER['QUERY_STRING'] : base_url('buyer/requirement_payment_history/');
	    $config['suffix'] = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'buyer/requirement_payment_history';
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

        $this->db->where('tbl_buyer_primum_membership_for_requirements_purchase_history.buyer_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_buyer_primum_membership_for_requirements_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_buyer_primum_membership_for_requirements_purchase_history',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        //echo $this->db->last_query();
         
		$data   =  array('middle_content' => 'buyer/buyer-requirement-transactions' , 'page_title' => 'Requirement Payment History' , 'pageTitle' => 'Listing Payment History' , 'HistoryData'=> $getPaymentHistory['getPaymentHistory']);
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

	    $this->db->where('tbl_buyer_primum_membership_for_make_offer_purchase_history.buyer_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_buyer_primum_membership_for_make_offer_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_buyer_primum_membership_for_make_offer_purchase_history');
        $Count=count($getPaymentHistory['getPaymentHistory']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config['first_url'] = $_SERVER['QUERY_STRING']!="" ? base_url('buyer/make_offer_payment_history/').'/?'.$_SERVER['QUERY_STRING'] : base_url('buyer/make_offer_payment_history/');
	    $config['suffix'] = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'buyer/make_offer_payment_history';
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

        $this->db->where('tbl_buyer_primum_membership_for_make_offer_purchase_history.buyer_id' , $this->session->userdata('user_id'));
	    $this->db->order_by('tbl_buyer_primum_membership_for_make_offer_purchase_history.id', 'desc');
		$getPaymentHistory['getPaymentHistory']  = $this->master_model->getRecords('tbl_buyer_primum_membership_for_make_offer_purchase_history',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        //echo $this->db->last_query();
         
		$data   =  array('middle_content' => 'buyer/make-offer-transactions' , 'page_title' => 'Make offer transactions' , 'pageTitle' => 'Make offer transactions' , 'HistoryData'=> $getPaymentHistory['getPaymentHistory']);
		$this->load->view('template',$data);
	}
	public function accept_offer($req_id=FALSE,$offer_id=FALSE)
	{
		$req_update_array = array(
          'requirment_status' => 'closed'
		);
		$this->db->where('tbl_buyer_post_requirement.id' , $req_id);
		$req_update = $this->db->update('tbl_buyer_post_requirement' , $req_update_array);



		$offer_update_array = array(
          'status' => 'Accepted'
		);
		$this->db->where('tbl_apply_for_requirment.id' , $offer_id);
		$this->db->where('tbl_apply_for_requirment.requirment_id' , $req_id);
		$offer_update = $this->db->update('tbl_apply_for_requirment' , $offer_update_array);



        if($offer_update){

        	/* insert notification */
            $this->db->where('tbl_buyer_post_requirement.id' , $req_id);
            $getreqdetails = $this->master_model->getRecords('tbl_buyer_post_requirement');
            if(isset($getreqdetails[0]['title'])) { $requirement = $getreqdetails[0]['title']; } else { $offer ="Not Available"; }


            $this->db->where('tbl_apply_for_requirment.id' , $offer_id);
            $getofferdetails = $this->master_model->getRecords('tbl_apply_for_requirment');

            $arr_noti  = array(
            'seller_id'          => $getofferdetails[0]['offered_seller_id'],
            'buyer_id'           => $this->session->userdata('user_id'),
            'notification'       => 'Your requirement request of  - <b>'.$requirement.'</b> is accepted.',
            'url'                => base_url().'seller/sent_offer_detail/'.$req_id,
            'details'            => '',
            'created_date'       => date('Y-m-d H:m:s'),
            'status'             =>'Unblock',
            'is_read'            =>'no'
            );
            $this->db->insert('tbl_seller_notifications' , $arr_noti);
            

        	$arr_response['status'] = "success";
	    	$arr_response['msg']    = "You successfully accepted  offer.";
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
    public function closed_requirments()
	{
    	$data['pageTitle']       = 'Closed requirements - '.PROJECT_NAME;
   	    $data['page_title']      = 'Closed requirements - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/buyer-closed-requirement';


        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'closed');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirments']);


        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']          = $Count;
	    $config1['base_url']            = base_url().'buyer/closed_requirments';
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

        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->order_by('tbl_buyer_post_requirement.id' , 'Desc');
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'closed');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments'] = $this->master_model->getRecords('tbl_buyer_post_requirement',FALSE,FALSE,FALSE,$page,$config1["per_page"]);


	    $this->load->view('template',$data);
	}

	public function closed_requirment_detail($req_id=FALSE)
	{
    	$data['pageTitle']       = 'Closed requirements detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Closed requirements detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/buyer-closed-requirement-details';

        $this->db->where('tbl_buyer_post_requirement.buyer_id' , $this->session->userdata('user_id'));
        $this->db->where('tbl_buyer_post_requirement.id' , $req_id);
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'closed');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirmentsDetail']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirmentsDetail']);

        /* offered sellers */ 
        $this->db->where('tbl_apply_for_requirment.requirment_id' , $req_id);
        $this->db->where('tbl_apply_for_requirment.status'   , 'Accepted');
        $this->db->order_by('tbl_apply_for_requirment.id' ,  'desc');
        $this->db->where('tbl_user_master.status'   , 'Unblock');
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

	
	public function contact_to_seller()
	{
		$seller_id    = $this->input->post('seller_id');
		$category_id  = $this->input->post('category_id');
		$product_name = $this->input->post('product_name');
		$country      = $this->input->post('country');
		$description  = $this->input->post('description');
 
		$arr_inq   = array(
		'buyer_id'         => $this->session->userdata('user_id'),
		'seller_id'        => $seller_id,
		'category_id'      => $category_id,
		'product_name'     => $product_name,
		'description'      => $description, 
		'country'          => $country, 
		'posted_date'      => date('Y-m-d H:m:s'),
		'status'           => 'Unblock'
		);

		if($this->db->insert('tbl_seller_contact_inquires' , $arr_inq)){
            $arr_response['status'] = "success";
	    	$arr_response['msg']    = "Your contact request send successfully to this seller.waiting for sellers responce.";
	       	echo json_encode($arr_response);
			exit;
		}
		else {
			$arr_response['status'] = "error";
			$arr_response['msg']    = "Please give permition to upload folder.";
			echo json_encode($arr_response);
			exit;
		}
	}

    public function notifications(){

    	$data['pageTitle']       = 'Buyer notifications - '.PROJECT_NAME;
   	    $data['page_title']      = 'Buyer notifications - '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/notifications';
   	    

        $this->db->where('status' , 'Unblock');
        $this->db->order_by('id' , 'desc');
        $this->db->where('buyer_id' , $this->session->userdata('user_id'));
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_buyer_notifications');
        $Count = count($data['get_notifications']);


   	    /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'buyer/notifications';
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
        $this->db->where('buyer_id' , $this->session->userdata('user_id'));
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_buyer_notifications',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
   	    $this->load->view('template',$data);

    }

    public function notification_details($noti_id=FALSE){

    	$data['pageTitle']       = 'Notifications Detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Notifications Detail- '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/notifications-detail';
   	    

        $this->db->where('status' , 'Unblock');
        $this->db->where('id' , $noti_id);
   	    $data['get_notifications']  = $this->master_model->getRecords('tbl_buyer_notifications');

        $this->db->where('id' , $noti_id);
        $this->db->update('tbl_buyer_notifications',array('is_read' => 'yes'));

        $this->load->view('template',$data);
    }

    public function notification_delete($noti_id=FALSE){

		if($this->master_model->updateRecord('tbl_buyer_notifications',array('status'=>'Delete'),array('id'=>$noti_id)))
	  	{
	  		$this->session->set_flashdata('success','Notification deleted successfully.');
	  		redirect(base_url().'buyer/notifications');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Notification.');
	  		redirect(base_url().'buyer/notifications');
	  	}

	}
	public function rating_for_seller(){
       
		$outputData="";
    	$data_arr=array(
         
             'seller_id'     => $this->input->post('seller_id'),
             'buyer_id'      => $this->session->userdata('user_id'),
             'review_for'    => 'seller',
             'ratings'       => $this->input->post('review_cnt'),
             'comment'       => $this->input->post('txt_comment'),
             'commented_at'  => date('Y-m-d H:m:s'),
             'status'             =>'Unblock',
             'is_read'            =>'no'

    		);
    	$this->db->insert('tbl_seller_rating',$data_arr);
    	$insert_id = $this->db->insert_id(); 	


        /* insert notification */
        $arr_noti  = array(
        'seller_id'          => $this->input->post('seller_id'),
        'buyer_id'           => $this->session->userdata('user_id'),
        'notification'       => $this->session->userdata('user_name').' give review on your profile.',
        'url'                => base_url().'seller/reviews_detail/'.$insert_id,
        'details'            => '',
        'created_date'       => date('Y-m-d H:m:s'),
        'status'             =>'Unblock',
        'is_read'            =>'no'
        );
        $this->db->insert('tbl_seller_notifications' , $arr_noti);
    	echo $outputData="done";
	}
	public function sent_inquiry_detail($inq_id=FALSE)
	{
		$this->master_model->IsLogged();
		if($this->session->userdata('user_type')!='Buyer')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
    	$data['pageTitle']       = 'Inquires Details- '.PROJECT_NAME;
   	    $data['page_title']      = 'Inquires Details- '.PROJECT_NAME;
   	    $data['middle_content']  = 'buyer/sent-inquiries-details';
        
        $this->db->order_by('tbl_seller_contact_inquires.id' , 'desc');
        $this->db->where('tbl_seller_contact_inquires.id' , $inq_id);
        $this->db->where('tbl_seller_contact_inquires.buyer_id' , $this->session->userdata('user_id'));
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_seller_contact_inquires.category_id');
        $data['inquires_detail']  = $this->master_model->getRecords('tbl_seller_contact_inquires');
   
	    $this->load->view('template',$data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success' , 'Logout successfully');
		redirect(base_url().'login');
	}

} //  end class
