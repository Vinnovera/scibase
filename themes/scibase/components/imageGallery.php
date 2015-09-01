<?php if(get_field('imageGallery')):?>
<?php while(the_repeater_field('imageGallery')):?>
<section class="g one-third press">
	<div class="box">
		<?php if(get_sub_field('title')): ?>
		<h2><?php the_sub_field('title'); ?></h2>
		<?php endif; ?>
		
		<?php if(get_sub_field('image')): ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'imageGallery'); ?>
			<?php $fullimage = wp_get_attachment_image_src(get_sub_field('image'), 'full'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
			<a href="<?php echo $fullimage[0]; ?>" target="_blank"><?php _e('imageGalleryDownload', 'scibase'); ?></a>
		<?php endif; ?>
	</div>
</section>
<?php endwhile;?>
<?php endif; ?>
