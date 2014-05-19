<?php $template = 'page'; ?>
<?php include_once('includes/head.php'); ?>

<body>
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
            <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>
                <h1><?php echo single_cat_title(); ?></h1>
                
                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    ?>
                    <div class="iteration">
                        <div class="image">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if ( has_post_thumbnail() ) { 
                                    the_post_thumbnail();
                                } 
                                else {
                                    echo '<img src="'. get_template_directory_uri() .'/img/latest-news.jpg" alt="" class="alignleft" />';
                                }    
                                ?>
                            </a>
                        </div>
                        <div class="excerpt">   
                            <a href="<?php the_permalink(); ?>"><?php the_title( '<h2>', '</h2>' ); ?></a>
                            <p class="date"><b>Posted On: </b><?php echo get_the_date(); ?></p>
                            <?php the_excerpt(); ?>
                            <p><a href="<?php the_permalink(); ?>">Read More...</a></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>                        
                    <?php
                    endwhile; endif;
                ?>                            
                
                <div class="pagination">
                    <?php paginate(); ?>
                </div>
                
            </article>
            
            <?php include_once('includes/aside.php'); ?>

            
            <div class="clearfix"></div>
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>