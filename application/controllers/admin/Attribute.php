<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Attribute extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session_validator->IsLogged();

		
	}

	/* attribute listing and added the links for  add/update/delete/block/unbloack */
    public function manage()
	{
	   	$data['pageTitle'] ='Manage attribute ';
	   	$data['page_title']='Manage Attribute';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
					$this->master_model->updateRecord('tbl_attribute_master',array('is_delete'=>'1'),array('attribute_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_attribute_master',array('attribute_status'=>'0'),array('attribute_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_attribute_master',array('attribute_status'=>'1'),array('attribute_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchattribute']=$this->master_model->getRecords('tbl_attribute_master',FALSE,FALSE,array('attribute_id','DESC'));


		
		
		$config['base_url']=base_url().ADMIN_PANEL_NAME."attribute/manage/";
		$data['middle_content']='attribute/manage-attribute';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Attribute Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Attribute ';
		$data['page_title'] ='Add Attribute';
		if(isset($_POST['btn_add_attribute']))
		{
			
			$this->form_validation->set_rules('attribute_name','Attribute  Name','required');
			//$this->form_validation->set_rules('page_img'     ,'Attribute Image','required');
			if($this->form_validation->run())
			{
				
				$name = $this->input->post("attribute_name",true);
				$slug = url_title($name, 'dash', true);


				if($this->master_model->getRecords('tbl_attribute_master',array('attribute_name'=>$name,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Attribute name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'attribute/add/');
				}
				else
				{

					$insert_array=array(
										'attribute_name'=>$name,
										'attribute_slug'=>$slug,
										'attribute_status'=>'1'
									   );

					$res=$this->master_model->insertRecord('tbl_attribute_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Attribute added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding attribute.');
					redirect(base_url().ADMIN_PANEL_NAME.'attribute/add/');
				}
			}
		}
		$data['middle_content']='attribute/add-attribute';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Attribute Function Start Here*/
	public function update()
	{

		$data['page_title'] = 'Update Attribute ';
		$id                 = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage');
		}

		if(isset($_POST['btn_add_attribute']))
		{
			
			$this->form_validation->set_rules('attribute_name','Attribute Name','required');
		
			if($this->form_validation->run())
			{
				$name=$this->input->post("attribute_name");

				if($this->master_model->getRecords('tbl_attribute_master',array('attribute_name'=>$name,'attribute_id != '=>$id,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Attribute name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'attribute/update/'.$id);
				}
				else
				{
					
					$update_array=array(
										'attribute_name'=>$name,
									);

					$update_result=$this->db->update('tbl_attribute_master',$update_array, array('attribute_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Attribute updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating attribute.');
					redirect(base_url().ADMIN_PANEL_NAME.'attribute/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'attribute/update/'.$id);
			}
		}

		$data['attribute_info']=$this->master_model->getRecords('tbl_attribute_master',array('attribute_id'=>$id));


        $data['pageTitle']='Manage Attribute';
		$data['middle_content']='attribute/edit-attribute';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Attribute Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('attribute_status'=>$sts);
		if($this->master_model->updateRecord('tbl_attribute_master',$input_array,array('attribute_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage');
		}
	}

	/*Attribute Delete Function Start Here*/
	public function delete($id2=FALSE)
	{

		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_attribute_master',array('is_delete'=>'1'),array('attribute_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Attribute Deleted Successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Record.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'attribute/manage');
	  	}
	}

} //  end class