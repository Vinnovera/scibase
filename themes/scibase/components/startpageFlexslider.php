<?php if(get_field('flexslider')):?>
<div class="g one-whole">
	<div class="box">
		<div class="slider">
			<ul class="slides">
				<?php while(the_repeater_field('flexslider')):?>
				<li>
				<?php
					$value = get_sub_field( "embed" );

					if( $value ) {

						echo the_sub_field('embed');

					} else {
					?>
						<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'startpageFlexslider'); ?>
						<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">

						<div class="content">
							<?php if(get_sub_field('desc')): ?>
							<h2>
								<span><?php the_sub_field('desc'); ?></span>
							</h2>
							<?php endif; ?>

							<?php if( get_sub_field('link_url_external') ) : ?>
								<p><a href="<?php the_sub_field('link_url_external'); ?>" class="read-more" target="_blank"><?php the_sub_field('link_text'); ?></a></p>
							<?php else : ?>
								<?php if(get_sub_field('link_url')): ?>
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
	</div>
</div>
<?php endif; ?>
