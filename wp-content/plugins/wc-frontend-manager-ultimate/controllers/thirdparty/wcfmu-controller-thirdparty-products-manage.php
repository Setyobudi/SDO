<?php
/**
 * WCFMu plugin controllers
 *
 * Third Party Plugin Products Manage Controller
 *
 * @author 		WC Lovers
 * @package 	wcfmu/controllers
 * @version   2.2.3
 */

class WCFMu_ThirdParty_Products_Manage_Controller {
	
	public function __construct() {
		global $WCFM, $WCFMu;
		
    // Product Manage Third Party Variaton Date Save
    add_filter( 'wcfm_product_variation_data_factory', array( &$this, 'wcfmu_thirdparty_product_variation_save' ), 100, 5 );
    	
		// WP Job Manager - Resume Manager Support - 2.3.4
    if( $wcfm_allow_resume_manager = apply_filters( 'wcfm_is_allow_resume_manager', true ) ) {
			if ( WCFMu_Dependencies::wcfm_resume_manager_active_check() ) {
				// Resume Manager Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wpjrm_product_meta_save' ), 60, 2 );
			}
		}
		
		// YITH Auction Support - 2.3.8
    if( $wcfm_allow_auction = apply_filters( 'wcfm_is_allow_auction', true ) ) {
			if( WCFMu_Dependencies::wcfm_yith_auction_active_check() ) {
				// YITH Auction Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_yithauction_product_meta_save' ), 70, 2 );
			}
		}
		
		// WooCommerce Simple Auction Support - 2.3.10
    if( $wcfm_allow_auction = apply_filters( 'wcfm_is_allow_auction', true ) ) {
			if( WCFMu_Dependencies::wcfm_wcs_auction_active_check() ) {
				// WooCommerce Simple Auction Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wcsauction_product_meta_save' ), 70, 2 );
			}
		}
		
		// WC Rental & Booking Support - 2.3.10
    if( $wcfm_allow_rental = apply_filters( 'wcfm_is_allow_rental', true ) ) {
			if( WCFMu_Dependencies::wcfm_wc_rental_pro_active_check() ) {
				// WC Rental Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wcrental_pro_product_meta_save' ), 80, 2 );
			}
		}
		
		// Woocommerce Box Office Support - 3.3.3
    if( $wcfm_is_allow_wc_box_office = apply_filters( 'wcfm_is_allow_wc_box_office', true ) ) {
			if( WCFMu_Dependencies::wcfm_wc_box_office_active_check() ) {
				// WC Box Office Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wc_box_office_product_meta_save' ), 80, 2 );
			}
		}
		
		// WooCommerce Lottery Support - 3.5.0
    if( apply_filters( 'wcfm_is_allow_lottery', true ) ) {
			if( WCFMu_Dependencies::wcfm_wc_lottery_active_check() ) {
				// WooCommerce Lottery Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wc_lottery_product_meta_save' ), 70, 2 );
			}
		}
		
		// WooCommerce Deposits Support - 3.5.0
    if( apply_filters( 'wcfm_is_allow_wc_deposits', true ) ) {
			if( WCFMu_Dependencies::wcfm_wc_deposits_active_check() ) {
				// WooCommerce Deposits Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wc_deposits_product_meta_save' ), 90, 2 );
			}
		}
		
		// WooCommerce Advanced Product Labels - 6.0.0
		if( apply_filters( 'wcfm_is_allow_wc_advanced_product_labels', true ) ) {
			if ( WCFMu_Dependencies::wcfm_wc_advanced_product_labels_active_check() ) {
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wc_advanced_product_labels_product_meta_save' ), 120, 2 );
			}
		}
		
		// WooCommerce Whole Sale Support - 2.3.4
    if( apply_filters( 'wcfm_is_allow_wholesale', true ) ) {
			if ( WCFMu_Dependencies::wcfm_wholesale_active_check() ) {
				// Whole Sale Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wholesale_product_meta_save' ), 130, 2 );
				add_filter( 'wcfm_product_variation_data_factory', array( &$this, 'wcfm_product_variation_wholesale_save' ), 130, 5 );
			}
		}
		
		// WC Min/Max Quantities Support - 2.3.4
    if( apply_filters( 'wcfm_is_allow_wc_min_max_quantities', true ) ) {
			if ( WCFMu_Dependencies::wcfm_wc_min_max_quantities_active_check() ) {
				// Whole Sale Product Meta Data Save
				add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfm_wc_min_max_quantities_product_meta_save' ), 130, 2 );
				add_filter( 'wcfm_product_variation_data_factory', array( &$this, 'wcfm_product_variation_wc_min_max_quantities_save' ), 130, 5 );
			}
		}
		
		// Third Party Product Meta Data Save
    add_action( 'after_wcfm_products_manage_meta_save', array( &$this, 'wcfmu_thirdparty_products_manage_meta_save' ), 120, 2 );
	}
	
	/**
	 * Product Manage Third Party Variation Data Save
	 */
	function wcfmu_thirdparty_product_variation_save( $wcfm_variation_data, $new_product_id, $variation_id, $variations, $wcfm_products_manage_form_data ) {
	 	global $wpdb, $WCFM, $WCFMu;
	 	  
	 	// WooCommerce Barcode & ISBN Support
		if( $allow_barcode_isbn = apply_filters( 'wcfm_is_allow_barcode_isbn', true ) ) {
			if(WCFM_Dependencies::wcfm_wc_barcode_isbn_plugin_active_check()) {
				update_post_meta( $variation_id, 'barcode', $variations[ 'barcode' ] );
				update_post_meta( $variation_id, 'ISBN', $variations[ 'ISBN' ] );
			}
		}
		
		// WooCommerce MSRP Pricing Support
		if( $allow_msrp_pricing = apply_filters( 'wcfm_is_allow_msrp_pricing', true ) ) {
			if(WCFM_Dependencies::wcfm_wc_msrp_pricing_plugin_active_check()) {
				update_post_meta( $variation_id, '_msrp', $variations[ '_msrp' ] );
			}
		}
		
		// WooCommerce Product Fees Support
		if( $allow_product_fees = apply_filters( 'wcfm_is_allow_product_fees', true ) ) {
			if(WCFM_Dependencies::wcfm_wc_product_fees_plugin_active_check()) {
				update_post_meta( $variation_id, 'product-fee-name', $variations['product-fee-name'] );
				update_post_meta( $variation_id, 'product-fee-amount', $variations['product-fee-amount'] );
				$product_fee_multiplier = ( $variations['product-fee-multiplier'] ) ? 'yes' : 'no';
				update_post_meta( $variation_id, 'product-fee-multiplier', $product_fee_multiplier );
			}
		}
		
		// WooCOmmerce Role Based Price Suport
		if( apply_filters( 'wcfm_is_allow_role_based_price', true ) ) {
			if(WCFM_Dependencies::wcfm_wc_role_based_price_active_check()) {
				$role_based_price = array();
				foreach( $variations as $variations_key => $variations_value ) {
					$pos = strpos( $variations_key, '-rolebased' );
					if ($pos !== false) {
						$rolebased_parts = explode( "-", $variations_key );
						if( count( $rolebased_parts ) == 3 ) {
							$role_based_price[$rolebased_parts[0]][str_replace( 'price', '_price', $rolebased_parts[1])] = $variations_value;
						}
					}
				}
				update_post_meta( $variation_id, '_role_based_price', $role_based_price );
				update_post_meta( $variation_id, '_enable_role_based_price', 1 );
			}
		}
		
	 	return $wcfm_variation_data;
	}
	
	/**
	 * WP Job Manager - Resume Manager Product Meta data save
	 */
	function wcfm_wpjrm_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		if( $wcfm_products_manage_form_data['product_type'] == 'resume_package' ) {
	
			$resume_package_fields = array(
				'_resume_package_subscription_type',
				'_resume_limit',
				'_resume_duration'
			);
	
			foreach ( $resume_package_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					update_post_meta( $new_product_id, $field_name, stripslashes( $wcfm_products_manage_form_data[ $field_name ] ) );
				}
			}
			
			// Featured
			$is_featured = ( isset( $wcfm_products_manage_form_data['_resume_featured'] ) ) ? 'yes' : 'no';
	
			update_post_meta( $new_product_id, '_resume_featured', $is_featured );
		}
	}
	
	/**
	 * YITH Auction Product Meta data save
	 */
	function wcfm_yithauction_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		if( $wcfm_products_manage_form_data['product_type'] == 'auction' ) {
			
			
			$auction_product = wc_get_product($new_product_id);
			
			if (isset($wcfm_products_manage_form_data['_yith_auction_for'])) {
				$my_date = $wcfm_products_manage_form_data['_yith_auction_for'];
				$gmt_date = get_gmt_from_date($my_date);
				yit_save_prop($auction_product, '_yith_auction_for', strtotime($gmt_date),true);
			}
			if (isset($wcfm_products_manage_form_data['_yith_auction_to'])) {
				$my_date = $wcfm_products_manage_form_data['_yith_auction_to'];
				$gmt_date = get_gmt_from_date($my_date);
				yit_save_prop($auction_product, '_yith_auction_to', strtotime($gmt_date),true);
			}
			
			$bids = YITH_Auctions()->bids;
			$exist_auctions = $bids->get_max_bid($new_product_id);

			if (isset($wcfm_products_manage_form_data['_yith_auction_start_price']) && $wcfm_products_manage_form_data['_yith_auction_start_price'] >= 0) {
					if (!$exist_auctions) {
							yit_save_prop($auction_product, '_yith_auction_start_price', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_auction_start_price'])));
					}
			}

			if (isset($wcfm_products_manage_form_data['_yith_auction_bid_increment']) && $wcfm_products_manage_form_data['_yith_auction_bid_increment'] >= 0) {
					yit_save_prop($auction_product, '_yith_auction_bid_increment', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_auction_bid_increment'])));
			}

			if (isset($wcfm_products_manage_form_data['_yith_auction_minimum_increment_amount']) && $wcfm_products_manage_form_data['_yith_auction_minimum_increment_amount'] >= 0) {
					yit_save_prop($auction_product, '_yith_auction_minimum_increment_amount', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_auction_minimum_increment_amount'])));
			}


			if (isset($wcfm_products_manage_form_data['_yith_auction_reserve_price']) && $wcfm_products_manage_form_data['_yith_auction_reserve_price'] >= 0) {
					yit_save_prop($auction_product, '_yith_auction_reserve_price', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_auction_reserve_price'])));
			}

			if (isset($wcfm_products_manage_form_data['_yith_auction_buy_now']) && $wcfm_products_manage_form_data['_yith_auction_buy_now'] >= 0) {
					yit_save_prop($auction_product, '_yith_auction_buy_now', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_auction_buy_now'])));
			}
			
			if (isset($wcfm_products_manage_form_data['_yith_auction_to'])) {
					//Clear all Product CronJob
					if (wp_next_scheduled('yith_wcact_send_emails', array($new_product_id))) {
							wp_clear_scheduled_hook('yith_wcact_send_emails', array($new_product_id));
					}
					//Create the CronJob //when the auction is about to end
					do_action('yith_wcact_register_cron_email', $new_product_id);

					//Clear all Product CronJob
					if (wp_next_scheduled('yith_wcact_send_emails_auction', array($new_product_id))) {
							wp_clear_scheduled_hook('yith_wcact_send_emails_auction', array($new_product_id));
					}
					//Create the CronJob //when the auction end, winner and vendors
					do_action('yith_wcact_register_cron_email_auction', $new_product_id);

			}

			if (isset($wcfm_products_manage_form_data['_yith_check_time_for_overtime_option'])&& $wcfm_products_manage_form_data['_yith_check_time_for_overtime_option'] >= 0) {
					yit_save_prop($auction_product, '_yith_check_time_for_overtime_option', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_check_time_for_overtime_option'])));
			}

			if (isset($wcfm_products_manage_form_data['_yith_overtime_option'])&& $wcfm_products_manage_form_data['_yith_overtime_option'] >= 0) {
					yit_save_prop($auction_product, '_yith_overtime_option', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_overtime_option'])));
			}

			if(isset($wcfm_products_manage_form_data['_yith_wcact_auction_automatic_reschedule'] ) && $wcfm_products_manage_form_data['_yith_wcact_auction_automatic_reschedule'] >=0 ) {
					yit_save_prop($auction_product, '_yith_wcact_auction_automatic_reschedule', wc_format_decimal(wc_clean($wcfm_products_manage_form_data['_yith_wcact_auction_automatic_reschedule'])),true);
			}

			if(isset($wcfm_products_manage_form_data['_yith_wcact_automatic_reschedule_auction_unit'] )) {
					yit_save_prop($auction_product, '_yith_wcact_automatic_reschedule_auction_unit', $wcfm_products_manage_form_data['_yith_wcact_automatic_reschedule_auction_unit'],true);
			}

			$show_bidup = isset($wcfm_products_manage_form_data['_yith_wcact_upbid_checkbox']) ? 'yes' : 'no';
			yit_save_prop($auction_product, '_yith_wcact_upbid_checkbox', $show_bidup);

			$show_overtime = isset($wcfm_products_manage_form_data['_yith_wcact_overtime_checkbox']) ? 'yes' : 'no';
			yit_save_prop($auction_product, '_yith_wcact_overtime_checkbox', $show_overtime );
			

			//Prevent issues with orderby in shop loop
			if (!$exist_auctions) {
					yit_save_prop($auction_product, '_price',$wcfm_products_manage_form_data['_yith_auction_start_price']);
			}

			yit_save_prop( $auction_product, 'stock_status','instock' );
			yit_save_prop( $auction_product, '_manage_stock', 'yes'  );
			yit_save_prop( $auction_product, '_stock', '1'  );
			yit_save_prop( $auction_product, '_backorders', 'no'  );
			yit_save_prop( $auction_product, '_sold_individually', 'yes'  );  

		}
	}
	
	/**
	 * WooCommerce Simple Auction Product Meta data save
	 */
	function wcfm_wcsauction_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		if( $wcfm_products_manage_form_data['product_type'] == 'auction' ) {
			$aution_fields = array(
				'_auction_item_condition',
				'_auction_type',
				'_auction_start_price',
				'_auction_bid_increment',
				'_auction_reserved_price',
				'_regular_price',
				'_auction_dates_from',
				'_auction_dates_to',
				'_auction_relist_fail_time',
				'_auction_relist_not_paid_time', 
				'_auction_relist_duration'
			);
			
			foreach ( $aution_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$rental_fields[ $field_name ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			if( isset( $wcfm_products_manage_form_data[ '_auction_proxy' ] ) ) {
				update_post_meta( $new_product_id, '_auction_proxy', 'yes' );
			} else {
				update_post_meta( $new_product_id, '_auction_proxy', '0' );
			}
			
			if( isset( $wcfm_products_manage_form_data[ '_auction_automatic_relist' ] ) ) {
				update_post_meta( $new_product_id, '_auction_automatic_relist', 'yes' );
			} else {
				delete_post_meta( $new_product_id, '_auction_automatic_relist' );
			}
			
			if( isset( $wcfm_products_manage_form_data[ '_regular_price' ] ) ) {
				update_post_meta( $new_product_id, '_price', wc_format_decimal( wc_clean( $wcfm_products_manage_form_data['_regular_price'] ) ) );
			} else {
				update_post_meta( $new_product_id, '_price', '' );
			}
			
			// Relist
			if (isset($wcfm_products_manage_form_data['_relist_auction_dates_from']) && isset($wcfm_products_manage_form_data['_relist_auction_dates_to']) && !empty($wcfm_products_manage_form_data['_relist_auction_dates_from']) && !empty($wcfm_products_manage_form_data['_relist_auction_dates_to'])) {
				$this->wcfm_wcsauction_do_relist( $new_product_id, $wcfm_products_manage_form_data['_relist_auction_dates_from'], $wcfm_products_manage_form_data['_relist_auction_dates_to'] );

			}
			
			// Stock Update
			update_post_meta( $new_product_id, '_manage_stock', 'yes'  );
			update_post_meta( $new_product_id, '_stock', '1'  );
			update_post_meta( $new_product_id, '_backorders', 'no'  );
			update_post_meta( $new_product_id, '_sold_individually', 'yes'  );  
		}
	}
	
	function wcfm_wcsauction_do_relist( $post_id, $relist_from, $relist_to ) {

		global $wpdb;

		update_post_meta($post_id, '_auction_dates_from', stripslashes($relist_from));
		update_post_meta($post_id, '_auction_dates_to', stripslashes($relist_to));
		update_post_meta($post_id, '_auction_relisted', current_time('mysql'));
		update_post_meta($post_id, '_manage_stock', 'yes');
		update_post_meta($post_id, '_stock', '1');
		update_post_meta($post_id, '_stock_status', 'instock');
		update_post_meta($post_id, '_backorders', 'no');
		update_post_meta($post_id, '_sold_individually', 'yes');
		delete_post_meta($post_id, '_auction_closed');
		delete_post_meta($post_id, '_auction_started');
		delete_post_meta($post_id, '_auction_fail_reason');
		delete_post_meta($post_id, '_auction_current_bid');
		delete_post_meta($post_id, '_auction_current_bider');
		delete_post_meta($post_id, '_auction_max_bid');
		delete_post_meta($post_id, '_auction_max_current_bider');
		delete_post_meta($post_id, '_stop_mails');
		delete_post_meta($post_id, '_stop_mails');
		delete_post_meta($post_id, '_auction_bid_count');
		delete_post_meta($post_id, '_auction_sent_closing_soon');
		delete_post_meta($post_id, '_auction_sent_closing_soon2');
		delete_post_meta($post_id, '_auction_fail_email_sent');
		delete_post_meta($post_id, '_Reserve_fail_email_sent');
		delete_post_meta($post_id, '_auction_win_email_sent');
		delete_post_meta($post_id, '_auction_finished_email_sent');
		delete_post_meta($post_id, '_auction_has_started');

		$order_id = get_post_meta($post_id, '_order_id', true);
		// check if the custom field has a value
		if (!empty($order_id)) {
			$order = wc_get_order($order_id);
			$order->update_status('failed', __('Failed because off relisting', 'wc_simple_auctions'));
			delete_post_meta($post_id, '_order_id');
		}

		$wpdb->delete( $wpdb->usermeta, array( 'meta_key' => 'wsa_my_auctions', 'meta_value' =>  $post_id ), array( '%s', '%s' ) );

		do_action('woocommerce_simple_auction_do_relist', $post_id, $relist_from, $relist_to);
	}
	
	/**
	 * WC Rental Pro Product Meta data save
	 */
	function wcfm_wcrental_pro_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		if( $wcfm_products_manage_form_data['product_type'] == 'redq_rental' ) {
			remove_all_actions('save_post');
			
			$redq_booking_data = array();
			
			// Pricing
			$rental_fields = array(
				'pricing_type' => 'pricing_type',
				'wcfm_redq_quantity' => 'wcfm_redq_quantity',
				'perkilo_price'    => 'perkilo_price',
				'hourly_price' => 'hourly_pricing',
				'general_price' => 'general_pricing',
				'redq_daily_pricing' => 'daily_pricing',
				'redq_monthly_pricing' => 'monthly_pricing',
				'redq_day_ranges_cost' => 'days_range_cost',
				'redq_price_discount_cost' => 'price_discount',
				'redq_rental_off_days' => 'rental_off_days'
			);
	
			foreach ( $rental_fields as $field_name => $field_name_all ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$redq_booking_data[ $field_name_all ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			// Checkboxes
			$settings_data = array();
			$rental_checkbox_fields = array(
				// Show/Hide
				'rnb_settings_for_display',
				'redq_rental_local_show_pickup_date',
				'redq_rental_local_show_pickup_time',
				'redq_rental_local_show_dropoff_date',
				'redq_rental_local_show_dropoff_time',
				'redq_rental_local_show_pricing_flip_box',
				'redq_rental_local_show_price_discount_on_days',
				'redq_rental_local_show_price_instance_payment',
				'redq_rental_local_show_request_quote',
				'redq_rental_local_show_book_now',
				
				// Logical
				'rnb_settings_for_conditions',
				'redq_rental_local_enable_single_day_time_based_booking',
				
				// Validation
				'rnb_settings_for_validations',
				'redq_rental_local_required_pickup_location',
				'redq_rental_local_required_return_location',
				'redq_rental_local_required_person',
				'redq_rental_required_local_pickup_time',
				'redq_rental_required_local_return_time'
			);
	
			foreach ( $rental_checkbox_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) && !empty( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$settings_data[ str_replace( 'redq_rental_', '', str_replace( 'local_', '', $field_name ) ) ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				} else {
					$settings_data[ str_replace( 'redq_rental_', '', str_replace( 'local_', '', $field_name ) ) ] = 'closed';
					update_post_meta( $new_product_id, $field_name, 'closed' );
				}
			}
			
			// Physical
			$rental_title_fields = array(
				'rnb_settings_for_labels'       => 'rnb_settings_for_labels',
				'redq_show_pricing_flipbox_text' => 'show_pricing_flipbox_text',
				'redq_flip_pricing_plan_text' => 'flip_pricing_plan_text',
				'redq_pickup_location_heading_title' => 'pickup_location_heading_title',
				'redq_dropoff_location_heading_title' => 'dropoff_location_heading_title',
				'redq_pickup_date_heading_title' => 'pickup_date_heading_title',
				'redq_pickup_date_placeholder' => 'pickup_date_placeholder',
				'redq_pickup_time_placeholder' => 'pickup_time_placeholder',
				'redq_dropoff_date_heading_title' => 'dropoff_date_heading_title',
				'redq_dropoff_date_placeholder' => 'dropoff_date_placeholder',
				'redq_dropoff_time_placeholder' => 'dropoff_time_placeholder',
				'redq_rnb_cat_heading' => 'rnb_cat_heading',
				'redq_resources_heading_title' => 'resources_heading_title',
				'redq_adults_heading_title' => 'adults_heading_title',
				'redq_adults_placeholder' => 'adults_placeholder',
				'redq_childs_heading_title' => 'childs_heading_title',
				'redq_childs_placeholder' => 'childs_placeholder',
				'redq_security_deposite_heading_title' => 'deposite_heading_title',
				'redq_discount_text_title' => 'discount_text',
				'redq_instance_pay_text_title' => 'instance_pay_text',
				'redq_total_cost_text_title' => 'total_cost_text',
				'redq_book_now_button_text' => 'book_now_text',
				'redq_rfq_button_text' => 'rfq_button_text'
			);
	
			foreach ( $rental_title_fields as $field_name => $field_name_settings ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$settings_data[ $field_name_settings ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			// Logical
			$rental_logical_fields = array(
				'block_rental_dates' => 'redq_block_general_dates',
				'choose_date_format' => 'redq_calendar_date_format',
				'max_time_late' => 'redq_max_time_late'
			);
			
			foreach ( $rental_logical_fields as $field_name => $field_store_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$redq_booking_data[ $field_name ] = $wcfm_products_manage_form_data[ $field_name ];
					$settings_data[ $field_name ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_store_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			if( $wcfm_products_manage_form_data[ 'choose_date_format' ] === 'd/m/Y' ) {
				$redq_booking_data[ 'choose_euro_format' ] = 'yes';
				$settings_data[ 'choose_euro_format' ] = 'yes';
				update_post_meta( $new_product_id, 'redq_choose_european_date_format', 'yes');
			} else {
				$redq_booking_data[ 'choose_euro_format' ] = 'no';
				$settings_data[ 'choose_euro_format' ] = 'no';
				update_post_meta( $new_product_id, 'redq_choose_european_date_format', 'no');
			}
			
			$rental_more_logical_fields = array(
				'redq_max_rental_days',
				'redq_min_rental_days',
				'redq_rental_starting_block_dates',
				'redq_rental_post_booking_block_dates',
				'redq_time_interval',
			);
			
			foreach ( $rental_more_logical_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$settings_data[ str_replace( 'rental_', '', str_replace( 'redq_', '', $field_name ) ) ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			// Daily basis openning and closing time
			$rental_opening_time_fields = array(
				'redq_rental_fri_min_time',
				'redq_rental_sat_min_time',
				'redq_rental_sun_min_time',
				'redq_rental_mon_min_time',
				'redq_rental_thu_min_time',
				'redq_rental_wed_min_time',
				'redq_rental_thur_min_time',
			);
			
			foreach ( $rental_opening_time_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) && !empty( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$settings_data[ str_replace( 'redq_rental_', '', $field_name ) ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				} else{
					update_post_meta( $new_product_id, $field_name, '00:00' );
					$settings_data[ str_replace( 'redq_rental_', '', $field_name ) ] = '00:00';
				}
			}
			
			$rental_closing_time_fields = array(
				'redq_rental_fri_max_time',
				'redq_rental_sat_max_time',
				'redq_rental_sun_max_time',
				'redq_rental_mon_max_time',
				'redq_rental_thu_max_time',
				'redq_rental_wed_max_time',
				'redq_rental_thur_max_time',
			);
			
			foreach ( $rental_closing_time_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) && !empty( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$settings_data[ str_replace( 'redq_rental_', '', $field_name ) ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				} else{
					update_post_meta( $new_product_id, $field_name, '24:00' );
					$settings_data[ str_replace( 'redq_rental_', '', $field_name ) ] = '24:00';
				}
			}
			
			
			// Inventory Management - 2.4.3
			$resource_identifier = array();
			$redq_inventory_child_ids = array();
			$redq_inventory_unique_names = array();
			if ( isset( $wcfm_products_manage_form_data[ 'redq_inventory_products' ] ) && !empty( $wcfm_products_manage_form_data[ 'redq_inventory_products' ] ) ) {
				$previous_unique_names = get_post_meta( $new_product_id, 'redq_inventory_products_quique_models', true );
				$previous_child_ids = get_post_meta( $new_product_id, 'inventory_child_posts', true );
				
				foreach( $wcfm_products_manage_form_data[ 'redq_inventory_products' ] as $redq_inventory_products ) {
					$inventory_id = '';
					$r_id = '';
					if( isset( $redq_inventory_products['inventory_id'] ) && !empty( $redq_inventory_products['inventory_id'] ) ) {
					  $inventory_id = $redq_inventory_products['inventory_id'];	
					  $r_id = $redq_inventory_products['inventory_id'];
					}
					
					$defaults = array(
						'ID' => $inventory_id,
						'post_author' => apply_filters( 'wcfm_current_vendor_id', get_current_user_id() ),
						'post_content' => $redq_inventory_products['unique_name'],
						'post_content_filtered' => '',
						'post_title' => $redq_inventory_products['unique_name'],
						'post_excerpt' => '',
						'post_status' => 'publish',
						'post_type' => 'inventory',
						'comment_status' => '',
						'ping_status' => '',
						'post_password' => '',
						'to_ping' =>  '',
						'pinged' => '',
						'post_parent' => $new_product_id,
						'menu_order' => 0,
						'guid' => '',
						'import_id' => 0,
						'context' => '',
					);

					$inventory_id = wp_insert_post( $defaults );

					if ( in_array( 'sitepress-multilingual-cms/sitepress.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && function_exists('icl_object_id') ) {
						global $sitepress;
						$trid = $sitepress->get_element_trid( $inventory_id, 'post_inventory' );
						$sitepress->set_element_language_details( $inventory_id, 'post_inventory', $trid, ICL_LANGUAGE_CODE );
					}
					
					$resource_identifier[$inventory_id]['title'] = $redq_inventory_products['unique_name'];
					$resource_identifier[$inventory_id]['inventory_id'] = $inventory_id;

					$redq_inventory_child_ids[] = $inventory_id;
					$redq_inventory_unique_names[] = $redq_inventory_products['unique_name'];
					
					// Associate Inventory Taxonomies
					$inventory_taxonomies = array( 'rnb_categories', 'pickup_location', 'dropoff_location', 'resource', 'person', 'deposite', 'attributes', 'features' );
					foreach( $inventory_taxonomies as $inventory_taxonomy ) {
						if( isset( $redq_inventory_products[$inventory_taxonomy] ) ) {
							wp_set_object_terms( $inventory_id, $redq_inventory_products[$inventory_taxonomy], $inventory_taxonomy );
						} else {
							wp_set_object_terms( $inventory_id, array(0), $inventory_taxonomy );
						}
					}
					
					// Availability
					$redq_rental_availability = array();
					$only_block_dates = array();
					if( isset( $redq_inventory_products[ 'redq_rental_availability' ] ) && !empty( $redq_inventory_products[ 'redq_rental_availability' ] ) ) {
						$redq_rental_availability = $redq_inventory_products[ 'redq_rental_availability' ];
						update_post_meta( $inventory_id, 'redq_rental_availability', $redq_rental_availability );
						
						$booked_dates_aras = array();
						foreach ( $redq_rental_availability as $key => $value ) {
		        	$booked_dates_aras[] = get_plain_dates_ara( $value['from'], $value['to'] );
		        }
		        if(isset($booked_dates_aras) && !empty($booked_dates_aras)) {
							foreach ($booked_dates_aras as $index => $booked_dates_aras) {
								foreach ($booked_dates_aras as $key => $value) {
									$only_block_dates[] = $value;
								}
							}
						}
					}
					
					$intialize_rental_availability = array();
					$intialize_rental_availability['block_dates'] = $redq_rental_availability;
					$intialize_rental_availability['block_times'] = array();
					$intialize_rental_availability['only_block_dates'] = $only_block_dates;
					$intialize_block_dates_and_times[$inventory_id] = $intialize_rental_availability;
					$intialize_block_dates_and_times = get_post_meta( $new_product_id, 'redq_block_dates_and_times', true );
					$intialize_block_dates_and_times[$inventory_id] = $intialize_rental_availability;
					update_post_meta( $new_product_id, 'redq_block_dates_and_times', $intialize_block_dates_and_times );
				}
				
				if( $previous_child_ids && is_array($previous_child_ids) ) {
					$removed_inventory_child_ids = array_diff( $previous_child_ids, $redq_inventory_child_ids );
					if( !empty( $removed_inventory_child_ids ) ) {
						foreach( $removed_inventory_child_ids as $removed_inventory_child_id ) {
							wp_delete_post( $removed_inventory_child_id );
						}
					}
				}
				
				update_post_meta( $new_product_id, 'resource_identifier', $resource_identifier );
				update_post_meta( $new_product_id, 'inventory_child_posts', $redq_inventory_child_ids );
				update_post_meta( $new_product_id, '_redq_product_inventory', $redq_inventory_child_ids );
				update_post_meta( $new_product_id, 'redq_rental_inventory_count', count( $redq_inventory_child_ids ) );
				update_post_meta( $new_product_id, 'redq_inventory_products_quique_models', $redq_inventory_unique_names );
			}
			
			// Store All Data
			$redq_booking_data['local_settings_data'] = $settings_data;
			update_post_meta( $new_product_id, 'redq_all_data', $redq_booking_data );
			
			
			// Set Product Price
			$pricing_type = get_post_meta( $new_product_id, 'pricing_type',true );
			$gproduct = wc_get_product($new_product_id);
			if(isset($gproduct) && !empty($gproduct)) {
				$product_type = wc_get_product($new_product_id)->get_type();
			}
			
			if( !empty( $redq_inventory_child_ids ) ) {
				foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
					update_post_meta( $redq_inventory_child_id, 'pricing_type', $pricing_type);
				}
			}
			
			if( !empty( $redq_inventory_child_ids ) ) {
				foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
					update_post_meta( $redq_inventory_child_id, 'quantity', $wcfm_products_manage_form_data['wcfm_redq_quantity'] );
				}
			}
			
			if( !empty( $redq_inventory_child_ids ) ) {
				foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
					update_post_meta( $redq_inventory_child_id, 'perkilo_price', $wcfm_products_manage_form_data['perkilo_price'] );
				}
			}
			
			if( !empty( $redq_inventory_child_ids ) ) {
				foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
					update_post_meta( $redq_inventory_child_id, 'hourly_price', $wcfm_products_manage_form_data['hourly_price'] );
				}
			}
	
			if(isset($product_type) && $product_type === 'redq_rental') {
				if($pricing_type == 'general_pricing') {
					$general_pricing = get_post_meta($new_product_id,'general_price',true);
					update_post_meta($new_product_id,'_price',$general_pricing);
					if( !empty( $redq_inventory_child_ids ) ) {
						foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
							update_post_meta( $redq_inventory_child_id, 'general_price', $general_pricing);
						}
					}
				}
	
				if($pricing_type === 'daily_pricing') {
					$redq_daily_pricing = array();
					$daily_pricing = get_post_meta($new_product_id,'redq_daily_pricing',true);
					$today = date('N');
					switch ($today) {
						case '7':
							update_post_meta($new_product_id, '_price' , $daily_pricing['sunday']);
							$redq_daily_pricing['sunday'] = $daily_pricing['sunday'];
							break;
						case '1':
							update_post_meta($new_product_id, '_price' , $daily_pricing['monday']);
							$redq_daily_pricing['monday'] = $daily_pricing['monday'];
							break;
						case '2':
							update_post_meta($new_product_id, '_price' , $daily_pricing['tuesday']);
							$redq_daily_pricing['tuesday'] = $daily_pricing['tuesday'];
							break;
						case '3':
							update_post_meta($new_product_id, '_price' , $daily_pricing['wednesday']);
							$redq_daily_pricing['wednesday'] = $daily_pricing['wednesday'];
							break;
						case '4':
							update_post_meta($new_product_id, '_price' , $daily_pricing['thursday']);
							$redq_daily_pricing['thursday'] = $daily_pricing['thursday'];
							break;
						case '5':
							update_post_meta($new_product_id, '_price' , $daily_pricing['friday']);
							$redq_daily_pricing['friday'] = $daily_pricing['friday'];
							break;
						case '6':
							update_post_meta($new_product_id, '_price' , $daily_pricing['saturday']);
							$redq_daily_pricing['saturday'] = $daily_pricing['saturday'];
							break;
						default:
							update_post_meta($new_product_id, '_price' , 'Daily price not set');
							break;
					}
					if( !empty( $redq_inventory_child_ids ) ) {
						foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
							update_post_meta( $redq_inventory_child_id, 'redq_daily_pricing', $redq_daily_pricing);
						}
					}
				}
	
				if($pricing_type === 'monthly_pricing') {
					$redq_monthly_pricing = array();
					$monthly_pricing = get_post_meta($new_product_id,'redq_monthly_pricing',true);
					$current_month = date('m');
					switch ($current_month) {
						case '1':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['january']);
							$redq_monthly_pricing['january'] = $monthly_pricing['january'];
							break;
						case '2':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['february']);
							$redq_monthly_pricing['february'] = $monthly_pricing['february'];
							break;
						case '3':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['march']);
							$redq_monthly_pricing['march'] = $monthly_pricing['march'];
							break;
						case '4':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['april']);
							$redq_monthly_pricing['april'] = $monthly_pricing['april'];
							break;
						case '5':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['may']);
							$redq_monthly_pricing['may'] = $monthly_pricing['may'];
							break;
						case '6':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['june']);
							$redq_monthly_pricing['june'] = $monthly_pricing['june'];
							break;
						case '7':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['july']);
							$redq_monthly_pricing['july'] = $monthly_pricing['july'];
							break;
						case '8':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['august']);
							$redq_monthly_pricing['august'] = $monthly_pricing['august'];
							break;
						case '9':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['september']);
							$redq_monthly_pricing['september'] = $monthly_pricing['september_price'];
							break;
						case '10':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['october']);
							$redq_monthly_pricing['october'] = $monthly_pricing['october_price'];
							break;
						case '11':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['november']);
							$redq_monthly_pricing['november'] = $monthly_pricing['november_price'];
							break;
						case '12':
							update_post_meta($new_product_id, '_price' , $monthly_pricing['december']);
							$redq_monthly_pricing['december'] = $monthly_pricing['december_price'];
							break;
						default:
							update_post_meta($new_product_id, '_price' , 'Daily price not set');
							break;
					}
					if( !empty( $redq_inventory_child_ids ) ) {
						foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
							update_post_meta( $redq_inventory_child_id, 'redq_monthly_pricing', $redq_monthly_pricing);
						}
					}
				}
	
				if($pricing_type === 'days_range') {
					$day_ranges_cost = get_post_meta($new_product_id,'redq_day_ranges_cost',true);
					update_post_meta($new_product_id, '_price' , $day_ranges_cost[0]['range_cost']);
					if( !empty( $redq_inventory_child_ids ) ) {
						foreach( $redq_inventory_child_ids as $redq_inventory_child_id ) {
							update_post_meta( $redq_inventory_child_id, 'redq_day_ranges_cost', $day_ranges_cost );
						}
					}
				}
			}
		}
	}
	
	/**
	 * WC Box Office Product Meta data save
	 */
	function wcfm_wc_box_office_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		$is_ticket = isset( $wcfm_products_manage_form_data['_ticket'] ) ? 'yes' : 'no';
		update_post_meta( $new_product_id, '_ticket', $is_ticket );
		
		if( apply_filters( 'wcfm_is_allow_wc_box_office_ticket', true ) ) {
			$ticket_fields = array();
			foreach( $wcfm_products_manage_form_data['_ticket_fields'] as $ticket_field_key => $ticket_field_value ) {
				$ticket_field_key = md5( $ticket_field_value[ 'label' ] . $ticket_field_value[ 'type' ] );
				$ticket_fields[$ticket_field_key] = $ticket_field_value;
			}
			update_post_meta( $new_product_id, '_ticket_fields', $ticket_fields );
		}

		// Ticket printing options
		if( apply_filters( 'wcfm_is_allow_wc_box_office_ticket_printing', true ) ) {
			if ( isset( $wcfm_products_manage_form_data['_print_tickets'] ) ) {
				update_post_meta( $new_product_id, '_print_tickets', $wcfm_products_manage_form_data['_print_tickets'] );
			} else {
				delete_post_meta( $new_product_id, '_print_tickets' );
			}
	
			if ( isset( $wcfm_products_manage_form_data['_print_barcode'] ) ) {
				update_post_meta( $new_product_id, '_print_barcode', $wcfm_products_manage_form_data['_print_barcode'] );
			} else {
				delete_post_meta( $new_product_id, '_print_barcode' );
			}
	
			if ( isset( $_POST['ticket_content'] ) ) {
				update_post_meta( $new_product_id, '_ticket_content', stripslashes( html_entity_decode( $_POST['ticket_content'], ENT_QUOTES, 'UTF-8' ) ) );
			}
		}

		// Ticket email options
		if( apply_filters( 'wcfm_is_allow_wc_box_office_ticket_email', true ) ) {
			if ( isset( $wcfm_products_manage_form_data['_email_tickets'] ) ) {
				update_post_meta( $new_product_id, '_email_tickets', $wcfm_products_manage_form_data['_email_tickets'] );
			} else {
				delete_post_meta( $new_product_id, '_email_tickets' );
			}
	
			if ( isset( $wcfm_products_manage_form_data['_email_ticket_subject'] ) ) {
				update_post_meta( $new_product_id, '_email_ticket_subject', $wcfm_products_manage_form_data['_email_ticket_subject'] );
			}
	
			if ( isset( $_POST['ticket_email_html'] ) ) {
				update_post_meta( $new_product_id, '_ticket_email_html', stripslashes( html_entity_decode( $_POST['ticket_email_html'], ENT_QUOTES, 'UTF-8' ) ) );
				update_post_meta( $new_product_id, '_ticket_email_plain', stripslashes( html_entity_decode( $_POST['ticket_email_html'], ENT_QUOTES, 'UTF-8' ) ) );
			}
		}
	}
	
	/**
	 * WC Lottery Product Meta data save
	 */
	function wcfm_wc_lottery_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		if( $wcfm_products_manage_form_data['product_type'] == 'lottery' ) {
			$lottery_fields = array(
				'_min_tickets',
				'_max_tickets',
				'_max_tickets_per_user',
				'_lottery_num_winners',
				'_lottery_multiple_winner_per_user',
				'_lottery_price',
				'_lottery_sale_price',
				'_lottery_dates_from',
				'_lottery_dates_to'
			);
			
			//$wcfm_products_manage_form_data['_yith_auction_for'] = ( $wcfm_products_manage_form_data[ '_yith_auction_for' ] ) ? strtotime( $wcfm_products_manage_form_data[ '_yith_auction_for' ] ) : '';
			//$wcfm_products_manage_form_data['_yith_auction_to'] = ( $wcfm_products_manage_form_data[ '_yith_auction_to' ] ) ? strtotime( $wcfm_products_manage_form_data[ '_yith_auction_to' ] ) : '';
			
			
			$wcfm_products_manage_form_data['_lottery_multiple_winner_per_user'] = ( $wcfm_products_manage_form_data[ '_lottery_multiple_winner_per_user' ] ) ? 'yes' : 'no';
	
			foreach ( $lottery_fields as $field_name ) {
				if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
					$rental_fields[ $field_name ] = $wcfm_products_manage_form_data[ $field_name ];
					update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
				}
			}
			
			// Set Product Price
			if( isset( $wcfm_products_manage_form_data[ '_lottery_price' ] ) ) {
				update_post_meta( $new_product_id, '_regular_price', $wcfm_products_manage_form_data[ '_lottery_price' ] );
			}
			if( isset( $wcfm_products_manage_form_data[ '_lottery_sale_price' ] ) && ( $wcfm_products_manage_form_data[ '_lottery_sale_price' ] != '' ) ) {
				update_post_meta( $new_product_id, '_sale_price', $wcfm_products_manage_form_data[ '_lottery_sale_price' ] );
				update_post_meta( $new_product_id, '_price', $wcfm_products_manage_form_data[ '_lottery_sale_price' ] );
			} else {
				update_post_meta( $new_product_id, '_sale_price', '' );
				update_post_meta( $new_product_id, '_price', $wcfm_products_manage_form_data[ '_lottery_price' ] );
			}
		}
	}
	
	/**
	 * WC Deposits Product Meta data save
	 */
	function wcfm_wc_deposits_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		$deposit_fields = array(
			'_wc_deposit_enabled',
			'_wc_deposit_type',
			'_wc_deposit_multiple_cost_by_booking_persons',
			'_wc_deposit_amount',
			'_wc_deposit_selected_type'
		);
		
		foreach ( $deposit_fields as $field_name ) {
			if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
				update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
			}
		}
	}
	
	/**
	 * WC Advanced Product Labels Product Meta data save
	 */
	function wcfm_wc_advanced_product_labels_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		$label_fields = array(
			'_wapl_label_type',
			'_wapl_label_text',
			'_wapl_label_style',
			'_wapl_label_align',
			'_wapl_custom_bg_color',
			'_wapl_custom_text_color'
		);
		
		foreach ( $label_fields as $field_name ) {
			if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
				update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
			}
		}
	}
	
	/**
	 * Whole Sale price Save
	 */
	function wcfm_wholesale_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		$label_fields = array(
			'wholesale_price',
			'wholesale_minimum_order_quantity',
			'wholesale_order_quantity_step',
			//'_wapl_label_align',
			//'_wapl_custom_bg_color',
			//'_wapl_custom_text_color'
		);
		
		foreach ( $label_fields as $field_name ) {
			if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
				foreach( $wcfm_products_manage_form_data[ $field_name ] as $wholesale_field_key => $wholesale_field_val ) {
					update_post_meta( $new_product_id, $wholesale_field_key, $wholesale_field_val );
				}
			}
		}
	}
	
	/**
	 * Whole Sale variation price Save
	 */
	function wcfm_product_variation_wholesale_save( $wcfm_variation_data, $new_product_id, $variation_id, $variations, $wcfm_products_manage_form_data ) {
		global $WCFM, $WCFMmp;
		
		$all_wholesale_roles = unserialize( get_option( WWP_OPTIONS_REGISTERED_CUSTOM_ROLES ) );
		if ( !is_array( $all_wholesale_roles ) )
			$all_wholesale_roles = array();
		
		if( !empty( $all_wholesale_roles ) ) {
			foreach ( $all_wholesale_roles as $role_key => $role ) {
				$field_id        = $role_key . '_wholesale_price';
				if( isset( $variations[$field_id] ) ) {
					update_post_meta( $variation_id, $field_id, $variations[$field_id] );
				}
			}
		}
		
		if ( WCFMu_Dependencies::wcfm_wholesale_active_check() ) {
			
			if( !empty( $all_wholesale_roles ) ) {
				foreach ( $all_wholesale_roles as $role_key => $role ) {
					$field_id        = $role_key . '_wholesale_minimum_order_quantity';				
					if( isset( $variations[$field_id] ) ) {
						update_post_meta( $variation_id, $field_id, $variations[$field_id] );
					}
				}
			}
			
			if( !empty( $all_wholesale_roles ) ) {
				foreach ( $all_wholesale_roles as $role_key => $role ) {
					$field_id        = $role_key . '_wholesale_order_quantity_step';				
					if( isset( $variations[$field_id] ) ) {
						update_post_meta( $variation_id, $field_id, $variations[$field_id] );
					}
				}
			}
		}
		return $wcfm_variation_data;
	}
	
	/**
	 * WC Min/Max Quantities Save
	 */
	function wcfm_wc_min_max_quantities_product_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		$label_fields = array(
			'minimum_allowed_quantity',
			'maximum_allowed_quantity',
			'group_of_quantity',
		);
		
		foreach ( $label_fields as $field_name ) {
			if ( isset( $wcfm_products_manage_form_data[ $field_name ] ) ) {
				update_post_meta( $new_product_id, $field_name, $wcfm_products_manage_form_data[ $field_name ] );
			}
		}
		
		if( isset( $wcfm_products_manage_form_data['allow_combination'] ) ) {
			update_post_meta( $new_product_id, 'allow_combination', 'yes' );
		} else {
			update_post_meta( $new_product_id, 'allow_combination', 'no' );
		}
		
		if( isset( $wcfm_products_manage_form_data['minmax_do_not_count'] ) ) {
			update_post_meta( $new_product_id, 'minmax_do_not_count', 'yes' );
		} else {
			update_post_meta( $new_product_id, 'minmax_do_not_count', 'no' );
		}
		
		if( isset( $wcfm_products_manage_form_data['minmax_cart_exclude'] ) ) {
			update_post_meta( $new_product_id, 'minmax_cart_exclude', 'yes' );
		} else {
			update_post_meta( $new_product_id, 'minmax_cart_exclude', 'no' );
		}
		
		if( isset( $wcfm_products_manage_form_data['minmax_category_group_of_exclude'] ) ) {
			update_post_meta( $new_product_id, 'minmax_category_group_of_exclude', 'yes' );
		} else {
			update_post_meta( $new_product_id, 'minmax_category_group_of_exclude', 'no' );
		}
	}
	
	/**
	 * WC Min/Max Quantities variation price Save
	 */
	function wcfm_product_variation_wc_min_max_quantities_save( $wcfm_variation_data, $new_product_id, $variation_id, $variations, $wcfm_products_manage_form_data ) {
		global $WCFM, $WCFMmp;
		
		$label_fields = array(
			'variation_minimum_allowed_quantity',
			'variation_maximum_allowed_quantity',
			'variation_group_of_quantity',
		);
		
		foreach ( $label_fields as $field_name ) {
			if ( isset( $variations[ $field_name ] ) ) {
				update_post_meta( $variation_id, $field_name, $variations[ $field_name ] );
			}
		}
		
		if( isset( $variations['min_max_rules'] ) ) {
			update_post_meta( $variation_id, 'min_max_rules', 'yes' );
		} else {
			update_post_meta( $variation_id, 'min_max_rules', 'no' );
		}
		
		if( isset( $variations['variation_minmax_do_not_count'] ) ) {
			update_post_meta( $variation_id, 'variation_minmax_do_not_count', 'yes' );
		} else {
			update_post_meta( $variation_id, 'variation_minmax_do_not_count', 'no' );
		}
		
		if( isset( $variations['variation_minmax_cart_exclude'] ) ) {
			update_post_meta( $variation_id, 'variation_minmax_cart_exclude', 'yes' );
		} else {
			update_post_meta( $variation_id, 'variation_minmax_cart_exclude', 'no' );
		}
		
		if( isset( $variations['variation_minmax_category_group_of_exclude'] ) ) {
			update_post_meta( $variation_id, 'variation_minmax_category_group_of_exclude', 'yes' );
		} else {
			update_post_meta( $variation_id, 'variation_minmax_category_group_of_exclude', 'no' );
		}
		
		return $wcfm_variation_data;
	}
	
	
	/**
	 * Third Party Product Meta data save
	 */
	function wcfmu_thirdparty_products_manage_meta_save( $new_product_id, $wcfm_products_manage_form_data ) {
		global $wpdb, $WCFM, $_POST;
		
		// WooCommerce Product Badge Manager Support
		if ( WCFMu_Dependencies::wcfm_wc_product_badge_manager_active_check() ) {
			if(isset($wcfm_products_manage_form_data['woo_pro_badge_meta_box'])) {
				update_post_meta( $new_product_id, 'woo_pro_badge_meta_box', $wcfm_products_manage_form_data['woo_pro_badge_meta_box'] );
			}
		}
		
		// WC 360 Images Support
		if ( WCFMu_Dependencies::wcfm_wc_360_images_active_check() ) {
			if(isset($wcfm_products_manage_form_data['wcfm_enable_360_images'])) {
				update_post_meta( $new_product_id, 'wc360_enable', 'yes' );
			} else {
				update_post_meta( $new_product_id, 'wc360_enable', 'no' );
			}
		}
		
		// WP Job Manager Support
		if( apply_filters( 'wcfm_is_allow_listings', true ) && apply_filters( 'wcfm_is_allow_associate_listings_for_products', true ) ) {
			if( WCFM_Dependencies::wcfm_wp_job_manager_plugin_active_check() && !WCFM_Dependencies::wcfm_products_mylistings_active_check() ) {
				if(isset($wcfm_products_manage_form_data['wpjm_listings'])) {
					$old_listings = (array) get_post_meta( $new_product_id, '_wpjm_listings', true );
					$new_listings = (array) $wcfm_products_manage_form_data['wpjm_listings'];
					
					// Remove Product from Old Listings 
					if( $old_listings ) {
						foreach( $old_listings as $old_listing ) {
							$listing_products = (array) get_post_meta( $old_listing, '_products', true );
							if( ( $key = array_search( $new_product_id, $listing_products ) ) !== false ) {
								unset( $listing_products[$key] );
							}
							update_post_meta( $old_listing, '_products', $listing_products );
						}
					}
					
					// Associate Product to New Listings
					if( $new_listings ) {
						foreach( $new_listings as $new_listing ) {
							$listing_products = (array) get_post_meta( $new_listing, '_products', true );
							$listing_products[] = $new_product_id;
							update_post_meta( $new_listing, '_products', $listing_products );
						}
					}
					update_post_meta( $new_product_id, '_wpjm_listings', $new_listings );
				}
			}
		}
	}
}