<div class="col-xs-12 col-sm-4">
	<?php
		$quicklinks = get_field('vkso-main', 'option');
		foreach ($quicklinks as $key => $quicklink) {
			$link_text = $quicklink['vkso-main-linktext'] ? $quicklink['vkso-main-linktext'] : 'Lees verder';
			?>
			<a href="<?php echo get_permalink($quicklink['vkso-main-link']->ID); ?>" class="quicklink main">
				<span class="quicklink_title">
					<span><?php echo $quicklink['vkso-main-title']; ?></span>
				</span>
				<span class="quicklink_proza">
					<?php echo $quicklink['vkso-main-text']; ?>
				</span>
				<span class="btn">
					<?php echo $link_text; ?> &raquo;
				</span>
			</a>
			<?php
		}
	?>
</div>