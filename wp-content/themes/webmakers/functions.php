<?php

# METATAGS
function metatags(){
    
    global $post;
	
    // SET THUMBNAIL URL
    if(is_single()):
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $thumbnail = $thumbnail[0];
    else:
        $thumbnail = get_template_directory_uri().'/screenshot.png';
    endif;
    
    $metatags = '<meta charset="'.get_bloginfo( 'charset' ).'">'."\n";
    $metatags .= '<title>'.get_bloginfo('name').'</title>'."\n";
    $metatags .= '<meta name="description" content="'.get_bloginfo('description').'">'."\n";
    $metatags .= '<meta name="keywords" content="">'."\n";	
    $metatags .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">'."\n";
    $metatags .= '<!-- TWITTER //-->'."\n";
    $metatags .= '<meta name="twitter:card" content="summary_large_image">'."\n";
    $metatags .= '<meta name="twitter:site" content="">'."\n";
    $metatags .= '<meta name="twitter:title" content="'.(is_single()||is_page() ? get_the_title() : get_bloginfo('name')).'">'."\n";
    $metatags .= '<meta name="twitter:description" content="'.(is_single()||is_page() ? $post->post_excerpt : get_bloginfo('description')).'">'."\n";
    $metatags .= '<meta name="twitter:image" content="'.$thumbnail.'"/>'."\n";
    $metatags .= '<!-- OPEN GRAPH //-->'."\n";
    $metatags .= '<meta property="og:site_name" content="'.get_bloginfo('name').'"/>'."\n";
    $metatags .= '<meta property="og:title" content="'.(is_single()||is_page() ? get_the_title() : get_bloginfo('name')).'"/>'."\n";
    $metatags .= '<meta property="og:description" content="'.(is_single()||is_page() ? $post->post_excerpt : get_bloginfo('description')).'">'."\n";
    $metatags .= '<meta property="og:image" content="'.$thumbnail.'"/>'."\n";
    $metatags .= '<meta property="og:image:width" content="600" />'."\n";
    $metatags .= '<meta property="og:image:height" content="315" />'."\n";
    $metatags .= '<meta property="og:url" content="'.(is_single()||is_page() ? get_the_permalink() : get_bloginfo('home')).'">'."\n";
    $metatags .= '<meta property="og:type" content="'.(is_single()||is_page() ? 'article' : 'website').'" />'."\n";
    $metatags .= '<meta property="fb:app_id" content="393826120693218" />'."\n";
    
    echo $metatags;
    
}

# THEME VERSION
if (!defined('THEME_VERSION')) {
    $theme = wp_get_theme();
    define('THEME_VERSION', $theme->Version);
}

# THEME PATH
if (!defined('THEMEPATH')) {
    define('THEMEPATH', get_template_directory());
}

# LOAD STYLES & SCRIPTS
function load_scripts(){
    
    # CSS
    wp_enqueue_style( 'style', get_stylesheet_uri(), array('bootstrap','fonts'), THEME_VERSION );
    wp_enqueue_style( 'transitions', get_template_directory_uri() . '/css/transitions.css', array('style'), THEME_VERSION );
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array('style','bootstrap','fonts',), THEME_VERSION );
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css', array(), THEME_VERSION );
    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Quicksand:300,500|Changa+One', array(), THEME_VERSION );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/vendor/slick/slick.css', array(), THEME_VERSION );
    
    # TEMPLATE DIRECTORY JAVASCRIPT VAR
    echo '<script>var homeDirectory = "'.get_bloginfo('home').'";';
    echo 'var templateDirectory = "'.get_bloginfo('template_directory').'";';
    echo 'var siteName = "'.get_bloginfo('name').'";</script>';
	
    # JS
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'validate'), THEME_VERSION, true );
    wp_enqueue_script( 'validate', get_template_directory_uri() . '/vendor/jquery.validate.min.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'scroll', get_template_directory_uri() . '/vendor/scroll.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/68ecb7a707.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/slick/slick.min.js', array('jquery'), THEME_VERSION, true );
    
}add_action( 'wp_enqueue_scripts', 'load_scripts' );

# CUSTOM POSTS
function custom_posts() {
    /* SLIDE */ register_post_type('slide',array('label'=>'Slides','public'=>true,'supports'=>array('title','editor','thumbnail')));
    /* SERVICES */ register_post_type('services',array('label'=>'Serviços','public'=>true,'supports'=>array('title','editor')));
    /* CLIENTS */ register_post_type('clients',array('label'=>'Clientes','public'=>true,'supports'=>array('title','thumbnail')));
    /* CLIENTS CATEGORY */ register_taxonomy('clients_category','clients',array('hierarchical'=>true,'label'=>'Estados','show_admin_column'=>true,'public'=>true,'query_var'=>true));
    /* TAG TAXONOMY  register_taxonomy('climasphere_tag','climasphere',array('hierarchical'=>false,'label'=>'Tags','show_admin_column'=>true,'public'=>true,'query_var'=>true));*/
}add_action( 'init', 'custom_posts' );

# SETUP SUPPORTS
function supports(){
    /* THUMBNAILS */ add_theme_support('post-thumbnails');
    /* EXCERPT TO PAGES */ add_post_type_support( 'page', 'excerpt' );
}add_action( 'init', 'supports' );

# SEARCH - Filter results
function search_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_search) {
      $query->set('post_type', array('post'));
    }
  }
} add_action('pre_get_posts','search_filter');

# TINY URL
function tinyurl($url)  {  
    $ch = curl_init();  
    $timeout = 5;  
    curl_setopt($ch,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);  
    $data = curl_exec($ch);  
    curl_close($ch);  
    return $data;  
}

# TWITTER TEXT
function twitter_text($text){
    $twitter = $text;
    $twitter = str_replace('&#039;','%27',$twitter);
    $twitter = str_replace('#','%23',$twitter);
    $twitter = str_replace('@','%40',$twitter);
    echo $twitter;
}

# EXCERPT WITH MAX LENGTH
function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}

/*************************************************************************
*  GET YOUTUBE EMBED BY URL
*************************************************************************/
function the_youtube_embed($url,$width,$height) {
  $url = parse_url($url, PHP_URL_QUERY);
  parse_str($url, $params);
  echo '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$params['v'].'" frameborder="0" allowfullscreen></iframe>';
}

/*************************************************************************
*  GET VIMEO EMBED BY URL
*************************************************************************/
function the_vimeo_embed($url,$width,$height) {
  $url = str_replace('https://','https://player.',$url);
  $url = str_replace('.com/','.com/video/',$url);
  echo '<iframe src="'.$url.'?title=0&byline=0&portrait=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
}

/*************************************************************************
*  GET VIDEO EMBED BY URL
*************************************************************************/
function the_video_embed($url,$width,$height) {
    $html = '<video width="'.$width.'" height="'.$height.'" controls>';
    $html .= '<source src="'.$url.'" type="video/mp4">';
    $html .= '</video>';
    echo $html;
}

// VIDEO PLAYER
function video_player($url,$width,$height){
    if(strstr($url,'youtube.com')):
        the_youtube_embed($url,$width,$height); //YOUTUBE
    elseif(strstr($url,'vimeo.com')):
        the_vimeo_embed($url,$width,$height); //VIMEO
    else:
        the_video_embed($url,$width,$height); //OTHER
    endif;
}

/* CATEGORY NAME */
function category_name($post,$taxonomy,$term_id=false){
    $terms = get_the_terms($post,$taxonomy);
    if($term_id){
        echo 'cat-item-'.$terms[0]->term_id;
    }else{
        echo $terms[0]->name;
    }
}