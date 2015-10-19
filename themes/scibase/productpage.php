<?php 
/*
Template Name: Productpage

*/
get_header(); 
?>
<div class="main">
	<div class="body">
		<div class="gw">
			<div class="g one-whole feature">
				<div class="box">
					<?php include(TEMPLATEPATH . '/components/productpageFlexslider.php'); ?>
					<?php include(TEMPLATEPATH . '/components/headline.php'); ?>
				</div>
			</div>
			<article class="g three-quarters post">
				<div class="box">
					<?php include(TEMPLATEPATH . '/components/content.php'); ?>
				</div>
			</article>
			<nav class="g one-quarter side-menu">
				<div class="box">
					<?php include(TEMPLATEPATH . '/components/subMenu.php'); ?>
				</div>
			</nav>
		</div>
	</div>
</div>

<?php get_footer(); ?>
