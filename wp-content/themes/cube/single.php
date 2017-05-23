<?php
if(isset($_GET["get_article_info"])){
    ?>
    <ul class="informations">
        <?php
        $author_id = $post->post_author;
        ?>
        <?php if($author_id): ?>
            <li class="autor"><i class="icon-user"></i><a href="<?php echo site_url()."/".$GLOBALS["um_profile"]."/".urlencode(get_the_author_meta("user_login" , $author_id )); ?>"><?php the_author_meta( "display_name" , $author_id ); ?></a></li>
        <?php endif; ?>
        <li class="views"><i class="icon-eye-open"></i><p><?php echo get_views(false)." ".__("views","um_lang"); ?></p></li>
        <li class="pub-date"><i class="icon-calendar"></i><p><?php echo get_the_date("d F Y"); ?></p></li>
        <?php if(get_field("post_likes","options") != "Disabled"): ?>
        <?php
        $post_likes = get_post_meta($post->ID,"um_post_likes");
        $liked = "";
        $this_user = wp_get_current_user();
        if(is_array($post_likes) && in_array($this_user->ID,$post_likes)){
            $liked = " liked";
        }
        ?>
        <li class="like <?php echo $liked; ?>"><i class="icon-thumbs-up-alt"></i><a href="<?php echo $post->ID; ?>"><?php _e("Like this","um_lang"); ?> (<span><?php echo count($post_likes); ?></span>)</a></li>
        <?php
        $post_likes = get_post_meta($post->ID,"um_post_dislikes");
        $liked = "";
        $this_user = wp_get_current_user();
        if(is_array($post_likes) && in_array($this_user->ID,$post_likes)){
            $liked = " disliked";
        }
        ?>
        <li class="dislike"><i class="icon-thumbs-down-alt"></i><a href="<?php echo $post->ID; ?>"><?php _e("Dislike this","um_lang"); ?> (<span><?php echo count($post_likes); ?></span>)</a></li>
        <?php endif; ?>
    </ul>
    <?php
    die;
}
?>
<?php
    $terms = wp_get_post_terms( $post->ID,"category" );
    $terms_html_array = array();
    foreach($terms as $t){
        $term_name = $t->name;
        $term_link = get_term_link($t->slug,$t->taxonomy);
        array_push($terms_html_array,"<a href='{$term_link}'>{$term_name}</a>");
    }
    $terms_html_array = implode(", ",$terms_html_array);
    global $terms_html_array;
    $media_type = get_field("media_type");
    if($media_type == "Video"){
        get_template_part("formats/format","video");
    }elseif($media_type == "Audio"){
        get_template_part("formats/format","audio");
    }else{
        get_template_part("formats/format","magazine");
    }
?>