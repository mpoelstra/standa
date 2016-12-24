<div class="post">
    <div class="post_date">
        <?php renderEventDate(); ?>
        <?php if ( has_post_thumbnail() && !is_post_type_archive() ) { ?>
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
            <footer>
                <a class="btn" href="<?php the_permalink() ?>">Lees meer &raquo;</a>
            </footer>
        </article>
    </div>
</div>