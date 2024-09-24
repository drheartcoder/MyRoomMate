<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogscategory extends CI_Controller
{
	/*Call construct for load auto model and all things */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}

    public function manage()
	{
	   	$data['pageTitle']='Manage Blogs category ';
	   	$data['page_title']='Blogscategory';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];
			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
					$this->master_model->updateRecord('tbl_blogscategory_master',array('is_delete'=>'1'),array('blogscategory_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().'admin/blogscategory/manage/');
			}
			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_blogscategory_master',array('blogscategory_status'=>'0'),array('blogscategory_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().'admin/blogscategory/manage/');
			}
			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_blogscategory_master',array('blogscategory_status'=>'1'),array('blogscategory_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().'admin/blogscategory/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchblogscategory']=$this->master_model->getRecords('tbl_blogscategory_master');
		$data['middle_content']='blogs/manage-blogscategory';
		$this->load->view('admin/template',$data);
	}

	/*Add Blogscategory Function Start Here*/
	public function add()
	{
		$data['pageTitle']='Add Blogs category ';
		$data['page_title']='Add Blogs category';
		if(isset($_POST['btn_add_blogscategory']))
		{
			$this->form_validation->set_rules('blogscategory_name','Blogs category  Name','required');
			$this->form_validation->set_rules('blogscategory_description','Blogs category Description','required');
			if($this->form_validation->run())
			{
				$name=$this->input->post("blogscategory_name",true);
				$blogscategory_description=$this->input->post("blogscategory_description",true);


				if($this->master_model->getRecords('tbl_blogscategory_master',array('blogscategory_name'=>$name)))
				{
					$this->session->set_flashdata('error','Blogs category name already exist');
					redirect(base_url().'admin/blogscategory/add/');
				}
				else
				{
					$insert_array=array('blogscategory_name'=>$name,
								'blogscategory_description'=>$blogscategory_description,
								'blogscategory_status'=>'0'
							);

					$res=$this->master_model->insertRecord('tbl_blogscategory_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Blogs category added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding Blogs category.');
					redirect(base_url().'admin/blogscategory/add/');
				}
			}
		}
		$data['middle_content']='blogs/add-blogscategory';
		$this->load->view('admin/template',$data);
	}

	/*Update Blogscategory Function Start Here*/
	public function update()
	{
		$data['page_title']='Update Blogs category ';
		$id = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().'admin/blogscategory/manage');
		}

		if(isset($_POST['btn_update']))
		{
			$this->form_validation->set_rules('blogscategory_name','Blogs category Name','required');
			$this->form_validation->set_rules('blogscategory_description','Blogs category Description','required');
			if($this->form_validation->run())
			{
				$name=$this->input->post("blogscategory_name");
				$blogscategory_description=$this->input->post("blogscategory_description",true);


				if($this->master_model->getRecords('tbl_blogscategory_master',array('blogscategory_name'=>$name,'blogscategory_id != '=>$id)))
				{
					$this->session->set_flashdata('error','Blogs category name already exist');
					redirect(base_url().'admin/blogscategory/update/'.$id);
				}
				else
				{
					$update_array=array('blogscategory_name'=>$name,
										'blogscategory_description'=>$blogscategory_description

									);

					$update_result=$this->db->update('tbl_blogscategory_master',$update_array, array('blogscategory_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Blogs category updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating blogscategory.');
					redirect(base_url().'admin/blogscategory/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().'admin/blogscategory/update/'.$id);
			}
		}

		$data['blogscategory_info']=$this->master_model->getRecords('tbl_blogscategory_master',array('blogscategory_id'=>$id));

		$data['middle_content']='blogs/update-blogscategory';
		$this->load->view('admin/template',$data);
	}

	/*Blogscategory Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('blogscategory_status'=>$sts);
		if($this->master_model->updateRecord('tbl_blogscategory_master',$input_array,array('blogscategory_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().'admin/blogscategory/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().'admin/blogscategory/manage');
		}
	}


	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_blogscategory_master',array('is_delete'=>'1'),array('blogscategory_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Record deleted successfully.');
	  		redirect(base_url().'admin/blogscategory/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Record.');
	  		redirect(base_url().'admin/blogscategory/manage');
	  	}
	}
}