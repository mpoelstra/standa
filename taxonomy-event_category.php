<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8">
            <?php renderEventsPaginated(5, 0, true); ?>
        </div>
        <div class="col-xs-12 col-sm-4">
            <aside>
                <?php dynamic_sidebar('Event categorie rechterkant'); ?>
                <div class="box widget-archive-link">
                    <a class="btn" href="<?php echo get_post_type_archive_link( 'event' ); ?>">Complete archief</a>
                </div>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>