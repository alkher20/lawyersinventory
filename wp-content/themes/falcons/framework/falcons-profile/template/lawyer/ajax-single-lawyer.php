<?php
global $post,$wpdb;

$directory_url_1=get_option('_iv_directory_url_1');					
if($directory_url_1==""){$directory_url_1='law-firms';}	

$directory_url_2=get_option('_iv_directory_url_2');					
if($directory_url_2==""){$directory_url_2='lawyers';}	


		$id=$_GET['id'];
		$post_id_1 = get_post($id);
		$post_id_1->post_title;
		$currentCategory=wp_get_object_terms( $id, $directory_url_2.'-category');
		$cat_link='';$cat_name='';$cat_slug='';
		if(isset($currentCategory[0]->slug)){										
			$cat_slug = $currentCategory[0]->slug;
			$cat_name = $currentCategory[0]->name;						
			$cat_link= get_term_link($currentCategory[0], $directory_url_2.'-category');						
		}
		
?>

<div class="cbp-l-inline">
    <div class="cbp-l-inline-left">       
	   <?php
	   if(has_post_thumbnail($id)){		
			echo get_the_post_thumbnail($id, 'large');		
		}else{
			?>							
			<img   src="<?php echo  wp_iv_directories_URLPATH."/assets/images/default-lawyer.png";?>">			 
		<?php
		}	
	   ?>
    </div>

    <div class="cbp-l-inline-right">
        <div class="cbp-l-inline-title"><?php echo $post_id_1->post_title; ?></div>
        <div class="cbp-l-inline-subtitle"><?php echo $cat_name; ?></div>      
        <?php
				$total_count=0;
				$total_count=get_post_meta($id,'_rating_total_count',true);
				$i=1;$default_fields='';$total_rating_value=0;$avg_rating=0;
				$field_set=get_option('iv_cpt-2_fields_review' );
				if($field_set!=""){
						$default_fields=get_option('iv_cpt-2_fields_review' );
				}else{
						$default_fields['Communication']=esc_html__('Communication','falcons'); 
						$default_fields['Judgment']=esc_html__('Judgment','falcons');'';
						$default_fields['Analytical']=esc_html__('Analytical','falcons');'';
						$default_fields['Research-Skills']=esc_html__('Research Skills','falcons');
						$default_fields['People-Skills']=esc_html__('People Skills','falcons');
						$default_fields['Perseverance']=esc_html__('Perseverance','falcons');
						$default_fields['Creativity']=esc_html__('Creativity','falcons');		
				}
				
				if(sizeof($default_fields)>0){
					foreach ( $default_fields as $field_key => $field_value ) {
						$field_value_trim=trim($field_value);
						$total_rating_value=$total_rating_value +get_post_meta($id,$field_key.'_rating',true);
					}
				}

				if($total_rating_value>0 AND $total_count>0){
					$avg_rating=$total_rating_value/$total_count;
				}
				
				?>
				  <div class="stars" style ="z-index: 99;position: relative;">
				  <i class="fa fa-star<?php echo($avg_rating>=1? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=1.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=2.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=3.5? "":"-o"); ?>"></i>
				  <i class="fa fa-star<?php echo($avg_rating>=4.5? "":"-o"); ?>"></i>
				  <span>(<?php echo ($total_count==""?0:$total_count); ?>)</span>
				  </div>

        <div class="cbp-l-inline-desc">
			<?php  
			echo $post_id_1->post_content;
			?>
				
		</div>

        <a href="<?php echo get_permalink($id);  ?>"  class="cbp-l-inline-view"><?php esc_html_e('MORE DETAIL','falcons'); ?></a>
    </div>
</div>
