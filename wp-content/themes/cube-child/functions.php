<?php

function my_scripts_method() {
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'comment-reply' );
    if($GLOBALS['jqueryuii'] != true){
        wp_enqueue_script( 'jqueryui',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js",false,1.0,true );
    }
    else{
        $GLOBALS['jqueryuii'] = false;
    }

    wp_enqueue_script( 'fancyboxScript',get_template_directory_uri()."/assets/fancybox/jquery.fancybox-1.3.4.pack.js",false,1.0,true );
    wp_enqueue_script( 'easing',get_template_directory_uri()."/assets/fancybox/jquery.easing-1.3.pack.js",false,1.0,true );
    wp_enqueue_script( 'waitforimages',get_template_directory_uri()."/assets/js/jquery.waitforimages.js",false,1.0,true );
    wp_enqueue_script( 'mousewheel',get_template_directory_uri()."/assets/js/jquery.mousewheel.min.js",false,1.0,true );
    wp_enqueue_script( 'scrollTo',get_template_directory_uri()."/assets/js/jquery.scrollTo-1.4.3.1-min.js",false,1.0,true );
    wp_enqueue_script( 'serialScroll',get_template_directory_uri()."/assets/js/jquery.serialScroll-1.2.2-min.js",false,1.0,true );
    wp_enqueue_script( 'twitter-text',get_template_directory_uri()."/assets/js/twitter-text.js",false,1.0,true );
    wp_enqueue_script( 'mediaelement',get_template_directory_uri()."/assets/mediaelement/mediaelement-and-player.js",false,1.0,true );
    //wp_enqueue_script( 'google_maps',"https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDKFOU1uU91vrPl21PYdwBnFYfnUg0OsHw",false,1.0,true );
  	wp_enqueue_script("google_map","https://maps.googleapis.com/maps/api/js?key=AIzaSyAKFSA04UQVh2e56stH7y86PZy3i11fEzc",'','',TRUE);
    wp_enqueue_script( 'masonry',get_template_directory_uri()."/assets/js/jquery.masonry.js",false,1.0,true );
    wp_enqueue_script( 'customScrollbar',get_template_directory_uri()."/assets/js/jquery.mCustomScrollbar.min.js",false,1.0,true );
    wp_enqueue_script( 'swipe',get_template_directory_uri()."/assets/js/jquery.event.swipe.js",false,1.0,true );
    wp_enqueue_script( 'script',get_template_directory_uri()."/assets/js/script.js",false,1.0,true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

/*Enqueue CSS and JS*/

function my_theme_enqueue_styles() {

    $parent_style = 'cube-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function article_category_init() {
    // create a new taxonomy
    register_taxonomy(
        'article_categories',
        'articles',
        array(
            'label' => __( 'Κατηγορίες Εντύπων' )
            )
    );
}
add_action( 'init', 'article_category_init' );

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Articles', 'Post Type General Name', 'cube-child' ),
        'singular_name'       => _x( 'Article', 'Post Type Singular Name', 'cube-child' ),
        'menu_name'           => __( 'Έντυπα', 'cube-child' ),
        'parent_item_colon'   => __( 'Parent Article', 'cube-child' ),
        'all_items'           => __( 'Όλα', 'cube-child' ),
        'view_item'           => __( 'Εμφάνιση', 'cube-child' ),
        'add_new_item'        => __( 'Προσθήκη Νέου', 'cube-child' ),
        'add_new'             => __( 'Προσθήκη Νέου', 'cube-child' ),
        'edit_item'           => __( 'Επεξεργασία', 'cube-child' ),
        'update_item'         => __( 'Ανανέωση', 'cube-child' ),
        'search_items'        => __( 'Αναζήτηση', 'cube-child' ),
        'not_found'           => __( 'Δε βρέθηκε', 'cube-child' ),
        'not_found_in_trash'  => __( 'Δε βρέθηκε', 'cube-child' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'articles', 'cube-child' ),
        'description'         => __( 'Article news and reviews', 'cube-child' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'article_categories' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    // Registering your Custom Post Type
    register_post_type( 'articles', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

//add_filter( 'gettext', 'change_post_to_article' );
//add_filter( 'ngettext', 'change_post_to_article' );
//
//function change_post_to_article( $translated )
//{
//    $translated = str_replace( 'άρθρα', 'άρθρα πολυμέσων', $translated );
//    $translated = str_replace( 'Άρθρα', 'Άρθρα Πολυμέσων', $translated );
//    return $translated;
//}


function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Άρθρα Πολυμέσων';
    $submenu['edit.php'][5][0] = 'Άρθρα Πολυμέσων';
//    $submenu['edit.php'][10][0] = 'Add Contacts';
//    $submenu['edit.php'][15][0] = 'Status'; // Change name for categories
//    $submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
    echo '';
}

function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Άρθρα Πολυμέσων';
    $labels->singular_name = 'Άρθρο Πολυμέσων';
//    $labels->add_new = 'Add Contact';
//    $labels->add_new_item = 'Add Contact';
//    $labels->edit_item = 'Edit Contacts';
//    $labels->new_item = 'Contact';
//    $labels->view_item = 'View Contact';
//    $labels->search_items = 'Search Contacts';
//    $labels->not_found = 'No Contacts found';
//    $labels->not_found_in_trash = 'No Contacts found in Trash';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

?>