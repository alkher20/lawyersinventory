<?php 
	function falcons_wpml_languages(){


		$falcons_option_data =get_option('falcons_option_data'); 

		$languages = icl_get_languages('skip_missing=0');
		$wpml_select = $falcons_option_data['falcons-wpml-select'];
	
		echo '<div class="language">';

			if($wpml_select === 'name'){


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a  class="toggle" href="'.$language['url'].'">';
							echo esc_attr($language['translated_name']);
						echo '</a>';				
					}
				}
					echo '<ul>';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li> <a href="'.$language['url'].'">'.$language['translated_name'].'</a></li>';
								
							}
						}
					echo '</ul>';

			} elseif($wpml_select === 'code'){


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a  class="toggle" href="'.$language['url'].'">';
							echo esc_attr($language['language_code']);
						echo '</a>';				
					}
				}

					echo '<ul>';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li><a href="'.$language['url'].'">'.$language['language_code'].'</a></li>';
								
							}
						}
					echo '</ul>';



			} else {


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a  class="toggle href="'.$language['url'].'">';
							echo '<img src="'.$language['country_flag_url'].'">';
							
						echo '</a>';				
					}
				}

				
					echo '<ul>';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li> <a href="'.$language['url'].'"><img src="'.$language['country_flag_url'].'"></a></li>';
								
							}
						}
					echo '</ul>';
				
			}





		echo ' </div>'; 
		
		

	}	

 ?>
