<?php 
   $get_pri_id=$get_next_id=array();
   /* previous */
   if(isset($blogs_data[0]['blogs_id']))
   {
     $this->db->where('blogs_id < ' , $blogs_data[0]['blogs_id']);
     $this->db->limit(1);
     $this->db->order_by('blogs_id','desc');
     $get_pri_id = $this->db->get('tbl_blogs_master')->result(); 
   
     $this->db->where('blogs_id > ' , $blogs_data[0]['blogs_id']);
     $this->db->limit(1);
     $this->db->order_by('blogs_id','asc');
     $get_next_id = $this->db->get('tbl_blogs_master')->result();
   
   }
  
?>
<div class="mid-cont">
<div class="container">
<div class="title-bar">
   <div class="page-title">Blog <span>Details</span></div>
   <div class="top_breadcrumb"> <a href="index.html#!/">Home </a> &nbsp;<span><i class="fa fa-angle-right" ></i>
      </span>&nbsp; <a href="#" class="act">Blog Details &nbsp;</a>
   </div>
   <div class="clearfix"></div>
</div>
<div class="row">
   <div class="col-sm-4 col-md-3 col-lg-3">
      <div class="left-bar-menu">
         <div class="search-left">
            <div class="search-input-box">
               <input type="text" placeholder="Search" name="search-bar" />
            </div>
            <div class="search-icons-font"><i class="fa fa-search"></i></div>
         </div>
         <div class="categories-all">
            <div class="cate-text-title">All Categories</div>
            <ul>
               <?php if(isset($getCat) && sizeof($getCat)) { ?>
               <?php foreach ($getCat as $category) { ?>
               <li><a  data-hover="<?php echo $category['blogscategory_name']; ?>" href="<?php echo base_url().'blogs/category/'.$category['blogscategory_id']; ?>"><?php echo $category['blogscategory_name']; ?></a></li>
               <?php } ?> 
               <?php } else { ?>
               <div class="row col-block-mobile">
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <?php $this->load->view('no-data-found'); ?>
                  </div>
               </div>
               <?php } ?>
            </ul>
         </div>
         <div class="recent-blog-block">
            <div class="cate-text-title ">Recent blog</div>
            <?php 
               if(count($blogs)>0) { 
                 $cnt=0; foreach ($blogs as $blogs_row) { $cnt++;
                   if($cnt <=5){
                   ?>
            <div class="recent-post-left">
               <a href="<?php echo base_url().'blogs/details/'.$blogs_row['blogs_id'];?>">
               <span class="sml-rect-image"> <?php if(!empty($blogs_row['blogs_img']) && file_exists('uploads/blogs_images/'.$blogs_row['blogs_img'])){ ?>
               <?php /* <img  src="<?php echo base_url().'timthumb.php?src='.base_url().'uploads/blogs_images/'.$blogs_row['blogs_img'].'&h=53&w=56&zc=0'; ?>" alt="" data-description=""> */ ?>
                     <img src=" <?php echo base_url().'uploads/blogs_images/'.$blogs_row['blogs_img']; ?>" alt="" data-description="" width="56" height="53">
               <?php } else { ?>
               <img  src="<?php echo base_url().'images/large_no_image.jpg'; ?>" alt="" />
               <?php } ?>  </span>
               <span class="rect-blog-text"><?php echo $blogs_row['blogs_name_en']; ?></span>
               </a>
            </div>
            <?php } } }  else { ?> 
            <div class="block-one-main" style="margin-top: 65px;">
               <?php 
                  $this->load->view('no-data-found');
                  ?>
            </div>
            <?php  } ?>
         </div>
      </div>
   </div>
   <?php if(!empty($blogs_data)){ ?>
   <div class="col-sm-8 col-md-9 col-lg-9">
      <div class="blog-main-block">
         <?php 
            if($this->session->flashdata('error')!=''){  ?>
         <div style="margin-top: 42px;" class="alert-box errors alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>×</span></button> &nbsp; <?php echo  $this->session->flashdata('error'); ?></div>
         <?php } ?>
         <?php  
            if($this->session->flashdata('success')!=''){  ?>
         <div style="margin-top: 42px;" class="alert-box success alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>×</span></button>  &nbsp; <?php echo  $this->session->flashdata('success'); ?></div>
         <?php } ?>
         <div class="priv-next-btn">
             <?php
               if(!empty($get_pri_id[0]->blogs_id) && !empty($get_next_id[0]->blogs_id))
               {
               ?>
            <div class=" previous-post-btn">
               <a href="<?php echo base_url().'blogs/details/'.$get_pri_id[0]->blogs_id;?>"> <i class="fa fa-long-arrow-left"></i>previous post</a>
            </div>
            <div class=" next-post-btn"> <a href="<?php echo base_url().'blogs/details/'.$get_next_id[0]->blogs_id;?>"> Next Post<i class="fa fa-long-arrow-right" ></i></a></div>
            <?php
               }
               else
               {
                  
               }
              ?>
         </div>
         <div class="main-blog-block-title"><?php echo $blogs_data[0]['blogs_name_en']; ?></a></div>
         <div class="main-blog-block-img">
            <!-- <img src="images/blog-1.png" alt="blog-1" /> -->
            <?php if(!empty($blogs_data[0]['blogs_img']) && file_exists('uploads/blogs_images/'.$blogs_data[0]['blogs_img'])){?>
            <?php /* <img class="event_pic " src="<?php echo base_url().'timthumb.php?src='.base_url().'uploads/blogs_images/'.$blogs_data[0]['blogs_img'].'&h=350&w=870&zc=0'; ?>" alt="" data-description=""> */ ?>
            <img src=" <?php echo base_url().'uploads/blogs_images/'.$blogs_data[0]['blogs_img']; ?>" alt="" data-description="" width="870" height="350">
            <?php } else { ?>
            <img src="<?php echo base_url().'images/large_no_image.jpg'; ?>" alt="" />
            <?php } ?> 
            <div class="date-loction">
               <ul>
                  <li>  <strong><?php echo date( "d", strtotime( $blogs_data[0]['blogs_added_date'] ) ); ?></strong>
                     <span><?php echo date( "F", strtotime( $blogs_data[0]['blogs_added_date'] ) ); ?></span>
                  </li>
                  <!-- <li><i class="fa fa-heart"></i>Like</li> -->
                  <li><i class="fa fa-comment"></i>
                     <?php 
                        $where_arr = array('message_read'=>'1','comm_blog_id'=>$blogs_data[0]['blogs_id']);
                        $data['blogs_comments_data'] = $this->master_model->getRecords('tbl_blogs_comments',$where_arr);
                        ?>
                     <?php echo count($data['blogs_comments_data']); ?> 
                  </li>
                 <!--  <li><i class="fa fa-tags"></i>Tour, Place, Trip, Country</li> -->
               </ul>
            </div>
         </div>
         <div class="main-blog-cont txt-shows">
            <p><?php echo $blogs_data[0]['blogs_description_en']; ?> </p>
         </div>
         <div class="tag-share-block">
            <div class="blog-tag-block">
               <div class="blog-tag"><i class="fa fa-tags"></i>Category:</div>
               <div class="tag-sml-text"><?php echo $blogs_data[0]['blogscategory_name'];?></div>
            </div>
            <div class="share-block">
               <div class="blog-tag"><i class="fa fa-share-alt"></i>Share :</div>
               <div class="share-socil-icon">
                  <ul>
                     <li>
                        <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
                     </li>
                     <li>
                        <a href="#"> <i class="fa fa-twitter"></i> </a>
                     </li>
                     <li>
                        <a href="#"> <i class="fa fa-google-plus"></i> </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="blog-profile">
            <div class="manin-blog-image">  </div>
            <div class="blog-pro-details">
              
               <?php 
                  $where_arr=array('message_read'=>'1','comm_blog_id'=>$blogs_data[0]['blogs_id']);
                  $blogs_comments_count=$this->master_model->getRecords('tbl_blogs_comments',$where_arr);
                  
                  ?>
               
               <div class="previous-post margin">
                  <?php
                     if(count($blogs_comments_count)>0)
                       {?>
                  <div class="leave-comment-title"> Comments (<?php echo count($blogs_comments_count); ?>)</div>
                  <div class="main-previous-post">
                     <!-- <div class="previ-post-image">
                        <div class="previous-image"> </div>
                        </div> -->
                        <?php foreach($blogs_comments_count as $blog) 
                        {
                        ?>

                     <div class="previous-post-message">
                        <div class="border-line">
                           <div class="previous-name-title"><?php echo $blog['comm_name'] ?></div>
                           <!-- <div class="previous-time">6 Houres ago</div> -->
                           <div class="previous-post-cont"> <?php echo $blog['comm_message'] ?></div>
                        </div>
                     </div>
                     <br>
                     <?php }?>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <?php }
                  else
                  {
                      $this->load->view('no-data-found');   
                  }
                  ?>
               <div class="clearfix"></div>
               <div class="leave-comment">
                  <form action="<?php echo base_url().'blogs/details/'.$blogs_data[0]['blogs_id']; ?>" method="post" class="form target">
                     <div class="leave-comment-title padding">Leave a Comments</div>
                     <input type="hidden" id="comm_id" name="comm_id" value="0">
                     <input type="hidden" id="comm_blog_id" name="comm_blog_id" value="<?php echo $blogs_data[0]['blogs_id']; ?>">
                     <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                           <div class="email-box-2">
                              <div class="email-title">Name<sup>*</sup></div>
                              <div class="search-left leave">
                                 <input type="text" id="con_name" name="con_name" value="<?php if($this->session->userdata('user_name') != '') { echo $this->session->userdata('user_name'); } ?>"/>
                              </div>
                              <div style="display: block;" class="error" id="error_name"><?php echo form_error('con_name');?> </div>
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                           <div class="email-box-2">
                              <div class="email-title">Email<sup>*</sup></div>
                              <div class="search-left leave">
                                 <input type="text" id="cont_email" name="cont_email" value="<?php if($this->session->userdata('user_email') != '') { echo $this->session->userdata('user_email'); } ?>" />
                              </div>
                              <div style="display: block;" class="error" id="error_email"><?php echo form_error('cont_message');?></div>
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                           <div class="email-box-2">
                              <div class="email-title">Phone<sup>*</sup></div>
                              <div class="search-left leave">
                                 <input type="text" id="con_phone" name="con_phone" value="<?php if($this->session->userdata('user_mobile') != '') { echo $this->session->userdata('user_mobile');} ?>"/>
                              </div>
                              <div style="display: block;"  class="error" id="error_phone"><?php echo form_error('cont_phone');?></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="email-box-2">
                              <div class="email-title">Comment<sup>*</sup></div>
                              <div class="search-left leave">
                                 <textarea name="cont_message" id="cont_message" rows="" cols=""></textarea>
                              </div>
                              <div style="display: block;" class="error" id="error_message"><?php echo form_error('cont_message');?></div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                           <div class="blog-submit-btn max-widths-blog">
                              <button type="submit" id="comments_submit" name="comments_submit" value="comments_submit">Send</button>
                           </div>
                        </div>
                        <div class="clr"></div>
                     </div>
                  </form>
               </div>
               <div class="clr"></div>
            </div>
         </div>
         <?php } else {
              $this->load->view('no-data-found');
            } ?>
         <!-- col-sm-8 col-md-9 col-lg-9 -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function(){
       //Blog details Page 
     $('#comments_submit').on('click',function(){
       var con_name=$('#con_name').val();
       var cont_email=$('#cont_email').val();
       var con_phone=$('#con_phone').val();
       var cont_message=$('#cont_message').val();
       var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
       var phn_num = /^-?\d*(\.\d+)?$/;
       var flag=1;
        $('#error_name').html('');
        $('#error_email').html('');
        $('#error_phone').html('');
        $('#error_message').html('');
   
       if(con_name.trim()=='')
       {
         $('#error_name').html('Please Enter Your Name');
         flag=0;
       }
       if(cont_email.trim()=='')
       {
         $('#error_email').html('Please Enter Your Email');
         flag=0;
       }
       else if(!filter.test(cont_email))
       {
         $('#error_email').html('Please Enter Valid Email');
         flag=0;
       }
       if(cont_message.trim()=="")
       {
          $('#error_message').html('Please Enter Comment');
          flag=0;
       }
   
       if(con_phone.trim()=="")
       {
         $('#error_phone').html('Please Enter Phone Number');
         flag=0;
       }
       else if((con_phone.length < 10))
        {
          $('#error_phone').html('Phone no must be greater than 10 digits');
          flag=0;
        }
        else  if((con_phone.length > 16))
        {
          $('#error_phone').html('Phone no must be less than 16 digits');
          flag=0;
        }
        else if(!phn_num.test(con_phone))
       {
         $('#error_phone').html('Please Enter valid Phone Number');
         flag=0;
       }
       if(flag==1)
       {
         return true;
       }
       else
       {
         return false;
       }
   
     });
   
   
   //Blog details Page 
   
    /* $(".com_id").on('click',function(){
   
       var id = $(this).attr('data-id');
       $('#comm_id1').val(id);
       });
   */
   });
   
</script>

