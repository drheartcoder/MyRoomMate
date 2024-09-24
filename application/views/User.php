<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
	}
	
	public function dashboard()
	{
		if($this->session->userdata('user_id') ==""){
			redirect(base_url().'home');
		} else {
	        $data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/edit-profile';

	   	    $data['userdata'] = $this->master_model->getRecords('tbl_user_master',array('id'=>trim($this->session->userdata('user_id'))));

	   	    $where = array('is_delete'=>'0','country_status'=>'1');
			$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);

			$where = array('country_id'=> $data['userdata'][0]['nationality'],'is_delete'=>'0','residence_status'=>'1');
			$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);

	   	    $this->load->view('template',$data);
		}
	}

	public function edit()
	{       
		$firstname  		= $this->input->post('firstname');
		$lastname   		= $this->input->post('lastname');
		$username  			= $this->input->post('username');
		$email   			= $this->input->post('email');
		$mobile_number  	= $this->input->post('mobile_number');
		$gender   			= $this->input->post('gender');
		$age   				= $this->input->post('age');
		$nationality   		= $this->input->post('country');
		$countryofresidence = $this->input->post('countryofresidence');
		$address   			= $this->input->post('address');
		
        $arr_Data  =array(
          'firstname'          => $firstname,
          'lastname'           => $lastname,
          'username'           => $username,
          'email'              => $email,
          'mobile_number'      => $mobile_number,
          'gender'             => $gender,
          'age'                => $age,
          'nationality'        => $nationality,
          'countryofresidence' => $countryofresidence,
          'address'            => $address,
        );

		// Update DaTa 
        $this->db->where('id' , $this->session->userdata('user_id'));
        if($this->db->update('tbl_user_master',$arr_Data)) {

	      	$last_inserted_id  =  $this->db->insert_id();

    	    $arr_response['status'] = "success";  
			$arr_response['msg']    = "Profile update successfully.";
			$arr_response['URL']    = base_url().'user/dashboard';
			echo json_encode($arr_response);
			exit;

        } else {

        	$arr_response['status'] = "error";
		    $arr_response['msg']    = "Problem occured please try again";
		    $arr_response['URL']    = base_url().'user/dashboard';
		    echo json_encode($arr_response);
		    exit;
        }
	}
	
	function changepassword()
	{
		if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{
			if(isset($_POST['oldpwd']))
			{

	        	$newpassword      = $this->input->post('newpwd');
	        	$oldpassword      = $this->input->post('oldpwd');

				// For New Password
		        	// encryption system for password (same as joomla)
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $salt = '';
				    for ($i = 0; $i < 32; $i++) {
				    	$salt .= $characters[rand(0, $charactersLength - 1)];
				    }
				    $encrypted_new = md5($newpassword);
				    $encrypted_password = $encrypted_new.':'.$salt;
				    // end encryption
				// New Password Ends

	            $check_old_pass_is_correct = $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id')));

				$get_password = explode( ':',$check_old_pass_is_correct[0]['password']);
				$get_main_password = $get_password[0];

				if($get_main_password != md5($oldpassword) || sizeof($check_old_pass_is_correct) <= 0)
				{
					$arr_response['status'] = "error";
			        $arr_response['msg']    = "Sorry , your old password does not match.";
			       	echo json_encode($arr_response);
					exit;
				}

	        	//$get_current_pass =     $this->master_model->getRecords('tbl_user_master',array('id'=>$this->session->userdata('user_id') ,'password' => sha1($newpassword)));

	        	//if(sizeof($get_current_pass) > 0){
				if(md5($oldpassword) == $encrypted_new){
	        		$arr_response['status'] = "error";
			        $arr_response['msg']    = "Sorry , Please do not enter old password as current password.";
			       	echo json_encode($arr_response);
					exit;
	        	}

	            $arr_Data = array(
	               'password'  => $encrypted_password
		        );

	        	$this->db->where('id' , $this->session->userdata('user_id'));
	            if($this->db->update('tbl_user_master',$arr_Data)){

	                $arr_response['status'] = "success";
	            	$arr_response['msg']    = "Password updated successfully.";
	            	$arr_response['URL']    = base_url().'user/changepassword';
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

			$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/change-password';

	   	    $data['userdata'] = $this->master_model->getRecords('tbl_user_master',array('id'=>trim($this->session->userdata('user_id'))));

	   	    $this->load->view('template',$data);
	   	}
	} // end changepassword

	function mylisting()
	{
		if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{	
			$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/my-listing';

	   	    // before pagination
	   	    $where = array('user_id'=>trim($this->session->userdata('user_id')), 'is_delete' => '0');
	   	    $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);

	   	    $Count = count($data['addlisting']);

	        /* create pagination */
	        $this->load->library('pagination');
	        $config1['total_rows']           = $Count;
	        $config1['base_url']             = base_url().'user/mylisting';
	        $config1['per_page']             = 5;
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

	        // after pagination
	        $this->db->order_by('created_date', 'Desc');
	        $where = array('user_id'=>trim($this->session->userdata('user_id')), 'is_delete' => '0');
	   	    $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where, FALSE, FALSE, $page,$config1["per_page"]);

	   	    $this->load->view('template',$data);
	   	}
	} // end mylisting

	function addlisting()
	{
		if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{

			$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/add-listing';

	   	    //echo "<pre>"; print_r($_SESSION);exit;

	   	    $data['userdata'] = $this->master_model->getRecords('tbl_user_master',array('id'=>trim($this->session->userdata('user_id'))));
	   	    //echo "<pre>"; print_r($data['userdata']);exit;

	   	    $where = array('is_delete'=>'0','country_status'=>'1');
			$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);

			$where = array('country_id' => $data['userdata']['0']['nationality'],'is_delete'=>'0','residence_status'=>'1');
			$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);
			//echo "<pre>"; print_r($data['fetchresidence']);exit;

	   	    $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
			$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

			foreach ($parentcat as $key => $value) {
				
				//$data['fetchcategory'][]   = $value;
				
				$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
				$childcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($childcat as $key => $value) {
		
					$data['fetchcategory'][]   = $value;

					/*$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
					$childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

					foreach ($childchildcat as $key => $value) {
		
						$data['fetchcategory'][]   = $value;
					}*/
				}
			}

			// payment pricing data
			$data['price_data'] = $this->master_model->getRecords('tbl_pricing_master', array('status'=> 1));

			// Terms and Conditions data
			$data['terms_and_conditions'] = $this->master_model->getRecords('tbl_dynamic_pages', array('slug' => 'terms-of-use'));

	   	    $this->load->view('template',$data);
	   	}

	} // end addlisting

	function frombuild()
	{

		$where = array('category_id' => $_POST['catid']);
		$sub_category = $this->master_model->getRecords('tbl_category_master',$where);

		$this->db->order_by('tbl_category_form_fields.orderby','ASC');
		$where = array('tbl_category_form_fields.cat_id'=>$sub_category[0]['parent_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
		$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
		$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

		if(count($catoptions) > 0 ) {
			
			foreach ($catoptions as $key => $value) {
				
				if($value['fields_type'] == 'text') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                        <input displayerror="<?php echo $value['attribute_name']; ?>" type="text" class="input-box" id="<?php echo $value['attribute_slug']; ?>" name="<?php echo $value['attribute_slug']; ?>" ng-model="user.<?php echo $value['attribute_slug']; ?>" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                        <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label><?php echo $value['attribute_name']; ?></label>
                    </div>
                </div>
                <?php 
				}

				if($value['fields_type'] == 'textarea') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  	<div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                        <textarea displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" cols="" class="input-box textarea-txt" rows=""  ng-init="user.<?php echo $value['attribute_slug']; ?>='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur rem beatae fuga tempora'" ng-model="user.<?php echo $value['attribute_slug']; ?>" ng-minlength="5" ng-maxlength="20" required></textarea>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                        <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label><?php echo $value['attribute_name']; ?></label>
                   	</div>
                </div>
                <?php 
				}

				if($value['fields_type'] == 'selectlist') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group input-box-w inner-inpt">
                 <div class="select-bock-container">
                        <select displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>">
                            <option value="">Select <?php echo $value['attribute_name']; ?></option>
                            <?php foreach($options as $opt => $option) { ?>
                              <option class="lavel2" value="<?php echo $option;?>"><?php echo $option;?></option>
                            <?php } ?>
                        </select>
                        <div class="error"></div>
                  </div>
                 </div>
                 </div>
                <?php 
				}

				if($value['fields_type'] == 'file') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group input-box-w">
                      <!--image upload start here-->
                        <div ng-controller="uploadImage">
                             <div class="profile-pic">
                               <div class="row">
                                   <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                   <div class="col-sm-12 col-md-7 col-lg-9">
                                        <input displayerror="<?php echo $value['attribute_name']; ?>" onchange="loadFile(event)" displayerror="<?php echo $value['attribute_name']; ?>" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = 'images/user.png'" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" />
                                        <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> <?php echo $value['attribute_name']; ?></button>
                                        <div class="error"></div>
                                   </div>
                               </div>
                              </div>
                            <!--image upload end here-->
                         </div>
                      </div>

                 </div>
                <?php 
				}

				if($value['fields_type'] == 'radiobutton') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                          	<div class="btns-main">
                            	<?php foreach($options as $opt => $option) { ?>
                              	<div class="radio-btn">
                                	<input displayerror="<?php echo $value['attribute_name']; ?>" id="c-option<?php echo $opt; ?>" name="<?php echo $value['attribute_slug']; ?>" type="radio" value="<?php echo $option;?>"/>
                                	<label for="c-option<?php echo $opt; ?>"> <?php echo $option;?> </label>
                                	<div class="check"></div>
                            	</div>
                            	<?php } ?>
                            	<div class="error"></div>
                          </div>
                     </div>
                 </div>
                <?php 
				}

				if($value['fields_type'] == 'checkbox') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt">
                    	<div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                  		<div class="listing-div innercheckbox">
	                      	<?php foreach($options as $opt => $option) { ?>
	                      	<p class="checkboxs">
	                        <input type="checkbox" class="filled-in" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug'].''.$opt; ?>" value="<?php echo $option;?>"/>
	                        <label for="<?php echo $value['attribute_slug'].''.$opt; ?>"><?php echo $option;?></label>
	                    	</p>
	                      	<?php } ?>                    
	                      	<div class="error"></div>
                		</div>
                 	</div>
             	</div>
                <?php 
				}

			}

		} else {
			echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div id="edit_profile_error" class="error">Not Available</div></div>';
		}


	} // end frombuild

	function addform() 
	{	

		if($_POST['category_name']!="")
		{	

			$user_id      	= $this->session->userdata('user_id');
	        $title        	= $this->input->post('title');
	        $adddescription = $this->input->post('adddescription');
	        $mobilenumber 	= $this->input->post('mobilenumber');
	        $addemail     	= $this->input->post('addemail');
	        $availability   = $this->input->post('availability');

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

					$this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
					$this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
				}
			}
			
			$arr_Data  =array(
				'cat_id'		=> $_POST['category_name'],
				'user_id'		=> $user_id,
				'title'			=> $title,
				'description'	=> $description,
				'mainphoto'		=> $slugvalue_img,
				'mobile'		=> $mobilenumber,
				'email'			=> $addemail,
				'availability'	=> $availability,
				'status'		=> '1',
				'is_delete'		=> '0',
	        );

	        if($this->master_model->insertRecord('tbl_addlisting',$arr_Data)){
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
				}

        	}	
		}

	}

	function getResidence()
	{
		$country_id = $_POST['countryid'];

		$where = array('country_id'=> $country_id,'is_delete'=>'0','residence_status'=>'1');
		$fetchcresidence = $this->master_model->getRecords('tbl_residence_master',$where);

		$select = '<option value="">Select City</option>';
		foreach ($fetchcresidence as $key => $value) {

			$select .= '<option value="'.$value['residence_id'].'">'.$value['residence_name'].'</option>';
		}

		echo $select;
	}

	/*
    | Function : Get Data according to id passed
    | Author : Deepak Arvind Salunke
    | Date   : 26/04/2017
    | Output: Display Listing Details 
    */

	function mylisting_details()
	{
		$mylisting_slug = $this->uri->segment(3);

		$data['pageTitle']       = 'User - '.PROJECT_NAME;
   	    $data['page_title']      = 'User - '.PROJECT_NAME;
   	    $data['middle_content']  = 'user/mylisting-details';

   	    $data['mylisting_details'] = $this->master_model->getRecords('tbl_addlisting',array('slug'=>trim($mylisting_slug)));

   	    if(!empty($data['mylisting_details'][0]['id']))
   	    {
   	    	$detail_id = $data['mylisting_details'][0]['id'];
   	    }
   	    else
   	    {
            $detail_id = '';
   	    }

   	    if(!empty($data['addlisting'][0]['cat_id']))
        {
            $get_listing_cat_id = $data['addlisting'][0]['cat_id'];
        }
        else
        {
            $get_listing_cat_id = '';
        }

   	    $data['mylisting_data'] = $this->master_model->getRecords('tbl_addlisting_data',array('listing_id'=>trim($detail_id)));

   	    //echo "<pre>";print_r($data['mylisting_data']);exit();

   	    // count number of favorite
        $data['favorite_data'] = $this->master_model->getRecords('tbl_myfavorite', array('addlisting_id'=>trim($get_listing_cat_id)));

        $data['nos_favorite'] = count($data['favorite_data']);
        //echo "<pre>"; print_r($data['nos_favorite']);exit;

   	    // Similar Listings slider
        $where_arr = array('status' => 1, 'is_delete' => '0', 'cat_id' => $get_listing_cat_id, 'id !=' => $detail_id);
        $this->db->order_by("id","desc");
        $this->db->limit(10);
        $data['similarlisting'] = $this->master_model->getRecords('tbl_addlisting', $where_arr);
        //echo "<pre>"; print_r($data['similarlisting']);exit;

   	    $this->load->view('template',$data);
	} // end mylisting_details function

	/*
    | Function : Get all the Favorite products of users
    | Author : Deepak Arvind Salunke
    | Date   : 26/04/2017
    | Output: Display User Favorite Listings
    */

    function myfavorite()
    {
    	if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{
	    	// Get login User id
	    	$login_user_id = trim($this->session->userdata('user_id'));

	    	// Before Pagination

	    	$where_arr = array('tbl_myfavorite.user_id' => $login_user_id, 'tbl_addlisting.status' => 1);
			$select = 'tbl_addlisting.*,
			           tbl_myfavorite.addlisting_id, tbl_myfavorite.id as myfavorite_id';

			$this->db->join('tbl_myfavorite', 'tbl_myfavorite.addlisting_id = tbl_addlisting.id');
			$data['myfavorite_data'] = $this->master_model->getRecords('tbl_addlisting', $where_arr, $select);
			
			if(count($data['myfavorite_data']) > 0)
			{
				$data['myfavorite_details'] = $this->master_model->getRecords('tbl_addlisting_data', array('listing_id'=>trim($data['myfavorite_data'][0]['id'])));
			}

			$Count = count($data['myfavorite_data']);

	        /* create pagination */
	        $this->load->library('pagination');
	        $config1['total_rows']           = $Count;
	        $config1['base_url']             = base_url().'user/myfavorite';
	        $config1['per_page']             = 5;
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

			// After Pagination
			$this->db->order_by('created_date', 'Desc');
			$where_arr = array('tbl_myfavorite.user_id' => $login_user_id, 'tbl_addlisting.status' => 1);
			$select = 'tbl_addlisting.*,
			           tbl_myfavorite.addlisting_id, tbl_myfavorite.id as myfavorite_id';

			$this->db->join('tbl_myfavorite', 'tbl_myfavorite.addlisting_id = tbl_addlisting.id');
			$data['myfavorite_data'] = $this->master_model->getRecords('tbl_addlisting', $where_arr, $select, FALSE, $page,$config1["per_page"]);
			//echo "<pre>";print_r($data['myfavorite_data']);exit;

	    	$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/myfavorite';

	   	    $this->load->view('template', $data);
	   	}
    } // end myfavorite function

    /*
    | Function : Delete favorite product
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Success or Failure
    */

    function del_myfavorite()
    {
    	$myfavorite_id = base64_decode($this->uri->segment(3));
    	//echo $myfavorite_id;exit();
    	if($myfavorite_id != '')
    	{
    		$this->master_model->deleteRecord('tbl_myfavorite',array('id'=>$myfavorite_id));
    	}
    	redirect(base_url().'user/myfavorite');
    } // end del_myfavorite function

    /*
    | Function : Get all the Inquire form database
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Display Inquire form
    */

    function received_inquiry()
    {
    	if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{
	    	$login_user_id = trim($this->session->userdata('user_id'));

	    	// before pagination
	    	$where_arr = array('tbl_user_master.id' => $login_user_id);
			$select = 'tbl_contact_inquiries.*,
			           tbl_addlisting.id as listing_id, tbl_addlisting.user_id as listing_user_id,
			           tbl_user_master.id as user_master_id';

			$this->db->join('tbl_addlisting', 'tbl_addlisting.id = tbl_contact_inquiries.addlisting_id');
			$this->db->join('tbl_user_master', 'tbl_user_master.id = tbl_addlisting.user_id');
			$data['inquiry_data'] = $this->master_model->getRecords('tbl_contact_inquiries', $where_arr, $select);

			$Count = count($data['inquiry_data']);

	        /* create pagination */
	        $this->load->library('pagination');
	        $config1['total_rows']           = $Count;
	        $config1['base_url']             = base_url().'user/received_inquiry';
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

	    	// after pagination
	    	$this->db->order_by('date_time', 'Desc');
	    	$where_arr = array('tbl_user_master.id' => $login_user_id);
			$select = 'tbl_contact_inquiries.*,
			           tbl_addlisting.id as listing_id, tbl_addlisting.user_id as listing_user_id,
			           tbl_user_master.id as user_master_id';

			$this->db->join('tbl_addlisting', 'tbl_addlisting.id = tbl_contact_inquiries.addlisting_id');
			$this->db->join('tbl_user_master', 'tbl_user_master.id = tbl_addlisting.user_id');
			$data['inquiry_data'] = $this->master_model->getRecords('tbl_contact_inquiries', $where_arr, $select, FALSE, $page,$config1["per_page"]);

	    	$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/received_inquiry';

	   	    $this->load->view('template', $data);
	   	}
    } // end received_inquiry function

    /*
    | Function : Get Received Inquire view details
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Display Received Inquire View
    */

	function received_inquiry_view()
    {
    	if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		}
		else
		{
	    	$contact_id = base64_decode($this->uri->segment(3));

	    	$where_arr = array('contact_id' => $contact_id);
	    	$data['inquiry_view_data'] = $this->master_model->getRecords('tbl_contact_inquiries', $where_arr);

	    	/*echo $this->db->last_query();
	    	echo "<pre>"; print_r($data['inquiry_view_data']);exit();*/

	    	$data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/received_inquiry_view';

	   	    $this->load->view('template', $data);
	   	}
    } // end received_inquiry_view function

    /*
    | Function : Delete Recevied Inquiry
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Success or Failure
    */

    function delete_received_inquiry()
    {
    	$contact_id = base64_decode($this->uri->segment(3));

    	if($contact_id != '')
    	{
    		$this->master_model->deleteRecord('tbl_contact_inquiries',array('contact_id'=>$contact_id));
    	}
    	redirect(base_url().'user/received_inquiry');
    } // end delete_received_inquiry function

    /*
    | Function : Check whether Payment for Card and Paypal is done and store add listing data in database
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Success or Failure
    */

    function payment()
    {	
    	$this->load->model('callerservice');
		/*echo "<pre>";
    	print_r($_POST);
    	echo "</pre>";
    	exit();*/

    	$user_id      				= $this->session->userdata('user_id');

		$cat_id						= $this->input->post('category_name');
        $title        				= preg_replace('/[^A-Za-z0-9-]/', '', $this->input->post('title'));
        $description    			= $this->input->post('adddescription');
        $mobilenumber 				= $this->input->post('mobilenumber');
        $addemail     				= $this->input->post('addemail');
        $country     				= $this->input->post('country');
        $countryofresidence     	= $this->input->post('countryofresidence');
        $address     				= $this->input->post('address');
        $price 						= number_format($this->input->post('price'), 2, '.', '');
        $availability   			= $this->input->post('availability');
        $payment 					= $this->input->post('payment');
        $card_type					= $this->input->post('card_type');
        $cc_number					= $this->input->post('cc_number');
        $cc_exp						= $this->input->post('cc_exp');
        $cc_cvc						= $this->input->post('cc_cvc');

        // create slug
        $listing_slug = $this->master_model->create_slug($title,'tbl_addlisting','slug');

        // check if slug is already present in database
        $where = array('slug' => $listing_slug);
        $check_slug = $this->master_model->getRecords('tbl_addlisting', $where);

        // if slug is already present in database
        if( count($check_slug) > 0 )
        {
        	// get the last id
        	$this->db->from('tbl_addlisting')->select('id')->order_by('id', 'DESC')->limit('1');
    		$get = $this->db->get();
        	foreach($get->result_array() as $last_id)
        	{
        		$last_id_val = $last_id['id'];
        	}
        	// increment id with 1 from last id present in database
        	$listing_slug = $listing_slug.'-'.($last_id_val + 1);
        }

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

				$this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
				$this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
			} // end if
			else
			{
				$this->session->set_flashdata('error',"Error while uploading image . Please try again later.");
				redirect(base_url().'user/addlisting');
				exit();
			} // end else
		} // end if
		else
		{
			$this->session->set_flashdata('error',"Error while uploading image . Please try again later.");
			redirect(base_url().'user/addlisting');
			exit();
		} // end else

		// Listing data
		$arr_Data  =array(
				'cat_id'				=> $cat_id,
				'user_id'				=> $user_id,
				'title'					=> $title,
				'slug'					=> $listing_slug,
				'description'			=> $description,
				'mainphoto'				=> $slugvalue_img,
				'mobile'				=> $mobilenumber,
				'email'					=> $addemail, 
				'country' 				=> $country,
				'countryofresidence' 	=> $countryofresidence,
				'address' 				=> $address,
				'price'					=> $price,
				'availability'			=> $availability,
				'status'				=> '1',
				'is_delete'				=> '0',
	        );
		
		// for free account where data is directly inserted into database
    	if($payment == 'Free') 
    	{
	        $arr_Data['status'] = '0';
	        $arr_Data['payment_type'] = 'free';

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

	    		/*$this->session->set_flashdata('success',"Listing has been submitted and has been published. <br/> Please note that images and content will be moderated and should comply with our terms and conditions. If any part of the listing does not comply, it will be removed.");*/

	    		$this->session->set_flashdata('success',"Listing added successfully. To add more images, go to the listing and click on the Image Icon.");

	            redirect(base_url().'user/addlisting');
	            exit();

        	} // end if

        	else
        	{
        		$this->session->set_flashdata('error',"Something went wrong.");
        		redirect(base_url().'user/addlisting');
        		exit();
        	} // end else

    	} // end if

    	// for paid accounts to check payment and insert data
    	else 
    	{    		
	        $arr_Data['payment_type'] = 'paid';

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

				// if Card Payment is Successful
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

			        		// insert data for extra fields which are add through listing data 
			        		$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

						} // end foreach

		        	} // end if

					$transaction_arr = array('user_id'			=> $user_id,
											 'listing_id'		=> $last_inserted_id,
											 'transaction_id'   => $resArray['TRANSACTIONID'],
											 'transaction_price'=> $resArray['AMT'],
											 'payment_status'	=> 'complete',
											 'payment_date'		=> date('Y-m-d H:i:s'),
											 'pament_type'		=> 'credit_card');

					if($this->master_model->insertRecord('tbl_addlisting_transection', $transaction_arr))
					{						
						$this->session->set_flashdata('success',"Your Payment Completed Successfully. <br/> Listing has been submitted and has been published. <br/> Please note that images and content will be moderated and should comply with our terms and conditions. If any part of the listing does not comply, it will be removed.");
						redirect(base_url().'user/addlisting');
						exit();
					} // end if

				} // end if

				// if Payment Fails
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
    			// Insert listing data
                if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
		        {
	        		$last_addlisting_inserted_id  =  $this->db->insert_id();

	        		// to pass last listing id to 'paypal_success' function
	        		$this->session->set_userdata('last_listing_id' , $last_addlisting_inserted_id);

	        		$where = array('tbl_category_form_fields.cat_id'=>$_POST['category_name']);
					$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');

					$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

					foreach ($catoptions as $key => $value) {
					
						$arr_Addlistdata  =array(
							'listing_id'      => $last_addlisting_inserted_id,
							'attribute_id'    => $value['attribute_id'],
							'attribute_slug'  => $value['attribute_slug'],
							'attribute_value' => $_POST[$value['attribute_slug']],
				        );

		        		// insert data for extra fields which are add through listing data 
		        		$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

					} // end foreach

	        	} // end if

    			$currencyCode    = 'USD';
				$final_price     = $payment;
				$offer_title 	 = $title;
				// if paypal payment is success then redirect to
				//$this->paypal_success($arr_Data);
				$returnUrl       = base_url().'user/paypal_success?totalAmt='.$final_price;
				// if paypal payment is failed then redirect to
				$cancelUrl       = base_url().'user/addlisting';
				$nvpstr          = "";

				$nvpstr.="&PAYMENTREQUEST_0_AMT=".$final_price."&PAYMENTREQUEST_0_PAYMENTACTION=Sale&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&L_PAYMENTREQUEST_0_NAME0=".$offer_title."&L_PAYMENTREQUEST_0_DESC0=".$offer_title."&&L_PAYMENTREQUEST_0_AMT0=".$final_price."&L_PAYMENTREQUEST_0_QTY0=1";

				$resArray = $this->callerservice->hash_call('SetExpressCheckout',$nvpstr);

				// Check Paypal Payment Success Or Failure
	    		if(isset($resArray["ACK"]))
		    	{
		    		$ack = strtoupper($resArray["ACK"]);
			    	if($ack=="SUCCESS")
			    	{
			     		$token = urldecode($resArray["TOKEN"]);
			   	    	$payPalURL = PAYPAL_URL.$token;
			   	    	// redirect to paypal page for transaction
			   	    	redirect($payPalURL);
			    	}
			    	else
			    	{
			    		$errorType=$resArray["L_LONGMESSAGE0"];

		        		// delete last inserted data
		        		$this->master_model->deleteRecord('tbl_myfavorite',array('id'=>$last_addlisting_inserted_id));
		        		// delete last inserted data
		        		$this->master_model->deleteRecord('tbl_addlisting_data',array('listing_id'=>$last_addlisting_inserted_id));

			    		$this->session->set_flashdata('error',"Error . Please try again later.");
			    		exit();
					}
			    }

    		} // end else if

    		else
    		{
    			$this->session->set_flashdata('error',"Something went wrong . Please try again later.");
				redirect(base_url().'user/addlisting');
				exit();
    		} // end else

    	} // end if else

    	/*$this->session->set_flashdata('error',"Something Wrong . Please try again later.");
    	redirect(base_url().'user/addlisting');
    	exit();*/
    	
    } // end payament function

    /*
    | Function : insert Transaction details after paypal successful payment
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Success or Failure
    */

    public function paypal_success()
	{ 
		/*echo "<pre>"; print_r($this->session->all_userdata()); die;*/
		
		/*print_r ($arr_Data);exit;*/
		$this->load->model('callerservice');

		$final_price	  = $this->input->get('totalAmt');

		$transaction_amt  = $final_price;
		$currencyCode     = 'USD';
		$returnUrl        = base_url().'user/addlisting';
		$cancelUrl        = base_url().'user/addlisting';
		$nvpstr           = "";

		$nvpstr.="&PAYMENTREQUEST_0_AMT=".$transaction_amt."&PAYMENTREQUEST_0_PAYMENTACTION=SALE&PAYMENTREQUEST_0_CURRENCYCODE=".$currencyCode."&returnUrl=".$returnUrl."&cancelUrl=".$cancelUrl."&TOKEN=".$_GET['token'].'&PAYERID='.$_GET['PayerID'];
		
		$resArray=$this->callerservice->hash_call('DoExpressCheckoutPayment',$nvpstr);
		/*echo "<pre>"; print_r($resArray['ACK']); die;*/
		if($resArray['ACK']=="Success")
		{
			$transaction_arr = array('transaction_id'   => $resArray['PAYMENTINFO_0_TRANSACTIONID'],
									 'user_id'	    	=> $this->session->userdata('user_id'),
									 'transaction_price'=> $resArray['PAYMENTINFO_0_AMT'],
									 'listing_id'       => $this->session->userdata('last_listing_id'),
									 'payment_status'	=> 'complete',
									 'payment_date'		=> date('Y-m-d H:i:s'),
									 'pament_type'		=> 'paypal');

			if($this->master_model->insertRecord('tbl_addlisting_transection',$transaction_arr))
			{	$this->db->where('id',1);
			$email_info=$this->master_model->getRecords('admin_login');
			if(isset($email_info) && sizeof($email_info)>0)
			{ 
				/* Mail To  Admin */
				$admin_contact_email=$email_info[0]['admin_email'];


				$user_email = $user_firstname = '';
				if($this->session->userdata('user_email') != '')
				{
					$user_email = $this->session->userdata('user_email');
				}
				if($this->session->userdata('user_firstname') != '')
				{
					$user_firstname = $this->session->userdata('user_firstname');
				}
				
				$other_info =array(
				  				/*"name"               => $name,*/
				  				"email"                 => $user_email,
				  				"user_firstname"	   => $user_firstname,
				  				//"subject"            => $subject,
				  				//"mobile_no"          => $mobile_no,
				  				/*"message"            => $message,*/

	  			);
	  			//print_r($other_info);exit;
	  			$info_arr   =array(
						        'from'    		     => $user_email,
						        'to'	 	         => $admin_contact_email,
						        'subject'	         => 'Payment Notification Mail - '.PROJECT_NAME,
						        'view'		         => 'payment-mail-to-admin'
				);
	  			
	  			$this->email_sending->sendmail($info_arr,$other_info);

	  			 $other_info_user=array(
				  				
				  				"email"              => $user_email,
				  				//"subject"            => $subject,
				  				//"mobile_no"          => $mobile_no,
				  				"user_firstname"      => $user_firstname,
				  			
	  			);
	  			/*print_r($other_info_user);exit;*/
	  			$info_arr_user  =array(
								'from' 		         => $admin_contact_email,
								'to'		         => $user_email,
								'subject'	         => 'Payment Notification Mail -'. PROJECT_NAME,
								'view'		         => 'payment-mail-to-user'
				);
				$this->email_sending->sendmail($info_arr_user,$other_info_user);

	  		}
				$this->session->unset_userdata('last_listing_id');


				$this->session->set_flashdata('success',"Your Payment Completed Successfully. <br/> Listing has been submitted and has been published. <br/> Please note that images and content will be moderated and should comply with our terms and conditions. If any part of the listing does not comply, it will be removed.");
				redirect(base_url().'user/addlisting');
                exit;

			}
		}
		else if($resArray['ACK']=="Failure")
		{
		   $this->session->unset_userdata('last_listing_id');
           $this->session->set_flashdata('error',"there . Please try again later.");
           redirect(base_url().'user/addlisting');
	       exit;
		}
	} // end paypal_success

	/*
    | Function : Delete My Listing
    | Author : Deepak Arvind Salunke
    | Date   : 01/05/2017
    | Output: Success or Failure
    */

    function delete_mylisting()
    {
    	$mylisting_id = base64_decode($this->uri->segment(3));

    	if($mylisting_id != '')
    	{
    		$where = array('id' => $mylisting_id);
    		$this->master_model->updateRecord('tbl_addlisting', array('is_delete' => '1'), $where);
    		//echo $this->db->last_query();exit;
    	}
    	redirect(base_url().'user/mylisting');
    } // end delete_mylisting function

    /*
    | Function : get data from database for Edit My Listing
    | Author : Deepak Arvind Salunke
    | Date   : 01/05/2017
    | Output: Display listing database for particular item
    */

    function edit_mylisting()
    {
    	if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		} // end if
		else
		{
	    	if($this->uri->segment(3) != '')
	    	{

		    	$mylisting_slug = $this->uri->segment(3);

		   	    $data['userdata'] = $this->master_model->getRecords('tbl_user_master',array('id'=>trim($this->session->userdata('user_id'))));

		   	    $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
				$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($parentcat as $key => $value) {
					
					$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
					$childcat = $this->master_model->getRecords('tbl_category_master',$where);

					foreach ($childcat as $key => $value) {

						$data['fetchcategory'][]   = $value;
						
						/*$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
						$childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

						foreach ($childchildcat as $key => $value) {
			
							$data['fetchcategory'][]   = $value;

							//echo "<pre>"; print_r($value); exit;
						}*/
					}
				}

		   	    $where = array('slug' => $mylisting_slug);
		   	    $addlisting = $this->master_model->getRecords('tbl_addlisting', $where);

		   	    if( count($addlisting) > 0 )
		   	    {
		   	    	$data['mylisting_data'] = $addlisting;
		   	    }

		   	    $where = array('is_delete'=>'0','country_status'=>'1');
				$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);

				$where = array('country_id' => $data['mylisting_data']['0']['country'],'is_delete'=>'0','residence_status'=>'1');
				$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);
				//echo "<pre>"; print_r($data['mylisting_data']);exit;

		   	    $this->db->order_by('tbl_category_form_fields.orderby','ASC');
				$where = array('tbl_category_form_fields.cat_id'=>$data['mylisting_data'][0]['cat_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
				$this->db->join('tbl_addlisting_data' , 'tbl_addlisting_data.attribute_id=tbl_category_form_fields.attribute_id AND tbl_addlisting_data.listing_id='.$data['mylisting_data'][0]['id']);
				$data['catoptions'] = $this->master_model->getRecords('tbl_category_form_fields',$where);

				/*echo "<pre>";
		   	    print_r($data['mylisting_data']);
		   	    print_r($data['catoptions']);
		   	    echo "</pre>";
		   	    exit;*/

	   		} // end if

	   	    $data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/edit_mylisting';

	   	    $this->load->view('template', $data);
   		} // end else
    }

    /*
    | Function : get form structure data from database for Edit My Listing
    | Author : Deepak Arvind Salunke
    | Date   : 02/05/2017
    | Output: Display form structure for particular item in Edit My Listing
    */

    function edit_frombuild()
	{
		$this->db->order_by('tbl_category_form_fields.orderby','ASC');
		$where = array('tbl_category_form_fields.cat_id'=>$_POST['catid'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
		$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
		$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

		if(count($catoptions) > 0 ) {
			
			foreach ($catoptions as $key => $value) {
				
				if($value['fields_type'] == 'text') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                        <input displayerror="<?php echo $value['attribute_name']; ?>" type="text" class="input-box" id="<?php echo $value['attribute_slug']; ?>" name="<?php echo $value['attribute_slug']; ?>" ng-model="user.<?php echo $value['attribute_slug']; ?>" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                        <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label><?php echo $value['attribute_name']; ?></label>
                    </div>
                </div>
                <?php 
				}

				if($value['fields_type'] == 'textarea') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  	<div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                        <textarea displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" cols="" class="input-box textarea-txt" rows=""  ng-init="user.<?php echo $value['attribute_slug']; ?>='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur rem beatae fuga tempora'" ng-model="user.<?php echo $value['attribute_slug']; ?>" ng-minlength="5" ng-maxlength="20" required></textarea>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                        <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label><?php echo $value['attribute_name']; ?></label>
                   	</div>
                </div>
                <?php 
				}

				if($value['fields_type'] == 'selectlist') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                 <div class="form-group input-box-w inner-inpt">
                 <div class="select-bock-container">
                        <select displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>">
                            <option value="">Select <?php echo $value['attribute_name']; ?></option>
                            <?php foreach($options as $opt => $option) { ?>
                              <option class="lavel2" value="<?php echo $option;?>"><?php echo $option;?></option>
                            <?php } ?>
                        </select>
                        <div class="error"></div>
                  </div>
                 </div>
                 </div>
                <?php 
				}

				if($value['fields_type'] == 'file') {
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group input-box-w">
                      <!--image upload start here-->
                        <div ng-controller="uploadImage">
                             <div class="profile-pic">
                               <div class="row">
                                   <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                   <div class="col-sm-12 col-md-7 col-lg-9">
                                        <input displayerror="<?php echo $value['attribute_name']; ?>" onchange="loadFile(event)" displayerror="<?php echo $value['attribute_name']; ?>" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = 'images/user.png'" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" />
                                        <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> <?php echo $value['attribute_name']; ?></button>
                                        <div class="error"></div>
                                   </div>
                               </div>
                              </div>
                            <!--image upload end here-->
                         </div>
                      </div>

                 </div>
                <?php 
				}

				if($value['fields_type'] == 'radiobutton') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                          	<div class="btns-main">
                            	<?php foreach($options as $opt => $option) { ?>
                              	<div class="radio-btn">
                                	<input displayerror="<?php echo $value['attribute_name']; ?>" id="c-option<?php echo $opt; ?>" name="<?php echo $value['attribute_slug']; ?>" type="radio" value="<?php echo $option;?>"/>
                                	<label for="c-option<?php echo $opt; ?>"> <?php echo $option;?> </label>
                                	<div class="check"></div>
                            	</div>
                            	<?php } ?>
                            	<div class="error"></div>
                          </div>
                     </div>
                 </div>
                <?php 
				}

				if($value['fields_type'] == 'checkbox') {
				$options =  explode('|', $value['fields_elements']);	
				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt">
                    	<div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                  		<div class="listing-div innercheckbox">
	                      	<?php foreach($options as $opt => $option) { ?>
	                      	<p class="checkboxs">
	                        <input type="checkbox" class="filled-in" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug'].''.$opt; ?>" value="<?php echo $option;?>"/>
	                        <label for="<?php echo $value['attribute_slug'].''.$opt; ?>"><?php echo $option;?></label>
	                    	</p>
	                      	<?php } ?>                    
	                      	<div class="error"></div>
                		</div>
                 	</div>
             	</div>
                <?php 
				}

			}

		} else {
			echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div id="edit_profile_error" class="error">Not Available</div></div>';
		}


	} // end edit_frombuild

	/*
    | Function : update data for My Listing
    | Author : Deepak Arvind Salunke
    | Date   : 02/05/2017
    | Output: Success or Failure
    */

	function update_mylisting()
	{
		if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		} // end if
		else
		{
			$user_id      		= $this->session->userdata('user_id');
			$listing_id 		= $this->input->post('listing_id');
			$cat_id				= $this->input->post('category_name');
	        $title        		= preg_replace('/[^A-Za-z0-9-]/', '', $this->input->post('title'));
	        $description    	= $this->input->post('description');
	        $mobilenumber 		= $this->input->post('mobilenumber');
	        $email     			= $this->input->post('email');
	        $country     		= $this->input->post('country');
	        $countryofresidence = $this->input->post('countryofresidence');
	        $address     		= $this->input->post('address');
	        $price     			= $this->input->post('price');
	        $availability   	= $this->input->post('availability');
	        $formData			= $this->input->post('formData');
	        //echo json_encode($formData);exit;

	        // create slug
	        //$listing_slug = $this->master_model->create_slug($title,'tbl_addlisting','slug');

	        /* Check Image Uploaded or not */
			$config=array(
				'upload_path'=>'uploads/addlisting_images',
				'allowed_types'=>'jpg|jpeg|png',
				'file_name'=>rand(1,9999999),
				'max_size'=>5120
				);

			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$slugvalue_img = $this->input->post('img_value');

			if(isset($_FILES['mainphoto']) && $_FILES['mainphoto']['error']==0)
			{
				if($this->upload->do_upload('mainphoto'))
				{
					$dt=$this->upload->data();
					$file=$dt['file_name'];
					$slugvalue_img = $file;

					$this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
					$this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
				} // end if
				else
				{
					$arr_response['status'] = "error";
				    $arr_response['msg']    = "Error while uploading image . Please try again later.";
				    $arr_response['URL']    = base_url().'user/mylisting';
				    /*echo json_encode($arr_response);
				    exit;*/
				} // end else
			} // end if
			else
			{
				$arr_response['status'] = "error";
			    $arr_response['msg']    = "Error while uploading image . Please try again later.";
			    $arr_response['URL']    = base_url().'user/mylisting';
			    /*echo json_encode($arr_response);
			    exit;*/
			} // end else

			// Listing data
			$arr_Data  =array(
					'id' 		  			=> $listing_id,
					'cat_id'      			=> $cat_id,
					'user_id'     			=> $user_id,
					'title'    	  			=> $title,
					//'slug'		  		=> $listing_slug,
					'description' 			=> $description,
					'mainphoto'   			=> $slugvalue_img,
					'mobile'      			=> $mobilenumber,
					'email'       			=> $email,
					'country'       		=> $country,
					'countryofresidence'    => $countryofresidence,
					'address'       		=> $address,
					'price'       			=> $price,
					'availability'			=> $availability,
					'status'      			=> '1',
					'is_delete'   			=> '0',
		        );

			//echo "<pre>"; print_r($arr_Data);exit;

			// Update Data 
	        $this->db->where('id' , $listing_id);
	        if($this->db->update('tbl_addlisting',$arr_Data))
	        {
	    	    // delete all the data related to this listing id
	    	    $where = array('listing_id' => $listing_id);
	    	    $count_query = $this->master_model->getRecordCount('tbl_addlisting_data', $where);
	    	    //echo $count_query;exit();
	    	    if( $count_query > 0)
	    	    {
	    	    	//$where = array('listing_id' => $listing_id);
	    	    	$this->master_model->deleteRecord('tbl_addlisting_data', 'listing_id', $listing_id);
	    	    }

	        	$where = array('tbl_category_form_fields.cat_id'=>$cat_id);
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');

				$catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

				foreach ($catoptions as $key => $value) {
					$arr_Addlistdata  =array(
						'listing_id'      => $listing_id,
						'attribute_id'    => $value['attribute_id'],
						'attribute_slug'  => $value['attribute_slug'],
						'attribute_value' => $_POST[$value['attribute_slug']],
			        );

        			$this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);
	        	}

	        	$arr_response['status'] = "success";
			    $arr_response['msg']    = "Listing update Successfully!";
	    	    $arr_response['URL']    = base_url().'user/mylisting';
	        }
	        else
	        {
	        	$arr_response['status'] = "error";
			    $arr_response['msg']    = "Error while uploading image . Please try again later.";
	        	$arr_response['URL']    = base_url().'user/mylisting';
	        }
	        echo json_encode($arr_response);
			exit;
		} //  end else
	} // end update_mylisting



	public function my_image($img_slug = FALSE)
	{

		if ( $this->session->userdata('user_id') == "" )
		{
			redirect(base_url().'home');
		} // end if
		else
		{
			if(isset($_POST['uplod_img']))
			{
	         
	            $where = array('slug' => $this->input->post('listing_id'));
	            $addlisting = $this->master_model->getRecords('tbl_addlisting', $where);
	            
	            $listing_id = $addlisting[0]['id'];
	            $img_slug = $this->input->post('listing_id');
	           
				$valCount	= count($_FILES['sv_image']['name']);
				
		            			for($i = 0; $i < $valCount; $i++)
		            			{

		            				$_FILES['userFile']['name']     = $_FILES['sv_image']['name'][$i];
					                $_FILES['userFile']['type']     = $_FILES['sv_image']['type'][$i];
					                $_FILES['userFile']['tmp_name'] = $_FILES['sv_image']['tmp_name'][$i];
					                $_FILES['userFile']['error']    = $_FILES['sv_image']['error'][$i];
					                $_FILES['userFile']['size']     = $_FILES['sv_image']['size'][$i];

		                            $uploadPath = 'uploads/addlisting_images/';
					                $config['upload_path']   = $uploadPath;
					                $config['allowed_types'] = 'gif|jpg|png';

					                
		            				$this->load->library('upload',$config);
									$this->upload->initialize($config); 
									
									if($this->upload->do_upload('userFile'))
									{
										$dt=$this->upload->data();
										$file= $dt['file_name'];
										$image[] = $file;
										
									}
									else
									{
										$this->session->set_flashdata('error',$this->upload->display_errors());
										redirect(base_url().'user/my_image/'.$img_slug);
										
										exit;
									}
									
								}

								foreach ($image as $value) 
									{

										$img_arr = array(
										'listing_id'=> $listing_id,
		                                 'image' => $value
										);
										$this->master_model->insertRecord('tbl_addimage_data',$img_arr);
									}
								$this->session->set_flashdata('success'," Images added successfully.");
								redirect(base_url().'user/my_image/'.$img_slug);
				}
			$data['img_slug'] = $img_slug;



	   	    $data['pageTitle']       = 'User - '.PROJECT_NAME;
	   	    $data['page_title']      = 'User - '.PROJECT_NAME;
	   	    $data['middle_content']  = 'user/my-images';

	   	    $this->load->view('template', $data);

		    //$this->load->view('user/my-images',$data);
		}
	}//end my_image


} //  end class
?>