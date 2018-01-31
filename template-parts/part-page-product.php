<?php
    $standa_title = get_field('standa_title');
    $standa_subtitle = get_field('standa_subtitle');
    $standa_text = get_field('standa_text');
    $standa_teaser = get_field('standa_teaser');
    $standa_btnText = get_field('standa_btn-text');
    $standa_btnLink = get_field('standa_btn-link');
    $standa_altText = get_field('standa_alt-text');
    $standa_altLink = get_field('standa_alt-link');
?>
<article class="product_wrapper">
    <header class="product_title">
        <h1><?php echo $standa_title; ?></h1>
        <h2><?php echo $standa_subtitle; ?></h2>
    </header>
    <div class="product_info product_info--richttext">
        <?php echo $standa_text; ?>
    </div>
    <div class="product_teaser">
        <?php echo $standa_teaser; ?>
    </div>
    <div>
        <a href="<?php echo $standa_btnLink; ?>" class="product_btn" aria-label="<?php $standa_btnText; ?>"><?php echo $standa_btnText; ?></a>
        <?php if ($standa_altText && $standa_altLink) { ?>
            <p class="product_alt"><a href="<?php echo $standa_altLink; ?>"><?php echo $standa_altText; ?></a></p>
        <?php } ?>
    </div>
</article>