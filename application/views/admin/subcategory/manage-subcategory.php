<!-- BEGIN Theme Setting -->
<!-- END Theme Setting --> 

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
  <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?>
</div>
<!-- END Navbar --> 

<!-- BEGIN Container -->
<div class="container" id="main-container"> 
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view(ADMIN_PANEL_NAME.'left-navigation'); ?>
  </div>
  <!-- END Sidebar --> 


  


  <div id="main-content">
    <div class="page-title">
      <div><h1><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $pageTitle; ?></h1></div>
    </div>
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"> <i class="fa fa-angle-right"></i></span> </li>
        <li class="active"><?php echo $pageTitle; ?></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title"><h3><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $pageTitle; ?></h3></div>
          <form name="frm-manage" id="frm-manage" method="post" action="<?php echo base_url().ADMIN_PANEL_NAME.'subcategory/manage';?>">
            <div class="box-content">
            <span id="show_success" ></span>    
             <?php if($this->session->flashdata('error')!=''){  ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php }if($this->session->flashdata('success')!=''){?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php } ?>
                <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
              <div class="col-md-10">
                
              </div>
              <div class="btn-toolbar pull-right clearfix">
                <div class="btn-group">
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Add Subcategory" href="<?php echo base_url();?>admin/subcategory/add/"  style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().ADMIN_PANEL_NAME.'subcategory/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
              </div>
              <br/><br/>
              <div class="clearfix"></div>
              <div class="table-responsive" style="border:0" id="showBlockUI">
                <input type="hidden" name="act_status" id="act_status" value="" />
                <table class="table table-condensed" <?php if(count($fetchsubcategory)>0){?> id="table1"<?php } ?>>
                  <thead>
                    <tr>
                      <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                      <th>Sub-Category Name</th>
                      <th>Category Name</th>
                      <!-- <th>Description</th> -->
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="catList" >
                    <?php

                    if(count($fetchsubcategory)>0) {
                     foreach($fetchsubcategory as $row) {

                     ?>

                     <tr>
                          <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="<?php echo $row['subcategory_id']; ?>"/></td>
                          
                          <td><?php echo stripslashes($row['subcategory_name']); ?></td>
                          <td>
                          <?php $category=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$row['category_id'])); //print_r($category);
                          echo ucfirst($category[0]['category_name']); ?> 
                          </td>
                          <td>

                          
                          <?php if($row['subcategory_status']=='1'){ ?>
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="<?php echo base_url('admin/subcategory/status/0/'.$row['subcategory_id']); ?>"  style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                          <?php } else { ?>
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="<?php echo base_url('admin/subcategory/status/1/'.$row['subcategory_id']); ?>" style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                          <?php } ?>

                          </td>
                          <td>
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Edit "  href="<?php echo base_url().ADMIN_PANEL_NAME.'subcategory/update/'.$row['subcategory_id'];?>" style="text-decoration:none;" ><i class="fa fa-edit"></i></a>


                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip delete_selected_subcategory" title="Delete " data-subcategory="<?php echo $row['subcategory_id'];  ?>"  style="text-decoration:none;" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                          
                          </td>


                    </tr>
                    <?php
                      }
                    }
                    else
                      echo '<tr><td colspan="5"><div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button><strong>Error!</strong> Sorry no records found !</div></td></tr>';
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
            </div>
          </form>
        </div>
      </div>
    </div>
    


<script type="text/javascript">
  
  $('.delete_selected_subcategory').click(function(){
        var category_id = jQuery(this).data("subcategory");
        swal({   
             title: "Are you sure?",   
             text: "You want to delete this sub-category ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Your sub-category has been deleted.", "success"); 
                           location.href=site_url+"admin/subcategory/delete/"+category_id;
              } 
              else
              { 
                     swal("Cancelled", "Your sub-category is safe :)", "error");          
                } 
            });
    }); 

</script>           