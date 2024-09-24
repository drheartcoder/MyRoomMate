<div id="theme-setting">
  <?php //$this->load->view('admin/theme-setting'); ?>
</div>
<div id="navbar" class="navbar">
  <?php $this->load->view('admin/top-navigation'); ?>
</div>
<div class="container" id="main-container"> 
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view('admin/left-navigation'); ?>
  </div>
  <div id="main-content"> 
   <div class="page-title">
    <div><h1><i class="fa fa-euro"></i><?php echo $pageTitle; ?></h1></div>
  </div>
  <div id="breadcrumbs">
    <ul class="breadcrumb">
    <li><i class="fa fa-home"></i><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>dashboard">Home</a> <span class="divider">
        <i class="fa fa-angle-right"></i></span>
      </li>
      <li class="active"><?php echo $pageTitle; ?></li>
    </ul>
  </div>

  <div class="row">
   <div class="col-md-12">
    <div class="box box-magenta">
     <div class="box-title"><h3><i class="fa fa-table"></i><?php echo $pageTitle; ?></h3></div>
     <form name="frm-manage" id="frm-manage" method="post" action="<?php echo base_url().ADMIN_PANEL_NAME.'paymentoption/manage';?>">
       <div class="box-content">
         <div class="col-md-10">
           <?php 
           if($this->session->flashdata('error')!=''){  ?>
             <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
             <?php }if($this->session->flashdata('success')!=''){?>
               <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
               <?php } ?>
               <div class="alert alert-danger" id="no_select" style="display:none;"></div>
               <div class="alert alert-warning" id="warning_msg" style="display:none;"></div>
             </div>
             <div class="btn-toolbar pull-right clearfix">
               <div class="btn-group"> 
               </div>
               <div class="btn-group"> <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Refresh" href="<?php echo base_url().ADMIN_PANEL_NAME.'paymentoption/manage'; ?>"style="text-decoration:none;"><i class="fa fa-repeat"></i></a> </div>
             </div>
             <br/><br/>
             <div class="clearfix"></div>
             <div class="table-responsive " style="border:0" id="showBlockUI">
               <input type="hidden" name="act_status" id="act_status" value="" />
               <table class="table table-bordered" <?php if(count($fetchdata)>0){?> id="table1"<?php } ?>>
                <thead>
                 <tr>
                  <th>Pricing name</th>
                  <th>Price</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="catList" >
                <?php 
                if(count($fetchdata)>0)
                {
                 foreach($fetchdata as $row)
                 {
                   ?>
                   <tr>
                    <td><?php echo stripslashes($row['pricing_name']); ?></td>
                    <td>
                    <?php echo CURRENCY.$row['membership_price']; ?>
                    </td>
                    <td>
                    <?php if($row['membership_price']!='free'){ ?>  
                     <a class="btn btn-circle btn-to-success btn-bordered btn-fill show-tooltip" title="Update" style="text-decoration:none;" data-original-title="Edit" href="<?php echo base_url().ADMIN_PANEL_NAME.'paymentoption/update/'.$row['membership_id'].''; ?>">
                      <i class="fa fa-edit"></i>
                    </a>
                    <?php }else{echo '-';} ?>
                   </td>

                </tr>
                <?php
              }
            }
        else
        {
         echo '<tr><td colspan="6"><div class="alert alert-danger"><button data-dismiss="alert" class="close">×</button><strong>Error!</strong> Sorry no records found !</div></td></tr>';
       }
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
