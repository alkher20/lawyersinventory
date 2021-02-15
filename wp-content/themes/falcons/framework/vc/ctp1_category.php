<?php

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}



$title=(isset($atts['cpt1_category_title'])?$atts['cpt1_category_title']:'Law Firms Categories');
$banner_subtitle=(isset($atts['cpt1_category_sub_title'])?$atts['cpt1_category_sub_title']:'With over 3000 advocate offeres across 20 countries Falcons is the right place to find your closest law service provider thal will help you in court');



?>
	
 <div class="blog-content pbzero home-blog">
 		<div class="container-fluid text-center">
<h2 class="home-title" style="text-align: center;"><strong><?php echo $title;?></strong></h2>
<div class="home-subtitle"><?php echo $banner_subtitle;?></div>

<div style="text-align: center;"><?php echo do_shortcode('[lawfirms_categories]')?></div>

</div></div>
