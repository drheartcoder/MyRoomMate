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
    <h1><i class="fa fa-phone-square"></i><?php echo $page_title;?></h1>
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
      $attributes1 = array('class' => 'form-horizontal','id'=>'frm-manage-contact','name'=>"frm-manage-contact",'method'=>"post");
echo form_open(base_url()."admin/blogscomments/manage/",$attributes1 );
?>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-title">
          <h3><i class="fa fa-phone-square"></i> <?php echo $page_title;?></h3>
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
            <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Read Message" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-contact','active');" style="text-decoration:none;">
              <i class="fa fa-unlock"></i></a>
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Un-read Message" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-contact','block');"  style="text-decoration:none;">
              <i class="fa fa-lock"></i></a>
              <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete Contact Enquiry" href="javascript:void(0);" onclick="javascript : return checkmultiaction('frm-manage-contact','delete');"  style="text-decoration:none;">
              <i class="fa fa-trash-o"></i></a>
              </div>
            <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().'admin/blogscomments/manage/'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
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
                  <th>Name</th>
                  <th>Email </th>
                  <th>Phone</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
        <?php
        //print_r($enquirydata);
         if($enquirydata)
             {
                foreach ($enquirydata as $contactenq)
                {
                  $status = ($contactenq['message_read']=="1")?"Approve":"Unapprove";
                  $hidden_checkbox = "<input type='checkbox' name='checkbox_del[]' value='".base64_encode($contactenq['comm_id'])."' id='checkbox_del'/>";
                  $message_read = "";
                 /* $display_order = "<input type = 'text'
                                          class = 'form-control'
                                          value = '".$contact['sv_display_order']."'
                                          onblur = 'change_service_display_order(this)'
                                          data-sv-id ='".$contact['comm_id']."'
                                           />
                                    <span class='order_error' style='color:#B94A48;'></span>";
                  /* Display Order */
                  /* Front Visibility */
                    if($contactenq['message_read']=='1')
                    {
                        $message_read = "<a class='btn btn-success' title='Click here to Make it Hidden'
                                            href='".base_url()."admin/blogscomments/toggle_visibility/".base64_encode($contactenq['comm_id'])."/0'
                                            >
                                             Approve
                                        </a>";
                    }
                    elseif($contactenq['message_read']=='0')
                    {
                        $message_read = "<a class='btn btn-info' title='Click here to Make it Visible'
                                            href='".base_url()."admin/blogscomments/toggle_visibility/".base64_encode($contactenq['comm_id'])."/1'
                                            >
                                             Unapprove
                                        </a>";
                    }
                  /* contact Visibility*/
                   /* if($contactenq['message_read']=="1")
                    {
                      $op_panel ='
                          <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Active contact" href="'.base_url().'admin/blogscomments/toggle_status/'.base64_encode($contactenq["comm_id"]).'/0"  style="text-decoration:none;">
                                    <i class="fa fa-unlock"></i>
                                </a>';
                    }
                    else
                    {
                      $op_panel ='<a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Block contact" href="'.base_url().'admin/blogscomments/toggle_status/'.base64_encode($contactenq["comm_id"]).'/1" style="text-decoration:none;">
                                    <i class="fa fa-lock"></i>
                          </a>';
                    }*/
                    $adv_actions='<a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="View contact" href="'.base_url().'admin/blogscomments/details/'.base64_encode($contactenq["comm_id"]).'"  style="text-decoration:none; " title="View"><i class="fa fa-eye"></i>
                                    </a>
                                  <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Delete contact" href="'.base_url().'admin/blogscomments/toggle_status/'.base64_encode($contactenq["comm_id"]).'/2" style="text-decoration:none;" onclick="javascript:return checksingledelete();">
                                    <i class="fa fa-trash-o"></i>
                                    </a>
                                    ';
                    echo "<tr>";
                    echo "<td> {$hidden_checkbox} </td>";?>
                    <?php
                    echo "<td> {$contactenq['comm_name']} </td>";
                    echo "<td> {$contactenq['comm_email']} </td>";
                     echo "<td> {$contactenq['comm_website']} </td>";
                     echo "<td> {$contactenq['comm_message']} </td>";

                    // echo "<td width='50%' ><div style='width:600px; height:50px; overflow-y: scroll;' >".stripslashes(substr(strip_tags($contact['sv_discription']),0,200).'...')."</div></td>";
                     //echo "<td>".$display_order."</td>";
                     echo "<td>".$message_read."</td>";
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
