            <aside>
                <?php 
                wp_reset_query();
                dynamic_sidebar( 'Sidebar' );  
                if(is_front_page()) {
                    dynamic_sidebar( 'Home Sidebar' );                      
                }
                if(is_page() && !is_front_page() && !is_page('19')) {
                    dynamic_sidebar( 'Page Sidebar' );
                }
                if(is_category() || is_archive() || is_single()) {
                    dynamic_sidebar( 'Blog Sidebar' );
                }
                if(is_page('19')) {
                    dynamic_sidebar( 'Contact Sidebar' );                    
                }
                ?>          
            </aside>