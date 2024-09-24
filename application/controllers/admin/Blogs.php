<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}


	public function index()
	{
		redirect(base_url().'admin/blogs/manage/');
	}

	public function manage()
	{
		$data = array();
		$data['page_title'] = 'Manage Blogs';
		$data['middle_content']='blogs/manage-blogs';

		if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
		{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];
			#-----block -----#
			if($action=='block')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'0','blogs_front_status'=>'1'),array('blogs_id'=>$id)))
					{
						$this->session->set_flashdata('success','Service blocked successfully');
					}
				}
				redirect(base_url().'admin/blogs/manage/');
			}
			  #-----unblock -----#
			elseif($action=='active')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'1','blogs_front_status'=>'1'),array('blogs_id'=>$id)))
					{
						$this->session->set_flashdata('success','Service activated successfully');
					}
				}
				redirect(base_url().'admin/blogs/manage/');
			}
				  #-----delete -----#
			elseif($action=='delete')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'2','blogs_front_status'=>'0'),array('blogs_id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) deleted successfully');
					}
				}
				redirect(base_url().'admin/blogs/manage/');
			}
		}

		$this->db->order_by('blogs_added_date','DESC');
		$data['fetchdata']=$this->master_model->getRecords('tbl_blogs_master',array('blogs_status !='=>'2'));
		$this->load->view('admin/template',$data);
	}

	public function add()
	{
		$data = array();
		$ajax_response =array();
		$data['page_title'] = 'Add Blogs';
		$data['middle_content']='blogs/add-blogs';

		$data['blogcategory']=$this->master_model->getRecords('tbl_blogscategory_master');

		if(isset($_POST['blogs_add']) && $_POST['blogs_add']==TRUE)
		{
			$this->form_validation->set_rules('blogs_name_en','Blogs Name','trim|required');
			$this->form_validation->set_rules('blogs_category_id','Blogs Category','trim|required');
			$this->form_validation->set_rules('blogs_description_en','Blogs Description','trim|required');
			$this->form_validation->set_rules('blogs_date','Blogs Date','required');
			$this->form_validation->set_rules('blogs_added_by','Blogs Added By','required');
			if($this->form_validation->run()==FALSE)
			{
				/*Validation Failed*/
				$this->session->set_flashdata('error','Validation Failed!!Enter proper values');
				redirect(base_url()."admin/blogs/add");
			}
			else
			{
				$blogs_name_en = $this->input->post('blogs_name_en');
				$blogs_category_id = $this->input->post('blogs_category_id');
				$blogs_description_en = $this->input->post('blogs_description_en');
				$blogs_date=$this->input->post('blogs_date');
				$blogs_added_by=$this->input->post('blogs_added_by');

					/* Check Image Uploaded or not */
					$config=array(
						'upload_path'=>'uploads/blogs_images',
						'allowed_types'=>'jpg|jpeg|png',
						'file_name'=>rand(1,9999999),
						'max_size'=>5120
						);
					$this->load->library('upload',$config);
					$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
					$default_img = 	"noimage.jpg";
					if(isset($_FILES['sv_logo']) && $_FILES['sv_logo']['error']==0)
					{
						if($this->upload->do_upload('sv_logo'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							$default_img = $file;
						}
						else
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url()."admin/blogs/add");
						}
					}
					else
					{
						$this->session->set_flashdata('error','Please select some image');
						redirect(base_url()."admin/blogs/add");
					}
					$arr_details = array(
						"blogs_name_en"=>$blogs_name_en,
						"blogs_category_id"=>$blogs_category_id,
						"blogs_description_en"=>$blogs_description_en,
						"blogs_added_by"=>$blogs_added_by,
						"blogs_added_date"=>date('Y-m-d',strtotime($blogs_date)),
						"blogs_img"=>$default_img
						);
					 $rec_cnt=$this->master_model->getRecordCount('tbl_blogs_master',array('blogs_name_en'=>$blogs_name_en,'blogs_status'=>1));
					if($rec_cnt==0)
					{
						if($this->master_model->insertRecord('tbl_blogs_master',$arr_details))
						{
							/* Record Insertion Success */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['success'] =  'Blogs added successfully';
							}
							else
							{
								$this->session->set_flashdata('success','Blogs added successfully');
							}
						}
						else
						{
							/* Record Insertion Failed */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['error'] =  'Failed to add Blogs ';
							}
							else
							{
								$this->session->set_flashdata('error','Failed to add Blogs');
							}
						}
					}
					else
					{
						$this->session->set_flashdata('error',"Name already existes.Enter some other name");
					}

				/* If request from ajax call */
				if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
				{
					if(array_key_exists('success', $ajax_response))
					{
						echo json_encode(array('sts'=>"OK",'msg'=>$ajax_response['success']))	;
						exit;
					}
					elseif (array_key_exists('error', $ajax_response))
					{
						echo json_encode(array('sts'=>"ERROR",'msg'=>$ajax_response['error']))	;
						exit;
					}
					exit;
				}
				else
				{
					redirect(base_url()."admin/blogs/add");
				}
			}
		}
		$this->load->view('admin/template',$data);
	}

	public function edit($blogs_id)
	{

		$data = array();
		$data['page_title'] = 'Edit Blogs';
		$data['middle_content']='blogs/edit-blogs';

		$data['blogcategory']=$this->master_model->getRecords('tbl_blogscategory_master');

		if($blogs_id!='')
		{

			$blogs_id = base64_decode($blogs_id);
			/* Retrieving services Details */
			$arr_cond= array('blogs_status <>'=>'2','blogs_id'=>$blogs_id);
			$arr_details = $this->master_model->getRecords('tbl_blogs_master',$arr_cond);
			if(sizeof($arr_details)>0)
			{
			    // Get first record specifically
				$arr_main_details = reset($arr_details);
			    // Deallosve $arr_details
				unset($arr_details);
				$data['blogs_details']= $arr_main_details;
			}
			else
			{
				// No records Found
				redirect(base_url()."admin/blogs/");
			}
			/* Following Code block excecutes while saving update record */
			if(isset($_POST['blogs_edit']) && $_POST['blogs_edit']==TRUE)
			{

				$this->form_validation->set_rules('blogs_name_en','Blogs Name','trim|required');
				$this->form_validation->set_rules('blogs_category_id','Blogs Category','trim|required');
				$this->form_validation->set_rules('blogs_description_en','Blogs Discription','trim|required');
				$this->form_validation->set_rules('blogs_added_by','Blogs Added By','required');
				
				if($this->form_validation->run()==FALSE)
				{
						// Record Updation Failed
					$this->session->set_flashdata('error','Validation Failed');
					redirect(base_url()."admin/blogs/edit/");
					/*Validation Failed*/
				}
				else
				{
					$blogs_name_en = $this->input->post('blogs_name_en');
					$blogs_category_id = $this->input->post('blogs_category_id');
					$blogs_description_en = $this->input->post('blogs_description_en');
					$blogs_added_by=$this->input->post('blogs_added_by');
					$blogs_date=$this->input->post('blogs_date');
					//$crit= "(blogs_name_en = '$blogs_name_en') AND (blogs_name_ar = '$blogs_name_ar')AND blogs_status <> '2' AND blogs_id <>'$blogs_id' ";

						/* Check Image Uploaded or not */
						$config=array(
							'upload_path'=>'uploads/blogs_images',
							'allowed_types'=>'jpg|jpeg|png',
							'file_name'=>rand(1,9999999),
							'max_size'=>5120
							);
						$this->load->library('upload',$config);
						$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
						 $default_img = 	isset($arr_main_details['blogs_img'])?$arr_main_details['blogs_img']:"noimage.jpg";
						if(isset($_FILES['blogs_logo']) && $_FILES['blogs_logo']['error']==0)
						{
							if($this->upload->do_upload('blogs_logo'))
							{
								$dt=$this->upload->data();
								$file=$dt['file_name'];
								$default_img = $file;
								if($arr_main_details['blogs_img']!="noimage.jpg")
								{
									@unlink($this->config->item('blogs_img').$arr_main_details['blogs_img']);
									@unlink($this->config->item('blogs_img').'thumb/'.$arr_main_details['blogs_img']);
								}
							}
							else
							{
								$this->session->set_flashdata('error',$this->upload->display_errors());
								redirect(base_url()."admin/blogs/");
							}
						}
						$arr_details = array('blogs_name_en'=>$blogs_name_en,
											 'blogs_category_id'=>$blogs_category_id,
						                     'blogs_description_en'=>$blogs_description_en,
						                    'blogs_img'=>$default_img,
						                    'blogs_added_by'=>$blogs_added_by,
						                     'blogs_added_date'=>date('Y-m-d',strtotime($blogs_date)));
						if($this->master_model->updateRecord('tbl_blogs_master',$arr_details,array('blogs_id'=>$blogs_id)))
						{
							// Record Updation Success
							$this->session->set_flashdata('success','Blogs Update successfully');
							redirect(base_url().'admin/blogs/manage');
						}
						else
						{
							// Record Updation Failed
							$this->session->set_flashdata('error','Failed to update service');
						}


					redirect(base_url()."admin/blogs/edit/".base64_encode($blogs_id));
				}
			}

			$this->load->view('admin/template',$data);
		}
		else
		{
			//echo "Step three";
			exit;
			// Parameter missing
			redirect(base_url()."admin/blogs/");
		}
	}

	public function toggle_status($blogs_id,$status)
	{
		if($blogs_id!='' && $status!='' )
		{
			if($status=="0")
			{
				$id = base64_decode($blogs_id);
				if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'0','blogs_front_status'=>'1'),array('blogs_id'=>$id)))
				{
					$this->session->set_flashdata('success','Status update successfully');
				}
			}
			elseif($status=="1")
			{
				$id = base64_decode($blogs_id);
				if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'1','blogs_front_status'=>'1'),array('blogs_id'=>$id)))
				{
					$this->session->set_flashdata('success','Status updated successfully ');
				}
			}
			elseif($status=="2")
			{
				$id = base64_decode($blogs_id);

					if($this->master_model->updateRecord('tbl_blogs_master',array('blogs_status'=>'2','blogs_front_status'=>'0'),array('blogs_id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) Deleted Successfully');
					}

			}
			redirect(base_url()."admin/blogs/manage/");
		}
		else
		{
			// Parameter missing
			redirect(base_url()."admin/services/");
		}
	}

	public function toggle_visibility($blogs_id,$status)
	{
		if(strlen($blogs_id)>0 && strlen($status)>0)
		{
			$safe_blogs_id = base64_decode($blogs_id);
			$arr_update_data = array();
			if($status=="0")
			{
				$arr_update_data  = array('blogs_front_status'=>'0');
			}
			elseif($status=="1")
			{
				$arr_update_data  = array('blogs_front_status'=>'1');
			}
			if(sizeof($arr_update_data)>0)
			{
				$this->master_model->updateRecord('tbl_blogs_master',$arr_update_data,array('blogs_id'=>"'".$safe_blogs_id."'"));
				if($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('success','Blogs Visibility Updated Succesfully');
				}
				else
				{
					$this->session->set_flashdata('error','Problem Occured , Please try again');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Problem Occured , Please try again');
			}
			redirect(base_url()."admin/blogs/");
		}
		else
		{
			$this->session->set_flashdata('error','Problem Occured , Please try again');
			redirect(base_url()."admin/blogs/");
		}
	}

	public function details($blogs_id)
	{
		$id=base64_decode($blogs_id);
		$data['page_title']='Blogs Details';
		$data['fetchdata']=$this->master_model->getRecords('tbl_blogs_master',array('blogs_id'=>$id));
		$data['middle_content']='blogs/detail-blogs';
		$this->load->view('admin/template',$data);
	}

}
?>