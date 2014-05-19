<?php 
/* Template Name: Page */
$template = 'page'; 
?>
<?php include_once('includes/head.php'); ?>

<body>
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
            <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>         
                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    if(!is_page('19')) {
                        the_title( '<h1>', '</h1>' );
                    }
                    the_content();
                    endwhile; endif;
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