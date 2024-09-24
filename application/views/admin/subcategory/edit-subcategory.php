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
        <li class=""><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>subcategory/manage">Manage Subcategory</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Update Subcategory </a>
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
              <form method="post" class="form-horizontal" id="update-form" enctype="multipart/form-data" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>subcategory/update/<?php echo $this->uri->segment(4); ?>">
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
                  <label class="col-sm-3 col-lg-2 control-label">Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="category_name" name="category_name" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Category</option>
                        <?php foreach($fetchcategory as $category) { ?>
                          <option <?php if($subcategory_info[0]['category_id'] == $category['category_id'] ) { echo "selected"; } ?> value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_category_name" ><?php echo form_error('category_name'); ?></div>
                  </div>
                </div>

              	<div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Subcategory Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control CopyPast_restrict beginningSpace_restrict" name="subcategory_name" id="subcategory_name" placeholder="Please Enter Subcategory Name"  value="<?php echo $subcategory_info[0]['subcategory_name']; ?>"/>
                    <div class="error" id="error_subcategory_name" ><?php echo form_error('subcategory_name'); ?></div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update" id="btn_add_subcategory">
                    <a class="btn" href="<?php echo base_url().ADMIN_PANEL_NAME;?>subcategory/manage/" >Cancel </a>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
   
<!-- END Main Content -->