<?php
function pre_save_media( $post_id )
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
        'post_status'  => "publish" ,
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

add_filter('acf/pre_save_post' , 'pre_save_media');
?>