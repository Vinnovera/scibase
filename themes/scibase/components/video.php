<?php if(get_field('video')):?>
<?php while(the_repeater_field('video')):?>
	
	<?php if(get_sub_field('url')): ?>
		<a href="<?php the_sub_field('url'); ?>" class="fancybox">[Video]</a>
	<?php endif; ?>

<?php endwhile;?>
<?php endif; ?>
