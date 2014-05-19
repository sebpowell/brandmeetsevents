<?php $template = 'page'; ?>
<?php include_once('includes/head.php'); ?>

<body>
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
                      <?php include_once('includes/breadcrumbs.php'); ?>

            <hr />
            
            <article>
                 <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    echo '<h1>';
                    the_title();
                    echo '<span class="date"><b>Posted On: </b>';
                    echo get_the_date(); 
                    echo '</span></h1>';
                    echo '<div class="post">';
                    if ( has_post_thumbnail() ) { 
                        the_post_thumbnail();
                    } 
                    else {
                        echo '<img src="'. get_template_directory_uri() .'/img/latest-news.jpg" alt="" class="alignleft" />';
                    }                        
                    the_content();
                    echo '</div>';
                    endwhile; endif;
                ?>                         
                
            </article>
            
            <?php include_once('includes/aside.php'); ?>

            
            <div class="clearfix"></div>
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>