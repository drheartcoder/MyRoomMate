
 
    <div class="main-inner-gray">
 <div class="container">
     
     <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <?php $this->load->view('user/left-menu'); ?> 
         </div>
         <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
             <div class="listing-block mrg-o">
                 <div class="title-inner-page">Favourites</div>
                        <?php 
                        if(count($myfavorite_data) > 0)
                        {
                            foreach ($myfavorite_data as $myfavorite) {
                                foreach ($myfavorite_details as $key => $value) {
                                    if($value['attribute_slug'] == 'price') {
                                        $price = $value['attribute_value'];
                                    } // end if
                                } // enf foreach


                                // check favorite image
                                if ( isset($myfavorite['mainphoto']) && !empty($myfavorite['mainphoto']) )
                                {
                                    $favorite_image = base_url().'uploads/addlisting_images/thumb/'.$myfavorite['mainphoto'];

                                    $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumb/'.$addlistingdata['mainphoto'];

                                    // check if image exists or not
                                    if (file_exists($path)) {
                                        //echo "The file exists";
                                        $favorite_image = $favorite_image;
                                    } else {
                                      $favorite_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                    }

                                } // end if
                                else
                                {
                                    $favorite_image = base_url().'front-asset/images/default-thumbnail.jpg';
                                } // end else

                            ?>
                            <div class="product-block">
                            <div class="row">
                                <div class="col-sm-3 col-md-3 col-lg-3">
                                   <div class="product-img-w">
                                    <div class="product-img">
                                        <img src="<?php echo $favorite_image ?>" class="img-responsive" alt="my-roommate"/>
                                    </div>
                                    <div class="heart"><i class="fa fa-trash-o"></i></div>
                                    <div class="ovrly"></div>
                                    <div class="buttons">
                                        <a href="javascript:void(0);" class="fa fa-trash-o delete_favorite" data-myfavoriteid="<?php echo base64_encode($myfavorite['myfavorite_id']); ?>"></a>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-7">
                                    <h5><?php echo $myfavorite['title']; ?></h5>
                                    <ul>
                                        <li>Listed on : <span><?php echo date("d F Y", strtotime($myfavorite['created_date'])); ?></span></li>
                                        <li>Availability : <span><?php 
                                          switch ($myfavorite['availability'])
                                            {
                                                case 'Immediately': echo "Immediately";
                                                break;
                                                case 'Within1Week': echo "Within 1 Week";
                                                break;
                                                case 'Within1Month': echo "Within 1 Month";
                                                break;
                                                case 'Within3Months': echo "Within 3 Months";
                                                break;
                                                case 'Within6Months': echo "Within 6 Months";
                                                break;
                                            } // end switch
                                         ?></span></li>
                                    </ul>
                                </div>
                                 <div class="col-sm-3 col-md-3 col-lg-2 pad-l-r">
                                   <div class="pricing-block">
                                    <h5>Rent (AED)</h5>
                                    <h2><?php echo $myfavorite['price']; ?></h2>
                                    <a href="<?php echo base_url().'user/mylisting_details/'.$myfavorite['slug']; ?>" class="orng-trans-btn hvr-rectangle-out">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <?php
                        } // end foreach
                        } // end if 
                        else{
                            ?>
                            <div class="product-block">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <h3 style="text-align:center">No Listing added to Favorite</h3>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } // end else if
                        ?>
                        <div class="">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
             </div>
         </div>
 </div>
</div> 

    </div>

<!-- sweet alert -->
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script> <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert_actions.js">
  
</script> <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css">
<style type="text/css">
.sweet-alert {
    background-color: white;
    font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    width: 478px;
    padding: 17px;
    border-radius: 5px;
    text-align: center;
    position: fixed;
    left: 50%;
    top: 10%;
    margin-left: -256px;
    margin-top: 100px !important;
    overflow: hidden;
    display: none;
    z-index: 99999;
}  
</style>
<!-- end sweet alert -->

<script type="text/javascript">
  
  $('.delete_favorite').click(function(){
        var myfavorite_id = jQuery(this).data("myfavoriteid");
        //alert(myfavorite_id);
        swal({   
             title: "Are you sure?",   
             text: "You want to Delete Your Favorite ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Item deleted to Your Favorite", "success"); 
                           location.href=site_url+"user/del_myfavorite/"+myfavorite_id;
              } 
              else
              { 
                     swal("Cancelled", "Not Deleted from Your Favorite :)", "error");          
                } 
            });
    }); 

</script>
    