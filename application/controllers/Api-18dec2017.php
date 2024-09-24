<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Api18dec2017 extends CI_Controller {

    public  $errorData    =  array();
    public  $success_Data =  array();
    public  $emptyData    =  array();
    
    public function __construct()
    {
        parent::__construct();

        $return_json = array();
        define('PER_PAGE',20);
        define( 'API_ACCESS_KEY', 'AIzaSyAPjcDh81kfXQyRN6RYnHYnfaFLlgvst1U' );
        $this->load->library('encrypt');
    }

    public function sendRespone($data)
    {
        header('content-type:application/json');
        echo json_encode($data);
        exit;
    }
    // Start Get parent categroy 
    public function parentcategorylist()
    {
        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
        $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
        $data['parentcategory'] = $this->master_model->getRecords('tbl_category_master',$where);
        
        if(count($data['parentcategory'])>0) {

            $i=0;
            foreach ($data['parentcategory'] as $key => $value) {

                $listingcnt = 0;
                if($value['parent_id'] == 0)
                {
                  $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $value['category_id']);
                  $level2 = $this->master_model->getRecords('tbl_category_master', $where);
                 
                  foreach($level2 as $lvl2)
                  {
                     $where  = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $lvl2['category_id']);
                     $level3 = $this->master_model->getRecords('tbl_category_master', $where);
                     
                     foreach($level3 as $lvl3)
                     {
                        $where  = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0','tbl_addlisting.status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $lvl3['category_id']);
                        $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                        $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                        $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                        $listingcnt +=  count($level3_listing);
                        
                     }
                  }
                }
                
                $categroy[$i]['category_id']   = $value['category_id'];
                $categroy[$i]['parent_id']     = $value['parent_id'];
                $categroy[$i]['category_name'] = $value['category_name'];

                if($value['logo_image']!='') { 
                    $categroy[$i]['profile_image'] = base_url().'uploads/category_logo/'.$value['logo_image'];
                } else {
                    $categroy[$i]['profile_image'] = base_url().'uploads/category_logo/544683.png';
                }
                $categroy[$i]['ads']                    = $listingcnt;
                //$categroy[$i]['profile_image'] = base_url().'uploads/category_logo/thumbdetail/'.$value['profile_image'];
                $i++;
            }

            $success_Data['message'] =  'Parent Categories.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $categroy;
            $this->sendRespone($success_Data);

        } else {
            
            $errorData['message'] = 'Category Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData);

        }
    } // End Get parent categroy 

    // Start Get child categroy 
    public function childcategorylist()
    {   
        $category_id = $_REQUEST['id'];
        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
        $where = array('parent_id'=>$category_id,'is_delete'=>'0','category_status'=>'1');
        $data['childcategory'] = $this->master_model->getRecords('tbl_category_master',$where);

        if(count($data['childcategory'])>0) {

            $i=0;
            foreach ($data['childcategory'] as $key => $value) {

                $listingcnt = 0;
                if($value['parent_id'] != 0)
                {
                    $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $value['category_id']);
                    $level2 = $this->master_model->getRecords('tbl_category_master', $where);
                    
                    if(count($level2)>0) {
                        foreach($level2 as $lvl2)
                        {
                            $where  = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0','tbl_addlisting.status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $lvl2['category_id']);
                            $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                            $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                            $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                            $listingcnt +=  count($level3_listing);   
                        }
                    } else {

                        $where  = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0','tbl_addlisting.status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $value['category_id']);
                        $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                        $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                        $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                        $listingcnt +=  count($level3_listing);
                    }   
                }

                $categroy[$i]['category_id']   = $value['category_id'];
                $categroy[$i]['parent_id']     = $value['parent_id'];
                $categroy[$i]['category_name'] = $value['category_name'];
                
                if($value['logo_image']!='') { 
                    $categroy[$i]['profile_image'] = base_url().'uploads/category_logo/'.$value['logo_image'];
                } else {
                    $categroy[$i]['profile_image'] = base_url().'uploads/category_logo/544683.png';
                }

                $categroy[$i]['ads']                    = $listingcnt;
                $i++;
            }

            $success_Data['message'] =  'Child Categories.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $categroy;
            $this->sendRespone($success_Data);

        } else {
            
            $errorData['message'] = 'Child Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData);

        }
    } // End Get child categroy 
    // Start Get listings
    /*public function getlistings()
    {
        //
        $price_order = $_REQUEST['price_order'];
        $pagination_limit = 10;
        $page     =  round($pagination_limit * $_REQUEST['page']);
        $startVal =  $page - $pagination_limit;

        $category_id = $_REQUEST['cat_id'];
        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
        if($price_order!= '')
        {
            $this->db->order_by('price', $price_order);    
        }
        $this->db->order_by('created_date', 'Desc');
        $where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
         $this->db->limit($pagination_limit, $startVal);
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);

        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
        if($price_order!= '')
        {
            $this->db->order_by('price', $price_order);    
        }
        $this->db->order_by('created_date', 'Desc');
        $where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
        $data['getTotal'] = $this->master_model->getRecords('tbl_addlisting', $where);
        
        if(count($data['addlisting'])>0){
            $success_Data['total']           =  count($data['getTotal']);
            $success_Data['per_page']        =  $pagination_limit;
            $success_Data['current_page']    =  (int)$_REQUEST['page'];
            $success_Data['last_page']       =  ceil(count($data['getTotal'])/$success_Data['per_page']);


            $i=0;
            foreach ($data['addlisting'] as $key => $value) {

                $listings[$i]['id']          = $value['id'];
                $listings[$i]['title']       = $value['title'];
                $listings[$i]['description'] = $value['description'];
                if($value['mainphoto']!='') {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
                } else {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
                }
                $listings[$i]['price']       = $value['price'];
                $listings[$i]['availability']        = $value['availability'];
                $listings[$i]['address']     = $value['address'];
                $listings[$i]['created_date']= $value['created_date'];



                $this->db->where('tbl_listing_rating.listing_id' , $value['id']);
                $reviews = $this->master_model->getRecords('tbl_listing_rating');
              
                if(count($reviews)>0)
                {
                    $totalStars = 0;
                    foreach($reviews as $review) {
                        $totalStars += $review['rating'];
                    }
                    $average = $totalStars/count($reviews);
                } else {
                    $average = 0;
                }

                $listings[$i]['rating'] = $average; 

                $i++;
            }

            $success_Data['message'] =  'All Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $listings;
            $this->sendRespone($success_Data);


        } else {

            $errorData['message'] = 'Listing Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    } */// End Get listings

    // Start Get listings
    public function getlistingdetails()
    {
        $id = $_REQUEST['id'];
        $this->db->select('id, cat_id, user_id, title, slug, description, mainphoto, price, address, mobile, created_date, country_name, residence_name, availability');
        $this->db->where('tbl_addlisting.id' ,$id);
        $this->db->join('tbl_country_master' , 'tbl_country_master.country_id = tbl_addlisting.country');
        $this->db->join('tbl_residence_master' , 'tbl_residence_master.residence_id = tbl_addlisting.countryofresidence');
        
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting');
        

        $this->db->where('tbl_listing_rating.listing_id' , $id);
        $reviews = $this->master_model->getRecords('tbl_listing_rating');
      
        if(!empty($reviews))
        {
            $numberOfReviews = 0;
            $totalStars = 0;
            foreach($reviews as $review)
            {
                $numberOfReviews++;
                $totalStars += $review['rating'];
            }

            $average = $totalStars/$numberOfReviews;

            $round = number_format($average, 1, '.', '');
        }

        else
        {
            $round = 0;
        }

        $this->db->select('attribute_slug,attribute_value');
        $where = array('listing_id' => $data['addlisting']['0']['id']);
        $data['addlisting1']= $this->master_model->getRecords('tbl_addlisting_data', $where);
    
          if(count($data['addlisting'])>0){

            foreach ($data['addlisting'] as $key => $value) {

                $listings_details['id']             = $value['id'];
                $listings_details['cat_id']         = $value['cat_id'];
                $listings_details['user_id']        = $value['user_id'];
                $listings_details['title']          = $value['title'];
                $listings_details['slug']           = $value['slug'];
                $listings_details['description']    = $value['description'];
                if($value['mainphoto']!='') {
                    $listings_details['mainphoto']  = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
                } else {
                    $listings_details['mainphoto']  = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
                }
                $listings_details['price']          = $value['price'];
                $listings_details['address']        = $value['address'];
                $listings_details['mobile']         = $value['mobile'];
                $listings_details['country_name']   = $value['country_name'];
                $listings_details['residence_name'] = $value['residence_name'];
                $listings_details['availability']   = $value['availability'];
                $listings_details['created_date']   = $value['created_date'];               
                $listings_details['rating'] = $round;               
                //$listings_details[$i]['listing_data'] = $data['addlisting'];
                //$listings_details[$i]['addlisting1']  = $data['addlisting1'];
                $k=0;
                foreach ($data['addlisting1'] as  $value1) {
                $listings_details12[$k]['attribute_slug']       = ucfirst($value1['attribute_slug']);
                $listings_details12[$k]['attribute_value']      = trim($value1['attribute_value']);
                $k++;
                }
            }

            $success_Data['message'] =  'All Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $listings_details;
            $success_Data['data']['dataattributes']    =  $listings_details12;

            $this->sendRespone($success_Data);

        } else {

            $errorData['message'] = 'Details Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    } // End Get listings

    public function getfooterfeaturedlists()
    {

        $this->db->select('id, title, slug, mainphoto, price, created_date');
        $this->db->where('tbl_addlisting.status' ,'1');
        $this->db->where('tbl_addlisting.is_delete' ,'0');
        $this->db->where('tbl_addlisting.payment_type' ,'paid');
        $this->db->order_by('tbl_addlisting.id' , 'DESC');
        $this->db->limit('3');
        $data['featuredlisting'] = $this->master_model->getRecords('tbl_addlisting');


        if(count($data['featuredlisting'])>0){
            $i=0;
            foreach ($data['featuredlisting'] as $key => $value) {

                $featured_listings[$i]['id']         = $value['id'];
                $featured_listings[$i]['title']          = $value['title'];
                $featured_listings[$i]['slug']       = $value['slug'];
                if($value['mainphoto']!='') {
                    $featured_listings[$i]['mainphoto']      = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
                } else {
                    $featured_listings[$i]['mainphoto']      = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
                }
                $featured_listings[$i]['price']          = $value['price'];
                $featured_listings[$i]['created_date']= $value['created_date'];
            }$i++;

            $success_Data['message'] =  'All Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $featured_listings;
            $this->sendRespone($success_Data);

        } else {

            $errorData['message'] = 'Details Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    } // End Get listings

    public function getfeaturedlists()
    {
        $this->db->select('category_id, parent_id, category_name, featured, profile_image, logo_image, category_status, is_delete');
        $this->db->where('category_status' , '1');
        $this->db->where('is_delete' , '0');
        $this->db->where('featured' , 'featured');
        $data['featuredlisting'] = $this->master_model->getRecords('tbl_category_master');
 
        if(count($data['featuredlisting'])>0){
            $i=0;
            foreach ($data['featuredlisting'] as $key => $value) {
                $listingcnt = 0;
                   if($value['parent_id'] == 0)
                   {
                      $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $value['category_id']);
                      $level2 = $this->master_model->getRecords('tbl_category_master', $where);
                     
                      foreach($level2 as $lvl2)
                      {
                         $where  = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $lvl2['category_id']);
                         $level3 = $this->master_model->getRecords('tbl_category_master', $where);
                         
                         foreach($level3 as $lvl3)
                         {
                            $where  = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0', 'tbl_addlisting.cat_id' => $lvl3['category_id']);
                            $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                            $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                            $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                            $listingcnt +=  count($level3_listing);
                            
                         }
                      }
                   }
                   if($value['parent_id'] != 0)
                   {
                      $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $value['category_id']);
                      $level2 = $this->master_model->getRecords('tbl_category_master', $where);

                      if( count($level2) == 0 )
                      {
                         $where = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0', 'tbl_addlisting.cat_id' => $value['category_id']);
                         $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                         $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                         $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                         $listingcnt += count($level3_listing);
                      }
                      else
                      {
                         foreach($level2 as $lvl2)
                         {
                            $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $lvl2['category_id']);
                            $level3 = $this->master_model->getRecords('tbl_category_master', $where);
                       
                            foreach($level3 as $lvl3)
                            {
                               $where = array('tbl_category_master.category_status' => '1', '30.is_delete' => '0', 'tbl_addlisting.cat_id' => $lvl3['category_id']);
                               $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                               $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                               $level3_listing = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                               $listingcnt += count($level3_listing);
                            }
                         }
                      }
                    }

                    $featured_listings[$i]['category_id']           = $value['category_id'];
                    $featured_listings[$i]['parent_id']             = $value['parent_id'];
                    $featured_listings[$i]['featured']              = $value['featured'];
                    $featured_listings[$i]['category_name']         = $value['category_name'];
                    if($value['logo_image']!='') {
                        $featured_listings[$i]['profile_image']     = base_url().'uploads/category_logo/'.$value['logo_image'];
                    } else {
                        $featured_listings[$i]['profile_image']     = base_url().'uploads/category_logo/thumbdetail/no_image.png';
                    }
                    $featured_listings[$i]['category_status']       = $value['category_status'];
                    $featured_listings[$i]['is_delete']             = $value['is_delete'];
                    $featured_listings[$i]['ads']                   = $listingcnt;
                    $i++;
            }

            $success_Data['message'] =  'All Featured Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $featured_listings;
            $this->sendRespone($success_Data);

        } else {

            $errorData['message'] = 'Details Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
        
    } // End Get Featured listings
    public function getcountries()
    {

        $this->db->select('country_id, country_name,country_description,profile_image,country_status, is_delete');
        $this->db->where('country_status' , '1');
        $this->db->where('is_delete' , '0');
       
        $data['countries'] = $this->master_model->getRecords('tbl_country_master');
 
        if(count($data['countries'])>0){
            $i=0;
            foreach ($data['countries'] as $key => $value) {
                $listingcnt = 0;
                   

                    $countries[$i]['country_id']            = $value['country_id'];
                    $countries[$i]['country_name']          = $value['country_name'];
                    $countries[$i]['country_description']   = $value['country_description'];
     
                    if($value['logo_image']!='') {
                        $countries[$i]['profile_image']     = base_url().'uploads/category_logo/'.$value['logo_image'];
                    } else {
                        $featured_listings[$i]['profile_image']     = base_url().'uploads/category_logo/thumbdetail/no_image.png';
                    }
                    $countries[$i]['country_status']        = $value['country_status'];
                    $countries[$i]['is_delete']             = $value['is_delete'];
                    $countries[$i]['countries']             = $listingcnt;
                    $i++;
            }

            $success_Data['message'] =  'All Countries';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $countries;
            $this->sendRespone($success_Data);

        } else {

            $errorData['message'] = 'Details Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    }
    public function signup()
    {
        $firstname      = $_REQUEST['firstname'];
        $lastname       = $_REQUEST['lastname'];
        $mobile_number  = $_REQUEST['mobile_number'];
        $email          = $_REQUEST['uemail'];
        $gender         = $_REQUEST['gender'];
        $country        = $_REQUEST['country'];
        $username       = $_REQUEST['username'];
        $password       = $_REQUEST['password'];
        $ip_address = ""; //$_REQUEST['REMOTE_ADDR'];
        $text_filter= "/^[a-zA-Z]+$/";
        $number_filter= "/^[0-9]+$/";
        $email_filter='/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
        if($firstname!='')
        {
            $firstname = trim($firstname);
            if(!preg_match($text_filter, $firstname))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Invalid First Name";
                echo json_encode($arr_response);
                exit;
            }
        }
        else
        {
            //error
            $arr_response['status'] = "error";
            $arr_response['message']    = "Enter First Name";
            echo json_encode($arr_response);
            exit;
        }
        if($lastname!='')
        {
            $lastname = trim($lastname);
            if(!preg_match($text_filter, $lastname))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Invalid Last Name";
                echo json_encode($arr_response);
                exit;
            }
        }
        else
        {
            //error
            $arr_response['status'] = "error";
            $arr_response['message']    = "Enter Last Name";
            echo json_encode($arr_response);
            exit;
        }
        if($mobile_number!='')
        {
            $mobile_number = trim($mobile_number);
            if(!preg_match($number_filter, $mobile_number))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Invalid Mobile Number";
                echo json_encode($arr_response);
                exit;
            }
        }
        else
        {
            //error
            $arr_response['status'] = "error";
            $arr_response['message']    = "Enter Mobile Number";
            echo json_encode($arr_response);
            exit;
        }
        if($email!='')
        {
            $email = trim($email);
            if(!preg_match($email_filter, $email))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Invalid Email Address";
                echo json_encode($arr_response);
                exit;
            }
            $this->db->select('email');
            $this->db->where('status' , 'Unblock');
            $this->db->where('email' , $email);
       
            $data['users'] = $this->master_model->getRecords('tbl_user_master');

            if(!empty($data['users']))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "This email address already exists";
                echo json_encode($arr_response);
                exit;
            } 
        }
        else
        {
            //error
            $arr_response['status'] = "error";
            $arr_response['message']    = "Enter Emial Address";
            echo json_encode($arr_response);
            exit;
        }
        if($gender=='')
        {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Enter Gender";
                echo json_encode($arr_response);
                exit;
        }
        if($country=='')
        {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "Enter Country";
                echo json_encode($arr_response);
                exit;
        }
        if($username=='')
        {
            $arr_response['status'] = "error";
            $arr_response['message']    = "Enter username";
            echo json_encode($arr_response);
        }
        else
        {
            $arr_response['status'] = "error";
                
            $this->db->select('username');
            $this->db->where('status' , 'Unblock');
            $this->db->where('username' , $username);

            $data['users'] = $this->master_model->getRecords('tbl_user_master');

            if(!empty($data['users']))
            {
                //error
                $arr_response['status'] = "error";
                $arr_response['message']    = "This username already exists";
                echo json_encode($arr_response);
                exit;
            } 
        }
        

        // encryption system for password (same as joomla)
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $salt = '';
        for ($i = 0; $i < 32; $i++) {
            $salt .= $characters[rand(0, $charactersLength - 1)];
        }
        $encrypted = md5($password);
        $encrypted_password = $encrypted.':'.$salt;
        // end encryption
    
        $confirm_code = sha1(uniqid().$email);

        $phonenumberOTP = mt_rand(100000, 999999);

        $arr_Data  =array(
          'firstname'           => $firstname,
          'lastname'            => $lastname,
          'email'               => $email,
          'mobile_number'       => $mobile_number,
          'gender'              => $gender,
          'nationality'         => $country,
          'username'            => $username,
          'ip_address'          => $ip_address,
          'password'            => $encrypted_password,
          'verification_status' => 'Unverified',
          'status'              => 'Unblock',
          'confirm_code'        => $confirm_code,
          'otp'                 => $phonenumberOTP,
          'created_date'        => date('Y-m-d H:m:s')
        );
        // print_r($arr_Data);exit;
        // Check User Already Exist 
        $arr_email_dump=$this->master_model->getRecords('tbl_user_master',array('email'=>trim($email), 'username' => $username));
        if(sizeof($arr_email_dump) > 0)
        {
            if($arr_email_dump[0]["verification_status"] == "Unverified")
            {
                $arr_response['status'] = "error";
                $arr_response['message']    = "User already exits. your verification is pending. Please check verification mail in your email";
                echo json_encode($arr_response);
                exit;
            }
            else
            {
                $arr_response['status'] = "error";
                $arr_response['message']    = "Email Already Exits";
                echo json_encode($arr_response);
                exit;
            }
        }
        // Insert DaTa 
        if($this->master_model->insertRecord('tbl_user_master',$arr_Data))
        {            
            $last_inserted_id  =  $this->db->insert_id();
            // mail send
            $admin_email       =  $this->master_model->getRecords('admin_login', array('id'=>'1'));
            //$admin_contact_email=$email_info[0]['admin_email'];
            $other_info        =  array(
                                  "user_name"    => $firstname,
                                  "user_email"   => $email,
                                  "confirm_code" => '',
                                  "otp"          => $phonenumberOTP,
                                  "message"      =>"You Are Registered Successfully.",
              );            
            $info_arr           = array(
                                  'from'        => $admin_email[0]['admin_email'],
                                  'to'          => $email,
                                  'subject'     => PROJECT_NAME.' - Account Creation',
                                  'view'        => 'user-activation-app'
              );
            $send_mail = $this->email_sending->sendmail($info_arr,$other_info);
            /* Mail To  admin */
            $other_info_user=array(
                  "email"                => $email,
                  //"subject"            => $subject,
                  //"mobile_no"          => $mobile_no,
                  "message"              => "Notification new user has done registeration successfully.",
                
            );        
            $info_arr_user  =array(
                'from'              => $email,
                'to'                => $admin_email[0]['admin_email'],
                'subject'           => 'New Account Creation -'. PROJECT_NAME,
                'view'              => 'user-registaration'
            );
            $send_mail = $this->email_sending->sendmail($info_arr_user,$other_info_user);    
            if($send_mail == 'send')
            {
                $arr_response['status'] = "Success";  
                $arr_response['message']    = "You are register successfully,A 6 digit One-Time Password (OTP) has been sent to your email id,Please enter that OTP & verify your account then you can login to your account.";
                $arr_response['URL']    = base_url().'user/dashboard';
                echo json_encode($arr_response);
                exit;
            }
            else if($send_mail == 'not send')
            {
                $this->db->where('email' ,$email);
                $this->db->delete('tbl_user_master');
                $arr_response['status'] = "Error";
                $arr_response['message']= "Network problem occured please try again";
                echo json_encode($arr_response);
                exit;
            }
        } 
        else 
        {
            $arr_response['status'] = "error";
            $arr_response['message']    = "Problem occured please try again";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function check_login()
    {
        $username           = $_REQUEST['username'];
        $pass               = $_REQUEST['password'];
        if($_REQUEST['username'] == '')
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "Please enter username";
            echo json_encode($arr_response);
            exit;
        }
        if($_REQUEST['password'] == '')
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "Sorry, your using wrong password";
            echo json_encode($arr_response);
            exit;
        }
        // encryption system for password (same as joomla)
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $salt = '';
        for ($i = 0; $i < 32; $i++) {
              $salt .= $characters[rand(0, $charactersLength - 1)];
        }
        $encrypted = md5($pass); 
        $encrypted_password = $encrypted.':'.$salt;

        /*$password_parts       = explode( ':', $pass);
        $main_password      = $password_parts[0];
        $salt               = $password_parts[1];*/
        $this->db->where('username', trim($username));
        $this->db->or_where('email', trim($username));
        $arr_user_check = $this->master_model->getRecords('tbl_user_master');

        if(sizeof($arr_user_check)>0)
        {
            $get_password = explode( ':',$arr_user_check[0]['password']);
            $get_main_password = $get_password[0];
            if($get_main_password == $encrypted)
            {
                if($arr_user_check[0]['status'] == "Unblock")
                {
                    if($arr_user_check[0]['verification_status'] == "Verified")
                    {
                        if(!empty($arr_user_check[0]['countryofresidence']))
                        {
                            $where = array('residence_id'=>$arr_user_check[0]['countryofresidence'], 'is_delete'=>'0','residence_status'=>'1');
                            $cities = $this->master_model->getRecords('tbl_residence_master',$where);
                            if(count($cities)>0)
                            {
                                foreach($cities as $city)
                                {
                                    $countryofresidence = $city["residence_name"];
                                }
                            }
                            else
                            {
                                $countryofresidence = "";
                            }
                        }
                        else
                        {
                            $countryofresidence = "";
                        }
                        if(!empty($arr_user_check[0]['nationality']))
                        {
                            $where = array('country_id'=>$arr_user_check[0]['nationality'], 'is_delete'=>'0','country_status'=>'1');
                            $countries = $this->master_model->getRecords('tbl_country_master',$where);
                            if(count($countries)>0)
                            {
                                foreach($countries as $country)
                                {
                                    $country = $country["country_name"];
                                }
                            }
                            else
                            {
                                $country = "";
                            }
                        }
                        else
                        {
                            $country = "";
                        }
                        $user_data = array(
                           'user_id'                    => $arr_user_check[0]['id'],
                           'user_firstname'             => $arr_user_check[0]['firstname'],
                           'user_lastname'              => $arr_user_check[0]['lastname'],
                           'user_username'              => $arr_user_check[0]['username'],
                           'user_gender'                => $arr_user_check[0]['gender'],
                           'user_email'                 => $arr_user_check[0]['email'],
                           'user_age'                   => $arr_user_check[0]['age'],
                           'user_mobile_number'         => $arr_user_check[0]['mobile_number'],
                           'user_nationality'           => $country,
                           'user_nationality_id'        => $arr_user_check[0]['nationality'],
                           'user_countryofresidence'    => $countryofresidence,
                           'user_countryofresidence_id' => $arr_user_check[0]['countryofresidence'],
                           'user_address'               => $arr_user_check[0]['address'],
                        );

                        //$this->session->set_userdata($user_data);

                        // check current page and redirect user to current page or user dashboard page during login
                        // check user data is completed or not
                        $arr_response['status']     = "Success";
                        $arr_response['message']        = "Login successfull";
                        $arr_response['data']        = $user_data;
                        echo json_encode($arr_response);
                        exit;
                    }
                    else 
                    {
                        $phonenumberOTP = mt_rand(100000, 999999);
                        $admin_email    =  $this->master_model->getRecords('admin_login', array('id'=>'1'));
        
                        $other_info        =  array(
                              "user_name"    => $arr_user_check[0]['firstname'],
                              "user_email"   => $arr_user_check[0]['email'],
                              "confirm_code" => '',
                              "otp"          => $phonenumberOTP,
                              "message"      =>"Use below OTP to verify your account",
                        );
             
                        $info_arr           = array(
                              'from'        => $admin_email[0]['admin_email'],
                              'to'          => $arr_user_check[0]['email'],
                              'subject'     => PROJECT_NAME.' - Verify Account',
                              'view'        => 'forgot-password-mail-to-user-app'
                        );
                        $send_mail = $this->email_sending->sendmail($info_arr,$other_info);    
                        if($send_mail == 'send')
                        {
                            $data['otp'] = $phonenumberOTP;
                            $this->db->where('email',$arr_user_check[0]['email']);
                            $user = $this->db->update('tbl_user_master',$data);
                            $arr_response['status'] = "Unverified";
                            $arr_response['message']    = "OTP verification is pending.Verify";
                            echo json_encode($arr_response);
                            exit;
                            
                        }
                        else if($send_mail == 'not send')
                        {
                
                            $arr_response['status'] = "Error";
                            $arr_response['message']= "Network problem occured please try again";
                            echo json_encode($arr_response);
                            exit;
                        }

                        
                    }
                }
                else 
                {
                    $arr_response['status'] = "Error";
                    $arr_response['message']    = "You are blocked by admin";
                    echo json_encode($arr_response);
                    exit;
                }
            }
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']    = "Sorry, your using wrong password";
                echo json_encode($arr_response);
                exit;
            }
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "User not found";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function get_categories_for_addlisting()
    {
        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
        $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
        $parentcategory = $this->master_model->getRecords('tbl_category_master',$where);
        if(count($parentcategory)>0)
        {
            $i=0;
            $data=[];
            foreach($parentcategory as $category)
            {
                
                $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
                $where = array('parent_id'=>$category['category_id'],'is_delete'=>'0','category_status'=>'1');
                $childcategory = $this->master_model->getRecords('tbl_category_master',$where);

                if(count($childcategory)>0)
                {
                    foreach($childcategory as $child)
                    {
                        $temp_arr = array();
                    
                        $temp_arr['category_id']   = $child['category_id'];
                        $temp_arr['parent_id']     = $child['parent_id'];
                        $temp_arr['category_name'] = $child['category_name'];

                        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
                        $where = array('parent_id'=>$child['category_id'],'is_delete'=>'0','category_status'=>'1');
                        $childchildcategory = $this->master_model->getRecords('tbl_category_master',$where);

                        if(count($childchildcategory)>0)
                        {
                            foreach($childchildcategory as $child2)
                            {
                                $temp_arr2 =array();
                                $temp_arr2['category_id']   = $child2['category_id'];
                                $temp_arr2['parent_id']     = $child2['parent_id'];
                                $temp_arr2['category_name'] = $child2['category_name'];
                        
                                array_push($temp_arr,$temp_arr2);
                            } 

                        }
                        $new_array = [];
                            foreach ($temp_arr as $key => $value) {
                                $check_int= '';
                                $check_int= is_int($key);
                        
                                if($check_int == '1'){
                                $new_array['child_data'][]= $value;
                            }else{
                            $new_array[$key] = $value;  
                            }
                            }
                        array_push($data,$new_array);         
                    }
                   
                }
                
                $i++;
            }

            $arr_response['status'] = "Success";
            $arr_response['message']    = "All categories";
            $arr_response['data']    = $data;
            echo json_encode($arr_response);
            exit;
        }
        else
        {
            $arr_response['status'] = "error";
            $arr_response['message']    = "No records found";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function get_cities()
    {

        if($_REQUEST['country_id']!='')
        {
            $where = array('country_id'=>$_REQUEST['country_id'], 'is_delete'=>'0','residence_status'=>'1');
            $cities = $this->master_model->getRecords('tbl_residence_master',$where);

            if(count($cities)>0)
            {
                $i=0;
                foreach($cities as $value)
                {
                    $data[$i]['residence_id']   = $value['residence_id'];
                    $data[$i]['residence_name'] = $value['residence_name'];
                    $i++;
                }
                $arr_response['status'] = "Success";
                $arr_response['message']    = "All cities";
                $arr_response['data']    = $data;
                echo json_encode($arr_response);
                exit;
            }
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']    = "No records found";
                echo json_encode($arr_response);
                exit;
            } 
        }
        else
        {
            $where = array('is_delete'=>'0','residence_status'=>'1');
            $cities = $this->master_model->getRecords('tbl_residence_master',$where);
            if(count($cities)>0)
            {
                $i=0;
                foreach($cities as $value)
                {
                    $data[$i]['residence_id']   = $value['residence_id'];
                    $data[$i]['residence_name'] = $value['residence_name'];
                    $i++;
                }
                $arr_response['status'] = "Success";
                $arr_response['message']    = "All cities";
                $arr_response['data']    = $data;
                echo json_encode($arr_response);
                exit;
            }
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']    = "No records found";
                echo json_encode($arr_response);
                exit;
            }
        }
    }    
    public function update_mylisting()
    {
        $user_id            = $_REQUEST['user_id'];
        $listing_id         = $_REQUEST['listing_id'];
        $cat_id             = $_REQUEST['category_id'];
        $title              = $_REQUEST['title'];
        $description        = $_REQUEST['description'];
        $mobilenumber       = $_REQUEST['mobilenumber'];
        $email              = $_REQUEST['email'];
        $country            = $_REQUEST['country'];
        $countryofresidence = $_REQUEST['countryofresidence'];
        $address            = $_REQUEST['address'];
        $price              = $_REQUEST['price'];
        $availability       = $_REQUEST['availability'];
        $mainphoto          = $_FILES['mainphoto'];
        $flag=0;
        if(empty($user_id))
        {
            $arr_response['message']    = "Invalid user";
            $flag=1;
        }
        else if(empty($listing_id))
        {
            $arr_response['message']    = "Listing id is required";
            $flag=1;
        }
        else if(empty($cat_id))
        {
            $arr_response['message']    = "Please select category";
            $flag=1;
        }
        else if(empty($title))
        {  
            $arr_response['message']    = "Please enter title";
            $flag=1;
        }
        else if(empty($description))
        {
            $arr_response['message']    = "Please enter description";
            $flag=1;
        }
        else if(empty($mobilenumber))
        {
            $arr_response['message']    = "Please enter mobile number";
            $flag=1;
        }
        else if(empty($email))
        {
            $arr_response['message']    = "Please enter email";
            $flag=1;
        }
        else if(empty($country))
        {
            $arr_response['message']    = "Please select country";
            $flag=1;
        }
        else if(empty($countryofresidence))
        {
            $arr_response['message']    = "Please select countryofresidence";
            $flag=1;
        }
        else if(empty($address))
        {
            $arr_response['message']    = "Please enter address";
            $flag=1;
        }
        else if(empty($price))
        {
            $arr_response['message']    = "Please enter price";
            $flag=1;
        }
        else if(empty($availability))
        {
            $arr_response['message']    = "Please select availability";
            $flag=1;
        }
        else if(empty($mainphoto))
        {
            $arr_response['message']    = "Please uplaod mainphoto";
            $flag=1;
        }
        if($flag==1)
        {
            $arr_response['status'] = "Error"; 
            echo json_encode($arr_response);
            exit;   
        }
        /* Check Image Uploaded or not */
        $config=array(
            'upload_path'=>'uploads/addlisting_images',
            'allowed_types'=>'jpg|jpeg|png',
            'file_name'=>rand(1,9999999),
            'max_size'=>5120
        );
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        //$slugvalue_img = $_REQUEST['img_value'];
        
        if(isset($_FILES['mainphoto']))
        {
            
            if($this->upload->do_upload('mainphoto'))
            {
                $dt=$this->upload->data();
                $file=$dt['file_name'];
                $slugvalue_img = $file;
                $this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
                $this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
            } // end if
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['msg']    = "Error while uploading image . Please try again later.";
                echo json_encode($arr_response);
                exit;
            } // end else
        } // end if
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['msg']    = "Error while uploading image . Please try again later.";
            echo json_encode($arr_response);
            exit;
        } // end else

            // Listing data
        $arr_Data  =array(
            'id'                    => $listing_id,
            'cat_id'                => $cat_id,
            'user_id'               => $user_id,
            'title'                 => $title,
            'description'           => $description,
            'mainphoto'             => $slugvalue_img,
            'mobile'                => $mobilenumber,
            'email'                 => $email,
            'country'               => $country,
            'countryofresidence'    => $countryofresidence,
            'address'               => $address,
            'price'                 => $price,
            'availability'          => $availability                    
        );

        // Update Data 
        $this->db->where('id' , $listing_id);
        if($this->db->update('tbl_addlisting',$arr_Data))
        {
            // delete all the data related to this listing id
            $where = array('listing_id' => $listing_id);
            $count_query = $this->master_model->getRecordCount('tbl_addlisting_data', $where);
            //echo $count_query;exit();
            if( $count_query > 0)
            {
                //$where = array('listing_id' => $listing_id);
                $this->master_model->deleteRecord('tbl_addlisting_data', 'listing_id', $listing_id);
            }

            $where = array('tbl_category_form_fields.cat_id'=>$cat_id);
            $this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');

            $catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

            foreach ($catoptions as $key => $value) {
                $arr_Addlistdata  =array(
                    'listing_id'      => $listing_id,
                    'attribute_id'    => $value['attribute_id'],
                    'attribute_slug'  => $value['attribute_slug'],
                    'attribute_value' => $_REQUEST[$value['attribute_slug']],
                );

                $this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);
            }

                $arr_response['status'] = "success";
                $arr_response['msg']    = "Listing update Successfully!";
                $arr_response['URL']    = base_url().'user/mylisting';
            }
            else
            {
                $arr_response['status'] = "error";
                $arr_response['msg']    = "Error while uploading image . Please try again later.";
                $arr_response['URL']    = base_url().'user/mylisting';
            }
            echo json_encode($arr_response);
            exit;
    }
    public function add_addlisting()
    {
        $flag=1;
        if(empty($_REQUEST['category_id']))
        {
            $arr_response['message'] = "Categeory field is required";
            $flag=0;     
        }
        else if(empty($_REQUEST['user_id']))
        {
            $arr_response['message'] = "Useer field is required";    
            $flag=0;
        }
        else if(empty($_REQUEST['title']))
        {
            $arr_response['message'] = "Title is required";    
            $flag=0;
        }
        else if(empty($_REQUEST['description']))
        {
            $arr_response['message'] = "Title is required";   
            $flag=0;
        }
        else if(empty($_FILES['mainphoto']))
        {
            $arr_response['message'] = "Mainphoto is required";
            $flag=0;
        }
        else if(empty($_REQUEST['mobilenumber']))
        {
            $arr_response['message'] = "Mobile number is required";
            $flag=0;
        }
        else if(empty($_REQUEST['email']))
        {
            $arr_response['message'] = "Email is required";
            $flag=0;
        }
        else if(empty($_REQUEST['country']))
        {
            $arr_response['message'] = "Please select country";
            $flag=0;
        }
        else if(empty($_REQUEST['countryofresidence']))
        {
            $arr_response['message'] = "Please select city";
            $flag=0;
        }
        else if(empty($_REQUEST['payment']))
        {
            $arr_response['message'] = "Type of payment is required";
            $flag=0;
        }
        else if(empty($_REQUEST['availability']))
        {
            $arr_response['message'] = "Please select availability";
            $flag=0;
        }
        else if(empty($_REQUEST['address']))
        {
            $arr_response['message'] = "Address is required";
            $flag=0;
        }
        if($flag==0)
        {
            $arr_response['status'] = 'Error';
            echo json_encode($arr_response);
            exit;
        }
        $user_id                    = $_REQUEST['user_id'];
        $cat_id                     = $_REQUEST['category_id'];
        $title                      = $_REQUEST['title'];
        $description                = $_REQUEST['description'];
        $mobilenumber               = $_REQUEST['mobilenumber'];
        $email                      = $_REQUEST['email'];
        $country                    = $_REQUEST['country'];
        $countryofresidence         = $_REQUEST['countryofresidence'];
        $address                    = $_REQUEST['address'];
        $price                      = number_format($_REQUEST['price'], 2, '.', '');
        $availability               = $_REQUEST['availability'];
        $payment                    = $_REQUEST['payment'];

        // create slug
        $listing_slug = $this->master_model->create_slug($title,'tbl_addlisting','slug');

        // check if slug is already present in database
        $where = array('slug' => $listing_slug);
        $check_slug = $this->master_model->getRecords('tbl_addlisting', $where);

        // if slug is already present in database
        if( count($check_slug) > 0 )
        {
            // get the last id
            $this->db->from('tbl_addlisting')->select('id')->order_by('id', 'DESC')->limit('1');
            $get = $this->db->get();
            foreach($get->result_array() as $last_id)
            {
                $last_id_val = $last_id['id'];
            }
            // increment id with 1 from last id present in database
            $listing_slug = $listing_slug.'-'.($last_id_val + 1);
        }

        /* Check Image Uploaded or not */
        $config=array(
            'upload_path'=>'uploads/addlisting_images',
            'allowed_types'=>'jpg|jpeg|png',
            'file_name'=>rand(1,9999999),
            'max_size'=>5120
            );

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        $slugvalue_img = "noimage.jpg";

        if(isset($_FILES['mainphoto']) && $_FILES['mainphoto']['error']==0)
        {
            if($this->upload->do_upload('mainphoto'))
            {
                $dt=$this->upload->data();
                $file=$dt['file_name'];
                $slugvalue_img = $file;

                $this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
                $this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
            } 
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']    = "Error while image uploading";
                echo json_encode($arr_response);
                exit;
            } 
        } 
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "Error while image uploading";
            echo json_encode($arr_response);
            exit;
        } 

        
        $arr_Data  =array(
                'cat_id'                => $cat_id,
                'user_id'               => $user_id,
                'title'                 => $title,
                'slug'                  => preg_replace('/[^A-Za-z0-9-]/', '-', $listing_slug),
                'description'           => $description,
                'mainphoto'             => $slugvalue_img,
                'mobile'                => $mobilenumber,
                'email'                 => $email, 
                'country'               => $country,
                'countryofresidence'    => $countryofresidence,
                'address'               => $address,
                'price'                 => $price,
                'availability'          => $availability,
                'is_delete'             => 0 ,
                'status'                => 1               
            );
        
        // for free account where data is directly inserted into database
        if($payment == 'free') 
        {
            $arr_Data['payment_type'] = 'free';

            if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
            {
                $last_inserted_id  =  $this->db->insert_id();
                $where = array('tbl_category_form_fields.cat_id'=>$_REQUEST['category_id']);
                $this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');

                $catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

                foreach ($catoptions as $key => $value) {

                    if($value['fields_type']=="selectmultiple") {

                        $selectmultiple = implode(", ",$_REQUEST[$value['attribute_slug']]);

                        $arr_Addlistdata  =array(
                            'listing_id'      => $last_inserted_id,
                            'attribute_id'    => $value['attribute_id'],
                            'attribute_slug'  => $value['attribute_slug'],
                            'attribute_value' => $selectmultiple,
                        );
                    } else {
                        $arr_Addlistdata  =array(
                            'listing_id'      => $last_inserted_id,
                            'attribute_id'    => $value['attribute_id'],
                            'attribute_slug'  => $value['attribute_slug'],
                            'attribute_value' => $_REQUEST[$value['attribute_slug']],
                        );
                    }

                    $this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

                }
                $arr_response['status'] = "Success";
                $arr_response['message']    = "Listing added successfully. To add more images, go to the listing and click on the Image Icon.";
                echo json_encode($arr_response);
                exit;
            } 
            else
            {
                $arr_response['status'] = "Failed";
                $arr_response['message']    = "Problem occured";
                echo json_encode($arr_response);
                exit;
            } 

        } 

        // for paid accounts to check payment and insert data
        else 
        {  
            if(empty($_REQUEST['transaction_id']))
            {
                $arr_response['message'] = "Transaction ID is required";
                $arr_response['status'] = 'Error';
                echo json_encode($arr_response);
                exit;
            }
            if(empty($_REQUEST['transaction_price']))
            {
                $arr_response['message'] = "Address is required";
                $arr_response['status'] = 'Error';
                echo json_encode($arr_response);
                exit;
            }               
            $arr_Data['payment_type'] = 'paid';
            if($this->master_model->insertRecord('tbl_addlisting',$arr_Data))
            {
        
                $last_addlisting_inserted_id  =  $this->db->insert_id();

                // insert data for extra fields which are add through listing data
                $where = array('tbl_category_form_fields.cat_id'=>$_REQUEST['category_id']);
                $this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');

                $catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);

                foreach ($catoptions as $key => $value) 
                {
                    
                        $arr_Addlistdata  =array(
                            'listing_id'      => $last_addlisting_inserted_id,
                            'attribute_id'    => $value['attribute_id'],
                            'attribute_slug'  => $value['attribute_slug'],
                            'attribute_value' => $_POST[$value['attribute_slug']]
                        );

                         
                        $this->master_model->insertRecord('tbl_addlisting_data',$arr_Addlistdata);

                } 
                // end insert data for extra fields which are add through listing data

                // insert transaction record
                $transaction_arr = array(
                                     'transaction_id'   =>     $_REQUEST['transaction_id'],
                                     'user_id'          =>     $_REQUEST['user_id'],
                                     'transaction_price'=>     $_REQUEST['transaction_price'],
                                     'listing_id'       =>     $last_addlisting_inserted_id,
                                     'payment_status'   =>     'complete',  
                                     'payment_date'     =>     date('Y-m-d H:i:s'),
                                     'pament_type'      =>     'paypal'
                                     );

                if($this->master_model->insertRecord('tbl_addlisting_transection',$transaction_arr))
                {   
                    /*$this->db->where('id',1);
                    $email_info=$this->master_model->getRecords('admin_login');

                    $addlisting = $this->master_model->getRecords('tbl_addlisting',array('id'=>$last_addlisting_inserted_id));*/

                    $arr_response['status'] = "Success";
                    $arr_response['msg']    = "Payment transaction done successfully";
                    echo json_encode($arr_response);
                    exit;

                }
                // end insert transaction record
            }     
                
        } // end if else
    } 
    public function delete_mylisting()
    {
        
        if(empty($_REQUEST['addlisting_id']))
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "Addlisting Id is required";
            echo json_encode($arr_response);
            exit;
        }
        
        $data=array('id'=>$_REQUEST['addlisting_id']);
        $result=$this->master_model->getRecords('tbl_addlisting',$data);   
        if(count($result)==0)
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "No such record is present";
            echo json_encode($arr_response);
            exit;
        }
        $data_param['is_delete']=1;
        $this->db->where('id',$_REQUEST['addlisting_id']);
        $result = $this->db->update('tbl_addlisting',$data_param);
        if($result)
        {
            $arr_response['status'] = "Success";
            $arr_response['message']    = "Addlisting deleted successfully";
            echo json_encode($arr_response);
            exit;
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']    = "Problem Occured";
            echo json_encode($arr_response);
            exit;
        }
    }
    //fetching addlisting by its id
    public function get_mylisting()
    {

        $where = array('id'=>$_REQUEST['addlisting_id']);
        $addlisting = $this->master_model->getRecords('tbl_addlisting',$where);
        $data_arr=[];
        if(count($addlisting)>0)
        {
            foreach($addlisting as $value)
            {

                if($value['cat_id']!='')
                {
                    $where = array('category_id'=>$value['cat_id']);
                    $category = $this->master_model->getRecords('tbl_category_master',$where);
                   if(count($category)>0)
                    {
                        foreach($category as $key)
                        {
                            $data['category_name']         = $key['category_name'];     
                            $data['category_id']           = $value['cat_id'];
                        }
                    }
                    else
                    {
                        $data['category_name']         = '';

                    }
                }
                else
                {
                    $data['category_name']         = '';
                }
                /*if($value['old_cat_id']!='')
                {
                    $where = array('category_id'=>$value['old_cat_id']);
                    $category = $this->master_model->getRecords('tbl_category_master',$where);
                    if(count($category)>0)
                    {
                        foreach($category as $key)
                        {
                            $data['old_category_name']         = $key['category_name'];     
                        }
                    }
                    else
                    {
                        $data['old_category_name']         = '';
                    }
                }
                else
                {
                    $data['old_category_name']         = '';
                }*/
                $data['user_id']        = $value['user_id'];
                $data['title']          =$value['title'];
                $data['slug']           = $value['slug'];
                $data['description']    = $value['description'];
                $data['mainphoto']      = $value['mainphoto'];
                $data['mobile']         =$value['mobile'];
                $data['email']          = $value['email'];
                if($value['country']!='')
                {
                    $where = array('country_id'=>$value['country']);
                    $country = $this->master_model->getRecords('tbl_country_master',$where);
                    if(count($country)>0)
                    {
                        foreach($country as $key)
                        {
                            $data['country']         = $key['country_name'];   
                            $data['country_id']      = $value['country']; 
                        }
                    }
                    else
                    {
                        $data['country']         = '';
                    }
                }
                else
                {
                    $data['country']         = '';
                }
                if($value['countryofresidence']!='')
                {
                    $where = array('residence_id'=>$value['countryofresidence']);
                    $countryofresidence = $this->master_model->getRecords('tbl_residence_master',$where);
                    if(count($countryofresidence)>0)
                    {
                        foreach($countryofresidence as $key)
                        {
                            $data['countryofresidence']         = $key['residence_name'];  
                            $data['countryofresidence_id']         = $value['countryofresidence'];     
                        }
                    }
                    else
                    {
                        $data['countryofresidence']         = '';
                    }
                }
                else
                {
                    $data['countryofresidence']         = '';
                }
                $data['payment_type']   = $value['payment_type'];
                $data['availability']   = $value['availability'];
                $data['address']        = $value['address'];
                $data['price']          = $value['price']; 


                $data_arr['common']= $data; 
            }
            /*if(!empty($addlisting[0]['cat_id']))
            {
                $this->db->order_by('tbl_category_form_fields.orderby','ASC');
                $where =array('tbl_category_form_fields.cat_id'=>$addlisting[0]['cat_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1','listing_id'=>trim($_REQUEST['addlisting_id']));
                $this->db->join('tbl_category_form_fields' , 'tbl_category_form_fields.attribute_id = tbl_attribute_master.attribute_id');
                $this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_slug = tbl_addlisting_data.attribute_slug');
                    
                $listing_data = $this->master_model->getRecords('tbl_addlisting_data',$where);

            }
            else
            {*/
                $listing_data = $this->master_model->getRecords('tbl_addlisting_data',array('listing_id'=>trim($_REQUEST['addlisting_id'])));
           // }
            
            $temp =[];
            $data=[];
            if(count($listing_data)>0)
            {
                foreach($listing_data as $value)
                {
                    $data['attribute_slug'] = $value['attribute_slug'];
                    $data['attribute_value'] = $value['attribute_value'];
                    array_push($temp,$data);
                }  
                $new_array = [];
                            foreach ($temp as $key => $value) {
                                $check_int= '';
                                $check_int= is_int($key);
                        
                                if($check_int == '1'){
                                $data_arr['extra'][]= $value;
                            }else{
                            $data_arr[$key] = $value;  
                            }
                            }
                       // array_push($data_arr,$new_array);   
                 
            }
            else
            {   
                $data_arr['extra'] = '';
            }
            
            $arr_response['status'] = "Success";
            $arr_response['message']    = "Addlisting";
            $arr_response['data']    = $data_arr;
            echo json_encode($arr_response);
            exit;
        }
    }
    public function send_inquiry()
    {

        $data= array(
            'addlisting_id'      => $_REQUEST['addlisting_id'],
            'user_id'            => $_REQUEST['user_id'],
            'name'               => $_REQUEST['name'],
            'email'              => $_REQUEST['email'],
            'subject'            => $_REQUEST['subject'],
            'mobile_no'          => $_REQUEST['mobile_no'],
            'message'            => $_REQUEST['message'],
            'date_time'          => date('Y-m-d H:m:s'),
            'seen_status'        => '0'
        );
        if($data['addlisting_id']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Addlisting field is required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['user_id']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "user is field required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['name']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Name is required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['email']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Email is required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['subject']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Subject is required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['mobile_no']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Mobile Number is required";
            echo json_encode($arr_response);
            exit;
        }
        if($data['message']=="")
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Message is required";
            echo json_encode($arr_response);
            exit;
        }

        $result = $this->master_model->insertRecord('tbl_contact_inquiries',$data);
        if($result)
        {
            $arr_response['status']     = "Success";
            $arr_response['message']    = "Inquiry submited successfully";
            echo json_encode($arr_response);
            exit;
        }
        else
        {
            $arr_response['status']     = "Error";
            $arr_response['message']    = "Problem Occured";
            echo json_encode($arr_response);
            exit;
        } 
    }
    public function get_additional_info_addlisting()
    {
        // Additional information in addlist
        if($_REQUEST['category_id'])
        {
            $this->db->order_by('tbl_category_form_fields.orderby','ASC');
            $where =array('tbl_category_form_fields.cat_id'=>$_REQUEST['category_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
            $this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
            $catoptions = $this->master_model->getRecords('tbl_category_form_fields',$where);    

            $i=0;
            $data=[];
            foreach($catoptions as $catoption)
            {
                if($catoption['fields_type']=='text' || $catoption['fields_type']=='textarea' || $catoption['fields_type']=='selectlist' || $catoption['fields_type']=='selectmultiple' || $catoption['fields_type']=='radiobutton' )
                {
                    array_push($data,$catoption);
                }
                $i++;
            }

            $arr_response['status'] = "Success";
            $arr_response['message']    = "Additional Information";
            $arr_response['data']   = $data;
            echo json_encode($arr_response);
            exit;
        }
    }
    public function multiple_images_upload()
    {
        $listing_id  = $_REQUEST['listing_id'];

        if($listing_id == '')
        {
            $arr_response['status']      = "Error";
            $arr_response['message']     = "Listing id is required";
            echo json_encode($arr_response);
            exit;
        }
        
        $valCount   = count($_FILES['images']['name']);
        if( $valCount>0)
        {
            for($i = 0; $i < $valCount; $i++)
            {    
                $_FILES['userFile']['name']     = $_FILES['images']['name'][$i];
                $_FILES['userFile']['type']     = $_FILES['images']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                $_FILES['userFile']['error']    = $_FILES['images']['error'][$i];
                $_FILES['userFile']['size']     = $_FILES['images']['size'][$i];
                    
                $uploadPath = 'uploads/addlisting_images/';
                $config['upload_path']   = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';

                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                                    
                if($this->upload->do_upload('userFile'))
                {
                    $dt=$this->upload->data();
                    $file= $dt['file_name'];
                    $image[] = $file;                       
                }
                else
                {
                    $arr_response['status']      = "Error";
                    $arr_response['message']     = "Error in image uploading";
                    echo json_encode($arr_response);
                    exit;
                }
            } 
            foreach ($image as $value) 
            {
                $img_arr = array(
                'listing_id'=> $listing_id,
                 'image' => $value
                );
                $this->master_model->insertRecord('tbl_addimage_data',$img_arr);
            }
            $arr_response['status']      = "Success";
            $arr_response['message']     = "Image uploading is done successfully";
            echo json_encode($arr_response);
            exit;
        } 
        else 
        {
            $arr_response['status']      = "Error";
            $arr_response['message']     = "There are no images to upload";
            echo json_encode($arr_response);
            exit;
        }  
    }
    public function verify_otp()
    {
        $otp    = $_REQUEST['otp'];
        if($_REQUEST['email_or_username'] == '')
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Username field is empty";
            echo json_encode($arr_response);
            exit; 
        }
        if($otp !="")
        {
            $email_or_username  = $_REQUEST['email_or_username'];
            $this->db->where('otp',$otp);
            $this->db->where('email',$email_or_username);
            $this->db->or_where('username',$email_or_username);
            $users  = $this->db->get('tbl_user_master')->result();
            if(count($users)>0)
            {
                if($users[0]->otp == $otp)
                {
                    $data['verification_status'] = 'Verified';
                    $data['confirm_code']        = '';
                    $this->db->where(array('email'=>$users[0]->email,'otp'=>$otp));
                    $users = $this->db->update('tbl_user_master',$data);
                    $arr_response['status']      = "Success";
                    $arr_response['message']     = "Your account is verified";
                    echo json_encode($arr_response);
                    exit;    
                }
                else
                {
                    $arr_response['status']      = "Error";
                    $arr_response['message']     = "You have entered wrong values.";
                    echo json_encode($arr_response);
                    exit; 
                }       
            }
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']= "You have entered wrong values.";
                echo json_encode($arr_response);
                exit; 
            }    
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "OTP field is empty";
            echo json_encode($arr_response);
            exit; 
        }
    }
    public function get_profile()
    { 
       
        $email = $_REQUEST['email'];

        if($email!="")
        {
            $where = array('email'=>$email);
            $users = $this->master_model->getRecords('tbl_user_master',$where);
            if(count($users)>0)
            {
                if(!empty($users[0]['countryofresidence']))
                {
                $where = array('residence_id'=>$users[0]['countryofresidence'], 'is_delete'=>'0','residence_status'=>'1');
                $cities = $this->master_model->getRecords('tbl_residence_master',$where);

                if(count($cities)>0)
                {
                    foreach($cities as $city)
                    {
                        $countryofresidence = $city["residence_name"];
                    }
                }
                else
                {
                    $countryofresidence = "";
                }
                }
                else
                {
                    $countryofresidence = "";
                }
                if(!empty($users[0]['nationality']))
                {
                    $where = array('country_id'=>$users[0]['nationality'], 'is_delete'=>'0','country_status'=>'1');
                    $countries = $this->master_model->getRecords('tbl_country_master',$where);
                    if(count($countries)>0)
                    {
                        foreach($countries as $country)
                        {      
                            $country = $country["country_name"];
                        }
                    }
                    else
                    {
                        $country = "";
                    }
                }
                else
                {
                    $country = "";
                }
    
                $user_data = array(
                               'user_id'                    => $users[0]['id'],
                               'user_firstname'             => $users[0]['firstname'],
                               'user_lastname'              => $users[0]['lastname'],
                               'user_username'              => $users[0]['username'],
                               'user_gender'                => $users[0]['gender'],
                               'user_email'                 => $users[0]['email'],
                               'user_age'                   => $users[0]['age'],
                               'user_mobile_number'         => $users[0]['mobile_number'],
                               'user_nationality'           => $country,
                               'user_nationality_id'        => $users[0]['nationality'],
                               'user_countryofresidence'    => $countryofresidence,
                               'user_countryofresidence_id' => $users[0]['countryofresidence'],
                               'user_address'               => $users[0]['address'],
                            );
                $arr_response['status'] = "Success";
                $arr_response['message']= "User's profile data";
                $arr_response['data']   = $user_data;
                echo json_encode($arr_response);
                exit;    
            }
            else
            {
                 $arr_response['status'] = "Error";
                 $arr_response['message']= "Invalid Email Address";
                 echo json_encode($arr_response);
                 exit;    
            }
        }
        else 
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Email field is required";
            echo json_encode($arr_response);
            exit; 
        }             
    }
    public function edit_profile()
    {
        if(empty($_REQUEST['email']))
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Email address is required";
            echo json_encode($arr_response);
            exit;
        } 
        if(empty($_REQUEST['user_id']))
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "User parameter required";
            echo json_encode($arr_response);
            exit;
        } 
        if(!empty($_REQUEST['firstname']))
        {
            $data['firstname']          = $_REQUEST['firstname'];
        }
        else
        {
            $data['firstname']          = "";
        }
        if(!empty($_REQUEST['lastname']))
        {
            $data['lastname']           = $_REQUEST['lastname'];
        }
        else
        {
            $data['lastname']= "";    
        }
        if(!empty($_REQUEST['username']))
        {
            $data['username']           = $_REQUEST['username'];
        }
        else
        {
            $data['username']= "";    
        }
        if(!empty($_REQUEST['username']))
        {
            $data['username']           = $_REQUEST['username'];
        }
        else
        {
            $data['username']= "";    
        }
        if(!empty($_REQUEST['age']))
        {
            $data['age']           = $_REQUEST['age'];
        }
        else
        {
            $data['age']= "";    
        }
        if(!empty($_REQUEST['mobile_number']))
        {
            $data['mobile_number']           = $_REQUEST['mobile_number'];
        }
        else
        {
            $data['mobile_number']= "";    
        }
        if(!empty($_REQUEST['nationality']))
        {
            $data['nationality']           = $_REQUEST['nationality'];
        }
        else
        {
            $data['nationality']= "";    
        }
        if(!empty($_REQUEST['countryofresidence']))
        {
            $data['countryofresidence']           = $_REQUEST['countryofresidence'];
        }
        else
        {
            $data['countryofresidence']= "";    
        }
        if(!empty($_REQUEST['address']))
        {
            $data['address']           = $_REQUEST['address'];
        }
        else
        {
            $data['address']= "";    
        }
        if(!empty($_REQUEST['gender']))
        {
            $data['gender']           = $_REQUEST['gender'];
        }
        else
        {
            $data['gender']= "";    
        }

        $data['username']           = $_REQUEST['username'];
        $data['email']              = $_REQUEST['email'];
        $data['age']                = $_REQUEST['age'];
        $data['mobile_number']      = $_REQUEST['mobile_number'];
        $data['nationality']        = $_REQUEST['nationality'];
        $data['countryofresidence'] = $_REQUEST['countryofresidence'];
        $data['address']            = $_REQUEST['address'];
        $data['gender']             = $_REQUEST['gender'];

        $where= array('id !='=>$_REQUEST['user_id'],'email'=>$_REQUEST['email']);
        $email_existance=$this->master_model->getRecords('tbl_user_master',$where);

        if(count($email_existance)>0)
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "This email address already exists";
            echo json_encode($arr_response);
            exit;
        }
 
        $this->db->where('id',$_REQUEST['user_id']);
        $users = $this->db->update('tbl_user_master',$data);

        if(count($users)>0)
        {
            $arr_response['status'] = "Success";
            $arr_response['message']= "Profile edited successfully";
            echo json_encode($arr_response);
            exit; 
        }   
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Problem occured while editing profile";
            echo json_encode($arr_response);
            exit;
        }    
    }
    public function forget_password()
    {
        $email_or_username = $_REQUEST['email_or_username'];
        //$where = array('email'=>$email_or_username);
        $this->db->where('email',$email_or_username);
        $this->db->or_where('username',$email_or_username);
        $user_info  = $this->db->get('tbl_user_master')->result();
    
        if(count($user_info)>0)
        {

            $firstname  = $user_info[0]->firstname;
            $email      = $user_info[0]->email;
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Invalid username or password";
            echo json_encode($arr_response);
            exit;
        }
        $phonenumberOTP = mt_rand(100000, 999999);
        $admin_email    =  $this->master_model->getRecords('admin_login', array('id'=>'1'));
        
        $other_info        =  array(
                              "user_name"    => $firstname,
                              "user_email"   => $email,
                              "confirm_code" => '',
                              "otp"          => $phonenumberOTP,
                              "message"      =>"Use below OTP to reset password",
          );
             
        $info_arr           = array(
                              'from'        => $admin_email[0]['admin_email'],
                              'to'          => $email,
                              'subject'     => PROJECT_NAME.' - Forget Password',
                              'view'        => 'forgot-password-mail-to-user-app'
          );
        $send_mail = $this->email_sending->sendmail($info_arr,$other_info);    
        if($send_mail == 'send')
        {
            $data['otp'] = $phonenumberOTP;
            $this->db->where('email',$email);
            $user = $this->db->update('tbl_user_master',$data);

            $arr_response['status'] = "Success";
            $arr_response['message'] = "A 6 digit One-Time Password (OTP) has been sent to your email id,Please enter that OTP & reset password"; 
            $arr_response['URL']    = base_url().'user/dashboard';
            echo json_encode($arr_response);
            exit;

        }
        else if($send_mail == 'not send')
        {
            $this->db->where('email' ,$email);
            $this->db->delete('tbl_user_master');
            $arr_response['status'] = "Error";
            $arr_response['message']= "Network problem occured please try again";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function update_new_password()
    {
        $email_or_username  = $_REQUEST['email_or_username'];
        $password           = $_REQUEST['new_password'];
        if(empty($email_or_username))
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Email feild is empty";
            echo json_encode($arr_response);
            exit;
        }
        if(!empty($password))
        {

            $this->db->where('email',$email_or_username);
            $this->db->or_where('username',$email_or_username);
            $user = $this->db->get('tbl_user_master',$data)->result(); 

            if(count($user)<1)
            {
                $arr_response['status'] = "Error";
                $arr_response['message']= "Invalid username or password";
                echo json_encode($arr_response);
                exit;
            }

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $salt = '';
            for ($i = 0; $i < 32; $i++) {
                $salt .= $characters[rand(0, $charactersLength - 1)];
            }
            $encrypted = md5($password);
            $encrypted_password = $encrypted.':'.$salt;

            $data['password'] = $encrypted_password ;

            $this->db->where('email',$email_or_username);
            $this->db->or_where('username',$email_or_username);
            $user = $this->db->update('tbl_user_master',$data);
            if($user)
            {
                $arr_response['status'] = "Success";
                $arr_response['message']= "Password changed successfully";
                echo json_encode($arr_response);
                exit;
            }
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']= "Problem occured in change password process";
                echo json_encode($arr_response);
                exit;
            }    
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Password feild is empty";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function resend_otp()
    {
        $email_or_username = $_REQUEST['email_or_username'];
        if($email_or_username=='')
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Please enter username";
            echo json_encode($arr_response);
            exit;
        }
        //$where = array('email'=>$email_or_username);
        $this->db->where('email',$email_or_username);
        $this->db->or_where('username',$email_or_username);
        $user_info  = $this->db->get('tbl_user_master')->result();
    
        if(count($user_info)>0)
        {

            $firstname  = $user_info[0]->firstname;
            $email      = $user_info[0]->email;
        }
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Invalid username or password";
            echo json_encode($arr_response);
            exit;
        }
        $phonenumberOTP = mt_rand(100000, 999999);
        $admin_email    =  $this->master_model->getRecords('admin_login', array('id'=>'1'));
        
        $other_info        =  array(
                              "user_name"    => $firstname,
                              "user_email"   => $email,
                              "confirm_code" => '',
                              "otp"          => $phonenumberOTP,
                              "message"      =>"Use below OTP to verify your account",
          );
             
        $info_arr           = array(
                              'from'        => $admin_email[0]['admin_email'],
                              'to'          => $email,
                              'subject'     => PROJECT_NAME.' - Resend OTP',
                              'view'        => 'forgot-password-mail-to-user-app'
          );
        $send_mail = $this->email_sending->sendmail($info_arr,$other_info);    
        if($send_mail == 'send')
        {
            $data['otp'] = $phonenumberOTP;
            $this->db->where('email',$email);
            $user = $this->db->update('tbl_user_master',$data);

            $arr_response['status'] = "Success";
            $arr_response['message'] = "A 6 digit One-Time Password (OTP) has been sent to your email id."; 
            echo json_encode($arr_response);
            exit;

        }
        else if($send_mail == 'not send')
        {
            
            $arr_response['status'] = "Error";
            $arr_response['message']= "Network problem occured please try again";
            echo json_encode($arr_response);
            exit;
        }
    }
    public function change_password()
    {
        $user_id        = $_REQUEST['user_id'];
        $old_password   = $_REQUEST['old_password'];
        $new_password   = $_REQUEST['new_password'];

        $where = array('id'=>$user_id);
        $user  = $this->master_model->getRecords('tbl_user_master',$where);
        
        if(count($user)>0)
        {
            $get_password = explode( ':',$user[0]['password']);
            $password     = $get_password[0];
            $old_password = md5($old_password);

            if($password == trim($old_password))
            {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $salt = '';
                for ($i = 0; $i < 32; $i++) {
                      $salt .= $characters[rand(0, $charactersLength - 1)];
                }
                $encrypted = md5($new_password); 
                $encrypted_password = $encrypted.':'.$salt;

                $data['password'] = $encrypted_password; 
                $this->db->where('id',$user_id);
                $result = $this->db->update('tbl_user_master',$data);
                if($result)
                {
                    $arr_response['status'] = "Success";
                    $arr_response['message']= "Password changed successfully";
                    echo json_encode($arr_response);
                    exit;
                }
                else
                {
                    $arr_response['status'] = "Error";
                    $arr_response['message']= "Problem occured in change password process";
                    echo json_encode($arr_response);
                    exit;
                }
            } 
            else
            {
                $arr_response['status'] = "Error";
                $arr_response['message']= "You have entered wrong old password";
                echo json_encode($arr_response);
                exit;
            }   
        } 
        else
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Invalid user";
            echo json_encode($arr_response);
            exit;
        }
    } 
    public function received_inquiries()
    {
        if($_REQUEST['user_id']=='')
        {
            $arr_response['status'] = "Error";
            $arr_response['message']= "Invalid user";
            echo json_encode($arr_response);
            exit;
        }
        if($_REQUEST['page'] == '' || $_REQUEST['page']==0){
            $_REQUEST['page'] =1;
        }
        $pagination_limit = 10   ;
        $page     =  round($pagination_limit * $_REQUEST['page']);
        $startVal =  $page - $pagination_limit;
        $login_user_id =$_REQUEST['user_id'];// trim($this->session->userdata('user_id'));
        // before pagination
        $where_arr = array('tbl_user_master.id' => $login_user_id);
        $select = 'tbl_contact_inquiries.*'
                  ;
            /* tbl_addlisting.id as listing_id, tbl_addlisting.user_id as listing_user_id,
                   tbl_user_master.id as user_master_id'*/
        $this->db->join('tbl_addlisting', 'tbl_addlisting.id = tbl_contact_inquiries.addlisting_id');
        $this->db->join('tbl_user_master', 'tbl_user_master.id = tbl_addlisting.user_id');
        $this->db->limit($pagination_limit, $startVal);

        $data['inquiry_data']            = $this->master_model->getRecords('tbl_contact_inquiries', $where_arr, $select);
        $last_page                       =  ceil(count($data['inquiry_data'])/$pagination_limit);
        if($last_page==0)
        {
            $success_Data['status']          = 'Error';
            $success_Data['message']         = 'No records available'; 
            echo json_encode($success_Data);
            exit;
        }
        $success_Data['status']          = 'Success';
        $success_Data['message']         = 'All received inquirires'; 
        
        $success_Data['total']           =  count($data['inquiry_data']);
        $success_Data['per_page']        =  $pagination_limit;
        $success_Data['current_page']    =  (int)$_REQUEST['page'];
        $success_Data['last_page']       =  ceil(count($data['inquiry_data'])/$success_Data['per_page']);
        $success_Data['data']            = $data['inquiry_data'];
        echo json_encode($success_Data);
        exit;
    } 
    public function mylisting()
    {
        
       if(empty($_REQUEST['page']))
       {
            $_REQUEST['page'] = 1;   
       }
       if(empty($_REQUEST['user_id']))
       {
            $errorData['message'] = 'Invalid user';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
       }
        $pagination_limit = 10;
        $page     =  round($pagination_limit * $_REQUEST['page']);
        $startVal =  $page - $pagination_limit;

        $user_id = $_REQUEST['user_id'];
        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
        $this->db->order_by('created_date', 'Desc');
        $where = array('user_id'=>$user_id,'is_delete'=>'0','status'=>'1');
         $this->db->limit($pagination_limit, $startVal);
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);

        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
        $this->db->order_by('created_date', 'Desc');
        $where = array('user_id'=>$user_id,'is_delete'=>'0','status'=>'1');
        $data['getTotal'] = $this->master_model->getRecords('tbl_addlisting', $where);
        
        if(count($data['addlisting'])>0){
            $success_Data['total']           =  count($data['getTotal']);
            $success_Data['per_page']        =  $pagination_limit;
            $success_Data['current_page']    =  (int)$_REQUEST['page'];
            $success_Data['last_page']       =  ceil(count($data['getTotal'])/$success_Data['per_page']);


            $i=0;
            foreach ($data['addlisting'] as $key => $value) {

                $listings[$i]['id']          = $value['id'];
                $listings[$i]['title']       = $value['title'];
                $listings[$i]['description'] = $value['description'];
                if($value['mainphoto']!='') {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
                } else {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
                }
                $listings[$i]['price']       = $value['price'];
                $listings[$i]['availability']        = $value['availability'];
                $listings[$i]['address']     = $value['address'];
                $listings[$i]['created_date']= $value['created_date'];



                $this->db->where('tbl_listing_rating.listing_id' , $value['id']);
                $reviews = $this->master_model->getRecords('tbl_listing_rating');
              
                if(count($reviews)>0)
                {
                    $totalStars = 0;
                    foreach($reviews as $review) {
                        $totalStars += $review['rating'];
                    }
                    $average = $totalStars/count($reviews);
                } else {
                    $average = 0;
                }

                $listings[$i]['rating'] = $average; 

                $i++;
            }

            $success_Data['message'] =  'All Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $listings;
            $this->sendRespone($success_Data);


        } else {

            $errorData['message'] = 'Listing Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    }
    public function delete_inquiry()
    {
        $contact_id = $_REQUEST['contact_id'];

        if($contact_id != '')
        {
            $data=array('contact_id'=>$contact_id);
            $result=$this->master_model->getRecords('tbl_contact_inquiries',$data);   
            if(count($result)==0)
            {
                $arr_response['status'] = "Error";
                $arr_response['message']= "No such record is present";
                echo json_encode($arr_response);
                exit;
            }
            $result=$this->db->delete('tbl_contact_inquiries',$data);
           
                $arr_response['status'] = "Success";
                $arr_response['message']= "Inquiry deleted successfully";
                echo json_encode($arr_response);
                exit;  
        }
        $arr_response['status'] = "Error";
        $arr_response['message']= "Inquiry id is required";
        echo json_encode($arr_response);
        exit;
    }
    public function getlistings()
    {
        if(empty($_REQUEST['category_id']))
        {
            $errorData['message'] = 'Category Id is required';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        } 
        $price_order = $_REQUEST['price_order'];  
        $country_id     = $_REQUEST['country_id'];
        $city_id        = $_REQUEST['countryofresidence_id'];    
       
        $availability   = $_REQUEST['availability'];
        $listed_on      = $_REQUEST['listed_on'];
        $pagination_limit = 10;
        $page     =  round($pagination_limit * $_REQUEST['page']);
        $startVal =  $page - $pagination_limit;
        $category_id = $_REQUEST['category_id'];
        $price =  $_REQUEST['price'];
        $search_key = $_REQUEST['search_key'];
        if($price!='')
        {
            $price = number_format($_REQUEST['price'], 2, '.', '');    
        }
        if($search_key!='')
        {
            $this->db->like('title',$search_key); 
        }
        $this->db->select('tbl_addlisting.id, title, description, mainphoto, price, address,tbl_addlisting.created_date,availability');
        $this->db->from('tbl_addlisting');

        if($country_id!='')
        {
            $this->db->where('country',$country_id);   
        }
        if($city_id!='')
        {
            $this->db->where('countryofresidence',$city_id);   
        }
        if($category_id!='')
        {
            $this->db->where('cat_id',$category_id);   
        }
        if($availability!='')
        {
            $this->db->where('availability',$availability); 
        }
        if($listed_on!='')
        {
            if($listed_on == 'today')
            {
                $this->db->where('date(created_date)',date('Y-m-d'));     
            }
            if($listed_on == 'last_week')
            {
                $current_date = date('Y-m-d '); 
                $before_date  = date('Y-m-d', strtotime('-7 days'));
                $this->db->where('date(created_date) >=',$before_date);
                $this->db->where('date(created_date) <=',$current_date);     
            }
            if($listed_on == 'last_month')
            {
                $this->db->where('month(created_date)',date('m')-1);
            }
            if($listed_on == 'last_year')
            {
                $this->db->where('year(created_date)',date('Y')-1);
            }   
        }
        if($price!='')
        {
            $this->db->where('price',$price);
        }
        $this->db->where('cat_id'       ,   $category_id    );
        $this->db->where('is_delete'    ,   '0'             );
        $this->db->where('status'       ,   '1'             );
        if($price_order!= '')
        {
            $this->db->order_by('price', $price_order);    
        }
        else
        {
            $this->db->order_by('created_date', 'Desc');    
        }
        
        $data['addlisting']=$this->db->get()->result();

        /*$where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
         $this->db->limit($pagination_limit, $startVal);
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);

        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');

        $this->db->order_by('created_date', 'Desc');
        $where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
        $data['getTotal'] = $this->master_model->getRecords('tbl_addlisting', $where);
        */
        if(count($data['addlisting'])>0){
            $success_Data['total']           =  count($data['addlisting']);
            $success_Data['per_page']        =  $pagination_limit;
            $success_Data['current_page']    =  (int)$_REQUEST['page'];
            $success_Data['last_page']       =  ceil(count($data['addlisting'])/$success_Data['per_page']);


            $i=0;
            foreach ($data['addlisting'] as $key => $value) {

                $listings[$i]['id']          = $value->id;
                $listings[$i]['title']       = $value->title;
                $listings[$i]['description'] = $value->description;

                if($value->mainphoto!='') {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/'.$value->mainphoto;
                } else {
                    $listings[$i]['mainphoto']   = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
                }
                $listings[$i]['price']       = $value->price;
                $listings[$i]['availability']= $value->availability;
                $listings[$i]['address']     = $value->address;
                $listings[$i]['created_date']= $value->created_date;
 
                $this->db->where('tbl_listing_rating.listing_id' , $value->id);
                $reviews = $this->master_model->getRecords('tbl_listing_rating');
                if(count($reviews)>0)
                {
                    $totalStars = 0;
                    foreach($reviews as $review) {
                        $totalStars += $review['rating'];
                    }
                    $average = $totalStars/count($reviews);
                } else {
                    $average = 0;
                }
                $listings[$i]['rating'] = $average; 
                $i++;
            }
            $success_Data['message'] =  'All Listing.!';
            $success_Data['status']  =  'Success';
            $success_Data['data']    =  $listings;
            $this->sendRespone($success_Data);
        } else {

            $errorData['message'] = 'Listing Not Available.!';
            $errorData['status']  = 'Error';
            $this->sendRespone($errorData); 
        }
    }
   /* public function categorylist_for_listingpage()
    {
        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
        $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
        $parentcategory = $this->master_model->getRecords('tbl_category_master',$where);
        if(count($parentcategory)>0)
        {
            $i=0;
            $data=[];
            foreach($parentcategory as $category)
            {
                $temp = [];
                $temp['category_id']   = $category['category_id'];
                $temp['parent_id']     = $category['parent_id'];
                $temp['category_name'] = $category['category_name'];   

                $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
                $where = array('parent_id'=>$category['category_id'],'is_delete'=>'0','category_status'=>'1');
                $childcategory = $this->master_model->getRecords('tbl_category_master',$where);    
                
                if(count($childcategory)>0)
                {
                    
                    foreach($childcategory as $child)
                    {
                        $temp_arr1 = array();
                    
                        $temp_arr1['category_id']   = $child['category_id'];
                        $temp_arr1['parent_id']     = $child['parent_id'];
                        $temp_arr1['category_name'] = $child['category_name'];

                        $this->db->select('category_id, parent_id, category_name, profile_image, logo_image');
                        $where = array('parent_id'=>$child['category_id'],'is_delete'=>'0','category_status'=>'1');
                        $childchildcategory = $this->master_model->getRecords('tbl_category_master',$where);

                        if(count($childchildcategory)>0)
                        {
                            foreach($childchildcategory as $child2)
                            {
                                $temp_arr2 =array();
                                $temp_arr2['category_id']   = $child2['category_id'];
                                $temp_arr2['parent_id']     = $child2['parent_id'];
                                $temp_arr2['category_name'] = $child2['category_name'];
                        
                                array_push($temp_arr1,$temp_arr2);
                            } 
                            /*$new_array = [];
                            foreach ($temp_arr2 as $key => $value) 
                            {
                                $check_int= '';
                                $check_int= is_int($key);
                        
                                if($check_int == '1')
                                {
                                    $new_array['child2'][]= $value;
                                }
                                else
                                {
                                    $new_array[$key] = $value;  
                                }
                            }
                            array_push($temp_arr1,$new_array);
                            
                        }       
                    }
                    print_r($temp_arr1);
                    $temp['child1'] = $temp_arr1; 
                    
                }
                array_push($data,$temp);
                $i++;
            }

            $arr_response['status'] = "Success";
            $arr_response['message']    = "All categories";
            $arr_response['data']    = $data;
            echo json_encode($arr_response);
            exit;
        }
        else
        {
            $arr_response['status'] = "error";
            $arr_response['message']    = "No records found";
            echo json_encode($arr_response);
            exit;
        }
    }*/

} //  end class 