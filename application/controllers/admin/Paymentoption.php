<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paymentoption extends CI_Controller {
/*Call construct for load auto model and all things */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_sending');
		
		$this->session_validator->IsLogged();

	}
	public function update($id='')
	{ 
	   $data['pageTitle']  = 'Payment Option Update';
	   $data['page_title'] = 'Pricing Option Update';
	   $data['fetchdata']  = $fetchdata=$this->master_model->getRecords('tbl_pricing_master',array('membership_id'=>$id));
	   if(isset($_POST['btn_update_membership']))
	   {
	        
				 $membership_price           = $this->input->post('membership_price',true);
				 $short_desc = $this->input->post('short_desc',true);
				 $long_desc  = $this->input->post('long_desc',true);
				 
                 $update_array=array(
				                 	'membership_price' =>$membership_price,
				                 	'short_desc'       =>$short_desc,
				                 	'long_desc'        =>$long_desc
				                 	);
				 if($this->master_model->updateRecord('tbl_pricing_master',$update_array,array('membership_id'=>$id)))
				 {
					 $this->session->set_flashdata('success','Record updated successfully.'); 
					 redirect(base_url().ADMIN_PANEL_NAME.'paymentoption/update/'.$id.'');
				 }
				 else
				 {
					 $this->session->set_flashdata('error','Error while updating record.'); 
					 redirect(base_url().ADMIN_PANEL_NAME.'paymentoption/update/'.$id.'');
				 }
	   }
	   
	   $data['middle_content']='payment/update-payment';
	   $this->load->view('admin/template',$data);
	}
	public function manage()
	{ 
      $data['pageTitle']  ='Manage Payment Option';
	  $data['page_title'] ='Manage Payment Option';

	  $order_by  =array('membership_id'=>'Asc');
	  $this->db->order_by('membership_id','DESC');

	  $data['fetchdata']      =$this->master_model->getRecords('tbl_pricing_master',FALSE,FALSE,$order_by);;
	  $data['middle_content'] ='payment/manage-payment';
	  $this->load->view('admin/template',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */