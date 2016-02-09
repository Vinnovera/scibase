<?php

$related_pages = get_field('related_pages');

if ($related_pages) {
	echo '<p class="g one-quarter side-menu-headline">'.__('Related','scibase').'</p>';
	echo '<nav class="g one-quarter side-menu related-pages">';
		echo '<div class="box">';
			echo '<ul>';
	foreach ($related_pages as $page) {
			echo '<li><a href="'.$page->guid.'">'.$page->post_title.'</a></li>';
		}
			echo '</ul>';
		echo '</div>';
	echo'</nav>';
}
	
?>
