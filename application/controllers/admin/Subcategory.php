<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subcategory extends CI_Controller
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
	   	$data['pageTitle']  = 'Manage subcategory ';
	   	$data['page_title'] = 'Manage Subcategory';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
			   		$this->session->set_flashdata('success','Record(s) deleted successfully.');
					$this->master_model->updateRecord('tbl_subcategory_master',array('is_delete'=>'1'),array('subcategory_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_subcategory_master',array('subcategory_status'=>'0'),array('subcategory_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_subcategory_master',array('subcategory_status'=>'1'),array('subcategory_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchsubcategory']=$this->master_model->getRecords('tbl_subcategory_master',FALSE,FALSE,array('subcategory_id','DESC'));

		$data['middle_content']='subcategory/manage-subcategory';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Subcategory Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Subcategory ';
		$data['page_title'] ='Add Subcategory';
		if(isset($_POST['btn_add_subcategory']))
		{
			$this->form_validation->set_rules('subcategory_name','Subcategory  Name','required');
			$this->form_validation->set_rules('category_name','category  Name','required');
			if($this->form_validation->run())
			{
				$name=$this->input->post("subcategory_name",true);
				$catname=$this->input->post("category_name",true);
				$subcategory_description=$this->input->post("subcategory_description",true);


				if($this->master_model->getRecords('tbl_subcategory_master',array('subcategory_name'=>$name,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Subcategory name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'subcategory/add/');
				}
				else
				{
					$insert_array=array('subcategory_name'=>$name,
								'category_id'=>$catname,
								'subcategory_status'=>'0'
							);

					$res=$this->master_model->insertRecord('tbl_subcategory_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Subcategory added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding subcategory.');
					redirect(base_url().ADMIN_PANEL_NAME.'subcategory/add/');
				}
			}
		}

		$where=array('is_delete'=>'0','category_status'=>'1');
		$data['fetchcategory']=$this->master_model->getRecords('tbl_category_master',$where);
		//echo "query -".$this->db->last_query();

		$data['middle_content']='subcategory/add-subcategory';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Subcategory Function Start Here*/
	public function update()
	{
		$data['page_title']='Update Subcategory ';
		$id = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
		}

		if(isset($_POST['btn_update']))
		{
			$this->form_validation->set_rules('subcategory_name','Subcategory Name','required');
			$this->form_validation->set_rules('category_name','category  Name','required');

			if($this->form_validation->run())
			{
				$name=$this->input->post("subcategory_name");
				$catname=$this->input->post("category_name",true);
				$subcategory_description=$this->input->post("subcategory_description",true);


				if($this->master_model->getRecords('tbl_subcategory_master',array('subcategory_name'=>$name,'subcategory_id != '=>$id,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Subcategory name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'subcategory/update/'.$id);
				}
				else
				{
					$update_array=array('subcategory_name'=>$name,
										'category_id'=>$catname,
										

									);

					$update_result=$this->db->update('tbl_subcategory_master',$update_array, array('subcategory_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Subcategory updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating subcategory.');
					redirect(base_url().ADMIN_PANEL_NAME.'subcategory/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'subcategory/update/'.$id);
			}
		}

		$where=array('is_delete'=>'0','category_status'=>'1');
		$data['fetchcategory']=$this->master_model->getRecords('tbl_category_master',$where);

		$data['subcategory_info']=$this->master_model->getRecords('tbl_subcategory_master',array('subcategory_id'=>$id));

		$data['middle_content']='subcategory/edit-subcategory';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Subcategory Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('subcategory_status'=>$sts);
		if($this->master_model->updateRecord('tbl_subcategory_master',$input_array,array('subcategory_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
		}
	}

	/*Subcategory Delete Function Start Here*/
	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_subcategory_master',array('is_delete'=>'1'),array('subcategory_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Sub-category deleted successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting sub-category.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
	  	}
	}
}