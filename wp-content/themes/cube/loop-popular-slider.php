<?php
$arguments = array();
$arguments["post_type"] = "post";
if(get_field("include_only_those_categories") || get_field("exclude_categories")){

    $arguments["tax_query"] = array();
    if(get_field("include_only_those_categories") && get_field("exclude_categories")){
        $arguments["tax_query"]['relation'] = 'OR';
    }

    if(get_field("exclude_categories")){
        $exclude_categories = explode(",",get_field("exclude_categories"));
        array_push($arguments["tax_query"],array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $exclude_categories,
            'operator' => 'NOT IN'
        ));
    }
    if(get_field("include_only_those_categories")){
        $include_categories = explode(",",get_field("include_only_those_categories"));
        array_push($arguments["tax_query"],array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $include_categories,
            'operator' => 'IN'
        ));
    }
}
if(get_field("exclude_categories")){
    $exlude_posts = array();
    foreach(get_field("exclude_categories") as $tmpPost){
        array_push($exlude_posts,$tmpPost->ID);
    }
    $arguments["post__not_in"] = $exlude_posts;
}

if(get_field("exclude_posts")){
    $exlude_posts = array();
    foreach(get_field("exclude_posts") as $tmpPost){
        array_push($exlude_posts,$tmpPost->ID);
    }
    $arguments["post__not_in"] = $exlude_posts;
}

$arguments["posts_per_page"] = get_field("number_of_posts");
$arguments["meta_key"] = "umbrella_post_view";
$arguments["orderby"] = "meta_value_num";
$the_query = new WP_Query( $arguments );
if($the_query->found_posts):
?>
    <div class="popular">
        <?php $the_query->the_post(); ?>
        <div class="span6 feat-post video">
            <div class="post-img">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("featured_slider"); ?><div class="hover-state"></div></a>
                <span class="views"><i class="icon-eye-open"></i><?php echo get_views(); ?></span>
            </div>
            <div class="post-title">
                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <span class="comments"><i class="icon-comments-alt"></i><?php comments_number( '0 '.__('comment','um_lang') , '1 '.__('comment','um_lang') , '% '.__('comments','um_lang') ); ?>.</span>
            </div>
        </div>
        <div class="feat-posts-list span4">
            <ul>
                <?php while ( $the_query->have_posts() ) :  $the_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="<?php echo toAscii(get_field("media_type")); ?>"><div class="hover-state"></div> <?php the_post_thumbnail("um_thumbnail"); ?></a>
                        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="views-counter"><i class="icon-eye-open"></i><?php echo get_views(false)." ".__("views","um_lang");?></p>
                        <br style="clear: both;">
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
<?php endif; ?>