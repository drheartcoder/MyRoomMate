<div class="err_msg_div" style="display:none;">
<p ng-message="required"    class="error">  This field is required</p>
<p ng-message="minlength"   class="error">  This field is too short</p>
<p ng-message="maxlength"   class="error">  This field is too long</p>
<p ng-message="required"    class="error">  This field is required</p>
<p ng-message="email"       class="error">  This needs to be a valid email</p>
<p ng-message="mobile"       class="error">  This needs to be a valid mobile</p>
<p ng-message="pwd"         class="error">  Password is not valid</p>
<p ng-message="pattern"     class="error">  Must be a valid 10 digit phone number</p>
</div>
<script type="text/javascript">
    $(document).ready(function(){
      setTimeout(function(){
        $('.err_msg_div').removeAttr('style');
      },200);
    });
</script>