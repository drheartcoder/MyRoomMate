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
  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div> <h1><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $pageTitle; ?></h1> <h4></h4> </div>
    </div>
    <!-- END Page Title -->
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url();?>admin/subcategory/manage">Manage Category Form Fields</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
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
              <h3><i class="fa fa-tags" aria-hidden="true"></i> <?php echo ucfirst($pageTitle); ?></h3>
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
                  <label class="col-sm-3 col-lg-2 control-label">Category Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <select class="form-control" id="category_name" name="category_name" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Category</option>
                        <?php foreach($fetchcategory as $category) { ?>
                          <?php if ($category['parent_id'] == '0') { ?>
                          <optgroup label="<?php echo $category['category_name'];?>">
                          <?php } else { ?>
                          <option class="lavel2" value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                          <?php } ?>
                          </optgroup>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_category_name" ><?php echo form_error('category_name'); ?></div>
                  </div>
              </div>

              <?php /* <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Subcategory Name<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                  <select name="subcategory_name" id="subcategory_name" class="form-control">
                    <option value="" selected="selected">Select Subcategory</option>
                   
                    </select>
                   <div class="error" id="error_subcategory_name" ><?php echo form_error('subcategory_name'); ?></div>
                  </div>
              </div> */ ?>

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Fields Label ( Attribute )<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    <!-- <input type="text" class="form-control CopyPast_restrict beginningSpace_restrict" name="fields_label" id="fields_label" placeholder="Please Enter Fields Label"  value=""/> -->
                    <select class="form-control" id="attribute_id" name="attribute_id" data- tabindex="1" data-rule-required="true">
                        <option value="">Select Fields</option>
                        <?php foreach($fetchattribute as $attribute) { ?>
                          <option value="<?php echo $attribute['attribute_id'];?>"><?php echo $attribute['attribute_name'];?></option>
                        <?php } ?>
                    </select>

                    <div class="error" id="error_fields_label" ><?php echo form_error('fields_label'); ?></div>
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Field Type<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    
                    <select name="fields_type" id="fields_type" class="form-control">
                      <option value="">Select Field Type</option>
                      <optgroup label="Multiple Options">
                        <option value="selectlist">Select List</option>
                        <option value="selectmultiple">Select Multiple</option>
                        <option value="radiobutton">Radio Button</option>
                       <!--  <option value="checkbox">Checkbox</option> -->
                      </optgroup>
                      
                      <optgroup label="Single Options">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <!-- <option value="date">Date</option>
                        <option value="file">File</option>
                        <option value="image">Image</option> -->
                      </optgroup>
                    </select>

                   <div class="error" id="error_subcategory_name" ><?php echo form_error('fields_type'); ?></div>
                  </div>
              </div>

               <div class="form-group">
                  <label class="col-sm-3 col-lg-2 control-label">Field Elements<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-4 controls">
                    
                    <textarea disabled="disabled" cols="50" rows="8" id="fields_elements" name="fields_elements" class="form-control beginningSpace_restrict"></textarea>
                    <p>
                    <span class="label label-important">NOTE!</span>Enter elements seperated by | 
                    </p>
                   <div class="error" id="error_subcategory_name" ><?php echo form_error('fields_elements'); ?></div>
                  </div>
              </div>
           
              <div class="form-group">
                 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Add" class="btn btn-primary" name="btn_add_category_fields" id="btn_add_category_fields">
                    <a class="btn" href="<?php echo base_url();?>admin/categoryfields/manage/" >Cancel </a>
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