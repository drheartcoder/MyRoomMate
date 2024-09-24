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

        <h1><i class="fa fa-user"></i> <?php echo $pageTitle; ?></h1>
        <h4></h4>
      </div>
    </div>
    <!-- END Page Title --> 
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        
            <li ><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>sellers/manage">Manage Users</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
       
          
        <li class="active"><?php echo $pageTitle; ?></li>
      </ul>
    </div>
    <!-- END Breadcrumb --> 
    
    <!-- BEGIN Main Content -->   
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
            <h3><i class="fa fa-user"></i> <?php echo $pageTitle; ?> </h3>
          </div>
          <div class="box-content">
          
            <style type="text/css">
              .unverify-class {
                  padding: 2px 20px;
                  line-height: 20px;
                  text-align: center;
                  background: #FF0000;
                  color: #fff;
                  font-weight: 600;
              }
              .verify-class {
                  padding: 2px 20px;
                  line-height: 20px;
                  text-align: center;
                  background: #15b74e;
                  color: #fff;
                  font-weight: 600;
              }
              .padding-left {
                  margin-right: 5px;
              }
            </style>
            <form class="form-horizontal" id="" action="#">
            <?php
              if(count($user_info) > 0) 
              {
                foreach ($user_info as $user) 
                {
                  ?>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Name : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                           <?php if(!empty($user['firstname'])){ echo $user['firstname'].' '.$user['lastname']; } else { echo "Not Available"; } ?>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Username : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                           <label style="font-weight:700;"><?php if(!empty($user['username'])){ echo ucfirst($user['username']); } else { echo "Not Available"; } ?></label>
                        </label>
                      </div>
                    </div>
                   
                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Gender : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;"><?php if(!empty($user['gender'])){ echo ucfirst($user['gender']); } else { echo "Not Available"; } ?></label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Email ID : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;"><?php if(!empty($user['email'])){ echo $user['email']; } else { echo "Not Available"; } ?></label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Mobile Number : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;"><?php if(!empty($user['mobile_number'])){ echo $user['mobile_number']; } else { echo "Not Available"; }  ?> </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Age : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;"><?php if(!empty($user['age'])){ echo $user['age']; } else { echo "Not Available"; }  ?> </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">City : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                        <?php foreach($fetchcountry as $country) 
                          { 
                               if($user_info['0']['nationality']  == $country['country_id'] )  
                               { 
                                  echo $country['country_name'];
                               }
                              
                           } ?>
                        </label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Country Of Residence : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                        <?php 
                         foreach($fetchresidence as $residence) 
                        {
                            if($user_info['0']['countryofresidence'] == $residence['residence_id'] )
                            {
                              echo $residence['residence_name'];
                            }
                           
                         } ?>
                        </label>

                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Address : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;"><?php if(!empty($user['address'])){ echo $user['address']; } else { echo "Not Available"; } ?></label>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">&nbsp;</label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                           <a href="<?php echo base_url(); ?>admin/users/manage/" class="btn btn-primary">Go Back</a>
                        </label>
                      </div>
                    </div>

                  <?php
                }
              }
              else{ ?>

                    <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Sorry : </label>
                      <div class="col-sm-9 col-lg-4 controls">
                        <label style="font-weight:700;">
                           No Record Found.....
                        </label>
                      </div>
                    </div>
              <?php }
            ?>
         </form> 
      </div>
    </div>
  </div>
</div>