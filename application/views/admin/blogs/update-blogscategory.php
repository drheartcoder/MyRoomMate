<!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
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
      <div> <h1><i class="fa fa-star"></i><?php echo $page_title; ?></h1> </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url();?>admin/blogscategory/manage">Manage Blogs Category</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Update Blogs Category </a>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
            <div class="box-title">
              <h3><i class="fa fa-star"></i><?php echo ucfirst($page_title); ?></h3>
              <div class="box-tool"> </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="update-form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/blogscategory/update/<?php echo $this->uri->segment(4); ?>">
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
                  <label class="col-sm-3 col-lg-2 control-label">Blogs Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-10 controls">
                    <input type="text" class="form-control" name="blogscategory_name" id="blogscategory_name" placeholder="Please Enter Blogs Category Name"  value="<?php echo $blogscategory_info[0]['blogscategory_name']; ?>"/>
                    <div class="error" id="error_blogscategory_name" ><?php echo form_error('blogscategory_name'); ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Description<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-10 controls">
                     <textarea type="text" class="form-control" name="blogscategory_description" id="blogscategory_description" placeholder="Please Enter Meta Description" rows="3"><?php echo $blogscategory_info[0]['blogscategory_description']; ?></textarea>
                     <div class="error" id="error_blogscategory_description" ><?php echo form_error('blogscategory_description'); ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update" id="btn_add_blogscategory">
                    <a class="btn" href="<?php echo base_url();?>admin/blogscategory/manage/" >Cancel </a>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
    <?php $this->load->view('admin/top-footer'); ?>
  </div>
</div>
<!-- END Main Content -->
