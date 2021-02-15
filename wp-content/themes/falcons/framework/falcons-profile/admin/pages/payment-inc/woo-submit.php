<?php		
global $wpdb;

	if( isset($_REQUEST['payment_gateway']) && $_REQUEST['iv-submit-listing']=='register' && $_REQUEST['payment_gateway']=='woocommerce'){	 
		 
if(class_exists('WooCommerce' ) ) {  
  
		$package_id='';
		$package_id=$_POST['package_id'];
			//create user here******		
						
				
		$userdata = array();
		$user_name='';
		if(isset($_POST['iv_member_user_name'])){
			$userdata['user_login']=$_POST['iv_member_user_name'];
		}					
		if(isset($_POST['iv_member_email'])){
			$userdata['user_email']=$_POST['iv_member_email'];
		}					
		if(isset($_POST['iv_member_password'])){
			$userdata['user_pass']=$_POST['iv_member_password'];
		}
		if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							
							 $role_package= get_post_meta( $package_id,'iv_directories_package_user_role',true); 
							 $user_id = wp_insert_user( $userdata ) ;
							 $user = new WP_User( $user_id );
							 //$user->set_role($iv_directories_payment_gateway);
							 $user->set_role('basic');
							 $userId=$user_id;
														
							 update_user_meta($user_id, 'iv_directories_package_id',$package_id);
							
							 
							$default_fields = array();
							$default_fields=get_option('iv_directories_profile_fields');
							$sign_up_array=get_option( 'iv_directories_signup_fields');							
							if(is_array($default_fields)){
								 foreach ( $default_fields as $field_key => $field_value ) { 									 
										$sign_up='no';
										if(isset($sign_up_array[$field_key]) && $sign_up_array[$field_key] == 'yes') {
												$sign_up='yes';
										}
										if($sign_up=='yes'){	 
											update_user_meta($user_id,$field_key, $_POST[$field_key] );
										}
								  }
							}	  
							 
							 
							require_once( wp_iv_directories_ABSPATH. 'inc/signup-mail.php');
							 // Add to cart****************							
							//login
							
							
							
							$user = get_user_by( 'id', $userId );
							
							wp_set_current_user($userId, $user->user_login);							
							wp_set_auth_cookie($userId);
							
							do_action('wp_login', $user->user_login, $user);
							
							 
							 
							$product_id= get_post_meta( $package_id,'iv_directories_package_woocommerce_product',true); 
							$iv_directories_package_cost= get_post_meta( $package_id,'iv_directories_package_cost',true);
							$iv_directories_package_recurring= get_post_meta( $package_id,'iv_directories_package_recurring',true);
							
							$package_cost=$iv_directories_package_cost;
							// Cheek here Coupon ************
							$trial_enable= 'no';
							if( $iv_directories_package_recurring=='on'  ){
								$package_cost=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);			
							}	
							if($package_cost >0){  
									 
								update_user_meta($user_id, 'iv_directories_payment_woo','woo_new');
							
								global $woocommerce;
								//do_action( 'woocommerce_ajax_added_to_cart', $product_id );
								$woocommerce->cart->empty_cart();
								$qty=1;
								$woocommerce->cart->add_to_cart($product_id,$qty);
								$url_checkout = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
								wp_redirect( $url_checkout );
								exit;
							
							}else{
								 
							 $expire_interval = get_post_meta($package_id, 'iv_directories_package_initial_expire_interval', true);						
							 $initial_expire_type = get_post_meta($package_id, 'iv_directories_package_initial_expire_type', true);
							 if($expire_interval!='' AND $initial_expire_type!=''){
									$exp_periodNum = (60 * 60 * 24 * 90);
									
									switch ($initial_expire_type) {
										case 'year':
											$exp_periodNum = (60 * 60 * 24 * 365) * $expire_interval;
											break;
										case 'month':
											$exp_periodNum = (60 * 60 * 24 * 30) * $expire_interval;
											break;
										case 'week':
											$exp_periodNum = (60 * 60 * 24 * 7) * $expire_interval;
											break;
										case 'day':
											$exp_periodNum = (60 * 60 * 24) * $expire_interval;
											break;
									}
									$exp_time = time() + $exp_periodNum;
									$exp_d = date('Y-m-d',$exp_time).'T'.'00:00:00Z';
							 }else{
							 
								$exp_d=date('Y-m-d', strtotime('+19 year'));
							 } 	
							 $role_package= get_post_meta( $package_id,'iv_directories_package_user_role',true);	
							 $user->set_role($role_package);					  
							 
							 update_user_meta($user_id, 'iv_directories_payment_status','success');							
							 update_user_meta($user_id, 'iv_directories_exprie_date',$exp_d); 
							 update_user_meta($user_id, 'iv_directories_package_id',$package_id);
								
								// success Page
								$iv_redirect = get_option( '_iv_directories_thank_you_page');
									if(trim($iv_redirect)!=''){
										$reg_page= get_permalink( $iv_redirect); 
										wp_redirect( $reg_page );
										exit;
									}
							
							}	
							 
						} else {
							$iv_redirect = get_option( '_iv_directories_registration');
							if(trim($iv_redirect)!=''){
								$reg_page= get_permalink( $iv_redirect).'?&package_id='.$package_id.'&message-error=User_or_Email_Exists'; 
								wp_redirect( $reg_page );
								exit;
							}	
							
						}
						
		}		
			
		if($userdata['user_login']=='' or $userdata['user_email']=='' or $userdata['user_pass']=='' ){
			$iv_redirect = get_option( '_iv_directories_registration');
				if(trim($iv_redirect)!=''){
					$reg_page= get_permalink( $iv_redirect).'?&package_id='.$package_id.'&message-error=exists'; 
					wp_redirect( $reg_page );
					exit;
				}	
		}	
			//create user End******
	
	
	}
	
}

//******************
// Upgrade*******************************************************
//**********************

if(isset($_REQUEST['iv-submit-upgrade']) &&  isset($_REQUEST['payment_gateway']) && $_REQUEST['iv-submit-upgrade']=='upgrade' && $_REQUEST['payment_gateway']=='woocommerce'){	 
		
if(class_exists('WooCommerce' ) ) { 

		$package_id=''; $current_user = wp_get_current_user();
		$user_id=$current_user->ID;
		$package_id=$_REQUEST['package_id'];
		
		
			//create user here******	
			
														
				update_user_meta($user_id, 'epfuture_package_id',$package_id);
				update_user_meta($user_id, 'iv_directories_package_id',$package_id);
				update_user_meta($user_id, 'iv_directories_payment_woo','woo_update');
				
					
				
				 // Add to cart****************							
				//login
			
				$user = get_user_by( 'id', $user_id );								 
				$product_id= get_post_meta( $package_id,'iv_directories_package_woocommerce_product',true); 
				
				
				global $woocommerce;
				//do_action( 'woocommerce_ajax_added_to_cart', $product_id );
				$woocommerce->cart->empty_cart();
				$qty=1;
				$woocommerce->cart->add_to_cart($product_id,$qty);					
																
				 $url_checkout = get_permalink( get_option( 'woocommerce_checkout_page_id' ) ); 
				 wp_redirect( $url_checkout );
				 exit;
	
	}
	
}

