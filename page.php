<?php get_header(); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php

					if ( have_posts() ) while ( have_posts() ) : the_post();
						$subTitle = get_field('page_sub-title');
						$intro = get_field('page_intro');
						$images = get_field('page_images');
						$imagesPos = strtolower(get_field('page_images-pos'));

						$class = '';
						if ($images) {
							$class = ' post--images' . ' ' . $imagesPos;
						}
						?>
						<div class="post<?php echo $class; ?>">
							<article>
								<header>
									<h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
									<?php if ($subTitle) { ?>
										<h2><?php echo $subTitle; ?></h2>
									<?php } ?>
									<?php if ($intro) { ?>
										<p class="post_intro">
											<?php echo $intro; ?>
										</p>
									<?php } ?>
									<div class="breadcrumb">
										<?php if(function_exists('bcn_display'))
										{
											bcn_display();
										}?>
									</div>
								</header>
								<div class="post_proza">
									<div class="proza_content">
										<?php the_content(); ?>
									</div>
									<?php if ($images) { ?>
										<aside>
											<?php
											foreach ($images as $key => $image) {
												$imgSrc = $image['page_image']['sizes']['large'];
												$alt = $image['page_image_alt'];
												?>
												<img src="<?php echo $imgSrc; ?>" alt="<?php echo $alt; ?>">
												<?php 
											}
											?>
										</aside>
									<?php } ?>
																	
								</div>
							</article>
							
						</div>
					<?php endwhile;
				?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>