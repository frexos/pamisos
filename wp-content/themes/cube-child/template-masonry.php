<?php
if(isset($_POST["um_paged"]) && $_POST["um_paged"]){

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
    /*Order Portion*/
    $order = get_field("order_by");
    if($order == "comment_count"){
        $arguments["orderby"] = "comment_count";
    }elseif($order == "post_view"){
        $arguments["orderby"] = "meta_value_num";
        $arguments["meta_key"] = "umbrella_post_view";
    }
    $arguments["paged"] = $_POST["um_paged"];
    /*Order Portion*/
    $the_query = new WP_Query( $arguments );
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        get_template_part("content","post-masonry");
    }
    wp_reset_postdata();
    /*List Posts*/
    die;
}
?>
<?php /*Template Name:Masonry*/ ?>
<?php get_header(); ?>
	<div id="inner-content">
		<div class="featured-section white-top">
			<div class="feat-pop-posts container">
				<div class="row">
					<div class="home-type span12">
                        <?php if(get_field("heading_page")): ?>
						    <h3><?php the_field("heading_page"); ?></h3>
                        <?php endif; ?>
                        <?php if(get_field("page_description")): ?>
						    <p><?php the_field("page_description"); ?></p>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="main-section">
			<div class="home-one container">
                <h4 style="margin: 20px 0; width: 100%;">Αναζήτηση Φωτογραφίας</h4>
                <?php echo do_shortcode('[searchandfilter taxonomies="search,category,post_tag" post_types="post"]'); ?>
				<div class="row">
                    <div class="page-posts masonry">
                    <?php
                        /*List Posts*/
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
                        /*Order Portion*/
                        $order = get_field("order_by");
                        if($order == "comment_count"){
                            $arguments["orderby"] = "comment_count";
                        }elseif($order == "post_view"){
                            $arguments["orderby"] = "meta_value_num";
                            $arguments["meta_key"] = "umbrella_post_view";
                        }
                        /*Order Portion*/
                        $the_query = new WP_Query( $arguments );
                        while ( $the_query->have_posts() ){
                        $the_query->the_post();
                        get_template_part("content","post-masonry");
                    }
                    wp_reset_postdata();
                        /*List Posts*/
                    ?>
                    </div>
                    <br style="clear:both"/>
					<div class="load-posts"><a href="<?php the_permalink(); ?>" class="load-more"><i class="icon-refresh"></i><?php _e("Load more","um_lang"); ?></a></div>
				</div>
			</div>	
		</div>
	</div>
<?php get_footer(); ?>