<?php
/**
 * Newsletter widget.  Provies a subscribe form for integration with Google/Feedburner. 
 * Newsletter widget class.
 *
 * @since 0.1.0
 */

ob_start();
class falcons_Widget_Newsletter extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		/* Set up the widget options. */
		$widget_options = array( 
			'classname' => 'newsletter', 
			'description' => esc_html__( 'Displays a subscription form for your Google/Feedburner account.', 'falcons' ) 
		);
		/* Set up the widget control options. */
		$control_options = array( 
			'width' => 200, 
			'height' => 350, 
			'id_base' => 'newsletter-falcons'
		);
		/* Create the widget. */
		// $this->WP_Widget( 'newsletter', esc_html__( 'Newsletter', 'falcons'), $widget_options, $control_options );
		parent::__construct('newsletter-falcons', esc_html__('falcons Newsletter','falcons' ), $widget_options, $control_options);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 0.1.0
	 */
	function widget( $sidebar, $instance ) {
		extract( $sidebar );
		
		
		$before_widget= (isset($args['before_widget'])? $args['before_widget']:'' );
		echo apply_filters( 'Newsletter_before',  $before_widget );

		if ( isset($instance['title']) )

            echo apply_filters('Newsletter_before_title',$args['before_title']). esc_attr($title) . apply_filters('Newsletter_after_title',$args['after_title']);  

		?>
	
<?php $falcons_option_data =get_option('falcons_option_data'); 
		$falcons_multi_footer_image = (isset($falcons_option_data['sb-multi-footer-image'])?$falcons_option_data['sb-multi-footer-image']:'' );
 ?>

<?php if(($falcons_multi_footer_image==5)||($falcons_multi_footer_image==6)){?>
<?php } else {?>
<div class="col-md-3 col-sm-6">
<?php } ?>

          <h5><?php esc_html_e('Newsletter','falcons'); ?></h5>
<?php if(($falcons_multi_footer_image==5)||($falcons_multi_footer_image==6)){?>
<?php } else{?>
<p><?php esc_html_e(' Subscribe to our newsletter to receive our latest news and updates. We do not spam.','falcons'); ?></p>
<?php } ?>
		<form class="newsletter-form" action="http://feedburner.google.com/fb/a/mailverify" method="post">
		<p>
			<input type="email" placeholder="<?php esc_html_e( 'Enter your email address', 'falcons' ); ?>" value="<?php echo esc_attr( $instance['input_text'] ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
			<input type="submit" class="btn btn-primary" value="<?php echo esc_attr( $instance['submit_text'] ); ?>" />
			<input type="hidden" value="<?php echo esc_attr( $instance['feedburner_id'] ); ?>" name="uri" />
			<input type="hidden" name="loc" value="en_US" />
		</p>
		</form>

<?php if(($falcons_multi_footer_image==5)||($falcons_multi_footer_image==6)){?>
<?php } else {?>
</div>
<?php } ?>

<?php
		$after_widget= (isset($args['after_widget'])?$args['after_widget']:'');
        echo apply_filters( 'Newsletter_after',  $after_widget );
	}
	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 0.1.0
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance = $new_instance;
		$instance['news_title'] = isset( $instance['news_title'] ) ? esc_attr( $instance['news_title'] ) : '';
		$instance['feedburner_id'] =isset( $instance['feedburner_id'] ) ? esc_attr( $instance['feedburner_id'] ) : ''; 
		$instance['input_text'] = isset( $instance['input_text'] ) ? esc_attr( $instance['input_text'] ) : '';
		$instance['submit_text'] = isset( $instance['submit_text'] ) ? esc_attr( $instance['submit_text'] ) : ''; 
		return $instance;
	}
	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 0.1.0
	 */
	function form( $instance ) {
		//Defaults
		$defaults = array(
			'news_title' => esc_html__( 'Newsletter', 'falcons'),
			'input_text' => esc_html__( 'info@example.com', 'falcons'),
			'submit_text' => esc_html__( 'Subscribe', 'falcons'),
			'feedburner_id' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div class="hybrid-widget-controls columns-1">
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'news_title' )); ?>"><?php esc_html_e( 'Title:', 'falcons' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'news_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'news_title' )); ?>" value="<?php echo esc_attr( $instance['news_title'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'feedburner_id' )); ?>"><?php esc_html_e( 'Google/Feedburner ID:', 'falcons' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'feedburner_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'feedburner_id' )); ?>" value="<?php echo esc_attr( $instance['feedburner_id'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'input_text' )); ?>"><?php esc_html_e( 'Input Text:', 'falcons' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'input_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'input_text' )); ?>" value="<?php echo esc_attr( $instance['input_text'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'submit_text' )); ?>"><?php esc_html_e( 'Submit Text:', 'falcons' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'submit_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'submit_text' )); ?>" value="<?php echo esc_attr( $instance['submit_text'] ); ?>" />
		</p>
	
		</div>
		<div >&nbsp;</div>
	<?php
	}
}



add_action('widgets_init', 'falcons_Widget_Newsletter');

function falcons_Widget_Newsletter(){

    register_widget('falcons_Widget_Newsletter');

}
