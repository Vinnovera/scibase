<?php if(get_field('contact_card_swe')):?>

<?php while(the_repeater_field('contact_card_swe')):?>

<article class="post contact <?php the_sub_field('country'); ?>">
	<figure>
		<?php if(get_sub_field('image')): ?>
		<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'contactCard'); ?>
			<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
		<?php endif; ?>
	</figure>
	
	<div class="bd">
		<?php if(get_sub_field('desc')): ?>
			<?php the_sub_field('desc'); ?>
		<?php endif; ?>
	</div>

	<?php if(get_sub_field('desc')): ?>
		<a href="#" class="readmore"><span class="showmore"><?php _e('Read more', 'scibase'); ?></span><span class="hidemore"><?php _e('Hide', 'scibase'); ?></span></a>
	<?php endif; ?>
</article>

<?php endwhile;?>
<?php endif; ?>
