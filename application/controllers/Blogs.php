<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('email_sending');
	}
	
	public function index()
	{

        $where =array('blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['blogs']=$this->master_model->getRecords('tbl_blogs_master',$where);
        $cnt=count($data['blogs']);

	    /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $cnt;
	    $config1['base_url']             = base_url() . "blogs/index"; 
	    $config1['per_page']             = 10;
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

		$this->db->where('blogscategory_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_blogscategory_master');


		$where=array('blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['blogs']           = $this->master_model->getRecords('tbl_blogs_master',$where,FALSE,FALSE,$page,$config1["per_page"]);

		
		$where        =array('blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['recblogs']=$this->master_model->getRecords('tbl_blogs_master',$where);


        $data['pageTitle']       = 'Blogs - '.PROJECT_NAME;
   	    $data['page_title']      = 'Blogs - '.PROJECT_NAME;
		$data['middle_content']  = "blog";
		$this->load->view('template',$data);
	}

	public function getblogs()
	{
		if(!empty($_REQUEST['blog_id'])) {
			$this->db->where('blogs_category_id =' ,$_REQUEST['blog_id']);
		}

		if(!empty($_REQUEST['blogs_date'])) {
			$this->db->where('blogs_added_date =' ,$_REQUEST['blogs_date']);
		}

		if(!empty($_REQUEST['blog_name'])) {
			$this->db->like('blogs_name_en', $_REQUEST['blog_name']);
			$this->db->or_like('blogs_description_en', $_REQUEST['blog_name']);
		}

		if(!empty($_REQUEST['blog_year']) && !empty($_REQUEST['blog_month'])) {
			$bdate = $_REQUEST['blog_year'].'-'.$_REQUEST['blog_month'];
			$this->db->like('blogs_added_date', $bdate);	
		}

		$this->db->order_by('blogs_added_date','DESC');

		$where=array('blogs_front_status'=>'1','blogs_status'=>'1');
		$data['blogs']=$this->master_model->getRecords('tbl_blogs_master',$where);
		//echo "query - ".$this->db->last_query();
		if(count($data['blogs'])>0) { 
          foreach ($data['blogs'] as $blogs_row) {
            ?>
            <div class="blog-bx">
              <img class="img-responsive" src="<?php echo base_url().'uploads/blogs_images/'.$blogs_row['blogs_img'];?>" alt="blog-img"/>
              <div class="blog-content">
                <div class="blog-head-text"><a href="<?php echo base_url().'blogs/details/'.$blogs_row['blogs_id'];?>"> <?php echo $blogs_row['blogs_name_en']; ?> </a></div>
                <div class="article-links">
                  <ul>
                    <li>
                      <span> Posted on :</span><?php echo date( "F j, Y", strtotime( $blogs_row['blogs_added_date'] ) ); ?>
                    </li>
                    <li class="art-br">|</li>
                    <li>
                      <span> Posted by :</span> <?php echo $blogs_row['blogs_added_by']; ?> 
                    </li>
                  </ul>
                </div>

                <div class="blog-divider"></div>

                <div class="blog-content-text">
                  <?php echo mb_substr(strip_tags($blogs_row['blogs_description_en']),0,100,'utf-8'); ?>...
                </div>

                <div class="com-btn">
                  	<?php 
                    	$where_arr = array('message_read'=>'1','comm_blog_id'=>$blogs_row['blogs_id']);
                        $data['blogs_comments_data'] = $this->master_model->getRecords('tbl_blogs_comments',$where_arr);
                    ?>	
                  <div class="commet-text"> <?php echo count($data['blogs_comments_data']); ?> Comments</div>
                  <a href="<?php echo base_url().'blogs/details/'.$blogs_row['blogs_id'];?>">
                  	<button type="button" class="read-btnn1"><span><i class="fa fa-plus"></i></span></button>
                  </a>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>
            <?php 
          }
        } else 
        {
        	?>
        	<div class="blog-bx">
        		<div class="blog-content">
        			No Blog Record Found ..
        		</div>
        	</div>
        	<?php
        }

	}
	public function details()
	{ $data['blogs_data']= array();
		if(isset($_POST['comments_submit']))
		{
			$this->form_validation->set_rules('con_name','Name','required');
			$this->form_validation->set_rules('cont_email','Email','required');
			$this->form_validation->set_rules('con_phone','Phone','required');
			$this->form_validation->set_rules('cont_message','Message','required');
			if($this->form_validation->run())
			{ 
				$comm_blog_id=$this->input->post('comm_blog_id');
				$comm_id=$this->input->post('comm_id');
				$con_name=$this->input->post('con_name');
				$cont_email=$this->input->post('cont_email');
				$con_phone=$this->input->post('con_phone');
				$cont_message=$this->input->post('cont_message');

				if($this->session->userdata('user_id') != ''){
                    $user_id      = $this->session->userdata('user_id');
                }  
                else{
					$user_id      = 0;
				}

				if($this->session->userdata('user_name') != ''){
                     $user_name   = $this->session->userdata('user_name');
                }  
                else{
				     $user_name   = $this->input->post('con_name');   
				}

				if($this->session->userdata('user_email') != ''){
                     $user_email   = $this->session->userdata('user_email');
                }  
                else{
				     $user_email   = $this->input->post('cont_email');   
				}

				if($this->session->userdata('user_mobile') != ''){
                     $user_mobile   = $this->session->userdata('user_mobile');
                }  
                else{
				     $user_mobile   = $this->input->post('con_phone');   
				}

				$info_arr=array(
								'comm_blog_id'   =>$comm_blog_id,
								'user_id'        =>$user_id,
								'comm_parent_id' =>$comm_id,
								'comm_name'      =>$user_name,
				                'comm_email'     =>$user_email,
				                'comm_website'   =>$user_mobile,
				                'comm_message'   =>$cont_message,
				                'added_date'     =>date('Y-m-d H:i:s A')
				                );
				 //echo($info_arr);exit;
					if($this->master_model->insertRecord('tbl_blogs_comments',$info_arr))
					{
						$admin_email=$this->master_model->getRecords('admin_login',array('id'=>1));
					
						$info_arr = array(   'from'      => $admin_email[0]['admin_email'],
									         'to'        => $user_email,
									         'subject'   => 'User:Comment on blog',
									         'view'      => 'comment-success');

	        		    $other_info = array( 'con_name'  => $user_name,
							             );
	        		  
	        		    $info_arr1 = array(  'from'      => $user_email,
									         'to'        => $admin_email[0]['admin_email'],
									         'subject'   => 'New comment on blog',
									         'view'      => 'admin-comment-success');

	        		    $other_info1 = array('con_name'      => $user_name,
	        		                         'cont_email'    => $user_email,
	        		                         'con_phone'     => $user_mobile,
	        		                         'content'       => '',
	        		                         'footer'        => '',
	        		                         'cont_message'  => $cont_message
							             );
	            		if($this->email_sending->sendmail($info_arr, $other_info) && $this->email_sending->sendmail($info_arr1, $other_info1) )
	            		{
							$this->session->set_flashdata('success',"Your comment has been submitted! After approval of the administrator will be published!");
                            redirect(base_url().'blogs/details/'.$this->uri->segment(3));	
						}
						else
						{
							$this->session->set_flashdata('error',"Something was wrong!");
							redirect(base_url().'blogs/details/'.$this->uri->segment(3));
						}
					}
			}
			else
			{
				$this->session->set_flashdata('error',$this->form_validation->error_string());
				redirect(base_url().'blogs/details/'.$this->uri->segment(3));
			}

		}

		$blogs_id=$this->uri->segment(3);
		if($blogs_id=='')
		{
			redirect(base_url()."blogs/");
		}
		$data['pageTitle']       = 'Blogs Details - '.PROJECT_NAME;
   	    $data['page_title']      = 'Blogs Details - '.PROJECT_NAME;

		$where_arr=array('blogs_front_status'=>1,'blogs_id'=>$blogs_id);
		$select='tbl_blogs_master.*,
		        tbl_blogscategory_master.blogscategory_name';

		$this->db->join('tbl_blogscategory_master','tbl_blogs_master.blogs_category_id=tbl_blogscategory_master.blogscategory_id');
		$data['blogs_data']=$this->master_model->getRecords('tbl_blogs_master',$where_arr,$select);

		$where_arr=array('message_read'=>'1','comm_parent_id'=>'0','comm_blog_id'=>$blogs_id);
		$data['blogs_comments_data']=$this->master_model->getRecords('tbl_blogs_comments',$where_arr);
		
        $Count = count($data['blogs_comments_data']);
         /* create pagination */
	    $this->load->library('pagination');
	    $config1['total_rows']           = $Count;
	    $config1['first_url']            = $_SERVER['QUERY_STRING']!="" ? base_url('blogs/details/'.$this->uri->segment(3)).'/?'.$_SERVER['QUERY_STRING'] : base_url('blogs/details/'.$this->uri->segment(3));
	    $config1['suffix']               = "/?".$_SERVER['QUERY_STRING'];
	    $config1['base_url']             = base_url().'blogs/details/'.$this->uri->segment(3);
	    $config1['per_page']             = 5;
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
        $where_arr=array('message_read'=>'1','comm_parent_id'=>'0','comm_blog_id'=>$blogs_id);
		$data['blogs_comments_data']=$this->master_model->getRecords('tbl_blogs_comments',$where_arr,FALSE,FALSE,$page,$config1["per_page"]);

		$data['Comments_string'] = "";

		foreach ($data['blogs_comments_data'] as $key => $value) {
			//print_r($value);
				$data['Comments_string'] .= $this->getComments($value);
		}

        $where        =array('blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['blogs']=$this->master_model->getRecords('tbl_blogs_master',$where);

		$this->db->where('blogscategory_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_blogscategory_master');
		//exit();
		$data['middle_content']='blog-details';
		$this->load->view('template',$data);

	}

	public function getComments($row){

        if($row["user_id"]!=0){
            $this->db->where('id' ,$row["user_id"]); 
        	$get_user_data = $this->master_model->getRecords('tbl_user_master');

        	if($get_user_data[0]['user_type']=="Seller"){
        	$image_folde = 'seller_image';
	        }
	        else{
	        	$image_folde = 'buyer_image';
	        }
        }

		$Comments = "";
		$Comments .= '<div class="inn-comm">';
		if(!empty($get_user_data[0]['user_image']) && file_exists('images/'.$image_folde.'/'.$get_user_data[0]['user_image'])){
         $Comments .= '<div class="comme-img"><img src="'.base_url().'images/'.$image_folde.'/'.$get_user_data[0]['user_image'].'" alt="" /></div>';
        } else { 
         $Comments .= '<div class="comme-img"><img  src="'.base_url().'images/default/default-user-img.jpg'.'" alt="" /></div>';
        } 
		$Comments .= '<div class="comm-txt"> <div class="coome-nm"> '. $row["comm_name"];
		$Comments .= '</div> </div>';
		$Comments .= '<div class="share-date"><span><img src="'.base_url().'images/art-cal.png" alt="img" /> </span>';
		$Comments .= date( "F j, Y", strtotime( $row['added_date'] ) ).' </div>';
		$Comments .= '<div class="com-content-text">';
		$Comments .= '<p style="text-align:justify;">'.$row['comm_message'].'</p>';
		$Comments .= '</div> </div>';

		return $Comments;
	}

	public function category()
	{
		$cat_id = $this->uri->segment(3);
		$where =array('blogs_category_id'=>$cat_id,'blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['blogs']=$this->master_model->getRecords('tbl_blogs_master',$where);

		$this->db->where('blogscategory_status' , '1');
        $this->db->where('is_delete' , '0');
        $data['getCat'] = $this->master_model->getRecords('tbl_blogscategory_master');

        $where        =array('blogs_front_status'=>'1','blogs_status'=>'1');
		$this->db->order_by('blogs_id','DESC');
		$data['recblogs']=$this->master_model->getRecords('tbl_blogs_master',$where);

		$data['pageTitle']       = 'category - '.PROJECT_NAME;
   	    $data['page_title']      = 'Category - '.PROJECT_NAME;
		$data['middle_content']='category-details';
		$this->load->view('template',$data);
		/*echo "<pre>";
		print_r($data['blogs']);
		echo "</pre>";
		exit;*/
	}

}