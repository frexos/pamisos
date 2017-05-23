<div id="footer">
    <div class="top-footer">
        <?php if(get_field("enable_or_disable_twitter_feed","options") == "Enabled"): ?>
        <div class="twitter-widget container">
            <div class="row">
                <div class="span12">
                    <a href="http://twitter.com/<?php the_field("twitter_username","options"); ?>"><i class="icon-twitter"></i></a>
                    <div class="tweets">

                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="mid-footer">
        <div class="contact-widgets container">
            <div class="row">
                <?php if( get_field("address","options") || get_field("phone","options") || get_field("email","options")): ?>
                <div class="contact-info span6">
                    <?php if(get_field("address","options")): ?>
                        <p class="location"><i class="icon-home"></i><?php the_field("address","options"); ?></p>
                    <?php endif; ?>
                    <?php if(get_field("phone","options")): ?>
                        <p class="phone"><i class="icon-phone-sign"></i><?php the_field("phone","options"); ?></p>
                    <?php endif; ?>
                    <?php if(get_field("email","options")): ?>
                        <p class="email"><i class="icon-envelope-alt"></i><?php the_field("email","options"); ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if(get_field("social_networks","options")): ?>
                <div class="social-links span6">
                    <p><?php _e("Follow us:","um_lang"); ?>
                    <ul>
                        <?php while(has_sub_field("social_networks","options")): ?>
                            <li><a target="_blank" href="<?php the_sub_field("social_network_url"); ?>"><i class="<?php the_sub_field("social_network"); ?>"></i></a></li>
                        <?php endwhile; ?>
                    </ul>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
    	<div class="container">
    		<div class="row">
    			<h5 class="span12"><?php the_field("footer_text","options"); ?></h5><br style="clear:both;">
    			<a href="#" class="to_top"><i class="icon-chevron-up"></i></a>
    		</div>
    	</div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>