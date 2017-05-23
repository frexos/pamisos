<?php get_header(); ?>
<div class="category-page">
	<div class="category-top">
		<div class="container">
			<div class="row">
				<div class="span4">
					<h5><i class="icon-file-text-alt"></i><?php wp_title(""); ?></h5>
				</div>
				<div class="span8 bread-crumb">
					<p><?php _e("You are here:","um_lang"); ?></p>
					<ul>
                        <?php display_breadcrumbs(); ?>
                    </ul>
				</div>
			</div>
		</div>
	</div>
	<div class="main-section">
			<div class="cat-one container">
				<div class="row">
					<div class="span8">
						<div class="category-row row one">
							<div class="span8 category">
								<div class="row category-posts-list">
									<?php while ( $wp_query->have_posts() ): $wp_query->the_post(); ?>
	                                    <?php get_template_part("content","home-post"); ?>
	                                <?php endwhile; ?>
								</div>
							</div>
						</div>
						<div class="pagination">
                            <?php
                            $slug = get_query_var("pagename");
                            $permalink = rtrim(get_permalink( get_page_by_path( $slug ) ),'/');
                            $format = $wp_rewrite->using_permalinks() ? $permalink."/page/%#%" : '?paged=%#%';
                            $big = 999999999; // need an unlikely integer
                            echo paginate_links( array(
                                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                'format' => $format,
                                'current' => max( 1, get_query_var('paged') ),
                                'total' => $wp_query->max_num_pages,
                                'prev_next'    => FALSE
                            ) );
                            ?>
						</div>
					</div>
					<div class="cat-sidebar span4">
                        <?php
                            $queried_object = get_queried_object();
                            if(isset($queried_object)){
								$taxonomy = $queried_object->taxonomy;
								$term_id = $queried_object->term_id;
	                            $sidebar = get_field('sidebar', $taxonomy . '_' . $term_id);
                    		
                            if(is_dynamic_sidebar($sidebar) && $sidebar){
                                dynamic_sidebar($sidebar);
                            }else{
                                dynamic_sidebar("default-sidebar");
                            }
                        }
                        ?>
					</div>
				</div>
			</div>
		</div>
</div>

<?php get_footer(); ?>