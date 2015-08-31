<?php
if( get_field('logo', 'option') ):
	$attachment_id = get_field('logo', 'option');
	$size = "logo";
	
	$image = wp_get_attachment_image_src( $attachment_id, $size );

?>
<img src="<?php echo $image[0]; ?>" />

<?php
endif;
?>
