<?php

$open_class = '';

if( get_current_page_depth() > 0) {
   $open_class = 'mp-level-open mp-level-overlay';
}

$mobileMenu = array(
	'theme_location'  => 'mobileMenu',
	'container'       => 'nav',
	'container_class' => 'mp-menu',
	'container_id'    => 'mp-menu',
	'menu_class'      => 'menu',
	'items_wrap'      => '<div class="mp-level '.$open_class.'"><h2>Main Menu</h2><ul id="%1$s" class="%2$s">%3$s</ul></div>',
	'depth'           => 0,
	'walker'          => new mobileMenu_walker_nav_menu
);

wp_nav_menu( $mobileMenu );

?>
<div class="menu-bar">
	<div class="menu-button">				
		<a href="#" id="trigger" class="menu-trigger"></a>
		<p>MENU</p>
	</div>
</div>	
	





