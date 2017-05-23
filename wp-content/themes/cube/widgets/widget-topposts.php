<?php
class umbrella_topposts extends WP_Widget{

    function __construct()
    {
        parent::__construct(false, $name = 'Umbrella > Top Posts');
    }

    function widget($args, $instance)
    {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $post_order = $instance['post_order'];
        $number_of_posts = $instance['number_of_posts'];
        $post_ids = $instance['post_ids'];
        ?>
        <div class="top-five-widget">
            <h5 class="widget-title"><span><?php echo $title; ?></span></h5>
            <ul>
                <?php
                    $arguments = array();
                    $arguments["post_type"] = "post";
                    $arguments["posts_per_page"] = isset($number_of_posts) ? $number_of_posts : 3;
                    if($post_order == "custom"){
                        function filter_integers($var){
                            $tmp_var = intval($var);

                            return $tmp_var ? $tmp_var : false;
                        }
                        $post_ids = explode(",",$post_ids);
                        $post_ids = array_filter($post_ids,"filter_integers");
                        $arguments["post__in"] = $post_ids;
                    }elseif($post_order == "most_view"){
                        $arguments["meta_key"] = "umbrella_post_view";
                        $arguments["orderby"] = "meta_value_num";
                    }elseif($post_order == "most_liked"){
                        $arguments["meta_key"] = "um_post_likes";
                        $arguments["orderby"] = "meta_value_num";
                    }elseif($post_order == "most_commented"){
                        $arguments["orderby"] = "comment_count";
                    }
                    $the_query = new WP_Query( $arguments );
                    while ( $the_query->have_posts() ) :  $the_query->the_post();
                ?>
                <li class="<?php echo toAscii(get_field("media_type")); ?>">
                    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail("thumbnail"); ?><div class="hover-state"></div></a>
                    <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <span class="views-count"><i class="icon-eye-open"></i><?php echo get_views(false)." ".__("views","um_lang");?></span>
                    <br style="clear: both;">
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_order'] = strip_tags($new_instance['post_order']);
        $instance['number_of_posts'] = strip_tags($new_instance['number_of_posts']);
        $instance['post_ids'] = strip_tags($new_instance['post_ids']);
        return $instance;
    }

    function form($instance)
    {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : "";
        $post_order = isset($instance['post_order']) ? esc_attr($instance['post_order']) : "";
        $number_of_posts = isset($instance['number_of_posts']) ? esc_attr($instance['number_of_posts']) : "";
        $post_ids = isset($instance['post_ids']) ? esc_attr($instance['post_ids']) : "";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title',"um_lang"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_order'); ?>"><?php _e('Posts Order',"um_lang"); ?></label>
            <select id="<?php echo $this->get_field_id('post_order'); ?>" name="<?php echo $this->get_field_name('post_order'); ?>">
                <option <?php echo $post_order == "most_view" ? "selected='selected'" : ""; ?> value="most_view"><?php _e("Most Clicked","um_lang"); ?></option>
                <option <?php echo $post_order == "most_commented" ? "selected='selected'" : ""; ?> value="most_commented"><?php _e("Most Discussed","um_lang"); ?></option>
                <option <?php echo $post_order == "most_liked" ? "selected='selected'" : ""; ?> value="most_liked"><?php _e("Most Liked","um_lang"); ?></option>
                <option <?php echo $post_order == "custom" ? "selected='selected'" : ""; ?> value="custom"><?php _e("Custom Posts","um_lang"); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of posts',"um_lang"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo $number_of_posts; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('post_ids'); ?>"><?php _e('Write post IDs on a comma separated list.',"um_lang"); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('post_ids'); ?>" name="<?php echo $this->get_field_name('post_ids'); ?>" type="text" value="<?php echo $post_ids; ?>" />
        </p>
    <?php
    }
}

function umbrella_widgets_topposts() {
    register_widget('umbrella_topposts');
}
add_action('widgets_init', 'umbrella_widgets_topposts');
?>