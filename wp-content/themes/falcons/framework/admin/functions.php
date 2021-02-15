<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;




/*-------------------------------------------------------------------------
  START REGISTER falcons SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'falcons_sidebar' ) ) {


function falcons_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => esc_html__( 'Page Sidebar', 'falcons' ),   
    'description'   => esc_html__('Put your main sidebar widgets here','falcons'),  
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '<h5 class="sidebar-title">',
    'after_title'   => '</h5>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'falcons_footer_left_sidebar',
    'name'          => esc_html__( 'Footer', 'falcons' ),
    'description'   => esc_html__('Put your widgets here that show on footer side area','falcons'),    
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar = array(

    'id'            => 'falcons_footer_middle_sidebar',
    'name'          => esc_html__( 'Footer Middle Sidebar', 'falcons' ),
    'description'   => esc_html__('Put your widgets here that show on footer middle area','falcons'), 
    'before_widget' => '<div class="col-md-3 col-sm-6">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',

  );

  //register_sidebar( $footer_middle_sidebar );


 $footer_right_sidebar = array(
    'id'            => 'falcons_footer_right_sidebar',
    'name'          => esc_html__( 'Footer Right Sidebar', 'falcons' ),
    'description'   => esc_html__('Put your widgets here that show on footer right side area example(newsletter)','falcons'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_right_sidebar );

  $footer_down_sidebar = array(
    'id'            => 'falcons_footer_down_sidebar',
    'name'          => esc_html__( 'Footer Down Sidebar', 'falcons' ),
    'description'   => esc_html__('Put your widgets here that show on footer down side area example(contact info)','falcons'), 
    'before_widget' => '',
    'after_widget'  => '',
    'before_title'  => '',
    'after_title'   => '',
  );

  //register_sidebar( $footer_down_sidebar );

 $footer_extra_middle_sidebar = array(
    'id'            => 'falcons_footer_extra_middle_sidebar',
    'name'          => esc_html__( 'Footer Extra Middle Sidebar', 'falcons' ),
    'description'   => esc_html__('Put your widgets here that show on footer extra middle side area','falcons'), 
    'before_widget' => '<div class="col-sm-4">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5>',
    'after_title'   => '</h5>',
  );

  //register_sidebar( $footer_extra_middle_sidebar );

}

add_action( 'widgets_init', 'falcons_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER falcons SIDEBARS
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR falcons
 ------------------------------------------------------------------------- */   

function falcons_custom_navigation_menus() {

  $locations = array(

    //'primary_navigation_left'   => esc_html__('Primary Menu Left','falcons'),
    'primary_navigation_right'  => esc_html__('Primary Menu','falcons'), 
    //'primary_navigation_footer' => esc_html__('Primary Menu footer','falcons'), 
    //'primary_navigation_mobile' => esc_html__('Primary Menu mobile','falcons'), 



  );

  register_nav_menus( $locations );

}

add_action( 'init', 'falcons_custom_navigation_menus' );



/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  falcons
 ------------------------------------------------------------------------- */ 


 /*-------------------------------------------------------------------------
  START falcons CUSTOM CSS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'falcons_custom_css' );


function falcons_custom_css() {

  $falcons_option_data =get_option('falcons_option_data'); 
  if(isset($falcons_option_data['falcons-custom-css'])){
    echo "<style>" . $falcons_option_data['falcons-custom-css'] . "</style>";  
  }
  
  
}


/*-------------------------------------------------------------------------
  END falcons AUTORENT CUSTOM CSS END
------------------------------------------------------------------------- */


/*-------------------------------------------------------------------------
  START falcons CUSTOM JS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'falcons_custom_js' );

function falcons_custom_js() {
  $falcons_option_data =get_option('falcons_option_data'); 
  if(isset($falcons_option_data['falcons-custom-js'])){
    echo "<script>" . $falcons_option_data['falcons-custom-js'] . "</script>";  
  }
  
}


/*-------------------------------------------------------------------------
  END falcons CUSTOM JS END
------------------------------------------------------------------------- */

 register_sidebar(array( 'name' => esc_html__( 'Sidebar ( Shop )', 'falcons' ),'id' => 'shop-sidebar','description' => esc_html__( 'Side for Woocommerce.', 'falcons' ), 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h5 class="side-tittle ">','after_title' => '</h5>'));


