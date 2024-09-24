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
      <div><h1><i class="fa fa-user" aria-hidden="true"></i> <?php echo $pageTitle; ?></h1></div>
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
          <div class="box-title"><h3><i class="fa fa-user" aria-hidden="true"></i> <?php echo $pageTitle; ?></h3></div>
          <form name="frm-manage" id="frm-manage" method="get" action="<?php echo base_url().ADMIN_PANEL_NAME.'users/manage';?>">
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
                  
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Subcategory" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().ADMIN_PANEL_NAME.'users/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
              </div>
              <br/><br/>
              <div class="clearfix"></div>

              <div class="col-xs-12 col-sm-12">
                  <label>Search: &nbsp; 
                  <?php if($_REQUEST['usersearch']!="") { ?> 
                  <input class="usersearch" placeholder="Please Enter Name" id="usersearch" name="usersearch" type="test" value="<?php echo $_REQUEST['usersearch']; ?>"></label>
                  <?php } else { ?>
                  <input class="usersearch" placeholder="Please Enter Name" id="usersearch" name="usersearch" type="test"></label>
                  <?php } ?>
                  <input type="submit" name="userbtnsearch" id="userbtnsearch">
              </div>

              <div class="table-responsive" style="border:0" id="showBlockUI">
                <input type="hidden" name="act_status" id="act_status" value="" />
                <!-- <table class="table table-condensed" <?php if(count($fetchusers)>0){?> id="table1"<?php } ?>> -->
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Mobile Number</th>
                      <th>IP Address</th>
                      <th>Block/Unblock</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="catList" >
                    <?php

                    if(count($fetchusers)>0) {
                    foreach($fetchusers as $row) {

                    ?>

                    <tr>
                      
                      <td style="width:18px">
                         <input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="<?php echo $row['id']; ?>"/>
                      </td>
                      <td><?php if($row['firstname'] != "") { echo stripslashes($row['firstname']). " ". stripslashes($row['lastname']);  } else { echo "-"; }; ?></td>
                      <td><?php if($row['username'] != "") { echo stripslashes($row['username']);  } else { echo "-"; }; ?></td>
                      <td><?php if($row['email'] != "") { echo stripslashes($row['email']);  } else { echo "-"; }; ?></td>
                      <td><?php if($row['gender'] != "") { echo stripslashes($row['gender']);  } else { echo "-"; }; ?></td>
                      <td><?php if($row['mobile_number'] != "") { echo stripslashes($row['mobile_number']);  } else { echo "-"; }; ?></td>
                      <td><?php if($row['ip_address'] != "") { echo stripslashes($row['ip_address']);  } else { echo "-"; }; ?></td>
                      <td>
                      <?php if($row['status']=='Unblock'){ ?>
                      <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Unblock" href="<?php echo base_url('admin/users/status/Block/'.$row['id']); ?>"  style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                      <?php } else { ?>
                      <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="<?php echo base_url('admin/users/status/Unblock/'.$row['id']); ?>" style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                      <?php } ?>
                      </td>
                      <td>

                       <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="View Details" href="<?php echo base_url('admin/users/view/'.$row['id']); ?>" style="text-decoration:none;"><i class="fa fa-eye" aria-hidden="true"></i></a>

                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Edit" href="<?php echo base_url('admin/users/edit/'.$row["id"]);?>"  style="text-decoration:none;"><i class="fa fa-edit"></i></a>

                       <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip delete_users" title="Delete " data-user="<?php echo $row['id'];  ?>"  style="text-decoration:none;" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a> -->
                      </td>
                    </tr>
                    <?php
                      }
                    }
                    else
                      echo '<tr><td colspan="6"><div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button><strong>Error!</strong> Sorry no records found !</div></td></tr>';
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="clear"></div>
            </div>
          </form>
        </div>
        <!--pagigation start here-->
        <div style="margin-top:-12px;">
          <?php echo $this->pagination->create_links(); ?>
        </div>
        <!--pagigation end here-->
      </div>
    </div>
    


<script type="text/javascript">
  $('.delete_users').click(function(){
        var user_id = jQuery(this).data("user");
        swal({   
             title: "Are you sure?",   
             text : "You want to delete this user ?",  
             type : "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Seller has been deleted.", "success"); 
                           location.href=site_url+"admin/users/delete/"+user_id;
              } 
              else
              { 
                     swal("Cancelled", "Seller is safe :)", "error");          
              } 
            });
    }); 
</script>           