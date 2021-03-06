<?php if(get_field('one-third')):?>
<div class="g one-whole">
	<div class="gw">
		<?php while(the_repeater_field('one-third')):?>
		<article class="puff small g one-third">
			<?php if(get_sub_field('image')) { ?>
			<div class="box">
				<a href="<?php the_sub_field('link_url'); ?>" class="overlay">
					<?php $image = wp_get_attachment_image_src(get_sub_field('image'), 'startpageThirdPuff'); ?>
					<img src="<?php echo $image[0]; ?>" alt="<?php echo get_the_title(get_sub_field('image')); ?>">
					
					<?php if(get_sub_field('title')): ?>
						<h2><?php the_sub_field('title'); ?></h2>
					<?php endif; ?>
					
					<div>
						<?php if(get_sub_field('desc')): ?>
							<?php the_sub_field('desc'); ?>
						<?php endif; ?>
						
						<?php if(get_sub_field('link_text')): ?>
							<b href="<?php the_sub_field('link_url'); ?>" class="read-more"><?php the_sub_field('link_text'); ?></b>
						<?php endif; ?>
					</div>
				</a>
			</div>
			<?php } else { ?>
			<div class="box fill">
				<?php if(get_sub_field('title')): ?>
					<h2>
						<a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('title'); ?></a>
					</h2>
				<?php endif; ?>
				
				<div>
					<?php if(get_sub_field('desc')): ?>
						<?php the_sub_field('desc'); ?>
					<?php endif; ?>
					
					<?php if(get_sub_field('link_text')): ?>
						<a href="<?php the_sub_field('link_url'); ?>" class="read-more"><?php the_sub_field('link_text'); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php } ?>
		</article>
		<?php endwhile;?>
	</div>
</div>
<?php endif; ?>
