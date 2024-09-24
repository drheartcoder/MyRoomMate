/* Master jquery made by tushar */

$(document).ready(function(){

    //  allow  letters and whitespaces only. 
    $(".num_restrict").keypress(function(event){
          var inputValue = event.which;
          $(this).parent().find('.wrapDiv').html('');
          if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 

            /*$(this).parent().find('.error,.err').html('only character allow');*/
            
            event.preventDefault(); 
          }
          else
          {
            $(this).parent().find('.wrapDiv').html('');
          }
     });
  
    //  allow numbers only. 
    $(".char_restrict").bind("keydown", function (event) {
        $(this).parent().find('.wrapDiv').html('');
        if(event.keyCode == 46     || event.keyCode   == 8      ||  event.keyCode  == 9  || event.keyCode  == 27     || event.keyCode == 13 || event.keyCode == 190 ||
          (event.keyCode == 65     && event.ctrlKey   === true) || (event.keyCode  == 61 && event.shiftKey === true) ||
          (event.keyCode >= 35     && event.keyCode   <= 39)) {
          return;
        } else {
          if(event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
             /*$(this).parent().find('.error,.err').html('only number allow');*/
             
             event.preventDefault();
          }
          else
          {
            $(this).parent().find('.wrapDiv').html('');
          }
        }
    });

    //  allow numbers only. 
    $(".mo_char_restrict").bind("keydown", function (event) {
        $(this).parent().find('.wrapDiv').html('');
        if(event.keyCode == 46     || event.keyCode   == 8      ||  event.keyCode  == 9  || event.keyCode  == 27     || event.keyCode == 13  ||
          (event.keyCode == 65     && event.ctrlKey   === true) || (event.keyCode  == 61 && event.shiftKey === true) ||
          (event.keyCode >= 35     && event.keyCode   <= 39)) {
          return;
        } else {
          if(event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
             /*$(this).parent().find('.error,.err').html('only number allow');*/
             
             event.preventDefault();
          }
          else
          {
            $(this).parent().find('.wrapDiv').html('');
          }
        }
    });

    // allow 14 digit number.
    $('.allowOnlyfourteen').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 14){
        var no = $(this).val().substring(0,14)
        $(this).val(no);
        /*$(this).parent().find('.error,.err').html('only 14 number allow');*/
    }});
  

    // allow 14 digit number.
    $('.allowOnlyfourty').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 40){
        var no = $(this).val().substring(0,40)
        $(this).val(no);
        //$(this).parent().find('.error,.err').html('only 40 number allow');

    }});

    // allow 14 digit number.
    $('.allowOnlyFourteen').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 14){
        var no = $(this).val().substring(0,14)
        $(this).val(no);
        //$(this).parent().find('.error,.err').html('only 40 number allow');
    }});

    // allow 14 digit number.
    $('.allowOnlySixteen').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 16){
        var no = $(this).val().substring(0,16)
        $(this).val(no);
        //$(this).parent().find('.error,.err').html('only 40 number allow');

    }});

    // allow 10 digit number.
    $('.allowOnlyten').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 10){
        var no = $(this).val().substring(0,10)
        $(this).val(no);
        /*$(this).parent().find('.error,.err').html('only 10 number allow');*/
    }});

    // allow 6 digit number.
    $('.allowOnlysix').on('keyup',function(){
      $(this).parent().find('.wrapDiv').html('');
      if(($(this).val().length) > 6){
        var no = $(this).val().substring(0,6)
        $(this).val(no);
        /*$(this).parent().find('.error,.err').html('only 10 number allow');*/
    }});
 

    //restrict space.
    $(".space_restrict").keypress(function(event){
        $(this).parent().find('.wrapDiv').html('');
        var inputValue = event.which;
        if(!(inputValue >= 65 && inputValue <= 122 ) && (inputValue == 32 && inputValue!=8 && inputValue != 0 )) { 
            /*$(this).parent().find('.error,.err').html('space not allowed');*/
            event.preventDefault(); 
        }
        else
        {
            $(this).parent().find('.wrapDiv').html('');
        }
    });


    /* image restriction */

    $('.allowOnlyImg').change(function() {
      $('#err-img').html('');
      var profile_pic   = $(this).val();
      var ext_a         = profile_pic.substring(profile_pic.lastIndexOf('.') + 1);
      if(profile_pic!='') {
        if(!(ext_a == "jpg" || ext_a == "jpeg" || ext_a == "gif" || ext_a == "png" || ext_a == "GIF" || ext_a == "JPG" || ext_a == "JPEG" || ext_a == "PNG")) {
          $('#err-img').html('Only jpg, png, gif, jpeg type images is allowed');
          setTimeout(function(){
            $('#err-img').html('');
          },2000);
          $(this).val('');
          event.preventDefault(); 
        }
        else {
            $('#err-img').html('');
        }
      }
    });

    /* restrict copy cmf pass */
    $('.CopyPast_restrict').bind("cut copy paste",function(e) {
     $(this).parent().find('.wrapDiv').html('');
     e.preventDefault();
    });

    /* textbox beginning space resriction -    Tushar A */
    $(".beginningSpace_restrict").on('keyup keypress',function(event) { 
      var textVal = $(this).val();
      if(textVal.indexOf(" ") !== -1) {
        if(textVal == " ") {
          $(this).val('');
          event.preventDefault();
        }
        else {
          
            $(this).parent().find('.wrapDiv').html('');
        }
      }
       
    });

    //valid_email
    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    $(".valid_email").blur(function(event){

        if($(this).val() != "")
        {
            $(this).parent().find('.wrapDiv').html('');
            if(!filter.test($(this).val())) { 
                $(this).val('');
                event.preventDefault(); 
            }
            else{
                $(this).parent().find('.wrapDiv').html('');
            }
        }   

    });



}); // end ready

/* end Master jquery made by tushar */