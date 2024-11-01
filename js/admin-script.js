(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    jQuery(function() {
        jQuery('.gm-snow-color-field').wpColorPicker();
        jQuery('.gmse_flake_icon_type').select2();
        jQuery('body').on('click', '.gmse_upload_image_button', function(e) {
	        e.preventDefault();
	 
	        var button = jQuery(this),
	        custom_uploader = wp.media({
	            title: 'Insert image',
	            library : {
	                // uncomment the next line if you want to attach image to the current post
	                // uploadedTo : wp.media.view.settings.post.id, 
	                type : 'image'
	            },
	            button: {
	                text: 'Use this image' // button label text
	            },
	            multiple: true // for multiple image selection set to true
	        }).on('select', function() { // it also has "open" and "close" events 
	            var attachment = custom_uploader.state().get('selection').toJSON();
	            console.log(attachment);
	            var htmlswork =''; 
	            jQuery( attachment ).each(function( key,value ) {
				  console.log( value.id );
				  htmlswork +='<div class="gmse_pdf_logo_prvw_image">';
				  htmlswork +='<img src="'+value.url+'" />';
				  htmlswork +='<input type="hidden" name="gmse_flake_image_type[]" value="'+value.id+'" />';
				  htmlswork +='<a href="#" class="gmse_remove_image_button button">Remove Image</a>';
				  htmlswork +='</div>';
				});
				jQuery(".gmse_pdf_logo_prvw_image_main").append(htmlswork);
	        })
	        .open();
   		});
   		jQuery('body').on('click', '.gmse_remove_image_button', function(e) {
	        e.preventDefault();
	        jQuery(this).closest('.gmse_pdf_logo_prvw_image').remove();
	    });
	    jQuery('body').on('change', '.gmse_select_weather', function(e) {
	        makeshowselciton();
	    });
   		makeshowselciton();
	    function makeshowselciton(){
	    	jQuery('.gmse_inner_weather_data').hide(); 
	    	var gmse_select_weather=jQuery('.gmse_select_weather').val(); 
	    	jQuery('.gmse_inner_weather_'+gmse_select_weather).show(); 
	    }
    });
     
})( jQuery );