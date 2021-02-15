<?php
/**
 * Template Name: Home Page
 *
 */

 ?>
 <?php get_header(); ?>
 


	<div class="">
		<?php echo apply_filters('the_content',$post->post_content); ?>

	</div>
	
  

<?php get_footer();
