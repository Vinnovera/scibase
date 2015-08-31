<?php if(get_field('widgets')):?>
<?php while(the_repeater_field('widgets')):?>
<aside class="g one-quarter">
<div class="box">
	<?php if(get_sub_field('title')): ?>
		<h2 style="background:<?php the_sub_field('color'); ?>"><?php the_sub_field('title'); ?></h2>
	<?php endif; ?>		
	<div>
		<?php if(get_sub_field('image')): ?>
			<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'widget'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
		<?php endif; ?>	
		<?php if(get_sub_field('desc')): ?>
			<?php the_sub_field('desc'); ?>
		<?php endif; ?>	
	</div>	
</div>
</aside>

<?php endwhile;?>
<?php endif; ?>
