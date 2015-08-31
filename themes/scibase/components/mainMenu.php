<?php 
	if(function_exists('wp_nav_menu')) {
		wp_nav_menu(array(
			'theme_location' 	=> 'mainMenu',			
			'container' 		=> '',
			'container_class' 	=> '',
			'items_wrap'      	=> '%3$s',
			'depth' 			=> '0',
			'fallback_cb' 		=> false,
			'after'				=> '<div class="mark"><div><div></div></div></div>'
		));

	}
?>
