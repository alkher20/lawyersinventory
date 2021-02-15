<?php get_header(); ?>


  <div class="blog-content pt60">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

            <h4 class="archive-title"><?php
                if ( is_day() ) :
                    printf( esc_html__( 'Daily Archives: %s', 'falcons' ), '<span>' . get_the_date() . '</span>' );
                elseif ( is_month() ) :
                    printf( esc_html__( 'Monthly Archives: %s', 'falcons' ), '<span>' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'falcons' ) ) . '</span>' );
                elseif ( is_year() ) :
                    printf( esc_html__( 'Yearly Archives: %s', 'falcons' ), '<span>' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'falcons' ) ) . '</span>' );
                else :
                    esc_html_e( 'Archives', 'falcons' );
                endif;
                ?>
            </h4>

                  <?php if (have_posts()) :while ( have_posts() ) : the_post(); ?>
                    <article <?php post_class( 'uou-block-7f blog-post-content'); ?> id="post-<?php the_ID(); ?>" >
                      <?php 
                      if ( has_post_thumbnail() ) {
                        $image_id =  get_post_thumbnail_id( get_the_ID() );
                        $large_image = wp_get_attachment_url( $image_id ,'full');  
                        $resize = falcons_aq_resize( $large_image, true );
                       ?>
                      <img src="<?php echo esc_url($resize); ?>" alt="<?php esc_html_e( 'image', 'falcons' ); ?>">
                      <?php } ?>


                      <div class="meta">
                         <span class="time-ago"> <?php echo esc_attr(human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'); ?></span>
                        <?php if(has_category()): ?>
                          <span class="category">
                            <?php the_category('&nbsp;,&nbsp;'); ?>
                          </span>
                        <?php endif; ?>
                        <span class="comments">
                          <?php 
                            if(comments_open() && !post_password_required()){
                              comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
                            }
                          ?>            
                        </span>
                      </div>

                     <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a></h1>
                      <?php the_content();  ?> 

                      <?php endwhile; else : ?>
                        <?php esc_html_e('No post have found!', 'falcons'); ?> 
                      <?php endif; ?>
            </article>


            <!--  start pagination * -->
              <?php if (function_exists("wp_pagination")) {
                wp_pagination();
            } ?>
            <!--  End of pagination * -->

            </div> <!-- end .blog-list -->


<!-- ************************** Start Sidebar **************************** -->



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

<!-- ************************** End Sidebar **************************** -->

      </div> 
    </div>
  </div> <!-- end .page-content -->



<?php get_footer(); ?>