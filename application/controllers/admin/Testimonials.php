<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Testimonials extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}


	public function index()
	{
		redirect(base_url().'admin/testimonials/manage/');
	}

	public function manage()
	{
		$data = array();
		$data['page_title'] = 'Manage Testimonials';
		$data['middle_content']='testimonials/manage-testimonials';

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
					if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'0','testimonials_front_status'=>'1'),array('testimonials_id'=>$id)))
					{
						$this->session->set_flashdata('success','Testimonials blocked successfully');
					}
				}
				redirect(base_url().'admin/testimonials/manage/');
			}
			  #-----unblock -----#
			elseif($action=='active')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'1','testimonials_front_status'=>'1'),array('testimonials_id'=>$id)))
					{
						$this->session->set_flashdata('success','Testimonials activated successfully');
					}
				}
				redirect(base_url().'admin/testimonials/manage/');
			}
				  #-----delete -----#
			elseif($action=='delete')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'2','testimonials_front_status'=>'0'),array('testimonials_id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) deleted successfully');
					}
				}
				redirect(base_url().'admin/testimonials/manage/');
			}
		}

		$data['fetchdata']=$this->master_model->getRecords('tbl_testimonials_master',array('testimonials_status !='=>'2'));
		$this->load->view('admin/template',$data);
	}

	public function add()
	{
		$data = array();
		$ajax_response =array();
		$data['page_title'] = 'Add Testimonials';
		$data['middle_content']='testimonials/add-testimonials';
		if(isset($_POST['testimonials_add']) && $_POST['testimonials_add']==TRUE)
		{
			$this->form_validation->set_rules('testimonials_name_en','Testimonials Name','trim|required');
			$this->form_validation->set_rules('testimonials_description_en','Testimonials Description','trim|required');
			$this->form_validation->set_rules('testimonials_date','Testimonials Date','required');
			$this->form_validation->set_rules('testimonials_added_by','Testimonials Added By','required');
			if($this->form_validation->run()==FALSE)
			{
				/*Validation Failed*/
				$this->session->set_flashdata('error','Validation Failed!!Enter proper values');
				redirect(base_url()."admin/testimonials/add");
			}
			else
			{
				$testimonials_name_en = $this->input->post('testimonials_name_en');
				$testimonials_description_en = $this->input->post('testimonials_description_en');
				$testimonials_date=$this->input->post('testimonials_date');
				$testimonials_added_by=$this->input->post('testimonials_added_by');

					/* Check Image Uploaded or not */
					$config=array(
						'upload_path'=>'uploads/testimonials_images',
						'allowed_types'=>'jpg|jpeg|png',
						'file_name'=>rand(1,9999999),
						'max_size'=>5120
						);
					$this->load->library('upload',$config);
					$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
					$default_img = 	"noimage.jpg";

					/*if(isset($_FILES['sv_logo']) && $_FILES['sv_logo']['error']==0)*/
						/*if(isset($_FILES['sv_logo']))*/

					/*if(isset($_FILES['sv_logo']) && $_FILES['sv_logo']['error']==0)*/
					if(isset($_FILES['sv_logo']))
					{
						if($this->upload->do_upload('sv_logo'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							$default_img = $file;
						}
						else
						{
							/*$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url()."admin/testimonials/add");*/
						}
					}
					else
					{
						/*$this->session->set_flashdata('error','Please select some image');
						redirect(base_url()."admin/testimonials/add");*/
					}
					$arr_details = array(
						"testimonials_name_en"=>$testimonials_name_en,
						"testimonials_description_en"=>$testimonials_description_en,
						"testimonials_added_by"=>$testimonials_added_by,
						"testimonials_added_date"=>date('Y-m-d',strtotime($testimonials_date)),
						"testimonials_img"=>$default_img
						);
					 $rec_cnt=$this->master_model->getRecordCount('tbl_testimonials_master',array('testimonials_name_en'=>$testimonials_name_en,'testimonials_status'=>1));
					if($rec_cnt==0)
					{
						if($this->master_model->insertRecord('tbl_testimonials_master',$arr_details))
						{
							/* Record Insertion Success */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['success'] =  'Testimonials added successfully';
							}
							else
							{
								$this->session->set_flashdata('success','Testimonials added successfully');
							}
						}
						else
						{
							/* Record Insertion Failed */
							/* If ajax response then set store operation status in variable else in flashdata */
							if(isset($_POST['ajax_request']) && $_POST['ajax_request']==TRUE)
							{
								$ajax_response['error'] =  'Failed to add Testimonials ';
							}
							else
							{
								$this->session->set_flashdata('error','Failed to add Testimonials');
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
					redirect(base_url()."admin/testimonials/add");
				}
			}
		}
		$this->load->view('admin/template',$data);
	}

	public function edit($testimonials_id)
	{

		$data = array();
		$data['page_title'] = 'Edit Testimonials';
		$data['middle_content']='testimonials/edit-testimonials';
		if($testimonials_id!='')
		{

			$testimonials_id = base64_decode($testimonials_id);
			/* Retrieving services Details */
			$arr_cond= array('testimonials_status <>'=>'2','testimonials_id'=>$testimonials_id);
			$arr_details = $this->master_model->getRecords('tbl_testimonials_master',$arr_cond);
			if(sizeof($arr_details)>0)
			{
			    // Get first record specifically
				$arr_main_details = reset($arr_details);
			    // Deallosve $arr_details
				unset($arr_details);
				$data['testimonials_details']= $arr_main_details;
			}
			else
			{
				// No records Found
				redirect(base_url()."admin/testimonials/");
			}
			/* Following Code block excecutes while saving update record */
			if(isset($_POST['testimonials_edit']) && $_POST['testimonials_edit']==TRUE)
			{

				$this->form_validation->set_rules('testimonials_name_en','Testimonials Name','trim|required');
				$this->form_validation->set_rules('testimonials_description_en','Testimonials Discription','trim|required');
				$this->form_validation->set_rules('testimonials_added_by','Testimonials Added By','required');
			if($this->form_validation->run()==FALSE)
				{
						// Record Updation Failed
					$this->session->set_flashdata('error','Validation Failed');
					redirect(base_url()."admin/testimonials/edit/");
					/*Validation Failed*/
				}
				else
				{
					$testimonials_name_en = $this->input->post('testimonials_name_en');
					$testimonials_description_en = $this->input->post('testimonials_description_en');
					$testimonials_added_by=$this->input->post('testimonials_added_by');
					$testimonials_date=$this->input->post('testimonials_date');
					//$crit= "(testimonials_name_en = '$testimonials_name_en') AND (testimonials_name_ar = '$testimonials_name_ar')AND testimonials_status <> '2' AND testimonials_id <>'$testimonials_id' ";

						/* Check Image Uploaded or not */
						$config=array(
							'upload_path'=>'uploads/testimonials_images',
							'allowed_types'=>'jpg|jpeg|png',
							'file_name'=>rand(1,9999999),
							'max_size'=>5120
							);
						$this->load->library('upload',$config);
						$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
						 $default_img = 	isset($arr_main_details['testimonials_img'])?$arr_main_details['testimonials_img']:"noimage.jpg";
						if(isset($_FILES['testimonials_logo']) && $_FILES['testimonials_logo']['error']==0)
						/*if(isset($_FILES['testimonials_logo']))*/
						{
							if($this->upload->do_upload('testimonials_logo'))
							{
								$dt=$this->upload->data();
								$file=$dt['file_name'];
								$default_img = $file;
								if($arr_main_details['testimonials_img']!="noimage.jpg")
								{
									@unlink($this->config->item('testimonials_img').$arr_main_details['testimonials_img']);
									@unlink($this->config->item('testimonials_img').'thumb/'.$arr_main_details['testimonials_img']);
								}
							}
							else
							{
								/*$this->session->set_flashdata('error',$this->upload->display_errors());
								redirect(base_url()."admin/testimonials/");*/
							}
						}
						$arr_details = array('testimonials_name_en'=>$testimonials_name_en,
						                     'testimonials_description_en'=>$testimonials_description_en,
						                    'testimonials_img'=>$default_img,
						                    'testimonials_added_by'=>$testimonials_added_by,
						                     'testimonials_added_date'=>date('Y-m-d',strtotime($testimonials_date)));
						if($this->master_model->updateRecord('tbl_testimonials_master',$arr_details,array('testimonials_id'=>$testimonials_id)))
						{
							// Record Updation Success
							$this->session->set_flashdata('success','Testimonials Update successfully');
							redirect(base_url().'admin/testimonials/manage');
						}
						else
						{
							// Record Updation Failed
							$this->session->set_flashdata('error','Failed to update Testimonials');
						}


					redirect(base_url()."admin/testimonials/edit/".base64_encode($testimonials_id));
				}
			}

			$this->load->view('admin/template',$data);
		}
		else
		{
			//echo "Step three";
			exit;
			// Parameter missing
			redirect(base_url()."admin/testimonials/");
		}
	}

	public function toggle_status($testimonials_id,$status)
	{
		if($testimonials_id!='' && $status!='' )
		{
			if($status=="0")
			{
				$id = base64_decode($testimonials_id);
				if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'0','testimonials_front_status'=>'1'),array('testimonials_id'=>$id)))
				{
					$this->session->set_flashdata('success','Status update successfully');
				}
			}
			elseif($status=="1")
			{
				$id = base64_decode($testimonials_id);
				if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'1','testimonials_front_status'=>'1'),array('testimonials_id'=>$id)))
				{
					$this->session->set_flashdata('success','Status updated successfully ');
				}
			}
			elseif($status=="2")
			{
				$id = base64_decode($testimonials_id);

					if($this->master_model->updateRecord('tbl_testimonials_master',array('testimonials_status'=>'2','testimonials_front_status'=>'0'),array('testimonials_id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) Deleted Successfully');
					}

			}
			redirect(base_url()."admin/testimonials/manage/");
		}
		else
		{
			// Parameter missing
			redirect(base_url()."admin/services/");
		}
	}

	public function toggle_visibility($testimonials_id,$status)
	{
		if(strlen($testimonials_id)>0 && strlen($status)>0)
		{
			$safe_testimonials_id = base64_decode($testimonials_id);
			$arr_update_data = array();
			if($status=="0")
			{
				$arr_update_data  = array('testimonials_front_status'=>'0');
			}
			elseif($status=="1")
			{
				$arr_update_data  = array('testimonials_front_status'=>'1');
			}
			if(sizeof($arr_update_data)>0)
			{
				$this->master_model->updateRecord('tbl_testimonials_master',$arr_update_data,array('testimonials_id'=>"'".$safe_testimonials_id."'"));
				if($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('success','testimonials Visibility Updated Succesfully');
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
			redirect(base_url()."admin/testimonials/");
		}
		else
		{
			$this->session->set_flashdata('error','Problem Occured , Please try again');
			redirect(base_url()."admin/testimonials/");
		}
	}

	public function details($testimonials_id)
	{
		$id=base64_decode($testimonials_id);
		$data['page_title']='testimonials Details';
		$data['fetchdata']=$this->master_model->getRecords('tbl_testimonials_master',array('testimonials_id'=>$id));
		$data['middle_content']='testimonials/detail-testimonials';
		$this->load->view('admin/template',$data);
	}

}
?>