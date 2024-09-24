<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Advertisement extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}


	public function index()
	{
		redirect(base_url().'admin/advertisement/manage/');
	}

	public function manage()
	{ 
        
		$data = array();
		$data['page_title'] = 'Manage Advertisement';
		$data['middle_content']='advertisement/manage-advertisement';

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
					if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'0'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Service blocked successfully');
					}
				}
				redirect(base_url().'admin/advertisement/manage/');
			}
			  #-----unblock -----#
			elseif($action=='active')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'1'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Service activated successfully');
					}
				}
				redirect(base_url().'admin/advertisement/manage/');
			}
				  #-----delete -----#
			elseif($action=='delete')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'2','is_delete'=>'1'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) deleted successfully');
					}
				}
				redirect(base_url().'admin/advertisement/manage/');
			}
		}

		//$this->db->order_by('blogs_added_date','DESC');
		$data['fetchdata']=$this->master_model->getRecords('tbl_advertisement',array('status !='=>'2'));
		$this->load->view('admin/template',$data);
	}
	public function add()
	{
		$data = array();
		$ajax_response =array();
		$data['page_title'] = 'Add Advertisement';
		$data['middle_content']='advertisement/add-advertisement';
		if(isset($_POST['adv_add']) && $_POST['adv_add']==TRUE)
		{
			$this->form_validation->set_rules('adv_name','Advertisement Name','trim|required');
			
			if($this->form_validation->run()==FALSE)
			{
				/*Validation Failed*/
				$this->session->set_flashdata('error','Validation Failed!!Enter proper values');
				redirect(base_url()."admin/advertisement/add");
			}
			else
			{
				$adv_name = $this->input->post('adv_name');
					/* Check Image Uploaded or not */
					$config=array(
						'upload_path'=>'uploads/adv_images',
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
							redirect(base_url()."admin/advertisement/add");
						}
					}
					else
					{
						$this->session->set_flashdata('error','Please select some image');
						redirect(base_url()."admin/advertisement/add");
					}
					$arr_details = array(
						"adv_name"=>$adv_name,
						
						"adv_image"=>$default_img
						);
					 $rec_cnt=$this->master_model->getRecordCount('tbl_advertisement',array('adv_name'=>$adv_name,'status'=>1));
					if($rec_cnt==0)
					{
						if($this->master_model->insertRecord('tbl_advertisement',$arr_details))
						{
							/* Record Insertion Success */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['success'] =  'Advertisement added successfully';
							}
							else
							{
								$this->session->set_flashdata('success','Advertisement added successfully');
							}
						}
						else
						{
							/* Record Insertion Failed */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['error'] =  'Failed to add Advertisement ';
							}
							else
							{
								$this->session->set_flashdata('error','Failed to add Advertisement');
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
					redirect(base_url()."admin/advertisement/add");
				}
			}
		}
		
		$this->load->view('admin/template',$data);
	}

	
	public function edit($id)
	{ 
		$data = array();
		$data['page_title'] = 'Edit Advertisement';
		$data['middle_content']='advertisement/edit-advertisement';

		if($id!='')
		{

			$id = base64_decode($id);
			/* Retrieving services Details */
			$arr_cond= array('status <>'=>'2','id'=>$id);
			//echo $arr_cond;exit;
			$arr_details = $this->master_model->getRecords('tbl_advertisement',$arr_cond);
			//echo $arr_details;exit;
			if(sizeof($arr_details)>0)
			{ 
			    // Get first record specifically
				$arr_main_details = reset($arr_details);
			    // Deallosve $arr_details
				unset($arr_details);
				$data['adv_details']= $arr_main_details;
			//echo $data['adv_details'];exit;
			}

			else
			{
				// No records Found
				redirect(base_url()."admin/advertisement/");
			}
			/* Following Code block excecutes while saving update record */
			if(isset($_POST['adv_edit']) && $_POST['adv_edit']==TRUE)
			{

				$this->form_validation->set_rules('adv_name','Advertisement Name','trim|required');
				
				
				
				if($this->form_validation->run()==FALSE)
				{ 
						// Record Updation Failed
					$this->session->set_flashdata('error','Validation Failed');
					redirect(base_url()."admin/advertisement/edit/".$id);
					/*Validation Failed*/
				}
				else
				{
					$adv_name = $this->input->post('adv_name');
					//echo"hh";exit;
					//$crit= "(blogs_name_en = '$blogs_name_en') AND (blogs_name_ar = '$blogs_name_ar')AND blogs_status <> '2' AND blogs_id <>'$blogs_id' ";

						/* Check Image Uploaded or not */
						$config=array(
							'upload_path'=>'uploads/adv_images',
							'allowed_types'=>'jpg|jpeg|png',
							'file_name'=>rand(1,9999999),
							'max_size'=>5120
							);
						$this->load->library('upload',$config);
						$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
						 $default_img = 	isset($arr_main_details['adv_image'])?$arr_main_details['adv_image']:"noimage.jpg";
						if(isset($_FILES['blogs_logo']) && $_FILES['blogs_logo']['error']==0)
						{  
							if($this->upload->do_upload('blogs_logo'))
							{
								$dt=$this->upload->data();
								$file=$dt['file_name'];
								$default_img = $file;
								if($arr_main_details['adv_image']!="noimage.jpg")
								{
									@unlink($this->config->item('adv_image').$arr_main_details['adv_image']);
									@unlink($this->config->item('adv_image').'thumb/'.$arr_main_details['adv_image']);
								}
							}
							else
							{
								$this->session->set_flashdata('error',$this->upload->display_errors());
								redirect(base_url()."admin/advertisement/");
							}
						}
						$arr_details = array('adv_name'=>$adv_name,
											 
						                     'adv_image'=>$default_img,
						                    );
						//echo $arr_details;exit;
						if($this->master_model->updateRecord('tbl_advertisement',$arr_details,array('id'=>$id)))
						{
							// Record Updation Success
							$this->session->set_flashdata('success','Advertisement Update successfully');
							redirect(base_url().'admin/advertisement/manage');
						}
						else
						{
							// Record Updation Failed
							$this->session->set_flashdata('error','Failed to update service');
						}


					redirect(base_url()."admin/advertisement/edit/".base64_encode($id));
				}
			}

			$this->load->view('admin/template',$data);
		}
		else
		{
			//echo "Step three";
			exit;
			// Parameter missing
			redirect(base_url()."admin/advertisement/");
		}
	}

	public function toggle_status($id,$status)
	{
		if($id!='' && $status!='' )
		{
			if($status=="0")
			{
				$id = base64_decode($id);
				if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'0'),array('id'=>$id)))
				{
					$this->session->set_flashdata('success','Status update successfully');
				}
			}
			elseif($status=="1")
			{
				$id = base64_decode($id);
				if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'1'),array('id'=>$id)))
				{
					$this->session->set_flashdata('success','Status updated successfully ');
				}
			}
			elseif($status=="2")
			{
				$id = base64_decode($id);

					if($this->master_model->updateRecord('tbl_advertisement',array('status'=>'2','is_delete'=>'1'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) Deleted Successfully');
					}

			}
			redirect(base_url()."admin/advertisement/manage/");
		}
		else
		{
			// Parameter missing
			redirect(base_url()."admin/services/");
		}
	}

	public function details($id)
	{
		$id=base64_decode($id);
		$data['page_title']='advertisment Details';
		$data['fetchdata']=$this->master_model->getRecords('tbl_advertisement',array('id'=>$id));
		$data['middle_content']='advertisement/detail-advertisement';
		$this->load->view('admin/template',$data);
	}
	
}
?>