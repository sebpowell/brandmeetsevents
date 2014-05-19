<?php 
/* Template Name: Banner */
$template = 'home';
?>
<?php include_once('includes/head.php'); ?>

<body>
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
                
                <div class="banner"> <!-- BANNER -->
                    <div class="flexslider">
                      <ul class="slides">
                          <?php $post = $wp_query->post; 
                            display_banners($post->ID);
                          ?>
                      </ul>
                    </div>
                </div>  <!-- END BANNER -->
                
                <div class="latest-news">
                    <div class="title">
                        <h2>Latest News</h2>
                    </div>
                    <?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        query_posts("cat=&paged=$paged&posts_per_page=2");  
                        if(have_posts()) : while( have_posts() ) : the_post(); 
                    ?>                     
                    <div class="article">
                        <p class="date"><?php echo get_the_date(); ?></p>                        
                        <div class="header">
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        </div>
                        <p>
                            <?php echo wpe_excerpt('wpe_excerptlength_index', 'wpe_excerptmore'); ?>
                        </p>
                        <p class="r-more"><a href="<?php the_permalink(); ?>"><b>Read More...</b></a></p>                        
                    </div> 
                    <?php 
                        endwhile; 
                        endif; 
                        wp_reset_query();
                    ?>                      
                </div>                
                
            <div class="clearfix"></div> 
            
            <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>
                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    the_title( '<h1>', '</h1>' );
                    the_content();
                    endwhile; endif;
                    wp_reset_query();
                ?>              
            </article>
            
            <?php include_once('includes/aside.php'); ?>
            
            <div class="clearfix"></div>
            
            <?php
                if(get_post_meta( $post->ID, '_galleryactive', true )) {
                    include_once('includes/gallery.php');
                }
            ?>
            
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>