function checkmultiaction(frmId,action,word)
{
	if(action=='block')
	{
		$confirmMsg=" Are you sure to change status of these "+word+" ? ";
		$Select='No records selected for changing status.';
		var checked=$("input[name='checkbox_del[]']:checked").length;
	}
	if(action=='active')
	{
		$confirmMsg=" Are you sure to change status of these "+word+" ? ";
		$Select='No records selected for changing status.';
		var checked=$("input[name='checkbox_del[]']:checked").length;
	}
	if(action=='delete')
	{ 
		$confirmMsg=" Are you sure to delete these "+word+" ? ";
		$Select='No records selected for delete.';
		var checked=$("input[name='checkbox_del[]']:checked").length;
	}

    if(checked < 1)
    {

    	//$('#no_select').show();
    	//$('#no_select').html('<i class="fa fa-ban"></i> <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'+$Select);
        
    	sweetAlert($Select);

    	return false;
    }
    else
    {
    	swal({   
         title: "Are you sure?",   
         text : "You want to perform this action ?",  
         type : "warning",   
         showCancelButton: true,   
         confirmButtonColor: "#8cc63e",  
         confirmButtonText: "Yes",  
         cancelButtonText: "No",   
         closeOnConfirm: false,   
         closeOnCancel: false }, function(isConfirm){   
          if (isConfirm) 
          { 
                 swal("Done!", "Your action successfully performed.", "success"); 
                 $('#act_status').val(action);
                 $('.status_yes').click();
                 
          } 
          else
          { 
          	     $('.status_no').click();
                 swal("Cancelled");          
          } 
        });

    	/*
    	$('#no_select').hide();
    	$('#warning_msg').show();*/

       
    	$('#warning_msg').html('<i class="fa fa-ban"></i><button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>'+ $confirmMsg+'<a class="btn btn-info status_yes " rel="'+frmId+'" style="padding: 2px 8px !important;"> Yes</a> <a class="btn btn-info status_no"  style="padding: 2px 8px !important;"> No</a>');

    }
}


$(document).ready(function(){
	
	$('body').on('click', '.status_yes', function () {	
		var $frmId=$(this).attr('rel');
		$('#'+$frmId).submit();
		return true;
	});
	$('body').on('click', '.status_yes', function () {
		$('#warning_msg').slideUp('slow');
	}); 

	$('body').on('click', '.status_no', function () {	
		window.location.reload();
	});

});

function confirm_delete() {
	if(confirm('Do you really want to delete the record?')) {
		return true;
	} else {
		return false;
	}
}


function confirm_verify() {
    if(confirm('Do you really want to verify this user?')) {
		return true;
	} else {
		return false;
	}
}

function confirm_assure() {
    if(confirm('Do you really want to done this process?')) {
		return true;
	} else {
		return false;
	}
}

function confirm_special() {
    if(confirm('Do you really want to done this process?')) {
		return true;
	} else {
		return false;
	}
}



//Bharat chk mutiple messages

function chk_message()
{
	$.ajax({
		url:site_url+'admin/ajax/message',
		type:'POST',
		success:function(res)
		{
			if(res.length>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	});
}

// Shankar chk multiple action-->
function chk_multiaction(chk_name,frm_name,val)
{
	var tmpchk = chk_name;
	var chk_name = document.getElementsByName(chk_name);
	var len = chk_name.length;
	var flag=1;

	var chklen = $('[name="'+tmpchk+'"]:checked').length;
	if(chklen > 0)
	{
		if(confirm('Do you really wany to perform this action?'))
		{
			for(var i=0;i<len;i++)
			{
				
				if(chk_name[i].checked==true)
				{
					flag=0;
					document.getElementById('multiple_action').value=val; 
					document.getElementById(frm_name).submit();
				}
			}	
		}
		else{
			return false;
		}
	}
	
	if(flag==1)
	{
		sweetAlert('Please select record(s)');
		return false;
	}
}
//Bharat delete confirm for subcategory
function confirm_delete_subcategory()
{
	var conftext = "Currently, ";
	conftext += "for the given subcategory products are allocated. ";
	conftext += "If you delete given subcategory then its related product are deleted. ";
	conftext += "Are you sure you want to continue?";
	if(confirm(conftext))
	{
		return true;
	}
	else
	{
		return false;
	}
}
//multiple delete for subcategory.
function chk_multiaction_delete(chk_name,frm_name,val)
{
	var tmpchk = chk_name;
	var chk_name = document.getElementsByName(chk_name);
	var len = chk_name.length;
	var flag=1;

	/*sweetAlert(chk_name[i].checked);*/
	var conftext = "Currently, ";
	conftext += "for the given subcategory products are allocated. ";
	conftext += "If you delete given subcategory then its related product are deleted. ";
	conftext += "Are you sure you want to continue?";

	var chklen = $('[name="'+tmpchk+'"]:checked').length;
	if(chklen > 0)
	{
		if(confirm(conftext))
		{
			for(var i=0;i<len;i++)
			{
				if(chk_name[i].checked==true)
				{
					flag=0;
					document.getElementById('multiple_action').value=val; 
					document.getElementById(frm_name).submit();
				}
			}	
		}
		else{
			return false;
		}
	}
	
	if(flag==1)
	{
		sweetAlert('Please select record(s)');
		return false;
	}
}
//Multiple active for category
function chk_multiaction_active(chk_name,frm_name,val)
{
	var tmpchk = chk_name;
	var chk_name = document.getElementsByName(chk_name);
	var len = chk_name.length;
	var flag=1;
	
	var chklen = $('[name="'+tmpchk+'"]:checked').length;
	if(chklen > 0)
	{
		var context="Currently, the given category is used in other subcategory and product? If you inactive then its related subcategory and product also inactive? Are you sure you want to continue?";
		if(confirm(context))
		{
			for(var i=0;i<len;i++)
			{
				if(chk_name[i].checked==true)
				{
					flag=0;
					document.getElementById('multiple_action').value=val; 
					document.getElementById(frm_name).submit();
				}
			}	
		}
		else{
			return false;
		}

	}
	
	if(flag==1)
	{
		sweetAlert('Please select record(s)');
		return false;
	}
}
function chk_multiaction_block(chk_name,frm_name,val)
{
	var tmpchk = chk_name;
	var chk_name = document.getElementsByName(chk_name);
	var len = chk_name.length;
	var flag=1;
	
	var chklen = $('[name="'+tmpchk+'"]:checked').length;
	if(chklen > 0)
	{
		var context="Currently, the given category is used in other subcategory and product? If you inactive then its related subcategory and product also inactive? Are you sure you want to continue?";
		if(confirm(context))
		{
			for(var i=0;i<len;i++)
			{
				if(chk_name[i].checked==true)
				{
					flag=0;
					document.getElementById('multiple_action').value=val; 
					document.getElementById(frm_name).submit();
				}
			}	
		}
		else{
			return false;
		}
	}
	
	if(flag==1)
	{
		sweetAlert('Please select record(s)');
		return false;
	}
}
$(document).ready(function(){


	/* textbox beginning space resriction -    Tushar A */
	
	$(".form-group .form-control").on('keypress' , function(event) {
		var textVal = $(this).val();
		if(textVal.indexOf(" ") !== -1)
		{
			if(textVal == " ")
			{
				$(this).val('');
				event.preventDefault();
			}
			
		}
	});

	/* end beginning first space resriction */

	$('#page_title').on('keyup',function(){

		if(($(this).val().length) > 40){
			var zipcode = $(this).val().substring(0,40)
			$('#page_title').val(zipcode);
			$('#error_page_title').show();
			$('#error_page_title').html('Page title contain only 40 characters');
		}

	});
	$('#meta_title').on('keyup',function(){

		if(($(this).val().length) > 40){
			var zipcode = $(this).val().substring(0,40)
			$('#meta_title').val(zipcode);
			$('#error_meta_title').show();
			$('#error_meta_title').html('Meta title contain only 40 characters');
		}

	});
	
	/*$('#meta_keyword').on('keyup',function(){

		if(($(this).val().length) > 40){
			var zipcode = $(this).val().substring(0,40)
			$('#meta_keyword').val(zipcode);
			$('#error_meta_keyword').show();
			$('#error_meta_keyword').html('Meta keyword contain only 40 characters');
		}

	});*/

	$('#meta_description').on('keyup',function(){

		if(($(this).val().length) > 100){
			var zipcode = $(this).val().substring(0,100)
			$('#meta_description').val(zipcode);
			$('#error_meta_description').show();
			$('#error_meta_description').html('Meta description contain only 100 characters');
		}

	});


	$('#zipcode').on('keyup',function(){

		if(($(this).val().length) > 6){
			var zipcode = $(this).val().substring(0,6)
			$('#zipcode').val(zipcode);
			$('#error_zipcode').show();
			$('#error_zipcode').html('Zip code contain only 6 numbers');
		}

	});

	/*$("#zipcode").bind("keydown", function (event) {

		if( event.keyCode  == 46    || event.keyCode   == 8      ||  event.keyCode  == 9  || event.keyCode  == 27     || event.keyCode == 13 || event.keyCode == 190 ||
			(event.keyCode == 65    && event.ctrlKey   === true) || (event.keyCode  == 61 && event.shiftKey === true) ||
			(event.keyCode >= 35    && event.keyCode <= 39)) {
			return;
		}   
		else {
			if(event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				$('#error_zipcode').show();
				$('#error_zipcode').html('Please enter only numbers');
				event.preventDefault();
			}
			else
			{
				$('#error_zipcode').hide();
			}
		}

    });*/

   /*
	====================================================
	USER OTHER SETTING JS OPERATIONS
	====================================================

	sign In validations  */


	$("#admin_username").keypress(function(event){
		var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122 ) && (inputValue == 32 && inputValue!=8 && inputValue != 0 )) { 

        	$('#err_admin_username').show();
        	$('#err_admin_username').html('space not allowed');
        	$('#admin_username').focus();

        	event.preventDefault(); 


        }
        else
        {
        	$('#err_admin_username').hide();
        }
    });

    /*
    ====================================================
    */


   /* ====================================================
	ALL IMAGES VALIDATIONS JS OPERATIONS
	==================================================== 

	*/

    

	$('#btn_add_category,#btn_edit_category,#btn_update_info').click(function() {

		var profile_pic   = $("#cat_logo,#file_upload").val();
		var ext_a         = profile_pic.substring(profile_pic.lastIndexOf('.') + 1);
		var flag          = 1;

		if(profile_pic!='')
		{

			if(!(ext_a == "jpg" || ext_a == "jpeg" || ext_a == "gif" || ext_a == "png" || ext_a == "GIF" || ext_a == "JPG" || ext_a == "JPEG" || ext_a == "PNG"))
			{
				$('#err_logo').show();
				$('#err_logo').html('Only jpg, png, gif, jpeg type images is allowed');
				$('#cat_logo').focus();
				flag=0;
			}
			
		}

		if(flag==0)
		{
			return false;
		}
		else
		{
			return true;s
		}

	});
    /* ====================================================
	   END ALL IMAGES VALIDATIONS JS OPERATIONS
	==================================================== 
	*/



	$("#category_name,#country_name,#district_name,#location_name,#news_title,#newsletter_subject,#faq_category_name,#meta_title").keypress(function(event){
		var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
        	$('#err_cat_name').show();
        	$('#err_cat_name').html('Please enter only characters');



        	$('#err_country_name').show();
        	$('#err_country_name').html('Please enter only characters');


        	$('#err_district_name').show();
        	$('#err_district_name').html('Please enter only characters');

        	$('#err_location_name').show();
        	$('#err_location_name').html('Please enter only characters');

        	$('#err_news_title').show();
        	$('#err_news_title').html('Please enter only characters');

        	$('#err_cat_name').show();
        	$('#err_cat_name').html('Please enter only characters');


        	$('#error_meta_title').show();
        	$('#error_meta_title').html('Please enter only characters');


        	event.preventDefault(); 

        }
        else
        {
        	$('#err_cat_name').hide();
        	$('#err_country_name').hide();
        	$('#err_district_name').hide();
        	$('#err_location_name').hide(); 
        	$('#err_news_title').hide();
        	$('#err_cat_name').hide();
        	$('#error_meta_title').hide();
        	

        }
    });

	$("#newsletter_subject,#page_title").keypress(function(event){
			var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
	        	
	        	$('#err_newsletter_subject').show();
	        	$('#err_newsletter_subject').html('Please enter only characters');


	        	$('#error_page_title').show();
	        	$('#error_page_title').html('Please enter only characters');

             	event.preventDefault(); 

	        }
	        else
	        {
	        	$('#err_newsletter_subject').hide();
	        	$('#error_page_title').hide();
	        	
	        }
	    });

	$("#meta_keyword").keypress(function(event){
			var inputValue = event.which;
	        // allow letters and whitespaces only.
	        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue!=8 && inputValue != 0 && inputValue!=46 && inputValue!=44 && inputValue!=13  && inputValue!=46)) { 
	        	
	        	$('#error_meta_keyword').show();
	        	$('#error_meta_keyword').html('Please enter only characters');

             	event.preventDefault(); 

	        }
	        else
	        {
	        	$('#error_meta_keyword').hide();
	        	
	        }
	    });


	/*
	====================================================
	*/




    /*
	====================================================
	CHANGE PASSWORD JS OPERATIONS
	====================================================


	disable copy pest into confirm password */
	$('#confirm_password').bind("cut copy paste",function(e) {
		e.preventDefault();
	});



	/* disable copy pest into confirm password 
	====================================================
	*/






	$("#faq_question,#news_title").keyup(function (evnt){
		evnt.preventDefault();
		var x = jQuery(this).val();
		jQuery(this).val(x.substr(0,80));
		var len = jQuery(this).val().length;
		var minlen = (80-len);
		if(minlen == 0){
			jQuery("#que_count").css({"color":"#C53E3E"});
		}else{
			jQuery("#que_count").css({"color":"#5BA250"});
		}
		jQuery("#que_count").text("Characters Remains : "+minlen);
	});


	//Delete Selected Subscribers
	$("#delete_selected_subscriber").click(function(e){
		e.preventDefault();
		var form = $(this).parents('form:first');
		var checked_subscriber = [];
		form.find('[name="check_email[]"]:checked').each(function(){
			checked_subscriber.push($(this).val());
			
		});
		var chksubscriber_len = form.find('[name="check_email[]"]:checked').length;
		if(chksubscriber_len > 0){
			if(confirm("Aru You Sure? Dou you want to delete Subscribers?"))
			{
				var display_msg = "";
				$.ajax({
					url:site_url+'admin/ajax/delete_selected_subscriber',
					data:{
						sub_ids:checked_subscriber
					},
					type:'POST',
					success:function(res)
					{
						if(res == "success"){
							var success = "success";
							localStorage.setItem("subscriberdeleted", success);
							location.reload("true");
						}else{
							var error = "error";
							localStorage.setItem("subscriberdeleted", error);
							location.reload("true");
						}
						return false;
					}
				});
			}else{
				return false;
			}
		}else{
			sweetAlert("Please Select Record!");
		}
		
	});

	//validation for edit profile
	$('#btn_account').click(function(){

		var username=$('#username').val();
		var email=$('#email').val();
		var admin_contactus=$('#admin_contactus').val();
		var filter_contact=/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;
		var fax=$('#admin_fax').val();
		var admin_address=$('#admin_address').val();
		var filter = /^[a-zA-Z0-9._-]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
		var contact_length=admin_contactus.length;

		if(username.trim()=='')
		{
			$('#err_username').show();
			$('#err_username').fadeIn(3000);
			$('#err_username').html('Please enter username');
			setTimeout(function(){
				$('#err_username').fadeOut('slow');
			},3000);
			$('#err_username').focus();
			return false;
		}
		else if(email.trim()=='')
		{
			$('#err_email').show();
			$('#err_email').fadeIn(3000);
			$('#err_email').html('Please enter emailId');
			setTimeout(function(){
				$('#err_email').fadeOut('slow');
			},3000);
			$('#err_email').focus();
			return false;
			
		}
		else if(!filter.test(email))
		{
			$('#err_email').show();
			$('#err_email').fadeIn(3000);
			$('#err_email').html('Please enter valid emailId');
			setTimeout(function(){
				$('#err_email').fadeOut('slow');
			},3000);
			$('#err_email').focus();
			return false;
			
		} 
		else if(admin_contactus.trim()=='')
		{
			$('#err_admin_contactus').show();
			$('#err_admin_contactus').fadeIn(3000);
			$('#err_admin_contactus').html('Please Enter contact no');
			setTimeout(function(){
				$('#err_admin_contactus').fadeOut('slow');
			},3000);
			$('#err_admin_contactus').focus();
			return false;
			
		}
		else if(!filter_contact.test(admin_contactus))
		{
			$('#err_admin_contactus').show();
			$('#err_admin_contactus').fadeIn(3000);
			$('#err_admin_contactus').html('Please Enter valid contact no');
			setTimeout(function(){
				$('#err_admin_contactus').fadeOut('slow');
			},3000);
			$('#err_admin_contactus').focus();
			return false;
		}
		else if(contact_length>18)
		{

			$('#err_admin_contactus').show();
			$('#err_admin_contactus').fadeIn(3000);
			$('#err_admin_contactus').html('Maximum 18 interger value allowed.');
			setTimeout(function(){
				$('#err_admin_contactus').fadeOut('slow');
			},3000);
			$('#err_admin_contactus').focus();
			return false;
		}
		else if(fax.trim()=='')
		{
			$('#err_admin_fax').show();
			$('#err_admin_fax').fadeIn(3000);
			$('#err_admin_fax').html('Please Enter fax');
			setTimeout(function(){
				$('#err_admin_fax').fadeOut('slow');
			},3000);
			$('#err_admin_fax').focus();
			return false;
		}
		else if(admin_address.trim()=='')
		{
			$('#err_admin_address').show();
			$('#err_admin_address').fadeIn(3000);
			$('#err_admin_address').html('Please Enter address');
			setTimeout(function(){
				$('#err_admin_address').fadeOut('slow');
			},3000);
			$('#err_admin_address').focus();
			return false;
			
		}
		else
		{
			return true;
		}
	});

// search validation for category -->
$('#btn_cat_search').click(function(){
	var search_val=$('#search_name').val();
	if(search_val.trim()=='')
	{
		$('#err_search_name').html('Please Enter Search Criteria');
		return false;
	}
});


//validations for blog
$('#btn_add_blog').click(function(){
	var blog_title	=	$('#blog_title').val();
	var blog_description = CKEDITOR.instances['blog_description'].getData().replace(/<[^>]*>/gi, '');
	if(blog_title.trim()=='')
	{
		$('#err_blog_title').show();
		$('#err_blog_title').fadeIn(3000);
		$('#err_blog_title').html('Please Enter blog title.');
		setTimeout(function(){
			$('#err_blog_title').fadeOut('slow');
		},3000);
		$('#err_blog_title').focus();
		return false;
	}
	else if(blog_description.trim()=='')
	{
		$('#err_blog_description').show();
		$('#err_blog_description').fadeIn(3000);
		$('#err_blog_description').html('Please Enter blog description');
		setTimeout(function(){
			$('#err_blog_description').fadeOut('slow');
		},3000);
		$('#err_blog_description').focus();
		return false;
	}
	else{
		return true;
	}
});

//edit blog
$('#btn_edit_blog').click(function(){
	var blog_title	=	$('#blog_title').val();
	var blog_description = CKEDITOR.instances['blog_description'].getData().replace(/<[^>]*>/gi, '');
	if(blog_title.trim()=='')
	{
		$('#err_blog').show();
		$('#err_blog').fadeIn(3000);
		$('#err_blog').html('Please Enter blog title.');
		setTimeout(function(){
			$('#err_blog').fadeOut('slow');
		},3000);
		$('#err_blog').focus();
		return false;
	}
	else if(blog_description.trim()=='')
	{
		$('#err_blog_description').show();
		$('#err_blog_description').fadeIn(3000);
		$('#err_blog_description').html('Please Enter blog description');
		setTimeout(function(){
			$('#err_blog_description').fadeOut('slow');
		},3000);
		$('#err_blog_description').focus();
		return false;
	}
	else{
		return true;
	}
});

//validation for add testimonial
$('#btn_add_tmnl').click(function()
{
	var name   =		$('#name').val();
	var address =	$('#address').val();
	var title 	=	$('#title').val();
	var desc = CKEDITOR.instances['desc'].getData().replace(/<[^>]*>/gi, '');
	var image 	=	$('#image').val();
	if(name.trim()=='')
	{
		$('#err_name').show();
		$('#err_name').fadeIn(3000);
		$('#err_name').html('Please Enter testimonial name');
		setTimeout(function(){
			$('#err_name').fadeOut('slow');
		},3000);
		$('#err_name').focus();
		return false;
	}
	else if(address.trim()=='')
	{
		$('#err_address').show();
		$('#err_address').fadeIn(3000);
		$('#err_address').html('Please Enter testimonial address');
		setTimeout(function(){
			$('#err_address').fadeOut('slow');
		},3000);
		$('#err_address').focus();
		return false;
	}
	else if(title.trim()=='')
	{
		$('#err_title').show();
		$('#err_title').fadeIn(3000);
		$('#err_title').html('Please Enter testimonial title');
		setTimeout(function(){
			$('#err_title').fadeOut('slow');
		},3000);
		$('#err_title').focus();
		return false;
	}
	else if(desc.trim()=='')
	{
		$('#err_desc').show();
		$('#err_desc').fadeIn(3000);
		$('#err_desc').html('Please Enter testimonial description');
		setTimeout(function(){
			$('#err_desc').fadeOut('slow');
		},3000);
		$('#err_desc').focus();
		return false;
	}
	else if(image.trim()=='')
	{
		$('#err_image').show();
		$('#err_image').fadeIn(3000);
		$('#err_image').html('Please Enter testimonial image');
		setTimeout(function(){
			$('#err_image').fadeOut('slow');
		},3000);
		$('#err_image').focus();
		return false;
	}
	else
	{
		return true;
	}
});	

$('#btn_edit_testimonial').click(function()
{
	var testimonial_name   =		$('#testimonial_name').val();
	var testimonial_address =	$('#testimonial_address').val();
	var testimonial_title 	=	$('#testimonial_title').val();
	var testimonial_description = CKEDITOR.instances['testimonial_description'].getData().replace(/<[^>]*>/gi, '');
   //var image 	=	$('#image').val();
   if(testimonial_name.trim()=='')
   {
   	$('#err_testimonial_name').show();
   	$('#err_testimonial_name').fadeIn(3000);
   	$('#err_testimonial_name').html('Please Enter testimonial name');
   	setTimeout(function(){
   		$('#err_testimonial_name').fadeOut('slow');
   	},3000);
   	$('#err_testimonial_name').focus();
   	return false;
   }
   else if(testimonial_address.trim()=='')
   {
   	$('#err_testimonial_address').show();
   	$('#err_testimonial_address').fadeIn(3000);
   	$('#err_testimonial_address').html('Please Enter testimonial address');
   	setTimeout(function(){
   		$('#err_testimonial_address').fadeOut('slow');
   	},3000);
   	$('#err_testimonial_address').focus();
   	return false;
   }
   else if(testimonial_title.trim()=='')
   {
   	$('#err_testimonial_title').show();
   	$('#err_testimonial_title').fadeIn(3000);
   	$('#err_testimonial_title').html('Please Enter testimonial title');
   	setTimeout(function(){
   		$('#err_testimonial_title').fadeOut('slow');
   	},3000);
   	$('#err_testimonial_title').focus();
   	return false;
   }
   else if(testimonial_description.trim()=='')
   {
   	$('#err_testimonial_description').show();
   	$('#err_testimonial_description').fadeIn(3000);
   	$('#err_testimonial_description').html('Please Enter testimonial description');
   	setTimeout(function(){
   		$('#err_testimonial_description').fadeOut('slow');
   	},3000);
   	$('#err_testimonial_description').focus();
   	return false;
   }
  /* else if(image.trim()=='')
   {
   		$('#err_image').show();
		$('#err_image').fadeIn(3000);
   		$('#err_image').html('Please Enter testimonial image');
   		setTimeout(function(){
		$('#err_image').fadeOut('slow');
		},3000);
		$('#err_image').focus();
   		return false;
   	}*/
   	else
   	{
   		return true;
   	}
   });	

//validation for contact us page
$('#btn_contact_us').click(function()
{
	var first_name   =	$('#first_name').val();

	if(first_name.trim()=='')
	{
		$('#err_first_name').show();
		$('#err_first_name').fadeIn(3000);
		$('#err_first_name').html('Please Enter First Name');
		setTimeout(function(){
			$('#err_first_name').fadeOut('slow');
		},3000);
		$('#err_first_name').focus();
		return false;
	}
	else
	{
		return true;
	}
});	

//seema validation for subcategory
$('#btn_add_subcategory').click(function(){
	var category_name	=	$('#category_name').val();
	var subcategory_name	=	$('#subcategory_name').val();
	var image	=	$('#subcategory_image').val();
	var ext=image.substring(image.lastIndexOf('.')+1);
	if(category_name.trim()=='')
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please select category name.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	
	else if(subcategory_name.trim()=='')	
	{
		$('#err_subcategory_name').show();
		$('#err_subcategory_name').fadeIn(3000);
		$('#err_subcategory_name').html('Please enter subcategory name.');
		setTimeout(function(){
			$('#err_subcategory_name').fadeOut('slow');
		},3000);
		$('#err_subcategory_name').focus();
		return false;
	}
	else if(image.trim()=='')	
	{
		$('#err_subcategory_image').show();
		$('#err_subcategory_image').fadeIn(3000);
		$('#err_subcategory_image').html('Please select image');
		setTimeout(function(){
			$('#err_subcategory_image').fadeOut('slow');
		},3000);
		$('#err_subcategory_image').focus();
		return false;
	}
	else if(image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_subcategory_image').show();
		$('#err_subcategory_image').fadeIn(3000);
		$('#err_subcategory_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_subcategory_image').fadeOut('slow');
		},3000);
		$('#err_subcategory_image').focus();
		return false;
	}
	else{
		return true;
	}
});

//Bharat validation for edit subcategory
$('#btn_edit_subcategory').click(function(){
	var category_name	=	$('#category_name').val();
	var subcategory_name	=	$('#subcategory_name').val();
	var image	=	$('#subcategory_image').val();
	var ext=image.substring(image.lastIndexOf('.')+1);
	if(category_name.trim()=='')
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please select category name.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	
	else if(subcategory_name.trim()=='')	
	{
		$('#err_subcategory_name').show();
		$('#err_subcategory_name').fadeIn(3000);
		$('#err_subcategory_name').html('Please enter subcategory name.');
		setTimeout(function(){
			$('#err_subcategory_name').fadeOut('slow');
		},3000);
		$('#err_subcategory_name').focus();
		return false;
	}
	else if(image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_subcategory_image').show();
		$('#err_subcategory_image').fadeIn(3000);
		$('#err_subcategory_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_subcategory_image').fadeOut('slow');
		},3000);
		$('#err_subcategory_image').focus();
		return false;
	}
	else{
		return true;
	}
});


 //validations for blog
/*$('#btn_add_newsletter,#btn_up_newsletter').click(function(){
	var news_title	=	$('#news_title').val();
	var newsletter_subject	=	$('#newsletter_subject').val();
	var news_description = CKEDITOR.instances['news_description'].getData().replace(/<[^>]*>/gi, '');
	if(news_title.trim()=='')
	{
		$('#err_news_title').show();
		$('#err_news_title').fadeIn(3000);
		$('#err_news_title').html('Please Enter newsletter title.');
		setTimeout(function(){
		$('#err_news_title').fadeOut('slow');
		},3000);
		$('#err_news_title').focus();
		return false;
	}
	else if(newsletter_subject.trim()=='')
	{
		$('#err_newsletter_subject').show();
		$('#err_newsletter_subject').fadeIn(3000);
		$('#err_newsletter_subject').html('Please Enter newsletter subject.');
		setTimeout(function(){
		$('#err_newsletter_subject').fadeOut('slow');
		},3000);
		$('#err_newsletter_subject').focus();
		return false;
	}
	else if(news_description.trim()=='')
    {
    	$('#err_news_description').show();
		$('#err_news_description').fadeIn(3000);
   		$('#err_news_description').html('Please Enter newsletter description');
   		setTimeout(function(){
		$('#err_news_description').fadeOut('slow');
		},3000);
		$('#err_news_description').focus();
   		return false;
    }
    
	 else{
		return true;
	}
});*/

//seema validations for news
$('#btn_add_news').click(function(){
	var news_title	=	$('#news_title').val();
	var image	=	$('#news_image').val();
	var ext=image.substring(image.lastIndexOf('.')+1);
	var news_description = CKEDITOR.instances['news_description'].getData().replace(/<[^>]*>/gi, '');
	if(news_title.trim()=='')
	{
		$('#err_news_title').show();
		$('#err_news_title').fadeIn(3000);
		$('#err_news_title').html('Please enter news title.');
		setTimeout(function(){
			$('#err_news_title').fadeOut('slow');
		},3000);
		$('#err_news_title').focus();
		return false;
	}
	
	else if(news_description.trim()=='')
	{
		$('#err_news_description').show();
		$('#err_news_description').fadeIn(3000);
		$('#err_news_description').html('Please enter news description');
		setTimeout(function(){
			$('#err_news_description').fadeOut('slow');
		},3000);
		$('#err_news_description').focus();
		return false;
	}
	else if(image.trim()=='')
	{
		$('#err_news_image').show();
		$('#err_news_image').fadeIn(3000);
		$('#err_news_image').html('Please select news image');
		setTimeout(function(){
			$('#err_news_image').fadeOut('slow');
		},3000);
		$('#err_news_image').focus();
		return false;
	}
	else if(image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_news_image').show();
		$('#err_news_image').fadeIn(3000);
		$('#err_news_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_news_image').fadeOut('slow');
		},3000);
		$('#err_news_image').focus();
		return false;
	}
	else{
		return true;
	}
});
	//seema validations for news
	$('#btn_edit_news').click(function(){
		var news_title	=	$('#news_title').val();
		var image	=	$('#news_image').val();
		var ext=image.substring(image.lastIndexOf('.')+1);
		var news_description = CKEDITOR.instances['news_description'].getData().replace(/<[^>]*>/gi, '');
		if(news_title.trim()=='')
		{
			$('#err_news_title').show();
			$('#err_news_title').fadeIn(3000);
			$('#err_news_title').html('Please enter news title.');
			setTimeout(function(){
				$('#err_news_title').fadeOut('slow');
			},3000);
			$('#err_news_title').focus();
			return false;
		}

		else if(news_description.trim()=='')
		{
			$('#err_news_description').show();
			$('#err_news_description').fadeIn(3000);
			$('#err_news_description').html('Please enter news description');
			setTimeout(function(){
				$('#err_news_description').fadeOut('slow');
			},3000);
			$('#err_news_description').focus();
			return false;
		}
		else if(image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
		{
			$('#err_news_image').show();
			$('#err_news_image').fadeIn(3000);
			$('#err_news_image').html('Please Choose valid image.');
			setTimeout(function(){
				$('#err_news_image').fadeOut('slow');
			},3000);
			$('#err_news_image').focus();
			return false;
		}
		else{
			return true;
		}
	});

/* seema validation for faq */
/*$('#btn_add_faq,#btn_edit_faq').click(function(){
	var faq_question	=	$('#faq_question').val();
	var faq_answer = CKEDITOR.instances['faq_answer'].getData().replace(/<[^>]*>/gi, '');
	if(faq_question.trim()=='')
	{
		$('#err_faq_question').show();
		$('#err_faq_question').fadeIn(3000);
		$('#err_faq_question').html('Please enter question.');
		setTimeout(function(){
		$('#err_faq_question').fadeOut('slow');
		},3000);
		$('#err_faq_question').focus();
		return false;
	}
	
	else if(faq_answer.trim()=='')
    {
    	$('#err_faq_answer').show();
		$('#err_faq_answer').fadeIn(3000);
   		$('#err_faq_answer').html('Please enter answer');
   		setTimeout(function(){
		$('#err_faq_answer').fadeOut('slow');
		},3000);
		$('#err_faq_answer').focus();
   		return false;
    }
    else{
		return true;
	}
});*/

//seema validation for category
$('#btn_add_category').click(function(){
	var category_name = $('#category_name').val();
	var sub_title = $('#sub_title').val();
	var category_image = $('#category_image').val();
	var ext=category_image.substring(category_image.lastIndexOf('.')+1);
	if(category_name.trim()=='')
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please enter category name.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	else if(sub_title.trim()=='')
	{
		$('#err_sub_title').show();
		$('#err_sub_title').fadeIn(3000);
		$('#err_sub_title').html('Please enter sub title.');
		setTimeout(function(){
			$('#err_sub_title').fadeOut('slow');
		},3000);
		$('#err_sub_title').focus();
		return false;
	}
	else if(category_image.trim()=='')
	{
		$('#err_category_image').show();
		$('#err_category_image').fadeIn(3000);
		$('#err_category_image').html('Please select image');
		setTimeout(function(){
			$('#err_category_image').fadeOut('slow');
		},3000);
		$('#err_category_image').focus();
		return false;
	}
	else if(category_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_category_image').show();
		$('#err_category_image').fadeIn(3000);
		$('#err_category_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_category_image').fadeOut('slow');
		},3000);
		$('#err_category_image').focus();
		return false;
	}
	else{
		return true;
	}
});

//bharat validation for edit category
$('#btn_edit_category').click(function(){
	var category_name = $('#category_name').val();
	var sub_title = $('#sub_title').val();
	var category_image = $('#category_image').val();
	var ext=category_image.substring(category_image.lastIndexOf('.')+1);
	if(category_name.trim()=='')
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please enter category name.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	else if(sub_title.trim()=='')
	{
		$('#err_sub_title').show();
		$('#err_sub_title').fadeIn(3000);
		$('#err_sub_title').html('Please enter sub title.');
		setTimeout(function(){
			$('#err_sub_title').fadeOut('slow');
		},3000);
		$('#err_sub_title').focus();
		return false;
	}
	else if(category_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_category_image').show();
		$('#err_category_image').fadeIn(3000);
		$('#err_category_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_category_image').fadeOut('slow');
		},3000);
		$('#err_category_image').focus();
		return false;
	}
	else{
		return true;
	}
});

//seema= validation for recipes
$('#btn_add_recipes').click(function(){
	var recipe_category_name = $('#recipe_category_name').val();
	var recipe_title = $('#recipe_title').val();
	var recipe_desc = CKEDITOR.instances['recipe_description'].getData().replace(/<[^>]*>/gi, '');
	var recipe_banner_image = $('#recipe_banner_image').val();
	var recipe_image = $('#recipe_image').val();
	var ext=recipe_banner_image.substring(recipe_banner_image.lastIndexOf('.')+1);
	var rec_ext=recipe_image.substring(recipe_image.lastIndexOf('.')+1);
	var recipe_title_name=recipe_title.length;
	//var recipe_ingredients=$("input:text[name^='recipe_ingredients']").val();

	if(recipe_category_name.trim()=='')
	{
		$('#err_recipe_category_name').show();
		$('#err_recipe_category_name').fadeIn(3000);
		$('#err_recipe_category_name').html('Please select category name.');

		setTimeout(function(){
			$('#err_recipe_category_name').fadeOut('slow');
		},3000);
		$('#err_recipe_category_name').focus();
		$(window).scrollTop($('#recipe_category_name').offset().top);
		return false;
	}
	else if(recipe_title.trim()=='')
	{
		$('#err_recipe_title').show();
		$('#err_recipe_title').fadeIn(3000);
		$('#err_recipe_title').html('Please enter recipe title');
		setTimeout(function(){
			$('#err_recipe_title').fadeOut('slow');
		},3000);
		$('#err_recipe_title').focus();
		$(window).scrollTop($('#recipe_title').offset().top);
		return false;
	}
	else if(recipe_title_name>29)
	{
		$('#err_recipe_title').show();
		$('#err_recipe_title').fadeIn(3000);
		$('#err_recipe_title').html('Maximum 29 characters allowed for title.');

		setTimeout(function(){
			$('#err_recipe_title').fadeOut('slow');
		},3000);
		$('#err_recipe_title').focus();
		$(window).scrollTop($('#recipe_title').offset().top);
		return false;
	}
	else if(recipe_desc.trim()=='')
	{
		$('#err_recipe_description').show();
		$('#err_recipe_description').fadeIn(3000);
		$('#err_recipe_description').html('Please enter recipe description.');
		setTimeout(function(){
			$('#err_recipe_description').fadeOut('slow');
		},3000);
		$('#err_recipe_description').focus();
		return false;
	}
	else if((!$.trim($("input:text[name^='recipe_ingredients']").val()).length)>0)
	{
		$("input:text[name^='recipe_ingredients']").each(function() {
			if (!$.trim($(this).val()).length) {
				$('#err_recipe_ingredients').show();
				$('#err_recipe_ingredients').fadeIn(3000);
				$('#err_recipe_ingredients').html('Please enter recipe ingredients');
				setTimeout(function(){
					$('#err_recipe_ingredients').fadeOut('slow');
				},3000);
				$('#err_recipe_ingredients').focus();
				return false;
			}
		});
		return false;
	}
	else if(recipe_banner_image.trim()=='')
	{
		$('#err_recipe_banner_image').show();
		$('#err_recipe_banner_image').fadeIn(3000);
		$('#err_recipe_banner_image').html('Please select banner image.');
		setTimeout(function(){
			$('#err_recipe_banner_image').fadeOut('slow');
		},3000);
		$('#err_recipe_banner_image').focus();
		return false;
	}
	else if(recipe_banner_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_recipe_banner_image').show();
		$('#err_recipe_banner_image').fadeIn(3000);
		$('#err_recipe_banner_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_recipe_banner_image').fadeOut('slow');
		},3000);
		$('#err_recipe_banner_image').focus();
		return false;
	}
	else if(recipe_image.trim()=='')
	{
		$('#err_recipe_image').show();
		$('#err_recipe_image').fadeIn(3000);
		$('#err_recipe_image').html('Please select recipe image.');
		setTimeout(function(){
			$('#err_recipe_image').fadeOut('slow');
		},3000);
		$('#err_recipe_image').focus();
		return false;
	}
	else if(recipe_image!=""  && rec_ext!="jpg" && rec_ext!="png" && rec_ext!="gif" && rec_ext!="jpeg" && rec_ext!="JPG" && rec_ext!="PNG" && rec_ext!="JPEG" && rec_ext!="GIF")
	{
		$('#err_recipe_image').show();
		$('#err_recipe_image').fadeIn(3000);
		$('#err_recipe_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_recipe_image').fadeOut('slow');
		},3000);
		$('#err_recipe_image').focus();
		return false;
	}
	else
	{
		return true;
	}
});

//bharat= validation for recipes
$('#btn_edit_recipes').click(function(){
	var recipe_category_name = $('#recipe_category_name').val();
	var recipe_title = $('#recipe_title').val();
	var recipe_desc = CKEDITOR.instances['recipe_description'].getData().replace(/<[^>]*>/gi, '');
	var recipe_banner_image = $('#recipe_banner_image').val();
	var recipe_image = $('#recipe_image').val();
	var ext=recipe_banner_image.substring(recipe_banner_image.lastIndexOf('.')+1);
	var rec_ext=recipe_image.substring(recipe_image.lastIndexOf('.')+1);
	var recipe_title_name=recipe_title.length;
	//var recipe_ingredients=$("input:text[name^='recipe_ingredients']").val();

	if(recipe_category_name.trim()=='')
	{
		$('#err_recipe_category_name').show();
		$('#err_recipe_category_name').fadeIn(3000);
		$('#err_recipe_category_name').html('Please select category name.');
		setTimeout(function(){
			$('#err_recipe_category_name').fadeOut('slow');
		},3000);
		$('#err_recipe_category_name').focus();
		return false;
	}
	else if(recipe_title.trim()=='')
	{
		$('#err_recipe_title').show();
		$('#err_recipe_title').fadeIn(3000);
		$('#err_recipe_title').html('Please enter recipe title');
		setTimeout(function(){
			$('#err_recipe_title').fadeOut('slow');
		},3000);
		$('#err_recipe_title').focus();
		return false;
	}
	else if(recipe_title_name>29)
	{
		$('#err_recipe_title').show();
		$('#err_recipe_title').fadeIn(3000);
		$('#err_recipe_title').html('Maximum 29 characters allowed for title.');
		setTimeout(function(){
			$('#err_recipe_title').fadeOut('slow');
		},3000);
		$('#err_recipe_title').focus();
		return false;
	}
	else if(recipe_desc.trim()=='')
	{
		$('#err_recipe_description').show();
		$('#err_recipe_description').fadeIn(3000);
		$('#err_recipe_description').html('Please enter recipe description.');
		setTimeout(function(){
			$('#err_recipe_description').fadeOut('slow');
		},3000);
		$('#err_recipe_description').focus();
		return false;
	}
	else if((!$.trim($("input:text[name^='recipe_ingredients']").val()).length)>0)
	{
		$("input:text[name^='recipe_ingredients']").each(function() {
			if (!$.trim($(this).val()).length) {
				$('#err_recipe_ingredients').show();
				$('#err_recipe_ingredients').fadeIn(3000);
				$('#err_recipe_ingredients').html('Please enter recipe ingredients');
				setTimeout(function(){
					$('#err_recipe_ingredients').fadeOut('slow');
				},3000);
				$('#err_recipe_ingredients').focus();
				return false;
			}
		});
		return false;
	}
	else if(recipe_banner_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_recipe_banner_image').show();
		$('#err_recipe_banner_image').fadeIn(3000);
		$('#err_recipe_banner_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_recipe_banner_image').fadeOut('slow');
		},3000);
		$('#err_recipe_banner_image').focus();
		return false;
	}
	else if(recipe_image!=""  && rec_ext!="jpg" && rec_ext!="png" && rec_ext!="gif" && rec_ext!="jpeg" && rec_ext!="JPG" && rec_ext!="PNG" && rec_ext!="JPEG" && rec_ext!="GIF")
	{
		$('#err_recipe_image').show();
		$('#err_recipe_image').fadeIn(3000);
		$('#err_recipe_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_recipe_image').fadeOut('slow');
		},3000);
		$('#err_recipe_image').focus();
		return false;
	}
	else
	{
		return true;
	}
});

$('#btn_send_newsletter').click( function () {
	var news=$('#news_title').val();
	var val = [];
	$(':checkbox:checked').each(function(i){
		val[i] = $(this).val();
	});


	if(news=="")
	{
		$('#err_news_title').show();
		$('#err_news_title').fadeIn(3000);
		$('#err_news_title').html('Please select subject.');
		setTimeout(function(){
			$('#err_news_title').fadeOut('slow');
		},3000);
		$('#err_news_title').focus();
		return false;
	}
	if((val.length)<=0)	
	{	

		$('#error_email').show();
					//$('#error_email').fadeIn(3000);
					$('#error_email').html('Please select subscriber email ids.');
					setTimeout(function(){
						$('#error_email').fadeOut('slow');
					},3000);
					
					
					return false;
				}
			});

//validation for valid slider.

$('#btn_up_slider').click(function() {

	var sliderlink =$('#slider_link').val();
	
	var url_validate =/^(http:\/\/www\.|https:\/\/www\.)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;

	var slider_image=$('#slider_image').val();

	var ext=slider_image.substring(slider_image.lastIndexOf('.')+1);

	if(slider_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_slider_image').show();
		$('#err_slider_image').fadeIn(3000);
		$('#err_slider_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_slider_image').fadeOut('slow');
		},3000);
		$('#err_slider_image').focus();
		return false;
	}
	else if(!url_validate.test(sliderlink))
	{
		$('#err_slider_link').show();
		$('#err_slider_link').fadeIn(3000);
		$('#err_slider_link').html('Please enter valid link.');
		setTimeout(function(){
			$('#err_slider_link').fadeOut('slow');
		},3000);
		$('#err_slider_link').focus();
		return false;
	}
	else
	{
		return true;
	}
});

//validation for know slider.

$('#btn_up_know').click(function() {

	var know_image=$('#know_image').val();
	var know_title =$('#know_title').val();

	var ext=know_image.substring(know_image.lastIndexOf('.')+1);

	if(know_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_know_image').show();
		$('#err_know_image').fadeIn(3000);
		$('#err_know_image').html('Please Choose valid image.');
		setTimeout(function(){
			$('#err_know_image').fadeOut('slow');
		},3000);
		$('#err_know_image').focus();
		return false;
	}
	else if(know_title.trim()=='')
	{
		$('#err_know_title').show();
		$('#err_know_title').fadeIn(3000);
		$('#err_know_title').html('Please enter slider title.');
		setTimeout(function(){
			$('#err_know_title').fadeOut('slow');
		},3000);
		$('#err_know_title').focus();
		return false;
	}
	else
	{
		return true;
	}
});
//validation for add store.

$('#btn_add_store,#btn_up_store').click(function() {

	var store_name=$('#store_name').val();
	var store_address=$('#store_address').val();
	var phone_no=$('#phone_no').val();
	var postcode=$('#postcode').val();
	var filter_contact=/^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/i;


	if(store_name=='')
	{
		$('#err_store_name').show();
		$('#err_store_name').fadeIn(3000);
		$('#err_store_name').html('Please enter store name.');
		setTimeout(function(){
			$('#err_store_name').fadeOut('slow');
		},3000);
		$('#err_store_name').focus();
		return false;
	}
	else if(store_address=='')
	{
		$('#err_store_address').show();
		$('#err_store_address').fadeIn(3000);
		$('#err_store_address').html('Please enter store address.');
		setTimeout(function(){
			$('#err_store_address').fadeOut('slow');
		},3000);
		$('#err_store_address').focus();
		return false;
	}
	else if(phone_no=='')
	{
		$('#err_phone_no').show();
		$('#err_phone_no').fadeIn(3000);
		$('#err_phone_no').html('Please enter phone number.');
		setTimeout(function(){
			$('#err_phone_no').fadeOut('slow');
		},3000);
		$('#err_phone_no').focus();
		return false;
	}
	else if(!filter_contact.test(phone_no))
	{
		$('#err_phone_no').show();
		$('#err_phone_no').fadeIn(3000);
		$('#err_phone_no').html('Please Enter valid phone no');
		setTimeout(function(){
			$('#err_phone_no').fadeOut('slow');
		},3000);
		$('#err_phone_no').focus();
		return false;
	}
	else if(phone_no.length>=18)
	{
		$('#err_phone_no').show();
		$('#err_phone_no').fadeIn(3000);
		$('#err_phone_no').html('Please Enter phone no up to 18 numers');
		setTimeout(function(){
			$('#err_phone_no').fadeOut('slow');
		},3000);
		$('#err_phone_no').focus();
		return false;
	}

	else if(postcode=='')
	{
		$('#err_postcode').show();
		$('#err_postcode').fadeIn(3000);
		$('#err_postcode').html('Please enter post code');
		setTimeout(function(){
			$('#err_postcode').fadeOut('slow');
		},3000);
		$('#err_postcode').focus();	
		return false;
	}
	else
	{
		return true;
	}
});

	//validation for Product Add.

	$('#btn_add_product').click(function() {

		var category_name =$('#category_name').val();
		var subcategory_name =$('#subcategory_name').val();
		var product_name =$('#product_name').val();
		var meta_title =$('#meta_title').val();
		var meta_description =$('#meta_description').val();
		var meta_keyword =$('#meta_keyword').val();
		var product_image=$('#product_image').val();
		var ext=product_image.substring(product_image.lastIndexOf('.')+1);
		var description =$('#description').val();
		var product_ingredients=$('#product_ingredients').val();
		var key_title =$('#key_title').val();
		var recipes=$('#recipes').val();
		//sweetAlert(recipes);
		if(category_name=="")
		{
			$('#err_category_name').show();
			$('#err_category_name').fadeIn(3000);
			$('#err_category_name').html('Please enter category.');
			setTimeout(function(){
				$('#err_category_name').fadeOut('slow');
			},3000);
			$('#err_category_name').focus();
			return false;
		}
		else if(subcategory_name=="")
		{
			$('#err_subcategory_name').show();
			$('#err_subcategory_name').fadeIn(3000);
			$('#err_subcategory_name').html('Please select subcategory.');
			setTimeout(function(){
				$('#err_subcategory_name').fadeOut('slow');
			},3000);
			$('#err_subcategory_name').focus();
			return false;
		}
		else if(product_name=="")
		{
			$('#err_product_name').show();
			$('#err_product_name').fadeIn(3000);
			$('#err_product_name').html('Please enter product name.');
			setTimeout(function(){
				$('#err_product_name').fadeOut('slow');
			},3000);
			$('#err_product_name').focus();
			return false;
		}
		else if(meta_title=="")
		{
			$('#err_meta_title').show();
			$('#err_meta_title').fadeIn(3000);
			$('#err_meta_title').html('Please enter meta title.');
			setTimeout(function(){
				$('#err_meta_title').fadeOut('slow');
			},3000);
			$('#err_meta_title').focus();
			return false;
		}
		else if(meta_description=="")
		{
			$('#err_meta_description').show();
			$('#err_meta_description').fadeIn(3000);
			$('#err_meta_description').html('Please enter meta description.');
			setTimeout(function(){
				$('#err_meta_description').fadeOut('slow');
			},3000);
			$('#err_meta_description').focus();
			return false;
		}
		else if(meta_keyword=="")
		{
			$('#err_meta_keyword').show();
			$('#err_meta_keyword').fadeIn(3000);
			$('#err_meta_keyword').html('Please enter meta keyword.');
			setTimeout(function(){
				$('#err_meta_keyword').fadeOut('slow');
			},3000);
			$('#err_meta_keyword').focus();
			return false;
		}
		else if(product_image=="")
		{
			$('#err_product_image').show();
			$('#err_product_image').fadeIn(3000);
			$('#err_product_image').html('Please select image.');
			setTimeout(function(){
				$('#err_product_image').fadeOut('slow');
			},3000);
			$('#err_product_image').focus();
			return false;
		}
		else if(product_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
		{
			$('#err_product_image').show();
			$('#err_product_image').fadeIn(3000);
			$('#err_product_image').html('Please choose valid image.');
			setTimeout(function(){
				$('#err_product_image').fadeOut('slow');
			},3000);
			$('#err_product_image').focus();
			return false;
		}
		else if(description=="")
		{
			$('#err_description').show();
			$('#err_description').fadeIn(3000);
			$('#err_description').html('Please enter description.');
			setTimeout(function(){
				$('#err_description').fadeOut('slow');
			},3000);
			$('#err_description').focus();
			return false;
		}
		else if(recipes==null)
		{
			
			$('#err_recipes').show();
			$('#err_recipes').fadeIn(3000);
			$('#err_recipes').html('Please select recipes.');
			setTimeout(function(){
				$('#err_recipes').fadeOut('slow');
			},3000);
			$('#err_recipes').focus();
			return false;
		}
		else if(product_ingredients=="")
		{
			$('#err_product_ingredients').show();
			$('#err_product_ingredients').fadeIn(3000);
			$('#err_product_ingredients').html('Please enter ingredient details.');
			setTimeout(function(){
				$('#err_product_ingredients').fadeOut('slow');
			},3000);
			$('#err_product_ingredients').focus();
			return false;
		}
		else if(key_title=="")
		{
			$('#err_key_title').show();
			$('#err_key_title').fadeIn(3000);
			$('#err_key_title').html('Please enter Key title.');
			setTimeout(function(){
				$('#err_key_title').fadeOut('slow');
			},3000);
			$('#err_key_title').focus();
			return false;
		}
		else if((!$.trim($("input:text[name^='key_points']").val()).length)>0)
		{
			$("input:text[name^='key_points']").each(function() {
				if (!$.trim($(this).val()).length) {
					$('#err_section_ingredients').show();
					$('#err_section_ingredients').fadeIn(3000);
					$('#err_section_ingredients').html('Please enter product key points');
					setTimeout(function(){
						$('#err_section_ingredients').fadeOut('slow');
					},3000);
					$('#err_section_ingredients').focus();
					return false;
				}
			});
			return false;
		}
		else
		{
			return true;
		}
	});

//validation for duplicate category.

$('.cat_name').blur(function(){
	var category_name=$('.cat_name').val();

	$.ajax({
		url:site_url+'admin/ajax/dup_category/'+category_name,
		data:{category_name:category_name},
		type:'POST',
		success:function(res)
		{
			if(res=='exist')
			{
				$('#err_category_name').show();
				$('#err_category_name').fadeIn(3000);
				$('#err_category_name').html('Category name already exist.');
				$('#category_name').val('');
				setTimeout(function(){
					$('#err_category_name').fadeOut('slow');
				},3000);
				$('#err_category_name').focus();
				return false;
			}
			else
			{
				return true;
			}
		}
	});
})

//validation for duplicate subcategory.

$('.subcat_name').blur(function(){
	var subcategory_name=$('.subcat_name').val();
	var category_id=$('#category_name').val();
	$.ajax({
		url:site_url+'admin/ajax/dup_subcategory/'+subcategory_name+'/'+category_id,
		data:{subcategory_name:subcategory_name,
			category_id:category_id},
			type:'POST',
			success:function(res)
			{
				if(res=='exist')
				{
					$('#err_subcategory_name').show();
					$('#err_subcategory_name').fadeIn(3000);
					$('#err_subcategory_name').html('Subcategory name already exist.');
					$('#subcategory_name').val('');
					setTimeout(function(){
						$('#err_subcategory_name').fadeOut('slow');
					},3000);
					$('#err_subcategory_name').focus();
					return false;
				}
				else
				{
					return true;
				}
			}
		});
})


//validation for duplicate recipe category.
$('.recipe_category').blur(function(){
	var category_name=$('#recipe_category').val();
	$.ajax({	
		url:site_url+'admin/ajax/dup_recp_cat/'+category_name,
		data:{category_name:category_name},
		type:'POST',
		success:function(res)
		{
			if(res=='exist')
			{
				$('#err_category_name').show();
				$('#err_category_name').fadeIn(3000);
				$('#err_category_name').html('Category name already exist.');
				$('#recipe_category').val('');
				setTimeout(function(){
					$('#err_category_name').fadeOut('slow');
				},3000);
				$('#btn_add_recipecategory').attr('disabled','disabled');
				$('#err_category_name').focus();

				return false;
			}
			else
			{
				$('#btn_add_recipecategory').removeAttr('disabled');
				return true;
			}
		}
	});
})


//validation for Recipe category.

$('#btn_add_recipecategory,#btn_edit_recipecategory').click(function() {
	var category_name=$('#recipe_category').val();
	if(category_name=='')
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please enter category name.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	else
	{
		return true;
	}

});

//validation for edit duplicate category

$('.rec_category').blur(function(){
	var category_name=$('#recipe_category').val();
	var category_id=$('#category_id').val();
	$.ajax({
		url:site_url+'admin/ajax/edit_rec_dup_category/'+category_name+'/'+category_id,
		data:{category_name:category_name},
		type:'POST',
		success:function(res)
		{
			if(res=='exist')
			{
				$('#err_category_name').show();
				$('#err_category_name').fadeIn(3000);
				$('#err_category_name').html('Category name already exist.');
				$('#recipe_category').val('');
				setTimeout(function(){
					$('#err_category_name').fadeOut('slow');
				},3000);
				$("#btn_edit_recipecategory").attr("disabled","disabled");
				$('#err_category_name').focus();
				return false;
			}
			else
			{
				$("#btn_edit_recipecategory").removeAttr("disabled");
				return true;
			}
		}
	});
})


//validation for update Product Add.

$('#btn_up_product').click(function() {

	var category_name =$('#category_name').val();
	var subcategory_name =$('#subcategory_name').val();
	var product_name =$('#product_name').val();
	var meta_title =$('#meta_title').val();
	var meta_description =$('#meta_description').val();
	var meta_keyword =$('#meta_keyword').val();
	var product_image=$('#product_image').val();
	var ext=product_image.substring(product_image.lastIndexOf('.')+1);
	var description =$('#description').val();
	var product_ingredients=$('#product_ingredients').val();
	var key_title =$('#key_title').val();
	var recipes=$('#recipes').val();
	if(category_name=="")
	{
		$('#err_category_name').show();
		$('#err_category_name').fadeIn(3000);
		$('#err_category_name').html('Please select category.');
		setTimeout(function(){
			$('#err_category_name').fadeOut('slow');
		},3000);
		$('#err_category_name').focus();
		return false;
	}
	else if(subcategory_name=="")
	{
		$('#err_subcategory_name').show();
		$('#err_subcategory_name').fadeIn(3000);
		$('#err_subcategory_name').html('Please select subcategory.');
		setTimeout(function(){
			$('#err_subcategory_name').fadeOut('slow');
		},3000);
		$('#err_subcategory_name').focus();
		return false;
	}
	else if(product_name=="")
	{
		$('#err_product_name').show();
		$('#err_product_name').fadeIn(3000);
		$('#err_product_name').html('Please enter product name.');
		setTimeout(function(){
			$('#err_product_name').fadeOut('slow');
		},3000);
		$('#err_product_name').focus();
		return false;
	}
	else if(meta_title=="")
	{
		$('#err_meta_title').show();
		$('#err_meta_title').fadeIn(3000);
		$('#err_meta_title').html('Please enter meta title.');
		setTimeout(function(){
			$('#err_meta_title').fadeOut('slow');
		},3000);
		$('#err_meta_title').focus();
		return false;
	}
	else if(meta_description=="")
	{
		$('#err_meta_description').show();
		$('#err_meta_description').fadeIn(3000);
		$('#err_meta_description').html('Please enter meta description.');
		setTimeout(function(){
			$('#err_meta_description').fadeOut('slow');
		},3000);
		$('#err_meta_description').focus();
		return false;
	}
	else if(meta_keyword=="")
	{
		$('#err_meta_keyword').show();
		$('#err_meta_keyword').fadeIn(3000);
		$('#err_meta_keyword').html('Please enter meta keyword.');
		setTimeout(function(){
			$('#err_meta_keyword').fadeOut('slow');
		},3000);
		$('#err_meta_keyword').focus();
		return false;
	}
	else if(product_image!=""  && ext!="jpg" && ext!="png" && ext!="gif" && ext!="jpeg" && ext!="JPG" && ext!="PNG" && ext!="JPEG" && ext!="GIF")
	{
		$('#err_product_image').show();
		$('#err_product_image').fadeIn(3000);
		$('#err_product_image').html('Please choose valid image.');
		setTimeout(function(){
			$('#err_product_image').fadeOut('slow');
		},3000);
		$('#err_product_image').focus();
		return false;
	}
	else if(description=="")
	{
		$('#err_description').show();
		$('#err_description').fadeIn(3000);
		$('#err_description').html('Please enter description.');
		setTimeout(function(){
			$('#err_description').fadeOut('slow');
		},3000);
		$('#err_description').focus();
		return false;
	}
	else if(recipes==null)
	{
		$('#err_recipes').show();
		$('#err_recipes').fadeIn(3000);
		$('#err_recipes').html('Please select recipes.');
		setTimeout(function(){
			$('#err_recipes').fadeOut('slow');
		},3000);
		$('#err_recipes').focus();
		return false;
	}
	else if(product_ingredients=="")
	{
		$('#err_product_ingredients').show();
		$('#err_product_ingredients').fadeIn(3000);
		$('#err_product_ingredients').html('Please enter ingredient details.');
		setTimeout(function(){
			$('#err_product_ingredients').fadeOut('slow');
		},3000);
		$('#err_product_ingredients').focus();
		return false;
	}
	else if(key_title=="")
	{
		$('#err_key_title').show();
		$('#err_key_title').fadeIn(3000);
		$('#err_key_title').html('Please enter Key title.');
		setTimeout(function(){
			$('#err_key_title').fadeOut('slow');
		},3000);
		$('#err_key_title').focus();

		return false;
	}
	else if((!$.trim($("input:text[name^='key_points']").val()).length)>0)
	{
		$("input:text[name^='key_points']").each(function() {
			if (!$.trim($(this).val()).length) {
				$('#err_section_ingredients').show();
				$('#err_section_ingredients').fadeIn(3000);
				$('#err_section_ingredients').html('Please enter product key points');
				setTimeout(function(){
					$('#err_section_ingredients').fadeOut('slow');
				},3000);
				$('#err_section_ingredients').focus();
				return false;
			}
		});
		return false;
	}
	else
	{
		return true;
	}
});

});

//ajax call on getSubcategory
function getSubcategory(basepath)
{
	var category_id=document.getElementById("category_name").value;
	var spr='category_id='+category_id;
	$.ajax({
		url:basepath+'ajax/getSubcategory',
		data:spr,
		type:'POST',
		success:function(res)
		{
			$("#subcategory").css("display", "block");
			$("#subcategory").html(res);
			$("#exist_subcategory").hide();
		}
	});

}

function loadImage_slider(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width >= 1550 && img.height >= 550) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_slider_image').show();
    		$('#err_slider_image').fadeIn(3000);
    		$('#err_slider_image').html('Image size must be greater than 1550 X 550');
    		setTimeout(function(){
    			$('#err_slider_image').fadeOut('slow');
    		},3000);
    		$('#err_slider_image').focus();
    		return false;
    	}
    }
}

function loadImage_know(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width >= 1900 && img.height >= 900) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_know_image').show();
    		$('#err_know_image').fadeIn(3000);
    		$('#err_know_image').html('Image size must be greater than 1900 X 900');
    		setTimeout(function(){
    			$('#err_know_image').fadeOut('slow');
    		},3000);
    		$('#err_know_image').focus();
    		return false;
    	}
    }
}
function loadImage_category(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 1900 && img.height > 360) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_category_image').show();
    		$('#err_category_image').fadeIn(3000);
    		$('#err_category_image').html('Image size must be greater than 1900 X 360');
    		setTimeout(function(){
    			$('#err_category_image').fadeOut('slow');
    		},3000);
    		$('#err_category_image').focus();
    		return false;
    	}
    }
}

function loadImage_categoryup(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 1900 && img.height > 360) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_category_image').show();
    		$('#err_category_image').fadeIn(3000);
    		$('#err_category_image').html('Image size must be greater than 1900 X 360');
    		setTimeout(function(){
    			$('#err_category_image').fadeOut('slow');
    		},3000);
    		$('#err_category_image').focus();
    		return false;
    	}
    }
}

function loadImage_recslider(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 1900 && img.height > 420) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_recipe_banner_image').show();
    		$('#err_recipe_banner_image').fadeIn(3000);
    		$('#err_recipe_banner_image').html('Image size must be greater than 1900 X 420');
    		setTimeout(function(){
    			$('#err_recipe_banner_image').fadeOut('slow');
    		},3000);
    		$('#err_recipe_banner_image').focus();
    		return false;
    	}
    }
}
function loadImage_recimage(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 260 && img.height > 260) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_recipe_image').show();
    		$('#err_recipe_image').fadeIn(3000);
    		$('#err_recipe_image').html('Image size must be greater than 260 X 260');
    		setTimeout(function(){
    			$('#err_recipe_image').fadeOut('slow');
    		},3000);
    		$('#err_recipe_image').focus();
    		return false;
    	}
    }
}

function loadImage_recsliderup(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 1900 && img.height > 420) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_recipe_banner_image').show();
    		$('#err_recipe_banner_image').fadeIn(3000);
    		$('#err_recipe_banner_image').html('Image size must be greater than 1900 X 420');
    		setTimeout(function(){
    			$('#err_recipe_banner_image').fadeOut('slow');
    		},3000);
    		$('#err_recipe_banner_image').focus();
    		return false;
    	}
    }
}
function loadImage_recimageup(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 260 && img.height > 260) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_recipe_image').show();
    		$('#err_recipe_image').fadeIn(3000);
    		$('#err_recipe_image').html('Image size must be greater than 260 X 260');
    		setTimeout(function(){
    			$('#err_recipe_image').fadeOut('slow');
    		},3000);
    		$('#err_recipe_image').focus();
    		return false;
    	}
    }
}
function loadImage_product(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 254 && img.height > 251) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_product_image').show();
    		$('#err_product_image').fadeIn(3000);
    		$('#err_product_image').html('Image size must be greater than 254 X 251');
    		setTimeout(function(){
    			$('#err_product_image').fadeOut('slow');
    		},3000);
    		$('#err_product_image').focus();
    		return false;
    	}
    }
}
function loadImage_productup(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 254 && img.height > 251) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_product_image').show();
    		$('#err_product_image').fadeIn(3000);
    		$('#err_product_image').html('Image size must be greater than 254 X 251');
    		setTimeout(function(){
    			$('#err_product_image').fadeOut('slow');
    		},3000);
    		$('#err_product_image').focus();
    		return false;
    	}
    }
}
function loadImage_subcategory(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 254 && img.height > 251) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_subcategory_image').show();
    		$('#err_subcategory_image').fadeIn(3000);
    		$('#err_subcategory_image').html('Image size must be greater than 254 X 251');
    		setTimeout(function(){
    			$('#err_subcategory_image').fadeOut('slow');
    		},3000);
    		$('#err_subcategory_image').focus();
    		return false;
    	}
    }
}
function loadImage_editsubcategory(file_name, err_image, updt_advertisement,pro) 
{
	var input, file, fr, img;
	var updt_advertisement = updt_advertisement;
	input = document.getElementById(pro);
	
	//sweetAlert(pro);	
	file = input.files[0];
	fr = new FileReader();
	fr.onload = createImage;
	fr.readAsDataURL(file);
	function createImage() {
		img = document.createElement('img');
		img.onload = imageLoaded;
        img.style.display = 'none'; // If you don't want it showing
        img.src = fr.result;
    }

    function imageLoaded() {
    	if (img.width > 254 && img.height > 251) 
    	{
    		document.getElementById(updt_advertisement).disabled = false;
    	} 
    	else
    	{
    		document.getElementById(updt_advertisement).disabled = true;
    		$('#err_subcategory_image').show();
    		$('#err_subcategory_image').fadeIn(3000);
    		$('#err_subcategory_image').html('Image size must be greater than 254 X 251');
    		setTimeout(function(){
    			$('#err_subcategory_image').fadeOut('slow');
    		},3000);
    		$('#err_subcategory_image').focus();
    		return false;
    	}
    }
}