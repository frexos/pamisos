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
<?php /*Template Name:Home Masonry*/ ?>
<?php get_header(); ?>
	<div id="inner-content">
        <div class="hero">

            <?php putRevSlider('homepage_slider', 'homepage'); ?>
        </div>
		<div class="pam-home-moto featured-section white-top">
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
				<div class="row">
                    <div class="span8">
                        <h1>Παρελθόν και Παρόν</h1>
                        <h4>από τη φωτο-συλλογή μας</h4>
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
//                                    $arguments["posts_per_page"] = 4;
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
                            </div>
                        <br style="clear:both"/>
                        <div class="load-posts"><a href="<?php the_permalink(); ?>" class="load-more"><i class="icon-refresh"></i><?php _e("Load more","um_lang"); ?></a></div>
                    </div>
                    <div class="span4">
                        <h1>Τα Νέα μας</h1>
                        <div class="home-articles">
                            <?php
                            $loop = new WP_Query( array( 'post_type' => 'articles', 'ignore_sticky_posts' => 1, 'posts_per_page' => 3, 'orderby' => 'date' ) );
                            if ( $loop->have_posts() ) :
                                while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                    <div class="article-post pindex">
                                        <div class="ptitle">
                                            <h2>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo get_the_title(); ?></a>
                                            </h2>
                                        </div>
                                        <?php if ( has_excerpt() ) { ?>
                                            <div class="pexcerpt">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>