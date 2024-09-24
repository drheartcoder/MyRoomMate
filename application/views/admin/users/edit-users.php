     <!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <!-- END Sidebar -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-th-list"></i><?php echo isset($page_title)?$page_title:"" ;?></h1>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url().'admin/dashboard/'; ?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li >
                <a href="<?php echo base_url().'admin/users/manage' ?>">Manage Users</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active"><?php echo isset($page_title)?$page_title:"" ;?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->flashdata('success')!=""){ ?>
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php }if($this->session->flashdata('error')!=""){ ?>
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Error! </strong><?php echo strip_tags($this->session->flashdata('error')); ?>
            </div>
            <?php } ?>
            <div id="form-validation-error" style="display:none">
                <div class="alert alert-danger" >
                    <button class="close" data-dismiss="alert">×</button>
                    <!-- <strong>Error! </strong> Please fill required fields in both English and Arabic Tabs  -->
                    <strong>Error! </strong> Please fill required fields.

                </div>
            </div>
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-th-list"></i><?php echo isset($page_title)?$page_title:"" ;?></h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                       <!--  <a data-action="close" href="#"><i class="fa fa-times"></i></a> -->
                    </div>
                </div>
                <div class="box-content">

                   <?php
                            $attr=array( "class"=>"form-horizontal", "id"=>"validation-form", "name"=>"frm-add-page" , "method"=>"post" , "enctype"=>"multipart/form-data");
                            echo form_open_multipart(base_url()."admin/users/edit/".$this->uri->segment(4)."",$attr);

                                   //print_r($user_info);     ?>

                    <div class="tabbable tabs-left" >
                        <div class="tab-content" id="myTabContent3" >
                            <div id="english" class="tab-pane fade active in">
                                
                                
                                 
                                 <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Username<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="username"
                                               id="username"
                                               class="form-control"
                                               placeholder=" Username"
                                               value="<?php echo isset($user_info[0]['username'])?$user_info[0]['username']:''; ?>"/>
                                       <span class="error_msg" style="color:red;"></span>
                                       <div class="error" id="err_title"></div>
                                    </div>
                                </div>
                              

                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">First Name<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               class="form-control"
                                               placeholder="First Name"
                                               value="<?php echo isset($user_info[0]['firstname'])?$user_info[0]['firstname']:''; ?>"/>
                                       <span class="error_msg" style="color:red;"></span>
                                       <div class="error" id="err_name"></div>
                                    </div>
                                </div>


                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Last Name<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="lastname"
                                               id="lastname"
                                               class="form-control"
                                               placeholder="Last Name"
                                               value="<?php echo isset($user_info[0]['lastname'])?$user_info[0]['lastname']:''; ?>"/>
                                       <span class="error_msg" style="color:red;"></span>
                                       <div class="error" id="err_lastname"></div>
                                    </div>
                                </div>

                                 <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Email<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <input type="text"
                                               name="email"
                                               id="email"
                                               class=" form-control"
                                               data-rule-required="true" 
                                               placeholder=" Email"
                                               value="<?php echo isset($user_info[0]['email'])?$user_info[0]['email']:''; ?>" />       
                                        <div class="error" id="err_email"></div>
                                        <span class="error_msg" style="color:red;"></span>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Gender<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <select class="form-control" id="gender" name="gender" displayerror="gender" >
                                      <option value="">Select Gender</option>
                                     <option value="male" <?php if($user_info[0]['gender']=="male") echo 'selected="selected"'; ?> >Male</option>
                                      <option value="female" <?php if($user_info[0]['gender']=="female") echo 'selected="selected"'; ?> >female</option>
                                         
                                   </select>   
                                        <div class="error" id="err_gender"></div>
                                    </div>
                                </div>
                              

                               <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Mobile Number<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <input type="text"
                                               name="mobile"
                                               id="mobile"
                                               class="form-control"
                                               placeholder=" Mobile Number"
                                               value="<?php echo isset($user_info[0]['mobile_number'])?$user_info[0]['mobile_number']:''; ?>"/>
                                       <div class="error" id="err_mobile"></div>
                                        <span class="error_msg" style="color:red;"></span>
                                    </div>
                                </div>



                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Age<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="age"
                                               id="age"
                                               class="form-control"
                                               placeholder="Age"
                                               value="<?php echo isset($user_info[0]['age'])?$user_info[0]['age']:''; ?>"/>
                                       <span class="error_msg" style="color:red;"></span>
                                       <div class="error" id="err_age"></div>
                                    </div>
                                </div>



                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Country<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <select class="form-control" id="country" name="country" displayerror="country">
                                      <option value="">Select Country</option>
                                      <?php foreach($fetchcountry as $country) { ?>
                                         <option <?php if($user_info['0']['nationality'] == $country['country_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                                       <?php } ?>
                                   </select>   
                                        <div class="error" id="err_country"></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">City<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                      <select class="form-control" id="countryofresidence" name="countryofresidence" displayerror="residence">
                                      <option value="">Select Residence</option>
                                       <?php foreach($fetchresidence as $residence) { ?>
                                         <option <?php if($user_info['0']['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>

                                       <?php } ?>
                                   </select>
                                        <div class="error" id="err_city"></div>
                                    </div>
                                </div>



                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                  <label class="col-sm-3 col-lg-2 control-label">Change Password</label>
                                  <div class="col-sm-9 col-lg-4 controls">
                                    <input type="password" class="form-control beginningSpace_restrict CopyPast_restrict" data-rule-maxlength="15" name="new_password" id="new_password" placeholder="New Password "/>
                                    <div class="error" id="err_new_password" ><?php echo form_error('new_password');?></div>
                                  </div>
                                </div>

                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Address<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                          <textarea  name="address" id="address" class="input-box textarea-txt form-control" rows=""  ><?php echo isset($user_info[0]['address'])?$user_info[0]['address']:''; ?></textarea>
                                              
                                        <div class="error" id="err_address"></div>
                                    </div>
                                </div>



                            </div>
                   
                            </div>
                          </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6  col-lg-5">
                            </div>
                            <div class="col-sm-6  col-lg-7">
                                    <input type="submit" name="user_edit" id="user_edit" class="btn btn-primary" value="Update" onclick="checkValidation()">
                            </div>
                        </div>
                    </div>
                    <?php
                        echo form_close();
                    ?>
                    </div>
                  </div>
        </div>
    </div>
<!-- END Main Content -->
<?php $this->load->view('admin/top-footer'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
 $(document).ready(function() {
    $('#user_edit').click(function(e) { 
      var name                 = $('#name').val();
      var lastname             = $('#lastname').val();
      var username             = $('#username').val();
      var mobile               = $('#mobile').val();
      var email                = $('#email').val();
      var gender               = $('#gender').val();
      var age                  = $('#age').val();
      var country              = $('#country').val();
      var countryofresidence   = $('#countryofresidence').val();
      var address              = $('#address').val();

      var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
      var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      var error = true;

      if($.trim(name)=="")
       {
          $('#name').val('');
          $('#err_name').fadeIn();
          $('#err_name').html('Please enter first name.');
          $('#err_name').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#name').focus();
          error = false;
       }

       if($.trim(lastname)=="")
       {
          $('#lastname').val('');
          $('#err_lastname').fadeIn();
          $('#err_lastname').html('Please enter last name.');
          $('#err_lastname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#lastname').focus();
          error = false;
       }
      if($.trim(username)=="")
       {
          $('#title').val('');
          $('#err_title').fadeIn();
          $('#err_title').html('Please enter username.');
          $('#err_title').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#title').focus();
          error = false;
       }
       
       if($.trim(mobile)=="")
       {
          $('#mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile').focus();
          error = false;
       }
       else if($.trim(mobile).length<10)
       {
          $('#mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter 10 digit mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile').focus();
          error = false;
       }
      else if(!$.trim(mobile).match(onlydigit))
       {
          $('#mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile').focus();
          error = false;
       }
       else if($.trim(mobile).length>10)
       {
          $('#mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter 10 digit mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile').focus();
          error = false;
       }
       if($.trim(email)=="")
       {
          $('#email').val('');
          $('#err_email').fadeIn();
          $('#err_email').html('Please enter email.');
          $('#err_email').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#email').focus();
         error = false;
       }
      if(!email_filter.test(email))
       {
          $('#email').val('');
          $('#err_email').fadeIn();
          $('#err_email').html('Please enter valid email id.');
          $('#err_email').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#email').focus();
         error = false;
       }
      if($.trim(gender)=="")
       {
          $('#country').val('');
          $('#err_gender').fadeIn();
          $('#err_gender').html('Please select gender.');
          $('#err_gender').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#gender').focus();
         error = false;
       }

       if($.trim(age)=="")
       {
          $('#age').val('');
          $('#err_age').fadeIn();
          $('#err_age').html('Please enter age.');
          $('#err_age').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#age').focus();
         error = false;
       }

       if(!$.trim(age).match(onlydigit))
       {
          $('#age').val('');
          $('#err_age').fadeIn();
          $('#err_age').html('Please enter valid age.');
          $('#err_age').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#age').focus();
          error = false;
       }
      if($.trim(country)=="")
       {
          $('#country').val('');
          $('#err_country').fadeIn();
          $('#err_country').html('Please select country.');
          $('#err_country').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#country').focus();
          error = false;
       }
      if($.trim(countryofresidence)=="")
       {
          $('#countryofresidence').val('');
          $('#err_city').fadeIn();
          $('#err_city').html('Please select city.');
          $('#err_city').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#countryofresidence').focus();
          error = false;
       }
       if($.trim(address)=="")
       {
          $('#address').val('');
          $('#err_address').fadeIn();
          $('#err_address').html('Please enter address.');
          $('#err_address').fadeOut(4000);
          $('#address').focus();
          error = false;
       }
       if(error==true)
       {
         return true;
       }
       else
       {
          return false;
       }
   
   });

   });


</script>

<script type="text/javascript">

    $(document).ready(function(){
     $('#country').on('change' , function(){

        var country_id = $(this).val();
        $.ajax({
          url:site_url+'admin/listing/fetch_city',
          type:'POST',
          data:{country_id:country_id},
          //dataType:'json',
          success:function(response)
          { 

              $('#countryofresidence').empty();
              $('#countryofresidence').append(response);
          }
        });
      });
    });
  


</script>