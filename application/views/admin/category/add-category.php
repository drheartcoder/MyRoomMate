<!-- BEGIN Theme Setting -->
<!-- <div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div> -->
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view('admin/top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view('admin/left-navigation'); ?> </div>
  <!-- END Sidebar -->
  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div> <h1> <i class="fa fa-tag" aria-hidden="true"></i> <?php echo $pageTitle; ?></h1> <h4></h4> </div>
    </div>
    <!-- END Page Title -->
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url();?>admin/category/manage">Manage Category</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active"><?php echo $pageTitle; ?></li>
      </ul>
    </div>
    <!-- END Breadcrumb -->

    <style type="text/css">
      .lavel1{
        color: #000;
        font-weight: bold;
      }

      .lavel2{
        color: #000;
        padding-left: 10px;
      }
    </style>
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
              <h3><i class="fa fa-tag" aria-hidden="true"></i> <?php echo ucfirst($pageTitle); ?></h3>
              <div class="box-tool">
              </div>
          </div>
          <div class="box-content">
            <form method="post" class="form-horizontal" id="add-form" enctype="multipart/form-data">
          	  <div class="form-group">
              	<div class="col-sm-12">
           		 	<?php if($this->session->flashdata('error')!=''){  ?>
            		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
           			 <?php }
            		 if($this->session->flashdata('success')!=''){?>
            		 <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
  			        <?php } ?>
                 </div>
  	          </div>

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Parent Category Name</label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="parent_id" name="parent_id" data- tabindex="1" data-rule-required="true">
                        <option value="0">Select Category</option>
                        <?php foreach($fetchcategory as $category) { ?>
                          <?php if ($category['parent_id'] == '0') { ?>
                          <option class="lavel1" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                          <?php } else { ?>
                          <option class="lavel2" value="<?php echo $category['category_id'];?>"> - <?php echo $category['category_name'];?></option>
                          <?php } ?>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_category_name" ><?php echo form_error('parent_id'); ?></div>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <input type="text" class="form-control beginningSpace_restrict" name="category_name" id="category_name" placeholder="Please Enter category Name" value="<?php echo set_value('category_name'); ?>"/>
                    <div class="error" id="error_category_name" ><?php echo form_error('category_name'); ?></div>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Feature</label>
                  <div class="col-sm-5 col-lg-1 controls">
                   <input type="checkbox" name="featured" value="featured" />
                    
                  </div>
              </div>
             <!--  <div class="form-group">
                      <label class="col-sm-3 col-lg-2 control-label">Category Description <span style="color:#F00;">*</span></label>
                      <div class="col-sm-9 col-lg-4 controls">
                         <textarea class="form-control" name="category_description" placeholder="Category Description" id="description" data-rule-required="true" rows="6"></textarea>
                         <div class="error" id="category_description" style="color:#b94a48;;" ><?php echo form_error('category_description'); ?></div> 
                      </div>
                   </div>  -->
                   <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Category Description<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <textarea class="form-control beginningSpace_restrict" name="category_description" placeholder="Category Description" id="description" data-rule-required="true" rows="6"></textarea>
                    <div class="error" id="error_category_description"><?php echo form_error('category_description'); ?></div> 
                  </div>
              </div>     
            <!-- <div class="form-group" style="">
              <label class="col-sm-3 col-lg-2 control-label">Image Upload<span style="color:#F00;">*</span></label>
              <div class="col-sm-9  controls">
                <input type='hidden'  name='oldimage' id='oldimage' value="">
               <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                 <img src="<?php echo base_url().'images/noimage200X150.png';?>" alt="" id="img_profile" />
               </div>
               <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
               <div class="" id="photo_error">
               </div>
               <div>
                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                 <span class="fileupload-exists">Change</span>
                 <input type="file" onChange="Upload()" class="file-input allowOnlyImg"  name="page_img" id="fileUpload"  /></span>
                 <a id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                
               </div>
                <div class="error" id="error_fileUpload" ><?php echo form_error('page_img'); ?></div>
             </div>
              </div>
            </div> -->
            <div class="form-group" style="">
              <label class="col-sm-3 col-lg-2 control-label">Image Logo<span style="color:#F00;">*</span></label>
              <div class="col-sm-9  controls">
                <input type='hidden'  name='oldimage' id='oldimage' value="">
               <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                 <img src="<?php echo base_url().'images/noimage200X150.png';?>" alt="" id="img_profile" />
               </div>
               <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
               <div class="" id="photo_error">
               </div>
               <div>
                 <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                 <span class="fileupload-exists">Change</span>
                 <input type="file" onChange="Upload()" class="file-input allowOnlyImg"  name="logo_image" id="fileUpload"/></span>
                 <a id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                
               </div>
                <div class="error" id="error_fileUpload" ><?php echo form_error('logo_img'); ?></div>
             </div>
             <!-- <div class="img-err">
                  <div style="color:#007aca; margin-top: 10px;" class="" ><b><span class="label label-important">NOTE!</span> Image allow 269x259 (h X w) dimension only and also image is mandatory.</b></div>
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
                    <input type="submit" value="Add" class="btn btn-primary" name="btn_add_category" id="btn_add_category">
                    <a class="btn" href="<?php echo base_url();?>admin/category/manage/" >Cancel </a>
                 </div>
              </div>
            </form>
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
