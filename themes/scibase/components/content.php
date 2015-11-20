<?php if(get_field('content')):?>
	<?php the_field('content'); ?>
<?php endif; ?>

<?php if( have_rows('foldable_list') ): ?>
		<!--div class="foldable-list-actions">
			<button class="expand-btn">+ Expand all</button>
		</div -->
		<ul class="foldable-list">
		<?php 

		// loop through rows (parent repeater)
		while( have_rows('foldable_list') ): the_row();

			echo '<li class="foldable-list-item">';
			echo '<h3 class="foldable-list-headline">'.get_sub_field('item_headline').'</h3>';
			echo '<div class="foldable-list-content">';
				the_sub_field('item_content');

				// check for rows (sub repeater)
				if( have_rows('sub_list') ):
					echo '<ul class="foldable-list sub-list">';
					// loop through rows (sub repeater)
					while( have_rows('sub_list') ): the_row();

						echo '<li class="foldable-list-item">';
							echo '<h3 class="foldable-list-headline">'.get_sub_field('sub_item_headline').'</h3>';
							echo '<div class="foldable-list-content">'.get_sub_field('sub_item_content').'</div>';
						echo '</li>';
						
					endwhile;
					echo '</ul>';
				endif;

			echo '</div>';
			echo '</li>';


		endwhile; ?>
		</ul>
<?php endif;  ?>