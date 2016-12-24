<?php 
if( ! class_exists('WidgetFaceBook') ) {
class WidgetFaceBook extends WP_Widget {
	
    /* Constructor */
    function WidgetFaceBook() {
        $widget_ops = array('classname' => 'widget-facebook', 'description' => 'Facebook blok' );
		$this->WP_Widget('widget-facebook', 'Facebook like page blok', $widget_ops);
    }

    /* Display widget */
    function widget($args, $instance) {		
        extract ($args);
		$title = apply_filters('title', $instance['title']);
		$urltolike = apply_filters('urltolike', $instance['urltolike']);
		
		// Befor widget
		echo $before_widget . "\r";
		if ($urltolike) {
			echo '<h2>' . $title . '<span class="ico facebook"></span></h2>';
            echo '<div class="inner">';
            echo '<a class="fb-link" target="_blank" href="' . $urltolike . '"></a>';
			echo '<div class="fb-like" data-href="' . $urltolike . '" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>';
            echo '</div>';
		}
		
		// After widget
		echo $after_widget . "\r";
	}

    /* Update widget */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['urltolike'] = strip_tags($new_instance['urltolike']);
        return $instance;
    }

    /* Form */
    function form($instance) {		
		$title = esc_attr($instance['title']);
		$urltolike = esc_attr($instance['urltolike']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo "Titel"; ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('urltolike'); ?>"><?php echo "Url to like"; ?> <input class="widefat" id="<?php echo $this->get_field_id('urltolike'); ?>" name="<?php echo $this->get_field_name('urltolike'); ?>" type="text" value="<?php echo $urltolike; ?>" /></label></p>
        <?php 
    }

}
register_widget('WidgetFaceBook');
}
?>