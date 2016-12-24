<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/part-news', 'single' );
					endwhile;
				?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<aside>
					<?php dynamic_sidebar('Nieuws detail rechterkant'); ?>

					<?php
						$category_link = get_category_link( 1 );
					?>
					<div class="box widget-archive-link">
						<a class="btn" href="<?php echo $category_link; ?>">Complete archief</a>
					</div>
				</aside>
			</div>
		</div>
	</div>

<?php get_footer(); ?>