<nav id="menu" class="product_menu">
    <?php $pages = get_field('standa_items', 'option'); ?>
        <ul class="menu">
            <li class="menu_item">
                <a href="#waarom">Waarom</a>
            </li>
            <?php if (count($pages) > 0) { ?>
                <?php foreach ($pages as $key => $page) {
                    if ($page['standa_item_title']) { ?>
                        <li class="menu_item">
                            <a href="<?php echo home_url( '/' ); ?>#<?php echo strtolower(str_replace(' ', '', $page['standa_item_title'])); ?>"><?php echo $page['standa_item_title']; ?></a>
                        </li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
            
            <?php
            $menuItems = wp_get_nav_menu_items( 'header-menu');
            ?>
            <?php if (count($menuItems) > 0) { ?>
                <?php foreach ($menuItems as $key => $menuItem) { ?>
                    <li class="menu_item">
                        <a href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->title; ?></a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
</nav>