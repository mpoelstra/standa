<?php
	$slides = get_field('standa_images', 'option');
	$slider_speed = get_field('standa_slider-speed', 'option');

	if (count($slides) > 0) {
		?>
			<div class="slider product_slider">
				<ul class="slides" data-speed="<?php echo $slider_speed; ?>" data-dots="true">
					<?php
					foreach ($slides as $key => $slide) {
						$slide_image = $slide['standa_image']['sizes']['large'];
						?>
						<li class="slide" data-color="<?php echo $slide['standa_color']; ?>">
							<div class="slide_image" style="background-image:url('<?php echo $slide_image; ?>');"></div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		<?php
	}
?>