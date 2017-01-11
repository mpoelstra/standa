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