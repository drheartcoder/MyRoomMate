<?php $user_info=$this->master_model->getRecords('admin_login');?>
<button type="button" class="navbar-toggle navbar-btn collapsed" data-toggle="collapse" data-target="#sidebar"> <span class="fa fa-bars"></span> </button>
<!-- <a class="navbar-brand" href="#" style="text-decoration:none;"><image src="<?php echo base_url();?>images/logo.png" style="height:42px; width:162px;"></a>  -->

<!-- BEGIN Navbar Buttons -->
<!-- BEGIN Button User -->
<a class="navbar-brand" href="#">
<small>
<i class="fa fa-desktop"></i>  
<!-- <img class="" src="<?php echo base_url(); ?>images/fevicon/favicon.png" alt="" /> -->
<?php echo PROJECT_NAME;?>  Admin
</small>
</a>
<ul class="nav flaty-nav pull-right">
<li class="user-profile">

<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle" style="text-decoration:none;"> 

<?php if(!empty($user_info[0]['profile_picture']) && file_exists('uploads/admin_profile/'.$user_info[0]['profile_picture'])) { ?>

<img class="nav-user-photo" src="<?php echo base_url(); ?>uploads/admin_profile/<?php echo $user_info[0]['profile_picture']; ?>" alt="" />

<?php } else { ?>  

<img class="nav-user-photo" src="<?php echo base_url(); ?>uploads/admin_profile/default.jpeg" alt="" />

<?php } ?>


<span class="hhh" id="user_info"><?php echo ucfirst($this->session->userdata('admin_username')); ?></span><i class="fa fa-caret-down"></i>

</a> 

<!-- BEGIN User Dropdown -->
<ul class="dropdown-menu dropdown-navbar" id="user_menu">
<!--<li class="nav-header"> <i class="fa fa-clock-o"></i> Logined From 20:45 </li>-->
<li> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/change_password/"> <i class="fa fa-cog"></i> Change Password </a> </li>
<!-- <li> <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>myaccount/editaccount"> <i class="fa fa-user"></i> Edit Profile </a> </li> -->
<!--<li> <a href="#"> <i class="fa fa-question"></i> Help </a> </li>-->
<li class="divider visible-xs"></li>
<li class="visible-xs"> <a href="#"> <i class="fa fa-tasks"></i> Tasks <span class="badge badge-warning">4</span> </a> </li>
<li class="visible-xs"> <a href="#"> <i class="fa fa-bell"></i> Notifications <span class="badge badge-important">8</span> </a> </li>
<li class="visible-xs"> <a href="#"> <i class="fa fa-envelope"></i> Messages <span class="badge badge-success">5</span> </a> </li>
<li class="divider"></li>
<li> <a href="<?php echo base_url().ADMIN_PANEL_NAME.'logout/' ?>"> <i class="fa fa-sign-out" aria-hidden="true"></i> Logout </a> </li>
</ul>
<!-- BEGIN User Dropdown --> 
</li>
</ul>


<?php 
$this->db->where('seen_status' , '0');
$enq_query = $this->master_model->getRecords('tbl_contact_inquiries');
$user_cnt  =$pending_ord=0;
$cnt       =count($enq_query);
?>


<!-- BEGIN Navbar Buttons -->
<ul class="nav flaty-nav pull-right" >

    <!-- contact inquiry -->  

      <li class="user-profile">

      <!-- BEGIN User Dropdown -->
      <ul class="dropdown-menu dropdown-navbar" id="user_menu">
      <li class="nav-header">
      <i class="fa fa-warning"></i>
      <?php   echo $cnt +  $user_cnt  + $pending_ord + $productrequestcnt + $sellerofferrequestcnt + $requirementrequestcnt + $buyerofferrequestcnt;?>
      Notifications
      </li>

      <li class="notify" style="width:320px;">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>enquiry/manage">
        <i class="fa fa-comment orange"></i>
        <p>New contact inquiries</p>
        <span class="badge badge-warning">
        <?php echo $cnt  ?> </span>
        </a>
      </li>
      <li class="notify" style="width:320px;">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>seller_requests/for_products/">
        <i class="fa fa-comment orange"></i>
        <p>New product upload request from seller</p>
        <span class="badge badge-warning">
        <?php echo $productrequestcnt;  ?> </span>
        </a>
      </li>
      <li class="notify" style="width:320px;">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>seller_requests/for_offers/">
        <i class="fa fa-comment orange"></i>
        <p>New make offer request from seller</p>
        <span class="badge badge-warning">
        <?php echo $sellerofferrequestcnt;  ?> </span>
        </a>
      </li>
      <li class="notify" style="width:320px;">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>buyer_requests/for_requirements/">
        <i class="fa fa-comment orange"></i>
        <p>New requirement post request from buyer</p>
        <span class="badge badge-warning">
        <?php echo $requirementrequestcnt;  ?> </span>
        </a>
      </li>
      <li class="notify" style="width:320px;">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>buyer_requests/for_offers/">
        <i class="fa fa-comment orange"></i>
        <p>New make offer request from buyer</p>
        <span class="badge badge-warning">
        <?php echo $buyerofferrequestcnt;  ?> </span>
        </a>
      </li>


      </ul>
      </li>

    <!-- end  contact inquiry -->  



</ul>


