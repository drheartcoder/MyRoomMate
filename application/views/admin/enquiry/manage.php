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
        <h1><i class="fa fa-phone"></i> Manage Enquiry</h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active">Manage Enquiry</li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
       <?php if($this->session->flashdata('success')!=''){?>
    <div class="alert alert-success">
	<button class="close" data-dismiss="alert">×</button>
	<?php echo $this->session->flashdata('success'); ?>
	</div>
	<?php } 
	 if($this->session->flashdata('error')!=''){
	?>
	<div class="alert alert-danger">
	<button class="close" data-dismiss="alert">×</button>
	<?php echo $this->session->flashdata('error'); ?>
	</div>
    <?php } ?>
     <form name="frm_enquiry" id="frm_enquiry" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>contactenquiry/multaction" method="post">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
            <h3><i class="fa fa-phone"></i> Manage Enquiry</h3>
            <div class="box-tool"></div>
          </div>
          <div class="box-content">
                          <div class="btn-toolbar pull-right clearfix">
                    <div class="btn-group">
                     </div>
                    <div class="btn-group">
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Refresh" href="<?php echo base_url().ADMIN_PANEL_NAME.'contactenquiry/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                       <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Delete " href="javascript:void(0);" onclick="javascript : chk_multiaction('chk_enquiry[]','frm_enquiry','delete');" style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                      
                      <input name="multiple_action" id="multiple_action" value="" type="hidden" />
                    </div>
                </div>
                <br/><br/>
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                <th><input type="checkbox" name="" id="" /></th>
                <th>Name</th>
                <th>Email Id</th>
                <th>Message</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php  if(count($enquiry_list)>0) {
				  foreach($enquiry_list as $fp) {?>
                <tr>
                <td><input type="checkbox" name="chk_enquiry[]" value="<?php echo $fp['contact_id'];?>"/></td>
                <td><?php if(!empty($fp['name']))            { echo ucfirst($fp['name']); }  else { echo "Not available"; } ?></td>
                <td><?php if(!empty($fp['email']))           { echo $fp['email']; }          else { echo "Not available"; } ?></td>
                <td><?php if(!empty($fp['message']))         { echo $fp['message']; }        else { echo "Not available"; } ?></td>
                <td>
                <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip delete_selected_enquiry" title="Delete " data-contactenquiry="<?php echo $fp['contact_id'];  ?>"  style="text-decoration:none;" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                </td>
                </tr>
                <?php }  } ?>
             </tbody>
            </table>
           <?php  if(count($enquiry_list)>0) {?>
                <div id="pagging" style="padding-top:10px;" class="paginate "><?php echo $links; ?></div>
            <?php }
              else {?>
              <strong>You have not any received enquiry yet!</strong>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>

<script type="text/javascript">
  
  $('.delete_selected_enquiry').click(function(){
        var contact_id = jQuery(this).data("contactenquiry");
        swal({   
             title: "Are you sure?",   
             text: "You want to delete this enquiry ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Your enquiry has been deleted.", "success"); 
                           location.href=site_url+"admin/contactenquiry/delete/"+contact_id;
              } 
              else
              { 
                     swal("Cancelled", "Your enquiry is safe :)", "error");          
                } 
            });
    }); 

</script>    