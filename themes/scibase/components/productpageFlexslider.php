<?php if(get_field('flexslider')):?>
<div class="slider">
	<ul class="slides">
		<?php while(the_repeater_field('flexslider')):?>
		<li>
			<?php
				$value = get_sub_field( "embed" );
				
				if( $value ) {
				
					echo '<div class="video">'.get_sub_field('embed').'</div>';
				
				} else {
				?>
					<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'productpageFlexslider'); ?>
					<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
					<div class="content">
					<?php if(get_sub_field('desc')): ?>
						<h2><span><?php the_sub_field('desc'); ?></span></h2>
					<?php endif; ?>
					<?php if(get_sub_field('link_url')): ?>
						<?php if(the_sub_field('link_text') != ''): ?>
							<p><a href="<?php the_sub_field('link_url'); ?>" class="read-more"><?php the_sub_field('link_text'); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
					</div>
				<?php
				}
			?>
		</li>
		<?php endwhile;?>
	</ul>
</div>
<?php endif; ?>
