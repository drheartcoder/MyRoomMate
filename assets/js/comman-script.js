/* here all js are added in ( training freelance) 
        Do not remove this all scripts 
 */




// hide show demo


$(document).ready(function(){


  $(".frm-input,input").keyup(function(){
    $(this).parent().find('.error-msg').html('');
    $(this).parent().find('.error').html('');
  });

 /* $("select").change(function(){
    $(this).parent().find('.error-msg').html('');
    $(this).parent().find('.error').html('');
  });
*/



    $("select").removeClass( "error" );
    $("select").click(function()  {
      //sweetAlert()
      setTimeout(function() {
           $(this).click();     
       },2);;
     
    });
    /*$('select').blur(function()  {
       setTimeout(function() {
          $( "select" ).removeClass( "error" )          
       },2);
    });
    $('button').click(function()   {
       setTimeout(function() {
          $( "select" ).removeClass( "error" )          
       },2);
    });*/

});      


//on click demo
$('.top').on('click', function() {

            $parent_box = $(this).closest('.box');
            $parent_box.siblings().find('.bottom').slideUp();
            $parent_box.find('.bottom').slideToggle(1000, 'swing');
        });
 

/*Responsive Tabs*/
  $(document).on('responsive-tabs.initialised', function(event, el) {
          console.log(el);
      });

  $(document).on('responsive-tabs.change', function(event, el, newPanel) {
      console.log(el);
      console.log(newPanel);
  });

  $('[data-responsive-tabs]').responsivetabs({
      initialised: function() {
          console.log(this);
      },
      change: function(newPanel) {
          console.log(newPanel);
      }
  });


/* !! sripts !! */ 

 /*   all zipcode character restriction */
/*  $(".cc_zipcode,.zipcode").keypress(function(event){
      var inputValue = event.which;

      if(!(inputValue <= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
       event.preventDefault(this); 
      }
  });   */
 /* end all zipcode character restriction */
 $('.cc_zipcode,.zipcode').on('keyup',function(){
    if(($(this).val().length) > 6){
      var zipcode = $(this).val().substring(0,6)
      $('.zipcode').val(zipcode);
      $('.cc_zipcode').val(zipcode);
    }
  });

 
  // allow letters and whitespaces only. T.A  
  $("#lname,#staff_name").keypress(function(event){
  var inputValue = event.which;
      if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
        
        /*$('#error_business_lname').show();
        $('#error_business_lname').html('Please enter only characters');

        $('#err_staff_name').show();
        $('#err_staff_name').html('Please enter only characters');*/
        event.preventDefault(); 
      }
      else
      {
        $('#err_staff_name').hide();
        $('#error_business_lname').hide();
      }
  });

  $("#fname,#name,#staff_lname").keypress(function(event){

      

      var inputValue = event.which;
      if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
        
        /*$('#error_business_fname').show();
        $('#error_business_fname').html('Please enter only characters');

        $('#error_name').show();
        $('#error_name').html('Please enter only characters');


        $('#err_staff_lname').show();
        $('#err_staff_lname').html('Please enter only characters');*/

        event.preventDefault(); 
      }
      else
      {
        $('#err_staff_lname').hide();
        $('#error_business_fname').hide();
      }
  });







//  allow letters and whitespaces only. 

 $(".num_restrict").keypress(function(event){
      var inputValue = event.which;
      if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
        event.preventDefault(); 
      }
 });

// end allow letters and whitespaces only. 

//  allow numbers only. 

$(".char_restrict").bind("keydown", function (event) {

    if(event.keyCode == 46     || event.keyCode   == 8      ||  event.keyCode  == 9  || event.keyCode  == 27     || event.keyCode == 13 || event.keyCode == 190 ||
      (event.keyCode == 65     && event.ctrlKey   === true) || (event.keyCode  == 61 && event.shiftKey === true) ||
      (event.keyCode >= 35     && event.keyCode   <= 39)) {
      return;
    }  else {
      if(event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
         event.preventDefault();
      }
    }
});
// end allow numbers only. 


// allow numbers only. T.A  
  $("#phone_number,#mobile_no").bind("keydown", function (event) {

    if(event.keyCode == 46     || event.keyCode   == 8      ||  event.keyCode  == 9  || event.keyCode  == 27     || event.keyCode == 13 || event.keyCode == 190 ||
      (event.keyCode == 65     && event.ctrlKey   === true) || (event.keyCode  == 61 && event.shiftKey === true) ||
      (event.keyCode >= 35     && event.keyCode   <= 39)) {
      return;
    }   
    else {
      if(event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
        /*$('#error_phone_number').show();
        $('#error_phone_number').html('Please enter only numbers');

        $('#error_mobile_no').show();
        $('#error_mobile_no').html('Please enter only numbers');*/

        
        event.preventDefault();
      }
      else
      {
        $('#error_phone_number').hide();
      }
    }

  });
  // end allow numbers only. 

$('#phone_number,#mobile_no').on('keyup',function(){

  if(($(this).val().length) > 10){
    var no = $(this).val().substring(0,10)

    $('#busi_phone').val(no);
    $('#phone_number').val(no);
    $('#mobile_no').val(no);
  }

});

$('#busi_phone').on('keyup',function(){

  if(($(this).val().length) > 16){
    var no = $(this).val().substring(0,16)
    $('#busi_phone').val(no);
  }

});



$('#busi_mobile').on('keyup',function(){

  if(($(this).val().length) > 16){
    var no = $(this).val().substring(0,16)
    $('#busi_mobile').val(no);
  }

});

/* disable copy pest into confirm password */
$('#confirm_new_password').bind("cut copy paste",function(e) {
 e.preventDefault();
});
/* end disable copy pest into confirm password */


/* !! end sripts !! */




$(".drop_down_more_filter").click(function(){
    $("#more_filter_container").slideToggle();
});
$(".drop_down_more_filter1").click(function(){
    $("#more_filter_container1").slideToggle();
});
$(".drop_down_more_filter2").click(function(){
    $("#more_filter_container2").slideToggle();
});
$(".drop_down_more_filter-edit").click(function(){
    $("#more_filter_container-edit").slideToggle();
});
$(".drop_down_more_filter-pay1").click(function(){
    $("#more_filter_container-pay-in").slideToggle();
});

// sticky menu
//var stickyNavTop = $('.header').offset().top;
//             var stickyNav = function() {
//                 var scrollTop = $(window).scrollTop();
//                 if (scrollTop > stickyNavTop) {
//                     $('.header').addClass('sticky');
//                 } else {
//                     $('.header').removeClass('sticky');
//                 }
//             };
//             stickyNav();
//             $(window).scroll(function() {
//                 stickyNav();
//             });


// flaunt menu start

;(function($) {

    // DOM ready
    $(function() {
        
        // Append the mobile icon nav
        $('.nav').append($('<div class="nav-mobile"></div>'));
        
        // Add a <span> to every .nav-item that has a <ul> inside
        $('.nav-item').has('ul').prepend('<span class="nav-click"><i class="nav-arrow"></i></span>');
        
        // Click to reveal the nav
        $('.nav-mobile').click(function(){
            $('.nav-list').toggle();
        });
    
        // Dynamic binding to on 'click'
        $('.nav-list').on('click', '.nav-click', function(){
        
            // Toggle the nested nav
            $(this).siblings('.nav-submenu').toggle();
            
            // Toggle the arrow using CSS3 transforms
            $(this).children('.nav-arrow').toggleClass('nav-rotate');
            
        });
        
    });
    
})(jQuery);

//droup down my accout top
        $(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeIn("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).fadeOut("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");
                });
        });

//responsive menu
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function() {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function() {
            $('#wrapper').toggleClass('toggled');
        });

//onclick toggle

$('.container1').hide();
$(".container1:first").addClass("act1").show();
$('.regi_toggle button').click(function () {
    $('button').removeClass('servi-act'); //remove the class from the button
    $(this).addClass('servi-act'); //add the class to currently clicked button
    var target = "#" + $(this).data("target");
    $(".container1").not(target).hide();
    $(target).show();
    target.slideToggle();
});



/*<!--img resize start -->*/

         $(function() {
                   if ( ! Modernizr.objectfit ) {
  $('.post__image-container').each(function () {
    var $container = $(this),
        imgUrl = $container.find('img').prop('src');

    if (imgUrl) {
      $container
        .css('backgroundImage', 'url(' + imgUrl + ')')
        .addClass('compat-object-fit');
    }  
  });
}
         });
   
     /* <!--img resize end -->*/