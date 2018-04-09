<?php get_header(); ?>
<?php get_views(true); ?>

    <div <?php post_class(array("audio","single-post")); ?> id="post-<?php the_ID(); ?>">
        <div class="audio-section">
            <div class="container">
                <div class="row">
                    <div class="audio-post span12">
                        <h3 class="audio-title"><?php the_title(); ?></h3>
                        <p class="audio-category"><?php global $terms_html_array;echo $terms_html_array; ?></p>
                        <div class="audio-player">
                        <?php
                            if(get_field("audio_type") == "SoundCloud"):
                                the_field("soundcloud");
                            else:
                                $audio_file_mp3 = get_field("audio_file_mp3");
                                $audio_file_ogg = get_field("audio_file_ogg");
                                $audio_file_wav = get_field("audio_file_wav");
                                if($audio_file_mp3 || $audio_file_ogg || $audio_file_wav):
                                ?>
                                    <audio controls class="ummedia">
                                        <?php if($audio_file_mp3):?>
                                            <source src="<?php echo $audio_file_mp3; ?>" type="audio/mpeg">
                                        <?php endif; ?>
                                        <?php if($audio_file_ogg):?>
                                            <source src="<?php echo $audio_file_ogg; ?>" type="audio/ogg">
                                        <?php endif; ?>
                                        <?php if($audio_file_wav):?>
                                            <source src="<?php echo $audio_file_wav; ?>" type="audio/wav">
                                        <?php endif; ?>
                                    </audio>
                                <?php
                                endif;
                            endif;
                        ?>
                        </div>
                        <div class="audio-info">
                            <ul class="informations">
                            <?php
                            $author_id = $post->post_author;
                            ?>
                            <?php if($author_id): ?>
								<li class="autor"><i class="icon-user"></i><a href="<?php echo site_url()."/".$GLOBALS["um_profile"]."/".urlencode(get_the_author_meta("user_login" , $author_id )); ?>"><?php the_author_meta( "display_name" , $author_id ); ?></a></li>
							<?php endif; ?>
                            <li class="views"><i class="icon-eye-open"></i><p><?php echo get_views(false)." ".__("προβολές","um_lang"); ?></p></li>
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
        </div>
        <div class="post-content">
            <div class="container">
                <div class="row">
                    <div class="span8 main-content">
                        <?php get_template_part("content","reviews"); ?>
                        <div class="details">
                            <div class="toggle">
                                <ul>
                                    <li>
                                        <a href="#" class="toggle-button"><?php _e("Details","um_lang"); ?><i class="icon-minus-sign"></i></a>
                                        <div class="toggle-content">
                                            <?php
                                                setup_postdata($post);
                                                the_content();
                                            ?>
                                        </div>
                                    </li>
                                </ul>
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