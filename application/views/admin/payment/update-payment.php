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
         <h1><i class="fa fa-euro"></i><?php echo $pageTitle; ?></h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    <!-- BEGIN Breadcrumb -->
  <ul class="breadcrumb">
            <li><i class="fa fa-home"></i><a href="<?php echo base_url().ADMIN_PANEL_NAME.'dashboard/' ?>">Home</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
                <li><a href="<?php echo base_url().ADMIN_PANEL_NAME.'pricing/manage/' ?>">Manage Pricing</a> <span class="divider">
                <i class="fa fa-angle-right"></i></span>
                </li>
            <li class="active"><?php echo $pageTitle; ?></li>
          </ul>
    <!-- END Breadcrumb --> 
    <!-- BEGIN Main Content --> 
  <div class="row">
    <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title"> 
                <h3><i class="fa fa-euro"></i><?php echo ucfirst($pageTitle); ?></h3> 
                <div class="box-tool"> 
                </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="validation-form" enctype="multipart/form-data" onsubmit="return checkmembershipprice();">
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
                    <label class="col-sm-3 col-lg-2 control-label"><?php echo ucfirst($fetchdata[0]['pricing_name']); ?>  ( USD ) <span style="color:#F00;">*</span></label>
                    <div class="col-sm-5 col-lg-2 controls">
                       <input type="text" class="form-control" name="membership_price" id="membership_price" placeholder="Membership Price" value="<?php echo $fetchdata[0]['membership_price']; ?>" data-rule-required="true" onblur="return checkmembershipprice();"/>
                       <div class="error" id="error_membership_price" ><?php echo form_error('membership_price'); ?></div>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-3 col-lg-2 control-label">Short Description (optional)</label>
                    <div class="col-sm-5 col-lg-5 controls">
                       <textarea type="text" class="form-control ckeditor" name="short_desc" id="short_desc" placeholder="Membership Plan Short Description"/>   <?php echo $fetchdata[0]['short_desc']; ?></textarea>                   
                    </div>                   
                </div>
                
                <div class="form-group" style="display:none;">
                    <label class="col-sm-3 col-lg-2 control-label">Long Description (optional)</label>
                    <div class="col-sm-5 col-lg-5 controls">
                      <textarea class="form-control col-md-12 ckeditor" id="long_desc" name="long_desc">
                        <?php echo $fetchdata[0]['long_desc']; ?>
                      </textarea>
                    </div>
                  
                </div>
                
                <div class="form-group">
                   <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                     <input type="submit" value="Update" class="btn btn-primary" name="btn_update_membership" id="btn_update_membership">
                      <a class="btn" href="<?php echo base_url().ADMIN_PANEL_NAME;?>paymentoption/manage/" >Cancel </a>
                   </div>
                </div>
               </form>
            </div>
        </div>
    </div>
</div>
<!-- END Main Content -->

<script type="text/javascript">
  function checkmembershipprice(){

    flag = 0;
    var Normal = $('#membership_price').val();
    var pattern = /^\d+(.\d{1,2})?$/;
    if (pattern.test(Normal)) {
        $('#error_membership_price').html('');
        flag = 1;
    } else {
        $('#error_membership_price').html('Please enter a valid number');
        flag = 0;
        return false;
    }


    if(flag == 0) {
      return false;
    } else {
      return true;
    }

  }
</script>