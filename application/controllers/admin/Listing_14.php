<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Listing extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->library('upload');
		$this->session_validator->IsLogged();
	}


	public function index()
	{
		redirect(base_url().'admin/listing/manage/');
	}

	public function manage()
	{ 
       
		$data = array();
		$data['page_title'] = 'Manage Listing';
		$data['middle_content']='listing/manage';

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
					if($this->master_model->updateRecord('tbl_addlisting',array('status'=>'0'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Service blocked successfully');
					}
				}
				redirect(base_url().'admin/listing/manage/');
			}
			  #-----unblock -----#
			elseif($action=='active')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					if($this->master_model->updateRecord('tbl_addlisting',array('status'=>'1'),array('id'=>$id)))
					{
						$this->session->set_flashdata('success','Service activated successfully');
					}
				}
				redirect(base_url().'admin/listing/manage/');
			}
				  #-----delete -----#
			elseif($action=='delete')
			{
				for($i=0;$i<$chkbox_count;$i++)
				{
					$id = base64_decode($_REQUEST['checkbox_del'][$i]);
					$this->db->where('id',  $id);
        			$query = $this->db->delete('tbl_addlisting');
					//print_r( $query);  exit;
						if($query)
					{
						$this->session->set_flashdata('success','Record(s) deleted successfully');
					}
				}
				redirect(base_url().'admin/listing/manage/');
			}
		}

		//$this->db->order_by('blogs_added_date','DESC');




		/*$this->db->limit(10);*/
		$this->db->order_by('tbl_addlisting.id','DESC');
		if($_REQUEST['listingsearch']!="") { 
	   		$this->db->like('title', $_REQUEST['listingsearch'], 'both');
	   	}
		$data['fetchdata']=$this->master_model->getRecords('tbl_addlisting',array('status !='=>'2'));
		//echo $this->db->last_query();

        $Count = count($data['fetchdata']);

		/* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    
	    $config1['first_url']            = $_SERVER['QUERY_STRING']!="" ? base_url('admin/listing/manage').'/?'.$_SERVER['QUERY_STRING'] : base_url('admin/listing/manage');
        $config1['suffix']               = "/?".$_SERVER['QUERY_STRING'];

	    $config1['base_url']             = base_url().'admin/listing/manage/';
	    $config1['per_page']             = 8;
	    $config1['uri_segment']          = '4';
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
	    $page        = ($this->uri->segment(4));
	    /* end create pagination */

	    $this->db->order_by('tbl_addlisting.id','DESC');
	    //$this->db->limit(10);
  		if($_REQUEST['listingsearch']!="") { 
	   		$this->db->like('title', $_REQUEST['listingsearch'], 'both');
	   	}

		$data['fetchdata']=$this->master_model->getRecords('tbl_addlisting',array('status !='=>'2'),FALSE,FALSE,$page,$config1["per_page"]);


		//print_r($data['fetchdata']);exit;
		$this->load->view('admin/template',$data);
	}
	

	
	public function edit($id)
	{  
		$data = array();
		$data['page_title'] = 'Edit Listing';
		$data['middle_content']='listing/edit-listing';

		if($id!='')
		{

			$id = base64_decode($id);
			
			/* Retrieving services Details */
			$arr_cond= array('id'=>$id);
			//echo $arr_cond;exit;
			/*$arr_details = $this->master_model->getRecords('tbl_addlisting',$arr_cond);
			echo"<pre>";
			print_r($arr_details);exit;*/

			 $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
				$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($parentcat as $key => $value) {
					
					$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
					$childcat = $this->master_model->getRecords('tbl_category_master',$where);

					foreach ($childcat as $key => $value) {

						$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
						$childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

						foreach ($childchildcat as $key => $value) {
			
							$data['fetchcategory'][]   = $value;

							//echo "<pre>"; print_r($value); exit;
						}
					}
				}
				 
		   	    $addlisting = $this->master_model->getRecords('tbl_addlisting',$arr_cond);

		   	    if( count($addlisting) > 0 )
		   	    {
		   	    	$data['mylisting_data'] = $addlisting;
		   	    	//echo "<pre>"; print_r($addlisting); exit;
		   	    }

		   	    $where = array('is_delete'=>'0','country_status'=>'1');
				$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);




				$where = array('country_id' => $data['mylisting_data']['0']['country'],'is_delete'=>'0','residence_status'=>'1');
				$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);
				

				//print_r($data['fetchresidence']);exit;

				$this->db->order_by('tbl_category_form_fields.orderby','ASC');
				$where = array('tbl_category_form_fields.cat_id'=>$data['mylisting_data'][0]['cat_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
				$this->db->join('tbl_addlisting_data' , 'tbl_addlisting_data.attribute_id=tbl_category_form_fields.attribute_id AND tbl_addlisting_data.listing_id='.$data['mylisting_data'][0]['id']);
				$data['catoptions'] = $this->master_model->getRecords('tbl_category_form_fields',$where);
				/*echo "<pre>";
		   	    print_r($data['mylisting_data']);
		   	    print_r($data['catoptions']);
		   	    echo "</pre>";
		   	    exit;*/

			if(sizeof($addlisting)>0)
			{ 
			    // Get first record specifically
				$arr_main_details = reset($addlisting);
			    // Deallosve $arr_details
				unset($addlisting);
				$data['listing_details']= $arr_main_details;
			//echo $data['adv_details'];exit;
			}

			else
			{
				// No records Found
				redirect(base_url()."admin/listing/");
			}
			/* Following Code block excecutes while saving update record */
			if(isset($_POST['list_edit']) && $_POST['list_edit']==TRUE)
			{
				 
					$cat_id             = $this->input->post('category_name');
					$title        		= $this->input->post('title');
			        $description    	= $this->input->post('description');
			        $mobilenumber 		= $this->input->post('mobile');
			        $email     			= $this->input->post('email');
			        $country     		= $this->input->post('country');
			        $countryofresidence = $this->input->post('countryofresidence');
			        $address     		= $this->input->post('address');
			        $price     			= $this->input->post('price');
			        $availability   	= $this->input->post('availability');

					//echo"hh";exit;
					//$crit= "(blogs_name_en = '$blogs_name_en') AND (blogs_name_ar = '$blogs_name_ar')AND blogs_status <> '2' AND blogs_id <>'$blogs_id' ";

						/* Check Image Uploaded or not */
						$config=array(
							'upload_path'=>'uploads/addlisting_images',
							'allowed_types'=>'jpg|jpeg|png',
							'file_name'=>rand(1,9999999),
							'max_size'=>5120
							);
						$this->load->library('upload',$config);
						$this->upload->initialize($config); //if missing this file error occured "cannot find valid upload path"
						


                        if($this->input->post('oldimage')!=""){

                        	$old_or_default_image = $this->input->post('oldimage');
                        }
                        else{
                           
                            $old_or_default_image = "noimage.jpg";
                        }

						$default_img = 	isset($addlisting['mainphoto'])?$addlisting['mainphoto']:$old_or_default_image;
						if(isset($_FILES['blogs_logo']) && $_FILES['blogs_logo']['error']==0)
						{  
							if($this->upload->do_upload('blogs_logo'))
							{
								$dt=$this->upload->data();
								$file=$dt['file_name'];
								$default_img = $file;
								if($arr_main_details['mainphoto']!="noimage.jpg")
								{
									@unlink($this->config->item('mainphoto').$arr_main_details['mainphoto']);
									@unlink($this->config->item('mainphoto').'thumb/'.$arr_main_details['mainphoto']);
								}

								$this->master_model->createThumb($file,'uploads/addlisting_images/',200,160);
								$this->master_model->createThumbdetail($file,'uploads/addlisting_images/',555,302);
							}
							else
							{
								$this->session->set_flashdata('error',$this->upload->display_errors());
								redirect(base_url()."admin/listing/");
							}
						}

                        

						$arr_details = array('cat_id'      			=> $cat_id,
											'title'    	  			=> $title,
											//'slug'		  		=> $listing_slug,
											'description' 			=> $description,
											'mobile'      			=> $mobilenumber,
											'email'       			=> $email,
											'country'       		=> $country,
											'countryofresidence'    => $countryofresidence,
											'address'       		=> $address,
											'price'       			=> $price,
											'availability'			=> $availability,
						                    'mainphoto'             =>$default_img,
						                    );
						//print_r ($arr_details);exit;
						if($this->master_model->updateRecord('tbl_addlisting',$arr_details,array('id'=>$id)))
						{
							// Record Updation Success
							$this->session->set_flashdata('success','Listing Updated successfully');
							redirect(base_url().'admin/listing/manage');
						}
						else
						{
							// Record Updation Failed
							$this->session->set_flashdata('error','Failed to update Listing');
						}


					redirect(base_url()."admin/listing/edit/".base64_encode($id));
				
			}

			$this->load->view('admin/template',$data);
		}
		else
		{
			//echo "Step three";
			exit;
			// Parameter missing
			redirect(base_url()."admin/listing/");
		}
	}

	public function toggle_status($id,$status)
	{
		if($id!='' && $status!='' )
		{
			if($status=="0")
			{
				$id = base64_decode($id);
				if($this->master_model->updateRecord('tbl_addlisting',array('status'=>'0'),array('id'=>$id)))
				{
					$this->session->set_flashdata('success','Status update successfully');
				}
			}
			elseif($status=="1")
			{
				$id = base64_decode($id);
				if($this->master_model->updateRecord('tbl_addlisting',array('status'=>'1'),array('id'=>$id)))
				{
					$this->session->set_flashdata('success','Status updated successfully ');
				}
			}
			elseif($status=="2")
			{
				$id = base64_decode($id);

					//if($this->master_model->updateRecord('tbl_addlisting',array('status'=>'2','is_delete'=>'1'),array('id'=>$id)))
				$this->db->where('id',  $id);
       			$query = $this->db->delete('tbl_addlisting');
        		if($query)
					{
						$this->session->set_flashdata('success','Record(s) Deleted Successfully');
					}

			}
			redirect(base_url()."admin/listing/manage/");
		}
		else
		{
			// Parameter missing
			redirect(base_url()."admin/services/");
		}
	}
	
	public function details($id)
	{
		$id=base64_decode($id);
		$data['page_title']='Listing Details';
		$arr_cond= array('id'=>$id);
			//echo $arr_cond;exit;
			/*$arr_details = $this->master_model->getRecords('tbl_addlisting',$arr_cond);
			echo"<pre>";
			print_r($arr_details);exit;*/

			 $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
				$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

				foreach ($parentcat as $key => $value) {
					
					$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
					$childcat = $this->master_model->getRecords('tbl_category_master',$where);

					foreach ($childcat as $key => $value) {

						$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
						$childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

						foreach ($childchildcat as $key => $value) {
			
							$data['fetchcategory'][]   = $value;

							//echo "<pre>"; print_r($value); exit;
						}
					}
				}
				 
		   	    $addlisting = $this->master_model->getRecords('tbl_addlisting',$arr_cond);

		   	    if( count($addlisting) > 0 )
		   	    {
		   	    	$data['mylisting_data'] = $addlisting;
		   	    	//echo "<pre>"; print_r($addlisting); exit;
		   	    }

		   	    $where = array('is_delete'=>'0','country_status'=>'1');
				$data['fetchcountry'] = $this->master_model->getRecords('tbl_country_master',$where);



				$where = array('country_id' => $data['mylisting_data']['0']['country'],'is_delete'=>'0','residence_status'=>'1');
				$data['fetchresidence'] = $this->master_model->getRecords('tbl_residence_master',$where);
				

				//print_r($data['fetchresidence']);exit;

				$this->db->order_by('tbl_category_form_fields.orderby','ASC');
				$where = array('tbl_category_form_fields.cat_id'=>$data['mylisting_data'][0]['cat_id'],'tbl_category_form_fields.is_delete'=>'0','tbl_category_form_fields.status'=>'1');
				$this->db->join('tbl_attribute_master' , 'tbl_attribute_master.attribute_id=tbl_category_form_fields.attribute_id');
				$this->db->join('tbl_addlisting_data' , 'tbl_addlisting_data.attribute_id=tbl_category_form_fields.attribute_id AND tbl_addlisting_data.listing_id='.$data['mylisting_data'][0]['id']);
				$data['catoptions'] = $this->master_model->getRecords('tbl_category_form_fields',$where);
		//print_r($data['fetchdata']);exit;
		$data['middle_content']='listing/listing-details';
		$this->load->view('admin/template',$data);
	}
	
	public function fetch_city(){

        $output = "";
        $where  = array('country_id' => $_POST['country_id'],'is_delete'=>'0','residence_status'=>'1');
		$fetchresidence = $this->master_model->getRecords('tbl_residence_master',$where);
		
       
	    /*echo $output = print_r($fetchresidence);*/
	    $output = '<option value="">Select City</option>';

	    foreach ($fetchresidence as $city) {
	    $output .= '<option value="'.$city['residence_id'].'">'.$city['residence_name'].'</option>';
	    }
	  
	    echo $output;

	}
	
}
?>