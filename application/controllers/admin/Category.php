<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->session_validator->IsLogged();

		
	}

	/* category listing and added the links for  add/update/delete/block/unbloack */
    public function manage()
	{
	   	$data['pageTitle'] ='Manage category ';
	   	$data['page_title']='Manage Category';
	   	if(isset($_REQUEST['checkbox_del']) && $_REQUEST['checkbox_del']!="")
	   	{
			$chkbox_count=count($_REQUEST['checkbox_del']);
			$action=$_REQUEST['act_status'];

			#----- delete ----#
			if($action=='delete')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
					$this->master_model->updateRecord('tbl_category_master',array('is_delete'=>'1'),array('category_id'=>$_REQUEST['checkbox_del'][$i]));
				}
			   	redirect(base_url().ADMIN_PANEL_NAME.'category/manage/');
			}

			#-----block -----#
			if($action=='block')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_category_master',array('category_status'=>'0'),array('category_id'=>$_REQUEST['checkbox_del'][$i]));
				}
				$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'category/manage/');
			}

			#-----unblock -----#
			if($action=='active')
			{
			   	for($i=0;$i<$chkbox_count;$i++)
			   	{
				   $this->master_model->updateRecord('tbl_category_master',array('category_status'=>'1'),array('category_id'=>$_REQUEST['checkbox_del'][$i]));
			   	}
			   	$this->session->set_flashdata('success','Record(s) status updated successfully.');
			   	redirect(base_url().ADMIN_PANEL_NAME.'category/manage/');
			}
	   	}
	   	

		$where = array('parent_id'=>'0','is_delete'=>'0');
        $parentcat = $this->master_model->getRecords('tbl_category_master',$where);

        foreach ($parentcat as $key => $value) {
          	
          $data['fetchcategory'][]   = $value;

          $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0');
          $childcat = $this->master_model->getRecords('tbl_category_master',$where);

          foreach ($childcat as $key => $value) {
      	
      		$data['fetchcategory'][]   = $value;

            $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0');
            $childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

            foreach ($childchildcat as $key => $value) {
      
              $data['fetchcategory'][]   = $value;
            }
          }
        }
		
		
		$config['base_url']=base_url().ADMIN_PANEL_NAME."category/manage/";
		$data['middle_content']='category/manage-category';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Add Category Function Start Here*/
	public function add()
	{
		$data['pageTitle']  ='Add Category ';
		$data['page_title'] ='Add Category';
		if(isset($_POST['btn_add_category']))
		{
			
			$this->form_validation->set_rules('parent_id','Select Parent Category Name','required');
			$this->form_validation->set_rules('category_name','Category  Name','required');
			$this->form_validation->set_rules('category_description','Category  Description','required');
			//$this->form_validation->set_rules('page_img'     ,'Category Image','required');
			if($this->form_validation->run())
			{
				
				$parent_id 			  = $this->input->post("parent_id",true);
				$name 				  = $this->input->post("category_name",true);
				$description    	  = $this->input->post("category_description",true);
				$meta_tag_title    	  = $this->input->post("meta_tag_title",true);
				$meta_tag_description = $this->input->post("meta_tag_description",true);
				$meta_tag_keywords    = $this->input->post("meta_tag_keywords",true);
				//$category_description=$this->input->post("category_description",true);


				if($this->master_model->getRecords('tbl_category_master',array('parent_id'=>'0','category_name'=>$name, 'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Category name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'category/add/');
				}
				else
				{ $feature	=	$this->input->post('featured');

					/*$config=array(
					'upload_path'    => 'uploads/cat_logo',
					'allowed_types'  => 'jpg|jpeg|png',
					'file_name'      => rand(1,9999999),
					'max_size'       => 5120
					);*/

					/*$this->load->library('upload',$config);
					$this->upload->initialize($config);  */

					
					/*$default_img = 	"";
					if(isset($_FILES['page_img']) && $_FILES['page_img']['error']==0)
					{
						if($this->upload->do_upload('page_img'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							$default_img = $file;
							
							$this->master_model->createThumb($file,'uploads/cat_logo/',400,250);
						}
						else
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url().ADMIN_PANEL_NAME."category/add");
						}
					}
					else
					{
						$this->session->set_flashdata('error',"Category image field is required");
						redirect(base_url().ADMIN_PANEL_NAME."category/add");
					}*/
					$config1=array(
					'upload_path'    => 'uploads/category_logo',
					'allowed_types'  => 'jpg|jpeg|png',
					'file_name'      => rand(1,9999999),
					'max_size'       => 5120
					);

					$this->load->library('upload',$config1);
					$this->upload->initialize($config1);  

					$logo_img ="";
					if(isset($_FILES['logo_image']) && $_FILES['logo_image']['error']==0)
					{ 
						if($this->upload->do_upload('logo_image'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							$logo_img = $file;
							//echo $default_img;exit;
						 $this->master_model->createThumb($file,'uploads/category_logo/',62,56);
						 $this->master_model->createThumbdetail($file,'uploads/category_logo/',100,90);
						}
						else
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url().ADMIN_PANEL_NAME."category/add");
						}
					}
					else
					{
						$this->session->set_flashdata('error',"Category logo field is required");
						redirect(base_url().ADMIN_PANEL_NAME."category/add");
					}

				
					$insert_array=array('parent_id'=>$parent_id,
										'category_name'=>$name,
										//'profile_image'=>$default_img,
										'featured'=>$feature,
										'category_description'=>$description,
										'logo_image' =>$logo_img,
										'category_status'=>'1',
										'meta_tag_title'=>$meta_tag_title,
										'meta_tag_description'=>$meta_tag_description,
										'meta_tag_keywords'=>$meta_tag_keywords,
							);

					//print_r($insert_array);exit;

					$res=$this->master_model->insertRecord('tbl_category_master',$insert_array);

					if($res)
						$this->session->set_flashdata('success','Category added successfully.');
					else
						$this->session->set_flashdata('error','Error while adding category.');
					redirect(base_url().ADMIN_PANEL_NAME.'category/add/');
				}
			}
		}

		$where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
		$parentcat = $this->master_model->getRecords('tbl_category_master',$where);

		foreach ($parentcat as $key => $value) {
			
			$data['fetchcategory'][]   = $value;
			
			$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
			$childcat = $this->master_model->getRecords('tbl_category_master',$where);

			foreach ($childcat as $key => $value) {
	
				$data['fetchcategory'][]   = $value;
			}
		}

		//echo "query -".$this->db->last_query();

		$data['middle_content']='category/add-category';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Update Category Function Start Here*/
	public function update()
	{ 

		$data['page_title'] = 'Update Category ';
		$id                 = $this->uri->segment(4);

		if($id=="")
		{
			redirect(base_url().ADMIN_PANEL_NAME.'category/manage');
		}

		if(isset($_POST['btn_add_category']))
		{

			$this->form_validation->set_rules('parent_id','Select Parent Category Name','required');
			$this->form_validation->set_rules('category_name','Category Name','required');
			$this->form_validation->set_rules('category_description','Category Description','required');
		
			if($this->form_validation->run())
			{

				$parent_id 		= $this->input->post("parent_id",true);
				$name     		= $this->input->post("category_name");
				$feature		= $this->input->post('featured');
				$description    = $this->input->post("category_description",true);

				$meta_tag_title    	  = $this->input->post("meta_tag_title",true);
				$meta_tag_description = $this->input->post("meta_tag_description",true);
				$meta_tag_keywords    = $this->input->post("meta_tag_keywords",true);
				
				if($this->master_model->getRecords('tbl_category_master',array('category_name'=>$name,'category_id != '=>$id,'is_delete'=>'0')))
				{
					$this->session->set_flashdata('error','Category name already exist');
					redirect(base_url().ADMIN_PANEL_NAME.'category/update/'.$id);
				}
				else
				{
					/*$config=array(
							'upload_path'   => 'uploads/cat_logo',
							'allowed_types' => 'jpg|jpeg|png|gif|GIF|JPG|JPEG|PNG|svg|SVG', 
							'file_name'     => rand(1,9999999)
							);*/

						/*$this->load->library('upload',$config);
						$this->upload->initialize($config); 

						$default_img = $this->input->post("oldimage");

					if(isset($_FILES['page_img']) && $_FILES['page_img']['error']==0 )
					{
						if($this->upload->do_upload('page_img'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							@unlink('uploads/cat_logo/'.$default_img);
							@unlink('uploads/cat_logo/thumb/'.$default_img);
							$default_img = $file;

							$this->master_model->createThumb($file,'uploads/cat_logo/',400,250);
						}
						else
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url().ADMIN_PANEL_NAME.'category/update/'.$id);
						}
					}*/

					$config1=array(
							'upload_path'   => 'uploads/category_logo',
							'allowed_types' => 'jpg|jpeg|png|gif|GIF|JPG|JPEG|PNG|svg|SVG', 
							'file_name'     => rand(1,9999999)
							);

						$this->load->library('upload',$config1);
						$this->upload->initialize($config1); 

						$logo_img = $this->input->post("oldimage1");

					if(isset($_FILES['logo_image']) && $_FILES['logo_image']['error']==0 )
					{
						if($this->upload->do_upload('logo_image'))
						{
							$dt=$this->upload->data();
							$file=$dt['file_name'];
							@unlink('uploads/category_logo/'.$logo_img);
							@unlink('uploads/category_logo/thumb/'.$logo_img);
							$logo_img = $file;

							$this->master_model->createThumb($file,'uploads/category_logo/',62,56);
						    $this->master_model->createThumbdetail($file,'uploads/category_logo/',100,90);
						}
						else
						{
							$this->session->set_flashdata('error',$this->upload->display_errors());
							redirect(base_url().ADMIN_PANEL_NAME.'category/update/'.$id);
						}
					}

					$update_array=array('parent_id'=>$parent_id,
										'category_name'=>$name,
										'featured'=>$feature,
										'category_description'=>$description,
										//'profile_image'=>$default_img,
										'logo_image' =>$logo_img

									);

					//print_r($update_array);exit;
					$update_result=$this->db->update('tbl_category_master',$update_array, array('category_id' => $id));

					if($update_result)
						$this->session->set_flashdata('success','Category updated successfully.');
					else
						$this->session->set_flashdata('error','Error while updating category.');
					redirect(base_url().ADMIN_PANEL_NAME.'category/update/'.$id);
				}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().ADMIN_PANEL_NAME.'category/update/'.$id);
			}
		}

		$data['category_info']=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$id));

		$where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
		$parentcat = $this->master_model->getRecords('tbl_category_master',$where);
     	  	
		foreach ($parentcat as $key => $value) {
			
			$data['fetchcategory'][]   = $value;
			
			$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
			$childcat = $this->master_model->getRecords('tbl_category_master',$where);

			foreach ($childcat as $key => $value) {
	
				$data['fetchcategory'][]   = $value;
				//print_r($data['fetchcategory']);exit;
			}
		}

        $data['pageTitle']='Manage Category';
		$data['middle_content']='category/edit-category';
		$this->load->view(ADMIN_PANEL_NAME.'template',$data);
	}

	/*Category Status Function Start Here*/
	public function status($sts='',$id='')
	{
		$data['success']=$data['error']='';
		$input_array = array('category_status'=>$sts);
		if($this->master_model->updateRecord('tbl_category_master',$input_array,array('category_id'=>$id)))
		{
			$this->session->set_flashdata('success','Record status updated successfully.');
			redirect(base_url().ADMIN_PANEL_NAME.'category/manage');
		}
		else
		{
			$this->session->set_flashdata('error','Error while updating status.');
			redirect(base_url().ADMIN_PANEL_NAME.'category/manage');
		}
	}

	/*Category Delete Function Start Here*/
	public function delete($id2=FALSE)
	{

		$data['success']=$data['error']='';
	  	if($this->master_model->updateRecord('tbl_category_master',array('is_delete'=>'1'),array('category_id'=>$id2)))
	  	{
	  		$this->session->set_flashdata('success','Category Deleted Successfully.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'category/manage');
	  	}
	  	else
	  	{
	  		$this->session->set_flashdata('error','Error while deleting Record.');
	  		redirect(base_url().ADMIN_PANEL_NAME.'category/manage');
	  	}
	}

} //  end class