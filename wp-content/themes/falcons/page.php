<?php

/**
 * Template Name: Falcons Blog with sidebar
 *
 * @package WordPress
 * @subpackage Falcons
 * @since 1.0
 */

get_header(); ?>
                
  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
		  <?php
		 if(class_exists( 'WooCommerce' )){
		   if( class_exists( 'WooCommerce' ) || is_page ( array( 'cart', 'checkout' )) || is_shop() || 'product' == get_post_type() ) { ?>
			   
			  <div class="col-md-12">
			
			<?php
				// Start the loop.
				  while ( have_posts() ) : the_post();

					// Include the page content template.
					  get_template_part('templates/page/content', 'page');
				  // End the loop.
				  endwhile;
				?>
				</div>
			<?php
				}
			}else{  
		  ?>
			<div class="col-md-8">

            <?php
			
              // Start the loop.
              while ( have_posts() ) : the_post();

                // Include the page content template.
                  get_template_part('templates/page/content', 'page');
              // End the loop.
              endwhile;
              ?>


              <div class="uou-post-comment">
               <aside class="uou-block-14a">
                  <h5>
                    <?php 
                            if(comments_open() && !post_password_required()){
							  esc_html_e("Comments","falcons"); 
								
                              comments_popup_link( '(0)', '(1)', '(%)', 'article-post-meta' ); ?>
                              <div class = "conversation"><?php comments_template('', true); ?></div>

                              
                          <?php    
                            }

                            
                    ?> 
                       
                  </h5>          
                   <?php comments_template('', true); ?>
                </aside>
              </div> <!-- end of comment -->

				
				
            </div><!-- /.blog-main -->

<!-- ************************** Start Sidebar **************************** -->


	<?php
		   ?>
            <div class="col-md-3">
              <div class="uou-sidebar pt40">

            <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
                  
              <?php dynamic_sidebar( 'mainsidebar' ); ?>
                  
            <?php else : ?>
              <div class="alert alert-message">
              
                <p><?php esc_html_e("Please activate some Widgets","falcons"); ?></p>
              
                </div>

            <?php endif; ?>

             </div>
            </div>
            <?php
			}
            ?>

<!-- ************************** End Sidebar **************************** -->

        </div><!-- /.row -->
    </div> <!-- /.container -->
  </div>




<?php get_footer(); ?>
