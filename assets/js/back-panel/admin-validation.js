// JavaScript Document
$(document).ready(function(){

	


	var currentRequest = null;
	
	$('#btnAddCat').live("click",function(){
		var _id					= $('#_id').val();
		var _catName		= $('#txtCategoryName').val();
		var _actionType	= $('#actionType').val();
		
		if(_catName == '')
		{
			alert('Category Name');
			$('#txtCategoryName').focus();
		}
		else
		{
			var dataString = {_id:_id,categoryName:encodeURIComponent(_catName),actionType:_actionType};
			currentRequest =  $.ajax({
				url: ''+siteUrl+'category/addCategory/',
				type: 'post',
				data: dataString,
				dataType: 'json',
				beforeSend : function(){           
					if(currentRequest != null) 
						{ currentRequest.abort(); }
				},
				success: function(data)
				{
					if(data._status=='done')
						{alert('done');}
					else
						{alert('no');}
				},
			});
		}
	});
	
	$('#btnGetPwd').live("click",function(){
		var _txtEmail = $('#txtEmail').val();
		var regEmail =/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		if(txtEmail == '' ||  !regEmail.test(_txtEmail))
		{
			$('._afterLogin').css('display','block');
			$('._afterLogin').html('<div class="alert alert-danger" >Please enter valid email.</div>');
			$('#txtEmail').val('');
			$('#txtEmail').focus();
		}
		else
		{
			$('._afterLogin').css('display','block');
			$('._beforeLogin').css('display','none');
			
			var dataString = {_txtEmail:_txtEmail};
			currentRequest =  $.ajax({
				url: ''+siteUrl+adminPath+'/login/recover_password/',
				type: 'post',
				data: dataString,
				dataType: 'json',
				beforeSend : function(){           
					if(currentRequest != null) 
						{ currentRequest.abort(); }
					$('._afterLogin').html('<div class="alert alert-info" ><img src="'+siteUrl+'images/loader_24x24.gif" /> Verifying email...</div>');
				},
				success: function(data)
				{
					if(data._status=='done')
					{
						$('._afterLogin').html('<div class="alert alert-success" ><img src="'+siteUrl+'images/loader_24x24.gif" /> sending email...</div>');
						setTimeout(function() {
							$('._beforeLogin').html('<div class="alert alert-success" >An email has been sent to \''+_txtEmail+'\'.<br/>Please check your inbox or spams.</div>');
							$('._beforeLogin').css('display','block');
							$('#txtEmail').val('');
							$('#txtEmail').focus();
							
						}, 1000);
					}
					else
					{
						$('._afterLogin').html('<div class="alert alert-danger" >'+data.msgString+'</div>');
						$('._beforeLogin').css('display','block');
						$('#txtEmail').val('');
						$('#txtEmail').focus();
					}

				},
			});
}
});





}) // end document ready