<!-- BEGIN Theme Setting -->
<div id="theme-setting"> <?php //$this->load->view('admin/theme-setting'); ?> </div>
<!-- END Theme Setting -->
<!-- BEGIN Navbar -->
<div id="navbar" class="navbar"> <?php $this->load->view(ADMIN_PANEL_NAME.'top-navigation'); ?> </div>
<!-- END Navbar -->
<!-- BEGIN Container -->
<div class="container" id="main-container">
  <!-- BEGIN Sidebar -->
  <div id="sidebar" class="navbar-collapse collapse"> <?php $this->load->view(ADMIN_PANEL_NAME.'left-navigation'); ?> </div>
  <!-- END Sidebar -->
  <!-- BEGIN Content -->
  <div id="main-content">
    <!-- BEGIN Page Title -->
    <div class="page-title">
      <div> <h1><i class="fa fa-star"></i><?php echo $pageTitle; ?></h1> <h4></h4> </div>
    </div>
    <!-- END Page Title -->
    
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
      <ul class="breadcrumb">
        <li> <i class="fa fa-home"></i><a href="<?php echo base_url().ADMIN_PANEL_NAME;?>dashboard">Home</a> <span class="divider"><i class="fa fa-angle-right"></i></span> </li>
        <li class="active"><?php echo $pageTitle; ?></li>
      </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-magenta">
          <div class="box-title">
              <h3><i class="fa fa-star"></i><?php echo ucfirst($pageTitle); ?></h3>
              <div class="box-tool">
              </div>
          </div>
          <div class="box-content">
            <form method="post" action="" class="form-horizontal" id="add-form" enctype="multipart/form-data">
          	  <div class="form-group">
              	<div class="col-sm-12">
           		 	<?php if($this->session->flashdata('error')!=''){  ?>
            		 <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
           			 <?php }
            		 if($this->session->flashdata('success')!=''){?>
            		 <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
  			        <?php } ?>
                 </div>
  	          </div>

              <div class="form-group">

                  <label class="col-sm-3 col-lg-2 control-label">Paypal username<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="ppal_uname" id="ppal_uname" placeholder="Please enter paypal username" value="<?php if(isset($payment_info[0]['paypal_username'])) echo $payment_info[0]['paypal_username']; ?>"/>
                    <div class="error" id="error_ppal_uname" ></div>
                  </div>
     
                  <label class="col-sm-3 col-lg-2 control-label">Sandbox username<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="snd_uname" id="snd_uname" placeholder=" Please enter sandbox username" value="<?php if(isset($payment_info[0]['sandbox_username'])) echo $payment_info[0]['sandbox_username']; ?>"/>
                    <div class="error" id="error_snd_uname" ></div>
                  </div>


              </div>

              <div class="form-group">


                  <label class="col-sm-3 col-lg-2 control-label">Paypal api key<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="ppal_api" id="ppal_api" placeholder="Please enter paypal api key" value="<?php if(isset($payment_info[0]['paypal_api_key'])) echo $payment_info[0]['paypal_api_key']; ?>"/>
                    <div class="error" id="error_ppal_api" ></div>
                  </div>
     
                  <label class="col-sm-3 col-lg-2 control-label">Sandbox api key<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="snd_api" id="snd_api" placeholder="Please enter sandbox api key"  value="<?php  if(isset($payment_info[0]['sandbox_api_key'])) echo $payment_info[0]['sandbox_api_key']; ?>"/>
                    <div class="error" id="error_snd_api" ></div>
                  </div>

              </div>

              <div class="form-group">


                  <label class="col-sm-3 col-lg-2 control-label">Paypal password<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="ppal_pass" id="ppal_pass" placeholder="Please enter paypal password" value="<?php  if(isset($payment_info[0]['paypal_password'])) echo $payment_info[0]['paypal_password']; ?>"/>
                    <div class="error" id="error_ppal_pass" ></div>
                  </div>
     
                  <label class="col-sm-3 col-lg-2 control-label">Sandbox password<span style="color:#F00;">*</span></label>
                  <div class="col-sm-9 col-lg-3 controls">
                    <input type="text" class="form-control" name="snd_password" id="snd_password" placeholder="Please enter sandbox password" value="<?php  if(isset($payment_info[0]['sandbox_password'])) echo $payment_info[0]['sandbox_password']; ?>"/>
                    <div class="error" id="error_snd_password" ></div>
                  </div>

              </div>
           
             <div class="form-group">

              <label class="col-sm-3 col-lg-2 control-label">Payment Mode</label>
                <div class="col-sm-9 col-lg-10 controls">

                      <label for="live">
                        <input id="live" type="radio" value="live" name="mode" <?php  if(isset($payment_info[0]['payment_mode']) && $payment_info[0]['payment_mode']=="live") echo 'checked=""'; ?>>
                        Live
                      </label>
                             &nbsp;
                      <label for="sand">
                        <input id="sand" type="radio"  value="sandbox" name="mode" <?php  if(isset($payment_info[0]['payment_mode']) && $payment_info[0]['payment_mode']=="sandbox") echo 'checked=""'; ?>>
                        Sandbox
                      </label>


                    <div id="error_mode" class="error"></div>
                </div>

            </div>
           
            <div class="form-group">
                 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <!-- empty -->
                 </div>
            </div>

            <div class="form-group">
                 <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                    <input type="submit" value="Update" class="btn btn-primary" name="btn_update_payment_info" id="btn_update_payment_info">
                 </div>
            </div>

          </form>
         </div>
        </div>
       </div>
      </div>
    <?php $this->load->view(ADMIN_PANEL_NAME.'top-footer'); ?>
   </div>
  </div>
<!-- END Main Content -->
<script type="text/javascript">

$(document).ready(function(){

  $('#btn_update_payment_info').click(function(){
    var ppal_uname      =$('#ppal_uname').val();
    var ppal_apikey     =$('#ppal_api').val();
    var ppal_pass       =$('#ppal_pass').val();
    var sand_username   =$('#snd_uname').val();
    var sand_api_key    =$('#snd_api').val();
    var sand_pass       =$('#snd_password').val();
    var payment_mode=$("input[name='mode']:checked").val();

    var flag=1;

    if($('input[name=mode]:checked').length<=0 )
    {
        $('#error_mode').html('Please select mode');
        $('#live').on('click',function()
        {
          $('#error_mode').hide();
        });
         $('#sandbox').on('click',function()
        {
          $('#error_mode').hide();
        });
        flag=0;
       
    }

    if(payment_mode=='live')
    {
       
       $('#error_snd_uname').hide();
       $('#error_snd_api').hide();
       $('#error_snd_password').hide();
       
       if(ppal_uname=='') 
       {
          $('#error_ppal_uname').show();
          $('#error_ppal_uname').html('Please enter paypal username');
          $('#ppal_uname').focus();
          $('#ppal_uname').on('keyup',function()
          {
            $('#error_ppal_uname').hide();
          });
          flag=0;
       }
       if(ppal_apikey=='') 
       {
          $('#error_ppal_api').show();
          $('#error_ppal_api').html('Please enter paypal api key');
          $('#ppal_api').focus();
          $('#ppal_api').on('keyup',function()
          {
            $('#error_ppal_api').hide();
          });
          flag=0;
        }
       if(ppal_pass=='') 
       {
          $('#error_ppal_pass').show();
          $('#error_ppal_pass').html('Please enter paypal password');
          $('#ppal_pass').focus();
          $('#ppal_pass').on('keyup',function()
          {
            $('#error_ppal_pass').hide();
          });
          flag=0;
        }

    }
    else if(payment_mode=='sandbox')
    {

      $('#error_ppal_uname').hide();
      $('#error_ppal_pass').hide();
      $('#error_ppal_api').hide();
      if(sand_username=='') 
       {
          $('#error_snd_uname').show();
          $('#error_snd_uname').html('Please enter sandbox username');
          $('#snd_uname').focus();
          $('#snd_uname').on('keyup',function()
          {
            $('#error_snd_uname').hide();
          });
          flag=0;
       }
       if(sand_api_key=='') 
       {
          $('#error_snd_api').show();
          $('#error_snd_api').html('Please enter sandbox api key');
          $('#snd_api').focus();
          $('#snd_api').on('keyup',function()
          {
            $('#error_snd_api').hide();
          });
          flag=0;
        }
       if(sand_pass=='') 
       {
          $('#error_snd_password').show();
          $('#error_snd_password').html('Please enter sandbox password');
          $('#snd_password').focus();
          $('#snd_password').on('keyup',function()
          {
            $('#error_snd_password').hide();
          });
          flag=0;
        }

    }
    if(flag==1)
    {
        return true;
    }
    else
    {
        return false;
    }
});

});
</script>