<?php
/*
 * Template Name: Bestellen
 *
 */
?>

<?php get_header(); ?>
	
	<div class="container container--form">
		<div class="row">
			<div class="col-xs-12">
				<?php get_template_part( 'template-parts/part-single', 'page' ); ?>

                <div class="product-form">
                    <div class="product-form_inner">
                    <?php
                        $form = 3;

                        //hack checks
                        if (isset($_GET['standa-product-name'])) {
                            exit;
                        }

                        if (isset($_GET['standa-product-price'])) {
                            exit;
                        }

                        if (isset($_GET['standa-product-quantity'])) {
                            exit;
                        }

                        $standa_price = get_field('standa_price', 'option');

                        $field_values = array(
                            'standa-product-name' => 'Standa',
                            'standa-product-price' => $standa_price,
                            'standa-product-quantity' => 1
                        );

                        gravity_form_enqueue_scripts($form, true);
                        
                        //gravity_form( $id_or_title, $display_title = true, $display_description = true, $display_inactive = false, $field_values = null, $ajax = false, $tabindex, $echo = true );
                        gravity_form($id = $form, $display_title = false, $display_description = true, $display_inactive = false, $field_values = $field_values, $ajax = true, $tabindex = 1);
                    ?>
                    </div>
                </div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>