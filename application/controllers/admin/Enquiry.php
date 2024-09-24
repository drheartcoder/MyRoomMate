<?php if(!defined('BASEPATH')) exit('No direct script access allow');
class Enquiry extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->session_validator->IsLogged();

	}

	public function manage()
	{
		$config['base_url']=base_url().ADMIN_PANEL_NAME."enquiry/manage/";
		$config['total_rows']=$this->master_model->getRecordCount('tbl_contact_inquiries');
		$config['num_links']	=	3;
		$config['uri_segment']	=	4;
		$config['per_page']	=	10;
		$this->pagination->initialize($config);
		$links	=	$this->pagination->create_links();
		/*echo $links;exit();*/
		$page	=	(($this->uri->segment(4))?$this->uri->segment(4):0);
		$enquiry_list=array();
		$enquiry_list=$this->master_model->getRecords('tbl_contact_inquiries','','*',array('contact_id'=>'DESC'),$page,$config['per_page']);
		/*echo '<pre>'; print_r($enquiry_list);exit();*/
		$middle_content='enquiry/manage';
		$page_title='Manage Contact Enquiry';
		$data=array('middle_content'=>$middle_content,'page_title'=>$page_title,'enquiry_list'=>$enquiry_list,'links'=>$links);
		$this->load->view('admin/template',$data);
	}
	public function delete()
	{
		$contact_id=	$this->uri->segment(4);
		if($contact_id!='')
		{
			$del=$this->master_model->deleteRecord('tbl_contact_inquiries','contact_id',$contact_id);
			if($del)
			{
				$this->session->set_flashdata('success','Contact Enquiry Deleted Successfully');
				redirect(base_url().ADMIN_PANEL_NAME.'enquiry/manage/');
			}
			else
			{
				$this->session->set_flashdata('error','Error While Deleting Contact Enquiry.');
				redirect(base_url().ADMIN_PANEL_NAME.'enquiry/manage/');
			}
		}
	}
	public function multaction()
	{
		if(isset($_POST['multiple_action']) && isset($_POST['chk_enquiry']))
		{
			if(count($_POST['chk_enquiry'])>0)
			{
				if($_POST['multiple_action']=='delete')
				{
					foreach($_POST['chk_enquiry'] as $row)
					{
						$this->master_model->deleteRecord('tbl_contact_inquiries','contact_id',$row);
					}
				}
				$this->session->set_flashdata('success','Contact Enquiry Deleted Successfully.');
				redirect(base_url().ADMIN_PANEL_NAME."enquiry/manage");
			}
		}
	}
}
?>