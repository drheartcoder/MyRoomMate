<!-- BEGIN Theme Setting -->

<div id="theme-setting">
  <?php //$this->load->view('admin/theme-setting'); ?>
</div>
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
        <h1><i class="fa fa-cog"></i> Social Links</h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li ><a>Setting</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
		<li class="active">Manage Social Links </li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
            <h3><i class="fa fa-cog"></i> Social  Links</h3>
           
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

           <form method="post" class="form-horizontal" id="validation-form" action="<?php echo base_url().ADMIN_PANEL_NAME."setting/social_links/";?>">
			<div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Facebook<span class="required">*</span></label>
            <div class="col-sm-9 col-lg-4 controls">
              <input type="text" class="form-control" name="facebook" id="facebook" data-rule-required="true" data-rule-url="true" placeholder="Facebook " value="<?php echo $getlink_info[0]['facebook']; ?>"  />
              <div class="error" id="err_facebook" ><?php echo form_error('facebook');?></div>
            </div>
          </div>
		  
		  <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Twitter<span class="required">*</span></label>
            <div class="col-sm-9 col-lg-4 controls">
              <input type="text" class="form-control" name="twitter" id="twitter" data-rule-required="true" data-rule-url="true" placeholder="Twitter " value="<?php echo $getlink_info[0]['twitter']; ?>"  />
              <div class="error" id="err_twitter" ><?php echo form_error('twitter');?></div>
            </div>
          </div>
		  
          <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Pinterest<span class="required">*</span></label>
            <div class="col-sm-9 col-lg-4 controls">
              <input type="text" class="form-control" name="linkedin" id="linkedin" data-rule-required="true" data-rule-url="true" data placeholder="Pinterest" value="<?php echo $getlink_info[0]['linkedin']; ?>"  />
              <div class="error" id="err_linkedin" ><?php echo form_error('linkedin');?></div>
            </div>
          </div>
		  
	<!-- 	  <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Google+</label>
            <div class="col-sm-9 col-lg-4 controls">
              <input type="text" class="form-control" name="googleplus" id="googleplus" placeholder="Google +" value="<?php echo $getlink_info[0]['googleplus']; ?>"  />
              <div class="error" id="err_googleplus" ><?php echo form_error('googleplus');?></div>
            </div>
          </div> -->
          
           <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label">Instagram<span class="required">*</span></label>
            <div class="col-sm-9 col-lg-4 controls">
              <input type="text" class="form-control" name="instagram" id="instagram" data-rule-required="true" data-rule-url="true" placeholder="Instagram" value="<?php echo $getlink_info[0]['instagram']; ?>"  />
              <div class="error" id="err_instagram" ><?php echo form_error('instagram');?></div>
            </div>
          </div>
		  
		  <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
              <input type="submit" value="Save" class="btn btn-primary" name="btn_sociallink" id="btn_sociallink"  >
            </div>
          </div>
        </form>
          </div>
        </div>
      </div>
      </div>