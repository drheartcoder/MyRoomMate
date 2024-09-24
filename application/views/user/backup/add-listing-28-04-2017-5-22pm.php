<!--    Payment Start Here-->
<link href="<?php echo base_url(); ?>front-asset/css/payment.css" rel="stylesheet" type="text/css" />
<!-- <script src="<?php //echo base_url(); ?>front-asset/js/payment.js" type="text/javascript"></script> -->
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
    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="title-inner-page">Add Listing</div></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt">
                                    <div class="title-redios">Categories</div>
                                    <div class="select-bock-container">
                                    
                                    <!-- <div id="err_other" class="error"></div> -->

                                    <select class="form-control" id="category_name" name="category_name" displayerror="category">
                                        <option value="">Select Category</option>
                                        <?php foreach($fetchcategory as $category) { ?>
                                          <?php if ($category['parent_id'] == '0') { ?>
                                          <option class="lavel1" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                          <?php } else { ?>
                                          <option class="lavel2" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                          <?php } ?>
                                        <?php } ?>
                                    </select>

                                    <div class="error"></div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.adddescription.$touched &amp;&amp; loginForm.adddescription.$invalid }">
                                    <textarea displayerror="Description" name="adddescription" id="adddescription" cols="" class="input-box textarea-txt" rows="" ng-model="user.adddescription" ng-minlength="5" ng-maxlength="20" required=""></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.adddescription.$error" ng-if="loginForm.$submitted || loginForm.adddescription.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Description</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                 <div class="form-group input-box-w">
                                  <!--image upload start here-->
                                    <div ng-controller="uploadImage">
                                         <div class="profile-pic">
                                           <div class="row">
                                               <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                               <div class="col-sm-12 col-md-7 col-lg-9">
                                                    <input displayerror="Main Photo" onchange="loadFile(event)" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = '../images/user.png'" name="mainphoto" id="mainphoto" />
                                                    <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> mainphoto</button>
                                                    <div class="error"></div>
                                               </div>
                                           </div>
                                          </div>
                                        <!--image upload end here-->
                                     </div>
                                  </div>
                             </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.mobilenumber.$touched &amp;&amp; loginForm.mobilenumber.$invalid }">
                                    <input displayerror="Mobile Number" class="input-box" id="mobilenumber" name="mobilenumber" ng-model="user.mobilenumber" ng-minlength="5" ng-maxlength="20" required="" type="text">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.mobilenumber.$error" ng-if="loginForm.$submitted || loginForm.mobilenumber.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Mobile Number</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.addemail.$touched &amp;&amp; loginForm.addemail.$invalid }">
                                    <input displayerror="Email" class="input-box" id="addemail" name="addemail" ng-model="user.addemail" ng-minlength="5" ng-maxlength="20" required="" type="text">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.addemail.$error" ng-if="loginForm.$submitted || loginForm.addemail.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Email</label>
                                </div>
                            </div>
                            

                            <div id="formbuild">
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt">
                                    <div class="title-redios">Payment</div>
                                        <div class="btns-main">
                                            <div class="radio-btn" id="pay_free">
                                                <input displayerror="Payment" id="payment1" name="payment" type="radio" value="Free"/>
                                                <label for="payment1"> Free </label>
                                                <div class="check"></div>
                                            </div>
                                            
                                        <div class="btns-main">
                                            <div class="radio-btn" id="pay_10usd">
                                                <input displayerror="Payment" id="payment2" name="payment" type="radio" value="10 USD"/>
                                                <label for="payment2"> Featured for 1 Week ( 10 USD) </label>
                                                <div class="check"></div>
                                            </div>
                                        </div>

                                          <div class="btns-main">
                                                <div class="radio-btn" id="pay_15usd">
                                                    <input displayerror="Payment" id="payment3" name="payment" type="radio" value="15 USD"/>
                                                    <label for="payment3"> Featured for 2 Week ( 15 USD) </label>
                                                    <div class="check"></div>
                                                    <div class="error"></div>
                                                </div>
                                          </div>
                                 </div>
                             </div>


                             <!-- start payment -->
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="img-err">
                                    <div style="color:#007aca; margin-top: 10px;" class="" >&nbsp;</div>
                                </div>
                            </div>

                            <div id="start_payment" style="display:none;">
                                <div class="col-sm-3 col-md-3 col-lg-3 p-r">
                                    <div class="side-menu">
                                        <ul>
                                            <a class="act common" id="monthly-free1" data-target="credit">
                                                <li class="active-pay" id="li_monthly-free1"><span><i class="fa fa-credit-card" aria-hidden="true"></i></span>Credit/Debit Card</li></a>
                                            <a class="common" id="monthly-free11" data-target="paypal">
                                                <li class="last-border" id="li_monthly-free11"><span><i class="fa fa-paypal" aria-hidden="true"></i></span>Pay Pal</li></a>
                                        </ul>
                                    </div>
                                </div>


                            <div class="col-sm-9 col-md-9 col-lg-9 pp-l">
                            <div class="payment_card">
                            <div class="payment-credit-card paymt-sec" id="credit">
                                <div class="top_card_icon">
                                    <div class="card_title">Pay using Credit Card</div>
                                    <div class="card_icon_img">
                                        <a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>front-asset/images/pay_pal.png" /></a>
                                        <a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>front-asset/images/master_card.png" /></a>
                                        <a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>front-asset/images/visa.png" /></a>
                                    </div>
                                </div>

                            <!-- <form id="frm_payment" name="frm_payment" method="post" action="<?php echo base_url();?>payment/paynow/"> -->

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
                                                <div class="col-sm-12 col-md-12 col-lg-12"> <div class="user_box"><div class="label_text tnf">Expiry Date</div></div></div>

                                                <div class="col-sm-12 col-md-6 col-lg-5">
                                                    <div class="user_box">
                                                        <input type="text"
                                                        class="input-bx-b exp"
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
                                            <div class="btn-apymt">
                                            <button class="change-btn-pass" id="btn_cc_pay" name="btn_cc_pay" type="submit">Pay</button>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

                            <div class="btn-apymt">
                            <button class="change-btn-pass" type="submit" id="btn_pay" name="btn_pay">Pay</button>
                            </div>
                            </div>
                            </div>
                            </div>
                            <!-- </form> -->
                            <div class="clr"></div>
                            </div>
                            </div>
                            </div>
                            <!-- end payment--> 


                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="button-innerpage">
                                    <!-- <a href="javascript:void(0)" >Submit</a> -->
                                    <div class="btn-apymt">
                                        <input type="submit" class="change-btn-pass" id="addlistingsubmit" name="addlistingsubmit" value="Submit">
                                    </div>

                                </div>
                            </div>
                  
                        </div>
             
                    </form>
             
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
        /*document.getElementById("btn_cc_pay").innerHTML = "Pay 0";
        document.getElementById("btn_pay").innerHTML = "Pay 0";*/
    });
    $("#pay_10usd").click(function(){
        $("#start_payment").show();
        /*document.getElementById("btn_cc_pay").innerHTML = "Pay 10";
        document.getElementById("btn_pay").innerHTML = "Pay 10";*/
    });
    $("#pay_15usd").click(function(){
        $("#start_payment").show();
        /*document.getElementById("btn_cc_pay").innerHTML = "Pay 15";
        document.getElementById("btn_pay").innerHTML = "Pay 15";*/
    });
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
