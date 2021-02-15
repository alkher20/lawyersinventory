<?php
global $wpdb;	
		
	
		$admin_mail = get_option('admin_email');	
		if( get_option( 'admin_email_iv_directories' )==FALSE ) {
			$admin_mail = get_option('admin_email');						 
		}else{
			$admin_mail = get_option('admin_email_iv_directories');								
		}						
	
	$wp_title = get_bloginfo();
					
	parse_str($_POST['form_data'], $form_data);
	
	// Email for Client	**************
	$email_body = get_option( 'falcons_contact_us_email_client');
	$contact_email_subject = get_option( 'falcons_contact_us_email_subject_client');			
					
	$visitor_email_address=$form_data['contact_email'];	
	
	$email_body = str_replace("[client_name]", $form_data['contact_name'], $email_body);
			
	$auto_subject=  $contact_email_subject; 	
	$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Reply-To: ".$visitor_email_address  ,"Content-Type: text/html");
	
		
		$h = implode("\r\n", $headers) . "\r\n";
		wp_mail($visitor_email_address, $auto_subject, $email_body, $h);
	
	// Admin Section*********************
	
	$email_body = get_option( 'falcons_contact_us_email');
	$contact_email_subject = get_option( 'falcons_contact_us_email_subject');			
					
	$visitor_email_address=$form_data['contact_email'];	
	
	$email_body = str_replace("[iv_member_name]", $form_data['contact_name'], $email_body);
	$email_body = str_replace("[iv_member_user_email]", $form_data['contact_email'], $email_body);
	$email_body = str_replace("[iv_member_message]", $form_data['contact_content'], $email_body);
			
	$auto_subject=  $contact_email_subject; 	
	$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Reply-To: ".$visitor_email_address  ,"Content-Type: text/html");
	
			$h = implode("\r\n", $headers) . "\r\n";
			wp_mail($admin_mail, $auto_subject, $email_body, $h);	
	
	
