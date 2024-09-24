<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo PROJECT_NAME; ?> - Admin Login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <!--base css styles-->
  <link rel="icon" href="<?php echo base_url(); ?>images/fevicon/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap.min.css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/font-awesome.min.css" media="screen" />
  <!--page specific css styles-->
  <!--flaty css styles-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/flaty.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/flaty-responsive.css" />
  <script type="text/javascript">var siteUrl = '<?php echo base_url(); ?>';</script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/login.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.alphanum.js"></script>
  <SCRIPT TYPE="text/javascript">

  function submitenter(myfield,e)
  {
	  myfield=document.getElementById("form-login");

	  if (window.event) 
	  keycode = window.event.keyCode;
	  else if (e) 
	  keycode = e.which;
	  else return true;

	  if (keycode == 13)
	  {
		  $('#btnDoLogin').click();
		  return false;
	  }
	  else
	  return true;
  }

  </SCRIPT>

</head>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/bootstrap.min.css"> <!-- style css -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/responsive.css">
<style type="text/css">
    
</style>
<body>

 <!-- Start Coming Soon Page One -->
            <div class="comming-soon-area text-center">
                <div class="display-table">
                    <div class="display-table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                     

                                    <div class="" style="margin: 0 auto;  width: 340px; ">
                                              <div class="col-md-12" style="background-color: #fff !important;  padding: 20px !important;">
                                                <!-- BEGIN Main Content -->
                                                <div class="login-wrapper container login-page">


                                                    <!-- BEGIN Login Form -->
                                                    <form id="form-login" action="" method="post" onsubmit="javascript:return false;" onKeyPress="return submitenter(this,event)">
                                                      

                                                      <?php  
                                                      if($this->session->flashdata('error')!=''){  ?>
                                                      <div class="alert alert-danger">
                                                      <button class="close" data-dismiss="alert">×</button>
                                                      <?php echo $this->session->flashdata('error'); ?>
                                                      </div>
                                                      <?php } 
                                                      if($this->session->flashdata('success')!=''){?>
                                                      <div class="alert alert-success">
                                                      <button class="close" data-dismiss="alert">×</button>
                                                      <?php echo  $this->session->flashdata('success'); ?>
                                                      </div>
                                                      <?php } ?> 


                                                      <div class="afterLogin" style="display:none;">Error message comes here</div>
                                                      <h3>Login to your account</h3>
                                                      <hr/>
                                                      <div class="beforeLogin"> 
                                                        <div class="form-group">
                                                          <div class="controls">
                                                           <input type="text" placeholder="Username" class="form-control" name="txtUsername" id="txtUsername" tabindex="1" />
                                                         </div>
                                                       </div>
                                                       <div class="form-group">
                                                        <div class="controls">
                                                         <input type="password" placeholder="Password" class="form-control" name="txtPassword" id="txtPassword" tabindex="2" />
                                                       </div>
                                                     </div>
                                                     <div class="form-group">
                                                      <div class="controls">
                                                        <button type="button" class="btn btn-primary form-control" name="btnDoLogin" id="btnDoLogin" tabindex="3">Login</button>
                                                      </div>
                                                    </div>
                                                    <hr/>
                                                    <p class="clearfix">
                                                      <a href="javascript:void(0);" class="goto-forgot pull-left">Forgot Password?</a> 
                                                    </p>
                                                    </div>
                                                    </form>




                                                    <!-- END Login Form --> 
                                                    <!-- BEGIN Forgot Password Form -->
                                                    <form id="form-forgot" action="" method="post" style="display:none"  onsubmit="javascript:return false;">
                                                    <h3>Get back your password</h3>
                                                    <hr/>
                                                    <div class="_afterLogin" style="display:none;">Error message comes here</div>
                                                    <div class="_beforeLogin">
                                                      <div class="form-group">
                                                        <div class="controls">
                                                         <input type="text" placeholder="Email" class="form-control" name="txtEmail" id="txtEmail" tabindex="4" />
                                                       </div>
                                                     </div>
                                                     <div class="form-group">
                                                      <div class="controls">
                                                       <button type="button" class="btn btn-primary form-control" name="btnGetPwd" id="btnGetPwd" tabindex="5">Recover</button>
                                                     </div>
                                                    </div>
                                                    <hr/>
                                                    <p class="clearfix"> <a href="javascript:void(0);" class="goto-login pull-left">← Back to login form</a> </p>
                                                    </div>
                                                    </form>
                                                <!-- END Forgot Password Form --> 
                                                </div>
                                                <!-- END Main Content -->
                                              </div>
                                    </div>
                                    


                               </div>
                            </div>
                      </div>
                    </div>
                </div>
            </div>
<!-- End Coming Soon Page One -->

</body>
</html>