<?php
$pageID = 10;
if(is_page($pageID) || is_child($pageID) ) {
	require_once(TEMPLATEPATH . "/geoip.inc");
	$gi = geoip_open(TEMPLATEPATH . "/GeoIP.dat",GEOIP_STANDARD);
	$country_code = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
	geoip_close($gi);
	$block_countries = array('US');

	if(in_array($country_code, $block_countries)) { ?>
	
			<?php
				//if($country_code=='AU') {
				//	$message =  __('We´re sorry. The content on this page cannot be viewed within your country due to legal restrictions, unless you are a registered doctor.', 'scibase');
				//  $heading = __('Confirm to proceed.', 'scibase');
				//	$label_deny = __('Continue as a private person', 'scibase');
				//}
				if($country_code=='US') {
					$message = '';
					$heading = __('Note: Nevisense is not yet approved for commercial distribution in the US.', 'scibase');;
					$label_deny = '';
				}
			?>
			
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/ui/css/geocheck.css">
			<script type="text/javascript">
			// Texts for the restriction modal
				var wp_startpage_url = "<?php bloginfo('url'); ?>",
					heading = "<?php echo $heading; ?>",
					message = "<?php echo $message; ?>",
				    label_confirm = "<?php _e('Proceed', 'scibase'); ?>",
				    label_deny = "<?php echo $label_deny; ?>";
			</script>
    	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/ui/js/geocheck.js"></script>
    <?php }
}

function is_child($pageID) { 
	global $post; 
	if( is_page() && ($post->post_parent==$pageID) ) {
    	return true;
	} else { 
    	return false; 
	}
}

// US TEXT: Note: Nevisense is not yet approved for commercial distribution in the US

?>	
