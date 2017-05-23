<?php get_header(); ?>

    <div class="user-profile-top">
        <div class="container">
            <div class="row">
                <div class="span12 contact-title">
                    <p><i class="icon-file-text-alt"></i><?php the_title(); ?></p>
                </div>
            </div>
        </div>
    </div>

    <br/>
    <div class="container">
        <div class="row">
			<?php 
				$thePostID = isset($wp_query->queried_object_id) ? $wp_query->queried_object_id : $post->ID;
				$sidebar = get_field("sidebar",$thePostID);
			?>
            <div class="<?php echo $sidebar ? "span8" : "span12" ; ?>">
                <div class="about-user-cont">
                    <?php do_action( 'bp_before_blog_page' ); ?>
                    <?php
                        global $post;
                        setup_postdata($post);
                        the_content();
                    ?>
                </div>
            </div>
			
			<?php 
				if($sidebar): 
			?>
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
			<?php endif; ?>
			
        </div>
    </div>

<?php get_footer(); ?>