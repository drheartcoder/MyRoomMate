$(document).ready(function(){

  // Check Username already exists
  $(".check_username").on('blur', function(){

    var username          = $("#registerusername").val();

    if(username != "")
    {
       $.ajax({
        url:site_url+'signup/check_username',
        type:'POST',
        data:{username:username},
        dataType:'json',
        success:function(response)
        {
            if(response.username_status == "error")
            {
                $('#err_register_username').html('Username already exits. Please use some other Username.');
                $('#err_register_username').show();
                $('#err_register_username').fadeOut(4000);
                $('#registerusername').focus();
                $('#signup').attr('disabled',true);
                return false;


            }
            else if(response.username_status == 'success')
            {
               $('#err_register_username').show();
               $('#signup').attr('disabled',false);
               return true;
            }
        }
      });
    }// end if

  });

  // login Validation 
  $("#login-button").on('click', function(){

    //var uemail            = $("#email").val();
    var username          = $("#username").val();
    var password          = $("#password").val();
    var url               = $("#page_url").val();
    var page_url_segment  = $("#page_url_segment").val();

   /*if(page_url_segment == 'home'){
    var  page_url  = site_url+'user/dashboard'; 
   }
   else{
    var page_url   = url;
   }*/
    
    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var flag=1;

    /*if(uemail=="")
    {
      $('#err_login_email').html('Enter Email Address.');
            
      $('#err_login_email').show();
      $('#email').focus();
      $('#email').on('keyup', function(){
        $('#err_login_email').hide();
      });

      flag=0;
    
    } else if(!filter.test(uemail))
    {
      $('#err_login_email').html('Please enter valid email.');
      $('#err_login_email').show();
      $('#email').focus();
      $('#email').on('keyup', function(){
        $('#err_login_email').hide();
      });
      flag=0;
    }
    else
    {
      $('#err_login_email').html('');
    }*/

    if(username == "")
    {
      $('#err_login_username').html('Enter Username.');
            
      $('#err_login_username').show();
      $('#err_login_username').fadeOut(4000);
      $('#username').focus();
      $('#username').on('keyup', function(){
        $('#err_login_username').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_login_username').html('');
    }

    if(password == "")
    {
      $('#err_login_password').html('Enter Password.');
            
      $('#err_login_password').show();
      $('#err_login_password').fadeOut(4000);
      $('#password').focus();
      $('#password').on('keyup', function(){
        $('#err_login_password').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_login_password').html('');
    }

    if(flag == 0) {
      return false;
    } else {
      
       ajaxindicatorstart();
       
       $.ajax({
        url:site_url+'login/login',
        type:'POST',
        data:{username:username, password:password, url:url, page_url_segment:page_url_segment},
        dataType:'json',
        success:function(response)
        {

          if(response.status == "LoginSuccess") {
            $("#login_error").html();
            $("#login_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();

              window.location.href = response.URL;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#login_success").html();
            $("#login_error").html(response.msg);
          }

          return true;

        }
      });


      /*var uemail=$("#email").val("");*/
      var username=$("#username").val("");
      var password=$("#password").val("");
      $('#login_error').html('');
      $('#login_success').html('');

      return false;
    }

  });

  // Registration Validation 
  $("#register-button").on('click', function(){

    var uemail    =$("#registeremail").val();
    var username  =$("#registerusername").val();
    var mobile    =$("#registermobile").val();
    var gender    =$("#gender").val();
    var country   =$("#country").val();
    var password1 =$("#registerpassword1").val();
    var password2 =$("#registerpassword2").val();
    var url       =$("#page_url").val();
    var page_url_segment =$("#page_url_segment").val();

   if(page_url_segment == 'home'){
    var  page_url  = site_url+'user/dashboard'; 
   }
   else{
    var page_url   = url;
   }

    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var filter1 = /^[0-9-+]+$/;
    var flag=1;

    if(uemail=="")
    {
      $('#err_register_email').html('Enter Email Address');        
      $('#err_register_email').show();
      $('#err_register_email').fadeOut(4000);
      $('#registeremail').focus();
      $('#registeremail').on('keyup', function(){
        $('#err_register_email').hide();
      });

      flag=0;
    
    } else if(!filter.test(uemail))
    {
      $('#err_register_email').html('Please enter valid email.');
      $('#err_register_email').show();
      $('#err_register_email').fadeOut(4000);
      $('#registeremail').focus();
      $('#registeremail').on('keyup', function(){
        $('#err_register_email').hide();
      });
      flag=0;
    }
    else
    {
      $('#err_register_email').html('');
    }

    if(mobile=="")
    {
      $('#err_register_mobile').html('Enter Mobile Number');  
      $('#err_register_mobile').show();
      $('#err_register_mobile').fadeOut(4000);
      $('#registermobile').focus();
      $('#registermobile').on('keyup', function(){
        $('#err_register_mobile').hide();
      });      
      flag=0;
    
    } else if(!filter1.test(mobile))
    {
      $('#err_register_mobile').html('Please enter valid mobile number.');
      $('#err_register_mobile').show();
      $('#err_register_mobile').fadeOut(4000);
      $('#registermobile').focus();
      $('#registermobile').on('keyup', function(){
        $('#err_register_mobile').hide();
      });      
      flag=0;
    }
    else
    {
      $('#err_register_mobile').html('');
    }


    if(username == "")
    {
      $('#err_register_username').html('Enter Username.');            
      $('#err_register_username').show();
      $('#err_register_username').fadeOut(4000);
      $('#registerusername').focus();
      $('#registerusername').on('keyup', function(){
        $('#err_register_username').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_username').html('');
    }

    if(gender== "")
    {
      $('#err_register_gender').html('Select gender');
            
      $('#err_register_gender').show();
      $('#err_register_gender').fadeOut(4000);
      $('#gender').focus();
      $('#gender').on('keyup', function(){
        $('#err_register_gender').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_gender').html('');
    }

    if(country== "")
    {
      $('#err_register_country').html('Select country.');
            
      $('#err_register_country').show();
      $('#err_register_country').fadeOut(4000);
      $('#country').focus();
      $('#country').on('keyup', function(){
        $('#err_register_country').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_country').html('');
    }

    if(password1 == "")
    {
      $('#err_register_password1').html('Enter Password.');
            
      $('#err_register_password1').show();
      $('#err_register_password1').fadeOut(4000);
      $('#registerpassword1').focus();
      $('#registerpassword1').on('keyup', function(){
        $('#err_register_password1').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password1').html('');
    }

    if(password2 == "")
    {
      $('#err_register_password2').html('Enter Confirm Password.');
            
      $('#err_register_password2').show();
      $('#err_register_password2').fadeOut(4000);
      $('#registerpassword2').focus();
      $('#registerpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    } 
    else if(password2 != password1)
    {
      $('#err_register_password2').html('Password does not match.');
      
      $('#err_register_password2').show();
      $('#err_register_password2').fadeOut(4000);
      $('#registerpassword2').focus();
      $('#registerpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password2').html('');
    }


    if(flag == 0) {
      return false;
    } else {

      ajaxindicatorstart();

      $.ajax({
        url:site_url+'signup/register',
        type:'POST',
        data:{uemail:uemail,username:username,mobile:mobile,gender:gender,country:country,password1:password1},
        dataType:'json',
        success:function(response)
        {
           if(response.status == "success") {
            $("#register_error").html();
            $("#register_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              window.location.href = page_url;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#register_success").html();
            $("#register_error").html(response.msg);
          }

          return true;
        }
      });

      var uemail=$("#registeremail").val("");
      var mobile=$("#registermobile").val("");
      var username=$("#registerusername").val("");
      var password1=$("#registerpassword1").val("");
      var password2=$("#registerpassword2").val("");

      $('#register_error').html('');
      $('#register_success').html('');

      return false;
    }

  });


  // Forgot Validation 
  $("#forgot-button").on('click', function(){

    var uemail=$("#forgotemail").val();
    var url =$("#page_url").val();
    var page_url_segment =$("#page_url_segment").val();

   if(page_url_segment == 'home'){
    var  page_url  = site_url+'user/dashboard'; 
   }
   else{
    var page_url   = url;
   }
    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var flag=1;

    if(uemail=="")
    {
      $('#err_forgot_email').html('Enter Email Address.');
            
      $('#err_forgot_email').show();
      $('#forgotemail').focus();
      $('#forgotemail').on('keyup', function(){
        $('#err_forgot_email').hide();
      });

      flag=0;
    
    } else if(!filter.test(uemail))
    {
      $('#err_forgot_email').html('Please enter valid email.');
      $('#err_forgot_email').show();
      $('#forgotemail').focus();
      $('#forgotemail').on('keyup', function(){
        $('#err_forgot_email').hide();
      });
      flag=0;
    }
    else
    {
      $('#err_forgot_email').html('');
    }

    if(flag == 0) {
      return false;
    } else {

      ajaxindicatorstart();

      $.ajax({
        url:site_url+'login/forgot_password',
        type:'POST',
        data:{email:uemail},
        dataType:'json',
        success:function(response)
        {
          if(response.status == "success") {
            $("#forgot_error").html();
            $("#forgot_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              window.location.href = page_url;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#forgot_success").html();
            $("#forgot_error").html(response.msg);
          }


        }
      });

      var uemail=$("#forgotemail").val("");
      return false;
    }

  });


  // Reset Password Validation 
  $("#reset-button").on('click', function(){

    var password1=$("#resetpassword1").val();
    var password2=$("#resetpassword2").val();
    var confirm_code=$("#confirm_code").val();

    var flag=1;

    if(password1 == "")
    {
      $('#err_register_password1').html('Enter Password.');
            
      $('#err_register_password1').show();
      $('#resetpassword1').focus();
      $('#resetpassword1').on('keyup', function(){
        $('#err_register_password1').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password1').html('');
    }

    if(password2 == "")
    {
      $('#err_register_password2').html('Enter Confirm Password.');
            
      $('#err_register_password2').show();
      $('#resetpassword2').focus();
      $('#resetpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    } 
    else if(password2 != password1)
    {
      $('#err_register_password2').html('Password does not match.');
            
      $('#err_register_password2').show();
      $('#resetpassword2').focus();
      $('#resetpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password2').html('');
    }


    if(flag == 0) {
      return false;
    } else {

      ajaxindicatorstart();

      $.ajax({
        url:site_url+'login/reset_password',
        type:'POST',
        data:{newpwd:password1,confirm_code:confirm_code},
        dataType:'json',
        success:function(response)
        {
          if(response.status == "success") {
            $("#reset_error").html();
            $("#reset_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              window.location.href = response.URL;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#reset_success").html();
            $("#reset_error").html(response.msg);
          }

          return true;
        }
      });

      var password1=$("#resetpassword1").val("");
      var password2=$("#resetpassword2").val("");

      $('#reset_error').html('');
      $('#reset_success').html('');

      return false;
    }

  });


  // Reset Password Validation 
  $("#reset-button-old").on('click', function(){

    var username=$("#username").val();
    var password1=$("#resetpassword1").val();
    var password2=$("#resetpassword2").val();
    var confirm_code=$("#confirm_code").val();

    var flag=1;

    if(username == "")
    {
      $('#err_register_username').html('Enter Username.');
            
      $('#err_register_username').show();
      $('#username').focus();
      $('#username').on('keyup', function(){
        $('#err_register_username').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_username').html('');
    }

    if(password1 == "")
    {
      $('#err_register_password1').html('Enter Password.');
            
      $('#err_register_password1').show();
      $('#resetpassword1').focus();
      $('#resetpassword1').on('keyup', function(){
        $('#err_register_password1').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password1').html('');
    }

    if(password2 == "")
    {
      $('#err_register_password2').html('Enter Confirm Password.');
            
      $('#err_register_password2').show();
      $('#resetpassword2').focus();
      $('#resetpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    } 
    else if(password2 != password1)
    {
      $('#err_register_password2').html('Password does not match.');
            
      $('#err_register_password2').show();
      $('#resetpassword2').focus();
      $('#resetpassword2').on('keyup', function(){
        $('#err_register_password2').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_register_password2').html('');
    }


    if(flag == 0) {
      return false;
    } else {

      ajaxindicatorstart();

      $.ajax({
        url:site_url+'login/resetpassword',
        type:'POST',
        data:{username:username,newpwd:password1,confirm_code:confirm_code},
        dataType:'json',
        success:function(response)
        {
          if(response.status == "success") {
            $("#reset_error").html();
            $("#reset_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              window.location.href = response.URL;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#reset_success").html();
            $("#reset_error").html(response.msg);
          }

          return true;
        }
      });

      var password1=$("#resetpassword1").val("");
      var password2=$("#resetpassword2").val("");

      $('#reset_error').html('');
      $('#reset_success').html('');

      return false;
    }

  });


  $("#subscribe-new").on('click', function(){
      var sub_email=$("#sub_email").val();
      var site_url=$("#base_url").val();
      var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
      var flag=1;
     if(sub_email=="")
      {
        $('#err_email_id').html('Enter Email Address.');
          
      $('#err_email_id').show();
      $('#sub_email').focus();
      $('#sub_email').on('keyup', function(){
        $('#err_email_id').hide();
          });
      flag=0;
      }
      else if(!filter.test(sub_email))
      {
        $('#err_email_id').html('Please enter valid email.');
      
        $('#err_email_id').show();
      $('#sub_email').focus();
      $('#sub_email').on('keyup', function(){
        $('#err_email_id').hide();
          });
      flag=0;
      }
      else
      {
        $('#err_email_id').html('');
      }

      if(flag==1)
      {

        ajaxindicatorstart();

        $.ajax({
              url:site_url+'home/newslettersubscribe/',
              type:'POST',
              data:{sub_email:sub_email},
              success:function(res)
              {
                ajaxindicatorstop();
                if(res=="exists")
                  {
                    $("#news_success").hide();
                    $("#news_error").show();
                    $("#news_error").html("You are already subscribed.");
                  }
                  else if(res=="error")
                  {
                    $("#news_success").hide();
                    $("#news_error").show();
                    $("#news_error").html("Please try again.");
                  }
                  else if(res=="success")
                  {
                      $('#email_id').val('');
                      $("#news_error").hide();
                      $("#news_success").show();
                      $("#news_success").html("Newsletters subscribed successfully.");
                  }
              }
          });
      }else
      {
        $("#news_success").hide();
        $("#news_error").hide();
        return false;
      }
  });

  // submit for to get list of Residence or cities form
  $( "#country" ).change(function() {
    
      var countryid = $('#country').val();

        $.ajax({
          url:site_url+'user/getResidence',
          type:'POST',
          data:{countryid:countryid},
          success:function(response)
          { 
            $('#countryofresidence').html(response);
            return true;
          }
        });
      return true;
  });

  // validation and submit for edit profile form
  $("#edti-profile").on('click', function(){

      var firstname           = $("#firstname").val();
      var lastname            = $("#lastname").val();
      var username            = $("#username").val();
      var email               = $("#email").val();
      var mobile_number       = $("#mobile_number").val();
      var gender              = $("#gender").val();
      var age                 = $("#age").val();
      var country             = $("#country").val();
      var countryofresidence  = $("#countryofresidence").val();
      var address             = $("#address").val();
      
      var flag=1;

      if(firstname == "")
      {
        $('#err_firstname').html('Enter Firstname.');
              
        $('#err_firstname').show();
        $('#firstname').focus();
        $('#firstname').on('keyup', function(){
          $('#err_firstname').hide();
        });

        flag=0;  
      }

      if(lastname == "")
      {
        $('#err_lastname').html('Enter lastname.');
              
        $('#err_lastname').show();
        $('#lastname').focus();
        $('#lastname').on('keyup', function(){
          $('#err_lastname').hide();
        });

        flag=0;  
      }

      if(username == "")
      {
        $('#err_username').html('Enter Username.');
              
        $('#err_username').show();
        $('#username').focus();
        $('#username').on('keyup', function(){
          $('#err_username').hide();
        });

        flag=0;  
      }

      if(email == "")
      {
        $('#err_email').html('Enter lastname.');
              
        $('#err_email').show();
        $('#email').focus();
        $('#email').on('keyup', function(){
          $('#err_email').hide();
        });

        flag=0;  
      }

      if(mobile_number == "")
      {
        $('#err_mobile_number').html('Enter mobile number.');
              
        $('#err_mobile_number').show();
        $('#mobile_number').focus();
        $('#mobile_number').on('keyup', function(){
          $('#err_mobile_number').hide();
        });

        flag=0;  
      }

      if(gender == "")
      {
        $('#err_gender').html('Enter err_gender number.');
              
        $('#err_gender').show();
        $('#gender').focus();
        $('#gender').on('keyup', function(){
          $('#err_gender').hide();
        });

        flag=0;  
      }

      if(age == "")
      {
        $('#err_age').html('Enter Age.');
              
        $('#err_age').show();
        $('#age').focus();
        $('#age').on('keyup', function(){
          $('#err_age').hide();
        });

        flag=0;  
      }

      if(country == "")
      {
        $('#err_country').html('Enter Country.');
              
        $('#err_country').show();
        $('#country').focus();
        $('#country').on('keyup', function(){
          $('#err_country').hide();
        });

        flag=0;  
      }

      /*if(countryofresidence == "")
      {
        $('#err_countryofresidence').html('Enter country of residence.');
              
        $('#err_countryofresidence').show();
        $('#countryofresidence').focus();
        $('#countryofresidence').on('keyup', function(){
          $('#err_countryofresidence').hide();
        });

        flag=0;  
      }*/

      if(address == "")
      {
        $('#err_address').html('Enter address.');
              
        $('#err_address').show();
        $('#address').focus();
        $('#address').on('keyup', function(){
          $('#err_address').hide();
        });

        flag=0;  
      }

      if(flag == 0) {
        return false;
      } else {

        ajaxindicatorstart();

        $.ajax({
          url:site_url+'user/edit',
          type:'POST',
          data:{firstname:firstname,lastname:lastname,username:username,email:email,mobile_number:mobile_number,gender:gender,age:age,country:country,countryofresidence:countryofresidence,address:address},
          dataType:'json',
          success:function(response)
          { 
             if(response.status == "success") {
              $("#edit_profile_error").html();
              $("#edit_profile_success").html(response.msg);

              setTimeout(function(){
                //$(".close").click();
                ajaxindicatorstop();
                window.location.href = response.URL;
              },1000);

            } else {

              ajaxindicatorstop();
              $("#edit_profile_success").html();
              $("#edit_profile_error").html(response.msg);
            }

            var firstname           = $("#firstname").val("");
            var lastname            = $("#lastname").val("");
            var username            = $("#username").val("");
            var email               = $("#email").val("");
            var mobile_number       = $("#mobile_number").val("");
            var gender              = $("#gender").val("");
            var age                 = $("#age").val("");
            var country             = $("#country").val("");
            var countryofresidence  = $("#countryofresidence").val("");
            var address             = $("#address").val("");

            return true;
          }
        });

        return false;
      }

  });
  
  // submit form and get dynamic form according to database
  $( "#category_name" ).change(function() {
    
      var catid = $('#category_name').val();

      //ajaxindicatorstart();

        $.ajax({
          url:site_url+'user/frombuild',
          type:'POST',
          data:{catid:catid},
          success:function(response)
          { 
            //ajaxindicatorstop();
            $('#formbuild').html(response);
            return true;
          }
        });
      return true;
  });

  // for edit my listing form
  $( "#edit_category_name" ).change(function() {
    get_fromdata();
  });


  function get_fromdata() {

      var catid = $('#edit_category_name').val();

      //ajaxindicatorstart();

        $.ajax({
          url:site_url+'user/edit_frombuild',
          type:'POST',
          data:{catid:catid},
          success:function(response)
          { 
            //ajaxindicatorstop();
            $('#formbuild').html(response);
            return true;
          }
        });
      return true;
  }

  // validation and display payment section for add listing form
  $(".check_listing").on('click', function(){
    //alert("here");
      var category_name       = $("#category_name").val();
      var title               = $("#title").val();
      var adddescription      = $("#adddescription").val();
      var mainphoto           = $("#mainphoto").val();
      var mobilenumber        = $("#mobilenumber").val();
      var addemail            = $("#addemail").val();
      var country             = $("#country").val();
      var countryofresidence  = $("#countryofresidence").val();
      var address             = $("#address").val();
      var price               = $("#price").val();
      var availability        = $("#availability").val();
      var iagree              = $("#iagree").is(":checked");
      var payment             = $('input[name=payment]:checked').length;
      var payment_value       = $('input[name=payment]:checked').val();

      //var payment=$('input[name=payment]').is(":checked");

      var flag=1;
      
      if(category_name == "")
      {
        var displayerror = $('#category_name').attr("displayerror");
        $('#category_name').parent().find('.error').html('Please enter the '+displayerror); 
        $('#category_name').focus();
        $('html, body').animate({scrollTop:$('#error_category').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(title == "")
      {
        var displayerror = $('#title').attr("displayerror");
        $('#title').parent().find('.error').html('Please enter the '+displayerror); 
        $('#title').focus();
        $('html, body').animate({scrollTop:$('#error_title').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(adddescription == "")
      {
        var displayerror = $('#adddescription').attr("displayerror");
        $('#adddescription').parent().find('.error').html('Please enter the '+displayerror); 
        $('#adddescription').focus();
        $('html, body').animate({scrollTop:$('#error_desc').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(mainphoto == "")
      {
        var displayerror = $('#mainphoto').attr("displayerror");
        $('#mainphoto').parent().find('.error').html('Please Upload Photo First'); 
        $('#mainphoto').focus();
        $('html, body').animate({scrollTop: $("#error_image").position().top}, 2000);
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var number = /^[0-9]+$/;

      if(mobilenumber == "")
      {
        var displayerror = $('#mobilenumber').attr("displayerror");
        $('#mobilenumber').parent().find('.error').html('Please enter the '+displayerror); 
        $('#mobilenumber').focus();
        $('html, body').animate({scrollTop:$('#error_mobile').position().top}, 2000);        
        flag=0;  
        return false;
      }
      else if(!number.test(mobilenumber))
      {
        var displayerror = $('#mobilenumber').attr("displayerror");
        $('#mobilenumber').parent().find('.error').html('Please enter only numbers for the '+displayerror); 
        $('#mobilenumber').focus();
        $('html, body').animate({scrollTop:$('#error_mobile').position().top}, 2000);        
        flag=0;  
        return false;
      }
      else
      {
        $('.error').html('');
        flag=1;
      }

      var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
      
      if(addemail=="")
      {
        var displayerror = $('#addemail').attr("displayerror");
        $('#addemail').parent().find('.error').html('Please enter the '+displayerror); 
        $('#addemail').focus();
        $('html, body').animate({scrollTop:$('#error_email').position().top}, 2000);        
        flag=0;  
        return false;
      
      } else if(!filter.test(addemail))
      {
        var displayerror = $('#addemail').attr("displayerror");
        $('#addemail').parent().find('.error').html('Please enter valid '+displayerror); 
        $('#addemail').focus();
        $('html, body').animate({scrollTop:$('#error_email').position().top}, 2000);        
        flag=0;  
        return false;
      }
      else
      {
        $('.error').html('');
        flag=1;
      }

      if(country == "")
      {
        var displayerror = $('#country').attr("displayerror");
        $('#country').parent().find('.error').html('Please enter the '+displayerror); 
        $('#country').focus();
        $('html, body').animate({scrollTop:$('#error_country').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(countryofresidence == "")
      {
        var displayerror = $('#countryofresidence').attr("displayerror");
        $('#countryofresidence').parent().find('.error').html('Please enter the '+displayerror); 
        $('#countryofresidence').focus();
        $('html, body').animate({scrollTop:$('#error_countryofresidence').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(address == "")
      {
        var displayerror = $('#address').attr("displayerror");
        $('#address').parent().find('.error').html('Please enter the '+displayerror); 
        $('#address').focus();
        $('html, body').animate({scrollTop:$('#error_address').position().top}, 2000);
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var currency = /^[0-9.]+$/;

      if(price == "")
      {
        var displayerror = $('#price').attr("displayerror");
        $('#price').parent().find('.error').html('Please enter the '+displayerror); 
        $('#price').focus();
        $('html, body').animate({scrollTop:$('#error_price').position().top}, 2000);        
        flag=0;  
        return false;
      }
      else if(!currency.test(price))
      {
        var displayerror = $('#price').attr("displayerror");
        $('#price').parent().find('.error').html('Please enter only numbers for the '+displayerror); 
        $('#price').focus();
        $('html, body').animate({scrollTop:$('#error_price').position().top}, 2000);        
        flag=0;  
        return false;
      }
      else
      {
        $('.error').html('');
        flag=1;
      }

      if(availability == "")
      {
        var displayerror = $('#availability').attr("displayerror");
        $('#availability').parent().find('.error').html('Please enter the '+displayerror); 
        $('#availability').focus();
        $('html, body').animate({scrollTop:$('#error_availability').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(iagree == false)
      {
   
        var displayerror = $('#iagree').attr("displayerror");
        $('#iagree').parent().parent().find('.error').html('You must agree with the Terms and Conditions'); 
        $('#iagree').focus();
        $('html, body').animate({scrollTop:$('#agree').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      /*$('#addlistingform input').each(function(index, element) {
        $('.error').html('');
        
        if (element.value === '') {
            var displayerror = $(this).attr("displayerror");
            $(this).parent().find('.error').html('Please enter the '+displayerror); 
            $('#'+element.id).focus();
            $('html, body').animate({scrollTop:$('#'+element.id).position().top}, 'slow');
            flag=0;
            return false;
        } else {
          $('#err_other').html('');
          flag=1;
        }

      });*/

      
      if(payment == '0')
      {
        var displayerror = $('#payment3').attr("displayerror");
        $('#payment3').parent().find('.error').html('Please select '+displayerror); 
        $('#payment3').focus();
        $('html, body').animate({scrollTop:$('#payment3').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(flag == 0) {
        return false;
      } else {
        if(payment_value != 'Free')
        {
          //$("#add_listing_form").hide();
          $("#start_payment").show();
        }
        else if(payment_value == 'Free')
        {
          $("#addlistingsubmit").show();
        }
        return true;
      }

      /*if(flag == 0) {
        return false;
      } else {

        ajaxindicatorstart();

        var formData = new FormData($('#addlistingform')[0]);

        $.ajax({
          url:site_url+'user/addform',
          type:'POST',
          data:formData,
          async: false,
          success:function(response)
          { 
            ajaxindicatorstop();
            return true;
          },
          cache: false,
          contentType: false,
          processData: false
        });

        return false;
      }*/

  });

  // validation and submit for change password form
  $("#changepassword").on('click', function(){
    var oldpass  = $("#oldpassword").val();
    var newpass  = $("#newpassword").val();
    var confpass = $("#confirmnewpassword").val();
    var flag=1;
    
    if(oldpass == "")
    {
      $('#err_oldpassword').html('Enter Old Password.');
            
      $('#err_oldpassword').show();
      $('#oldpassword').focus();
      $('#oldpassword').on('keyup', function(){
        $('#err_oldpassword').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_oldpassword').html('');
    }

    if(newpass == "")
    {
      $('#err_newpassword').html('Enter New Password.');
            
      $('#err_newpassword').show();
      $('#newpassword').focus();
      $('#newpassword').on('keyup', function(){
        $('#err_newpassword').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_newpassword').html('');
    }

    if(confpass == "")
    {
      $('#err_confirmnewpassword').html('Enter Confirm Password.');
            
      $('#err_confirmnewpassword').show();
      $('#confirmnewpassword').focus();
      $('#confirmnewpassword').on('keyup', function(){
        $('#err_confirmnewpassword').hide();
      });

      flag=0;  
    } 
    else if(confpass != newpass)
    {
      $('#err_confirmnewpassword').html('Password does not match.');
            
      $('#err_confirmnewpassword').show();
      $('#confirmnewpassword').focus();
      $('#confirmnewpassword').on('keyup', function(){
        $('#err_confirmnewpassword').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_confirmnewpassword').html('');
    }

    if(flag == 0) {
        return false;
      } else {

        ajaxindicatorstart();

        $.ajax({
          url:site_url+'user/changepassword',
          type:'POST',
          data:{oldpwd:oldpass,newpwd:newpass,confpass:confpass},
          dataType:'json',
          success:function(response)
          { 
             if(response.status == "success") {
              $("#edit_changepass_error").html();
              $("#edit_changepass_success").html(response.msg);

              setTimeout(function(){
                //$(".close").click();
                ajaxindicatorstop();
                window.location.href = response.URL;
              },1000);

            } else {

              ajaxindicatorstop();
              $("#edit_changepass_success").html();
              $("#edit_changepass_error").html(response.msg);
            }
          }
        });

        return false;
      }

  });

  // validation for header search 
  $('#homesearchsubmit').on('click', function(){
    
    var category_name   = $("#home_category_name").val();
    var city_name       = $("#home_city_name").val();
    
    var flag = 1;

    if(category_name == "")
    {
      $('#err_home_category_name').html('Enter Category Name.');
            
      $('#err_home_category_name').show();
      $('#home_category_name').focus();
      $('#home_category_name').on('keyup', function(){
        $('#err_home_category_name').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_home_category_name').html('');
    }

    if(city_name == "")
    {
      $('#err_home_city_name').html('Enter City Name.');
            
      $('#err_home_city_name').show();
      $('#home_city_name').focus();
      $('#home_city_name').on('keyup', function(){
        $('#err_home_city_name').hide();
      });

      flag=0;  
    }
    else
    {
      $('#err_home_city_name').html('');
    }

    if (flag == 0 ) {
      return false;
    } else {
      return true;
    }
    
  });

  // validation and submit for inquiry form
  $('#sendinquiry').on('click', function(){
    
    var inquiry_name = $("#sendinquiry_name").val();
    var inquiry_email = $("#sendinquiry_email").val();
    var inquiry_phone = $("#sendinquiry_phone").val();
    var inquiry_subject = $("#sendinquiry_subject").val();
    var inquiry_message = $("#sendinquiry_message").val();
    var inquiry_listing_id = $("#sendinquiry_listingid").val();

    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var number = /^[0-9]+$/;
    var flag = 1;

    // Check Name
    if(inquiry_name == "")
    {
      $('#err_sendinquiry_name').html('Enter Your Name.');
      $('#err_sendinquiry_name').show();
      $('#sendinquiry_name').focus();
      $('#sendinquiry_name').on('keyup', function(){
        $('#err_sendinquiry_name').hide();
      });
      flag=0;  
    }
    else
    {
      $('#err_sendinquiry_name').html('');
    }

    // Check Email
    if(inquiry_email == "")
    {
      $('#err_sendinquiry_email').html('Enter Email Address.');
            
      $('#err_sendinquiry_email').show();
      $('#sendinquiry_email').focus();
      $('#sendinquiry_email').on('keyup', function(){
        $('#err_sendinquiry_email').hide();
      });

      flag=0;
    
    } else if(!filter.test(inquiry_email))
    {
      $('#err_sendinquiry_email').html('Please Enter Valid Email.');
      $('#err_sendinquiry_email').show();
      $('#sendinquiry_email').focus();
      $('#sendinquiry_email').on('keyup', function(){
        $('#err_sendinquiry_email').hide();
      });
      flag=0;
    }
    else
    {
      $('#err_sendinquiry_email').html('');
    }

    // Check Phone
    if(inquiry_phone == "")
    {
      $('#err_sendinquiry_phone').html('Enter Your Phone Number.');
      $('#err_sendinquiry_phone').show();
      $('#sendinquiry_phone').focus();
      $('#sendinquiry_phone').on('keyup', function(){
        $('#err_sendinquiry_phone').hide();
      });
      flag=0;  
    }else if(!number.test(inquiry_phone))
    {
      $('#err_sendinquiry_phone').html('Enter Valid Phone Number.');
      $('#err_sendinquiry_phone').show();
      $('#sendinquiry_phone').focus();
      $('#sendinquiry_phone').on('keyup', function(){
        $('#err_sendinquiry_phone').hide();
      });
      flag=0;  
    }
    else
    {
      $('#err_sendinquiry_phone').html('');
    }

    // Check Subject
    if(inquiry_subject == "")
    {
      $('#err_sendinquiry_subject').html('Enter Your Subject.');
      $('#err_sendinquiry_subject').show();
      $('#sendinquiry_subject').focus();
      $('#sendinquiry_subject').on('keyup', function(){
        $('#err_sendinquiry_subject').hide();
      });
      flag=0;  
    }
    else
    {
      $('#err_sendinquiry_subject').html('');
    }

    // Check Message
    if(inquiry_message == "")
    {
      $('#err_sendinquiry_message').html('Enter Your Message.');
      $('#err_sendinquiry_message').show();
      $('#sendinquiry_message').focus();
      $('#sendinquiry_message').on('keyup', function(){
        $('#err_sendinquiry_message').hide();
      });
      flag=0;  
    }
    else
    {
      $('#err_sendinquiry_message').html('');
    }

    if (flag == 0 ) {
      return false;
    } else {
      ajaxindicatorstart();

       $.ajax({
        url:site_url+'listing/sendinquiry',
        type:'POST',
        data:{inquiry_name:inquiry_name, inquiry_email:inquiry_email, inquiry_phone:inquiry_phone, inquiry_subject:inquiry_subject, inquiry_message:inquiry_message, inquiry_listing_id:inquiry_listing_id},
        dataType:'json',
        success:function(response)
        {

          if(response.inquiry_status == "success") {
            $("#sendinquiry_error").html();
            $("#sendinquiry_success").html(response.inquiry_msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              //window.location.href = response.URL;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#sendinquiry_success").html();
            $("#sendinquiry_error").html(response.inquiry_msg);
          }

          return true;

        }
      });
    }

    var inquiry_name = $("#sendinquiry_name").val("");
    var inquiry_email = $("#sendinquiry_email").val("");
    var inquiry_phone = $("#sendinquiry_phone").val("");
    var inquiry_subject = $("#sendinquiry_subject").val("");
    var inquiry_message = $("#sendinquiry_message").val("");
    var inquiry_listing_id = $("#sendinquiry_listingid").val("");

    $('#sendinquiry_error').html('');
    $('#sendinquiry_success').html('');

    return false;
    
  });

  // Report as scam
  $('#reportscam').on('click', function(){
    
    var reportscam_name     = $("#reportscam_name").val();
    var reportscam_lname     = $("#reportscam_lname").val();
    var reportscam_email    = $("#reportscam_email").val();
    var reportscam_title    = $("#reportscam_title").val();
    var reportscam_listing_id = $("#reportscam_listingid").val();

      ajaxindicatorstart();

       $.ajax({
        url:site_url+'listing/reportscam',
        type:'POST',
        data:{reportscam_name:reportscam_name, reportscam_lname:reportscam_lname, reportscam_email:reportscam_email, reportscam_title:reportscam_title, reportscam_listing_id:reportscam_listing_id},
        dataType:'json',
        success:function(response)
        {

          if(response.inquiry_status == "success") {
            $("#reportscam_error").html();
            $("#reportscam_success").html(response.inquiry_msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              //window.location.href = response.URL;
            },1000);

          } else {

            ajaxindicatorstop();
            $("#reportscam_success").html();
            $("#reportscam_error").html(response.inquiry_msg);
          }

          return true;

        }
      });
    

    var reportscam_name     = $("#reportscam_name").val("");
    var reportscam_lname     = $("#reportscam_lname").val("");
    var reportscam_email    = $("#reportscam_email").val("");
    var reportscam_title    = $("#reportscam_title").val("");
    var reportscam_listing_id = $("#reportscam_listingid").val("");

    $('#reportscam_error').html('');
    $('#reportscam_success').html('');
    return false;    
  });

  // validation and submit for edit listing form
  $(".edit_listingsubmit").on('click', function(){
    var category_name         = $("#edit_category_name").val();
    var title                 = $("#title").val();
    var description           = $("#description").val();
    var mainphoto             = $("#img_value").val();
    var mobilenumber          = $("#mobilenumber").val();
    var email                 = $("#email").val();
    var country               = $("#country").val();
    var countryofresidence    = $("#countryofresidence").val();
    var address               = $("#address").val();
    var price                 = $("#price").val();
    var availability          = $("#availability").val();

    var flag = 1;

    if(category_name == "")
    {
      var displayerror = $('#edit_category_name').attr("displayerror");
      $('#edit_category_name').parent().find('.error').html('Please enter the '+displayerror); 
      $('#edit_category_name').focus();
      $('html, body').animate({scrollTop:$('#error_category').position().top}, 'slow');        
      flag = 0;  
      return false;
    } // end if
    else
    {
      $('.error').html('');
      flag = 1;
    } // end else

    if(title == "")
    {
      var displayerror = $('#title').attr("displayerror");
      $('#title').parent().find('.error').html('Please enter the '+displayerror); 
      $('#title').focus();
      $('html, body').animate({scrollTop:$('#error_title').position().top}, 'slow');        
      flag=0;  
      return false;
    } else {
      $('.error').html('');
      flag=1;
    }

    if(description == "")
      {
        var displayerror = $('#description').attr("displayerror");
        $('#description').parent().find('.error').html('Please enter the '+displayerror); 
        $('#description').focus();
        $('html, body').animate({scrollTop:$('#error_desc').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(mainphoto == "")
      {
        var displayerror = $('#mainphoto').attr("displayerror");
        $('#mainphoto').parent().find('.error').html('Please enter the '+displayerror); 
        $('#mainphoto').focus();
        $('html, body').animate({scrollTop:$('#error_image').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var number = /^[0-9]+$/;

      if(mobilenumber == "")
      {
        var displayerror = $('#mobilenumber').attr("displayerror");
        $('#mobilenumber').parent().find('.error').html('Please enter the '+displayerror); 
        $('#mobilenumber').focus();
        $('html, body').animate({scrollTop:$('#error_mobile').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
      
      if(email=="")
      {
        var displayerror = $('#email').attr("displayerror");
        $('#email').parent().find('.error').html('Please enter the '+displayerror); 
        $('#email').focus();
        $('html, body').animate({scrollTop:$('#error_email').position().top}, 'slow');        
        flag=0;  
        return false;      
      }
      else if(!filter.test(email))
      {
        var displayerror = $('#email').attr("displayerror");
        $('#email').parent().find('.error').html('Please enter valid '+displayerror); 
        $('#email').focus();
        $('html, body').animate({scrollTop:$('#error_email').position().top}, 'slow');        
        flag=0;  
        return false;
      }
      else
      {
        $('.error').html('');
        flag=1;
      }

      if(country == "")
      {
        var displayerror = $('#country').attr("displayerror");
        $('#country').parent().find('.error').html('Please enter the '+displayerror); 
        $('#country').focus();
        $('html, body').animate({scrollTop:$('#error_country').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(countryofresidence == "")
      {
        var displayerror = $('#countryofresidence').attr("displayerror");
        $('#countryofresidence').parent().find('.error').html('Please enter the '+displayerror); 
        $('#countryofresidence').focus();
        $('html, body').animate({scrollTop:$('#error_countryofresidence').position().top}, 2000);        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(address == "")
      {
        var displayerror = $('#address').attr("displayerror");
        $('#address').parent().find('.error').html('Please enter the '+displayerror); 
        $('#address').focus();
        $('html, body').animate({scrollTop:$('#error_address').position().top}, 2000);
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var currency = /^[0-9.]+$/;

      if(price == "")
      {
        var displayerror = $('#price').attr("displayerror");
        $('#price').parent().find('.error').html('Please enter the '+displayerror); 
        $('#price').focus();
        $('html, body').animate({scrollTop:$('#error_price').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      if(availability == "")
      {
        var displayerror = $('#availability').attr("displayerror");
        $('#availability').parent().find('.error').html('Please enter the '+displayerror); 
        $('#availability').focus();
        $('html, body').animate({scrollTop:$('#error_availability').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

    if(flag == 0)
    {
        return false;
    }
    else
    {
      ajaxindicatorstart();

        var formData = new FormData($('#editlistingform')[0]);

        $.ajax({
          url:site_url+'user/update_mylisting',
          type:'POST',
          dataType: "json",
          data:formData,
          //async: false,
          success:function(response)
          { 
             if(response.status == "success")
             {
                $("#edit_error").html();
                $("#edit_success").html(response.msg);

                setTimeout(function()
                {
                  //$(".close").click();
                  ajaxindicatorstop();
                  window.location.href = response.URL;
                },1000);
              }
              else
              {
                  ajaxindicatorstop();
                  $("#edit_success").html();
                  $("#edit_error").html(success.msg);
              }

              var category_name         = $("#edit_category_name").val("");
              var title                 = $("#title").val("");
              var description           = $("#description").val("");
              var mainphoto             = $("#mainphoto").val("");
              var mobilenumber          = $("#mobilenumber").val("");
              var email                 = $("#email").val("");
              var country               = $("#country").val("");
              var countryofresidence    = $("#countryofresidence").val("");
              var address               = $("#address").val("");
              var availability          = $("#availability").val("");

              return true;
            },
            cache: false,
            contentType: false,
            processData: false
          });
      return false;
    }
  });
  
  // submit form and get listing data according to conditions

    $('.catlavel3').click(function() { 
        $('#sercategory_id').val($(this).attr('data-value'));
        submit_listingForm();
    }); 

    $( "#availability").change(function() {
        submit_listingForm();
    });

     $( "#orderbyprice").change(function() {
        submit_listingForm();
    });

     $( ".radio-btn").change(function() { 
        submit_listingForm();
    });

    $( "#country_search").change(function() { 
        submit_listingForm();
    });

    $( "#residence_serach").change(function() { 
        submit_listingForm();
    });

    $( ".price_min").change(function() { 
        alert();
    });

    $( ".price_max").change(function() { 
        alert();
    });

    function submit_listingForm() {
      $( "#listingData" ).submit();
    }

    $('.get_category_id').click(function(){
      $('#sercategory_id').val($(this).attr('data-value'));
      $('#submit_category_id').submit();
    });

/*----------------------contactus-------------------------*/

  $('#contactusbutton').on('click', function(){  
    var flag = 1;
    var name    = $('#contactname').val();
    var email   = $('#contactemail').val();
    var message = $('#contactmessage').val();
    var email_filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     if($.trim(name)=="")
     {
        $('#err_contactname').fadeIn();         
        $('#err_contactname').html('Please enter name.');
        $('#err_contactname').fadeOut(4000);
        $('#contactname').focus();
        flag = 0;
     }

     if($.trim(email)=="")
     { 
        $('#err_contactemail').fadeIn();         
        $('#err_contactemail').html('Please enter email.');
        $('#err_contactemail').fadeOut(4000);
        $('#contactemail').focus();
        flag = 0;
     }
     if($.trim(message)=="")
     {
        $('#err_contactmessage').fadeIn();         
        $('#err_contactmessage').html('Please enter message.');
        $('#err_contactmessage').fadeOut(4000);
        $('#contactmessage').focus();
        flag = 0;
     }
     else if(!email_filter.test(email))
     {
          $('#email').val('');
          $('#err_contactemail').fadeIn();
          $('#err_contactemail').html('Please enter valid email id.');
          $('#err_contactemail').fadeOut(4000);
          $('#contactemail').focus();
          return false;
     } 
     

    if (flag == 0 ) {
      return false;
    } else {
      return true;
    }
    
  });


});


var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

