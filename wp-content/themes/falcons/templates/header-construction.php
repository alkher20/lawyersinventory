<!doctype html>
<html <?php language_attributes();   ?> >

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<?php $falcons_option_data =get_option('falcons_option_data');  ?>

    
  
  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?> 
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
 <div class="uou-block-11a mobileMenu">
        <h5 class="title">Menu</h5>
        <a href="#" class="mobile-sidebar-close">&times;</a>
          <?php get_template_part('templates/header','menuMobile');?>
        <hr>
        
        <?php
          get_search_form();
         ?>
  </div> 

<div id="main-wrapper">
  <div class="toolbar">
        <?php get_template_part('templates/topS/header','topbarChoose');?>
        <?php get_template_part('templates/headerS/header','choose');?>
  </div>

