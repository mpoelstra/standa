<?php
/*
 * Template Name: Actiepagina
 *
 */
?>

<?php 
    get_header();

    if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	    	<div class="container">
	    		<div class="row">
					<div class="col-xs-12">
						<div class="product">
							<?php get_template_part( 'template-parts/part-home', 'menu' ); ?>
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<?php get_template_part( 'template-parts/part-page', 'slider' ); ?>
								</div>
								<div class="col-xs-12 col-sm-6">
									<?php get_template_part( 'template-parts/part-page', 'product' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
	    	</div>

			<div class="container container--small">
				<?php get_template_part('template-parts/part-page', 'features'); ?>
			</div>

			<div class="container container--smaller">
				<?php get_template_part('template-parts/part-page', 'pages'); ?>
			</div>

			<?php get_template_part('template-parts/part-home', 'bar'); ?>
    <?php

	endwhile;

    get_footer();
?>
