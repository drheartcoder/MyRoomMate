<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
	}
	public function index()
	{
        /*---------advertsement---------------*/
        $where=array('status'=>'1');
		$this->db->order_by('rand()');
   	    $this->db->limit(1);
		$data['adv']    = $this->master_model->getRecords('tbl_advertisement',$where);
		
		/*--------home feature---------------*/
		$this->db->where('category_status' , '1');
        $this->db->where('is_delete' , '0');
        $this->db->where('featured' , 'featured');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');

		/*---------category below the advertsement---------------*/
		$where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
		$data['homefetchcategory'] = $this->master_model->getRecords('tbl_category_master',$where);
     	

     	/*-------------------newlisting advertise----------------*/
		$where_arr = array('status'=>1,'is_delete'=>'0');
        $this->db->order_by("id","desc");
        $this->db->limit(10);
        $this->db->select('tbl_addlisting.*, tbl_addlisting_transection.transaction_price');
        // to get the amount paid
        $this->db->join('tbl_addlisting_transection', 'tbl_addlisting_transection.listing_id=tbl_addlisting.id');
        $data['latestaddlisting'] = $this->master_model->getRecords('tbl_addlisting', $where_arr);
        //echo $this->db->last_query();

        $data['pageTitle']       = 'Home - '.PROJECT_NAME;
   	    $data['page_title']      = 'Home - '.PROJECT_NAME;
   	    $data['middle_content']  = 'home';

	    $this->load->view('template',$data);
	}

	public function allcategories()
	{
        $data['pageTitle']       = 'All Categories - '.PROJECT_NAME;
   	    $data['page_title']      = 'All Categories - '.PROJECT_NAME;
   	    $data['middle_content']  = 'hompage-all-categories';

        /* get Categories */
        $this->db->where('category_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master');
        $Count = count($data['getCat']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'home/allcategories';
	    $config1['per_page']             = 7;
	    $config1['uri_segment']          = '3';
	    $config1['full_tag_open']        = '<div class="pagination pull-right"><ul class="pagination pagination-blog">';
	    $config1['full_tag_close']       = '</ul></div>';

	    $config1['first_link']           = '<i class="fa fa-angle-double-left" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['first_tag_open']       = '<li class="prev page">';
	    $config1['first_tag_close']      = '</li>';

	    $config1['last_link']            = '<i class="fa fa-angle-double-right" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['last_tag_open']        = '<li class="next page">';
	    $config1['last_tag_close']       = '</li>';

	    $config1['next_link']            = '<i class="fa fa-angle-right" style="font-size: 1.4em;" aria-hidden="true"></i>';
	    $config1['next_tag_open']        = '<li class="next page">';
	    $config1['next_tag_close']       = '</li>';

	    $config1['prev_link']            = '<i class="fa fa-angle-left" style="font-size: 1.4em;"></i>';
	    $config1['prev_tag_open']        = '<li class="prev page">';
	    $config1['prev_tag_close']       = '</li>';

	    $config1['cur_tag_open']         = '<li ><a href="" class="act" style="color: rgb(242, 246, 249);background-color: #034A7B;" >';
	    $config1['cur_tag_close']        = '</a></li>';

	    $config1['num_tag_open']         = '<li class="page">';
	    $config1['num_tag_close']        = '</li>'; 
	    
	    $this->pagination->initialize($config1);
	    $page        = ($this->uri->segment(3));
	    /* end create pagination */

	    $this->db->where('category_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_category_master',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        //print_r($data['getCat']);exit;
	    $this->load->view('template',$data);
	}
	public function help()
	{
        $data['pageTitle']       = 'Help - '.PROJECT_NAME;
   	    $data['page_title']      = 'Help - '.PROJECT_NAME;
   	    $data['middle_content']  = 'help';
	    $this->load->view('template',$data);
	}
	public function subscribe()
	{
		$sub_email = $this->input->post('sub_email');
		$user_id   = $this->session->userdata('user_id');
	
		if($sub_email!='')
		{
			$num = $this->master_model->getRecordCount('tbl_newsletter_subscriber',array('sub_email'=>$sub_email));
			if($num==0)
			{
				if($this->master_model->insertRecord('tbl_newsletter_subscriber',array('sub_email'=>$sub_email)))
				{
					    $id = $this->db->insert_id();

						$admin_email=$this->master_model->getRecords('admin_login',array('id'=>1));
                      
						$info_arr   = array('from'     =>$admin_email[0]['admin_email'],
									        'to'       =>$sub_email,
									        'subject'  =>'Newsletter - '.PROJECT_NAME,
									        'view'     =>'newsletter-enquiry-success');

						$other_info = array('con_name' =>PROJECT_NAME,
							                'content'  =>'',
							                'id'       =>$id,
								            'footer'   =>''
							             );

            		    if($this->email_sending->sendmail($info_arr, $other_info))
            		    {
						   $this->session->set_flashdata('success',"Mail Sent successfully");
						   echo 'success';
					    }
				}
				else
				{
					$this->session->set_flashdata('error',"Error While Sending Mail");
					echo 'error';
				}
			} 
			else 
			{
			    $up_array = array('sub_status'=>'1');
				if($this->master_model->updateRecord('tbl_newsletter_subscriber',$up_array,array('sub_email'=>"'".$sub_email."'")))
				{
	       			echo 'exists';
	       		}	
			}
		}

	}
	public function unsubscribe($sub_id = FALSE)
	{

		$sub_id  = $sub_id;
		$rec_cnt = $this->master_model->getRecordCount('tbl_newsletter_subscriber',array('sub_id'=>$sub_id,'sub_status'=>'1'));
		if($rec_cnt > 0)
		{

			if($this->master_model->updateRecord('tbl_newsletter_subscriber',array('sub_status'=>'0'),array('sub_id'=>$sub_id)))
			{
				$this->session->set_flashdata('success','Your subscription to newsletter has been cancelled successfully');
				redirect(base_url().'home');
			}
			else 
			{
				$this->session->set_flashdata('error','Failed to unsubscribe newsletter');
				redirect(base_url().'home');	
			}
		}
		else 
		{
			$this->session->set_flashdata('error','You have already unsubscribed newsletter');
			redirect(base_url().'home');
		}
	}

} //  end class
