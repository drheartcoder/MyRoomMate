<!-- BEGIN Theme Setting -->
<!-- END Theme Setting --> 

<!-- BEGIN Navbar -->
<div id="navbar" class="navbar">
  <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?>
</div>
<!-- END Navbar --> 

<!-- BEGIN Container -->
<div class="container" id="main-container"> 
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse">
    <?php $this->load->view(ADMIN_PANEL_NAME.'left-navigation'); ?>
  </div>
  <!-- END Sidebar --> 



  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div> <h1><i class="fa fa-tag" aria-hidden="true"></i>  <?php echo $page_title; ?></h1> </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url();?>admin/category/manage">Manage Category</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Update Category </a>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title">
              <h3><i class="fa fa-tag" aria-hidden="true"></i>  <?php echo ucfirst($page_title); ?></h3>
              <div class="box-tool"> </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="update-form" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/category/update/<?php echo $this->uri->segment(4); ?>">
                <div class="form-group">
                  <div class="col-sm-12">
                    <?php if($this->session->flashdata('error')!=''){  ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } if($this->session->flashdata('success')!=''){?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Category Name</label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="parent_id" name="parent_id" data- tabindex="1" data-rule-required="true">
                        <option value="0">Select Category</option>
                        <?php foreach($fetchcategory as $category) { ?>

                          <?php if ($category['parent_id'] == '0') { ?> 
                          <option <?php if($category_info[0]['parent_id'] == $category['category_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                          <?php } else { ?>
                          <option <?php if($category_info[0]['parent_id'] == $category['category_id'] ) { echo 'selected="selected"'; } ?> value="<?php echo $category['category_id'];?>"> - <?php echo $category['category_name'];?></option>
                          <?php } ?>
                          
                        <?php } ?>
                        
                    </select>

                    <div class="error" id="error_category_name" ><?php echo form_error('parent_id'); ?></div>
                  </div>
                </div>

              	<div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict CopyPast_restrict" name="category_name" id="category_name" placeholder="Please Enter Category Name"  value="<?php echo $category_info[0]['category_name']; ?>"/>
                    <div class="error" id="error_category_name" ><?php echo form_error('category_name'); ?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Feature</label>
                  <div class="col-sm-5 col-lg-1 controls">
                   <input type="checkbox" name="featured" value="featured" <?php  if(isset($category_info[0]['featured']) && $category_info[0]['featured']=="featured") echo 'checked=""'; ?> />
                    
                  </div>
                   
              </div>
              <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Category Description <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-4 controls">
                         <textarea class="form-control" name="category_description" placeholder="Category Description" id="description" data-rule-required="true" rows="6"><?php echo $category_info[0]['category_description']; ?></textarea>
                         <div class="error_msg" id="error_page_description" style="color:#b94a48;;" ><?php echo form_error('category_description'); ?></div> 
                      </div>
                   </div>
                <!--  <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Image Upload<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9  controls">
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                    <input type='hidden' name='oldimage' id='oldimage' value="<?php echo $category_info[0]['profile_image'];?>">
                    <div class="fileupload-new img-thumbnail"    >
                     <?php 
                     if(isset($category_info[0]['profile_image']) && file_exists('uploads/cat_logo/'.$category_info[0]['profile_image']))
                     {
                      ?>
                      <img  src="<?php echo base_url().'uploads/cat_logo/'.$category_info[0]['profile_image'];?>" alt="" width="100" heigth="100"/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <img src="<?php echo base_url().'images/noimage200X150.png';?>" alt="" />
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
                   <input type="file" id="fileUpload" onChange="Upload()" class="file-input" name="page_img"  /></span>
                   <a  id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                 </div>
                 
                  <div class="error" id="error_fileUpload" ><?php echo form_error('Image'); ?></div>
               </div>
            </div>
              </div> -->
               <div class="form-group" style="">
                  <label class="col-sm-3 col-lg-2 control-label">Image logo<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9  controls">
                   <div class="fileupload fileupload-new" data-provides="fileupload">
                    <input type='hidden' name='oldimage1' id='oldimage1' value="<?php echo $category_info[0]['logo_image'];?>">
                    <div class="fileupload-new img-thumbnail"    >
                     <?php 
                     if(isset($category_info[0]['logo_image']) && file_exists('uploads/category_logo/'.$category_info[0]['logo_image']))
                     {
                      ?>
                      <img  src="<?php echo base_url().'uploads/category_logo/'.$category_info[0]['logo_image'];?>" alt="" width="100" heigth="100"/>
                      <?php
                    }
                    else
                    {
                      ?>
                      <img src="<?php echo base_url().'images/noimage200X150.png';?>" alt="" />
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
                   <input type="file" id="fileUpload" class="file-input" name="logo_image"  /></span>
                   <a  id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                 </div>
                 
                  <div class="error" id="error_fileUpload" ><?php echo form_error('Image'); ?></div>
               </div>
               <!-- <div class="img-err">
                  <div style="color:#007aca; margin-top: 10px;" class="" ><b><span class="label label-important">NOTE!</span> Image allow 162 x 260 (h X w) dimension only and also image is mandatory.</b></div>
              </div> -->
            </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Meta Tag Title</label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <textarea class="form-control beginningSpace_restrict" name="meta_tag_title" placeholder="Meta Tag Title" id="meta_tag_title" data-rule-required="true" rows="6"></textarea>
                    <div class="error" id="error_meta_tag_title"><?php echo form_error('meta_tag_title'); ?></div> 
                  </div>
              </div> 

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Meta Tag Description</label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <textarea class="form-control beginningSpace_restrict" name="meta_tag_description" placeholder="Meta Tag Description" id="meta_tag_description" data-rule-required="true" rows="6"></textarea>
                    <div class="error" id="error_meta_tag_description"><?php echo form_error('meta_tag_description'); ?></div> 
                  </div>
              </div> 

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Meta Tag Keywords</label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <textarea class="form-control beginningSpace_restrict" name="meta_tag_keywords" placeholder="Meta Tag Keywords" id="meta_tag_keywords" data-rule-required="true" rows="6"></textarea>
                    <div class="error" id="error_meta_tag_keywords"><?php echo form_error('meta_tag_keywords'); ?></div> 
                  </div>
              </div> 
              
                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_add_category" id="btn_add_category">
                    <a class="btn" href="<?php echo base_url().ADMIN_PANEL_NAME;?>category/manage/" >Cancel </a>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Main Content -->

<script type="text/javascript">
function Upload() {
    //Get reference of FileUpload.
    var fileUpload = document.getElementById("fileUpload");
 
    //Check whether the file is valid Image.
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+()$");
    if (regex.test(fileUpload.value.toLowerCase())) {
 
        //Check whether HTML5 is supported.
        if (typeof (fileUpload.files) != "undefined") {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
 
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;
                       
                //Validate the File Height and Width.
                image.onload = function () {
                    /*var height = this.height;
                    var width = this.width;
                    if (height > 269 && width > 269) {

                        $(this).val('');
                        sweetAlert("Image only allow 269 x 259 diamentions.");
                        $("img").attr('src', site_url+'images/noimage200X150.png');
                        event.preventDefault(); 
                        return false;
                    }*/
                    /*alert("Uploaded image has valid Height and Width.");*/
                    return true;
                };
 
            }
        } else {
            sweetAlert("This browser does not support HTML5.");
            return false;
        }
    } else {
        sweetAlert("Please select a valid Image file.");
        return false;
    }
}
</script>