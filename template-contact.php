<?php
/*
 * Template Name: Contact
 *
 */
?>

<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/part-content', 'single' );
					endwhile;
				?>
				<?php 
					$contacts = get_field('vkso-contacts');
					if ($contacts) {
						?>
						<div class="row">
							<?php
							foreach ($contacts as $key => $contact) {
								?>
								<div class="col-xs-12 col-sm-6">
									<div class="block">
										<h2 class="block_title"><?php echo $contact['vkso-contact-title']; ?></h2>
										<p class="block_proza">
											<?php echo standa_autolink($contact['vkso-contact-text']); ?>
										</p>
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
				?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<aside>
					<div class="box widget-form">
						<?php
							$form = get_field('vkso-contact-form');

							if ($form && $form->id && $form->is_active) {
								?>
								<h2><?php echo $form->title; ?></h2>
								<?php
								gravity_form($form->id, $display_title = false, $display_description = true, $display_inactive = false, $field_values = null, $ajax = true);
							}
						?>
					</div>
				</aside>
			</div>
		</div>
	</div>

<?php get_footer(); ?>