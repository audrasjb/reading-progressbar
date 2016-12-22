(function( $ ) {
	'use strict';

	$(window).load( function() {
		
		// Show widget
		if ( $('#asagenda-widget-calendar-container').length > 0 ) {
			$('#asagenda-widget-calendar-container').monthly({
				mode: 'event',
				dataType: 'json',
				events: asagendaJsonEvents,
				weekStart: 'Mon',
			});
		}
		
		// Show shortcode
		if ( $('#asagenda-shortcode-calendarview-container').length > 0 ) {
			$('#asagenda-shortcode-calendarview-container').monthly({
				mode: 'event',
				dataType: 'json',
				events: asagendaJsonEvents,
				weekStart: 'Mon',
			});
		}
	});

})( jQuery );
