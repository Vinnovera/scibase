<?php

require_once('inc/custom-post-type.php');

show_admin_bar( false );

update_option( 'menu_init', 'current_item' );

function enable_extended_upload ( $mime_types =array() ) {
 
   // The MIME types listed here will be allowed in the media library.
   // You can add as many MIME types as you want.
   $mime_types['zip']  = 'application/zip';
   $mime_types['ppt'] = 'application/mspowerpoint';
   $mime_types['ps'] = 'application/postscript';
   $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension
   $mime_types['psd'] = 'image/vnd.adobe.photoshop'; //Adding photoshop files
   $mime_types['eps'] = 'application/postscript'; //Adding eps files
   $mime_types['ai'] = 'application/postscript'; //Adding eps files
 
   return $mime_types;
}
 
add_filter('upload_mimes', 'enable_extended_upload');

function limit_access( $value, $post_id, $field ){
	if (!is_admin()) {

		$url = esc_url( get_permalink($post_id) );

		//If the user is in the sales section
		$url = strpos($url,'sales');
		
		if (!members_can_current_user_view_post( $post_id ) ) {

			$value = members_get_post_error_message( $post_id ).members_login_form_shortcode();

		}else if (members_can_current_user_view_post( $post_id ) && is_user_logged_in() && $field['name'] == 'content' && $url > 0) {
			
			$value = '<div class="loginout">'.wp_loginout( get_permalink($post_id) , false).'</div>'.$value;
		}
	}
	return $value;
}

// acf/load_value - filter for every value load
add_filter('acf/load_value', 'limit_access', 10, 3);

function filesDir($catSlug) {

// Use english site for filedir.
global $switched;
switch_to_blog(2);

if (!$catSlug) {
	$catSlug = 'sales';
}
  
$cat = get_category_by_slug($catSlug); 
$catID = $cat->term_id;

$output = '<ul class="filedir">';
$parents = get_categories(array('hierarchical' => false, 'include' => $catID, 'hide_empty'  => 0));

	if(!empty($parents)){
		foreach($parents as $parent){

			$children = get_categories(array('hierarchical' => false, 'parent' => $parent->term_id, 'hide_empty'  => 0));
		
			foreach($children as $child){
				$output .= '<li class="folder">'.$child->name.'</li>';
				$output .= '<ul>';
				$output .= renderFiles($child->term_id);

				$subchildren = get_categories(array('hierarchical' => false, 'parent' => $child->term_id, 'hide_empty'  => 0));

				foreach($subchildren as $subchild){
					$output .= '<li class="folder">'.$subchild->name.'</li>';
					$output .= '<ul>';
					$output .= renderFiles($subchild->term_id);
					
					$sub_2_children = get_categories(array('hierarchical' => false, 'parent' => $subchild->term_id, 'hide_empty'  => 0));

					foreach($sub_2_children as $sub_2_child){
						$output .= '<li class="folder">'.$sub_2_child->name.'</li>';
						$output .= '<ul>';
						$output .= renderFiles($sub_2_child->term_id);
						
						$sub_3_children = get_categories(array('hierarchical' => false, 'parent' => $sub_2_child->term_id, 'hide_empty'  => 0));

						foreach($sub_3_children as $sub_3_child){
							$output .= '<li class="folder">'.$sub_3_child->name.'</li>';
							$output .= '<ul>';
							$output .= renderFiles($sub_3_child->term_id);
							$output .= '</ul>';
						}
						$output .= '</ul>';
					}
					$output .= '</ul>';
				}
				$output .= '</ul>';

			}

			$output .= renderFiles($catID);
			
		}
	}
restore_current_blog();
$output .= '</ul>';

return $output;
}

function renderFiles($catID){
	global $post;

	$files = get_posts(array('post_type' => 'attachment' ,'category__in' => $catID, 'posts_per_page'   => -1) );


	$html;

	foreach ( $files as $post ) : setup_postdata( $post);
		$fileType = explode("/", get_post_mime_type($post->ID));
		$fileType = $fileType[1];

		$html .= '<li><a href="'.wp_get_attachment_url( $post->ID ).'" download target="_blank"><span class="file-icon"><img src="'.get_icon_for_attachment($post->ID).'"/></span><span class="title">'.get_the_title().'</span><span class="download">'.__('Download','scibase').'</span><span class="filetype">'.$fileType.'</span></a></li>';
	endforeach;
	wp_reset_postdata();

	return $html;
}

function get_icon_for_attachment($post_id) {
  $base = "http://stdicon.com/tango/";
  $type = get_post_mime_type($post_id);
  $icon = wp_get_attachment_image_src( $post_id, 'thumbnail' );

  switch ($type) {
	case 'image/jpeg':
	case 'image/png':
	case 'image/gif':
	  return $icon[0]; break;
	case 'application/postscript':
		return $base.'image?size=32&default=package'; break;
	case 'application/pdf':
	  return $base.'text?size=32&default=package';
	default:
	  return $base.$type.'?size=32&default=package';
  }

  
}

function helloUser() {
	if (is_user_logged_in()) {
		$current_user = wp_get_current_user();
		$output = __('Welcome','scibase').' '. $current_user->user_nicename;
		return $output;
	}
}

function register_shortcodes(){
   add_shortcode('file-dir', 'filesDir');
   add_shortcode('hello-user', 'helloUser');
}

add_action( 'init', 'register_shortcodes');

function scibase_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_directory_uri().'/style.css' );
	if (is_page_template('study.php')) {
		wp_enqueue_style( 'survey', get_stylesheet_directory_uri().'/ui/css/survey.css' );
	}
	if (!preg_match('/(?i)msie [1-9]\./',$_SERVER['HTTP_USER_AGENT'])){ 
		wp_enqueue_style( 'responsive', get_stylesheet_directory_uri().'/ui/css/responsive.css' );
		wp_enqueue_style( 'mobile-menu', get_stylesheet_directory_uri().'/ui/css/mobile-menu.css' );
	}
}

add_action( 'wp_enqueue_scripts', 'scibase_scripts' );

add_filter('gform_init_scripts_footer', 'init_scripts');
function init_scripts() {
	return true;
}


add_filter( 'body_class', 'sp_body_class' );
function sp_body_class( $class ) {
	if (preg_match('/(?i)msie [1-9]\./',$_SERVER['HTTP_USER_AGENT'])){
		$class[] = 'non-responsive';
	}

	$current_user   = wp_get_current_user();
	$role_name      = $current_user->roles[0];
 
	if ( $role_name ) {
			$class[] = 'subscriber';
	} // if $role_name
	return $class;
}

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
	'mobileMenu' 	=> __( 'Mobile Menu'),
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

	add_image_size( 'icon', 64, 64, true);
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


/**
 * Check if post is in a menu
 *
 * @param $menu menu name, id, or slug
 * @param $object_id int post object id of page
 * @return bool true if object is in menu
 */
function object_is_in_menu( $menu = null, $object_id = null ) {

	// get menu object
	$menu_object = wp_get_nav_menu_items( esc_attr( $menu ) );

	// stop if there isn't a menu
	if( ! $menu_object )
		return false;

	// get the object_id field out of the menu object
	$menu_items = wp_list_pluck( $menu_object, 'object_id' );

	// use the current post if object_id is not specified
	if( !$object_id ) {
		global $post;
		$object_id = get_queried_object_id();
	}

	// test if the specified page is in the menu or not. return true or false.
	return in_array( (int) $object_id, $menu_items );

}

/**
 * Get current page depth
 *
 * @return integer
 */
function get_current_page_depth(){
	global $wp_query;
	
	$object = $wp_query->get_queried_object();
	$parent_id  = $object->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}
 
	return $depth;
}

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

add_filter('syndicated_item_excerpt','fwp_strip_excerpt',10,2);

function fwp_strip_excerpt ($excerpt, $post) {
    // Strip out the HTML
    $excerpt = wp_trim_words( $excerpt, 40, '...' );;

    // Send it back
    return $excerpt;
} /* fwp_strip_excerpt() */



/*add_filter( 'gform_pre_render_1', 'populate_posts' );
add_filter( 'gform_pre_validation_1', 'populate_posts' );
add_filter( 'gform_pre_submission_filter_1', 'populate_posts' );
add_filter( 'gform_admin_pre_render_1', 'populate_posts' );
function populate_posts( $form ) {

	foreach ( $form['fields'] as &$field ) {

		if ( $field->type != 'select' || strpos( $field->cssClass, 'populate-customer-dropdown' ) === false ) {
			continue;
		}

		// you can add additional parameters here to alter the posts that are retrieved
		// more info: [http://codex.wordpress.org/Template_Tags/get_posts](http://codex.wordpress.org/Template_Tags/get_posts)
		$posts = get_posts( 'numberposts=-1&post_status=publish&post_type=client' );

		$choices = array();

		foreach ( $posts as $post ) {
			$choices[] = array( 'text' => $post->post_title, 'value' => $post->post_ID );
		}

		// update 'Select a Post' to whatever you'd like the instructive option to be
		$field->placeholder = 'Select a Post';
		$field->choices = $choices;

	}

	return $form;
}*/

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


//Walker for mobile menu

class mobileMenu_walker_nav_menu extends Walker_Nav_Menu {
	private $curItem;
	// rebuild output for sub-menus
	function start_lvl( &$output, $depth ) {
		// build html
		$open_class = '';
		$current_class = '';
		if (get_option('menu_init') == 'current_item') {
			if ($this->curItem->current || $this->curItem->current_item_ancestor) {
				$open_class = 'mp-level-open';
			}
		}

		if ($this->curItem->current) {
			$current_class = 'current-menu-item';
		}

		$output .= "\n" . $indent . '<div class="mp-level '.$open_class.'"><a href="'.$this->curItem->url.'"><h2>'.$this->curItem->title.'</h2></a><a class="mp-back" href="#">'.__('Back', 'scibase').'</a><ul><li class="menu-item '.$current_class.'"><a href="'.$this->curItem->url.'">'.$this->curItem->title.'</a></li>' . "\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		/** This filter is documented in wp-includes/post-template.php */
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */

		$this->curItem = $item;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	  
}

add_action('wp_footer', 'ga_tag_manager');

function ga_tag_manager() {
	
	$code = "<!-- Google Tag Manager --><noscript><iframe src='//www.googletagmanager.com/ns.html?id=GTM-WNNWP9'height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-WNNWP9');</script><!-- End Google Tag Manager -->"; 
	echo $code;

}

?>
