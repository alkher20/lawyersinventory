<?php

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}



$title=(isset($atts['cpt2_category_title'])?$atts['cpt2_category_title']:'Lawyers Categories');
$banner_subtitle=(isset($atts['cpt2_category_sub_title'])?$atts['cpt2_category_sub_title']:'With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court');

$backg_image=(isset($atts['cpt2_category_image'])?$atts['cpt2_category_image']:'');
if($backg_image==''){
 $backg_image=falcons_IMAGE.'cpt2-category-bg.jpg';
}else{
 $backg_image=wp_get_attachment_url($backg_image);
}

global $post,$wpdb,$tag;



?>
	<div class="pb50 " style="background: url(<?php echo $backg_image;?>) top center no-repeat;background-size: cover;position: relative;padding-top: 30px;">
		<div class="container">
		<div class="row">
			<div class="col-md-12">
			<div class="row">
			<h2 class="home-title" style="text-align: center;"><strong>				
				<?php echo $title;?>
				
				</strong></h2>	
				<div class="home-subtitle"><?php echo $banner_subtitle;?></div>		
			<div class="categories-imgs text-center">
				<?php
						
							//directories
							$taxonomy = $directory_url_2.'-category';
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
								//'parent'            => '0',
								'hierarchical'      => true,
								'child_of'          => 0,
								'childless'         => false,
								'show_count'               => '1',

							);
							if(isset($atts['cpt2_category_only_slug']) AND $atts['cpt2_category_only_slug']!=''){
								$slugsarr=explode(",",$atts['cpt2_category_only_slug']);	
								$args['slug']=$slugsarr;
							}	
				$terms = get_terms($taxonomy,$args); // Get all terms of a taxonomy
				if ( $terms && !is_wp_error( $terms ) ) :
						$i=0;
						foreach ( $terms as $term_parent ) {

							if($term_parent->count>0){

								$feature_img_id = get_option('_cate_main_image_'.$term_parent->term_id);
								$feature_img=falcons_IMAGE.'default-lawyer-category.png';
								$feature_image = wp_get_attachment_image_src( $feature_img_id, 'large' );
								if($feature_image[0]!=""){
									$feature_img=$feature_image[0];
									$feature_img_width=$feature_image[1];
									$feature_img_height=$feature_image[2];

								}
								 $cat_link= get_term_link($term_parent , $directory_url_2.'-category');
							?>
							<div class="col-md-3 col-sm-6">
								<a href="<?php echo $cat_link; ?>" style="color:#000000;">
									<div class="image-wrapper-content">
										<img src="<?php echo $feature_img; ?>" class="home-category-img" alt="home category">
										<div class="categories-wrap-shadow"></div>
										<div class="inner-meta ">
											<!-- <div><?php echo $term_parent->name; ?></div>
											<small>(<?php echo $term_parent->count; ?>)</small> -->
											<i class="fa fa-link"></i>
										</div>
									</div>


									<span style="font-size:15px;"><?php echo $term_parent->name; ?></span>

								</a>
							</div>
						<?php
							}
						}
				endif;
				?>
			</div>
			</div>
			</div>

	</div>
			</div>
</div>
