<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index($page_slug=FALSE)
	{
		redirect(base_url()."home/");

	}
	public function display($page_slug=FALSE)
	{
		if($page_slug!=FALSE )
		{
			$data['page_detail']=$this->master_model->getRecords('tbl_dynamic_pages',array('page_slug'=>$page_slug,'page_status'=>'1'));
			if(isset($data['page_detail']) && count($data['page_detail']) > 0 )
			{
				$data['pagetitle'] = $data['page_detail'][0]['page_title_en'];

				// get staff data
				$where=array('staff_status'=>1,'staff_front_status'=>1);
				$this->db->order_by('staff_id','DESC');
				$this->db->limit(4);
				$data['staff'] = $this->master_model->getRecords('tbl_staff_master',$where);

				$data['middle_content']='front_page';
		        $this->load->view('template',$data);
			}
			else
			{
				echo  'Page not found';	// page not found
				exit();
			}
		}
		else
		{
			redirect(base_url()."home/");
		}
	}

	public function importlisting()
	{
		
			$oldlisting = $this->master_model->getRecords('jos_mt_links');

			foreach ($oldlisting as $key => $value) 
			{
				$where=array('id'=>$value['link_id']);
				$listing = $this->master_model->getRecords('tbl_addlisting', $where);

				$arr_data['id'] 		        = $value['link_id'];
				$arr_data['title'] 		        = $value['link_name'];
				$arr_data['slug']				= $value['alias'];
				$arr_data['description']		= $value['link_desc'];
				$arr_data['user_id']			= $value['user_id'];
				$arr_data['status']				= $value['link_published'];
				$arr_data['address']		    = $value['address'];
				$arr_data['mobile']				= $value['telephone'];
				$arr_data['price']				= $value['price'];
				$arr_data['email']				= $value['email'];
				$arr_data['created_date']		= $value['link_created'];
				
				if(count($listing) == 0 ) 
				{
					$this->master_model->insertRecord('tbl_addlisting',$arr_data);
				}
			}

			echo "Completed..";
	}

	public function importimages()
	{
		$img_data = $this->master_model->getRecords('jos_mt_images');

		foreach ($img_data as $key => $image) 
		{
			$arr_data['image_id']  	= $image['img_id'];
			$arr_data['listing_id']	= $image['link_id'];
			$arr_data['image']		= $image['filename'];
			$this->master_model->insertRecord('tbl_addimage_data',$arr_data);
		}
		
		echo "Inserted";
	}

	public function importcategory()
	{
		$category_data = $this->master_model->getRecords('jos_mt_cats');

		foreach ($category_data as $key => $category) 
		{
			$arr_data['category_id'] = $category['cat_id'];

			if($category['cat_parent'] == 0)
			{
				$arr_data['parent_id'] = "1";
			}
			else
			{
				$arr_data['parent_id'] = $category['cat_parent']; 
			}
			$arr_data['category_name'] = $category['cat_name'];
			$arr_data['slug']	= $category['alias'];
			$arr_data['category_description'] = $category['cat_association'];

			if($category['cat_featured'] == "1")
			{
				$arr_data['featured'] = "featured";
			}

			else
			{
				$arr_data['featured'] = "0";
			}

			$arr_data['profile_image'] = $category['cat_image'];
			$arr_data['is_delete'] = "0";

			$this->master_model->insertRecord('tbl_category_master',$arr_data);
		}
		
		echo "Categorys Inserted";
	}

	public function insertcategory()
	{
		//$this->db->where('jos_mt_cl.cat_id' , 82);
		$oldcategorydata = $this->master_model->getRecords('jos_mt_cl');
       	
       	foreach ($oldcategorydata as $key => $value) 
		{

					$data['old_cat_id'] = $value['cat_id'];
					$this->db->where('tbl_addlisting.id' , $value['link_id']);
                    $this->db->update('tbl_addlisting',$data);

			    //echo "<br>".$value['link_id'].' = '.$value['cat_id'];
				/*$where=array('id'=>$value['link_id']);
				$listing = $this->master_model->getRecords('tbl_addlisting', $where);

				if(count($listing) > 0)
				{
					foreach($listing as $linkdata)
					{
							//if($value['cat_id'] == 82) 
							//{
								//$data['cat_id'] = 113;
								$data['old_cat_id'] = 82;
								$this->db->where('tbl_addlisting.id' , $value['link_id']);
                            	$this->db->update('tbl_addlisting',$data);
							//} 
	
					}

				}*/
		}
		echo "done";
	}

	public function addcustomfields()
	{
		$this->db->order_by('id','ASC');
		$limit  = 63850;
		$offset = 500;
		$this->db->limit($offset,$limit);
		$cf_values= $this->master_model->getRecords('jos_mt_cfvalues');
		//echo "<pre>"; print_r($cf_values);exit();
		foreach($cf_values as $key => $value)
		{
			$where=array('cf_id'=>$value['cf_id']);			
			$fields = $this->master_model->getRecords('jos_mt_customfields',$where);
			//echo "<pre>"; count($fields); print_r($fields);exit();
			
			foreach($fields as $field_values)
			{				
				
				$where = array('attribute_slug'=>$field_values['alias']);			
				$customfields = $this->master_model->getRecords('tbl_attribute_master',$where);
				//echo "<pre>"; echo count($customfields); print_r($customfields);exit();

				if(count($customfields) == 0)
				{	
					$data['attribute_name'] = $field_values['caption'];
					$data['attribute_slug']	= $field_values['alias'];

					$this->master_model->insertRecord('tbl_attribute_master',$data);
					$attribute_id  =  $this->db->insert_id();
				} 
				else
				{
					$attribute_id = $customfields[0]['attribute_id'];
				}	

				$addlisting_data['attribute_id'] 	= $attribute_id;
				$addlisting_data['listing_id']		= $value['link_id'];
				$addlisting_data['attribute_slug']	= $field_values['alias'];
				$addlisting_data['attribute_value']	= $value['value'];

				$where = array('attribute_id'		=>	$attribute_id,
						           'listing_id'		=>	$value['link_id'],
						           'attribute_slug'	=>	$field_values['alias'],
						           'attribute_value'=>	$value['value']);	

				$listing_data = $this->master_model->getRecords('tbl_addlisting_data',$where);

				if(count($listing_data) <= 0 )
				{
					$this->master_model->insertRecord('tbl_addlisting_data',$addlisting_data);
				}
					
				$where = array('link_id'=>$value['link_id']);
				$category = $this->master_model->getRecords('jos_mt_cl',$where);
				//echo "<pre>"; echo count($category); print_r($category);exit();
				
				if(count($category) > 0)
				{
					$category_new_id = '';
					
					$ihaveroom 	= array(81, 82,  85, 88, 97, 98, 99, 100);
					if (in_array( intval($category[0]['cat_id']) , $ihaveroom, TRUE))
					{
						$category_new_id = 113;
					}

					$ineedroom 	= array(83, 84, 86, 87, 101, 102, 103, 104);
					if (in_array(intval($category[0]['cat_id']), $ineedroom, TRUE))
					{
						$category_new_id = 114;
					}

					$maid 		= array(119);
					if (in_array(intval($category[0]['cat_id']), $maid, TRUE))
					{
						$category_new_id = 208;
					}

					$villasrend = array(118);
					if (in_array(intval($category[0]['cat_id']), $villasrend, TRUE))
					{
						$category_new_id = 227;
					}

					$apartments = array(116);
					if (in_array(intval($category[0]['cat_id']), $apartments, TRUE))
					{
						$category_new_id = 228;
					}

					$cars 		= array(115);
					if (in_array(intval($category[0]['cat_id']), $cars, TRUE))
					{
						$category_new_id = 229;
					}

					$books		= array(114);
					if (in_array(intval($category[0]['cat_id']), $books, TRUE))
					{
						$category_new_id = 230;
					}

					$freegive	= array(113);
					if (in_array(intval($category[0]['cat_id']), $freegive, TRUE))
					{
						$category_new_id = 226;
					}

					$muscial	= array(112);
					if (in_array(intval($category[0]['cat_id']), $muscial, TRUE))
					{
						$category_new_id = 231;
					}

					$technology = array(110);
					if (in_array(intval($category[0]['cat_id']), $technology, TRUE))
					{
						$category_new_id = 232;
					}

					$personal 	= array(109);
					if (in_array(intval($category[0]['cat_id']), $personal, TRUE))
					{
						$category_new_id = 233;
					}

					$clothes	= array(108);
					if (in_array(intval($category[0]['cat_id']), $clothes, TRUE))
					{
						$category_new_id = 234;
					}

					$appliances = array(107);
					if (in_array(intval($category[0]['cat_id']), $appliances, TRUE))
					{
						$category_new_id = 235;
					}

					$furniture	= array(106);
					if (in_array(intval($category[0]['cat_id']), $furniture, TRUE))
					{
						$category_new_id = 236;
					}

					$jobsinuae	= array(120);
					if (in_array(intval($category[0]['cat_id']), $jobsinuae, TRUE))
					{
						$category_new_id = 222;
					}

				}
				
				if(!empty($category_new_id)) {	

					$addcategoryfields['attribute_id']  	= $attribute_id;
					$addcategoryfields['cat_id']        	= $category_new_id;
					$addcategoryfields['fields_type']   	= $field_values['field_type'];
					$addcategoryfields['fields_elements'] 	= $field_values['field_elements'];

              
					$where = array('attribute_id'=>$attribute_id,
						           'cat_id'=>$category_new_id,
						           'fields_type'=> $field_values['field_type'],
						           'fields_elements'=>$field_values['field_elements']);	

					$category_fields = $this->master_model->getRecords('tbl_category_form_fields',$where);

					if(count($category_fields) <= 0 )
					{
						$this->master_model->insertRecord('tbl_category_form_fields',$addcategoryfields);
						
					}
					
			    }

			}

		}
		echo "done";
	}

	public function add_image()
	{
		$this->db->group_by('jos_mt_images.link_id');
		$old_images = $this->master_model->getRecords('jos_mt_images');
		//echo "<pre>"; print_r($old_images);

		foreach ($old_images as $key => $value) 
		{
			$where=array('id'=>$value['link_id']);
			$listing = $this->master_model->getRecords('tbl_addlisting', $where);
			//echo "<pre>"; print_r($listing);

			if(count($listing) > 0)
			{
				foreach($listing as $linkdata)
				{
					if($value['link_id'] == $linkdata['id'])
					{
						$data['mainphoto'] = $value['filename'];
						$this->db->where('tbl_addlisting.id' , $value['link_id']);
                        $this->db->update('tbl_addlisting',$data);
                        //echo "here";exit;
					}
				}
			}
		}
		echo "done";
	}

	/*public function add_city(){

		$old_cities_id = $this->master_model->getRecords('jos_mt_cats');

		foreach ($old_cities_id as  $value) {
			$this->db->where('tbl_addlisting.old_cat_id',$value['cat_id']);
            $get_new_city_id = $this->master_model->getRecords('tbl_addlisting');

            foreach ($get_new_city_id as  $value1) {
            	
			    $city_name = explode('in', $value['cat_name']);
			    if(!empty($city_name[1]) && $city_name[1] !=""){

                  $ltrim = ltrim($city_name[1]);			    	 
                  $this->db->where('tbl_residence_master.residence_name',rtrim($ltrim));
			      $get_actual_city_id = $this->master_model->getRecords('tbl_residence_master');

                   foreach ($get_actual_city_id as  $value2) {
                        
                  	    $data['country']            = $value2['country_id'];
                  	    $data['countryofresidence'] = $value2['residence_id'];
						
                        $this->db->where('tbl_addlisting.country' ,0);
                        $this->db->where('tbl_addlisting.countryofresidence' ,0);
						$this->db->where('tbl_addlisting.old_cat_id' ,$value1['old_cat_id']);
                        $this->db->update('tbl_addlisting',$data);
                   }
			    }
            }
		}
		echo "done";
	}*/
	/*public function update_slug(){

        $get_listing_records    =  $this->master_model->getRecords('tbl_addlisting');            

        foreach ($get_listing_records as $value) {
        	$data['slug']            = $value['slug'].'~'.$value['id'];
			$this->db->where('tbl_addlisting.id' ,$value['id']);
		    $this->db->update('tbl_addlisting',$data);
        }
        echo "done T";
                  
	}*/

} //  end Class
