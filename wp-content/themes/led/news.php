<?php 
/* Template Name: News */
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

            <article>
                <h1>Latest News</h1>
                  <ul class="news-feed">
                    <?php $the_query = new WP_Query( 'showposts=5' ); ?>
                    <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                    <li>
                        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(__('(more…)')); ?></p>
                    </li>
                    <?php endwhile;?>
                </ul>   
            </article>
            
            
            
            <div class="clearfix"></div>
            
            <?php
                if(get_post_meta( $post->ID, '_galleryactive', true )) {
                    include_once('includes/gallery.php');
                }
            ?>            
            
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>