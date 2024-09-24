     <!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <!-- END Sidebar -->
<div id="main-content">
    <!-- BEGIN Page Title -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <!-- BEGIN Page Title -->
    <div class="page-title">
        <div>
            <h1><i class="fa fa-th-list"></i><?php echo isset($page_title)?$page_title:"" ;?></h1>
        </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url().'admin/dashboard/'; ?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li >
                <a href="<?php echo base_url().'admin/blogs/manage' ?>">Manage Blogs</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active"><?php echo isset($page_title)?$page_title:"" ;?></li>
        </ul>
    </div>
    <!-- END Breadcrumb -->
    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <?php if($this->session->flashdata('success')!=""){ ?>
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Success! </strong><?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php }if($this->session->flashdata('error')!=""){ ?>
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Error! </strong><?php echo strip_tags($this->session->flashdata('error')); ?>
            </div>
            <?php } ?>
            <div id="form-validation-error" style="display:none">
                <div class="alert alert-danger" >
                    <button class="close" data-dismiss="alert">×</button>
                    <!-- <strong>Error! </strong> Please fill required fields in both English and Arabic Tabs  -->
                    <strong>Error! </strong> Please fill required fields.

                </div>
            </div>
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-th-list"></i><?php echo isset($page_title)?$page_title:"" ;?></h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                       <!--  <a data-action="close" href="#"><i class="fa fa-times"></i></a> -->
                    </div>
                </div>
                <div class="box-content">
                   <?php
                            $attr=array( "class"=>"form-horizontal", "id"=>"validation-form", "name"=>"frm-add-page" , "method"=>"post" , "enctype"=>"multipart/form-data");
                            echo form_open_multipart(base_url()."admin/blogs/edit/".$this->uri->segment(4)."",$attr);
                                        ?>
                    <div class="tabbable tabs-left" >
                        <div class="tab-content" id="myTabContent3" >
                            <div id="english" class="tab-pane fade active in">
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Name<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="blogs_name_en"
                                               id="blogs_name_en"
                                               class="form-control"
                                               data-rule-required="true"
                                               data-rule-minlength="3"
                                               placeholder=" Name"
                                               value="<?php echo isset($blogs_details['blogs_name_en'])?$blogs_details['blogs_name_en']:'' ?>"/>
                                        <div class="error_msg"><?php if(form_error('blogs_name_en')!=""){echo form_error('blogs_name_en');} ?></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="image_title_en">Image Category<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        
                                        <select class="form-control" id="blogs_category_id" name="blogs_category_id" data- tabindex="1" data-rule-required="true">
                                            <option value="">Select Blog Category</option>
                                            <?php foreach($blogcategory as $bc) { 
                                              if( $bc['blogscategory_id'] == $blogs_details['blogs_category_id'] ) { ?> 
                                              <option selected="selected" value="<?php echo $bc['blogscategory_id'];?>"><?php echo $bc['blogscategory_name'];?></option>
                                              <?php } else { ?>
                                              <option value="<?php echo $bc['blogscategory_id'];?>"><?php echo $bc['blogscategory_name'];?></option>
                                            <?php }
                                            } ?>
                                         </select>

                                        <div class="error_msg"><?php if(form_error('image_title_en')!=""){echo form_error('image_title_en');} ?></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="blogs_added_by">Added by<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input data-rule-ckvalidation="true"
                                                  name="blogs_added_by"
                                                  id="blogs_added_by"
                                                  rows="5"
                                                  class="form-control ckeditor"
                                                  data-rule-required="true"
                                                  data-rule-minlength="3"
                                                  placeholder=" Added by "
                                                  value="<?php echo $blogs_details['blogs_added_by'];?>"/>
                                        <div class="error_msg"><?php if(form_error('blogs_added_by')!=""){echo form_error('blogs_added_by');} ?></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="blogs_description_en">Description<i class="red">*</i></label>
                                    <div class="col-sm-9 controls">
                                        <textarea data-rule-ckvalidation="true"
                                                  name="blogs_description_en"
                                                  id="blogs_description_en"
                                                  rows="5"
                                                  class="form-control ckeditor"
                                                  data-rule-minlength="10"
                                                  placeholder=" Description ">
                                                 <?php echo isset($blogs_details['blogs_description_en'])?$blogs_details['blogs_description_en']:'' ?>
                                        </textarea>
                                        <div class="error_msg"><?php if(form_error('blogs_description_en')!=""){echo form_error('blogs_description_en');} ?></div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                  <label class="col-sm-3 col-lg-2 control-label">Image Upload<i class="red">*</i></label>
                                  <div class="col-sm-9  controls">
                                   <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <input type='hidden' name='oldimage' id='oldimage' value="<?php echo $blogs_details['blogs_img']?>">
                                    <div class="fileupload-new img-thumbnail"    >
                                     <?php
                                                if(isset($blogs_details['blogs_img']))
                                                {
                                                    ?>
                                                        <img   src="<?php echo base_url().'uploads/blogs_images/'.$blogs_details['blogs_img'];?>" alt="" width="500" height="500">
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>
                                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                    <?php
                                                }
                                     ?>
                                    </div>
                                           <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div class="" id="photo_error">
                                              </div>
                                           <div>
                                               <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" id="fileUpload" class="file-input" name="blogs_logo" /></span>
                                               <a  id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                           </div>
                                       </div>
                                       <!-- <span class="label label-important">NOTE!</span><br>
                                       <ul>
                                          <li><span><strong>Attached image img-thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only</strong></span></li>
                                          <li><span><strong>Attached image Should be 270 x 135 pixel Only</strong></span></li>
                                       </ul> -->
                                   </div>
                               </div>
                    </div>
                     <?php
                    $blogs_data=$blogs_details['blogs_added_date'];
                    //$date=date('Y m d l',strtotime($blogs_data));
                    $date=date('m/d/Y',strtotime($blogs_data));
                    ?>
                    <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="date_en">Date<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-3 controls">
                                        <input data-rule-ckvalidation="true"
                                                  name="blogs_date"
                                                  id="blogs_date"
                                                  rows="5"
                                                  class="form-control ckeditor"
                                                  data-rule-minlength="10"
                                                  placeholder=" Date"
                                                  value="<?php echo $date; ?>"/>
                                        <div class="error_msg"><?php if(form_error('blogs_date')!=""){echo form_error('blogs_date');} ?></div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6  col-lg-5">
                            </div>
                            <div class="col-sm-6  col-lg-7">
                                    <input type="submit" name="blogs_edit" id="blogs_edit`" class="btn btn-primary" value="Update" onclick="checkValidation()">
                            </div>
                        </div>
                    </div>
                    <?php
                        echo form_close();
                    ?>
                    </div>
                  </div>
        </div>
    </div>
<!-- END Main Content -->
<?php $this->load->view('admin/top-footer'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function checkValidation()
{
   if($("#validation-form").valid()==false)
   {
        $("#form-validation-error").show();
        setTimeout(function()
        {
           $("#form-validation-error").hide();
        }, 8000);
   }
}
</script>
<script type="text/javascript">
  $("#blogs_date" ).datepicker({
   changeYear: true,
   changeMonth: true,
   inline: true,
});

</script>
