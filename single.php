<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						?>
						<div class="post">
							<div class="post_article post_article--full">
								<article>
									<header>
										<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
									</header>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="image">
												<?php
												$imageSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
												echo '<img src="' . $imageSrc[0] . '" alt="' . get_the_title() . '">';
												?>
										</div>
									<?php } ?>
									<div class="proza">
										<?php the_content(); ?>
									</div>
								</article>
							</div>
						</div>
						<?php
					endwhile;
				?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>