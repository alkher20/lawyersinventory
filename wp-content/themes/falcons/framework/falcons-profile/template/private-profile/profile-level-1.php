 <?php
 global $wpdb;
 $current_user = wp_get_current_user();
  
		    // Check Express Checkout Here 
		    // IF IF*********
   
		$userId=$current_user->ID;
		
		$payment_gateway=get_user_meta($userId, 'iv_directories_payment_gateway', true);	
		if($payment_gateway==''){$payment_gateway='paypal-express';}
		
		
	?>    
					<style>
	            #profile-account2 .profile-content {
	              border: 0;
	              padding: 0;
	              box-shadow: 0px 2px 0px rgba(0,0,0, .1);
	              background: #fff;
	              margin-bottom: 40px;
	            }
	            #profile-account2 .portlet {
	              padding: 0;
	            }
	            #profile-account2 .caption {
	              display: block;
	              width: 100%;
	              float: none;
	              padding: 15px 20px !important;
	              background: #f0f0f0;
	              border-top-left-radius: 3px !important;
	              border-top-right-radius: 3px !important;
	            }
	            #profile-account2 .caption-subject {
	              color: #333 !important;
	              text-transform: capitalize;
	            }
	            #profile-account2 .nav-tabs {
	              float: none;
	              background: #f4f4f4;
	              width: 100%;
	              position: relative;
	              z-index: 10;
	            }

	            #profile-account2 .nav-tabs li {
	              width: 25%;
	              border-right: 2px solid #f0f0f0;
	              border-bottom: o;
	              text-align: center;
	            }
	            #profile-account2 .nav-tabs li:last-child {
	              border-right: 0;
	            }

	            #profile-account2 .portlet-title .nav li.active {
	              border-bottom: 0;
	            }

	            #profile-account2 .portlet-title .nav li.active a {
	              background:  #c29c6a;
	              color: #fff;
	              border-bottom-color: #c29c6a !important;
	            }

	            #profile-account2 .portlet-title .nav li.active a:before {
	              content: '';
	              position: absolute;
	              left: 45%;
	              top: 100%;
	              width: 0; 
	              height: 0; 
	              border-left: 10px solid transparent;
	              border-right: 10px solid transparent;
	              
	              border-top: 10px solid #c29c6a;
	            }

	            #profile-account2 .nav-tabs li a {
	              padding: 12px 7px;
	              border-bottom: 2px solid #f0f0f0 !important;
	              margin: 0;
	              border-radius: 0;
	              text-transform: uppercase;
	              color: #333;
	              font-size: 13px;
	            }

	            #profile-account2 .portlet-title .nav li:hover {
	              border-bottom: 0;
	              background: transparent;
	            }

	            #profile-account2 .tabbable-line {
	              border-bottom: 0;
	            }

	            #profile-account2 .tab-content {
	              padding: 30px;
	            }

	            .tab-content .form-group {
	              position: relative;
	              margin-bottom: 30px;
	            }

	            #profile-account2 label {
	              color: #666;
	              font-weight: 600;
	              font-size: 15px;
	              margin-bottom: 8px;
	            }

	            #profile-account2 .tab-content .table tbody tr {
	              background: #f4f4f4;
	            }

	            #profile-account2 .tab-content .table tbody tr td {
	              border-left: 1px solid #ddd;
	              border-bottom: 1px solid #ddd;
	              padding-left: 20px;
	              padding-top: 16px;
	              color: #333;
	            }
	            #profile-account2 .tab-content .table tbody tr td:last-child {
	              border-right: 1px solid #ddd;
	            }

	            #profile-account2 .tab-content .table tbody tr td label {
	              background: transparent;
	            }

	            #profile-account2 .tab-content .table tbody tr td label input {
	              margin-right: 5px;
	            }

	            #main-wrapper {
	              background: #fbfbfb;
	            }


	            .btn-new {
	              display: inline-block;
	              margin-bottom: 0;
	              font-weight: inherit;
	              text-align: center;
	              vertical-align: middle;
	              touch-action: manipulation;
	              cursor: pointer;
	              background-image: none;
	              border: 0;
	              white-space: nowrap;
	              color: #ffffff !important;
	              padding: 6px 21.312px;
	              transition: all 0.3s;
	              border-radius: 3px;
	              text-transform: uppercase !important;
	              font-size: 13px !important;
	              font-family: 'Montserrat', sans-serif !important;
	            }

	            .btn-custom {
	              background-color: #c29c6a;
	              border: 2px solid #c29c6a;
	              color: #fff;
	              padding: 6px 30px !important;
	            }

	            #profile-account2 .green-haze {
	              background-color: #c29c6a !important;
	              border: 2px solid #c29c6a;
	              color: #fff;
	            }

	            

	            .btn-custom:hover, .btn-custom.hover, .btn-custom:focus, .btn-custom.focus, .btn-custom:active, .btn-custom.active {
	                background-color: #2771aa;
	                border-color: #2771aa;
	            }


	            .table .profile-desc-link img {
	            	border-radius: 50%;
	            }

	            #profile-account2 .tab-content .table tbody tr td {
	            	vertical-align: middle;
	            }


	          </style>
        
          <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Membership Level','falcons')	;?>	 </span>
                    </div>
					 <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#tab_current" data-toggle="tab"><?php  _e('Current','falcons')	;?></a>
                      </li>
					  <li class="">
                        <a href="#tab_upgrade" data-toggle="tab"><?php  _e('Upgrade','falcons')	;?></a>
                      </li>
					    
                      <li>
                        <a href="#tab_cancel" data-toggle="tab"><?php  _e('Cancel','falcons')	;?></a>
                      </li>
                   
                    </ul>
                  
                  </div>
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_current">
					   <?php
						  	global $wpdb, $post;
							$iv_gateway = get_option('iv_directories_payment_gateway');								
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
							$membership_pack = $wpdb->get_results($sql);
							$total_package=count($membership_pack);
							$package_id=get_user_meta($current_user->ID,'iv_directories_package_id',true);
							$iv_pac=$package_id;
						  ?>
						  <div class="table-responsive">
							<table class="table table-striped">
							<tr>
									<td  style="font-size:14px;width:40%"> 
										<?php  _e('Current Package','falcons')	;?>
									</td>
									<td  style="font-size:14px;width:60%"> 
									<?php
										if($package_id!=""){
											$post_p = get_post($package_id); 
											if(!empty($post_p)){
												echo ($post_p->post_title!="" ? $post_p->post_title: 'None');	
											}else{
												echo'None';
											}	
										}else{
											echo'None';
										}
										
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Package Amount','falcons')	;?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php	$currencyCode= get_option('_iv_directories_api_currency');
											$recurring_text='  '; $amount= '';
											if(get_post_meta($package_id, 'iv_directories_package_cost', true)=='0' or get_post_meta($package_id, 'iv_directories_package_cost', true)==""){
											  $amount= 'Free';
											}else{
											  $amount= $currencyCode.' '. get_post_meta($package_id, 'iv_directories_package_cost', true);
											}
											
											$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);	
											if($recurring == 'on'){
												$amount= $currencyCode.' '. get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);
												$count_arb=get_post_meta($package_id, 'iv_directories_package_recurring_cycle_count', true); 	
												if($count_arb=="" or $count_arb=="1"){
												$recurring_text=" per ".' '.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_type', true);
												}else{
												$recurring_text=' per '.$count_arb.' '.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_type', true).'s';
												}
												
											}else{
												$recurring_text=' &nbsp; ';
											}
										echo $amount;
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Package Type','falcons')	;?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php
										echo $amount.' '.$recurring_text;
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Payment Status','falcons')	;?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php 
										echo ucfirst(get_user_meta($current_user->ID, 'iv_directories_payment_status', true));
										?>
									</td>
							</tr>
							<tr>
									<td style="font-size:14px;width:40%" > 
										<?php  _e('User Role','falcons')	;?>
									</td>
									<td style="font-size:14px;width:60%"> 
									<?php 
										
										 $user = new WP_User( $current_user->ID );
										if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
											foreach ( $user->roles as $role )
												echo ucfirst($role);
										}
										
										?>
									</td>
							</tr>
							 <?php
							 
							   if(get_user_meta($current_user->ID, 'iv_directories_payment_status', true)=='cancel'){
							 ?>
								<tr>
										<td width="40%" style="font-size:14px"> 
											<?php  _e('Exprie Date','falcons');?> 
										</td>
										<td width="60%" style="font-size:14px"> 
										<?php
											if($recurring == 'on'){
												$exp_date= get_user_meta($current_user->ID, 'iv_directories_exprie_date', true);
												echo date('d-M-Y',strtotime($exp_date));
											}else{
												$exp_date= get_user_meta($current_user->ID, 'iv_directories_exprie_date', true);
												echo date('d-M-Y',strtotime($exp_date));	
											}	
											
											?>
										</td>
								</tr>
								<?php
								}else{
								
								?>
								
								<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Next Payment Date','falcons')	;?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php
										if($recurring == 'on'){
											$exp_date= get_user_meta($current_user->ID, 'iv_directories_exprie_date', true);
											echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
										}else{
											$exp_date= get_user_meta($current_user->ID, 'iv_directories_exprie_date', true);
											echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
										}	
										
										?>
									</td>
							</tr>
							<?php
							}
							?>
							
							</table>
						</div>
 
	                 </div>                   
					
					<div class="tab-pane" id="tab_upgrade">
						
					<?php
						if($iv_gateway=='woocommerce'){
						?>
			<form class="form-group"  name="profile_upgrade_form" id="profile_upgrade_form" action="<?php  the_permalink() ?>?&payment_gateway=woocommerce&iv-submit-upgrade=upgrade" method="post">

				<div class=" row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','epphotographer')	;?></label>
						<div class="col-md-8 col-xs-8 col-sm-8 ">
							<?php
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft'";
								$membership_pack = $wpdb->get_results($sql);
								$total_package=count($membership_pack);
								//echo'$total_package.....'.$total_package;
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
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','epphotographer')	;?></label>

								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount">
									<?php  echo $amount.' '.$recurring_text; ?>

								</div>
						</div>


								<div class="row form-group">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
									<div class="col-md-8 col-xs-8 col-sm-8 " > 	<div id="loading"> </div>
										<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">
										<input type="hidden" name="coupon_code" id="coupon_code" value="">
										<button class="btn green-haze" type="submit"> <?php  _e('Upgrade','epphotographer')	;?></button>
										<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									</div>

								</div>
						</form>
						 <?php
						 }				
						if($iv_gateway=='paypal-express'){							
						?>
			<form class="form-group"  name="profile_upgrade_form" id="profile_upgrade_form" action="<?php  the_permalink() ?>?&payment_gateway=paypal&iv-submit-upgrade=upgrade" method="post">
			
				<div class=" row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','falcons')	;?></label>
						<div class="col-md-8 col-xs-8 col-sm-8 "> 																				
							<?php
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft'";
								$membership_pack = $wpdb->get_results($sql);
								$total_package=count($membership_pack);
								//echo'$total_package.....'.$total_package;
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
						<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','falcons')	;?></label>
						
						<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> 									
							<?php  echo $amount.' '.$recurring_text; ?> 
							
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
								<div class="col-md-8" id="total"><label class="control-label">  <?php $package_amount=0;  $package_amount= (int)$package_amount+(int)$tax_total; echo $package_amount.''.$api_currency; ?></label>
								</div>										
						</div>		
						
                        
                       
								<div class="row form-group">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
									<div class="col-md-8 col-xs-8 col-sm-8 " > 	<div id="loading"> </div> 
										<input type="hidden" name="country_select" id="country_select" value="<?php echo $country_id; ?>">	
										<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
										<input type="hidden" name="coupon_code" id="coupon_code" value="">	
										<button class="btn green-haze" type="submit"> <?php  esc_html_e('Upgrade','falcons')	;?></button>
										<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									</div>
									
								</div>	
						</form> 
						 <?php
						 }
																			
						if($iv_gateway=='stripe'){ ?>
							<form class="form"  name="profile_upgrade_form" id="profile_upgrade_form" action="" method="post">
						<?php	
							include(wp_iv_directories_template.'private-profile/iv_stripe_form_upgrade.php');
								$arb_status =	get_user_meta($current_user->ID, 'iv_directories_payment_status', true);
								$cust_id = get_user_meta($current_user->ID,'iv_directories_stripe_cust_id',true);
								$sub_id = get_user_meta($current_user->ID,'iv_directories_stripe_subscrip_id',true);	
							?>
							
							<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
							<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
							
						</form>
						<?php		
							}
							?>
						<div class=" row bs-callout bs-callout-info">
						<?php  esc_html_e('Note: Your Successful Upgrade or Downgrade will affect on your user role immediately.','falcons')	;?>						
							
						</div>
					</div>
					<div class="tab-pane" id="tab_cancel">
								<?php
									$payment_gateway=get_user_meta($current_user->ID, 'iv_directories_payment_gateway', true);
									if($payment_gateway=='paypal-express'){	
										$arb_status =	get_user_meta($current_user->ID, 'iv_directories_payment_status', true);
										$profile_id = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
											if($arb_status!='cancel'  && $profile_id!='' ){											?>
													<div class="" id="update_message_paypal"></div>
													<div id="paypal_cancel_div" name="paypal_cancel_div">
															<form class="form" role="form"  name="paypal_cancel_form" id="paypal_cancel_form" action="" method="post">
																<input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">	
																<div class="form-group">
																<label class="control-label"><?php  esc_html_e('Cancel Reason','falcons')	;?></label>
																<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder="<?php  esc_html_e('Canceling Reason','falcons')	;?>"  ></textarea>
															  </div>
																
																<div class="margiv-top-10">
																	<div class="" id="update_message"></div>
																	
																	<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_paypal();"><?php  esc_html_e('Cancel Membership','falcons')	;?></button>
															  
															  </div>	
																					  
														  </form>  
														</div>    
											<?php
											}else{ ?>
											
												<div class="form-group">
															<label class="control-label"><?php  esc_html_e('Nothing to Cancel','falcons')	;?></label>
															
												</div>
											<?php
											}
						
									}
									if($payment_gateway=='stripe'){
											
											
											
											$arb_status =	get_user_meta($current_user->ID, 'iv_directories_payment_status', true);
											$cust_id = get_user_meta($current_user->ID,'iv_directories_stripe_cust_id',true);
											$sub_id = get_user_meta($current_user->ID,'iv_directories_stripe_subscrip_id',true);
											
											if($arb_status!='cancel'  && $sub_id!='' ){										?>
														<div class="" id="update_message_stripe"></div>
														<div id="stripe_cancel_div" name="stripe_cancel_div">
																<form class="form" role="form"  name="profile_cancel_form" id="profile_cancel_form" action="<?php  the_permalink() ?>" method="post">		
																<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
																<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">																	
																	<div class="form-group">
																	<label class="control-label"><?php  esc_html_e('Cancel Reason','falcons')	;?></label>
																	<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder="<?php  esc_html_e('Canceling Reason','falcons')	;?>"  ></textarea>
																  </div>															
																	
																	<div class="margiv-top-10">
																		
																		<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_stripe();"><?php  esc_html_e('Cancel Membership','falcons')	;?></button>
																   </div>
																	
																</form>
														</div>
												<?php
												}else{ ?>
												
												<div class="form-group">
															<label class="control-label"><?php  esc_html_e('Nothing to Cancel','falcons')	;?>.</label>
															
														  </div>
												<?php
												}
										
									
									}	
								?>
								
					</div>
                  </div>
                </div>
              </div>
            </div>
   <script>  
   function iv_cancel_membership_paypal (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_paypal').html(loader_image);
					var search_params={
						"action"  : 	"iv_directories_cancel_paypal",	
						"form_data":	jQuery("#paypal_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							if(response.code=='success'){
								jQuery('#paypal_cancel_div').hide(); 
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}else{
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}
							
						}
						
					});
		}			
	
	}        
  function iv_cancel_membership_stripe (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_stripe').html(loader_image);
					var search_params={
						"action"  : 	"iv_directories_cancel_stripe",	
						"form_data":	jQuery("#profile_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							jQuery('#stripe_cancel_div').hide(); 
							jQuery('#update_message_stripe').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
						}
					});
		}			
	
	}
 </script>	
<script>
jQuery(function(){	
	jQuery('#package_sel').on('change', function (e) {
		
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params={
		"action"  			: "iv_directories_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:'',
		"form_data"			:jQuery("#profile_upgrade_form").serialize(),
		"api_currency" 		:'<?php echo $currencyCode; ?>',
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="<?php echo wp_iv_directories_URLPATH; ?>admin/files/images/right_icon.png">');
				}else{
						jQuery('#coupon-result').html('<img src="<?php echo wp_iv_directories_URLPATH; ?>admin/files/images/wrong_16x16.png">');
				}
				
				jQuery('#p_amount').html(response.p_amount);							
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);							
				
			}
			});
		});	
	});	
</script>	
 
          <!-- END PROFILE CONTENT -->
        
