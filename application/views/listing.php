<?php ob_start(); ?>
<style type="text/css">
.paid {
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.4);
    height: 30px;
    right: 15px;
    position: absolute;
    text-align: center;
    top: 10px;
    width: 30px;
}
</style>
<div class='adfreely' rel='A001'></div>
<?php //echo "<pre>"; print_r($this->session->userdata()); echo "</pre>"; ?>
<div class="middle-section listing-page">
    <div class="container">
        <div class="row">

            <form class="listingData" id="listingData" name="listingData" method="get" action="<?php echo base_url().'listing'; ?>">
             
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="sidebar">
                    
                    <h1>Search</h1>
                    <?php if(!isset($_REQUEST['keyword'])) { $_REQUEST['keyword'] =''; } ?>
                    <div class="searchbox-cls">
                    <input type="text" name="keyword" id="keyword" value="<?php echo $_REQUEST['keyword'];?>" >
                    <div class="clearfix"></div>
                    <button class="search_keyword btn-abt"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    
                    <?php if(!empty($_REQUEST['keyword']) || !empty($_REQUEST['sercategory_id']) || !empty($_REQUEST['availability']) || !empty($_REQUEST['chkliston']) || !empty($_REQUEST['orderbyprice']) || !empty($_REQUEST['product_title']) || !empty($_REQUEST['country']) || !empty($_REQUEST['price_min'])) { ?>

                      <a href="<?php echo base_url(); ?>listing" class="reset-btnlisting"><i class="fa fa-undo" aria-hidden="true"></i> Reset</a>

                    <?php } ?>
                    <br/><br/>
                    <div class="clearfix"></div>                  
                    <br/>
                    </div>

                    <h1 class="border">Country</h1>
                    <div class="availablity">
                        <div class="select-style">
                            <?php if(!isset($_REQUEST['country'])) { $_REQUEST['country'] =''; } ?>
                            <select id="country_search" name="country">
                                <option value="">Select Country</option>
                                <?php foreach($fetchcountry as $country) { ?>
                                <option 

                                <?php 

                                  if(isset($_REQUEST['country']) && !empty($_REQUEST['country'])){
                                   if($_REQUEST['country'] == $country['country_id']) { ?> selected <?php } 
                                  } else {

                                   if($this->session->userdata('user_countryofresidence') == $country['country_id']) { ?> selected <?php } 
                                  } 

                                 ?> value="<?php echo $country['country_id'];?>"><?php echo $country['country_name'];?></option>
                                <?php } ?>
                           </select>
                        </div>
                    </div>

                    <?php if(isset($_REQUEST['country']) && $_REQUEST['country'] != '') { ?>
                    <h1 class="border">City</h1>
                    <div class="availablity">
                        <div class="select-style">
                            <?php if(!isset($_REQUEST['countryofresidence'])) { $_REQUEST['countryofresidence'] =''; } ?>
                            <select id="residence_serach" name="countryofresidence">
                                <option value="">Select City</option>
                                <?php foreach($fetchresidence as $residence) { ?>
                                <option 

                                <?php 

                                if($_REQUEST['countryofresidence'] == $residence['residence_id'] ) { echo 'selected="selected"'; } 


                                ?> 

                                value="<?php echo $residence['residence_id'];?>"><?php echo $residence['residence_name'];?></option>
                                <?php } ?>
                           </select>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if(!isset($get_category[0]['category_id'])) { $get_category[0]['category_id'] =''; } ?>
                    <h1>Category</h1>
                    
                    
                    <ul class="main-categories">
                      <?php if(!isset($_REQUEST['sercategory_id'])) { $_REQUEST['sercategory_id'] =''; } ?>
                      <input type="hidden" name="sercategory_id" id="sercategory_id" value="<?php echo $_REQUEST['sercategory_id']; ?>" />
                        <?php 
                        $activeclass = 1;
                        foreach ($fetchcategory as $key => $value) {
                            if($value['parent_id']=='0') {

                                $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                                $childcat = $this->master_model->getRecords('tbl_category_master',$where);

                                if(count($childcat) > 0) { 

                                    ?>
                                    <li><a <?php if($get_category[0]['category_id'] == $value['category_id'] || $value['category_id'] == $_REQUEST['sercategory_id'] ) { echo 'class="active"'; } ?> value="Toggle Second" id="parent<?php echo $value['category_id']; ?>" data-submenu-toggle="#menu<?php echo $value['category_id']; ?>" data-submenu-duration="1000"><i class="fa fa-circle-o"></i><?php echo $value['category_name']; ?> <span class="arrow"><i <?php if($get_category[0]['category_id'] == $value['category_id']) { echo 'class="fa fa-angle-up"'; } else { echo 'class="fa fa-angle-down"'; } ?> ></i></span></a>
                                            <ul class="sublist" id="menu<?php echo $value['category_id']; ?>" <?php if($get_category[0]['category_id'] != $value['category_id']) { echo 'style="display:none;"'; } ?> >
                                    <?php        
                                    foreach ($childcat as $key => $childcatvalue) {
                                            
                                        $where = array('parent_id'=> $childcatvalue['category_id'],'is_delete'=>'0','category_status'=>'1');
                                        $childchildcat = $this->master_model->getRecords('tbl_category_master',$where);
                                        

                                        ?><li><a href="<?php echo base_url().'listing?sercategory_id='.$childcatvalue['category_id'];?>" class="catlavel2 <?php if($childcatvalue['category_id'] == $_REQUEST['sercategory_id'] ) { ?> act-class <?php } ?>"><strong><?php echo ucwords($childcatvalue['category_name']); ?></strong></a></li> <?php
                                        if(count($childchildcat) > 0 ) {
                                            ?>
                                            <?php 
                                            $activeclass++;

                                            foreach ($childchildcat as $key => $childchildcatvalue) {
                                
                                                ?>

                                                <li><a href="javascript:void(0);" class="catlavel3 <?php if($childchildcatvalue['category_id'] == $_REQUEST['sercategory_id'] ) { ?> act-class <?php } ?>" data-value="<?php echo $childchildcatvalue['category_id']; ?>">- <?php echo ucwords($childchildcatvalue['category_name']); ?></a></li>
                                                
                                                <?php
                                            }
                                        }
                                        if($childcatvalue['category_id'] == $_REQUEST['sercategory_id'] || $value['category_id'] == $_REQUEST['sercategory_id'] ) { 
                                        
                                        ?><script>
                                          setTimeout(function(){
                                          $('#parent'+<?php echo $value['category_id']; ?>).click();
                                            setTimeout(function(){
                                            $('html, body').animate({scrollTop:$('#parent'+<?php echo $value['category_id']; ?>).position().top}, 'slow');
                                            },400);
                                          },500);
                                        </script>
                                        <?php } 
                                    }
                                    ?>
                                    </ul>
                                  </li>
                                <?php
                                }
                            }
                        }
                        ?>
                    </ul>

                    <h1 class="border">Availablity</h1>
                    <div class="availablity">
                        <div class="select-style">
                            <?php if(!isset($_REQUEST['availability'])) { $_REQUEST['availability'] =''; } ?>
                            <select id="availability" name="availability">
                                <option value="">Select Availablity</option>
                                <option <?php if($_REQUEST['availability'] == 'Immediately') { ?> selected="selected" <?php } ?> value="Immediately">Immediately</option>
                                <option <?php if($_REQUEST['availability'] == 'Within1Week') { ?> selected="selected" <?php } ?> value="Within1Week">Within 1 Week</option>
                                <option <?php if($_REQUEST['availability'] == 'Within1Month') { ?> selected="selected" <?php } ?> value="Within1Month">Within 1 Month</option>
                                <option <?php if($_REQUEST['availability'] == 'Within3Months') { ?> selected="selected" <?php } ?> value="Within3Months">Within 3 Months</option>
                                <option <?php if($_REQUEST['availability'] == 'Within6Months') { ?> selected="selected" <?php } ?> value="Within6Months">Within 6 Months</option>
                           </select>
                        </div>
                    </div>


                    <h1 class="border">Listed On</h1>
                    <div class="listing-div">
                    <?php if(!isset($_REQUEST['chkliston'])) { $_REQUEST['chkliston'] =''; } ?>
                      <div class="btns-main">
                          <div class="radio-btn">
                              <input class="check_listing" id="today" name="chkliston" <?php if($_REQUEST['chkliston'] == 'Today') { ?> checked="checked" <?php } ?> value="Today" type="radio" >
                              <label for="today"> Today </label>
                              <div class="check"></div>
                          </div>
                      </div>

                      <div class="btns-main">
                          <div class="radio-btn">
                              <input class="check_listing" id="lastweek" name="chkliston" <?php if($_REQUEST['chkliston'] == 'LastWeek') { ?> checked="checked" <?php } ?> value="LastWeek" type="radio">
                              <label for="lastweek"> Last Week </label>
                              <div class="check"></div>
                          </div>
                      </div>

                      <div class="btns-main">
                          <div class="radio-btn">
                              <input class="check_listing" id="lastmonth" name="chkliston" <?php if($_REQUEST['chkliston'] == 'LastMonth') { ?> checked="checked" <?php } ?> value="LastMonth" type="radio">
                              <label for="lastmonth"> Last Month </label>
                              <div class="check"></div>
                          </div>
                      </div>

                      <div class="btns-main">
                          <div class="radio-btn">
                              <input class="check_listing" id="lastyear" name="chkliston" <?php if($_REQUEST['chkliston'] == 'LastYear') { ?> checked <?php } ?> value="LastYear" type="radio">
                              <label for="lastyear"> Last Year </label>
                              <div class="check"></div>
                          </div>
                      </div>
                    </div>

                    <h1 class="border">Rent/Price (AED)</h1>
                    <div class="range-slider">
                        <div class="range-t input-bx" for="amount">
                             <div id="slider-price-range" class="slider-rang"></div>
                             <div class="amount-no" id="slider_price_range_txt"></div>

                             <input type='hidden' class='price_min' id="price_min" name='price_min' 
                             value="<?php if(!isset($_REQUEST['price_min'])) { $_REQUEST['price_min'] = '0'; } { echo $_REQUEST['price_min']; } ?>"
                              />

                             <input type='hidden' class='price_max' id="price_max" name='price_max' 
                             value="<?php if(!isset($_REQUEST['price_max'])) { $_REQUEST['price_max'] = $max_price[0]['price']; } {  echo $_REQUEST['price_max']; } ?>" />

                             <input type="hidden" class="max_price" value="<?php echo $max_price[0]['price']; ?>">
                        </div>
                    </div>

                    <?php /* <h1>Search</h1>
                    <?php if(!isset($_REQUEST['keyword'])) { $_REQUEST['keyword'] =''; } ?>
                    <div class="searchbox-cls">
                    <input type="text" name="keyword" id="keyword" value="<?php echo $_REQUEST['keyword'];?>" >
                    <button class="search_keyword btn-abt"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>

                    <?php if(!empty($_REQUEST['keyword']) || !empty($_REQUEST['sercategory_id']) || !empty($_REQUEST['availability']) || !empty($_REQUEST['chkliston']) || !empty($_REQUEST['orderbyprice']) || !empty($_REQUEST['product_title']) || !empty($_REQUEST['country']) || !empty($_REQUEST['price_min'])) { ?>
                      <a href="<?php echo base_url(); ?>listing" class="reset-btnlisting"><h1><i class="fa fa-undo" aria-hidden="true"></i> Reset</h1></a>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <br/> */ ?>
                   
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <div class="listing-block">

         <div style="margin-left:12px;">
            <?php
              if(!empty($_REQUEST['sercategory_id'])){
                $this->db->where('category_id' , $_REQUEST['sercategory_id']);
                $getCategory = $this->master_model->getRecords('tbl_category_master');
                if(!empty($getCategory[0]['category_name'])){
                 echo  '<h4>'.$Count.' ADS of '.$getCategory[0]['category_name'].'</h4>';
                }
              }
            ?>
          </div>


                    <div class="sort-strip">

                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <p>Result 1 - <?php echo $Count; ?> of <?php echo count($addlisting); ?></p>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                              <div class="sort-by">
                               <label>Sort By</label>
                                <div class="select-style">
                                      <?php if(!isset($_REQUEST['orderbyprice'])) { $_REQUEST['orderbyprice'] =''; } ?>
                                      <select id="orderbyprice" name="orderbyprice">
                                           <option <?php if($_REQUEST['orderbyprice'] == '') { ?> selected="selected" <?php } ?> value="">--Select--</option>
                                           <option <?php if($_REQUEST['orderbyprice'] == 'desc') { ?> selected="selected" <?php } ?> value="desc">Price High to Low</option>
                                           <option <?php if($_REQUEST['orderbyprice'] == 'asc') { ?> selected="selected" <?php } ?> value="asc">Price Low to High</option>
                                      </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <?php 
                    
                    
                    if(count($addlisting) > 0)
                    {
                      foreach ($addlisting as $key => $addlistingdata) {
                      
                          $addlisting_data = $this->master_model->getRecords('tbl_addlisting_data',array('listing_id'=>trim($addlistingdata['id'])));
              
                          foreach ($addlisting_data as $key => $value) {
                      
                              if($value['attribute_slug'] == 'price') {
                                  $price = $value['attribute_value'];
                              } // end if
                                 
                          } // end foreach

                          // check listisng image
                          if ( isset($addlistingdata['mainphoto']) && !empty($addlistingdata['mainphoto']) )
                          {
                              $listing_image = base_url().'uploads/addlisting_images/thumb/'.$addlistingdata['mainphoto'];
                              $path = $_SERVER['DOCUMENT_ROOT'].'/uploads/addlisting_images/thumb/'.$addlistingdata['mainphoto'];

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
                                          <img src="<?php echo $listing_image; ?>" class="img-responsive" alt="my-roommate"/>
                                      </div>

                                      <div class="heart space-right">
                                      <?php
                                        $where_myfavorite = array('user_id'=>$this->session->userdata('user_id'),'addlisting_id'=>$addlistingdata['id']);
                                        $myfavorite_data  = $this->master_model->getRecords('tbl_myfavorite',$where_myfavorite); 
                                      ?>
                                      <?php
                                      if(count($myfavorite_data) > 0){
                                      ?><i class="fa fa-heart " style="color:#ef5025"></i><?php   
                                      }else{
                                      ?><i class="fa fa-heart  unfav<?php echo $addlistingdata['id']; ?>"  ></i><?php
                                      }?>
                                     
                                      </div>
                                      
                                      <?php
                                      if($addlistingdata['payment_type']=="paid"){

                                      ?><div class="paid space-right pull-right"><i class="fa fa-star-o" style="font-size:1.5em; margin-top:5px;"></i> </div><?php   
                                      }?>
                                     
                                      <div class="ovrly"></div>

                                      <!-- Check if user is login or not -->
                                      <?php 
                                        if($this->session->userdata('user_id') == "")
                                        { 
                                        ?>
                                          <div class="buttons">
                                            <a href="javascript:void(0);" class="fa fa-heart ulogin"></a>
                                        </div>
                                      <?php
                                      }else{
                                      ?>
                                          <div class="buttons">
                                              <a href="javascript:void(0);" class="fa fa-heart add_to_favorite" 
                                              data-id="<?php echo $addlistingdata['id']; ?>"
                                              data-mylisting="<?php echo base64_encode($addlistingdata['id']); ?>"></a>
                                          </div>
                                      <?php
                                      }
                                      ?>

                                      </div>
                                  </div>
                                  <div class="col-sm-6 col-md-6 col-lg-7">
                                      <h5><?php echo $addlistingdata['title']; ?></h5>
                                      <?php //echo $addlistingdata['description']; ?>
                                      <ul>
                                          <li>Listed on : <span>
                                            <?php
                                              if ( isset($addlistingdata['created_date']) && $addlistingdata['created_date'] != '0000-00-00 00:00:00' )
                                                { 
                                                    echo date("d F Y", strtotime($addlistingdata['created_date']));
                                                } // end if
                                                else 
                                                {
                                                    echo 'Date Not Available'; 
                                                }  // end else 
                                            ?>
                                          </span></li>
                                          <li>Availability : <span>
                                          <?php 
                                          switch ($addlistingdata['availability'])
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
                                          ?>
                                          </span></li>
                                      </ul>
                                  </div>
                                   <div class="col-sm-3 col-md-3 col-lg-2 pad-l-r">
                                     <div class="pricing-block">
                                      <h5>Rent/Price (AED)</h5>
                                      <h2><?php echo $addlistingdata['price']; ?></h2>
                                      <!-- <a href="< ?php echo base_url().'listing/details/'.base64_encode($addlistingdata['id']); ?>" class="orng-trans-btn hvr-rectangle-out">Details</a> -->
                                      <a href="<?php echo base_url().'listing/details/'.$addlistingdata['slug']; ?>" class="orng-trans-btn hvr-rectangle-out">Details</a>
                                      </div>
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
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.ulogin').click(function(){
      $('.login').click();
    });
  });
</script>


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
  
  $('.add_to_favorite').click(function(){
        var mylisting_id = jQuery(this).data("mylisting");
        var id = jQuery(this).data("id");
        
        $.ajax({
        url:site_url+"listing/addfavorite_listing/"+mylisting_id,
        type:'POST',
        dataType:'json',
        success:function(response)
        {

          if(response.status == "success") {
            $("#error").html();
            $("#success").html(response.msg);
            $(".unfav"+id).attr('style' , 'color:#ef5025');
          } else {

            ajaxindicatorstop();
            $("#success").html();
            $("#error").html(response.msg);
          }

          return true;

        }
      });

    }); 

</script>


<script type="text/javascript">
    $(function() {
        var min = $("#price_min").val();
        var max = $("#price_max").val();
        var max_price = $(".max_price").val();

        $("#slider-price-range").slider({
            range: true,
            min: 0,
            max: max_price,
            values: [min, max],
            slide: function(event, ui) {
                $("#slider_price_range_txt").html("<span class='slider_price_min'>AED " + ui.values[0] + "</span>  <span class='slider_price_max'>AED " + ui.values[1] + " </span>");
            },
            change: function(event, ui) {
                /*$("#price_range_txt").html("<input type='text' class='price_min' name='price_min' value='$ " + ui.values[0] + "' /> <input type='text' class='price_max' name='price_max' value='$ " + ui.values[1] + "' />");*/
                $(".price_min").val(ui.values[0]);
                $(".price_max").val(ui.values[1]);

                setTimeout(function(){

                   $( "#listingData" ).submit();
                },500);
                
            }
        });
        $("#slider_price_range_txt").html("<span class='slider_price_min'> AED " + $("#slider-price-range").slider("values", 0) + "</span>  <span class='slider_price_max'>AED " + $("#slider-price-range").slider("values", 1) + "</span>");


    });
</script>