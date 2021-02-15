<?php
$exprie_date= strtotime (get_user_meta($userId, 'iv_directories_exprie_date', true));
$current_date=strtotime(date('Y-m-d'));
$user_id  = get_current_user_id();	

$user_id=$current_user->ID;
$user = new WP_User( $userId );									
if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	foreach ( $user->roles as $role ){
		$crole= ucfirst($role); 
		break;
	}	
}		
				
$iv_directories_package_recurring= get_post_meta( $package_id,'iv_directories_package_recurring',true);	
if( $iv_directories_package_recurring=='on'  ){
		
		if ( class_exists( 'WC_Subscriptions' ) ) { 		
			$subscriptions = wcs_get_users_subscriptions();
																					
			foreach ( $subscriptions as $subscription_id => $subscription ) {
				 $payment_status=  esc_attr( wcs_get_subscription_status_name( $subscription->get_status() ) );
				 $status_result=1;
			}											
		}
		
		$payment_status=strtolower($payment_status);
		if($payment_status=='active'){				
					$recurring_cycle_count= get_post_meta($package_id,'iv_directories_package_recurring_cycle_count',true);
					if($recurring_cycle_count=="" or $recurring_cycle_count==0){$recurring_cycle_count=1;}
					 $recurring_cycle_type= get_post_meta($package_id,'iv_directories_package_recurring_cycle_type',true);
					
				$periodNum='';
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
			update_user_meta($userId, 'iv_directories_exprie_date', $new_exp_date);		
		}
}else{
	update_user_meta($userId, 'iv_directories_payment_status', 'pending');
	$user = new WP_User( $userId );									
	
	if($crole!='Administrator'){
		$user->set_role('basic');
	}

}	
