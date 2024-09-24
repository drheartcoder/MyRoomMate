<!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?> </div>
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
      <div> <h1><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $page_title; ?></h1> </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>residence/manage">Manage Residence</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Update Residence </a>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title">
              <h3><i class="fa fa-tags" aria-hidden="true"></i> <?php echo ucfirst($page_title); ?></h3>
              <div class="box-tool"> </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="update-form" enctype="multipart/form-data" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>residence/update/<?php echo $this->uri->segment(4); ?>">
                <div class="form-group">
                  <div class="col-sm-12">
                    <?php if($this->session->flashdata('error')!=''){  ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } if($this->session->flashdata('success')!=''){?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Country Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="country_name" name="country_name" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Country</option>
                        <?php foreach($fetchcountry as $country) { ?>
                          <option <?php if($residence_info[0]['country_id'] == $country['country_id'] ) { echo "selected"; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_country_name" ><?php echo form_error('country_name'); ?></div>
                  </div>
                </div>

              	<div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Residence Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict" name="residence_name" id="residence_name" placeholder="Please Enter Residence Name"  value="<?php echo $residence_info[0]['residence_name']; ?>"/>
                    <div class="error" id="error_residence_name" ><?php echo form_error('residence_name'); ?></div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update" id="btn_add_residence">
                    <a class="btn" href="<?php echo base_url().ADMIN_PANEL_NAME;?>residence/manage/" >Cancel </a>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
   
<!-- END Main Content -->