<?php

function renderEventArchive() {
	$eventLinks = get_event_archive_links();
	?>
		<ul>
        	<?php 
        		foreach ($eventLinks as $key => $value) {
        			$monthYear = str_replace('-',' ',$key);
        			?>
        			<li><a href="<?php echo get_post_type_archive_link( 'event' ); ?>?t=<?php echo $value[0]; ?>"><?php echo $monthYear; ?> (<?php echo count($value); ?>)</a></li>
        			<?php
        		}
        	?>
       	</ul>
    <?php
}

function renderTaxonomySelect($tax, $key, $name, $value, $label) {
     ?>
<p>
    <label for="<?php echo $key; ?>"><?php echo $label; ?></label>
    <select id="<?php echo $key; ?>" name="<?php echo $name; ?>" class="widefat" style="width:100%;">
        <?php
        renderTaxonomySelectOptions($tax, $value);
        ?>
    </select>
</p>
<?php   
}

function renderTaxonomySelectOptions($tax, $value) {
    $terms = get_terms( $tax, array(
        'orderby'    => 'name',
        'hide_empty' => 0
    ));
    foreach ( $terms as $term ) {
        $selected = '';
        if ($value == $term->term_id) {
            $selected = 'selected="selected"';
        }
        echo '<option value="'.$term->term_id.'" '.$selected.'>'.$term->name.'</option>';
    }
}


function renderPostSelect($post_types, $key, $name, $value, $label, $tax='', $tax_slug='') {
?>	
    <p>
        <label for="<?php echo $key; ?>"><?php echo $label; ?></label>
        <select id="<?php echo $key; ?>" name="<?php echo $name; ?>" class="widefat" style="width:100%;">
            <?php
            renderPostSelectOptions($post_types, $value, $tax, $tax_slug);
            ?>          
        </select>
    </p>
<?php	
}

function renderPostSelectOptions($post_types, $select_value, $tax='', $tax_slug='') {
	
	foreach($post_types as $post_type) {
		// get posts
		$posts = false;
		
		if(is_post_type_hierarchical($post_type))
		{				
			// get pages
			$posts = get_pages(array(
				'numberposts' => -1,
				'post_type' => $post_type,
				'sort_column' => 'menu_order',
				'order' => 'ASC',
				'post_status' => array('publish'),
				//'meta_key' => $field['meta_key'],
				//'meta_value' => $field['meta_value'],
			));
		}
		else
		{
			if ($tax) {
				// get posts
				$posts = get_posts(array(
					'numberposts' => -1,
					'post_type' => $post_type,
					'orderby' => 'date',
					$tax			=> $tax_slug,
					'order' => 'DESC',
					'post_status' => array('publish'),
					//'meta_key' => $field['meta_key'],
					//'meta_value' => $field['meta_value'],
				));
			} else {
				// get posts
				$posts = get_posts(array(
					'numberposts' => -1,
					'post_type' => $post_type,
					'orderby' => 'date',
					'order' => 'DESC',
					'post_status' => array('publish'),
					//'meta_key' => $field['meta_key'],
					//'meta_value' => $field['meta_value'],
				));
			}
		}
		
		// if posts, make a group for them
		if($posts)
		{
			$post_type_object = get_post_type_object($post_type);
			$post_type_name = $post_type_object->labels->name;
	
			echo '<optgroup label="'.$post_type_name.'">';
			
			foreach($posts as $post)
			{
				$key = $post->ID;
				
				$value = '';
				$ancestors = get_ancestors($post->ID, $post_type);
				if($ancestors)
				{
					foreach($ancestors as $a)
					{
						$value .= '- ';
					}
				}
				$value .= get_the_title($post->ID);
				
				// status
				if($post->post_status == "private" || $post->post_status == "draft")
				{
					$value .= " ($post->post_status)";
				}
				
				
				$selected = '';
				
				
				if(is_array($select_value))
				{
					// 2. If the value is an array (multiple select), loop through values and check if it is selected
					if(in_array($key, $select_value))
					{
						$selected = 'selected="selected"';
					}
				}
				else
				{
					// 3. this is not a multiple select, just check normaly
					if($key == $select_value)
					{
						$selected = 'selected="selected"';
					}
				}	
				
				
				echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
				
				
			}	
			
			echo '</optgroup>';
			
		}// endif
	
	}//end foreach post_type
	
	
}

?>