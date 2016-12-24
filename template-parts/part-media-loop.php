<div class="post">
    <div class="post_date">
        <div class="date">
            <span class="date_day"><?php the_time('j') ?></span>
            <span class="date_month-year"><?php the_time('M Y') ?></span>
        </div>
        <?php if ( has_post_thumbnail() && is_category() ) { ?>
            <div class="image">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php
                    $imageSrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
                    echo '<img src="' . $imageSrc[0] . '" alt="' . get_the_title() . '">';
                    ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <div class="post_article">
        <article>
            <header>
                <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
            </header>
            <div class="proza">
                <?php the_excerpt(); ?>
            </div>
            <?php
                renderMedia($widget=false, $col=5, $limit=10);
            ?>
            <footer>
                <a class="btn" href="<?php the_permalink() ?>">Alle media &raquo;</a>
            </footer>
        </article>
    </div>
</div>