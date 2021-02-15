										<div class="row form-group">
										<label  class="col-md-3 control-label"><?php  esc_html_e('Package Name','falcons');?></label>
										<div class="col-md-9"> 																				
											<?php
											$tax_total=0;
											 $recurring_text=''; 
											 if( $package_name==""){												

												$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
												$membership_pack = $wpdb->get_results($sql);
												$total_package = count($membership_pack);
												
												
												if(sizeof($membership_pack)>0){
													$i=0;
													echo'<select name="package_sel" id ="package_sel" class=" form-control">';
													
													foreach ( $membership_pack as $row )
													{	
														
														echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
														if($i==0){$package_id=$row->ID;}
														$i++;
													}	
																		
													echo '</select>';	
													$package_id= $membership_pack[0]->ID;
													$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);	
													if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);
													}else{
														$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
													}	
													?>
									
													<?php
												}	
													
												
											 }else{
												 
												
												echo '<label class=""> '.$package_name.'</label>';
												$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);
												if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);
													}else{
														$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
												}
												
											}
											
											
											
											 ?>
											</div>
										
										</div>
							<div class="row form-group">
								<label  class="col-md-3 control-label"><?php  esc_html_e('Amount','falcons');?></label>
								
								
								<div class="col-md-9" id="p_amount"> <label class="control-label"><?php echo $package_amount.' '.$api_currency ; ?> </label>
								</div>										
							</div>
							<?php
								
							 if( get_option('_iv_directories_payment_coupon')==""){
							?>
							<div class="row form-group" id="show_hide_div">
								<label  class="col-md-3 control-label"></label>
								<div class="col-md-9" > 
									<button type="button" onclick="show_coupon();"  class="btn btn-default"><?php  esc_html_e('Have a coupon?','falcons');?></button>
								</div>
							</div>
							<?php
								include(wp_iv_directories_template.'signup/coupon_form_2.php');
							
							}
							?>
							<?php
							if($tax_active_module=='yes'){
							?>
							<div class="row form-group">
								<label  class="col-md-3 control-label"><?php  esc_html_e('Vat/Tax','falcons');?></label>												
																				
								<div class="col-md-9" id="tax">  
									
									<?php 
										$tax_total=0;
										$tax_type= get_option('_iv_tax_type');
										$tax_active_module=get_option('_iv_directories_active_tax');
										
										if($tax_active_module=='' ){ $tax_active_module='yes';	}					
										if($tax_type==''){$tax_type='country';}
											
										if($tax_active_module=='yes' AND $tax_type=='country'){						
											$countries_tax_array= (get_option('_iv_countries_tax')!="" ? get_option('_iv_countries_tax') : array() );
											$country_id= (isset($first_country)? $first_country:'0');
											if(array_key_exists($country_id , $countries_tax_array)){							
												 $country_tax_value= $countries_tax_array[$country_id];
												 $tax_total=$package_amount * $country_tax_value/100;
											}
										}
										if($tax_active_module=='yes' AND $tax_type=='common'){						
											$common_tax_value= get_option('_iv_comman_tax_value');						
											$tax_total=$package_amount * $common_tax_value/100;
											
										}
													echo '<label class="control-label">'.$tax_total.''.$api_currency.'</label>'; 
										
										?>
								</div>										
							</div>
							<?php
							}	
							?>
							<div class="row form-group">
								<label  class="col-md-3 control-label"><?php  esc_html_e('Total','falcons');?></label>												
																				
								<div class="col-md-9" id="total"><label class="control-label">  <?php  $package_amount= (int)$package_amount+(int)$tax_total; echo $package_amount.''.$api_currency; ?></label>
								</div>										
							</div>
							
								
								<input type="hidden" name="reg_error" id="reg_error" value="yes">
								<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
								
								<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
								<?php
									$iv_directories_payment_terms=get_option('iv_directories_payment_terms'); 
									$term_text='I have read & accept the <a href="#"> Terms & Conditions</a>';
									if( get_option( 'iv_directories_payment_terms_text' ) ) {
										$term_text= get_option('iv_directories_payment_terms_text'); 
									}
									if($iv_directories_payment_terms=='yes'){
									?>
							
								<div class="row">
									<div class="col-md-3 "> 
									</div>
											<div class="col-md-9 term-condition"> 
										<label>
										  <input type="checkbox" data-validation="required" 
		 data-validation-error-msg="You have to agree to our terms "  name="check_terms" id="check_terms"> <?php echo $term_text; ?>
										</label>
										
										      
									  </div>									
								</div>
																				
								<?php
								}	 
										 
								?>	
																	
						<div class="row">
							<div class="col-md-3 "> 
							</div>
							<div class="col-md-9 "> 
							
							<div id="paypal-button">
								<?php 
								 $p_amount=$package_amount;
								 $recurring=get_post_meta($package_id, 'iv_directories_package_recurring',true);
								 
								 if($package_amount=="0" or trim($package_amount)=="" ){
									 if($recurring=='on'){
											$p_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial',true); 
										}
									 
								  }else{
									 $p_amount=$package_amount;
									}			
								 if($package_name!="" AND $p_amount=='0' ){ ?>
									<div id="loading-3" style="display: none;"><img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
									<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment"  type="submit" class="btn-new btn-custom ctrl-btn"  > <?php  esc_html_e('Submit','falcons');?></button>
									
								<?php
								}else{	
									?>
									<div id="loading-3" style="display: none;"><img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
								<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment" type="submit" class="btn-new btn-custom ctrl-btn"  ><?php  esc_html_e('Submit','falcons');?>  </button>
								
								<?php 
									}
								?>
								
							</div>	
							
							</div>										
						</div>		
						
						
	
