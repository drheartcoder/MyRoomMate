<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categoryfields extends CI_Controller
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
	   	$data['pageTitle']  = 'Manage Category Form Fields ';
	   	$data['page_title'] = 'Manage Category Form Fields';
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
					$this->master_model->updateRecord('tbl_category_form_fields',array('is_delete'=>'1'),array('id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_category_form_fields',array('status'=>'0'),array('id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_category_form_fields',array('status'=>'1'),array('id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchcategoryfields']=$this->master_model->getRecords('tbl_category_form_fields',FALSE,FALSE,array('id','DESC'));

		$data['middle_content']='categoryfields/manage-category-fields';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Add Category Form Fields Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Category Form Fields';
		$data['page_title'] ='Add Category Form Fields';
		if(isset($_POST['btn_add_category_fields']))
		{

			$this->form_validation->set_rules('category_name','Category Name','required');
			$this->form_validation->set_rules('attribute_id','Category Field Name','required');
			$this->form_validation->set_rules('fields_type','Category Field Type','required');

			if($this->form_validation->run())
			{
				$cat_id=$this->input->post("category_name",true);
				$attribute_id=$this->input->post("attribute_id",true);
				$fields_type=$this->input->post("fields_type",true);
				$fields_elements=$this->input->post("fields_elements",true);

				$where = array('parent_id'=> $cat_id);
				$childcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($childcat as $key => $value) {
					
					$insert_array=array(
						'cat_id'=>$value['category_id'],
						'attribute_id'=>$attribute_id,
						'fields_type'=>$fields_type,
						'fields_elements'=>$fields_elements,
						'status'=>'1',
						'is_delete'=>'0'
					);

					$res=$this->master_model->insertRecord('tbl_category_form_fields',$insert_array);
				}
				
				if($res)
					$this->session->set_flashdata('success','Category form fields added successfully.');
				else
					$this->session->set_flashdata('error','Error while adding category form fields.');
				redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/add/');
			}
			
			/*if($this->form_validation->run())
			{
				$cat_id=$this->input->post("category_name",true);
				$attribute_id=$this->input->post("attribute_id",true);
				$fields_type=$this->input->post("fields_type",true);
				$fields_elements=$this->input->post("fields_elements",true);

				$insert_array=array(
							'cat_id'=>$cat_id,
							'attribute_id'=>$attribute_id,
							'fields_type'=>$fields_type,
							'fields_elements'=>$fields_elements,
							'status'=>'1',
							'is_delete'=>'0'
						);

				$res=$this->master_model->insertRecord('tbl_category_form_fields',$insert_array);

				if($res)
					$this->session->set_flashdata('success','Category form fields added successfully.');
				else
					$this->session->set_flashdata('error','Error while adding category form fields.');
				redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/add/');
			}*/
		}

		$where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
		$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

		foreach ($parentcat as $key => $value) {
			
			$data['fetchcategory'][]   = $value;
			
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

		$where=array('is_delete'=>'0','attribute_status'=>'1');
		$data['fetchattribute']=$this->master_model->getRecords('tbl_attribute_master',$where);

		$data['middle_content']='categoryfields/add-category-fields';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Subcategory Function Start Here*/
	public function update()
	{
		$data['page_title']='Update Category Form Fields ';
		$id = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'subcategory/manage');
		}

		if(isset($_POST['btn_update']))
		{
			$this->form_validation->set_rules('category_name','Category Name','required');
			$this->form_validation->set_rules('attribute_id','Category Field Name','required');
			$this->form_validation->set_rules('fields_type','Category Field Type','required');

			if($this->form_validation->run())
			{
				$cat_id=$this->input->post("category_name",true);
				$attribute_id=$this->input->post("attribute_id",true);
				$fields_type=$this->input->post("fields_type",true);
				$fields_elements=$this->input->post("fields_elements",true);

				$update_array=array(
							'cat_id'=>$cat_id,
							'attribute_id'=>$attribute_id,
							'fields_type'=>$fields_type,
							'fields_elements'=>$fields_elements,
							'status'=>'1',
							'is_delete'=>'0'
					);

				$update_result=$this->db->update('tbl_category_form_fields',$update_array, array('id' => $id));

				if($update_result)
					$this->session->set_flashdata('success','Category form fields  updated successfully.');
				else
					$this->session->set_flashdata('error','Error while updating category form fields .');
				redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/update/'.$id);
				
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/update/'.$id);
			}
		}

		/*$where=array('is_delete'=>'0','category_status'=>'1');
		$data['fetchcategory']=$this->master_model->getRecords('tbl_category_master',$where);*/

		/*$where=array('is_delete'=>'0','subcategory_status'=>'1');
		$data['fetchsubcategory']=$this->master_model->getRecords('tbl_subcategory_master',$where);*/

		$where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
		$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

		foreach ($parentcat as $key => $value) {
			
			//$data['fetchcategory'][]   = $value;
			
			$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
			$childcat = $this->master_model->getRecords('tbl_category_master',$where);

			foreach ($childcat as $key => $value) {
	
				//$data['fetchcategory'][]   = $value;

				$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
				$childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($childchildcat as $key => $value) {
	
					$data['fetchcategory'][]   = $value;
				}
			}
		}

		$where=array('is_delete'=>'0','attribute_status'=>'1');
		$data['fetchattribute']=$this->master_model->getRecords('tbl_attribute_master',$where);
		
		$data['category_form_field_info']=$this->master_model->getRecords('tbl_category_form_fields',array('id'=>$id));

		$data['middle_content']='categoryfields/edit-category-fields';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Subcategory Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('status'=>$sts);
		if($this->master_model->updateRecord('tbl_category_form_fields',$input_array,array('id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage');
		}
	}

	/*Subcategory Delete Function Start Here*/
	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_category_form_fields',array('is_delete'=>'1'),array('id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Category fields deleted successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting category fields.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'categoryfields/manage');
	  	}
	}

	public function getSubCategory()
	{
		$where=array('is_delete'=>'0','subcategory_status'=>'1','category_id'=>$_POST['CiD']);
		$data['getSubCategoryDetails']=$this->master_model->getRecords('tbl_subcategory_master',$where);

		$subcategory ="";
	    if(count($data['getSubCategoryDetails'])>0)
	    {
	    	 $subcategory.="<option value='0'>--Select Subcategory--</option>";
		    foreach($data['getSubCategoryDetails'] as $field => $value)
	        {
	           
	            $subcategory.="<option value=".$value['subcategory_id'].">".$value['subcategory_name']."</option>";
	           
	        }
	    }
	    else
	    {
	    	$subcategory='<option > No subcategory</option>';
	    }
        
		echo $subcategory;
	}

	public function orderby()
	{
		$update_array=array('orderby'=>$_POST['orderby']);
		$update_result=$this->db->update('tbl_category_form_fields',$update_array, array('id' => $_POST['fieldId']));
	}
}