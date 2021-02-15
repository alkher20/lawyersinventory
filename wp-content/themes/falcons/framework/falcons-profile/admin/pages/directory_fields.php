<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}

</style>
			<?php
			global $wpdb;
			global $current_user;
			$ii=1;
			
			$directory_url_1=get_option('_iv_directory_url_1');					
			if($directory_url_1==""){$directory_url_1='law-firms';}	
			
			$directory_url_2=get_option('_iv_directory_url_2');					
			if($directory_url_2==""){$directory_url_2='lawyers';}
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">
						<div class="row">
							
							<div class="col-md-12"><h3 class="page-header"><?php _e('Listing Fields','falcons'); ?>  <br /><small> &nbsp;</small> </h3>
							</div>
						</div> 
						<div id="success_message">	</div>
						
						
						
							
							
						<div class="panel panel-info">
						<div class="panel-heading"><h4><?php echo ucfirst($directory_url_1); ?> Fields </h4></div>
						<div class="panel-body">	
							
							
							<form id="dir_fields" name="dir_fields" class="form-horizontal" role="form" onsubmit="return false;">	
								<div class="row ">
									<div class="col-sm-3 "><h4>	Specialtie(s) <?php echo ucfirst($directory_url_1).' & '.ucfirst($directory_url_2) ; ?>(Both) :</h4>	
									</div>
									<?php
							$specialtie ='Accident Injury,Administrative,Admiralty Maritime,Adoption,Agricultural Law,Antitrust and Unfair Competition,Appeals,Appellate Practice,Arson and Fraud Defense,Asbestos Mesothelioma,Asset Protection,Auto Accidents,Aviation Litigation,Bad Faith Litigation,Bankruptcy,Bicycle Personal Injury,Brain Injury,Burglary,Business Commercial,Casualty and Property Defense,Child Abuse,Child Custody,Children,Civil Engineering,Civil Litigation,Civil Practice,Civil Rights,Collaborative Law,Collections,Commercial Litigation,Computer,Constitutional Law,Construction,Construction Claim,Construction Litigation,Consumer Debt Protection,Consumer Litigation,Contract,Copyright and Trademark,Corporate and Partnership Litigation,Corporate Planning,Corporation,Credit Card Settlement,Credit Reporting,Creditor Debtor,Creditors Rights,Criminal,Crisis Management,Directors and Officers Liability,Discrimination,Divorce,Domestic,Drug Charges,Drug Possession,DUI OWI,E-Commerce and Internet Business Law,Education,Elder Law,Emerging Business and Venture Capital,Employee Benefits and Executive Compensation,Employment Law,Entertainment,Environmental Coverage,Environmental Law,Environmental Litigation,ERISA,Estate Planning,Estate Planning and Administration,Estate Settlement,Family,Federal and State Taxation,Federal Law,FELA Railroad Injury,Felonies,Fidelity and Security,Financial Services,Food Borne Illness,Foreclosures,Franchise Law,General Practice,Government Contracts,Guardianship Conservator,Hand Surgery,Health Care,Health Regulatory Law and Litigation,Immigration,Injuries At Bars Hotels and Restaurants,Injuries from Animal Attacks,Injuries to Children,Injury,Insurance,Insurance Bad Faith,Insurance Corporate and Regulatory,Insurance Coverage,Intellectual Property,International,International Tax and Estate Planning,International Torts,Internet,Juvenile,Labor and Employment,Land Use,Landlord Tenant,Latin America Practice Group,Mergers and Acquisitions,Military Law,Misdemeanors,Motor Vehicle Accident,Murder Homicide,Nonprofit,Oil Drilling,Oil Field Production,OSHA Defense,Patent,Personal Injury,Pharmaceuticals,Premise Liability,Privacy Law and Regulations,Pro Bono,Probate,Product Liability,Professional Liability,Professional Malpractice,Property,Public and Project Finance,Public Utilities and Energy Law,Punitive Damages,Racial Discrimination,Real Estate,Real Estate Litigation,Real Property,Reinsurance,Securities and Banking Law,Securities Arbitration and Litigation,Securities Litigation and Civil RICO,Securities Offerings and Regulations,Sentencing Issues,Sexual Assault,Sexual Harassment,Small Business,Social Security Disability,Special,Sports,State Law,Structured Settlement and Lottery Funding,Subrogation and Recovery,Tax Law,Toxic and Other Mass Torts,Traffic,Transportation,Truck Accident,Truck Crash,Trucks and Semis,Trust and Estate Litigation,Trust and Estate Planning,Unfair Insurance Practices,Vaccine Injury,Veterans Disability,Veterinarian Malpractice Defense,White Collar Crime,Wills Estates,Workers Compensation,Wrongful Death,Zoning';
																										
											$field_set=get_option('iv_cpt1_specialtie' );
											if($field_set!=""){ 
													$specialtie=get_option('iv_cpt1_specialtie' );
											}			
																	
										?>
									<div class="col-sm-9 ">	<textarea rows="10" class="col-sm-9 " name="specialtie" id="specialtie"   ><?php echo $specialtie; ?> </textarea>	
									</div>
								</div>
								<br/><br/>
																	
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4>Post Meta Name</h4>
												</div>
												<div class="col-sm-5">
													<h4>Display Label</h4>									
												</div>
												<div class="col-sm-2">
													<h4>Action</h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div">			
														<?php
														
														$default_fields = array();
															$field_set=get_option('iv_directories_fields' );
															
															
														if($field_set!=""){ 
																$default_fields=get_option('iv_directories_fields' );
														}else{															
																$default_fields['profitNonProfit']='For-profit or non-profit?';
																$default_fields['size']='Size';
																$default_fields['cost']='Cost';
																$default_fields['average_stay']=' Average length of stay';
																$default_fields['NumberOflawyer ']='Number Of Lawyers';
																$default_fields['accreditedBy']='Accredited by';	
																$default_fields['certifications']='Certifications';	
														}
														if(sizeof($default_fields)<1){																
																$default_fields['profitNonProfit']='For-profit or non-profit?';
																$default_fields['size']='Size';
																$default_fields['cost']='Cost';
																$default_fields['average_stay']=' Average length of stay';
																$default_fields['ownership']='Ownership';
																$default_fields['accreditedBy']='Accredited by';	
																$default_fields['certifications']='Certifications';		
														 }	
														
														$i=1;		
														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field('<?php echo $i; ?>');">Delete</button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field();">Add More</button>
									 </div>	
									<input type="hidden" name="dir_name" id="dir_name" value="<?php echo $main_category; ?>">	 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_dir_fields();">Update </button>
												</div>
												<p>&nbsp;</p>
											</div>
						</div>							 
				
				</div>			 	
					
					
					
				<div id="success_message_cpt2">	</div>								
										
				<div class="panel panel-info">
						<div class="panel-heading"><h4><?php echo ucfirst($directory_url_2); ?> Fields </h4></div>
						<div class="panel-body">	
							<form id="cpt2_fields" name="cpt2_fields" class="form-horizontal" role="form" onsubmit="return false;">
											
							
										
										
										<div class="row ">
												<div class="col-sm-5 ">										
													<h4>Post Meta Name</h4>
												</div>
												<div class="col-sm-5">
													<h4>Display Label</h4>									
												</div>
												<div class="col-sm-2">
													<h4>Action</h4>
													
												</div>		
																		  
										</div>
										
																 
									
											<div id="custom_field_div_cpt2">			
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
																$default_fields['LeadershipRoles']='Leadership Roles';	
																
															
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
																$default_fields['LeadershipRoles']='Leadership Roles';		
														 }			
														

														
														foreach ( $default_fields as $field_key => $field_value ) {												
															
																//echo'<br/>$field_key....'.$field_key.'......$field_values....'.$field_values;
																echo '<div class="row form-group " id="field_'.$i.'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="'.$field_key . '" placeholder="Enter Post Meta Name "> </div>		
																<div  class=" col-sm-5">
																<input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="'.$field_value . '" placeholder="Enter Post Meta Label">													
																</div>
																<div  class=" col-sm-2">';
																?>
																<button class="btn btn-danger btn-xs" onclick="return iv_remove_field_cpt2('<?php echo $i; ?>');">Delete</button>
																<?php																								
																echo '</div></div>';
															
															$i++;	
															
														}	
													?>
														
													
											</div>				  
										<div class="col-xs-12">											
											<button class="btn btn-warning btn-xs" onclick="return iv_add_field_cpt2();">Add More</button>
									 </div>	
									 
							</form>	
					
									<div class="col-xs-12">					
												<div align="center">
													<div id="loading"></div>
													<button class="btn btn-info btn-lg" onclick="return update_cpt2_fields();">Update </button>
												</div>
												<p>&nbsp;</p>
											</div>
						</div>							 
				
				</div>			 	
					
					
					
							
			
									
			  </div>						
		</div>		 


<script>
	var i=<?php echo $i; ?>;
	var ii=<?php echo $ii; ?>;
	
	
	function update_dir_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_dir_fields",
			"form_data":	jQuery("#dir_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field(){	
	
		jQuery('#custom_field_div').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	// cpt2**********
	function update_cpt2_fields(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 		"iv_directories_update_cpt2_fields",
			"form_data":	jQuery("#cpt2_fields").serialize(), 	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message_cpt2').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
	}
	function iv_add_field_cpt2(){	
	
		jQuery('#custom_field_div_cpt2').append('<div class="row form-group " id="field_'+i+'"><div class=" col-sm-5"> <input type="text" class="form-control" name="meta_name[]" id="meta_name[]" value="" placeholder="Enter Post Meta Name "> </div>	<div  class=" col-sm-5"><input type="text" class="form-control" name="meta_label[]" id="meta_label[]" value="" placeholder="Enter Post Meta Label"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_field_cpt2('+i+');">Delete</button>');		
			i=i+1;		
	}
	function iv_remove_field_cpt2(div_id){		
		jQuery("#field_"+div_id).remove();
	}	
	
	
	function iv_add_menu(){	
	
	jQuery('#custom_menu_div').append('<div class="row form-group " id="menu_'+ii+'"><div class=" col-sm-3"> <input type="text" class="form-control" name="menu_title[]" id="menu_title[]" value="" placeholder="Enter Menu Title "> </div>	<div  class=" col-sm-7"><input type="text" class="form-control" name="menu_link[]" id="menu_link[]" value="" placeholder="Enter Menu Link.  Example  http://www.google.com"></div><div  class=" col-sm-2"><button class="btn btn-danger btn-xs" onclick="return iv_remove_menu('+ii+');">Delete</button>');
	
		ii=ii+1;		
	}
	function iv_remove_menu(div_id){		
		jQuery("#menu_"+div_id).remove();
	}	
		
		
</script>				
			
