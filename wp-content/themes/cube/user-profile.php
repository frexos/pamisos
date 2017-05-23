<?php
    $user_slug = urldecode(get_query_var("user_slug"));
    if($user_slug){
        $this_user = get_user_by('login',$user_slug);
    }else{
        $this_user = wp_get_current_user();
    }
    if(!$this_user->ID){
        wp_redirect(site_url());
    }
?>
<?php get_header(); ?>
<div class="user-profile-top usr-prof">
	<div class="container">
		<div class="row">
			<div class="span4 user-pic">
				<?php if(get_field("author_image","user_".$this_user->ID)): $image = get_field("author_image","user_".$this_user->ID); ?>
                    <img src="<?php  echo $image["sizes"]["thumbnail"]; ?>" alt=""/>
                <?php endif; ?>
				<h4><?php echo $this_user->data->display_name; ?></h4>
				<p class="nr-of-posts"><?php echo count_user_posts($this_user->ID)." ".__("posts","um_lang"); ?></p>
			</div>
            <?php if(!$user_slug): ?>
			<div class="span6">
				<a href="<?php echo site_url()."/".$GLOBALS["um_profile"]; ?>" class="my-posts"><?php _e("My Posts","um_lang"); ?></a>
				<a href="<?php echo site_url()."/".$GLOBALS["um_profile"]."/".$GLOBALS["um_edit"]; ?>" class="edit-prof"><?php _e("Edit profile","um_lang"); ?></a>
			</div>
            <?php endif; ?>
			<div class="span2 subscribe">
				<a href="<?php echo site_url()."/author/".$this_user->data->user_login."/feed/"; ?>" class="subscribe"><i class="icon-rss"></i>Subscribe</a>
			</div>
		</div>
	</div>
</div>
<div class="user-prof-content">
	<div class="container">
		<div class="row">
			<div class="span8 user-posts">
				<div class="category-row row one">
					<div class="span8 category">
						<h4 class="category-title"><span>
                                <?php
                                    if($user_slug){
                                        echo $this_user->data->display_name;
                                    }else{
                                        echo __("My posts","um_lang");
                                    }
                                ?>
						</span></h4>
                        <div class="row">
                        	<?php
								$paged = isset($_GET["pgd"]) ? $_GET["pgd"] : 0;
	                            $the_query = new WP_Query( array("posts_per_page"=>6,"post_type"=>"post","author"=>$this_user->ID,"paged"=>$paged) );
	                            while ( $the_query->have_posts() ){
	                                $the_query->the_post();
	                                get_template_part("content","profile-post");
	                            }
	                            wp_reset_postdata();
	                        ?>							
                        </div>
						<div class="pagination">
							<?php
							$format = '?pgd=%#%';
							$big = 999999999; // need an unlikely integer
							echo paginate_links( array(
								'base' => site_url()."/".$GLOBALS["um_profile"]."%_%",
								'format' => $format,
								'current' => max( 1, $paged ),
								'total' => $the_query->max_num_pages,
								'prev_next'    => FALSE
							) );
							?>
						</div>
					</div>

                    <?php if(get_field("post_likes","options") != "Disabled"): ?>
                    <?php
                        $the_query = new WP_Query( array(
                                                        "posts_per_page"=>-1,
                                                        "post_type"=>"post",
                                                        "meta_key" => "um_num_post_likes",
                                                        "orderby" => "meta_value_num",
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'um_post_likes',
                                                                'value' => array($this_user->ID),
                                                                'compare' => 'IN',
                                                            )
                                                        )
                        ) );
                        if($the_query->found_posts):
                    ?>
                    <div class="span8 category">
                        <h4 class="category-title"><span>
                                <?php _e("Liked Posts","um_lang"); ?>
						</span></h4>
                        <div class="row">
                            <?php
                            while ( $the_query->have_posts() ){
                                $the_query->the_post();
                                get_template_part("content","profile-post");
                            }
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

				</div>
			</div>
			<div class="span4 user-sidebar">
				<div class="about-widget">
					<h5 class="widget-title"><span><?php _e("About","um_lang"); ?></span></h5>
					<div class="about-user-cont">
						<p><?php echo nl2br(get_the_author_meta("description",$this_user->ID)); ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>