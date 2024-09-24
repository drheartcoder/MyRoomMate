<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Coming Soon Page</title>
        <meta name="description" content="">
		
		<!-- responsive viewport -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" href="apple-touch-icon.png"> 

        <!-- bootstrap css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/bootstrap.min.css">
		
		<!-- FontAwesome css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/font-awesome.min.css">
        
        <!--  CSS3 Animition css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/ain-css.css">
         
		<!-- style css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/style.css">
		
		<!-- responsive css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/coming-soon-one/css/responsive.css">
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
       
         <!-- Start Coming Soon Page One -->
        <div class="comming-soon-area text-center">
            <div class="display-table">
                <div class="display-table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="coming-text text-center">
                                        <h1>
                                        <!-- <em>C</em>
                                        <em class="planet left">O</em>
                                        <em>m</em>
                                        <em>i</em>
                                        <em>n</em>
                                        <em>g</em>
                                        <span class="space"></span>
                                        <em>S</em>
                                        <em class="planet right">O</em>
                                        <em>o</em>
                                        <em>n...</em> -->
                                       
                                        <em>u</em>
                                        <em>n</em>
                                        <em>d</em>
                                        <em>e</em>
                                        <em>r</em>
                                        <em>-</em>
                                        <em>c</em>
                                        <em class="planet right">o</em>
                                        <em >n</em>
                                        <em>s</em>
                                        <em>t</em>
                                        <em>r</em>
                                        <em>u</em>
                                        <em>c</em>
                                        <em>t</em>
                                        <em>i</em>
                                        <em class="planet left">o</em>
                                        <em>n</em>
                                        </h1>
                                        <p>you are invited our <?php echo PROJECT_NAME; ?> team </p>
                                </div>
                                <!-- <div class="countdown">
                                    <div class="simply-countdown-losange" id="simply-countdown-losange"></div>
                                </div>

                              <div class="social-icon text-center">
                                  <a href=""><i class="fa fa-facebook"></i></a>
                                  <a href="" class="one"><i class="fa fa-twitter"></i></a>
                                  <a href="" class="two"><i class="fa fa-youtube-play"></i>
                                  </a>
                              </div> -->
                            </div>
                        </div>
            </div>
                </div>
            </div>
        </div>
        <!-- End Coming Soon Page One -->
        
       <!-- Latest jQuery -->
        <script src="<?php echo base_url(); ?>assets/coming-soon-one/js/jquery-1.11.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/coming-soon-one/js/modernizr-2.8.3.min.js"></script>
        
        <!-- Simple Counter jQuery -->
		<script src="<?php echo base_url(); ?>assets/coming-soon-one/js/simplyCountdown.min.js"></script>
		
      <!-- Counter Active jQuery -->
       <script>
        var d = new Date(new Date().getTime() + 1099 * 120 * 120 * 2000);
           //jQuery Counter
        $('#simply-countdown-losange').simplyCountdown({
            year: d.getFullYear(),
            month: d.getMonth() + 1,
            day: d.getDate(),
            enableUtc: false
            //year: 2015, // required
           // month: 6, // required
            //day: 30, // required
            /* Options here */
        });
    </script>
    
		<!-- bootstrap jQuery -->
        <script src="<?php echo base_url(); ?>assets/coming-soon-one/js/bootstrap.min.js"></script>
      
		<!-- Theme jQuery -->
        <script src="<?php echo base_url(); ?>assets/coming-soon-one/js/main.js"></script>
    </body>
</html>
