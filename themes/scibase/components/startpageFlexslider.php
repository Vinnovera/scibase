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

		
		<div class="frontpage-image">
			
			<?php 
			
			$randomSlide = array_rand(get_field('flexslider'),1);
			$slide = get_field('flexslider')[$randomSlide];
			//var_dump($randomSlide);
			//print_r($slide);
			
			$image = wp_get_attachment_image_src($slide['image'], 'startpageFlexslider');

			//var_dump($slide['desc']);
			
			//print_r($slide);
			?>

			<img src="<?php echo $image[0]; ?>">
			<div class="content">
				<?php if($slide['desc']): ?>
				<h2>
					<span><?php echo $slide['desc']; ?></span>
				</h2>
				<?php endif; ?>

				<?php if($slide['link_url_external']) :
				
				 ?>
					<p><a href="<?php echo $slide['link_url_external']; ?>" class="read-more" target="_blank"><?php echo $slide['link_text']; ?></a></p>
				<?php else : ?>
					<?php if($slide['link_url']): ?>
						<p><a href="<?php echo $slide['link_url'];?>" class="read-more"><?php echo $slide['link_text']; ?></a></p>
					<?php endif; ?>
				<?php endif; ?>

			</div>
			<?php
				
			//var_dump($slide);

			?>

			
		</div>
		

	</div>
</div>
<?php endif; ?>
