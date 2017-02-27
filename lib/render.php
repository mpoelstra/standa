<?php
function renderMenu($footer = false) {
    $pages = get_field('standa_items', 'option');

    ?>
    <li class="menu_item">
        <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">Home</a>
    </li>
    

    <?php if ( (count($pages) > 0) && (!$footer) ) { ?>
        <?php foreach ($pages as $key => $page) {
            if ($page['standa_item_title'] && $page['standa_item_inmenu']) { ?>
                <li class="menu_item">
                    <a href="<?php echo home_url( '/' ); ?>#<?php echo strtolower(standa_clean($page['standa_item_title'])); ?>"><?php echo $page['standa_item_title']; ?></a>
                </li>
            <?php } ?>
        <?php } ?>
    <?php } ?>

    <?php
    if ($footer) {
        $menuItems = wp_get_nav_menu_items( 'footer-menu');
    } else {
        $menuItems = wp_get_nav_menu_items( 'header-menu');
    }
    ?>

    <?php if (count($menuItems) > 0) { ?>
        <?php foreach ($menuItems as $key => $menuItem) { ?>
            <li class="menu_item">
                <a href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->title; ?></a>
            </li>
        <?php } ?>
    <?php }
}
?>