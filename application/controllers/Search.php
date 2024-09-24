<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
        $this->master_model->IsLogged();
        
	}
	public function index()
	{
        /*Get-Seller*/
        /* searching criteareas */
        if(isset($_REQUEST['seller']) && $_REQUEST['seller'] != ""){
        $this->db->like('name' , $_REQUEST['seller']);
        }
 
        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
        	$this->db->like('address' , $_REQUEST['location']);
        }

        if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != ""){
        	$this->db->where_in('tbl_seller_upload_product.category_id' ,$_REQUEST['cat_id']);
        	$this->db->group_by('tbl_seller_upload_product.seller_id');
        	$this->db->join('tbl_seller_upload_product' , 'tbl_seller_upload_product.seller_id=tbl_user_master.id');
        }
      
        if(isset($_REQUEST['selector'])  && $_REQUEST['selector'] == "lToh"){
            $this->db->join('tbl_seller_rating' , 'tbl_seller_rating.seller_id=tbl_user_master.id' , 'left');
            $this->db->where('tbl_seller_rating.status' , 'Unblock');
            $this->db->group_by('tbl_seller_rating.seller_id');
            $this->db->order_by(count('ratings') , 'desc');
        }

        if(isset($_REQUEST['selector'])  && $_REQUEST['selector'] == "hTol"){
            $this->db->join('tbl_seller_rating' , 'tbl_seller_rating.seller_id=tbl_user_master.id' , 'left');
            $this->db->where('tbl_seller_rating.status' , 'Unblock');
            $this->db->group_by('tbl_seller_rating.seller_id');
            $this->db->order_by(count('ratings') , 'asc');
        }
       


        /* end searching criteareas */
        $this->db->where('tbl_user_master.status' , 'Unblock');
		$this->db->where('tbl_user_master.verification_status' , 'Verified');
		$this->db->where('tbl_user_master.user_type' , 'Seller');
		$data['get_seller'] = $this->master_model->getRecords('tbl_user_master');
		$Count = count($data['get_seller']);

		/* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
 
        $config1['first_url']            = $_SERVER['QUERY_STRING']!="" ? base_url('search/index').'/?'.$_SERVER['QUERY_STRING'] : base_url('search/index');
	    $config1['suffix']               = "/?".$_SERVER['QUERY_STRING'];


	    $config1['base_url']             = base_url().'search/index';
	    $config1['per_page']             = 9;
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

        /* searching criteareas */
        if(isset($_REQUEST['seller']) && $_REQUEST['seller'] != ""){
        $this->db->like('name' , $_REQUEST['seller']);
        }

        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
        	$this->db->like('address' , $_REQUEST['location']);
        }

        if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != ""){
        	$this->db->where_in('tbl_seller_upload_product.category_id' ,$_REQUEST['cat_id']);
        	$this->db->group_by('tbl_seller_upload_product.seller_id');
        	$this->db->join('tbl_seller_upload_product' , 'tbl_seller_upload_product.seller_id=tbl_user_master.id');
        }

        

        if(isset($_REQUEST['selector'])  && $_REQUEST['selector'] == "lToh"){
            $this->db->join('tbl_seller_rating' , 'tbl_seller_rating.seller_id=tbl_user_master.id' , 'left');
            $this->db->where('tbl_seller_rating.status' , 'Unblock');
            $this->db->group_by('tbl_seller_rating.seller_id');
            $this->db->order_by(count('ratings') , 'desc');
        }

        if(isset($_REQUEST['selector'])  && $_REQUEST['selector'] == "hTol"){
            $this->db->join('tbl_seller_rating' , 'tbl_seller_rating.seller_id=tbl_user_master.id' , 'left');
            $this->db->group_by('tbl_seller_rating.seller_id');
            $this->db->where('tbl_seller_rating.status' , 'Unblock');
            $this->db->order_by(count('ratings') , 'asc');
        }


        /* end searching criteareas */
	    $this->db->where('tbl_user_master.status' , 'Unblock');
		$this->db->where('tbl_user_master.verification_status' , 'Verified');
		$this->db->where('tbl_user_master.user_type' , 'Seller');
		$data['get_seller'] = $this->master_model->getRecords('tbl_user_master',FALSE,FALSE,FALSE,$page,$config1["per_page"]);
        /**/

        $data['seller_count'] =$Count;

        /*Sub-Category*/
		$this->db->where('subcategory_status' , '0');
		$this->db->where('is_delete' , '0');
		$data['getSubcat'] = $this->master_model->getRecords('tbl_subcategory_master');
        /**/

        /*Category*/
		$this->db->where('category_status' , '1');
		$this->db->where('is_delete' , '0');
		$data['getCategory'] = $this->master_model->getRecords('tbl_category_master');
        /**/

        $data['pageTitle']       = 'Seller Search - '.PROJECT_NAME;
   	    $data['page_title']      = 'Seller Search - '.PROJECT_NAME;
   	    $data['middle_content']  = 'search/seller/seller-listing-page';
	    $this->load->view('template',$data);
	}
	public function requirments()
	{
        $this->master_model->IsLogged();
        if($this->session->userdata('user_type')!='Seller')
        {
           $this->session->set_flashdata('error' , 'Sorry!!, you cant access this page....');
           redirect(base_url().lcfirst($this->session->userdata('user_type'))."/dashboard");
        }
        /* searching criteareas */
        if(isset($_REQUEST['requirment']) && $_REQUEST['requirment'] != ""){
        $this->db->like('title' , $_REQUEST['requirment']);
        }
 
        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
        	$this->db->like('location' , $_REQUEST['location']);
        }

        if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != ""){
        	$this->db->where_in('tbl_buyer_post_requirement.category_id' ,$_REQUEST['cat_id']);
        }

        /* end searching criteareas */
        
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirments']);

        /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['base_url']             = base_url().'search/requirment';
	    $config1['per_page']             = 9;
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

        /* searching criteareas */
        if(isset($_REQUEST['requirment']) && $_REQUEST['requirment'] != ""){
        $this->db->like('title' , $_REQUEST['requirment']);
        }
 
        if(isset($_REQUEST['location']) && $_REQUEST['location'] != ""){
        	$this->db->like('location' , $_REQUEST['location']);
        }

        if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != ""){
        	$this->db->where_in('tbl_buyer_post_requirement.category_id' ,$_REQUEST['cat_id']);
        }
        $this->db->order_by('tbl_buyer_post_requirement.id' , 'Desc');
        $this->db->where('tbl_buyer_post_requirement.status' , 'Unblock');
        $this->db->where('tbl_buyer_post_requirement.status <>' , 'Delete');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirments'] = $this->master_model->getRecords('tbl_buyer_post_requirement',FALSE,FALSE,FALSE,$page,$config1["per_page"]);

        $data['requirment_count'] =$Count;

        /*Sub-Category*/
		$this->db->where('subcategory_status' , '0');
		$this->db->where('is_delete' , '0');
		$data['getSubcat'] = $this->master_model->getRecords('tbl_subcategory_master');
        /**/

        /*Category*/
		$this->db->where('category_status' , '1');
		$this->db->where('is_delete' , '0');
		$data['getCategory'] = $this->master_model->getRecords('tbl_category_master');
        /**/

        $data['pageTitle']       = 'Requirment Search - '.PROJECT_NAME;
   	    $data['page_title']      = 'Requirment Search - '.PROJECT_NAME;
   	    $data['middle_content']  = 'search/requirment/requirment-listing-page';
	    $this->load->view('template',$data);
	}

    public function requirment_detail($req_id=FALSE)
	{
        $this->master_model->IsLogged();
    	$data['pageTitle']       = 'Requirment detail- '.PROJECT_NAME;
   	    $data['page_title']      = 'Requirment detail - '.PROJECT_NAME;
   	    $data['middle_content']  = 'search/requirment/requirment-listing-page-detail';
        $this->db->where('tbl_buyer_post_requirement.id' , $req_id);
        //$this->db->where('tbl_subcategory_master.is_delete <>','1');
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirmentsDetail']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirmentsDetail']);
	    $this->load->view('template',$data);
	}


	

} //  end class
