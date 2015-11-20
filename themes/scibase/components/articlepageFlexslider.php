<?php if(get_field('flexslider') && get_field('flexslider').length > 0):?>
<div class="slider">
	<ul class="slides">
		<?php while(the_repeater_field('flexslider')):?>
		<li>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'articlepageFlexslider'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
			<div class="content">
			<?php if(get_sub_field('desc')): ?>
				<h2><span><?php the_sub_field('desc'); ?></span></h2>
			<?php endif; ?>
			<?php if(get_sub_field('link_url')): ?>
				<p><a href="<?php the_sub_field('link_url'); ?>" class="read-more"><?php the_sub_field('link_text'); ?></a></p>
			<?php endif; ?>
			</div>
		</li>
		<?php endwhile;?>
	</ul>
</div>
<?php endif; ?>
