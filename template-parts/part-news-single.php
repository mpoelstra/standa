<div class="post">
    <div class="post_date">
        <div class="date">
            <span class="date_day"><?php the_time('j') ?></span>
            <span class="date_month-year"><?php the_time('M Y') ?></span>
        </div>
    </div>
    <div class="post_article">
        <article>
            <header>
                <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
            </header>
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="image">
                        <?php
                        $imageSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                        echo '<img src="' . $imageSrc[0] . '" alt="' . get_the_title() . '">';
                        ?>
                </div>
            <?php } ?>
            <div class="proza">
                <?php the_content(); ?>
            </div>
        </article>
    </div>
</div>