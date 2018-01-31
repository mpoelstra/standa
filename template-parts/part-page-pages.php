<div class="row">
    <div class="col-xs-12">
        <?php $pages = get_field('standa_items');
        if (count($pages) > 0) { ?>
            <ul class="pages">
                <?php foreach ($pages as $key => $page) {
                    if ($page['standa_item_title']) { ?>
                        <li class="pages_item">
                            <div class="page">
                                <div id="<?php echo strtolower(standa_clean($page['standa_item_title'])); ?>" class="page_title"><?php echo $page['standa_item_title']; ?></div>
                                
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