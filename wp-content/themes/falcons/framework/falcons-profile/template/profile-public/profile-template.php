<?php
wp_enqueue_style('wp-iv_directories-piblic-11', wp_iv_directories_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_style('iv_directories-style-64', wp_iv_directories_URLPATH . 'assets/cube/css/cubeportfolio.min.css');
wp_enqueue_style('user-public-profile-style', falcons_CSS.'user-public-profile.css', array(), $ver = false, $media = 'all');


$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}	


//wp_enqueue_media();
$display_name='';
$email='';
$user_id=1;
 if(isset($_REQUEST['id'])){
	   $author_name= $_REQUEST['id'];
		$user = get_user_by( 'slug', $author_name );
	if(isset($user->ID)){
		$user_id=$user->ID;
		$display_name=$user->display_name;
		$email=$user->user_email;
	}
  }else{
	  global $current_user;
	  $current_user = wp_get_current_user();
	  $user_id=$current_user->ID;
	  $display_name=$current_user->display_name;
	  $email=$current_user->user_email;
	  if($user_id==0){
		$user_id=1;
	  }
  }
  //print_r($current_user);
  $iv_profile_pic_url=get_user_meta($user_id, 'iv_profile_pic_thum',true);

?>




<style>


</style>


 <div id="profile-template-5" class="bootstrap-wrapper around-separetor public-profile-content">
    <div class="wrapper">
      <div class="row margin-top-10">
        <div class="col-md-3 col-sm-4">
          <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
              <!-- SIDEBAR USERPIC -->
              <div class="profile-userpic text-center">
                  <?php
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{
					 echo'	 <img src="'. wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg" class="agent">';
					}
				  	?>
                      </div>
              <!-- END SIDEBAR USERPIC -->
              <!-- SIDEBAR USER TITLE -->
              <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                   <?php
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?>

                </div>
                <div class="profile-usertitle-job">
                    <?php echo get_user_meta($user_id,'occupation',true); ?>
                </div>
              </div>

            </div>
            <!-- END PORTLET MAIN -->
            <!-- PORTLET MAIN -->
            <div class="portlet portlet0 light">
              <!-- STAT -->

              <!-- END STAT -->
              <div>
                <h4 class="profile-desc-title"><?php esc_html_e('About','falcons'); ?>     <?php
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?>
</h4>
                <span class="profile-desc-text"> <?php echo get_user_meta($user_id,'description',true); ?> </span>
					<?php

					if( get_user_meta($user_id,'hide_phone',true)==''){ ?>
						<h4 class="profile-desc-title">Contact Info</h4>
						 <div class="profile-desc-text">

					<strong class="desc-title"><?php esc_html_e('Phone','falcons'); ?> </strong><?php echo ''. get_user_meta($user_id,'phone',true); ?>
						 </div>
					<?php
					}
					if( get_user_meta($user_id,'hide_mobile',true)==''){ ?>
						 <div class="profile-desc-text">

					<strong class="desc-title"><?php esc_html_e('Mobile','falcons'); ?> </strong><?php echo ''. get_user_meta($user_id,'mobile',true); ?>
						 </div>
					<?php
					}

					if( get_user_meta($user_id,'hide_email',true)==''){ ?>
						 <div class="profile-desc-link"
						 ><strong class="desc-title"><?php esc_html_e('Email','falcons'); ?> </strong>
						 <a href="mailto:<?php echo $email; ?>">

							<?php echo $email; ?>
							</a>
						 </div>
					<?php
					}
            ?>
							<div class=" profile-desc-link"><a href="http://<?php  echo get_user_meta($user_id,'web_site',true); ?>">
							<strong class="desc-title"><?php esc_html_e('About','falcons'); ?> Website</strong>
							<?php  echo get_user_meta($user_id,'web_site',true);  ?>
							</a>
						 </div>
						 <h4 class="profile-desc-title"><?php esc_html_e('Social Profile','falcons'); ?> </h4>
						 <div class="social-info">
                <div class="profile-desc-link">

                  <a href="http://www.twitter.com/<?php  echo get_user_meta($user_id,'twitter',true);  ?>/"><i class="fa fa-twitter-square"></i><?php  //echo get_user_meta($user_id,'twitter',true);  ?></a>
                </div>
                <div class="profile-desc-link">

                  <a href="http://www.facebook.com/<?php  echo get_user_meta($user_id,'facebook',true);  ?>/"><i class="fa fa-facebook-square"></i><?php  //echo get_user_meta($user_id,'facebook',true);  ?></a>
                </div>

                <div class="profile-desc-link">

                  <a href="http://www.plus.google.com/<?php  echo get_user_meta($user_id,'gplus',true);  ?>/"><i class="fa fa-google-plus-square"></i><?php  //echo get_user_meta($user_id,'gplus',true);  ?></a>
                </div>
               </div>
              </div>
            </div>
            <!-- END PORTLET MAIN -->
          </div>

          </div>
            <div class="col-md-9 col-sm-8 border-blue">
              <div class="profile-content">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <i class="icon-globe theme-font hide"></i>
                      <span class="caption-subject font-blue-madison bold uppercase"><?php esc_html_e('User Listing','falcons'); ?> </span>
                    </div>
                  </div>
                  <div class="portlet-body">

							<div id="js-grid-meet-the-team" class="cbp cbp-l-grid-team" >
                       <?php
							global $wpdb;

							$per_page=8;
							$row_strat=0;$row_end=$per_page;
							$current_page=0 ;
							if(isset($_REQUEST['cpage']) and $_REQUEST['cpage']!=1 ){
								$current_page=$_REQUEST['cpage']; $row_strat =($current_page-1)*$per_page;
								$row_end=$per_page;
							}
							$sql="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$directory_url_1."','".$directory_url_2."' )and post_author='".$user_id."' and post_status IN ('publish') ORDER BY  ID DESC  limit ".$row_strat.", ".$row_end." ";
							$authpr_post = $wpdb->get_results($sql);
							$total_post=count($authpr_post);

							if($total_post>0){
								$i=0;
								foreach ( $authpr_post as $row )
								{
									$id=$row->ID;


									$feature_img='';
									if(has_post_thumbnail($id)){
										$feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'large' );
										if($feature_image[0]!=""){
											$feature_img =$feature_image[0];
										}
									}else{
										$feature_img= wp_iv_directories_URLPATH."/assets/images/default-directory.png";

									}
									$currentCategory=wp_get_object_terms( $id, $row->post_type.'-category');
									$cat_link='';$cat_name='';$cat_slug='';
									if(isset($currentCategory[0]->slug)){
										$cat_slug = $currentCategory[0]->slug;
										$cat_name = $currentCategory[0]->name;
									}
									?>
                                      <div class="cbp-item <?php echo $cat_slug; ?> ">
                                      <a class="cbp-caption"  href="<?php echo get_post_permalink($id); ?>" class="cbp-caption cbp-singlePage" >

										<div class="cbp-caption-defaultWrap">
												<img src="<?php echo $feature_img;?>" alt="">
											</div>

											<div class="cbp-caption-activeWrap">
												<div class="cbp-l-caption-alignCenter">
													<div class="cbp-l-caption-body">
														<div class="cbp-l-caption-text"><?php esc_html_e('VIEW DETAIL', 'falcons' ); ?></div>
													</div>
												</div>
											</div>
										</a>


										<a href="<?php echo get_post_permalink($id); ?>" class="cbp-l-grid-team-name" ><?php echo $row->post_title; ?></a>
										<div class="cbp-l-grid-team-position">
										 <?php echo $cat_name.'&nbsp;'; ?> - <?php echo $row->post_type.'&nbsp;'; ?>
										</div>

									</div>



                                          <?php
                                   }
                               }
                                          ?>

							</div>

                      <!-- END PERSONAL INFO TAB -->
                      			<div class="center"><?php
								$sql2="SELECT * FROM $wpdb->posts WHERE post_type IN ('".$directory_url_1."','".$directory_url_2."' ) and post_author='".$user_id."' and post_status IN ('publish') ";
								$authpr_post2 = $wpdb->get_results($sql2);
								$total_post=count($authpr_post2);
								$total_page= $total_post/$per_page;
								$total_page=ceil( $total_page);
								 if($total_page>1){
										$current_page =($current_page==''? '1': $current_page );
										echo ' <ul class="iv-pagination">';
										for($i=1;$i<= $total_page;$i++){
												echo '<li class="'.($i==$current_page  ? 'active-li': '').' list-pagi"><a href="'.get_permalink().'?&profile=all-post&cpage='.$i.'"> '.$i.'</a></li>';
										}
										echo'</ul>';
								}
							?>
						</div>


                </div>

                </div>
                </div>
        </div>
        </div>
      </div>

<?php
wp_enqueue_script('iv_directories-ar-script-23', wp_iv_directories_URLPATH . 'assets/cube/js/jquery.cubeportfolio.min.js');
wp_enqueue_script('iv_directories-ar-script-102', wp_iv_directories_URLPATH . 'assets/cube/js/meet-team.js');
?>


