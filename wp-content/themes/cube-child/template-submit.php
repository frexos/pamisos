<?php
$GLOBALS['jqueryuii'] = true;

require_once "wp-admin/includes/template.php";
if(!$GLOBALS["allow_users_to_publish"] && !is_user_logged_in()){
    wp_redirect(site_url());
    die;
}
$curent_post_id = get_query_var("umpostid");
if($curent_post_id && !current_user_can('edit_post', $curent_post_id)){
    wp_die(__("You don't have permissions to edit this post!!","um_lang"));
}
if(isset($_GET["delete"]) && $_GET["delete"]){
    if($curent_post_id && !current_user_can('delete_post', $curent_post_id)){
        wp_die(__("You don't have permissions to delete this post!!","um_lang"));
    }else{
        wp_delete_post($curent_post_id);
        wp_redirect(site_url()."/".$GLOBALS["um_profile"]);
    }
}

acf_form_head();
get_header();
the_post();
?>

    <div class="add-post-top">
        <div class="container">
            <div class="row">
                <div class="span12"><h5><i class="icon-file-alt"></i><?php echo $curent_post_id ? __("Επεξεργασία","um_lang") : __("Προσθήκη Νέας Φωτογραφίας","um_lang"); ?></h5></div>
            </div>
        </div>
    </div>
    <div class="post-add-box">
        <div class="container">
            <div class="row">
                <div class="add-box span12">
                    <!--Edit Post-->
                    <?php
                    if($curent_post_id && current_user_can('edit_post', $curent_post_id)) :
                        $post = get_post($curent_post_id);
                        setup_postdata($post);
                        ?>
                        <div class="wp-in">
                            <?php ob_start(); ?>
                            <input type="text" name="title" value="<?php the_title(); ?>"  id="title" placeholder="<?php _e("Title","um_lang"); ?>"/>
                            <?php wp_editor( get_the_content() , 'post_content' ); ?>
                            <?php
                            $terms = wp_get_post_terms( $post->ID,"category" );
                            $terms = isset($terms[0]) ? $terms[0]->term_id : "";
                            ?>

                            <?php //wp_dropdown_categories( array( 'taxonomy' => 'category' , 'hierarchical'=>1 , 'show_option_none'=>__('Choose Category:','um_lang') , 'name' => 'post_category' ,'selected' => $terms ) ); ?>
                            <p><?php _e("Choose Post Category:","um_lang"); ?></p>
                            <?php
                            wp_terms_checklist($post->ID,array(
                                "descendants_and_self" => false,
                                "checked_ontop" => false
                            ));
                            ?>

                            <?php
                            $tags = wp_get_post_tags( $post->ID, array("fields"=>"names") );
                            $tags = implode(",",$tags);
                            ?>

                            <textarea name="post_tags" id="" cols="30" rows="10" placeholder="<?php _e("Enter media tags, seperate them with comma","um_lang"); ?> (,)"><?php echo $tags; ?></textarea>
                            <?php $post_thumb = get_post_thumbnail_id($post->ID); ?>
                            <div class="acf-image-uploader clearfix <?php echo has_post_thumbnail() ? "active" : ""; ?>" data-preview_size="thumbnail" data-library="all">
                                <input class="acf-image-value" type="hidden" name="featured_image" value="<?php echo $post_thumb; ?>">
                                <div class="has-image">
                                    <div class="hover">
                                        <ul class="bl">
                                            <li><a class="acf-button-delete ir" href="#"><?php _e("Remove","um_lang"); ?></a></li>
                                            <li><a class="acf-button-edit ir" href="#"><?php _e("Edit","um_lang"); ?></a></li>
                                        </ul>
                                    </div>
                                    <?php if(has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail("thumbnail"); ?>
                                    <?php else: ?>
                                        <img class="acf-image-image" src="" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="no-image">
                                    <p><?php _e("Choose Featured Image","um_lang"); ?> <input type="button" class="button add-image" value="<?php _e("Add Image","um_lang"); ?>">
                                    </p></div>
                            </div>
                            <?php $form = ob_get_clean(); ?>

                            <?php
                            $args = array(
                                'post_id' => $post->ID,
                                'field_groups' => array( "acf_media","acf_related-posts" ),
                                'html_before_fields' => $form,
                                'submit_value' => __("Update","um_lang"),
                                'return' => site_url()."/".$GLOBALS["um_profile"]
                            );

                            acf_form( $args );
                            ?>
                        </div>
                        <!--Edit Post-->
                    <?php else: ?>
                        <!--Insert Post-->
                        <div class="wp-in">
                            <?php ob_start(); ?>
                            <h3>Τίτλος Φωτογραφίας</h3>
                            <input type="text" name="title" id="title" placeholder="<?php _e("Title","um_lang"); ?>"/>

                            <div class="acf-image-uploader clearfix " data-preview_size="thumbnail" data-library="all">
                                <input class="acf-image-value" type="hidden" name="featured_image" value="">
                                <div class="has-image">
                                    <div class="hover">
                                        <ul class="bl">
                                            <li><a class="acf-button-delete ir" href="#"><?php _e("Remove","um_lang"); ?></a></li>
                                            <li><a class="acf-button-edit ir" href="#"><?php _e("Edit","um_lang"); ?></a></li>
                                        </ul>
                                    </div>
                                    <img class="acf-image-image" src="" alt="">
                                </div>
                                <div class="no-image">
                                    <h3>Επιλέξτε Φωτογραφία</h3>
<!--                                    <p>-->
                                    <input type="button" class="button add-image" value="<?php _e("Add Image","um_lang"); ?>">
<!--                                    </p>-->
                                </div>
                            </div>


                            <?php
                            echo("<h3>Στοιχεία Φωτογραφίας και Περιγραφή</h3>");
                            $editorSettings = array(
                                    'media_buttons' => false,
                                    "editor_height" => 100);
                            wp_editor( '' , 'post_content', $editorSettings );
                            ?>

                            <?php //wp_dropdown_categories( array( 'taxonomy' => 'category' , 'hierarchical'=>1 , 'show_option_none'=>__('Choose Category:','um_lang') , 'name' => 'post_category' ) ); ?>
<!--                            <p>--><?php //_e("Choose Post Category:","um_lang"); ?><!--</p>-->
                            <?php echo("<div class='select-category'>")?>
<!--                            <p>--><?php //_e("Choose Post Category:","um_lang"); ?><!--</p>-->

                            <h3>Επιλέξτε Κατηγορία</h3>
                            <?php
                            wp_terms_checklist(array(
                                "descendants_and_self" => false,
                                "checked_ontop" => false
                            ));
                            ?>
                            <?php echo("</div>")?>
                            <h3>Εισάγετε Λέξεις Κλειδιά</h3>
                            <textarea name="post_tags" id="" cols="30" rows="10" placeholder="Λέξεις Κλειδιά χωρισμένες με κόμμα"></textarea>

                            <a class="btn-pending">ΑΝΕΒΑΣΜΑ</a>

                        </div>
                        <!--Insert Post-->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-pending">
        <h3>Η φωτογραφία σας έχει ανέβει και θα δημοσιοποιηθεί μόλις εγκριθεί, το συντομότερο δυνατό. Ευχαριστούμε</h3>
        <div class="submit-new">
            <?php $form = ob_get_clean(); ?>

            <?php
            $args = array(
                'post_id' => 'new',
                'field_groups' => array( "acf_media","acf_related-posts" ),
                'html_before_fields' => $form,
                'submit_value' => __("ΕΝΤΑΞΕΙ","um_lang"),
                'return' => site_url()."/".$GLOBALS["um_profile"]
            );

            acf_form( $args );
            ?>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function($){
            var myInput = document.getElementById("title");

            $(".btn-pending").on("click",function(){
                console.log('show popup');

                if (!myInput || !myInput.value) {
                    $('.popup-pending').html('<h3>Παρακαλώ συμπληρώστε τον τίτλο της φωτογραφίας</h3><div class="submit-new"><input type="submit" value="ΕΝΤΑΞΕΙ"/></div>');

                    $(".submit-new input").on("click",function(){
                        $("html").removeClass("has-popup");
                    });

                }

                $("html").addClass("has-popup");
            });

            $(".submit-new input").on("click",function(){
                $("html").removeClass("has-popup");
            });
        });
    </script>

<?php get_footer(); ?>