</div>
<footer>
	<div class="body">
		<nav class="main-menu">
			<ul>
				<?php include(TEMPLATEPATH . '/components/footerMenu.php'); ?>
			</ul>
		</nav>
		<div class="copyright">
			<p>&copy; <?php _e('copyright', 'scibase'); ?> <?php switch_to_blog('1'); ?><?php bloginfo("name"); ?><?php restore_current_blog(); ?>  <?php $the_year = date("Y"); echo $the_year; ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/adaptive_iframe.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.fitvids.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/froogaloop.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/script.js"></script>
</body>
</html>
