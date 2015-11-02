<?php

$open_class = '';
$children = get_pages('child_of='.$post->ID);
if (get_option('menu_init') == 'current_item') {

	if( get_current_page_depth() > 0 || count( $children ) != 0) {
	   $open_class = 'mp-level-open mp-level-overlay';
	}

}

$mobileMenu = array(
	'theme_location'  => 'mobileMenu',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'mobileMenu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'fallback_cb'     => '',
	'walker'          => new mobileMenu_walker_nav_menu
);

?>

<nav id="mp-menu" class="mp-menu">
	<div class="mp-level root <?php echo $open_class; ?>">
		<?php wp_nav_menu( $mobileMenu ); ?>
		<ul class="quick-links mobileMenu">
			<h3>Quick Links:</h3>
			<?php include(TEMPLATEPATH . '/components/topMenu.php'); ?>
		</ul>
		<ul class="utility">
			<h3>Set Language:</h3>
			<?php include(TEMPLATEPATH . '/components/languageMenu.php'); ?>
		</ul>
	</div>
</nav>

<div class="menu-bar">
	<div class="menu-button">				
		<a href="#" id="trigger" class="menu-trigger"></a>
		<p>MENU</p>
	</div>
</div>	
	





