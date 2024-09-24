<div>
<?php if ( $url_link != '' ) { ?>
<a href='<?php echo $url_link; ?>' target='_balnk'>
<?php } ?>
<img
	src='<?php echo $url_image; ?>'
	width='<?php echo $image_w; ?>'
	height='<?php echo $image_h; ?>'
	border='0'
	title='<?php echo $ad_id; ?>'
	alt='<?php echo $ad_id; ?>'
/>
<?php if ( $url_link != '' ) { ?>
</a>
<?php } ?>
</div>