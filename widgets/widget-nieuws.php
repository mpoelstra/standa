<?php 
if( ! class_exists('WidgetNieuws') ) {
class WidgetNieuws extends WP_Widget {
	
    /* Constructor */
    function WidgetNieuws() {
        $widget_ops = array('classname' => 'widget-nieuws', 'description' => 'Nieuws blok' );
		//$control_ops = array('width' => 600, 'height' => 350);
		$this->WP_Widget('widget-nieuws', 'Nieuws blok', $widget_ops, $control_ops);
    }

    /* Display widget */
    function widget($args, $instance) {		
        extract ($args);
		$total = absint( $instance['total'] );
		$category_id = absint( $instance['category_id'] );
		$title = apply_filters('title', $instance['title']);
		$objects = array();
		
		$query_params = array(
			'posts_per_page' 		=> $total,
			'post_type'      		=> 'post',
			'cat'					=> $category_id,
			'orderby'        		=> 'date',
			'order'          		=> 'DESC',
			'post_status'    		=> 'publish'
		); 	
		query_posts($query_params);
		$counter = 0;
		if ( have_posts() ) :
             while ( have_posts() ) : the_post();
	             	global $post;
					$objects[$counter]['postId'] = $post->ID;
					$objects[$counter]['excerpt'] = get_the_excerpt();
					$objects[$counter]['title'] = get_the_title($post->ID);
					$objects[$counter]['date'] = get_the_date('d-m-y');
					$objects[$counter]['permalink'] = get_permalink($post->ID);
			   $counter++;
             endwhile;
        endif; 
		
		// Befor widget
		echo $before_widget;
		
		renderNieuws($objects, $title);
		//echo '</li>';
		
		// After widget
		echo $after_widget;
	}

    /* Update widget */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['total'] = (int) $new_instance['total'];
	$instance['category_id']    = strip_tags( $new_instance['category_id'] );
        return $instance;
    }

    /* Form */
    function form($instance) {		
		$title = esc_attr($instance['title']);
		$total = isset($instance['total']) ? absint($instance['total']) : 3;
		$category_id   = esc_attr($instance['category_id']);
		$category_dropdown_args = array( 
			'name'     => $this->get_field_name('category_id'),  
			'id'       => $this->get_field_id('category_id'),
			'echo'     => false,
			'selected' => $category_id
		);

        ?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php echo "Title"; ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>        
			<p><label for="<?php echo $this->get_field_id('category_id'); ?>"><?php echo "Categorie"; ?> <?php echo wp_dropdown_categories($category_dropdown_args); ?></label></p>
			<p><label for="<?php echo $this->get_field_id('total'); ?>"><?php echo "Aantal"; ?> <input class="widefat" id="<?php echo $this->get_field_id('total'); ?>" name="<?php echo $this->get_field_name('total'); ?>" type="text" value="<?php echo $total; ?>" /></label></p>                    
		<?php
    }

}
register_widget('WidgetNieuws');
}
?>