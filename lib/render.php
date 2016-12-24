<?php
function renderMedia($widget=false, $col=5, $limit=10) {
	$media = get_field('vkso-media');
    if ($media) {
    	$extraClass = $col === 5 ? ' col5' : ' col4';

    	if ($widget) {
    		?>
    		<div class="box widget-media">
				<h2>Media</h2>
			<?php
    	}
        ?>

        <div class="media-row<?php echo $extraClass; ?>">
            <?php
            $counter = 0;
            foreach ($media as $key => $object) {
                $counter++;
                if ( ($limit) && ($counter === $limit + 1) ) {
                    break;
                }
                if ($object['vkso-media-type'] === 'Foto') {
                    $image = $object['vkso-media-image']['sizes']['thumbnail'];
                    if ($image) {
                        ?>
                        <div class="media">
                            <a class="media_element mfp-image" href="<?php echo $object['vkso-media-image']['sizes']['large']; ?>" style="background-image:url(<?php echo $image; ?>);">
                            </a>
                        </div>
                        <?php
                    }
                } else {
                    $video = $object['vkso-media-video'];
                    if ($video) {
                        ?>
                        <div class="media">
                            <a class="media_element mfp-iframe" href="https://www.youtube.com/watch?v=T7H843GarAU" style="background-image:url(http://img.youtube.com/vi/<?php echo $video; ?>/default.jpg);"> 
                            </a>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    	<?php
    	if ($widget) {
    		?>
    		</div>
    	<?php 
    	}
	}
}

function renderEventDate() {
    ?>
    <div class="date event">
        <?php
            $event_date = get_field('event_date');
            $dateDay = date_i18n('j', $event_date);
            $dateMonthYear = date_i18n('M Y', $event_date);
            $dateTime = date_i18n('H:i', $event_date);
        ?>
        <span class="date_day"><?php echo $dateDay; ?></span>
        <span class="date_month-year"><?php echo $dateMonthYear; ?></span>
        <span class="date_time"><?php echo $dateTime; ?></span>
    </div>
    <?php
}

function renderEventDateByTimeStamp($timestamp) {
    ?>
    <div class="date event">
        <?php
            $event_date = $timestamp;
            $dateDay = date_i18n('j', $event_date);
            $dateMonthYear = date_i18n('M Y', $event_date);
            $dateTime = date_i18n('H:i', $event_date);
        ?>
        <span class="date_day"><?php echo $dateDay; ?></span>
        <span class="date_month-year"><?php echo $dateMonthYear; ?></span>
        <span class="date_time"><?php echo $dateTime; ?></span>
    </div>
    <?php
}

function get_events($limit=-1, $timestamp=0, $futureEvents=false) {

    if ($futureEvents) {

        $today = date('Ymd', strtotime('-1 day'));
        $today = strtotime($today);

        $query_params = array(
            'posts_per_page'    => $limit,
            'post_type'     => 'event',
            'post_status'   => array('publish'),
            'order'         => 'ASC',
            'paged'         => get_query_var('paged'),
            'orderby'       => 'meta_value_num',
            'meta_key'      => 'event_date',
            'meta_query' => array(
                array(
                    'key'  => 'event_date' ,
                    'value'  => $today,
                    'compare'  => '>'
                ),
            )
        );

    } elseif ($timestamp > 0) {

        $endDate = date("Y-m-d", strtotime("+1 month", $timestamp));

        $query_params = array(
            'posts_per_page'    => $limit,
            'post_type'     => 'event',
            'post_status'   => array('publish'),
            'order'         => 'DESC',
            'paged'         => get_query_var('paged'),
            'orderby'       => 'meta_value_num',
            'meta_key'      => 'event_date',
            'meta_query' => array(
                array(
                    'key'  => 'event_date' ,
                    'value'  => $timestamp,
                    'compare'  => '>'
                ),
                array(
                    'key'  => 'event_date' ,
                    'value'  => strtotime($endDate),
                    'compare'  => '<'
                ),
            )
        );

    } else {
        $query_params = array(
            'posts_per_page'    => $limit,
            'post_type'     => 'event',
            'post_status'   => array('publish'),
            'order'         => 'DESC',
            'paged'         => get_query_var('paged'),
            'orderby'       => 'meta_value_num',
            'meta_key'      => 'event_date'
        );
        
    }
    /*
    echo '<pre>';
    print_r($query_params);
    echo '</pre>';

    $posts = get_posts($query_params);
    echo 'today: ' . $today . '<BR>';

    foreach ($posts as $post) {
        $event_date = get_field('event_date', $post->ID);
        echo 'event_date: ' . $event_date . '<BR>';
        echo '<pre>';
        print_r($post);
        echo '</pre>';
    }

    exit;
    */
    
    query_posts($query_params);
    $my_query = new WP_Query($query_params);
    return $my_query;
    
}

function get_event_archive_links() {
    wp_reset_query();
    $query_params = array(
        'posts_per_page'    => 5,
        'post_type'     => 'event',
        'post_status'   => array('publish'),
        'order'         => 'DESC',
        'paged'         => get_query_var('paged'),
        'orderby'       => 'meta_value_num',
        'meta_key'      => 'event_date'
    );

    $posts = get_posts( $query_params );

    $result = array();

    foreach ($posts as $key => $post) {
        $event_date = get_field('event_date', $post->ID);
        $monthFull = date_i18n('F', $event_date);
        $monthNumeric = date_i18n('m', $event_date);
        $yearFull = date_i18n('Y', $event_date);

        $eventDateString = '01-' . $monthNumeric . '-' . $yearFull;
        $timestamp = strtotime($eventDateString);

        if (!is_array($result[$monthFull . '-' . $yearFull])) {
            $result[$monthFull . '-' . $yearFull] = array();
        }
        array_push($result[$monthFull . '-' . $yearFull],$timestamp);
    }

    return $result;


}

function renderEventsPaginated($limit, $timestamp=0, $futureEvents) {

    $my_query = get_events($limit, $timestamp, $futureEvents);

    if (have_posts()) {
        ?><div class="posts"><?php
        while ($my_query->have_posts()) : $my_query->the_post();
            
            get_template_part( 'template-parts/part-event', 'loop' );
            
        endwhile;
        ?></div><?php
    }

    if (have_posts()) {
        if( function_exists( 'wp_pagenavi' ) ) : wp_pagenavi( array( 'query' => $my_query ) ); endif;
        wp_reset_postdata(); 
    }
}
?>