<?php 

/*

Template Name: Image gallery

*/

get_header(); 

?>

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
				
				echo '<div class="g three-quarters press-list">';
					echo '<div class="gw">';
						echo '<article class="g one-whole post">';
							echo '<div class="box">';
								include(TEMPLATEPATH . '/components/articlepageFlexslider.php');
								include(TEMPLATEPATH . '/components/content.php');
								include(TEMPLATEPATH . '/components/video.php');
							echo '</div>';
						echo '</article>';
						
						include(TEMPLATEPATH . '/components/imageGallery.php');
						
					echo '</div>';
				echo '</div>';
				
				include(TEMPLATEPATH . '/components/widgets.php');
			}
			
			else {
				echo '<div class="g three-quarters press-list">';
					echo '<div class="gw">';
						echo '<article class="g one-whole post">';
							echo '<div class="box">';
								include(TEMPLATEPATH . '/components/articlepageFlexslider.php');
								include(TEMPLATEPATH . '/components/content.php');
								include(TEMPLATEPATH . '/components/video.php');
							echo '</div>';
						echo '</article>';
						
						include(TEMPLATEPATH . '/components/imageGallery.php');
						
					echo '</div>';
				echo '</div>';
				
				include(TEMPLATEPATH . '/components/widgets.php');
			
			}
			
			?>	

		</div>
	</div>
</div>

<?php get_footer(); ?>
