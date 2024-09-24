<?php include(INC_HTML_TAG); ?>
<head>
<?php include(INC_HTML_HEADER); ?>
<title><?php echo STR_PAGE_TITLE; ?></title>
<script type="text/javascript">
parent.iframe_success();
</script>
</head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php $step = 5; ?>
<?php include( 'tpl.page.header.inc.php' ); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php include(INC_FORM_BEGIN); ?>

	<div
		style='margin:30px;padding:30px;font-size:150%;
		color:#808080;font-weight:bold;text-align:center;'>
	<?php echo RSTR_THANK_YOU; ?>
	<br/>
	<br/>
	<input type="image"
		value="Finish" title="<?php echo RSTR_FINISH; ?>"
		alt="<?php echo RSTR_FINISH; ?>"
		onclick='parent.iframe_close(); false;'
		src="<?php echo _LANG_FILE_( "images/buttons/##LANG_CODE##/" ); ?>btn_finish.png"
		onmouseover="javascript:this.src='<?php echo
		_LANG_FILE_( "images/buttons/##LANG_CODE##/" ); ?>btn_finish_ro.png'"
		onmouseout="javascript:this.src='<?php echo
		_LANG_FILE_( "images/buttons/##LANG_CODE##/" ); ?>btn_finish.png'"
	/>
	</div>

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include( 'tpl.page.footer.inc.php' ); ?>

</div>
<!-- [END] Container -->

</body>
</html>
