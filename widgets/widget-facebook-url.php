<?php 
if( ! class_exists('WidgetFaceBookUrl') ) {
class WidgetFaceBookUrl extends WP_Widget {
	
    /* Constructor */
    function WidgetFaceBookUrl() {
        $widget_ops = array('classname' => 'widget-facebook', 'description' => 'Facebook blok' );
		$this->WP_Widget('widget-facebook-url', 'Facebook like huidige url blok', $widget_ops);
    }

    /* Display widget */
    function widget($args, $instance) {		
        extract ($args);
		$title = apply_filters('title', $instance['title']);
		$currentUrl = get_current_page_url();

		// Befor widget
		echo $before_widget . "\r";
		if ($currentUrl) {
			echo '<h2>' . $title . '<span class="ico facebook"></span></h2>';
            echo '<div class="inner">';
			echo '<div class="fb-like" data-href="' . $currentUrl . '" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>';
            echo '</div>';
		}
		
		// After widget
		echo $after_widget . "\r";
	}

    /* Update widget */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /* Form */
    function form($instance) {		
		$title = esc_attr($instance['title']);
		$urltolike = esc_attr($instance['urltolike']);
        ?>
	        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo "Title"; ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

}
register_widget('WidgetFaceBookUrl');
}
?>