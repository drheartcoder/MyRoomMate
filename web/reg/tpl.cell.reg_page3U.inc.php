<?php include(INC_HTML_TAG); ?>
<head>
<?php include(INC_HTML_HEADER); ?>
<title><?php echo STR_PAGE_TITLE; ?></title>
</head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php $step = 3; ?>
<?php include( 'tpl.page.header.inc.php' ); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php $_form_params_ = "enctype='multipart/form-data'"; ?>
<?php include(INC_FORM_BEGIN); ?>

<?php include( 'tpl.page.info.inc.php' ); ?>

	<div style='margin:10px;padding:10px;'>

	<div style='margin:10px 10px 20px 10px;padding:0px;'>
	<?php if ( $hm->Zb('rs:def:pic_state=') == 'E' ) { ?>
		<?php echo RSTR_SELECT_PIC; ?>
	<?php } else { ?>
		<?php echo RSTR_CLICK_REPLACE; ?>
	<?php } ?>
	</div>

	<!-- [BEGIN] Fields -->
	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( $hm->Zb('rs:def:pic_state=') == 'E' ) { ?>
	<tr>
		<td class='td_caption'>&nbsp;</td>
		<td class='td_value' align='left'>
			<span style='font-size:80%;font-style:normal;'>
			<?php echo RSTR_ALLOWABLE_IMAGE_TYPES; ?>
			<?php echo RSTR_IMAGE_SIZE; ?> :
				<span class='image_size'><?php echo $sys->image_w; ?></span>
				<?php echo RSTR_PIXELS; ?> [<?php echo RSTR_WIDTH; ?>] x
				<span class='image_size'><?php echo $sys->image_h; ?></span>
				<?php echo RSTR_PIXELS; ?> [<?php echo RSTR_HEIGHT; ?>]<br/>
			</span>
		</td>
	</tr>
	<?php } ?>

	<tr>
		<td colspan='2' align='center'>
			<table cellspacing='0' cellpadding='0'>
			<tr>
				<td>
				<div style='background-color:#f0f0f0;
					border:1px solid #a0a0a0;padding:20px;'>
				<?php echo $hm->Zb('rs:def:pic'); ?>
				</div>
				</td>
			</tr>
			</table>
		</td>
	</tr>

	</table>

	<!-- [END] Fields -->

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin-top:20px;">
	<?php if ( $hm->Zb('rs:def:pic_state=') == 'E' ) { ?>
	<?php } else { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_page3U_next&" ) ); ?>
	<?php } ?>
	<table width='100%'>
	<tr>
		<?php if ( $hm->Zb('rs:def:pic_state=') != 'E' ) { ?>
		<td align='center'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_page3U_file_remove&fileup_key=pic&", 'src'=>'replace', 'value'=>RSTR_REPALCE ) ); ?>
		</td>
		<?php } ?>
		<td align='center'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_page3U_next&", 'src'=>'next', 'value'=>RSTR_NEXT ) ); ?>
		</td>
	</tr>
	</table>
	</div>
	<!-- [END] Buttons -->

	</div>

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include( 'tpl.page.footer.inc.php' ); ?>

</div>
<!-- [END] Container -->

</body>
</html>
