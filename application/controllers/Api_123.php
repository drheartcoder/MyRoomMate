<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Api_123 extends CI_Controller {

	public  $errorData    =  array();
	public	$success_Data =  array();
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
				$categroy[$i]['ads'] 		 			= $listingcnt;
				//$categroy[$i]['profile_image'] = base_url().'uploads/category_logo/thumbdetail/'.$value['profile_image'];
				$i++;
			}

			$success_Data['message'] =  'Parent Categories.!';
			$success_Data['status']  =  'Success';
        	$success_Data['data']    =  $categroy;
			$this->sendRespone($success_Data);

		} else {
			
			$errorData['message'] = 'Category Not Available.!';
			$errorData['status']  = 'Failed';
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

				$categroy[$i]['ads'] 		 			= $listingcnt;
				$i++;
			}

			$success_Data['message'] =  'Child Categories.!';
			$success_Data['status']  =  'Success';
        	$success_Data['data']    =  $categroy;
			$this->sendRespone($success_Data);

		} else {
			
			$errorData['message'] = 'Child Not Available.!';
			$errorData['status']  = 'Failed';
			$this->sendRespone($errorData);

		}
    } // End Get child categroy 


    // Start Get listings
	public function getlistings()
	{
		//
		$pagination_limit = 10;
		$page     =  round($pagination_limit * $_REQUEST['page']);
        $startVal =  $page - $pagination_limit;

		$category_id = $_REQUEST['cat_id'];
		$this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
		$this->db->order_by('created_date', 'Desc');
		$where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
		 $this->db->limit($pagination_limit, $startVal);
        $data['addlisting'] = $this->master_model->getRecords('tbl_addlisting', $where);

        $this->db->select('id, title, description, mainphoto, price, address, created_date,availability');
		$this->db->order_by('created_date', 'Desc');
		$where = array('cat_id'=>$category_id,'is_delete'=>'0','status'=>'1');
        $data['getTotal'] = $this->master_model->getRecords('tbl_addlisting', $where);
        
        if(count($data['addlisting'])>0){
        	$success_Data['total']    		 =  count($data['getTotal']);
			$success_Data['per_page']    	 =  $pagination_limit;
			$success_Data['current_page']    =  (int)$_REQUEST['page'];
			$success_Data['last_page']       =  ceil(count($data['getTotal'])/$success_Data['per_page']);


        	$i=0;
        	foreach ($data['addlisting'] as $key => $value) {

        		$listings[$i]['id'] 		 = $value['id'];
        		$listings[$i]['title'] 		 = $value['title'];
        		$listings[$i]['description'] = $value['description'];
        		if($value['mainphoto']!='') {
        			$listings[$i]['mainphoto'] 	 = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
        		} else {
        			$listings[$i]['mainphoto'] 	 = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
        		}
        		$listings[$i]['price'] 		 = $value['price'];
        		$listings[$i]['availability'] 		 = $value['availability'];
        		$listings[$i]['address'] 	 = $value['address'];
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

				$listings[$i]['rating']	= $average; 

        		$i++;
        	}

        	$success_Data['message'] =  'All Listing.!';
			$success_Data['status']  =  'Success';
        	$success_Data['data']    =  $listings;
			$this->sendRespone($success_Data);


        } else {

        	$errorData['message'] = 'Listing Not Available.!';
			$errorData['status']  = 'Failed';
			$this->sendRespone($errorData);	
        }
	} // End Get listings

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

        		$listings_details['id'] 		 	= $value['id'];
        		$listings_details['cat_id'] 	 	= $value['cat_id'];
        		$listings_details['user_id'] 	 	= $value['user_id'];
        		$listings_details['title'] 		 	= $value['title'];
        		$listings_details['slug'] 		 	= $value['slug'];
        		$listings_details['description'] 	= $value['description'];
        		if($value['mainphoto']!='') {
        			$listings_details['mainphoto'] 	= base_url().'uploads/addlisting_images/'.$value['mainphoto'];
        		} else {
        			$listings_details['mainphoto'] 	= base_url().'uploads/addlisting_images/thumb/5624165.JPG';
        		}
        		$listings_details['price'] 		 	= $value['price'];
        		$listings_details['address'] 	 	= $value['address'];
        		$listings_details['mobile'] 	 	= $value['mobile'];
        		$listings_details['country_name']	= $value['country_name'];
        		$listings_details['residence_name']	= $value['residence_name'];
        		$listings_details['availability']	= $value['availability'];
        		$listings_details['created_date']	= $value['created_date'];        		
        		$listings_details['rating']	= $round;        		
        		//$listings_details[$i]['listing_data']	= $data['addlisting'];
        		//$listings_details[$i]['addlisting1']  = $data['addlisting1'];
        		$k=0;
        		foreach ($data['addlisting1'] as  $value1) {
        		$listings_details12[$k]['attribute_slug']   	= ucfirst($value1['attribute_slug']);
        		$listings_details12[$k]['attribute_value']   	= trim($value1['attribute_value']);
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
			$errorData['status']  = 'Failed';
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

        		$featured_listings[$i]['id'] 		 = $value['id'];
        		$featured_listings[$i]['title'] 		 = $value['title'];
        		$featured_listings[$i]['slug'] 		 = $value['slug'];
        		if($value['mainphoto']!='') {
        			$featured_listings[$i]['mainphoto'] 	 = base_url().'uploads/addlisting_images/'.$value['mainphoto'];
        		} else {
        			$featured_listings[$i]['mainphoto'] 	 = base_url().'uploads/addlisting_images/thumb/5624165.JPG';
        		}
        		$featured_listings[$i]['price'] 		 = $value['price'];
        		$featured_listings[$i]['created_date']= $value['created_date'];
        	}$i++;

        	$success_Data['message'] =  'All Listing.!';
			$success_Data['status']  =  'Success';
        	$success_Data['data']    =  $featured_listings;
			$this->sendRespone($success_Data);

        } else {

        	$errorData['message'] = 'Details Not Available.!';
			$errorData['status']  = 'Failed';
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

	                $featured_listings[$i]['category_id'] 		 	= $value['category_id'];
	        		$featured_listings[$i]['parent_id'] 		 	= $value['parent_id'];
	        		$featured_listings[$i]['featured'] 		 		= $value['featured'];
	        		$featured_listings[$i]['category_name'] 		= $value['category_name'];
	        		if($value['logo_image']!='') {
	        			$featured_listings[$i]['profile_image'] 	= base_url().'uploads/category_logo/'.$value['logo_image'];
	        		} else {
	        			$featured_listings[$i]['profile_image'] 	= base_url().'uploads/category_logo/thumbdetail/no_image.png';
	        		}
	        		$featured_listings[$i]['category_status'] 		= $value['category_status'];
	        		$featured_listings[$i]['is_delete']				= $value['is_delete'];
	                $featured_listings[$i]['ads'] 		 			= $listingcnt;
	        		$i++;
	        }

	    	$success_Data['message'] =  'All Featured Listing.!';
			$success_Data['status']  =  'Success';
        	$success_Data['data']    =  $featured_listings;
			$this->sendRespone($success_Data);

        } else {

        	$errorData['message'] = 'Details Not Available.!';
			$errorData['status']  = 'Failed';
			$this->sendRespone($errorData);	
        }
        
	} // End Get Featured listings

} //  end class 