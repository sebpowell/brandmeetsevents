<?php 
/* Template Name: New Prospect */
$template = 'page'; 
?>
<?php include_once('includes/head.php'); ?>

<body>
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
            <?php include_once('includes/breadcrumbs.php'); ?>
            
            <article>      
        
                <img class="event-logo" src="<?php the_field("show_logo") ?> "/> 
                
                <ul class="event-details">
                    <li>
                        <h3>Show Dates</h3>
                        <?php the_field("show_dates") ?>
                    </li>
                    <li>
                        <h3>Show Venue</h3>
                        <?php the_field("show_venue") ?>    
                    </li>
                </ul>
           

                <h2>About The Show</h2>
                <?php the_field("about_show") ?>
                 
                <h2>About Us</h2>
                <?php the_field("about_brand_meets_events") ?>    


               <div class="cta">
                <?php the_field("cta") ?>
                </div>
 

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