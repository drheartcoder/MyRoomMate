
<!--    Review Rating Demo Start Here-->


<script src="<?php echo base_url().'front-asset/review/'; ?>jstarbox.js"></script>
<link rel="stylesheet" href="<?php echo base_url().'front-asset/review/'; ?>jstarbox.css" type="text/css" media="screen" charset="utf-8" />
<!--    Review Rating Demo End Here--> 

<link href="<?php echo base_url();?>front-asset/css/slider-gallery.css" rel="stylesheet" type="text/css" />
    
<div class="middle-section listing-page">
    <div class="container">
        <div class="page-path mrg-bottoms">
           <!-- <div class="row">
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
           </div> -->
            
        </div>
        <div class="row">
        
        <?php 
        //echo $addlisting[0]['mainphoto'];
        if(!empty($addlisting)) 
        { 
            // check listisng image
            if ( isset($addlisting[0]['mainphoto']) && !empty($addlisting[0]['mainphoto']) )
            {
                $listing_image = base_url().'uploads/addlisting_images/thumbdetail/'.$addlisting[0]['mainphoto'];

                $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumbdetail/'.$addlisting['mainphoto'];

                // check if image exists or not
                if (file_exists($path)) {
                    //echo "The file exists";
                    $listing_image = $listing_image;
                } else {
                  $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                }
                              
                // check if image exists or not
                /*if ( !@getimagesize($listing_image) ) 
                {
                    $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                } */// end if
            } // end if
            else
            {
                $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
            } // end else

           

           /*if(!empty($my_image_listing))
           {
               $my_image = base_url().'uploads/addlisting_images'.$my_image_listing[0]['image'];
                print_r($my_image);
           }*/
            ?>

          <div class="col-sm-12 col-md-6 col-lg-6 product">
            <div class="product-image-slider">
              <div class="row">
             
              <div class="col-xs-12">
                <div class="product-image">
                  <div class="image img-detail-listing lisitng-details-list"">
                   <div class="bigheart">
                    <?php 
                        if($this->session->userdata('user_id') == "")
                        { 
                            ?>
                            <a href="javascript:void(0);" class="ulogin"><i class="fa fa-heart"></i></a>
                            <?php
                        } else {
                            ?>
                            <a href="javascript:void(0);" class="add_to_favorite" data-mylisting="<?php echo base64_encode($addlisting[0]['id']); ?>">
                                <i class="fa fa-heart"></i>
                            </a>
                            <?php
                        }
                    ?>
                </div>

                    <a id="prod-image-link" href="<?php echo $listing_image; ?>"  data-lightbox="image-1690276006" data-title="">
                      <img id="prod-image" src="<?php echo $listing_image; ?>" alt="" />
                    </a>
                  </div>

                </div>
              </div><!-- /.col -->
               <div class="col-xs-12">
                <div class="product-image-slider">
                  <ul class="bxslider" id="prod-image-slider">

                     <li class="">
                      <div class="prod-image">
                        <div class="prod-image-inner">
                          <a href="#">
                            <img src="<?php echo $listing_image; ?>" alt=""/>
                          </a>
                        </div>
                        <!--<div class="arrow"></div>-->
                      </div>
                    </li>
                    
                   <?php foreach($my_image_listing as $image) { ?>
                    <li class="active">
                      <div class="prod-image">
                        <div class="prod-image-inner">
                       
                          <a href="#">
                            
                            <?php if(!empty($image['image']) && file_exists('uploads/addlisting_images/'.$image['image'])) {
                             
                              ?><img src="<?php echo base_url().'uploads/addlisting_images/'.$image['image'] ?>" class="img-responsive" alt="my-roommate"><?php

                            } else{
                              ?>
                              <img src="http://demo.masscode.ru/masspaging/pic/1.png" class="img-responsive" alt="my-roommate">
                              <?php
                            } ?>
                            
                          </a>
                        </div>
                        <!--<div class="arrow"></div>-->
                      </div>
                    </li>

                    <?php } ?>

                   

                  </ul><!-- /.bxslider -->
                  <div class="owl-controls">
                    <a href="#" id="prod-image-next" class="owl-next"></a>
                    <a href="#" id="prod-image-prev" class="owl-prev"></a>
                  </div>
                </div><!-- /.product-image-slider -->
              </div><!-- /.col -->
              </div>
            </div>
          </div>

            
            <div class="col-md-6">
              <div class="backbtn">
                <a href=javascript:history.back()><span><i class="fa fa-long-arrow-left"></i></span>Back to Search Results </a>
                <!-- <a href="< ?php echo base_url().'user/mylisting' ?>"><span><i class="fa fa-long-arrow-left"></i></span>Back</a> -->
              </div>
              <br/>
            </div>

            
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="listing-detail-right">
                    <h2>
                        <?php 
                            if ( isset($addlisting[0]['title']) && $addlisting[0]['title'] != '' ) { 
                                echo $addlisting[0]['title']; 
                            } else {
                                echo 'Title Not Available'; 
                            }  // end else     
                        ?>
                    </h2>
                    <!-- Check if user is login or not -->
                    
                    <div class="ovrly"></div>

                    <form class="rating_form" method="POST" action="<?php echo base_url().'listing/rating'; ?>">
                    <div class="rating-detailpage">
                        <ul class="ratings-ul">
                            <li><div class="starbox colours ghosting small autoupdate" data-button-count="10" data-star-count="5"></div><span class="rivew-count" >0</span></li>
                            <li>Good</li>
                            <li>Favoured: <?php echo isset($nos_favorite)?$nos_favorite:'0'; ?></li>
                            <input type="hidden" id="rating_value" name="rating_value" />
                            <input type="hidden" id="listing_id" name="listing_id" value="<?php echo $addlisting[0]['id']; ?>" />
                        </ul>
                    </div>
                    </form>
                

                <p class="lisiting-sdetail">
                <?php 
                    if ( isset($addlisting[0]['description']) && $addlisting[0]['description'] != '' )
                    { 
                        echo $addlisting[0]['description']; 
                    } // end if
                    else 
                    {
                        echo 'Description Not Available'; 
                    }  // end else 
                ?>
             </p>
             
                <!-- <div id="rating_success" class="success"></div>
                <div id="rating_error" class="error"></div> -->

                <div class="table-section-listing-details">
                   <h3>Listing Details</h3>
                    <div class="table-responsive">
                    
                    <table class="table transe-detai-table my-profile-table listndetailstb">                                
                        <tbody>

                          <?php 
                          $this->db->where('country_id', $addlisting[0]['country']);
                          $get_country_name = $this->master_model->getRecords('tbl_country_master');
                          ?>

                          <?php if($get_country_name[0]['country_name'] != '') { ?> 
                          <tr>
                            <td class="bold-fnts">Country Name</td>
                            <td><?php echo $get_country_name[0]['country_name']; ?></td>
                          </tr>
                          <?php } ?>

                          <?php 
                          $this->db->where('residence_id', $addlisting[0]['countryofresidence']);
                          $get_country_residence_name = $this->master_model->getRecords('tbl_residence_master');
                          ?>

                          <?php if($get_country_residence_name[0]['residence_name'] != '') { ?> 
                          <tr>
                            <td class="bold-fnts">Residence Name</td>
                            <td><?php echo $get_country_residence_name[0]['residence_name']; ?></td>
                          </tr>
                          <?php } ?>

                          <?php if($addlisting[0]['created_date'] != '') { ?> 
                          <tr>
                            <td class="bold-fnts">Created Date</td>
                            <td><?php echo date("d F Y", strtotime($addlisting[0]['created_date'])); ?></td>
                          </tr>
                          <?php } ?>

                          <?php if($addlisting[0]['price'] != '') { ?> 
                          <tr>
                            <td class="bold-fnts">Price/Rent</td>
                            <td><?php echo $addlisting[0]['price']; ?> AED</td>
                          </tr>
                          <?php } ?>

                          <?php if($addlisting[0]['mobile'] != '') { ?> 
                          <tr>
                            <td class="bold-fnts">Mobile</td>
                            <td><?php echo $addlisting[0]['mobile']; ?></td>
                          </tr>
                          <?php } ?>

                            <?php
                                foreach ($addlisting_data as $key => $value) {
                                    ?>
                                        <tr>
                                          <td class="bold-fnts"><?php echo ucwords($value['attribute_slug']); ?></td>
                                        <td><?php echo $value['attribute_value']; ?></td>
                                        </tr>
                                    <?php 
                                }
                            ?>                           
                        </tbody>
                    </table>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="button-innerpage">
                            <input type="hidden" name="useridforinquiry" id="useridforinquiry" value="<?php echo $addlisting[0]['id']; ?>">
                            <input type="hidden" name="addlistingidforinquiry" id="addlistingidforinquiry" value="<?php echo $addlisting[0]['id']; ?>">

                            <?php if( $this->session->userdata('user_id') == "" ) { ?>
                            <a data-toggle="modal" href="#login">Send Inquiry</a>
                            <?php } else { ?>
                            <a data-toggle="modal" href="#sendinquiryform">Send Inquiry</a>
                            <?php } ?>
                        </div>
                    </div>

                    </div>  
                </div>
                </div>
               
            </div>
            
             <div class="col-sm-12 col-md-12 col-lg-12">
             
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

	<p></p>	<p></p>
        <!-- Listing of same category  -->
        <div class="col-md-12">

		<div class="title-bar">
               		<div class="page-title">Similar Listings</div>
                	<div class="clearfix"></div>
	        </div>
                  <div class="title-detail-listng"></div>
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

                                  <?php 

                                  // check listisng image
                                  if ( isset($data['mainphoto']) && !empty($data['mainphoto']) )
                                  {
                                      $listing_image = base_url().'uploads/addlisting_images/thumbdetail/'.$data['mainphoto'];

                                      $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumbdetail/'.$data['mainphoto'];

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
                                             <?php echo $data['description'];?>
                                          </h4>
                                          <h5>
                                            
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
                              <a href="<?php //echo base_url().'listing/details/'.base64_encode($data['id']); ?>" ><?php //echo ucwords($data['title']);?></a>
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

<!--Send Inquiry modal start here-->
<div id="sendinquiryform" class="modal fade popup-cls" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url(); ?>/front-asset/images/close.png" alt="" /></button>
                <div class="login-modal">
                    <div class="login-form">
                        <!-- <h1>Contact</h1> -->
                        <h4>Send an inquiry to the listing owner</h4>
			<p>Do not pay a seller on the internet. For your security, do all your transactions in person. <br>If you suspect a listing is scam, please report it by <a href="http://myroommate.ae/Contact_us" target="_blank">contacting us</a>.</p><p></p>
                        <div id="sendinquiry_success" class="success"></div>
                        <div id="sendinquiry_error" class="error"></div>

                        <form id="inquiryForm" name="inquiryForm" method="POST" novalidate>
                            
                            <!--name start here-->
                            <div class="form-group input-box-w" ng-class="{ 'has-error': inquiryForm.name.$touched && inquiryFormForm.name.$invalid }">
                                <input type="text" class="input-box" id="sendinquiry_name" name="sendinquiry_name" ng-model="sendinquiry.name" value="<?php if($this->session->userdata['user_firstname']!="") { echo $this->session->userdata['user_firstname']; } ?>" ng-init="sendinquiry.name='<?php if($this->session->userdata['user_firstname']!="") { echo $this->session->userdata['user_firstname']; } ?>'" ng-minlength="5" ng-maxlength="20" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <div id="err_sendinquiry_name" class="error"></div>
                                <div ng-messages="loginForm.name.$error" ng-if="inquiryForm.$submitted || inquiryForm.name.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                </div>

                                <label>Name</label>
                            </div>

                            <!--email start here-->
                            <div class="form-group input-box-w" ng-class="{ 'has-error': inquiryForm.email.$touched && inquiryFormForm.email.$invalid }">
                                <input type="email" class="input-box" id="sendinquiry_email" name="sendinquiry_email" ng-model="sendinquiry.email" <?php if($this->session->userdata['user_email']!="") { echo $this->session->userdata['user_email']; } ?>" ng-init="sendinquiry.email='<?php if($this->session->userdata['user_email']!="") { echo $this->session->userdata['user_email']; } ?>'" ng-minlength="5" ng-maxlength="20" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <div id="err_sendinquiry_email" class="error"></div>
                                <div ng-messages="loginForm.email.$error" ng-if="inquiryForm.$submitted || inquiryForm.email.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                </div>

                                <label>Email</label>
                            </div>

                            <!--phone start here-->
                            <div class="form-group input-box-w" ng-class="{ 'has-error': inquiryForm.phone.$touched && inquiryFormForm.phone.$invalid }">
                                <input type="text" class="input-box" id="sendinquiry_phone" name="sendinquiry_phone" ng-model="sendinquiry.phone" <?php if($this->session->userdata['user_mobile_number']!="") { echo $this->session->userdata['user_mobile_number']; } ?>" ng-init="sendinquiry.phone='<?php if($this->session->userdata['user_mobile_number']!="") { echo $this->session->userdata['user_mobile_number']; } ?>'" ng-minlength="5" ng-maxlength="20" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <div id="err_sendinquiry_phone" class="error"></div>
                                <div ng-messages="loginForm.phone.$error" ng-if="inquiryForm.$submitted || inquiryForm.phone.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                </div>

                                <label>Phone</label>
                            </div>

                            <!--subject start here-->
                            <div class="form-group input-box-w" ng-class="{ 'has-error': inquiryForm.subject.$touched && inquiryFormForm.subject.$invalid }">
                                <input type="text" class="input-box" id="sendinquiry_subject" name="sendinquiry_subject" ng-model="sendinquiry.subject" ng-minlength="5" ng-maxlength="50" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <div id="err_sendinquiry_subject" class="error"></div>
                                <div ng-messages="loginForm.subject.$error" ng-if="inquiryForm.$submitted || inquiryForm.subject.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                </div>

                                <label>Subject</label>
                            </div>

                            <!--message start here-->
                            <div class="form-group input-box-w" ng-class="{ 'has-error': inquiryForm.message.$touched && inquiryFormForm.message.$invalid }">
                                <input type="text" class="input-box" id="sendinquiry_message" name="sendinquiry_message" ng-model="sendinquiry.message" ng-minlength="5" ng-maxlength="500" required/>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <div id="err_sendinquiry_message" class="error"></div>
                                <div ng-messages="loginForm.message.$error" ng-if="inquiryForm.$submitted || inquiryForm.message.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                </div>

                                <label>Message</label>
                            </div>
                           
                           <input type="hidden" name="sendinquiry_listingid" id="sendinquiry_listingid" value="<?php echo $addlisting[0]['id']; ?>">
                            
                            <!-- <a id="sendinquiry" name="sendinquiry" href="index.html#!/dashboard-add-listing" role="button" data-dismiss="modal" class="hvr-rectangle-out orng-btn">Login</a> -->
                            <button id="sendinquiry" name="sendinquiry" class="hvr-rectangle-out orng-btn" type="submit">Send</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--Send Inquiry modal end here-->

<script type="text/javascript">
$(document).ready(function(){
    $('.ulogin').click(function(){
        $('.login').click();
    });
});
</script>

<script type="text/javascript">
  
  $('.add_to_favorite').click(function(){
        var mylisting_id = jQuery(this).data("mylisting");
        $.ajax({
        url:site_url+"listing/addfavorite_listing/"+mylisting_id,
        type:'POST',
        dataType:'json',
        success:function(response)
        {

          if(response.status == "success") {
            $("#error").html();
            $("#success").html(response.msg);

          } else {

            ajaxindicatorstop();
            $("#success").html();
            $("#error").html(response.msg);
          }

          return true;

        }
      });
    }); 

</script>

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

              if(response.rating_status == "success") {
                $("#rating_error").html();
                $("#rating_success").html(response.rating_msg);
                $('#rating_success').fadeIn('slow');
                setTimeout(function(){
                  $('#rating_success').fadeOut('slow');
                  ajaxindicatorstop();
                  //window.location.href = response.URL;
                },1000);

              } else {

                ajaxindicatorstop();
                $("#rating_success").html();
                $("#rating_error").html(response.rating_msg);
                $('#rating_error').fadeIn('slow');
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


