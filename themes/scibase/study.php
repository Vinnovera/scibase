<?php 
/*
Template Name: Landing Page Study

*/
get_header(); 
?>
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
