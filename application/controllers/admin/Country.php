<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Country extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session_validator->IsLogged();

		
	}

	/* country listing and added the links for  add/update/delete/block/unbloack */
    public function manage()
	{
	   	$data['pageTitle'] ='Manage country ';
	   	$data['page_title']='Manage Country';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
					$this->master_model->updateRecord('tbl_country_master',array('is_delete'=>'1'),array('country_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'country/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_country_master',array('country_status'=>'0'),array('country_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'country/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_country_master',array('country_status'=>'1'),array('country_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'country/manage/');
			}
	   	}
	   	$this->db->where('is_delete <>','1');
		$data['fetchcountry']=$this->master_model->getRecords('tbl_country_master',FALSE,FALSE,array('country_id','DESC'));


		
		
		$config['base_url']=base_url().ADMIN_PANEL_NAME."country/manage/";
		$data['middle_content']='country/manage-country';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Country Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Country ';
		$data['page_title'] ='Add Country';
		if(isset($_POST['btn_add_country']))
		{
			
			$this->form_validation->set_rules('country_name','Country  Name','required');
			if($this->form_validation->run())
			{
				
				$name = $this->input->post("country_name",true);
			
				if($this->master_model->getRecords('tbl_country_master',array('country_name'=>$name,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Country name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'country/add/');
				}
				else
				{

					$insert_array=array('country_name'=>$name,
										'country_status'=>'1'
									);

					$res=$this->master_model->insertRecord('tbl_country_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Country added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding country.');
					redirect(base_url().ADMIN_PANEL_NAME.'country/add/');
				}
			}
		}
		$data['middle_content']='country/add-country';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Country Function Start Here*/
	public function update()
	{

		$data['page_title'] = 'Update Country ';
		$id                 = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'country/manage');
		}

		if(isset($_POST['btn_add_country']))
		{
			
			$this->form_validation->set_rules('country_name','Country Name','required');
		
			if($this->form_validation->run())
			{
				$name=$this->input->post("country_name");
				if($this->master_model->getRecords('tbl_country_master',array('country_name'=>$name,'country_id != '=>$id,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Country name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'country/update/'.$id);
				}
				else
				{
					$update_array=array('country_name'=>$name);

					$update_result=$this->db->update('tbl_country_master',$update_array, array('country_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Country updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating country.');
					redirect(base_url().ADMIN_PANEL_NAME.'country/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'country/update/'.$id);
			}
		}

		$data['country_info']=$this->master_model->getRecords('tbl_country_master',array('country_id'=>$id));


        $data['pageTitle']='Manage Country';
		$data['middle_content']='country/edit-country';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Country Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('country_status'=>$sts);
		if($this->master_model->updateRecord('tbl_country_master',$input_array,array('country_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'country/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'country/manage');
		}
	}

	/*Country Delete Function Start Here*/
	public function delete($id2=FALSE)
	{

		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_country_master',array('is_delete'=>'1'),array('country_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Country Deleted Successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'country/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Record.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'country/manage');
	  	}
	}

} //  end class