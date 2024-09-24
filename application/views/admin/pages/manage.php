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
        <li class="active">Manage Front Pages</li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->
    
    
    <form name="frm_newsletter" id="frm_newsletter" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/multaction" method="post">

      <div class="row">
        <div class="col-md-12">
          <?php if($this->session->flashdata('error')!=''){  ?>
          <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
          <?php } 
          if($this->session->flashdata('success')!=''){?>  
          <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
          <?php } ?>
          <div class="box box-magenta">
            <div class="box-title">
              <h3><i class="fa fa-file-o"></i> Manage Front Pages</h3>
              <div class="box-tool"> <!--<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a> <a data-action="close" href="#"><i class="fa fa-times"></i></a> --></div>
            </div>
            <div class="box-content">
              <div class="btn-toolbar pull-right clearfix">
                <div class="btn-group">
                </div>
                <div class="btn-group">
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Add"     href="<?php echo base_url().ADMIN_PANEL_NAME.'pages/add'; ?>"style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                  <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Active"  href="javascript:void(0);" onclick="javascript : chk_multiaction('chk_fp[]','frm_newsletter','active');" style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Block"   href="javascript:void(0);" onclick="javascript : chk_multiaction('chk_fp[]','frm_newsletter','block');" style="text-decoration:none;"><i class="fa fa-circle-o"></i></a> -->
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Delete " href="javascript:void(0);" onclick="javascript : chk_multiaction('chk_fp[]','frm_newsletter','delete');" style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Refresh" href="<?php echo base_url().'pages/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a>
                  
                  <input name="multiple_action" id="multiple_action" value="" type="hidden" />


                </div>
              </div>
              <br/><br/>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" name="" id="" /></th>
                      <th>Page Title</th>
                      <th>Description</th>
                      <!-- <th>Status</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if(count($fetch_manage_frontpage) > 0) {


                      foreach($fetch_manage_frontpage as $fp) {?>
                      <tr>
                      <td><input type="checkbox" name="chk_fp[]"   value="<?php echo $fp['page_id'];?>"/></td>
                      
                      <td><?php echo ucfirst($fp['page_title']);?></td>
                      <td><?php echo stripslashes(substr(strip_tags($fp['page_description']),0,100))."..."; ?></td>


                      <!-- <td>  
                        <?php if($fp['front_status']==1){ ?>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Active" href="<?php echo base_url().ADMIN_PANEL_NAME."pages/status/0/".urlencode($fp['page_id']); ?>"  style="text-decoration:none;"><i class="fa fa-dot-circle-o"></i></a>
                        <?php } else { ?>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" title="Block" href="<?php echo base_url().ADMIN_PANEL_NAME."pages/status/1/".urlencode($fp['page_id']); ?>"  style="text-decoration:none;"><i class="fa fa-circle-o"></i></a>
                        <?php } ?>
                      </td> -->

                      <td>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill  show-tooltip" href="<?php echo base_url().ADMIN_PANEL_NAME;?>pages/edit/<?php echo $fp['page_id'];?>" data-original-title="Edit" style="text-decoration:none;" title="Edit <?php echo ucfirst($fp['page_title']);?>"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-circle btn-to-danger btn-bordered btn-fill show-tooltip delete_selected_page" data-page="<?php echo base64_encode($fp['page_id']);?>" title="Delete"  style="text-decoration:none;" href="#"><i class="fa fa-trash-o"></i></a>
                      </td>
                      
                      </tr>
                      <?php }  } else { ?>
                      <tr><td colspan="4"><strong>No Front page Exist!</strong></td></tr>
                      <?php }?>

                    </tbody>
                   </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <!-- END Main Content -->

<!-- END Container -->
<script type="text/javascript">
  
  $('.delete_selected_page').click(function(){
        var page_id = jQuery(this).data("page");
        swal({   
             title: "Are you sure?",   
             text: "You want to delete this page ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Your page has been deleted.", "success"); 
                           location.href=site_url+"admin/pages/delete/"+page_id;
              } 
              else
              { 
                     swal("Cancelled", "Your page is safe :)", "error");          
                } 
            });
    }); 

</script>                  
