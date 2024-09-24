<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogscomments extends CI_Controller
{
	/*Call construct for load auto model and all things */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_sending');
	}

    public function manage()
	{
	   	$data['pageTitle']='Manage Blogs Comments';
	   	$data['page_title']='Manage Blogs Comments';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
		{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];
			#-----block -----#
			if($action=='block')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_comments',array('message_read'=>'0'),array('comm_id'=>$id)))
					{
						$this->session->set_flashdata('success','Contact enquiry unread successfully');
					}
				}
				redirect(base_url().'admin/blogscomments/manage/');
			}
			  #-----unblock -----#
			elseif($action=='active')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_comments',array('message_read'=>'1'),array('comm_id'=>$id)))
					{
						$this->session->set_flashdata('success','Contact enquiry read successfully');
					}
				}
				redirect(base_url().'admin/blogscomments/manage/');
			}
				  #-----delete -----#
			elseif($action=='delete')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_blogs_comments',array('message_read'=>'2'),array('comm_id'=>$id)))
					{
						$this->session->set_flashdata('success','Record(s) deleted successfully');
					}
				}
				redirect(base_url().'admin/blogscomments/manage/');
			}
		}
		$this->db->where('message_read <>','2');
		$data['enquirydata']=$this->master_model->getRecords('tbl_blogs_comments');
		$data['middle_content']='blogs/manage_blogs_comments';
		$this->load->view('admin/template',$data);
	}

	public function details($comm_id='')
	{
	   $comm_id=base64_decode($comm_id);
	   $data['page_title']='Details';
	   $data['pageTitle']='Blogs Comments Details';
	   
	   if($comm_id=='')
	   {
	   		redirect(base_url()."admin/blogscomments/manage");
	   }

	   $data['fetchdata']=$this->master_model->getRecords('tbl_blogs_comments',array('comm_id'=>$comm_id));
	   $data['middle_content']='blogs/details-comments';
	   $this->load->view('admin/template',$data);
	}

	public function toggle_status($comm_id,$status)
	{
		if($comm_id!='' && $status!='' )
		{
			if($status=="2")
			{
				$comm_id = base64_decode($comm_id);
					if($this->master_model->updateRecord('tbl_blogs_comments',array('message_read'=>'2'),array('comm_id'=>$comm_id)))
					{
						//$this->master_model->updateRecord('tbl_blogs_comments',array('sub_status'=>'2'),array('fk_id'=>$comm_id));
						$this->session->set_flashdata('success','Record(s) Deleted Successfully');
					}

			}
			redirect(base_url()."admin/blogscomments/manage");
		}
		else
		{
			// Parameter missing
			redirect(base_url()."admin/blogscomments/manage");
		}
	}
	public function toggle_visibility($comm_id,$status)
	{
		if(strlen($comm_id)>0 && strlen($status)>0)
		{
			$safe_id = base64_decode($comm_id);
			$arr_update_data = array();
			if($status=="0")
			{
				$arr_update_data  = array('message_read	'=>'0');
			}
			elseif($status=="1")
			{
				$arr_update_data  = array('message_read	'=>'1');
			}
			if(sizeof($arr_update_data)>0)
			{
				$this->master_model->updateRecord('tbl_blogs_comments',$arr_update_data,array('comm_id'=>"'".$safe_id."'"));
				if($this->db->affected_rows()>0)
				{
					$this->session->set_flashdata('success','Conatct Visibility Updated Succesfully');
				}
				else
				{
					$this->session->set_flashdata('error','Problem Occured, Please try again');
				}
			}
			else
			{
				$this->session->set_flashdata('error','Problem Occured, Please try again');
			}
			redirect(base_url()."admin/blogscomments/manage");
		}
		else
		{
			$this->session->set_flashdata('error','Problem Occured , Please try again');
			redirect(base_url()."admin/blogscomments/manage");
		}
	}
	/*code for reply contact enquiry*/
	public function reply($comm_id='')
	{
           $comm_id=base64_decode($comm_id);
           $contact_data=$this->master_model->getRecords('tbl_blogs_comments',array('comm_id'=>$comm_id));
            if(isset($_POST['send_reply']))
            {
            	$this->form_validation->set_rules('reply_message','Reply message','required');
            	if($this->form_validation->run())
            	{
                    $reply_message=$this->input->post('reply_message',true);
            		$admin_email=$this->master_model->getRecords('admin_login',array('id'=>1));
            		/*follows Email array*/
            		$info_arr = array('from'=>$admin_email[0]['admin_email'],
									   'to'=>$contact_data[0]['comm_email'],
									   'subject'=>'Contact Replay',
									    'view'=>'contact-enquiry-response');

            		$other_info = array('comm_name'=> $contact_data[0]['comm_name'],
							              'reply_message'=> $reply_message);
            		  //print_r($info_arr);print_r($other_info);exit;
            		if($this->email_sending->sendmail($info_arr, $other_info))
                    {
        	 		    $this->session->set_flashdata('success','Contact Enquiry Reply Sent Successfully.');
				        redirect(base_url().'admin/blogscomments/reply/'.base64_encode($comm_id));
				    }
				    else
				    {
				        $this->session->set_flashdata('error','Error while sending contact enquiry reply');
					    redirect(base_url().'admin/blogscomments/reply/'.base64_encode($comm_id));
				    }
            	}
            	else
				{
					$this->session->set_flashdata('error',$this->form_validation->error_string());
					redirect(base_url().'admin/blogscomments/reply/'.base64_encode($comm_id));

				}
            }
           $data=array('page_title'=>'Reply contact enquiry','middle_content'=>'reply-contact-enquiry','contact_data'=>$contact_data);
	       $this->load->view('admin/template',$data);
	}

}