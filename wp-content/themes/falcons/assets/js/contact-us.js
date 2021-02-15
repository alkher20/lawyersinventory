var loader_image = falcons_data.loading_image;
var ajaxurl = falcons_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=falcons_data.iv_gateway; 
	
	jQuery(document).ready(function($) {
	
				jQuery.validate({
					form : '#contactus',
																			
					onSuccess : function() {	
						send_contact_message();	
						return false; // false Will stop the submission of the form
						
					},
					
			  })
 
	 })
})(jQuery);	

function send_contact_message(){
	
var ajaxurl = falcons_data.ajaxurl;	
var loader_image =  falcons_data.loading_image;
	jQuery('#update_message').html('<img src="'+loader_image+'">'); 
	var search_params={
		"action"  : 	"iv_directories_message_contact",	
		"form_data":	jQuery("#contactus").serialize(), 					
	};				
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){											
			jQuery('#update_message').html(response.msg );
			jQuery("#contactus").trigger('reset');						
		}
	});		


}

				
		
