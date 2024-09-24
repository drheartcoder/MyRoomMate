<?php include(INC_HTML_TAG); ?>
<?php $hm->Title( __FILE__, RSTR_APP_TITLE, RSTR_CELL, RSTR_CODE ); ?>

<head><?php include(INC_HTML_HEADER); ?>
<style>
#slideshow div {
	margin:0 auto;
}
.code {
	margin:0 auto;
	padding:10px;
	border:1px solid #c0c0c0;
	background-color:#f0f0f0;
}
</style>
</head>

<body>

<!-- [BEGIN] Container -->
<div id="container">

<?php include(INC_BODY_HEADER); ?>

<!-- [BEGIN] Main Form -->
<div id="main_div">

<?php include(INC_FORM_BEGIN); ?>

<?php include(INC_BODY_INFO); ?>

	<?php
		$ad_id = $hm->Zb('rs:def:ad_id');
		function _r_( $ph, $v, $s )
		{
			return CMBStr::replace( $ph, $v, $s );
		}
	?>

	<!-- [BEGIN] How-To -->
	<?php echo $hm->SectBegin(
		_r_( '##ad_id##', $ad_id, RSTR_HOWTOSHOW_ONPAGE_TITLE ) ); ?>

	<div style='margin-top:20px;'></div>
	<div style='margin:10px;padding:30px;background:#bcd4ec url(images/bg_circle.png);
		border:3px solid #bcd4ec;overflow:auto;'>
	<center><?php echo $hm->Zb('rs:def:pic'); ?></center>
	</div>

	<?php
		$path = dirname( dirname( CUtil::GetCurrentPageURL() ) ) . '/cn/';
		$js = "<script type='text/javascript' src='{$path}cn.php'></script>";
		$js = "<span style='color:#008000;'>" . htmlspecialchars( $js ) . "</span>";
		$adcell = "<div class='adfreely' rel='{$ad_id}'></div>" ;
		$adcell = "<span style='color:#008000;'>" . htmlspecialchars( $adcell ) . "</span>";
	$txt=<<<_EOM_
<!DOCTYPE HTML>
<html>
<head>
<script type='text/javascript' src='{$path}cn.php'></script>
</head>
<body>
<div class='adfreely' rel='{$ad_id}'></div>
</body>
</html>
_EOM_;
		$txt = str_replace( "\r", "", $txt );
		$ax = explode( "\n", $txt );
		$codelines = array();
		foreach( $ax as $a )
		{
			$b = ( strpos( $a, "<script" ) !== false ) ||
				( strpos( $a, "<div" ) !== false );
			$ln = htmlspecialchars( $a );
			if ( $b ) $ln = "<span style='color:#008000;'>{$ln}</span>";
			$codelines[] = $ln;
		}
		$code = implode( "<br/>", $codelines );
	?>

	<p><?php echo RSTR_HOWTOSHOW_ONPAGE_P1; ?></p>

	<p><?php echo RSTR_HOWTOSHOW_ONPAGE_P2; ?></p>

	<div class='code'>
	<?php echo $js; ?>
	</div>

	<p><?php echo _r_( '##ad_id##', $hm->Zb('rs:def:ad_id'),
		RSTR_HOWTOSHOW_ONPAGE_P3 ); ?></p>

	<div class='code'>
	<?php echo $adcell; ?>
	</div>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] How-To -->

	<div style='margin-top:20px;'></div>

	<!-- [BEGIN] Sample Web Page -->
	<?php echo $hm->SectBegin( RSTR_HOWTOSHOW_SAMPLE_TITLE ); ?>

	<p><?php echo _r_( '##ad_id##', $hm->Zb('rs:def:ad_id'),
		RSTR_HOWTOSHOW_SAMPLE_P1 ); ?></p>

	<div class='code'>
	<?php echo $code; ?>
	</div>

	<p><?php echo RSTR_HOWTOSHOW_SAMPLE_P2; ?></p>

	<?php echo $hm->SectEnd(); ?>
	<!-- [END] Sample Web Page -->

	<?php echo $hm->SectEndMarker(); ?>

	<!-- [BEGIN] Buttons -->
	<div align="center" style="margin-top:10px">
	<table width='100%'>
	<tr>
		<td align='center'>
			<?php echo $hm->Button( array( '<>'=>'</>', 'name'=>"_sc=_this/search_ret&", 'src'=>'back', 'value'=>RSTR_BACK ) ); ?>
		</td>
	</tr>
	</table>
	</div>
	<!-- [END] Buttons -->

<?php include(INC_FORM_END); ?>

</div>
<!-- [END] Main Form -->

<?php include(INC_BODY_FOOTER); ?>

</div>
<!-- [END] Container -->

</body>
</html>

<?php include(INC_HTML_END); ?>
