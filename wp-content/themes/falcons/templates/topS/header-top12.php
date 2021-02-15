    <div class="box-shadow-for-ui">
      <div class="uou-block-2d">
        <div class="container">
			<?php $falcons_option_data =get_option('falcons_option_data'); ?>
			<?php
        $top_logo_image= falcons_IMAGE."falcons-logo.png";
        if(isset($falcons_option_data['falcons-header-icon']['url']) AND $falcons_option_data['falcons-header-icon']['url']!=""):
			$top_logo_image=esc_url($falcons_option_data['falcons-header-icon']['url']);
         endif; ?>
         
          <a href="<?php echo esc_url(site_url('/')); ?>" class="logo">  <img src="<?php echo esc_attr($top_logo_image); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"> </a>
          <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>
        </div>
      </div> <!-- end .uou-block-2d -->
    </div>
