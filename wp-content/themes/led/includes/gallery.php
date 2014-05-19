            <section class="latest-projects">
                <h1>Latest Projects</h1>
                    <ul id="carousel" class="jcarousel-skin">
                        <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                            query_posts("paged=$paged&posts_per_page=9999&post_type=portfolio");   
                            while ( have_posts() ) : the_post();
                        ?>
                      <li>
                          <a class="slider-link" href="<?php the_permalink(); ?>">
                              <?php
                                if ( has_post_thumbnail() ) { 
                                    the_post_thumbnail('thumb');
                                } else { 
                                    echo display_first_portfolio_image(get_the_ID(), 'thumb');
                                }
                                ?>
                          <p><span class="title"><?php echo get_the_title(); ?></span>
                              <?php echo get_the_excerpt(); ?></p>
                          </a>
                      </li>
                        <?php
                            endwhile;     
                            wp_reset_query();
                        ?>                           
                    </ul> 
            </section>
            
            <div class="clearfix"></div>