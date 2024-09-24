<div class="mid-cont">
<div class="container">
<div class="sort-strip">
   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="title-bar">
               <div class="page-title"><?php if(isset($dynamic)  && sizeof($dynamic)>0) { echo $dynamic[0]['page_name']; }?></div>
            <div class="top_breadcrumb"> <a href="<?php echo base_url(); ?>">Home </a> &nbsp;<span><i class="fa fa-angle-right" ></i>
                  </span>&nbsp; <a href="javascript:void(0);" class="act"><?php if(isset($dynamic)  && sizeof($dynamic)>0) { echo $dynamic[0]['page_name']; }?> </a>
            </div>
                <div class="clearfix"></div>
             </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
            	<div class="white-box-main box-paymnet space-tp">
					<?php if(isset($dynamic)  && sizeof($dynamic)>0) { echo $dynamic[0]['page_description']; }?>       
				</div>
            </div>
        </div>
    </div>
</div>