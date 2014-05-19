<?php
add_theme_support('menus');
add_theme_support('post-thumbnails');

// Get JS
function custom_theme_js(){
        wp_deregister_script( 'jquery' );
        
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', false, '1.8.3', true);
        wp_register_script( 'flexslider',  get_template_directory_uri() . '/js/vendor/jquery.flexslider-min.js', array('jquery'),null,true );
        wp_register_script( 'carousel',  get_template_directory_uri() . '/js/vendor/jquery.jcarousel-min.js', array('jquery'),null,true );
        wp_register_script( 'infield',  get_template_directory_uri() . '/js/vendor/jquery.infield-min.js', array('jquery'),null,true );  
        wp_register_script( 'hoverintent',  get_template_directory_uri() . '/js/vendor/jquery.hoverIntent-min.js', array('jquery'),null,true );                
        wp_register_script( 'plugins',  get_template_directory_uri() . '/js/plugins.js', array('jquery'),null,true ); 
        wp_register_script( 'init',  get_template_directory_uri() . '/js/main.js', array('jquery'),null,true );     

        wp_enqueue_script( 'jquery' );            
        wp_enqueue_script('flexslider');
        wp_enqueue_script('carousel');
        wp_enqueue_script('infield');   
        wp_enqueue_script('hoverintent');           
        wp_enqueue_script('plugins');
        wp_enqueue_script('init');
    }
    
add_action('wp_enqueue_scripts', 'custom_theme_js');  

// Scripts for Admin (ie.. thickbox)
function admin_scripts() {
    //wp_register_script( 'admin', get_template_directory_uri(). '/js/admin.js', array('jquery').null,true);
    //wp_register_script( 'jqueryui', 'http://code.jquery.com/ui/1.9.2/jquery-ui.js', array('jquery'),null,true);
    
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    //wp_enqueue_script('jquery');
    //wp_enqueue_script('jqueryui');
    wp_enqueue_script('admin');
}

function admin_styles() {
    wp_register_style('admin', get_template_directory_uri(). '/css/admin.css');
    
    wp_enqueue_style('thickbox');
    wp_enqueue_style('admin');
}

//add_action('admin_print_scripts', 'admin_scripts');
add_action('admin_print_styles', 'admin_styles');


// Includes
//include_once('admin/banner.php');
include_once('admin/gallery.php');
include_once('admin/portfolio.php');
include_once('admin/wysiwyg.php');

// Multiple Excerpts
function wpe_excerptlength_index( $length ) {
    return 14;
}
function wpe_excerptlength_port( $length ) {
    return 20;
}
function wpe_excerptmore( $more ) {
    return '...';
}


function wpe_excerpt( $length_callback = '', $more_callback = '' ) {
    if ( function_exists( $length_callback ) )
    add_filter( 'excerpt_length', $length_callback );
    if ( function_exists( $more_callback ) )
    add_filter( 'excerpt_more', $more_callback );
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>'; // maybe wpautop( $foo, $br )
    return $output;
}

function paginate() {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
 
    $pagination = array(
        'base' => @add_query_arg('page','%#%'),
	'format' => '',
	'total' => $wp_query->max_num_pages,
	'current' => $current,
	'show_all' => true,
	'type' => 'list',
	'next_text' => '&raquo;',
	'prev_text' => '&laquo;'
	);
 
	if( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
 
	if( !empty($wp_query->query_vars['s']) )
            $pagination['add_args'] = array( 's' => get_query_var( 's' ) );
            echo paginate_links( $pagination );
}

function get_breadcrumb() {
    if (!is_home()) {
        echo '<a href="';
        echo get_option('home');
        echo '">';
        echo 'Home';
        echo "</a> <span class='blue'>»</span> ";
        if (is_category() || is_single() || is_archive()) {
            the_category(' » ');
            if (is_single()) {
                echo " <span class='blue'>»</span> ";
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        }
    }
}

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div> ',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
));  

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Home Sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div> ',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
));  

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Page Sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div> ',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
));  

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Blog Sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div> ',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
));  

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Contact Sidebar',
            'before_widget' => '<div class="widget">',
            'after_widget' => '</div> ',
            'before_title' => '<h2>',
            'after_title' => '</h2>',
));


/* Added 6/11/2013 */

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Footer Tel',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Copyright',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span style="display:none;">',
        'after_title' => '</span>',
    ));

function display_banners($id) {

    if(get_post_type( $id )=='page' ) {
        if(get_field('banner_slider', $id)) {


            while(has_sub_field('banner_slider', $id)) {
                echo '<li>';

                // image
                $image = get_sub_field('banner_image');
                echo '<img src="'.$image['sizes']['banner-slide'].'" alt="" />';

                // large text
                $large_text = get_sub_field('large_text');
                if($large_text) {
                ?>
                <p class="flex-caption">
                    <span class="title">
                        <?php echo $large_text; ?>
                        <?php

                        // small text
                        $small_text = get_sub_field('small_text');
                        if($small_text) {
                            ?>
                            <span class="text">
                                <?php echo $small_text; ?>
                            </span>
                            <?php
                        }

                        // link
                        $link = get_sub_field('link');
                        if($link) {
                            echo '<span class="link">';
                            echo '<a href="'.$link.'">Read More...</a>';
                            echo '</span>';
                        }
                        ?>
                    </span>
                </p>
                <?php
                }

                echo '</li>';
            }
        }


    ?>

    <?php } else {
        if(get_field('portfolio_gallery', $id)) {
            while(has_sub_field('portfolio_gallery', $id)) {
                $portfolio_image = get_sub_field('portfolio_image');
            ?>
            <li>
                <img src="<?php echo $portfolio_image['sizes']['large']; ?>" />
            </li>
        <?php
            }
        }
    }

}

function display_first_portfolio_image($id, $type) {
$repeater =  get_field('portfolio_gallery', $id);

    if($repeater) {
	/*foreach( $repeater as $key => $row ) {
	    $column_id[ $key ] = $row['id'];
	}
	array_multisort( $column_id, SORT_ASC, $repeater ); */
	foreach($repeater as $row) {
		$portfolio_image = $row['portfolio_image'];
            if($type=='thumb') {
        ?>

            <img src="<?php echo $portfolio_image['sizes']['thumbnail']; ?>" />
        <?php
            } elseif($type=='medium') { ?>

            <img src="<?php echo $portfolio_image['sizes']['medium']; ?>" />
        <?php
            }
break;
	}
        /*while(has_sub_field('portfolio_gallery', $id)) {

            $portfolio_image = get_sub_field('portfolio_image');
            if($type=='thumb') {
        ?>

            <img src="<?php echo $portfolio_image['sizes']['thumbnail']; ?>" />
        <?php
            } elseif($type=='medium') { ?>

            <img src="<?php echo $portfolio_image['sizes']['medium']; ?>" />
        <?php
            }
            break;
        } */
           
      
    }
}



if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'banner-slide', 704, 334, true ); //(cropped)
}

?>
