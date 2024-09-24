<div class="middle-section listing-page">
   <div class="page-path mrg-bottoms">
           <div class="container">
           <div class="row">
               <div class="col-sm-6">
                   <h2><?php  echo $maincategory[0]['category_name'];?></h2>
               </div>
               <div class="col-sm-6">
                   <ul>
                       <li><a href="<?php echo base_url(); ?>">Home</a></li>
                       <li><i class="fa fa-angle-right"></i></li>
                       <li><a href="javascript:void(0)" id="self_reload" class="active "><?php  echo $maincategory[0]['category_name'];?></a></li>
                   </ul>
               </div>
           </div>
       </div>
       <div class="clearfix"></div>
       <div class="category-list-main">
        <div class="container">
          <form id="submit_category_id" method="POST" action="<?php echo base_url().'listing'; ?>">
          <input type="hidden" name="sercategory_id" id="sercategory_id" />
          <?php

          /*echo"<pre>";
          print_r($maincategory);
          print_r($childcategory);
          echo"</pre>";
          */          
            
          if(count($maincategory) > 0) {

            foreach ($maincategory as $key => $value) {

                $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                $childcategory_level1 = $this->master_model->getRecords('tbl_category_master',$where);

                if(count($childcategory_level1) > 0 ) {
                  ?>
                  <div class="category-inner">
                  <?php
                  foreach ($childcategory_level1 as $key => $value) { 
                  ?> 
                  
                  <div class="main-category-title"><a href="javascript:void(0)"><?php echo ucwords($value['category_name']);?></a></div>

                  <?php 
                  $where = array('parent_id'=> $value['category_id'],'is_delete'=>'0','category_status'=>'1');
                  $childcategory_level2 = $this->master_model->getRecords('tbl_category_master',$where);

                  if(count($childcategory_level2) > 0 ) {
                  ?>
                  <ul> 
                  <?php 
                    foreach ($childcategory_level2 as $key => $value) {
                      ?>
                        <li><a href="javascript:void(0)" class="get_category_id" data-value="<?php echo $value['category_id'];?>"> <span><i class="fa fa-angle-right" aria-hidden="true"></i></span><?php echo ucwords($value['category_name']);?></a></li>
                      <?php 
                    }
                    ?>
                    </ul>
                    <?php 
                    } else {
                      ?> <ul><li><?php
                      echo "No Category Available";
                      ?></li></ul> <?php
                    }
                  } 
                  ?>
                  </div>
                  <?php
                } 
                ?>
              <?php 
            }

          } // end if
          
          ?>
          
         </form> 
        </div>
      </div>
            
  </div>
</div>

<script type="text/javascript">
  // $('#self_reload').click(function(){
  //   window.location.reload();
  // });
</script>
