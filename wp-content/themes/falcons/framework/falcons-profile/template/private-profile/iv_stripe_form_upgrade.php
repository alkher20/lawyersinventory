<?php
// wp_enqueue_style('wp-iv_directories-style-13', wp_iv_directories_URLPATH . 'admin/files/css/require 'lib/Stripe.php';';
wp_enqueue_script('iv_directories-script-upgrade-15', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');

$newpost_id='';
$post_name='iv_directories_stripe_setting';
$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
			if(sizeof($row )>0){
			  $newpost_id= $row->ID;
			}
$stripe_mode=get_post_meta( $newpost_id,'iv_directories_stripe_mode',true);	
if($stripe_mode=='test'){
	$stripe_publishable =get_post_meta($newpost_id, 'iv_directories_stripe_publishable_test',true);	
}else{
	$stripe_publishable =get_post_meta($newpost_id, 'iv_directories_stripe_live_publishable_key',true);	
}
$api_currency= 'USD';
if( get_option('_iv_directories_api_currency' )!=FALSE ) {
	$api_currency= get_option('_iv_directories_api_currency' );
}
?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
			<div id="payment-errors"></div>
	<div id="stripe_form">
			<div class="row form-group">
			<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php esc_html_e('Package Name',"falcons"); ?></label>
				<div class="col-md-8 col-xs-8 col-sm-8 "> 																				
					<?php
						$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
						$membership_pack = $wpdb->get_results($sql);
						$total_package=count($membership_pack);
						
						if(sizeof($membership_pack)>0){
							$i=0; $current_package_id=get_user_meta($current_user->ID,'iv_directories_package_id',true);
							echo'<select name="package_sel" id ="package_sel" class=" form-control">';							
							foreach ( $membership_pack as $row )
							{		
									if($current_package_id==$row->ID){
										echo '<option value="'. $row->ID.'" >'. $row->post_title.' [Your Current Package]</option>';
									}else{
										echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
									}
									
									if($i==0){
										
										 $package_id=$row->ID;
										if(get_post_meta($row->ID, 'iv_directories_package_recurring',true)=='on'){
											$package_amount=get_post_meta($row->ID, 'iv_directories_package_recurring_cost_initial', true);	
										}else{
											$package_amount=get_post_meta($row->ID, 'iv_directories_package_cost',true);
										
										}
									}
							 $i++;		
							}	
												
							echo '</select>';
						}
					 ?>
					</div>
				
				</div>
							
			<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php esc_html_e('Amount',"falcons"); ?></label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label"> <?php  echo $package_amount.' '.$recurring_text; ?> </label>
								</div>										
			</div>	
						<?php
							$api_currency= 'USD';
							if( get_option('_iv_directories_api_currency' )!=FALSE ) {
								$api_currency= get_option('_iv_directories_api_currency' );
							}
							$tax_total=0;
							$tax_type= (get_option('_iv_tax_type')!=""? get_option('_iv_tax_type'):"country");
							$tax_active_module=get_option('_iv_directories_active_tax');
							$country_id= get_user_meta($userId, 'country_code',true);  // Will get from User meta
							if($tax_active_module=='yes'){
							?>
							<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Vat/Tax','falcons');?></label>												
																				
								<div class="col-md-8" id="tax">  
									<?php 										
										$tax_type= get_option('_iv_tax_type');
										$tax_active_module=get_option('_iv_directories_active_tax');
										
										if($tax_active_module=='' ){ $tax_active_module='yes';	}					
										if($tax_type==''){$tax_type='country';}
											
										if($tax_active_module=='yes' AND $tax_type=='country'){						
											$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
											
											if(array_key_exists($country_id , $countries_tax_array)){							
												 $country_tax_value= $countries_tax_array[$country_id];
												 $tax_total=$package_amount * $country_tax_value/100;
											}
										}
										if($tax_active_module=='yes' AND $tax_type=='common'){						
											$common_tax_value= get_option('_iv_comman_tax_value');						
											$tax_total=$package_amount * $common_tax_value/100;											
										}
													echo $tax_total.''.$api_currency; 
										
										?>
								</div>										
							</div>
							<?php
							}	
							?>					
			<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Total','falcons');?></label>												
																				
								<div class="col-md-8" id="total"><label class="control-label">  <?php  $package_amount= $package_amount+$tax_total; echo $package_amount.''.$api_currency; ?></label>
								</div>										
			</div>							
			<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php esc_html_e('Card Number',"falcons"); ?></label> 
								<div class="col-md-8 col-xs-8 col-sm-8 " >  
									<input type="text" name="card_number" id="card_number"  data-validation="creditcard required"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e('Enter card number',"falcons"); ?>" data-validation-error-msg="<?php esc_html_e('Card number is not correct',"falcons"); ?>" >
			</div>										
			</div>
		<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php esc_html_e('Card CVV',"falcons"); ?> </label>
								<div class="col-md-8 col-xs-8 col-sm-8 " >  
									<input type="text" name="card_cvc" id="card_cvc" class="form-control ctrl-textbox"   data-validation="number" 
data-validation-length="2-6" data-validation-error-msg="<?php esc_html_e('CVV number is not correct',"falcons"); ?>" placeholder="<?php esc_html_e('Enter card CVC',"falcons"); ?>" >
			</div>
		</div>	
					<div class="row form-group">
							<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php esc_html_e('Expiration (MM/YYYY)',"falcons"); ?></label>
							<div class="col-md-4 col-xs-4 col-sm4" >  
							
								<select name="card_month" id="card_month"  class="card-expiry-month stripe-sensitive required form-control">
									<option value="01" selected="selected">01</option>
									<option value="02">02</option>
									<option value="03">03</option>
									<option value="04">04</option>
									<option value="05">05</option>
									<option value="06">06</option>
									<option value="07">07</option>
									<option value="08">08</option>
									<option value="09">09</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12" selected >12</option>
								  </select>
							</div>
						<div class="col-md-4 col-xs-4 col-sm-4 " >  
								 <select name="card_year"  id="card_year"  class="card-expiry-year stripe-sensitive  form-control">
								  </select>
								  <script type="text/javascript">
									var select = jQuery(".card-expiry-year"),
									year = new Date().getFullYear();
						 
									for (var i = 0; i < 12; i++) {
										select.append(jQuery("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
									}
								</script> 
						</div>								
					</div>	
				<?php
									$iv_directories_payment_terms=get_option('iv_directories_payment_terms'); 
									$term_text='I have read & accept the <a href="#"> Terms & Conditions</a>';
									if( get_option( 'iv_directories_payment_terms_text' ) ) {
										$term_text= get_option('iv_directories_payment_terms_text'); 
									}
									if($iv_directories_payment_terms=='yes'){
									?>
							
								<div class="row">
									<div class="col-md-4 col-xs-4 col-sm-4 "> 
									</div>
											<div class="col-md-8 col-xs-8 col-sm-8 "> 
											<label>
											  <input type="checkbox" data-validation="required" 
			 data-validation-error-msg="You have to agree to our terms "  name="check_terms" id="check_terms"> <?php echo $term_text; ?>
											</label>
										<div class="text-danger" id="error_message" > </div>
									  </div>									
								</div>
																				
								<?php
								}	 
										 
								?>	
						<input type="hidden" name="country_select" id="country_select" value="<?php echo $country_id; ?>">	
						<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
						<input type="hidden" name="coupon_code" id="coupon_code" value="">	 		
						<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
						<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
			
				
			
				<div class="row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
					<div class="col-md-8 col-xs-8 col-sm-8 " > <div id="loading"> </div> 
						<button  id="submit_iv_directories_payment"  type="submit" class="btn btn-info ctrl-btn"  > <?php esc_html_e('Submit',"falcons"); ?> </button>
					</div>
				</div>	
	</div>			
	 			
<script type="text/javascript">	
var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';

(function($) {
	var active_payment_gateway='<?php echo $iv_gateway; ?>'; 
	jQuery(document).ready(function($) {
						
						jQuery.validate({
							form : '#profile_upgrade_form',
							modules : 'security',		
												
							onSuccess : function() {
							  
							  	//$("#loading-3").html(loader_image);
								jQuery("#loading").html(loader_image);
								
								if(active_payment_gateway=='stripe'){
									
									  var chargeAmount = 3000;
									  
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
	 
		
		Stripe.setPublishableKey('<?php echo  $stripe_publishable; ?>');

		function stripeResponseHandler(status, response) {
			if (response.error) {				
				jQuery("#payment-errors").html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.error.message +'.</div> ');
			} else {
				var form$ = jQuery("#profile_upgrade_form");
				// token contains id, last4, and card type
				var token = response['id'];
				// insert the token into the form so it gets submitted to the server
				form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
				// and submit
					
				 	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';			
					var search_params={
						"action"  : 	"iv_directories_profile_stripe_upgrade",	
						"form_data":	jQuery("#profile_upgrade_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							jQuery('#payment-errors').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							jQuery("#stripe_form").hide();
							
						}
					});
					//form$.get(0).submit();
			}
		}
})(jQuery);		
		
</script>		
