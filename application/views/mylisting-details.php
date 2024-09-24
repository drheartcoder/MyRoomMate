
<style>
   ul.ratings-ul li{padding: 0 10px;}
   .img-detail-listing img{height: 270px;}
</style>
<!--    Review Rating Demo Start Here-->
<script src="<?php echo base_url().'front-asset/review/'; ?>jstarbox.js"></script>
<link rel="stylesheet" href="<?php echo base_url().'front-asset/review/'; ?>jstarbox.css" type="text/css" media="screen" charset="utf-8" />
<!--    Review Rating Demo End Here-->
<div class="main-inner-gray">
   <div class="middle-section listing-page">
      <div class="container">
         <!-- <div class="page-path mrg-bottoms">
            <div class="row">
                <div class="col-sm-6">
                    <h2>I Have a Room in <span>Abu Dhabi</span></h2>
                </div>
                <div class="col-sm-6">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="#">Available Rooms</a></li>
                        <li><i class="fa fa-angle-right"></i></li>
                        <li><a href="#" class="active">I have a room in Abu Dhabi</a></li>
                    </ul>
                </div>
            </div>            
            </div> -->
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
               <?php $this->load->view('user/left-menu'); ?> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
               <?php 
                  if(!empty($mylisting_details)) 
                  { 
                      // check listisng image
                      if ( isset($mylisting_details[0]['mainphoto']) && !empty($mylisting_details[0]['mainphoto']) )
                      {
                          $listing_image = base_url().'uploads/addlisting_images/thumbdetail/'.$mylisting_details[0]['mainphoto'];
                          // check if image exists or not
                         
                           $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumbdetail/'.$mylisting_details[0]['mainphoto'];

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
               <div class="row">
                  <div class="col-sm-12 col-md-4 col-lg-5">
                     <div class="img-detail-listing">
                        <img src="<?php echo $listing_image; ?>" class="img-responsive" alt="my-roommate"/>
                     </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="backbtn">
                      <a href=javascript:history.back()><span><i class="fa fa-long-arrow-left"></i></span>Back to List</a>
                      <!-- <a href="< ?php echo base_url().'user/mylisting' ?>"><span><i class="fa fa-long-arrow-left"></i></span>Back</a> -->
                    </div>
                    <br/>
                  </div>

                  <div class="col-sm-12 col-md-8 col-lg-7">
                     <div class="listing-detail-right">
                        <h2><?php 
                           if ( isset($mylisting_details[0]['title']) && $mylisting_details[0]['title'] != '' )
                           { 
                               echo $mylisting_details[0]['title']; 
                           } // end if
                           else 
                           {
                               echo 'Title Not Available'; 
                           }  // end else 
                           ?></h2>
                        
                        <form class="rating_form" method="POST" action="<?php echo base_url().'listing/rating'; ?>">
                          <div class="rating-detailpage">
                              <ul class="ratings-ul">
                                  <li><div class="starbox colours ghosting small autoupdate" data-button-count="10" data-star-count="5"></div><span class="rivew-count" >0</span></li>
                                  <li>Good</li>
                                  <li>Favoured: <?php echo isset($nos_favorite)?$nos_favorite:'0'; ?></li>
                                  <input type="hidden" id="rating_value" name="rating_value" />
                                  <input type="hidden" id="listing_id" name="listing_id" value="<?php echo $mylisting_details[0]['id']; ?>" />
                              </ul>
                          </div>
                        </form>
                        
                        <div class="table-section-listing-details">
                           <h3>Listing Details</h3>
                           <div class="table-responsive">
                              <table class="table transe-detai-table my-profile-table listndetailstb">
                                 <tbody>
                                    <?php
                                       foreach ($mylisting_data as $key => $value) {
                                           ?>
                                    <tr>
                                       <td class="bold-fnts"><?php echo ucwords($value['attribute_slug']); ?></td>
                                       <td><?php echo $value['attribute_value']; ?></td>
                                    </tr>
                                    <?php 
                                       } // end foreach
                                       ?>                           
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-12">
                     <p class="lisiting-sdetail"><?php 
                        if ( isset($mylisting_details[0]['description']) && $mylisting_details[0]['description'] != '' )
                        { 
                            echo $mylisting_details[0]['description']; 
                        } // end if
                        else 
                        {
                            echo 'Description Not Available'; 
                        }  // end else 
                        ?></p>
                  </div>
               </div>
               <?php 
                  } // end if 
                  else
                  { 
                      ?>
               <div class="row">
                  <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:center">
                     <h3>No Data Found</h3>
                  </div>
               </div>
               <?php
                  } // end else if
                  ?>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-12">
              <!-- Listing of same category  -->
               <div class="col-md-12">
                  <div class="title-detail-listng">Similar Listings</div>
                  <?php if(count($similarlisting) > 0)
                    { 
                    ?>
                  <div class="bottom-slider listing-detail-slider">
                     <flex-carousel data-options="{
                        visibleItems: 4,
                        animationSpeed: 1000,
                        autoPlay: true,
                        autoPlaySpeed: 3000,
                        pauseOnHover: true,
                        enableResponsiveBreakpoints: true,
                        responsiveBreakpoints: {
                        portrait: {
                        changePoint: 480,
                        visibleItems: 1
                        },
                        landscape: {
                        changePoint: 640,
                        visibleItems: 2
                        },
                        tablet: {
                        changePoint: 768,
                        visibleItems: 3
                        }
                        }
                        }">
                        <ul id="flexiselDemo2">
                           <?php foreach( $similarlisting as $data)
                              {
                              ?>
                           <li>
                              <a href="<?php echo base_url().'listing/details/'.$data['slug'] ?>">
                                 <div class="main-box">
                                    <div class="flex-img">
                                       <img  width='270px' height='310px' src="<?php echo base_url().'uploads/addlisting_images/'.$data['mainphoto'];?>" alt="" /> 
                                       <div class="caption">
                                          <h4>
                                             <?php echo $data['description'];?>
                                          </h4>
                                          <h5>
                                             Category: 
                                             <span>
                                             <?php echo ucwords($data['title']);?>
                                             </span>
                                          </h5>
                                       </div>
                                       <div class="hover-text-block">
                                          <h6>price (Aed)</h6>
                                          <h1>
                                             <?php echo $data['price'];?>
                                          </h1>
                                          <div class="date-status">
                                             <p>
                                                Listed On : 
                                                <span>
                                                <?php echo date("  d F Y", strtotime($data['created_date']));?>
                                                </span>
                                             </p>
                                             <p>Availability: <span><?php echo $data['availability'];?></span></p>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="slider-text">
                                       <p>
                              <a href="<?php echo base_url().'listing/details/'.base64_encode($data['id']); ?>" ><?php echo ucwords($data['title']);?></a>
                              </p>
                              </div>
                              </div>
                              </a>
                           </li>
                           <?php } // end foreach ?> 
                        </ul>
                     </flex-carousel>
                  </div>
                  <?php } // end if
                  else { ?>
                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:center">
                         <h3>No Data Found</h3>
                      </div>
                   </div>
                  <?php  
                  //echo "No Record Found"; 
                  } // end else
                  ?>
               </div>
            </div>

         </div>
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

<!--rating -->
<script type="text/javascript">
jQuery(function() {
    jQuery('.starbox').each(function() {
        var starbox = jQuery(this);
        starbox.starbox({
            average: starbox.attr('data-start-value'),
            changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
            ghosting: starbox.hasClass('ghosting'),
            autoUpdateAverage: starbox.hasClass('autoupdate'),
            buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
            stars: starbox.attr('data-star-count') || 5
        }).bind('starbox-value-changed', function(event, value) {
            if(starbox.hasClass('random')) {
                var val = Math.random();
                starbox.next().text(val*5);
                return val;
            } else {
                starbox.next().text(value*5);
            }
        }).bind('starbox-value-moved', function(event, value) {
            starbox.next().text(value*5);
            $('#review_count').val(value*5);
            $('#rivew-count').html(value*5);
            
        });
    });
});
//--><!]]>
</script>
<input type="hidden" name="is_logged" id="is_logged" value="<?php echo $this->session->userdata('user_id') ?>">
<script type="text/javascript">
$(document).ready(function(){
    $('.starbox').click(function(){
        
        var user = $('#is_logged').val();
        if( user == '')
        {
          $('.login').click();
        }
        else{
          var rating = $('.rivew-count').text();
          //$('#rating_value').val(rating);
          var listing_id = $('#listing_id').val();

          $.ajax({
            url:site_url+'listing/rating',
            type:'POST',
            dataType: "json",
            data:{ rating:rating, listing_id:listing_id },
            success:function(response)
            {

              if(response.inquiry_status == "success") {
                $("#rating_error").html();
                $("#rating_success").html(response.rating_msg);

                setTimeout(function(){
                  $('#rating_success').fadeOut('slow');
                  ajaxindicatorstop();
                  //window.location.href = response.URL;
                },1000);

              } else {

                ajaxindicatorstop();
                $("#rating_success").html();
                $("#rating_error").html(response.rating_msg);

                setTimeout(function(){
                  $('#rating_error').fadeOut('slow');
                  ajaxindicatorstop();
                  //window.location.href = response.URL;
                },1000);
                
              }

              return true;

            }
          });
        }
    });
});
</script>
<!--end rating -->