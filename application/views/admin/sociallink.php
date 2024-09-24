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
        <h1><i class="fa fa-cogs"></i><?php echo $page_title; ?> </h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url();?>admin/dashboard/">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active"><?php echo $page_title; ?></li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-title">
            <h3><i class="fa fa-cogs"></i> <?php echo $page_title; ?></h3>
            <div class="box-tool">
            </div>
          </div>
          <div class="box-content">
           <div class="form-group">
             <?php if($this->session->flashdata('error')){ ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
             <?php } ?>
             <?php if($this->session->flashdata('success')){ ?>
             <div class="alert alert-success"><?php echo $this->session->flashdata('success');?></div>
             <?php } ?>
           </div>
           <form action="<?php echo base_url().'admin/profile/social/'; ?>" class="form-horizontal" id="validation-form" method="post">
             <div class="form-group">
               <label class="col-sm-3 col-lg-2 control-label" for="password">Facebook Links <span style="color:#F00;">*</span></label>
               <div class="col-sm-6 col-lg-4 controls">
                 <input type="text" name="facebook_link" id="facebook_link" class="form-control"  value="<?php echo $social_link[0]['facebook_link'];?>"/>
                 <div class="error" id="error_facebook_link" ></div>
               </div>
             </div>

             <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Twitter Links <span style="color:#F00;">*</span></label>
              <div class="col-sm-6 col-lg-4 controls">
                <input type="text" name="twitter_link" id="twitter_link" class="form-control"  value="<?php echo $social_link[0]['twitter_link'];?>"/>
                <div class="error" id="error_twitter_link" ></div>
              </div>
            </div>

            <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Google Plus Links<span style="color:#F00;">*</span></label>
            <div class="col-sm-6 col-lg-4 controls">
             <input type="text" name="googleplus_link" id="googleplus_link" class="form-control"  value="<?php echo $social_link[0]['googleplus_link'];?>"/>
             <div class="error" id="error_googleplus_link" ></div>
           </div>
         </div>

         <div class="form-group">
            <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Youtube Links<span style="color:#F00;">*</span></label>
            <div class="col-sm-6 col-lg-4 controls">
             <input type="text" name="youtube_link" id="youtube_link" class="form-control"  value="<?php echo $social_link[0]['youtube_link'];?>"/>
             <div class="error" id="error_youtube_link" ></div>
           </div>
         </div>

            <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Pinterest Links <span style="color:#F00;">*</span></label>
              <div class="col-sm-6 col-lg-4 controls">
               <input type="text" name="pinterest_link" id="pinterest_link" class="form-control"  value="<?php echo $social_link[0]['pinterest_link'];?>"/>
               <div class="error" id="error_pinterest_link" ></div>
             </div>
           </div>

           <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Linkedin Links <span style="color:#F00;">*</span></label>
              <div class="col-sm-6 col-lg-4 controls">
               <input type="text" name="linkedin_link" id="linkedin_link" class="form-control"  value="<?php echo $social_link[0]['linkedin_link'];?>"/>
               <div class="error" id="error_linkedin_link" ></div>
             </div>
           </div>

           <div class="form-group">
              <label class="col-sm-3 col-lg-2 control-label" for="confirm-password">Instagram Links <span style="color:#F00;">*</span></label>
              <div class="col-sm-6 col-lg-4 controls">
               <input type="text" name="instagram_link" id="instagram_link" class="form-control"  value="<?php echo $social_link[0]['instagram_link'];?>"/>
               <div class="error" id="error_instagram_link" ></div>
             </div>
           </div>
         <div class="form-group">
          <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
            <input type="submit" class="btn btn-primary" value="Update" name="btn_social" id="btn_social">
             <a class="btn" href="<?php echo base_url();?>admin/dashboard/">Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
 <?php $this->load->view('admin/top-footer'); ?>





<!-- END Main Content -->

<!-- END Container -->