<?php
// VC elements
add_action('vc_before_init', 'falcons_top_banner');
function falcons_top_banner(){
					vc_map( array(
						  "name" => esc_html__( "Home Top Banner", "falcons" ),
						  "base" => "falcons_top",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						   array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Banner Top Icon", "falcons" ),
								"param_name" => "banner_top_icon",
								"value" => esc_html__( "fa fa-university", "falcons" ),
								"description" => __( "You can more Icon code here : https://fontawesome.com/v4.7.0/icons/ ", "falcons" )
								
							 ),
						  array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( " Top Banner Image", "falcons" ),
								"param_name" => "top_banner",								
								),							 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "top_title",
								"value" => esc_html__( "Lawyers Directory", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "top_sub_title",
								"value" => esc_html__( "SEARCH FOR LAW FIRM AND LAWYERS ON WORLD WIDE BASIS", "falcons" ),								
							 ),
							
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Lawfirm Button Text", "falcons" ),
								"param_name" => "lawfirm_button_text",
								"value" => esc_html__( "FIND A Lawfirm", "falcons" ),								
							 ),
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Lawfirm Button Link", "falcons" ),
								"param_name" => "lawfirm_button_link",
								"value" => esc_html__( "", "falcons" ),								
							 ),	
							 					 
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "lawyer Button Text", "falcons" ),
								"param_name" => "lawyer_button_text",
								"value" => esc_html__( "FIND A lawyer", "falcons" ),								
							 ),	
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "lawyer Button Link", "falcons" ),
								"param_name" => "lawyer_button_link",
								"value" => esc_html__( "", "falcons" ),								
							 ),	
							  array(
								"type" => "checkbox",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Banner Search Bar", "falcons" ),
								"param_name" => "top_search_bar",
								"value" => esc_html__( "1", "falcons" ),								
							 ),
						  )
					   ) );
				
				}
add_shortcode('falcons_top', 'falcons_top_func');	

function falcons_top_func($atts, $content = null ){	
									
	include('vc/top_banner.php');				
}	
//********* 3 home page blocks
add_action('vc_before_init', 'falcons_top_blocks');
function falcons_top_blocks(){
					vc_map( array(
						  "name" => esc_html__( "Home Top 3 Blocks", "falcons" ),
						  "base" => "falcons_top_3blocks",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						  array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Color", "falcons" ),
								"param_name" => "block1_color",
								"value" => esc_html__( "#f5f5f5", "falcons" ),
								
								
							 ),
						   array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Top Icon", "falcons" ),
								"param_name" => "block1_top_icon",
								"value" => esc_html__( "fa-briefcase", "falcons" ),
								"description" => __( "You can more Icon code here : https://fontawesome.com/v4.7.0/icons/ ", "falcons" )
								
							 ),
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Top Title", "falcons" ),
								"param_name" => "b1top_title",
								"value" => esc_html__( "Lawfirm", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Sub Title", "falcons" ),
								"param_name" => "b1top_sub_title",
								"value" => esc_html__( "With Over 300 Law firm across 20 countries falcon directory is the right place to find your closest Law office", "falcons" ),								
							 ),
							 
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Button Text", "falcons" ),
								"param_name" => "b1button_title",
								"value" => esc_html__( "SEARCH NOW", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 1 Button Link", "falcons" ),
								"param_name" => "b1top_button_link",
								"value" => esc_html__( "", "falcons" ),								
							 ),							 
							
							 array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Color", "falcons" ),
								"param_name" => "block2_color",
								"value" => esc_html__( "#f5f5f5", "falcons" ),
								
								
							 ),
							   array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Top Icon", "falcons" ),
								"param_name" => "block2_top_icon",
								"value" => esc_html__( "fa-black-tie", "falcons" ),
								"description" => __( "You can more Icon code here : https://fontawesome.com/v4.7.0/icons/ ", "falcons" )
								
							 ),
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Top Title", "falcons" ),
								"param_name" => "b2top_title",
								"value" => esc_html__( "lawyer", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Sub Title", "falcons" ),
								"param_name" => "b2top_sub_title",
								"value" => esc_html__( "Find the right lawyer within the closest Lawfirm across a wide range of medical fields including neurosurgery", "falcons" ),								
							 ),
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Button Text", "falcons" ),
								"param_name" => "b2button_title",
								"value" => esc_html__( "SEARCH NOW", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 2 Button Link", "falcons" ),
								"param_name" => "b2top_button_link",
								"value" => esc_html__( "", "falcons" ),								
							 ),	
							  array(
								"type" => "colorpicker",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Color", "falcons" ),
								"param_name" => "block3_color",
								"value" => esc_html__( "#f5f5f5", "falcons" ),
								
								
							 ),	
							   array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Top Icon", "falcons" ),
								"param_name" => "block3_top_icon",
								"value" => esc_html__( "fa-diamond", "falcons" ),
								"description" => __( "You can more Icon code here : https://fontawesome.com/v4.7.0/icons/ ", "falcons" )
								
							 ),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Top Title", "falcons" ),
								"param_name" => "b3top_title",
								"value" => esc_html__( "Register Now", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Sub Title", "falcons" ),
								"param_name" => "b3top_sub_title",
								"value" => esc_html__( "You're a medical center with Lawfirms and lawyers worldwide, Lawyers Directory is the right place to list your Lawfirms and lawyers, join us now", "falcons" ),								
							 ), 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Button Text", "falcons" ),
								"param_name" => "b3button_title",
								"value" => esc_html__( "Register", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Block 3 Button Link", "falcons" ),
								"param_name" => "b3top_button_link",
								"value" => esc_html__( "", "falcons" ),								
							 ),		
						  
							 
							 
						  )
					   ) );
				
				}
add_shortcode('falcons_top_3blocks', 'falcons_top_3blocks_func');	

function falcons_top_3blocks_func($atts, $content = null ){	
									
	include('vc/top_3blocks.php');				
}	
// CPT 1 category
$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='Lawfirm';}	

add_action('vc_before_init', 'falcons_cpt1_category');
function falcons_cpt1_category(){
					vc_map( array(
						  "name" => esc_html__( "Lawfirm Categories", "falcons" ),
						  "base" => "falcons_cpt1_category",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						  						 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "cpt1_category_title",
								"value" => esc_html__( "Lawfirm Categories", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "cpt1_category_sub_title",
								"value" => esc_html__( "With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court", "falcons" ),								
							 ),							
							
						  )
					   ) );
				
				}
add_shortcode('falcons_cpt1_category', 'falcons_cpt1_category_func');	

function falcons_cpt1_category_func($atts, $content = null ){	
									
	include('vc/ctp1_category.php');				
}

// CPT 2 category


add_action('vc_before_init', 'falcons_cpt2_category');
function falcons_cpt2_category(){
					vc_map( array(
						  "name" => esc_html__( "lawyer Categories", "falcons" ),
						  "base" => "falcons_cpt2_category",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						    array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( " Background Image", "falcons" ),
								"param_name" => "cpt2_category_image",								
								),		
						  						 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "cpt2_category_title",
								"value" => esc_html__( "lawyer Categories", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "cpt2_category_sub_title",
								"value" => esc_html__( "With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court", "falcons" ),								
							 ),	
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Categores Only", "falcons" ),
								"param_name" => "cpt2_category_only_slug",
								"description" => __( "You can add category slugs", "falcons" )								
							 ),							
							
						  )
					   ) );
				
				}
add_shortcode('falcons_cpt2_category', 'falcons_cpt2_category_func');	

function falcons_cpt2_category_func($atts, $content = null ){	
									
	include('vc/ctp2_category.php');				
}
/// Feature Lawfirm

add_action('vc_before_init', 'falcons_ctp1_featured');
function falcons_ctp1_featured(){
					vc_map( array(
						  "name" => esc_html__( "Lawfirm Featured", "falcons" ),
						  "base" => "falcons_ctp1_featured",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						    array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( " Background Image", "falcons" ),
								"param_name" => "cpt1_featured_image",								
								),		
						  						 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "cpt1_featured_title",
								"value" => esc_html__( "Featured Lawfirm", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "cpt1_featured_sub_title",
								"value" => esc_html__( "With Over 300 Law firm across 20 countries falcon directory is the right place to find your closest Law office", "falcons" ),								
							 ),	
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Featured Lawfirm IDs", "falcons" ),
								"param_name" => "cpt1_featured_ids",
								"description" => __( "10,20,36", "falcons" )								
							 ),							
							
						  )
					   ) );
				
				}
add_shortcode('falcons_ctp1_featured', 'falcons_ctp1_featured_func');	

function falcons_ctp1_featured_func($atts, $content = null ){	
									
	include('vc/ctp1_featured.php');				
}


// CPT 2 featured


add_action('vc_before_init', 'falcons_ctp2_featured');
function falcons_ctp2_featured(){
					vc_map( array(
						  "name" => esc_html__( "lawyer Featured", "falcons" ),
						  "base" => "falcons_ctp2_featured",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						    array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( " Background Image", "falcons" ),
								"param_name" => "cpt2_featured_image",								
								),		
						  						 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "cpt2_featured_title",
								"value" => esc_html__( "Featured lawyer", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "cpt2_featured_sub_title",
								"value" => esc_html__( "With over 5000 lawyers and experts in the healthcare field Lawyers Directory provides a listing of all lawyers
across a wide variety if medical fields", "falcons" ),								
							 ),	
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Featured lawyer IDs", "falcons" ),
								"param_name" => "cpt2_featured_ids",
								"description" => __( "10,20,36", "falcons" )								
							 ),							
							
						  )
					   ) );
				
				}
add_shortcode('falcons_ctp2_featured', 'falcons_ctp2_featured_func');	

function falcons_ctp2_featured_func($atts, $content = null ){	 
									
	include('vc/ctp2_featured.php');				
}

// Latest Post
add_action('vc_before_init', 'falcons_latest_post');
function falcons_latest_post(){
					vc_map( array(
						  "name" => esc_html__( "Latest Post", "falcons" ),
						  "base" => "falcons_latest_post",
						  'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  "params" => array(
						   			 
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Top Title", "falcons" ),
								"param_name" => "latest_post_title",
								"value" => esc_html__( "Latest Post", "falcons" ),
								
							 ),
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Sub Title", "falcons" ),
								"param_name" => "latest_post_sub_title",
								"value" => esc_html__( "With over 5000 lawyers and experts in the healthcare field Lawyers Directory provides a listing of all lawyers
across a wide variety if medical fields", "falcons" ),								
							 ),	
							  array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => esc_html__( "Post IDs", "falcons" ),
								"param_name" => "latest_post_ids",
								"description" => __( "10,20,36", "falcons" )								
							 ),							
							
						  )
					   ) );
				
				}
add_shortcode('falcons_latest_post', 'falcons_latest_post_func');	

function falcons_latest_post_func($atts, $content = null ){	 
									
	include('vc/latest_post.php');				
}

