<div <?php post_class(array("post",toAscii(get_field("media_type")))); ?>>
    <div class="post-img">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail("um_thumbnail_2"); ?>
            <div class="hover-state"></div>
        </a>
    </div>
    <div class="post-brief">
        <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></p>
    </div>
</div>