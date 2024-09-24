<footer>
   <div class="container">
      <div class="row">
         <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="footer-block">
               <?php $page_home = $this->master_model->getRecords('tbl_dynamic_pages',array('slug'=>'about-us','front_status'=>'1')); ?>
               <span class="footer-logo"> <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>front-asset/images/logo.png" class="img-responsive" alt="My Roommate"/></a></span>
               <?php echo mb_substr(strip_tags($page_home[0]['page_description']),0,250,'utf-8'); ?>...
               <a href="<?php echo base_url();?>cms/view/<?php echo $page_home[0]['slug']; ?>" class="read-more">Read More</a>

               <?php $social=$this->master_model->getRecords('tbl_social'); ?>
               <ul>
                  <li class="fb"><a href="<?php echo $social[0]['facebook_link']; ?>">&nbsp;</a></li>
                  <li class="twitter"><a href="<?php echo $social[0]['twitter_link']; ?>">&nbsp;</a></li>
                  <li class="google-plus"><a href="<?php echo $social[0]['googleplus_link']; ?>">&nbsp;</a></li>
               </ul>
               
                              <a href="https://play.google.com/store/apps/details?id=com.app.myroommate"> <img src="images/andriodlogo.jpg" height="50px">
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="footer-block">
               <h4 value="Toggle Second" data-slide-toggle="#box1" data-slide-toggle-duration="1000">User Testimonials<span class="angel-icon"> <i class="fa fa-angle-right"></i></span></h4>
               <div class="sub_menu submenu" id="box1">
                  <?php 
                     $where=array('testimonials_status'=>1,'testimonials_front_status'=>1);
                     $this->db->order_by('testimonials_id','RANDOM');
                     $this->db->limit(1);
                     $testimonials = $this->master_model->getRecords('tbl_testimonials_master',$where);
                     ?>
                  <div class="testi">
                    <!--  <p><?php echo $testimonials[0]['testimonials_name_en']; ?> </p> -->
                     <h6>- <?php echo $testimonials[0]['testimonials_added_by']; ?></h6>
                  </div>
                  <div class="testi">
                     <?php echo $testimonials[0]['testimonials_description_en']; ?>
                     <!-- <h6>- Riccard from Dubai</h6> --> 
                  </div>
                  <a href="<?php echo base_url().'testimonial/testimonialdetails'?>">View All</a>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="footer-block">
               <h4 value="Toggle Second" data-slide-toggle="#box2" data-slide-toggle-duration="1000">Latest Listing<span class="angel-icon"> <i class="fa fa-angle-right"></i></span></h4>
               <div class="sub_menu submenu" id="box2">
                <?php
                $where_arr=array('status'=>1,'is_delete'=>'0', 'payment_type' => 'free');
                $this->db->order_by("id","desc");
                $this->db->limit(3);
                $data['latestlisting']=$this->master_model->getRecords('tbl_addlisting',$where_arr);

                ?>
                <?php if(count($data['latestlisting'])>0)
                { 
                    ?>
                    <?php foreach( $data['latestlisting'] as $data)
                    {
                     
                    ?>
                    <div class="latest-rooms">
                        <span class="foo-img"> <?php if(!empty($data['mainphoto']) && file_exists('uploads/addlisting_images/'.$data['mainphoto'])){
                         ?><img width='62px' height='61px' src="<?php echo base_url().'uploads/addlisting_images/'.$data['mainphoto'];?>" alt=""/><?php
                        } else {
                        ?><img width='62px' height='61px' src="http://192.168.1.7/myroommate/front-asset/images/default-thumbnail.jpg" alt=""/>
                        <?php } ?></span>
                        <div class="room-desc">
                        <p>
                           <a href="<?php echo base_url().'listing/details/'.$data['slug'] ?>">
                              <!-- family room for rent family room for rent -->
                              <?php echo ucwords($data['title']);?>
                           </a>
                        </p>
                        <h6>
                           <span>Listed On:</span> <!-- 29 March 2017 --><?php echo
                              date("d F Y", strtotime($data['created_date']));?>
                        </h6>
                        <h5>Rent/Price (AED) 
                           <span>
                           <?php echo $data['price']; ?>
                           </span>
                        </h5>
                        </div>
                    </div>
                  <?php }?> 
                <?php } else { ?>
                <?php  echo"No Record Found";?>
                <?php } ?>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="footer-block">
               <h4 value="Toggle Second" data-slide-toggle="#box3" data-slide-toggle-duration="1000">Latest Featured<span class="angel-icon"> <i class="fa fa-angle-right"></i></span></h4>
               <div class="sub_menu submenu" id="box3">
                 <?php
                $where_arr=array('status'=>1,'is_delete'=>'0', 'payment_type' => 'paid');
                $this->db->order_by("id","desc");
                $this->db->limit(3);
                $data['latestlisting']=$this->master_model->getRecords('tbl_addlisting',$where_arr);

                ?>
                <?php if(count($data['latestlisting'])>0)
                { 
                    ?>
                    <?php foreach( $data['latestlisting'] as $data)
                    {
                     
                    ?>
                    <div class="latest-rooms">  
                        <span class="foo-img"><img width='62px' height='61px' src="<?php echo base_url().'uploads/addlisting_images/'.$data['mainphoto'];?>" alt=""/></span>
                        <div class="room-desc">
                        <p>
                           <a href="<?php echo base_url().'listing/details/'.$data['slug'] ?>">
                              <!-- family room for rent family room for rent -->
                              <?php echo ucwords($data['title']);?>
                           </a>
                        </p>
                        <h6>
                           <span>Listed On:</span> <!-- 29 March 2017 --><?php echo
                              date("d F Y", strtotime($data['created_date']));?>
                        </h6>
                        <h5>Rent/Price (AED) 
                           <span>
                           <?php echo $data['price']; ?>
                           </span>
                        </h5>
                        </div>
                    </div>
                  <?php }?> 
                <?php } else { ?>
                <?php  echo"No Record Found";?>
                <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </div>
</footer>
<div class="copyright">
   <div class="container">
      <p>Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved. MyRoommate 2017 <span> <a href="<?php echo base_url().'cms/view/terms-conditions';?>" class="copyrights">Terms & Conditions</a> | <a href="<?php echo base_url().'cms/view/about-us'; ?>">About Us</a>

</span></p>
   </div>
</div>

<!--login modal start here-->
<div id="login" class="modal fade popup-cls" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url(); ?>/front-asset/images/close.png" alt="" /></button>
            <div class="login-modal">
               <div class="login-form">
                  <h1>Log In</h1>
                  <h5>Log in to your Account</h5>
                  <div id="login_success" class="success"></div>
                  <div id="login_error" class="error"></div>
                  <form id="loginForm" name="loginForm" method="POST" novalidate>
                     <input type="hidden" class="input-box" id="page_url" name="page_url" value="<?php echo current_url();?>"/>
                     <input type="hidden" class="input-box" id="page_url_segment" name="page_url_segment" value="<?php echo $this->uri->segment(1);?>"/>
                     <!--username start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.username.$touched && loginForm.username.$invalid }">
                        <input type="text" class="input-box" id="username" name="username" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_login_username" class="error"></div>
                        <div ng-messages="loginForm.username.$error" ng-if="loginForm.$submitted || loginForm.username.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Username or Email Address</label>
                     </div>
                     <!--email start here-->
                     <!-- <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                        <input type="email" class="input-box" id="email" name="email" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_login_email" class="error"></div>
                        <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Email</label>
                     </div> -->
                     <!--password start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.password.$touched && loginForm.password.$invalid }">
                        <input type="password" class="input-box" id="password" name="password" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_login_password" class="error"></div>
                        <div ng-messages="loginForm.password.$error" ng-if="loginForm.$submitted || loginForm.password.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Password</label>
                     </div>

                     <a href="<?php echo base_url(); ?>/login/resetpassword">Reset Password?</a>
                     
                     <button class="hvr-rectangle-out orng-btn" type="submit" id="login-button" name="login-button">Login</button>
                     <!--   <button class="hvr-rectangle-out orng-btn" type="submit">Login</button>-->
                     <!--  <button class="con-fb btn_gp_reg goog-btn-block" onclick="GoogleLogin('Client')" type="button">
                       <span><img class="img-icon-block" src="<?php echo base_url(); ?>images/con-gle.png" alt="google img" /></span> 
                     </button> -->
                  </form>
               </div>
               <div class="forget-block">
                  <h5><a data-toggle="modal" href="#forget"  data-dismiss="modal">Forget Password?</a></h5>
                  <a class="regi-text" data-toggle="modal" href="#signup" data-dismiss="modal">Register an Account</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--login modal end here-->
<!--signup modal start here-->
<div id="signup" class="modal fade popup-cls" role="dialog" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" id="close"><img src="<?php echo base_url(); ?>front-asset/images/close.png" alt="" /></button>
            <div class="login-modal">
               <div class="login-form">
                  <h1>Sign Up</h1>
                  <h5>Register with your Details</h5>
                  <div id="register_success" class="success"></div>
                  <div id="register_error" class="error"></div>
                  <form id="registerForm" name="registerForm" method="POST" novalidate>
                     <input type="hidden" class="input-box" id="page_url" name="page_url" value="<?php echo current_url();?>"/>
                     <input type="hidden" class="input-box" id="page_url_segment" name="page_url_segment" value="<?php echo $this->uri->segment(1);?>"/>
                     <!--username start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.username.$touched && loginForm.username.$invalid }">
                        <input type="text" class="input-box check_username space_restrict beginningSpace_restrict" id="registerusername" name="registerusername" ng-model="user.username" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_username" class="error"></div>
                        <div ng-messages="loginForm.username.$error" ng-if="loginForm.$submitted || loginForm.username.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Username</label>
                     </div>

                  <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.firstname.$touched &amp;&amp; loginForm.firstname.$invalid }">
                        <input class="input-box ng-pristine ng-valid ng-not-empty ng-valid-required ng-valid-minlength ng-valid-maxlength ng-touched" id="firstname" name="firstname" ng-model="user.firstname" ng-minlength="5" ng-maxlength="20" required="" style="" type="text">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_firstname" class="error"></div>
                        <!-- ngIf: loginForm.$submitted || loginForm.firstname.$touched -->
                        <label>First Name</label>
                    </div>

                    <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.lastname.$touched &amp;&amp; loginForm.lastname.$invalid }">
                        <input class="input-box ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required ng-valid-minlength ng-valid-maxlength" id="lastname" name="lastname" ng-model="user.lastname" ng-minlength="5" ng-maxlength="20" required="" type="text">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_lastname" class="error"></div>
                        <!-- ngIf: loginForm.$submitted || loginForm.lastname.$touched -->
                        <label>Last Name</label>
                    </div>

                     <!--email start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                        <input type="email" class="input-box" id="registeremail" name="registeremail" ng-model="user.email" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_email" class="error"></div>
                        <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Email</label>
                     </div>


                     <!--Mobile Number start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.mobile_number.$touched &amp;&amp; loginForm.mobile_number.$invalid }">
                        <input class="input-box ng-pristine ng-valid ng-not-empty ng-valid-required ng-valid-minlength ng-valid-maxlength ng-touched" id="mobile_number" name="mobile_number" ng-model="user.mobile_number" ng-minlength="5" ng-maxlength="20" required="" style="" type="text">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_mobile_number" class="error"></div>
                        <!-- ngIf: loginForm.$submitted || loginForm.mobile_number.$touched -->
                        <label>Mobile Phone Number</label>
                    </div>
                     <!--Mobile number start here-->

                     <?php 

                        $where = array('is_delete'=>'0','country_status'=>'1');
                        $fetchcountry = $this->master_model->getRecords('tbl_country_master',$where);

                     ?>


                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.gender.$touched && loginForm.gender.$invalid }">
                        <select id="gender" name="gender" class="frm-select form-control check_username" required/>
                            <option value="">Select Gender</option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_gender" class="error"></div>
                        <div ng-messages="loginForm.gender.$error" ng-if="loginForm.$submitted || loginForm.gender.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                       
                     </div>
                     

                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                      <select id="country" name="country" class="frm-select form-control check_username" required/>
                          <option value="">Select Country</option>
                          <?php foreach($fetchcountry as $country) { ?>
                            <option value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                          <?php } ?>
                      </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_country" class="error"></div>
                        <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        
                     </div>
                     <!--password start here-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.password.$touched && loginForm.password.$invalid }">
                        <input type="password" class="input-box space_restrict beginningSpace_restrict" id="registerpassword1" name="registerpassword1" ng-model="user.password" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_password1" class="error"></div>
                        <div ng-messages="loginForm.password.$error" ng-if="loginForm.$submitted || loginForm.password.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Password</label>
                     </div>
                     <!--confirm password-->
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.password2.$touched && loginForm.password2.$invalid }">
                        <input type="password" class="input-box space_restrict beginningSpace_restrict" id="registerpassword2" name="registerpassword2" ng-model="user.password2" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_register_password2" class="error"></div>
                        <div ng-messages="loginForm.password2.$error" ng-if="loginForm.$submitted || loginForm.password2.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Confirm Password</label>
                     </div>
                     <!--register button-->
                     <button class="hvr-rectangle-out orng-btn" type="submit" id="register-button" name="register-button">Register</button>
                  </form>
               </div>
               <div class="forget-block">
                  <p>Already have an account ? <a data-toggle="modal" href="#login" data-dismiss="modal">Log In</a></p>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--signup modal end here-->
<!--Fotget modal start here-->
<div id="forget" class="modal fade popup-cls" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url(); ?>front-asset/images/close.png" alt="" /></button>
            <div class="login-modal">
               <div class="login-form">
                  <h1>Forgot Password</h1>
                  <!--<h5>Log into your Account</h5>-->
                  <form id="forgotform" name="forgotform" method="POST" novalidate>
                     <input type="hidden" class="input-box" id="page_url" name="page_url" value="<?php echo current_url();?>"/>
                     <input type="hidden" class="input-box" id="page_url_segment" name="page_url_segment" value="<?php echo $this->uri->segment(1);?>"/>
                     <!--email start here-->
                     <p class="txt-forget">
                        Forgot your password? Please enter your email id to get your password
                     </p>
                     <div id="forgot_success" class="success"></div>
                     <div id="forgot_error" class="error"></div>
                     <div class="form-group input-box-w" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                        <input type="email" class="input-box" id="forgotemail" name="forgotemail" ng-model="user.email" ng-minlength="5" ng-maxlength="20" required/>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <div id="err_forgot_email" class="error"></div>
                        <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                           <div ng-messages-include="error-message.html"></div>
                        </div>
                        <label>Email</label>
                     </div>
                     <button class="hvr-rectangle-out orng-btn" type="submit" id="forgot-button" name="forgot-button">Submit</button>
                  </form>
               </div>
               <div class="forget-block">
                  <h5><a data-toggle="modal" href="#signup"  data-dismiss="modal">Sign Up?</a></h5>
                  <a class="regi-text" data-toggle="modal" href="#login" data-dismiss="modal">Log In</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Fotget modal end here-->

<!--range slider-->
<link href="<?php echo base_url(); ?>front-asset/css/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url(); ?>front-asset/css/range-slider.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>front-asset/js/jquery-ui.js" type="text/javascript"></script>
<div style="display:none">
      Website Developed and Design By <a href="http://www.webwingtechnologies.com"> Webwing Technologies </a>
      </div>
<script type="text/javascript">
  $('#close').click(function()
  {
      $('input:text').val("");  
      $('input:password').val("");
      $('#registeremail').val("");
      $('#gender').val("");
      $('#country').val("");
      $('.error').html("");
  });
   (function() {
     var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
     po.src = 'https://apis.google.com/js/client.js?onload=initGoogleAuth';
     var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

  function initGoogleAuth()
  {
      gapi.client.setApiKey('RdBIbqJW0ek125FQ8rJW9L-N'); //set your API KEY
      gapi.client.load('plus', 'v1',function(){});//Load Google + API
  }
  function GoogleLogin() 
  {
    
    var myParams = {
      'clientid' : '635517288541-i23pm6rre2o5iqlpa92ii3b3pp9rn3gc.apps.googleusercontent.com', // You need to set client id
      'cookiepolicy' : 'single_host_origin',
      'callback' : 'GoogleLoginCallback', //callback function
      'approvalprompt':'force',
      'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
    };
    //console.log(gapi.auth.signIn(myParams));
    
    gapi.auth.signIn(myParams);
    var baseUrl = '<?php echo base_url(); ?>'
    
    $.ajax({
              url:baseUrl+'/newroommate/login/login',
              type:'POST',
              data:{type:res},
              dataType:'json',
              cache:false,
              success:function(res)
              {
                  //alert(res);
                  return ;
              },
           });


  }
  function GoogleLogout()
  { 
    $.ajax({
              url:'https://accounts.google.com/Logout',
              type:'GET',
              dataType:'json',
              cache:false,
              success:function()
              {
                  return ;
              },
           });   
  }
  function GoogleLoginCallback(result)
  {
      
      if(result['status']['signed_in'])
      { 
          var request = gapi.client.plus.people.get(
          {
              'userId': 'me'
          });
      
      request.execute(function (resp)
      {
         
          var email = '';
          if(resp['emails'])
          {
              for(i = 0; i < resp['emails'].length; i++)
              {
                  if(resp['emails'][i]['type'] == 'account')
                  {
                      email = resp['emails'][i]['value'];
                  }
              }
          }
          
          var name   = resp['displayName'];
          var image  = resp['image']['url'];
          var id    =  resp['id'];
           
          $.ajax({url : site_url+'signup/common_registration',
                  type : 'post',
                  data : {email:email,name:name},
                  //dataType : 'json',
                  success : function(resp)
                  {
                     //console.log(resp);
                     var json = $.parseJSON(resp); 
                     //alert(json.result);
                     if(json.result=="success" )
                      {
                        //alert('success');
                        window.location.href=json.redirect_url;
                      }
                      else if(json.result=="reload")
                      {
                        //alert('reload');
                        window.location.reload(true);
                      }
                      else if(json.result=="block_user")
                      {
                        jQuery("#show_error").html("<div class='alert alert-danger'>Sorry Your Account Is Blocked.</div>").show().fadeOut(14000);
                        jQuery("#show_error1").html("<div class='alert alert-danger'>Sorry Your Account Is Blocked.</div>").show().fadeOut(14000);
                      }
                      else
                      {
                        //alert('default');
                        window.location.reload();
                      }
                  
                 },
            });
        });
      }   
   
  }




</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35816976-1', 'auto');
  ga('send', 'pageview');

</script>
