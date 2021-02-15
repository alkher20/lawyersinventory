<?php
wp_enqueue_style('wp-iv_directories-bidding-style-102', wp_iv_directories_URLPATH . 'admin/files/css/colorbox.css');
wp_enqueue_script('wp-iv_directories-bidding-script-103', wp_iv_directories_URLPATH . 'admin/files/js/jquery.colorbox-min.js');
global $wpdb;
wp_enqueue_style('wp_iv_directory-style-0A2', wp_iv_directories_URLPATH . 'admin/files/css/jquery.dataTables.css');

	$profile_url=get_permalink();
	global $current_user;
	 $current_user = wp_get_current_user();
	$user = $current_user->ID;
	$message='';
if(isset($_GET['delete_id']))  {
	$post_id=$_GET['delete_id'];
	$post_edit = get_post($post_id);

	if($post_edit->post_author==$current_user->ID){
		wp_delete_post($post_id);
		delete_post_meta($post_id,true);
		$message="Deleted Successfully";
	}



}
 $directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}	
?>


<style>
.boxo{ border:1px solid #ccc; border-radius:0 0 6px 6px; padding:15px 0}
.picwrapper{ padding:0;}

.addnote{ background:#f5f5f5; padding:10px 0; margin:20px; clear:both;}
.addnote textarea{ width:100%;}


#profile-account2 .profile-content {
  border: 0;
  padding: 0;
  box-shadow: 0px 2px 0px rgba(0,0,0, .1);
  background: #fff;
  margin-bottom: 40px;
  border-radius: 3px;
}
#profile-account2 .profile-content .portlet-body {
	padding: 25px;
}


#profile-account2 .portlet {
  padding: 0;
}
#profile-account2 .caption {
  display: block;
  width: 100%;
  float: none;
  padding: 15px 20px !important;
  background: #f0f0f0;
  border-top-left-radius: 3px !important;
  border-top-right-radius: 3px !important;
}
#profile-account2 .caption-subject {
  color: #333 !important;
  text-transform: capitalize;
}
#profile-account2 .tabbable-line {
  margin-bottom: 0;
}



#profile-account2 label {
  color: #666;
  font-weight: 600;
  font-size: 15px;
  margin-bottom: 8px;
}



#main-wrapper {
  background: #fbfbfb;
}


.btn-new {
  display: inline-block;
  margin-bottom: 0;
  font-weight: inherit;
  text-align: center;
  vertical-align: middle;
  touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 0;
  white-space: nowrap;
  color: #ffffff !important;
  padding: 6px 21.312px;
  transition: all 0.3s;
  border-radius: 3px;
  text-transform: uppercase !important;
  font-size: 13px !important;
  font-family: 'Montserrat', sans-serif !important;
}

.btn-custom {
  background-color: #c29c6a !important;
  border: 2px solid #c29c6a !important;
  color: #fff;

}

.nav-button {
	position: relative;
	width: 100%;
	padding: 30px;
	padding-bottom: 0;
}

.nav-button a {
	margin-right: 10px;
}

#profile-account2 a.btn-custom-reverse {
	color: #c29c6a !important;
	background: transparent;
	border: 2px solid #c29c6a !important;
	padding: 4px 10px;
	border-radius: 3px;
}

.btn-custom-reverse {
	color: #c29c6a !important;
	background: transparent;
	border: 2px solid #c29c6a !important;
	padding: 3px 10px;
	border-radius: 3px;

}

#profile-account2 .green-haze {
  background-color: #c29c6a !important;
  border: 2px solid #c29c6a;
  color: #fff;
}



.btn-custom:hover, .btn-custom.hover, .btn-custom:focus, .btn-custom.focus, .btn-custom:active, .btn-custom.active {
    background-color: #A37941;
    border-color: #A37941;
}


#profile-account2 .profile-content .portlet-body .srchresult {
	margin-bottom: 20px;
	border: 1px solid #ddd;
	border-radius: 3px;
	padding: 18px 10px 4px;

}

#profile-account2 .profile-content .portlet-body .srchresult .address {
	font-size: 14px;
}

#profile-account2 .profile-content .portlet-body .srchresult .addnote.row {
	margin-left: 15px;
	margin-right: 15px;
}
#profile-account2 .profile-content .portlet-body .srchresult .btn-xs{
	    padding: 2px 8px 3px 8px;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 1px;
    background: #f8f8f8;
    border-radius: 3px;
    color: #999;
}

#profile-account2 .profile-content .portlet-body .srchresult .picwrapper {
	background: transparent;
}

#profile-account2 .profile-content .portlet-body .srchresult .bottom-button {
	position: relative;
	padding-top: 10px;
	padding-bottom: 10px;
}
.srchresult .bottom-button input ,
.srchresult .bottom-button a,
.srchresult .bottom-button input:focus,
.srchresult .bottom-button input:active
.srchresult .bottom-button a:focus,
.srchresult .bottom-button a:active {
	outline: 0;
}
.srchresult .bottom-button .profile-button a {
	width: 100%;
}



</style>


<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
     <div class="profile-content">

              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject">
					  <?php
							esc_html_e('Who is Interested','falcons')	;
						?></span>
                    </div>

                  </div>

                  <div class="portlet-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="tab_1_1">
					  <?php




						if($message!=''){
						 echo  '<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'.$message.'.</div>';
						}

						?>

					<div class="">
							<table id="user-data" class="display table" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th><?php esc_html_e('User Name','falcons'); ?></th>
											<th><?php esc_html_e('Email','falcons'); ?></th>
											<th><?php esc_html_e('Directory','falcons'); ?></th>
											<th> <?php esc_html_e('Contact','falcons'); ?></th>
										</tr>
									</thead>

									<tfoot>
										<tr>
											<th><?php esc_html_e('User Name','falcons'); ?></th>
											<th><?php esc_html_e('Email','falcons'); ?></th>
											<th><?php esc_html_e('Directory','falcons'); ?></th>
											<th> <?php esc_html_e('Contact','falcons'); ?></th>

										</tr>
									</tfoot>

									<tbody>

										<?php
										$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$directory_url_1."','".$directory_url_2."' ) and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' )  ";
									$authpr_post = $wpdb->get_results($sql);
									 $total_post=count($authpr_post);
									$iv_redirect_user = get_option( '_iv_directories_profile_public_page');
									$reg_page_user='';
									if($iv_redirect_user!='defult'){
										$reg_page_user= get_permalink( $iv_redirect_user) ;
									}
									if($total_post>0){
										$i=0;
										foreach ( $authpr_post as $row )
										{		//echo '<br/>ID...'.$row->ID;
												$user_list= get_post_meta($row->ID,'_favorites',true);
												$user_list_arr2 = array();
												$user_list_arr = array_filter( explode(",", $user_list), 'strlen' );
												$i=0;
												foreach($user_list_arr as $arr){
													if(trim($arr)!=''){
														$user_list_arr2[$i]=$arr;
														$i++;
													}
												}
											if(sizeof($user_list_arr2)>0){

													$args_users = array ('include'  =>$user_list_arr2,);
													// The User Query
													$user_query = new WP_User_Query( $args_users );

												if ( ! empty( $user_query->results ) ) {
													foreach ( $user_query->results as $user ) {
															//print_r( $user );
													?>
														<tr>

															<td><?php $reg_page_u=$reg_page_user.'?&id='.$user->user_login;  echo '<a href="'.$reg_page_u.'">'. $user->display_name.'</a>'; ?> </td>
															<td><?php echo $user->user_email; ?></td>

															<td><?php
																echo '<a href="'.esc_url( get_permalink( $row->ID ) ).'">'.$row->post_title .'</a>';

																?>
															</td>
															<td>
																<a class='btn btn-primary btn-sm popup-contact' href="<?php echo admin_url('admin-ajax.php').'?action=iv_directories_contact_popup&dir-id='.$row->ID; ?>">
																				<?php esc_html_e('Contact','wp_iv_membership'); ?>
																 </a>
															</td>
														</tr>

														<?php
													}

												}
											}
										}
									}
										?>





									</tbody>
								</table>

					</div>

					 </div>

                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
<script>

			jQuery(window).on('load',function(){
				jQuery('#user-data').show();
				var oTable = jQuery('#user-data').dataTable();
				oTable.fnSort( [ [1,'DESC'] ] );
			});


</script>
 <script>
jQuery(document).ready(function($) {
		jQuery(".popup-contact").colorbox({transition:"None", width:"650px", height:"415px" ,opacity:"0.70"});

})
</script>
