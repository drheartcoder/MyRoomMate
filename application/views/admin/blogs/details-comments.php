<!-- BEGIN Theme Setting -->
<!-- <div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div> -->
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <!-- END Sidebar -->
  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div> <h1><i class="fa fa-star"></i><?php echo $page_title; ?></h1> <h4></h4> </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li><a href="<?php echo base_url().'admin/blogscomments/manage' ?>">Manage Blogs Comments</a> <span class="divider"> <i class="fa fa-angle-right"></i></span>
                </li>
        <li class="active"><?php echo $page_title; ?></li>
      </ul>
    </div>

    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
    <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title">
                <h3><i class="fa fa-phone-square"></i><?php echo ucfirst($pageTitle); ?></h3>
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
                  <label class="col-sm-3 col-lg-2 control-label">Name:</label>
                      <div class="col-sm-3 col-lg-2 controls" style="margin-top:6px;">
                         <?php if(!empty($fetchdata[0]['comm_name'])){echo $fetchdata[0]['comm_name']; }?>
                       </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Contact Email:</label>
                      <div class="col-sm-9 col-lg-10 controls" style="margin-top:6px;">
                          <?php if(!empty($fetchdata[0]['comm_email'])){echo $fetchdata[0]['comm_email']; }?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Phone:</label>
                      <div class="col-sm-9 col-lg-10 controls" style="margin-top:6px;">
                          <?php if(!empty($fetchdata[0]['comm_website'])){echo $fetchdata[0]['comm_website']; }?>
                      </div>
                  </div>
                 <!--  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Company:</label>
                      <div class="col-sm-9 col-lg-10 controls">
                          <?php //if(!empty($fetchdata[0]['comm_company'])){echo $fetchdata[0]['comm_company'];} ?>
                      </div>
                  </div> -->
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Contact Message:</label>
                      <div class="col-sm-9 col-lg-10 controls" style="margin-top:6px;">
                        <?php if(!empty($fetchdata[0]['comm_message'])){   echo $mytext = chunk_split( preg_replace('/(<a.*?)(class="something")\s(.*?data-class="false".*?>)|(<a.*?)(data-class="false".*?)\s(class="something")(.*?>)/', '$1$3$4$5$7', strip_tags($fetchdata[0]['comm_message']) ) ); }?>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Added Date:</label>
                      <div class="col-sm-9 col-lg-10 controls" style="margin-top:6px;">
                        <?php if(!empty($fetchdata[0]['added_date'])){echo date('d-m-Y  h:m:s', strtotime($fetchdata[0]['added_date']));} ?>
                      </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                      <div class="col-sm-9 col-lg-10 controls" style="margin-top:6px;">
                      <a class="btn" align="right"  href="<?php echo base_url().'admin/blogscomments/manage';?>" >Back </a>
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
<script type="text/javascript">
function checkValidation()
{
   if($("#validation-form").valid()==false)
   {
        $("#form-validation-error").show();
        setTimeout(function()
        {
           $("#form-validation-error").hide();
        }, 8000);
   }
}
</script>
<script type="text/javascript">
  $("#blogs_date" ).datepicker({
   changeYear: true,
   changeMonth: true,
   inline: true,
});

</script>