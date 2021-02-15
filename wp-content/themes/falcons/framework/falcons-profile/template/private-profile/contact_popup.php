<?php
$dir_id=0; if(isset($_REQUEST['dir-id'])){$dir_id=$_REQUEST['dir-id'];}	
	
?>
<div class="bootstrap-wrapper" style="margin:0 20px">
		<br/>
		<form action="" id="message-pop" name="message-pop"  method="POST" role="form">
		  
		  <div class="form-group">
				<h3><?php esc_html_e( 'Message Board', 'falcons' ); ?></h3>	
			</div>	
		  
		  <div class="form-group">
			<label for="text" class="control-label"><?php esc_html_e( 'Subject', 'falcons' ); ?></label>
			<input type="text" class="form-control" id="subject" placeholder="<?php esc_html_e( 'Enter Subject', 'falcons' ); ?>">
		  </div>
		  <div class="form-group">
			<label for="text" class="control-label"><?php esc_html_e( 'Enter Message', 'falcons' ); ?></label>
			<textarea name="message-content" id="message-content"  class="form-control" cols="60" rows="4" title="Please Enter Message"  placeholder="<?php esc_html_e( 'Please Enter Message', 'falcons' ); ?>"  ></textarea>
		  </div>
		  <div class="row">
			 <div class="col-md-6">
			 <input type="hidden" name="dir_id" id="dir_id" value="<?php echo $dir_id; ?>">
			  <button type="button" onclick="send_message_iv();" class="btn btn-large btn-primary"><?php esc_html_e( 'Submit', 'falcons' ); ?></button>
			  
			 </div> 
			<div class="col-md-1">
			</div>
			 <div class="col-md-5"> <div id="update_message_popup"></div>
			 </div>
		</div>	 
		</form>
			
</div>

<script type="text/javascript">

	
	function send_message_iv(){	
		if (jQuery.trim(jQuery("#message-content").val()) == "") {
                  alert("Please put your message");
        } else {    
			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_popup').html(loader_image); 
				var search_params={
					"action"  : 	"iv_directories_message_send",	
					"form_data":	jQuery("#message-pop").serialize(), 					
				};
				
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){ 
											
						jQuery('#update_message_popup').html(response.msg );
						jQuery("#message-pop").trigger('reset');
						
					}
				});
		}	
	
	}		 	
	
function closeBox() {
  jQuery.colorbox.close();
}	
	
</script>	





