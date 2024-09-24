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
                <a href="<?php echo base_url().'admin/advertisement/manage' ?>">Manage Advertisement</a>
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
                            echo form_open_multipart(base_url()."admin/listing/edit/".$this->uri->segment(4)."",$attr);

                                        ?>

                    <div class="tabbable tabs-left" >
                        <div class="tab-content" id="myTabContent3" >
                            <div id="english" class="tab-pane fade active in">
                                
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Categories<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <select class="form-control" id="edit_category_name" name="category_name" displayerror="category">
                                        <option value="">Select Category</option>
                                        <?php foreach($fetchcategory as $category) 
                                        {
                                            if ($category['parent_id'] == '0') 
                                            {
                                                if($category['category_id'] == $mylisting_data[0]['cat_id'])
                                                {
                                                    ?>
                                                        <option class="lavel1" value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name'];?></option>
                                                    <?php
                                                } // end if
                                                else
                                                {
                                                    ?>
                                                        <option class="lavel1" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                                    <?php
                                                } // end else
                                            } // end if
                                            else
                                            {
                                                if($category['category_id'] == $mylisting_data[0]['cat_id'])
                                                {
                                                    ?>
                                                        <option class="lavel2" value="<?php echo $category['category_id'];?>" selected><?php echo $category['category_name'];?></option>
                                                    <?php
                                                } // end if
                                                else
                                                {
                                                    ?>
                                                        <option class="lavel2" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                                    <?php
                                                } // end else
                                            } // end else
                                        } // end foreach
                                        ?>
                                    </select>
                                    <div class="error" id="err_catname"></div>
                                        <span class="error_msg" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Title<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="title"
                                               id="title"
                                               class="form-control"
                                               placeholder=" Title"
                                               value="<?php echo isset($mylisting_data[0]['title'])?$mylisting_data[0]['title']:''; ?>"/>
                                       <span class="error_msg" style="color:red;"></span>
                                       <div class="error" id="err_title"></div>
                                    </div>
                                </div>
                                 <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Description<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <textarea displayerror="Description" name="description" id="description" cols="" class="input-box textarea-txt form-control" rows="" ng-model="user.description <?php echo isset($mylisting_data[0]['description'])?$mylisting_data[0]['description']:''; ?>" ng-minlength="5" ng-maxlength="20" required=""><?php echo isset($mylisting_data[0]['description'])?$mylisting_data[0]['description']:''; ?></textarea>
                                              
                                        <div class="error" id="err_description"></div>
                                        <span class="error_msg" style="color:red;"></span>
                                    </div>
                                </div>
                                
                              <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                  <label class="col-sm-3 col-lg-2 control-label">Image Upload</label>
                                  <div class="col-sm-9  controls">
                                   <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input type='hidden' name='oldimage' id='oldimage' value="<?php echo $mylisting_data[0]['mainphoto']?>">
                                    <div class="fileupload-new img-thumbnail"    >
                                     <?php
                                               $filename = 'uploads/addlisting_images/'.$mylisting_data[0]['mainphoto'];
                                     if (file_exists($filename) && !empty($mylisting_data[0]['mainphoto']))
                                     { 
                                      
                                     ?>
                                       
                                     <img width='100px' height='100px'  src='<?php echo base_url().'uploads/addlisting_images/'.$mylisting_data[0]['mainphoto'];?>' alt="" />
                                     <?php }else{ ?>
                                      <img width='100px' height='100px'  src='<?php echo base_url().'uploads/noimage/'.'noimagefound.jpg'?>' alt="" />
                                     
                                      <?php }?>
                                    </div>
                                           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div class="" id="photo_error">
                                              </div>
                                           <div>
                                               <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" id="fileUpload" class="file-input" name="blogs_logo" /></span>
                                               <a  id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                           </div>
                                             <div class="error" id="err_image"></div>
                                       </div>
                                       <!-- <span class="label label-important">NOTE!</span><br>
                                       <ul>
                                          <li><span><strong>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</strong></span></li>
                                          <li><span><strong>Attached image Should be 270 x 135 pixel Only</strong></span></li>
                                       </ul> -->
                                   </div>
                               </div>
                               <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Mobile Number<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <input type="text"
                                               name="mobile"
                                               id="mobile"
                                               class="form-control"
                                               data-rule-required="true"
                                               placeholder=" Title"
                                               value="<?php echo isset($mylisting_data[0]['mobile'])?$mylisting_data[0]['mobile']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text"/>
                                       <div class="error" id="err_mobile"></div>
                                        <span class="error_msg" style="color:red;"></span>
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
                                               placeholder=" Title"
                                               value="<?php echo isset($mylisting_data[0]['email'])?$mylisting_data[0]['email']:''; ?>" />       
                                        <div class="error" id="err_email"></div>
                                        <span class="error_msg" style="color:red;"></span>
                                    </div>
                                </div>
                                 <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Country<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                         <select class="form-control" id="country" name="country" displayerror="country">
                                      <option value="">Select Country</option>
                                      <?php foreach($fetchcountry as $country) { ?>
                                         <option <?php if($mylisting_data['0']['country'] == $country['country_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                                       <?php } ?>
                                   </select>   
                                        <div class="error" id="err_country"></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">City<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                      <select class="form-control" id="countryofresidence" name="countryofresidence" displayerror="residence">
                                      <option value="">Select City</option>
                                       <?php foreach($fetchresidence as $residence) { ?>
                                         <option <?php if($mylisting_data['0']['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>

                                       <?php } ?>
                                   </select>
                                        <div class="error" id="err_city"></div>
                                    </div>
                                </div>
                                 <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Address<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                          <textarea displayerror="Address" name="address" id="address" cols="" class="input-box textarea-txt form-control" rows="" ng-model="user.address <?php echo isset($mylisting_data[0]['address'])?$mylisting_data[0]['address']:''; ?>" ng-minlength="5" ng-maxlength="20" required=""><?php echo isset($mylisting_data[0]['address'])?$mylisting_data[0]['address']:''; ?></textarea>
                                              
                                        <div class="error" id="err_address"></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Price<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                           <input type="text"
                                               name="price"
                                               id="price"
                                               class="form-control"
                                               data-rule-required="true"
                                               placeholder=" Title"
                                               value="<?php echo isset($mylisting_data[0]['price'])?$mylisting_data[0]['price']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($mylisting_data[0]['price'])?$mylisting_data[0]['price']:''; ?>"/>
                                        <div class="error" id="err_price"></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Availabilty<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                           <?php $availability = isset($mylisting_data[0]['availability'])?$mylisting_data[0]['availability']:''; ?>

                                    <select class="form-control" id="availability" name="availability" displayerror="Availability">
                                        <option value="">Select Availability</option>
                                        <option value="Immediately" <?php if($availability == 'Immediately') { echo 'selected'; } ?> >Immediately</option>
                                        <option value="Within1Week" <?php if($availability == 'Within1Week') { echo 'selected'; } ?> >Within 1 Week</option>
                                        <option value="Within1Month" <?php if($availability == 'Within1Month') { echo 'selected'; } ?> >Within 1 Month</option>
                                        <option value="Within3Months" <?php if($availability == 'Within3Months') { echo 'selected'; } ?> >Within 3 Months</option>
                                        <option value="Within6Months" <?php if($availability == 'Within6Months') { echo 'selected'; } ?> >Within 6 Months</option>
                                    </select>      
                                        <div class="error" id="err_availablity"></div>
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
                                    <input type="submit" name="list_edit" id="list_edit" class="btn btn-primary" value="Update" onclick="checkValidation()">
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
    $('#list_edit').click(function(e) { 
      var edit_category_name           = $('#edit_category_name').val();
      var title                        = $('#title').val();
      var description                  = $('#description').val();
      var mobile                       = $('#mobile').val();
      var email                        = $('#email').val();
      var country                      = $('#country').val();
      var countryofresidence           = $('#countryofresidence').val();
      var address                      = $('#address').val();
      var price                        = $('#price').val();
      var availability                 = $('#availability').val();

      var onlydigit     = /^[0-9]*(?:\.\d{1,2})?$/;
      var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if($.trim(edit_category_name)=="")
       {
          $('#edit_category_name').val('');
          $('#err_catname').fadeIn();
          $('#err_catname').html('Please enter valid phone number.');
          $('#err_catname').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#err_catname').focus();
          return false;
       }
       else if($.trim(title)=="")
       {
          $('#title').val('');
          $('#err_title').fadeIn();
          $('#err_title').html('Please enter title.');
          $('#err_title').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#title').focus();
          return false;
       }
       else if($.trim(description)=="")
       {
          $('#description').val('');
          $('#err_description').fadeIn();
          $('#err_description').html('Please enter description.');
          $('#err_description').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#description').focus();
          return false;
       }
       else if($.trim(mobile)=="")
       {
          $('#mobile').val('');
          $('#err_mobile').fadeIn();
          $('#err_mobile').html('Please enter mobile number.');
          $('#err_mobile').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#mobile').focus();
          return false;
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
          return false;
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
          return false;
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
          return false;
       }
       else if($.trim(email)=="")
       {
          $('#email').val('');
          $('#err_email').fadeIn();
          $('#err_email').html('Please enter email.');
          $('#err_email').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#email').focus();
          return false;
       }
       else if(!email_filter.test(email))
       {
          $('#email').val('');
          $('#err_email').fadeIn();
          $('#err_email').html('Please enter valid email id.');
          $('#err_email').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#email').focus();
          return false;
       }
        else if($.trim(country)=="")
       {
          $('#country').val('');
          $('#err_country').fadeIn();
          $('#err_country').html('Please select country.');
          $('#err_country').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#country').focus();
          return false;
       }
       else if($.trim(countryofresidence)=="")
       {
          $('#countryofresidence').val('');
          $('#err_city').fadeIn();
          $('#err_city').html('Please select city.');
          $('#err_city').fadeOut(4000);
          $('html, body').animate({
                scrollTop: $('#main-content').offset().top
            }, 'slow');
          $('#countryofresidence').focus();
          return false;
       }
       else if($.trim(address)=="")
       {
          $('#address').val('');
          $('#err_address').fadeIn();
          $('#err_address').html('Please enter address.');
          $('#err_address').fadeOut(4000);
          $('#address').focus();
          return false;
       }
       else if($.trim(price)=="")
       {
          $('#price').val('');
          $('#err_price').fadeIn();
          $('#err_price').html('Please enter price.');
          $('#err_price').fadeOut(4000);
          $('#price').focus();
          return false;
       }
        else if($.trim(availability)=="")
       {
          $('#availability').val('');
          $('#err_availablity').fadeIn();
          $('#err_availablity').html('Please select avaialbality.');
          $('#err_availablity').fadeOut(4000);
          $('#availability').focus();
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
