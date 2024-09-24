<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subscribe extends CI_Controller
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
	   	$data['pageTitle']  = 'Subscribers';
	   	$data['page_title'] = 'Subscribers';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count =count($_REQUEST['checkbox_del']);
			$action       =$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
			   		$this->session->set_flashdata('success','Record(s) deleted successfully.');
					$this->master_model->updateRecord('tbl_newsletter_subscriber',array('sub_status'=>'0'),array('sub_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'subscribe/manage/');
			}
	   	}
	   	$this->db->where('sub_status','1');
		$data['fetchsubscribers']   = $this->master_model->getRecords('tbl_newsletter_subscriber',FALSE,FALSE,array('sub_id','DESC'));
    
		$data['middle_content'] ='subcribe/manage';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}


	/*Subcategory Delete Function Start Here*/
	public function delete($id2='')
	{
		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_newsletter_subscriber',array('sub_status'=>'0'),array('sub_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Subscriber deleted successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'subscribe/manage/');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting subscriber.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'subscribe/manage/');
	  	}
	}

} // end class