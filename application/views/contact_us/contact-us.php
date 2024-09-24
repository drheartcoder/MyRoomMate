      <!--middle section start here-->
      <!--banner start-->   
      <style>
      .err
      {
        color:red;
      }
      </style>
      <div class="banner-bg-b" style="background-color: transparent; background-image: url('<?php echo base_url()?>/images/contain-pages-banner.jpg'); background-clip: border-box; background-origin: padding-box; background-position: center top; background-repeat: no-repeat; background-size: cover;">
          <h2>Contact <span> Us</span></h2>
      </div>
      <!--banner end--> 
      <div class="contact-map">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                 <?php $this->load->view('status-msg'); ?>
                  <div class="row">
                     <div class="map-div col-sm-6 col-md-6 col-lg-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d236152.69971531094!2d113.98092734275397!3d22.35793549131418!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3403e2eda332980f%3A0xf08ab3badbeac97c!2sHong+Kong!5e0!3m2!1sen!2sin!4v1485247901131" style="border:0" width="100%" height="642" frameborder="0"></iframe>
                     </div>
                     <div class="block-min-top">
                        <div class="col-sm-6 col-md-6 col-lg-3 p-r-none">
                           <div class="section-details-contact">
                               <?php
                                $admin_data=$this->master_model->getRecords('admin_login', array('id'=>'1'));
                               //print_r($admin_data);
                                ?>
                              <div class="cont-icon">
                                 <i class="fa fa-phone-square" aria-hidden="true"></i>
                              </div>
                              <div class="conta-details">
                                 <div class="det-b">
                                    <b>Phone Number</b> <span><?php if(isset($admin_data[0]['admin_contactus'])) { echo $admin_data[0]['admin_contactus']; } else { echo "--";} ?></span> 
                                 </div>
                                 <div class="det-b">
                                    <b>Fax</b> <span><?php if(isset($admin_data[0]['admin_fax'])){echo $admin_data[0]['admin_fax'];} else { echo "--";}?></span>
                                 </div>
                              </div>
                           </div>
                           <div class="section-details-contact">
                              <div class="cont-icon">
                                 <i class="fa fa-envelope-square" aria-hidden="true"></i>
                              </div>
                              <div class="conta-details">
                                 <div class="det-b">
                                    <span><?php if(isset($admin_data[0]['admin_email'])){echo $admin_data[0]['admin_email'];} else { echo "--";}?></span> 
                                 </div>
                                 <div class="det-b"> 
                                   <!--  <span><a href="#">www.example.com</a></span> -->
                                 </div>
                              </div>
                           </div>
                           <div class="section-details-contact">
                              <div class="cont-icon">
                                 <i class="fa fa-map-marker" aria-hidden="true"></i>
                              </div>
                              <div class="conta-details">
                                 <div class="det-b">
                                    <span><?php if(isset($admin_data[0]['admin_address'])){echo $admin_data[0]['admin_address'];} else { echo "--";}?></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                           <div class="section-details-contact2">
                              <h2>Stay in Touch</h2>
                              <div class="conta-details-form">
                                 <form action="<?php echo base_url().'Contact_us/submit_enquiry' ?>" method="post">
                                    <div class="user-box">
                                       <input placeholder="Name" id="contactname" name="contactname" type="text" class="input-hig"/>
                                       <div class="err" id="err_contactname"></div>
                                    </div>
                                    <div class="user-box">
                                       <input placeholder="Email" id="contactemail" name="contactemail" type="text" class="input-hig"/>
                                    <div class="err" id="err_contactemail"></div>
                                    </div>
                                    <div class="user-box">
                                       <textarea  placeholder="Message" id="contactmessage" name="contactdescription" cols="30" rows="10" class="input-hig" style="height:108px;"></textarea>
                                      <div class="err" id="err_contactmessage"></div>
                                    </div>
                                    <div class="user-box11 pull-right">
                                       <!-- <a class="yallow-btn">Send Message</a> -->
                                        <button id="contactusbutton" name="contactusbutton" class="yallow-btn" type="submit" >Send Message</button>
                                       <div class="clr"></div>
                                    </div>
                                    <div class="clr"></div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="clr"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="contact-us-strip">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="cont-bx">
                    <?php $page_home = $this->master_model->getRecords('tbl_dynamic_pages',array('slug'=>'connect-with-us','front_status'=>'1')); ?>
                    <h3>Connect with Us</h3>
                     <p><!-- We regularly share wedding inspirations on our wedding blog, Pinterest and Instagram. If you want to 
                        talk to us, we are available on Facebook or just drop us an email at <a href="#">info@myroommate.com.</a> --> 
                     <?php echo ($page_home[0]['page_description']); ?>
                     </p>
                  </div>
               </div>
<!--
               <div class="col-lg-3">
                  <button class="log-btn f-cls" type="button" onclick="location.href='contact-us.html'">Get in Touch</button>
               </div>
-->
            </div>
         </div>
      </div>
    