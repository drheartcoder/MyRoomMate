<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Residence extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}

	/* residence listing and added the links for  add/update/delete/block/unbloack */
    public function manage()
	{
	   	$data['pageTitle']  = 'Manage residence ';
	   	$data['page_title'] = 'Manage Residence';
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
					$this->master_model->updateRecord('tbl_residence_master',array('is_delete'=>'1'),array('residence_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'residence/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_residence_master',array('residence_status'=>'0'),array('residence_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'residence/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_residence_master',array('residence_status'=>'1'),array('residence_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'residence/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchresidence']=$this->master_model->getRecords('tbl_residence_master',FALSE,FALSE,array('residence_id','DESC'));

		$data['middle_content']='residence/manage-residence';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Residence Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Residence ';
		$data['page_title'] ='Add Residence';
		if(isset($_POST['btn_add_residence']))
		{
			$this->form_validation->set_rules('residence_name','Residence  Name','required');
			$this->form_validation->set_rules('country_name','country  Name','required');
			if($this->form_validation->run())
			{
				$name=$this->input->post("residence_name",true);
				$catname=$this->input->post("country_name",true);
				$residence_description=$this->input->post("residence_description",true);


				if($this->master_model->getRecords('tbl_residence_master',array('residence_name'=>$name,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Residence name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'residence/add/');
				}
				else
				{
					$insert_array=array('residence_name'=>$name,
								'country_id'=>$catname,
								'residence_status'=>'1'
							);

					$res=$this->master_model->insertRecord('tbl_residence_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Residence added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding residence.');
					redirect(base_url().ADMIN_PANEL_NAME.'residence/add/');
				}
			}
		}

		$where=array('is_delete'=>'0','country_status'=>'1');
		$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master',$where);
		//echo "query -".$this->db->last_query();

		$data['middle_content']='residence/add-residence';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Residence Function Start Here*/
	public function update()
	{
		$data['page_title']='Update Residence ';
		$id = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'residence/manage');
		}

		if(isset($_POST['btn_update']))
		{
			$this->form_validation->set_rules('residence_name','Residence Name','required');
			$this->form_validation->set_rules('country_name','country  Name','required');

			if($this->form_validation->run())
			{
				$name=$this->input->post("residence_name");
				$catname=$this->input->post("country_name",true);
				$residence_description=$this->input->post("residence_description",true);


				if($this->master_model->getRecords('tbl_residence_master',array('residence_name'=>$name,'residence_id != '=>$id,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Residence name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'residence/update/'.$id);
				}
				else
				{
					$update_array=array('residence_name'=>$name,
										'country_id'=>$catname,
										

									);

					$update_result=$this->db->update('tbl_residence_master',$update_array, array('residence_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Residence updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating residence.');
					redirect(base_url().ADMIN_PANEL_NAME.'residence/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'residence/update/'.$id);
			}
		}

		$where=array('is_delete'=>'0','country_status'=>'1');
		$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master',$where);

		$data['residence_info']=$this->master_model->getRecords('tbl_residence_master',array('residence_id'=>$id));

		$data['middle_content']='residence/edit-residence';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Residence Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('residence_status'=>$sts);
		if($this->master_model->updateRecord('tbl_residence_master',$input_array,array('residence_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'residence/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'residence/manage');
		}
	}

	/*Residence Delete Function Start Here*/
	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_residence_master',array('is_delete'=>'1'),array('residence_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Sub-country deleted successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'residence/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting sub-country.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'residence/manage');
	  	}
	}
}