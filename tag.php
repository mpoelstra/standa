<?php
get_header();
?>

<div class="overview">
    <article>
        <header>
            <h1>Berichten gemarkeerd met: <?php echo get_query_var('tag'); ?></h1>
        </header>
        <br/>
    </article>
    <?php renderPostsPaginated($wp_query); ?>
    
	<?php wp_reset_query();  ?>
</div>

<?php get_footer();?>