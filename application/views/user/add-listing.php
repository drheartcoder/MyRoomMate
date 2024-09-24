<!--    Payment Start Here-->
<link href="<?php echo base_url(); ?>front-asset/css/payment.css" rel="stylesheet" type="text/css" />
<!--    Payment End Here--> 
<div class="main-inner-gray">
<div class="container">
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
         <?php $this->load->view('user/left-menu'); ?>  
      </div>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
         <div class="main-inner">
            <form enctype="multipart/form-data" method="POST" id="addlistingform" name="addlistingform" action="<?php echo base_url(); ?>user/payment" novalidate>
               <div class="row" id="add_listing_form">
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="title-inner-page">Add Listing</div>
                     <p>Note: All Fields are Compulsory</p>
                     </br>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <?php
                        if($this->session->flashdata('success') != "")
                        {
                        ?>
                     <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">×</button>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success') ?>
                     </div>
                     <?php
                        }
                        else if($this->session->flashdata('error') != "")
                        {
                        ?>
                     <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close">×</button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                     </div>
                     <?php
                        }
                        ?>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_category">
                     <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios">Categories</div>
                        <div class="select-bock-container">
                           <!-- <div id="err_other" class="error"></div> -->
                           <select class="form-control" id="category_name" name="category_name" displayerror="category">
                              <optgroup label="">
                              <option value="">Select Category</option>
                              </optgroup>
                              
                              <?php foreach($fetchcategory as $category) { ?>
                                 <optgroup label="<?php echo $category['category_name'];?>">

                                 <?php $where = array('parent_id'=> $category['category_id'],'is_delete'=>'0','category_status'=>'1');
                                 $childchildcat = $this->master_model->getRecords('tbl_category_master',$where); ?>

                                 <?php foreach($childchildcat as $value) { ?>
                                    <option class="lavel2" value="<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?></option>
                                 <?php } ?> 

                                 </optgroup>
                              <?php } ?>
                           </select>
                           <div class="error"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_title">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.title.$touched &amp;&amp; loginForm.title.$invalid }">
                        <input displayerror="Title" class="input-box" id="title" name="title" ng-model="user.title" ng-minlength="5" ng-maxlength="20" required="" type="text">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.title.$error" ng-if="loginForm.$submitted || loginForm.title.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Title</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_desc">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.adddescription.$touched &amp;&amp; loginForm.adddescription.$invalid }">
                        <textarea displayerror="Description" name="adddescription" id="adddescription" cols="" class="input-box textarea-txt" rows="" ng-model="user.adddescription" ng-minlength="5" ng-maxlength="20" required="" style="height:150px;"></textarea>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.adddescription.$error" ng-if="loginForm.$submitted || loginForm.adddescription.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Description</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_image">
                     <div class="form-group input-box-w">
                        <!--image upload start here-->
                        <div ng-controller="uploadImage">
                           <div class="profile-pic">
                              <div class="row">
                                 <div class="col-sm-12 col-md-5 col-lg-3">
                                    <div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div>
                                 </div>
                                 <div class="col-sm-12 col-md-7 col-lg-9">
                                    <input displayerror="Main Photo" onchange="loadFile(event)" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = '<?php echo base_url(); ?>front-asset/images/default-thumbnail.jpg'" name="mainphoto" id="mainphoto" />
                                    <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> mainphoto</button>
                                    <div class="error"></div>
                                 </div>
                              </div>
                           </div>
                           <!--image upload end here-->
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_mobile">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.mobilenumber.$touched &amp;&amp; loginForm.mobilenumber.$invalid }">
                        <input displayerror="Mobile Number" class="input-box" id="mobilenumber" name="mobilenumber" ng-model="user.mobilenumber <?php echo isset($_SESSION['user_mobile_number'])?$_SESSION['user_mobile_number']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($_SESSION['user_mobile_number'])?$_SESSION['user_mobile_number']:''; ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.mobilenumber.$error" ng-if="loginForm.$submitted || loginForm.mobilenumber.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Mobile Number</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_email">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.addemail.$touched &amp;&amp; loginForm.addemail.$invalid }">
                        <input displayerror="Email" class="input-box" id="addemail" name="addemail" ng-model="user.addemail <?php echo isset($_SESSION['user_email'])?$_SESSION['user_email']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($_SESSION['user_email'])?$_SESSION['user_email']:''; ?>">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.addemail.$error" ng-if="loginForm.$submitted || loginForm.addemail.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Email</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_country">
                     <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios">Country</div>
                        <div class="select-bock-container">
                           <select class="form-control" id="country" name="country" displayerror="country">
                              <option value="">Select Country</option>
                              <?php foreach($fetchcountry as $country) { ?>
                                 <option <?php if($userdata[0]['nationality'] == $country['country_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                               <?php } ?>
                           </select>
                           <div id="err_country" class="error"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_countryofresidence">
                     <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios">City</div>
                        <div class="select-bock-container">
                           <select class="form-control" id="countryofresidence" name="countryofresidence" displayerror="residence">
                              <option value="">Select City</option>
                               <?php foreach($fetchresidence as $residence) { ?>
                                 <option <?php if($userdata[0]['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>
                               <?php } ?>
                           </select>
                           <div id="error_countryofresidence" class="error"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_address">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.address.$touched &amp;&amp; loginForm.address.$invalid }">
                        <textarea displayerror="Address" name="address" id="address" cols="" class="input-box textarea-txt" rows="" ng-model="user.address" ng-minlength="5" ng-maxlength="20" required=""><?php echo isset($_SESSION['user_address'])?$_SESSION['user_address']:''; ?></textarea>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.address.$error" ng-if="loginForm.$submitted || loginForm.address.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Address</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_price">
                     <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.price.$touched &amp;&amp; loginForm.price.$invalid }">
                        <input displayerror="Price" class="input-box" id="price" name="price" ng-model="user.price" ng-minlength="5" ng-maxlength="20" required="" type="text">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div class="error"></div>
                        <div ng-messages="loginForm.price.$error" ng-if="loginForm.$submitted || loginForm.price.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Price</label>
                     </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_availability">
                     <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios">Availability</div>
                        <div class="select-bock-container">
                           <!-- <div id="err_other" class="error"></div> -->
                           <select class="form-control" id="availability" name="availability" displayerror="Availability">
                              <option value="">Select Availability</option>
                              <option value="Immediately">Immediately</option>
                              <option value="Within1Week">Within 1 Week</option>
                              <option value="Within1Month">Within 1 Month</option>
                              <option value="Within3Months">Within 3 Months</option>
                              <option value="Within6Months">Within 6 Months</option>
                           </select>
                           <div class="error"></div>
                        </div>
                     </div>
                  </div>
                  <div id="formbuild">
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="agree">
                    <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.iagree.$touched &amp;&amp; loginForm.iagree.$invalid }">
                     <div class="title-redios"></div>
                        <div class="listing-div innercheckbox">
                           <p class="checkboxs" >
                              <input displayerror="Iagree" class="filled-in" id="iagree" name="iagree" ng-model="user.iagree" required="" type="checkbox" value="">
                              <label for="iagree">I agree with the <a data-toggle="modal" href="#terms"  data-dismiss="modal">Terms & Conditions</a>.</label>
                              <span class="highlight"></span>
                              <!-- <span class="bar"></span> -->
                              <div class="error"></div>
                              <div ng-messages="loginForm.iagree.$error" ng-if="loginForm.$submitted || loginForm.iagree.$touched">
                                 <div ng-messages-include="error-message.html"></div>
                              </div>
                           </p>
                     </div>
                  </div>
               </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group input-box-w inner-inpt">
                        <div class="title-redios">Payment</div>
                        <div class="btns-main">
                           <div class="radio-btn" id="pay_free">
                              <input displayerror="Payment" class="check_listing" id="payment" name="payment" type="radio" value="Free"/>
                              <label for="payment"> Free </label>
                              <div class="check"></div>
                           </div>
                           
                           <div id="pay_usd">
                           <?php if( count($price_data) > 0 )
                           { 
                              foreach ($price_data as $price)
                              {
                                 ?>
                                    <div class="btns-main">
                                       <div class="radio-btn">
                                          <input displayerror="Payment" class="check_listing" id="payment<?php echo $price['membership_id']; ?>" name="payment" type="radio" value="<?php echo $price['membership_price']; ?> USD"/>
                                          <label for="payment<?php echo $price['membership_id']; ?>"> Featured for <?php echo $price['pricing_name']; ?> ( <?php echo $price['membership_price']; ?> USD) </label>
                                          <div class="check"></div>
                                          <div class="error"></div>
                                       </div>
                                    </div>
                                 <?php
                              } // end foreach
                           ?>
                           <?php } // end if ?>
                           </div>

                           <!-- <div class="btns-main">
                              <div class="radio-btn" id="pay_10usd">
                                 <input displayerror="Payment" class="check_listing" id="payment2" name="payment" type="radio" value="10 USD"/>
                                 <label for="payment2"> Featured for 1 Week ( 10 USD) </label>
                                 <div class="check"></div>
                              </div>
                           </div>

                           <div class="btns-main">
                              <div class="radio-btn" id="pay_15usd">
                                 <input displayerror="Payment" class="check_listing" id="payment3" name="payment" type="radio" value="15 USD"/>
                                 <label for="payment3"> Featured for 2 Week ( 15 USD) </label>
                                 <div class="check"></div>
                                 <div class="error"></div>
                              </div>
                           </div> -->

                        </div>
                     </div>
                     <!-- start payment -->
                     <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="img-err">
                           <div style="color:#007aca; margin-top: 10px;" class="" >&nbsp;</div>
                        </div>
                     </div>
                     <div id="start_payment" style="display:none;">
                        <div class="row">
                          <!--  <div class="col-sm-3 col-md-3 col-lg-4 p-r">
                              <div class="side-menu">
                                 <ul>
                                    <a class="act common" id="monthly-free1" data-target="credit">
                                       <li class="active-pay" id="li_monthly-free1"><span><i class="fa fa-credit-card" aria-hidden="true"></i></span>Credit/Debit Card</li>
                                    </a>
                                    <a class="common" id="monthly-free11" data-target="paypal">
                                       <li class="last-border" id="li_monthly-free11"><span><i class="fa fa-paypal" aria-hidden="true"></i></span>Pay Pal</li>
                                    </a>
                                 </ul>
                              </div>
                           </div> -->
                           <div class="col-sm-9 col-md-9 col-lg-8 pp-l">
                              <div class="payment_card">
                                 <!-- <div class="payment-credit-card paymt-sec" id="credit">
                                    <div class="top_card_icon">
                                       <div class="card_title">Pay using Credit Card</div>
                                       <div class="card_icon_img">
                                          <a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>front-asset/images/cart-debit.png" style="height: 30px;" /></a>
                                       </div>
                                    </div>
                                   
                                    <div class="payment-form">
                                       <div class="row">
                                          <div class="col-sm-12 col-md-12 col-lg-10">
                                             <div class="row">
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                   <div class="user_box">
                                                      <div class="input-bx-b">
                                                         <input type="text"
                                                            class="tra-input"
                                                            id="card_type"
                                                            name="card_type"
                                                            placeholder="Credit/Debit Card"
                                                            readonly/>
                                                         <div class="card_icon_img" id="card_type-img">
                                                            <a href="javascript:void(0);" id="visa"><img alt="" src="<?php echo base_url();?>front-asset/images/pay-visa.png" /></a>
                                                            <a href="javascript:void(0);" id="mastercard"><img alt="" src="<?php echo base_url();?>front-asset/images/pay-mstercard.png" /></a>
                                                         </div>
                                                      </div>
                                                      <div class="error_msg" id="error_msg_card_type"></div>
                                                   </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                   <div class="user_box-imf">
                                                      <input type="text"
                                                         class="input-bx-f allowOnlySixteen"
                                                         id="cc_number"
                                                         name="cc_number"
                                                         placeholder="Card Number" />
                                                      <div class="img-odiv" >
                                                         <img src="<?php echo base_url();?>front-asset/images/cart-nubs.png" alt="" />
                                                      </div>
                                                      <div id="error_msg_cc_number" class="error_msg"></div>
                                                   </div>
                                                </div>
                                                <div class="col-sm-12 col-md-12 col-lg-12">
                                                   <div class="user_box">
                                                      <div class="label_text tnf">Expiry Date</div>
                                                   </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-5">
                                                   <div class="user_box">
                                                      <input type="text"
                                                         class="input-bx-b"
                                                         id="cc_exp"
                                                         name="cc_exp"
                                                         placeholder="MM/YYYY" />
                                                      <div class="error_msg" id="error_msg_cc_exp"></div>
                                                   </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 col-lg-6">
                                                   <div class="user_box">
                                                      <input class="input-bx-b input-card "
                                                         id="cc_cvc"
                                                         name="cc_cvc"
                                                         type="text"
                                                         placeholder=" CVV " /><span></span>
                                                      <div class=" error_msg" id="error_msg_cc_cvc"></div>
                                                   </div>
                                                </div>
                                                <div class="clr"></div>
                                                <div class="col-lg-12">
                                                   <div class="button-innerpage blog-submit-btn max-widths-blog">
                                                      <button class="change-btn-pass" id="btn_cc_pay" name="btn_cc_pay" type="submit">Submit</button>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div> -->
                                 <div class="payment-paypal paymt-sec payment-form" id="paypal">
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="top_card_icon">
                                             <div class="card_title">Pay using Paypal</div>
                                             <div class="card_icon_img">
                                                <a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>front-asset/images/pay_pal.png" /></a>
                                             </div>
                                          </div>
                                          <div class="pay-tril"><span>Click to connect to paypal</span>(You won't be charged until the order is placed.) </div>
                                          <div class="clr"></div>
                                          <div class="pay-tril">By clicking Continue to PayPal, you authorise TaskersHub to charge your PayPal account for the full amount of all fees related to your buying activity on TaskersHub.</span></div>
                                          <div class="button-innerpage blog-submit-btn max-widths-blog">
                                             <button class="change-btn-pass" type="submit" id="btn_pay" name="btn_pay">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- </form> -->
                                 <div class="clr"></div>
                              </div>
                           </div>
                        </div>
                    </div>
                    <!-- end payment--> 
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="button-innerpage blog-submit-btn max-widths-blog">
                           <button type="submit" id="addlistingsubmit" name="addlistingsubmit" value="comments_submit" style="display:none;">Submit</button>
                        </div>
                     </div>
            </form>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Payment Method Validations jQuery -->
<script type="application/javascript">
   $(document).ready(function(){
       $("#pay_free").click(function(){
           $("#start_payment").hide();
       });
       $("#pay_usd").click(function(){
           $("#addlistingsubmit").hide();
       });
       /*$("#pay_15usd").click(function(){
           $("#addlistingsubmit").hide();
           document.getElementById("btn_cc_pay").innerHTML = "Pay 15";
           document.getElementById("btn_pay").innerHTML = "Pay 15";
       });*/
   });
</script>
<script type="application/javascript">
   //onclick toggle
   $(document).ready(function() 
   {
       $('.container1-b').hide();
       $(".container1-b:first").addClass("act1").show();
       $('.regi_toggle .billing_cycle').click(function() 
       {
           $('.billing_cycle').removeClass('act'); //remove the class from the button
           $(this).addClass('act'); //add the class to currently clicked button
           var target = "#" + $(this).data("target");
           $(".container1-b").not(target).hide();
           $(target).show();
           target.slideToggle();
       });
   
       $(".billing_cycle").click(function(event) 
       {
           event.stopPropagation();
           /*alert("The span element was clicked.");*/
       });
   
       $('.paymt-sec').hide();
       $(".paymt-sec:first").addClass("ac1").show();
       $('.side-menu .common').click(function() 
       {
           //alert();
           var curr_id = $(this).attr('id');
           $('.common').removeClass('act2'); //remove the class from the button
           $(this).addClass('act2'); //add the class to currently clicked button
           var target = "#" + $(this).data("target");
           console.log(target);
           $(".paymt-sec").not(target).hide();
           $(target).show();
   
           //target.slideToggle();
           if(curr_id=='monthly-free1')
           {
               $('#li_monthly-free1').addClass('active-pay');
               $('#li_monthly-free1').addClass('last-border');
               $('#li_monthly-free11').removeClass('active-pay');
               $('#li_monthly-free11').removeClass('last-border');
           }
           if(curr_id=='monthly-free11')
           {
               $('#li_monthly-free11').addClass('active-pay');
               $('#li_monthly-free11').addClass('last-border');
               $('#li_monthly-free1').removeClass('active-pay');
               $('#li_monthly-free1').removeClass('last-border');
           }
       });
   
       /* --------------T.A--------------------------------*/
       $('#visa').click(function(){
           $('#card_type').val('Visa');
       });
   
       $('#mastercard').click(function(){
           $('#card_type').val('Mastercard');
       });
   
       $('#amazon').click(function(){
           $('#card_type').val('Amazon');
       });
   
       $('#discover').click(function(){
           $('#card_type').val('Discover');
       });
   
       $('#btn_cc_pay').click(function()
       {
           var card_type = $('#card_type').val();
           var Acc_no = $('#cc_number').val();
           var Expirydate = $('#cc_exp').val();
           var cvv = $('#cc_cvc').val();
           var flag=1;
           if(card_type=="")
           {
               $('#error_msg_card_type').show();
               $('#error_msg_card_type').html('Please select card type');
               $('#card_type').focus();
               $('#card_type-img').on('click',function()
               {
                   $('#error_msg_card_type').hide();
               });
   
               flag=0;
           }
           if(Acc_no=="")
           {
               $('#error_msg_cc_number').show();
               $('#error_msg_cc_number').html('Please enter card no');
               $('#cc_number').focus();
               $('#cc_number').on('keyup',function()
               {
                   //$('#error_msg_cc_number').hide();
               });
   
               flag=0;
           }
   
           if(Expirydate=="")
           {
               $('#error_msg_cc_exp').show();
               $('#error_msg_cc_exp').html('Please enter expiry date');
               $('#cc_exp').focus();
               $('#cc_exp').on('click',function()
               {
                   $('#error_msg_cc_exp').hide();
               });
   
               flag=0;
           }
           if(Expirydate!="")
           {
               var txtVal = $('#cc_exp').val();
               var filter = new RegExp("(0[123456789]|10|11|12)([/])([1-2][0-9][0-9][0-9])");
   
               var lastFive = txtVal.substr(txtVal.length - 4);
               var currentYear = new Date().getFullYear();
   
               var firstTwo = txtVal.substring(0, 2);
               var currentDay = new Date();
   
               var d = new Date();
               var currentDay = d.getMonth();
   
   
               if(!filter.test(txtVal) || lastFive < currentYear || firstTwo < currentDay || lastFive == currentYear && firstTwo < currentDay)
               {
                   $('#error_msg_cc_exp').show();
                   $('#error_msg_cc_exp').html('Invalid Date!!!');
                   $('#cc_exp').focus();
                   $('#cc_exp').on('click',function()
                   {
                       $('#error_msg_cc_exp').hide();
                   });
   
                   flag=0;
               }
           }
           if(cvv=="")
           {
               $('#error_msg_cc_cvc').show();
               $('#error_msg_cc_cvc').html('Please enter cvv');
               $('#cc_cvc').focus();
               $('#cc_cvc').on('keyup',function()
               {
                   //$('#error_msg_cc_cvc').hide();
               });
   
               flag=0;
           }
   
           /* credit card expiry date validation (mm/yyyy) --------------T.A*/
           $('#cc_exp').blur(function() 
           {
               var txtVal = $('#cc_exp').val();
               var filter = new RegExp("(0[123456789]|10|11|12)([/])([1-2][0-9][0-9][0-9])");
   
               var lastFive = txtVal.substr(txtVal.length - 4);
               var currentYear = new Date().getFullYear();
   
               var firstTwo = txtVal.substring(0, 2);
               var currentDay = new Date();
   
               var d = new Date();
               var currentDay = d.getMonth();
   
               flag=1;
               if(!filter.test(txtVal) || lastFive < currentYear || firstTwo < currentDay || lastFive == currentYear && firstTwo < currentDay)
               {
                   $('#error_msg_cc_exp').show();
                   $('#error_msg_cc_exp').html('Invalid Date!!!');
                   $('#cc_exp').focus();
                   $('#cc_exp').on('click',function()
                   {
                       $('#error_msg_cc_exp').hide();
                   });
                   flag=0;
               }
           });
           /* end credit card expiry date ------------------------------T.A*/
           if(flag==1)
           {
               return true;
           }
           else
           {
               return false;
           }
       
           /* character restriction */
           $("#cc_number").bind("keydown", function (event) 
           {
               if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 17 || event.keyCode == 86 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 ||
               // Allow: Ctrl+A
               (event.keyCode == 65 && event.ctrlKey === true) ||
               // Allow: home, end, left, right
               (event.keyCode >= 35 && event.keyCode <= 39)) 
               {
                   // let it happen, don't do anything
                   return;
               } 
               else 
               {
                   // Ensure that it is a number and stop the keypress
                   if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) 
                   {
                       $('#error_msg_cc_number').show();
                       $('#error_msg_cc_number').html('Please enter only numbers');
                       event.preventDefault();
                   }
                   else
                   {
                       $('#error_msg_cc_number').hide();
                   }
               }
           });
           $("#cc_cvc").bind("keydown", function (event) 
           {
               if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || event.keyCode == 190 ||
               // Allow: Ctrl+A
               (event.keyCode == 65 && event.ctrlKey === true) ||
   
               // Allow: home, end, left, right
               (event.keyCode >= 35 && event.keyCode <= 39)) 
               {
               // let it happen, don't do anything
               return;
               } 
               else 
               {
                   // Ensure that it is a number and stop the keypress
                   if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) 
                   {
                       $('#error_msg_cc_cvc').show();
                       $('#error_msg_cc_cvc').html('Please enter only numbers');
                       event.preventDefault();
                   }
                   else
                   {
                       $('#error_msg_cc_cvc').hide();
                   }
               }
           });
       });
   
   /* end character restriction --------------T.A*/
   }); // end document ready
</script>

<!--Terms and Conditions modal start here-->
<div id="terms" class="modal fade popup-cls" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url(); ?>front-asset/images/close.png" alt="" /></button>
            <div class="login-modal">
               <div class="login-form">
                  <h1><?php if(isset($terms_and_conditions) && sizeof($terms_and_conditions)>0) { echo $terms_and_conditions[0]['page_title']; }?></h1>
                  <br/>
                  <div><?php if(isset($terms_and_conditions) && sizeof($terms_and_conditions)>0) { echo $terms_and_conditions[0]['page_description']; }?></div>
               </div>
               <div class="forget-block"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Terms and Conditions modal end here-->

