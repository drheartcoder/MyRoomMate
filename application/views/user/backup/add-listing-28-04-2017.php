<div class="main-inner-gray">
    <div class="container">
     
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <?php $this->load->view('user/left-menu'); ?>  
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="main-inner">
                    <form method="POST" id="addlistingform" name="addlistingform" novalidate>
    
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div class="title-inner-page">Add Listing</div></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt">
                                    <div class="title-redios">Categories</div>
                                    <div class="select-bock-container">
                                    
                                    <!-- <div id="err_other" class="error"></div> -->

                                    <select class="form-control" id="category_name" name="category_name" displayerror="category">
                                        <option value="">Select Category</option>
                                        <?php foreach($fetchcategory as $category) { ?>
                                          <?php if ($category['parent_id'] == '0') { ?>
                                          <option class="lavel1" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                          <?php } else { ?>
                                          <option class="lavel2" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                          <?php } ?>
                                        <?php } ?>
                                    </select>

                                    <div class="error"></div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.title.$touched &amp;&amp; loginForm.title.$invalid }">
                                    <input displayerror="Title" class="input-box" id="title" name="title" ng-model="user.title" ng-minlength="5" ng-maxlength="20" required="" type="text">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.title.$error" ng-if="loginForm.$submitted || loginForm.title.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Title</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.adddescription.$touched &amp;&amp; loginForm.adddescription.$invalid }">
                                    <textarea displayerror="Description" name="adddescription" id="adddescription" cols="" class="input-box textarea-txt" rows="" ng-model="user.adddescription" ng-minlength="5" ng-maxlength="20" required=""></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.adddescription.$error" ng-if="loginForm.$submitted || loginForm.adddescription.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Description</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                 <div class="form-group input-box-w">
                                  <!--image upload start here-->
                                    <div ng-controller="uploadImage">
                                         <div class="profile-pic">
                                           <div class="row">
                                               <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                               <div class="col-sm-12 col-md-7 col-lg-9">
                                                    <input displayerror="Main Photo" onchange="loadFile(event)" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = '../images/user.png'" name="mainphoto" id="mainphoto" />
                                                    <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> mainphoto</button>
                                                    <div class="error"></div>
                                               </div>
                                           </div>
                                          </div>
                                        <!--image upload end here-->
                                     </div>
                                  </div>
                             </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.mobilenumber.$touched &amp;&amp; loginForm.mobilenumber.$invalid }">
                                    <input displayerror="Mobile Number" class="input-box" id="mobilenumber" name="mobilenumber" ng-model="user.mobilenumber" ng-minlength="5" ng-maxlength="20" required="" type="text">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.mobilenumber.$error" ng-if="loginForm.$submitted || loginForm.mobilenumber.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Mobile Number</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.addemail.$touched &amp;&amp; loginForm.addemail.$invalid }">
                                    <input displayerror="Email" class="input-box" id="addemail" name="addemail" ng-model="user.addemail" ng-minlength="5" ng-maxlength="20" required="" type="text">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.addemail.$error" ng-if="loginForm.$submitted || loginForm.addemail.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Email</label>
                                </div>
                            </div>
                            

                            <div id="formbuild">
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="button-innerpage">
                                    <a href="javascript:void(0)" id="addlistingsubmit" name="addlistingsubmit">Submit</a>
                                </div>
                            </div>
                  
                        </div>
             
                    </form>
             
                </div>
            </div>
     
        </div>
    </div>
</div>