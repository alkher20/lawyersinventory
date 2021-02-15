<form  name="contactus" id="contactus"  class="form-horizontal"  role="form">
							<div class="form-group row"  >
								<!-- <label for="text" class="col-md-12 control-label"><?php  _e('Name:','falcons');?><span class="chili"></span></label> -->
								<div class="col-md-7">
									<input type="text"  name="contact_name" id="contact_name"   data-validation="required" data-validation-error-msg="<?php  esc_html_e('Your Name','falcons');?>" class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Enter your name', 'falcons' ); ?>"  >

								</div>
							</div>

						<div class="form-group row">
							<!-- <label for="email" class="col-md-12 control-label" ><?php  esc_html_e('Email:','falcons');?><span class="chili"></span></label> -->
							<div class="col-md-7">
								<input type="email" name="contact_email" id="contact_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Your email', 'falcons' ); ?>" data-validation-error-msg="<?php  esc_html_e('Please enter a valid email address','falcons');?> " >
							</div>
						</div>
						<div class="form-group row"  >
								<!-- <label for="text" class="col-md-12 control-label"><?php  esc_html_e('Subject:','falcons');?><span class="chili"></span></label> -->
								<div class="col-md-7">
									<input type="text"  name="contact_subject"  class="form-control ctrl-textbox" placeholder="<?php esc_html_e( 'Subject', 'falcons' ); ?>" >

								</div>
						</div>
						<div class="form-group row"  >
								<!-- <label for="text" class="col-md-12 control-label"><?php  _e('Message:','falcons');?><span class="chili"></span></label> -->
								<div class="col-md-12">
									<textarea id="contact_content" name="contact_content" class="form-control" placeholder="<?php esc_html_e( 'Message', 'falcons' ); ?>" data-validation="required"></textarea>

								</div>
						</div>



						<div class="row">

								<div class="col-md-12 text-left">
									<button type="submit" class="btn-new btn-custom full-width" > <?php esc_html_e( 'Send Message', 'falcons' ); ?></button>
									 <div id="update_message">	</div>

								</div>
						</div>
</form>
<?php
wp_enqueue_script('iv_directories-script-contact', wp_iv_directories_URLPATH . 'admin/files/js/jquery.form-validator.js');
wp_enqueue_script( 'contact-us-js', falcons_JS.'contact-us.js', array('jquery'), $ver = true, true );
wp_localize_script( 'contact-us-js', 'falcons_data', array( 	'ajaxurl' 			=> admin_url( 'admin-ajax.php' ),
															'loading_image'		=> wp_iv_directories_URLPATH.'admin/files/images/loader.gif',) );

