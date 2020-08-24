jQuery(document).ready(function($) {
	$(document).on("click", ".brb__upload-button", function (e) {
		e.preventDefault();
		var $button = $(this);

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select or upload image',
			library: {
				type: 'image'
			},
			button: {
				text: 'Select'
			},
			multiple: false
		});

		file_frame.on('select', function () {
			var attachment = file_frame.state().get('selection').first().toJSON();
			$button.siblings('.brb__upload-field').val(attachment.url);
			$button.siblings('.brb__upload-preview').html('<img class="brb__logo-preview" src="' + attachment.url + '" alt="Your Logo">');
		});

		file_frame.open();
 });

	$('.brb__upload-clear').on('click', function(e) {
		$('.brb__upload-field').val('');
		$('.brb__logo-preview').hide();
		return false;
	});
});