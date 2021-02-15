<?php


wp_enqueue_style('blog-latest-post', falcons_CSS . 'latest-post.css',array(), $ver = false, $media = 'all');

$title=(isset($atts['latest_post_title'])?$atts['latest_post_title']:'Latest Posts');
$banner_subtitle=(isset($atts['latest_post_sub_title'])?$atts['latest_post_sub_title']:'With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court');

$feature_post_ids= array();
if(!isset($atts['latest_post_ids']) OR $atts['latest_post_ids']==''){
	$args = array(
		'post_type' => 'post', // enter your custom post type
		'post_status' => 'publish',
		'showposts'=>'3',		
		'orderby' => 'rand',
	);
	$the_latest= new WP_Query( $args );
		 if ( $the_latest->have_posts() ) :
			while ( $the_latest->have_posts() ) : $the_latest->the_post();
						$id = get_the_ID();
						$feature_post_ids[]=$id;
			endwhile;
	 endif;
}else{
		$feature_post_ids = explode(",", $atts['latest_post_ids']);
}

?>
			
    <div class="latest-post-area">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                    <div class="latest-post-header">
                        <h2 class="section-title">	<?php echo $title;?></h2>
                        <p><?php echo $banner_subtitle;?></p>
                    </div>
                </div>
            </div>
            <div class="row">				
				<?php
						foreach($feature_post_ids as $fpost){
							$id =$fpost;
							 $post = get_post($id);
							// echo'<pre>';
							 //print_r($post);
							 
							 if($post!=''){
								$feature_img='';
								if(has_post_thumbnail($id)){
									$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
									if($feature_image[0]!=""){
										$feature_img =$feature_image[0];
									}
								}else{
									$feature_img= falcons_IMAGE."post2.jpg";

								}								
							?>
							<div class="col-md-4 col-sm-6 col-xs-12">
							<div class="single-latest-post" style="margin-bottom:20px">
								<div class="latest-post-img">
									<a href="<?php echo get_the_permalink($id);?>"><img src="<?php echo $feature_img;?>" alt=""></a>
								</div>
								<div class="latest-post-content">
									<h3><a href="<?php echo get_the_permalink($id);?>"><?php  echo $post->post_title;?></a></h3>
									<span><?php  echo date('d M Y',strtotime($post->post_date));?></span>
									<p><?php  echo wp_trim_words( $post->post_content, 12, NULL ); ?></p>
									<a class="read-more" href="<?php echo get_the_permalink($id);?>"><?php esc_html_e( 'read more', 'falcons' ); ?></a>
								</div>
							</div>
						</div>

						<?php
							}

						}

				?>
            </div>
        </div>
    </div>
    <!-- latest-post-area-end -->
