<!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?> </div>
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
      <div> <h1><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $page_title; ?></h1> </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>subcategory/manage">Manage Category Form Fields</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active">Update Category Form Fields </a>
      </ul>
    </div>
    <!-- END Breadcrumb -->
    
    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
            <div class="box-title">
              <h3><i class="fa fa-tags" aria-hidden="true"></i> <?php echo ucfirst($page_title); ?></h3>
              <div class="box-tool"> </div>
            </div>
            <div class="box-content">
              <form method="post" class="form-horizontal" id="update-form" enctype="multipart/form-data" action="<?php echo base_url().ADMIN_PANEL_NAME; ?>categoryfields/update/<?php echo $this->uri->segment(4); ?>">
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
                  <label class="col-sm-3 col-lg-2 control-label">Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="category_name" name="category_name" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Category</option>
                        <?php foreach($fetchcategory as $category) { ?>
                          <option <?php if($category_form_field_info[0]['cat_id'] == $category['category_id'] ) { echo "selected"; } ?> value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_category_name" ><?php echo form_error('category_name'); ?></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Fields Label ( Attribute )<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <!-- <input type="text" class="form-control CopyPast_restrict beginningSpace_restrict" name="fields_label" id="fields_label" placeholder="Please Enter Fields Label"  value=""/> -->
                    <select class="form-control" id="attribute_id" name="attribute_id" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Fields</option>
                        <?php foreach($fetchattribute as $attribute) { ?>
                          <option <?php if($category_form_field_info[0]['attribute_id'] == $attribute['attribute_id'] ) { echo "selected"; } ?> value="<?php echo $attribute['attribute_id'];?>"><?php echo $attribute['attribute_name'];?></option>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_fields_label" ><?php echo form_error('fields_label'); ?></div>
                  </div>
              </div>

                <?php /* <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Subcategory Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select name="subcategory_name" id="subcategory_name" class="form-control">
                    <option value="" selected="selected">Select Subcategory</option>
                      <?php foreach($fetchsubcategory as $subcategory) { ?>
                          <option <?php if($category_form_field_info[0]['subcat_id'] == $subcategory['subcategory_id'] ) { echo "selected"; } ?> value="<?php echo $subcategory['subcategory_id'];?>"><?php echo $subcategory['subcategory_name'];?></option>
                        <?php } ?>
                   
                    </select>
                    <div class="error" id="error_subcategory_name" ><?php echo form_error('subcategory_name'); ?></div>
                  </div>
                </div> */ ?>
                
              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Field Type<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    
                    <select name="fields_type" id="fields_type" class="form-control">
                      <optgroup label="Multiple Options">
                        <option <?php if($category_form_field_info[0]['fields_type'] == "selectlist" ) { echo "selected"; } ?> value="selectlist">Select List</option>
                        <option <?php if($category_form_field_info[0]['fields_type'] == "selectmultiple" ) { echo "selected"; } ?> value="selectmultiple">Select Multiple</option>
                        <option <?php if($category_form_field_info[0]['fields_type'] == "radiobutton" ) { echo "selected"; } ?> value="radiobutton">Radio Button</option>
                        <!-- <option <?php if($category_form_field_info[0]['fields_type'] == "checkbox" ) { echo "selected"; } ?> value="checkbox">Checkbox</option> -->
                      </optgroup>
                      
                      <optgroup label="Single Options">
                        <option <?php if($category_form_field_info[0]['fields_type'] == "text" ) { echo "selected"; } ?> value="text">Text</option>
                        <option <?php if($category_form_field_info[0]['fields_type'] == "textarea" ) { echo "selected"; } ?> value="textarea">Textarea</option>
                        <!-- <option <?php if($category_form_field_info[0]['fields_type'] == "date" ) { echo "selected"; } ?> value="date">Date</option>
                        <option <?php if($category_form_field_info[0]['fields_type'] == "file" ) { echo "selected"; } ?> value="file">File</option>
                        <option <?php if($category_form_field_info[0]['fields_type'] == "image" ) { echo "selected"; } ?> value="image">Image</option> -->
                      </optgroup>
                    </select>

                   <div class="error" id="error_subcategory_name" ><?php echo form_error('fields_type'); ?></div>
                  </div>
              </div>

               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Field Elements<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    
                    <textarea cols="50" rows="8" id="fields_elements" name="fields_elements" class="form-control CopyPast_restrict beginningSpace_restrict"><?php echo $category_form_field_info[0]['fields_elements']; ?></textarea>
                    <p>
                    <span class="label label-important">NOTE!</span>Enter elements seperated by | 
                    </p>
                   <div class="error" id="error_subcategory_name" ><?php echo form_error('fields_elements'); ?></div>
                  </div>
              </div>

                <div class="form-group">
                  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update" id="btn_add_subcategory">
                    <a class="btn" href="<?php echo base_url().ADMIN_PANEL_NAME;?>categoryfields/manage/" >Cancel </a>
                  </div>
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
   
<!-- END Main Content -->

<script type="text/javascript">

$("#category_name" ).change(function() {
  
  var category_id = $('#category_name').val();

  if(category_id == '')
  {
    $('error_category_name').html('Please select category');
    return false;
  }
  $.ajax({
           type:"POST",
           url:'<?php echo base_url(); ?>admin/categoryfields/getSubCategory',
           data:{CiD:category_id},
           success:function(result)
           {  
              $('#subcategory_name').html(result);
           }
        
     })

});

$("#fields_type" ).change(function() {

  var selected = $(':selected', this);
  var groupname = selected.closest('optgroup').attr('label');

  if(groupname == "Multiple Options"){
    $("#fields_elements").prop("disabled", false);
  } else {
    $("#fields_elements").prop("disabled", true);
  }
});


</script>