$(document).ready(function(){

  // login Validation 
  $("#login-button").on('click', function(){

    var uemail=$("#email").val();
    var password=$("#password").val();
    
    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var flag=1;

    if(uemail=="")
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
    }

    if(password == "")
    {
      $('#err_login_password').html('Enter Password.');
            
      $('#err_login_password').show();
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
        data:{uemail:uemail,password:password},
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
            },3000);

          } else {

            ajaxindicatorstop();
            $("#login_success").html();
            $("#login_error").html(response.msg);
          }

          return true;

        }
      });


      var uemail=$("#email").val("");
      var password=$("#password").val("");
      $('#login_error').html('');
      $('#login_success').html('');

      return false;
    }

  });

  // Registration Validation 
  $("#register-button").on('click', function(){

    var uemail=$("#registeremail").val();
    var password1=$("#registerpassword1").val();
    var password2=$("#registerpassword2").val();

    var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
    var flag=1;

    if(uemail=="")
    {
      $('#err_register_email').html('Enter Email Address.');
            
      $('#err_register_email').show();
      $('#registeremail').focus();
      $('#registeremail').on('keyup', function(){
        $('#err_register_email').hide();
      });

      flag=0;
    
    } else if(!filter.test(uemail))
    {
      $('#err_register_email').html('Please enter valid email.');
      $('#err_register_email').show();
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

    if(password1 == "")
    {
      $('#err_register_password1').html('Enter Password.');
            
      $('#err_register_password1').show();
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
        data:{uemail:uemail,password1:password1},
        dataType:'json',
        success:function(response)
        {
           if(response.status == "success") {
            $("#register_error").html();
            $("#register_success").html(response.msg);

            setTimeout(function(){
              //$(".close").click();
              ajaxindicatorstop();
              window.location.href = response.URL;
            },3000);

          } else {

            ajaxindicatorstop();
            $("#register_success").html();
            $("#register_error").html(response.msg);
          }

          return true;
        }
      });

      var uemail=$("#registeremail").val("");
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
              window.location.href = response.URL;
            },3000);

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
            },3000);

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

  $("#edti-profile").on('click', function(){

      var firstname=$("#firstname").val();
      var lastname=$("#lastname").val();
      var email=$("#email").val();
      var mobile_number=$("#mobile_number").val();
      var gender=$("#gender").val();
      var age=$("#age").val();
      var country=$("#country").val();
      var countryofresidence=$("#countryofresidence").val();
      var address=$("#address").val();
      
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
        $('#firstname').on('keyup', function(){
          $('#err_lastname').hide();
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
          data:{firstname:firstname,lastname:lastname,email:email,mobile_number:mobile_number,gender:gender,age:age,country:country,countryofresidence:countryofresidence,address:address},
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
              },3000);

            } else {

              ajaxindicatorstop();
              $("#edit_profile_success").html();
              $("#edit_profile_error").html(response.msg);
            }

            var firstname=$("#firstname").val("");
            var lastname=$("#lastname").val("");
            var email=$("#email").val("");
            var mobile_number=$("#mobile_number").val("");
            var gender=$("#gender").val("");
            var age=$("#age").val("");
            var country=$("#country").val("");
            var countryofresidence=$("#countryofresidence").val("");
            var address=$("#address").val("");

            return true;
          }
        });

        return false;
      }

  });
  
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

  $("#addlistingsubmit").on('click', function(){
      var category_name=$("#category_name").val();
      var title=$("#title").val();
      var adddescription=$("#adddescription").val();
      var mainphoto=$("#mainphoto").val();
      var mobilenumber=$("#mobilenumber").val();
      var addemail=$("#addemail").val();
      var payment=$('input[name=payment]:checked').val();

      
      var flag=1;

      if(category_name == "")
      {
        var displayerror = $('#category_name').attr("displayerror");
        $('#category_name').parent().find('.error').html('Please enter the '+displayerror); 
        $('#category_name').focus();
        $('html, body').animate({scrollTop:$('#category_name').position().top}, 'slow');        
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
        $('html, body').animate({scrollTop:$('#title').position().top}, 'slow');        
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
        $('html, body').animate({scrollTop:$('#adddescription').position().top}, 'slow');        
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
        $('html, body').animate({scrollTop:$('#mainphoto').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }


      if(mobilenumber == "")
      {
        var displayerror = $('#mobilenumber').attr("displayerror");
        $('#mobilenumber').parent().find('.error').html('Please enter the '+displayerror); 
        $('#mobilenumber').focus();
        $('html, body').animate({scrollTop:$('#mobilenumber').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
      
      if(addemail=="")
      {
        var displayerror = $('#addemail').attr("displayerror");
        $('#addemail').parent().find('.error').html('Please enter the '+displayerror); 
        $('#addemail').focus();
        $('html, body').animate({scrollTop:$('#addemail').position().top}, 'slow');        
        flag=0;  
        return false;
      
      } else if(!filter.test(addemail))
      {
        var displayerror = $('#addemail').attr("displayerror");
        $('#addemail').parent().find('.error').html('Please enter valid '+displayerror); 
        $('#addemail').focus();
        $('html, body').animate({scrollTop:$('#addemail').position().top}, 'slow');        
        flag=0;  
        return false;
      }
      else
      {
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

      if(payment == "")
      {
        var displayerror = $('#payment[]').attr("displayerror[]");
        $('#payment[]').parent().find('.error').html('Please select '+displayerror); 
        $('#payment[]').focus();
        $('html, body').animate({scrollTop:$('#payment[]').position().top}, 'slow');        
        flag=0;  
        return false;
      } else {
        $('.error').html('');
        flag=1;
      }

      return false;

      


      if(flag == 0) {
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
      }

  });

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
              },3000);

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

  $('#homesearchsubmit').on('click', function(){
    
    var category_name=$("#home_category_name").val();
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

    if (flag == 0 ) {
      return false;
    } else {
      return true;
    }
    
  });


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
            },3000);

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


});


var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

