<?php
wp_enqueue_style('single-cpt2-style', falcons_CSS.'add-cpt1.css', array(), $ver = false, $media = 'all');
?>

          <div class="profile-content">
            
              <div class="portlet light">
                <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"> <?php esc_html_e('Add new '.$directory_url_2_string,'falcons'); ?></span>
                    </div>
					
                  </div>
               
                  <div class="portlet-body">
                    <div class="tab-content">                    
                      <div class="tab-pane active" id="tab_1_1">
					  <?php					
						global $wpdb;
						// Check Max\
						$package_id=get_user_meta($current_user->ID,'iv_directories_package_id',true);						
						$max=get_post_meta($package_id, 'iv_directories_package_max_post_no', true);
						
						if($package_id==""){ 
							global $wpdb; $user_role= $current_user->roles[0];
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'";
							$membership_pack = $wpdb->get_results($sql);
							$total_package=count($membership_pack);								
							if(sizeof($membership_pack)>0){
								$i=0;
								foreach ( $membership_pack as $row )
								{	
									if(get_post_meta($row->ID, 'iv_directories_package_user_role', true)==$user_role ){
										$package_id=$row->ID ;
									}
								}
								$max=get_post_meta($package_id, 'iv_directories_package_max_post_no', true);
								
							}else{
								$max=999999;
							}	
						}				
						$user_role= $current_user->roles[0];
						if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
							$max=999999; 
						}	
						
						$sql="SELECT count(*) as total FROM $wpdb->posts WHERE post_type IN ('".$directory_url_1."','".$directory_url_2."' )  and post_author='".$current_user->ID."' ";									
						$all_post = $wpdb->get_row($sql);
						$my_post_count=$all_post->total;
						
						if ( $my_post_count>=$max or !current_user_can('edit_posts') )  {
								$iv_redirect = get_option( '_iv_directories_profile_page');							
								$reg_page= get_permalink( $iv_redirect); 							
							?>
							<?php esc_html_e('Please upgrade your account','falcons'); ?>
							 <a href="<?php echo $reg_page.'?&profile=level'; ?>" title="Upgarde"><b><?php esc_html_e('here','falcons'); ?> </b></a> 
							<?php esc_html_e('to add more post.','falcons'); ?>	
							
							
						<?php
						}else{
					
					?>					
					
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="new_post" name="new_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php esc_html_e('Full Name','falcons'); ?></label>
									<div class="  "> 
										<input type="text" class="" name="title" id="title" value="" placeholder="<?php esc_html_e('Enter Full Name Here','falcons'); ?>">
									</div>																		
								</div>
								
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>8,
														'editor_class' => ''															 
														);
													
													$editor_id = 'new_post_content';
													wp_editor( '', $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>
								
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php esc_html_e('Profile Image','falcons'); ?>  </label>
									
										<div class="col-md-4" id="post_image_div">
											<a  href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
											<?php  echo '<img width="100px" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>			
											</a>					
										</div>
										
										<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
										
										<div class="col-md-3" id="post_image_edit">	
											<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php esc_html_e('Add','falcons'); ?> </button>
											
										</div>									
								</div>
								<div class=" row form-group ">	
											<!--
										<div class="col-md-12" id="gallery_image_div">
											
											<a  href="javascript:void(0);" onclick="edit_gallery_image('gallery_image_div');"  >									
											<?php  echo '<img src="'. wp_iv_directories_URLPATH.'assets/images/gallery_icon.png">'; ?>			
											</a>
															
										</div>
											-->
										<input type="hidden" name="gallery_image_ids" id="gallery_image_ids" value="">
										
										<div class="col-md-12" id="gallery_image_div">
										</div>									
								</div>
								
																
								
								<div class="clearfix"></div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-12 control-label"><?php esc_html_e('Post Status','falcons'); ?>  </label>
									
										<div class="col-md-12" >										
										<select name="post_status" id="post_status"  class="">
											<?php
												$dir_approve_publish =get_option('_dir_approve_publish');
												if($dir_approve_publish!='yes'){?>
													<option value="publish"><?php esc_html_e('Publish','falcons'); ?></option>
												<?php	
												}else{ ?>
													<option value="pending"><?php esc_html_e('Pending Review','falcons'); ?></option>
												<?php
												}
											?>	
											<option value="draft"><?php esc_html_e('Draft','falcons'); ?></option>
											
										</select>										
											
											
										</div>				
																		
								</div>
								
								
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-12 control-label"><?php esc_html_e('Category','falcons'); ?></label>									
									<div class=" col-md-12 "> 
								
								<?php
									$selected='';
									echo '<select name="postcats" class=" ">';
									echo'	<option selected="'.$selected.'" value="">'.__('Choose a category','falcons').'</option>';
								
										
										if( isset($_POST['submit'])){
											$selected = $_POST['postcats'];
										}
											//directories
											$taxonomy = $directory_url_2.'-category';
											$args = array(
												'orderby'           => 'name', 
												'order'             => 'ASC',
												'hide_empty'        => false, 
												'exclude'           => array(), 
												'exclude_tree'      => array(), 
												'include'           => array(),
												'number'            => '', 
												'fields'            => 'all', 
												'slug'              => '',
												'parent'            => '0',
												'hierarchical'      => true, 
												'child_of'          => 0,
												'childless'         => false,
												'get'               => '', 
												
											);
								$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
								if ( $terms && !is_wp_error( $terms ) ) :
									$i=0;
									foreach ( $terms as $term_parent ) {  ?>												
										
										
											<?php //echo'<br/> '. $term_parent->name.' ..ID..'.$term_parent->term_id;  
											
											echo '<option  value="'.$term_parent->slug.'" '.($selected==$term_parent->slug?'selected':'' ).'><strong>'.$term_parent->name.'<strong></option>';
											?>	
												<?php
												
												$args2 = array(
													'type'                     => $directory_url_2,						
													'parent'                   => $term_parent->term_id,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 0,
													'hierarchical'             => 1,
													'exclude'                  => '',
													'include'                  => '',
													'number'                   => '',
													'taxonomy'                 => $directory_url_2.'-category',
													'pad_counts'               => false 

												); 											
												$categories = get_categories( $args2 );	
												if ( $categories && !is_wp_error( $categories ) ) :
														
														
													foreach ( $categories as $term ) { 
														echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>--'.$term->name.'</option>';
													} 	
																				
												endif;		
												
												?>
																			
	  
									<?php
										$i++;
									} 								
								endif;	
									echo '</select>';	
								?>		
									</div>
																		
								</div>
								
								
								


						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Address','falcons'); ?></label>							
							<div class=" "> 
								<input type="text" class="" name="address" id="address" value="" placeholder="<?php esc_html_e('Enter here Here','falcons'); ?>">
							</div>															
						</div>
						
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('City','falcons'); ?></label>	
								<input type="text" class="" name="city" id="city" value="" placeholder="<?php esc_html_e('Enter city here','falcons'); ?>">
						</div>
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('State','falcons'); ?></label>	
								<input type="text" class="" name="state" id="state" value="" placeholder="<?php esc_html_e('Enter state here','falcons'); ?>">
						</div>
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Postcode','falcons'); ?></label>	
								<input type="text" class="" name="postcode" id="postcode" value="" placeholder="<?php esc_html_e('Enter postcode here','falcons'); ?>">
						</div>
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Country','falcons'); ?></label>	
								<input type="text" class="" name="country" id="country" value="" placeholder="<?php esc_html_e('Enter country here','falcons'); ?>">
						</div>
						
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Latitude','falcons'); ?></label>	
								<input type="text" class="" name="latitude" id="latitude" value="" placeholder="<?php esc_html_e('Enter latitude here','falcons'); ?>">
						</div>
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Longitude','falcons'); ?></label>	
								<input type="text" class="" name="longitude" id="longitude" value="" placeholder="<?php esc_html_e('Enter longitude here','falcons'); ?>">
						</div>
						
						
						<div class=" form-group">
							<label for="text" class=" control-label"><?php esc_html_e('Address Map','falcons'); ?></label>							
							<div class=" "> 
									<div  id="map-canvas"  style="width:100%;height:300px;"></div>
										
								<script type="text/javascript">
								var geocoder;
								jQuery(document).ready(function($) {									
									var map;
									var marker;

									 geocoder = new google.maps.Geocoder();
									

									function geocodePosition(pos) {
									  geocoder.geocode({
									    latLng: pos
									  }, function(responses) {
									    if (responses && responses.length > 0) {
									      updateMarkerAddress(responses[0].formatted_address);
									    } else {
									      updateMarkerAddress('Cannot determine address at this location.');
									    }
									  });
									}

									function updateMarkerPosition(latLng) {
									  jQuery('#latitude').val(latLng.lat());
									  jQuery('#longitude').val(latLng.lng());	
										//console.log(latLng);	
										codeLatLng(latLng.lat(), latLng.lng());
									}

									function updateMarkerAddress(str) {
									  jQuery('#address').val(str);
									}

									function initialize() {

									  var latlng = new google.maps.LatLng(40.748817, -73.985428);
									  var mapOptions = {
									    zoom: 2,
									    center: latlng
									  }

									  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
										
									  geocoder = new google.maps.Geocoder();

									  marker = new google.maps.Marker({
									  	position: latlng,
									    map: map,
									    draggable: true
									  });

									  // Add dragging event listeners.
									  google.maps.event.addListener(marker, 'dragstart', function() {
									    updateMarkerAddress('Please Wait Dragging...');
									  });
									  
									  google.maps.event.addListener(marker, 'drag', function() {
									    updateMarkerPosition(marker.getPosition());
									  });
									  
									  google.maps.event.addListener(marker, 'dragend', function() {
									    geocodePosition(marker.getPosition());
									  });

									}

									google.maps.event.addDomListener(window, 'load', initialize);
									google.maps.event.addDomListener(window, 'load', initialize_address);
									function initialize_address() {
										var input = document.getElementById('address');
										var autocomplete = new google.maps.places.Autocomplete(input);
											google.maps.event.addListener(autocomplete, 'place_changed', function () {
											var place = autocomplete.getPlace();
											//document.getElementById('city2').value = place.name;
											document.getElementById('latitude').value = place.geometry.location.lat();
											document.getElementById('longitude').value = place.geometry.location.lng(); 
											
											//codeLatLng(place.geometry.location.lat(), place.geometry.location.lng());
											
									         var location = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
												codeLatLng(place.geometry.location.lat(), place.geometry.location.lng());
											
									        marker.setPosition(location);
									        map.setZoom(16);
									        map.setCenter(location);
										});
									}
									jQuery(document).ready(function() { 
									         
									  initialize();
									          
									  
									  
									  //Add listener to marker for reverse geocoding
									  google.maps.event.addListener(marker, 'drag', function() {
									    geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
									      if (status == google.maps.GeocoderStatus.OK) {
									        if (results[0]) {
												
									          jQuery('#address').val(results[0].formatted_address);
									          jQuery('#latitude').val(marker.getPosition().lat());
									          jQuery('#longitude').val(marker.getPosition().lng());
									        }
									      }
									    });
									  });
									  
									});

								});
								// For city country , zip
								function codeLatLng(lat, lng) {
									var city;
									var postcode;
									var state;
									var country;	
									var latlng = new google.maps.LatLng(lat, lng);
									geocoder.geocode({'latLng': latlng}, function(results, status) {
									  if (status == google.maps.GeocoderStatus.OK) {
									  //console.log(results)
										if (results[1]) {
									
										//find country name
											 for (var i=0; i<results[0].address_components.length; i++) {
											for (var b=0;b<results[0].address_components[i].types.length;b++) {

											//there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
												if (results[0].address_components[i].types[b] == "locality") {
													//this is the object you are looking for
													city= results[0].address_components[i];		
													//break;
												}
												if (results[0].address_components[i].types[b] == "country") {
													country= results[0].address_components[i];
												}
												if (results[0].address_components[i].types[b] == "postal_code") {													
													postcode= results[0].address_components[i];													
												}	
												
											}
										}
										//city data
										jQuery('#address').val(results[0].formatted_address); 
										jQuery('#city').val(city.long_name);
										jQuery('#postcode').val(postcode.long_name);
										jQuery('#country').val(country.long_name);
										//alert(city.falcons + " " + city.long_name)


										} else {
										  
										}
									  } else {
										
									  }
									});
								  }

						    </script>
							
							</div>																
						</div>
					
										
						<div class="clearfix"></div>	
					
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
									  <?php esc_html_e('Specialitie(s)','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
									  <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseEight" class="panel-collapse collapse">
								  <div class="panel-body">
									<div class=" form-group">
										
											<div class=" "> 
											<?php
											$specialtie =__('Accident Injury,Administrative,Admiralty Maritime,Adoption,Agricultural Law,Antitrust and Unfair Competition,Appeals,Appellate Practice,Arson and Fraud Defense,Asbestos Mesothelioma,Asset Protection,Auto Accidents,Aviation Litigation,Bad Faith Litigation,Bankruptcy,Bicycle Personal Injury,Brain Injury,Burglary,Business Commercial,Casualty and Property Defense,Child Abuse,Child Custody,Children,Civil Engineering,Civil Litigation,Civil Practice,Civil Rights,Collaborative Law,Collections,Commercial Litigation,Computer,Constitutional Law,Construction,Construction Claim,Construction Litigation,Consumer Debt Protection,Consumer Litigation,Contract,Copyright and Trademark,Corporate and Partnership Litigation,Corporate Planning,Corporation,Credit Card Settlement,Credit Reporting,Creditor Debtor,Creditors Rights,Criminal,Crisis Management,Directors and Officers Liability,Discrimination,Divorce,Domestic,Drug Charges,Drug Possession,DUI OWI,E-Commerce and Internet Business Law,Education,Elder Law,Emerging Business and Venture Capital,Employee Benefits and Executive Compensation,Employment Law,Entertainment,Environmental Coverage,Environmental Law,Environmental Litigation,ERISA,Estate Planning,Estate Planning and Administration,Estate Settlement,Family,Federal and State Taxation,Federal Law,FELA Railroad Injury,Felonies,Fidelity and Security,Financial Services,Food Borne Illness,Foreclosures,Franchise Law,General Practice,Government Contracts,Guardianship Conservator,Hand Surgery,Health Care,Health Regulatory Law and Litigation,Immigration,Injuries At Bars Hotels and Restaurants,Injuries from Animal Attacks,Injuries to Children,Injury,Insurance,Insurance Bad Faith,Insurance Corporate and Regulatory,Insurance Coverage,Intellectual Property,International,International Tax and Estate Planning,International Torts,Internet,Juvenile,Labor and Employment,Land Use,Landlord Tenant,Latin America Practice Group,Legal Malpractice,Liability,Litigation,Loan Modification,Long Term Disability,Main,Malpractice,Manslughter,Marine and Maritime Law,Matrimonial,Mediation Arbitration,Medicaid,Mergers and Acquisitions,Military Law,Misdemeanors,Motor Vehicle Accident,Murder Homicide,Nonprofit,Oil Drilling,Oil Field Production,OSHA Defense,Patent,Personal Injury,Pharmaceuticals,Premise Liability,Privacy Law and Regulations,Pro Bono,Probate,Product Liability,Professional Liability,Professional Malpractice,Property,Public and Project Finance,Public Utilities and Energy Law,Punitive Damages,Racial Discrimination,Real Estate,Real Estate Litigation,Real Property,Reinsurance,Securities and Banking Law,Securities Arbitration and Litigation,Securities Litigation and Civil RICO,Securities Offerings and Regulations,Sentencing Issues,Sexual Assault,Sexual Harassment,Small Business,Social Security Disability,Special,Sports,State Law,Structured Settlement and Lottery Funding,Subrogation and Recovery,Tax Law,Toxic and Other Mass Torts,Traffic,Transportation,Truck Accident,Truck Crash,Trucks and Semis,Trust and Estate Litigation,Trust and Estate Planning,Unfair Insurance Practices,Vaccine Injury,Veterans Disability,Veterinarian Malpractice Defense,White Collar Crime,Wills Estates,Workers Compensation,Wrongful Death,Zoning','falcons');
																										
											$field_set=get_option('iv_cpt1_specialtie' );
											if($field_set!=""){ 
													$specialtie=get_option('iv_cpt1_specialtie' );
											}			
																	
														
										$i=1;		
											
										$specialtie_fields= explode(",",$specialtie);			
										foreach ( $specialtie_fields as $field_value ) { ?>	
												<div class="col-md-4">
													<label class="form-group"> <input type="checkbox" name="specialtie_arr[]" id="specialtie_arr[]" value="<?php echo $field_value; ?>"> <?php echo $field_value; ?> </label>  
												</div>
														
												
										
										<?php
										}
										?>															
										</div>																
									</div>								
								  </div>
								</div>
					  </div>
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									  <?php esc_html_e('Additional Info','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
									 <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse">
								  <div class="panel-body">											
										<?php							
											
											
											$default_fields = array();
												$field_set=get_option('iv_directories_fields_lawyer' );
											if($field_set!=""){ 
													$default_fields=get_option('iv_directories_fields_lawyer' );
											}else{													
													$default_fields['Gender']='Gender';	
													$default_fields['lawfirmAffiliations']='Law Office Affiliations';
													$default_fields['ExperienceTranining']='Experience / Tranining';
													$default_fields['Education']='Education';
													$default_fields['Apprenticeships']='Apprenticeships';
													$default_fields['Residency']='Residency';
													$default_fields['PractiseArea']='Practise Area';	
													$default_fields['Certifications']='Certifications';	
													$default_fields['Pre-Law']='Pre-Law';
													$default_fields['Law-School']='Law School';		
													$default_fields['law-degree']='Law Degree';																	
													$default_fields['Bar-Exam']='Bar Exam';	
													$default_fields['Practice-Course']='Practice Course';																
													$default_fields['Languages']='Languages';	
													//Languages
												
											}
											if(sizeof($default_fields)<1){
													$default_fields['Gender']='Gender';	
													$default_fields['lawfirmAffiliations']='Law Office Affiliations';
													$default_fields['ExperienceTranining']='Experience / Tranining';
													$default_fields['Education']='Education';
													$default_fields['Apprenticeships']='Apprenticeships';
													$default_fields['Residency']='Residency';
													$default_fields['PractiseArea']='Practise Area';	
													$default_fields['Certifications']='Certifications';	
													$default_fields['Pre-Law']='Pre-Law';
													$default_fields['Law-School']='Law School';		
													$default_fields['law-degree']='Law Degree';																	
													$default_fields['Bar-Exam']='Bar Exam';	
													$default_fields['Practice-Course']='Practice Course';																
													$default_fields['Languages']='Languages';	
											 }							
																	
														
										$i=1;							
										foreach ( $default_fields as $field_key => $field_value ) { ?>	
												 <div class="form-group">
													<label class="control-label"><?php  echo $field_value; ?></label>
													<input type="text" placeholder="<?php echo 'Enter '.$field_value;?>" name="<?php echo $field_key;?>" id="<?php echo $field_key;?>"  class="" value=""/>
												  </div>
										
										<?php
										}
										?>			
										
								  </div>
								</div>
					  </div>					
					
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									  <?php esc_html_e('Awards','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsethirty2">
									   <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapsethirty2" class="panel-collapse collapse">
								  <div class="panel-body">	
									  <div id="awards">
										 <div id="award">	
											<?php
												// video, event , coupon , vip_badge
												if($this->check_write_access('award')){												
												?>	
													
													<div class=" form-group">
														<label for="text" class=" control-label"><?php esc_html_e('Award Title','falcons'); ?>*</label>
														
														<div class="  "> 
															<input type="text" class="" name="award_title[]" id="award_title[]" value="" placeholder="<?php esc_html_e('Enter award title *required','falcons'); ?>">
														</div>																
													</div>		
													<div class=" form-group">
														<label for="text" class=" control-label"><?php esc_html_e('Award Description','falcons'); ?></label>
														
														<div class="  "> 
															<input type="text" class="" name="award_description[]" id="award_description[]" value="" placeholder="<?php esc_html_e('Enter Award Description','falcons'); ?>">
														</div>																
													</div>
													<div class=" form-group">
														<label for="text" class=" control-label"><?php esc_html_e('Year(s) for which award was received','falcons'); ?></label>
														
														<div class="  "> 
															<input type="text" class="" name="award_year[]" id="award_year[]" value="" placeholder="<?php esc_html_e('Enter Award Year','falcons'); ?>">
														</div>																
													</div>	
													<div class=" form-group " style="margin-top:10px">
													<label for="text" class=" col-md-2 control-label"><?php esc_html_e('Award Image','falcons'); ?>  </label>
														<a  href="javascript:void(0);" onclick="award_post_image(this);"  >									
														<?php  echo '<img width="100px" src="'. wp_iv_directories_URLPATH.'assets/images/image-add-icon.png">'; ?>			
														</a>
													<div class="col-md-4" id="award_image_div">
																			
													</div>						
											</div>	
										</div>
																				
									</div>
									<div class=" row  form-group ">
										<div class="col-md-12" >	
										<button type="button" onclick="add_award_field();"  class="btn btn-xs green-haze"><?php esc_html_e('Add More','falcons'); ?></button>
										</div>
									</div>							
									
									
										<?php
										}else{
												_e('Please upgrade your account to add Award ','falcons');
										}
										?>
									
								  </div>
								</div>
					  </div>
					
					<div class="clearfix"></div>	
					
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Contact Info','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
									  <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseFour" class="panel-collapse collapse">
								  <div class="panel-body">											
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Phone','falcons'); ?></label>						
											<div class="  "> 
												<input type="text" class="" name="phone" id="phone" value="" placeholder="<?php esc_html_e('Enter Phone Number','falcons'); ?>">
											</div>																
									</div>
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Fax','falcons'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="fax" id="fax" value="" placeholder="<?php esc_html_e('Enter Fax Number','falcons'); ?>">
											</div>																
									</div>	
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Email Address','falcons'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="contact-email" id="contact-email" value="" placeholder="<?php esc_html_e('Enter Email Address','falcons'); ?>">
											</div>																
									</div>
									<div class=" form-group">
											<label for="text" class=" control-label"><?php esc_html_e('Website','falcons'); ?></label>
											
											<div class="  "> 
												<input type="text" class="" name="contact_web" id="contact_web" value="" placeholder="<?php esc_html_e('Enter Web Site','falcons'); ?>">
											</div>																
									</div>
									
									
								  </div>
								</div>
					  </div>
					
									
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									  <?php esc_html_e('Videos','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
									   <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse">
								  <div class="panel-body">	
									  <?php
											// video, event , coupon , vip_badge
										 if($this->check_write_access('video')){
											
										?>										
										<div class=" form-group">
											
												<label for="text" class=" control-label"><?php esc_html_e('Youtube','falcons'); ?></label>
												
												<div class="  "> 
													<input type="text" class="" name="youtube" id="youtube" value="" placeholder="<?php esc_html_e('Enter Youtube video ID, e.g : bU1QPtOZQZU ','falcons'); ?>">
												</div>																
										</div>
										<div class=" form-group">
												<label for="text" class=" control-label"><?php esc_html_e('vimeo','falcons'); ?></label>
												
												<div class="  "> 
													<input type="text" class="" name="vimeo" id="vimeo" value="" placeholder="<?php esc_html_e('Enter vimeo ID, e.g : 134173961','falcons'); ?>">
												</div>																
										</div>
										<?php
										}else{
												_e('Please upgrade your account to add video ','falcons');
										}
										?>
									
								  </div>
								</div>
					  </div>
					
					
					<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									  <?php esc_html_e('Social Profiles','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
									   <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseFive" class="panel-collapse collapse">
								  <div class="panel-body">											
										
										<div class="form-group">
										<label class="control-label">FaceBook</label>
										<input type="text" name="facebook" id="facebook" value="" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Linkedin</label>
										<input type="text" name="linkedin" id="linkedin" value="" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Twitter</label>
										<input type="text" name="twitter" id="twitter" value="" class=""/>
									  </div>
									  <div class="form-group">
										<label class="control-label">Google+ </label>
										<input type="text" name="gplus" id="gplus" value=""  class=""/>
									  </div>
						  									
										
								  </div>
								</div>
					  </div>
					
					
					
						  <div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  <?php esc_html_e('Opening Time','falcons'); ?> 
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
									  <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse">
								  <div class="panel-body">	
									<div id="day_field_div">
										<div class=" row form-group " id="day-row1" >									
											<div class=" col-md-4"> 
											<select name="day_name[]" id="day_name[]" class="">	
											<option value=""></option> 
											<option value="Monday"> <?php esc_html_e('Monday','falcons'); ?>  </option> 
											<option value="Tuesday"><?php esc_html_e('Tuesday','falcons'); ?></option> 
											<option value="Wednesday"><?php esc_html_e('Wednesday','falcons'); ?></option> 
											<option value="Thursday"><?php esc_html_e('Thursday','falcons'); ?></option> 
											<option value="Friday"><?php esc_html_e('Friday','falcons'); ?></option> 
											<option value="Saturday"><?php esc_html_e('Saturday','falcons'); ?></option> 
											<option value="Sunday"><?php esc_html_e('Sunday','falcons'); ?></option> 
											</select>
											</div>		
											<div  class=" col-md-4">
											<select name="day_value1[]" id="day_value1[]" class="">
												<option value=""> </option>												
												<option value="Closed"><?php esc_html_e('Closed','falcons'); ?> </option>	
												<option value="Always"><?php esc_html_e('Always','falcons'); ?></option>											
												<option value="12:00 AM">12:00 AM </option>
												<option value="12:30 AM">12:30 AM </option>
												<option value="01:00 AM">01:00 AM </option>
												<option value="01:30 AM">01:30 AM </option>
												<option value="02:00 AM">02:00 AM </option>
												<option value="02:30 AM">02:30 AM </option>
												<option value="03:00 AM">03:00 AM </option>
												<option value="03:30 AM">03:30 AM </option>
												<option value="04:00 AM">04:00 AM </option>
												<option value="04:30 AM">04:30 AM </option>
												<option value="05:00 AM">05:00 AM </option>
												<option value="05:30 AM">05:30 AM </option>
												<option value="06:00 AM">06:00 AM </option>
												<option value="06:30 AM">06:30 AM </option>
												<option value="07:00 AM">07:00 AM </option>
												<option value="07:30 AM">07:30 AM </option>
												<option value="08:00 AM">08:00 AM </option>
												<option value="08:30 AM">08:30 AM </option>
												<option value="09:00 AM">09:00 AM </option>
												<option value="09:30 AM">09:30 AM </option>
												<option value="10:00 AM">10:00 AM </option>
												<option value="10:30 AM">10:30 AM </option>
												<option value="11:00 AM">11:00 AM </option>
												<option value="11:30 AM">11:30 AM </option>
												<option value="12:00 PM">12:00 PM </option>
												<option value="12:30 PM">12:30 PM </option>
												<option value="01:00 PM">01:00 PM </option>
												<option value="01:30 PM">01:30 PM </option>
												<option value="02:00 PM">02:00 PM </option>
												<option value="02:30 PM">02:30 PM </option>
												<option value="03:00 PM">03:00 PM </option>
												<option value="03:30 PM">03:30 PM </option>
												<option value="04:00 PM">04:00 PM </option>
												<option value="04:30 PM">04:30 PM </option>
												<option value="05:00 PM">05:00 PM </option>
												<option value="05:30 PM">05:30 PM </option>
												<option value="06:00 PM">06:00 PM </option>
												<option value="06:30 PM">06:30 PM </option>
												<option value="07:00 PM">07:00 PM </option>
												<option value="07:30 PM">07:30 PM </option>
												<option value="08:00 PM">08:00 PM </option>
												<option value="08:30 PM">08:30 PM </option>
												<option value="09:00 PM">09:00 PM </option>
												<option value="09:30 PM">09:30 PM </option>
												<option value="10:00 PM">10:00 PM </option>
												<option value="10:30 PM">10:30 PM </option>
												<option value="11:00 PM">11:00 PM </option>
												<option value="11:30 PM">11:30 PM </option>
												<option value="12:00 PM">12:00 PM </option>
											</select>
												
												
											</div>
											<div  class="col-md-4">
											
												<select name="day_value2[]" id="day_value2[]" class="">
												<option value=""> </option>
												<option value="12:00 AM">12:00 AM </option>
												<option value="12:30 AM">12:30 AM </option>
												<option value="01:00 AM">01:00 AM </option>
												<option value="01:30 AM">01:30 AM </option>
												<option value="02:00 AM">02:00 AM </option>
												<option value="02:30 AM">02:30 AM </option>
												<option value="03:00 AM">03:00 AM </option>
												<option value="03:30 AM">03:30 AM </option>
												<option value="04:00 AM">04:00 AM </option>
												<option value="04:30 AM">04:30 AM </option>
												<option value="05:00 AM">05:00 AM </option>
												<option value="05:30 AM">05:30 AM </option>
												<option value="06:00 AM">06:00 AM </option>
												<option value="06:30 AM">06:30 AM </option>
												<option value="07:00 AM">07:00 AM </option>
												<option value="07:30 AM">07:30 AM </option>
												<option value="08:00 AM">08:00 AM </option>
												<option value="08:30 AM">08:30 AM </option>
												<option value="09:00 AM">06:00 AM </option>
												<option value="09:30 AM">09:30 AM </option>
												<option value="10:00 AM">10:00 AM </option>
												<option value="10:30 AM">10:30 AM </option>
												<option value="11:00 AM">11:00 AM </option>
												<option value="11:30 AM">11:30 AM </option>
												<option value="12:00 PM">12:00 PM </option>
												<option value="12:30 PM">12:30 PM </option>
												<option value="01:00 PM">01:00 PM </option>
												<option value="01:30 PM">01:30 PM </option>
												<option value="02:00 PM">02:00 PM </option>
												<option value="02:30 PM">02:30 PM </option>
												<option value="03:00 PM">03:00 PM </option>
												<option value="03:30 PM">03:30 PM </option>
												<option value="04:00 PM">04:00 PM </option>
												<option value="04:30 PM">04:30 PM </option>
												<option value="05:00 PM">05:00 PM </option>
												<option value="05:30 PM">05:30 PM </option>
												<option value="06:00 PM">06:00 PM </option>
												<option value="06:30 PM">06:30 PM </option>
												<option value="07:00 PM">07:00 PM </option>
												<option value="07:30 PM">07:30 PM </option>
												<option value="08:00 PM">08:00 PM </option>
												<option value="08:30 PM">08:30 PM </option>
												<option value="09:00 PM">09:00 PM </option>
												<option value="09:30 PM">09:30 PM </option>
												<option value="10:00 PM">10:00 PM </option>
												<option value="10:30 PM">10:30 PM </option>
												<option value="11:00 PM">11:00 PM </option>
												<option value="11:30 PM">11:30 PM </option>
												<option value="12:00 PM">12:00 PM </option>
											</select>
												
											</div>
											
										</div>
									</div>	
											
									<div class=" row  form-group ">
										<div class="col-md-12" >	
										<button type="button" onclick="add_day_field();"  class="btn btn-xs green-haze"><?php esc_html_e('Add More','falcons'); ?></button>
										</div>
									</div>	
								  </div>
								</div>
					  </div>
						<div class="clearfix"></div>	
					<div class="panel panel-default">
								<div class="panel-heading">
								  <h4 class="panel-title col-lg-10">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsenine">
									  <?php esc_html_e('Appointment','falcons'); ?>
									</a>
								  </h4>
									<h4 class="panel-title" style="text-align:right;color:#1AA2E1;font-size:12px;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapsenine">
									  <?php esc_html_e('Edit ','falcons'); ?> <i class="fa fa-edit"></i>
									</a>
								  </h4>
								</div>
								<div id="collapsenine" class="panel-collapse collapse">
								  <div class="panel-body">	
									  <?php
											// video, event , coupon , vip_badge , booking
										 if($this->check_write_access('booking')){
											
										?>												
										   <div class="form-group">
												<label class="control-label"><?php esc_html_e('Appointment Detail','falcons'); ?>  </label>
												
												<?php
													$settings_booking = array(															
														'textarea_rows' =>2,	
														'editor_class' => ''															 
														);
													//$content_client = get_post_meta($post_edit->ID,'booking_detail',true);
													$editor_id = 'booking_detail';
													//wp_editor( $content_client, $editor_id, $settings_booking );	
																						
													?>
												<textarea id="booking_detail" name="booking_detail"  rows="4" class="" > <?php //echo $content_client; ?> </textarea>
										  </div>
										  <div class="form-group">
												<label class="control-label"><?php esc_html_e('Or, Appointment Shortcode','falcons'); ?>  </label>
												<input type="text" name="booking" id="booking" value="" placeholder="e.g : [events_calendar long_events=1 ]" class=""/>
										  </div>
										  
										  <?php
										}else{
												_e('Please upgrade your account to add Appointment detail ','falcons');
										}
										?>
								  </div>
								</div>
					  </div>
					
						
						
								<div class="margiv-top-10">
								    <div class="" id="update_message"></div>
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php //echo $curr_post_id; ?>">
								    <button type="button" onclick="iv_save_post();"  class="btn green-haze"><?php esc_html_e('Save Post','falcons'); ?></button>
		                          
		                        </div>	
									 
							</form>
						  </div>
						</div>
			<?php
			
				} // for Role
			
		
				
			?>
					
			

                      
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->

          
	 <script>	
function iv_save_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_save_cpt2",	
					"form_data":	jQuery("#new_post").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = "<?php echo get_permalink(); ?>?&profile=all-post";    						
								jQuery(location).attr('href',url);	
						}						
					}
				});
	
	}
function add_day_field(){
	var main_opening_div =jQuery('#day-row1').html(); 
	jQuery('#day_field_div').append('<div class="clearfix"></div><div class=" row form-group" >'+main_opening_div+'</div>');
}

function add_award_field(){
	var main_award_div =jQuery('#award').html(); 
	jQuery('#awards').append('<div class="clearfix"></div><hr>'+main_award_div+'');
}

function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Add</button>');
}


 function edit_post_image(profile_image_id){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set Profile Image ', 'falcons' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set Profile Image', 'falcons' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  						   
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	}

function award_post_image(awardthis){	
				var image_gallery_frame;
               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: "<?php esc_html_e( 'Set award Image ', 'falcons' ); ?>",
                    button: {
                        text: "<?php esc_html_e( 'Set award Image', 'falcons' ); ?>",
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {		
													
							jQuery(awardthis).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'"><input type="hidden" name="award_image_id[]" id="award_image_id[]" value="'+attachment.id+'">');
							
							
						}
					});                   
                });               
				image_gallery_frame.open(); 				
	} 
</script>	  
        
