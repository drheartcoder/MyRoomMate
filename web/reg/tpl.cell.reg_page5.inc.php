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

<?php include(INC_FORM_BEGIN); ?>
<input type="hidden" name="_sc" value="_this/reg_page5_next" />

<?php include( 'tpl.page.info.inc.php' ); ?>

	<div style='margin:10px;padding:10px;'>

	<div style='margin:10px 10px 20px 10px;padding:0px;'>
	<?php echo RSTR_MAKE_CLICKABLE; ?>
	</div>

	<!-- [BEGIN] Fields -->
	<table width='100%' border='0' cellpadding='3' cellspacing='1'>

	<tr>
		<td class='td_caption'><span class="required"></span> <?php echo RSTR_URL; ?> : </td>
		<td class='td_value'><?php echo $hm->Zb('rs:def:url_link'); ?></td>
	</tr>

	<tr>
		<td class='td_caption'>&nbsp;</td>
		<td class='td_value'>
			<span style='font-size:80%'>
			<?php echo RSTR_URL_LINK_EX; ?>
			</span>
		</td>
	</tr>

	</table>
	<!-- [END] Fields -->

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin-top:40px;">
	<?php echo $hm->Button( array( '<>'=>'<default/>', 'name'=>"_sc=_this/reg_page5_next&" ) ); ?>
	<table width='100%'>
	<tr>
		<td align='center'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_page5_prev&", 'src'=>'prev', 'value'=>RSTR_BACK ) ); ?>
		</td>
		<td align='center'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/reg_page5_next&", 'src'=>'next', 'value'=>RSTR_NEXT ) ); ?>
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
