<div class="main-inner-gray">
    <div class="container">
     
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <?php $this->load->view('user/left-menu'); ?>         
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="main-inner">
                    <form name="loginForm" novalidate>
    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="title-inner-page">Edit Profile</div></div>
                                
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="edit_changepass_success" class="success"></div>
                                <div id="edit_changepass_error" class="error"></div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.username.$touched && loginForm.username.$invalid }">
                                    <input type="text" class="input-box" id="username" name="username"  <?php if(!empty($userdata[0]['username'])) { ?> ng-init="user.username='<?php echo $userdata[0]['username']; ?>'" value="<?php echo $userdata[0]['username']; ?>" <?php } ?> ng-model="user.username" ng-minlength="5" ng-maxlength="20" required="" ng-readonly="true" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_username" class="error"></div>
                                    <div ng-messages="loginForm.username.$error" ng-if="loginForm.$submitted || loginForm.username.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label style=" color: #333; font-size: 12px; left: 0;   position: absolute;
    top: -16px;  transition: all 0.2s ease 0s;">Username</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.firstname.$touched && loginForm.firstname.$invalid }">
                                    <input type="text" class="input-box" id="firstname" name="firstname"  <?php if(!empty($userdata[0]['firstname'])) { ?> ng-init="user.firstname='<?php echo $userdata[0]['firstname']; ?>'" value="<?php echo $userdata[0]['firstname']; ?>" <?php } ?> ng-model="user.firstname" ng-minlength="5" ng-maxlength="20" required="" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_firstname" class="error"></div>
                                    <div ng-messages="loginForm.firstname.$error" ng-if="loginForm.$submitted || loginForm.firstname.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>First Name</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.lastname.$touched && loginForm.lastname.$invalid }">
                                    <input type="text" class="input-box" id="lastname" name="lastname"  <?php if(!empty($userdata[0]['lastname'])) { ?> ng-init="user.lastname='<?php echo $userdata[0]['lastname']; ?>'" value="<?php echo $userdata[0]['lastname']; ?>" <?php } ?> ng-model="user.lastname" ng-minlength="5" ng-maxlength="20" required="" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_lastname" class="error"></div>
                                    <div ng-messages="loginForm.lastname.$error" ng-if="loginForm.$submitted || loginForm.lastname.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Last Name</label>
                                </div>
                            </div>
                            <div class="clr"></div>
               
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.email.$touched && loginForm.email.$invalid }">
                                    <input type="email" class="input-box" id="email" name="email"  <?php if(!empty($userdata[0]['email'])) { ?> ng-init="user.email='<?php echo $userdata[0]['email']; ?>'" value="<?php echo $userdata[0]['email']; ?>" <?php } ?> ng-model="user.email" ng-minlength="5" ng-maxlength="20" required="" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_email" class="error"></div>
                                    <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Email Address</label>
                                </div>
                            </div>
                 
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.mobile_number.$touched && loginForm.mobile_number.$invalid }">
                                    <input type="text" class="input-box" id="mobile_number" name="mobile_number"  <?php if(!empty($userdata[0]['mobile_number'])) { ?> ng-init="user.mobile_number='<?php echo $userdata[0]['mobile_number']; ?>'" value="<?php echo $userdata[0]['mobile_number']; ?>" <?php } ?> ng-model="user.mobile_number" ng-minlength="5" ng-maxlength="20" required="" />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_mobile_number" class="error"></div>
                                    <div ng-messages="loginForm.mobile_number.$error" ng-if="loginForm.$submitted || loginForm.mobile_number.$touched">
                                        <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Mobile Phone Number</label>
                                </div>
                            </div>
                            <div class="clr"></div>
                 
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="select-bock-container">
                                    <select id="gender" name="gender">
                                        <option>Select Gender</option>
                                        <option value="male" <?php if($userdata[0]['gender'] == "male") { ?> selected="selected" <?php } ?>  >male</option>
                                        <option value="female" <?php if($userdata[0]['gender'] == "female") { ?> selected="selected" <?php } ?> >female</option>
                                    </select>
                                    <div id="err_gender" class="error"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.age.$touched && loginForm.age.$invalid }">
                                    <input type="text" class="input-box" id="age" name="age" <?php if(!empty($userdata[0]['age'])) { ?> ng-init="user.age='<?php echo $userdata[0]['age']; ?>'" value="<?php echo $userdata[0]['age']; ?>" <?php } ?> ng-model="user.age" ng-minlength="5" ng-maxlength="20" required/>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_age" class="error"></div>
                                    <div ng-messages="loginForm.age.$error" ng-if="loginForm.$submitted || loginForm.age.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Age</label>
                                </div>
                            </div>
                            <div class="clr"></div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="select-bock-container form-group">

                                    <select id="country" name="country">
                                        <option value="">Select Country</option>
                                       <?php foreach($fetchcountry as $country) { ?>
                                         <option <?php if($userdata[0]['nationality'] == $country['country_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                                       <?php } ?>
                                    </select>

                                    <div id="err_country" class="error"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="select-bock-container form-group" >
                                
                                    <select id="countryofresidence" name="countryofresidence">
                                        <option value="">Select Residence</option>
                                        <?php foreach($fetchresidence as $residence) { ?>
                                          <option <?php if($userdata[0]['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="clr"></div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.address.$touched && loginForm.address.$invalid }">
                                
                                    <textarea cols="" class="input-box textarea-txt" id="address" name="address" rows="" <?php if(!empty($userdata[0]['address'])) { ?> ng-init="user.address='<?php echo $userdata[0]['address']; ?>'" value="<?php echo $userdata[0]['address']; ?>" <?php } ?> ng-model="user.address" ng-minlength="5" ng-maxlength="20" required></textarea>
                                      
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div id="err_countryofresidence" class="error"></div>
                                    <div ng-messages="loginForm.address.$error" ng-if="loginForm.$submitted || loginForm.address.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Address</label>
                                     
                                </div>
                            </div>
                            <div class="clr"></div>
                  
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="button-innerpage">
                                    <a href="javascript:void(0)" id="edti-profile" name="edti-profile">Save</a>
                                </div>
                            </div>

                        </div>
                    </form>
             
                </div>
            </div>
     
        </div>
    </div> 
</div>