<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <?php if($_GET['sercategory_id']!='') { 

        $this->db->where('category_id' , $_GET['sercategory_id']);
        $metacategory = $this->master_model->getRecords('tbl_category_master');
        $meta_tag_title = $metacategory[0]['meta_tag_title'];
        $meta_tag_description = $metacategory[0]['meta_tag_description'];
        $meta_tag_keywords = $metacategory[0]['meta_tag_keywords'];
        ?>

        <title>MyRoommate.ae : <?php echo $meta_tag_title; ?></title>
        <meta name="description" content="<?php echo $meta_tag_description; ?>"/>
        <meta name="keywords" content="<?php echo $meta_tag_keywords; ?>" />

    <?php } else { ?>
        
        <title>MyRoommate.ae</title>

        <meta name="description" content="MyRoommate.ae is the number one classified website to help people find bedspace, roommates 
        and rooms in Dubai, Abu Dhabi and the rest of UAE, sell their used cars or giveaway un-needed items. " />
        
        <meta name="keywords" content="rooms in dubai, roommates in dubai, roommates in abu dhabi, rooms in abu dhabi, rooms in uae, bedspace in uae, bedspace in dubai, sharing in dubai, bedspace in abu dhabi, used cars, used cars in dubai, room sharing in uae, room sharing in dubai" />

    <?php } ?>
    <script type='text/javascript' src='http://192.168.1.8/myroommate/web/cn/cn.php'></script>
    <meta name="author" content="IT Essentials FZE" />

    <!-- ======================================================================== -->
    
    <script type="text/javascript">
        var site_url = "<?php echo base_url(); ?>";
    </script>
    
    <!--materialize css-->
    <link href="<?php echo base_url(); ?>front-asset/css/materialize.css" rel="stylesheet" type="text/css" />
    
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>front-asset/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- main CSS -->
    <link href="<?php echo base_url(); ?>front-asset/css/my-roommate.css" rel="stylesheet" type="text/css" />
    <!--font-awesome-css-start-here-->
    <link href="<?php echo base_url(); ?>front-asset/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <link href="http://www.myroommate.ae/front-asset/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!--core js-->
    <script src="<?php echo base_url(); ?>front-asset/js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/bootstrap.min.js" type="text/javascript"></script>
    

    <!--modal-->
    <link href="<?php echo base_url(); ?>front-asset/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>front-asset/js/modalmanager.js" type="text/javascript"></script>
    
  
    
    <script src="<?php echo base_url(); ?>front-asset/js/bootstrap-modal.js" type="text/javascript"></script>
    <!--custom angular js-->
     
    <!--angular js-->
    <script src="<?php echo base_url(); ?>front-asset/js/angular.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/angular-route.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/angular-messages.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/angular-animate.js" type="text/javascript"></script>
    
    
    <!--    Product Details Slider-->
    <script src="<?php echo base_url(); ?>front-asset/js/jquery.jcarousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/boot.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>front-asset/js/lightbox.min.js" type="text/javascript"></script>
     <script>eval(mod_pagespeed_WAWJZAdXEv);</script>
		<script>eval(mod_pagespeed_RcpwFJIp$_);</script>
		<script>eval(mod_pagespeed_FSUaW1Y3vq);</script>
		<script>eval(mod_pagespeed_0KqYEZWOa_);</script>
		<script>eval(mod_pagespeed_dWA3BZo97w);</script>
		<script>eval(mod_pagespeed_fZpiBTJPUH);</script>
		<script>eval(mod_pagespeed_oGaklZrnQk);</script>
		<script>eval(mod_pagespeed_7uW5S6VuLq);</script>
		<script>eval(mod_pagespeed_F7swirz2G$);</script>
		<script>eval(mod_pagespeed_JOPDUu3b98);</script>
		<script>eval(mod_pagespeed_fERGRPwicm);</script>
		<script>echo.init({offset:100,throttle:250,unload:false});</script>
   
   
    <!-- Custome Angular JS -->
    <script src="<?php echo base_url(); ?>front-asset/js/app.js" type="text/javascript"></script>
    
    <!-- comman-script -->
    <script src="<?php echo base_url(); ?>front-asset/js/comman-script.js" type="text/javascript"></script>
    
   
    
    <style type="text/css">
    .modal.container {max-width: none;}
    .modal-backdrop {position: fixed;top: 0;right: 0;bottom: 0;left: 0;z-index: 1040;}
    </style>
    
</head>
<body ng-app="myApp" scroll-to-top id="top" >
<div id="main"></div>
    <?php $get_site_status = $this->master_model->getRecords('admin_login'); ?>

    <?php if($get_site_status[0]['site_status'] == '1') { ?>


        <?php
        if($this->session->userdata('user_id') !=""){
            $this->load->view('home-header',$page_title);
        }else{
            $this->load->view('home-header',$page_title);
        }


        $this->load->view($middle_content);
        $this->load->view('footer');
        ?>

    <?php } else {
    $this->load->view('underconstruction');
    } ?>


<script type="text/javascript">
    function ajaxindicatorstart(text)
    {
        /*if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading')
        {
            jQuery('body').append('<div id="resultLoading" style="display:none"><div><img style="height:120px;width:120px;" src="<?php echo base_url(); ?>images/loader/preloader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
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
        /*jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
        jQuery('body').css('cursor', 'default');*/
    }

</script>

<script type="text/javascript">

  $(window).on('beforeunload', function(){
        //ajaxindicatorstart('Please wait..');
  });

  $(document).ready(function(){
      //ajaxindicatorstart('Please wait..');
  });

  $(window).bind("load", function() { 
    //ajaxindicatorstop();
  });
</script>
</body>
</html>