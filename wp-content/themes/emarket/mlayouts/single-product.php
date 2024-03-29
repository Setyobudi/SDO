<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	$emarket_sidebar_product = emarket_options() -> getCpanelValue('sidebar_product');
?>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
	<div class="body-wrapper theme-clearfix">
		<div class="body-wrapper-inner">
			<header id="header" class="header-page">
				<div class="header-shop clearfix">
					<div class="container">
						<div class="back-history"></div>
						<h4><?php the_title() ?></h4>
						<?php if ( has_nav_menu('vertical_menu') ) {?>
								<div class="vertical_megamenu vertical_megamenu_shop pull-right">
									<?php wp_nav_menu(array('theme_location' => 'vertical_menu', 'menu_class' => 'nav vertical-megamenu')); ?>
								</div>
						<?php } ?>
					</div>
				</div>
			</header>
			<div class="container">
				<div class="content-product-detail" role="main">
					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action('woocommerce_before_main_content');
					?>
					<div class="single-product clearfix">
					
						<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/**
								 * woocommerce_before_single_product hook
								 *
								 * @hooked woocommerce_show_messages - 10
								 */
								 do_action( 'woocommerce_before_single_product' );
								global $product;
							?>
							<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="product_detail">
									<div class="slider_img_productd">
										<!-- woocommerce_show_product_images -->
										<?php
											/**
											 * woocommerce_show_product_images hook
											 *
											 * @hooked woocommerce_show_product_sale_flash - 10
											 * @hooked woocommerce_show_product_images - 20
											 */
											do_action( 'woocommerce_before_single_product_summary' );
										?>
									</div>							
									<div class="content_product_detail">
										<!-- woocommerce_template_single_title - 5 -->
										<!-- woocommerce_template_single_rating - 10 -->
										<!-- woocommerce_template_single_price - 20 -->
										<!-- woocommerce_template_single_excerpt - 30 -->
										<!-- woocommerce_template_single_add_to_cart 40 -->
										<?php
											/**
											 * woocommerce_single_product_summary hook
											 *
											 * @hooked woocommerce_template_single_title - 5
											 * @hooked woocommerce_template_single_price - 10
											 * @hooked woocommerce_template_single_excerpt - 20
											 * @hooked woocommerce_template_single_add_to_cart - 30
											 * @hooked woocommerce_template_single_meta - 40
											 * @hooked woocommerce_template_single_sharing - 50
											 */
											do_action( 'woocommerce_single_product_summary' );
										?>				
									</div>
								</div>
							</div>		
							<div class="tabs clearfix">
								<?php
									/**
									 * woocommerce_after_single_product_summary hook
									 *
									 * @hooked woocommerce_output_product_data_tabs - 10
									 * @hooked woocommerce_output_related_products - 20
									 */
									do_action( 'woocommerce_after_single_product_summary' );
								?>
							</div>

							<?php if (is_active_sidebar('bottom-detail-product-mobile')) { ?>
								<div class="bottom-single-product theme-clearfix">
									<?php dynamic_sidebar('bottom-detail-product-mobile'); ?>
								</div>
							<?php } ?>
								
							<?php do_action( 'woocommerce_after_single_product' ); ?>

						<?php endwhile; // end of the loop. ?>
					
					</div>
					
					<?php
						/**
						 * woocommerce_after_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
						 */
						do_action('woocommerce_after_main_content');
					?>
				</div>
			</div>

<?php get_template_part('footer'); ?>
