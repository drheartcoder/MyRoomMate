<div class="main-inner-gray">
    <div class="container"> 
        <div class="row">
            
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
                <div class="main-inner">

                    <form 
                      class=""
                      ng-init="user.confirm_code = '<?php echo $conf_code; ?>'";
                      name="ResetPassForm" 
                      novalidate 
                      ng-submit="ResetPassForm.$valid && processResetPass();">
    	
    					<input type="hidden" id="confirm_code" name="confirm_code" value="<?php echo $conf_code; ?>" ng-model="user.confirm_code" ng-minlength="5" ng-maxlength="20" required/>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="title-inner-page">Reset Password</div></div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div id="reset_success" class="success"></div>
                            <div id="reset_error" class="error"></div>
                            <br><br>
                            </div>
                            
                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.username.$touched && loginForm.username.$invalid }">
                                     <input type="text" class="input-box" name="username" id="username" ng-model="user.username" ng-minlength="5" ng-maxlength="20" required/>
                                     <span class="highlight"></span>
                                     <span class="bar"></span>
                                     <div id="err_register_username" class="error"></div>
                                     <div ng-messages="loginForm.username.$error" ng-if="loginForm.$submitted || loginForm.username.$touched">
                                     <div ng-messages-include="error-message.html"></div>
                                     </div>
                                     <label>Username</label>
                                  </div>
                             </div>

                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.firstname.$touched && loginForm.firstname.$invalid }">
                                     <input type="password" class="input-box" name="resetpassword1" id="resetpassword1" ng-model="user.firstname" ng-minlength="5" ng-maxlength="20" required/>
                                     <span class="highlight"></span>
                                     <span class="bar"></span>
                                     <div id="err_register_password1" class="error"></div>
                                     <div ng-messages="loginForm.firstname.$error" ng-if="loginForm.$submitted || loginForm.firstname.$touched">
                                     <div ng-messages-include="error-message.html"></div>
                                     </div>
                                     <label>New Password</label>
                                  </div>
                             </div>

                             <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.lastname.$touched && loginForm.lastname.$invalid }">
                                     <input type="password" class="input-box" name="resetpassword2" id="resetpassword2" ng-model="user.lastname" ng-minlength="5" ng-maxlength="20" required/>
                                     <span class="highlight"></span>
                                     <span class="bar"></span>
                                     <div id="err_register_password2" class="error"></div>
                                     <div ng-messages="loginForm.lastname.$error" ng-if="loginForm.$submitted || loginForm.lastname.$touched">
                                     <div ng-messages-include="error-message.html"></div>
                                     </div>
                                     <label>Confirm Password</label>
                                  </div>
                             </div>
                             <div class="clr"></div>
               
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="button-innerpage">
                                    <a href="#" id="reset-button-old">Save</a>
                                </div>
                            </div>
                 
                        </div>
                 
                    </form>
                </div>
            </div>     
        </div>
    </div> 
</div>