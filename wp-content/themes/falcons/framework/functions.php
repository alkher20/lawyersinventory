<?php




/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(  get_template_directory(). '/framework/constants.php' );
require_once(  get_template_directory(). '/framework/ext/extensions-setup.php' );
require_once(  get_template_directory(). '/framework/ext/widget-catagories_one.php' );
require_once(  get_template_directory() . '/framework/ext/widget-newsletter-subscription.php' );
require_once(  get_template_directory(). '/framework/ext/widget-contact-info.php' );
require_once(  get_template_directory(). '/framework/ext/widget-social.php' );
require_once(  get_template_directory(). '/framework/ext/widget-company.php' );
require_once(  get_template_directory(). '/framework/ext/widget-legal.php' );
require_once(  get_template_directory(). '/framework/ext/widget-logo.php' );



require_once(  get_template_directory(). '/framework/ext/widget-archives.php' );
require_once(  get_template_directory(). '/framework/ext/widget-tag.php' );
require_once(  get_template_directory(). '/framework/ext/widget-social.php' );
require_once(  get_template_directory(). '/framework/ext/widget-categories.php' );



require_once(  get_template_directory(). '/framework/theme/style.php' );
require_once(  get_template_directory(). '/framework/theme/scripts.php' );
require_once(  get_template_directory() . '/framework/theme/falcons-image.php' );
require_once(  get_template_directory(). '/framework/theme/falcons-wpml.php' );

require_once(  get_template_directory(). '/framework/admin/functions.php' );
require_once(  get_template_directory(). '/framework/admin/theme-functions.php' );
require_once(  get_template_directory(). '/framework/admin/breadcrumbs.php' );
require_once(  get_template_directory(). '/framework/admin/allBreadcrumbs/arrowcrumbs.php' );
require_once(  get_template_directory() . '/framework/admin/falcons-menu-walker.php' );
require_once(  get_template_directory(). '/framework/admin/falcons-nav-menu-walker-two.php' );
require_once(  get_template_directory(). '/framework/admin/falcons-image.php' );

require_once(  get_template_directory(). '/framework/falcons-profile/plugin.php' );
require_once(  get_template_directory(). '/framework/vc_map.php' );

if (defined('wp_iv_directories_URLPATH') && wp_iv_directories_URLPATH!='') { 
	require_once(  get_template_directory(). '/framework/ext/falcons-cpt1.php' ); 
	require_once(  get_template_directory(). '/framework/ext/falcons-cpt2.php' ); 
}
/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */

	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/framework/redux/ReduxCore/framework.php' ) ) {
	    require_once( get_template_directory() . '/framework/redux/ReduxCore/framework.php' );
	}
	if ( !isset( $falcons_option_data ) && file_exists( get_template_directory() . '/framework/redux/config/config.php' ) ) {
	    require_once( get_template_directory() . '/framework/redux/config/config.php' );
	}


add_filter('nav_menu_css_class' , 'falcons_special_nav_class' , 10 , 2);

function falcons_special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}




