<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}

	/* subcategory listing and added the links for  add/update/delete/block/unbloack */
    public function manage()
	{
		$data['pageTitle']  = 'Users';
	   	$data['page_title'] = 'Users';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count =count($_REQUEST['checkbox_del']);
			$action       =$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
			   		$this->session->set_flashdata('success','Record(s) deleted successfully.');
					$this->master_model->updateRecord('tbl_user_master',array('status'=>'Delete'),array('id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'users/manage/');
			}
			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_user_master',array('status'=>'Block'),array('id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'users/manage/');
			}
			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_user_master',array('status'=>'Unblock'),array('id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'users/manage/');
			}
	   	}

	   	if($_REQUEST['usersearch']!="") { 
	   		$this->db->like('firstname', $_REQUEST['usersearch'], 'both');
	   		$this->db->or_like('lastname', $_REQUEST['usersearch'], 'both');
	   	}
	   	$this->db->where('status !=','Delete');
	   	$this->db->where('verification_status','Verified');
		$data['fetchusers']   = $this->master_model->getRecords('tbl_user_master',FALSE,FALSE,array('id','DESC'));
		//echo $this->db->last_query();

        $Count = count($data['fetchusers']);

		/* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;

	    $config1['first_url']            = $_SERVER['QUERY_STRING']!="" ? base_url('admin/users/manage').'/?'.$_SERVER['QUERY_STRING'] : base_url('admin/users/manage');
        $config1['suffix']               = "/?".$_SERVER['QUERY_STRING'];

	    $config1['base_url']             = base_url().'admin/users/manage/';
	    $config1['per_page']             = 15;
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

	    if($_REQUEST['usersearch']!="") { 
	   		$this->db->like('firstname', $_REQUEST['usersearch'], 'both');
	   		$this->db->or_like('lastname', $_REQUEST['usersearch'], 'both');
	   	}
	    $this->db->where('status !=','Delete');
	   	$this->db->where('verification_status','Verified');
		$data['fetchusers']   = $this->master_model->getRecords('tbl_user_master',FALSE,FALSE,array('id','DESC'),$page,$config1["per_page"]);

        /*echo "<pre>";
        print_r($data['fetchusers'][0][email]);
        exit;*/
           
		$data['middle_content'] ='users/manage-users';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Subcategory Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success'] = $data['error']='';
		$input_array     = array('status'=>$sts);

		if($this->master_model->updateRecord('tbl_user_master',$input_array,array('id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'users/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'users/manage');
		}
	}

	/*Subcategory Delete Function Start Here*/
	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_user_master',array('status'=>'Delete'),array('id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Seller deleted successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'users/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting seller.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'users/manage');
	  	}
	}

	public function edit($id="")
	{
		$data['pageTitle']  = 'Edit User';
	   	$data['page_title'] = 'Edit User';
	   	$data['middle_content'] ='users/edit-users';	
	   	$user_id 			=  $id;
	   	$data['user_info']  = $this->master_model->getRecords('tbl_user_master',array('id'=>$id));

	   $where = array('is_delete'=>'0','country_status'=>'1');
	   $data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);

	   $where = array('country_id'=> $data['user_info'][0]['nationality'],'is_delete'=>'0','residence_status'=>'1');
	   $data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);
				
			   	if(isset($_POST['user_edit']) && $_POST['user_edit']==TRUE)
			   	{
			   			$name 				= $this->input->post('name');
			   			$lastname 			= $this->input->post('lastname');
			   			$user_name 			= $this->input->post('username');
			   			$mobile 			= $this->input->post('mobile');
			   			$email 				= $this->input->post('email');
			   			$gender 			= $this->input->post('gender');
			   			$age   				= $this->input->post('age');
						$nationality   		= $this->input->post('country');
						$countryofresidence = $this->input->post('countryofresidence');
						$address 			= $this->input->post('address');
						$password 			= $this->input->post('new_password');
						//echo $password;exit;
    	

			   			if($password!="")
			   			{
				   		   $arr_user=array(
				   			'firstname'			 => $name,
   							'lastname'			 => $lastname,
   							'username'			 => $user_name,
   							'mobile_number'		 => $mobile,
   							'email'				 => $email,
   							'gender'			 => $gender,
   							'age'  				 => $age,
							'nationality'        => $nationality,
							'countryofresidence' => $countryofresidence,
							'address'			 => $address,
							'password'       	 => md5($password));
			   			}
			   			else
			   			{
				   			 $arr_user=array(
				   			'firstname'			 => $name,
   							'lastname'			 => $lastname,
   							'username'			 => $user_name,
   							'mobile_number'		 => $mobile,
   							'email'				 => $email,
   							'gender'			 => $gender,
   							'age'  				 => $age,
							'nationality'        => $nationality,
							'countryofresidence' => $countryofresidence,
							'address'			 => $address);
			   			}


			   			if($this->master_model->updateRecord('tbl_user_master',$arr_user,array('id'=>$id)))
								{
									// Record Updation Success
									$this->session->set_flashdata('success','User Details Updated successfully');
									redirect(base_url().'admin/users/manage');
								}
								else
								{
									// Record Updation Failed
									$this->session->set_flashdata('error','Failed to update USer Details');
								}


							redirect(base_url()."admin/users/edit/".$id);
			   	}

				$this->load->view(ADMIN_PANEL_NAME.'template',$data);
			}

	public function view($user_id='')
	{
		/* VIew User Info */
		$data['pageTitle']  = 'User Details';
	   	$data['page_title'] = 'User Details';
		$user_id            = $user_id;
		$data['user_info']  = $this->master_model->getRecords('tbl_user_master',array('id'=>$user_id));

		$where = array('is_delete'=>'0','country_status'=>'1');
	   	$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);

	   	$where = array('country_id'=> $data['user_info'][0]['nationality'],'is_delete'=>'0','residence_status'=>'1');
	   	$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);

		$data['middle_content']='users/view-user';
        $this->load->view(ADMIN_PANEL_NAME.'template',$data);	
    }

} // end class