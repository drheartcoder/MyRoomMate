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
      <div> <h1><i class="fa fa-star"></i><?php echo $page_title; ?></h1> <h4></h4> </div>
    </div>
    <!-- END Page Title -->
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url();?>admin/dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class=""><a href="<?php echo base_url();?>admin/Advertisement/manage">Manage Advertisement</a> <span class="divider"><i class="fa fa-angle-right"></i></span></li>
        <li class="active"><?php echo $page_title; ?></li>
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
                    <strong>Error! </strong> Please fill required fields
                </div>
            </div>
            <div class="box box-magenta">
                <div class="box-title">
                    <h3><i class="fa fa-th-list"></i><?php echo isset($page_title)?$page_title:"" ;?></h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                       <!--  <a data-action="close" href="#"><i class="fa fa-times"></i></a> -->
                    </div>
                </div>
                <div class="box-content">
                   <?php
                            $attr=array("class"=>"form-horizontal", "id"=>"validation-form", "name"=>"frm-add-page" , "method"=>"post", "enctype" => "multipart/form-data");
                            echo form_open_multipart(base_url()."admin/advertisement/add/",$attr);
                                        ?>
                    <div class="tabbable tabs-left" >
                        <div class="tab-content" id="myTabContent3" >
                            <div id="english" class="tab-pane fade active in">
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                    <label class="col-sm-3 col-lg-2 control-label" for="page_title">Name<i class="red">*</i></label>
                                    <div class="col-sm-6 col-lg-4 controls">
                                        <input type="text"
                                               name="adv_name"
                                               id="adv_name"
                                               class="form-control"
                                               placeholder="Please enter advertisement name"
                                               value="<?php echo set_value ('adv_name'); ?>"/>
                                        <div class="error" id="err_adv_name"><?php if(form_error('adv_name')!=""){echo form_error('adv_name');} ?></div>
                                    </div>
                                </div>
                                
                               
                              
                                <div class="form-group" style="margin-right:0 !important; margin-left:0 !important; ">
                                              <label class="col-sm-3 col-lg-2 control-label">Image Upload<i class="red">*</i></label>
                                              <div class="col-sm-9 controls">
                                               <div class="fileupload fileupload-new" data-provides="fileupload">
                                                  <div class="fileupload-new img-thumbnail" style="width: 200px; height: 150px;">
                                                      <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                  </div>
                                                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                  <div class="" id="photo_error"></div>
                                                 <div>
                                                     <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span>
                                                     <span class="fileupload-exists">Change</span>
                                                     <input type="file" class="file-input" name="sv_logo" id="fileUpload"  /></span>
                                                     <a id="removeButton" href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                 </div>
                                                <div class="error" id="err_image"></div>
                                            </div>
                                      </div>
                                 </div>
                             </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6  col-lg-5">
                            </div>
                            <div class="col-sm-6  col-lg-7">
                                    <input type="submit" name="adv_add" id="adv_add" class="btn btn-primary" value="Add">
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
<?php $this->load->view('admin/top-footer'); ?>
</div>
</div>
<script type="text/javascript">

</script>
<script type="text/javascript">
  /*$("#blogs_date" ).datepicker({
   changeYear: true,
   changeMonth: true,
   inline: true,
});*/


//add Blog  Page 
  $('#adv_add').on('click',function(){ 

    var adv_name=$('#adv_name').val();
    var fileUpload=$('#fileUpload').val();
    var ext_a=fileUpload.substring(fileUpload.lastIndexOf('.') + 1);
    
    var flag=1;
     $('#err_adv_name').html('');
     $('#err_image').html('');
     
    if(adv_name.trim()=='')
    {
      $('#err_adv_name').html('Please Enter Advertisement  Name.');
      flag=0;
    }

    if(fileUpload.trim()=='')
    {
      $('#err_image').html('Please Select Image.');
      flag= 0;
    }
    else
    if(!(ext_a == "jpg" || ext_a == "jpeg" || ext_a == "gif" || ext_a == "png" || ext_a == "GIF" || ext_a == "JPG" || ext_a == "JPEG" || ext_a == "PNG"))
    {
        $('#err_image').html('Only jpg, png, gif, jpeg type images is allowed');
        flag=0;
    }
    
    if(flag==1)
    {
      return true;
    }
    else
    {
      return false;
    }

  });
</script>