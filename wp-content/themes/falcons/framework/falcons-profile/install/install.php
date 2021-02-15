<?php $blog_title = get_bloginfo(); 

global $wpdb;
// Create Basic Role
global $wp_roles;												
//$contributor_roles = $wp_roles->get_role('subscriber');							
$role_name_new= 'basic';
$wp_roles->remove_role( $role_name_new );						 

$role_display_name = 'Basic';						
//$wp_roles->add_role($role_name_new, $role_display_name, $contributor_roles->capabilities);
$wp_roles->add_role($role_name_new, $role_display_name, array(
    'read' => true, // True allows that capability, False specifically removes it.
    //'edit_posts' => true,
    //'delete_posts' => true,
    //'edit_published_posts' => true,
    //'publish_posts' => true,
    //'edit_files' => true,
    'upload_files' => true //last in array needs no comma!
));
	
include ('install-payment-option.php');
include ('install-profile-option.php');
include ('install-signup-email.php');
include ('install-order-email.php');
include ('install-reminder-email.php'); 


update_option('_iv_new_badge_day','7');
update_option('_iv_radius','50');
update_option('_bid_start_amount','.01');
//************************************* Font End Page ****************

update_option('_cpt1_cpt2_install_setting','installed');

// Delete  page
$page_name=get_option('_iv_directories_home');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_price_table');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_registration');							
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_profile_page');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_profile_public_page');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_login_page');					
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_thank_you_page');					
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_user_dir_page');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_contact_page');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_blog');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

$page_name=get_option('_iv_directories_about_us');						
$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
$wpdb->query($query);

// Delete page End

/// **** Create Page for Pricing Table******


	$page_title='Our Pricing';
	$page_name='our-pricing';
	$page_content='[iv_directories_price_table]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_price_table', $newpost_id); 		
	update_option('iv_directories_signup_redirect', $newpost_id);  
	
	// **** Create Account Form For Registration Page******
	
	$page_title='User Registration';
	$page_name='registration';
	$page_content='[iv_directories_form_wizard]';
	$post_iv = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	
	
		
	$newpost_id= wp_insert_post( $post_iv );
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_registration', $newpost_id); 	
	
	/// **** Create Page for User Profile******


	$page_title='My Account';
	$page_name='my-account';
	$page_content='[iv_directories_profile_template]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_profile_page', $newpost_id); 	
	
	/// **** Create Page for User public Profile****** c c c c c c c   c


	$page_title='Profile Public';
	$page_name='profile-public';
	$page_content='[iv_directories_profile_public]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_profile_public_page', $newpost_id);
	
	
	
	// Login Page *******************
	$page_title='Login';
	$page_name='login';
	$page_content='[iv_directories_login]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	$reg_login_page= get_permalink( $newpost_id);
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_login_page', $newpost_id);
	
	/// **** Create Page for Thank you ****** 
	
	$reg_login_page= get_permalink(get_option('_iv_directories_login_page'));
	
	$page_title='Thank You';
	$page_name='thank-you';
	$page_content='<h3>Thank You For Your Signup & Payment. Please login <a href="'.$reg_login_page.'"> here </a>.</h3>';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_thank_you_page', $newpost_id);
	
	/// **** Create Page for User Directory ******
	
	$reg_login_page= get_permalink(get_option('_iv_directories_login_page'));
	
	$page_title='User Directory';
	$page_name='user-directory';
	$page_content='[iv_directories_user_directory]';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/full-width-page.php' );
	update_option('_iv_directories_user_dir_page', $newpost_id);
	
	// Contact Us Page**********
	
	$page_title='Contact Us';
	$page_name='contact-us';
	$page_content='<div class="contact-us-content">
<h5>Contact Information</h5>
<div class="contact-info">
<div class="row">
<div class="col-md-6 left-part">
<div class="single-part">
<h6>Find Us On Map</h6>
<iframe src="https://maps.google.com/maps?q=new york,USA&amp;ie=UTF8&amp;&amp;output=embed" width="100%" height="250" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
<div class="row">
<div class="col-md-6">
<h6>Address Details</h6>
<div class="address-single">
<i class="fa fa-map-marker"></i>
<span>1234 Hydre Street</span>
<span>San Francisco</span>
<span>CA 90043</span>
</div>

<div class="address-single">
<i class="fa fa-phone"></i>
<span><b>Phone:</b>+123 456 789</span>
<span><b>Fax:</b>+400 445 999</span>
</div>

<div class="address-single">
<i class="fa fa-envelope-o"></i>
<span><b>Email:</b><a href="#">example@ex.com</a></span>
<span><b>Website:</b><a href="#">www.yourwebsite.com</a></span>
</div>
</div>
<div class="col-md-6">
<h6>Opening Hours</h6>
<div class="address-single">
<i class="fa fa-clock-o"></i>
<span><b>Mo-Fri:</b> 9am - 5pm</span>
<span><b>Saturday:</b>10am - 2pm</span>
<span><b>Sunday:</b>Closed</span>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="single-part">
<div class="contact-form">
<div class="form-field">
<h6>Send Us a Message</h6>
<p>In case you had any questions or you needed any information about our activities feel free to send us an email. We will respond quickly.</p>
[contact_us]
</div>
</div>
</div>
</div>
</div>
</div>
</div>
	';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template',  'templates/full-width-page.php' );
	update_option('_iv_directories_contact_page', $newpost_id);
	
/// **** Create Page for Home page******


	$page_title='Home';
	$page_name='home';
	$page_content=' [vc_row][vc_column][falcons_top lawfirm_button_text="FIND A Lawfirm " lawyer_button_text="FIND A lawyer " top_search_bar="true"][/vc_column][/vc_row][vc_row][vc_column][falcons_top_3blocks][/vc_column][/vc_row][vc_row][vc_column][falcons_cpt1_category][/vc_column][/vc_row][vc_row][vc_column][falcons_cpt2_category][/vc_column][/vc_row][vc_row][vc_column][falcons_ctp2_featured cpt2_featured_sub_title="With over 5000 lawyers and experts in the healthcare field Lawyers Directory provides a listing of all lawyers across a wide variety "][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]
<h2 style="text-align: center;">Our Pricing</h2>
[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][vc_separator el_width="30"][vc_column_text]
<p style="text-align: center;">I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<p style="text-align: center;">Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>
[/vc_column_text][/vc_column][/vc_row][vc_row][vc_column][iv_directories_price_table][/vc_column][/vc_row][vc_row][vc_column][falcons_ctp1_featured][/vc_column][/vc_row][vc_row][vc_column][falcons_latest_post latest_post_sub_title="With over 5000 lawyers and experts in the healthcare field Lawyers Directory provides a listing of all lawyers across a wide variety if medical fields"][/vc_column][/vc_row]

';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/home.php' );
	update_option('_iv_directories_home', $newpost_id); 
		
	update_option( 'page_on_front', $newpost_id);
    update_option( 'show_on_front', 'page' );
    
    
/// **** Create Page for Blog******

	$page_title='Blog';
	$page_name='blog';
	$page_content='';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	
	update_option('_iv_directories_blog', $newpost_id); 		
	update_option( 'page_for_posts', $newpost_id);
  
	
/// **** About Us Page ******


	$page_title='About Us';
	$page_name='about-us';
	$page_content=' 
        <article class="uou-block-7b secondary">
          <div class="css-table">
            <div class="css-table-cell content">
             
              <h1>Perspiciatis Sint Pariatur Velit Corrupti</h1>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam.</p>

            </div>

            <div class="css-table-cell image has-bg-image">
              <img  src="'. falcons_IMAGE . 'blog-image-2.png" alt="">
            </div>
          </div>
        </article> <!-- end .uou-block-7b -->

		<div class="out-team-content pt30">
        <h4 class="text-center">Our Team</h4>
        <div class="row">
          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.falcons_IMAGE.'member-1.png" alt="">
              <h6>Jessica Walsh <span>Founder &amp; Web Designer</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>

          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.falcons_IMAGE.'member-2.png" alt="">
              <h6>Wade Jeffree <span>Sales Consultant</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>

          <div class="col-sm-4">
            <div class="uou-block-6a rounded">
              <img src="'.falcons_IMAGE.'member-3.jpg" alt="">
              <h6>Stefan Sagmeister <span>Web Developer</span></h6>
              <p>Lorem Ipsum dolor sit amet consectetur. Gravid nib velit auctor aquet sollicitudin lorem quis bibendum auctor</p>
              <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div> <!-- end .uou-block-6a -->
          </div>
        </div>
      </div> <!-- end our-team -->
   ';
	$my_post_form = array(
		'post_title'    => wp_strip_all_tags( $page_title),
		'post_name'    => wp_strip_all_tags( $page_name),
		'post_content'  => $page_content,
		'post_status'   => 'publish',
		'post_author'   =>  get_current_user_id(),	
		'post_type'		=> 'page',
		);
	$newpost_id= wp_insert_post( $my_post_form );	
	update_post_meta( $newpost_id, '_wp_page_template', 'templates/about-us.php' );
	update_option('_iv_directories_about_us', $newpost_id); 
		
  			
	
?>
