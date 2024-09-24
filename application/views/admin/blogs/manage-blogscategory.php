<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<div class="container" id="main-container">
	<!-- BEGIN Sidebar -->
	<div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <div id="main-content">
    <div class="page-title">
      <div><h1><i class="fa fa-star"></i><?php echo $pageTitle; ?></h1></div>
    </div>
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li><i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"> <i class="fa fa-angle-right"></i></span> </li>
        <li class="active"><?php echo $pageTitle; ?></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-title"><h3><i class="fa fa-star"></i><?php echo $pageTitle; ?></h3></div>
          <form name="frm-manage" id="frm-manage" method="post" action="<?php echo base_url().'admin/blogscategory/manage';?>">
            <div class="box-content">
              <div class="col-md-10">
                <?php if($this->session->flashdata('error')!=''){  ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                <?php }if($this->session->flashdata('success')!=''){?>
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                <?php } ?>
                <div class="alert alert-danger" id="no_select" style="display:none;"></div>
                <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
              </div>
              <div class="btn-toolbar pull-right clearfix">
                <div class="btn-group">
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Add Blog Category" href="<?php echo base_url();?>admin/blogscategory/add/"  style="text-decoration:none;"><i class="fa fa-plus"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Blog Category" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','active');" style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Blog Category" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','block');"  style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Blog Category" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage','delete');"  style="text-decoration:none;"><i class="fa fa-trash-o"></i></a>
                </div>
                <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().'admin/blogscategory/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
              </div>
              <br/><br/>
              <div class="clearfix"></div>
              <div class="table-responsive" style="border:0" id="showBlockUI">
                <input type="hidden" name="act_status" id="act_status" value="" />
                <table class="table table-condensed" <?php if(count($fetchblogscategory)>0){?> id="table1"<?php } ?>>
                  <thead>
                    <tr>
                      <th style="width:18px"><input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="catList" >
                    <?php
                    if(count($fetchblogscategory)>0) {
                     foreach($fetchblogscategory as $row) {
                    ?>
                    <tr>
                      <td style="width:18px"><input type="checkbox" name="checkbox_del[]" id="checkbox_del" value="<?php echo $row['blogscategory_id']; ?>"/></td>
                      <td><?php echo stripslashes($row['blogscategory_name']); ?></td>
                      <td><?php echo stripslashes($row['blogscategory_description']); ?></td>
                      <td>
                        <?php if($row['blogscategory_status']=='1'){ ?>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active" href="<?php echo base_url('admin/blogscategory/status/0/'.$row['blogscategory_id']); ?>"  style="text-decoration:none;"><i class="fa fa-unlock"></i></a>
                        <?php } else{ ?>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block" href="<?php echo base_url('admin/blogscategory/status/1/'.$row['blogscategory_id']); ?>" style="text-decoration:none;"><i class="fa fa-lock"></i></a>
                        <?php } ?>
                      </td>
                      <td>
                        <!-- <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip"   href="<?php echo base_url().'admin/blogscategory/update/'.$row['blogscategory_id'];?>" data-original-title="Edit" style="text-decoration:none;" title="Update"> <i class="fa fa-edit"></i></a>  -->
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Edit "  href="<?php echo base_url().'admin/blogscategory/update/'.$row['blogscategory_id'];?>" style="text-decoration:none;" ><i class="fa fa-edit"></i></a>
                        <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete "  onclick="javascript : return confirm_delete('<?php echo base_url().'admin/blogscategory/delete/'.$row['blogscategory_id'];?>');" style="text-decoration:none;" href="javascript:void(0);"><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                    <?php
                      }
                    }
                    else
                      echo '<tr><td colspan="4"><div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button><strong>Error!</strong> Sorry no records found !</div></td></tr>';
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
    <?php $this->load->view('admin/top-footer'); ?>
  </div>
</div>