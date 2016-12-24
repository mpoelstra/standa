<?php get_header(); ?>

<div class="container">
    <div class="row">
     	<div class="col-xs-12 col-sm-8">
            <?php 
            $timestamp = 0;
			if (isset($_GET['t'])) {
				$timestamp = $_GET['t'];
			}
            renderEventsPaginated(5, $timestamp, false);

            ?>
            <?php wp_reset_query(); ?>
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
