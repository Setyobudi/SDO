$wcfm_event_tickets_table = '';
$ticket_event = '';

jQuery(document).ready(function($) {
		
	if( dataTables_config.is_allow_hidden_export ) {
		$wcfm_datatable_button_args = [
																		{
																			extend: 'print',
																		},
																		{
																			extend: 'pdfHtml5',
																			orientation: 'landscape',
																			pageSize: 'LEGAL',
																		},
																		{
																			extend: 'excelHtml5',
																		}, 
																		{
																			extend: 'csv',
																		}
																	];
	}
	
	$wcfm_event_tickets_table = $('#wcfm-event_tickets').DataTable( {
		"processing": true,
		"serverSide": true,
		"pageLength": parseInt(dataTables_config.pageLength),
		"responsive": true,
		"dom"       : 'Bfrtip',
		"pageLength": parseInt(dataTables_config.pageLength),
		"language"  : $.parseJSON(dataTables_language),
		"buttons"   : $wcfm_datatable_button_args,
		"columns"   : [
										{ responsivePriority: 1 },
										{ responsivePriority: 2 },
										{ responsivePriority: 1 },
										{ responsivePriority: 2 },
										{ responsivePriority: 3 },
										{ responsivePriority: 4 },
										{ responsivePriority: 1 },
								],
		"columnDefs": [ { "targets": 0, "orderable" : false }, 
									  { "targets": 1, "orderable" : false }, 
										{ "targets": 2, "orderable" : false },
										{ "targets": 3, "orderable" : false },
										{ "targets": 4, "orderable" : false },
										{ "targets": 5, "orderable" : false },
										{ "targets": 6, "orderable" : false },
									],
		'ajax': {
			"type"   : "POST",
			"url"    : wcfm_params.ajax_url,
			"data"   : function( d ) {
				d.action       = 'wcfm_ajax_controller',
				d.controller   = 'wcfm-event-tickets',
				d.ticket_event = $ticket_event
			},
			"complete" : function () {
				$(".wcfm_linked_images").colorbox({iframe:true, width: 300, innerHeight: 100});
				initiateTip();
				
				// Fire wcfm-event_tickets table refresh complete
				$( document.body ).trigger( 'updated_wcfm-event_tickets' );
			}
		}
	} );
	
	if( $('#dropdown_event').length > 0 ) {
		$('#dropdown_event').on('change', function() {
			$ticket_event = $('#dropdown_event').val();
			$wcfm_event_tickets_table.ajax.reload();
		}).select2();
	}
	
	// Dashboard FIlter
	if( $('.wcfm_filters_wrap').length > 0 ) {
		$('.dataTable').before( $('.wcfm_filters_wrap') );
		$('.wcfm_filters_wrap').css( 'display', 'inline-block' );
	}
	
	// Screen Manager
	/*$( document.body ).on( 'updated_wcfm-event_tickets', function() {
		$.each(wcfm_customers_screen_manage, function( column, column_val ) {
		  $wcfm_shop_customers_table.column(column).visible( false );
		} );
	});*/
} );