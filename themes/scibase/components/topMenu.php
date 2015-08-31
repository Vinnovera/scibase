<?php 
	if(function_exists('wp_nav_menu')) {
		$navvi = wp_nav_menu(array(
			'echo'				=> FALSE,
			'theme_location' 	=> 'topMenu',			
			'container' 		=> '',
			'container_class' 	=> '',
			'items_wrap'      	=> '%3$s',
			'depth' 			=> '0',
			'link_before'     	=> '<span>',
			'link_after'     	=> '</span>',
			'fallback_cb' 		=> false
		));
		
		$nav_bits = explode('<li ', $navvi);
		$navvi = ''; $i = 0;
		foreach($nav_bits as $bits) :
		if($i==0) { $navvi = $navvi.$bits; }
		else { $navvi = $navvi.'<li class="item'.$i.'" '.$bits; }
		$i++;
		endforeach;
		echo $navvi;

	}

?>
