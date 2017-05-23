<div class="post <?php echo toAscii(get_field("media_type")); ?>">
    <div class="post-img">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail("um_thumbnail_2"); ?>
        </a>
    </div>
    <div class="post-brief">
        <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></p>
		<?php 
			$this_user_ = wp_get_current_user();
		?>
        <?php if(current_user_can('edit_post', $post->ID) && $post->post_author == $this_user_->ID): ?>
            <p class="edit_post"><a href="<?php echo site_url()."/".$GLOBALS["um_submit"]."/".$post->ID; ?>"><i class="icon-pencil"></i><?php _e("Edit","um_lang"); ?></a></p>
        <?php endif; ?>
        <?php if(current_user_can('delete_post', $post->ID) && $post->post_author == $this_user_->ID): ?>
            <p class="delete_post"><a href="<?php echo site_url()."/".$GLOBALS["um_submit"]."/".$post->ID; ?>?delete=true"><i class="icon-trash"></i><?php _e("Delete","um_lang"); ?></a></p>
        <?php endif; ?>
    </div>
</div>