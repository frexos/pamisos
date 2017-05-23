<?php get_header(); ?>

    <div <?php post_class(array("article","single-post")); ?> id="post-<?php the_ID(); ?>">
        <div class="article-section">
            <div class="container">
                <div class="row">
                    <div class="article-info span12">
                        <ul class="informations">
                            <?php
                            $author_id = $post->post_author;
                            ?>
                            <?php if($author_id): ?>
								<li class="autor"><i class="icon-user"></i><a href="<?php echo site_url()."/".$GLOBALS["um_profile"]."/".urlencode(get_the_author_meta("user_login" , $author_id )); ?>"><?php the_author_meta( "display_name" , $author_id ); ?></a></li>
							<?php endif; ?>
                            <li class="views"><i class="icon-eye-open"></i><p><?php echo get_views(true)." ".__("views","um_lang"); ?></p></li>
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
                    </div>
                </div>
            </div>
        </div>
        <div class="post-content">
            <div class="container">
                <div class="row">
                    <div class="span8 main-content">
                        <div class="article-content">
                            <?php the_post_thumbnail("magazine_image"); ?>
                            <div class="post-title">
                                <h4><?php the_title();?></h4>
                                <p class="post-category"><i class="icon-folder-open"></i><?php global $terms_html_array;echo $terms_html_array; ?></p>
                            </div>
                            <?php
                            $gallery = get_field("magazine_gallery");
                            if($gallery || get_field("reviews")):
                                ?>
                                <div class="mag-type">
                                    <?php if($gallery): ?>
                                        <div class="mag-gallery">
                                            <a href="#" class="prev"><i class="icon-angle-left"></i></a>
                                            <div class="gallery-holder">
                                                <ul class="gallery-continer">
                                                    <?php foreach($gallery as $img): ?>
                                                        <?php if($img["image"]):  ?>
                                                            <li><a rel="gallery" href="<?php echo $img["image"]["url"]; ?>"><img src="<?php echo $img["image"]["sizes"]["gallery_image"]; ?>" alt="<?php echo $img["image"]["title"]; ?>"></a></li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <a href="#" class="next"><i class="icon-angle-right"></i> </a>
                                        </div>
                                    <?php endif; ?>
                                    <?php get_template_part("content","reviews"); ?>
                                </div>
                            <?php endif; ?>
                            <div class="post-main-cont">
                                <?php
                                global $post;
                                setup_postdata($post);
                                the_content();
                                ?>
                            </div>
                        </div>
                        <?php
                        $tags = wp_get_post_terms( $post->ID,"post_tag" );
                        $tags_html_array = array();
                        foreach($tags as $t){
                            $term_name = $t->name;
                            $term_link = get_term_link($t->slug,$t->taxonomy);
                            array_push($tags_html_array,"<li><a href='{$term_link}'>{$term_name}</a></li>");
                        }
                        $tags_html_array = implode("",$tags_html_array);
                        ?>
                        <?php if($tags_html_array): ?>
                            <div class="post-tags">
                                <ul>
                                    <?php echo $tags_html_array; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(get_field("sharethis_markup","options")): ?>
                            <div class="post-tags">
                                <?php the_field("sharethis_markup","options"); ?>
                            </div>
                        <?php endif; ?>

                        <?php comments_template(); ?>
                    </div>
                    <div class="span4 post-sidebar">
                        <?php
                        $thePostID = isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : $post->ID;
                        if(is_dynamic_sidebar(get_field("sidebar")) && get_field("sidebar")){
                            dynamic_sidebar(get_field("sidebar"));
                        }elseif(is_dynamic_sidebar(get_field("blog_posts_sidebar","options"))){
                            dynamic_sidebar(get_field("blog_posts_sidebar","options"));
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