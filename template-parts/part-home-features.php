<div class="row features">
	<div class="col-xs-12">
		<h1 id="waarom" class="features_title">Waarom de STANDA</h1>
	</div>
	<?php
		$quicklinks = get_field('standa_features', 'option');
		foreach ($quicklinks as $key => $quicklink) {
			$linkTitle = $quicklink['standa_feature_title'];
			$linkText = $quicklink['standa_feature_text'];
			$linkImage = $quicklink['standa_feature_image']['sizes']['medium'];
			?>
			<div class="col-xs-12 col-sm-3">
				<article class="feature">
					<header>
						<div class="feature_image" style="background-image: url('<?php echo $linkImage; ?>')"></div>
						<h1 class="feature_title"><?php echo $linkTitle; ?></h1>
					</header>
					<div class="feature_text">
						<p><?php echo $linkText; ?></p>
					</div>
				</article>
			</div>
			<?php
		}
	?>
</div>