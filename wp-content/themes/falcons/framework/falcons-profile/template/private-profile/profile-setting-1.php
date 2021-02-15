          <style>
            #profile-account2 .profile-content {
              border: 0;
              padding: 0;
              box-shadow: 0px 2px 0px rgba(0,0,0, .1);
              background: #fff;
              margin-bottom: 40px;
            }
            #profile-account2 .portlet {
              padding: 0 15px;
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
            #profile-account2 .nav-tabs {
              float: none;
              background: #f4f4f4;
              width: 100%;
              position: relative;
              z-index: 10;
            }

            #profile-account2 .nav-tabs li {
              width: 25%;
              border-right: 2px solid #f0f0f0;
              border-bottom: o;
              text-align: center;
            }
            #profile-account2 .nav-tabs li:last-child {
              border-right: 0;
            }

            #profile-account2 .portlet-title .nav li.active {
              border-bottom: 0;
            }

            #profile-account2 .portlet-title .nav li.active a {
              background:  #c29c6a;
              color: #fff;
              border-bottom-color: #c29c6a !important;
            }

            #profile-account2 .portlet-title .nav li.active a:before {
              content: '';
              position: absolute;
              left: 45%;
              top: 100%;
              width: 0;
              height: 0;
              border-left: 10px solid transparent;
              border-right: 10px solid transparent;

              border-top: 10px solid #c29c6a;
            }

            @media screen and (max-width: 768px) {
              #profile-account2 .portlet-title .nav li.active a:before {
                display: none;
              }

              #profile-account2 .nav-tabs li {
                width: 50%;
              }
            }

            #profile-account2 .nav-tabs li a {
              padding: 12px 7px;
              border-bottom: 2px solid #f0f0f0 !important;
              margin: 0;
              border-radius: 0;
              text-transform: uppercase;
              color: #333;
              font-size: 13px;
            }

            #profile-account2 .portlet-title .nav li:hover {
              border-bottom: 0;
              background: transparent;
            }

            #profile-account2 .tabbable-line {
              border-bottom: 0;
            }

            #profile-account2 .tab-content {
              padding: 30px;
            }

            .tab-content .form-group {
              position: relative;
              margin-bottom: 30px;
            }

            #profile-account2 label {
              color: #666;
              font-weight: 600;
              font-size: 15px;
              margin-bottom: 8px;
            }

            #profile-account2 .tab-content .table tbody tr {
              background: #f4f4f4;
            }

            #profile-account2 .tab-content .table tbody tr td {
              border-left: 1px solid #ddd;
              border-bottom: 1px solid #ddd;
              padding-left: 20px;
              padding-top: 16px;
              color: #333;
            }
            #profile-account2 .tab-content .table tbody tr td:last-child {
              border-right: 1px solid #ddd;
            }

            #profile-account2 .tab-content .table tbody tr td label {
              background: transparent;
            }

            #profile-account2 .tab-content .table tbody tr td label input {
              margin-right: 5px;
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
              background-color: #c29c6a;
              border: 2px solid #c29c6a;
              color: #fff;
              padding: 6px 30px !important;
            }



            .btn-custom:hover, .btn-custom.hover, .btn-custom:focus, .btn-custom.focus, .btn-custom:active, .btn-custom.active {
                background-color: #A37941;
                border-color: #A37941;
            }

          </style>


          <div class="profile-content">

              <div class="portlet row light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  esc_html_e('Profile','falcons');?> </span>
                    </div>
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#tab_1_1" data-toggle="tab"><?php  esc_html_e('Personal Info','falcons');?> </a>
                      </li>
                      <li>
                        <a href="#tab_1_3" data-toggle="tab"><?php  esc_html_e('Change Password','falcons');?> </a>
                      </li>
                      <li>
                        <a href="#tab_1_5" data-toggle="tab"><?php  esc_html_e('Social','falcons');?> </a>
                      </li>
					  <li>
                        <a href="#tab_1_4" data-toggle="tab"><?php  esc_html_e('Privacy Settings','falcons');?> </a>
                      </li>
                    </ul>
                  </div>

                  <div class="portlet-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="tab_1_1">
                        <form role="form" name="profile_setting_form" id="profile_setting_form" action="#">
                         <?php
								$default_fields = array();
								$field_set=get_option('iv_directories_profile_fields' );

								if($field_set!=""){
										$default_fields=get_option('iv_directories_profile_fields' );
								}else{
									$default_fields['first_name']='First Name';
									$default_fields['last_name']='Last Name';
									$default_fields['phone']='Phone Number';
									$default_fields['mobile']='Mobile Number';
									$default_fields['address']='Address';
									$default_fields['occupation']='Occupation';
									$default_fields['description']='About';
									$default_fields['web_site']='Website Url';

								}
							 if(is_array($field_set) && sizeof($field_set)<1){
									$default_fields['first_name']='First Name';
									$default_fields['last_name']='Last Name';
									$default_fields['phone']='Phone Number';
									$default_fields['mobile']='Mobile Number';
									$default_fields['address']='Address';
									$default_fields['occupation']='Occupation';
									$default_fields['description']='About';
									$default_fields['web_site']='Website Url';
							 }

							$i=1;
							foreach ( $default_fields as $field_key => $field_value ) { ?>
									 <div class="form-group">
										<label class="control-label"><?php echo $field_value; ?></label>
										<input type="text" placeholder="<?php esc_html_e('Enter','falcons'); ?><?php echo ' '.$field_value;?>" name="<?php echo $field_key;?>" id="<?php echo $field_key;?>"  class="" value="<?php echo get_user_meta($current_user->ID,$field_key,true); ?>"/>
									  </div>

							<?php
							}
							?>
                         <!--
                          <div class="form-group">
                            <label class="control-label">First Name</label>
                            <input type="text" placeholder="John" name="first_name" id="first_name"  class="" value="<?php echo get_user_meta($current_user->ID,'first_name',true); ?>"/>
                          </div>


                          <div class="form-group">
                            <label class="control-label">Last Name</label>
                            <input type="text" placeholder="Doe"  name="last_name" id="last_name" class="form-control"  value="<?php echo get_user_meta($current_user->ID,'last_name',true); ?>" />
                          </div>
                          <div class="form-group">
                            <label class="control-label">Phone Number</label>
                            <input type="text" placeholder="+1 646 580 232" name="phone" id="phone" class="form-control"  value="<?php echo get_user_meta($current_user->ID,'phone',true); ?>"/>
                          </div>
						  <div class="form-group">
                            <label class="control-label">Mobile Number</label>
                            <input type="text" placeholder="+1 646 580 DEMO (6284)" name="mobile" id="mobile"class="form-control"  value="<?php echo get_user_meta($current_user->ID,'mobile',true); ?>"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" placeholder="" name="address" id="address" value="<?php echo get_user_meta($current_user->ID,'address',true); ?>" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Occupation</label>
                            <input type="text" placeholder="Web Developer" class="form-control"  name="occupation" id="occupation" value="<?php echo get_user_meta($current_user->ID,'occupation',true); ?>" />
                          </div>
                          <div class="form-group">
                            <label class="control-label">About</label>
                            <textarea class="form-control" name="about" id="about" rows="3" placeholder="About!!!"  ><?php echo get_user_meta($current_user->ID,'description',true); ?></textarea>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Website Url</label>
                            <input type="text"id="web_site" name="web_site" placeholder="www.mywebsite.com" class="form-control" value ="<?php echo get_user_meta($current_user->ID,'web_site',true);?>"/>
                          </div>
                          -->
                          <div class="margiv-top-10">
						    <div class="" id="update_message"></div>
						    <button type="button" onclick="update_profile_setting();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','falcons');?></button>

                          </div>
                        </form>
                      </div>

					  <div class="tab-pane" id="tab_1_3">
                        <form action="" name="pass_word" id="pass_word">
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('Current Password','falcons');?> </label>
                            <input type="password" id="c_pass" name="c_pass" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('New Password','falcons');?> </label>
                            <input type="password" id="n_pass" name="n_pass" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  esc_html_e('Re-type New Password','falcons');?> </label>
                            <input type="password" id="r_pass" name="r_pass" class=""/>
                          </div>
                          <div class="margin-top-10">
                            <div class="" id="update_message_pass"></div>
							 <button type="button" onclick="iv_update_password();"  class="btn-new btn-custom"><?php  esc_html_e('Change Password','falcons');?> </button>

                          </div>
                        </form>
                      </div>

					  <div class="tab-pane" id="tab_1_5">
                        <form action="#" name="setting_fb" id="setting_fb">
                          <div class="form-group">
                            <label class="control-label">FaceBook</label>
                            <input type="text" name="facebook" id="facebook" value="<?php echo get_user_meta($current_user->ID,'facebook',true); ?>" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Linkedin</label>
                            <input type="text" name="linkedin" id="linkedin" value="<?php echo get_user_meta($current_user->ID,'linkedin',true); ?>" class=""/>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Twitter</label>
                            <input type="text" name="twitter" id="twitter" value="<?php echo get_user_meta($current_user->ID,'twitter',true); ?>" class=""/>
                          </div>
						  <div class="form-group">
                            <label class="control-label">Google+ </label>
                            <input type="text" name="gplus" id="gplus" value="<?php echo get_user_meta($current_user->ID,'gplus',true); ?>"  class=""/>
                          </div>


                          <div class="margin-top-10">
						     <div class="" id="update_message_fb"></div>
                            <button type="button" onclick="iv_update_fb();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','falcons');?> </button>

                          </div>
                        </form>
                      </div>
                      <div class="tab-pane" id="tab_1_4">
                        <form action="#" name="setting_hide_form" id="setting_hide_form">
                        <div class="table-responsive">
                          <table class="table table-light table-hover">

                          <tr>
                            <td style="font-size:14px">
                              <?php  esc_html_e('Hide Email Address ','falcons');?>
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="email_hide" name="email_hide"  value="yes" <?php echo( get_user_meta($current_user->ID,'hide_email',true)=='yes'? 'checked':''); ?>/> <?php  esc_html_e('Yes','falcons');?>  </label>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:14px">
                               <?php  esc_html_e('Hide Phone Number','falcons');?>
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="phone_hide" name="phone_hide" value="yes" <?php echo( get_user_meta($current_user->ID,'hide_phone',true)=='yes'? 'checked':''); ?>  /> <?php  esc_html_e('Yes','falcons');?>  </label>
                            </td>
                          </tr>
                          <tr>
                            <td style="font-size:14px">
                              <?php  esc_html_e('Hide Mobile Number','falcons');?>
                            </td>
                            <td>
                              <label class="uniform-inline">
                              <input type="checkbox" id="mobile_hide" name="mobile_hide" value="yes"  <?php echo( get_user_meta($current_user->ID,'hide_mobile',true)=='yes'? 'checked':''); ?> /> <?php  esc_html_e('Yes','falcons');?>  </label>
                            </td>
                          </tr>
                          </table>
                          </div>
                          <!--end profile-settings-->
                          <div class="margin-top-10">
						  <div class="" id="update_message_hide"></div>
						   <button type="button" onclick="iv_update_hide_setting();"  class="btn-new btn-custom"><?php  esc_html_e('Save Changes','falcons');?> </button>


                          </div>
                        </form>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
 <script>

function iv_update_hide_setting (){

	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_hide').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_hide",
					"form_data":	jQuery("#setting_hide_form").serialize(),
				};
				jQuery.ajax({
					url : ajaxurl,
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){

						jQuery('#update_message_hide').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');

					}
				});

	}
function iv_update_fb (){

	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_fb').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_fb",
					"form_data":	jQuery("#setting_fb").serialize(),
				};
				jQuery.ajax({
					url : ajaxurl,
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){

						jQuery('#update_message_fb').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');

					}
				});

	}
function iv_update_password (){

	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo wp_iv_directories_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message_pass').html(loader_image);
				var search_params={
					"action"  : 	"iv_directories_update_setting_password",
					"form_data":	jQuery("#pass_word").serialize(),
				};
				jQuery.ajax({
					url : ajaxurl,
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){

						jQuery('#update_message_pass').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');

					}
				});

	}
 </script>

