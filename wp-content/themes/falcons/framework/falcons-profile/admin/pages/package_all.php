<?php
	global $wpdb;
	
	//include( wp_iv_directories_ABSPATH. 'install/install-order-email.php');
	//include( wp_iv_directories_ABSPATH. 'install/install-signup-email.php');
	//include( wp_iv_directories_ABSPATH. 'install/install.php');
	
	
	
	$currencies = array();
	$currencies['AUD'] ='$';$currencies['CAD'] ='$';
	$currencies['EUR'] ='€';$currencies['GBP'] ='£';
	$currencies['JPY'] ='¥';$currencies['USD'] ='$';
	$currencies['NZD'] ='$';$currencies['CHF'] ='Fr';
	$currencies['HKD'] ='$';$currencies['SGD'] ='$';
	$currencies['SEK'] ='kr';$currencies['DKK'] ='kr';
	$currencies['PLN'] ='zł';$currencies['NOK'] ='kr';
	$currencies['HUF'] ='Ft';$currencies['CZK'] ='Kč';
	$currencies['ILS'] ='₪';$currencies['MXN'] ='$';
	$currencies['BRL'] ='R$';$currencies['PHP'] ='₱';
	$currencies['MYR'] ='RM';$currencies['AUD'] ='$';
	$currencies['TWD'] ='NT$';$currencies['THB'] ='฿';	
	$currencies['TRY'] ='TRY';	$currencies['CNY'] ='¥';	
	
	
if(isset($_REQUEST['id']))  {
	//include ('edit_form.php');
}
if(isset($_REQUEST['delete_id']))  {
	$post_id=$_REQUEST['delete_id'];
	
		$recurring= get_post_meta($post_id, 'iv_directories_package_recurring', true);
		
		if($recurring=='on'){
			$iv_gateway = get_option('iv_directories_payment_gateway');
			if($iv_gateway=='stripe'){
				
				include(wp_iv_directories_DIR . '/admin/files/init.php');
				// delete Plan ******
				$post_name2='iv_directories_stripe_setting';
				$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name2."' ");
					if(isset($row->ID )){
					  $stripe_id= $row->ID;
					}		
				$post_package = get_post($post_id); 
				$p_name = $post_package->post_name;
				$stripe_mode=get_post_meta( $stripe_id,'iv_directories_stripe_mode',true);	
				if($stripe_mode=='test'){
					$stripe_api =get_post_meta($stripe_id, 'iv_directories_stripe_secret_test',true);	
				}else{
					$stripe_api =get_post_meta($stripe_id, 'iv_directories_stripe_live_secret_key',true);	
				}
				$plan='';	
				\Stripe\Stripe::setApiKey($stripe_api);
				try {
					$plan = \Stripe\Plan::retrieve($p_name);
					$plan->delete();
					
				} catch (Exception $e) {
					 
				}		
					
			}
		}							
	
	wp_delete_post($post_id);
	delete_post_meta($post_id,true);
	$message="Deleted Successfully";
	
}
if(isset($_REQUEST['form_submit']))  {
	$message="Update Successfully ";
}
  $api_currency= get_option('_iv_directories_api_currency' );

?>
<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}

</style>	

<script>
function iv_install_page_template(){

	var search_params={
		"action"  : 	"iv_directories_install_page_template",			
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			location.reload();	
		}
	})	
}
		 
	 jQuery(document).ready(function () {

		   jQuery("input[type='radio']").click(function(){
				save_package_table();
		   });

		});
	function save_package_table(){
						
						var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
						var search_params = {
							"action": 			"iv_directories_update_price_table_template",
							"price-tab-style": jQuery("input[name=option-price-table]:checked").val(),	
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
function iv_package_status_change(status_id,curr_status){
					//$('#test').append("<div onclick='alert(\" "+tmp+" \")'>Show</div>");
					
					 status_id =status_id.trim();
					 curr_status=curr_status.trim();
					var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
						var search_params = {
							"action": 	"iv_directories_update_package_status",
							"status_id": status_id,	
							"status_current":curr_status,
						};
						
						jQuery.ajax({
							url: ajaxurl,
							dataType: "json",
							type: "post",
							data: search_params,
							success: function(response) {   
								if(response.code=='success'){					
									
									jQuery("#status_"+status_id).html('<button class="btn btn-info btn-xs" onclick="return iv_package_status_change(\' '+status_id+' \' ,\' '+response.current_st+' \');">'+response.msg+'</button>');
			

								}
								
							}
						});

}	
</script>

<div class="bootstrap-wrapper">
	
	<div class="container-fluid">
		<?php
	$page_install= get_option('_cpt1_cpt2_install_setting');
	if($page_install!='installed'){?>
	  <div class="row">	
		<div class=" col-md-12  bs-callout bs-callout-info">	
			<?php _e('Please install pages, email template and setting. This is required','falcons');  ?> <button type="button" onclick="return  iv_install_page_template();" class="btn btn-success"><?php _e('Install Now','falcons'); ?> </button>
		</div>		
	
		</div>
	<?php 
	}
	?>
	
	<div class="welcome-panel container-fluid">
		
		
			
			<div class="row ">					
				<div class="col-md-12" id="submit-button-holder">					
					<div class="pull-right ">								
						
						<a class="btn btn-info "  href="<?php echo wp_iv_directories_ADMINPATH; ?>admin.php?page=wp-iv_directories-package-create"><?php _e( 'Create A New Package', 'falcons' ); ?></a>
					</div>
				</div>
			</div>
			
			
			
			<div class="row">
			
				<div class="col-md-12 table-responsive">
					
					<h3  class=""><?php _e( 'All Package / Membership Level', 'falcons' ); ?>  <small></small>
						<small >
							<?php
							
							if (isset($_REQUEST['form_submit']) AND $_REQUEST['form_submit'] <> "") {
								//echo  '<span style="color: #0000FF;"> [ Create Successfully ]</span>';
							}
							if (isset($message) AND $message <> "") {
								echo  '<span style="color: #0000FF;"> [ '.$message.' ]</span>';
							}
							?>
						</small>
					</h3>
				<div class="panel panel-info">
					<div class="panel-body">
					<table class="table table-striped col-md-12">
						<thead >
							<tr>
								<th ><?php _e('Package Name','falcons'); ?></th>
								<th ><?php _e('Amount','falcons'); ?></th>
								<th><?php _e('Link','falcons'); ?></th>
								<th><?php _e('User Role','falcons'); ?></th>
								<th><?php _e('Status','falcons'); ?></th>
								<th ><?php _e('Action','falcons'); ?> </th>
							</tr>
						</thead>
						<tbody>
							<?php
						
							$currency=$api_currency ;
							$currency_symbol=(isset($currencies[$currency]) ? $currencies[$currency] :$currency );
							
							global $wpdb, $post;
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'";
							$membership_pack = $wpdb->get_results($sql);
							$total_package=count($membership_pack);
							
							if(sizeof($membership_pack)>0){
								$i=0;
								foreach ( $membership_pack as $row )
								{	
									echo'<tr>';
									echo '<td>'. $row->post_title.'</td>';
									$amount='';
									if(get_post_meta($row->ID, 'iv_directories_package_cost', true)!="" AND get_post_meta($row->ID, 'iv_directories_package_cost', true)!="0"){
										$amount= get_post_meta($row->ID, 'iv_directories_package_cost', true).' '.$currency;
									}else{
										$amount= '0 '.$currency;
									}
									$recurring= get_post_meta($row->ID, 'iv_directories_package_recurring', true);	
									if($recurring == 'on'){
										$count_arb=get_post_meta($row->ID, 'iv_directories_package_recurring_cycle_count', true); 	
										if($count_arb=="" or $count_arb=="1"){
										$recurring_text=" per ".' '.get_post_meta($row->ID, 'iv_directories_package_recurring_cycle_type', true);
										}else{
										$recurring_text=' per '.$count_arb.' '.get_post_meta($row->ID, 'iv_directories_package_recurring_cycle_type', true).'s';
										}
										
									}else{
										$recurring_text=' &nbsp; ';
									}
									
									$recurring= get_post_meta($row->ID, 'iv_directories_package_recurring', true);	
									if($recurring == 'on'){
										$amount= get_post_meta($row->ID, 'iv_directories_package_recurring_cost_initial', true).' '.$currency;
										$amount=$amount. ' / '.$recurring_text;
									}
												
												
									echo '<td>'. $amount.'</td>';	
									 $page_name_reg=(get_option('_iv_directories_registration')? get_option('_iv_directories_registration'): "0"); 
										
									echo '<td><a target="blank" href="'.get_permalink($page_name_reg).'?&package_id=	'.$row->ID.'">'.get_permalink($page_name_reg).'?&package_id=	'.$row->ID.' </a>
									</td>';
									
									echo '<td>'. $row->post_title.'</td>';
									
									
									?>
									<td>
									<div id="status_<?php echo $row->ID; ?>">
									<?php
									if($row->post_status=="draft"){										
										$pac_msg='Active';
									 }else{										
										$pac_msg='Inactive';
									 }
									?>
									<button class="btn btn-info btn-xs" onclick="return iv_package_status_change('<?php echo $row->ID; ?>','<?php echo $row->post_status; ?>');"><?php echo $pac_msg; ?></button>
									</div>	
										
										<?php
										echo" </td> ";
										echo '<td>  <a class="btn btn-primary btn-xs" href="?page=wp-iv_directories-package-update&id='.$row->ID.'"> Edit</a> <a href="?page=wp-iv_directories-package-all&delete_id='.$row->ID.'" class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure to delete this package?\');">Delete</a></td>';
										
										
										
										echo'</tr>';
										$i++;
									}
								}else{
								
								 echo "	<br/>
										<br/><tr><td> <h4>Package List is Empty </h4></td></tr>";
								}
								?>
								
							</tbody>
						</table>
						
					</div>					
					
					</div>
					</div>
				</div>
				<div class="row">					
					<div class="col-md-12">					
						<div class="">								
							
							<a class="btn btn-info "  href="<?php echo wp_iv_directories_ADMINPATH; ?>admin.php?page=wp-iv_directories-package-create"><?php _e( 'Create A New Package', 'falcons' ); ?> </a>
							
							
								<?php //echo $page_name_reg=get_option('_iv_directories_registration' );  ?>
								<!--
								<a  class="btn btn-primary " target="blank"href="<?php  $page_name_reg=get_option('_iv_directories_registration' ); 	  echo get_page_link($page_name_reg); ?>">Registration Page</a>
								-->
						</div>
					</div>
				</div>
				<br/>
		<div class="panel panel-info">
			<div class="panel-body">		
				
				
				
						<div class=" col-md-12  bs-callout bs-callout-info">		
					<?php _e( 'User role "Basic" is created on the plugin activation. Paid exprired or unsuccessful payment user will set on the "Basic" user role.', 'falcons' ); ?>
						
					
						</div>
											
						<div class="clearfix"></div>
						<ul class=" list-group col-md-6">
								<li class="list-group-item">Short Code : <code>[iv_directories_price_table]  </code></li>
								<li class="list-group-item">PHP Code :<code>
											&lt;?php
											echo do_shortcode('[iv_directories_price_table ]');
											?&gt;</code>  
										</li>
								<li class="list-group-item">
									<?php _e( 'Package Page :', 'falcons' ); ?>  
									<?php 
											$iv_directories_price_table=get_option('_iv_directories_price_table');
											  ?>
											<a class="btn btn-info btn-xs " href="<?php echo get_permalink( $iv_directories_price_table ); ?>" target="blank"><?php _e( 'View Page', 'falcons' ); ?></a>
						

								</li>		
					  </ul>	
						  			
					<div class="clearfix"></div>
					<div class="  bs-callout bs-callout-info">	
						<?php _e( 'Note: You can use other available pricing table. The package link URL will go on "Sign UP " button.', 'falcons' ); ?>
						 
					</div>
				
			
			</div>
		</div>			

					
			
			
				
			</div>
		
		</div>
