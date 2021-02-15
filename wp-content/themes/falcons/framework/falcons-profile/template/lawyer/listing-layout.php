<?php
get_header(); 

	// For cpt2
	$opt_style=	get_option('_archive_template_cpt2');
	if($opt_style==''){$opt_style='style-1';} 
	if($opt_style=='style-1'){
	 echo do_shortcode('[listing_cpt2_style_1"]');
	}
	
get_footer();
 ?>
