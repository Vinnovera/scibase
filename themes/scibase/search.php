<?php get_header(); ?>

<div class="main">
	<div class="body">
		<div class="gw">
			<aside class="g one-quarter">
				<div class="box search">
					<form method="get" class="search-form" action="<?php bloginfo("url"); ?>/">
						<input type="text" name="s" class="query icon search on-page" placeholder="<?php _e('Search...', 'scibase'); ?>">
						<input type="submit" name="submit" class="hide">
					</form>
				</div>
			</aside>
			<?php
			if (have_posts()):
			?>
			<article class="g three-quarters post-list">
				<div class="box">
					<?php while (have_posts()) : the_post(); ?>
						<article class="post">
							<h1>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h1>
							<?php
							if(get_field('content')) {
								echo custom_field_excerpt('content'); // More info in functions.php
							} else {
								the_excerpt();	
							}
							?>
						</article>
					<?php endwhile; ?>
				</div>
			</article>
			<?php else : ?>
			<article class="g three-quarters post">
				<div class="box">
					<article class="post">
						<h1>
							<?php _e( 'Nothing Found'); ?>
						</h1>
					</article>
				</div>
			</article>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
