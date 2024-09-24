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

 <!-- BEGIN Content -->
 <div id="main-content"> 
  <!-- BEGIN Page Title -->
  <div class="page-title">
    <div>
      <h1><img class="" src="<?php echo base_url(); ?>images/fevicon/favicon.png" alt="" style="height:30px; margin-top:-8px" /> 
         <?php echo PROJECT_NAME; ?> Dashboard</h1>
      <h4>Overview, stats, chat and more</h4>
  </div>
</div>
<!-- END Page Title --> 



<!-- BEGIN Tiles -->
<?php  $color_array=array('tile tile-light-sky',
    'tile tile-red',
    'tile tile-light-red',
    'tile tile-pink',
    'tile tile-light-pink',
    'tile tile-light-yellow',
    'tile tile-dark-magento',
    'tile tile-lgt-magento');?>

    <!-- END Tiles -->
    <!-- BEGIN Tiles -->



    <div class="row">
    <div class="col-md-12">
    <div class="row">


    <div class="col-md-3">
      <div class="row">
        <div class="col-md-12 tile-active">
            <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard/">
                <div class="tile tile-light-blue">
                    <div class="img img-center">
                       <i class="fa fa-home"></i>
                   </div>
                   <p class="title text-center">Dashboard</p>
               </div></a>
               <div class="tile tile-blue">
                <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>dashboard/">Dashboard</a></p>
                <p>See Your Dashboard</p>
                <div class="img img-bottom">
                    <i class="fa fa-home"></i>
                </div>
            </div>

        </div>
      </div>
    </div>


    <div class="col-md-3">
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/edit/">
            <div class="tile tile-red">
                <div class="img img-center">
                   <i class="fa fa-cog"></i>
               </div>
               <p class="title text-center">Edit Profile</p>
           </div></a>
           <div class="tile tile-orange">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/edit/">Edit Profile</a></p>
            <p>See Your Profile</p>
            <div class="img img-bottom">
                <i class="fa fa-cog"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3">
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/change_password/">
            <div class="tile tile-green">
                <div class="img img-center">
                   <i class="fa fa-key" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Change Password</p>
           </div></a>
           <div class="tile tile-pink">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>profile/change_password/">Change Password</a></p>
            <p>Change Your Password</p>
            <div class="img img-bottom">
                <i class="fa fa-key" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>country/manage/">
            <div class="tile tile-pink">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Country</p>
           </div></a>
           <div class="tile tile-light-magenta">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>country/manage/">Country</a></p>
            <p>Manage Your Country</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>residence/manage/">
            <div class="tile tile-lime">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Residence</p>
           </div></a>
           <div class="tile tile-green">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>residence/manage/">Residence</a></p>
            <p>Manage Your Residence</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>category/manage/">
            <div class="tile tile-magenta">
                <div class="img img-center">
                   <i class="fa fa-tag" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Category</p>
           </div></a>
           <div class="tile tile-dark-blue">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>category/manage/">Category</a></p>
            <p>Add Your Category</p>
            <div class="img img-bottom">
                <i class="fa fa-tag" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>attribute/manage/">
            <div class="tile tile-lime">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Attribute</p>
           </div></a>
           <div class="tile tile-orange">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>attribute/manage/">Attribute</a></p>
            <p>Manage Your Attribute</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>categoryfields/manage/">
            <div class="tile tile-orange">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Custom Fields</p>
           </div></a>
           <div class="tile tile-red">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>categoryfields/manage/">Custom Fields</a></p>
            <p>Manage Your Custom Fields</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>users/manage/">
            <div class="tile tile-light-blue">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Sellers</p>
           </div></a>
           <div class="tile tile-lime">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>users/manage/">Sellers</a></p>
            <p>Manage Your Sellers</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>testimonials/manage/">
            <div class="tile tile-dark-blue">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Testimonials</p>
           </div></a>
           <div class="tile tile-magenta">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>testimonials/manage/">Testimonials</a></p>
            <p>Manage Your Testimonials</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3">
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/manage/">
            <div class="tile tile-red">
                <div class="img img-center">
                   <i class="fa fa-file-o" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Front Pages</p>
           </div></a>
           <div class="tile tile-pink">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>pages/manage/">Front Pages</a></p>
            <p>Manage Your Front Pages</p>
            <div class="img img-bottom">
                <i class="fa fa-file-o" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>blogs/manage/">
            <div class="tile tile-light-blue">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Blogs</p>
           </div></a>
           <div class="tile tile-blue">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>blogs/manage/">Blogs</a></p>
            <p>Manage Your Blogs</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>blogscomments/manage/">
            <div class="tile tile-orange">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Blogs Comments</p>
           </div></a>
           <div class="tile tile-blue">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>blogscomments/manage/">Blogs Comments</a></p>
            <p>Manage Your Blogs Comments</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3">
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>subscribe/manage/">
            <div class="tile tile-red">
                <div class="img img-center">
                   <i class="fa fa-envelope-o" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Subscribers</p>
           </div></a>
           <div class="tile tile-green">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>subscribe/manage/">Subscribers</a></p>
            <p>Manage Your Subscribers</p>
            <div class="img img-bottom">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3">
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>Contactenquiry/manage/">
            <div class="tile tile-magenta">
                <div class="img img-center">
                   <i class="fa fa-envelope-o" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Contact Enquiry</p>
           </div></a>
           <div class="tile tile-dark-blue">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>Contactenquiry/manage/">Contact Enquiry</a></p>
            <p>Manage Your Contact Enquiry</p>
            <div class="img img-bottom">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>paymentoption/manage/">
            <div class="tile tile-green">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Payment Option</p>
           </div></a>
           <div class="tile tile-lime">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>paymentoption/manage/">Payment Option</a></p>
            <p>Manage Your Payment Option</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>advertisement/manage/">
            <div class="tile tile-pink">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Advertisement</p>
           </div></a>
           <div class="tile tile-magenta">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>advertisement/manage/">Advertisement</a></p>
            <p>Manage Your Advertisement</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>

    <div class="col-md-3" >
    <div class="row">
    <div class="col-md-12 tile-active">
        <a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>listing/manage/">
            <div class="tile tile-lime">
                <div class="img img-center">
                   <i class="fa fa-tags" aria-hidden="true"></i>
               </div>
               <p class="title text-center">Listing</p>
           </div></a>
           <div class="tile tile-orange">
            <p class="title"><a href="<?php echo base_url().ADMIN_PANEL_NAME; ?>listing/manage/">Listing</a></p>
            <p>Manage Your Listing</p>
            <div class="img img-bottom">
                <i class="fa fa-tags" aria-hidden="true"></i>
            </div>
        </div>

    </div>
    </div>
    </div>
    
</div>

<!-- end reports -->     

</div>
<!-- content end -->

</div>


