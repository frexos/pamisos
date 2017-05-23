<?php /*Template Name:Revolution Slider*/ ?>
<?php get_header(); ?>
    <div id="inner-content">
        <div class="featured-section slider white-top">
            <div class="feat-pop-posts">
                <?php
					$thePostID = isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : $post->ID;
                    if(get_field("revolution_slider_alias",$thePostID)){
                        echo do_shortcode(get_field("revolution_slider_alias",$thePostID));
                    }
                ?>
            </div>
        </div>

        <div class="main-section">
            <div class="home-one container">
                <div class="row">
                    <div class="span8 videos-home">

                        <?php while(has_sub_field("home_layout")): ?>

                            <?php if(get_row_layout() == "category_full_width"): // layout: Content ?>
                                <?php
                                $term = get_term(get_sub_field("category"),"category");
                                if($term):
                                    ?>
                                    <div class="category-row row one">
                                        <div class="span8 category">
                                            <h4 class="category-title"><span><?php echo $term->name; ?></span></h4>
                                            <div class="posts row">
                                                <?php
                                                $number_of_posts = get_sub_field("number_of_posts") ? get_sub_field("number_of_posts") : 3;
                                                $the_query = new WP_Query( array("posts_per_page"=>$number_of_posts,"post_type"=>"post","cat"=>$term->term_id) );
                                                while ( $the_query->have_posts() ){
                                                    $the_query->the_post();
                                                    get_template_part("content","home-post");
                                                }
                                                wp_reset_postdata();
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php elseif(get_row_layout() == "category_half_width"): // layout: Content ?>
                                <div class="category-row row two">
                                    <?php
                                    $term = get_term(get_sub_field("category"),"category");
                                    if($term):
                                        $number_of_posts = get_sub_field("number_of_posts") ? get_sub_field("number_of_posts") : 3;
                                        $the_query = new WP_Query( array("posts_per_page"=>$number_of_posts,"post_type"=>"post","cat"=>$term->term_id) );
                                        $the_query->the_post();
                                        ?>
                                        <div class="category span4">
                                            <h4 class="category-title"><span><?php echo $term->name; ?></span></h4>
                                            <div class="post <?php echo toAscii(get_field("media_type")); ?>">
                                                <div class="post-img">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail("um_thumbnail_3"); ?>
                                                        <div class="hover-state"></div>
                                                    </a>
                                                </div>
                                                <div class="post-brief">
                                                    <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                    <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></p>
                                                </div>
                                                <div class="related-posts">
                                                    <ul>
                                                        <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                                                            <li>
                                                                <p>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <span class="related-title"><?php the_title(); ?></span>
                                                                    </a>
                                                                    <span class="related-views"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></span>
                                                                </p>
                                                            </li>
                                                        <?php endwhile;wp_reset_postdata(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php
                                    $term2 = get_term(get_sub_field("category_2"),"category");
                                    if($term2):
                                        $number_of_posts = get_sub_field("number_of_posts2") ? get_sub_field("number_of_posts2") : 3;
                                        $the_query = new WP_Query( array("posts_per_page"=>$number_of_posts,"post_type"=>"post","cat"=>$term2->term_id) );
                                        $the_query->the_post();
                                        ?>
                                        <div class="category span4">
                                            <h4 class="category-title"><span><?php echo $term2->name; ?></span></h4>
                                            <div class="post <?php echo toAscii(get_field("media_type")); ?>">
                                                <div class="post-img">
                                                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("um_thumbnail_3"); ?><div class="hover-state"></div></a>
                                                </div>
                                                <div class="post-brief">
                                                    <h5 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                                    <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></p>
                                                </div>
                                                <div class="related-posts">
                                                    <ul>
                                                        <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                                                            <li>
                                                                <p>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <span class="related-title"><?php the_title(); ?></span>
                                                                    </a>
                                                                    <span class="related-views"><i class="icon-eye-open"></i><?php echo get_views()." ".__("views","um_lang"); ?></span>
                                                                </p>
                                                            </li>
                                                        <?php endwhile;wp_reset_postdata(); ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php elseif(get_row_layout() == "plain_html_full_width"): // layout: Content ?>
                                <div class="category-row row one">
                                    <div class="span8 category"><?php the_sub_field("html_markup"); ?></div>
                                </div>
                            <?php elseif(get_row_layout() == "plain_html_half_width"): // layout: Content ?>
                                <div class="category-row row two">
                                    <div class="category span4"><?php the_sub_field("html_markup"); ?></div>
                                    <div class="category span4"><?php the_sub_field("html_markup_2"); ?></div>
                                </div>
                            <?php endif; ?>

                        <?php endwhile; ?>

                    </div>

                    <div class="home-sidebar span4">
                        <?php
                        $thePostID = isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : $post->ID;
                        if(is_dynamic_sidebar(get_field("sidebar"),$thePostID) && get_field("sidebar",$thePostID)){
                            dynamic_sidebar(get_field("sidebar",$thePostID));
                        }else{
                            dynamic_sidebar("default-sidebar");
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
<?php get_footer(); ?>