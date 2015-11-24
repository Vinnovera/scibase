<?php 

if (have_posts()) :
	while (have_posts() ) : the_post();  

		$title = get_the_title();
		$ID = get_field('client_id');		
		
		echo '<span class="client-title">'.$title.'</span>';
		echo '<span class="client-id">'.$ID.'</span>';


	endwhile;
endif;
?>