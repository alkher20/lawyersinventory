</div>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage simple builder
 * @since 1.0
 */
?>
<?php

$falcons_option_data =get_option('falcons_option_data');

$falcons_option_data['falcons-multi-footer-image']=1;
$falcons_option_data['falcons-multi-bottom-image']=1;
?>
<!-- Start Footer Switch -->

<?php if($falcons_option_data['falcons-footer-switch']){?>

<!-- Start falcons Multifooter -->

<!-- Start Footer 7 -->
<?php if(isset($falcons_option_data['falcons-multi-footer-image'])&&($falcons_option_data['falcons-multi-footer-image']==1)){?>
  <!-- uou block 4e -->
  <div class="uou-block-4e">
    <div class="container">
      <div class="row">
		  <!-- Contact us section -->
		  <div class="col-md-3 col-sm-6">
			  <?php
							  /** This filter is documented in wp-includes/default-widgets.php */


						$bg_image_default = falcons_IMAGE.'footer-map-bg.png';
						$title = 	(isset($falcons_option_data['falcons-title-contact']) ? $falcons_option_data['falcons-title-contact'] :'');
						$logo = 	(isset($falcons_option_data['falcons-footer-icon']['url']) ? $falcons_option_data['falcons-footer-icon']['url']: '' );
						$address = (isset($falcons_option_data['falcons-address-contact']) ? $falcons_option_data['falcons-address-contact'] :'');
						$phone_no = (isset($falcons_option_data['falcons-phone-contact']) ? $falcons_option_data['falcons-phone-contact'] :'' );
						$email = 	(isset($falcons_option_data['falcons-email-contact']) ? $falcons_option_data['falcons-email-contact']:'' );
						$bg_image = (isset($falcons_option_data['falcons-contact-bg-image']['url']) ? $falcons_option_data['falcons-contact-bg-image']['url']: $bg_image_default);
						if($bg_image==''){$bg_image=$bg_image_default;}

						?>

						<!-- <div class="col-md-3 col-sm-6"> -->



						<?php if ( ! empty( $logo ) ) { ?>

							<a href="#" class="logo"><img src="<?php echo esc_url($logo); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>"></a>

						<?php } ?>



							<?php



							if ( ! empty( $bg_image ) ) {

								echo '<ul class="contact-info has-bg-image contain" data-bg-image="'.$bg_image.'">';

							}

							else{

								echo '<ul class="contact-info">';

							}



							if ( ! empty( $address ) ) {

								echo '<li><i class="fa fa-map-marker"></i><address>'.$address.'</address></li>';

							}



							if ( ! empty( $phone_no ) ) {

								echo '<li><i class="fa fa-phone"></i><a href="tel:#">'.$phone_no.'</a></li>';

							}



							if ( ! empty( $email ) ) {

								echo '<li><i class="fa fa-envelope"></i><a href="mailto:">'.$email.'</a></li>';

							}


							?>

						</ul>
		  </div>

         <!-- Start left footer sidebar -->

    <?php   if(isset($falcons_option_data['falcons-left-footer-switch'])){ ?>

            <?php

            if(is_active_sidebar('falcons_footer_left_sidebar')):

				dynamic_sidebar('falcons_footer_left_sidebar');

            endif;

            ?>

    <?php } ?>

      </div>
    </div>
  </div> <!-- end .uou-block-4e -->
  <?php } ?>


<?php } ?>

<!-- Start Bottom 7 -->
<?php if(isset($falcons_option_data['falcons-multi-bottom-image'])&&($falcons_option_data['falcons-multi-bottom-image']==1)){?>
  <!-- uou block 4b -->
  <div class="uou-block-4a secondary">
    <div class="container">

      <?php if(isset($falcons_option_data['falcons-show-footer-copyrights'])){?>
      <p>
        <?php if(isset($falcons_option_data['falcons-copyright-text'])&&!empty($falcons_option_data['falcons-copyright-text'])) {?>
        <?php
				if(isset($falcons_option_data['falcons-copyright-link']) && $falcons_option_data['falcons-copyright-link']!='' ){?>

					<a  href="http://<?php echo esc_html($falcons_option_data['falcons-copyright-link']);?> "><?php echo esc_html($falcons_option_data['falcons-copyright-text']);?></i></a>
					<?php
				}else{
					echo esc_html($falcons_option_data['falcons-copyright-text']);
				}



				?>
        <?php } ?>
        <?php bloginfo('name'); ?>.
        <?php if(isset($falcons_option_data['falcons-after-copyright-text'])&&!empty($falcons_option_data['falcons-after-copyright-text'])) {?>
        <?php echo esc_html($falcons_option_data['falcons-after-copyright-text']); ?>
        <?php } ?>
        <?php if(isset($falcons_option_data['falcons-show-footer-credits']) && $falcons_option_data['falcons-show-footer-credits']==1) {?>
        <?php echo '<a href="http://themeforest.net/user/uouapps">UOUAPPS</a>'; ?>
        <?php } ?>

      </p>
      <?php } ?>


    <!-- Start sccial Profile -->

    <?php if(isset($falcons_option_data['falcons-social-profile'])){?>

      <ul class="social-icons">

        <?php if(isset($falcons_option_data['falcons-facebook-profile']) && !empty($falcons_option_data['falcons-facebook-profile'])) : ?>
        <li><a  href="<?php echo esc_url($falcons_option_data['falcons-facebook-profile']);?> "><i class="fa fa-facebook"></i></a></li>
        <?php endif; ?>

        <?php if(isset($falcons_option_data['falcons-twitter-profile']) && !empty($falcons_option_data['falcons-twitter-profile'])) : ?>
        <li><a  href="<?php echo esc_url($falcons_option_data['falcons-twitter-profile']);?> "><i class="fa fa-twitter"></i></a></li>
        <?php endif; ?>

        <?php if(isset($falcons_option_data['falcons-google-profile']) && !empty($falcons_option_data['falcons-google-profile'])) : ?>
        <li><a  href="<?php echo esc_url($falcons_option_data['falcons-google-profile']);?> "><i class="fa fa-google"></i></a></li>
        <?php endif; ?>

        <?php if(isset($falcons_option_data['falcons-linkedin-profile']) && !empty($falcons_option_data['falcons-linkedin-profile'])) : ?>
        <li><a  href="<?php echo esc_url($falcons_option_data['falcons-linkedin-profile']);?> "><i class="fa fa-linkedin"></i></a></li>
        <?php endif; ?>

        <?php if(isset($falcons_option_data['falcons-pinterest-profile']) && !empty($falcons_option_data['falcons-pinterest-profile'])) : ?>
        <li><a  href="<?php echo esc_url($falcons_option_data['falcons-pinterest-profile']);?> "><i class="fa fa-pinterest"></i></a></li>
        <?php endif; ?>

      </ul>

    <?php }?>
    <!-- end of social profile -->

    </div>
  </div>
  <!-- end .uou-block-4a -->
    <?php } ?>



<?php wp_footer(); ?>

</body>
</html>
