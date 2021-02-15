<?php $falcons_option_data =get_option('falcons_option_data');  ?>

<!-- Start Social -->
<?php if(isset($falcons_option_data['falcons-share-button']) && $falcons_option_data['falcons-share-button'] == 1) : ?>
<ul class="buttons">
	<?php if(isset($falcons_option_data['falcons-share-button-facebook']) && $falcons_option_data['falcons-share-button-facebook'] == 1) : ?>
	<li><a class="fa fa-facebook" href="http://www.facebook.com/sharer.php?u=<?php home_url('/');?> "></a></li>
	<?php endif; ?>
	<?php if(isset($falcons_option_data['falcons-share-button-twitter']) && $falcons_option_data['falcons-share-button-twitter'] == 1) : ?>
	<li><a class="fa fa-twitter" href="http://twitthis.com/twit?url=<?php home_url('/'); ?>"></a></li>
	<?php endif; ?>
	<?php if(isset($falcons_option_data['falcons-share-button-linkedin']) && $falcons_option_data['falcons-share-button-linkedin'] == 1) : ?>
	<li><a class="fa fa-google-plus" href="http://plus.google.com/share?url=<?php home_url('/');?>"></a></li>
	<?php endif; ?>
</ul> 
<?php endif; ?>
<!-- End Social -->