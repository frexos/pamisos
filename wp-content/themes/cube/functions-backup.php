<?php
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');

if ( ! isset( $content_width ) ) $content_width = 900;

/*Image Sizes*/
add_image_size("magazine_image", 770, 364, true);
add_image_size("related_image", 720, 540, true);
add_image_size("um_thumbnail", 720, 540, true);
add_image_size("um_thumbnail_2", 720, 540, true);
add_image_size("um_thumbnail_3", 720, 540, true);
add_image_size("um_thumbnail_3_variable", 720, 540, true);
add_image_size("featured_slider", 570, 308, true);
add_image_size("slider_image", 720, 540, true);
add_image_size("gallery_image", 720, 540, true);
/*Image Sizes*/

/*Lang*/
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('um_lang', get_template_directory() . '/lang');
}
/*Lang*/

/*Include ACF HERE*/
if(!isACFActive()){
    define( 'ACF_LITE' , true );
    include_once('advanced-custom-fields/acf.php' );
}
require_once "includes/custom-fields.php";
/*Include ACF HERE*/

/*Register Option Pages*/
if (function_exists("register_options_page")) {
    register_options_page('Main');
    register_options_page('Footer');
    register_options_page('Sidebars');
    register_options_page('Twitter');
    register_options_page('Front-end Submission');
    register_options_page('Branding');
}
/*Register Option Pages*/

/*Includes*/
require_once "includes/tgm/plugins.php";
require_once "includes/google-fonts.php";
require_once "shortcodes/shortcodes.php";
require_once "includes/breadcrumb.php";
require_once "includes/save-post.php";
require_once "includes/sidebars.php";
require_once "widgets/widgets.php";
/*Includes*/

/*Register New Fields*/
add_action('acf/register_fields', 'register_fields');
function register_fields()
{
    include_once('includes/acf-location-field/acf-location.php');
}
/*Register New Fields*/

function my_acf_options_page_settings($options){
    $options['capability'] = 'install_themes';
    return $options;
}
add_filter('acf/options_page/settings', 'my_acf_options_page_settings');

/*Globals*/
global $um_submit;
global $um_profile;
global $um_edit;
global $um_new_user_role;
global $um_facebook_app_id;
global $default_post_status;
global $allow_users_to_publish;
add_action("init","init_globals");

function init_globals(){
    global $um_submit;
    global $um_profile;
    global $um_edit;
    global $um_new_user_role;
    global $um_facebook_app_id;
    global $default_post_status;
    global $allow_users_to_publish;
    $allow_users_to_publish = get_field("allow_users_to_publish_posts","options") == "Disabled" ? false : true;
    $default_post_status = get_field("default_post_status","options") ? get_field("default_post_status","options") : "draft";
    $um_submit = get_field("submit_permalink_keyword","options") ? get_field("submit_permalink_keyword","options") : "submit";
    $um_profile = get_field("profile_permalink_keyword","options") ? get_field("profile_permalink_keyword","options") : "profile";
    $um_edit = "edit";
    $um_new_user_role = get_field("default_users_role","options") ? get_field("default_users_role","options") :"subscriber";
    if(get_field("allow_users_to_register_and_login_with_facebook","options") == "Disabled"){
        $um_facebook_app_id = "";
    }else{
        $um_facebook_app_id = get_field("facebook_app_id","options");
    }

}
/*Globals*/

/*Custom Slug Generator*/
function toAscii($str){
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);
    return $clean;
}
/*Custom Slug Generator*/

/*Register Menu*/
add_action('init', 'register_my_menus');

function register_my_menus()
{
    register_nav_menus(
        array(
            'main_menu' => __('Main Menu', "um-lang"),
            'mobile_menu' => __('Mobile Menu', "um-lang")
        )
    );
}
/*Register Menu*/

/*Custom Rewrite Rules*/
add_action( 'init', 'um_add_rewrite_rules' );
function um_add_rewrite_rules(){
    add_rewrite_rule('^'.$GLOBALS["um_profile"].'/edit?','index.php?umeditprofile=1','top');
    add_rewrite_rule('^'.$GLOBALS["um_profile"].'/([^/]*)/?','index.php?umprofile=1&user_slug=$matches[1]','top');
    add_rewrite_rule('^'.$GLOBALS["um_profile"].'/?','index.php?umprofile=1','top');

    add_rewrite_rule('^'.$GLOBALS["um_submit"].'/([^/]*)/?','index.php?umsubmit=1&umpostid=$matches[1]','top');
    add_rewrite_rule('^'.$GLOBALS["um_submit"].'/?','index.php?umsubmit=1','top');
}

add_filter( 'query_vars', 'wpa5413_query_vars' );
function wpa5413_query_vars( $query_vars )
{
    $query_vars[] = 'list';
    $query_vars[] = 'rowid';
    $query_vars[] = 'umprofile';
    $query_vars[] = 'umsubmit';
    $query_vars[] = 'umeditprofile';
    $query_vars[] = 'user_slug';
    $query_vars[] = 'umpostid';
    return $query_vars;
}

add_filter( 'template_redirect', 'wpse36736_template_redirect' );
function wpse36736_template_redirect(){
    global $wp_query;
    if( $wp_query->get( 'umprofile' ) ):
        get_template_part("user","profile");
        exit();
    endif;
    if( $wp_query->get( 'umsubmit' ) ):
        get_template_part("template","submit");
        exit();
    endif;
    if( $wp_query->get( 'umeditprofile' ) ):
        get_template_part("user","edit-profile");
        exit();
    endif;
}
/*Custom Rewrite Rules*/

/*views*/
function get_views($set = false){
    global $post;
    $views = get_post_meta($post->ID, "umbrella_post_view", true);
    if($set){
        $views = intval($views) + 1;
        if($views){
            update_post_meta($post->ID, "umbrella_post_view" , $views );
        }else{
            add_post_meta($post->ID, "umbrella_post_view" , 1 );
        }
    }
    return $views ? number_format($views, 0, ' ', ' ') : 0;
}
/*views*/

/*Like System*/
add_action('wp_ajax_um_like_post', 'um_like_post');

function um_like_post(){
    if(!is_user_logged_in()){
        die("-1");
    }
    $postid = $_POST["to_like"];
    $this_user = wp_get_current_user();
    $post_likes = get_post_meta($postid,"um_post_likes");
    if(is_array($post_likes) && in_array($this_user->ID,$post_likes)){
        delete_post_meta($postid, "um_post_likes" , $this_user->ID);
        echo "removed_like";
    }else{
        add_post_meta($postid,"um_post_likes",$this_user->ID);
        echo "added_like";
    }

    /*Update Number of post likes*/
    $post_likes = get_post_meta($postid,"um_post_likes");

    $number_of_post_likes = get_post_meta($postid,"um_num_post_likes");
    if($number_of_post_likes){
        update_post_meta($postid,"um_num_post_likes",count($post_likes));
    }else{
        add_post_meta($postid,"um_num_post_likes",count($post_likes));
    }

    /*Remove dis-like just in case*/
    delete_post_meta($postid, "um_post_dislikes" , $this_user->ID);
    die;
}

add_action('wp_ajax_um_dislike_post', 'um_dislike_post');

function um_dislike_post(){
    if(!is_user_logged_in()){
        die("-1");
    }
    $postid = $_POST["to_like"];
    $this_user = wp_get_current_user();
    $post_likes = get_post_meta($postid,"um_post_dislikes");
    if(is_array($post_likes) && in_array($this_user->ID,$post_likes)){
        delete_post_meta($postid, "um_post_dislikes" , $this_user->ID);
        echo "removed_like";
    }else{
        add_post_meta($postid,"um_post_dislikes",$this_user->ID);
        echo "added_like";
    }
    /*Remove Like's just in case*/
    delete_post_meta($postid, "um_post_likes" , $this_user->ID);
    die;
}
/*Like System*/

/*Ajax Autocomplete*/
add_action('wp_ajax_nopriv_get_autocomplete', 'um_get_autocomplete');
add_action('wp_ajax_get_autocomplete', 'um_get_autocomplete');

function um_get_autocomplete(){

    $search = $_REQUEST["um_search"];
    $queried_posts = array();
    $the_query = new WP_Query( array("s"=>$search,"posts_per_page"=>-1,"post_type"=>"post") );
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        array_push($queried_posts,array("permalink"=>get_permalink(),"title"=>get_the_title()));
    }
    echo json_encode($queried_posts);
    die;
}
/*Ajax Autocomplete*/

/*Ajax Login*/
add_action('wp_ajax_nopriv_auth_user', 'auth_user');
add_action('wp_ajax_auth_user', 'auth_user');
function auth_user(){
    $user_name = $_POST["um_username"];
    $password = $_POST["um_pass"];
    $auth = wp_authenticate($user_name,$password);
    if(!is_wp_error($auth)){
        wp_signon(array("user_login"=>$user_name,"user_password"=>$password),false);
    }
    echo !is_wp_error($auth);
    die;
}

add_action('wp_ajax_nopriv_auth_user_fb', 'auth_user_fb');
add_action('wp_ajax_auth_auth_user_fb', 'auth_user_fb');
function auth_user_fb(){
    $facebook_id = $_POST["facebook_id"];
    $user_fb = get_users(array("meta_key "=>"um_facebook_id","meta_value"=>$facebook_id));
    if(is_wp_error($user_fb) || !count($user_fb)){
        echo "-1";
    }else{
        wp_set_auth_cookie($user_fb[0]->ID);
        echo "1";
    }
    die;
}
/*Ajax Login*/

/*Ajax Signup*/
add_action('wp_ajax_nopriv_signup_user', 'signup_user');
add_action('wp_ajax_signup_user', 'signup_user');

function signup_user(){
    $user_name = $_POST["um_username"];
    $user_email = $_POST["um_email"];
    $user_facebook_id = "";
    if(isset($_POST["um_facebookid"]) && $_POST["um_facebookid"]){
        $user_facebook_id = $_POST["um_facebookid"];
    }

    if(username_exists( $user_name )){
        die("user_exists");
    }elseif(email_exists($user_email)){
        die("email_exists");
    }else{
        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_id = wp_create_user( $user_name, $random_password, $user_email );

        $message = __("Here bellow you can find your credentials","um_lang")."
        Username : {$user_name},
        Password : {$random_password}
        ";
        wp_update_user( array ( 'ID' => $user_id, 'role' => $GLOBALS["um_new_user_role"] ) ) ;
        wp_mail($user_email,site_url().__(" Thank you for your registration","um_lang"),$message);
        wp_signon(array("user_login"=>$user_name,"user_password"=>$random_password),false);
        if($user_facebook_id){
            update_user_meta($user_id,"um_facebook_id",$user_facebook_id);
        }
        echo 1;
    }

    die;
}
/*Ajax Signup*/

/*Ajax Forgot Password*/
add_action('wp_ajax_nopriv_um_reset_password', 'um_reset_password');
add_action('wp_ajax_um_reset_password', 'um_reset_password');

function um_reset_password(){
    $email = $_POST["um_email"];

    if(email_exists($email)){
        include "../wp-login.php";
        retrieve_password($email);
    }else{
        echo "-1";
    }

    die;
}
/*Ajax Forgot Password*/

function group_array($array,$group){
    if(!$array || !is_array($array)){
        return false;
    }
    $tmp_array = array();
    $array_holder = array_merge($array);
    $tool_array = array();
    $group_by = 0;
    foreach($array as $key => $value){
        if($group_by % $group == 0 && $group_by != 0){
            array_push($tmp_array,$tool_array);
            $tool_array = array();
        }
        array_push($tool_array,$value);
        $group_by++;
        array_shift($array_holder);
    }
    foreach($array_holder as $arr){
        if($arr){
            array_push($tool_array,$arr);
        }
    }
    array_push($tmp_array,$tool_array);
    return $tmp_array;
}

/*Categories*/
function my_acf_load_field_categories( $field )
{
    // reset choices
    $field['choices'] = array();
    $field['choices'][''] = "---";

    // get the textarea value from options page
    $choices = array();
    $choices[""] = "---";

    $terms = get_terms("category");
    if($terms){
        foreach($terms as $t){
            $field['choices'][$t->term_id] = $t->name;
        }
    }
    // Important: return the field
    return $field;
}

add_action('acf/load_field/key=field_51d198e2f34f0', 'my_acf_load_field_categories');
add_action('acf/load_field/key=field_51d198bef34ee', 'my_acf_load_field_categories');
add_action('acf/load_field/key=field_51d198cdf34ef', 'my_acf_load_field_categories');
add_action('acf/load_field/key=field_51dc00b6cae2c', 'my_acf_load_field_categories');
/*Categories*/

/*Default Post Thumbs*/
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {
    if( '' == $html ){
        $default_img = get_field("default_featured_image","options");
        if($default_img){
            $html = '<img src="'.$default_img["url"].'" />';
        }
    }
    return $html;
}
/*Default Post Thumbs*/

/*Get Tweets*/
function um_get_tweets(){
    function my_streaming_callback($data, $length, $metrics) {
        return TRUE;
    }

    require 'includes/oAuth/tmhOAuth.php';
    require 'includes/oAuth/tmhUtilities.php';
    $tmhOAuth = new tmhOAuth(array(
        'consumer_key'    => get_field("consumer_key","options"),
        'consumer_secret' => get_field("consumer_secret","options"),
        'user_token'      => get_field("user_token","options"),
        'user_secret'     => get_field("user_secret","options"),
    ));

    $method = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $params = array(
        'screen_name' => get_field("twitter_username","options"),
        'count' => get_field("number_of_tweets","options") ? get_field("number_of_tweets","options") : 30,
        'exclude_replies' => get_field("exclude_replies","options") ? 1 : 0
    );
    $tmhOAuth->request('GET', $method, $params, 'my_streaming_callback');
    echo $tmhOAuth->response['response'];
    die();
}
add_action('wp_ajax_um_get_tweets', 'um_get_tweets');
add_action('wp_ajax_nopriv_um_get_tweets', 'um_get_tweets');
/*Get Tweets*/

/*Get Video Embedd*/
function getVideoEmbed($vurl,$height = "100%",$width="100%"){
    $image_url = parse_url($vurl);
    // Test if the link is for youtube
    if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
        $array = explode("&", $image_url['query']);
        return '<iframe class="youtube" src="http://www.youtube.com/embed/' . substr($array[0], 2) . '?wmode=transparent&enablejsapi=1" width="'.$width.'" height="'.$height.'" frameborder="0" allowfullscreen></iframe>'; // Returns the youtube iframe embed code
        // Test if the link is for the shortened youtube share link
    } else if($image_url['host'] == 'www.youtu.be' || $image_url['host'] == 'youtu.be'){
        $array = ltrim($image_url['path'],'/');
        return '<iframe class="youtube" src="http://www.youtube.com/embed/' . $array . '?wmode=transparent&enablejsapi=1" width="'.$width.'" height="'.$height.'" frameborder="0" allowfullscreen></iframe>'; // Returns the youtube iframe embed code
        // Test if the link is for vimeo
    } else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
        $hash = substr($image_url['path'], 1);
        return '<iframe class="vimeo" src="http://player.vimeo.com/video/' . $hash . '?title=0&byline=0&portrait=0&api=1" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen allowfullscreen></iframe>'; // Returns the vimeo iframe embed code
    }
}
/*Get Video Embedd*/

/*Rewrite rules in case of some options change*/
function my_acf_update_value_flush($old)
{
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action("update_option_options_profile_permalink_keyword","my_acf_update_value_flush");
add_action("update_option_options_submit_permalink_keyword","my_acf_update_value_flush");
/*Rewrite rules in case of some options change*/

/*Get Post Statuses*/
function my_acf_load_post_statuses( $field )
{
    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page
    $choices = array();
    global $wp_post_statuses;
    $statuses = $wp_post_statuses;
    foreach($statuses as $key=>$status){
        $field['choices'][$key] = $status->label;
    }
    return $field;
}

add_action('acf/load_field/key=field_51e50f425e654', 'my_acf_load_post_statuses');
/*Get Post Statuses*/

/*Get User Roles*/
function my_acf_load_user_roles( $field )
{
    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page
    global $wp_roles;
    foreach($wp_roles->roles as $key => $role){
        $field['choices'][$key] = $role["name"];
    }
    return $field;
}

add_action('acf/load_field/key=field_51e50f16a1021', 'my_acf_load_user_roles');
/*Get User Roles*/

/*Add Post Thumbnail If it does not exist*/
//add_action( 'post_updated', 'my_project_updated' );

function my_project_updated( $post_id ){
    if(!has_post_thumbnail($post_id)){
        $default_img = get_field("default_featured_image","options");
        if($default_img){
            $default_img = $default_img["id"];
            set_post_thumbnail($post_id,$default_img);
        }
    }
}
/*Add Post Thumbnail If it does not exist*/

/*New Options Page Import Tool*/
add_action('admin_menu', 'register_my_custom_submenu_page' , 99);

function register_my_custom_submenu_page() {
    add_submenu_page( 'acf-options-main', 'Documentation', 'Documentation', 'manage_options', 'admin.php?page=acf-options-documentation', 'my_documentation_menu_callback' );
}

function my_documentation_menu_callback(){
    ?>
    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e("Documentation","um_lang"); ?></h2>
    <iframe width="100%" height="800px" src="http://documentation.umbrella.al/cube-documentation/" frameborder="0"></iframe>
    <?php
}

function my_custom_submenu_page_callback() {

    ?>
    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e("Import Options","um_lang"); ?></h2>
    <form action="admin.php?page=admin.php">
        <input type="hidden" name="page" value="admin.php?page=acf-options-import"/>
        <textarea name="um_import" id="" cols="30" rows="10"></textarea><br/>
        <input type="submit" value="<?php _e("Import","um_lang"); ?>"/>
    </form>
    <?php

    if(isset($_GET["um_to_export"])){
        $export_fields = array();
        $not_allowed_fields = array("repeater","image");
        $fields_droups = $GLOBALS['acf_register_field_group'];
        foreach($fields_droups as $field_group){
            $is_in_options = false;
            foreach($field_group["location"] as $location){
                foreach($location as $lo){
                    if(in_array("options_page",$lo)){
                        $is_in_options = true;
                        break;
                    }
                }
                if($is_in_options){
                    break;
                }
            }
            if($is_in_options){
                foreach($field_group["fields"] as $field){
                    if(!in_array($field["type"],$not_allowed_fields)){
                        array_push($export_fields,array(
                            "key" => $field["key"],
                            "value" => get_field($field["name"],"options",false)
                        ));
                    }
                }
            }
        }
        echo json_encode($export_fields);
    }

    if(isset($_GET["um_import"])){
        $import_data = $_GET["um_import"];
        if($import_data){
            $import_data = json_decode(stripcslashes($import_data),true);
            if($import_data){
                foreach($import_data as $data){
                    try{
                        update_field($data["key"],$data["value"],"option");
                    }catch (Exception $err){

                    }
                }
            }
        }
    }
}
/*New Options Page Import Tool*/

/*Enqueue CSS and JS*/
add_action( 'wp_enqueue_scripts', 'add_external_stylesheets' );
function add_external_stylesheets(){
    wp_enqueue_style("fancybox", get_template_directory_uri() . "/assets/fancybox/jquery.fancybox-1.3.4.css", false, "1.0");
    wp_enqueue_style("bootstrap", get_template_directory_uri() . "/assets/css/bootstrap.css", false, "1.0");
    wp_enqueue_style("responsive", get_template_directory_uri() . "/assets/css/bootstrap-responsive.css", false, "1.0");
    wp_enqueue_style("font-awesome", get_template_directory_uri() . "/assets/css/font-awesome.min.css", false, "1.0");
    wp_enqueue_style("mediaelementplayer", get_template_directory_uri() . "/assets/mediaelement/mediaelementplayer.min.css", false, "1.0");
    wp_enqueue_style("customScrollbar", get_template_directory_uri() . "/assets/css/jquery.mCustomScrollbar.css", false, "1.0");
    wp_enqueue_style("jqueryui", "http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css", false, "1.0");
    wp_enqueue_style("style", get_template_directory_uri() . "/assets/css/style.css", false, "1.0");
    if(get_field("theme_skin","options") == "white"){
        wp_enqueue_style("white_skin", get_template_directory_uri() . "/assets/css/white.css", false, "1.0");
    }
    if(get_field("brand_color","options")){
        wp_enqueue_style("dynamic", get_template_directory_uri() . "/assets/css/dynamic.php?preset=".urlencode(get_field("brand_color","options")), false, "1.0");
    }
    if(get_field("post_views","options") == "Disabled"){
        wp_enqueue_style("disable_views",get_template_directory_uri()."/assets/css/dynamic.php?post_views=true",false);
    }
    $font = get_field("google_fonts","options");
    if($font && $font != "--None--"){
        $font = $GLOBALS["UM_GOOGLEFONTS"][$font];
        $font_name = str_replace(" ","+",$font["family"]);
        $font_variants = "";
        $font_subset = "";
        if($font["variants"]){
            $font_variants = implode($font["variants"],",");
            $font_variants = ":".$font_variants;
        }
        if($font["subsets"]){
            $font_subset = implode($font["subsets"],",");
            $font_subset = "&subset=".$font_subset;
        }
        $font_url = "http://fonts.googleapis.com/css?family={$font_name}{$font_variants}{$font_subset}";
        wp_enqueue_style("google_fonts",$font_url,false);
        wp_enqueue_style("dynamic_css",get_template_directory_uri()."/assets/css/dynamic.php?font=".$font["family"],false);
        //wp_enqueue_style("dynamic", get_template_directory_uri() . "/assets/css/dynamic.php?font=".urlencode(get_field("brand_color","options")), false, "1.0");
    }else{
        wp_enqueue_style("googlefont1", "http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800", false, "1.0");
    }
    /*Grey Skin Font*/
    wp_enqueue_style("googlefont2", "http://fonts.googleapis.com/css?family=Montserrat:400,700", false, "1.0");
    if(get_field("theme_skin","options") == "white"){
        /*White Skin Font*/
        wp_enqueue_style("arvo", "http://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic", false, "1.0");
    }
}

function my_scripts_method() {
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'jqueryui',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js",false,1.0,true );
    wp_enqueue_script( 'fancybox',get_template_directory_uri()."/assets/fancybox/jquery.fancybox-1.3.4.pack.js",false,1.0,true );
    wp_enqueue_script( 'easing',get_template_directory_uri()."/assets/fancybox/jquery.easing-1.3.pack.js",false,1.0,true );
    wp_enqueue_script( 'mousewheel',get_template_directory_uri()."/assets/js/jquery.mousewheel.min.js",false,1.0,true );
    wp_enqueue_script( 'scrollTo',get_template_directory_uri()."/assets/js/jquery.scrollTo-1.4.3.1-min.js",false,1.0,true );
    wp_enqueue_script( 'serialScroll',get_template_directory_uri()."/assets/js/jquery.serialScroll-1.2.2-min.js",false,1.0,true );
    wp_enqueue_script( 'twitter-text',get_template_directory_uri()."/assets/js/twitter-text.js",false,1.0,true );
    wp_enqueue_script( 'mediaelement',get_template_directory_uri()."/assets/mediaelement/mediaelement-and-player.js",false,1.0,true );
    wp_enqueue_script( 'googlemaps',"https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false",false,1.0,true );
    wp_enqueue_script( 'masonry',get_template_directory_uri()."/assets/js/jquery.masonry.js",false,1.0,true );
    wp_enqueue_script( 'customScrollbar',get_template_directory_uri()."/assets/js/jquery.mCustomScrollbar.min.js",false,1.0,true );
    wp_enqueue_script( 'swipe',get_template_directory_uri()."/assets/js/jquery.event.swipe.js",false,1.0,true );
    wp_enqueue_script( 'script',get_template_directory_uri()."/assets/js/script.js",false,1.0,true );
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
/*Enqueue CSS and JS*/

/*isACF Active*/
function isACFActive(){
    return in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
}
/*isACF Active*/
?>