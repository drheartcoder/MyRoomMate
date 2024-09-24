jQuery(document).ready(function()
{
  $("#ajax-login-form").validate();

  jQuery("#ajax-login-form").submit(function(evnt)
  {
    if($("#ajax-login-form").valid())
    {
      evnt.preventDefault();  
      $.ajax({
        url:site_url+"authorize_user/login/AJAX",
        data: jQuery("#ajax-login-form").serialize(), 
        type:'POST',
        dataType:'json',
        beforeSend: function() {
           //erezervo.show_loader("ajax-login-form");
           jQuery("#ajax-login-loader").erezervo("show");
         },
         success:function(response)
         {
          if(response.status == "SUCCESS")
          {
            //location.reload(true);
            window.location.href =site_url+'authorize_user/re_route';
          }
          else
          {
            jQuery("#top_login_status").html("<div class='alert alert-danger'>"+response.msg+"</div>");
            setTimeout(function()
            {
             jQuery("#top_login_status").empty(); 
           },5000);
            
            jQuery("#ajax-login-form")[0].reset();
          }
          return false;
        },
        complete: function() {
            //erezervo.hide_loader("ajax-login-form");
            jQuery("#ajax-login-loader").erezervo("hide");
          }
        });
    }

    });

    jQuery('html').click(function() {
      jQuery("#login-content").fadeOut(700);
    });

    jQuery("#login-trigger,#login-content").click(function(event){
     event.stopPropagation();
    });

    (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));


    });

    window.fbAsyncInit = function() {
      FB.init({
        appId      : '1677108799190701',
        status     : true, 
        cookie     : true, 
        xfbml      : true,
        version    : 'v2.4'
      });
    };



    function FBLogin(user_type,redirect_url)
    {


       redirect_url = redirect_url ? redirect_url : false;

       FB.login(function(fb_response) {

        if(fb_response.authResponse) {

            FB.api('/me', 'get', {fields: 'email,first_name,last_name'}, function(profile_response) {
              
              var email    = profile_response.email;
              var fname    = profile_response.first_name;
              var lname    = profile_response.last_name;
              var fb_token = FB.getAuthResponse()['accessToken'];

              var datastr="email="+email+"&fname="+fname+"&lname=+"+lname+'&fb_token='+fb_token+"&user_type="+user_type;



              jQuery.ajax({
                url:site_url+'user/fb_auth',
                type:'POST',
                data:datastr,
                dataType:'json',
                success:function(response)
                {
                  if(response.status=="SUCCESS") {

                    console.log(redirect_url);
                    if(redirect_url != false) {

                      window.location.href =site_url+redirect_url;
                    }
                    else {

                      window.location.href =site_url+'authorize_user/re_route';
                    }

                  }
                  else {

                    jQuery(".top_login_status").html("<div class='alert alert-danger'>"+response.msg+"</div>");
                    setTimeout(function() {

                     jQuery(".top_login_status").empty(); 
                   
                    },5000);

                  }
                  return false;
                }


              });

              return false;
           
            });
        }
    }, 

    {scope: 'public_profile,email'});



} // end document 

