<?php get_header(); ?>

<div class="container">
    <div class="row">
     	<div class="col-xs-12 col-sm-8">
			<?php if ( have_posts() ) : ?>
				<div class="posts">
					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/part-news', 'loop' );

						endwhile;
					?>
				</div>
				<!-- paginate -->
				<?php if( function_exists( 'wp_pagenavi' ) ) : /* Needs activated wp_pagenavi plugin */ ?>
					<?php wp_pagenavi(); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="col-xs-12 col-sm-4">
			<aside>
				<?php dynamic_sidebar('Nieuws categorie rechterkant'); ?>
			</aside>
		</div>
	</div>
</div>

<?php get_footer(); ?>