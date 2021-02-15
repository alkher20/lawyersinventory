<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php wp_title('|', true, 'right'); ?> </title>
<!-- Bootstrap -->

<?php
wp_enqueue_style('user-dir-style', falcons_CSS.'user-directory.css', array(), $ver = false, $media = 'all');

global $wpdb;
?>

<script>
	jQuery(function() {
    jQuery('#package_sel').change(function() {
        this.form.submit();
    });
});
</script>
		<?php
		$package ='';
		if(isset($_REQUEST['package_sel'])){
			$package = $_REQUEST['package_sel'];
		}
		if($package==''){
			if(isset($_REQUEST['package'])){
				$package=$_REQUEST['package'];
			}
		}
		$search_user='';
		if(isset($_POST['search_user'])){
			$search_user = $_POST['search_user'];
			//$package = $_POST['package_hidden'];
		}

		?>
	        <div id="directory-temp" class="bootstrap-wrapper">
	        	<div class="main clearfix directory-option row">
		        	<div class="row">
		        		 <form class="dd col-md-6 col-sm-7"   action="<?php echo the_permalink(); ?>" method="post"  >
		        		     <span class="pull-left sort-by"><?php esc_html_e('Sort By:','falcons');	 ?>  </span>
	    		        	 		<div class="row">
			        		       <select id="package_sel" name="package_sel" class="" >
			        		 		     <?php
			        							   $sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_directories_pack'  and post_status='draft' ";
			        							$membership_pack = $wpdb->get_results($sql);
			        								echo'<option value="">All</option>';
			        							foreach ( $membership_pack as $row ){
			        								echo'<option value="'.$row->ID.'"  '.($package==$row->ID ? " selected" : " ") .' >'.$row->post_title.'</option>';

			        							}

			        							  ?>
	    		        	 		  </select >

	    		        	 		  <!-- <div class="arrow-user">
	    		        	 		  <i class="fa fa-angle-down"></i>
	    		        	 		  </div> -->
	    		        	 		  <!--[if IE ]>
	    								<div class="arrow-user1">
	    								<i class="fa fa-angle-down"></i>
	    								</div>
			        	 		  <![endif]-->
			        	 		  </div>
			        	 		</form>
		        	    <form class="dd col-md-6 col-sm-5"   action="<?php echo the_permalink(); ?>" method="post"  >
		        	        <div class="search-username">
			        	        <input type="text" name="search_user" id="search_user" class="search" placeholder="User Name" value="<?php echo $search_user; ?>">
			        	        <button class="submit"><i class="fa fa-search"></i></button>
												<input type="hidden" name="package_hidden" id="package_hidden" value="<?php echo $package; ?>">
		        	    		</div>
		        	    </form>
	        	 		<!--[if IE ]>
								<![endif]-->



	        	</div>
	        	</div>
					<section class="main">
								<ul class="ch-grid">
				        <?php

				        if(isset($atts['per_page'])){
							 $no=$atts['per_page'];
						}else{
							$no=12;
						}

						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						if($paged==1){
						  $offset=0;
						}else {
						   $offset= ($paged-1)*$no;
						}
				        $args = array();
				        $args['number']=$no;
				        $args['offset']=$offset;
				        $args['orderby']='registered';
				        $args['order']='DESC';
				        //$args['search']='12';
				        //$args['search_columns']=array( 'user_login', 'user_email' );
				        if($package!=''){
							$role_package= get_post_meta( $package,'iv_directories_package_user_role',true);
							$args['role']=$role_package;
						}
						  if($search_user!=''){
							$args['search']='*'.$search_user.'*';
						}

						$iv_redirect_user = get_option( '_iv_directories_profile_public_page');
						$reg_page_user='';
				        if($iv_redirect_user!='defult'){
							$reg_page_user= get_permalink( $iv_redirect_user) ;
						}
						if(isset($atts['role'])){
							 $args['role']=$atts['role'];
						}
				        $user_query = new WP_User_Query( $args );

				        // User Loop
				        if ( ! empty( $user_query->results ) ) {
				        	foreach ( $user_query->results as $user ) {

								if (isset($user->wp_capabilities['administrator'])!=1 ){

								$iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
								$reg_page_u=$reg_page_user.'?&id='.$user->user_login; //$reg_page ;
								?>
									<li>

										<div class="ch-item">
										<a href="<?php echo $reg_page_u; ?>">
						                    <?php
						                    if($iv_profile_pic_url!=''){ ?>
								        	 <img src="<?php echo $iv_profile_pic_url; ?>" class="home-img wide tall">
								        	<?php
								        	}else{
								        	 echo'	 <img src="'. wp_iv_directories_URLPATH.'assets/images/Blank-Profile.jpg" class="home-img wide tall">';
								   		} ?>
											<div class="ch-info">
											</div>
											</a>
										</div>
				<p class="para text-center">
						  <?php
						  if(get_user_meta($user->ID,'twitter',true)!=''){
						  ?>
						  <a href="http://www.twitter.com/<?php  echo get_user_meta($user->ID,'twitter',true);  ?>/">
				          <i class="fa fa-twitter"></i>
				          </a>
						  <?php
						  }
						  if(get_user_meta($user->ID,'linkedin',true)!=''){
						  ?>
				          <a href="http://www.linkedin.com/<?php  echo get_user_meta($user->ID,'linkedin',true);  ?>/">
				          <i class="fa fa-linkedin"></i>
				          </a>
						  <?php
						  }
						  if(get_user_meta($user->ID,'facebook',true)!=''){
						  ?>
				          <a href="http://www.facebook.com/<?php  echo get_user_meta($user->ID,'facebook',true);  ?>/">
				          <i class="fa fa-facebook"></i>
				          </a>
						  <?php
						  }
						   if(get_user_meta($user->ID,'gplus',true)!=''){
						  ?>
				          <a href="http://www.plus.google.com/<?php  echo get_user_meta($user->ID,'gplus',true);  ?>/">
				          <i class="fa fa-google-plus"></i>
				          </a>
						  <?php
						  }
						  ?>
				</p>
				<a href="<?php echo $reg_page_u; ?>">
				<h5 class="text-center"><?php echo $user->display_name; ?></h5>
				</a>
				<p class="para1 text-center">
				<?php  	if(get_user_meta($user->ID,'occupation',true)==!""){
							echo get_user_meta($user->ID,'occupation',true);
						}
				}
			  }
		} else {
				     echo 'No users found.';
		 }

		?>
						</ul>
				</section>
				<div class="text-center">
				<?php
					$total_user = $user_query->total_users;
					$total_pages=ceil($total_user/$no);
					echo '<div id="iv-pagination" class="iv-pagination">';

						echo paginate_links( array(
							'base' =>  '%_%'.'?&package='.$package, // the base URL, including query arg
							'format' => '?&paged=%#%', // this defines the query parameter that will be used, in this case "p"
							'prev_text' => __('&laquo; Previous','falcons'), // text for previous page
							'next_text' => __('Next &raquo;','falcons'), // text for next page
							'total' => $total_pages, // the total number of pages we have
							'current' => $paged, // the current page
							'end_size' => 1,
							'mid_size' => 5,
						));
					echo '</div></div>';
					?>
					</div>




