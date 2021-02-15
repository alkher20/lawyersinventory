<?php

$feature_post_ids =array();
$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}

if(!isset($atts['city']) OR $atts['city']==''){
	$args = array(
		'post_type' => $directory_url_1, // enter your custom post type		
		'post_status' => 'publish',
		//'showposts'=>'4',
		'orderby' => 'rand',
		
	);
	$the_query_cpt2 = new WP_Query( $args );  
		 
}else{
		$args = array(
		'post_type' => $directory_url_1, // enter your custom post type		
		'post_status' => 'publish',
		//'showposts'=>'4',
		//'orderby' => 'rand',
		
		
	);
	$args['meta_query']= array(
				array(
					'key'     => 'city',
					'value'   => $atts['city'],
					'compare' => 'LIKE',
				),
			);
	$the_query_cpt1 = new WP_Query( $args );  
		
}


?>

<div class="cpt2-feature-content">
	<div class="">
		
			<div class="row">		
				<div class="col-md-12 ">
				<div class="row">
						
					<div class="categories-imgs text-center">
			
						<?php
						 if ( $the_query_cpt1->have_posts() ) :
							while ( $the_query_cpt1->have_posts() ) : $the_query_cpt1->the_post();
						
							
							 $id = get_the_ID();
							 $post = get_post($id);
							 
							 if($post!=''){
								$feature_img='';
								if(has_post_thumbnail($id)){ 
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

							<div class="col-md-4">

							
							<a href="<?php echo get_post_permalink($id); ?>" style="color:#000000;">
								<div class="f-cpt2e-single">
									<div class="image-wrapper-content">
										<img src="<?php echo $feature_img; ?>" class="home-category-img" alt="home category">
										<div class="categories-wrap-shadow"></div>
										<div class="inner-meta ">
											
											<i class="fa fa-link"></i>
										</div>

									</div>
																									
								<span style="font-size:15px; padding-bottom: 0;"><?php echo $post->post_title;  ?></span>
								<p class="f-cpt2-subtitle"><?php echo $cat_name.'&nbsp;'; ?></p>							
								
								</div>
							</a>
							</div>
							
						<?php
							}
						
						
						endwhile;
					endif;	
				
				?>
			</div>
			</div>
	</div>
	</div>
	</div>
</div>
