<?php get_header();

wp_enqueue_style('iv_directories-style-110', falcons_CSS . 'listing_style_1.css');
wp_enqueue_style('iv_directories-style-64', wp_iv_directories_URLPATH . 'assets/cube/css/cubeportfolio.css');
wp_enqueue_script('iv_directories-script-12', wp_iv_directories_URLPATH . 'admin/files/js/markerclusterer.js');
wp_enqueue_style('single-cpt1-style-2', falcons_CSS.'single-cpt1.css', array(), $ver = false, $media = 'all');
$default_fields=array();$feature_id='';
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

$directory_url_1=get_option('_iv_directory_url_1');
if($directory_url_1==""){$directory_url_1='law-firms';}

$directory_url_2=get_option('_iv_directory_url_2');
if($directory_url_2==""){$directory_url_2='lawyers';}


$ins_lat='37.4419';
$ins_lng='-122.1419';


$search_button_show=get_option('_search_button_show');
if($search_button_show==""){$search_button_show='yes';}

$dir_searchbar_show=get_option('_dir_searchbar_show');
if($dir_searchbar_show==""){$dir_searchbar_show='yes';}

$dir_map_show=get_option('_dir_map_show');
if($dir_map_show==""){$dir_map_show='yes';}

$dir_popup=get_option('_dir_popup');	
if($dir_popup==""){$dir_popup='yes';}


$dirs_data =array();
$tag_arr= array();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	'post_type' => $directory_url_1, // enter your custom post type
	'paged' => $paged,
	'post_status' => 'publish',
	
);

$lat='';$long='';$keyword_post='';$address='';$postcats ='';$selected='';



if(get_query_var($directory_url_1.'-category')!=''){
		$postcats = get_query_var($directory_url_1.'-category');
		$args[$directory_url_1.'-category']=$postcats;
		$selected=$postcats;

}

if( isset($_POST[$directory_url_1.'-category'])){
	if($_POST[$directory_url_1.'-category']!=''){
		$postcats = $_POST[$directory_url_1.'-category'];
		$args[$directory_url_1.'-category']=$postcats;
		$selected=$postcats;
		$search_show=1;
		$args['posts_per_page']='999999';
	}
}


$radius=get_option('_iv_radius');
if( isset($_POST['range_value'])){
	$radius = $_POST['range_value'];
}
if($radius==''){$radius='50';}


if( isset($_POST['address'])){
	if($_POST['address']!=""){
		
		$address = str_replace(" ", "+", $_POST['address']);
		$json = file_get_contents( "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=" . urlencode( $address ));	
		$json = json_decode($json);
		if(isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'})){
			$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		}
		if(isset($json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'})){
			$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		}	
		
		
	
		$lat =  $lat;
		$long = $long;
		$address=trim($_POST['address']);
		$args['lat']=$lat;
		$args['lng']=$long;
		$args['distance']=$radius;
		$search_show=1;
		$args['posts_per_page']='999999';
	}
}
if( isset($_POST['keyword'])){
	if($_POST['keyword']!=""){
		$args['s']= $_POST['keyword'];
		$keyword_post=$_POST['keyword'];
		$search_show=1;
		$args['posts_per_page']='999999';
	}
}

if( isset($_POST['tag_arr'])){
	if($_POST['tag_arr']!=""){
		$tag_arr= $_POST['tag_arr'];
		//$tag_arr= get_query_var('tag_arr');
		$tags_string= implode("+", $tag_arr);
		$args['tag']= $tags_string;

	}
}
$city_mq ='';
if(isset($_REQUEST['dir_city']) AND $_REQUEST['dir_city']!=''){							
	$city_mq = array(
	'relation' => 'AND',
		array(
			'key'     => 'city',
			'value'   => $_REQUEST['dir_city'],
			'compare' => 'LIKE'
		),
	);
}
$dir_specialities='';
if( isset($_POST['dir_Specialities'])){
	if($_POST['dir_Specialities']!=''){
		
		$dir_specialities = array(
			'relation' => 'AND',
				array(
					'key'     => 'specialtie',
					'value'   => $_REQUEST['dir_Specialities'],
					'compare' => 'LIKE'
				),
			);	
		
		
	}
}
		$args['meta_query'] = array(
			$city_mq, $dir_specialities,
		);

$the_query = new WP_GeoQuery( $args );

$main_class = new wp_iv_directories;

$paid_ids= array();

$directory_url_1_string=str_replace("-"," ",$directory_url_1); 
$directory_url_1_string= (isset($falcons_option_data['falcons-home-hearder-block1'])?$falcons_option_data['falcons-home-hearder-block1']:$directory_url_1_string);
?>

 <?php
		$top_breadcrumb_image= falcons_IMAGE."banner-breadcrumb.jpg";
        if(isset($falcons_option_data['falcons-banner-breadcrumb']['url']) AND $falcons_option_data['falcons-banner-breadcrumb']['url']!=""):
			$top_breadcrumb_image=esc_url($falcons_option_data['falcons-banner-breadcrumb']['url']);
         endif;
         
         $falcons_breadcrumb_value='1';
         if(isset($falcons_option_data['falcons-breadcrumb']) AND $falcons_option_data['falcons-breadcrumb']!=""):
			$falcons_breadcrumb_value=$falcons_option_data['falcons-breadcrumb'];
         endif;
         
         
         if($falcons_breadcrumb_value=='1'){ 
		?>
		 <div class="breadcrumb-content">
			<img   src="<?php echo $top_breadcrumb_image;?>" alt="<?php esc_html_e( 'banner', 'falcons' ); ?>">
			<div class="container">
				<h3> <?php
					  echo esc_attr (ucwords($directory_url_1_string));
					?></h3>
			</div>
		</div>	
		<?php
			}
		?>
<div class=" ">
		<!-- Map**************-->

		<div id="top-map" class="<?php echo ($dir_map_show=='yes'? '': 'div-hide') ?>">
			<div id="map"> </div>
		</div>


	 <div id="top-search" class=" navbar-default navbar <?php echo ($dir_searchbar_show=='yes'? '': 'div-hide') ?>" >
		<div class=" navbar-collapse text-left" >
				<form class="form-inline advanced-serach" action="<?php echo get_post_type_archive_link( $directory_url_1) ; ?>" method="POST"  >
				<div class="container">
					<div class="input-field">
					<div class="">
						 <div class="form-group" >
								<input type="text" class="form-control " id="keyword" name="keyword"  placeholder="<?php esc_html_e( 'Keyword', 'falcons' ); ?>" value="<?php echo esc_attr($keyword_post); ?>">
								<?php $pos = $main_class->get_unique_keyword_values('keyword',$directory_url_1);
								?>
								<script>									
									jQuery(function() {
									var availableTags = [ "<?php echo  implode('","',$pos); ?>" ];
									jQuery( "#keyword" ).autocomplete({source: availableTags});
								  });
								  
								</script> 
						  </div>
				  </div>
				  <div class="">

					  <div class="form-group" >
					  <i class="fa fa-chevron-down arrow"></i>
									<?php
								echo '<select name="cpt1-category" class="form-control">';
								echo'	<option selected="'.$selected.'" value="">'.esc_html__('Any Category','falcons').'</option>';


										if( isset($_REQUEST['cpt1-category'])){
											$selected = $_REQUEST['cpt1-category'];
										}
											//directories
											$taxonomy = $directory_url_1.'-category';
											$args = array(
												'orderby'           => 'name',
												'order'             => 'ASC',
												'hide_empty'        => true,
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


											<?php

											echo '<option  value="'.$term_parent->slug.'" '.($selected==$term_parent->slug?'selected':'' ).'><strong>'.$term_parent->name.'</strong></option>';
											?>
												<?php

												$args2 = array(
													'type'                     => $directory_url_1,
													'parent'                   => $term_parent->term_id,
													'orderby'                  => 'name',
													'order'                    => 'ASC',
													'hide_empty'               => 1,
													'hierarchical'             => 1,
													'exclude'                  => '',
													'include'                  => '',
													'number'                   => '',
													'taxonomy'                 => $directory_url_1.'-category',
													'pad_counts'               => false

												);
												$categories = get_categories( $args2 );
												if ( $categories && !is_wp_error( $categories ) ) :


													foreach ( $categories as $term ) {
														echo '<option  value="'.$term->slug.'" '.($selected==$term->slug?'selected':'' ).'>-'.$term->name.'</option>';
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
					<div class="">
						<div class="form-group" >
								<input type="text" class="form-control location-input " id="address" name="address"  placeholder="<?php esc_html_e( 'Location', 'falcons' ); ?>"
								value="<?php echo trim($address); ?>">
								<i class="fa fa-map-marker marker"></i>
								
								<?php
								
								if(isset($_REQUEST['city'])){$city=$_REQUEST['city'];}else{$city='';}
								if($address!=''){
										$x = file_get_contents( "http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=" . urlencode( $address ));									
										$o = json_decode( $x );
										if(isset($o->results[0]->address_components)){
											foreach ( $o->results[0]->address_components as $component ) {
												if ( $component->types[0] == 'locality' ){
													$city= $component->long_name;
												}
											}									
										
											$lat = $o->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
											$long = $o->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
									}	
										
								}	
								?>
								<input type="hidden" id="city" name="city"  value="<?php echo esc_attr($city); ?>" >
								<input type="hidden" id="latitude" name="latitude"  value="<?php echo esc_attr($lat); ?>" >
								<input type="hidden" id="longitude" name="longitude"  value="<?php echo esc_attr($long); ?>">
					  </div>
					 </div>
					 <div class="">
					<?php
					$args_citys = array(
						'post_type'  => $directory_url_1,
						'posts_per_page' => -1,
						'meta_query' => array(
							array(
								'key'     => 'city',	
								'orderby' => 'meta_value', 
								'order' => 'ASC',		
							),
							
						),
					);
					$citys = new WP_Query( $args_citys );	
					$citys_all = $citys->posts;
					$get_cityies =array();
					foreach ( $citys_all as $term ) {
						$new_city="";
						$new_city=ucfirst(trim(get_post_meta($term->ID,'city',true)));
						if (!in_array($new_city, $get_cityies)) {
							$get_cityies[]=ucfirst($new_city);
						
						}	
					}	
					?>
						<div class="form-group " >
						 <select name="dir_city"  id="dir_city" class="form-control" >
							  <option   value="">
							  <?php esc_html_e('Choose a City   ','falcons'); ?>
							  </option>							  
							  <?php		
									$selected_city= (isset($_REQUEST['dir_city'])?$_REQUEST['dir_city']:'' );
													
										if(count($get_cityies)) {
												asort($get_cityies);
										  foreach($get_cityies as $row1) {
											  if($row1!=''){													  
											  ?>
												<option   value="<?php echo $row1; ?>" <?php echo ($selected_city==$row1?'selected':''); ?>><?php echo $row1; ?></option>
											<?php
											}
												
											}
										  
										} 
											
										?>
							</select>
						
					  </div>
				  </div>
				 
					 <div class="">
							<div class="form-group search" >
								<button type="submit" id="submit" name="submit"  class="btn-new btn-custom-search "><i class="fa fa-search"></i> <span><?php esc_html_e( 'Search', 'falcons' ); ?></span></button>
							</div>
						</div>
					</div>
					</div>
				</form>

	 </div>
	</div>

</div>

<div class="blog-content bg-white">
	<div class="listing-filter-content">

	<div class="container">
		 <div class="clearfix top-8" >
			<?php
			if($search_button_show=='yes'){
			?>
			 <div class="cbp-l-filters-button cbp-l-filters-right">
		        <div id="search_toggle_div" class="cbp-filter-item" onclick="toggle_top_search('top-search');" ><i class="fa fa-search listing-padding-right" ></i><?php esc_html_e( 'Search', 'falcons' ); ?></div>
		        <div  id="map_toggle_div"  class="cbp-filter-item" onclick="toggle_top_map('top-map');"><i class="fa fa-globe listing-padding-right" ></i><?php esc_html_e( 'Show Map', 'falcons' ); ?></div>
		    </div>
		    <?php
			}
		    ?>

			 <div id="js-filters-meet-the-team" class="cbp-l-filters-button cbp-l-filters-left" >
				<?php
					if($postcats==''){	?>

						<div data-filter="*" class="cbp-filter-item">
							<?php esc_html_e('Show All', 'falcons' ); ?>
						</div>
						<?php

						$argscat = array(
							'type'                     => $directory_url_1,
							'orderby'                  => 'name',
							'order'                    => 'ASC',
							'hide_empty'               => true,
							'hierarchical'             => 1,
							'exclude'                  => '',
							'include'                  => '',
							'number'                   => '',
							'taxonomy'                 => $directory_url_1.'-category',
							'pad_counts'               => false

						);
						$categories = get_categories( $argscat );

						if ( $categories && !is_wp_error( $categories ) ) :
							foreach ( $categories as $term ) {							
								?>
								<div data-filter="" class="cbp-filter-item"><a href="<?php echo get_post_type_archive_link( $directory_url_1 ).'?&'.$directory_url_1.'-category='.$term->slug ; ?>">
									<?php echo esc_attr($term->name); ?>
									</a>
								</div>
							<?php
							}
						endif;
				}
				if($postcats!=''){ ?>
						<div data-filter="" class="cbp-filter-item"><a href="<?php echo get_post_type_archive_link( $directory_url_1) ; ?>">
							<?php esc_html_e('Show All', 'falcons' ); ?>
							</a>
						</div>

					<?php

					 $custom_cat_obj =  get_term_by('slug',$postcats,$directory_url_1.'-category');

					echo '<div data-filter=".'.$postcats.'"  class="cbp-filter-item-active cbp-filter-item"> '.$custom_cat_obj->name.' <div class="cbp-filter-counter"></div></div>';


				}
				?>
			</div>
	</div>
	</div>
	</div>




<div class="container">
  <div class="row " >
			
		<?php
		$selected_cat='';
		if( isset($_REQUEST['cpt1-category'])){
			$selected_cat = $_REQUEST['cpt1-category'];
		}
		if($selected_cat!='' AND $city!='' ){	
			$arg_f = array(
				'post_type' => $directory_url_1, // enter your custom post type
				'posts_per_page' => '1',
				'post_status' => 'publish',
				
			);
			$arg_f['meta_query'] = array(
							'relation' => 'AND',
									array(
									'key'     => '_iv_feature_category',
									'value'   => $selected_cat,
									'compare' => '='
								),
										array(
								'key'     => '_iv_feature_location',
								'value'   => $city,
								'compare' => '='
							),
				);
		
		
		$query_feature = new WP_Query( $arg_f );
		  
		 if ( $query_feature->have_posts() ) :
			while ( $query_feature->have_posts() ) : $query_feature->the_post();
			$id = get_the_ID();
			$feature_id = get_the_ID();
			?>
			<div class="col-md-12 ">
				<div class="col-md-12 " style=" background-color: #c29c6a; color: #FFFFFF; font-size: 16px;font-weight: bold; height:30px; margin-top:15px;">				 
					 <p class="text-center" ><strong>Featured Law Firm </strong></p>
				</div>
				<div class="col-md-12" style=" border: 3px solid #c29c6a;">
					<div class="col-md-3 "  >
						<h5>
						<?php
						echo get_the_title($id);
						?>						
						</h5>
						<p class="location-lists">
							<?php echo get_post_meta($id ,'address',true);?>
						</p>	
						<p>
							Phone :<br/> <?php echo get_post_meta($id ,'phone',true);?>
						</p>
					</div>
					<div class="col-md-2"  class="text-center" style="">
						<?php
						$logo_image_id=get_post_meta($id ,'logo_image_id',true);
						if($logo_image_id>0){?>

							<img   style="margin-top:15px; max-height:200px;vertical-align:middle; text-align:center;" src="<?php echo wp_get_attachment_url( $logo_image_id ); ?> " alt="<?php esc_html_e( 'image', 'falcons' ); ?>">

						<?php
						}
						?>
					</div>
					<div class="col-md-3" >
						<p style="margin-top:15px;">
						<?php
						
						echo substr( get_post_field('post_content', $id),0, 150);;
						?>
						<p>
							<div class="text-center">	
							<a class="btn btn-primary " style="width: 70%;" href="<?php echo get_permalink($id); ?>"><?php esc_html_e( 'Learn More', 'falcons' ); ?></a>
						 </div>
					</div>
					<?php
						$feature_img='';
							if(has_post_thumbnail()){
								$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' );
								if($feature_image[0]!=""){
									$feature_img =$feature_image[0];
								}
							}else{
								$feature_img= wp_iv_directories_URLPATH."/assets/images/default-directory.png";

							}
						?>
					<div class="col-md-4" style="margin-top:15px;margin-bottom:15px; min-height:200px;background: url('<?php echo esc_attr($feature_img);?>') center center no-repeat; background-size: cover;">
						
						
					</div>
					
					
					 
				</div>
			</div>
			<?php
				
				
				endwhile;
			endif;	
		}	
		?>
		

	  	  
	  
    <div class="col-md-12">
		


<div id="js-grid-meet-the-team" class="cbp cbp-l-grid-team" >
   <?php
$i=1;
 if ( $the_query->have_posts() ) :

while ( $the_query->have_posts() ) : $the_query->the_post();
			$id = get_the_ID();

			$gallery_ids=get_post_meta($id ,'image_gallery_ids',true);
			$gallery_ids_array = array_filter(explode(",", $gallery_ids));

			$dir_data['link']=get_post_permalink();
			$dir_data['title']=$post->post_title;
			$dir_data['lat']=get_post_meta($id,'latitude',true);
			$dir_data['lng']=get_post_meta($id,'longitude',true);
			if($i==1){
				if(get_post_meta($id,'latitude',true)!=''){$ins_lat=get_post_meta($id,'latitude',true);}
				if(get_post_meta($id,'longitude',true)!=''){$ins_lng=get_post_meta($id,'longitude',true);}
			}
			$dir_data['address']=get_post_meta($id,'address',true);
			$dir_data['image']= '';
			$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail' );
			if($feature_image[0]!=""){
				//$dir_data['image']= '<img class=" img-responsive" src="'. $feature_image[0].'">';
				$dir_data['image']=  $feature_image[0];
			}
			$dir_data['marker_icon']=wp_iv_directories_URLPATH."/assets/images/map-marker/map-marker.png";
			$currentCategoryId='';
			$terms =get_the_terms($id, $directory_url_1."-category");
			if($terms!=""){
				foreach ($terms as $termid) {
					if(isset($termid->term_id)){
						 $currentCategoryId= $termid->term_id;
					}
				}
			}
			
			$marker = get_option('_cat_map_marker_'.$currentCategoryId,true);
			if($marker!=''){
				if($feature_id==$id){
					$dir_data['marker_icon']=falcons_IMAGE."map-marker.png";
				}else{	
					$image_attributes = wp_get_attachment_image_src( $marker ); // returns an array
					if( $image_attributes ) {

						$dir_data['marker_icon']= $image_attributes[0];
					}
				}
			}
			
			array_push( $dirs_data, $dir_data );
				$feature_img='';
				if(has_post_thumbnail()){
					$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'medium' );
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
				<div class="cbp-item <?php echo esc_attr($cat_slug); ?> ">
					<?php
					if($dir_popup=='yes'){
					?>
					<a href="<?php echo admin_url('admin-ajax.php'); ?>?action=iv_cpt1_ajax_single&id=<?php echo esc_attr($id); ?>" class="cbp-caption cbp-singlePage" rel="nofollow">
					<?php
					}else{
					?>
						<a href="<?php echo get_post_permalink(); ?>" class="cbp-caption" >
					<?php
					}
					?>
						<div class="cbp-caption-defaultWrap">
							<div class="image-container" style="background: url('<?php echo esc_attr($feature_img);?>') center center no-repeat; background-size: cover;">
							</div>
						</div>
						<div class="cbp-caption-activeWrap for-cpt1">
							<div class="cbp-l-caption-alignCenter">
								<div class="cbp-l-caption-body">
									<div class="cbp-l-caption-text"><?php esc_html_e('VIEW DETAIL', 'falcons' ); ?></div>
								</div>
							</div>
						</div>
					</a>
					<a href="<?php echo get_post_permalink(); ?>" class="cbp-l-grid-team-name" ><?php echo esc_attr($post->post_title); ?></a>
					<div class="cbp-l-grid-team-position"><?php echo esc_attr($cat_name).'&nbsp;'; ?>
						<?php
							$total_count=0;
							$total_count=get_post_meta($id,'_rating_total_count',true);
							$i=1;$total_rating_value=0;$avg_rating=0;
							if(sizeof($default_fields)>0){
								foreach ( $default_fields as $field_key => $field_value ) {
									$field_value_trim=trim($field_value);
									$total_rating_value=(int)$total_rating_value +(int)get_post_meta($id,$field_key.'_rating',true);
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
				</div>
	<?php
	$i++;

endwhile;
			$dirs_json ='';
			if(!empty($dirs_data)){
				//$dirs_json =json_encode($dirs_data);
				$dirs_json =$dirs_data;
			}

			?>


	<?php else :
		$dirs_json='';
	 ?>



	<?php endif; ?>



</div>
<?php
	if ( !$the_query->have_posts() ){
	esc_html_e( 'Sorry, no data matched your criteria.','falcons' );
	}
?>
	 <!--  start pagination * -->

		<?php
		if ( $the_query->have_posts() ){
			if (function_exists('wp_pagination')){
					 wp_pagination();

			}
		}
	   ?>

	<!--END .navigation-links-->



<?php

wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/meet-team.js');

wp_enqueue_script('archive-listing-1-js', falcons_JS.'archive-listing-1.js', array('jquery'), $ver = true, true );
wp_localize_script('archive-listing-1-js', 'falcons_data', array( 			'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
'loading_image'		=> '<img src="'.falcons_IMAGE.'loader2.gif">',
'current_user_id'	=>get_current_user_id(),
'login_message'		=> esc_html__('Please login to remove favorite','falcons'),
'Add_to_Favorites'	=> esc_html__('Add to Favorites','falcons'),
'Login_claim'		=> esc_html__('Please login to Claim The Listing','falcons'),
'login_favorite'	=> esc_html__("Please login to add favorite",'falcons'),
'login_review'	=> esc_html__("Please login to add review",'falcons'),
'ins_lat'=>$ins_lat,
'ins_lng'=>$ins_lng,
'dirs'=> $dirs_json,
) );
?>



        </div> <!-- end .blog-list -->

  </div>
</div>
</div> <!-- end .page-content -->



<?php get_footer(); ?>
