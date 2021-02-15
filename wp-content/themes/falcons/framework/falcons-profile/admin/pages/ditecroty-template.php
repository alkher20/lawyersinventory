<div class="bootstrap-wrapper">
	<div class="welcome-panel container-fluid">
		
		<div class="row">
			<div class="col-md-12">
				
				<h3 class="page-header" >Listing Layout <small>  </small> </h3>
				
				
				
			</div>
		</div>
		
		
		<div class="form-group col-md-12 row">
			
			<div class="row ">
				<label for="text" class="col-md-3 control-label">cpt1 Category List Short Code</label>
				<div class="col-md-3" >
					[lawfirms_categories]
				</div>
				<div class="col-md-6" >
					<p>
					&lt;?php
					echo do_shortcode('[lawfirms_categories]');
					?&gt;</p>	
					
				</div>				
			</div>
			<div class="row ">
				<label for="text" class="col-md-3 control-label">cpt2 Category List Short Code</label>
				<div class="col-md-3" >
					[lawyer_categories]
				</div>
				<div class="col-md-6" >
					<p>
					&lt;?php
					echo do_shortcode('[lawyer_categories]');
					?&gt;</p>	
					
				</div>				
			</div>
			
			<div class="row ">
				<label for="text" class="col-md-3 control-label">cpt1 Featured List Short Code</label>
				<div class="col-md-3" >
					[lawfirms_featured_home post_ids="22,26,48"]
				</div>
				<div class="col-md-6" >
					<p>
					&lt;?php
					echo do_shortcode('[lawfirms_featured_home post_ids="22,26,48"]');
					?&gt;</p>	
					
				</div>				
			</div>
			<div class="row ">
				<label for="text" class="col-md-3 control-label">cpt2 Featured List Short Code</label>
				<div class="col-md-3" >
					[cpt2_featured post_ids="22,26,48"]
				</div>
				<div class="col-md-6" >
					<p>
					&lt;?php
					echo do_shortcode('[cpt2_featured post_ids="22,26,48"]');
					?&gt;</p>	
					
				</div>				
			</div>
			
			
			
			<div class="row ">
				<label for="text" class="col-md-3 control-label"> Law firm Listing Page</label>
				<div class="col-md-9" >
						
					<a class="btn btn-info btn-xs " href="<?php echo get_post_type_archive_link( 'cpt1' ) ; ?>" target="blank">View Page</a>
				
					
				</div>
			</div>
				<div class="row ">
				<label for="text" class="col-md-3 control-label"> Lawyer Listing Page</label>
				<div class="col-md-9" >
						
					<a class="btn btn-info btn-xs " href="<?php echo get_post_type_archive_link( 'cpt2' ) ; ?>" target="blank">View Page</a>
				
					
				</div>
			</div>
			
			
			<div class="col-md-12" id="success_message">
			</div>
			
			<br/>
			
			<table class="table table-striped responsive">
				<?php
					$opt_style=	get_option('_archive_template');
					if($opt_style==''){$opt_style='style-2';}
				?>
				<tr>
					<td width ="20%">
							<label >
									<input type="radio" name="option-archive" id="option-archive" value="style-1"  <?php  echo ($opt_style=='style-1' ? 'checked': ''); ?> >
									Style 1: Set As Default cpt1 tempale
								</label>
					</td>
					<td>
						<img width="400" height="" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/setting_latout_1.png";?>" class="img-responsive" >
						
						<?php //echo do_shortcode('[listing_layout_style_1]'); ?>						
						<?php //include( wp_iv_directories_template. 'directories/archive-directories-style-1.php');?>
					</td>	
				</tr>
				
				<tr>
					<td>
							<label >
									<input type="radio" name="option-archive" id="option-archive" value="style-2"  <?php  echo ($opt_style=='style-2' ? 'checked': ''); ?>>
									Style 2: Set As Default cpt1 tempale
								</label>
					</td>
					<td>
						<img width="400" height="" src="<?php echo  wp_iv_directories_URLPATH."/assets/images/setting_latout_2.png";?>" class="img-responsive" >
						<?php //echo do_shortcode('[listing_layout_style_2]'); ?>
						<?php //include( wp_iv_directories_template. 'directories/archive-directories-style-2.php');?>
					</td>	
				</tr>
							
				
			</table>	
				
				
			
		</div>
		
			
		
	</div>
</div>
<script type="text/javascript">

	 jQuery(document).ready(function () {

		   jQuery("input[type='radio']").click(function(){
		   		 
				update_profile_public_template(); 
		   });

		});
function update_profile_public_template(){
		
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 			"iv_directories_archive_template",
			"archive-st": jQuery("input[name=option-archive]:checked").val(),	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				//jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
				jQuery('#success_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.code +'.</div>');
			}
		});
}
</script>
