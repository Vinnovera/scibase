<?php
//Excerpt from Advanced Custom Field
function custom_field_excerpt($title) {
	global $post;
	$text = get_field($title);
	if ( '' != $text ) {
		$text = strip_shortcodes( $text );
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
		$excerpt_length = 40; // 20 words
		$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
		$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', $text);
}

//Languages configs
load_theme_textdomain( 'scibase', TEMPLATEPATH.'/languages' );
 
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);


// WP EDITOR FIXES
function customformatTinyMCE($init) {
	// Add block format elements you want to show in dropdown
	$init['theme_advanced_blockformats'] = 'p,h1,h2,h3';

	// Add elements not included in standard tinyMCE doropdown p,h1,h2,h3,h4,h5,h6
	//$init['extended_valid_elements'] = 'code[*]';

	return $init;
}

// Modify Tiny_MCE init
add_filter('tiny_mce_before_init', 'customformatTinyMCE' );


// Activate WP Menus
add_theme_support( 'menus' );

// Menus
register_nav_menus( array(  
    'topMenu' 		=> __( 'Top Menu'),
    'mainMenu' 		=> __( 'Main Menu'),
    'footerMenu' 	=> __( 'Footer Menu')
));



if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'logo', 194, 52, false);
	
	add_image_size( 'startpageFlexslider', 920, 350, true);
	
	add_image_size( 'startpageHalfPuff', 440, 200, true);
	add_image_size( 'startpageHalfPuffRight', 248, 201, true);
	
	add_image_size( 'startpageThirdPuff', 280, 180, true);
	
	add_image_size( 'productpageFlexslider', 610, 320, true);
	
	add_image_size( 'articlepageFlexslider', 610, 320, true);
	
	add_image_size( 'contactCard', 125, 145, true);
	
	add_image_size( 'article', 700, 9999, false);
	
	add_image_size( 'imageGallery', 199, 9999, false);
	
	add_image_size( 'widget', 196, 107, true);
	
	add_image_size( 'download-materials', 125, 145, true);
}

//Remove WP default image sizes and add new ones
function custom_upload_sizes($sizes) {
       //unset( $sizes['thumbnail']);
       //unset( $sizes['medium']);
       //unset( $sizes['large']);
       //unset( $sizes['full'] ); // removes full size if needed

       $custom_imgsizes = array(
       		"article" => __( "Article")
       );
       $newimgsizes = array_merge($sizes, $custom_imgsizes);
       return $newimgsizes;
}
add_filter('image_size_names_choose', 'custom_upload_sizes');


// Activate Sidebars

if ( function_exists('register_sidebar') )
{   
	//SIDEBAR
	register_sidebar(array(
	'name' => 'Sidebar',
	'before_widget' => '<div class="row widget">', 
	'after_widget' => '</div>'
	));
	
}

//Activate Globals Option page

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page('Options');
	
}

// removed dynamically width and height
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );
// Genesis framework only
add_filter( 'genesis_get_image', 'remove_thumbnail_dimensions', 10 );
// Removes attached image sizes as well
add_filter( 'the_content', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


//Remove some default wordpress menu items
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'),__('Comments'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }
  
add_action('admin_menu', 'remove_menu_items');

function surveyformSubmit() {
	if (!isset($_POST['survey_form_nonce']) || !wp_verify_nonce($_POST['survey_form_nonce'], 'survey_form') || !empty($_POST['sf_submit'])) return;

	$details = array(
      "firstname" => strip_tags($_POST['firstname']),
      "surname" => strip_tags($_POST['surname']),
      "firstyear" => strip_tags($_POST['firstyear']),
      "practice" => strip_tags($_POST['practice']),
      "address" => strip_tags($_POST['address']),
      "address2" => strip_tags($_POST['address2']),
      "city" => strip_tags($_POST['city']),
      "state" => strip_tags($_POST['state']),
      "zip" => strip_tags($_POST['zip']),
      "email" => strip_tags($_POST['email']),
      "phone" => strip_tags($_POST['phone'])
    );

    require_once "inc/surveyform.class.php";

    $result = new SurveyForm($details);

    $_POST['surveyValues'] = $details;

    if(!$result->getStatus()) {
    	$_POST['surveySuccess'] = false;
    } else {
    	$_POST = array(); //Empty fields if sucess
    	$_POST['surveySuccess'] = true;
    }


}

add_action('init', 'surveyformSubmit');

// remove shit from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

?>
