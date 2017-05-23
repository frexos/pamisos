<?php if ('open' == $post->comment_status) : ?>
<div class="post-comments">
    <a href="#" class="show-hide-comments">
        <?php _e("Show Comments","um_lang"); ?>
        <i class="icon-comments-alt"></i>
    </a>
    <div class="comments-fb">
        <?php if(get_field("comments_type","options") == "Default"): ?>
        <div class="comments-list">
            <?php
            global $post;
            $comments = get_comments(array(
                'post_id' => $post->ID,
                'status' => 'approve'
            ));
            wp_list_comments(array(),$comments);
            ?>
            <div class="comments_navigation">
                <?php paginate_comments_links(); ?>
            </div>
        </div>
        <div class="comment-form">
            <?php comment_form(); ?>
        </div>
        <?php elseif(get_field("comments_type","options") == "Facebook"): ?>
            <div class="comments-list">
                <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="700" data-num-posts="10"></div>
            </div>
        <?php elseif(get_field("comments_type","options") == "Disqus"): ?>
            <div class="comments-list">
                <div id="disqus_thread"></div>
                <script type="text/javascript">
                    //<![CDATA[
                    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                    var disqus_shortname = '<?php the_field("disqus_shortname","options"); ?>'; // required: replace example with your forum shortname

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                    //]]>
                </script>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>