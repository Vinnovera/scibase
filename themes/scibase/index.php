
	<?php get_header(); ?>
	
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
					
					echo '<article class="g three-quarters post">';
						echo '<div class="box">';
							include(TEMPLATEPATH . '/components/articlepageFlexslider.php');
							include(TEMPLATEPATH . '/components/content.php');
							include(TEMPLATEPATH . '/components/video.php');
						echo '</div>';
					echo '</article>';
					
					if ( is_page('image-gallery')) { 
						include(TEMPLATEPATH . '/components/imageGallery.php');	
					}
					
					include(TEMPLATEPATH . '/components/widgets.php');
				}
				
				else {
					echo '<article class="g three-quarters post">';
						echo '<div class="box">';
							include(TEMPLATEPATH . '/components/articlepageFlexslider.php');
							include(TEMPLATEPATH . '/components/content.php');
							include(TEMPLATEPATH . '/components/video.php');
							
						echo '</div>';
					echo '</article>';
					
					include(TEMPLATEPATH . '/components/widgets.php');
				
				}
				
				?>	
	
			</div>
		</div>
	</div>
<?php get_footer(); ?>
