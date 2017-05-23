<?php
$terms = wp_get_post_terms( $post->ID,"category" );
$terms_html_array = array();
foreach($terms as $t){
    $term_name = $t->name;
    $term_link = get_term_link($t->slug,$t->taxonomy);
    array_push($terms_html_array,"<a href='{$term_link}'>{$term_name}</a>");
}
$terms_html_array = implode(", ",$terms_html_array);
?>
<div class="post <?php echo toAscii(get_field("media_type")); ?> span4">
    <a href="<?php the_permalink(); ?>" class="post-img">
        <?php the_post_thumbnail("um_thumbnail_3_variable"); ?>
        <div class="hover-state"></div>
    </a>
    <div class="post-brief">
        <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p class="post-views"><span class="views"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></span>
            <span class="category"><i class="icon-folder-open"></i><?php echo $terms_html_array; ?></span></p>
    </div>
</div>