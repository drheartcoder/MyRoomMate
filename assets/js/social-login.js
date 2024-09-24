  /* step1 */
    window.fbAsyncInit = function() {
      FB.init({
       /* appId      : '1677108799190701',
        appId      : '1677108799190701',
        status     : true, 
        cookie     : true, 
        xfbml      : true,
        version    : 'v2.4'*/
        appId      : '1070467933074849',
        xfbml      : true,
        version    : 'v2.6'
      });
    };
     /* step2 */

    jQuery(document).ready(function()
    {
       /*(function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));*/

      (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));

    });


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
                beforeSend: function() 
                {
                  ajaxindicatorstart('please wait..');
                },
                success:function(response)
                {

                  //console.log(response);return false;
                  if(response.status=="SUCCESS") 
                  {

                    console.log(redirect_url);
                    if(redirect_url != false) 
                    {

                      window.location.href =site_url+redirect_url;
                    }
                    else 
                    {

                      window.location.href =site_url+'authorize_user/re_route';
                    }

                  }
                  else 
                  {

                    jQuery(".top_login_status").html("<div class='alert-box errors alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span>×</span></button>"+response.msg+"</div>");
                    setTimeout(function() 
                    {

                     jQuery(".top_login_status").empty(); 
                   
                    },5000);

                  }
                  return false;
                },
                complete:function()
                {
                  ajaxindicatorstop();
                }


              });

              return false;
           
            });
        }
    }, 

    {scope: 'public_profile,email'});



}