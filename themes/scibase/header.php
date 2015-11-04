<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title('|'); ?></title>

<?php if (is_user_logged_in()){ ?>
<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1, IE=edge,chrome=1">
<?php }else{ ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php } ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/modernizr.custom.15992.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" type="image/png" href="<?php echo get_bloginfo( 'template_url' ); ?>/favicon.png" />
<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_url'); ?>/ui/css/print.css">
<?php include_once(TEMPLATEPATH . "/components/GEOCheck.php"); ?>
<?php wp_head(); ?>
</head>


<body <?php body_class($class); ?>>
	<div class="geo-overlay" id="overlay"></div>
<?php if(get_field('header_scripts', 'option')) { ?>
	<?php the_field('header_scripts', 'option'); ?>
<?php }?>
<?php 
	$levelClass = '';
	$level = get_current_page_depth()+1;
	$children = get_pages('child_of='.$post->ID);

	if (get_option('menu_init') == 'current_item') {
		if ($level > 1) {
			$levelClass = 'level-'.$level;
		}elseif (count( $children ) != 0) {
			$levelClass = 'level-2';
		}
	}
?>
	<div id="wrapper" class="wrapper">
		<div class="mp-pusher <?php echo $levelClass; ?>" id="mp-pusher">	
			<div class="mobile-menu">
				<?php include(TEMPLATEPATH . '/components/mobileMenu.php'); ?>
			</div>
		<div class="scroller">
			<div class="scroller-inner">	
				<header>
					<div class="body">
						<a href="<?php bloginfo("url"); ?>" class="logo">
							<?php include(TEMPLATEPATH . '/components/logo.php'); ?>
						</a>
						<nav class="top-menu">
							<ul>
								<?php include(TEMPLATEPATH . '/components/topMenu.php'); ?>
							</ul>
							<ul class="utility">
								<li class="search">
									<?php include(TEMPLATEPATH . '/components/topSearch.php'); ?>
								</li>
								<?php include(TEMPLATEPATH . '/components/languageMenu.php'); ?>
							</ul>
						</nav>
						<nav class="main-menu">
							<ul>
								<?php include(TEMPLATEPATH . '/components/mainMenu.php'); ?>
							</ul>
						</nav>

						
					</div>
				</header>
				



	
