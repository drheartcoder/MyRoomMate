<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('session_validator');
		$this->load->helper('url');

		$this->session_validator->IsLogged();

	}
	
	public function manage()
	{
		$data['success']          =$data['error']='';
		$data['page_title']       ='Manage Front Pages';
		$this->db->where('front_status !=' , '2');

		//$this->db->where('slug =' , 'terms-of-use');
		$data['fetch_manage_frontpage']=$this->master_model->getRecords('tbl_dynamic_pages');
		$data['middle_content']   ='pages/manage';

		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}
	public function add()
	{
		$data['success']=$data['error']='';
		$data['page_title']='Add Front Pages';
		if(isset($_POST['btn_add']))
		{
			$this->form_validation->set_rules('page_name','Page Name','required|xss_clean');
			$this->form_validation->set_rules('page_title','Page Title','required|xss_clean');
			$this->form_validation->set_rules('page_description','Description','required');
			$this->form_validation->set_rules('meta_title','Meta Title','required');
			$this->form_validation->set_rules('meta_keyword','Meta Keyword','required');
			$this->form_validation->set_rules('meta_description','Meta Description','required');
			if($this->form_validation->run())
			{
				$page_name=$this->input->post('page_name',true);
				$page_title=$this->input->post('page_title',true);
				$page_description=$this->input->post('page_description');
				$meta_title=$this->input->post('meta_title');
				$meta_keyword=$this->input->post('meta_keyword');
				$meta_description=$this->input->post('meta_description');
				$page_slug=$this->master_model->create_slug($page_name,'tbl_dynamic_pages','slug');
				$res=$this->master_model->getRecords('tbl_dynamic_pages',array('page_name'=>$page_name));
				if(count($res)>0)
				{
					$this->session->set_flashdata('error','Front Page Already Exist'); 
					redirect(admin_url().ADMIN_PANEL_NAME.'pages/add/');
				}
				$input_array=array('page_name'=>stripslashes($page_name),
					'page_title'=>stripslashes($page_title),
					'meta_title'=>stripslashes($meta_title),
					'meta_keyword'=>stripslashes($meta_keyword),
					'meta_description'=>stripslashes($meta_description),
					'slug'=>$page_slug,
					'page_description'=>stripslashes($page_description)
					);

				if($this->master_model->insertRecord('tbl_dynamic_pages',$input_array))
				{ 
					$this->session->set_flashdata('success','Front page added successfully.');
					redirect(base_url().ADMIN_PANEL_NAME.'pages/add/');
				}
				else
				{
					$this->session->set_flashdata('error','Error occured while adding front page.'); 
					redirect(base_url().ADMIN_PANEL_NAME.'pages/add/');
				}
			}

		}

		//$data['fetch_manage_frontpage']=$this->master_model->getRecords('tbl_dynamic_pages');
		$data['middle_content']='pages/add';
		$this->load->view('admin/template',$data);

	}
	public function edit()
	{
		$data['page_title']='Edit Front page';		  
		$page_id=$this->uri->segment(4);	 
		if($page_id=="")
		{
			redirect(admin_url());
		}
		if(isset($_POST['btn_aboutus']))
		{
			  //$this->form_validation->set_rules('page_name','Page Name','required|xss_clean');
			$this->form_validation->set_rules('page_title','Page Title','required|xss_clean');
			$this->form_validation->set_rules('page_description','Description','required');
			$this->form_validation->set_rules('meta_title','Meta Title','required');
			$this->form_validation->set_rules('meta_keyword','Meta Keyword','required');
			$this->form_validation->set_rules('meta_description','Meta Description','required');
			if($this->form_validation->run())
			{
				$page_title=$this->input->post('page_title',true);
				$page_description=$this->input->post('page_description');
				$meta_title=$this->input->post('meta_title');
				$meta_keyword=$this->input->post('meta_keyword');
				$meta_description=$this->input->post('meta_description');

				$input_array=array('page_title'=>stripslashes($page_title),
					'meta_title'=>stripslashes($meta_title),
					'meta_keyword'=>stripslashes($meta_keyword),
					'meta_description'=>stripslashes($meta_description),
					'page_description'=>stripslashes($page_description));
				if($this->master_model->updateRecord('tbl_dynamic_pages',$input_array,array('page_id'=>$page_id)))
				{ 
					$this->session->set_flashdata('success','Dynamic page updated successfully.');
					redirect(base_url().ADMIN_PANEL_NAME.'pages/manage/');
				}
				else
				{
					$this->session->set_flashdata('error','Error occured while updating dynamic page.'); 
					redirect(base_url().ADMIN_PANEL_NAME.'pages/manage/');
				}
			}
		}
		$data['front_page_fetch']=$this->master_model->getRecords('tbl_dynamic_pages',array('page_id'=>$page_id));
		$data['middle_content']='pages/edit';
		$this->load->view('admin/template',$data);
	}

    ##------- status update fornt pages (Tushar)----------##
	public function status()
	{
		$status=$this->uri->segment(4);
		$page_id=urldecode($this->uri->segment(5));
		if($status!='' && $page_id!='')
		{
			$res=	$this->master_model->updateRecord('tbl_dynamic_pages',array('front_status'=>$status),array('page_id'=>$page_id));
			if($res)
			{
				$this->session->set_flashdata('success','Status updated successfully.');
			}
			else{
				$this->session->set_flashdata('error','Error while updating status.');
			}
			redirect(base_url().ADMIN_PANEL_NAME."pages/manage");
		}
		redirect(base_url().ADMIN_PANEL_NAME."pages/manage");
	}

	/*DISTRICT : DELETE*/
	public function delete($page_id='')
	{
		$admin_id = $this->session->userdata('admin_id');

		if($admin_id == '')
		{
			redirect(base_url().ADMIN_PANEL_NAME.'');
		}

		$page_id = $page_id;

		if($page_id  == '')
		{
			redirect(base_url().ADMIN_PANEL_NAME.'pages/manage');
		}

       
		if($this->master_model->updateRecord('tbl_dynamic_pages',array('front_status' => '2' ), array('page_id'=> $page_id)))
		{
			$this->session->set_flashdata('success','Record deleted successfully');
			redirect(base_url().ADMIN_PANEL_NAME.'pages/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Opps! some thing went wrong please try again');
			redirect(base_url().ADMIN_PANEL_NAME.'pages/manage');
		}
	}

	##------- multi action pages --------##
	public function multaction()
	{
		if(isset($_POST['multiple_action']) && isset($_POST['chk_fp']))
		{
			if(count($_POST['chk_fp'])>0)
			{
				if($_POST['multiple_action']=='block')
				{
					foreach($_POST['chk_fp'] as $row)
					{
						$this->master_model->updateRecord('tbl_dynamic_pages',array('front_status'=>'0'),array('page_id'=>$row));
					}
					$this->session->set_flashdata('success','Status updated successfully.');
					redirect(base_url().ADMIN_PANEL_NAME."pages/manage");
				}
				else if($_POST['multiple_action']=='active')
				{
					foreach($_POST['chk_fp'] as $row)
					{
						$this->master_model->updateRecord('tbl_dynamic_pages',array('front_status'=>'1'),array('page_id'=>$row));
					}
					$this->session->set_flashdata('success','Status updated successfully.');
					redirect(base_url().ADMIN_PANEL_NAME."pages/manage");
				}
				else if($_POST['multiple_action']=='delete')
				{
					foreach($_POST['chk_fp'] as $row)
					{
						$this->master_model->updateRecord('tbl_dynamic_pages',array('front_status'=>'2'),array('page_id'=>$row));
					}
					$this->session->set_flashdata('success','front pages Deleted Successfully.');
				}
				
				redirect(base_url().ADMIN_PANEL_NAME."pages/manage");
			}			
		}
	}	

}// end class