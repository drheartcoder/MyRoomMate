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
        <h1><i class="fa fa-file-o"></i>Front Pages</h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/manage" >Manage Front Pages</a><span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Edit Front Pages</li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    
    
    
    <div class="row">
    <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title">
                <h3><i class="fa fa-file-o"></i>Edit Front Pages</h3>
                <div class="box-tool">
                	
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/edit/<?php echo $this->uri->segment(4); ?>">
              	  <div class="form-group">
                  	<div class="col-sm-12">
               		 	<?php if($this->session->flashdata('error')!=''){  ?>
                		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
               			 <?php } 
                		 if($this->session->flashdata('success')!=''){?>	
                		 <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
						 <?php } ?>
                     </div>
				  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Page Name <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="page_name" id="page_name" placeholder="Page Name" value="<?php echo $front_page_fetch[0]['page_name']; ?>" readonly="readonly" data-rule-required="true"/>
                          <?php echo form_error('page_name'); ?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Page Title <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Page Title" value="<?php echo $front_page_fetch[0]['page_title']; ?>" data-rule-required="true" <?php /* data-rule-pattern="^[a-zA-Z'.\s]{1,40}$" */?> />
                          <div class="error_msg" id="error_page_title" style="color:#b94a48;" ><?php echo form_error('page_title'); ?>
                      </div></div>
                   </div>
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Meta Title <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Page Title" value="<?php echo $front_page_fetch[0]['meta_title']; ?>" data-rule-required="true"/>
                          <div class="error_msg" id="error_meta_title" style="color:#b94a48;" ><?php echo form_error('meta_title'); ?>
                      </div></div>
                   </div>
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Meta Keywords <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <input type="text" class="form-control" name="meta_keyword" id="meta_keyword" data-rule-required="true" placeholder="Meta Title" value="<?php echo $front_page_fetch[0]['meta_keyword']; ?>" />
                          <div class="error_msg" id="error_meta_keyword" style="color:#b94a48;" ><?php echo form_error('meta_keyword'); ?>
                      </div></div>
                   </div>
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Meta Description <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <textarea type="text" class="form-control" name="meta_description" placeholder="Meta Description" id="meta_description" placeholder="Meta Description" data-rule-required="true"  ><?php echo $front_page_fetch[0]['meta_description']; ?></textarea>
                          <div class="error_msg" id="error_meta_description"  style="color:#b94a48;"><?php echo form_error('meta_description'); ?>
                      </div></div>
                   </div>
                   <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Page Description <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <textarea class="form-control col-md-12 ckeditor" name="page_description" placeholder="Page Description" id="page_description" data-rule-required="true" rows="6"><?php echo $front_page_fetch[0]['page_description']; ?></textarea>
                         <div class="error_msg" id="error_page_description" style="color:#b94a48;;" ><?php echo form_error('page_description'); ?></div> 
                      </div>
                   </div>
                   <div class="form-group">
                     <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                        <input type="submit" value="Update" class="btn btn-primary" name="btn_aboutus" id="btn_aboutus" onclick="javascript:return aboutus_valid();">
                     </div>
                   </div>
               </form>
            </div>
        </div>
    </div>
</div>