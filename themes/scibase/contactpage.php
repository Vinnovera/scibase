<?php 
/*
Template Name: Contactpage

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
				echo '<article class="g three-quarters post-list">';
					echo '<div class="box">';
						echo '<section class="post">';
							include(TEMPLATEPATH . '/components/content-header.php');
							include(TEMPLATEPATH . '/components/content.php');
						echo '</section>';
						include(TEMPLATEPATH . '/components/contactCardsSwe.php');
					echo '</div>';
				echo '</article>';

				echo'<nav class="g one-quarter side-menu">';
					echo '<div class="box">';
						include(TEMPLATEPATH . '/components/subMenu.php');
					echo '</div>';
				echo'</nav>';
			}
			
			else {
				echo '<article class="g three-quarters post-list">';
					echo '<div class="box">';
						echo '<section class="post">';
							include(TEMPLATEPATH . '/components/content-header.php');
							include(TEMPLATEPATH . '/components/content.php');
						echo '</section>';
						include(TEMPLATEPATH . '/components/contactCardsSwe.php');
					echo '</div>';
				echo '</article>';
				
				echo '<div class="g one-quarter">';
					echo '<div class="gw">';
					
					echo '</div>';
				echo '</div>';
			}
			
			?>	

		</div>
	</div>
</div>

<?php get_footer(); ?>
