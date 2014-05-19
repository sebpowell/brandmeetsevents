<?php
add_action( 'add_meta_boxes', 'page_gal_func' );  

function page_gal_func()  {
    add_meta_box( 'gall-meta', 'Gallery', 'inner_gal_func', 'page', 'normal', 'high' );     
}

function inner_gal_func( $post )  {  
    global $post;
    wp_nonce_field( 'my_meta_box_nonce', 'page_gal_func_nonce' );
    $checked = get_post_meta( $post->ID, '_galleryactive', true);
    echo '<label for="_galleryactive">Activate Sliding Gallery?</label>&nbsp;';
    echo '<input id="_galleryactive" type="checkbox" name="_galleryactive"';
    if($checked=='on') { echo 'checked'; } 
    echo '/>';
}  

add_action( 'save_post', 'inner_gal_save' );

function inner_gal_save( $post )  {  
    global $post;
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
    if($_POST['_galleryactive']) {
        update_post_meta($post->ID, '_galleryactive', $_POST['_galleryactive'], $checked);
    }  else {
        update_post_meta($post->ID, '_galleryactive', '', $checked);        
    }    
}
?>