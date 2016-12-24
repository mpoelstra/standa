<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						get_template_part( 'template-parts/part-content', 'single' );
					endwhile;
				?>
			</div>
			<div class="col-xs-12 col-sm-4">
				<aside>
					<?php
						$extra_page = get_field('vkso-page-extra');
						if ($extra_page) {
							$extra_page_title = get_field('vkso-page-title');
							?>
							<div class="box widget-page">
								<?php if ($extra_page_title) { ?><h2><?php echo $extra_page_title; ?></h2> <?php } ?>
								<?php echo $extra_page; ?>
							</div>
							<?php
						}
					?>
				</aside>
			</div>
		</div>
	</div>

<?php get_footer(); ?>