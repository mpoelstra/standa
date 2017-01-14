<?php
    $standa_title = get_field('standa_title', 'option');
    $standa_subtitle = get_field('standa_subtitle', 'option');
    $standa_text = get_field('standa_text', 'option');
    $standa_price = get_field('standa_price', 'option');
?>
<article class="product_wrapper">
    <header class="product_title">
        <h1><?php echo $standa_title; ?></h1>
        <h2><?php echo $standa_subtitle; ?></h2>
    </header>
    <div class="product_info">
        <p><?php echo $standa_text; ?></p>
    </div>
    <div class="product_price">
        <?php echo '&euro; ' . number_format($standa_price, 2, ',', '.') . ' '; ?>
    </div>
    <div>
        <button class="product_btn" aria-label="Bestellen">Bestellen</button>
    </div>
</article>