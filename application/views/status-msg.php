

<div style="padding-left:10px;padding-right:10px; padding-top:10px;" id="status_msg">
	
	<?php 
	if($this->session->flashdata('error')!=''){  ?>
	   <div class="alert-box errors alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>×</span></button><span class="label label-danger">NOTE <i class="fa fa-frown-o" style="font-size:1.2em;"> </i>  </span> &nbsp; <?php echo  $this->session->flashdata('error'); ?></div>
	<?php } ?>
	<?php  
	if($this->session->flashdata('success')!=''){  ?>
	<div class="alert-box success alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span>×</span></button><span class="label label-success">DONE <i class="fa fa-smile-o" style="font-size:1.2em;"></i>  </span>  &nbsp; <?php echo  $this->session->flashdata('success'); ?></div>
	<?php } ?>

</div>



