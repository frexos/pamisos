<?php
class umbrella_related_posts extends WP_Widget{

    function __construct()
    {
        parent::__construct(false, $name = 'Umbrella > Related Posts');
    }

    function widget($args, $instance)
    {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        global $post;
        $tags = wp_get_post_tags($post->ID);
        $terms = wp_get_post_terms( $post->ID,"category" );

        $related_posts = get_field("related_media");
        $custom_query = "";
        if(!$related_posts){
            $args = array();
            $args["post_not_in"] = array ($post->ID);
            $args["posts_per_page"] = 2;
            $args["post_type"] = "post";
            $args["category__in"] = array();
            $args["tag__in"] = array();
            if($terms){
                foreach($terms as $t){
                    array_push($args["category__in"],$t->term_id);
                }
            }
            if($tags){
                foreach($tags as $t){
                    array_push($args["tag__in"],$t->term_id);
                }
            }
            $custom_query = new WP_Query($args);
        }
        ?>
        <?php if($related_posts || $custom_query->found_posts): ?>
        <div class="related-widget">
            <h5 class="widget-title"><span><?php echo $title; ?></span></h5>
            <?php
            if($related_posts):
                foreach($related_posts as $post):
                    setup_postdata($post);
                    get_template_part("content","related");
                endforeach;
            else:
                while ( $custom_query->have_posts() ) :  $custom_query->the_post();
                    setup_postdata($post);
                    get_template_part("content","related");
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    <?php endif; ?>

    <?php
        wp_reset_postdata();
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : "";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title',"um_lang"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
    <?php
    }
}

function umbrella_widgets_related_posts() {
    register_widget('umbrella_related_posts');
}
add_action('widgets_init', 'umbrella_widgets_related_posts');
?>