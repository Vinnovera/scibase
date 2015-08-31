<li class="language icon down-arrow">
	<?php
	global $blog_id;
	global $switched;
	
	//$current_site_url = get_bloginfo('siteurl');
	
	$path = network_site_url('/');
	
	if ($blog_id == 2) {
		echo '<span class="icon en">English</span>';
		
		echo '<ul>';
			echo '<li>';
				echo '<a href="'.$path.'de" class="icon de">Deutsch</a>';
			echo '</li>';
		echo '</ul>';
	} 
	
	else if ($blog_id == 3) {
		echo '<span class="icon de">Deutsch</span>';
		
		echo '<ul>';
			echo '<li>';
				echo '<a href="'.$path.'en" class="icon en">English</a>';
			echo '</li>';
		echo '</ul>';
	}
	?>
</li>
