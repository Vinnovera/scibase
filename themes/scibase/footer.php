
</div> <!--/scroller-inner-->
<footer class="body-footer">
	<div class="body">
		<nav class="main-menu">
			<ul>
				<?php include(TEMPLATEPATH . '/components/footerMenu.php'); ?>
			</ul>

		</nav>
		<ul class="quick-links">
				<h3><?php _e('Quick Links','scibase'); ?></h3>
				<?php include(TEMPLATEPATH . '/components/topMenu.php'); ?>
		</ul>
		<div class="copyright">
			<p>&copy; <?php _e('copyright', 'scibase'); ?> <?php switch_to_blog('1'); ?><?php bloginfo("name"); ?><?php restore_current_blog(); ?>  <?php $the_year = date("Y"); echo $the_year; ?></p>
		</div>
	</div>
</footer>

		</div> <!--/scroller-->
	</div> <!--/mp-pusher -->
</div><!-- /wrapper -->
<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/adaptive_iframe.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/jquery.fitvids.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/froogaloop.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/classie.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/mlpushmenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/lib/modernizr.custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/ui/js/script.js"></script>
</body>
</html>
