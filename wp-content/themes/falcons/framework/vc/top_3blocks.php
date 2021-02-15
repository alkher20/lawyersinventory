<?php

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='lawfirm';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyer';}




$banner_top_icon=(isset($atts['banner_top_icon'])?$atts['banner_top_icon']:'fa-user-md');



$button_link1= get_post_type_archive_link( $directory_url_1);
$button_link2= get_post_type_archive_link( $directory_url_2);

$page_name_reg=get_option('_iv_directories_registration' );
$register_link= get_permalink($page_name_reg);


$block1_color=(isset($atts['block1_color'])?$atts['block1_color']:'#f5f5f5');
$banner_top_icon1=(isset($atts['block1_top_icon'])?$atts['block1_top_icon']:'fa-briefcase');
$title1=(isset($atts['b1top_title'])?$atts['b1top_title']:'Law Firm');
$banner_subtitle1=(isset($atts['b1top_sub_title'])?$atts['b1top_sub_title']:'With Over 300 Law firm across 20 countries falcon directory is the right place to find your closest Law office');
$button_textb1=(isset($atts['b1button_title'])?$atts['b1button_title']:'SEARCH NOW');
$button_linkb1=(isset($atts['b1top_button_link'])?$atts['b1top_button_link']:$button_link1);

//2222222
$block2_color=(isset($atts['block2_color'])?$atts['block2_color']:'#f5f5f5');
$banner_top_icon2=(isset($atts['block2_top_icon'])?$atts['block2_top_icon']:'fa-black-tie');
$title2=(isset($atts['b2top_title'])?$atts['b2top_title']:'Lawyer');
$banner_subtitle2=(isset($atts['b2top_sub_title'])?$atts['b2top_sub_title']:'Find the right lawyers within the closest Law firm across a wide range of law fields including banking');
$button_textb2=(isset($atts['b2button_title'])?$atts['b2button_title']:'SEARCH NOW');
$button_linkb2=(isset($atts['b2top_button_link'])?$atts['b2top_button_link']:$button_link2);

//333333
$block3_color=(isset($atts['block3_color'])?$atts['block3_color']:'#f5f5f5');
$banner_top_icon3=(isset($atts['block13_top_icon'])?$atts['block3_top_icon']:'fa-diamond');
$title3=(isset($atts['b3top_title'])?$atts['b3top_title']:'Register Now');
$banner_subtitle3=(isset($atts['b3top_sub_title'])?$atts['b3top_sub_title']:"You're a law firm with Law firm and lawyers worldwide, falcons directory is the right place to list your Law firm and lawyers, join us now");
$button_textb3=(isset($atts['b3button_title'])?$atts['b3button_title']:'REGISTER');
$button_linkb3=(isset($atts['b3top_button_link'])?$atts['b3top_button_link']:$register_link);


?>
<style>
.feature-content-body {
	margin-bottom: -7px !important;
}	
</style>
 <div class="blog-content pbzero home-blog">
 		<div class="container-fluid text-center">					
 			<div class="row">
 				<div class="feature-content-body">
 				<div class="col-md-4 matchHeight" style="background: <?php echo $block1_color;?>;">
 					<div class="feature-content-single">
 						<h5><i class="fa <?php echo $banner_top_icon1;?> "></i> 						
 						  <?php echo $title1; ?>
 						  </h5>
							<p><?php echo $banner_subtitle1; ?></p>
 						<div class="button-content">
 							<?php 								
 								echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$button_linkb1.'\'" >'.  $button_textb1.'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				<div class="col-md-4 matchHeight  middle" style="background: <?php echo $block2_color;?>;">
 					<div class="feature-content-single">
 						<h5><i class="fa <?php echo $banner_top_icon2;?>"></i>
 						<?php						
							echo $title2; 
						?>
 						</h5>
 						<p><?php 						
 						echo $banner_subtitle2;
 					  ?></p>
 						<div class="button-content">
 							<?php 							
 							echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$button_linkb2.'\'" >'. $button_textb2.'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				<div class="col-md-4 matchHeight" style="background: <?php echo $block3_color;?>;">
 					<div class="feature-content-single">
 						<h5><i class="fa <?php echo $banner_top_icon3;?>"></i><?php						
							echo $title3; 
						?></h5>
 						<p><?php 						
 						echo $banner_subtitle3;
						?></p>
 						<div class="button-content">
 							<?php 							
 							echo '<button type="button" class="btn btn-transparent" onclick="location.href=\''.$button_linkb3.'\'" >'.  $button_textb3.'</button>';
 							?>
 						</div>
 					</div>
 				</div>
 				</div>
 			</div>
 		
		
 		</div>
  </div> <!--  end blog-single -->


