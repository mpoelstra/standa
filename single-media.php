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
					<?php renderMedia($widget=true, $col=4, $limit=0); ?>
				</aside>
			</div>
		</div>
	</div>

<?php get_footer(); ?>