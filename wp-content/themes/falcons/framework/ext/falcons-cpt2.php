<?php



class cpt2_listing extends WP_Widget {

    function __construct() {
		$directory_url_1=get_option('_iv_directory_url_1');
		if($directory_url_1==""){$directory_url_1='law-firms';}

		$directory_url_2=get_option('_iv_directory_url_2');
		if($directory_url_2==""){$directory_url_2='lawyers';}
		
        $widget_ops = array('classname' => 'falcons_widget_recent_entries', 'description' => ucwords($directory_url_2).esc_html__( "cpt2 Listing",'falcons' ) );
        parent::__construct('cpt2_latest', ucwords($directory_url_2).esc_html__(' Listing','falcons' ), $widget_ops);
        $this->alt_option_name = 'xxl_widget_recent_entries';

      
    }

    public function widget($args, $instance) {

         $cache = wp_cache_get('cpt2_listing_widget', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($cache[ $args['widget_id']]);
            return;
        }

        ob_start();
        extract($args);

        echo apply_filters( 'Social_before',  $args['before_widget'] );
       
		include(  get_template_directory(). '/framework/ext/widget-latest-cpt2.php' ); 
		
		echo apply_filters( 'Social_before',  $args['after_widget'] );  

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('cpt1_listing_widget', $cache, 'widget');

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['words'] = strip_tags($new_instance['words']);       
        $instance['number'] = (int) $new_instance['number'];
        $instance['display_option'] ='list'; //strip_tags($new_instance['display_option']);
	  	$instance['type'] = strip_tags($new_instance['type']);
	  	$instance['post_ids'] = strip_tags($new_instance['post_ids']);
       echo  $new_instance['display_option'];
        
        $this->flush_widget_cache_falcons();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache_falcons() {

        wp_cache_delete('cpt2_listing_widget', 'widget');

    }

    public function form( $instance ) {

        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : 'Recently joined';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;
        $words    = isset( $instance['words'] ) ? absint( $instance['words'] ) : 15;
        

    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:','falcons'  ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of posts to show:','falcons'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('words')); ?>"><?php esc_html_e( 'Words of words to be displayed:','falcons'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('words')); ?>" name="<?php echo esc_attr($this->get_field_name('words')); ?>" type="text" value="<?php echo esc_attr($words); ?>" size="3" />
        </p>        
		
		
		<p><label for="<?php echo esc_attr($this->get_field_id('post_ids')); ?>"><?php esc_html_e('Only Display Ids ', 'falcons'); ?>:</label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('post_ids')); ?>" name="<?php echo esc_attr($this->get_field_name('post_ids')); ?>" type="text" value="<?php echo esc_attr(strip_tags((isset($instance['post_ids'])? $instance['post_ids']:''))); ?>" placeholder="<?php esc_html_e('Enter IDs by , [# of post will not work]', 'falcons'); ?>"/>	
		</p>
    <?php
    }
}

add_action('widgets_init', 'cpt2_listing');

function cpt2_listing(){

    register_widget('cpt2_listing');

}
