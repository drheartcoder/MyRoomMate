// JavaScript Document
$(document).ready(function(){
	var adminPath = 'admin';
	var currentRequest = null;
	var whiteSpace = /\s/g;
	$('#txtUsername').val('');
	$('#txtUsername').alpha({ allow: '' });
	
	function goToForm(form)
	{
		$('.afterLogin,._afterLogin').html('');
		$('.afterLogin,._afterLogin').css('display','none');
		$('.login-wrapper > form:visible').fadeOut(500, function(){
			$('#form-' + form).fadeIn(500);
		});
	}
	
	$('.goto-login').click(function(){
		$('#txtUsername').focus();
		goToForm('login');
	});
	
	$('.goto-forgot').click(function(){
		$('#txtEmail').focus();
		goToForm('forgot');
	});
	$('#txtUsername').blur(function(){
		var _userName = $('#txtUsername').val();
		if(_userName == '' ||  _userName.match(whiteSpace))
		{
			$('.afterLogin').css('display','block');
			$('.afterLogin').html('<div class="alert alert-danger" >Please Enter Valid Username.</div>');
			$('#txtUsername').val('');
			$('#txtUsername').focus();
		}
		else
		{
			$('.afterLogin').html('');
			$('.afterLogin').css('display','none');
		}
	});
	$('#txtPassword').blur(function(){
		var _passWord = $('#txtPassword').val();
		if(_passWord == '' ||  _passWord.match(whiteSpace))
		{
			$('.afterLogin').css('display','block');
			$('.afterLogin').html('<div class="alert alert-danger" >Please Enter Valid Password.</div>');
			$('#txtPassword').val('');
			$('#txtPassword').focus();
		}
		else
		{
			$('.afterLogin').html('');
			$('.afterLogin').css('display','none');
		}
	});
	
	$('#btnDoLogin').bind("click",function(){
		var _userName = $('#txtUsername').val();
		var _passWord = $('#txtPassword').val();
		var whiteSpace = /\s/g;
		if(_userName == '' ||  _userName.match(whiteSpace))
		{
			$('.afterLogin').css('display','block');
			$('.afterLogin').html('<div class="alert alert-danger" >Please Enter Valid Username.</div>');
			$('#txtUsername').val('');
			$('#txtUsername').focus();
		}
		else if(_passWord == '' ||  _passWord.match(whiteSpace))
		{
			$('.afterLogin').css('display','block');
			$('.afterLogin').html('<div class="alert alert-danger" >Please Enter Valid Password.</div>');
			$('#txtPassword').val('');
			$('#txtPassword').focus();
		}
		else
		{
			$('.afterLogin').css('display','block');
			$('.beforeLogin').css('display','none');
			$('.afterLogin').html('<div class="alert alert-info" ><img src="'+siteUrl+'images/loader_24x24.gif" /> Authenticating User...</div>');
			var dataString = {_userName:_userName,_passWord:_passWord};
			currentRequest =  $.ajax({
						  url: ''+siteUrl+adminPath+'/login/doValidate/',
						  type: 'post',
						  data: dataString,
						  dataType: 'json',
						  beforeSend : function(){           
								if(currentRequest != null) 
								{ currentRequest.abort(); }
						},
						success: function(data)
						  {
							  if(data._status=='true')
							  {
								    $('.afterLogin').html('<div class="alert alert-success" ><img src="'+siteUrl+'images/loader_24x24.gif" /> Logging In...</div>');
								  	 setTimeout(function() {
										 location.href=''+siteUrl+adminPath+'/dashboard/';
									  }, 1000);
							  }
							  else
							  {
								  $('.afterLogin').html('<div class="alert alert-danger" >'+data.msgString+'</div>');
								  $('.beforeLogin').css('display','block');
								  $('#txtUsername').val('');
								  $('#txtPassword').val('');
							  }
						  },
					});
		}
	});
	
	$('#btnGetPwd').bind("click",function(){
		var _txtEmail = $('#txtEmail').val();
		var regEmail =/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		if(txtEmail == '' ||  !regEmail.test(_txtEmail))
		{
			$('._afterLogin').css('display','block');
			$('._afterLogin').html('<div class="alert alert-danger" >Please Enter Valid Email.</div>');
			$('#txtEmail').val('');
			$('#txtEmail').focus();
		}
		else
		{
			$('._afterLogin').css('display','block');
			$('._beforeLogin').css('display','none');
			$('._afterLogin').html('<div class="alert alert-info" ><img src="'+siteUrl+'images/loader_24x24.gif" /> Verifying Email...</div>');
			var dataString = {_txtEmail:_txtEmail};
			currentRequest =  $.ajax({
						  url: ''+siteUrl+adminPath+'/login/recover_password/',
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
							  {
								    $('._afterLogin').html('<div class="alert alert-success" ><img src="'+siteUrl+'images/loader_24x24.gif" /> Sending Email...</div>');
								  	 setTimeout(function() {
										$('._afterLogin').html('<div class="alert alert-success" >An Email Has Been Sent Successfully To \''+_txtEmail+'\'.<br/>Please Check Your Inbox Or Spams.</div>');
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
})