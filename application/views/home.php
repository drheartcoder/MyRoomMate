<!--Featured Categries on top -->
<div class="container-fluid pad-0">
   <flex-carousel >
      <ul id="flexisel" class="top-slider">
         <?php 
            $cnt = 3;
            
            foreach($getCat as $level1)
            {
               $listingcnt = 0;
               if($level1['parent_id'] == 0)
               {
                  $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $level1['category_id']);
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
               if($level1['parent_id'] != 0)
               {
                  $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $level1['category_id']);
                  $level2 = $this->master_model->getRecords('tbl_category_master', $where);

                  if( count($level2) == 0 )
                  {
                     $where = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0', 'tbl_addlisting.cat_id' => $level1['category_id']);
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


               // check category logo image
              if ( isset($level1['logo_image']) && !empty($level1['logo_image']) )
              {
                  $category_logo_image = base_url().'uploads/category_logo/'.$level1['logo_image'];
                  $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/category_logo/'.$level1['logo_image'];
                  // check if image exists or not
                  if (file_exists($path)) {
                      //echo "The file exists";
                      $category_logo_image = $category_logo_image;
                  } else {
                    $category_logo_image = base_url().'uploads/category_logo/thumbdetail/no_image.png';
                  }

              } // end if
              else
              {
                  $category_logo_image = base_url().'uploads/category_logo/thumbdetail/no_image.png';
              } // end else
      ?>
         <li <?php echo "class='$cnt'"; ?>>
            <div class="main-box <?php if($cnt % 3 == 0 ) { echo 'yellow-bg'; } else if($cnt % 4 == 0 ) { echo 'red-bg'; } else if($cnt % 5 == 0 ) { echo 'gray-bg'; } else { echo 'red-bg'; }?>">
               <a href="<?php echo base_url().'listing?sercategory_id='.$level1['category_id']; ?>">
                   <div class="caption">
                 <div class="slider-img"><img src="<?php echo $category_logo_image; ?>" class="img-responsive" alt="My Roommate"  width='62' height="56" /></div>
                  <h4>                        
                        <?php echo ucwords($level1['category_name']);?></h4>
                  <h6>
                     <?php  if(!empty($listingcnt)) { echo $listingcnt; } else { 


                              $where = array('tbl_category_master.category_status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $level1['category_id']);
                              $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                              $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                              $lev1cat = $this->master_model->getRecords('tbl_addlisting', $where, $select);

                              if(count($lev1cat) > 0){

                                 $listingcnt +=  count($lev1cat);

                                 foreach($lev1cat as $lev1)
                                 {
                                    $where = array('tbl_category_master.category_status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $lev1['category_id']);
                                    $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                                    $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                                    $lev2cat = $this->master_model->getRecords('tbl_addlisting', $where, $select);


                                       $listingcnt +=  count($lev2cat);
                                       foreach($lev2cat as $lvl2)
                                       {
                                          $where  = array('tbl_category_master.category_status' => '1', 'tbl_category_master.is_delete' => '0', 'tbl_addlisting.cat_id' => $lvl2['category_id']);
                                          $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                                          $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                                          $level3cat = $this->master_model->getRecords('tbl_addlisting', $where, $select);

                                             $listingcnt +=  count($level3cat);
                                       }
                                 }
                              }
                              else {
                                 $where = array('category_status' => '1', 'is_delete' => '0', 'parent_id' => $level1['category_id']);
                                 $get_parent = $this->master_model->getRecords('tbl_category_master', $where);
                                 foreach ($get_parent as $value) {
                                    $where  = array('tbl_category_master.category_status' => '1', 'tbl_addlisting.is_delete' => '0', 'tbl_addlisting.cat_id' => $value['category_id']);
                                    $select = array('tbl_addlisting.*, tbl_category_master.category_id');
                                    $this->db->join('tbl_category_master', 'tbl_category_master.category_id=tbl_addlisting.cat_id');
                                    $allcate = $this->master_model->getRecords('tbl_addlisting', $where, $select);
                                    $listingcnt +=  count($allcate);
                                 }

                              }
                            if($listingcnt > 0)
                            {
                              echo $listingcnt;
                            }
                            else
                            {
                              echo "0";
                            }
                      } ?> Ads
                  </h6>
                  
               </div></a>
            </div>
         </li>
         <?php $cnt++; } ?>
      </ul>
   </flex-carousel>
</div>

<div class="container">
   <div class="bottom-slider">
      <ul id="flexiselDemo2">
      <?php //echo date("Y-m-d H:i:s"); ?>
         <?php if(count($latestaddlisting)>0)
            { 
                ?>
            <?php foreach( $latestaddlisting as $data)
               {
                  if ( !empty($data['transaction_price']) )
                  {
                     $last_listing_date = date('Y-m-d', strtotime('+2000 week', strtotime($data['created_date'])));
                     if( date("Y-m-d") <= $last_listing_date)
                     {
                        ?>
                           <li>
                              <a href="<?php echo base_url().'listing/details/'.$data['slug'] ?>">
                              <div class="main-box">
                                 <div class="flex-img">
                                    
                                    <?php 
                                    if ( isset($data['mainphoto']) && !empty($data['mainphoto']) )
                                      {
                                          $listing_image = base_url().'uploads/addlisting_images/thumb/'.$data['mainphoto'];
                                          $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumb/'.$data['mainphoto'];

                                          // check if image exists or not
                                          if (file_exists($path)) {
                                              //echo "The file exists";
                                              $listing_image = $listing_image;
                                          } else {
                                            $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                          }
                                       } // end if
                                       else
                                       {
                                          $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                       } // end else
                                       ?>
                                       <img  width='270px' height='310px' src="<?php echo $listing_image;?>" alt="" /> 
                                    
                                    <div class="caption">
                                       <h4>
                                          <!-- Class 11,12 cbsc syllabus lorem ipsum is dummy text --><!--<?php echo $data['description'];?>-->
                                       </h4>
                                       <h5>
                                          <!--Category: -->
                                          <span>
                                             <!-- Books --><?php echo ucwords($data['title']);?>
                                          </span>
                                       </h5>
                                    </div>
                                    <div class="hover-text-block">

                                       <h6>price (Aed)</h6>
                                       <h1>
                                          <!-- 1500.00 --><?php echo $data['price'];?>
                                       </h1>
                                       <div class="date-status">
                                          <p>
                                             Listed On : 
                                             <span>
                                                <!-- 3 March 2017 --><?php echo
                                                   date("  d F Y", strtotime($data['created_date']));?>
                                             </span>
                                          </p>
                                          <p>Availability: <span><?php echo $data['availability'];?></span></p>
                                       </div>
                                    </div>
                                 </div>
                                <!-- <div class="slider-text">
                                    <p>
                                     <a href="<?php echo base_url().'listing/details/'.base64_encode($data['id']); ?>" ><?php echo ucwords($data['title']);?></a>
                                    </p>
                                 </div> -->
                              </div>
                              </a>
                           </li>
                        <?php
                     } // end if
                     else
                     {
                        echo "No Data Found";
                     } // end else
                  } // end if

                  if ( $data['transaction_price'] == 10.00 )
                  {
                     $last_listing_date = date('Y-m-d', strtotime('+1 week', strtotime($data['created_date'])));
                     if( date("Y-m-d") <= $last_listing_date)
                     {
                        ?>
                           <li>
                              <a href="<?php echo base_url().'listing/details/'.$data['slug'] ?>">
                              <div class="main-box">
                                 <div class="flex-img">
                                    
                                       <img  width='270px' height='310px' src="<?php echo base_url().'uploads/addlisting_images/'.$data['mainphoto'];?>" alt="" /> 
                                    
                                    <div class="caption">
                                       <h4>
                                          <!-- Class 11,12 cbsc syllabus lorem ipsum is dummy text --><?php echo $data['description'];?>
                                       </h4>
                                       <h5>
                                          Category: 
                                          <span>
                                             <!-- Books --><?php echo ucwords($data['title']);?>
                                          </span>
                                       </h5>
                                    </div>
                                    <div class="hover-text-block">
                                       <!--  <p>expat family leaving the country-items for sale:</p> -->
                                       <h6>price (Aed)</h6>
                                       <h1>
                                          <!-- 1500.00 --><?php echo $data['price'];?>
                                       </h1>
                                       <div class="date-status">
                                          <p>
                                             Listed On : 
                                             <span>
                                                <!-- 3 March 2017 --><?php echo
                                                   date("  d F Y", strtotime($data['created_date']));?>
                                             </span>
                                          </p>
                                          <p>Availability: <span><?php echo $data['availability'];?></span></p>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="slider-text">
                                    <p>
                                       <!-- White goods available immediately : Refrigerator... -->
                                     <a href="<?php echo base_url().'listing/details/'.base64_encode($data['id']); ?>" ><?php echo ucwords($data['title']);?></a>
                                    </p>
                                 </div>
                              </div>
                              </a>
                           </li>
                        <?php
                     } // end if
                     else
                     {
                        echo "No Data Found";
                     } // end else
                  } // end if 

               } // end foreach
            } // end if
            ?>
      </ul>
   </div>
   <!--  <div class="add-img"><img src="< ?php echo base_url(); ?>front-asset/images/ads.jpg" class="img-responsive" alt="my-roommate"/></div>       
   <div class="add-img">  <img width='1169px' height='111px'  src='<?php echo base_url().'uploads/adv_images/'.$adv[0]['adv_image'];?>' class="img-responsive" alt="" /></div>--> 




</div>

<!-- Adsense -->
<div class="add-img"> 

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- myroommate.AE Home-970 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:970px;height:90px"
     data-ad-client="ca-pub-8835549008864000"
     data-ad-slot="6193755682"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>

<div class="categories">
   <div class="container">
      <div class="row">
         
         <?php
            if(count($homefetchcategory) > 0) {
               foreach ($homefetchcategory as $key => $value) {

                 // check category logo image
                 if ( isset($value['logo_image']) && !empty($value['logo_image']) )
                 {
                     $category_logo = base_url().'uploads/category_logo/'.$value['logo_image'];

                     $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/category_logo/'.$value['logo_image'];
                     // check if image exists or not
                     if (file_exists($path)) {
                         //echo "The file exists";
                         $category_logo = $category_logo;
                     } else {
                       $category_logo = base_url().'uploads/category_logo/thumb/no_image.png';
                     }

                 } // end if
                 else
                 {
                     $category_logo = base_url().'uploads/category_logo/thumb/no_image.png';
                 } // end else
               ?>
         <div class="col-sm-6 col-md-3 col-lg-3">
            <div class="category-block">
               <!--<div class="category-img">
                  <img src='<?php echo $category_logo; ?>' alt="" />
               </div> -->
               <h2>
                  <?php echo ucwords($value['category_name']);?>
               </h2>
               <?php
                  $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                  $childcategory_level1 = $this->master_model->getRecords('tbl_category_master',$where);
                  $all_products_count = 0;
                  if(count($childcategory_level1) > 0)
                  {
                     foreach ($childcategory_level1 as $childcategory_level1_value)
                     {
                       
                        $where = array('parent_id'=> $childcategory_level1_value['category_id'],'is_delete'=>'0','category_status'=>'1');
                        $childcategory_level2 = $this->master_model->getRecords('tbl_category_master',$where);
                        //echo "<pre>"; print_r($childcategory_level2);exit;

                        foreach ($childcategory_level2 as $childcategory_level2_data) {
                           // get nos of listing for particular category
                           $where = array('cat_id'=> $childcategory_level2_data['category_id'],'is_delete'=>'0','status'=>'1');
                           $listing_data = $this->master_model->getRecords('tbl_addlisting',$where);
                           //echo "<pre>"; print_r($listing_data);exit;
                           $all_products_count = $all_products_count + count($listing_data);
                        }
                     }
                  }
                  
                  
                   ?>
               <h6> (<?php  echo $all_products_count;?> Ads)</h6>
               <ul>
                  <?php 
                     $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                     $this->db->limit(5);
                     $childcat = $this->master_model->getRecords('tbl_category_master',$where);
                     //echo "<pre>";print_r($childcat);exit;
                     if(count($childcat) > 0) {
                        ?>
                  <?php
                     foreach ($childcat as $key => $data) {
                        ?>
                  <li><a href="<?php echo base_url().'listing?sercategory_id='.$data['category_id'];?>" ><i class="fa fa-angle-right"></i><?php echo ucwords($data['category_name']);?></a></li>
                  <?php 
                     }
                     ?>
                  <?php
                     }
                     ?>
               </ul>
               <a href="<?php echo base_url().'listing?sercategory_id='.$value['category_id'];?>" data-hover="View&nbsp;All" class="view-all cl-effect-11">View All</a>
            </div>
         </div>
         <?php    
            }
            }
            ?>
      </div>
   </div>
</div>
<script>
   /*angular.module('myApp', ['flexSlider']);*/
</script>
<!--flexslider-->
<script src="<?php echo base_url(); ?>front-asset/js/angular-flexisel.js" type="text/javascript"></script>
<!-- <script src="js/jquery.flexisel.js" type="text/javascript"></script>-->
<link href="<?php echo base_url(); ?>front-asset/css/slider.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
<meta name="google-site-verification" content="c43t1l5FfCDxl1I6kOwa4w7Dit8CDLzvC1yhqStFphM" />

