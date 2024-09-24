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
          <form name="frm-manage" id="frm-manage" method="post" action="<?php echo base_url().ADMIN_PANEL_NAME.'categoryfields/manage';?>">
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
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Add category fields" href="<?php echo base_url();?>admin/categoryfields/add/"  style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active category fields" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block category fields" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete category fields" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().ADMIN_PANEL_NAME.'categoryfields/manage/'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
              </div>
              <br/><br/>
              <div class="clearfix"></div>
              <div class="table-responsive" style="border:0" id="showBlockUI">
                <input type="hidden" name="act_status" id="act_status" value="" />
                <table class="table table-condensed" <?php if(count($fetchcategoryfields)>0){?> id="table1"<?php } ?>>
                  <thead>
                    <tr>
                      <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                      <th>Category Name</th>
                      <th>Field Name</th>
                      <th>Field Type</th>
                      <th>Field Elements</th>
                      <th>Order By</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="catList" >
                    <?php
                    
                    if(count($fetchcategoryfields)>0) {
                     foreach($fetchcategoryfields as $row) {

                     ?>

                     <tr>
                          <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="<?php echo $row['id']; ?>"/></td>
                          
                          <td>
                          <?php $category=$this->master_model->getRecords('tbl_category_master',array('category_id'=>$row['cat_id'])); //print_r($category);
                          echo $category[0]['category_name'];
                          //isset($category[0]['category_name'])?ucfirst($category[0]['category_name']):'' 
                          ?> 
                          </td>
                          
                          <td>
                          <?php $attribute=$this->master_model->getRecords('tbl_attribute_master',array('attribute_id'=>$row['attribute_id'])); //print_r($category);
                          echo ucfirst($attribute[0]['attribute_name']); ?>
                          </td>

                          <td>
                          <?php echo $row['fields_type']; ?>
                          </td>

                          <td>
                          <?php echo $row['fields_elements']; ?>
                          </td>

                          <td>
                          <input type="text" name="orderby<?php echo $row['id']; ?>" id="orderby<?php echo $row['id']; ?>" value="<?php if(!empty($row['orderby'])) { echo $row['orderby']; } ?>" style="width: 60px" onblur="orderbyfields('<?php echo $row['id']; ?>');"/>
                          </td>

                          <td>                       
                          <?php if($row['status']=='1'){ ?>
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="<?php echo base_url('admin/categoryfields/status/0/'.$row['id']); ?>"  style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                          <?php } else { ?>
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="<?php echo base_url('admin/categoryfields/status/1/'.$row['id']); ?>" style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                          <?php } ?>

                          </td>
                          <td>
                         <!--  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Edit "  href="<?php //echo base_url().ADMIN_PANEL_NAME.'categoryfields/update/'.$row['id'];?>" style="text-decoration:none;" ><i class="fa fa-edit"></i></a> -->


                           <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip delete_selected_subcategory" title="Delete " data-subcategory="<?php echo $row['id'];  ?>"  style="text-decoration:none;" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                          
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
          text: "You want to delete this category fields ?",  
          type: "warning",   
          showCancelButton: true,   
          confirmButtonColor: "#8cc63e",  
          confirmButtonText: "Yes",  
          cancelButtonText: "No",   
          closeOnConfirm: false,   
          closeOnCancel: false }, function(isConfirm){   
          if (isConfirm) 
          { 
              swal("Deleted!", "Your category fields has been deleted.", "success"); 
              location.href=site_url+"admin/categoryfields/delete/"+category_id;
          } 
          else
          { 
              swal("Cancelled", "Your category fields is safe :)", "error");          
          } 
        });
    }); 

  function orderbyfields(id) {
    var fieldValue = $('#orderby'+id).val();
    
    $.ajax({
       type:"POST",
       url:'<?php echo base_url(); ?>admin/categoryfields/orderby',
       data:{fieldId:id,orderby:fieldValue},
       success:function(result)
       {  
          //alert("Updated ... !");
          //$('#subcategory_name').html(result);
       }
     })
  }

</script>           