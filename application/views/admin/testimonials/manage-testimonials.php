 <!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <!-- END Sidebar -->
<div id="main-content">
    <!-- BEGIN Page Title -->

<div class="page-title">
  <div>
    <h1><i class="fa fa-th-list"></i><?php echo $page_title;?></h1>
  </div>
</div>
<!-- END Page Title -->
<!-- BEGIN Breadcrumb -->
<div id="breadcrumbs">
  <ul class="breadcrumb">
    <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().'admin/dashboard/'; ?>">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
    <li class="active"><?php echo $page_title;?></li>
  </ul>
</div>
<!-- END Breadcrumb -->
<!-- BEGIN Main Content -->
<style type="text/css">
  .hide_th
  {
    background-color:  transparent;
  }
</style>
<?php
      $attributes1 = array('class' => 'form-horizontal','id'=>'frm-manage-testimonials','name'=>"frm-manage-testimonials",'method'=>"post");
echo form_open(base_url()."admin/testimonials/manage/",$attributes1 );
?>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-title">
          <h3><i class="fa fa-list"></i> <?php echo $page_title;?></h3>
          <div class="box-tool">
          </div>
        </div>
        <div class="box-content">
          <div class="col-md-10">
            <div id='opt_status_service'>
            <?php
                   if($this->session->flashdata('error')!=''){  ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
            <?php }
                   if($this->session->flashdata('success')!=''){?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
            <?php } ?>
            </div>
            <div class="alert alert-danger" id="no_select" style="display:none;"></div>
            <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
          </div>
          <div class="btn-toolbar pull-right clearfix">
            <div class="btn-group">
             <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Add Testimonials" href="<?php echo base_url();?>admin/testimonials/add/"  style="text-decoration:none;"><i class="fa fa-plus"></i></a>

             <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active Testimonials" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-testimonials','active');" style="text-decoration:none;">
              <i class="fa fa-unlock"></i></a>
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block Testimonials" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-testimonials','block');"  style="text-decoration:none;">
              <i class="fa fa-lock"></i></a>
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Testimonials" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-testimonials','delete');"  style="text-decoration:none;">
              <i class="fa fa-trash-o"></i></a>
              </div>
            <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().'admin/testimonials/manage/'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
          </div>
          <br/>
          <br/>
          <div class="clearfix"></div>
          <div class="table-responsive" style="border:0" id='manage_service_tbl_data'>
            <?php
            ?>
            <input type="hidden" name="act_status" id="act_status" value="" />
            <table class="table table-advance"  id="table1" >
              <thead>
                <tr>
                  <th style="width:18px" > <input type="checkbox" name="mult_change" id="mult_change" value="delete" /></th>
                  <th>Image</th>
                  <th>Title  </th>
                  <th>Added By  </th>
                  <th>Description </th>
                  <th>Front Status</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
          
            <?php  if($fetchdata)
             {
                foreach ($fetchdata as $testimonials)
                {
                  $status = ($testimonials['testimonials_status']=="1")?"Active":"In-Active";
                  $hidden_checkbox = "<input type='checkbox' name='checkbox_del[]' value='".base64_encode($testimonials['testimonials_id'])."' id='checkbox_del'/>";
                  $front_status = "";

                    if($testimonials['testimonials_front_status']=="1")
                    {
                        $front_status = "<a class='btn btn-success' title='Click here to Make it Hidden'
                                            href='".base_url()."admin/testimonials/toggle_visibility/".base64_encode($testimonials['testimonials_id'])."/0'
                                            >
                                             Visible
                                        </a>";
                    }
                    elseif($testimonials['testimonials_front_status']=="0")
                    {
                        $front_status = "<a class='btn btn-danger' title='Click here to Make it Visible'
                                            href='".base_url()."admin/testimonials/toggle_visibility/".base64_encode($testimonials['testimonials_id'])."/1'
                                            >
                                             Hidden
                                        </a>";
                    }
                  /* testimonials Visibility*/
                    if($testimonials['testimonials_status']=="1")
                    {
                      $op_panel ='
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active testimonials" href="'.base_url().'admin/testimonials/toggle_status/'.base64_encode($testimonials["testimonials_id"]).'/0"  style="text-decoration:none;">
                                    <i class="fa fa-unlock"></i>
                                </a>';
                    }
                    else
                    {
                      $op_panel ='<a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block testimonials" href="'.base_url().'admin/testimonials/toggle_status/'.base64_encode($testimonials["testimonials_id"]).'/1" style="text-decoration:none;">
                                    <i class="fa fa-lock"></i>
                          </a>';
                    }
                    $adv_actions='<a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="View testimonials" href="'.base_url().'admin/testimonials/details/'.base64_encode($testimonials["testimonials_id"]).'"  style="text-decoration:none; " title="View"><i class="fa fa-eye"></i>
                                    </a>
                                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Edit testimonials" href="'.base_url().'admin/testimonials/edit/'.base64_encode($testimonials["testimonials_id"]).'"  style="text-decoration:none;">
                                    <i class="fa fa-edit"></i>
                                    </a>
                                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete testimonials" href="'.base_url().'admin/testimonials/toggle_status/'.base64_encode($testimonials["testimonials_id"]).'/2" style="text-decoration:none;" onclick="javascript:return checksingledelete();">
                                    <i class="fa fa-trash-o"></i>
                                    </a>';
                    echo "<tr>";
                    echo "<td> {$hidden_checkbox} </td>";?>
                     <td> 
                     <?php
                     $filename = 'uploads/testimonials_images/'.$testimonials['testimonials_img'];
                     if (file_exists($filename) && !empty($testimonials['testimonials_img']))
                     { 
                      
                     ?>
                       
                     <img width='100px' height='100px'  src='<?php echo base_url().'uploads/testimonials_images/'.$testimonials['testimonials_img'];?>' alt="" />
                     <?php }else{ ?>
                      <img width='100px' height='100px'  src='<?php echo base_url().'uploads/noimage/'.'noimagefound.jpg'?>' alt="" />
                     
                      <?php }?>
                      </td>
                    <?php
                    echo "<td> {$testimonials['testimonials_name_en']} </td>";
                     echo "<td> {$testimonials['testimonials_added_by']} </td>";
                    echo "<td> ".substr($testimonials['testimonials_description_en'],0,80)."..." ."</td>";
                     echo "<td>".$front_status."</td>";
                    echo "<td> {$op_panel} </td>";
                    echo  "<td> {$adv_actions} </td>";
                  echo "</tr>";
                }// foreach ends here
             }/* if ends here*/
        ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php echo form_close();?>
<!-- END Main Content -->
<?php $this->load->view('admin/top-footer'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>
