<!--    Payment Start Here-->
<link href="<?php echo base_url(); ?>front-asset/css/payment.css" rel="stylesheet" type="text/css" />
<!-- <script src="<?php //echo base_url(); ?>front-asset/js/payment.js" type="text/javascript"></script> -->
<!--    Payment End Here--> 

<div class="main-inner-gray">
    <div class="container">
     
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <?php $this->load->view('user/left-menu'); ?>  
            </div>

            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                
                <!-- check if listing id is pass or not -->
                <?php if($this->uri->segment(3) != '' ) { ?>

                <div class="main-inner">
                    <form enctype="multipart/form-data" method="POST" id="editlistingform" name="editlistingform" action="<?php echo base_url(); ?>user/update_mylisting" novalidate>
    
                        <div class="row" id="add_listing_form">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="title-inner-page">Edit Listing</div>
                                <p>Note: All Fields are Compulsory</p>
                                </br>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="edit_success" class="success"></div>
                                <div id="edit_error" class="error"></div>
                            </div>

                            <?php
                            if ( count($mylisting_data) > 0)
                            {
                                //echo "<pre>";print_r($mylisting_data);exit;

                                // check listisng image
                                if ( isset($mylisting_data[0]['mainphoto']) && !empty($mylisting_data[0]['mainphoto']) )
                                {
                                    $listing_image = base_url().'uploads/addlisting_images/'.$mylisting_data[0]['mainphoto'];

                                    // check if image exists or not
                                    if ( !@getimagesize($listing_image) ) 
                                    {
                                        $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                    } // end if
                                } // end if
                                else
                                {
                                    $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                } // end else

                                $listing_id = $mylisting_data[0]['id'];
                            ?>

                            <input type="hidden" name="listing_id" id="listing_id" value="<?php echo $listing_id; ?>" />

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_category">
                                <div class="form-group input-box-w inner-inpt">
                                    <div class="title-redios">Categories</div>
                                    <div class="select-bock-container">
                                    
                                    <!-- <div id="err_other" class="error"></div> -->

                                    <select class="form-control" id="edit_category_name" name="category_name" displayerror="category">
                                        <optgroup label="">
                                        <option value="">Select Category</option>
                                        </optgroup>
                                        <?php foreach($fetchcategory as $category) 
                                        {
                                            ?>
                                            <optgroup label="<?php echo $category['category_name'];?>">

                                            <?php $where = array('parent_id'=> $category['category_id'],'is_delete'=>'0','category_status'=>'1');
                                                $childchildcat = $this->master_model->getRecords('tbl_category_master',$where); ?>
                                                
                                                <?php foreach($childchildcat as $value) 
                                                {
                                                    if ($value['parent_id'] == '0') 
                                                    {
                                                        if($value['category_id'] == $mylisting_data[0]['cat_id'])
                                                        {
                                                            ?>
                                                                <option class="lavel1" value="<?php echo $value['category_id'];?>" selected><?php echo $value['category_name'];?></option>
                                                            <?php
                                                        } // end if
                                                        else
                                                        {
                                                            ?>
                                                                <option class="lavel1" value="<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?></option>
                                                            <?php
                                                        } // end else
                                                    } // end if
                                                    else
                                                    {
                                                        if($value['category_id'] == $mylisting_data[0]['cat_id'])
                                                        {
                                                            ?>
                                                                <option class="lavel2" value="<?php echo $value['category_id'];?>" selected><?php echo $value['category_name'];?></option>
                                                            <?php
                                                        } // end if
                                                        else
                                                        {
                                                            ?>
                                                                <option class="lavel2" value="<?php echo $value['category_id'];?>"><?php echo $value['category_name'];?></option>
                                                            <?php
                                                        } // end else
                                                    } // end else
                                                }
                                                ?>
                                            </optgroup>
                                            <?php 
                                        } // end foreach
                                        ?>
                                    </select>

                                    <div class="error"></div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_title">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.title.$touched &amp;&amp; loginForm.title.$invalid }">
                                    <input displayerror="Title" class="input-box" id="title" name="title" ng-model="user.title <?php echo isset($mylisting_data[0]['title'])?$mylisting_data[0]['title']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($mylisting_data[0]['title'])?$mylisting_data[0]['title']:''; ?>">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.title.$error" ng-if="loginForm.$submitted || loginForm.title.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Title</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_desc">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.description.$touched &amp;&amp; loginForm.description.$invalid }">
                                    <textarea displayerror="Description" name="description" id="description" cols="" class="input-box textarea-txt" rows="" ng-model="user.description <?php echo isset($mylisting_data[0]['description'])?$mylisting_data[0]['description']:''; ?>" ng-minlength="5" ng-maxlength="20" required=""><?php echo isset($mylisting_data[0]['description'])?$mylisting_data[0]['description']:''; ?></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.description.$error" ng-if="loginForm.$submitted || loginForm.description.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Description</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_image">
                                 <div class="form-group input-box-w">
                                  <!--image upload start here-->
                                    <div ng-controller="uploadImage">
                                         <div class="profile-pic">
                                           <div class="row">
                                               <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="<?php echo $listing_image; ?>"  src="<?php echo $listing_image; ?>" ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                               <div class="col-sm-12 col-md-7 col-lg-9">
                                                    <input displayerror="Main Photo" onchange="loadFile(event)" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = '<?php echo $listing_image; ?>'" name="mainphoto" id="mainphoto" value="<?php echo $listing_image; ?>" ng-model="user.mainphoto <?php echo $listing_image; ?>"/>
                                                    <input type="hidden" name="img_value" id="img_value" value="<?php echo $mylisting_data[0]['mainphoto']; ?>" />
                                                    <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> mainphoto</button>
                                                    <div class="error"></div>
                                               </div>
                                           </div>
                                          </div>
                                        <!--image upload end here-->
                                     </div>
                                  </div>
                             </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_mobile">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.mobilenumber.$touched &amp;&amp; loginForm.mobilenumber.$invalid }">
                                    <input displayerror="Mobile Number" class="input-box" id="mobilenumber" name="mobilenumber" ng-model="user.mobilenumber <?php echo isset($mylisting_data[0]['mobile'])?$mylisting_data[0]['mobile']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($mylisting_data[0]['mobile'])?$mylisting_data[0]['mobile']:''; ?>">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.mobilenumber.$error" ng-if="loginForm.$submitted || loginForm.mobilenumber.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Mobile Number</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_email">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.email.$touched &amp;&amp; loginForm.email.$invalid }">
                                    <input displayerror="Email" class="input-box" id="email" name="email" ng-model="user.email <?php echo isset($mylisting_data[0]['email'])?$mylisting_data[0]['email']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($mylisting_data[0]['email'])?$mylisting_data[0]['email']:''; ?>">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.email.$error" ng-if="loginForm.$submitted || loginForm.email.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Email</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_country">
                             <div class="form-group input-box-w inner-inpt">
                                <div class="title-redios">Country</div>
                                <div class="select-bock-container">
                                   <select class="form-control" id="country" name="country" displayerror="country">
                                      <option value="">Select Country</option>
                                      <?php foreach($fetchcountry as $country) { ?>
                                         <option <?php if($mylisting_data['0']['country'] == $country['country_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                                       <?php } ?>
                                   </select>
                                   <div id="err_country" class="error"></div>
                                </div>
                             </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_countryofresidence">
                             <div class="form-group input-box-w inner-inpt">
                                <div class="title-redios">Residence</div>
                                <div class="select-bock-container">
                                   <select class="form-control" id="countryofresidence" name="countryofresidence" displayerror="residence">
                                      <option value="">Select Residence</option>
                                       <?php foreach($fetchresidence as $residence) { ?>
                                         <option <?php if($mylisting_data['0']['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>
                                       <?php } ?>
                                   </select>
                                   <div id="error_countryofresidence" class="error"></div>
                                </div>
                             </div>
                          </div>

                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_address">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.address.$touched &amp;&amp; loginForm.address.$invalid }">
                                    <textarea displayerror="Address" name="address" id="address" cols="" class="input-box textarea-txt" rows="" ng-model="user.address <?php echo isset($mylisting_data[0]['address'])?$mylisting_data[0]['address']:''; ?>" ng-minlength="5" ng-maxlength="20" required=""><?php echo isset($mylisting_data[0]['address'])?$mylisting_data[0]['address']:''; ?></textarea>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.address.$error" ng-if="loginForm.$submitted || loginForm.address.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Address</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_price">
                                <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.price.$touched &amp;&amp; loginForm.price.$invalid }">
                                    <input displayerror="Price" class="input-box" id="price" name="price" ng-model="user.price <?php echo isset($mylisting_data[0]['price'])?$mylisting_data[0]['price']:''; ?>" ng-minlength="5" ng-maxlength="20" required="" type="text" value="<?php echo isset($mylisting_data[0]['price'])?$mylisting_data[0]['price']:''; ?>">
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <div class="error"></div>
                                    <div ng-messages="loginForm.price.$error" ng-if="loginForm.$submitted || loginForm.price.$touched">
                                    <div ng-messages-include="error-message.html"></div>
                                    </div>
                                    <label>Price</label>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="error_availability">
                                <div class="form-group input-box-w inner-inpt">
                                    <div class="title-redios">Availability</div>
                                    <div class="select-bock-container">
                                    
                                    <!-- Get value from database -->
                                    <?php $availability = isset($mylisting_data[0]['availability'])?$mylisting_data[0]['availability']:''; ?>

                                    <select class="form-control" id="availability" name="availability" displayerror="Availability">
                                        <option value="">Select Availability</option>
                                        <option value="Immediately" <?php if($availability == 'Immediately') { echo 'selected'; } ?> >Immediately</option>
                                        <option value="Within1Week" <?php if($availability == 'Within1Week') { echo 'selected'; } ?> >Within 1 Week</option>
                                        <option value="Within1Month" <?php if($availability == 'Within1Month') { echo 'selected'; } ?> >Within 1 Month</option>
                                        <option value="Within3Months" <?php if($availability == 'Within3Months') { echo 'selected'; } ?> >Within 3 Months</option>
                                        <option value="Within6Months" <?php if($availability == 'Within6Months') { echo 'selected'; } ?> >Within 6 Months</option>
                                    </select>

                                    <div class="error"></div>

                                    </div>
                                </div>
                            </div>

                            <div id="formbuild">

                            <?php 
                                if(count($catoptions) > 0 )
                                {
            
                                    foreach ($catoptions as $key => $value) {
                                        
                                        if($value['fields_type'] == 'text') {
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                                                <input displayerror="<?php echo $value['attribute_name']; ?>" type="text" class="input-box" id="<?php echo $value['attribute_slug']; ?>" name="<?php echo $value['attribute_slug']; ?>" ng-model="user.<?php echo $value['attribute_slug']; ?> <?php echo $value['attribute_value']; ?>" value="<?php echo $value['attribute_value']; ?>" ng-minlength="5" ng-maxlength="20" required/>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <div class="error"></div>
                                                <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                                                <div ng-messages-include="error-message.html"></div>
                                                </div>
                                                <label><?php echo $value['attribute_name']; ?></label>
                                            </div>
                                        </div>
                                        <?php 
                                        }

                                        if($value['fields_type'] == 'textarea') {
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group input-box-w inner-inpt" ng-class="{ 'has-error': loginForm.<?php echo $value['attribute_slug']; ?>.$touched && loginForm.<?php echo $value['attribute_slug']; ?>.$invalid }">
                                                <textarea displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" cols="" class="input-box textarea-txt" rows=""  ng-init="user.<?php echo $value['attribute_slug']; ?>='Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur rem beatae fuga tempora'" ng-model="user.<?php echo $value['attribute_slug']; ?> <?php echo $value['attribute_value']; ?>" ng-minlength="5" ng-maxlength="20" value="<?php echo $value['attribute_value']; ?>" required></textarea>
                                                <span class="highlight"></span>
                                                <span class="bar"></span>
                                                <div class="error"></div>
                                                <div ng-messages="loginForm.<?php echo $value['attribute_slug']; ?>.$error" ng-if="loginForm.$submitted || loginForm.<?php echo $value['attribute_slug']; ?>.$touched">
                                                <div ng-messages-include="error-message.html"></div>
                                                </div>
                                                <label><?php echo $value['attribute_name']; ?></label>
                                            </div>
                                        </div>
                                        <?php 
                                        }

                                        if($value['fields_type'] == 'selectlist') {
                                        $options =  explode('|', $value['fields_elements']);    
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                         <div class="form-group input-box-w inner-inpt">
                                         <div class="select-bock-container">
                                                <select displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>">
                                                    <option value="">Select <?php echo $value['attribute_name']; ?></option>
                                                    <?php 
                                                        foreach($options as $opt => $option) { 
                                                            if($value['attribute_value'] == $option)
                                                            {
                                                                ?>
                                                                    <option class="lavel2" value="<?php echo $option;?>" selected><?php echo $option;?></option>
                                                                <?php
                                                            } // end if
                                                            else
                                                            {
                                                                ?>
                                                                    <option class="lavel2" value="<?php echo $option;?>"><?php echo $option;?></option>
                                                                <?php
                                                            } // end else
                                                        } // end foreach ?>
                                                </select>
                                                <div class="error"></div>
                                          </div>
                                         </div>
                                         </div>
                                        <?php 
                                        }

                                        if($value['fields_type'] == 'selectmultiple') {
                                        $options =  explode('|', $value['fields_elements']);    
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                         <div class="form-group input-box-w inner-inpt">
                                         <div class="select-bock-container">
                                                <select multiple displayerror="<?php echo $value['attribute_name']; ?>" name="<?php echo $value['attribute_slug']; ?>[]" id="<?php echo $value['attribute_slug']; ?>">
                                                    <option value="">Select <?php echo $value['attribute_name']; ?></option>
                                                    <?php 
                                                        $selectmultiple = explode(",", $value['attribute_value']);
                                                        print_r($selectmultiple);
                                                        foreach($options as $opt => $option) { 
                                                            if(in_array($option, $selectmultiple, TRUE)) 
                                                            {
                                                                ?>
                                                                    <option class="lavel2" value="<?php echo $option;?>" selected><?php echo $option;?></option>
                                                                <?php
                                                            } // end if
                                                            else
                                                            {
                                                                ?>
                                                                    <option class="lavel2" value="<?php echo $option;?>"><?php echo $option;?></option>
                                                                <?php
                                                            } // end else
                                                        } // end foreach ?>
                                                </select>
                                                <div class="error"></div>
                                          </div>
                                         </div>
                                         </div>
                                        <?php 
                                        }


                                        if($value['fields_type'] == 'file') {
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                             <div class="form-group input-box-w">
                                              <!--image upload start here-->
                                                <div ng-controller="uploadImage">
                                                     <div class="profile-pic">
                                                       <div class="row">
                                                           <div class="col-sm-12 col-md-5 col-lg-3"><div class="profile-img"><img ng-src="{{filepreview}}" class="img-responsive" ng-show="filepreview" id="output" /></div></div>
                                                           <div class="col-sm-12 col-md-7 col-lg-9">
                                                                <input displayerror="<?php echo $value['attribute_name']; ?>" onchange="loadFile(event)" displayerror="<?php echo $value['attribute_name']; ?>" type="file" class="upload-btn" fileinput="file" filepreview="filepreview" ng-init="filepreview = 'images/user.png'" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug']; ?>" />
                                                                <button class="upload-btn2"><span><i class="fa fa-upload" aria-hidden="true"></i></span> <?php echo $value['attribute_name']; ?></button>
                                                                <div class="error"></div>
                                                           </div>
                                                       </div>
                                                      </div>
                                                    <!--image upload end here-->
                                                 </div>
                                              </div>

                                         </div>
                                        <?php 
                                        }

                                        if($value['fields_type'] == 'radiobutton') {
                                        $options =  explode('|', $value['fields_elements']);    
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group input-box-w inner-inpt">
                                                <div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                                                    <div class="btns-main">
                                                        <?php foreach($options as $opt => $option) { 
                                                            ?>
                                                                <div class="radio-btn">
                                                            <?php
                                                                if($value['attribute_value'] == $option)
                                                                {
                                                                    ?>
                                                                        <input displayerror="<?php echo $value['attribute_name']; ?>" id="c-option<?php echo $opt; ?>" name="<?php echo $value['attribute_slug']; ?>" type="radio" value="<?php echo $option;?>" checked/>
                                                                        <label for="c-option<?php echo $opt; ?>"> <?php echo $option;?> </label>
                                                                        <div class="check"></div>
                                                                    <?php
                                                                } // end if
                                                                else
                                                                {
                                                                    ?>
                                                                        <input displayerror="<?php echo $value['attribute_name']; ?>" id="c-option<?php echo $opt; ?>" name="<?php echo $value['attribute_slug']; ?>" type="radio" value="<?php echo $option;?>"/>
                                                                        <label for="c-option<?php echo $opt; ?>"> <?php echo $option;?> </label>
                                                                        <div class="check"></div>
                                                                    <?php
                                                                } // end else
                                                            ?>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="error"></div>
                                                  </div>
                                             </div>
                                         </div>
                                        <?php 
                                        }

                                        if($value['fields_type'] == 'checkbox') {
                                        $options =  explode('|', $value['fields_elements']);    
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="form-group input-box-w inner-inpt">
                                                <div class="title-redios"><?php echo $value['attribute_name']; ?></div>
                                                <div class="listing-div innercheckbox">
                                                    <?php foreach($options as $opt => $option) { ?>
                                                    <p class="checkboxs">
                                                    <?php if($value['attribute_value'] == $option) { ?>
                                                    <input type="checkbox" class="filled-in" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug'].''.$opt; ?>" value="<?php echo $option;?>" checked/>
                                                    <label for="<?php echo $value['attribute_slug'].''.$opt; ?>"><?php echo $option;?></label>
                                                    <?php } // end if 
                                                    else { ?>
                                                        <input type="checkbox" class="filled-in" name="<?php echo $value['attribute_slug']; ?>" id="<?php echo $value['attribute_slug'].''.$opt; ?>" value="<?php echo $option;?>"/>
                                                        <label for="<?php echo $value['attribute_slug'].''.$opt; ?>"><?php echo $option;?></label>
                                                    <?php } // end else ?>
                                                    </p>
                                                    <?php } // end foreach ?>                    
                                                    <div class="error"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        }

                                    }

                                } // end if
                                else
                                {
                                    echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><div id="edit_profile_error" class="error">Not Available</div></div>';
                                } // end else
                                ?>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="button-innerpage blog-submit-btn max-widths-blog">

                                    <button type="submit" class="edit_listingsubmit" id="edit_listingsubmit" name="edit_listingsubmit" value="submit" >Send</button>

                                </div>
                            </div>

                            <?php
                            }
                            ?>
                  
                        </div>
             
                    </form>
                
                </div>

                <?php } // end if 
                else {
                    ?>
                        <div class="product-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <h3 style="text-align:center">No Listing Found</h3>
                                </div>
                            </div>
                        </div>
                    <?php
                } // end else
                ?>

            </div>
     
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var catid = document.getElementById('edit_category_name').value;
        //alert(catid);
        //get_fromdata();
    });
</script>