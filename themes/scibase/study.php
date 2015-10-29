<?php 
/*
Template Name: Landing Page Study

*/
//get_header(); 
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<title><?php wp_title('|'); ?></title>
<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1, IE=edge,chrome=1">
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/modernizr.custom.15992.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="shortcut icon" type="image/png" href="<?php echo get_bloginfo( 'template_url' ); ?>/favicon.png" />
<link rel="stylesheet" type="text/css" media="print" href="<?php bloginfo('template_url'); ?>/ui/css/print.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/ui/css/survey.css">
<?php include_once(TEMPLATEPATH . "/components/GEOCheck.php"); ?>
<?php wp_head(); ?>
</head>


<body <?php body_class($class); ?>>
	<div class="geo-overlay" id="overlay"></div>
<?php if(get_field('header_scripts', 'option')) { ?>
	<?php the_field('header_scripts', 'option'); ?>
<?php }?>
<div class="wrapper">
	<header>
		<div class="body">
			<a href="<?php bloginfo("url"); ?>" class="logo" target="_blank">
				<img src="<?php echo get_bloginfo( 'template_url' ); ?>/ui/img/nevisense_logo.png" alt=""/>
			</a>
		</div>
	</header>	


	<div class="main">
		<div class="body">
			<div class="gw">
				<div class="g one-whole feature">
					<div class="box">
						<img src="<?php echo get_bloginfo( 'template_url' ); ?>/ui/img/nevisense_header.png">
					</div>
				</div>
				<article class="g one-whole">
					<div class="box">
						<div class="survey-text-limit">
							<?php
								if(isset($_POST['surveySuccess'])) {
									if($_POST['surveySuccess']) {
										echo '<div class="survey-message survey-success">Thank you for registering</div>';
									}
								}
							?>
							<?php 
								ob_start();
									the_field("content");
								$content = ob_get_clean();

								ob_start();
									include(TEMPLATEPATH . '/components/survey-form.php');
								$form = ob_get_clean();

								echo preg_replace("/\[survey-form\]/", $form, $content);
								?>
							</div>
					</div>
				</article>
				<div class="g one-whole eq-height">
					<div class="gw">
						<article class="g medium one-half puff survey-address">
							<div class="box">
								<p class="survey-address-title">Director Clinical Engineering</p>
								<h2>SciBase AB</h2>
								<div>
									<p>
										<span>Kammakargatan 22</span>
										<span>SE-111 40 Stockholm, Sweden</span>
										<span>Direct Phone  +46 8 410 209 04</span>
										<span>Mobile Phone +46 708 42 10 54</span>
										<span>Fax                +46 8 615 22 24</span>
										<span>Email: <a href="mailto:ulrik.birgersson@scibase.se">ulrik.birgersson@scibase.se</a></span>
										<span><a href="www.scibase.se">www.scibase.se</a></span>
									</p>
								</div>
							</div>
						</article>

						<article class="g medium one-half puff survey-address">
							<div class="box">
								<p class="survey-address-title">Research Affiliate</p>
								<h2>Karolinska Institutet</h2>
								<div>
									<p>
										<span>Division of Imaging and Technology</span> 
										<span>Department of Clinical Science, Intervention and Technology</span>
										<span>Nobels Allé 10</span>
										<span>SE-14186 Huddinge, Sweden</span>
										<span>Direct Phone  +46 8 410 209 04</span>
										<span>Mobile Phone +46 708 42 10 54</span>
										<span>Fax                +46 8 615 22 24</span>
										<span>Email: <a href="mailto:ulrik.birgersson@ki.se">ulrik.birgersson@ki.se</a></span>
									</p>
								</div>
							</div>
						</article>
					</div>
				</div>
				<article class="g one-whole survey-content">
					<div class="box">
						<div class="survey-text-limit">
							<?php the_field("extra_description"); ?>
						</div>
					</div>
				</article>
				<article class="g one-whole">
					<div class="box">
						<div class="survey-text-limit">
							<?php the_field("more_information"); ?>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
