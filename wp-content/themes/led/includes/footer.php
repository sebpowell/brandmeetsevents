        <footer>
            <div class="wrapper">
                <div class="footer-inner">
                    
                    <div class="tel">
                        <?php dynamic_sidebar( 'Footer Tel' ); ?>
                    </div>
                    
                    <nav class="footer-nav">
                        <ul>
                        <?php wp_nav_menu( array( 'menu_class' => '',
                            'container' => '',
                            'menu' => 'Footer',
                            'theme_location' => 'primary',
                            'link_before' => ' ',
                            'link_after' => ' ',
                            'title_li' =>  __(' '),
                            'menu_id'    => '',
                            'items_wrap'      => '%3$s',            
                            ) );
                        ?>
                        </ul>
                    </nav>
                    
                    <div class="copyright">
                        <?php dynamic_sidebar( 'Copyright' ); ?>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>

            </div> 
            
            <div class="credit">
                <div class="wrapper">
                <p><a href="http://www.nvisage.co.uk" target="_blank">Website design &amp; development</a> by Nvisage</p>
            </div>    
            
        </footer>

        <?php wp_footer(); ?>



    </body>
</html>
