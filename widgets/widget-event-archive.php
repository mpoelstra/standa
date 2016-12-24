<?php 
if( ! class_exists('WidgetEventArchive') ) {
class WidgetEventArchive extends WP_Widget {
	
    /* Constructor */
    function WidgetEventArchive() {
        $widget_ops = array('classname' => 'widget_archive', 'description' => 'Facebook blok' );
		$this->WP_Widget('widget-event-archive', 'Agenda archief', $widget_ops);
    }

    /* Display widget */
    function widget($args, $instance) {		
        extract ($args);
		$title = apply_filters('title', $instance['title']);
		
		// Befor widget
		echo $before_widget . "\r";
		echo '<h2>' . $title . '</h2>';
        renderEventArchive();
		
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
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo "Titel"; ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
        <?php 
    }

}
register_widget('WidgetEventArchive');
}
?>