<div class="uou-block-1e">
	<div class="container">
        <?php get_template_part('templates/header','social'); ?> 
        <?php $falcons_option_data =get_option('falcons_option_data'); ?>
            <?php
			  $falconstopphone='(02) 123-456-7890';
			 if(isset($falcons_option_data['falcons-top-phone']) AND $falcons_option_data['falcons-top-phone']!=""):
				$falconstopphone=$falcons_option_data['falcons-top-phone'];
			 endif;
         
			?>
        
         <a class="contact"  href="tel:<?php echo $falconstopphone;?>"><?php echo $falconstopphone;?></a>
        <?php get_template_part('templates/header','login'); ?> 
        <?php get_template_part('templates/header','language'); ?> 
  </div>
</div> <!-- end .uou-block-1a -->
