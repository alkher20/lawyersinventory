<?php
$userId=$current_user->ID;
$user_id=$current_user->ID;
$user = new WP_User( $userId );									
if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	foreach ( $user->roles as $role ){
		$crole= ucfirst($role); 
		break;
	}	
}

						if ( class_exists( 'WC_Subscriptions' ) ) { 
								//WC_Subscriptions::get_my_subscriptions_template();
								$subscriptions = wcs_get_users_subscriptions();
								$user_id       = get_current_user_id();																					
								foreach ( $subscriptions as $subscription_id => $subscription ) {
									 $payment_status=  esc_attr( wcs_get_subscription_status_name( $subscription->get_status() ) );
									 $status_result=1;
								}											
						 }
					if($status_result==0){ 
						$order_statuses = array('wc-on-hold', 'wc-processing', 'wc-completed');
						
						$customer_orders = get_posts( array(
						'meta_key'    => '_customer_user',
						'meta_value'  => $user_id,
						'post_type'   => 'shop_order',
						'post_status' => $order_statuses,
						'numberposts' => -1
						));
						$got_status='';
						$package_product_id= get_post_meta( $package_id,'iv_directories_package_woocommerce_product',true);
						foreach($customer_orders as $customer_order){													
							$order = wc_get_order($customer_order->ID);
							$order_stat = new WC_Order( $customer_order->ID );																			
							foreach($order->get_items() as $item_id => $item_values){												
								$product_id = $item_values['product_id'];
								
								if($product_id==$package_product_id){ 
									if($order_stat->has_status( 'completed' )){
										$payment_status= 'completed';  
									}
									else{
										 $payment_status='Processing';  
									}
									$got_status='1';														
									break;
								}												
							}
								if($got_status=='1'){   
									break;
								}
							}
						}
							//[STATUS] => Active
							$payment_status=strtolower($payment_status);
								if($payment_status=='completed' OR $payment_status=='active'){
									$package_id=get_user_meta($userId, 'iv_directories_package_id', true);
									$role_package= get_post_meta( $package_id,'iv_directories_package_user_role',true);

									update_user_meta($userId, 'iv_directories_payment_status', 'success');
									update_user_meta($userId, 'iv_directories_payment_woo', 'success');
									
									$user = new WP_User( $userId );
									
									if($crole!='Administrator'){
										$user->set_role($role_package);
									}
									// Change exprie_date
					
										
										$iv_directories_exprie_date_old =get_user_meta($userId,'iv_directories_exprie_date',true);
										$iv_directories_package_recurring= get_post_meta( $package_id,'iv_directories_package_recurring',true);			
		
										if($iv_directories_package_recurring=='on'){
											$recurring_cycle_count= get_post_meta($package_id,'iv_directories_package_recurring_cycle_count',true);
											if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
											 $recurring_cycle_type= get_post_meta($package_id,'iv_directories_package_recurring_cycle_type',true);
										}else{
											$recurring_cycle_count = get_post_meta($package_id, 'iv_directories_package_initial_expire_interval', true);						
											$recurring_cycle_type = get_post_meta($package_id, 'iv_directories_package_initial_expire_type', true);
											
										}
										
										$periodNum='';
										if($recurring_cycle_count!='' AND $recurring_cycle_count!=''){
											switch ($recurring_cycle_type) {
												case 'year':
													$periodNum = (60 * 60 * 24 * 365) * $recurring_cycle_count;
													break;
												case 'month':
													$periodNum = (60 * 60 * 24 * 30) * $recurring_cycle_count;
													break;
												case 'week':
													$periodNum = (60 * 60 * 24 * 7) * $recurring_cycle_count;
													break;
												case 'day':
													$periodNum = (60 * 60 * 24) * $recurring_cycle_count;
													break;
											}
											$timeToBegin = time() + $periodNum;
											$date_n = date('Y-m-d',$timeToBegin).'T'.'00:00:00Z';

											$new_exp_date=  date("Y-m-d", strtotime($date_n));
									}else{
										$new_exp_date=date('Y-m-d', strtotime('+19 year'));
									
									}
										update_user_meta($userId, 'iv_directories_exprie_date', $new_exp_date);
									


								}else{
									update_user_meta($userId, 'iv_directories_payment_status', 'pending');
									$user = new WP_User( $userId );									
									
									if($crole!='Administrator'){
										$user->set_role('basic');
									}
								}
