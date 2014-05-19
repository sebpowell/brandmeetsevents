<?php $template = 'page'; ?>
<?php include_once('includes/head.php'); ?>

<body class="contact">
    
    <?php include_once('includes/header.php'); ?>
    
        <div role="main" id="main">
            <div class="wrapper">
            
            <div class="breadcrumbs">
                <p>
                    You are here <a href="">Page</a>
                </p>
            </div>
            <hr />
            
            <article>
                <div class="col">
                    <h1>Contact Us</h1>
                    <p>
                        Get in touch for more information, on the details to the right,
                        or alternatively use the form below
                    </p>
                    <form method="post" action="" class="wpcf7-form">
                        <p>
                            <label for="your-name">
                                Your name *
                            </label>
                            <input type="text" id="your-name" name="your-name" />
                        </p>
                        <p>
                            <label for="your-surname">
                                Your surname
                            </label>
                            <input type="text" id="your-surname" name="your-surname" />
                        </p>
                        <p>
                            <label for="your-email">
                                Your e-mail address*
                            </label>
                            <input type="text" id="your-email" name="your-email" />
                        </p>
                        <p>
                            <label for="how-find">
                                How did you find us?
                            </label>
                            <input type="text" id="how-find" name="how-find" />
                        </p>
                        <p>
                            <label for="message">
                                Your message here
                            </label>
                            <textarea id="message" name="message"></textarea>
                        </p>
                        <p>
                            <input type="submit" />
                        </p>
                    </form>
                </div>
                <div class="col">
                    <h1>Find Us</h1>
                    <p><b>By train</b><br />
                        Our office is 90 minutes from London and 40 minutes from
                        London Gatwick Airport. We'd be happy to pick you up at the
                        train station. here</p>
                    <p>
                        <img src="./img/map.jpg" alt="" />
                    </p>
                </div>
            </article>
            
            <aside>
                <div class="widget">
                    <h3>Our Address</h3>
                    <address>
                        Leading Edge Exhibits Limited<br />
                        Willowfield Studios<br />
                        67a Willowfield Road<br />
                        Eastbourne<br />
                        East Sussex<br />
                        BN22 9AP<br />
                        UK
                    </address>
                </div>  
                
                <div class="widget">
                    <h3>Contact Us</h3>
                    <div class="call-widget">
                        <ul>
                            <li>T: +44 (0)1323 411 663</li>
                            <li>F: +44 (0)1323 411 692</li>
                        </ul>
                        <p>E: team@leadingedgedesign.co.uk</p>
                    </div>
                </div>
                
                <div class="widget">
                    <h3>Stay connected</h3>
                    <div class="fol-widget">
                    </div>
                </div>
            </aside>

            
            <div class="clearfix"></div>
            </div>
        </div>
    
<?php include_once('includes/footer.php'); ?>