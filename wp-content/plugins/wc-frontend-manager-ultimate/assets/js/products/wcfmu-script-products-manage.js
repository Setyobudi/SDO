jQuery(document).ready(function($) {
	if( wcfm_is_allow_downlodable_file_field.is_allow ) {
		$('.downlodable_file').addClass('downlodable_file_visible');
		$('.downlodable_file').attr( 'readonly', false );
	}
		
	// Category checklist view cat limit control
	if( $('#product_cats_checklist').length > 0 ) {
		var catlimit = $('#product_cats_checklist').data('catlimit');
		if( catlimit != -1 ) {
			$('#product_cats_checklist').find('.wcfm-checkbox').change(function() {
			  var checkedCount = $('#product_cats_checklist').find('.wcfm-checkbox:checked').length;
			  if( checkedCount > catlimit ) {
			  	if( catlimit == 1 ) {
						$('#product_cats_checklist').find('.wcfm-checkbox').prop( 'checked', false );
						$(this).prop( 'checked', true );
					} else {
						$(this).prop( 'checked', false );
					}
			  }
			});
		}
	}
	
	// Custom Taxonomy checklist view cat limit control
	if( $('.product_custom_taxonomy_checklist').length > 0 ) {
		$('.product_custom_taxonomy_checklist').each(function() {
			var $ptid = $(this).attr('id');
			var catlimit = $("#" + $ptid).data('catlimit');
			if( catlimit != -1 ) {
				$("#" + $ptid).find('.wcfm-checkbox').change(function() {
					var checkedCount = $("#" + $ptid).find('.wcfm-checkbox:checked').length;
					if( checkedCount > catlimit ) {
						if( catlimit == 1 ) {
							$("#" + $ptid).find('.wcfm-checkbox').prop( 'checked', false );
							$(this).prop( 'checked', true );
						} else {
							$(this).prop( 'checked', false );
						}
					}
				});
			}
		});
	}
	
	// Category - Attribute Mapping
	function processCategoryBasedAttibutesShow() {
		$('.wcfm_attributes_blocks').addClass('wcfm_custom_hide');
		$('.wcfm_category_attributes_mapping_msg').removeClass('wcfm_custom_hide');
		$has_category_attributes_mapping = wcfm_is_force_category_attributes_mapping.is_force;
		$('#product_cats_checklist').find('input[type="checkbox"]').each(function() {
			if( $(this).is(':checked') ) {
				$cat_val = $(this).data('super_parent');
				$has_mapping = false;
				$.each( wcfm_category_attributes_mapping, function( cat_id, allowed_attributes ) {
				  if( $cat_val == cat_id ) {
				  	$has_mapping = true;
				  	$.each( allowed_attributes, function( i, allowed_attribute ) {
				  	  $('.wcfm_attributes_block_'+allowed_attribute).removeClass('wcfm_custom_hide');
				  	});
				  	$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
				  }
				});
				
				if( !$has_mapping ) {
					$('.wcfm_attributes_blocks').removeClass('wcfm_custom_hide');
					$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
				}
				$has_category_attributes_mapping = true;
			}
		});
		if( !$has_category_attributes_mapping ) {
			$('.wcfm_attributes_blocks').removeClass('wcfm_custom_hide');
			$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
		}
		resetCollapsHeight($('#attributes'));
	}
	
	if( $('#product_cats').hasClass('wcfm-select') ) {
		$('#product_cats').change(function() {
			$('.wcfm_attributes_blocks').addClass('wcfm_custom_hide');
			$('.wcfm_category_attributes_mapping_msg').removeClass('wcfm_custom_hide');
			$has_category_attributes_mapping = wcfm_is_force_category_attributes_mapping.is_force;
			$selected_categories = $(this).find(':selected');
			
			$.each( $selected_categories, function( $sc, $selected_category ) {
				$product_cat = $(this).data('super_parent');
				$has_mapping = false;
				$.each( wcfm_category_attributes_mapping, function( cat_id, allowed_attributes ) {
					if( $product_cat == cat_id ) {
						$has_mapping = true;
						$.each( allowed_attributes, function( i, allowed_attribute ) {
							$('.wcfm_attributes_block_'+allowed_attribute).removeClass('wcfm_custom_hide');
						});
						$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
					}
				});
				
				if( !$has_mapping ) {
					$('.wcfm_attributes_blocks').removeClass('wcfm_custom_hide');
					$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
				}
				$has_category_attributes_mapping = true;
			});
			
			if( !$has_category_attributes_mapping ) {
				$('.wcfm_attributes_blocks').removeClass('wcfm_custom_hide');
				$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
			}
			resetCollapsHeight($('#attributes'));
		}).change();
	} else if( $('.wcfm_category_hierarchy ').length > 0 ) {
		$('#wcfm_cat_level_0').change(function() {
			$('.wcfm_attributes_blocks').addClass('wcfm_custom_hide');
			$('.wcfm_category_attributes_mapping_msg').removeClass('wcfm_custom_hide');
			$has_mapping = wcfm_is_force_category_attributes_mapping.is_force;
			$product_cat = $(this).val();
			
			$.each( wcfm_category_attributes_mapping, function( cat_id, allowed_attributes ) {
				if( $product_cat == cat_id ) {
					$has_mapping = true;
					$.each( allowed_attributes, function( i, allowed_attribute ) {
						$('.wcfm_attributes_block_'+allowed_attribute).removeClass('wcfm_custom_hide');
					});
					$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
				}
			});
			
			if( !$has_mapping ) {
				$('.wcfm_attributes_blocks').removeClass('wcfm_custom_hide');
				$('.wcfm_category_attributes_mapping_msg').addClass('wcfm_custom_hide');
			}
			
			resetCollapsHeight($('#attributes'));
		}).change();
	} else {
		$('#product_cats_checklist').find('input[type="checkbox"]').each(function() {
			$(this).click(function() {
				processCategoryBasedAttibutesShow();
			});
		});
		processCategoryBasedAttibutesShow();
	}
		
	$('.wcfm_add_attributes_new_term').each(function() {
		$(this).on('click', function() {
			var term = prompt( wcfm_dashboard_messages.add_attribute_term );
			if (term != null) {
				$wrapper = $(this).parent();
				var taxonomy = $wrapper.find('[data-name="term_name"]').val();
				var data         = {
					action:   'wcfmu_add_attribute_term',
					taxonomy: taxonomy,
					term:     term
				};
		
				$('#attributes').block({
					message: null,
					overlayCSS: {
						background: '#fff',
						opacity: 0.6
					}
				});
				
				$.ajax({
					type:		'POST',
					url: wcfm_params.ajax_url,
					data: data,
					success:	function(response) {
						if(response) {
							if ( response.error ) {
								// Error.
								window.alert( response.error );
							} else if ( response.slug ) {
								// Success.
								$wrapper.find( 'select.wc_attribute_values' ).append( '<option value="' + response.term_id + '" selected="selected">' + response.name + '</option>' );
								$wrapper.find( 'select.wc_attribute_values' ).change();
							}
			
							$( '#attributes' ).unblock();
						}
					}
				});
			}
		});
	});
	
	// Associate Listing - WP Job Manager Support
	if( $('#wpjm_listings').length > 0 ) {
		$('#wpjm_listings').select2({
			placeholder: wcfm_dashboard_messages.choose_listings_select2
		});
	}
	
	if( $('.add_product_tab').length > 0 ) {
		$('.add_product_tab').on('click', function() {
			setTimeout(function() {
				$('.remove_row').addClass('wcfm_submit_button');
				resetCollapsHeight($('#woocommerce_product_tabs'));
			}, 100);
		});
	}
	
	// Duplicate Product
	$('#wcfm_product_duplicate').click(function(event) {
		event.preventDefault();
		$('#wcfm_products_manage_form').block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});
		var data = {
			action : 'wcfmu_duplicate_product',
			proid : $(this).data('proid')
		}	
		$.ajax({
			type:		'POST',
			url: wcfm_params.ajax_url,
			data: data,
			success:	function(response) {
				if(response) {
					$response_json = $.parseJSON(response);
					if($response_json.status) {
						if( $response_json.redirect ) window.location = $response_json.redirect;	
					}
				}
			}
		});
		return false;
	});
	
	// Featured Product
	$('.wcfm_product_featured').each(function() {
		$(this).click(function(event) {
			event.preventDefault();
			jQuery('#wcfm_products_manage_form').block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});
			var data = {
				action   : 'wcfmu_product_featured',
				proid    : $(this).data('proid'),
				featured : $(this).data('featured')
			}	
			jQuery.ajax({
				type:		'POST',
				url: wcfm_params.ajax_url,
				data: data,
				success:	function(response) {
					window.location.reload();
				}
			});
			return false;
		});
	});
} );