<?php
    $slider_logic = get_field("slider_posts_logic");
    $arguments = array();
    $arguments["post_type"] = "post";
    $arguments["posts_per_page"] = 5;
    if($slider_logic == "Latest"){
        //Nothing To Do here
    }elseif($slider_logic == "Popular"){
        $arguments["meta_key"] = "umbrella_post_view";
        $arguments["orderby"] = "meta_value_num";
    }elseif($slider_logic == "Featured"){
        $arguments["meta_key"] = "featured";
    }elseif($slider_logic == "Manual"){
        $manual_posts = get_field("slider_posts",$post->ID,false);
        $arguments["post__in"] = $manual_posts;
    }elseif($slider_logic == "Category"){
        $arguments["cat"] = get_field("slider_category");
    }
    $the_query = new WP_Query( $arguments );
    if($the_query->found_posts):
?>
    <?php $the_query->the_post(); ?>
    <div class="span6 feat-post <?php echo toAscii(get_field("media_type")); ?>">

        <div class="post-img">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("featured_slider"); ?><div class="hover-state"></div></a>
            <span class="views"><i class="icon-eye-open"></i><?php echo get_views(); ?></span>
        </div>

        <div class="post-title">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <span class="comments"><i class="icon-comments-alt"></i><?php comments_number( '0 '.__('comment','um_lang') , '1 '.__('comment','um_lang') , '% '.__('comments','um_lang') ); ?></span>
        </div>

    </div>
    <div class="feat-posts-blocks span6">
        <ul>
            <?php while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>" class="<?php echo toAscii(get_field("media_type")); ?>">
                    <?php the_post_thumbnail("slider_image"); ?>
                    <div class="hover-state">
                        <h5><?php the_title(); ?></h5>
                        <p class="views"><i class="icon-eye-open"></i><?php echo get_views(false)." ".__("views","um_lang");?></p>
                        <i class="post-icon"></i>
                    </div>
                </a>
            </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </ul>
    </div>
<?php endif; ?>