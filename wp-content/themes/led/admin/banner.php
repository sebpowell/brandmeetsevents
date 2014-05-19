<?php

// GET REQUESTS
if($_GET['update_order']) {
    global $wpdb;
    foreach ($_GET['listItem'] as $position => $item) {
        $sql[] = "UPDATE ".$wpdb->prefix."banner SET ordering = $position WHERE id = $item";
    }    
    foreach($sql as $query) {
        $wpdb->query($query);                 
    }
    die();
}

if($_GET['get_new_page']) {
    global $wpdb;
    if(is_numeric($_GET['page_id'])) {
        echo '
        <h3>Add New</h3>
        <table>
            <tr valign="top">
                <td>
                    <label for="upload_image">Upload image<br />
                        <input id="upload_image" type="text" size="36" name="upload_image" value="" />
                        <input id="upload_image_button" type="button" value="Upload Image" />
                        <input type="hidden" id="page_id" name="page_id" value="'.$_GET['page_id'].'" />
                    </label>
                </td>
            </tr>
            <tr>
            <tr>
                <td><button id="save_banner" name="save_banner">Add</button></td>
            </tr>
        </table>
        ';
        $query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."banner WHERE post_id=".$_GET['page_id']." ORDER BY ordering");
        echo '<br /><hr /><br />';
        echo '
        <h3>Current Banners for <i>'.get_the_title($_GET['page_id']).'</i> (drag to reorder)</h3> ';
        echo '<table>';
        echo '<tr>';
        echo '<th width="250px">Image</th><th class="banner_only_text" width="250px">Big Text</th><th class="banner_only_text" width="250px">Small Text</th><th class="banner_only_text" width="250px">Link</th>';
        echo '</tr>';
        echo '</table>';
        echo '<ul id="sortable">'; 
        echo '<li id="listItem_1"></li>';
        foreach($query as $item) {
            echo '
                <li id="listItem_'.$item->id.'">
                    <table class="bdy">
                    <form method="post" action="">
                    <tr>
                        <td valign="top">
                            <img width="250px" height="auto" src="'.$item->image.'" alt="" />
                        </td>
                        <td class="banner_only_text" width="250px" valign="top">
                            <textarea class="banner_bigtext">'.$item->bigtext.'</textarea>
                        </td>
                        <td class="banner_only_text"  width="250px" valign="top">
                            <textarea class="banner_smalltext">'.$item->smalltext.'</textarea>
                        </td>
                        <td class="banner_only_text"  width="250px" valign="top">
                            <input type="text" class="banner_link" value="'.$item->link.'" />
                        </td>                        
                        <td  width="100px">
                            <button name="delete_banner" class="delete_banner" value="'.$item->id.'">Delete</button>
                            &nbsp;
                            <button name="update_banner_text" class="update_banner_text banner_only_text" value="'.$item->id.'">Update Text</button>
                        </td>
                    </tr>
                    </form>    
                    </table>
                </li>';
        }
        echo '</ul>';
    }
    die();
}

if($_GET['add_new_banner']) {
    global $wpdb;
    $highest_value = $wpdb->get_results("SELECT ordering, id FROM ".$wpdb->prefix."banner ORDER BY ordering DESC LIMIT 1");

    $highest_value = array_shift($highest_value); 
     foreach($highest_value as $value) {
         $highest_value = $value['ordering'];
         $id = $value['id'];
     }
     $ordering=$highest_value + 1;
        
    $wpdb->insert( $wpdb->prefix."banner",
            array(
                'image' => $_GET['image_path'],
                'post_id' => $_GET['page_id'],
                'ordering' => $ordering,
            ),
            array( 
                    '%s', 
                    '%d' 
            )             
     ); 
    die();
}

if($_GET['update_banner_text']) {
    global $wpdb;
    $wpdb->update( 
        $wpdb->prefix."banner",
            array( 
                'bigtext' => $_GET['bigtext'],	
                'smalltext' => $_GET['smalltext'],
                'link' => $_GET['link']
            ), 
            array( 'ID' => $_GET['banner_id'] ), 
            array( 
                    '%s',	// value1
                    '%s',	// value2
                    '%s'
            ), 
            array( '%d' ) 
    );
    die();
}

if($_GET['delete_banner']) {
    global $wpdb;
    $wpdb->query(
        $wpdb->prepare( 
            "
                DELETE FROM ".$wpdb->prefix."banner
                WHERE id = ".$_GET['delete_banner']."
            "
            )
        );
    die();
}


// ADMIN FUNCTIONS
add_action( 'admin_menu', 'banner' );

function banner_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "banner";

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id mediumint(9) NOT NULL,
        image varchar(120) NOT NULL,
        bigtext varchar(250) NOT NULL,
        smalltext varchar(250) NOT NULL,
        link varchar(250) NOT NULL,        
        ordering mediumint(9) NOT NULL,
        PRIMARY KEY  (id),
        UNIQUE  (id)
     );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    $wpdb->show_errors();
    $wpdb->query($sql);
}

function banner() {
    add_menu_page( 'Banners', 'Banners', 'manage_options', 'banner', 'banner_options' );
}

function banner_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    
    // Functionality
    global $wpdb;
    $table_name = $wpdb->prefix . "banner";
    
    if($_POST['first_add_banner']) {
        banner_create_table();
    }
    
    // Check if table exists
    $table = $wpdb->get_results("SHOW TABLES LIKE '".$table_name."'" , ARRAY_N);
    if(empty($table)) {    
        echo '<p>No banners added yet. Click <form method="post" action=""><input type="submit" name="first_add_banner" value="HERE" /></form> to add your first one';
    } else {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => 'index.php'
        ));
        echo '<p>Banner Rotator Enabled Pages</p>';
        echo '<select name="page" class="page">';
        echo "<option>Select...</option>";
        foreach($pages as $page){
            echo "<option value='".$page->ID."'>".$page->post_title."</option>";
        } 
        echo '</select>';
        $pages = array(
            'post_type' => 'portfolio'
        );
        $query = new WP_Query($pages);
        echo '<p>Portfolio Galleries</p>';
        echo '<select name="page" class="page hide-text">';
        echo "<option>Select...</option>";
        if( $query->have_posts() ) {
            global $post;
            while ($query->have_posts()) : $query->the_post(); 
            echo "<option value='".$post->ID."'>".$post->post_title."</option>";
            endwhile;
        } 
        wp_reset_query();
        echo '</select>';
        echo '<div class="banner_area"></div>';        
    ?>
    <?php
    }
}

function display_banners($post_id) {
    global $wpdb;
    $query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."banner WHERE post_id=$post_id ORDER BY ordering");  
    foreach($query as $item) {
        ?>

                        <li>
                          <img src="<?php echo $item->image ?>" />
                          <p class="flex-caption">
                              <span class="title">
                                  <?php echo $item->bigtext; ?>
                                  <span class="text">
                                      <?php echo $item->smalltext; ?>
                                  </span>
                                  <?php if($item->link) {
                                      echo '<span class="link">';
                                      echo '<a href="'.$item->link.'">Read More...</a>';
                                      echo '</span>';
                                  } ?>
                              </span>
                          </p>
                        </li>           

        <?php
    }
}

function display_portfolio($post_id) {
    global $wpdb;
    $query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."banner WHERE post_id=$post_id ORDER BY ordering");  
    foreach($query as $item) {
        ?>
        <li>
            <img src="<?php echo $item->image; ?>" />
        </li>           
        <?php
    }
}

function display_first_portfolio_image($post_id) {
   global $wpdb;
   $query = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."banner WHERE post_id=$post_id ORDER BY ordering LIMIT 1");  
    foreach($query as $item) {
        ?>
        <img src="<?php echo $item->image; ?>" />
        <?php
    }   
}
?>
