<?php
if(get_field('footer_cols', 'option')):
while(the_repeater_field('footer_cols', 'option')):
?>

<section class="g one-third">
	<?php if(get_sub_field('title', 'option')): ?>
		<a href="#" class="button"><?php the_sub_field('title', 'option'); ?></a>
	<?php endif; ?>
	<?php if(get_sub_field('desc', 'option')): ?>
		<?php the_sub_field('desc', 'option'); ?>
	<?php endif; ?>	
</section>

<?php
endwhile;
endif;
?>
