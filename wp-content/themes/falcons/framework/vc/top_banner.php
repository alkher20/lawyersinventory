<?php

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}


$home_top_image=(isset($atts['top_banner'])?$atts['top_banner']:'');
if($home_top_image==''){
 $home_top_image=falcons_IMAGE.'home-top.jpg';
}else{
 $home_top_image=wp_get_attachment_url($home_top_image);
}
$title=(isset($atts['top_title'])?$atts['top_title']:'Lawyers Directory');
$banner_subtitle=(isset($atts['top_sub_title'])?$atts['top_sub_title']:'SEARCH FOR LAW FIRM AND LAWYERS ON WORLD WIDE BASIS');

$banner_top_icon=(isset($atts['banner_top_icon'])?$atts['banner_top_icon']:'fa-university');

$button_link1= get_post_type_archive_link( $directory_url_1);
$button_link2= get_post_type_archive_link( $directory_url_2);

$button_text1=(isset($atts['lawfirm_button_text'])?$atts['lawfirm_button_text']:'');
$button_link1=(isset($atts['lawfirm_button_link'])?$atts['lawfirm_button_link']:$button_link1);

$button_text2=(isset($atts['lawyer_button_text'])?$atts['lawyer_button_text']:'');
$button_link2=(isset($atts['lawyer_button_link'])?$atts['lawyer_button_link']:$button_link2);



?>

 <div class="falcons-home-banner" style="background: url('<?php echo esc_attr($home_top_image);?>') top center no-repeat;">
		<div class="overlay"></div>
		<div class="banner-content">
			<div class="container">
				<div  class="home-banner-text">
					<div class="row">
						<div class="text-center">
							<div class="banner-icon">
								<i class="fa <?php echo $banner_top_icon;?>"></i>								
							</div>
							<h2>
								<?php
									echo $title;
								?>
							</h2>

						</div>
					</div>
					<div class="row">
						<div class="text-center">
							<p>	<?php
									echo $banner_subtitle;
								?>
							</p>

						</div>
					</div>

				</div>
				<div class="home-banner-button text-center">
					<?php
					if($button_text1!=''){
							echo '<button type="button" class="btn-new btn-custom" onclick="location.href=\''.$button_link1.'\'" >'. $button_text1.'</button>';
					
					}				
				
						
					if($button_text2!=''){									
						echo '<button type="button" class="btn-new btn-custom-white" onclick="location.href=\''.$button_link2.'\'" >'. $button_text2.'</button>';
					}
					?>
				</div>
			</div>
			<?php
			 $top_search_bar=(isset($atts['top_search_bar'])?$atts['top_search_bar']:"");
			if($top_search_bar==true){
			?>
			<div class="home-search-content">
				<?php echo do_shortcode("[search_box bgcolor='1d1d1d']");?>
			</div>
			<?php
			}	
			?>
			

		</div>


</div>


