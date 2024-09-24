<?php 
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->model('email_sending');
        
	}

    /*
    | Function : Get Data according to conditions given on listing page left menu
    | Author : Deepak Arvind Salunke
    | Date   : 03/05/2017
    | Output: seleted data for condition or Failure
    */

	public function index()
	{
        // Before Pagination
        $subchild_id =array();
        $child       =array();
        // check status and is_deleted conditions
      
       
        
        // if category from left menu bar is selected for listing search
        if(isset($_REQUEST['sercategory_id']) && $_REQUEST['sercategory_id'] != '')
        {
            $this->db->where('parent_id', $_REQUEST['sercategory_id']);
            $get_child_cat = $this->master_model->getRecords('tbl_category_master');
            foreach ($get_child_cat as $child_ids) 
            {
                
                $child[] = $child_ids['category_id'];
                //print_r($child);exit;
                $this->db->where('parent_id', $child_ids['category_id']);
                $get_subchild_cat = $this->master_model->getRecords('tbl_category_master');
                
                foreach ($get_subchild_cat as $subchild_ids) 
                {

                   $subchild_id[] = $subchild_ids['category_id'];
                }

                
            }
            
            
            if(count($subchild_id) > 0 ) 
            {
                //echo "erroe";exit;
                $this->db->where_in('cat_id', $subchild_id);
                
            }
            else if(count($child) > 0 ) 
            {

                 $this->db->where_in('cat_id', $child); 
            }
            else 
            {

                 $this->db->where('cat_id', $_REQUEST['sercategory_id']); 
            }
            
            $this->session->set_userdata('sercategory_id' , $_REQUEST['sercategory_id']);


        } // end if

         $where = array('status' => '1', 'is_delete' => '0');
        // if serach keyword from left menu bar is selected for listing search
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '')
        {
            $this->db->like('title', $_REQUEST['keyword'], 'both');
            //$this->db->or_like('description', $_REQUEST['keyword'], 'both');
        } // end if

        // if Availablity from left menu bar is selected for listing search
        if(isset($_REQUEST['availability']) && $_REQUEST['availability'] != '')
        {
            $this->db->like('availability', $_REQUEST['availability'], 'both');
        } // end if

        // if Listed On from left menu bar is selected for listing search
        if(isset($_REQUEST['chkliston']) && $_REQUEST['chkliston'] != '')
        {
            switch ($_REQUEST['chkliston'])
              {
                  case 'Today':         $this->db->where('created_date <',date("Y-m-d 23:59:59"));
                                        $this->db->where('created_date >',date("Y-m-d 00:00:00"));
                                        break;
                  case 'LastWeek':      $oneweek =  date("Y-m-d",strtotime('-1 week'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$oneweek);
                                        break;
                  case 'LastMonth':     $onemonth =  date("Y-m-d",strtotime('-1 month'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$onemonth);
                                        break;
                  case 'LastYear':      $oneyear =  date("Y-m-d",strtotime('-1 year'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$oneyear); 
                                        break;
              } // end switch
            
        } // end if

        // if Order by / Sort by is selected for listing search
        if(isset($_REQUEST['orderbyprice']) && $_REQUEST['orderbyprice'] != '')
        {
            $this->db->order_by("price", $_REQUEST['orderbyprice']);
        } // end if

        // if product title is used to search listing
        if(isset($_REQUEST['product_title']) && $_REQUEST['product_title'] != '')
        {
            $this->db->like('title', $_REQUEST['product_title'], 'both');
        } // end product_title

        // if country is used to search listing
        if(isset($_REQUEST['country']) && $_REQUEST['country'] != '')
        {
            $this->db->where('country', $_REQUEST['country']);
            $this->session->set_userdata('country' , $_REQUEST['country']);
            

        } // end if

        // if city_name is used to search listing
        if(isset($_REQUEST['countryofresidence']) && $_REQUEST['countryofresidence'] != '')
        {
            $this->db->where('countryofresidence', $_REQUEST['countryofresidence']);
            $this->session->set_userdata('countryofresidence' , $_REQUEST['countryofresidence']);

        } // end if


        // if price_min is used to search listing
        if(isset($_REQUEST['price_min']) && $_REQUEST['price_min'] != '' && isset($_REQUEST['price_max']) && $_REQUEST['price_max'] != '')
        {
            $this->db->where('price >=', $_REQUEST['price_min']);
            $this->db->where('price <=', $_REQUEST['price_max']);
        } // end if

        /*$this->db->order_by('FIELD(payment_type, "free")');*/
        $this->db->order_by('created_date', 'Desc');
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);
        /*echo "<pre>";
        print_r($data['addlisting']);exit;*/
        $data['Count'] = count($data['addlisting']);
        /* create pagination */
        $this->load->library('pagination');

        $config1['total_rows']           = $data['Count'];

        $config1['first_url']            = $_SERVER['QUERY_STRING']!="" ? base_url('listing/index').'/?'.$_SERVER['QUERY_STRING'] : base_url('listing/index');
        $config1['suffix']               = "/?".$_SERVER['QUERY_STRING'];

        $config1['base_url']             = base_url().'listing/index';
        $config1['per_page']             = '10';
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

        // After Pagination
        $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
        $parentcat = $this->master_model->getRecords('tbl_category_master',$where);

        foreach ($parentcat as $key => $value) 
        {
      
            $data['fetchcategory'][]   = $value;

        } // end foreach

       
        $subchild_id = array();
        $child       = array();
        // if category from left menu bar is selected for listing search
        if(isset($_REQUEST['sercategory_id']) && $_REQUEST['sercategory_id'] != '')
        {
            $this->db->where('parent_id', $_REQUEST['sercategory_id']);
            $get_child_cat = $this->master_model->getRecords('tbl_category_master');
            foreach ($get_child_cat as $child_ids) 
            {
                $child[] = $child_ids['category_id'];

                $this->db->where('parent_id', $child_ids['category_id']);
                $get_subchild_cat = $this->master_model->getRecords('tbl_category_master');
                foreach ($get_subchild_cat as $subchild_ids) 
                {
  
                   $subchild_id[] = $subchild_ids['category_id'];
                }
                
            }
            if(count($subchild_id) > 0 ) 
            {
                 //echo "here";exit;
                 $this->db->where_in('cat_id', $subchild_id);
            }
            else if(count($child) > 0 ) 
            {

                 $this->db->where_in('cat_id', $child); 
            }
            else 
            {

                 $this->db->where('cat_id', $_REQUEST['sercategory_id']); 
            }
           
        } // end if
        
       
         // check status and is_deleted conditions
        $where = array('status' => '1', 'is_delete' => '0');
       
        // if serach keyword from left menu bar is selected for listing search
        if(isset($_REQUEST['keyword']) && $_REQUEST['keyword'] != '')
        {
            $this->db->like('title', $_REQUEST['keyword'], 'both');
            //$this->db->or_like('description', $_REQUEST['keyword'], 'both');
        } // end if

        // if Availablity from left menu bar is selected for listing search
        if(isset($_REQUEST['availability']) && $_REQUEST['availability'] != '')
        {
            $this->db->like('availability', $_REQUEST['availability'], 'both');
        } // end if

        // if Listed On from left menu bar is selected for listing search
        if(isset($_REQUEST['chkliston']) && $_REQUEST['chkliston'] != '')
        {
            switch ($_REQUEST['chkliston'])
              {
                  case 'Today':         $this->db->where('created_date <',date("Y-m-d 23:59:59"));
                                        $this->db->where('created_date >',date("Y-m-d 00:00:00"));
                                        $this->db->order_by('created_date', 'Desc');
                                        break;
                  case 'LastWeek':      $oneweek =  date("Y-m-d",strtotime('-1 week'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$oneweek);
                                        $this->db->order_by('created_date', 'Desc');
                                        break;
                  case 'LastMonth':     $onemonth =  date("Y-m-d",strtotime('-1 month'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$onemonth);
                                        $this->db->order_by('created_date', 'Desc');
                                        break;
                  case 'LastYear':      $oneyear =  date("Y-m-d",strtotime('-1 year'));
                                        $this->db->where('created_date <',date("Y-m-d"));
                                        $this->db->where('created_date >',$oneyear);
                                        $this->db->order_by('created_date', 'Desc');
                                        break;
              } // end switch
            
        } // end if

        // if Order by / Sort by is selected for listing search
        if(isset($_REQUEST['orderbyprice']) && $_REQUEST['orderbyprice'] != '')
        {
            $this->db->order_by("price", $_REQUEST['orderbyprice']);
        } // end if

        // if product title is used to search listing
        if(isset($_REQUEST['product_title']) && $_REQUEST['product_title'] != '')
        {
            $this->db->like('title', $_REQUEST['product_title'], 'both');
        } // end if

        // if country is used to search listing
        if(isset($_REQUEST['country']) && $_REQUEST['country'] != '')
        {
            $this->db->where('country', $_REQUEST['country']);
        } // end if

        // if countryofresidence is used to search listing
        if(isset($_REQUEST['countryofresidence']) && $_REQUEST['countryofresidence'] != '')
        {
            $this->db->where('countryofresidence', $_REQUEST['countryofresidence']);
        } // end if

        // if price_min is used to search listing
        if(isset($_REQUEST['price_min']) && $_REQUEST['price_min'] != '' && isset($_REQUEST['price_max']) && $_REQUEST['price_max'] != '')
        {
            $this->db->where('price >=', $_REQUEST['price_min']);
            $this->db->where('price <=', $_REQUEST['price_max']);
        } // end if

        /*$this->db->order_by('created_date', 'Desc');*/
        /*$this->db->order_by('FIELD(payment_type, "free")');*/
        $this->db->order_by('created_date', 'Desc');
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where, FALSE, FALSE, $page,$config1["per_page"]);

        // get the max price fro listing
        $this->db->select_max('price');
        $data['max_price'] = $this->master_model->getRecords('tbl_addlisting');

        // get parent category id for left menu active 
        if(isset($_REQUEST['sercategory_id']) && $_REQUEST['sercategory_id'] != '')
        {          
            $where = array('category_id' => $_REQUEST['sercategory_id'], 'category_status' => '1', 'is_delete' => '0');
            $data['get_child_sub_category'] = $this->master_model->getRecords('tbl_category_master', $where);
            //print_r($data['get_child_sub_category']);exit;
            if(count($data['get_child_sub_category']) > 0)
            {
                $where = array('category_id' => $data['get_child_sub_category'][0]['parent_id'], 'category_status' => '1', 'is_delete' => '0');
                $data['get_sub_category'] = $this->master_model->getRecords('tbl_category_master', $where);

                if(count($data['get_sub_category']) > 0)
                {
                    $where = array('category_id' => $data['get_sub_category'][0]['parent_id'], 'category_status' => '1', 'is_delete' => '0');
                    $data['get_category'] = $this->master_model->getRecords('tbl_category_master', $where);
                }
            }
        }

        $where_country = array('is_delete'=>'0','country_status'=>'1');
        $data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where_country);

        if(isset($_REQUEST['country']) && $_REQUEST['country'] != '')
        {
            $where_residence = array('country_id'=> $_REQUEST['country'],'is_delete'=>'0','residence_status'=>'1');
            $data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where_residence);
        } else {
            $where_countryfromcity = array('residence_id'=> $_REQUEST['countryofresidence'],'is_delete'=>'0','residence_status'=>'1');
            $data['fetchcountryfromcity'] = $this->master_model->getRecords('tbl_residence_master',$where_countryfromcity);

            $_REQUEST['country'] =  $data['fetchcountryfromcity'][0]['country_id'];
            $this->session->set_userdata('country' , $_REQUEST['country']);
            
            if(count($data['fetchcountryfromcity']) > 0 ) {
                $where_residence = array('country_id'=> $data['fetchcountryfromcity'][0]['country_id'],'is_delete'=>'0','residence_status'=>'1');
                $data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where_residence);
            }
        }
        // end if
        
        $data['pageTitle']       = 'Seller Search - '.PROJECT_NAME;
   	    $data['page_title']      = 'Seller Search - '.PROJECT_NAME;
   	    $data['middle_content']  = '/listing';
	    $this->load->view('template',$data);
	}

    public function details()
    {
        $listing_slug = $this->uri->segment(3);
        
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting',array('slug'=>trim($listing_slug)));
        
        if(!empty($data['addlisting'][0]['id']))
        {
            $get_listing_id = $data['addlisting'][0]['id'];
        }
        else
        {
            $get_listing_id = '';
        }

        if(!empty($data['addlisting'][0]['cat_id']))
        {
            $get_listing_cat_id = $data['addlisting'][0]['cat_id'];
        }
        else
        {
            $get_listing_cat_id = '';
        }


        if( count($data['addlisting']) > 0)
        {
            $this->db->group_by('attribute_id'); 
            $data['addlisting_data'] = $this->master_model->getRecords('tbl_addlisting_data', array('listing_id'=>trim($get_listing_id)));
        }

        $this->db->where('tbl_addimage_data.listing_id',$get_listing_id);
        $data['my_image_listing'] = $this->master_model->getRecords('tbl_addimage_data');

        //print_r($data['my_image']);exit;

        // count number of favorite
        $data['favorite_data'] = $this->master_model->getRecords('tbl_myfavorite', array('addlisting_id'=>trim($get_listing_id)));

        $data['nos_favorite'] = count($data['favorite_data']);

        // Similar Listings slider
        $where_arr = array('status' => 1, 'is_delete' => '0', 'cat_id' => $get_listing_cat_id, 'id !=' => $get_listing_id);
        $this->db->order_by("id","desc");
        $this->db->limit(10);
        $data['similarlisting'] = $this->master_model->getRecords('tbl_addlisting', $where_arr);

        // get rating for listing product
        $data['rating_data'] = $this->master_model->getRecords('tbl_listing_rating', array('listing_id'=>trim($get_listing_id)));

        //echo "<pre>"; print_r($data['rating_data']);exit;
        
        foreach($data['rating_data'] as $rating)
        {
            $data['all_rating'] = $rating['rating']+$data['all_rating'];
        }
        
        $data['all_rating'] = $data['all_rating']/count($data['rating_data']);

        $data['pageTitle']       = 'Seller Search - '.PROJECT_NAME;
        $data['page_title']      = 'Seller Search - '.PROJECT_NAME;
        $data['middle_content']  = '/listing-details';
        /*print_r($data);exit;*/
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
        
        $this->db->where('tbl_buyer_post_requirement.requirment_status' , 'open');
        $this->db->join('tbl_subcategory_master' , 'tbl_subcategory_master.subcategory_id = tbl_buyer_post_requirement.subcategory_id');
        $this->db->join('tbl_category_master' , 'tbl_category_master.category_id = tbl_subcategory_master.category_id');
        $data['getRequirmentsDetail']  = $this->master_model->getRecords('tbl_buyer_post_requirement');
        $Count = count($data['getRequirmentsDetail']);
	    $this->load->view('template',$data);
	}

    /*
    | Function : Item add to User Favorite from listing page
    | Author : Deepak Arvind Salunke
    | Date   : 26/04/2017
    | Output: Success or Error
    */

    function addfavorite_listing()
    {
        $data['addlisting_id'] = $data['user_id'] = '';

        $addlisting_id = base64_decode($this->uri->segment(3));
        $user_id = $this->session->userdata('user_id');

        if($user_id != '')
        {
            $data = array('addlisting_id' => $addlisting_id, 'user_id' => $user_id, 'status' => '1');

            if($this->master_model->getRecords('tbl_myfavorite',array('user_id' => $user_id, 'addlisting_id' => $addlisting_id)))
            {
                $arr_response['status'] = "success";
                $arr_response['msg']    = "Your Inquire for Listing is submited";
                echo json_encode($arr_response);
                exit;
            }
            
            $res = $this->master_model->insertRecord('tbl_myfavorite',$data);

            if($res)
            {
                $arr_response['status'] = "success";
                $arr_response['msg']    = "Your Inquire for Listing is submited";
                echo json_encode($arr_response);
                exit;
            }
            else
            {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Your Inquire for Listing is submited";
                echo json_encode($arr_response);
                exit;
            }
            
        }
        redirect(base_url().'home/');
    }

    /*
    | Function : Item add to User Favorite from listing details page
    | Author : Deepak Arvind Salunke
    | Date   : 01/05/2017
    | Output: Success or Error
    */

    function addfavorite_listing_deatils()
    {
        $data['addlisting_id'] = $data['user_id'] = '';

        $addlisting_id = base64_decode($this->uri->segment(3));
        $user_id = $this->session->userdata('user_id');

        if($user_id != '')
        {
            $data = array('addlisting_id' => $addlisting_id, 'user_id' => $user_id, 'status' => '1');

            if($this->master_model->getRecords('tbl_myfavorite',array('user_id' => $user_id, 'addlisting_id' => $addlisting_id)))
            {
                //$this->session->set_flashdata('error','Item already added to Your Favorite');
                redirect(base_url().'listing/details/'.base64_encode($addlisting_id));
            }
            
            $res = $this->master_model->insertRecord('tbl_myfavorite',$data);
            redirect(base_url().'listing/details/'.base64_encode($addlisting_id));
        }
        redirect(base_url().'home/');
    }


    /*
    | Function : Add inquiry form details
    | Author : Deepak Arvind Salunke
    | Date   : 27/04/2017
    | Output: Success or Failure
    */

    function sendinquiry()
    {
        $name = $this->input->post('inquiry_name');
        $email = $this->input->post('inquiry_email');
        $phone = $this->input->post('inquiry_phone');
        $subject = $this->input->post('inquiry_subject');
        $message = $this->input->post('inquiry_message');
        $listing_id = $this->input->post('inquiry_listing_id');
        $user_id = $this->session->userdata('user_id');
        $date_time = date('Y-m-d H:m:s');

        $arr_inquiry_response = array();

        $data = array(
                'name' => $name,
                'email' => $email,
                'mobile_no' => $phone,
                'subject' => $subject,
                'message' => $message,
                'addlisting_id' => $listing_id,
                'user_id' => $user_id,
                'date_time' => $date_time,
                );

        $query = $this->master_model->insertRecord('tbl_contact_inquiries', $data);

        if($query)
        {

            $this->db->where('id',1);
            $email_info=$this->master_model->getRecords('admin_login');

            $addlisting = $this->master_model->getRecords('tbl_addlisting',array('id'=>$listing_id));

            if(isset($email_info) && sizeof($email_info)>0)
            { 
                /* Mail To  Admin */
                $admin_contact_email = $email_info[0]['admin_email'];

                $listing_user_contact_email = $addlisting[0]['email'];

                $user_email = $user_firstname = '';
                if($email != '')
                {
                    $user_email = $email;
                }
                if($name != '')
                {
                    $user_firstname = $name;
                }
                
                // To admin
                $other_info =array(
                                "email"                => $user_email,
                                "name"                 => $user_firstname,
                                "user_firstname"       => $user_firstname,
                                "listing_id"           => $listing_id,
                                "link"                 => base_url('listing/details').'/'.$addlisting[0]['slug'],
                                //"subject"            => $subject,
                                //"mobile_no"          => $mobile_no,
                                "message"              => $message,
                );

                $info_arr   =array(
                                'from'               => $user_email,
                                'to'                 => $admin_contact_email,
                                'subject'            => 'Inquiry Notification Mail - '.PROJECT_NAME,
                                'view'               => 'inquiry-mail-to-admin'
                );
                
                $this->email_sending->sendmail($info_arr,$other_info);

                // to user_email
                $other_info_user=array(
                                
                                "email"              => $user_email,
                                "name"               => $user_firstname,
                                //"subject"          => $subject,
                                //"mobile_no"        => $mobile_no,
                                "user_firstname"     => $user_firstname,
                );
                
                $info_arr_user  =array(
                                'from'               => $admin_contact_email,
                                'to'                 => $user_email,
                                'subject'            => 'Inquiry Notification Mail -'. PROJECT_NAME,
                                'view'               => 'inquiry-mail-to-user'
                );

                $this->email_sending->sendmail($info_arr_user,$other_info_user);

                // to listing_user_contact_email
                $other_info =array(
                                "email"                => $user_email,
                                "name"                 => $user_firstname,
                                "user_firstname"       => $user_firstname,
                                "listing_id"           => $listing_id,
                                "link"                 => base_url('listing/details').'/'.$addlisting[0]['slug'],
                                //"subject"            => $subject,
                                //"mobile_no"          => $mobile_no,
                                "message"            => $message,
                );

                $info_arr   =array(
                                'from'               => $user_email,
                                'to'                 => $listing_user_contact_email,
                                'subject'            => 'Inquiry Notification Mail - '.PROJECT_NAME,
                                'view'               => 'inquiry-mail-to-admin'
                );
                
                $this->email_sending->sendmail($info_arr,$other_info);

            }

            $arr_inquiry_response['inquiry_status'] = "success";
            $arr_inquiry_response['inquiry_msg']    = "Your Inquire for Listing is submited";
            echo json_encode($arr_inquiry_response);
            exit;
        }
        else
        {
            $arr_inquiry_response['inquiry_status'] = "error";
            $arr_inquiry_response['inquiry_msg']    = "Error while submitting your Inquire";
            echo json_encode($arr_inquiry_response);
            exit;
        }
    }
	
    function reportscam()
    {

        $reportscam_name        = $this->input->post('reportscam_name');
        $reportscam_lname        = $this->input->post('reportscam_lname');
        $reportscam_email       = $this->input->post('reportscam_email');
        $reportscam_title       = $this->input->post('reportscam_title');
        $reportscam_listingid   = $this->input->post('reportscam_listing_id');
        $user_id                = $this->session->userdata('user_id');
        $date_time              = date('Y-m-d H:m:s');

        $this->db->where('id',1);
        $email_info=$this->master_model->getRecords('admin_login');
        $addlisting = $this->master_model->getRecords('tbl_addlisting',array('id'=>$reportscam_listingid));

        if(isset($email_info) && sizeof($email_info)>0)
            { 

                
                
                $admin_contact_email = $email_info[0]['admin_email'];
                $user_firstname = $reportscam_name;
                $user_lastname = $reportscam_lname;
                $user_email = $reportscam_email;

                // To admin
                $other_info =array(
                                "name"                 => $user_firstname,
                                "lastname"             => $user_lastname,

                                "email"                => $user_email,
                                "title"                => $reportscam_title,
                                "listing_id"           => $reportscam_listingid,
                                "link"                 => base_url('listing/details').'/'.$addlisting[0]['slug'],
                );

                $info_arr   =array(
                                'from'               => $user_email,
                                'to'                 => $admin_contact_email,
                                'subject'            => 'Myroommate Scam Mail - '.PROJECT_NAME,
                                'view'               => 'report-as-scam'
                );
                
                $this->email_sending->sendmail($info_arr,$other_info);

                $arr_inquiry_response['inquiry_status'] = "success";
                $arr_inquiry_response['inquiry_msg']    = "Your scam report submitted successfully";
                echo json_encode($arr_inquiry_response);
                exit;
            }else
            {
                $arr_inquiry_response['inquiry_status'] = "error";
                $arr_inquiry_response['inquiry_msg']    = "Error while submitting your Inquire";
                echo json_encode($arr_inquiry_response);
                exit;
            }
    }
    
    /*
    | Function : Rating for listing product
    | Author : Deepak Arvind Salunke
    | Date   : 08/05/2017
    | Output: success and failure
    */

    function rating()
    {
        $listing_id = $this->input->post('listing_id');
        $user_id    = $this->session->userdata('user_id');
        $rating     = $this->input->post('rating');

        $where      = array('listing_id' => $listing_id, 'user_id' => $user_id);
        $get_rating = $this->master_model->getRecords('tbl_listing_rating', $where);

        if($get_rating)
        {
            $rating_response['rating_status'] = "error";
            $rating_response['rating_msg']    = "Already Rating Submited for Listing";
            echo json_encode($rating_response);
            exit;
        } // end if

        $data       = array('listing_id' => $listing_id, 'user_id' => $user_id, 'rating' => $rating);
        $query = $this->master_model->insertRecord('tbl_listing_rating', $data);

        if($query)
        {
            $rating_response['rating_status'] = "success";
            $rating_response['rating_msg']    = "Your Rating for Listing is Submited";
            echo json_encode($rating_response);
            exit;
        } // end if
        else
        {
            $rating_response['rating_status'] = "error";
            $rating_response['rating_msg']    = "Error while Submitting Your Rating";
            echo json_encode($rating_response);
            exit;
        } // end if
    } // end rating

} //  end class
