jQuery(document).ready(function($){
	$('#upload-btn').click(function(e) {
		e.preventDefault();
		var image = wp.media({ 
			title: 'Change Logo',
			multiple: false
		}).open()
		.on('select', function(e){
			var uploaded_image = image.state().get('selection').first();
			var image_url = uploaded_image.toJSON().url;
			$('#sp_wp_cust_login_logo').val(image_url);
		});
	});
});
