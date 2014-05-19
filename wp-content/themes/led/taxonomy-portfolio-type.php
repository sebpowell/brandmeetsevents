<?php $template = 'page-n-side'; ?>
<?php include_once('includes/head.php'); ?>

<body class="page-n-side">
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
                <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>
                <h1><?php echo single_cat_title(); ?></h1>
                <?php echo category_description(); ?>
                
                <div class="case-studies">
                    
                    <div class="controls">
                        <ul id="nav" class="use-trans">
                            <li><a href="#">All</a></li>
                            <li><a href="#">By Title</a>
                                <div class="submenu">
                                    <ul>
                                        <?php
                                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                            query_posts("cat=&paged=$paged&posts_per_page=9999&post_type=portfolio");  
                                            if (have_posts()) : while( have_posts() ) : the_post();       
                                            echo '<li><a href="';
                                            the_permalink();
                                            echo '">';
                                            the_title();
                                            echo '</a></li>';
                                            endwhile; endif;
                                            wp_reset_query();   
                                        ?>
                                    </ul>
		</div>
                            </li>
                            <li><a href="#">By Type<span></span></a>
                                <div class="submenu">
                                    <ul id="filter">
                                        <?php 
                                            $taxonomy = 'portfolio-type';
                                            $tax_terms = get_terms($taxonomy);
                                            foreach ($tax_terms as $tax_term) {
                                                if($tax_term->slug != 'portfolio') {
                                                    echo '<li>' . '<a href="#">' . $tax_term->name.'</a></li>';
                                                }
                                            }
                                        ?>
                                    </ul>
		</div>
                            </li>
                        </ul>
                        
                    <div class="clearfix"></div>
                    </div>
                    
                    <div>
                        
                <?php           
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    global $post;
                    ?>                        
                        <a href="<?php the_permalink(); ?>">
                            <div class="item<?php
                                $array = wp_get_post_terms($post->ID, 'portfolio-type', array('fields' => 'slugs')); 

                                foreach($array as $item) {
                                    if($item!='portfolio') {
                                        echo " ";
                                        echo $item;
                                    }
                                }                 
                                ?>">    
                                <div class="image">
                                      <?php
                                        if ( has_post_thumbnail() ) { 
                                            the_post_thumbnail('full');
                                        } else { 
                                            echo display_first_portfolio_image(get_the_ID(), 'medium');
                                        }
                                        ?>
                                </div>
                                <div class="excerpt">
                                    <h3><?php the_title(); ?></h3>
                                    <p>
                                        <?php echo str_replace('Objective', '', wpe_excerpt('wpe_excerptlength_port', 'wpe_excerptmore')); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php
                    endwhile; endif;
                    ?>       

                        <div class="clearfix"></div>
                    </div>
                    
                </div>
         
                <div class="pagination">
                    <?php paginate(); ?>
                </div>                
                
                <div class="clearfix"></div>
            </article>
            
            
            <div class="clearfix"></div>
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>