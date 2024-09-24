<div class="middle-section listing-page">
    <div class="container">
          <div class="col-sm-12 col-md-9 col-lg-12">
                <div class="listing-block">
                    <div class="sort-strip">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <p>Testimonials</p>
                            </div>
                        </div>
                        
                    </div>

                    <?php 
                    if(count($get_testimonial) > 0)
                    {
                    
                      foreach ($get_testimonial as $key => $data) {
                      
                          /*$addlisting_data = $this->master_model->getRecords('tbl_addlisting_data',array('listing_id'=>trim($addlistingdata['id'])));
              
                          foreach ($addlisting_data as $key => $value) {
                      
                              if($value['attribute_slug'] == 'price') {
                                  $price = $value['attribute_value'];
                              } // end if
                                 
                          } // end foreach
*/
                          // check listisng image
                          if ( isset($data['testimonials_img']) && !empty($data['testimonials_img']) )
                          {
                              $listing_image = base_url().'uploads/testimonials_images/'.$data['testimonials_img'];
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

                          ?>

                          <div class="product-block">
                              <div class="row">
                                  <div class="col-sm-3 col-md-3 col-lg-3">
                                     <div class="product-img-w">
                                      <div class="product-img">
                                          <img src="<?php echo $listing_image; ?>" class="img-responsive" alt="my-roommate"/>
                                      </div>
                                      
                                      

                                      <!-- Check if user is login or not -->
                                    

                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-6 col-lg-7">
                                      <ul>
                                      <li>Title: <span>
                                            <h5><?php echo $data['testimonials_name_en']; ?></h5>
                                          </span></li>
                                          <li>Author: <span>
                                            <h5><?php echo $data['testimonials_added_by']; ?></h5>
                                          </span></li>
                                          <li>Description: <span>
                                          
                                           <h5><?php echo $data['testimonials_description_en']; ?></h5>
                                         
                                          </span></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <?php 
                      }  // end foreach
                    } // end if

                    else
                    {
                        ?>
                        <div class="product-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12" style="text-align:center">
                                    <h3>No Data Found</h3>
                                </div>
                            </div>
                        </div>
                        <?php
                    } // end else

                    ?>

                    <!-- <div class="paging">
                        <a href="#"><span><i class="fa fa-angle-double-left"></i>Prev</span></a>
                            <ul>
                                <li><a href="#">1</a></li>     
                                <li><a href="#" class="active">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>                                                                                                     
                                <li><a href="#">5</a></li>                                                                                               
                            </ul>
                       <a href="#"> <span>Next<i class="fa fa-angle-double-right"></i></span>  </a>                         
                    </div>     -->  
                    <div class="">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>    