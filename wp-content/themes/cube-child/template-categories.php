<?php get_header(); ?>

<?php /* Template Name:Categories */ ?>

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
                <?php foreach (get_categories() as $cat) : ?>
                    <?php if ($cat->term_id != 1): ?>
                        <div class="categories-single__wrapper">
                            <a href="<?php echo get_category_link($cat->term_id); ?>">
                                <div class="categories__single" style="background-image: url('<?php echo z_taxonomy_image_url($cat->term_id); ?>')"></div>
                            </a>
                            <a class="cat-name" href="<?php echo get_category_link($cat->term_id); ?>">
                                <?php echo $cat->cat_name; ?>
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
			
        </div>
    </div>

<?php get_footer(); ?>