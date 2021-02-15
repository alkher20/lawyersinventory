<div class="form-group">
		<label  class="col-md-2   control-label">Contact Us Subject : Admin  </label>
		<div class="col-md-4 ">
			
				<?php
				$iv_directories_contact_email_subject = get_option( 'falcons_contact_us_email_subject');
				?>
				
				<input type="text" class="form-control" id="contactus_email_subject" name="contactus_email_subject" value="<?php echo $iv_directories_contact_email_subject; ?>" placeholder="Enter subject">
		
	</div>
</div>
<div class="form-group">
		<label  class="col-md-2   control-label">Contact Us Template : Admin  </label>
		<div class="col-md-10 ">
													<?php
					$settings_forget = array(															
						'textarea_rows' =>'20',	
						'editor_class'  => 'form-control',														 
						);
					$content_client = get_option( 'falcons_contact_us_email');
					$editor_id = 'contactus_email_template';
					//wp_editor( $content_client, $editor_id,$settings_forget );										
					?>
			<textarea id="<?php echo $editor_id ;?>" name="<?php echo $editor_id ;?>" rows="20" class="col-md-12 ">
			<?php echo $content_client; ?>
			</textarea>				

	</div>
</div>
<div class="form-group">
		<label  class="col-md-2   control-label">Contact Us Subject : User  </label>
		<div class="col-md-4 ">
			
				<?php
				$iv_directories_contact_email_subject = get_option( 'falcons_contact_us_email_subject_client');
				?>
				
				<input type="text" class="form-control" id="contactus_client_email_subject" name="contactus_client_email_subject" value="<?php echo $iv_directories_contact_email_subject; ?>" placeholder="Enter subject">
		
	</div>
</div>
<div class="form-group">
		<label  class="col-md-2   control-label">Contact Us Template : User  </label>
		<div class="col-md-10 ">
													<?php
					$settings_forget = array(															
						'textarea_rows' =>'20',	
						'editor_class'  => 'form-control',														 
						);
					$content_client = get_option( 'falcons_contact_us_email_client');
					$editor_id = 'contactus_client_email_template';
					//wp_editor( $content_client, $editor_id,$settings_forget );										
					?>
			<textarea id="<?php echo $editor_id ;?>" name="<?php echo $editor_id ;?>" rows="20" class="col-md-12 ">
			<?php echo $content_client; ?>
			</textarea>				

	</div>
</div>
