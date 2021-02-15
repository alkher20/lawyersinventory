<?php $falcons_option_data =get_option('falcons_option_data');  ?>



<?php 

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $falcons_option_data['falcons-top-language'] == 1){
    	
    	falcons_wpml_languages();

    } else {  ?>


		<?php if(isset($falcons_option_data['falcons-top-language']) && $falcons_option_data['falcons-top-language'] == 1) : ?>
		<div class="language">
			<?php if(isset($falcons_option_data['falcons-language']) && is_array($falcons_option_data['falcons-language']) && !empty($falcons_option_data['falcons-language'])) : ?>
			<a class = "toggle" href = "" >
				EN
			</a>

				<ul>
					<?php foreach($falcons_option_data['falcons-language'] as $key => $value){ ?>

					<li><a href="#"><?php echo esc_attr($value); ?></a></li>
					
					<?php } ?>
				</ul>

			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php } ?>
<!-- End Header-Language -->