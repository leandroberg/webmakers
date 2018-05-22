<?php $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' ); ?>
<div class="popup">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="javascript:void(0)"><img src="<?php bloginfo('template_directory') ?>/images/close.png" class="close animated" alt="Close" /></a>
                <article></article>
            </div>
        </div>
    </div>
</div>