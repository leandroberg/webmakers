<?php

# METATAGS
function metatags(){
    
    $metatags = '<meta charset="'.get_bloginfo( 'charset' ).'">'."\n";
    $metatags .= '<title>'.get_bloginfo('name').'</title>'."\n";
    $metatags .= '<meta name="description" content="'.get_bloginfo('description').'">'."\n";
    $metatags .= '<meta name="keywords" content="">'."\n";	
    $metatags .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">'."\n";
    $metatags .= '<!-- TWITTER //-->'."\n";
    $metatags .= '<meta name="twitter:card" content="summary_large_image">'."\n";
    $metatags .= '<meta name="twitter:site" content="">'."\n";
    $metatags .= '<meta name="twitter:title" content="'.metatitle().'">'."\n";
    $metatags .= '<meta name="twitter:description" content="'.metadescription().'">'."\n";
    $metatags .= '<meta name="twitter:image" content="'.metathumb().'"/>'."\n";
    $metatags .= '<!-- OPEN GRAPH //-->'."\n";
    $metatags .= '<meta property="og:site_name" content="'.get_bloginfo('name').'"/>'."\n";
    $metatags .= '<meta property="og:title" content="'.metatitle().'"/>'."\n";
    $metatags .= '<meta property="og:description" content="'.metadescription().'">'."\n";
    $metatags .= '<meta property="og:image" content="'. metathumb().'"/>'."\n";
    $metatags .= '<meta property="og:image:width" content="600" />'."\n";
    $metatags .= '<meta property="og:image:height" content="315" />'."\n";
    $metatags .= '<meta property="og:url" content="'.metaurl().'">'."\n";
    $metatags .= '<meta property="og:type" content="'.metatype().'" />'."\n";
    $metatags .= '<meta property="fb:app_id" content="393826120693218" />'."\n";
    
    echo $metatags; // WPCS: XSS OK
    
}

# META TITLE
function metatitle(){
    $title = get_bloginfo('name');
    if(is_single()||is_page()){
        $title =  get_the_title();
    }
    return $title;
}

#META DESCRIPTION
function metadescription(){
    global $post;
    $description = get_bloginfo('description');
    if(is_single()||is_page()){
        $description = $post->post_excerpt;
    }
    return $description;
}

# THUMBNAIL
function metathumb(){
    global $post;
    $thumbnail = get_template_directory_uri().'/screenshot.png';
    if(is_single()){
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
        $thumbnail = $thumbnail[0];
    }
    return $thumbnail;
}

# META URL
function metaurl(){
    $url = get_bloginfo('home');
    if(is_single()||is_page()){
        $url = get_the_permalink();
    }
    return $url;
}

# META TYPE
function metatype(){
    $type = 'website';
    if(is_single()||is_page()){
        $type = 'article';
    }
    return $type;
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
    wp_enqueue_style( 'ajaxstatus', get_template_directory_uri() . '/vendor/virtuemasters/ajaxstatus/ajaxstatus.css', array(), THEME_VERSION );
	
    # JS
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery', 'validate'), THEME_VERSION, true );
    wp_enqueue_script( 'validate', get_template_directory_uri() . '/vendor/jquery.validate.min.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'scroll', get_template_directory_uri() . '/vendor/scroll.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/68ecb7a707.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/slick/slick.min.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'ajaxstatus', get_template_directory_uri() . '/vendor/virtuemasters/ajaxstatus/ajaxstatus.js', array('jquery','fontawesome'), THEME_VERSION, true );
    wp_enqueue_script( 'ajaxform', get_template_directory_uri() . '/vendor/virtuemasters/ajaxform/ajaxform.js', array('ajaxstatus'), THEME_VERSION, true );
    
    # AJAX OBJECT
    $ajaxobject = array(
        'themeurl' => get_template_directory_uri(),
        'ajaxurl' => admin_url('admin-ajax.php'),
        'sitename' => get_bloginfo('name')
    );
    //wp_localize_script( 'custom', 'ajaxobject', $ajaxobject);
    //wp_localize_script( 'popup', 'ajaxobject', $ajaxobject);
    wp_localize_script( 'ajaxstatus', 'ajaxobject', $ajaxobject);
    wp_localize_script( 'ajaxform', 'ajaxobject', $ajaxobject);
    
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
    $curl = curl_init();  
    $timeout = 5;  
    curl_setopt($curl,CURLOPT_URL,'http://tinyurl.com/api-create.php?url='.$url);  
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,$timeout);  
    $data = curl_exec($curl);  
    curl_close($curl);  
    return $data;  
}

# TWITTER TEXT
function twitter_text($text){
    $twitter = $text;
    $twitter = str_replace('&#039;','%27',$twitter);
    $twitter = str_replace('#','%23',$twitter);
    $twitter = str_replace('@','%40',$twitter);
    return $twitter;
}