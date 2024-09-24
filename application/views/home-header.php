<header ng-controller="HeaderCntrl">

<!-- Hotjar Tracking Code for myroommate.ae -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:455910,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<meta name="google-site-verification" content="4Pqy-5dEDw0lqYmsdErnRE_Ng1c683cl8X5F5-SiRzA" />

<input type="hidden" name="loginuserid" id="loginuserid" value="<?php echo $this->session->userdata('user_id'); ?>">
 <div class="container">
     <div class="row">
         <div class="col-xs-7 col-sm-7 col-md-3 col-lg-3">
         <a href="<?php echo base_url(); ?>" class="logo"><img src="<?php echo base_url(); ?>front-asset/images/logo.png" class="img-responsive" alt="My-Roommate"/></a>
         </div>
         <div class="col-xs-5 col-sm-5 hidden-md hidden-lg">
           <div class="resp-block">
            <span class="resp-search visible-xs" value="Toggle Second" data-slide-toggle="#box5" data-slide-toggle-duration="1000"><i class="fa fa-search"></i></span>
            <span class="menu-icon  visible-xs visible-sm" ng-click="openNav()">&#9776;</span>
            </div>
         </div>
             
         <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
             <div class="search-section for-error-cloass" id="box5">
                 <div id="err_home_category_name" class="error"></div>
                 <div class="search-block-w">
                     <form id="homesearch" name="homesearch" method="get" action="<?php echo base_url(); ?>listing">
                     
                          <?php 
                            $where = array('parent_id'=>'0','is_delete'=>'0','category_status'=>'1');
                            $parentcat = $this->master_model->getRecords('tbl_category_master',$where);

                            foreach ($parentcat as $key => $value) {
                              
                              $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                              $childcat = $this->master_model->getRecords('tbl_category_master',$where);

                              $fetchcategoriesparent[]   = $value;

                              foreach ($childcat as $key => $value) {
                                
                                $fetchcategories[]   = $value;

                                /*$where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                                $childchildcat = $this->master_model->getRecords('tbl_category_master',$where);

                                foreach ($childchildcat as $key => $value) {
                          
                                  $fetchcategories[]   = $value;
                                }*/
                              }
                            }

                           /* echo "<pre>";
                            print_r($fetchcategories);
                            echo "</pre>";*/

                          ?>

                          <div class="select-style">
                          <?php if(!isset($_REQUEST['sercategory_id'])) { $_REQUEST['sercategory_id'] =''; } ?>
                          <select class="frm-select" id="home_category_name" name="sercategory_id">
                              <optgroup style="max-height: 200px;" label="">
                                <option value="">Select Category</option>
                              </optgroup>
                              <?php foreach($fetchcategories as $category) { ?>
                              <optgroup style="max-height: 200px;" label="<?php echo $category['category_name'];?>">

                               <!-- <option value="">Select Category</option> -->
                                <?php 
                                $where = array('parent_id'=> $category['category_id'],'is_delete'=>'0','category_status'=>'1');
                                $childchildcat = $this->master_model->getRecords('tbl_category_master',$where);
                                ?>

                                <?php foreach($childchildcat as $value) { ?>
                                  <option class="lavel2" value="<?php echo $value['category_id']; ?>" 
                                 
                                  <?php 
                                     
                                      if(isset($_REQUEST['sercategory_id']) && !empty($_REQUEST['sercategory_id'])){
                                       if($_REQUEST['sercategory_id'] == $value['category_id']) { ?> selected <?php } 
                                      } else {

                                       if($this->session->userdata('sercategory_id') == $value['category_id']) { ?> selected <?php } 
                                      } 
                                        
                                  ?>
                                  ><?php echo $value['category_name'];?></option>
                                <?php } ?>
                              </optgroup>
                              <?php } ?>
                          </select>
                    </div>

                    <div class="select-style-short">
                          <?php 
                            $this->db->order_by('tbl_residence_master.residence_name');
                            //$this->db->group_by('tbl_addlisting.countryofresidence');
                            $where = array('tbl_residence_master.is_delete'=>'0','tbl_residence_master.residence_status'=>'1');
                            //$this->db->join('tbl_addlisting' , 'tbl_addlisting.countryofresidence = tbl_residence_master.residence_id'); 
                            $arr_city = $this->master_model->getRecords('tbl_residence_master',$where);
                            //echo "<pre>"; print_r($arr_city);exit;
                          ?>
                          <?php if(!isset($_REQUEST['countryofresidence'])) { $_REQUEST['countryofresidence'] =''; } ?>
                          
                          <select class="frm-select" id="home_city_name" name="countryofresidence">
                              <optgroup style="max-height: 200px;" label="">
                               <option value="">Select City</option>
                                
                                <?php foreach($arr_city as $city) { ?>
                                  
                                  <option class="lavel2" value="<?php echo $city['residence_id']; ?>" 
                                  <?php

                                    if(isset($_REQUEST['countryofresidence']) && !empty($_REQUEST['countryofresidence'])){
                                     if($_REQUEST['countryofresidence'] == $city['residence_id']) { ?> selected <?php } 
                                    } else {

                                     if($this->session->userdata('countryofresidence') == $city['residence_id']) { ?> selected <?php } 
                                    }
                                  ?>
                                  ><?php echo $city['residence_name'];?></option>
                                
                                <?php } ?>
                              
                              </optgroup>
                          </select>
                          

                          <div id="err_home_city_name" class="error"></div>
                    </div>
                    
                    <!--< ?php if(!isset($_REQUEST['product_title'])) { $_REQUEST['product_title'] =''; } ?>
                     <span><input type="text" class="search-bx" name="product_title" value="< ?php echo $_REQUEST['product_title']; ?>" placeholder="What are you Looking For?"/></span> -->
                    <button type="submit" id="homesearchsubmit" name="homesearchsubmit" class="search hvr-icon-pulse">&nbsp;<!--<i class="fa fa-search"></i>--></button>

                    </form>
           
                  </div>
                
                <!-- check if user is login -->
                <?php if($this->session->userdata('user_id') == "") { ?>
                  <a href="javascript:void(0);" class="post-ads hvr-ripple-out hidden-xs hidden-sm userlogin">Post Ads</a>
                <?php } else { ?>
                  <a href="<?php echo base_url().'user/addlisting' ?>" class="post-ads hvr-ripple-out hidden-xs hidden-sm">Post Ads</a>
                <?php } ?>

              <?php if($this->session->userdata('user_id')=="") { ?>
              <a class="login hidden-xs hidden-sm" data-toggle="modal" href="#login">Login</a>
              <?php } else { ?>
              <a class="login hidden-xs hidden-sm" data-toggle="modal" href="<?php echo base_url().'user/dashboard'; ?>">My Account</a>
              <?php } ?>
              
              <span class="menu-icon  visible-sm" ng-click="openNav()">&#9776;</span>
             </div>
         </div>
     </div>
 </div>
 <div class="top-menu">
    <div class="container">
    <div class="sidenav" id="mySidenav">
                <a class="closebtn" ng-click="closeNav()">&times;</a>
                <div class="banner-img-block">
                   <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>front-asset/images/small-logo.png" class="img-responsive" alt="" /></a>
                </div>
     <ul class="min-menu">
        <li><a href="<?php echo base_url(); ?>">Home</a></li>
        <li><a href="<?php echo base_url();?>listing?sercategory_id=113">Rooms Available</a></li>
        <li><a href="<?php echo base_url();?>listing?sercategory_id=114">Rooms Needed</a></li>
        <li><a href="<?php echo base_url();?>listing?sercategory_id=229">Cars 4x4</a></li>  
        <!--<li><a href="<?php echo base_url().'cms/view/about-us'; ?>">About Us</a></li>-->
        <li><a href="<?php echo base_url().'blogs';?>">Blog</a></li>
        <li><a href="<?php echo base_url().'Contact_us';?>">Contact Us</a></li>
        <li class="visible-xs visible-sm">
        	<?php if($this->session->userdata('user_id') == "") { ?>
                  <a data-toggle="modal" href="#login" ng-click="closeNav()">Post Ads</a>
                <?php } else { ?>
                  <a href="<?php echo base_url().'user/addlisting' ?>">Post Ads</a>
                <?php } ?>
        </li>
        <li class="visible-xs visible-sm">

          <?php if($this->session->userdata('user_id')=="") { ?>
            <a data-toggle="modal" href="#login" ng-click="closeNav()">Login</a>
          <?php } else { ?>
            <a data-toggle="modal" href="<?php echo base_url().'user/dashboard'; ?>">My Account</a>
          <?php } ?>
          </li>
         
          <li class="visible-xs visible-sm">

          <?php if($this->session->userdata('user_id')!="") { ?>
            <a data-toggle="modal" href="<?php echo base_url().'login/logout'; ?>">Logout</a>
          <?php } ?>
          </li>
     </ul>
     </div>
     </div>
 </div>



<!--<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
               <div class="alert-title">Welcome to the New Myroommate.ae Website Beta Version</div>
		<div>
		<p>Our previous users, we invite you please to reset your password by <a href="http://myroommate.ae//login/resetpassword">clicking here</a>.<br>
		Then you can Login, find what you need and all your listings.</p>
		<div>
                <div class="clearfix"></div>
             </div>
</div>
-->


 </header>

<meta name="google-site-verification" content="c43t1l5FfCDxl1I6kOwa4w7Dit8CDLzvC1yhqStFphM" />

 <script type="text/javascript">
$(document).ready(function(){
    $('.userlogin').click(function(){
        $('.login').click();
    });
});
</script>
