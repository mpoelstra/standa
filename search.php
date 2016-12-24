<?php get_header();
$allsearch = &new WP_Query("s=$s&showposts=-1");
$count = $allsearch->post_count;
?>

<div class="overview">
      <?php if ( have_posts() ) : ?>
            <article>
                <header>
                  <h1><?php echo number_format_i18n($count); ?> zoekresultaten voor: <?php echo get_search_query(); ?></h1>
                </header>
            </article>   
            	<?php get_template_part( 'template-parts/part-search', 'loop' ); ?>
      <?php else : ?>
            <article>
                <header>
                    <h1>Geen resultaten voor: <?php echo get_search_query(); ?></h1>
                </header>
                <p>Geen resultaten gevonden, probeer het nogmaals met andere zoekwoorden.</p>
            </article>
      <?php endif; ?>
</div>
<?php get_footer();?>
