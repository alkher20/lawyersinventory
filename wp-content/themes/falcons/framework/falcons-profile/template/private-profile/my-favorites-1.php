<?php
wp_enqueue_style('wp-iv_directories-bidding-style-101', wp_iv_directories_URLPATH . 'admin/files/css/bidding.css');
wp_enqueue_style('wp-iv_directories-bidding-style-102', wp_iv_directories_URLPATH . 'admin/files/css/colorbox.css');
wp_enqueue_script('wp-iv_directories-bidding-script-103', wp_iv_directories_URLPATH . 'admin/files/js/jquery.colorbox-min.js');

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

     <div class="profile-content">

              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject">
					  <?php

								_e('My Favorites','falcons')
						?></span>
                    </div>

                  </div>

                  <div class="portlet-body">
                   <div class="row">
							<div class="col-lg-12 col-sm-12">
									<div class="srchresultwrapper">
										
								 <?php
								 $directory_url_1=get_option('_iv_directory_url_1');					
								if($directory_url_1==""){$directory_url_1='law-firms';}	

								$directory_url_2=get_option('_iv_directory_url_2');					
								if($directory_url_2==""){$directory_url_2='lawyers';}	

									$favorites=get_user_meta(get_current_user_id(),'_dir_favorites', true);
									$favorites_a = array();
									$favorites_a = explode(",", $favorites);
									$ids = array_filter($favorites_a);

									$my_favorites = query_posts(array('post__in' => $ids,'post_type'=> array($directory_url_1,$directory_url_2)));

									//global $post;
									if(sizeof($ids)>0){
									foreach ($my_favorites as $post) {

										?>

										<div class="srchresult" id="main_<?php echo $post->ID;?>">
										  <div class="col-lg-3 col-sm-3 col-xs-3">

										<div class="picwrapper">
												<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'medium' );
													if($feature_image[0]!=""){ ?>
														<a href="<?php echo get_permalink($post->ID); ?>" > <img title="dir image"   src="<?php  echo $feature_image[0]; ?>"></a>
													<?php
													}
												?>
										</div>

									  </div>
									  <div class="col-lg-9 col-sm-9 col-xs-9">
										<div class="rightflaot">
											<button type="button" class="btn btn-default btn-xs" onclick="close_his(<?php echo $post->ID;?>);return false;"><i class="fa fa-trash"></i></button>
										</div>
										<h5 class="listing-info" ><a href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title;; ?></a></h5>

										<!-- <p class="desc"> <?php //echo $post->post_content; ?>  </p> -->
										<p class="address"> <?php esc_html_e('Address :','falcons');  echo get_post_meta($post->ID,'address',true); ?>   </p>



									  </div>
									  <div class="col-md-12 bottom-button">
									  	<div class="row">
									  		<div class="col-md-3 col-sm-3">
									  			<div class="profile-button">
													<?php
													$iv_redirect_user = get_option( '_iv_directories_profile_public_page');
													$profile_page_user='';
													if($iv_redirect_user!='defult'){
														$profile_page_user= get_permalink( $iv_redirect_user) ;
													}
													$profile_page_user=$profile_page_user.'?&id='.$post->post_author;

													?>
									  				<a href="<?php echo get_permalink($post->ID); ?>" class="btn-new btn-custom"><?php esc_html_e('Profile','falcons');	 ?></a>
									  			</div>
									  		</div>
									  		<div class="col-md-9">
									  			<div class="rightflaot">
									  				<div id="update_message"></div>
									  				<input type="button"  onclick="load_note_dir(<?php echo $post->ID; ?>,'<?php echo get_post_meta($post->ID,'_note_'.get_current_user_id(),true); ?>');" value="Add note"  class="btn-custom-reverse"/>
									  			<!--<input type="button" value="Contact Property" class="btn btn-primary btn-sm"/>  -->
									  			<a class='btn-custom-reverse popup-contact' href="<?php echo admin_url('admin-ajax.php').'?action=iv_directories_contact_popup&dir-id='.$post->ID; ?>">
									  			 <?php esc_html_e('Contact','falcons');	 ?>
									  			 </a>
									  			</div>
									  		</div>
									  	</div>


									  </div>
										  <div class="">
											<div class="col-lg-12 col-sm- col-xs-12" id="dir_<?php echo $post->ID; ?>">
													<p>
													<?php
													if(get_post_meta($post->ID,'_note_'.get_current_user_id(),true)!=''){
													 ?>

															<strong><?php esc_html_e('Note: ','falcons');	 ?> </strong> <?php echo get_post_meta($post->ID,'_note_'.get_current_user_id(),true); ?>

													<?php
													}
													?>

													</p>


											</div>
										</div>

									  <div class="clear">&nbsp;</div>
									</div>

									<?php
										}
									}else{
										_e('No data available','falcons');

									}
										wp_reset_query();
									?>


								  </div>

									 </div>
								</div>


                </div>
              </div>
 </div>

          <!-- END PROFILE CONTENT -->
<script >
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	function load_note_dir(h_id, note){

		jQuery("#dir_"+h_id).attr("class", "addnote row");

		jQuery("#dir_"+h_id).html('<div class="col-md-10 col-lg-10 col-sm-10 col-xs-12"><textarea cols="" class="" id="note_'+h_id+'" rows="3">'+note+'</textarea></div><div class="col-md-2 col-lg-2 col-sm-2 col-xs-12"><div><input type="button" value="Cancel" onclick="cancel_note('+h_id+');" class="btn-custom-reverse"/></div><div style="margin-top:5px"><input type="button" value=" &nbsp;&nbsp;Save&nbsp;&nbsp; " onclick="save_note('+h_id+');return false;" class="btn-new btn-custom btn-sm"/> </div></div>');
	}

	function save_note(h_id){

			var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';

			if (jQuery.trim(jQuery("#note_"+h_id).val()) == "") {
                        alert("Please Put some comments");
              } else {
                        jQuery('#update_message').html(loader_image);
						var search_params={
								"action"  : 	"iv_directories_save_note",
								"data": "id="+h_id+"&note="+jQuery("#note_"+h_id).val(),
						};
						jQuery.ajax({
							url : ajaxurl,
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){
								jQuery('#update_message').html('');
								if (response.msg=="success") {
                                    var note_save='<div class="col-lg-12 col-sm-12 col-xs-12"> Note : '+jQuery("#note_"+h_id).val() +'</div>';
                                    jQuery("#dir_"+h_id).html(note_save);
                                    //alert('Added Successfully');
                                } else {
                                    alert('Try later');
                                }

							}
						});



             }


	}

	function cancel_note(h_id){

		var note_cancel='Note : '+jQuery("#note_"+h_id).val();
		jQuery("#dir_"+h_id).attr("class", " col-lg-12 col-sm-12 col-xs-12 ");
		jQuery("#dir_"+h_id).html(note_cancel);
	}
	function close_his(h_id){

                        var search_params={
								"action"  : 	"iv_directories_delete_favorite",
								"data": "id="+h_id,
						};
						jQuery.ajax({
							url : ajaxurl,
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){
								jQuery('#update_message').html('');
								if (response.msg=="success") {
                                   jQuery("#main_"+h_id).fadeOut(800, function(){ jQuery(this).remove();});
                                } else {
                                    alert('Try later');
                                }

							}
						});



	}
jQuery(document).ready(function($) {
		jQuery(".popup-contact").colorbox({transition:"None", width:"650px", height:"415px" ,opacity:"0.70"});

})

</script>



