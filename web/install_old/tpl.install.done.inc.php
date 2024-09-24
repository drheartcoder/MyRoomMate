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

	<div style='margin:20px 10px 20px 10px;padding:10px;'>

	<!-- [BEGIN] Contents -->
	<div style='margin:0 0 30px 0;padding:0px;font-weight:bold;
		font-size:26px;text-align:left;color:#404040;text-align:left;
		'>
	<?php echo RSTR_INSTALL_SUCCESS; ?>
	</div>

	<div style='margin:0 0 30px 0;padding:10px;font-weight:bold;
		text-align:left;color:#404040;
		border:1px solid #e0e0ff;background-color:#F5F5FF;'>
	<span style='margin:0 10px 0 0;padding:2px 10px 2px 10px;
		color:white;background-color:red;font-weight:bold;'>
	<?php echo RSTR_INSTALL_IMPORTANT; ?>
	</span>
	<?php echo RSTR_INSTALL_REMOVE_FOLDER; ?>
	</div>

	<div style='margin:0 0 30px 0;padding:5px;'>
	<?php echo RSTR_INSTALL_LOG_IN; ?>
	</div>

	<center>
	<table cellpadding="3" style='border:1px solid #636AFF;background-color:#D0D3FF;'>
	<tr>
		<td align='right'><?php echo RSTR_INSTALL_USERNAME; ?> : </td>
		<td align='left' style='color:#000080;font-weight:bold;'>admin</td>
	</tr>
	<tr>
		<td align='right'><?php echo RSTR_INSTALL_PASSWORD; ?> : </td>
		<td align='left' style='color:#000080;font-weight:bold;'>password</td>
	</tr>
	</table>
	</center>

	<?php include( 'include/tpl.page.extra.inc.php' ); ?>

	<!-- [END] Contents -->

	</div>

</form>

</div>
<!-- [END] Main Form -->

<?php include( 'include/tpl.page.footer.inc.php' ); ?>

</div>
<!-- [END] Container -->

</body>
</html>