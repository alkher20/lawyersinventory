<?php
 $falcons_option_data =get_option('falcons_option_data'); 
 $my_profile= get_option('_iv_directories_profile_page');
 $register= get_option('_iv_directories_registration'); 
 
  if(isset($falcons_option_data['falcons-login-option']) && $falcons_option_data['falcons-login-option'] == 1) : ?>
  <?php $current_user = wp_get_current_user(); ?> 
  <?php if(is_user_logged_in()){ ?>
    <ul class="authentication">
      <li>
        <a href="<?php echo esc_url(home_url('/')); ?>" > <i class="fa fa-user"></i> <?php echo esc_attr($current_user->user_login ); ?></a>
        <div class="login-reg-popup">
          <ul class = "list-unstyled">
            <li><a href="<?php echo esc_url( get_permalink($my_profile)); ?>" > <i class="fa fa-edit"></i> <?php esc_html_e( '&nbsp;Profile &nbsp;' , 'falcons' ); ?></a>  </li>
            <li><a href="<?php echo esc_url(wp_logout_url( home_url('/') )); ?>" > <i class="fa fa-power-off"></i> <?php esc_html_e( 'Logout' , 'falcons' ); ?></a> </li>
          </ul>
        </div>
      </li>
    </ul> 
      
  <?php } else { ?>  


    <ul class="authentication">
      <li> <a href="#"><?php esc_html_e('Login','falcons');?></a>
        <div class="login-reg-popup">

          <form name="loginform" id="loginform" class="default-form" action="<?php echo esc_url(home_url('/').'/wp-login.php'); ?>" method="post">
              <input type="text" name="log" id="user_login"  value="" size="20" placeholder="<?php esc_html_e( 'User name' , 'falcons' ); ?> ">
              <input type="password" name="pwd" id="user_pass"  value="" size="20" placeholder="<?php esc_html_e( 'Password' , 'falcons' ); ?>">
              <input type="submit" name="wp-submit" id="wp-submit" value = "Log In"  class="btn btn-primary">
              <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="testcookie" value="1">

               <label for="rememberme"> 
                <input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember Me' , 'falcons' ); ?> 
               </label> 
          </form>
            <?php echo do_action('oa_social_login'); ?>
        </div>
      </li>
		<?php
		 if (class_exists('wp_iv_directories')) { ?>
		   <li><a href="<?php echo esc_url( get_permalink($register)); ?>" ><?php esc_html_e('Register','falcons');?></a>
		<?php
		 }else{ ?>
				<li><a href="#"><?php esc_html_e('Register','falcons');?></a>
				<div class="login-reg-popup">
					<form method="post" name="myForm">
						<input type="text"  name="uname" placeholder = "<?php esc_html_e('username','falcons');?>"/>
						<input id="email" type="text" name="uemail" placeholder = "<?php esc_html_e('email','falcons');?>" />
						<input type="password"  name="upass" placeholder = "<?php esc_html_e('password','falcons');?>"/>
						<input type="submit" class="btn btn-primary" value = "<?php esc_html_e('Register Here','falcons');?> "/>
					</form>
				</div>
			  </li>
		<?php
		}	 
		?>
   
      
       
      </li>
    </ul> 


  <?php } ?>


<?php endif; ?>
<!-- End Header-Login -->
