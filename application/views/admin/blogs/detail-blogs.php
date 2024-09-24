<!-- BEGIN Theme Setting -->
 <?php

     /*$this->db->where('con_id',base64_decode($this->uri->segment(4)));
     $this->db->update('tbl_contact_enquiry',array('message_read'=>'read'));*/
    ?>
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
         <h1><i class="fa fa-th-large"></i><?php echo ucfirst($page_title); ?></h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url().'admin/dashboard/' ?>">Home</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
                <li><a href="<?php echo base_url().'admin/blogs/manage' ?>">Manage Blogs</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
            <li class="active"><?php echo $page_title; ?></li>
          </ul>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
  <div class="row">
    <div class="col-md-12">
        <div class="box ">
            <div class="box-title">
                <h3><i class="fa fa-th-large"></i><?php echo ucfirst($page_title); ?></h3>
                <div class="box-tool">
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data">
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
                      <label class="col-sm-3 col-lg-2 control-label">Image:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                        <img src="<?php echo base_url().'uploads/blogs_images/'.$fetchdata[0]['blogs_img']?>"  width="500" height="500">
                      </div>
                  </div>
                  <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Blogs Name:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <?php if(!empty($fetchdata[0]['blogs_name_en'])){echo ucwords($fetchdata[0]['blogs_name_en']); }?>
                       </div>
                  </div>
                   <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Added By:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                         <?php if(!empty($fetchdata[0]['blogs_added_by'])){echo ucwords($fetchdata[0]['blogs_added_by']); }?>
                       </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Blogs Description:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                          <?php if(!empty($fetchdata[0]['blogs_description_en'])){echo $fetchdata[0]['blogs_description_en']; }?>
                      </div>
                  </div>
                 <?php $date=$fetchdata[0]['blogs_added_date'];
                  $date=date('Y-m-d',strtotime($date));?>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Date:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                          <?php if(!empty($fetchdata[0]['blogs_added_date'])){echo $date;} ?>
                      </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                      <div class="col-sm-9 col-lg-10 controls">
                      <a class="btn" align="right"  href="<?php echo base_url().'admin/blogs/manage';?>" >Back </a>
                      </div>
                  </div>
               </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/top-footer'); ?>

<!-- END Main Content -->
