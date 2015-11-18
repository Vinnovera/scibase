<?php 
/*
Template Name: Productpage

*/
get_header(); 
?>
<div class="main">
	<div class="body">
		<div class="gw">
			<div class="g three-quarters post">
			<?php if(get_field('flexslider')): ?>
			<div class="g feature post">
				<div class="box">
					<?php include(TEMPLATEPATH . '/components/productpageFlexslider.php'); ?>
					<?php include(TEMPLATEPATH . '/components/headline.php'); ?>
				</div>
			</div>
			<?php endif;?>
			<article class="g post">

				<div class="box">
					<?php include(TEMPLATEPATH . '/components/content-header.php'); ?>
					<?php include(TEMPLATEPATH . '/components/content.php'); ?>
				</div>
			</article>
			</div>
			<nav class="g one-quarter side-menu">
				<div class="box">
					<?php include(TEMPLATEPATH . '/components/subMenu.php'); ?>
				</div>
			</nav>
		</div>
	</div>
</div>

<?php get_footer(); ?>
