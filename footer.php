<?php wp_reset_query(); ?>

</main>

<footer class="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="footer">
				<?php
				$footerText = get_field('standa_footer_text', 'option');
				$footerExtra = get_field('standa_footer_extra', 'option');
				$footerContact = get_field('standa_footer_contact', 'option');
				?>
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<div class="box">
								<h2 class="logo">Standa</h2>
								<?php echo $footerText; ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="box">
								<h2>Menu</h2>
								<ul class="menu">
									<?php renderMenu($footer = true); ?>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="box">
								<?php echo $footerExtra; ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2">
							<div class="box">
								<?php echo $footerContact; ?>
								<?php 
									$facebook = get_field('standa_facebook', 'option');
									$linkedin = get_field('standa_linkedin', 'option');

									if ($facebook || $linkedin) {
										?>
											<ul class="social">
												<?php if ($facebook) { ?><li><a class="facebook" href="<?php echo $facebook; ?>" target="_blank" title="Volg ons op Facebook"></a></li><?php } ?>
												<?php if ($linkedin) { ?><li><a class="linkedin" href="<?php echo $linkedin; ?>" target="_blank" title="Volg ons op LinkedIn"></a></li><?php } ?>
											</ul>
										<?php
									}
								?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- script files should be placed at the bottom for performance reasons -->
<?php wp_footer(); ?>
</body>
</html>