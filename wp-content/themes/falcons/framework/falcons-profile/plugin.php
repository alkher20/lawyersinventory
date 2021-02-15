<?php



  if (!defined('ABSPATH')) {
  	exit;
  }

  if (!class_exists('wp_iv_directories')) {  	
		
			final class wp_iv_directories {
			
			private static $instance;			
				
				public static function instance() {
					if (!isset(self::$instance) && !(self::$instance instanceof wp_iv_directories)) {
						self::$instance = new wp_iv_directories;
					}
					return self::$instance;
				}
				
				/**
				 * Construct and start the other plug-in functionality
				 */
				public function __construct() {
					
						
						//
						// 2. Declare constants and load dependencies
						//
					$this->define_constants();
					$this->load_dependencies();
					
						//
						// 3. Activation Hooks
						//
					
					add_action( 'load-themes.php',  array(&$this, 'init_theme') );	
					
					
					register_activation_hook(__FILE__, array(&$this, 'activate'));
					register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
					//register_uninstall_hook(__FILE__, 'wp_iv_directories::uninstall');
					
					
						//
						// 4. Load Widget
						//
					add_action('widgets_init', array(&$this, 'register_widget'));
					
						//
						// 5. i18n
						//
					add_action('init', array(&$this, 'i18n'));
						//
						// 6. Actions
						//
					
					add_action('wp_ajax_iv_directories_registration_submit', array(&$this, 'iv_directories_registration_submit'));
					add_action('wp_ajax_nopriv_iv_directories_registration_submit', array(&$this, 'iv_directories_registration_submit'));
					add_action('wp_ajax_iv_directories_user_exist_check', array(&$this, 'iv_directories_user_exist_check'));
					add_action('wp_ajax_nopriv_iv_directories_user_exist_check', array(&$this, 'iv_directories_user_exist_check'));
					add_action('wp_ajax_iv_directories_check_coupon', array(&$this, 'iv_directories_check_coupon'));
					add_action('wp_ajax_nopriv_iv_directories_check_coupon', array(&$this, 'iv_directories_check_coupon'));					
					add_action('wp_ajax_iv_directories_check_package_amount', array(&$this, 'iv_directories_check_package_amount'));
					add_action('wp_ajax_nopriv_iv_directories_check_package_amount', array(&$this, 'iv_directories_check_package_amount'));					
					add_action('wp_ajax_iv_check_availablility', array(&$this, 'iv_check_availablility'));
					add_action('wp_ajax_nopriv_iv_check_availablility', array(&$this, 'iv_check_availablility'));
					
					add_action('wp_ajax_iv_directories_update_profile_pic', array(&$this, 'iv_directories_update_profile_pic'));			
					add_action('wp_ajax_iv_directories_update_profile_setting', array(&$this, 'iv_directories_update_profile_setting'));
									
					
					add_action('wp_ajax_iv_directories_save_cpt1', array(&$this, 'iv_directories_save_cpt1'));
					add_action('wp_ajax_iv_directories_save_cpt2', array(&$this, 'iv_directories_save_cpt2'));				
					
					add_action('wp_ajax_iv_directories_update_cpt1', array(&$this, 'iv_directories_update_cpt1'));								
					add_action('wp_ajax_iv_directories_update_cpt2', array(&$this, 'iv_directories_update_cpt2'));
				
					
					add_action('wp_ajax_iv_directories_update_setting_fb', array(&$this, 'iv_directories_update_setting_fb'));
				
					add_action('wp_ajax_iv_directories_update_setting_hide', array(&$this, 'iv_directories_update_setting_hide'));
					
					add_action('wp_ajax_iv_directories_update_setting_password', array(&$this, 'iv_directories_update_setting_password'));
								
					add_action('wp_ajax_iv_directories_check_login', array(&$this, 'iv_directories_check_login'));
					add_action('wp_ajax_nopriv_iv_directories_check_login', array(&$this, 'iv_directories_check_login'));
					add_action('wp_ajax_iv_directories_forget_password', array(&$this, 'iv_directories_forget_password'));
					add_action('wp_ajax_nopriv_iv_directories_forget_password', array(&$this, 'iv_directories_forget_password'));
					add_action('wp_ajax_iv_directories_cancel_stripe', array(&$this, 'iv_directories_cancel_stripe'));
					
					add_action('wp_ajax_iv_directories_cancel_paypal', array(&$this, 'iv_directories_cancel_paypal'));
				
					add_action('wp_ajax_iv_directories_profile_stripe_upgrade', array(&$this, 'iv_directories_profile_stripe_upgrade'));
										
					add_action('wp_ajax_iv_directories_save_favorite', array(&$this, 'iv_directories_save_favorite'));
				
					add_action('wp_ajax_iv_directories_save_un_favorite', array(&$this, 'iv_directories_save_un_favorite'));
					add_action('wp_ajax_nopriv_iv_directories_save_un_favorite', array(&$this, 'iv_directories_save_un_favorite'));	
					add_action('wp_ajax_iv_directories_save_note', array(&$this, 'iv_directories_save_note'));
					add_action('wp_ajax_nopriv_iv_directories_save_note', array(&$this, 'iv_directories_save_note'));
					add_action('wp_ajax_iv_directories_delete_favorite', array(&$this, 'iv_directories_delete_favorite'));
					
					add_action('wp_ajax_iv_directories_contact_popup', array(&$this, 'iv_directories_contact_popup'));
					add_action('wp_ajax_nopriv_iv_directories_contact_popup', array(&$this, 'iv_directories_contact_popup'));
					add_action('wp_ajax_iv_directories_claim_popup', array(&$this, 'iv_directories_claim_popup'));
					add_action('wp_ajax_nopriv_iv_directories_claim_popup', array(&$this, 'iv_directories_claim_popup'));
					add_action('wp_ajax_iv_directories_message_send', array(&$this, 'iv_directories_message_send'));
					add_action('wp_ajax_nopriv_iv_directories_message_send', array(&$this, 'iv_directories_message_send'));						
					add_action('wp_ajax_iv_directories_message_contact', array(&$this, 'iv_directories_message_contact'));
					add_action('wp_ajax_nopriv_iv_directories_message_contact', array(&$this, 'iv_directories_message_contact'));						
					add_action('wp_ajax_iv_directories_paypal_notify_url', array(&$this, 'iv_directories_paypal_notify_url'));
					add_action('wp_ajax_nopriv_iv_directories_paypal_notify_url', array(&$this, 'iv_directories_paypal_notify_url'));					
					add_action('wp_ajax_iv_directories_claim_send', array(&$this, 'iv_directories_claim_send'));
					add_action('wp_ajax_nopriv_iv_directories_claim_send', array(&$this, 'iv_directories_claim_send'));
					add_action('wp_ajax_iv_directories_cron_job', array(&$this, 'iv_directories_cron_job'));
					add_action('wp_ajax_nopriv_iv_directories_cron_job', array(&$this, 'iv_directories_cron_job'));				
					add_action('wp_ajax_iv_cpt1_ajax_single', array(&$this, 'iv_cpt1_ajax_single'));
					add_action('wp_ajax_nopriv_iv_cpt1_ajax_single', array(&$this, 'iv_cpt1_ajax_single'));					
					add_action('wp_ajax_iv_cpt2_ajax_single', array(&$this, 'iv_cpt2_ajax_single'));
					add_action('wp_ajax_nopriv_iv_cpt2_ajax_single', array(&$this, 'iv_cpt2_ajax_single'));
					
					
					add_action('wp_ajax_iv_directories_save_rating', array(&$this, 'iv_directories_save_rating'));
					
					add_action('wp_ajax_nopriv_iv_directories_save_rating', array(&$this, 'iv_directories_save_rating'));
					
					add_action( 'wp_loaded', array(&$this, 'iv_directories_woocommerce_form_submit') );
					
					add_action('plugins_loaded', array(&$this, 'start'));
					add_action('add_meta_boxes', array(&$this, 'prfx_custom_meta_iv_cpt1'));
					add_action('add_meta_boxes', array(&$this, 'prfx_custom_meta_iv_cpt2'));
					add_action('save_post', array(&$this, 'iv_cpt1_meta_save'));
					add_action('save_post', array(&$this, 'iv_cpt2_meta_save'));
									
					add_action( 'init', array(&$this, 'iv_directories_paypal_form_submit') );
					add_action( 'init', array(&$this, 'iv_directories_stripe_form_submit') );					
					add_action('wp_login', array(&$this, 'check_expiry_date'));					
					add_action('pre_get_posts',array(&$this, 'iv_restrict_media_library') );
					
					add_action('init', array(&$this, 'remove_admin_bar') );	
					
						// For Visual Composer 
					add_action('vc_before_init',array(&$this, 'dir_vc_pricing_table') );
					add_action('vc_before_init',array(&$this, 'dir_vc_signup') );
					add_action('vc_before_init',array(&$this, 'dir_vc_user_login') );
					add_action('vc_before_init',array(&$this, 'dir_vc_my_account') );
					add_action('vc_before_init',array(&$this, 'dir_vc_public_profile') );
					add_action('vc_before_init',array(&$this, 'dir_vc_user_directory') );
					
						
						// 7. Shortcode					
						
						
					//add_shortcode('iv_directories_display', array(&$this, 'iv_directories_display_func'));	
					add_shortcode('iv_archive_directories', array(&$this, 'iv_archive_directories_func'));
					add_shortcode('iv_directories_price_table', array(&$this, 'iv_directories_price_table_func'));
					add_shortcode('iv_directories_registration_form', array(&$this, 'iv_directories_registration_form_func'));
					add_shortcode('iv_directories_payment_form', array(&$this, 'iv_directories_payment_form_func'));
					add_shortcode('iv_directories_form_wizard', array(&$this, 'iv_directories_form_wizard_func'));
					add_shortcode('iv_directories_profile_template', array(&$this, 'iv_directories_profile_template_func'));
					add_shortcode('iv_directories_profile_public', array(&$this, 'iv_directories_profile_public_func'));
					//add_shortcode('iv_directories_stripe_form', array(&$this, 'iv_directories_stripe_form_func'));
					add_shortcode('iv_directories_login', array(&$this, 'iv_directories_login_func'));
					add_shortcode('iv_directories_user_directory', array(&$this, 'iv_directories_user_directory_func'));
					
					add_shortcode('lawfirms_categories', array(&$this, 'lawfirms_categories_func'));
					add_shortcode('lawyer_categories', array(&$this, 'lawyer_categories_func'));
					
					add_shortcode('lawfirms_featured_home', array(&$this, 'lawfirms_featured_home_func'));
					add_shortcode('cpt2_featured', array(&$this, 'cpt2_featured_func'));
					add_shortcode('lawyer_featured_home', array(&$this, 'lawyer_featured_home_func'));					
					
					
					add_shortcode('listing_layout_style_1', array(&$this, 'listing_layout_style_1_func'));
					add_shortcode('contact_us', array(&$this, 'contact_us_func'));
					add_shortcode('search_box', array(&$this, 'search_box_func'));
					add_shortcode('listing_cpt1_by_city', array(&$this, 'listing_cpt1_by_city_func'));
					add_shortcode('listing_cpt2_by_city', array(&$this, 'listing_cpt2_by_city_func'));
					
					add_shortcode('iv_directories_reminder_email_cron', array(&$this, 'iv_directories_reminder_email_cron_func'));
						// 8. Filter
					
					//add_filter('the_content', array(&$this, 'iv_directories_content_protected'), 9);
					add_filter( 'mce_css',	array(&$this, 'plugin_mce_css_iv_directories') );
					add_filter('user_contactmethods', array(&$this, 'modify_contact_methods') );					
					//add_filter('registration_redirect', array(&$this, 'iv_registration_redirect') );
					//add_filter( 'author_link',  array(&$this, 'author_public_profile') );
					//add_filter('pre_get_posts', array(&$this, 'iv_directories_check_access'), 9);
					
								
					//---- COMMENT FILTERS ----//	
					//add_filter('comments_template', array(&$this,'no_comments_on_page'),10); 
					
					add_action( 'init', array(&$this, 'iv_cpt1_post_type') );
					add_action( 'init', array(&$this, 'tr_create_my_taxonomy_cpt1'));					
					//add_filter('request', array(&$this, 'post_type_tags_fix'));	
					
					add_action( 'init', array(&$this, 'iv_cpt2_post_type') );
					add_action( 'init', array(&$this, 'tr_create_my_taxonomy_cpt2'));
					
					
					add_filter( 'template_include', array(&$this, 'falcons_include_template_function'), 9, 2  );
					
					
				}
				
				
				/**
				 * Define constants needed across the plug-in.
				 */
				private function define_constants() {
					/*
					if (!defined('wp_iv_directories_BASENAME')) define('wp_iv_directories_BASENAME', plugin_basename(__FILE__));
					//define('wp_iv_directories_BASENAME', plugin_basename(__FILE__));
					if (!defined('wp_iv_directories_DIR')) define('wp_iv_directories_DIR', dirname(__FILE__));
					if (!defined('wp_iv_directories_FOLDER'))define('wp_iv_directories_FOLDER', plugin_basename(dirname(__FILE__)));
					if (!defined('wp_iv_directories_ABSPATH'))define('wp_iv_directories_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
					if (!defined('wp_iv_directories_URLPATH'))define('wp_iv_directories_URLPATH', trailingslashit(WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__))));
					if (!defined('wp_iv_directories_ADMINPATH'))define('wp_iv_directories_ADMINPATH', get_admin_url());
					
					
					$filename = get_template_directory()."/cpt1cpt2/";
					if (!file_exists($filename)) {					
						if (!defined('wp_iv_directories_template'))define( 'wp_iv_directories_template', wp_iv_directories_ABSPATH.'template/' );
					}else{
						if (!defined('wp_iv_directories_template'))define( 'wp_iv_directories_template', $filename);
					}	
					*/

					if (!defined('wp_iv_directories_BASENAME')) define('wp_iv_directories_BASENAME', plugin_basename(__FILE__));
					
					if (!defined('wp_iv_directories_DIR')) define('wp_iv_directories_DIR', dirname(__FILE__));
					
					if (!defined('wp_iv_directories_ABSPATH'))define('wp_iv_directories_ABSPATH', get_template_directory().'/framework/falcons-profile/' );
					if (!defined('wp_iv_directories_URLPATH'))define('wp_iv_directories_URLPATH', get_template_directory_uri().'/framework/falcons-profile/' );
					if (!defined('wp_iv_directories_ADMINPATH'))define('wp_iv_directories_ADMINPATH', get_admin_url());
					
					
					$filename = get_template_directory()."/cpt1cpt2/";
					if (!file_exists($filename)) {					
						if (!defined('wp_iv_directories_template'))define( 'wp_iv_directories_template', wp_iv_directories_ABSPATH.'/template/' );
					}else{
						if (!defined('wp_iv_directories_template'))define( 'wp_iv_directories_template', $filename);
					}	
					
				}	
				function init_theme() {					
					
					  if ( isset( $_GET['activated'] ) ) { //  if theme is activated
						    global $wpdb;
							$page_name=get_option('_iv_directories_home');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_price_table');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_registration');							
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_profile_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_profile_public_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_login_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_thank_you_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_user_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_contact_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_blog');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_about_us');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
														
						include ('install/install.php');
						
					  }					   
					  
					}			
				/**
				 * Loads PHP files that required by the plug-in
				 */			
				function falcons_include_template_function( $template_path ) { 	
						
						$directory_url_1=get_option('_iv_directory_url_1');					
						if($directory_url_1==""){$directory_url_1='law-firms';}	
						
						$directory_url_2=get_option('_iv_directory_url_2');					
						if($directory_url_2==""){$directory_url_2='lawyers';}				
						
						if ( get_post_type() == $directory_url_1) { 
							
							if ( is_single() ) {
								$template_path =  get_template_directory(). '/single-law-firm.php';	
							}
								
								
							if(  is_category() || is_archive() ){
								
								$template_path =  get_template_directory(). '/archive-law-firms.php';
							}
						}
						if ( get_post_type() == $directory_url_2 ) { 
							
							if ( is_single() ) { 
								$template_path =  get_template_directory(). '/single-lawyer.php';	
							}
													
							if(is_category() || is_archive() ){
								$template_path =  get_template_directory(). '/archive-lawyers.php';
							}
						}
						
						
						return $template_path;
									
				}
				public function remove_admin_bar() {
					 $iv_hide = get_option( '_iv_directories_hide_admin_bar');
					if (!current_user_can('administrator') && !is_admin()) {
						if($iv_hide=='yes'){							
						  show_admin_bar(false);
						  
						}
					}	
				}
					
				
				public function tr_create_my_taxonomy_cpt2() {
										
					$directory_url_2=get_option('_iv_directory_url_2');					
					if($directory_url_2==""){$directory_url_2='lawyers';}	
					
						register_taxonomy(
							$directory_url_2.'-category',
							$directory_url_2,
							array(
								'label' => __( 'Categories','falcons' ),
								'rewrite' => array( 'slug' => $directory_url_2.'-category' ),
								'hierarchical' => true,
							)
						);
				}
				public function iv_cpt2_post_type() {
					$directory_url_2=get_option('_iv_directory_url_2');					
					if($directory_url_2==""){$directory_url_2='lawyers';}	
					
					$labels = array(
						'name'                => _x( $directory_url_2, 'Post Type General Name', 'falcons' ),
						'singular_name'       => _x( $directory_url_2, 'Post Type Singular Name', 'falcons' ),
						'menu_name'           => __( $directory_url_2, 'falcons' ),
						'name_admin_bar'      => __( $directory_url_2, 'falcons' ),
						'parent_item_colon'   => __( 'Parent Item:', 'falcons' ),
						'all_items'           => __( 'All Items', 'falcons' ),
						'add_new_item'        => __( 'Add New Item', 'falcons' ),
						'add_new'             => __( 'Add New', 'falcons' ),
						'new_item'            => __( 'New Item', 'falcons' ),
						'edit_item'           => __( 'Edit Item', 'falcons' ),
						'update_item'         => __( 'Update Item', 'falcons' ),
						'view_item'           => __( 'View Item', 'falcons' ),
						'search_items'        => __( 'Search Item', 'falcons' ),
						'not_found'           => __( 'Not found', 'falcons' ),
						'not_found_in_trash'  => __( 'Not found in Trash', 'falcons' ),
					);
					$args = array(
						'label'               => __( $directory_url_2, 'text_cpt1' ),
						'description'         => __( $directory_url_2, 'text_cpt1' ),
						'labels'              => $labels,
						'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),
						//'taxonomies'          => array(  'post_tag' ),
						'hierarchical'        => false,
						'public'              => true,
						'show_ui'             => true,
						'show_in_menu'        => true,
						'menu_position'       => 5,
						'show_in_admin_bar'   => true,
						'show_in_nav_menus'   => true,
						'can_export'          => true,
						'has_archive'         => true,
						'exclude_from_search' => false,
						'publicly_queryable'  => true,
						'capability_type'     => 'post',
						
					);
					register_post_type( $directory_url_2, $args );

				}	
				public function tr_create_my_taxonomy_cpt1() {
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='law-firms';}	
					
				

						register_taxonomy(
							$directory_url_1.'-category',
							$directory_url_1,
							array(
								'label' => __( 'Categories','falcons' ),
								'rewrite' => array( 'slug' => $directory_url_1.'-category' ),
								'hierarchical' => true,
							)
						);
				}
				
				public function iv_cpt1_post_type() {
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='law-firms';}	
					
					

					$labels = array(
						'name'                => _x( $directory_url_1, 'Post Type General Name', 'falcons' ),
						'singular_name'       => _x( $directory_url_1, 'Post Type Singular Name', 'falcons' ),
						'menu_name'           => __( $directory_url_1, 'falcons' ),
						'name_admin_bar'      => __( $directory_url_1, 'falcons' ),
						'parent_item_colon'   => __( 'Parent Item:', 'falcons' ),
						'all_items'           => __( 'All Items', 'falcons' ),
						'add_new_item'        => __( 'Add New Item', 'falcons' ),
						'add_new'             => __( 'Add New', 'falcons' ),
						'new_item'            => __( 'New Item', 'falcons' ),
						'edit_item'           => __( 'Edit Item', 'falcons' ),
						'update_item'         => __( 'Update Item', 'falcons' ),
						'view_item'           => __( 'View Item', 'falcons' ),
						'search_items'        => __( 'Search Item', 'falcons' ),
						'not_found'           => __( 'Not found', 'falcons' ),
						'not_found_in_trash'  => __( 'Not found in Trash', 'falcons' ),
					);
					$args = array(
						'label'               => __( $directory_url_1, 'text_cpt1' ),
						'description'         => __( $directory_url_1, 'text_cpt1' ),
						'labels'              => $labels,
						'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'post-formats','custom-fields' ),
						//'taxonomies'          => array(  'post_tag' ),
						'hierarchical'        => false,
						'public'              => true,
						'show_ui'             => true,
						'show_in_menu'        => true,
						'menu_position'       => 5,
						'show_in_admin_bar'   => true,
						'show_in_nav_menus'   => true,
						'can_export'          => true,
						'has_archive'         => true,
						'exclude_from_search' => false,
						'publicly_queryable'  => true,
						'capability_type'     => 'post',
						
					);
					register_post_type( $directory_url_1, $args );

				}	
				public function post_type_tags_fix($request) {
					if ( isset($request['tag']) AND !isset($request['post_type']) ){
						
						$request['post_type'] = 'cpt1';
						 
					}
					
					return $request;
				} 
				public function dir_vc_pricing_table() {
						vc_map( array(
						  "name" => __( "Pricing Table", "falcons" ),
						  "base" => "iv_directories_price_table",
						    'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "falcons" ),
								"param_name" => "no",
								"value" => __( "Default", "falcons" ),
								"description" => __( "You can select the style from wp-admin e.g : style-1.", "falcons" )
							 )
						  )
					   ) );
				}
				public function dir_vc_signup() {
						vc_map( array(
						  "name" => __( "Signup ", "falcons" ),
						  "base" => "iv_directories_form_wizard",
						    'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "falcons" ),
								"param_name" => "Default",
								"value" => __( "Default", "falcons" ),
								"description" => __( ".", "falcons" )
							 )
						  )
					   ) );
				}
				public function dir_vc_my_account() {
						vc_map( array(
						  "name" => __( "My Acount ", "falcons" ),
						  "base" => "iv_directories_profile_template",
						    'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "falcons" ),
								"param_name" => "Default",
								"value" => __( "Default", "falcons" ),
								"description" => __( ".", "falcons" )
							 )
						  )
					   ) );
				}
				public function dir_vc_public_profile() {
						vc_map( array(
						  "name" => __( "Public Profile ", "falcons" ),
						  "base" => "iv_directories_profile_public",
						    'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Style Name", "falcons" ),
								"param_name" => "Default",
								"value" => __( "Default", "falcons" ),
								"description" => __( "You can select the style from wp-admin e.g : style-1 , style-2 ", "falcons" )
							 )
						  )
					   ) );
				}
				public function dir_vc_user_directory() {
						vc_map( array(
						  "name" => __( "User Directory ", "falcons" ),
						  "base" => "iv_directories_user_directory",
						    'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( "Show  number of user / Page", "falcons" ),
								"param_name" => "per_page",
								"value" => __( "12", "falcons" ),
								"description" => __( "You can set the number : 10,20 ", "falcons" )
							 )
						  )
					   ) );
				}
				public function dir_vc_user_login() {
						vc_map( array(
						  "name" => __( "Login", "falcons" ),
						  "base" => "iv_directories_login",
						   'icon' =>  falcons_IMAGE.'vc-icon.png',
						  "class" => "",
						  "category" => esc_html__( "Lawyers Directory", "falcons"),
						  //'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
						  //'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
						  "params" => array(
							 array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "",
								"heading" => __( " Login", "falcons" ),
								"param_name" => "style",
								"value" => __( "Default", "falcons" ),
								"description" => __( "Default ", "falcons" )
							 )
						  )
					   ) );
				}
				public function search_box_func($atts = ''){
					ob_start();	
					include( wp_iv_directories_template. 'lawfirm/slider-search.php');
					$content = ob_get_clean();
					return $content;
					
			   }
			   public function listing_cpt1_by_city_func($atts = ''){
					ob_start();	
					include( wp_iv_directories_template. 'lawfirm/listing_cpt1_by_city.php');
					$content = ob_get_clean();
					return $content;
				}
			   public function listing_cpt2_by_city_func($atts = ''){
					ob_start();	
					include( wp_iv_directories_template. 'lawyer/listing_cpt2_by_city.php');
					$content = ob_get_clean();
					return $content;
				}
				
				public function author_public_profile() {
					
					$author = get_the_author();	
					$iv_redirect = get_option( '_iv_directories_profile_public_page');
					if($iv_redirect!='defult'){ 
						$reg_page= get_permalink( $iv_redirect) ; 
						return    $reg_page.'?&id='.$author; //$reg_page ;
						//wp_redirect( $reg_page.'/author/111'  );
						exit;
					}
				}
				public function iv_directories_woocommerce_form_submit(  ) {
					require_once(wp_iv_directories_ABSPATH . '/admin/pages/payment-inc/woo-submit.php');
				}
				public function iv_registration_redirect(){
					$iv_redirect = get_option( 'iv_directories_signup_redirect');
					if($iv_redirect!='defult'){
						$reg_page= get_permalink( $iv_redirect); 
						wp_redirect( $reg_page );
						exit;
					}	
						
				}
				public function iv_directories_login_func(){
						include(wp_iv_directories_template. 'private-profile/profile-login.php');
				}
				public function iv_directories_forget_password(){
					
					parse_str($_POST['form_data'], $data_a);
						if( ! email_exists($data_a['forget_email']) ) {
							echo json_encode(array("code" => "not-success","msg"=>"There is no user registered with that email address."));
								exit(0);
						} else {
								include( wp_iv_directories_ABSPATH. 'inc/forget-mail.php');
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
						}
				}
				public function iv_directories_check_login(){
					
					parse_str($_POST['form_data'], $form_data);
					global $user;
					$creds = array();
					$creds['user_login'] =$form_data['username'];
					$creds['user_password'] =  $form_data['password'];
					$creds['remember'] =  (isset($form_data['remember']) ?'true' : 'false');					
					$secure_cookie = is_ssl() ? true : false;
					$user = wp_signon( $creds, $secure_cookie );
					
					if ( is_wp_error($user) ) {
						//echo $user->get_error_message();
						echo json_encode(array("code" => "not-success","msg"=>__('Invalid Username & Password','falcons')));
						exit(0);
					}
					if ( !is_wp_error($user) ) {
						$iv_redirect = get_option( '_iv_directories_profile_page');
						if($iv_redirect!='defult'){
							
							$reg_page= get_permalink( $iv_redirect); 
							echo json_encode(array("code" => "success","msg"=>$reg_page));
							exit(0);
							//wp_redirect( $reg_page );
							
						}
					}		
				
				}
				
			// Rating********
			public function iv_directories_save_rating(){
					parse_str($_POST['data'], $form_data);					
					 $profile_user_id=$form_data['id'];
					 $rating_text=$form_data['rating_text'];
					 $rating_value=$form_data['rating_value'];
					
					$total_count=get_post_meta($profile_user_id,'_rating_total_count',true);					
					$old_rating= get_user_meta(get_current_user_id(),$rating_text.'_rating'.'|'.$profile_user_id,true);
					if($old_rating<1){
						$total_count=$total_count+1;
					}
					$total_rating=get_post_meta($profile_user_id,$rating_text.'_rating',true);
					
					$count_the_rating=get_post_meta($profile_user_id,$rating_text.'_count',true);					
					
					if($old_rating>0){
						$count_the_rating=$count_the_rating-1;
						
					}					
					
					$count_the_rating=$count_the_rating + 1 ;					
					$total_rating=$total_rating-$old_rating;
					$total_rating=$total_rating+$rating_value;
					
					update_post_meta($profile_user_id,$rating_text.'_count',$count_the_rating);
					update_post_meta($profile_user_id,$rating_text.'_rating',$total_rating);	
					update_post_meta($profile_user_id,'_rating_total_count',$total_count);
					update_user_meta(get_current_user_id(),$rating_text.'_rating'.'|'.$profile_user_id,$rating_value);	
					
					echo json_encode(array("msg" => 'success'));
					exit(0);	
			}
			public function iv_directories_update_cpt1(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);		
					$my_post = array();
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='law-firms';}	
					
					
					
					$my_post['ID'] = $newpost_id= $form_data['user_post_id'];
					
					$my_post['post_title'] = sanitize_text_field($form_data['title']);
					$my_post['post_content'] = sanitize_textarea_field($form_data['edit_post_content']);
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					if($form_data['post_status']=='publish'){
							$form_data['post_status']='pending';
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}else{	
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									$form_data['post_status']='publish';
								}else{	
									$form_data['post_status']='pending';
								}	
							}
					}
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $directory_url_1.'-category');
					}
					$default_fields = array();
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
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, sanitize_text_field($form_data[$field_key] ));
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[sanitize_text_field($day_name[$i])]=sanitize_text_field($day_value1[$i]).'|'.sanitize_text_field($day_value2[$i]);
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					// For Tag Save tag_arr
					$tag_all='';
					if(isset($form_data['tag_arr'] )){
						$tag_name= $form_data['tag_arr'] ;							
						$i=0;$tag_all='';
						foreach($tag_name  as $one_tag){							
							$tag_all= $tag_all.",".sanitize_text_field($one_tag);												
							$i++;	
						}
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					}
					if(isset($form_data['new_tag'] )){
						$tag_all=$tag_all.','.sanitize_text_field($form_data['new_tag']);
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					
					}	
					// Our cpt2s
					if(isset($form_data['physician_list'] )){
						$cpt2s=$form_data['physician_list'];															
						update_post_meta($newpost_id, 'physician_list', $cpt2s);  	
					}	
					
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".sanitize_text_field($one_specialtie);
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
					// Delete 1st
					$i=0;
						for($i=0;$i<20;$i++){
								delete_post_meta($newpost_id, '_award_title_'.$i); 							
								delete_post_meta($newpost_id, '_award_description_'.$i);							
								delete_post_meta($newpost_id, '_award_year_'.$i); 						
								delete_post_meta($newpost_id, '_award_image_id_'.$i); 						
						}		
					// Delete End
					
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){	
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, sanitize_text_field($award_title[$i])); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, sanitize_text_field($award_description[$i])); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, sanitize_text_field($award_year[$i])); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, sanitize_text_field($award_image_id[$i])); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
					update_post_meta($newpost_id, 'state',sanitize_text_field( $form_data['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
					
					// Get latlng from address* START********
					$dir_lat=sanitize_text_field($form_data['latitude']);
					$dir_lng=sanitize_text_field($form_data['longitude']);
					$address = sanitize_text_field($form_data['address']);
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
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					update_post_meta($newpost_id, 'logo_image_id', sanitize_text_field($form_data['logo_image_id'])); 
					update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
					update_post_meta($newpost_id, 'fax', sanitize_text_field($form_data['fax'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web'])); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
						update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
					}
					update_post_meta($newpost_id, 'facebook', sanitize_text_field($form_data['facebook'])); 
					update_post_meta($newpost_id, 'linkedin', sanitize_text_field($form_data['linkedin'])); 
					update_post_meta($newpost_id, 'twitter', sanitize_text_field($form_data['twitter'])); 
					update_post_meta($newpost_id, 'gplus', sanitize_text_field($form_data['gplus']));
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', sanitize_text_field($form_data['event_image_id']));
						update_post_meta($newpost_id, 'event_title', sanitize_text_field($form_data['event-title']));
						update_post_meta($newpost_id, 'event_detail', sanitize_text_field($form_data['event-detail']));
					}
										
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			public function get_unique_keyword_values( $key = 'keyword', $post_type ){
						global $wpdb;

						if( empty( $key ) ){
							return;
						}	
						$res=array();
						$args = array(
						'post_type' => $post_type, // enter your custom post type						
						'post_status' => 'publish',						
						'posts_per_page'=> -1,  // overrides posts per page in theme settings
						//"s" => $key,
						//"fields"=>'post_title',
						);
						$query_auto = new WP_Query( $args );
						$posts_auto = $query_auto->posts;						
						foreach($posts_auto as $post_a) {
							$res[]=$post_a->post_title;
						}	
						return $res;
				}
			public function iv_directories_update_cpt2(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);		
					$my_post = array();
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='law-firms';}	
					
					$directory_url_2=get_option('_iv_directory_url_2');					
					if($directory_url_2==""){$directory_url_2='lawyers';}
					
					$my_post['ID'] = $newpost_id= $form_data['user_post_id'];
					
					$my_post['post_title'] = sanitize_text_field($form_data['title']);
					$my_post['post_content'] = sanitize_textarea_field($form_data['edit_post_content']);
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $directory_url_2.'-category');
					}
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
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, sanitize_text_field($form_data[$field_key]) );
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[sanitize_text_field($day_name[$i])]=sanitize_text_field($day_value1[$i]).'|'.sanitize_text_field($day_value2[$i]);
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}

										
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".sanitize_text_field($one_specialtie);
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
					// Delete 1st
					$i=0;
						for($i=0;$i<20;$i++){
								delete_post_meta($newpost_id, '_award_title_'.$i); 							
								delete_post_meta($newpost_id, '_award_description_'.$i);							
								delete_post_meta($newpost_id, '_award_year_'.$i); 						
								delete_post_meta($newpost_id, '_award_image_id_'.$i); 						
						}		
					// Delete End
					
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){		
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, sanitize_text_field($award_title[$i])); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, sanitize_text_field($award_description[$i])); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, sanitize_text_field($award_year[$i])); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, sanitize_text_field($award_image_id[$i])); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
					update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
					
					// Get latlng from address* START********
					$dir_lat=sanitize_text_field($form_data['latitude']);
					$dir_lng=sanitize_text_field($form_data['longitude']);
					$address = sanitize_text_field($form_data['address']);
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
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********					
					
					 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
					update_post_meta($newpost_id, 'fax', sanitize_text_field($form_data['fax'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web'])); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
						update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
					}
					update_post_meta($newpost_id, 'facebook', sanitize_text_field($form_data['facebook'])); 
					update_post_meta($newpost_id, 'linkedin', sanitize_text_field($form_data['linkedin'])); 
					update_post_meta($newpost_id, 'twitter', sanitize_text_field($form_data['twitter'])); 
					update_post_meta($newpost_id, 'gplus', sanitize_text_field($form_data['gplus']));
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', sanitize_text_field($form_data['event_image_id']));
						update_post_meta($newpost_id, 'event_title', sanitize_text_field($form_data['event-title']));
						update_post_meta($newpost_id, 'event_detail', sanitize_text_field($form_data['event-detail']));
					}
										
					if(isset($form_data['booking'])){
						update_post_meta($newpost_id, 'booking', sanitize_text_field($form_data['booking']));
					}
					if(isset($form_data['booking_detail'])){
						update_post_meta($newpost_id, 'booking_detail', sanitize_text_field($form_data['booking_detail']));
												
					}
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function iv_directories_save_cpt2(){
					global $current_user; global $wpdb;	
					$directory_url_2=get_option('_iv_directory_url_2');					
					if($directory_url_2==""){$directory_url_2='lawyers';}
					
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = sanitize_text_field($form_data['title']);
					$my_post['post_content'] =sanitize_textarea_field($form_data['new_post_content']);
					
					if($form_data['post_status']=='publish'){
							$form_data['post_status']='pending';
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}else{	
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									$form_data['post_status']='publish';
								}else{	
									$form_data['post_status']='pending';
								}	
							}
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					$post_type = $directory_url_2;//get_option( '_iv_directories_profile_post');
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}
						// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_".$directory_url_2."' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
											
					if(isset($form_data['feature_image_id'] )){
							$attach_id =sanitize_text_field($form_data['feature_image_id']);
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $directory_url_2.'-category');
					}
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
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, sanitize_text_field($form_data[$field_key] ));
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= 		$form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'];
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[sanitize_text_field($day_name[$i])]=sanitize_text_field($day_value1[$i]).'|'.sanitize_text_field($day_value2[$i]);
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".sanitize_text_field($one_specialtie);
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){		
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, sanitize_text_field($award_title[$i])); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, sanitize_text_field($award_description[$i])); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, sanitize_text_field($award_year[$i])); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, sanitize_text_field($award_image_id[$i])); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
					update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
					
					// Get latlng from address* START********
					$dir_lat=sanitize_text_field($form_data['latitude']);
					$dir_lng=sanitize_text_field($form_data['longitude']);
					$address = sanitize_text_field($form_data['address']);
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
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					//update_post_meta($newpost_id, 'logo_image_id', $form_data['logo_image_id']); 
					//update_post_meta($newpost_id, 'image_gallery_ids', $form_data['gallery_image_ids']); 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
					update_post_meta($newpost_id, 'fax', sanitize_text_field($form_data['fax'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web'])); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
						update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
					}
					update_post_meta($newpost_id, 'facebook', sanitize_text_field($form_data['facebook'])); 
					update_post_meta($newpost_id, 'linkedin', sanitize_text_field($form_data['linkedin'])); 
					update_post_meta($newpost_id, 'twitter', sanitize_text_field($form_data['twitter'])); 
					update_post_meta($newpost_id, 'gplus', sanitize_text_field($form_data['gplus']));
					/*
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
					*/					
					if(isset($form_data['booking'])){
						update_post_meta($newpost_id, 'booking', sanitize_text_field($form_data['booking']));
					}
					if(isset($form_data['booking_detail'])){
						update_post_meta($newpost_id, 'booking_detail', sanitize_text_field($form_data['booking_detail']));
												
					}
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
				
				public function iv_directories_save_cpt1(){
					global $current_user; global $wpdb;	
					$directory_url_1=get_option('_iv_directory_url_1');					
					if($directory_url_1==""){$directory_url_1='law-firms';}	
					
					$directory_url_2=get_option('_iv_directory_url_2');					
					if($directory_url_2==""){$directory_url_2='lawyers';}	
					
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = sanitize_text_field($form_data['title']);
					$my_post['post_content'] = sanitize_textarea_field($form_data['new_post_content']);
					
					if($form_data['post_status']=='publish'){
							$form_data['post_status']='pending';
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}else{	
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									$form_data['post_status']='publish';
								}else{	
									$form_data['post_status']='pending';
								}	
							}
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					$post_type = $directory_url_1;
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}
					// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_".$directory_url_1."' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
					
					$iv_feature_location= get_user_meta($current_user->ID, 'iv_feature_location',true);
					
					if(trim($iv_feature_location)!=''){
						$iv_feature_location_arr= explode("|",$iv_feature_location);
						if(isset($iv_feature_location_arr[0])){
							update_post_meta($newpost_id, '_iv_feature_category', sanitize_text_field($iv_feature_location_arr[0])); 
							//** Remove from temp data for city + ;location check.
								 $availablility=get_option('iv_availablility_data');
								 unset($availablility[$iv_feature_location_arr[0]]);
								 update_option('iv_availablility_data',$availablility);
						}
						if(isset($iv_feature_location_arr[1])){
							update_post_meta($newpost_id, '_iv_feature_location', sanitize_text_field($iv_feature_location_arr[1])); 
						}
						
						
					}
					
					
						
						
											
					if(isset($form_data['feature_image_id'] )){
							$attach_id =sanitize_text_field($form_data['feature_image_id']);
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $directory_url_1.'-category');
					}
					$default_fields = array();
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
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							if(isset($form_data[$field_key])){
								update_post_meta($newpost_id, $field_key, sanitize_text_field($form_data[$field_key] ));
							}
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= 		$form_data['day_name'];
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[sanitize_text_field($day_name[$i])]=sanitize_text_field($day_value1[$i]).'|'.sanitize_text_field($day_value2[$i]);
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					
					// Our cpt2s
					if(isset($form_data['physician_list'] )){
						$cpt2s=$form_data['physician_list'];															
						update_post_meta($newpost_id, 'physician_list', $cpt2s);  	
					}	
					
					
					
					// For Specialtie Save 
					$specialtie_all='';
					if(isset($form_data['specialtie_arr'] )){
						$specialtie_name= $form_data['specialtie_arr'] ;							
						$i=0;$specialtie_all='';
						foreach($specialtie_name  as $one_specialtie){							
							$specialtie_all= $specialtie_all.",".sanitize_text_field($one_specialtie);
						}
						update_post_meta($newpost_id, 'specialtie', $specialtie_all);  	
							
					}
					
					// For Awards Save 
				
					if(isset($form_data['award_title'] )){
						$award_title= $form_data['award_title'];
						$award_description= $form_data['award_description'];	
						$award_year= $form_data['award_year'];	
						$award_image_id= (isset($form_data['award_image_id']) ? $form_data['award_image_id']:'');							
													
						$i=0;
						//foreach($award_title  as $one_award_title){							
						for($i=0;$i<20;$i++){	
							if(isset($award_title[$i])){
								update_post_meta($newpost_id, '_award_title_'.$i, sanitize_text_field($award_title[$i])); 
							}
							if(isset($award_description[$i])){
								update_post_meta($newpost_id, '_award_description_'.$i, sanitize_text_field($award_description[$i])); 
							}
							if(isset($award_year[$i])){
								update_post_meta($newpost_id, '_award_year_'.$i, sanitize_text_field($award_year[$i])); 
							}
							if(isset($award_image_id[$i])){
								update_post_meta($newpost_id, '_award_image_id_'.$i, sanitize_text_field($award_image_id[$i])); 
							}
														
							//$i++;
						}						 	
							
					}
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', sanitize_text_field($form_data['address'])); 
					update_post_meta($newpost_id, 'latitude', sanitize_text_field($form_data['latitude'])); 
					update_post_meta($newpost_id, 'longitude', sanitize_text_field($form_data['longitude']));					
					update_post_meta($newpost_id, 'city', sanitize_text_field($form_data['city'])); 
					update_post_meta($newpost_id, 'state', sanitize_text_field($form_data['state'])); 
					update_post_meta($newpost_id, 'postcode', sanitize_text_field($form_data['postcode'])); 
					update_post_meta($newpost_id, 'country', sanitize_text_field($form_data['country'])); 
					
					// Get latlng from address* START********
					$dir_lat=sanitize_text_field($form_data['latitude']);
					$dir_lng=sanitize_text_field($form_data['longitude']);
					$address = sanitize_text_field($form_data['address']);
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
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* END********	
					
					update_post_meta($newpost_id, 'logo_image_id', sanitize_text_field($form_data['logo_image_id'])); 
					update_post_meta($newpost_id, 'image_gallery_ids', sanitize_text_field($form_data['gallery_image_ids'])); 
					update_post_meta($newpost_id, 'phone', sanitize_text_field($form_data['phone'])); 
					update_post_meta($newpost_id, 'fax', sanitize_text_field($form_data['fax'])); 
					update_post_meta($newpost_id, 'contact-email', sanitize_text_field($form_data['contact-email'])); 
					update_post_meta($newpost_id, 'contact_web', sanitize_text_field($form_data['contact_web'])); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', sanitize_text_field($form_data['vimeo'])); 
						update_post_meta($newpost_id, 'youtube', sanitize_text_field($form_data['youtube'])); 
					}
					update_post_meta($newpost_id, 'facebook', sanitize_text_field($form_data['facebook'])); 
					update_post_meta($newpost_id, 'linkedin', sanitize_text_field($form_data['linkedin'])); 
					update_post_meta($newpost_id, 'twitter', sanitize_text_field($form_data['twitter'])); 
					update_post_meta($newpost_id, 'gplus', sanitize_text_field($form_data['gplus']));
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', sanitize_text_field($form_data['event_image_id']));
						update_post_meta($newpost_id, 'event_title', sanitize_text_field($form_data['event-title']));
						update_post_meta($newpost_id, 'event_detail', sanitize_text_field($form_data['event-detail']));
					}
										
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
				public function iv_directories_save_wp_post(){
					global $current_user; global $wpdb;	
					parse_str($_POST['form_data'], $form_data);				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					
					if($form_data['post_status']=='publish'){
							$dir_approve_publish =get_option('_dir_approve_publish');
							if($dir_approve_publish!='yes'){
								$form_data['post_status']='publish';
							}
						
					}
					
					$my_post['post_status'] = $form_data['post_status'];					
					$newpost_id= wp_insert_post( $my_post );						
					$post_type = 'cpt1';//get_option( '_iv_directories_profile_post');
					if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
					}						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );					
					}						
					if(isset($form_data['postcats'] )){ 
						//wp_set_post_categories($newpost_id, $form_data['postcats'] );
						//wp_set_post_categories($newpost_id, array($form_data['postcats'] ));
							
							$category_ids = array($form_data['postcats']);
							wp_set_object_terms( $newpost_id, $category_ids, $directory_url_1.'-category');
					}
					$default_fields = array();
					$field_set=get_option('iv_directories_fields' );
					if($field_set!=""){ 
							$default_fields=get_option('iv_directories_fields' );
					}else{															
							$default_fields['business_type']='Business Type';
							$default_fields['main_products']='Main Products';
							$default_fields['number_of_employees']='Number Of Employees';
							$default_fields['main_markets']='Main Markets';
							$default_fields['total_annual_sales_volume']='Total Annual Sales Volume';	
					}
					if(sizeof($default_fields )){			
						foreach( $default_fields as $field_key => $field_value ) { 
							update_post_meta($newpost_id, $field_key, $form_data[$field_key] );							
						
						}					
					}
					$opening_day=array();
					if(isset($form_data['day_name'] )){
						$day_name= $form_data['day_name'] ;
						$day_value1 = $form_data['day_value1'] ;
						$day_value2 = $form_data['day_value2'] ;
						$i=0;
						foreach($day_name  as $one_meta){
							if(isset($day_name[$i]) and isset($day_value1[$i]) ){
								if($day_name[$i] !=''){
									$opening_day[$day_name[$i]]=$day_value1[$i].'|'.$day_value2[$i];
								}
							}							
						$i++;	
						}
						update_post_meta($newpost_id, '_opening_time', $opening_day); 	
					}
					// For Tag Save tag_arr
					$tag_all='';
					if(isset($form_data['tag_arr'] )){
						$tag_name= $form_data['tag_arr'] ;							
						$i=0;$tag_all='';
						foreach($tag_name  as $one_tag){							
							$tag_all= $tag_all.",".$one_tag;												
							$i++;	
						}
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					}
					if(isset($form_data['new_tag'] )){
						$tag_all=$tag_all.','.$form_data['new_tag'];
						wp_set_post_tags($newpost_id, $tag_all, true); 	
					
					}	
					
					
					//wp_set_post_tags( 42, 'meaning,life', true );
					
					
					update_post_meta($newpost_id, 'address', $form_data['address']); 
					update_post_meta($newpost_id, 'latitude', $form_data['latitude']); 
					update_post_meta($newpost_id, 'longitude', $form_data['longitude']);					
					update_post_meta($newpost_id, 'city', $form_data['city']); 
					update_post_meta($newpost_id, 'postcode', $form_data['postcode']); 
					update_post_meta($newpost_id, 'country', $form_data['country']); 
					
					// Get latlng from address* START********
					$dir_lat=$form_data['latitude'];
					$dir_lng=$form_data['longitude'];
					$address = $form_data['address'];
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
									update_post_meta($newpost_id,'latitude',$latitude);
								}
								if($longitude!=''){
									update_post_meta($newpost_id,'longitude',$longitude);
								}
							}
					}	
					// Get latlng from address* ENDDDDDD********	
					
					update_post_meta($newpost_id, 'image_gallery_ids', $form_data['gallery_image_ids']); 
					update_post_meta($newpost_id, 'phone', $form_data['phone']); 
					update_post_meta($newpost_id, 'fax', $form_data['fax']); 
					update_post_meta($newpost_id, 'contact-email', $form_data['contact-email']); 
					update_post_meta($newpost_id, 'contact_web', $form_data['contact_web']); 
					
					if(isset($form_data['vimeo'] )){
						update_post_meta($newpost_id, 'vimeo', $form_data['vimeo']); 
						update_post_meta($newpost_id, 'youtube', $form_data['youtube']); 
					}
					update_post_meta($newpost_id, 'facebook', $form_data['facebook']); 
					update_post_meta($newpost_id, 'linkedin', $form_data['linkedin']); 
					update_post_meta($newpost_id, 'twitter', $form_data['twitter']); 
					update_post_meta($newpost_id, 'gplus', $form_data['gplus']);
					if(isset($form_data['event-title'])){
						update_post_meta($newpost_id, '_event_image_id', $form_data['event_image_id']);
						update_post_meta($newpost_id, 'event_title', $form_data['event-title']);
						update_post_meta($newpost_id, 'event_detail', $form_data['event-detail']);
					}
					if(isset($form_data['deal-title'])){
						update_post_meta($newpost_id, '_deal_image_id', $form_data['deal_image_id']);
						update_post_meta($newpost_id, 'deal_title', $form_data['deal-title']);
						update_post_meta($newpost_id, 'deal_detail', $form_data['deal-detail']);
						update_post_meta($newpost_id, 'deal_paypal', $form_data['deal-paypal']);
						update_post_meta($newpost_id, 'deal_amount', $form_data['deal-amount']);
						
					}
					if(isset($form_data['booking'])){
						update_post_meta($newpost_id, 'booking', $form_data['booking']);
					}
					if(isset($form_data['booking_detail'])){
						update_post_meta($newpost_id, 'booking_detail', $form_data['booking_detail']);
												
					}
					
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
			
				public function iv_directories_cancel_paypal(){
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);
						
						if( ! class_exists('Paypal' ) ) {
							include(wp_iv_directories_DIR . '/inc/class-paypal.php');
							
						}

						$post_name='iv_directories_paypal_setting';						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						$paypal_id='0';
						if(sizeof($row )>0){
							$paypal_id= $row->ID;
						}
						$paypal_api_currency=get_post_meta($paypal_id, 'iv_directories_paypal_api_currency', true);
						
						$paypal_username=get_post_meta($paypal_id, 'iv_directories_paypal_username',true);
						$paypal_api_password=get_post_meta($paypal_id, 'iv_directories_paypal_api_password', true);
						$paypal_api_signature=get_post_meta($paypal_id, 'iv_directories_paypal_api_signature', true);
						
						$credentials = array();
						$credentials['USER'] = (isset($paypal_username)) ? $paypal_username : '';
						$credentials['PWD'] = (isset($paypal_api_password)) ? $paypal_api_password : '';
						$credentials['SIGNATURE'] = (isset($paypal_api_signature)) ? $paypal_api_signature : '';
						
						$paypal_mode=get_post_meta($paypal_id, 'iv_directories_paypal_mode', true);
					
						$currencyCode = $paypal_api_currency;
						$sandbox = ($paypal_mode == 'live') ? '' : 'sandbox.';
						$sandboxBool = (!empty($sandbox)) ? true : false;
						
						$paypal = new Paypal($credentials,$sandboxBool);
						
						$oldProfile = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
						if (!empty($oldProfile)) {
							$cancelParams = array(
								'PROFILEID' => $oldProfile,
								'ACTION' => 'Cancel'
							);
							$paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
							
							update_user_meta($current_user->ID,'iv_paypal_recurring_profile_id','');
							update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
							update_user_meta($current_user->ID,'iv_directories_payment_status', 'cancel'); 
							
							echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
							exit(0);							
						}else{
						
							echo json_encode(array("code" => "not","msg"=>"Unable to Cancel "));
							exit(0);	
						}
						
				
				}
				public function iv_cpt1_ajax_single(){					
					//include( get_template_directory(). '/ajax-single-cpt1.php');
					include( wp_iv_directories_template. '/lawfirm/ajax-single-cpt1.php');
					
					exit(0);
				}
				public function iv_cpt2_ajax_single(){					
					//include( get_template_directory(). '/ajax-single-cpt2.php');
					include( wp_iv_directories_template. '/lawyer/ajax-single-lawyer.php');
					exit(0);
				}
				
				public function  iv_directories_profile_stripe_upgrade(){
						include(wp_iv_directories_DIR . '/admin/files/init.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='iv_directories_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'iv_directories_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_live_secret_key',true);	
						}
						
						\Stripe\Stripe::setApiKey($stripe_api);				
						// For  cancel ----
						$arb_status =	get_user_meta($current_user->ID, 'iv_directories_payment_status', true);
						$cust_id = get_user_meta($current_user->ID,'iv_directories_stripe_cust_id',true);
						$sub_id = get_user_meta($current_user->ID,'iv_directories_stripe_subscrip_id',true);
						if($sub_id!=''){	
							try{
									$iv_cancel_stripe = \Stripe\Customer::retrieve($form_data['cust_id']);
									$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();		
									
							} catch (Exception $e) {
								//print_r($e);	
								
								//$error_msg=$e;
							}
							update_user_meta($current_user->ID,'iv_directories_payment_status', 'cancel'); 
							update_user_meta($current_user->ID,'iv_directories_stripe_subscrip_id','');
						}
						
						// Start  New 
						$response='';
						parse_str($_POST['form_data'], $form_data);
						include(wp_iv_directories_DIR . '/admin/pages/payment-inc/stripe-upgrade.php');
						
						echo json_encode(array("code" => "success","msg"=>$response));
						exit(0);

				}
				public function  iv_directories_profile_stripe_add_balance(){
						include(wp_iv_directories_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='iv_directories_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'iv_directories_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_live_secret_key',true);	
						}
																		
						// Start  New 
						$response='';
						parse_str($_POST['form_data'], $form_data);
						include(wp_iv_directories_DIR . '/admin/pages/payment-inc/stripe-add-balance.php');
						
						echo json_encode(array("code" => "success","msg"=>$response));
						exit(0);

				}
				public function iv_directories_cancel_stripe(){
						
						include(wp_iv_directories_DIR . '/admin/files/init.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='iv_directories_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'iv_directories_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'iv_directories_stripe_live_secret_key',true);	
						}
						parse_str($_POST['form_data'], $form_data);
						
						
						\Stripe\Stripe::setApiKey($stripe_api);
						
						
						try{
								$iv_cancel_stripe = \Stripe\Customer::retrieve($form_data['cust_id']);
								$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();		
						
						} catch (Exception $e) {
							//print_r($e);	
						}
						
						
						update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
						update_user_meta($current_user->ID,'iv_directories_payment_status', 'cancel'); 
						update_user_meta($current_user->ID,'iv_directories_stripe_subscrip_id','');
						
						echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
						exit(0);
				
				}
				public function  iv_directories_stripe_form_func(){
					//echo wp_iv_directories_URLPATH.'files/short_code_file/iv_stripe_form_display';
					include(wp_iv_directories_ABSPATH.'files/short_code_file/iv_stripe_form_display.php');
				}
				
				public function iv_directories_update_setting_hide(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);	
					$mobile_hide=(isset($form_data['mobile_hide'])? $form_data['mobile_hide']:'');	
					$email_hide=(isset($form_data['email_hide'])? $form_data['email_hide']:'');	
					$phone_hide=(isset($form_data['phone_hide'])? $form_data['phone_hide']:'');	
					
					update_user_meta($current_user->ID,'hide_email', $email_hide); 
					update_user_meta($current_user->ID,'hide_phone', $phone_hide);					
					update_user_meta($current_user->ID,'hide_mobile',$mobile_hide); 
					
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				
				public function iv_directories_update_setting_fb(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);			
					update_user_meta($current_user->ID,'twitter', $form_data['twitter']); 
					update_user_meta($current_user->ID,'facebook', $form_data['facebook']); 
					update_user_meta($current_user->ID,'gplus', $form_data['gplus']); 
					update_user_meta($current_user->ID,'linkedin', $form_data['linkedin']); 
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				public function iv_directories_update_setting_password(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);						
					if ( wp_check_password( $form_data['c_pass'], $current_user->user_pass, $current_user->ID) ){
					  
							if($form_data['r_pass']!=$form_data['n_pass']){
								echo json_encode(array("code" => "not", "msg"=>"New Password & Re Password are not same. "));
								exit(0);
							}else{
								wp_set_password( $form_data['n_pass'], $current_user->ID);
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
							}
					}else{
						
					   echo json_encode(array("code" => "not", "msg"=>"Current password is wrong. "));
						exit(0);
					}
					
					
					
				}
				
				public function iv_directories_update_profile_setting(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);		
										
					if(array_key_exists('wp_capabilities',$form_data)){
							wp_die( 'Are you cheating:wp_capabilities?' );							
					}
					
					foreach ( $form_data as $field_key => $field_value ) { 
						if($field_key!='wp_capabilities'){
							update_user_meta($current_user->ID,$field_key, sanitize_text_field($field_value)); 
						}	
					}
						
					/*
					update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					update_user_meta($current_user->ID,'last_name', $form_data['last_name']); 
					update_user_meta($current_user->ID,'phone', $form_data['phone']); 
					
					update_user_meta($current_user->ID,'mobile', $form_data['mobile']); 
					update_user_meta($current_user->ID,'address', $form_data['address']); 
					update_user_meta($current_user->ID,'occupation', $form_data['occupation']);
					update_user_meta($current_user->ID,'description', $form_data['about']);	
					update_user_meta($current_user->ID,'web_site', $form_data['web_site']);	
					*/
					/*
					update_user_meta($current_user->ID,'twitter', $form_data['twitter']); 
					update_user_meta($current_user->ID,'facebook', $form_data['facebook']); 
					update_user_meta($current_user->ID,'gplus', $form_data['gplus']); 
					update_user_meta($current_user->ID,'linkedin', $form_data['linkedin']); 
					 */
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function modify_contact_methods($profile_fields) {

					// Add new fields
					$profile_fields['phone'] = 'Phone Number';
					$profile_fields['twitter'] = 'Twitter Username';
					$profile_fields['facebook'] = 'Facebook URL';
					$profile_fields['gplus'] = 'Google+ URL';
					$profile_fields['linkedin'] = 'Linkedin';
					

					return $profile_fields;
				}

				public function iv_restrict_media_library( $wp_query ) {
					global $current_user, $pagenow;
					
						//global $current_user;
						if( is_admin() && !current_user_can('edit_others_posts') ) {
							$wp_query->set( 'author', $current_user->ID );
							add_filter('views_edit-post', 'fix_post_counts');
							add_filter('views_upload', 'fix_media_counts');
						}
					
				}
				public function check_expiry_date($user) {
					
					include(wp_iv_directories_DIR . '/inc/check_expire_date.php');
				}
				
				public function iv_directories_update_profile_pic(){
					global $current_user;
					if(isset($_REQUEST['profile_pic_url_1'])){
						$iv_profile_pic_url=$_REQUEST['profile_pic_url_1'];
						$attachment_thum=$_REQUEST['attachment_thum'];
					}else{
						$iv_profile_pic_url='';
						$attachment_thum='';
					
					}
					update_user_meta($current_user->ID, 'iv_profile_pic_thum', $attachment_thum);					
					update_user_meta($current_user->ID, 'iv_profile_pic_url', $iv_profile_pic_url);
					echo json_encode('success');
					exit(0);
				}
				
				public function iv_directories_paypal_form_submit(  ) {
					include(wp_iv_directories_DIR . '/admin/pages/payment-inc/paypal-submit.php');
				}	
				public function iv_directories_stripe_form_submit(  ) {
					include(wp_iv_directories_DIR . '/admin/pages/payment-inc/stripe-submit.php');
				}
				
				public function plugin_mce_css_iv_directories( $mce_css ) {
					if ( ! empty( $mce_css ) )
						$mce_css .= ',';

					$mce_css .= plugins_url( 'admin/files/css/iv-bootstrap.css', __FILE__ );

					return $mce_css;
				}
												
				/***********************************
				 * Adds a meta box to the post editing screen
				*/
				public function prfx_custom_meta_iv_cpt1() {
					$directory_url_1=get_option('_iv_directory_url_1');					
						if($directory_url_1==""){$directory_url_1='law-firms';}	
						
						$directory_url_2=get_option('_iv_directory_url_2');					
						if($directory_url_2==""){$directory_url_2='lawyers';}

					add_meta_box('prfx_meta', __('Claim Approve ', 'falcons'), array(&$this, 'iv_cpt1_meta_callback'),$directory_url_1,'side');
				}
				public function prfx_custom_meta_iv_cpt2() {
					$directory_url_1=get_option('_iv_directory_url_1');					
						if($directory_url_1==""){$directory_url_1='law-firms';}	
						
						$directory_url_2=get_option('_iv_directory_url_2');					
						if($directory_url_2==""){$directory_url_2='lawyers';}

					add_meta_box('prfx_meta', __('Claim Approve ', 'falcons'), array(&$this, 'iv_cpt2_meta_callback'),$directory_url_2,'side');
				}
				
				public function iv_directories_check_coupon(){
				
					global $wpdb;
					$coupon_code=$_REQUEST['coupon_code'];
					$package_id=$_REQUEST['package_id'];
					parse_str($_REQUEST['form_data'], $form_data);
					//$package_amount =$_REQUEST['package_amount'];
					$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
					$api_currency =$_REQUEST['api_currency'];
					// Tax Strat********************
						$tax_total=0;
						$tax_type= get_option('_iv_tax_type');
						$tax_active_module=get_option('_iv_directories_active_tax');
						
						if($tax_active_module=='' ){ $tax_active_module='yes';	}					
						if($tax_type==''){$tax_type='country';}
							
						if($tax_active_module=='yes' AND $tax_type=='country'){						
							$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
							$country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
							if(array_key_exists($country_id , $countries_tax_array)){							
								 $country_tax_value= $countries_tax_array[$country_id];
								 $tax_total=$package_amount * $country_tax_value/100;
							}
						}
						if($tax_active_module=='yes' AND $tax_type=='common'){						
							$common_tax_value= get_option('_iv_comman_tax_value');						
							$tax_total=$package_amount * $common_tax_value/100;
							
						}
						$iv_gateway = get_option('iv_directories_payment_gateway');	
						$iv_directories_package_recurring= get_post_meta( $package_id,'iv_directories_package_recurring',true);
						if($iv_directories_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
					// End TAx****************
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='falcons_coupon'");	
						
						if(sizeof($post_cont)>0 && $package_amount>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'falcons_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'falcons_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'falcons_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'falcons_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'falcons_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'falcons_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
												
							 if(in_array('0', $all_pac_arr)){
								$pac_found=1;
								
							 }else{
								if(in_array($package_id, $all_pac_arr)){
									$pac_found=1;
								}else{
									$pac_found=0;
								}
								
							 }
							 $recurring = get_post_meta( $package_id,'iv_directories_package_recurring',true); 
							
							
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found == '1' && $recurring!='on' ){
						
								$total = ($package_amount -$dis_amount)+ $tax_total;
								$coupon_type= get_post_meta($post_cont->ID, 'falcons_coupon_type', true);
								if($coupon_type=='percentage'){
										$dis_amount= $dis_amount * $package_amount/100;
										$total = ($package_amount -$dis_amount)+ $tax_total;
								}
								
								echo json_encode(array('code' => 'success',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								
								exit(0);
							}else{
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-2',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
														
													));
								exit(0);
							
							}
							
						
						}else{
								if($package_amount=="" or $package_amount=="0"){$package_amount='0';}
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-1',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								exit(0);
						
						}
						
					
					
				}
				public function iv_directories_check_package_amount(){
				
					global $wpdb;
					$coupon_code=isset($_REQUEST['coupon_code']);
					$package_id=$_REQUEST['package_id'];
					 $form_data= array();
					 if(isset($_REQUEST['form_data'])){
						parse_str($_REQUEST['form_data'], $form_data);
					}					
					if( get_post_meta( $package_id,'iv_directories_package_recurring',true) =='on'  ){
						$package_amount=get_post_meta($package_id, 'iv_directories_package_recurring_cost_initial', true);			
					}else{					
						$package_amount=get_post_meta($package_id, 'iv_directories_package_cost',true);
					}
					
					$api_currency =$_REQUEST['api_currency'];
					// Tax Strat********************
					$tax_total=0;
					$tax_type= get_option('_iv_tax_type');
					$tax_active_module=get_option('_iv_directories_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}					
					if($tax_type==''){$tax_type='country';}
						
					if($tax_active_module=='yes' AND $tax_type=='country'){						
						$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
						$country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
						if(array_key_exists($country_id , $countries_tax_array)){							
							 $country_tax_value= $countries_tax_array[$country_id];
							 $tax_total=$package_amount * $country_tax_value/100;
						}
					}
					if($tax_active_module=='yes' AND $tax_type=='common'){						
						$common_tax_value= get_option('_iv_comman_tax_value');						
						$tax_total=$package_amount * $common_tax_value/100;
						
					}
						$iv_gateway = get_option('iv_directories_payment_gateway');	
						$iv_directories_package_recurring= get_post_meta( $package_id,'iv_directories_package_recurring',true);
						if($iv_directories_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
						
					// End TAx****************
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='falcons_coupon'");	
						
						if(sizeof($post_cont)>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'falcons_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'falcons_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'falcons_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'falcons_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'falcons_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'falcons_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
							 $pac_found= in_array($package_id, $all_pac_arr);							
							 
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
							// if( $today_time<=$expire_time && $coupon_used<=$coupon_limit){	
								$total = ($package_amount -$dis_amount)+ $tax_total;
								echo json_encode(array('code' => 'success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency.' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								
								exit(0);
							}else{
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								exit(0);
							
							}
							
						
						}else{
								
								$dis_amount='--';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $api_currency.' '.$dis_amount,
														'gtotal' => $api_currency.' '.$total,
														'tax_total'	=>$api_currency .' '.$tax_total,
														'p_amount' => $api_currency.' '.$package_amount,
													));
								exit(0);
						
						}
						
					
					
				}
				public function iv_check_availablility(){
					
					global $wp_query; 
					$directory_url_1=get_option('_iv_directory_url_1');
					if($directory_url_1==""){$directory_url_1='law-firms';}
					
					parse_str($_REQUEST['form_data'], $form_data);
					$old_data='empty';
					$temp_data='empty';
					
					$availablility=get_option('iv_availablility_data');
					if($availablility==''){
						$availablility=array();
						//$availablility=array('biz-law'=>'New york, London','family-law'=>'london' );
					}
										
					if (array_key_exists($form_data['postcats'],$availablility)){						
						$array_string=strtoupper($availablility[$form_data['postcats']]);						
						$all_city=  array_map('trim', explode(',', $array_string));
						$current_city=strtoupper($form_data['address']);
						if(in_array($current_city, $all_city)) {
							$temp_data='have';
						}	
					}
					$selected_cat=$form_data['postcats'];
										
					$arg_f = array(
						'post_type' => $directory_url_1, // enter your custom post type						
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
										'value'   => $form_data['address'],
										'compare' => '='
									),
						);				
					
					
					$query_feature_ajax = new WP_Query( $arg_f );					
					if($query_feature_ajax->found_posts>0){
						$old_data='have';
					}		
														
					if($old_data=='empty' AND $temp_data=='empty'){					
						echo json_encode(array('code' => 'success'));				
						exit(0);
					}else{
						echo json_encode(array('code' => 'not-success','full_message' => 'Sorry, the Practice Category and City is taken.'));		
						
						exit(0);
										
					}
										
					exit(0);
				
				
				}
				/**
				 * Outputs the content of the meta box
				 */
				public function iv_cpt1_meta_callback($post) {
					wp_nonce_field(basename(__FILE__), 'prfx_nonce');
					include ('admin/pages/metabox.php');
				}
				public function iv_cpt2_meta_callback($post) {
					wp_nonce_field(basename(__FILE__), 'prfx_nonce');
					include ('admin/pages/metabox.php');
				}
				public function iv_cpt1_meta_save($post_id) {
					
					global $wpdb;
					$is_autosave = wp_is_post_autosave($post_id);					
						
					if (isset($_REQUEST['iv_cpt1_approve'])) {
						if($_REQUEST['iv_cpt1_approve']=='yes'){ 
								update_post_meta($post_id, 'iv_cpt1_approve', $_REQUEST['iv_cpt1_approve']);
							// Set new user for post
							$sql="UPDATE  $wpdb->posts SET post_author=".$_REQUEST['iv_directories_author_id']."  WHERE ID=".$post_id;		
							$wpdb->query($sql); 	
						}
					} 
				}
				public function iv_cpt2_meta_save($post_id) {
					
					global $wpdb;
					$is_autosave = wp_is_post_autosave($post_id);
					
					if (isset($_REQUEST['iv_cpt2_approve'])) {
						if($_REQUEST['iv_cpt2_approve']=='yes'){ 
								update_post_meta($post_id, 'iv_cpt2_approve', $_REQUEST['iv_cpt2_approve']);
							// Set new user for post
							$sql="UPDATE  $wpdb->posts SET post_author=".$_REQUEST['iv_directories_author_id']."  WHERE ID=".$post_id;		
							$wpdb->query($sql); 	
						}
					} 
				}
				public function iv_content_protected_pages($content) {					
					$current_user = wp_get_current_user();
					global $post ;	
					ob_start();	
					
					$active_module=get_option('_iv_directories_active_visibility_page'); 					
					if(!isset($post->post_type)){
							return $content;
					}	
					
					
					
					if($active_module=='yes' AND $post->post_type=='page'){					
						if(isset($current_user->ID) AND $current_user->ID!=''){
							$user_role= $current_user->roles[0];
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								return $content;
							}
							$message=get_option('_iv_visibility_login_message');							
						}else{							
							$user_role= 'visitor';
							
							$message=get_option('_iv_visibility_visitor_message');
								
						}	
						$store_array=get_option('_iv_visibility_serialize_page_role');
						//echo'<pre>';
						//print_r($store_array);

						 if(isset($store_array[$user_role]))
						{	
							if(in_array($post->post_name, $store_array[$user_role])){
								return $content;
							}else{
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
							}
							
						}else{ 
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
						
						}
						
						
					}
					return $content;
				}
				public function no_comments_on_page( $file )
				{
					
					$current_user = wp_get_current_user(); $user_role= '';	
					global $post ;	
							//echo'<pre>'; print_r($post); echo'</pre>';
					$active_module=get_option('_iv_directories_active_visibility_page'); 					
					
					if($active_module=='yes'){	
							if(isset($current_user->ID) AND $current_user->ID!=''){
								$user_role= $current_user->roles[0];
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									return $file;
								}														
							}else{							
								 $user_role= 'visitor';					
								
							}					
						$have_access=0;
						$store_array=get_option('_iv_visibility_serialize_role');	
						//echo'<pre>'; print_r($store_array); echo'</pre>'.$user_role;
						if(isset($store_array[$user_role]))	{	
							$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
							if(in_array($post_category, $store_array[$user_role])){
								$have_access=1; 
							}else{
								 $have_access=0;
							}							
						}
						$have_access_page=0;
						$store_array_page=get_option('_iv_visibility_serialize_page_role');	
						 if(isset($store_array_page[$user_role])){	
							if(in_array($post->post_name, $store_array_page[$user_role])){
								$have_access_page=1;							
							}else{
								$have_access_page=0;
								
							}							
						}
						if($have_access == 0 AND $have_access_page == 0){
							
							 $file =wp_iv_directories_DIR . '/admin/pages/empty-comment-file.php';
						}
						
					}
					
					
					
					return $file;
				}

				public function iv_directories_content_protected($content) { 
					
					$current_user = wp_get_current_user();
					global $post ;
					
					$active_module=get_option('_iv_directories_active_visibility'); 
					ob_start();	
					

					if($active_module=='yes' AND $post->post_type=='post'){	
										
						if(isset($current_user->ID) AND $current_user->ID!=''){
							$user_role= $current_user->roles[0];
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								
								return $content;
							}
							$message=get_option('_iv_visibility_login_message');
							$iv_redirect = get_option( '_iv_directories_profile_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).'?&profile=level "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);							

						}else{							
							$user_role= 'visitor';
							
							$message=get_option('_iv_visibility_visitor_message');
							$iv_redirect = get_option( '_iv_directories_login_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).' "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);	
						}
						
						$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
						$store_array=get_option('_iv_visibility_serialize_role');
						
						 if(isset($store_array[$user_role]))
						{	
							if(in_array($post_category, $store_array[$user_role])){
								
								return $content;
							}else{
								
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
							}
							//print_r($store_array['Silver']);
						}else{ 
							$content='';
							$content = ob_get_clean();
							$content =  $message; 
							return $content;
							
						}
						
						$output='';
						$output = $content;
					}
					
					
					return $content;
				}
				
			
				public function iv_directories_user_exist_check(){
						global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
					
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					
					
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 //$user_id = wp_insert_user( $userdata ) ;
								echo json_encode('success');
								exit(0);
						} else {
								echo json_encode('User or Email exists');
								exit(0);
						}
					}
									
				
						
				
				}
				public function iv_directories_registration_submit() {
					
					global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
						
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['first_name']=$data_a2['iv_member_fname'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['last_name']=$data_a2['iv_member_lname'];
					}							
					
					//print_r($userdata);
					
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 $user_id = wp_insert_user( $userdata ) ;
						} else {
							echo json_encode('User or Email exists');
							exit(0);
						}
					}
					
					//$hidden_form_name = $data_a2['iv_directories_registration'];
					$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'iv_directories_account_form'");
					
					$iv_directories_auto_email = get_post_meta($post_id, 'iv_directories_auto_email', true);
					$admin_mail = get_option('admin_email');
					$wp_title = get_bloginfo();
					
						// email for user
					
					foreach ($data_a2 as $key => $item) {
						$search_sort_key = '[' . $key . ']';
						$iv_directories_auto_email = str_replace($search_sort_key, $item, $iv_directories_auto_email);
						$search_sort_key = '[ ' . $key . ' ]';
						$iv_directories_auto_email = str_replace($search_sort_key, $item, $iv_directories_auto_email);
					}
					
					$iv_directories_admin_email = get_post_meta($post_id, 'iv_directories_admin_email', true);
						
						
					$cilent_email_address = $userdata['user_email'];
							
					$auto_subject=  get_post_meta($post_id, 'iv_directories_auto_email_subject', true); 
							
					$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
					$h = implode("\r\n", $headers) . "\r\n";
							
					if (get_option('iv_directories_auto_reply') == 'yes') {
								wp_mail($cilent_email_address, $auto_subject, $iv_directories_auto_email, $h);
					}
						
						
				
										
				
						echo json_encode('success');
						exit(0);
				}
				
				
				
				private function load_dependencies() {
					
						// Admin Panel
					if (is_admin()) {
						include ('admin/forms.php');
						include ('admin/notifications.php');
						include ('admin/tables.php');
						include ('admin/admin.php');
					}
					
						// Front-End Site
					if (!is_admin()) {
					}
					
						// Global
					include ('inc/widget.php');
				}
				
				/**
				 * Called every time the plug-in is activated.
				 */
				public function activate() {
					include ('install/install.php');
					
											
				}
				
				/**
				 * Called when the plug-in is deactivated.
				 */
				public function deactivate() {
							global $wpdb;
							//$page_name=get_option('_iv_directories_home');						
							//$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							//$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_price_table');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_registration');							
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_profile_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_profile_public_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_login_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_thank_you_page');					
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_user_dir_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_contact_page');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_blog');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							$page_name=get_option('_iv_directories_about_us');						
							$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
							$wpdb->query($query);
							
							update_option('_cpt1_cpt2_install_setting','');
					
					
				}
				
				/**
				 * Called when the plug-in is uninstalled
				 */
				static function uninstall() {
				}
				
				/**
				 * Register the widgets
				 */
				public function register_widget() {
					//register_widget("wp_iv_directories_widget");
				}
				
				/**
				 * Internationalization
				 */
				public function i18n() {
					
					//load_plugin_textdomain('falcons', false,  get_template_directory() . '/language/' );
					load_plugin_textdomain('falcons', false, basename(dirname(__FILE__)) . '/languages/' );
					
					//die( get_template_directory()  . '/language/');
				}
				
				/**
				 * Starts the plug-in main functionality
				 */
				public function start() {
				}
				public function iv_directories_display_func($atts = '', $content = '') {
					global $wpdb;					
						
					if (isset($atts['form'])) {
						$form_name = $atts['form'];
						$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "'");
						
						$content_post = get_post($post_id);
						$content = $content_post->post_content;
						
					}
					return $content;
				}
				
				public function iv_directories_price_table_func($atts = '', $content = '') {						
						ob_start();						  //include the specified file
							
						include( wp_iv_directories_template. 'pricing-table/price-table.php');						
							
						$content = ob_get_clean();	
					
					return $content;
					
				}
				
				public function iv_directories_registration_form_func($atts = '', $content = '') {
						
						$package_id=0;
						if(isset($_REQUEST['package_id'])){
							$package_id=$_REQUEST['package_id'];
						}
						
						global $wpdb;
						
						$post_name='iv_directories_account_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							$content = str_replace('iv_directories_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function iv_directories_payment_form_func($atts = '', $content = '') {
						
						
						
						global $wpdb;
						
						$post_name='iv_directories_payment_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							//$content = str_replace('iv_directories_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function iv_archive_directories_func(){
					ob_start();	
					$template_path=wp_iv_directories_template.'directories/';
					include( $template_path. 'archive-directories.php');
					
					$content = ob_get_clean();
					return $content;
				}
				public function iv_directories_form_wizard_func($atts = '') {
						
						//global $wpdb;
						$template_path=wp_iv_directories_template.'signup/';						
						ob_start();						
							
						include( $template_path. 'wizard-style-2.php');							
						
						$content = ob_get_clean();	
					
					return $content;
				}
				
				public function iv_directories_profile_template_func($atts = '') {
						//die(wp_iv_directories_template);
						//global $wpdb;
					 global $current_user;
					 ob_start();
					 if($current_user->ID==0){
							include(wp_iv_directories_template. 'private-profile/profile-login.php');
					 
					 }else{
							
							// get_template_part('templates/private-profile/profile-template-1.php','choose');
							//die(get_template_directory_uri().'templates');
							include( wp_iv_directories_template. 'private-profile/profile-template-1.php');
							
						
						
					}
					
					$content = ob_get_clean();	
					
					return $content;
						
					
				}
				public function iv_directories_reminder_email_cron_func ($atts = ''){
					
					include( wp_iv_directories_ABSPATH. 'inc/reminder-email-cron.php');
					
				
				}
				public function iv_directories_cron_job(){
					
					include( wp_iv_directories_ABSPATH. 'inc/all_cron_job.php');
					exit(0);
				}
				
				public function lawfirms_categories_func($atts = ''){
					ob_start();						
					include( wp_iv_directories_template. 'lawfirm/lawfirms_categories.php');					
					$content = ob_get_clean();
					return $content;
				}
				public function lawyer_categories_func($atts = ''){
					ob_start();						
					include( wp_iv_directories_template. 'lawyer/lawyer_categories.php');					
					$content = ob_get_clean();
					return $content;
				}
				public function directorypro_map_func($atts = ''){
					ob_start();	
						include( wp_iv_directories_template. 'directories/directories-map.php');
					$content = ob_get_clean();
					return $content;
				}				
				public function lawfirms_featured_home_func($atts = ''){
					ob_start();
					include( wp_iv_directories_template. 'lawfirm/lawfirms_featured.php');
					$content = ob_get_clean();
					return $content;
				}
				public function lawyer_featured_home_func($atts = ''){
					ob_start();
					include( wp_iv_directories_template. 'lawyer/lawyer_featured_home.php');
					$content = ob_get_clean();
					return $content;
				}
				public function cpt2_featured_func($atts = ''){
					ob_start();
					include( wp_iv_directories_template. 'lawyer/cpt2_featured.php');
					$content = ob_get_clean();
					return $content;
				}	
				public function listing_cpt2_style_1_func(){
					ob_start();	
						include( wp_iv_directories_template. 'lawyer/archive-cpt2_style_1.php');
					$content = ob_get_clean();
					return $content;
				
				}
				public function listing_layout_style_1_func(){
					ob_start();	
						include( wp_iv_directories_template. 'lawfirm/archive-cpt1_style_1.php');
					$content = ob_get_clean();
					return $content;
				
				}				
				public function contact_us_func(){
					ob_start();	
						include( wp_iv_directories_template. 'contact/contact-us.php');
					$content = ob_get_clean();
					return $content;
				
				}
				
				
				
				public function iv_directories_user_directory_func($atts = ''){
					global $current_user;					 
					
					
					ob_start();						 
					//include the specified file
					
					include( wp_iv_directories_template. 'user-directory/directory-template.php');
					
					
					$content = ob_get_clean();
					return $content;						
							
						
				}
				public function iv_directories_profile_public_func($atts = '') {
						
						
						
						ob_start();						 
						//include the specified file
						
						include(wp_iv_directories_template. 'profile-public/profile-template.php');
													
						$content = ob_get_clean();	
					
					return $content;
				}
				public function get_search_listing($lat=0,$lng=0,$radius=3,$postcats){
					global $wpdb;	
					
					if($radius==""){$radius='50';}	
					if($lat==""){$lat='0';}	
					if($lng==""){$lng='0';}	
					$results = $wpdb->get_results("SELECT p.ID, 
								ACOS(SIN(RADIANS($lat))*SIN(RADIANS(pm1.meta_value))+COS(RADIANS($lat  ))*COS(RADIANS(pm1.meta_value))*COS(RADIANS(pm2.meta_value)-RADIANS($lng))) * 6387.7 AS distance 
								FROM $wpdb->posts p													
								LEFT JOIN wp_postmeta AS pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'latitude' )
								LEFT JOIN wp_postmeta AS pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'longitude' )
								
								WHERE post_type = 'directories' AND post_status = 'publish'								
								HAVING distance <= $radius
								ORDER BY distance ASC;");
													
					$ids='';
					foreach($results as $row){
						$ids=$row->ID.',';
						
					}
					return $ids;
				}
				public function get_nearest_listing($lat=0,$lng=0,$radius=3){
					global $wpdb;	
					if($radius==""){$radius='50';}	
					if($lat==""){$lat='0';}	
					if($lng==""){$lng='0';}	
					$dir_search_redius=get_option('_dir_search_redius');
					$for_option_redius='6387.7';	
					if($dir_search_redius=="Miles"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
				
					$results = $wpdb->get_results("SELECT p.*, pm1.meta_value as lat, pm2.meta_value as lon, 
								ACOS(SIN(RADIANS($lat))*SIN(RADIANS(pm1.meta_value))+COS(RADIANS($lat  ))*COS(RADIANS(pm1.meta_value))*COS(RADIANS(pm2.meta_value)-RADIANS($lng))) * ".$for_option_redius." AS distance 
								FROM $wpdb->posts p													
								LEFT JOIN wp_postmeta AS pm1 ON ( p.ID = pm1.post_id AND pm1.meta_key = 'latitude' )
								LEFT JOIN wp_postmeta AS pm2 ON ( p.ID = pm2.post_id AND pm2.meta_key = 'longitude' )								
								WHERE post_type = 'directories' AND post_status = 'publish'
								HAVING distance <= $radius
								ORDER BY distance ASC;");
					
					return $results;
				}
				
				
				public function iv_directories_bidding_popup(){
					include( wp_iv_directories_template. 'private-profile/bidding-popup.php');
					exit(0);
				}
				public function iv_directories_contact_popup(){
					include( wp_iv_directories_template. 'private-profile/contact_popup.php');
					exit(0);
				}
				public function iv_directories_claim_popup(){
					include( wp_iv_directories_template. 'private-profile/claim_popup.php');
					exit(0);
				}
			
				public function iv_directories_bidding_position(){
					global $wpdb;
					parse_str($_POST['form_data'], $form_data);
					$amount=$form_data['bump_amount'];
					$dir_id=$form_data['dir_id'];
					$radius=get_option('_iv_radius');
					
					$paid_cat_range=0;
					$paid_area_count=0;
					$top_bump_amount=0;
					$bump_room=0;
					$lat=get_post_meta($dir_id,'latitude',true);
					$long=get_post_meta($dir_id,'longitude',true);						
						
					$nearest_listing = $this->get_nearest_listing($lat,$long,$radius);
					
					$bump_exp_date =get_post_meta($dir_id,'_bump_exp_date',true);
					$bump_amount  = get_post_meta($dir_id,'_bump_amount',true); 
					$bump_create_date= get_post_meta($dir_id,'_bump_create_date',true);
					
					//if(strtotime($bump_exp_date)>=time()){								
							$bump_room=1;								
						foreach ($nearest_listing as $nearest_listing_row) { 										
							if($nearest_listing_row->ID!=$dir_id){
								$near_bump_exp_date=get_post_meta($nearest_listing_row->ID,'_bump_exp_date',true);
								$near_bump_create_date= get_post_meta($nearest_listing_row->ID,'_bump_create_date',true);
								$near_bump_amount= get_post_meta($nearest_listing_row->ID,'_bump_amount',true);	
																	
								if(strtotime($near_bump_exp_date)>=time()){														
										if($near_bump_amount > $amount  ){															
												$paid_area_count++;	
														
										}
										if($amount == $near_bump_amount ){
											 if(strtotime($bump_create_date) < strtotime($near_bump_create_date )){
													$paid_area_count++;
													
											 }	
										}
										
									}
							}
							
						}
					
					//}					
					
					$i=1;
					$free_area_count=0;
					$free_cat_range=0;					
					$cat_range=1+$paid_cat_range+$free_cat_range;
					$area_count=1+$paid_area_count+$free_area_count;
									
					//echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					
					echo json_encode(array("cat_range" => $cat_range, "area_count" => $area_count));
                  exit(0);
				}
				public function iv_directories_save_bidding(){
					global $wpdb;
					parse_str($_POST['form_data'], $form_data);
					
					$amount=$form_data['bump_amount'];
					$balance=get_user_meta(get_current_user_id(),'balance',true);
					if($balance<$amount){
						echo json_encode(array("msg" => 'lowBalance'));
						exit(0);
					}
					$dir_id=$form_data['dir_id'];
					$new_amount=$amount - get_post_meta($dir_id,'bump_amount',true); 
					$bump_exp_date= strtotime("+1 day", time());
					$bump_exp_date=date("Y-m-d H:i:s",$bump_exp_date); 
					
					update_post_meta($dir_id,'_bump_exp_date',$bump_exp_date);
					update_post_meta($dir_id,'_bump_amount',$amount); 
					$current_date=date("Y-m-d H:i:s", time());
					update_post_meta($dir_id,'_bump_create_date',$current_date);
					update_post_meta($dir_id,'_bump_status', 'open');
					$total=get_post_meta($dir_id,'_bump_amount_total',true);
					update_post_meta($dir_id,'_bump_amount_total',$total+$new_amount);
					
					//**********
					
					$balance=$balance - $new_amount;
					update_user_meta(get_current_user_id(),'balance',$balance);
					//*********
					
					
						// Add History ******
						$post_history='Bidding Cost';
						$history_content='Bidding Cost :'.$new_amount.' For Directory  : <a href="'.get_permalink( $dir_id ).'"> '.get_the_title( $dir_id ).'</a>';
						$my_post_form = array('post_title' => wp_strip_all_tags($post_history), 'post_name' => wp_strip_all_tags($post_history), 'post_content' => $history_content, 'post_status' => 'publish', 'post_author' => get_current_user_id(),);
						$newpost_id = wp_insert_post($my_post_form);
						
						$post_type = 'iv_payment';
						$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
						$wpdb->query($query);
						
						update_post_meta($newpost_id,'amount',$new_amount);
						
					
						echo json_encode(array("msg" => 'success'));		
					
						exit(0);		
					
				
				}
				public function iv_directories_save_favorite(){
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];
						
						$old_favorites= get_post_meta($dir_id,'_favorites',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites.', '.get_current_user_id();
						update_post_meta($dir_id,'_favorites',$new_favorites);
						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
						$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
						
						
						$new_favorites2=$old_favorites2.', '.$dir_id;
						update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function iv_directories_save_un_favorite(){
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];
						
						$old_favorites= get_post_meta($dir_id,'_favorites',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites;
						update_post_meta($dir_id,'_favorites',$new_favorites);
						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
						$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);
						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function iv_directories_save_note(){
					
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];
						$note=$form_data['note'];
						
						update_post_meta($dir_id,'_note_'.get_current_user_id(),$note);
						
						echo json_encode(array("msg" => 'success'));
						exit(0);	
				}
				public function iv_directories_delete_favorite(){
						parse_str($_POST['data'], $form_data);					
						$dir_id=$form_data['id'];						
						
						
						$old_favorites= get_post_meta($dir_id,'_favorites',true);
						$old_favorites = str_replace(get_current_user_id(), '',  $old_favorites);
						
						$new_favorites=$old_favorites;
						update_post_meta($dir_id,'_favorites',$new_favorites);						
						
						$old_favorites2=get_user_meta(get_current_user_id(),'_dir_favorites', true);						
						$old_favorites2 = str_replace($dir_id ,' ',  $old_favorites2);						
						
						$new_favorites2=$old_favorites2;
						update_user_meta(get_current_user_id(),'_dir_favorites',$new_favorites2);
						
						
						echo json_encode(array("msg" => 'success'));
						exit(0);
				
				}
				public function iv_directories_paypal_notify_url(){				
						include( wp_iv_directories_ABSPATH. 'inc/paypal_deal_notify_mail.php');	
						exit(0);
				}
				
				public function iv_directories_message_contact(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_iv_directories_ABSPATH. 'inc/contact-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function iv_directories_message_send(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_iv_directories_ABSPATH. 'inc/message-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function iv_directories_claim_send(){
					parse_str($_POST['form_data'], $form_data);					
					
					include( wp_iv_directories_ABSPATH. 'inc/claim-mail.php');	
					
					echo json_encode(array("msg" => 'Message Sent'));
					exit(0);
					
				}
				public function paging() {
					global $wp_query;
					
				} 
				public function check_write_access($arg=''){
					 $current_user = wp_get_current_user();
					 $userId=$current_user->ID;
					
					if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
							return true;
					}		
					 $package_id=get_user_meta($userId,'iv_directories_package_id',true);
					 
					 $access=get_post_meta($package_id, 'iv_directories_package_'.$arg, true);
						if($access=='yes'){
							return true;
						}else{
							return false;
						}
				} 
				public function check_reading_access($arg='',$id=0){
					 global $post;
					  
					 $current_user = wp_get_current_user();
					 $userId=$current_user->ID;
					 if($id>0){
						$post = get_post($id);
					 }			 
					 
					 if($post->post_author==$userId){
						 return true;
					 }
					 $package_id=get_user_meta($userId,'iv_directories_package_id',true);					 
					 $access=get_post_meta($package_id, 'iv_directories_package_'.$arg, true);
					 
					 					
					  $active_module=get_option('_iv_directories_active_visibility'); 
					 
						if($active_module=='yes' ){		
											
								if(isset($current_user->ID) AND $current_user->ID!=''){
									$user_role= $current_user->roles[0];
									if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
										return true;
									}																
								}else{							
									$user_role= 'visitor';
								}	
								
								$store_array=get_option('_iv_visibility_serialize_role');	
								//echo'<pre>';
								//echo $user_role;
								//print_r($store_array);

								 if(isset($store_array[$user_role]))
								{	
									if(in_array($arg, $store_array[$user_role])){
										return true;
									}else{
										
										return false;
									}
									
								}else{ 
										
										return false;
								
								}
								
								
							}else{
								return true;
							}
					
								
				}
				
			}
	}

if(!class_exists('WP_GeoQuery'))
{
	/**
	 * Extends WP_Query to do geographic searches
	 */
	class WP_GeoQuery extends WP_Query
	{
		private $_search_latitude = NULL;
		private $_search_longitude = NULL;
		private $_search_distance = NULL;
		private $_search_postcats = NULL;
		
		
		
		/**
		 * Constructor - adds necessary filters to extend Query hooks
		 */
		public function __construct($args = array())
		{
			// Extract Latitude
			
			if(!empty($args['lat']))
			{
				$this->_search_latitude = $args['lat'];
			}
			// Extract Longitude
			if(!empty($args['lng']))
			{
				$this->_search_longitude = $args['lng'];
			}
			if(!empty($args['distance']))
			{
				$this->_search_distance = $args['distance'];
			}
			if(!empty($args['category']))
			{
				$this->_search_postcats= $args['category'];
				
			}
			
			
			// unset lat/lng
			unset($args['lat'], $args['lng'],$args['distance']);
			
			add_filter('posts_fields', array(&$this, 'posts_fields'), 10, 2);
			add_filter('posts_join', array(&$this, 'posts_join'), 10, 2);
			add_filter('posts_where', array(&$this, 'posts_where'), 10, 2);
			add_filter('posts_groupby', array($this, 'posts_groupby'), 10, 2);
			add_filter('posts_orderby', array(&$this, 'posts_orderby'), 10, 2);
			
			parent::query($args);
			remove_filter('posts_fields', array($this, 'posts_fields'));
			remove_filter('posts_join', array($this, 'posts_join'));
			remove_filter('posts_where', array($this, 'posts_where'));
			remove_filter('posts_groupby', array($this, 'posts_groupby'));
			remove_filter('posts_orderby', array($this, 'posts_orderby'));
			
		} // END public function __construct($args = array())

		/**
		 * Selects the distance from a haversine formula
		 */	
		public function posts_groupby($where) {
			
			global $wpdb;			
			if($this->_search_longitude!=""){
				if($this->_search_postcats!=""){								
					$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance); 					
				}else{								
					$where = $wpdb->prepare("{$wpdb->posts}.ID  HAVING distance < %d ", $this->_search_distance);
				}
			}
			if($this->_search_postcats!=""){
				
				//$where .= $wpdb->prepare(" HAVING distance < %d ", $this->_search_distance);
			}				
			
			
			return $where;
		  }		 
		public function posts_fields($fields)
		{
			global $wpdb;
      
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude))
			{
				
				$dir_search_redius=get_option('_dir_search_redius');
				$for_option_redius='6387.7';	
				if($dir_search_redius=="Miles"){$for_option_redius='3959';}else{$for_option_redius='6387.7'; }
				
				$fields .= sprintf(", ( ".$for_option_redius."* acos( 
						cos( radians(%s) ) * 
						cos( radians( latitude.meta_value ) ) * 
						cos( radians( longitude.meta_value ) - radians(%s) ) + 
						sin( radians(%s) ) * 
						sin( radians( latitude.meta_value ) ) 
					) ) AS distance ", $this->_search_latitude, $this->_search_longitude, $this->_search_latitude);	
			
				$fields .= ", latitude.meta_value AS latitude ";
				$fields .= ", longitude.meta_value AS longitude ";
			}
			return $fields;
		} // END public function posts_join($join, $query)

		/**
		 * Makes joins as necessary in order to select lat/long metadata
		 */		
		public function posts_join($join, $query)
		{
			global $wpdb;
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
			$join .= " INNER JOIN {$wpdb->postmeta} AS latitude ON {$wpdb->posts}.ID = latitude.post_id ";
			$join .= " INNER JOIN {$wpdb->postmeta} AS longitude ON {$wpdb->posts}.ID = longitude.post_id ";
			//$join .= " INNER JOIN {$wpdb->postmeta} AS location ON {$wpdb->posts}.ID = location.post_id ";
			}
			
			return $join;
		} // END public function posts_join($join, $query)
		
		/**
		 * Adds where clauses to compliment joins
		 */		
		public function posts_where($where)
		{	
			if(!empty($this->_search_latitude) && !empty($this->_search_longitude)){
				$where .= ' AND latitude.meta_key="latitude" ';
				$where .= ' AND longitude.meta_key="longitude" ';
				//$where .= ' HAVING distance < '.$this->_search_distance;
			}
			
			return $where;
		} // END public function posts_where($where)
		
		/**
		 * Adds where clauses to compliment joins
		 */	
		public function posts_orderby($orderby)
		{
			if(!empty($this->_search_latitude) && !empty($this->_search_distance))
			{ 
				$orderby = " distance ASC, " . $orderby;
			}			
			return $orderby;
		} // END public function posts_orderby($orderby)
	}
}
/*
 * Creates a new instance of the BoilerPlate Class
*/
function iv_directoriesBootstrap() {
	return wp_iv_directories::instance();
}

iv_directoriesBootstrap(); ?>
