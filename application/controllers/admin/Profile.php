<?php if(!defined ('BASEPATH')) exit('No direct script access is allow');
class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session_validator->IsLogged();
	}
	
	/*public function social_links()
	{
		if(isset($_POST['btn_sociallink']))
		{
			$this->form_validation->set_rules('facebook','Facebook','required|xss_clean|trim|callback_valid_url_format');
			$this->form_validation->set_rules('twitter','Twitter','required|xss_clean|trim|callback_valid_url_format');
			$this->form_validation->set_rules('linkedin','Linkedin','required|xss_clean|trim|callback_valid_url_format');
			$this->form_validation->set_rules('instagram','Instagram','required|xss_clean|trim|callback_valid_url_format');


			if($this->form_validation->run())
			{
				$facebook		=	$this->input->post('facebook',true);
				$twitter		=	$this->input->post('twitter',true);
				$linkedin       =	$this->input->post('linkedin',true);
				$instagram     =   $this->input->post('instagram',true);

				$update_array=array(
									'facebook'=>$facebook,
									'twitter'=>$twitter,
									'linkedin'=>$linkedin,
									'instagram'=>$instagram
									);
				if($this->master_model->updateRecord(SOCIAL_LINK,$update_array,array('social_id'=>'1')))
				{
					$this->session->set_flashdata('success',' Social Links Updated Successfully.');
					redirect(base_url().ADMIN_PANEL_NAME.'profile/social_links');
				}
				else
				{
					$this->session->set_flashdata('error',' Error While Updating Social Links.');
					redirect(base_url().ADMIN_PANEL_NAME.'profile/social_links');
				}
			}
		}
		$getlink_info=$this->master_model->getRecords(SOCIAL_LINK);
		$data=array('middle_content'=>'profile/social-links-manage','page_title'=>'Social Links','getlink_info'=>$getlink_info);
		$this->load->view('admin/template',$data);
	}*/
	
	public function edit()
	{
		if(isset($_POST['btn_update_info']))
		{
			$this->form_validation->set_rules('admin_contactus','Phone Number','xss_clean|trim|required');
			$this->form_validation->set_rules('admin_fax','Fax','xss_clean|trim|required');
			$this->form_validation->set_rules('admin_address','Address','xss_clean|trim|required');
			$this->form_validation->set_rules('admin_email','Email','xss_clean|trim|required');
			$this->form_validation->set_rules('admin_username','User Name','xss_clean|trim|required');
			$this->form_validation->set_rules('site_status','Site Status','xss_clean|trim|required');
			
			if($this->form_validation->run())
			{
				$admin_contactus			=	$this->input->post('admin_contactus');
				$admin_fax		=	$this->input->post('admin_fax');
				$admin_address	=	$this->input->post('admin_address');
				$admin_address2	=	$this->input->post('admin_address2');
				$admin_address3	=	$this->input->post('admin_address3');
				$admin_country	=	$this->input->post('admin_country');
				$admin_state	=	$this->input->post('admin_state');
				$admin_city	    =	$this->input->post('admin_city');
				$admin_postcode	=	$this->input->post('admin_postcode');
				$admin_email	=	$this->input->post('admin_email');
				$admin_username	=	$this->input->post('admin_username');
				$site_status	=	$this->input->post('site_status');




                $old_image = $this->input->post('old_image',true);
	  			$config    = array('upload_path'    =>'uploads/admin_profile/',
	  				               'allowed_types'  =>'jpg|jpeg|gif|png',
	  				               'file_name'      =>rand(1,9999),'max_size'=>0);
	  			$this->load->library('upload',$config);
				$this->upload->initialize($config); 

				if(isset($_FILES['file_upload']['name']) && $_FILES['file_upload']['name']!='')
				{  
					if($this->upload->do_upload('file_upload'))
					{
						$dt=$this->upload->data();
						$file=$dt['file_name'];

						unlink('uploads/admin_profile/'.$old_image);
					}
					else
					{
						$file=$old_image;
						$data['error']=$this->upload->display_errors();
					}
				}
				else
				{
					$file=$old_image;
				}

				$update_array=array('admin_contactus'  => $admin_contactus,
									'admin_fax'        => $admin_fax,
									'admin_address'    => $admin_address,
									'admin_country'    => $admin_country,
									'admin_state'      => $admin_state,
									'admin_city'       => $admin_city,
									'admin_postcode'   => $admin_postcode,
									'admin_email'      => $admin_email,
									'admin_username'   => $admin_username,
									'profile_picture'  => $file,
									'site_status'      => $site_status,
								   );
					$res=$this->master_model->updateRecord('admin_login',$update_array, array('id'=>'1'));
					if($res) {

						$this->session->set_flashdata('success',' Settings updated successfully.');
						redirect(base_url().ADMIN_PANEL_NAME."profile/edit");
					}
					else{
						$this->session->set_flashdata('error',' Error while updating settings.');
						redirect(base_url().ADMIN_PANEL_NAME."profile/edit");
					}
			}
			else
			{
				$this->form_validation->error_string();
			}
		}

		$other_data=$this->master_model->getRecords('admin_login',array('id'=>'1'));
		
		$data= array('middle_content' =>'setting/other_info',
			         'page_title'     =>'Edit Profile',
			         'other_data'     => $other_data	);

		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	
	public function change_password()
	{
		if(isset($_POST['btn_update_password']))
		{
			$old_password			=	$this->input->post('old_password');
			$new_password		    =	$this->input->post('new_password');
			$confirm_password    	=	$this->input->post('confirm_password');
			
			$recovery_info      	=	$this->master_model->getRecords('admin_login',array('id'=>'1'));
			$admin_password      	=	$recovery_info[0]['admin_password'];
			
			$this->form_validation->set_rules('old_password','Old Password','xss_clean|trim|required');
			$this->form_validation->set_rules('new_password','New Password','xss_clean|trim|required');
			$this->form_validation->set_rules('confirm_password','Confirm Password','xss_clean|trim|required');
			
			if($this->form_validation->run())
			{
				if($admin_password==$old_password)
				{
					$res=$this->master_model->updateRecord('admin_login', array('admin_password'=>$new_password), array('id'=>'1'));
					if($res)
					{
						$this->session->set_flashdata('success',' Password updated successfully.');
						redirect(base_url().ADMIN_PANEL_NAME."profile/change_password");
					}
					else{
						$this->session->set_flashdata('error',' Error while updating password.');
						redirect(base_url().ADMIN_PANEL_NAME."profile/change_password");
					}
				}
				else{
					$this->session->set_flashdata('error',' Old password not match.');
					redirect(base_url().ADMIN_PANEL_NAME."profile/change_password");				
				}		
			}
			else{
				$this->form_validation->error_string();
			}
		}
		$data=array('middle_content'=>'setting/admin-change-password','page_title'=>'Change Password');
		$this->load->view('admin/template',$data);
	}
	public function payment() /* ----------T.A---------- */
	{
		if(isset($_POST['btn_update_payment_info']))
		{
			if($this->input->post('mode')=="sandbox")
			{
				$sandBox_arr=array(

			        'sandbox_username'    => $this->input->post('snd_uname'),
			        'sandbox_api_key'     => $this->input->post('snd_api'),
			        'sandbox_password'    => $this->input->post('snd_password'),
			        'payment_mode'        => $this->input->post('mode'),
			        'status'              => ''
					);
			    $this->db->where('id', 1);
			    $this->db->update('tbl_payment_info', $sandBox_arr);
			    $this->session->set_flashdata('success',' Sandbox payment details successfully updated.');
			    redirect(base_url().ADMIN_PANEL_NAME."profile/payment");

			}
			else if($this->input->post('mode')=="live")
			{
				$paypal_arr=array(

			        'paypal_username'    => $this->input->post('ppal_uname'),
			        'paypal_api_key'     => $this->input->post('ppal_api'),
			        'paypal_password'    => $this->input->post('ppal_pass'),
			        'payment_mode'        => $this->input->post('mode'),
			        'status'              => ''
					);
			    $this->db->where('id', 1);
			    $this->db->update('tbl_payment_info', $paypal_arr);
			    $this->session->set_flashdata('success',' Live payment details successfully updated.');
			    redirect(base_url().ADMIN_PANEL_NAME."profile/payment");
			}
		}

		$data                    =array('middle_content'=>'payment-info/payment-info','page_title'=>'Payment Info' , 'pageTitle' => 'Payment Info');
		$condition               =array('id' => 1);
		$data['payment_info']    =$this->master_model->getRecords('tbl_payment_info');

		$this->load->view('admin/template',$data);
	}


	public function social()
	{
		$data['page_title']='Social Link';
		$data['social_link']=$this->master_model->getRecords('tbl_social');

		if(isset($_POST['btn_social']))
		{
			$this->form_validation->set_rules('facebook_link','Facebook Link','required');
			$this->form_validation->set_rules('twitter_link','Twitter Link','required');
			$this->form_validation->set_rules('googleplus_link','GooglePlus Link','required');
			$this->form_validation->set_rules('youtube_link','YouTube Link','required');
			$this->form_validation->set_rules('pinterest_link','Pinterest Link','required');
			$this->form_validation->set_rules('linkedin_link','LinkedIn Link','required');
			$this->form_validation->set_rules('instagram_link','Instagram Link','required');
			if($this->form_validation->run()){
				$facebook_link=$this->input->post('facebook_link');
				$twitter_link=$this->input->post('twitter_link');
				$googleplus_link=$this->input->post('googleplus_link');
				$youtube_link=$this->input->post('youtube_link');
				$pinterest_link=$this->input->post('pinterest_link');
				$linkedin_link=$this->input->post('linkedin_link');
				$instagram_link=$this->input->post('instagram_link');

				$arr=array('facebook_link'=>$facebook_link,'twitter_link'=>$twitter_link,'googleplus_link'=>$googleplus_link,'youtube_link'=>$youtube_link,
							'pinterest_link'=>$pinterest_link,'linkedin_link'=>$linkedin_link,'instagram_link'=>$instagram_link
						  );
				if($this->master_model->updateRecord('tbl_social',$arr,array('social_id'=>'1')))
				{
					$this->session->set_flashdata('success','Social Links updated Successfully');
					redirect(base_url().ADMIN_PANEL_NAME.'profile/social');
				}
				else
				{
					$this->session->set_flashdata('error','Failed to update Social Links ');
				}
			}
		}
		$data['middle_content']='sociallink';
		$this->load->view('admin/template',$data);
	}
	
	/*public function site_online_offline()
	{
		
		$status=	$this->master_model->getRecords(SITE_STATUS,array('site_id'=>'1'));
		if(isset($_POST['update_site_status']))
		{ 
			$site_status	=	$this->input->post('site_status');
			$res=$this->master_model->updateRecord(SITE_STATUS,array('site_status'=>$site_status),array('site_id'=>'1'));
			if($res)
			{
				$this->session->set_flashdata('success',' Site Status Updated Successfully.');
				redirect(base_url().ADMIN_PANEL_NAME."profile/site_online_offline");
			}
			else{
				$this->session->set_flashdata('success',' Error While Updating Site Status.');
				redirect(base_url().ADMIN_PANEL_NAME."profile/site_online_offline");
			}
		}
		$data=array('middle_content'=>'profile/admin-site-status','page_title'=>'Site status','status'=>$status[0]['site_status']);
		$this->load->view('admin/template',$data);
	}*/

    /*public function home_sliders()
    {
    	$data=array('middle_content'=>'homepage-slider','page_title'=>'Homepage Slider');
		$this->load->view('admin/template',$data);
    }*/

} //  end class
?>