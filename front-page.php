<?php 
    get_header();

    if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	    	<div class="container">
	    		<div class="row">
					<div class="col-xs-12">
						<div class="product">
							<nav id="menu" class="product_menu">
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
							</nav>
							<div class="row">
								<div class="col-xs-12 col-sm-6">
									<?php get_template_part( 'template-parts/part-home', 'slider' ); ?>
								</div>
								<div class="col-xs-12 col-sm-6">
									<?php get_template_part( 'template-parts/part-home', 'product' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
	    	</div>

			<div class="container container--small">
				<?php get_template_part('template-parts/part-home', 'features'); ?>
			</div>

			<div class="container container--smaller">
				<div class="row">
					<div class="col-xs-12">
						<?php $pages = get_field('standa_items', 'option');
						if (count($pages) > 0) { ?>
							<ul class="pages">
								<?php foreach ($pages as $key => $page) {
									if ($page['standa_item_title']) { ?>
										<li class="pages_item">
											<div class="page">
												<div id="page<?php echo $key; ?>" class="page_title"><?php echo $page['standa_item_title']; ?></div>
												<div class="page_content">
													<?php 
														$image = $page['standa_item_image']['sizes']['large'];
														$imagePos = $page['standa_item_pos'];
														if ($image) {
															?>
															<img class="page_image <?php echo strtolower($imagePos); ?>" src="<?php echo $image; ?>" alt="<?php echo $page['standa_item_title']; ?>">
															<?php
														}
													?>
													<?php echo $page['standa_item_text']; ?>
												</div>
											</div>
										</li>
									<?php } ?>
								<?php } ?>
							</ul>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="bar">
				<?php
					$standa_bar = get_field('standa_bar', 'option');
					$barPages = array();
							
					foreach ($standa_bar as $key => $slides) {
						$countSlideImages = count($slides['standa_bar_slide']);
						$totalWidthSlide = 0;
						$images = array();
						foreach ($slides['standa_bar_slide'] as $index => $image) {
							$images[$index]['url'] = $image['standa_bar_image']['sizes']['large'];
							$images[$index]['width'] = $image['standa_bar_image']['sizes']['large-width'];
							$images[$index]['height'] = $image['standa_bar_image']['sizes']['large-height'];

							$totalWidthSlide = $totalWidthSlide + $image['standa_bar_image']['sizes']['large-width'];
						}
						$barPages[$key]['width'] = $totalWidthSlide;
						$barPages[$key]['images'] = $images;
					}
				?>
				<div class="slider bar-slider">
					<ul class="slides" data-speed="4">
						<?php 
							foreach ($barPages as $key => $barPage) {
								?>
									<li class="slide">
										<?php
										$counter = 0;
										$totalWidth = 0;
										$totalImages = count($barPage['images']);
										foreach ($barPage['images'] as $key => $image) {
											$counter++; 
											if ($counter == $totalImages) {
												$width = 1 - $totalWidth;
											} else {
												$width = round($image['width'] / $barPage['width'], 2);
												$totalWidth = $totalWidth + $width;
											}		
										?>
										<div class="bar-slider_image" style="float:left; width: <?php echo $width * 100; ?>%; background-image:url('<?php echo $image['url']; ?>');">
										</div>											
										<?php } ?>
									</li>

								<?php
							}
						?>
					</ul>
				</div>
			</div>
		<!--
	    <div class="quicklinks">
	    	<div class="container">
	    		<?php //get_template_part( 'template-parts/part-home', 'quicklinks' ); ?>
	    	</div>
	    </div>
		-->
    <?php

	endwhile;

    get_footer();
?>
