        <!--[if lt IE 8]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <header>
            <div class="wrapper">
                
                <div class="logo"> <!-- Logo -->
                    <a href="/">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" />
                    </a>
                </div> <!-- End Logo -->
                
                <nav class="top-links">
                    <ul>
                        <?php wp_nav_menu( array( 'menu_class' => '',
                            'container' => '',
                            'menu' => 'Top Menu',
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
                
            </div>
            <div class="clearfix"></div>
        </header>
        

        <nav class="main-nav">
            <div class="wrapper dropmenu">
                <ul class="">
                        <?php wp_nav_menu( array( 'menu_class' => '',
                            'container' => '',
                            'menu' => 'Main Menu',
                            'theme_location' => 'primary',
                            'link_before' => ' ',
                            'link_after' => ' ',
                            'title_li' =>  __(' '),
                            'menu_id'    => '',
                            'items_wrap'      => '%3$s',            
                            ) );
                        ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </nav>
