<?php if(get_field("featured_control") == "Manual"): ?>
    <div class="featured">
        <?php
        $featured_posts = get_field("featured_posts");
        if($featured_posts):
            $post = array_shift($featured_posts);
            setup_postdata($post);
            ?>
            <div class="span6 feat-post <?php echo toAscii(get_field("media_type")); ?>">
                <div class="post-img">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("featured_slider"); ?><div class="hover-state"></div></a>
                    <span class="views"><i class="icon-eye-open"></i><?php echo get_views(); ?></span>
                </div>
                <div class="post-title">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <span class="comments"><i class="icon-comments-alt"></i><?php comments_number( '0 '.__('comment','um_lang') , '1 '.__('comment','um_lang') , '% '.__('comments','um_lang') ); ?>.</span>
                </div>
            </div>
        <?php endif; ?>
        <?php if($featured_posts): ?>
            <div class="feat-posts-list span4">
                <ul>
                    <?php foreach($featured_posts as $post): setup_postdata($post); ?>
                        <li>
                            <a class="<?php echo toAscii(get_field("media_type")); ?>" href="<?php the_permalink(); ?>"><div class="hover-state"></div><?php the_post_thumbnail("um_thumbnail"); ?></a>
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p class="views-counter"><i class="icon-eye-open"></i><?php echo get_views(false)." ".__("views","um_lang");?></p>
                        </li>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="featured">
        <?php
        $the_query = new WP_Query( array("posts_per_page"=>6,"post_type"=>"post","meta_key"=>"featured") );
        $the_query->the_post();
        ?>
        <div class="span6 feat-post <?php echo toAscii(get_field("media_type")); ?>">
            <div class="post-img">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail("featured_slider"); ?>
                    <div class="hover-state"></div>
                </a>
                <span class="views"><i class="icon-eye-open"></i><?php echo get_views(); ?></span>
            </div>
            <div class="post-title">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <span class="comments"><i class="icon-comments-alt"></i><?php comments_number( '0 '.__('comment','um_lang') , '1 '.__('comment','um_lang') , '% '.__('comments','um_lang') ); ?>.</span>
            </div>
        </div>

        <div class="feat-posts-list span4">
            <ul>
                <?php while($the_query->have_posts()): $the_query->the_post(); ?>
                    <li>
                        <a class="<?php echo toAscii(get_field("media_type")); ?>" href="<?php the_permalink(); ?>"><div class="hover-state"></div><?php the_post_thumbnail("um_thumbnail"); ?></a>
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="views-counter"><i class="icon-eye-open"></i><?php echo get_views(false)." ".__("views","um_lang");?></p>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>