<?php include( 'include/tpl.html.tag.inc.php' ); ?>
<head>
<?php include( 'include/tpl.html.head.inc.php' ); ?>
</head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php include( 'include/tpl.page.header.inc.php' ); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<form action='index.php' method='post'>
<input type='hidden' name='_postback' value='y'/>

	<div style='margin:10px 10px 40px 10px;padding:10px;'>

	<!-- [BEGIN] Contents -->

<?php if ( !$sys->isError() ) { ?>
	<div style='padding:0 0 10px 0;font-size:18px;font-weight:normal;color:#404040;'>
	<?php echo RSTR_INSTALL_START_INSTALL; ?>
	</div>
<?php } else { ?>
	<div style='margin:0 0px 20px 0px;padding:10px;font-weight:bold;
		text-align:left;color:#ff0000;
		border:1px solid #ff0000;background-color:#ffc0c0;'>
	<?php echo $sys->getErrMsg(); ?>
	</div>

	<div style='padding:0 0 10px 0;font-weight:normal;'>
	<?php echo RSTR_INSTALL_CHECK_ERROR; ?>
	</div>
<?php } ?>

<br/>
<br/>
<br/>

	<!-- [END] Contents -->

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin-top:10px">
	<table width='100%'>
	<tr>
		<td align='center'>
			<input type='submit' value='<?php echo RSTR_INSTALL_SETUP; ?>'
			style='font-weight:bold;font-style:italic;height:60px;width:200px;'/>
		</td>
	</tr>
	</table>
	</div>
	<!-- [END] Buttons -->

	</div>

</form>

</div>
<!-- [END] Main Form -->

<?php include( 'include/tpl.page.footer.inc.php' ); ?>

</div>
<!-- [END] Container -->

</body>
</html>