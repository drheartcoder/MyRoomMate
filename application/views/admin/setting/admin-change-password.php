<!-- BEGIN Theme Setting -->

<!-- END Theme Setting --> 

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
  <?php $this->load->view('admin/top-navigation'); ?>
</div>
<!-- END Navbar --> 

<!-- BEGIN Container -->
<div class="container" id="main-container"> 
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view('admin/left-navigation'); ?>
  </div>
  <!-- END Sidebar --> 
  
  <!-- BEGIN Content -->
  <div id="main-content"> 
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div>
        <h1><i class="fa fa-cog"></i> Change Password</h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li ><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/edit/">Profile</a><span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Change Password</li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    
    
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
            <h3><i class="fa fa-cog"></i> Change Password</h3>

          </div>
          <div class="box-content">
            <span id="show_error" class="show_error"></span>
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

           <form method="post" class="form-horizontal" id="validation-form" action="<?php echo base_url().ADMIN_PANEL_NAME."profile/change_password/";?>">
             <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label ">Old Password</label>
              <div class="col-sm-9 col-lg-4 controls">
                <input type="password" class="form-control beginningSpace_restrict CopyPast_restrict" data-rule-required="true" name="old_password" id="old_password" placeholder="Old Password " />
                <div class="error" id="err_old_password" ><?php echo form_error('old_password');?></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label">New Password</label>
              <div class="col-sm-9 col-lg-4 controls">
                <input type="password" class="form-control beginningSpace_restrict CopyPast_restrict" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="15" name="new_password" id="new_password_match" placeholder="New Password "   />
                <div class="error" id="err_new_password" ><?php echo form_error('new_password');?></div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label ">Confirm Password</label>
              <div class="col-sm-9 col-lg-4 controls">
                <input type="password" class="form-control beginningSpace_restrict CopyPast_restrict" data-rule-required="true" data-rule-minlength="6" data-rule-maxlength="15" name="confirm_password" data-rule-equalto="#new_password_match" id="confirm_password" placeholder="Confirm Password"   />
                <div class="error" id="err_confirm_password" ><?php echo form_error('confirm_password');?></div>
              </div>
            </div>


            <div class="form-group">
              <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                <input type="submit" value="Save" class="btn btn-primary" name="btn_update_password" id="btn_update_password">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
    
    $('#btn_update_password').on('click' , function(){
    var old_pass = $('#old_password').val();
    var new_pass = $('#new_password_match').val();

      if(old_pass != "" && new_pass != "" && new_pass == old_pass)
      {
        jQuery("#show_error").html("<div class='alert alert-danger'>Sorry , you can't enter old password and new password as same.</div>").show().fadeOut(14000);
        return false;
      }   

    });
  
  });
  </script>