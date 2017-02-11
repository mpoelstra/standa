<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<?php get_template_part( 'template-parts/part-main', 'head' ); ?>
</head>

<body <?php body_class(); ?>>

<header class="main">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <a class="logo" href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><span><?php bloginfo( 'description' ); ?></span></a>
        <button class="menu-btn" data-href="#menu">Menu</button>
        <?php if (!is_front_page()) { ?>
          <?php get_template_part( 'template-parts/part-home', 'menu' ); ?>
        <?php } ?>
      </div>
    </div>
  </div>
</header>

<main class="main">