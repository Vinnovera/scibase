<?php 
/*
Template Name: Startpage
*/
get_header(); 
?>
<div class="main">
	<div class="body">
		<div class="gw">
			<?php include(TEMPLATEPATH . '/components/startpageFlexslider.php'); ?>
			<?php include(TEMPLATEPATH . '/components/startpage50Cols.php'); ?>
			<?php include(TEMPLATEPATH . '/components/startpage33Cols.php'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
