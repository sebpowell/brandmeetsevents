<?php 
/* Template Name: Page No Sidebar */
$template = 'page-n-side'; 
?>
<?php include_once('includes/head.php'); ?>

<body class="page-n-side">
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
            <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>
                <?php 
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); 
                    the_title( '<h1>', '</h1>' );
                    the_content();
                    endwhile; endif;
                ?>          
                <div class="clearfix"></div>
            </article>
            
            
            <div class="clearfix"></div>
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>