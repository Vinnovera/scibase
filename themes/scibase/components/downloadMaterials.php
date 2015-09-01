<?php if(get_field('download_materials')):?>
<?php while(the_repeater_field('download_materials')):?>
<article class="post download">
	<figure>
		<?php if(get_sub_field('image')): ?>
		<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'download-materials'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
		<?php endif; ?>
	</figure>
	<div class="bd">
		<?php if(get_sub_field('desc')): ?>
			<?php the_sub_field('desc'); ?>
		<?php endif; ?>
	</div>
</article>
<?php endwhile;?>
<?php endif; ?>
