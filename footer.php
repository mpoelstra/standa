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
								<?php $pages = get_field('standa_items', 'option');
								if (count($pages) > 0) { ?>
									<ul class="menu">
										<li class="menu_item">
											<a href="#waarom">Waarom</a>
										</li>
										<?php foreach ($pages as $key => $page) {
											if ($page['standa_item_title']) { ?>
												<li class="menu_item">
													<a href="#page<?php echo $key; ?>"><?php echo $page['standa_item_title']; ?></a>
												</li>
											<?php } ?>
										<?php } ?>
									</ul>
								<?php } ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-3">
							<div class="box">
								<h2>Extra</h2>
								<?php echo $footerExtra; ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-2">
							<div class="box">
								<h2>Contact</h2>
								<?php echo $footerContact; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</footer>


<div class="product-overlay"></div>

<div class="product-form" aria-hidden="true">
    <button class="product-form_close" aria-label="Sluit bestelformulier"></button>
    <?php
        $form = 1;
        gravity_form_enqueue_scripts($form, true);
    	
        //gravity_form( $id_or_title, $display_title = true, $display_description = true, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true );
    	gravity_form($id = $form, $display_title = true, $display_description = true, $display_inactive = false, $field_values = $field_values, $ajax = true, $tabindex = 1);
    ?>
</div>

<!-- script files should be placed at the bottom for performance reasons -->
<?php wp_footer(); ?>
</body>
</html>