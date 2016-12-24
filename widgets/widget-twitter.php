<?php 
if( ! class_exists('WidgetTwitter') ) {
class WidgetTwitter extends WP_Widget {
	
    /* Constructor */
    function WidgetTwitter() {
        $widget_ops = array('classname' => 'widget-twitter', 'description' => 'Twitter blok' );
		//$control_ops = array('width' => 600, 'height' => 350);
		$this->WP_Widget('widget-twitter', 'Twitter blok', $widget_ops, $control_ops);
    }

    /* Display widget */
    function widget($args, $instance) {		
        extract ($args);
        $title = apply_filters('title', $instance['title']);
		$total = absint( $instance['total'] );
		$twitter_account = apply_filters('twitter_account', $instance['twitter_account']);
		$twitter_query = apply_filters('twitter_query', $instance['twitter_query']);
		$search = new TwitterSearch($twitter_query);
		$results = $search->rpp($total)->results();
		$total = count($results);
		// Befor widget
		echo $before_widget;
		//echo '</li>';
        echo '<h2>' . $title . '<span class="ico twitter"></span></h2>';
        echo '<div class="inner">';
		
		if ($results) {
			$counter = 0;
			foreach($results as $result){
				$extraClass = '';
				if ($counter == ($total-1)) {
					$extraClass = ' last';
				}
				$text_n=toLink($result->text, true);
				//$date = strtotime(date("Y-m-d", strtotime($result->created_at)) . " +1 day");
				$pubDate = date_i18n('d-m-Y H:m:s', strtotime($result->created_at)); 
				$timeago = timeAgo($pubDate);
				echo '<div class="tweet' . $extraClass . '">';
				echo '<p><a target="_blank" href="http://www.twitter.com/' . $result->from_user . '">' . $result->from_user . '</a>';
				echo $text_n . '</p>';
				echo '<p class="time"><time>' . $timeago  . '</time></p>';
				echo '</div>';
				$counter = $counter + 1;
			}
		}
		echo '<a href="http://twitter.com/veendam1894' . '" class="btn" target="_blank">Volg ons op Twitter</a>';
		
		echo '</div>';
		// After widget
		echo $after_widget;
	}

    /* Update widget */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
	$instance['twitter_account'] = strip_tags($new_instance['twitter_account']);
	$instance['twitter_query'] = strip_tags($new_instance['twitter_query']);
	$instance['total'] = (int) $new_instance['total'];
        return $instance;
    }

    /* Form */
    function form($instance) {
        $title = esc_attr($instance['title']);
		$twitter_account = esc_attr($instance['twitter_account']);	
		$twitter_query = esc_attr($instance['twitter_query']);
		$total = isset($instance['total']) ? absint($instance['total']) : 3;
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo "Titel"; ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('twitter_account'); ?>"><?php echo "Twitter account"; ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_account'); ?>" name="<?php echo $this->get_field_name('twitter_account'); ?>" type="text" value="<?php echo $twitter_account; ?>" /></label></p>                
			<p><label for="<?php echo $this->get_field_id('twitter_query'); ?>"><?php echo "Zoekstring"; ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_query'); ?>" name="<?php echo $this->get_field_name('twitter_query'); ?>" type="text" value="<?php echo $twitter_query; ?>" /></label></p>        
			<p><label for="<?php echo $this->get_field_id('total'); ?>"><?php echo "Aantal Tweets"; ?> <input class="widefat" id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo $total; ?>" /></label></p>                    
		<?php
    }

}
register_widget('WidgetTwitter');
}
?>