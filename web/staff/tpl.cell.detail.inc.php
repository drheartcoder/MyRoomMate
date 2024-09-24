<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, RSTR_APP_TITLE, RSTR_CELL, $hm->Zb( 'page:caption_verb' ) ); ?>
<?php include(INC_DETAIL_VERB); ?>

<head><?php include(INC_HTML_HEADER); ?></head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php include(INC_BODY_HEADER); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php $_form_params_ = "enctype='multipart/form-data'"; ?>
<?php include(INC_FORM_BEGIN); ?>

<?php include(INC_BODY_INFO); ?>

	<?php if ( $hm->Zb("def:display?") ) { ?>

	<!-- [BEGIN] basic_info -->
	<?php echo $hm->SectBegin( $hm->Zb( 'page:caption_verb' ) . " [" . RSTR_CELL ."]" ); ?>

	<div style='overflow:auto;'>
	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<?php if ( false && ( $b_edit || $b_del )) { ?>
	<tr>
		<td class='column_caption'><span class="required"></span> <?php echo RSTR_CELL_ID; ?> : </td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:cell_id'); ?></td>
	</tr>
	<?php } ?>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?>
			<span class="required">*</span>
			<?php } ?>
			<?php echo RSTR_ACTIVE; ?> :
		</td>
		<td class='column_value'>
			<?php if ( $b_reg || $b_edit ) { ?>
				<?php echo $hm->Zb('rs:def:active_Y'); ?>Yes&nbsp;&nbsp;&nbsp;
				<?php echo $hm->Zb('rs:def:active_N'); ?>No
			<?php } ?>
			<?php if ( $b_del ) { ?>
				<?php echo $hm->Zb('rs:def:active'); ?>
			<?php } ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			<?php echo RSTR_AD_ID; ?> :
		</td>
		<td class='column_value'>
			<?php echo $hm->Zb('rs:def:ad_id'); ?>
		</td>
	</tr>

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required">*</span><?php } ?>
			<?php echo RSTR_SIZE; ?> :
		</td>
		<td class='column_value'>
			<?php echo RSTR_IMAGE_W; ?> <?php echo $hm->Zb('rs:def:image_w'); ?> px&nbsp;&nbsp;&nbsp;
			<?php echo RSTR_IMAGE_H; ?> <?php echo $hm->Zb('rs:def:image_h'); ?> px
		</td>
	</tr>

	<!-- [BEGIN] Def Buttons (For IE) -->
	<?php if ( $b_reg ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_done&" ) ); ?>
	<?php } ?>
	<?php if ( $b_edit ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/edit_done&" ) ); ?>
	<?php } ?>
	<!-- [BEGIN] Def Buttons (For IE) -->

	<tr>
		<td class='column_caption' valign='top'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			<?php echo RSTR_PIC; ?> : </td>
		<td class='column_value'>
			<?php if (( !$b_del ) || ( $hm->Zb('rs:def:pic_state=') != 'E' )) { ?>
				<div style='width:800px;overflow:auto;'>
				<?php echo $hm->Zb('rs:def:pic'); ?>
				</div>
			<?php } ?>

			<?php if ( !$b_del ) { ?>
			<?php if ( $hm->Zb('rs:def:pic_state=') == 'E' ) { ?>
				<span style='font-size:80%'>
				<?php echo RSTR_USE_BROWSE; ?>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_file_upload&fileup_key=pic" value="<?php echo RSTR_FILE_UPLOAD; ?>"/>
				</span>
			<?php } else { ?>
				<input type="submit" name="_sc=_this/<?php echo $verb; ?>_file_remove&fileup_key=pic" value="<?php echo RSTR_FILE_REMOVE; ?>"/>
			<?php } ?>
			<?php } ?>
		</td>
	</tr>

	<!-- [BEGIN] Def Buttons (For FireFox) -->
	<?php if ( $b_reg ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_done&" ) ); ?>
	<?php } ?>
	<?php if ( $b_edit ) { ?>
		<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/edit_done&" ) ); ?>
	<?php } ?>
	<!-- [BEGIN] Def Buttons (For FireFox) -->

	<tr>
		<td class='column_caption'>
			<?php if ( $b_reg || $b_edit ) { ?><span class="required"></span><?php } ?>
			<?php echo RSTR_LINK_URL; ?> :
		</td>
		<td class='column_value'><?php echo $hm->Zb('rs:def:url_link'); ?>
		</td>
	</tr>

	</table>
	</div>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] basic_info -->

	<?php include(INC_DETAIL_LOG_INFO); ?>

	<?php echo $hm->SectEndMarker(); ?>

	<?php include(INC_DETAIL_BUTTONS); ?>

	<?php } ?>

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include(INC_BODY_FOOTER); ?>

</div>
<!-- [END] Container -->

</body>
</html>

<?php include(INC_HTML_END); ?>
