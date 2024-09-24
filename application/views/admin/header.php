<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title><?php echo $page_title; ?> - <?php echo PROJECT_NAME;?></title>
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <!--base css styles-->
  <?php
  $onClass 		= $this->router->fetch_class();
  $onMethod	  = $this->router->fetch_method();
  $_Combine	  =	$onClass.'|'.$onMethod;
  ?>
 
  <link rel="icon" href="<?php echo base_url(); ?>images/fevicon/favicon.png" type="image/x-icon" />

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap.min.css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/font-awesome.min.css" media="screen" />

  <!--Form_component css styles-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/chosen.min.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/jquery.tagsinput.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/jquery.pwstrength.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap-fileupload.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap-duallistbox.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/dropzone.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/colorpicker.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/timepicker.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/clockface.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/datepicker.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/daterangepicker.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap-switch.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/bootstrap-wysihtml5.css" media="screen" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/back-panel/paginate_stylsheet.css" media="screen" />
  <script type="text/javascript">
  var site_url="<?php echo base_url();?>"	
  </script>


  <!--Form_component css styles-->
  <!--UI General Gritter-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/jquery.gritter.css" media="screen" />
  <!--UI General Gritter-->
  <!--DynamicTable-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/dataTables.bootstrap.css" media="screen" />
  <!--DynamicTable-->
  <!--Calendar Files-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/jquery-ui.min.css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/fullcalendar.css" media="screen" />
  <!--Calendar Files-->
  <!--flaty css styles-->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/flaty.css" media="screen"  />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/back-panel/flaty-responsive.css" media="screen" />
  <link rel="shortcut icon" href="img/favicon.png" />
  <!--basic scripts-->
  <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script> -->
  <script type="text/javascript"> 
  var siteUrl ='<?php echo base_url().ADMIN_PANEL_NAME; ?>';
  </script>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.js"></script>
<!--<script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/back-panel/jquery-2.0.3.min.js"><\/script>')</script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.magnific-popup.min.js"></script>
<!--page specific plugin scripts-->
<!--Dasboard Files-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.crosshair.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.flot.tooltip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flot/jquery.sparkline.min.js"></script>
<!--Dasboard Files-->

<!--Form_component Files-->
<script type="text/javascript">
var site_url = '<?php echo base_url(); ?>';
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



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-inputmask.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.pwstrength.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-duallistbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/dropzone.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/clockface.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-switch.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/ckeditor/ckeditor.js"></script> 
<!--Form_component Files-->
<!--Form_validation Files-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/additional-methods.min.js"></script>
<!--Form_validation Files-->
<!--Form_Wizard Files-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.bootstrap.wizard.js"></script>
<!--Form_Wizard Files-->
<!--dynamicTable-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/dataTables.bootstrap.js"></script>
<!--dynamicTable-->
<!--UI General Gritter-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery.gritter.js"></script>
<!--UI General Gritter-->
<!--Calendar Files-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/fullcalendar.min.js"></script>
<!--Calendar Files-->
<!--flaty scripts-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flaty.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/back-panel/flaty-demo-codes.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.alphanum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/admin_validations.js"></script>
<!--popup banner scripts-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/back-panel/prettyPhoto.css">
<!-- <script src="<?php echo base_url();?>assets/js/back-panel/jquery.prettyPhoto.js"></script>
 -->
<script src="<?php echo base_url();?>assets/T-validations/masterT-validations.js"></script>




<!-- fusionvhart-->
<!-- <script type="text/javascript" src="<?php echo base_url();?>assets/fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/fusioncharts/js/themes/fusioncharts.theme.fint.js"></script> -->

</head>
<body class="skin-blue" 
      data-base-url="<?php echo base_url(); ?>" 
      data-token-name="<?php echo $this->security->get_csrf_token_name(); ?>"
      data-token-value="<?php echo $this->security->get_csrf_hash(); ?>"
      >


<!-- active tab script T.A-->
  <script>
  $(document).ready(function() {
    if(location.hash) {
      $('a[href=' + location.hash + ']').tab('show');
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
      location.hash = this.getAttribute("href");
    });
  });
  $(window).on('popstate', function() {
    var anchor = location.hash || $("a[data-toggle=tab]").first().attr("href");
    $('a[href=' + anchor + ']').tab('show');
  }); 
  </script>
<!--end active tab script-->

<script type="text/javascript">
function ajaxindicatorstart(text)
{
  /*if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
  jQuery('body').append('<div id="resultLoading" style="display:none"><div><img height="100" width="100" src="<?php echo base_url(); ?>images/loader/preloader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
  }

  jQuery('#resultLoading').css({
    'width':'100%',
    'height':'100%',
    'position':'fixed',
    'z-index':'10000000',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto'
  });

  jQuery('#resultLoading .bg').css({
    'background':'#000000',
    'opacity':'0.7',
    'width':'100%',
    'height':'100%',
    'position':'absolute',
    'top':'0'
  });

  jQuery('#resultLoading>div:first').css({
    'width': '250px',
    'height':'75px',
    'text-align': 'center',
    'position': 'fixed',
    'top':'0',
    'left':'0',
    'right':'0',
    'bottom':'0',
    'margin':'auto',
    'font-size':'16px',
    'z-index':'10',
    'color':'#ffffff'

  });

    jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');*/
}
function ajaxindicatorstop()
{
   /* jQuery('#resultLoading .bg').height('100%');
       jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');*/
}
</script>
<script type="text/javascript">

 /* $(window).on('beforeunload', function(){
        ajaxindicatorstart('Please wait..');
  });

  $(document).ready(function(){
    ajaxindicatorstart('Please wait..');
  });
  $(window).bind("load", function() { 
    ajaxindicatorstop();
  });*/
</script>