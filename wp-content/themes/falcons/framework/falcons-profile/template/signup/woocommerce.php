
										<div class="row form-group">
										<label for="text" class="col-md-3"><?php  _e('Package Name','epphotographer');?></label>
										<div class="col-md-9">
											<?php
											 $recurring_text='';
											 $api_currency= get_option( 'woocommerce_currency' );
											 if($api_currency==''){$api_currency= 'USD';}
											 if( $package_name==""){

												$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
												$membership_pack = $wpdb->get_results($sql);
												$total_package = count($membership_pack);


												if(sizeof($membership_pack)>0){
													$i=0;
													echo'<select name="package_sel" id ="package_sel" class=" form-control-solid">';

													foreach ( $membership_pack as $row )
													{

														$srecurring= get_post_meta($row->ID, 'iv_directories_package_recurring', true);

														if($srecurring == 'on'){
															$spackage_amount=' | '.get_post_meta($row->ID, 'iv_directories_package_recurring_cost_initial', true).' '.$api_currency.'/'.get_post_meta($row->ID, 'iv_directories_package_recurring_cycle_count', true).' '.get_post_meta($row->ID, 'iv_directories_package_recurring_cycle_type', true);

														}else{
																$spackage_amount=' | '.(get_post_meta($row->ID, 'iv_directories_package_cost',true)=='' || get_post_meta($row->ID, 'iv_directories_package_cost',true)==0 ?'0':get_post_meta($row->ID, 'iv_directories_package_cost',true) ).' '.$api_currency;


														}

														echo '<option value="'. $row->ID.'" >'. $row->post_title.''.$spackage_amount.'</option>';
														if($i==0){$package_id=$row->ID;}
														$i++;
													}

													echo '</select>';
													$package_id= $membership_pack[0]->ID;
													$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);
													if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true).' '.$api_currency.'/'.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_count', true).' '.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_type', true);
													}else{
														$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true).' '.$api_currency;
													}
													?>

													<?php
												}


											 }else{


												echo '<label class=""> '.$package_name.'</label>';
												$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);
												if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true).' '.$api_currency.'/'.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_count', true).' '.get_post_meta($package_id, 'iv_directories_package_recurring_cycle_type', true);

													}else{
														$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true).' '.$api_currency;
												}

											}



											 ?>
											</div>

										</div>
							<div class="row form-group">
								<label for="text" class="col-md-3"><?php  _e('Amount','epphotographer');?></label>


								<div class="col-md-9" id="p_amount"> <label class="control-label"><?php echo $package_amount ; ?> </label>
								</div>
							</div>
							


								<input type="hidden" name="reg_error" id="reg_error" value="yes">
								<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">
							
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
											<div class="col-md-9 ">
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
							<div class="col-md-3">
							</div>
							<div class="col-md-9 ">

							<div id="paypal-button" class="margin-top-20">
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
									<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment"  type="submit" class="btn-new btn-custom ctrl-btn"  > <?php  _e('Submit','epphotographer');?></button>

								<?php
								}else{
									?>
									<div id="loading-3" style="display: none;"><img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
								<button  id="submit_iv_directories_payment" name="submit_iv_directories_payment" type="submit" class="btn btn-info ctrl-btn"  ><?php  _e('Submit','epphotographer');?>  </button>

								<?php
									}
								?>

							</div>

							</div>
						</div>



