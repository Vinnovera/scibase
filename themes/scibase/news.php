<?php 

/*

Template name: Newspage

*/

get_header(); ?>
<div class="main">
	<div class="body">
		<div class="gw">
		
			<?php
			if($post->post_parent){
				$children = wp_list_pages("depth=1&sort_column=menu_order&title_li=&child_of=".$post->post_parent."&echo=0");
			}
			
			else {
				$children = wp_list_pages("depth=1&sort_column=menu_order&title_li=&child_of=".$post->ID."&echo=0");
			}
			
			if ($children) {
				echo'<nav class="g one-quarter side-menu">';
					echo '<div class="box">';
						include(TEMPLATEPATH . '/components/subMenu.php');
					echo '</div>';
				echo'</nav>';
				
				echo '<article class="g three-quarters post-list">';
					echo '<div class="box">';
						include(TEMPLATEPATH . '/components/news.php');
					echo '</div>';
				echo '</article>';
			}
			
			else {
				echo '<article class="g three-quarters post-list">';
					echo '<div class="box">';
						include(TEMPLATEPATH . '/components/news.php');
					echo '</div>';
				echo '</article>';
			
			}
			
			?>	

		</div>
	</div>
</div>

<?php get_footer(); ?>
