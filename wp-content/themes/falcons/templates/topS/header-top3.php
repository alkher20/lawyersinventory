    <div class="uou-block-1c">
	   <div class="container">
		   <?php
        $top_logo_image= falcons_IMAGE."falcons-logo.png";
        if(isset($falcons_option_data['falcons-header-icon']['url']) AND $falcons_option_data['falcons-header-icon']['url']!=""):
			$top_logo_image=esc_url($falcons_option_data['falcons-header-icon']['url']);
         endif; ?>
         
      <a href="<?php echo esc_url(site_url('/')); ?>" class="logo"> 
      <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"> </a>

      <div class="search">
        <?php get_search_form(); ?>
      </div>
      	<?php get_template_part('templates/header','socialButton'); ?>  
    </div>
  </div> <!-- end .uou-block-1a -->

