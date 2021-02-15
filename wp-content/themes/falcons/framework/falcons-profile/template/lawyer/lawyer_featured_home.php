<?php

$feature_post_ids =array();
$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}

 $falcons_option_data =get_option('falcons_option_data');

if(!isset($atts['post_ids']) OR $atts['post_ids']==''){
	$args = array(
		'post_type' => $directory_url_2, // enter your custom post type
		'post_status' => 'publish',
		'showposts'=>'4',
		'orderby' => 'rand',

	);
	$the_feature = new WP_Query( $args );
		 if ( $the_feature->have_posts() ) :
			while ( $the_feature->have_posts() ) : $the_feature->the_post();
						$id = get_the_ID();
						$feature_post_ids[]=$id;
			endwhile;
	 endif;
}else{
		$feature_post_ids = explode(",", $atts['post_ids']);
}


?>

<div class="cpt2-feature-content pt50 pb50 home-shortcodes">
	<div class="container">

			<div class="row">
				<div class="col-md-12 ">
				<div class="row">
					<h2 class="home-title" style="text-align: center;"><strong>
						
						
						<?php echo (isset($falcons_option_data['falcons-header-lawyer_featured'])? $falcons_option_data['falcons-header-lawyer_featured']: 'Featured '.ucfirst($directory_url_2));?>
				
						</strong></h2>

					<div class="categories-imgs text-center">

						<?php
						foreach($feature_post_ids as $fpost){

							 $id =$fpost;
							 $post = get_post($id);

							 if($post!=''){
								$feature_img='';
								if(has_post_thumbnail($id)){
									$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
									if($feature_image[0]!=""){
										$feature_img =$feature_image[0];
									}
								}else{
									$feature_img= wp_iv_directories_URLPATH."/assets/images/default-lawyer.png";

								}

								$currentCategory=wp_get_object_terms( $id, $directory_url_2.'-category');
								$cat_link='';$cat_name='';$cat_slug='';
								if(isset($currentCategory[0]->slug)){
									$cat_slug = $currentCategory[0]->slug;
									$cat_name = $currentCategory[0]->name;

									$cat_link= get_term_link($currentCategory[0], $directory_url_2.'-category');

								}
							?>

							<div class="col-md-3 col-sm-6">


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
								<p> </p>
								</div>
							</a>
							</div>

						<?php
							}

						}

				?>
			</div>
			</div>
	</div>
	</div>
	</div>
</div>
