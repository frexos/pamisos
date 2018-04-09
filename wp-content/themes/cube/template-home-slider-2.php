<?php /*Template Name:Home Slider 2*/ ?>
<?php get_header(); ?>
    <div id="inner-content">
		<div class="slider-two masonry">
			<div class="container">
				<div class="row">
                    <?php
                    $slider_logic = get_field("slider_posts_logic");
                    $arguments = array();
                    $arguments["post_type"] = "post";
                    $arguments["posts_per_page"] = 6;
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
                    $array_image_sizes = array(
                        array(370,379),
                        array(370,300),
                        array(370,250),
                        array(370,250),
                        array(370,300),
                        array(370,379)
                    );
                    if($the_query->found_posts):
                    while ( $the_query->have_posts() ) :  $the_query->the_post();
                    ?>

					<div class="span4">
						<div class="post <?php echo toAscii(get_field("media_type")); ?>">
							<div class="post-img">
								<a href="<?php the_permalink(); ?>">
                                    <?php
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                                        if($image){
                                            $image = $image[0];
                                        }else{
                                            $default_img = get_field("default_featured_image","options");
                                            if($default_img){
                                                $image = $default_img["url"];
                                            }
                                        }
                                        if($image){
                                            $size = array_shift($array_image_sizes);
                                            $img = aq_resize($image,$size[0],$size[1],true);
                                            ?>
                                                <img src="<?php echo $img; ?>" />
                                            <?php
                                        }
                                    ?>
									<div class="hover-state"></div>
								</a>
							</div>
							<a href="<?php the_permalink(); ?>" class="post-title"><h4><?php the_title(); ?></h4></a>
						</div>
					</div>

                    <?php
                    endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
				</div>
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
                                                    <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("προβολές","um_lang"); ?></p>
                                                </div>
                                                <div class="related-posts">
                                                    <ul>
                                                        <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                                                            <li>
                                                                <p>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <span class="related-title"><?php the_title(); ?></span>
                                                                    </a>
                                                                    <span class="related-views"><i class="icon-eye-open"></i><?php echo get_views()." ".__("προβολές","um_lang"); ?></span>
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
                                                    <p class="views-count"><i class="icon-eye-open"></i><?php echo get_views()." ".__("προβολές","um_lang"); ?></p>
                                                </div>
                                                <div class="related-posts">
                                                    <ul>
                                                        <?php while ( $the_query->have_posts() ): $the_query->the_post(); ?>
                                                            <li>
                                                                <p>
                                                                    <a href="<?php the_permalink(); ?>">
                                                                        <span class="related-title"><?php the_title(); ?></span>
                                                                    </a>
                                                                    <span class="related-views"><i class="icon-eye-open"></i><?php echo get_views()." ".__("προβολές","um_lang"); ?></span>
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