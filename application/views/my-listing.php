<div class="main-inner-gray">
    <div class="container"> 
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
            <?php $this->load->view('user/left-menu'); ?> 
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
                <div class="listing-block mrg-o">
                    <div class="title-inner-page">My Listings</div>

                    <?php
                        if($this->session->flashdata('success') != "")
                        {
                    ?>
                    <div class="alert alert-success">
                        <button data-dismiss="alert" class="close">×</button>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success') ?>
                    </div>
                    <?php
                        }
                    else if($this->session->flashdata('error') != "")
                        {
                    ?>
                    <div class="alert alert-danger">
                        <button data-dismiss="alert" class="close">×</button>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error') ?>
                    </div>
                    <?php
                        }
                    ?>

                    <?php 
                    if(count($addlisting) > 0)
                    {
                    foreach ($addlisting as $key => $listing_data) {
                        $addlisting_data = $this->master_model->getRecords('tbl_addlisting_data',array('listing_id'=>trim($listing_data['id'])));

                        foreach ($addlisting_data as $key => $value) {
                            if($value['attribute_slug'] == 'price') {
                                $price = $value['attribute_value'];
                            }
                        }

                        // check listisng image
                        if ( isset($listing_data['mainphoto']) && !empty($listing_data['mainphoto']) )
                        {
                            $listing_image = base_url().'uploads/addlisting_images/thumb/'.$listing_data['mainphoto'];
                            
                            $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumb/'.$listing_data['mainphoto'];

                              // check if image exists or not
                              if (file_exists($path)) {
                                  //echo "The file exists";
                                  $listing_image = $listing_image;
                              } else {
                                $listing_image = base_url().'front-asset/images/default-thumbnail.jpg';
                              }

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
                                        <img src="<?php echo $listing_image; ?>" class="img-responsive" alt="my-roommate" />
                                    </div>
                                    <div class="heart"><i class="fa fa-pencil"></i></div>
                                    <div class="heart1"><i class="fa fa-times"></i></div>
                                    <div class="heart2"><i class="fa fa-picture-o"></i></div>
                                   
                                    <div class="ovrly"></div>
                                    <div class="buttons two-btns">

                                        <a href="javascript:void(0);" data-mylisting="<?php echo base64_encode($listing_data['id']); ?>" class="fa fa-times mrg-rts to_delete" ></a>
                                        <a href="<?php echo base_url().'user/edit_mylisting/'.$listing_data['slug']; ?>" class="fa fa-pencil mrg-rts "></a>
                                        <a href="<?php echo base_url().'user/my_image/'.$listing_data['slug']; ?>" class="fa fa-picture-o mrg-rts "></a>
  
                                    </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-7">
                                    <h5>
                                    <?php 
                                        if ( isset($listing_data['title']) && $listing_data['title'] != '' )
                                        { 
                                            echo $listing_data['title']; 
                                        } // end if
                                        else 
                                        {
                                            echo 'Title Not Available'; 
                                        }  // end else 
                                    ?>
                                    </h5>
                                    <?php //echo $listing_data['description']; ?>
                                    <ul>
                                        <li>Listed on : <span><?php 

                                        if ( isset($listing_data['created_date']) && $listing_data['created_date'] != '0000-00-00 00:00:00' )
                                        { 
                                            echo date("d F Y", strtotime($listing_data['created_date']));
                                        } // end if
                                        else 
                                        {
                                            echo 'Date Not Available'; 
                                        }  // end else 
                                        
                                        ?></span></li>
                                        <li>Availability : <span><?php 
                                        if ( isset($listing_data['availability']) && $listing_data['availability'] != '' )
                                        { 
                                            switch ($listing_data['availability'])
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
                                        } // end if
                                        else 
                                        {
                                            echo 'Availability Not Available'; 
                                        }  // end else 
                                        ?></span></li>
                                    </ul>
                                </div>
                                 <div class="col-sm-3 col-md-3 col-lg-2 pad-l-r">
                                   <div class="pricing-block">
                                    <h5>Rent (AED)</h5>
                                    <h2><?php 
                                        if ( isset($listing_data['price']) && $listing_data['price'] != '' )
                                        { 
                                            echo $listing_data['price'];
                                        } // end if
                                        else 
                                        {
                                            echo 'Price Not Available'; 
                                        }  // end else 

                                    ?></h2>
                                    <a href="<?php echo base_url().'user/mylisting_details/'.$listing_data['slug']; ?>" class="orng-trans-btn hvr-rectangle-out">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                    } // end foreach
                } //  end if
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
  
  $('.to_delete').click(function(){
        var mylisting_id = jQuery(this).data("mylisting");
        //alert(listing_id);
        swal({   
             title: "Are you sure?",   
             text: "You want to delete from Your Listing ?",  
             type: "warning",   
             showCancelButton: true,   
             confirmButtonColor: "#8cc63e",  
             confirmButtonText: "Yes",  
             cancelButtonText: "No",   
             closeOnConfirm: false,   
             closeOnCancel: false }, function(isConfirm){   
              if (isConfirm) 
              { 
                     swal("Deleted!", "Item deleted to Your Listing", "success"); 
                           location.href=site_url+"user/delete_mylisting/"+mylisting_id;
              } 
              else
              { 
                     swal("Cancelled", "Item Not deleted Your Listing :)", "error");          
                } 
            });
    }); 

</script>

