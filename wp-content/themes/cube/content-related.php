<div class="post video">
    <div class="post-img">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("related_image"); ?><div class="hover-state"></div></a>
    </div>
    <div class="post-brief">
        <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p class="post-views"><i class="icon-eye-open"></i> <?php echo get_views(false)." ".__("views","um_lang"); ?> </p>
    </div>
</div>