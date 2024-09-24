<!-- BEGIN Theme Setting -->
<!-- END Theme Setting --> 

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
  <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?>
</div>
<!-- END Navbar --> 

<!-- BEGIN Container -->
<div class="container" id="main-container"> 
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view(ADMIN_PANEL_NAME.'left-navigation'); ?>
  </div>
  <!-- END Sidebar --> 
  
  <!-- BEGIN Content -->
  <div id="main-content"> 
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div>
        <h1><i class="fa fa-cog"></i> <?php echo $page_title; ?> </h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li >Profile<span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active"> <?php echo $page_title; ?> </li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    
    
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
            <h3><i class="fa fa-cog"></i>  <?php echo $page_title; ?> </h3>
          </div>
          <div class="box-content">
                <?php  
                if($this->session->flashdata('error')!=''){  ?>
                <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">×</button>
                <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } 
                if($this->session->flashdata('success')!=''){?>
                <div class="alert alert-success">
                <button class="close" data-dismiss="alert">×</button>
                <?php echo  $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>          
                <br/><br/>

                <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data" action="<?php echo base_url().ADMIN_PANEL_NAME."profile/edit/";?>">
                  <?php if(count($other_data)>0){?>



                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Profile Image  <span style="color:red;">*</span> </label>
                      <div class="col-sm-9 col-md-10 controls">
                       <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">

                          <?php if(!empty($other_data[0]['profile_picture']) && file_exists('uploads/admin_profile/'.$other_data[0]['profile_picture'])) { ?>

                           <?php $proile_img = ($other_data[0]['profile_picture']!="") ? $other_data[0]['profile_picture'] : "dummypic.jpg";?>

                           <img src="<?php echo base_url(); ?>uploads/admin_profile/<?php echo $proile_img;?>" alt="" />

                           <?php } else {

                            ?><img src="<?php echo base_url().'uploads/admin_profile/default.jpeg'; ?>" alt="" /><?php                   
                          }
                          ?>


                        </div>
                        <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div>
                         <span class="btn btn-file" ><span class="fileupload-new">Select image</span>
                         <span class="fileupload-exists">Change</span>
                         <input type="file" class="default allowOnlyImg" name="file_upload" id="file_upload"/>
                         <input type="hidden" class="default" name="old_image" id="old_image" value="<?php if(isset($other_data[0]['profile_picture'])) { echo  $other_data[0]['profile_picture']; } else {

                          echo  'default.jpeg'; } ;?>"/>

                        </span>
                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                      </div>
                      <div class="error" id="err_logo" ></div>
                    </div>
                    <span class="label label-important">NOTE!</span>
                    <span>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</span>
                  </div>
                </div>




                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Email ID  <span style="color:red;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict" name="admin_email" id="admin_email" data-rule-required="true" data-rule-email="true" placeholder="Email ID " value="<?php echo $other_data[0]['admin_email']; ?>" />
                    <div class="error" id="err_admin_contactus" ><?php echo form_error('admin_email');?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">User Name  <span style="color:red;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict" name="admin_username" id="admin_username" data-rule-required="true" data-rule-pattern="^[a-zA-Z'.\s]{0,40}$" data-rule-minlength="4" data-rule-maxlength="20" placeholder="User Name" value="<?php echo $other_data[0]['admin_username']; ?>" />
                    <div class="error" id="err_admin_username" ><?php echo form_error('admin_username');?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Phone  <span style="color:red;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict char_restrict" name="admin_contactus" id="admin_contactus" data-rule-required="true" data-rule-minlength="10" data-rule-maxlength="16"   placeholder="Phone" value="<?php echo $other_data[0]['admin_contactus']; ?>" />
                    <div class="error" id="err_admin_contactus" ><?php echo form_error('admin_contactus');?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Fax  <span style="color:red;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict char_restrict " name="admin_fax" id="admin_fax" placeholder="Fax" data-rule-required="true" data-rule-minlength="5" data-rule-maxlength="30" data-rule-digits="true" value="<?php echo $other_data[0]['admin_fax']; ?>"   />
                    <div class="error" id="err_admin_fax" ><?php echo form_error('admin_fax');?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Address   <span style="color:red;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict " name="admin_address" id="admin_address" placeholder="Address " data-rule-required="true" value="<?php echo $other_data[0]['admin_address']; ?>" />
                    <div class="error" id="err_admin_address" ><?php echo form_error('admin_address');?></div>
                  </div>

                </div>

                <div class="geo-details" style="display:none;">

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Country </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <input type="text" class="form-control beginningSpace_restrict" name="admin_country" id="admin_country" data-geo="country" data-rule-required="false" readonly placeholder="Country" value="<?php echo $other_data[0]['admin_country']; ?>" />
                        
                        <div class="error" id="err_admin_country" ><?php echo form_error('admin_country');?></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">State  </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <input type="text" data-geo="administrative_area_level_1" class="form-control beginningSpace_restrict" name="admin_state" id="admin_state" data-rule-required="false" readonly placeholder="State" value="<?php echo $other_data[0]['admin_state']; ?>" />
                        
                        <div class="error" id="err_admin_state" ><?php echo form_error('admin_state');?></div>
                      </div>
                    </div>   
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">City </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <input type="text" class="form-control beginningSpace_restrict" name="admin_city" id="admin_city" data-geo="administrative_area_level_2" data-rule-required="false" readonly placeholder="Country" value="<?php echo $other_data[0]['admin_city']; ?>" />
                        <div class="error" id="err_admin_city" ><?php echo form_error('admin_city');?></div>
                      </div>
                    </div>  

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Postcode</label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <input type="text" class="form-control beginningSpace_restrict" name="admin_postcode" id="admin_postcode"  placeholder="Postcode" readonly value="<?php echo $other_data[0]['admin_postcode']; ?>" />
                        <div class="error" id="err_admin_postcode" ><?php echo form_error('admin_postcode');?></div>
                      </div>
                    </div>

                </div>

                <div class="form-group">
                 <label class="col-sm-3 col-lg-2 control-label">Site Status  <span style="color:red;">*</span></label>
                 <div class="col-sm-9 col-lg-10 controls">
                  <label class="radio">
                    <input type="radio" name="site_status" value="1" <?php if($other_data[0]['site_status']=='1') { echo 'checked="checked"'; } ?>  /> Online
                  </label>
                  <label class="radio">
                    <input type="radio" name="site_status" value="0" <?php if($other_data[0]['site_status']=='0') { echo 'checked="checked"'; } ?>/> Offline
                  </label>  

                </div>
              </div>



              <div class="form-group">
                <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                  <input type="submit" value="Save" class="btn btn-primary" name="btn_update_info" id="btn_update_info">
                </div>
              </div>
              <?php }?>
            </form>
          </div>
        </div>
      </div>
    </div>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBLKCmJEIrOrzdRklZHYer8q9qx2XLJ4Vs&sensor=false&libraries=places"></script>
<script src="<?php echo base_url(); ?>assets/js/geolocator/jquery.geocomplete.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){

    var location = "Ireland";

    $("#admin_address").geocomplete({
      details: ".geo-details",
      detailsAttribute: "data-geo",
      //location:location,
    });
  });
  
</script>
