(function( $ ) {
	'use strict';
	
	// Il faut que le DOM soit déjà opé
	$(function() { 

		// Calcul de la valeur max de la progressbar
		var winHeight = $(window).height(),
		docHeight = $(document).height();
		var max = docHeight - winHeight;
		$('.readingProgressbar').attr('max', max);
		
		var progressColor = $('.readingProgressbar').attr('data-color');
		var progressHeight = $('.readingProgressbar').attr('data-height');
		var progressPosition = $('.readingProgressbar').attr('data-position');
		var progressCustomPosition = $('.readingProgressbar').attr('data-custom-position');
		var progressFixedOrAbsolute = 'fixed';

		// Custom position
		if (progressPosition == 'custom') {
			console.log(progressCustomPosition);
			$('.readingProgressbar').appendTo(progressCustomPosition);
			progressPosition = 'bottom';
			progressFixedOrAbsolute = 'absolute';
		}

		// Styles
		if ( progressPosition == 'top' ) {
			var progressTop = '0';
			var progressBottom = 'auto';
		} else {
			var progressTop = 'auto';
			var progressBottom = '0';
		}

		$('.readingProgressbar').css({
			'color' :  progressColor,
			'height' :  progressHeight + 'px',
			'top' : progressTop,
			'bottom' : progressBottom,
			'position' : progressFixedOrAbsolute
		});
		
		$('<style>.readingProgressbar::-webkit-progress-bar { background-color: transparent } .readingProgressbar::-webkit-progress-value { background-color: ' + progressColor + ' } .readingProgressbar::-moz-progress-bar { background-color: ' + progressColor + ' }</style>')
		.appendTo('head');

		// Valeur initiale (si on arrive via une ancre ou autre…)
		var value = $(window).scrollTop();
		$('.readingProgressbar').attr('value', value);

		// Calcul et maj dynamique de la valeur lors du scroll
		$(document).on('scroll', function() {
			value = $(window).scrollTop();
			$('.readingProgressbar').attr('value', value);
		});
		
	});

})( jQuery );
