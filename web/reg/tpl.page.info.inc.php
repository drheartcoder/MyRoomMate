<?php if ( $hm->Zb("page:info_msg?") ) { ?>
	<!-- [BEGIN] Info Message -->
	<div style='margin:20px 30px 0px 20px;padding:5px 0 5px 10px;font-weight:bold;text-align:left;color:#008000;'>
	<?php echo $hm->Zb("page:info_msg"); ?>
	</div>
	<!-- [END] Info Message -->
<?php } ?>

<?php if ( $hm->Zb("page:err_msg?") ) { ?>
	<!-- [BEGIN] Error Message -->
	<div style='margin:20px 30px 0px 20px;padding:15px 10px 15px 10px;
		font-weight:bold;text-align:left;color:#ff0000;border:1px red solid;
		background-color:#ffe0e0'>
	<?php echo $hm->Zb("page:err_msg"); ?>
	</div>
	<!-- [END] Error Message -->
<?php } ?>
