<script src="http://192.168.1.101/myroommate/front-asset/js/jquery-1.11.3.min.js" type="text/javascript"></script>

<div class="main-inner-gray">
    <div class="container">
     
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                <?php $this->load->view('user/left-menu'); ?>  
            </div>

            <div class="col-sm-12 col-md-9 col-lg-9">
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
       		
 <form enctype="multipart/form-data" action="<?php echo base_url();?>/user/my_image" method="post">
    <div class="form-group boxdoc">


            <label class="col-sm-3 col-lg-2 control-label">Attach Images</label>
           
           <input type="hidden" name="listing_id" id="listing_id" value="<?php echo $img_slug; ?>" />

           <div class="col-sm-9 controls sv_image">
              <!-- <input type="file" id="profile_image" style="visibility:hidden; height: 0;" name="file"/>
              <div class="input-group ">
                 <input type="text" class="form-control file-caption  kv-fileinput-caption" id="profile_image_name" disabled="disabled"/>
                 <div class="btn btn-primary btn-file btn-gry">
                    <a class="file" onclick="browseImage()">Browse...</a>
                 </div>
                 <div class="btn btn-primary btn-file remove" style="border-right:1px solid #fbfbfb !important;display:none;" id="btn_remove_image">
                    <a class="file" onclick="removeBrowsedImage()"><i class="fa fa-trash"></i></a>
                 </div>
              </div> -->
              
              
               <input type="file" class="file-input img" name="sv_image[]" id="fileUpload"/>
               <button type="button" class="remove_img">Remove</button> 
               <div class="error" id="err_img"></div>    
           </div> 
    </div> </br></br>
  <div class="form-group">  
     <label class="col-sm-3 col-lg-2 control-label"></label>
     <div class="col-sm-9 controls">
      <input class="button-imgadd" name="button-imgadd" id="button-imgadd" type="button" value="+"> 

    </div>
 </div> 
 
  <button type="submit" class="uplod_img" id="uplod_img" name="uplod_img" value="submit">Upload</button>
  <!-- <a href="<?php echo base_url()?>user/mylisting">Back</a> -->
 </form>

</div>
 </div>
 </div>
</div>

<!--Image Upload Start Here-->
<script type="text/javascript">
  /*function browseImage() {
         
         $("#profile_image").trigger('click');
         }
         
         function removeBrowsedImage() {
         $('#profile_image_name').val("");
         $("#btn_remove_image").hide();
         $("#profile_image").val("");
         }
         
         
         // This is the simple bit of jquery to duplicate the hidden field to subfile
         $('#profile_image').change(function() {
           if ($(this).val().length > 0) {
               $("#btn_remove_image").show();
           }
         
           $('#profile_image_name').val($(this).val());
         });*/
</script>
<!--Image Upload End Here-->

<script type="text/javascript">

$(document).ready(function(){
  $('.remove_img:first').hide();
});
  
$('.button-imgadd').click(function()
{
    var limit= 5;
     var image=$('.img:last').val();
     var ext=image.substring(image.lastIndexOf('.')+1);
     if(ext!="")
     {
        if(ext=="jpg" || ext=="png" || ext=="gif" || ext=="jpeg" || ext=="JPG"|| ext=="PNG" || ext=="JPEG" || ext=="GIF")
        {
          if($('.sv_image').length <  limit)
          {  
            var new_ele =$('.sv_image:first').clone().insertAfter(".sv_image:last");
            new_ele.find('input').val("");
            $('.remove_img:last').show();
          }
        }
        else
        {
          $('div#err_img:last').show();
          $('div#err_img:last').fadeIn(3000);
          $('div#err_img:last').html('Please select valid image.');
          setTimeout(function()
          {
              $('div#err_img:last').fadeOut('slow');
          },3000);
          $('div#err_img:last').focus();
          return false;
        }
    }
    else
    {
      $('div#err_img:last').show();
          $('div#err_img:last').fadeIn(3000);
          $('div#err_img:last').html('Please select image.');
          setTimeout(function()
          {
              $('div#err_img:last').fadeOut('slow');
          },3000);
          $('div#err_img:last').focus();
          return false;
    }
    
});

/*$('.remove_img').on('click',function()*/
$(document).on('click', '.remove_img', function () 
{  
   if($('.remove_img').length != '1'){
    $(this).closest('.sv_image').remove();
   }

});


</script>