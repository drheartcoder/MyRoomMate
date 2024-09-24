<div class="mid-cont">
   <div class="container">
      <div class="title-bar">
         <div class="page-title">Blog</div>
         <div class="top_breadcrumb"> <a href="index.html#!/">Home </a> &nbsp;<span><i class="fa fa-angle-right" ></i>
            </span>&nbsp; <a href="#" class="act">Blog&nbsp;</a>
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
                     if(count($recblogs)>0) { 
                       $cnt=0; foreach ($recblogs as $blogs_row) { $cnt++;
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
                  <div style="margin-top:-12px;">
                     <?php echo $this->pagination->create_links(); ?>
                  </div>
               </div>
            </div>
         </div> 
         <div class="col-sm-8 col-md-9 col-lg-9">
            <?php 
               if(count($blogs)>0) { 
                 foreach ($blogs as $blogs_row) {
                   ?>
            <div class="blog-main-block">
               <div class="main-blog-block-title"> <?php echo $blogs_row['blogs_name_en']; ?> </div>
               <div class="main-blog-block-img">
                  <!-- <img src="images/blog-1.png" alt="blog-1" /> -->
                  <?php if(!empty($blogs_row['blogs_img']) && file_exists('uploads/blogs_images/'.$blogs_row['blogs_img'])){?>
                  <?php /* <img class="event_pic " src="<?php echo base_url().'timthumb.php?src='.base_url().'uploads/blogs_images/'.$blogs_data[0]['blogs_img'].'&h=350&w=870&zc=0'; ?>" alt="" data-description=""> */ ?>
            <img src=" <?php echo base_url().'uploads/blogs_images/'.$blogs_row['blogs_img']; ?>" alt="" data-description="" width="870" height="350">
                  <?php } else { ?>
                  <img src="<?php echo base_url().'images/large_no_image.jpg'; ?>" alt="" />
                  <?php } ?> 
                  <div class="date-loction">
                     <ul>
                        <li> <strong><?php echo date( "d", strtotime( $blogs_row['blogs_added_date'] ) ); ?></strong>
                           <span><?php echo date( "F", strtotime( $blogs_row['blogs_added_date'] ) ); ?></span>
                        </li>
                       <!--  <li><i class="fa fa-heart"></i>Like</li> -->
                        <li><i class="fa fa-comment"></i><?php 
                            $where_arr = array('message_read'=>'1','comm_blog_id'=>$blogs_row['blogs_id']);
                            $data['blogs_comments_data'] = $this->master_model->getRecords('tbl_blogs_comments',$where_arr);
                        ?>
                                <?php echo count($data['blogs_comments_data']); ?></li>
                        <!-- <li><i class="fa fa-tags"></i>Tour, Place, Trip, Country</li> -->
                     </ul>
                  </div>
               </div>
               <div class="main-blog-cont"><?php  echo mb_substr(strip_tags($blogs_row['blogs_description_en']),0,500,'utf-8'); ?></div>
               <div class="blog-read-more"> <a href="<?php echo base_url().'blogs/details/'.$blogs_row['blogs_id'];?>">Read More<i class="fa fa-long-arrow-right" ></i></a> </div>
               <br>
            </div>
            <?php } 
               } else {
                  ?> 
            <div class="block-one-main" style="margin-top: 65px;">
               <?php 
                  $this->load->view('no-data-found');
                  ?>
            </div>
            <?php  }?>
            <!--pagigation start here-->
            <div style="margin-top:-12px;">
               <?php echo $this->pagination->create_links(); ?>
            </div>
         </div>
      </div>
   </div>
</div>

