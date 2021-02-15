<?php $falcons_option_data =get_option('falcons_option_data');  ?>

<!-- Start Social -->
<?php if(isset($falcons_option_data['falcons-share-button']) && $falcons_option_data['falcons-share-button'] == 1) : ?>
	<ul class="social">
	<?php if(isset($falcons_option_data['falcons-share-button-facebook']) && $falcons_option_data['falcons-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( home_url( '/' ) );?> "></a></li>
	<?php endif; ?>
	<?php if(isset($falcons_option_data['falcons-share-button-twitter']) && $falcons_option_data['falcons-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="https://twitter.com/home?status=<?php echo esc_url( home_url( '/' ) ); ?>"></a></li>
	<?php endif; ?>	
	
	<?php if(isset($falcons_option_data['falcons-share-button-linkedin']) && $falcons_option_data['falcons-share-button-linkedin'] == 1) : ?>	
	<li><a class="fa fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	<?php if(isset($falcons_option_data['falcons-share-button-google']) && $falcons_option_data['falcons-share-button-google'] == 1) : ?>	
	<li><a class="fa fa-google-plus" href="https://plus.google.com/share?url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	<?php if(isset($falcons_option_data['falcons-share-button-pinterest']) && $falcons_option_data['falcons-share-button-pinterest'] == 1) : ?>	
	<li><a class="fa fa-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( home_url( '/' ) );?>"></a></li>
	<?php endif; ?>
	
	</ul> 
<?php endif; ?>

<!-- End Social -->
