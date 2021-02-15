var loader_image = falcons_data.loading_image;
var ajaxurl = falcons_data.ajaxurl;		
(function($) {
	
	var active_payment_gateway=falcons_data.iv_gateway; 
	
	jQuery(document).ready(function($) {
			
						jQuery.validate({
							form : '#iv_directories_registration',
							modules : 'security',		
												
							onSuccess : function() {
							
							  	jQuery("#loading-3").show();
								jQuery("#loading").html('<img src="'+loader_image+'">');
								
								if(active_payment_gateway=='stripe'){
									
										 Stripe.createToken({
											number: jQuery('#card_number').val(),
											cvc: jQuery('#card_cvc').val(),
											exp_month: jQuery('#card_month').val(),
											exp_year: jQuery('#card_year').val(),
											//name: $('.card-holder-name').val(),
											//address_line1: $('.address').val(),
											//address_city: $('.city').val(),
											//address_zip: $('.zip').val(),
											//address_state: $('.state').val(),
											//address_country: $('.country').val()
										}, stripeResponseHandler);
									
									return false;
									
								}else{ // Else for paypal
									
									return true; // false Will stop the submission of the form
								}
								
							},
							
					  })
 
	 })
	 
	 
	 // this identifies your website in the createToken call below
	 if(active_payment_gateway=='stripe'){
		Stripe.setPublishableKey(falcons_data.stripe_publishable);

			function stripeResponseHandler(status, response) {
				if (response.error) {				
					jQuery("#payment-errors").html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.error.message +'.</div> ');
				
				} else {
					var form$ = jQuery("#iv_directories_registration");
					// token contains id, last4, and card type
					var token = response['id'];
					// insert the token into the form so it gets submitted to the server
					form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
					// and submit
					form$.get(0).submit();
				}
			}
	}
	 
	 
})(jQuery);
							
		
jQuery(document).ready(function() {
    jQuery('#coupon_name').on('keyup change', function() {
						
		var ajaxurl = falcons_data.ajaxurl;		
		var search_params={
			"action"  			: "iv_directories_check_coupon",	
			"coupon_code" 		:jQuery("#coupon_name").val(),
			"package_id" 		:jQuery("#package_id").val(),
			"package_amount" 	:falcons_data.package_amount,
			"api_currency" 		:falcons_data.api_currency,
			"form_data"			:jQuery("#iv_directories_registration").serialize(),
			
		};
		jQuery('#coupon-result').html('<img src="'+falcons_data.old_loader+'">');
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="'+falcons_data.right_icon+'">');							
					
				}else{
					jQuery('#coupon-result').html('<img src="'+falcons_data.wrong_icon+'">');
				}
				
				jQuery('#total').html('<label class="control-label">'+response.gtotal +'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount +'</label>');
			}
		});
	});
});

jQuery(function(){	
	jQuery('#package_sel').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = falcons_data.ajaxurl;		
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:falcons_data.package_amount,
		"api_currency" 		:falcons_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#coupon-result').html('<img src="'+falcons_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+falcons_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);
				jQuery('#discount').html(response.dis_amount);
			}
			});
		});	
jQuery('#country_select').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = jQuery("#package_id").val();
		
		
		//jQuery("#package_id").val(pack_id);
								
		var ajaxurl = falcons_data.ajaxurl;		
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:falcons_data.package_amount,
		"api_currency" 		:falcons_data.api_currency,
		"form_data"			:jQuery("#iv_directories_registration").serialize(),
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){
					jQuery('#coupon-result').html('<img src="'+falcons_data.right_icon+'">');
				}else{
						jQuery('#coupon-result').html('<img src="'+falcons_data.wrong_icon+'">');
				}
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);
				jQuery('#discount').html(response.dis_amount);
			}
			});
		});
});	
function check_availablility(){
	var category =jQuery('#postcats').val(); 
	category=category.trim();
	var address = jQuery("#address").val();
	
	address=address.trim();
	jQuery("#message_availablility").html('<img src="'+loader_image+'">');	
	if(category!="" && address!=""){
			var ajaxurl = falcons_data.ajaxurl;		
				var search_params={
				"action"  			: "iv_check_availablility",	
				"category" 			:category,		
				"address" 			:address,		
				"form_data"			:jQuery("#iv_directories_registration").serialize(),
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
							//jQuery('#message_availablility').html('<span class="help-block form-error">Available...... </span>');
							jQuery('#message_availablility').html('');
							jQuery('#check_availablility').hide();
							jQuery('#availablility_success').show();
							
						}
						if(response.code=='not-success'){ 
							jQuery('#message_availablility').html('<span class="help-block form-error">'+response.full_message+' </span>');
							jQuery('#check_availablility').show();
							jQuery('#availablility_success').hide();
						}
						
					}
					});
	}else{
		jQuery('#message_availablility').html('<span class="help-block form-error">Please select Practice Category and City </span>');
	
	}		
			
}
function reserve_click(){
	
	var category =jQuery('#postcats').val(); 
	category=category.trim();
	var address = jQuery("#address").val();
	
	address=address.trim();
	jQuery("#message_availablility").html('<img src="'+loader_image+'">');	
	if(category!="" && address!=""){
			var ajaxurl = falcons_data.ajaxurl;		
				var search_params={
				"action"  			: "iv_check_availablility",	
				"category" 			:category,		
				"address" 			:address,		
				"form_data"			:jQuery("#iv_directories_registration").serialize(),
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
							//jQuery('#message_availablility').html('<span class="help-block form-error">Available...... </span>');
							jQuery('#message_availablility').html('');
							jQuery('#check_availablility').hide();
							jQuery('#availablility_success').hide();
							
							jQuery('#postcats').attr('disabled', true);
							jQuery('#address').attr('disabled', true);
							jQuery('#payment_div').show();
							
						}
						if(response.code=='not-success'){ 
							jQuery('#message_availablility').html('<span class="help-block form-error">'+response.full_message+' </span>');
							jQuery('#check_availablility').show();
							jQuery('#availablility_success').hide();
						}
						
					}
					});
	}else{
		jQuery('#message_availablility').html('<span class="help-block form-error">Please select Practice Category and City </span>');
	
	}		
	
	
	
}	

function show_coupon(){
				jQuery("#coupon-div").show();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-3 control-label"></label><div class="col-md-9 " ><button type="button" onclick="hide_coupon();"  class="btn btn-default center"> '+falcons_data.Hide_Coupon +'</button></div>');
}
function hide_coupon(){
				 jQuery("#coupon-div").hide();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-3 control-label"></label><div class="col-md-9 " ><button type="button" onclick="show_coupon();"  class="btn btn-default center"> '+falcons_data.have_Coupon +'</button></div>');
}

jQuery('#iv_directories_registration').submit(function(){
   jQuery("#iv_directories_registration :disabled").removeAttr('disabled');
});
