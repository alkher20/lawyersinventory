<?php
global $wpdb;
wp_enqueue_script('iv_directories-script-signup-2-15', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');
wp_enqueue_style('profile-signup-style', falcons_CSS.'profile-registration.css', array(), $ver = false, $media = 'all');


$api_currency= 'USD';
if( get_option('_iv_directories_api_currency' )!=FALSE ) {
	$api_currency= get_option('_iv_directories_api_currency' );
}	
if(isset($_REQUEST['payment_gateway'])){
	
		$payment_gateway=$_REQUEST['payment_gateway'];
		if($payment_gateway=='paypal'){
			//include(wp_iv_directories_DIR . '/admin/pages/payment-inc/paypal-submit.php');
							
		}
}

		$iv_gateway='paypal-express';
		if( get_option( 'iv_directories_payment_gateway' )!=FALSE ) {
			$iv_gateway = get_option('iv_directories_payment_gateway');	
				   if($iv_gateway=='paypal-express'){
						$post_name='iv_directories_paypal_setting';						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						$paypal_id='0';
						if(isset($row->ID )){
							$paypal_id= $row->ID;
						}
						$api_currency=get_post_meta($paypal_id, 'iv_directories_paypal_api_currency', true);	
					}				 
		}
		$package_id=''; 
		if(isset($_REQUEST['package_id'])){
			$package_id=$_REQUEST['package_id'];
			
			$recurring= get_post_meta($package_id, 'iv_directories_package_recurring', true);	
			if($recurring == 'on'){
				$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);
			}else{
				$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
			}
		
			if($package_amount=='' || $package_amount=='0' ){$iv_gateway='paypal-express';}
																					
		}
	
		$form_meta_data= get_post_meta( $package_id,'iv_directories_content',true);			
		$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
		$package_name='';
		$package_amount='';
		if(isset($row->post_title)){
			$package_name=$row->post_title;
			$count =get_post_meta($package_id, 'iv_directories_package_recurring_cycle_count', true);
			
			
			$package_name=$package_name;
																
			$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
		}
		
	$newpost_id='';
	$post_name='iv_directories_stripe_setting';
	$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
				if(isset($row->ID )){
				  $newpost_id= $row->ID;
				}
	$stripe_mode=get_post_meta( $newpost_id,'iv_directories_stripe_mode',true);	
	if($stripe_mode=='test'){
		$stripe_publishable =get_post_meta($newpost_id, 'iv_directories_stripe_publishable_test',true);	
	}else{
		$stripe_publishable =get_post_meta($newpost_id, 'iv_directories_stripe_live_publishable_key',true);	
	}
				 
								
?>

<div class="registration-style">
<div class="row">

	<div id="iv-form3" class="col-md-12">
		<?php
			if($iv_gateway=='paypal-express'){	
			 ?>
		
				<form id="iv_directories_registration" name="iv_directories_registration" class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form">
		
		<?php	
		}
		if($iv_gateway=='woocommerce'){
		?>
		<form id="iv_directories_registration" name="iv_directories_registration" class="form-horizontal" action="<?php  the_permalink() ?>?&payment_gateway=woocommerce&iv-submit-listing=register" method="post" role="form">
		<?php
		}
		if($iv_gateway=='stripe'){?>
				<form id="iv_directories_registration" name="iv_directories_registration" class="form-horizontal" action="<?php  the_permalink() ?>?&package_id=<?php echo $package_id; ?>&payment_gateway=stripe&iv-submit-stripe=register" method="post" role="form">
				
				<input type="hidden" name="payment_gateway" id="payment_gateway" value="stripe">	
				<input type="hidden" name="iv-submit-stripe" id="iv-submit-stripe" value="register">	
		<?php	
		}
		?>	
		
					 
			<div class="content"> 
			<h3  class="form-title"><?php  esc_html_e('User Information','falcons');?></h3>
					  
			<div class="form-content">
		
			<div class="row">	
				  
           
          <div class="col-md-12"> 
						<?php
							 if(isset($_REQUEST['message-error'])){?>
							  <div class="row alert alert-info alert-dismissable" id='loading-2'><a class="panel-close close" data-dismiss="alert">x</a> <?php  echo $_REQUEST['message-error']; ?></div>
							  <?php
							  }
						?>
					
	<!--  
		For Form Validation we used plugins http://formvalidator.net/index.html#reg-form  
		This is in line validation so you can add fields easily. 	
	-->

				
				<div>
						<div id="selected-column-1" class=" ">
						<div class="text-center" id="loading"> </div>
						<div class="form-group row"  >									
						<label  class="col-md-3 control-label"><?php  esc_html_e('User Name','falcons');?><span class="chili"></span></label>
						<div class="col-md-9">
							<input type="text"  name="iv_member_user_name"  data-validation="length alphanumeric" 
data-validation-length="4-12" data-validation-error-msg="<?php  esc_html_e(' The user name has to be an alphanumeric value between 4-12 characters','falcons');?>" class="form-control ctrl-textbox" placeholder="Enter User Name"  >

						</div>
					</div>
					<div class="form-group row">									
						<label  class="col-md-3 control-label" ><?php  esc_html_e('Email Address','falcons');?><span class="chili"></span></label>
						<div class="col-md-9">
							<input type="email" name="iv_member_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="Enter email address" data-validation-error-msg="<?php  esc_html_e('Please enter a valid email address','falcons');?> " >
						</div>
					</div>
					<div class="form-group row ">									
						<label  class="col-md-3 control-label"><?php  esc_html_e('Password','falcons');?><span class="chili"></span></label>
						<div class="col-md-9">
							<input type="password" name="iv_member_password"  class="form-control ctrl-textbox" placeholder="" data-validation="strength" 
		 data-validation-strength="2">
						</div>
					</div>
					<?php
					$tax_type= (get_option('_iv_tax_type')!=""?get_option('_iv_tax_type'):"country");
					$tax_active_module=get_option('_iv_directories_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}
					$country_show=0;
					if($tax_type=='country'){
					 $country_show=1;
					}else{
						$country_show=0;
					}
					if($tax_active_module=='yes' AND $country_show==1){
					?>
					<div class="form-group row ">									
						<label  class="col-md-3 control-label"><?php  esc_html_e('Country','falcons');?><span class="chili"></span></label>
						<div class="col-md-9">
							<select name="country_select" id ="country_select" class=" form-control" data-validation="required" 
		 data-validation-error-msg="<?php  esc_html_e('Please select your country','falcons');?>">
								<?php
								/*$countries = array(
									"AF" => "Afghanistan (‫افغانستان‬‎)",
									"AX" => "Åland Islands (Åland)",
									"AL" => "Albania (Shqipëri)",
									"DZ" => "Algeria (‫الجزائر‬‎)",
									"AS" => "American Samoa",
									"AD" => "Andorra",
									"AO" => "Angola",
									"AI" => "Anguilla",
									"AQ" => "Antarctica",
									"AG" => "Antigua and Barbuda",
									"AR" => "Argentina",
									"AM" => "Armenia (Հայաստան)",
									"AW" => "Aruba",
									"AC" => "Ascension Island",
									"AU" => "Australia",
									"AT" => "Austria (Österreich)",
									"AZ" => "Azerbaijan (Azərbaycan)",
									"BS" => "Bahamas",
									"BH" => "Bahrain (‫البحرين‬‎)",
									"BD" => "Bangladesh (বাংলাদেশ)",
									"BB" => "Barbados",
									"BY" => "Belarus (Беларусь)",
									"BE" => "Belgium (België)",
									"BZ" => "Belize",
									"BJ" => "Benin (Bénin)",
									"BM" => "Bermuda",
									"BT" => "Bhutan (འབྲུག)",
									"BO" => "Bolivia",
									"BA" => "Bosnia and Herzegovina (Босна и Херцеговина)",
									"BW" => "Botswana",
									"BV" => "Bouvet Island",
									"BR" => "Brazil (Brasil)",
									"IO" => "British Indian Ocean Territory",
									"VG" => "British Virgin Islands",
									"BN" => "Brunei",
									"BG" => "Bulgaria (България)",
									"BF" => "Burkina Faso",
									"BI" => "Burundi (Uburundi)",
									"KH" => "Cambodia (កម្ពុជា)",
									"CM" => "Cameroon (Cameroun)",
									"CA" => "Canada",
									"IC" => "Canary Islands (islas Canarias)",
									"CV" => "Cape Verde (Kabu Verdi)",
									"BQ" => "Caribbean Netherlands",
									"KY" => "Cayman Islands",
									"CF" => "Central African Republic (République centrafricaine)",
									"EA" => "Ceuta and Melilla (Ceuta y Melilla)",
									"TD" => "Chad (Tchad)",
									"CL" => "Chile",
									"CN" => "China (中国)",
									"CX" => "Christmas Island",
									"CP" => "Clipperton Island",
									"CC" => "Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))",
									"CO" => "Colombia",
									"KM" => "Comoros (‫جزر القمر‬‎)",
									"CD" => "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)",
									"CG" => "Congo (Republic) (Congo-Brazzaville)",
									"CK" => "Cook Islands",
									"CR" => "Costa Rica",
									"CI" => "Côte d’Ivoire",
									"HR" => "Croatia (Hrvatska)",
									"CU" => "Cuba",
									"CW" => "Curaçao",
									"CY" => "Cyprus (Κύπρος)",
									"CZ" => "Czech Republic (Česká republika)",
									"DK" => "Denmark (Danmark)",
									"DG" => "Diego Garcia",
									"DJ" => "Djibouti",
									"DM" => "Dominica",
									"DO" => "Dominican Republic (República Dominicana)",
									"EC" => "Ecuador",
									"EG" => "Egypt (‫مصر‬‎)",
									"SV" => "El Salvador",
									"GQ" => "Equatorial Guinea (Guinea Ecuatorial)",
									"ER" => "Eritrea",
									"EE" => "Estonia (Eesti)",
									"ET" => "Ethiopia",
									"FK" => "Falkland Islands (Islas Malvinas)",
									"FO" => "Faroe Islands (Føroyar)",
									"FJ" => "Fiji",
									"FI" => "Finland (Suomi)",
									"FR" => "France",
									"GF" => "French Guiana (Guyane française)",
									"PF" => "French Polynesia (Polynésie française)",
									"TF" => "French Southern Territories (Terres australes françaises)",
									"GA" => "Gabon",
									"GM" => "Gambia",
									"GE" => "Georgia (საქართველო)",
									"DE" => "Germany (Deutschland)",
									"GH" => "Ghana (Gaana)",
									"GI" => "Gibraltar",
									"GR" => "Greece (Ελλάδα)",
									"GL" => "Greenland (Kalaallit Nunaat)",
									"GD" => "Grenada",
									"GP" => "Guadeloupe",
									"GU" => "Guam",
									"GT" => "Guatemala",
									"GG" => "Guernsey",
									"GN" => "Guinea (Guinée)",
									"GW" => "Guinea-Bissau (Guiné Bissau)",
									"GY" => "Guyana",
									"HT" => "Haiti",
									"HM" => "Heard & McDonald Islands",
									"HN" => "Honduras",
									"HK" => "Hong Kong (香港)",
									"HU" => "Hungary (Magyarország)",
									"IS" => "Iceland (Ísland)",
									"IN" => "India (भारत)",
									"ID" => "Indonesia",
									"IR" => "Iran (‫ایران‬‎)",
									"IQ" => "Iraq (‫العراق‬‎)",
									"IE" => "Ireland",
									"IM" => "Isle of Man",
									"IL" => "Israel (‫ישראל‬‎)",
									"IT" => "Italy (Italia)",
									"JM" => "Jamaica",
									"JP" => "Japan (日本)",
									"JE" => "Jersey",
									"JO" => "Jordan (‫الأردن‬‎)",
									"KZ" => "Kazakhstan (Казахстан)",
									"KE" => "Kenya",
									"KI" => "Kiribati",
									"XK" => "Kosovo (Kosovë)",
									"KW" => "Kuwait (‫الكويت‬‎)",
									"KG" => "Kyrgyzstan (Кыргызстан)",
									"LA" => "Laos (ລາວ)",
									"LV" => "Latvia (Latvija)",
									"LB" => "Lebanon (‫لبنان‬‎)",
									"LS" => "Lesotho",
									"LR" => "Liberia",
									"LY" => "Libya (‫ليبيا‬‎)",
									"LI" => "Liechtenstein",
									"LT" => "Lithuania (Lietuva)",
									"LU" => "Luxembourg",
									"MO" => "Macau (澳門)",
									"MK" => "Macedonia (FYROM) (Македонија)",
									"MG" => "Madagascar (Madagasikara)",
									"MW" => "Malawi",
									"MY" => "Malaysia",
									"MV" => "Maldives",
									"ML" => "Mali",
									"MT" => "Malta",
									"MH" => "Marshall Islands",
									"MQ" => "Martinique",
									"MR" => "Mauritania (‫موريتانيا‬‎)",
									"MU" => "Mauritius (Moris)",
									"YT" => "Mayotte",
									"MX" => "Mexico (México)",
									"FM" => "Micronesia",
									"MD" => "Moldova (Republica Moldova)",
									"MC" => "Monaco",
									"MN" => "Mongolia (Монгол)",
									"ME" => "Montenegro (Crna Gora)",
									"MS" => "Montserrat",
									"MA" => "Morocco (‫المغرب‬‎)",
									"MZ" => "Mozambique (Moçambique)",
									"MM" => "Myanmar (Burma) (မြန်မာ)",
									"NA" => "Namibia (Namibië)",
									"NR" => "Nauru",
									"NP" => "Nepal (नेपाल)",
									"NL" => "Netherlands (Nederland)",
									"NC" => "New Caledonia (Nouvelle-Calédonie)",
									"NZ" => "New Zealand",
									"NI" => "Nicaragua",
									"NE" => "Niger (Nijar)",
									"NG" => "Nigeria",
									"NU" => "Niue",
									"NF" => "Norfolk Island",
									"MP" => "Northern Mariana Islands",
									"KP" => "North Korea (조선 민주주의 인민 공화국)",
									"NO" => "Norway (Norge)",
									"OM" => "Oman (‫عُمان‬‎)",
									"PK" => "Pakistan (‫پاکستان‬‎)",
									"PW" => "Palau",
									"PS" => "Palestine (‫فلسطين‬‎)",
									"PA" => "Panama (Panamá)",
									"PG" => "Papua New Guinea",
									"PY" => "Paraguay",
									"PE" => "Peru (Perú)",
									"PH" => "Philippines",
									"PN" => "Pitcairn Islands",
									"PL" => "Poland (Polska)",
									"PT" => "Portugal",
									"PR" => "Puerto Rico",
									"QA" => "Qatar (‫قطر‬‎)",
									"RE" => "Réunion (La Réunion)",
									"RO" => "Romania (România)",
									"RU" => "Russia (Россия)",
									"RW" => "Rwanda",
									"BL" => "Saint Barthélemy (Saint-Barthélemy)",
									"SH" => "Saint Helena",
									"KN" => "Saint Kitts and Nevis",
									"LC" => "Saint Lucia",
									"MF" => "Saint Martin (Saint-Martin (partie française))",
									"PM" => "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)",
									"WS" => "Samoa",
									"SM" => "San Marino",
									"ST" => "São Tomé and Príncipe (São Tomé e Príncipe)",
									"SA" => "Saudi Arabia (‫المملكة العربية السعودية‬‎)",
									"SN" => "Senegal (Sénégal)",
									"RS" => "Serbia (Србија)",
									"SC" => "Seychelles",
									"SL" => "Sierra Leone",
									"SG" => "Singapore",
									"SX" => "Sint Maarten",
									"SK" => "Slovakia (Slovensko)",
									"SI" => "Slovenia (Slovenija)",
									"SB" => "Solomon Islands",
									"SO" => "Somalia (Soomaaliya)",
									"ZA" => "South Africa",
									"GS" => "South Georgia & South Sandwich Islands",
									"KR" => "South Korea (대한민국)",
									"SS" => "South Sudan (‫جنوب السودان‬‎)",
									"ES" => "Spain (España)",
									"LK" => "Sri Lanka (ශ්‍රී ලංකාව)",
									"VC" => "St. Vincent & Grenadines",
									"SD" => "Sudan (‫السودان‬‎)",
									"SR" => "Suriname",
									"SJ" => "Svalbard and Jan Mayen (Svalbard og Jan Mayen)",
									"SZ" => "Swaziland",
									"SE" => "Sweden (Sverige)",
									"CH" => "Switzerland (Schweiz)",
									"SY" => "Syria (‫سوريا‬‎)",
									"TW" => "Taiwan (台灣)",
									"TJ" => "Tajikistan",
									"TZ" => "Tanzania",
									"TH" => "Thailand (ไทย)",
									"TL" => "Timor-Leste",
									"TG" => "Togo",
									"TK" => "Tokelau",
									"TO" => "Tonga",
									"TT" => "Trinidad and Tobago",
									"TA" => "Tristan da Cunha",
									"TN" => "Tunisia (‫تونس‬‎)",
									"TR" => "Turkey (Türkiye)",
									"TM" => "Turkmenistan",
									"TC" => "Turks and Caicos Islands",
									"TV" => "Tuvalu",
									"UM" => "U.S. Outlying Islands",
									"VI" => "U.S. Virgin Islands",
									"UG" => "Uganda",
									"UA" => "Ukraine (Україна)",
									"AE" => "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)",
									"GB" => "United Kingdom",
									"US" => "United States",
									"UY" => "Uruguay",
									"UZ" => "Uzbekistan (Oʻzbekiston)",
									"VU" => "Vanuatu",
									"VA" => "Vatican City (Città del Vaticano)",
									"VE" => "Venezuela",
									"VN" => "Vietnam (Việt Nam)",
									"WF" => "Wallis and Futuna",
									"EH" => "Western Sahara (‫الصحراء الغربية‬‎)",
									"YE" => "Yemen (‫اليمن‬‎)",
									"ZM" => "Zambia",
									"ZW" => "Zimbabwe"
								); */
								$countries = country_listing();
								$i=0;
								echo '<option value="" >'. __('Select Country','falcons').'</option>';
								$first_country='select';
								foreach($countries as $key=>$country) {
										echo '<option value="'. $key.'" >'. $country.'</option>';
										
										$i++;
									}	
								?>
							</select>	
							
						</div>
					</div>
					
					<?php
					}	
					?>
					</div>							
					</div>	
						
																	
					<input type="hidden" name="hidden_form_name" id="hidden_form_name" value="iv_directories_registration">
						

              </div>
         </div>
         </div>
			</div>	
		 <br/>
		 
		
			<div class="content">
            
					<h3 class="form-title"><?php  esc_html_e('Payment Info','falcons');?></h3>
           
					<div class="col-md-12">
						<div class="form-content">
							<?php 														
							if($iv_gateway=='paypal-express'){
								include(wp_iv_directories_template.'signup/paypal_form_2.php');
							}
							
							if($iv_gateway=='stripe'){
								include(wp_iv_directories_template.'signup/iv_stripe_form_2.php');					
							}	
							if($iv_gateway=='woocommerce'){
							include(wp_iv_directories_template.'signup/woocommerce.php');
						}										
							?>	
						</div>		
					</div>	
				
					
				</div>	
		
		</form>
		<div style="display: none;">
			<img src='<?php echo wp_iv_directories_URLPATH. 'admin/files/images/loader.gif'; ?>' />
		</div>
	</div>
	</div>
</div>

<?php 
 wp_enqueue_script( 'profile-registration-js', falcons_JS.'profile-registration.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'profile-registration-js', 'falcons_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
																		'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',
																		'old_loader'		=> wp_iv_directories_URLPATH.'admin/files/images/old-loader.gif',
																		'iv_gateway'		=>$iv_gateway,
																		'stripe_publishable'=>$stripe_publishable,
																		'package_amount'	=> $package_amount,
																		'api_currency'		=>$api_currency ,
																		'right_icon'		=> wp_iv_directories_URLPATH. 'admin/files/images/right_icon.png' ,
																		'wrong_icon'		=> wp_iv_directories_URLPATH. 'admin/files/images/wrong_16x16.png' ,
																		'Hide_Coupon'=> __('Hide Coupon','falcons'),
																		'have_Coupon'=> __('Have a coupon?','falcons'),
																		
																		) );
 
 ?> 
