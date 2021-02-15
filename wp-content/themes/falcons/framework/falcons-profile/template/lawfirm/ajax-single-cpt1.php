<?php
global $post,$wpdb;

	 $id=$_GET['id'];
	//print_r($_REQUEST);
	$id = $_GET['id'];
	 $post_id_1 = get_post($id);
	$post_id_1->post_title;


$wp_directory= new wp_iv_directories();
	$logo_image_id=get_post_meta($id ,'logo_image_id',true);

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}	
?>
<div class="blog-content pt20">
 <div class="">
		<div class="row">
				<div class="cbp-l-project-title ajax-title">
					<h2>
					<?php
					echo $post_id_1->post_title; ?>		
					</h2>		
				</div>
				<div style="text-align: center">	
					<?php
				$total_count=0;
				$total_count=get_post_meta($id,'_rating_total_count',true);
				$i=1;$default_fields='';$total_rating_value=0;$avg_rating=0;
				$field_set=get_option('iv_cpt-1_fields_review' );
				if($field_set!=""){
						$default_fields=get_option('iv_cpt-1_fields_review' );
				}else{
						$default_fields['Communication']=esc_html__('Communication','falcons'); 
						$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
						$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
						$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
						$default_fields['People-Skills']=esc_html__('People Skills','falcons');
						$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
						$default_fields['Creativity']=esc_html__('Creativity','falcons');
						$default_fields['Services']=esc_html__('Services','falcons');
						$default_fields['Cost']=esc_html__('Cost','falcons');
				}
				if(sizeof($default_fields)>0){
					foreach ( $default_fields as $field_key => $field_value ) {
						$field_value_trim=trim($field_value);
						$total_rating_value=$total_rating_value +get_post_meta($id,$field_key.'_rating',true);
					}
				}

				if($total_rating_value>0 AND $total_count>0){
					$avg_rating=$total_rating_value/$total_count;
				}
				
				?>
				  <div class="stars" style ="z-index: 99;position: relative;">
				  <i class="fa fa-star<?php echo($avg_rating>=1? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=1.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=2.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=3.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=4.5? "":"-o"); ?>"></i>
				  <span>(<?php echo ($total_count==""?0:$total_count); ?>)</span>
				  </div>
			 </div>  
				
<?php
if(has_post_thumbnail()){
	$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
	if($feature_image[0]!=""){
		$feature_img =$feature_image[0];
	}
}else{
	$feature_img= wp_iv_directories_URLPATH."/assets/images/default-directory.png";

}

$currentCategory=wp_get_object_terms( $id, $directory_url_1.'-category');
$cat_link='';$cat_name='';$cat_slug='';
if(isset($currentCategory[0]->slug)){
	$cat_slug = $currentCategory[0]->slug;
	$cat_name = $currentCategory[0]->name;
	$cat_link= get_term_link($currentCategory[0], $directory_url_1.'-category');
}

?>


	<div class="single-direcotry-page">

		<div class="row">
				<div class="col-md-9 col-md-push-3">
							<div class="content slider">
								<div class="cbp-slider">
									<ul class="cbp-slider-wrap">

											<?php
												//get_template_part( 'content', 'single' );

												$gallery_ids=get_post_meta($id ,'image_gallery_ids',true);
												$gallery_ids_array = array_filter(explode(",", $gallery_ids));
												$i=1;
													foreach($gallery_ids_array as $slide){
														if($slide!=''){ ?>
														 <li class="cbp-slider-item">
															<img src="<?php echo wp_get_attachment_url( $slide ); ?> " >
														 </li>
														<?php
														$i++;
														}
													}
												if(sizeof($gallery_ids_array)<1){

														if(has_post_thumbnail($id)){
															echo'<li class="cbp-slider-item">';
																echo get_the_post_thumbnail($id, 'large');
															echo '</li>';
														}else{
															?>
															 <li class="cbp-slider-item">
																<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-directory.png";?>">
															 </li>
														<?php
														}
												}
											?>
									</ul>
								</div>
							</div>
							<div class="content">
									<div class="title-content">
										<div class="cpt2-cpt1-title"><h5><?php esc_html_e('About Us','falcons'); ?></h5>
										</div>

											<span id="fav_dir<?php echo $id; ?>" class="fav-button" style="float: right;">
														<?php
															$user_ID = get_current_user_id();
															if($user_ID>0){
																$my_favorite = get_post_meta($id,'_favorites',true);
																$all_users = explode(",", $my_favorite);
																if (in_array($user_ID, $all_users)) { ?>
																	<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Added to Favorites','falcons'); ?>" href="javascript:;" onclick="save_unfavorite('<?php echo $id; ?>')" >
																	<span class="hide-sm"><i class="fa fa-heart  red-heart-o fa-lg"></i>&nbsp;&nbsp; </span></a>
																<?php
																}else{ ?>
																	<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','falcons'); ?>" href="javascript:;" onclick="save_favorite('<?php echo $id; ?>')" >
																	<span class="hide-sm"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp; </span>
																	</a>
																<?php
																}
															}else{ ?>
																	<a style="text-decoration: none;" data-toggle="tooltip" data-placement="bottom" title="<?php esc_html_e('Add to Favorites','falcons'); ?>" href="javascript:;" onclick="save_favorite('<?php echo $id; ?>')" >
																	<span class="hide-sm"><i class="fa fa-heart fa-lg"></i>&nbsp;&nbsp; </span>
																	</a>
														<?php
															}
														?>
											</span>


									</div>


									<div class="conten-desc">


										<?php
												if($wp_directory->check_reading_access('description',$id)){
											?>

												<div class="cbp-l-project-desc-text">
												<?php
														$content = $post_id_1->post_content; //apply_filters( 'the_content', get_the_content() );
														$content = str_replace( ']]>', ']]&gt;', $content );
														echo  $content;

												?>
												</div>
											<div class="cbp-l-project-desc-text">
												<?php
												$i=1;
												$field_set=get_option('iv_directories_fields' );
												if($field_set!=""){
														$default_fields=get_option('iv_directories_fields' );
												}else{
														$default_fields['profitNonProfit']='For-profit or non-profit?';
														$default_fields['size']='Size';
														$default_fields['cost']='Cost';
														$default_fields['average_stay']=' Average length of stay';
														$default_fields['ownership']='Ownership';
														$default_fields['accreditedBy']='Accredited by';
														$default_fields['certifications']='Certifications';
												}
												if(sizeof($default_fields)>0){ 	?>
													<ul class="qualification-list">
													<?php
													foreach ( $default_fields as $field_key => $field_value ) {
														$field_value_trim=trim($field_value);
														?>
														 <li><strong><?php echo $field_value_trim; ?></strong>
														 <span><?php echo '  '.get_post_meta($id,$field_key,true); ?></span>

														</li>
													<?php
													}
													?>
												</ul>
												<?php
												}
												?>
											</div>
										<?php
										}else{
												echo get_option('_iv_visibility_login_message');

											}
										?>

								</div>
						</div>


					<div class="content Specialities-list">
						<div class="title-content">
							<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Specialities','falcons'); ?></h5></div>
						</div>

						<div class="conten-desc specialist-list">
							<?php
								$Specialities = get_post_meta($id,'specialtie',true);
								$Specialities_arr= explode(",",$Specialities);
								if(sizeof($Specialities_arr)>0){?>
									<ul class="cbp-l-project-details-list">
									<?php
									foreach($Specialities_arr as $sp_one){
											if(trim($sp_one)!=''){
											?>
										<li><?php echo $sp_one;?></li>
									<?php
										}
									}?>
									</ul>
								<?php
								}
								?>
						</div>

					</div>

							<?php
						if(get_post_meta($id,'_award_title_0',true)!='' || get_post_meta($id,'_award_description_0',true) ){
					?>
						<div class="content">
								<div class="title-content">
									<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Awards','falcons'); ?></h5></div>
								</div>


									<div class="conten-desc award-content">
											<div class="cbp-l-project-desc-text">
												<?php
												if($wp_directory->check_reading_access('award',$id)){
												   for($i=0;$i<20;$i++){
													   if(get_post_meta($id,'_award_title_'.$i,true)!='' || get_post_meta($id,'_award_description_'.$i,true) || get_post_meta($id,'_award_year_'.$i,true)|| get_post_meta($id,'_award_image_id_'.$i,true) ){?>

														   <div class="cbp-l-inline">
																<div class="cbp-l-inline-left">
																	<?php
																		if(get_post_meta($id,'_award_image_id_'.$i,true)!=''){?>
																			<img src="<?php echo wp_get_attachment_url( get_post_meta($id,'_award_image_id_'.$i,true) ); ?> " >
																		<?php
																		}

																	?>

																</div>
																<div class="cbp-l-inline-right-hd">
																	<div class="cbp-l-award-title"><?php echo get_post_meta($id,'_award_title_'.$i,true); ?></div>
																	<div class="cbp-l-inline-subtitle"><?php echo get_post_meta($id,'_award_year_'.$i,true); ?></div>
																	<div class="cbp-l-inline-desc">
																			<?php echo get_post_meta($id,'_award_description_'.$i,true); ?>
																	</div>
																</div>
															</div>

														<?php
														}
													}
												}else{
													echo get_option('_iv_visibility_login_message');

												}
												?>
											</div>

								</div>
						</div>
						<?php

						}
						?>
						<?php
							if($wp_directory->check_reading_access('video',$id)){

							 $video_vimeo_id= get_post_meta($id,'vimeo',true);
							 $video_youtube_id=get_post_meta($id,'youtube',true);
							if($video_vimeo_id!='' || $video_youtube_id!=''){
							?>
						<div class="content">
								<div class="title-content">
									<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Video','falcons'); ?></h5></div>
								</div>

									<div class="conten-desc">
										<?php
													 $v=0;
													 $video_vimeo_id= get_post_meta($id,'vimeo',true);
													 if($video_vimeo_id!=""){ $v=$v+1; ?>
															<iframe src="https://player.vimeo.com/video/<?php echo $video_vimeo_id; ?>" width="100%" height="315px" frameborder="0"></iframe>
													<?php
													 }
													?>
													<br/>
													<?php
													 $video_youtube_id=get_post_meta($id,'youtube',true);
													 if($video_youtube_id!=""){
															echo($v==1?'<hr>':'');
														 ?>

															<iframe width="100%" height="315px" src="https://www.youtube.com/embed/<?php echo $video_youtube_id; ?>" frameborder="0" allowfullscreen></iframe>
													<?php
													 }
													?>
									</div>
						</div>
						<?php
							}
						}
						?>
						<div class="content">
									<?php
									if($wp_directory->check_reading_access('event')){
									?>
										<?php

									 if(trim(get_post_meta($id,'event_title',true))!='' || trim(get_post_meta($id,'event_detail',true))!=''  || trim(get_post_meta($id,'_event_image_id',true))!=''  ){?>
									 <div class="title-content">
									 	<div class="cpt2-cpt1-title"><h5><?php esc_html_e('Event','falcons'); ?></h5>
									 	</div>
									 </div>

										<div class="conten-desc award-content">
													<div class="cbp-l-project-desc-text">

															   <div class="cbp-l-inline">
																	<div class="cbp-l-inline-left">
																		<?php
																			if(get_post_meta($id,'_event_image_id',true)!=''){?>
																				<img src="<?php echo wp_get_attachment_url( get_post_meta($id,'_event_image_id',true) ); ?> " >
																			<?php
																			}

																		?>

																	</div>
																	<div class="cbp-l-inline-right-hd">
																		<div class="cbp-l-award-title"><?php echo get_post_meta($id,'event_title',true); ?></div>
																		<div class="cbp-l-inline-desc">
																				<?php echo get_post_meta($id,'event_detail',true); ?>
																		</div>
																	</div>
																</div>


												</div>


											</div>
												<?php
														}

												  ?>

												<?php
											}
											?>

							</div>
						<?php
							$physician_list=get_post_meta($id,'physician_list',true);


							if(sizeof($physician_list)>0 and $physician_list!=""){?>
							  <div class="content slider">
							  	<div class="title-content">
							  		<div class="cpt2-cpt1-title">

							  					<h5><?php esc_html_e('Our ','falcons'); echo $directory_url_2;?></h5>
							  			 </div>
							  	</div>

								<div id="js-grid-slider-projects" class="cbp cpt2-slider conten-desc">
									<?php
									foreach($physician_list as $cpt2_one){
											$post_cpt2= get_post($cpt2_one);
											?>
										<div class="cbp-item singl-directory">
											<div class="cbp-caption">
												<div class="cbp-caption-defaultWrap">
													<?php
														if(has_post_thumbnail($cpt2_one)){
																echo get_the_post_thumbnail($cpt2_one, 'large');

														}else{	?>

															<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-lawyer.png";?>">

														<?php
														}
													?>
												</div>
												<div class="cbp-caption-activeWrap">
													<div class="cbp-l-caption-alignCenter">
														<div class="cbp-l-caption-body">
															<a href="<?php echo get_permalink($cpt2_one);?>" class="btn-new btn-custom" rel="nofollow"><?php esc_html_e( 'View Profile', 'falcons' ); ?> </a>

														</div>
													</div>
												</div>
											</div>
											<div class="cbp-l-grid-projects-title"><?php  echo get_the_title( $cpt2_one );  ?></div>
											<div class="cbp-l-grid-projects-desc">
												<?php
												$currentCategory=wp_get_object_terms( $cpt2_one, $directory_url_2.'-category');
												$cat_link='';$cat_name='';$cat_slug='';
												if(isset($currentCategory[0]->slug)){
													$cat_slug = $currentCategory[0]->slug;
													$cat_name = $currentCategory[0]->name;
													$cat_link= get_term_link($currentCategory[0], $directory_url_2.'-category');
												}
												echo $cat_name;
												?>
												</div>
										</div>

							<?php
								}
								?>
									</div>
								</div>
							<?php
							}
						?>
				</div> <!-- End col-md-9-->

				<div class="col-md-3 col-md-pull-9">
							<div class="falcons-sidebar">
								<?php
								$logo_image_id=get_post_meta($id ,'logo_image_id',true);
								if($logo_image_id>0){?>

									<img style="width:100%;vertical-align:middle; margin-bottom: 20px;"  src="<?php echo wp_get_attachment_url( $logo_image_id ); ?> " >

								<?php
								}


										$lat=get_post_meta($id,'latitude',true);
										$lng=get_post_meta($id,'longitude',true);

										// Get latlng from address* START********
										$dir_lat=$lat;
										$dir_lng=$lng;
										$address = get_post_meta($id,'address',true);
										if($address!=''){
												if($dir_lat=='' || $dir_lng==''){
													$latitude='';$longitude='';

													$prepAddr = str_replace(' ','+',$address);
													$geocode=wp_remote_fopen('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
													$output= json_decode($geocode);
													if(isset( $output->results[0]->geometry->location->lat)){
														$latitude = $output->results[0]->geometry->location->lat;
													}
													if(isset($output->results[0]->geometry->location->lng)){
														$longitude = $output->results[0]->geometry->location->lng;
													}
													if($latitude!=''){
														update_post_meta($id,'latitude',$latitude);
													}
													if($longitude!=''){
														update_post_meta($id,'longitude',$longitude);
													}
													$lat=$latitude;
													$lng=$longitude;
												}
										}
									?>



									<div class="sidebar-content">
											<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Info','falcons'); ?></span>
											</div>
												<?php
												if($wp_directory->check_reading_access('contact info',$id)){
												?>

											<ul class="cbp-l-project-details-list location-lists">
												<li><strong><?php esc_html_e('Location','falcons'); ?></strong>
												<?php
													echo '<a style="text-decoration: none;" href="http://maps.google.com/maps?saddr=Current+Location&amp;daddr='.$lat.'%2C'.$lng.'" target="_blank"">'.get_post_meta($id,'address',true).'</a>';
												?>
												</li>
												  <li><strong><?php esc_html_e('Phone','falcons'); ?></strong>
													<?php echo '<a style="text-decoration: none;" href="tel:'.get_post_meta($id,'phone',true).'">'.get_post_meta($id,'phone',true).'</a>' ;?>
												</li>
												  <li><strong><?php esc_html_e('Fax','falcons'); ?></strong>
															<?php echo get_post_meta($id,'fax',true).'&nbsp;';?>			</li>
												  <li><strong><?php _e('Email','falcons'); ?></strong>
															<?php echo get_post_meta($id,'contact-email',true).'&nbsp;';?>					</li>
												  <li><strong><?php _e('Website','falcons'); ?></strong>
														<?php echo '<a style="text-decoration: none;" href="'. get_post_meta($id,'contact_web',true).'" target="_blank"">'. get_post_meta($id,'contact_web',true).'&nbsp; </a>';?>
												 </li>
												 <li><strong><?php esc_html_e('Social Profile','falcons'); ?></strong>

												 				<?php
												 			 if(get_post_meta($id,'facebook',true)!='' || get_post_meta($id,'twitter',true)!='' || get_post_meta($id,'linkedin',true)!=''|| get_post_meta($id,'gplus',true)!='' ){

												 			?>

												 				<?php
												 				if(get_post_meta($id,'facebook',true)!=""){ ?>
												 					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Facebook Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'facebook',true);?>" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
												 				<?php
												 				}
												 				?>
												 				<?php
												 				if(get_post_meta($id,'twitter',true)!=""){ ?>
												 					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('Twitter Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'twitter',true);?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
												 				<?php
												 				}
												 				?>
												 				<?php
												 				if(get_post_meta($id,'linkedin',true)!=""){ ?>
												 					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('linkedin Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'linkedin',true);?>" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i></a>
												 				<?php
												 				}
												 				?>
												 				<?php
												 				if(get_post_meta($id,'gplus',true)!=""){ ?>
												 					<a data-toggle="tooltip" data-placement="bottom" class="icon-blue"  title="<?php esc_html_e('google+ Profile','falcons'); ?>" href="<?php echo get_post_meta($id,'gplus',true);?>" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
												 				<?php
												 				}
												 			}
												 		?>
												 </li>

												 <li><strong><?php esc_html_e('Share','falcons'); ?></strong>
												 		<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Facebook','falcons'); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();  ?>"><i class="fa fa-facebook-square fa-2x"></i></a>

												 		<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On Twitter','falcons'); ?>" href="https://twitter.com/home?status=<?php the_permalink();  ?>"><i class="fa fa-twitter fa-2x"></i></a>

												 		<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On linkedin','falcons'); ?>" href="https://www.linkedin.com/shareArticle?mini=true&url=test&title=<?php the_title(); ?>&summary=&source="><i class="fa fa-linkedin-square fa-2x"></i></a>

												 		<a data-toggle="tooltip" class="icon-blue" data-placement="bottom" title="<?php esc_html_e('Share On google+','falcons'); ?>" href="https://plus.google.com/share?url=<?php the_permalink();  ?>"><i class="fa fa-google-plus-square fa-2x"></i></a>

												 </li>
											</ul>
										<?php
										}else{
											echo get_option('_iv_visibility_login_message');

										}
										?>
									</div>



									<div class="cbp-l-project-desc-text">
									<iframe  class="scroll-no" width="100%" height="200" frameborder="0" scrolling="off" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo $address; ?>&amp;ie=UTF8&amp;&amp;output=embed"></iframe><br />

									</div>


									<div class="sidebar-content">
										<?php
											$openin_days =get_post_meta($id ,'_opening_time',true);
											if(!is_array($openin_days)){
												$openin_days_final = array();
												$daysArr = explode( ',', $openin_days );
												foreach( $daysArr as $val ){
												  $tmp = explode( '|', $val );
												  $openin_days_final[ $tmp[0] ] = (isset($tmp[1])?$tmp[1]:'').'|'.(isset($tmp[2])?$tmp[2]:'');
												}
												$openin_days=$openin_days_final;
											 }
											if($openin_days!=''){
												if(is_array($openin_days)){
													if(sizeof($openin_days)>0){?>

															<div class="cbp-l-project-details-title"><span><?php esc_html_e('Working Time','falcons'); ?></span></div>

															<ul class="cbp-l-project-details-list">
														<?php
															foreach($openin_days as $key => $item){
																$day_time = explode("|", $item);
																?>
																 <li><strong><?php echo $key; ?></strong><?php echo $day_time[0].' - '.$day_time[1];  ?></li>
																<?php

																}
															?>
															   </ul>
														<?php
													} }
										}	
										 ?>
									</div>
									<div class="sidebar-content">
									
									<div class="cbp-l-project-details-title"><span><?php esc_html_e('Reviews','falcons'); ?></span></div>
										
									<ul class="cbp-l-project-details-list stars">
									<?php
									$i=1;$default_fields='';
									$field_set=get_option('iv_cpt-1_fields_review' );
									if($field_set!=""){
											$default_fields=get_option('iv_cpt-1_fields_review' );
									}else{
											$default_fields['Communication']=esc_html__('Communication','falcons'); 
											$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
											$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
											$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
											$default_fields['People-Skills']=esc_html__('People Skills','falcons');
											$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
											$default_fields['Creativity']=esc_html__('Creativity','falcons');
											$default_fields['Services']=esc_html__('Services','falcons');
											$default_fields['Cost']=esc_html__('Cost','falcons');
									}
									if(sizeof($default_fields)>0){
										foreach ( $default_fields as $field_key => $field_value ) {
											$field_value_trim=trim($field_value);
											$old_rating= get_post_meta($id,$field_key.'_rating',true);
											$key_total_count= get_post_meta($id,$field_key.'_count',true);	
											if($key_total_count<1){$key_total_count=1;}
											$old_rating=$old_rating/$key_total_count;
											?>
											 <li><strong><?php echo $field_value_trim; ?></strong>
												  <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','1')" >
												 <i  id="<?php echo $field_key ?>_1" class="uourating fa fa-star<?php echo($old_rating>=1 ? '':'-o'); ?>"></i></a>

												 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','2')" >
												 <i id="<?php echo $field_key ?>_2"  class="uourating fa fa-star<?php echo($old_rating>=2 ? '':'-o'); ?>"></i></a>

												 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;"  onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','3')" >
												 <i id="<?php echo $field_key ?>_3"  class="uourating fa fa-star<?php echo($old_rating>=3 ? '':'-o'); ?>"></i></a>

												 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','4')" >
												 <i id="<?php echo $field_key ?>_4"  class="uourating fa fa-star<?php echo($old_rating>=4 ? '':'-o'); ?>"></i></a>

												 <a title="<?php esc_html_e('Submit Rating','falcons'); ?>" href="javascript:;" onclick="save_rating('<?php echo $id; ?>','<?php echo $field_key; ?>','5')" >
												 <i id="<?php echo $field_key ?>_5" class="uourating fa fa-star<?php echo($old_rating>=5 ? '':'-o'); ?>"></i></a>
											 
											 
											 </li>
											<?php

											}
									}		
										?>
									</ul>
										
								
										
								</div>
								

									<div class="sidebar-content">
										<div class="cbp-l-project-details-title"><span><?php esc_html_e('Contact Us','falcons'); ?></span></div>
										<?php
											if($wp_directory->check_reading_access('contact us',$id)){
										?>
											<form action="" id="message-pop" name="message-pop"  method="POST" role="form">
											<div class="cbp-l-grid-projects-desc">
												<input id="subject" name ="subject" type="text" placeholder="Enter Subject" class="cbp-search-input">
											</div>
											<div class="cbp-l-grid-projects-desc">
												<input name ="email_address" id="email_address" type="text" placeholder="Enter Email" class="cbp-search-input">
											</div>
											<div class="cbp-l-grid-projects-desc">
												<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="54" rows="4" title="Please Enter Message"  placeholder="<?php esc_html_e( 'Enter Message', 'falcons' ); ?>"  ></textarea>
											</div>
											 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo $id; ?>">
											  <a onclick="send_message_iv();" class="btn btn-primary full-width"><?php esc_html_e( 'Send Message', 'falcons' ); ?></a>
												<div id="update_message_popup"></div>
											</form>
										<?php
										}else{
												echo get_option('_iv_visibility_login_message');

										}
										?>
									</div>


								</div>

								<div class="falcons-sidebar">
									<div class="sidebar-content claims">
											<?php
											$dir_claim_show=get_option('_dir_claim_show');
											if($dir_claim_show==""){$dir_claim_show='yes';}
											if($dir_claim_show=='yes'){
												if(get_post_meta($id,'iv_cpt1_approve',true)!='yes'){
												?>

												<div class="cbp-l-project-details-title"><span><?php esc_html_e('Claim','falcons'); ?></span></div>
												 <form action="" id="message-claim" name="message-claim"  method="POST" role="form">
														<div class="cbp-l-grid-projects-desc">
															<input id="subject" name ="subject" type="text" placeholder="Enter Subject" Value="<?php esc_html_e('Claim The Listing', 'falcons' ); ?>" class="cbp-search-input">
														</div>
														<div class="cbp-l-grid-projects-desc">
															<textarea name="message-content" id="message-content"  class="cbp-search-"  cols="56" rows="4" title="Please Enter Message"  placeholder="<?php esc_html_e( 'Enter Message', 'falcons' ); ?>"  ></textarea>
														</div>
														 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo $id; ?>">
														  <a onclick="send_message_claim();" class="btn btn-primary full-width"><?php esc_html_e( 'Submit Claim', 'falcons' ); ?></a>
															<div id="update_message_claim"></div>

													</form>

											<?php
											}
										}
											?>
									</div>

								</div>



						</div>	<!--falcons-sidebar -->

				</div><!-- End col-md-3-->



		</div>
	</div>




</div>
</div></div></div>



<?php

  /*
wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/meet-team.js');
wp_enqueue_script('single-cpt1-js', falcons_JS.'single-cpt1.js', array('jquery'), $ver = true, true );
wp_localize_script('single-cpt1-js', 'falcons_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',
'current_user_id'	=>get_current_user_id(),
'login_message'		=> __('Please login to remove favorite','falcons'),
'Add_to_Favorites'		=> __('Add to Favorites','falcons'),
'Login_claim'		=> __('Please login to Claim The Listing','falcons'),
'login_favorite'	=> __("Please login to add favorite",'falcons'),
) );
 */

  ?>


<script type="text/javascript">

(function($, window, document, undefined) {
    'use strict';
    // init cubeportfolio
    var singlePage = jQuery('#js-singlePage-container').children('div');
    jQuery('#js-grid-slider-projects').cubeportfolio({
        layoutMode: 'slider',
        drag: true,
        auto: false,
        autoTimeout: 4000,
        autoPauseOnHover: true,
        showNavigation: true,
        showPagination: true,
        rewindNav: false,
        scrollByPage: false,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 1500,
            cols: 5
        }, {
            width: 1100,
            cols: 4
        }, {
            width: 800,
            cols: 3
        }, {
            width: 480,
            cols: 3
        }, {
            width: 320,
            cols: 1
        }],
        gapHorizontal: 0,
        gapVertical: 25,
        caption: 'overlayBottomReveal',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,
        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
        singlePageAnimation: 'fade',
        singlePageCallback: function(url, element) {
            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var indexElement = $(element).parents('.cbp-item').index(),
                item = singlePage.eq(indexElement);
            this.updateSinglePage(item.html());},
    });
})(jQuery, window, document);

</script>
