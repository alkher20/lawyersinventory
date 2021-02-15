<?php

wp_enqueue_style('profile-login-style', falcons_CSS.'profile-login.css', array(), $ver = false, $media = 'all');

?>
  <div id="login-2" class="bootstrap-wrapper">
   <div class="menu-toggler sidebar-toggler">
   </div>
   <!-- END SIDEBAR TOGGLER BUTTON -->
   <!-- BEGIN LOGO -->

   <!-- END LOGO -->
   <!-- BEGIN LOGIN -->
   <div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form id="login_form" class="login-form" action="" method="post">
      <h3 class="form-title"><?php  esc_html_e('Sign In','falcons');?></h3>
      <div class="form-content">
        <div class="display-hide" id="error_message">

        </div>
        <div class="form-group">
          <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
          <div class="row">
            <div class="col-md-3 col-sm-4">
              <label class="control-label visible-ie8 visible-ie9"><?php  esc_html_e('Username','falcons');?>:</label>
            </div>
            <div class="col-md-9 col-sm-8">
                <input class=" placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username"/>
            </div>

          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-3 col-sm-4">
              <label class="control-label visible-ie8 visible-ie9"><?php  esc_html_e('Password','falcons');?>:</label>

            </div>
            <div class="col-md-9 col-sm-8">
              <input class=" placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" id="password"/>
            </div>

          </div>
        </div>
        <div class="form-actions row">
        <div class="col-md-3"></div>
        <div class="col-md-3 col-sm-4 col-xs-4">
          <button type="button" class="btn-new btn-custom" onclick="return chack_login();" ><?php  esc_html_e('Submit','falcons');?></button>
        </div>
        <p class="margin-20 para col-md-3 col-sm-4 col-xs-4 text-right">
          <input type="checkbox" id="test2" checked="checked" />
          <label for="test2"><?php  esc_html_e('Remember','falcons');?> </label>
        </p>
          <p class="margin-20 para col-md-3 col-sm-4 col-xs-4 text-right">
            <a href="javascript:;" class="forgot-link"><?php  esc_html_e('Forgot Password?','falcons');?> </a>
          </p>
        </div>

      </div>
      
      <?php
         if(has_action('oa_social_login')) {
        ?>
		 <div class="form-actions row">
			   <div class="col-md-4"> </div>
			   <div class="col-md-3">  <?php echo do_action('oa_social_login'); ?></div>
			   <div class="col-md-3"> </div>
		</div>	
		<?php
		}
		?>  
      <div class="create-account">
            <p><?php
        $iv_redirect = get_option( '_iv_directories_price_table');
        $reg_page= get_permalink( $iv_redirect);
        ?>Are you a new user?<a  href="<?php echo $reg_page;?>" id="register-btn" class=""><?php  esc_html_e('Create an account','falcons');?>  </a>
            </p>
      </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form id="forget-password" name="forget-password" class="forget-form" action="" method="post" >
      <h3><?php  esc_html_e('Forget Password ?','falcons');?>  </h3>
      <div class="form-content">
			<div id="forget_message">
          </div>
          <div class="form-group">
            <input class=" placeholder-no-fix" type="text"  placeholder="Email" name="forget_email" id="forget_email"/>
          </div>
          <div class="">
            <button type="button" id="back-btn" class="btn-new btn-warning margin-b-30"><?php  esc_html_e('Back','falcons');?> </button>
            <button type="button" onclick="return forget_pass();"  class="btn-new btn-custom pull-right margin-b-30"><?php  esc_html_e('Submit','falcons');?> </button>
          </div>
      </div>
    </form>
    </div>
    </div>
 <?php
 wp_enqueue_script( 'profile-login-js', falcons_JS.'profile-login.js', array('jquery'), $ver = true, true );
 wp_localize_script( 'profile-login-js', 'HDAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'loading_image'=> wp_iv_directories_URLPATH. 'admin/files/images/loader.gif' ) );

 ?>

