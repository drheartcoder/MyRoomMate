
 
    <div class="main-inner-gray">
 <div class="container">
     
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
           
             <?php $this->load->view('user/left-menu'); ?>  
             
             
         </div>
         <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            <div class="main-inner">
             <form name="changepasswordForm" id="changepasswordForm" novalidate>
    
             <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="title-inner-page">Change Password</div></div>
                    
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="form-group input-box-w inner-inpt">
                    <div id="edit_changepass_success" class="success"></div>
                    <div id="edit_changepass_error" class="error"></div>
                    </div>
                </div>

                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.oldpassword.$touched && loginForm.oldpassword.$invalid }">
                         <input type="text" class="input-box" name="oldpassword" id="oldpassword" ng-model="user.oldpassword" ng-minlength="5" ng-maxlength="20" required/>
                         <span class="highlight"></span>
                         <span class="bar"></span>
                         <div id="err_oldpassword" class="error"></div>
                         <div ng-messages="loginForm.oldpassword.$error" ng-if="loginForm.$submitted || loginForm.oldpassword.$touched">
                         <div ng-messages-include="error-message.html"></div>
                         </div>
                         <label>Old Password</label>
                      </div>
                 </div>
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.newpassword.$touched && loginForm.newpassword.$invalid }">
                         <input type="text" class="input-box" name="newpassword" id="newpassword" ng-model="user.newpassword" ng-minlength="5" ng-maxlength="20" required/>
                         <span class="highlight"></span>
                         <span class="bar"></span>
                         <div id="err_newpassword" class="error"></div>
                         <div ng-messages="loginForm.newpassword.$error" ng-if="loginForm.$submitted || loginForm.newpassword.$touched">
                         <div ng-messages-include="error-message.html"></div>
                         </div>
                         <label>New Password</label>
                      </div>
                 </div>
               
                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.confirmnewpassword.$touched && loginForm.confirmnewpassword.$invalid }">
                         <input type="text" class="input-box" name="confirmnewpassword" id="confirmnewpassword" ng-model="user.confirmnewpassword" ng-minlength="5" ng-maxlength="20" required/>
                         <span class="highlight"></span>
                         <span class="bar"></span>
                         <div id="err_confirmnewpassword" class="error"></div>
                         <div ng-messages="loginForm.confirmnewpassword.$error" ng-if="loginForm.$submitted || loginForm.confirmnewpassword.$touched">
                         <div ng-messages-include="error-message.html"></div>
                         </div>
                         <label>Confirm New Password</label>
                      </div>
                 </div>
                            
                 <div class="clr"></div>
                  
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="button-innerpage">
                         <a href="javascript:void(0);" id="changepassword" name="changepassword">Update</a>
                     </div>
                 </div>
                 
                 
             </div>
             
             
             
            </form>
             
         </div>
         </div>
     
 </div>
</div> 

    </div>
