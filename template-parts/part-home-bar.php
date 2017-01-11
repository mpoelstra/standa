<div class="bar">
    <?php
        $standa_bar = get_field('standa_bar', 'option');
        $standa_bar_speed = get_field('standa_bar_speed', 'option');
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
        <ul class="slides" data-speed="<?php echo $standa_bar_speed; ?>">
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