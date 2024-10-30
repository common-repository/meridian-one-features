"use strict";

jQuery(document).ready(function($) {

	/**
	 * Icon Selector
	 */

	if ( $('#customize-controls').length ) {
		$('#customize-controls').append('<div class="meridian-one-customizer-icon-select"><span class="meridian-one-customizer-icon-select-title">Icon Select</span><span class="meridian-one-customizer-icon-select-description">Click on the icon from the list below.</span><div class="meridian-one-customizer-icon-select-list"></div></div>');
	} else {
		$('body').append('<div class="meridian-one-customizer-icon-select"><span class="meridian-one-customizer-icon-select-title">Icon Select</span><span class="meridian-one-customizer-icon-select-description">Click on the icon from the list below.</span><div class="meridian-one-customizer-icon-select-list"></div></div>');
	}
	
	var iconSelector = $('.meridian-one-customizer-icon-select'),
	iconList = $('.meridian-one-customizer-icon-select-list');

	$.each( MeridianOneIcons, function( key, font ) {
		iconList.append('<span class="fa ' + font + '" data-meridian-one-id="' + font + '"></span>');
	});

	$(document).on( 'click', '.meridian-one-customizer-icon-select-list .fa', function(){
		var iconID = $(this).data('meridian-one-id');
		$('.meridian-one-customizer-icon-select-value.meridian-one-active').siblings('.meridian-one-customizer-icon-current').html( '<span class="fa ' + iconID + '"></span>' );
		$('.meridian-one-customizer-icon-select-value.meridian-one-active').val(iconID).removeClass('meridian-one-active').trigger('change');
		iconSelector.hide();
	});

	$(document).on( 'click', '.meridian-one-customizer-icon-select-hook', function(){
		iconSelector.show();
		$(this).siblings('.meridian-one-customizer-icon-select-value').addClass('meridian-one-active');
	});

	/**
	 * Image selector
	 */

	$(document).on( 'click', '.meridian-one-customizer-image-select-hook', function (e) {

		e.preventDefault();

		var imageButton = $(this),
		imageCurrent = $(this).siblings('.meridian-one-customizer-image-current');

		// Create the media frame.
		var file_frame = wp.media.frames.file_frame = wp.media({
			library: {
				type: 'image'
			},
			multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on('select', function () {
			// We set multiple to false so only get one image from the uploader
			var attachment = file_frame.state().get('selection').first().toJSON();
			imageCurrent.html( '<img src="' + attachment.url + '" />' );
			imageButton.siblings('input').val(attachment.id).trigger('change');
		});

		// Finally, open the modal
		file_frame.open();

	});

});