
        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fvibbrati&tabs=timeline&width=350&height=70&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=393826120693218" width="350" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                    <div class="col-md-6">
                        <!-- LightWidget WIDGET -->
                        <script src="//lightwidget.com/widgets/lightwidget.js"></script>
                        <iframe src="//lightwidget.com/widgets/2e6c6abe5f4a5be88375c8a15b1ea5cc.html" scrolling="no" allowtransparency="true" class="lightwidget-widget" style="width: 100%; border: 0; overflow: hidden;"></iframe>
                    </div>
                </div>
                <div class="row justify-content-center no-gutters">
                    <div class="col-md-8"><?php $wpQuery = new WP_Query(array('page_id'=>27)); $wpQuery->the_post(); the_content(); wp_reset_query(); ?></div>
                </div>
            </div>
        </footer>

        <!-- AJAX STATUS //-->
        <div class="ajax-status">
            <div class="container-fluid">
                <div class="row justify-content-center min-height-100vh">
                    <div class="col align-self-center">
                        <span class="fa"></span>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
        
        <?php wp_footer() ?>
        
    </body>
</html>