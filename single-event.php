<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/part-event', 'single' );
					endwhile;
				?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<aside>
					<?php
						$extra_page = get_field('event_location');
						if ($extra_page) {
							?>
							<div class="box widget-page">
								<h2>Locatie en info</h2>
								<p><?php echo standa_autolink($extra_page); ?></p>
							</div>
							<?php
						}
					?>
					<?php dynamic_sidebar('Event categorie rechterkant'); ?>
                	<div class="box widget-archive-link">
                    	<a class="btn" href="<?php echo get_post_type_archive_link( 'event' ); ?>">Complete archief</a>
                	</div>
				</aside>
			</div>
		</div>
	</div>

<?php get_footer(); ?>