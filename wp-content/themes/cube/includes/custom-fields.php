<?php
add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
    include_once('addons/acf-repeater/repeater.php');
    include_once('addons/acf-flexible-content/flexible-content.php');
}

include_once( 'addons/acf-options-page/acf-options-page.php' );

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_author-image',
        'title' => 'Author Image',
        'fields' => array (
            array (
                'key' => 'field_51d2eb48a316e',
                'label' => 'Author Image',
                'name' => 'author_image',
                'type' => 'image',
                'instructions' => 'Upload author image.',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'ef_user',
                    'operator' => '==',
                    'value' => 'all',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_branding',
        'title' => 'Branding',
        'fields' => array (
            array (
                'key' => 'field_51e525ceb87ba',
                'label' => 'Site Logo',
                'name' => 'site_logo',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51e525dcb87bb',
                'label' => 'Site FavIco',
                'name' => 'site_favico',
                'type' => 'file',
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51e5265883f90',
                'label' => 'Google Fonts',
                'name' => 'google_fonts',
                'type' => 'select',
                'choices' => array (
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51e545178d5d2',
                'label' => 'Default Featured Image',
                'name' => 'default_featured_image',
                'type' => 'image',
                'instructions' => 'Place an image, in case any of the posts does not have a featured image.',
                'save_format' => 'object',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51e6b931cf8e0',
                'label' => 'Brand Color',
                'name' => 'brand_color',
                'type' => 'color_picker',
                'default_value' => '',
            ),
            array (
                'key' => 'field_51fa52ba262e6',
                'label' => 'Background Image',
                'name' => 'background_image',
                'type' => 'image',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51fa52cc262e7',
                'label' => 'Background Image Mode',
                'name' => 'background_image_mode',
                'type' => 'select',
                'choices' => array (
                    'bgimage' => 'Background Image',
                    'bgpattern' => 'Background Pattern',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51fa52cc262e7a',
                'label' => 'Theme Skin',
                'name' => 'theme_skin',
                'type' => 'radio',
                'choices' => array (
                    'default' => 'Default/Grey',
                    'white' => 'White',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-branding',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_contact',
        'title' => 'Contact',
        'fields' => array (
            array (
                'key' => 'field_51e537702472c',
                'label' => 'Google Map',
                'name' => 'google_map',
                'type' => 'location-field',
                'val' => 'address',
                'center' => '48.856614,2.3522219000000177',
                'zoom' => 16,
                'scrollwheel' => 1,
            ),
            array (
                'key' => 'field_51e5379f2472d',
                'label' => 'Google Map Zoom Level',
                'name' => 'google_map_zoom_level',
                'type' => 'number',
                'instructions' => 'Google Map Zoom Level',
                'default_value' => 8,
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_51e536a3c789d',
                'label' => 'Receiving Email',
                'name' => 'receiving_email',
                'type' => 'text',
                'instructions' => 'Type the e-mail address, where you want to accept e-mails from contact form',
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51e536cbc789e',
                'label' => 'Success Message',
                'name' => 'success_message',
                'type' => 'textarea',
                'instructions' => 'Type the message which will appear when users sent e-mails to you.',
                'default_value' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_51e536e5c789f',
                'label' => 'Contact Form Additional Content',
                'name' => 'contact_form_additional_content',
                'type' => 'wysiwyg',
                'instructions' => 'If you need, type some content after contact form.',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-contact.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_footer',
        'title' => 'Footer',
        'fields' => array (
            array (
                'key' => 'field_51deb43e92684',
                'label' => 'Address',
                'name' => 'address',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deb45092686',
                'label' => 'Phone',
                'name' => 'phone',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deb44792685',
                'label' => 'Email',
                'name' => 'email',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deb50ea26b8',
                'label' => 'Social Networks',
                'name' => 'social_networks',
                'type' => 'repeater',
                'instructions' => 'Click add row to add a new social network.',
                'sub_fields' => array (
                    array (
                        'key' => 'field_51deb527a26b9',
                        'label' => 'Social Network',
                        'name' => 'social_network',
                        'type' => 'select',
                        'column_width' => '',
                        'choices' => array (
                            'icon-facebook-sign' => 'Facebok',
                            'icon-google-plus-sign' => 'Google +',
                            'icon-linkedin' => 'LinkedIn',
                            'icon-pinterest-sign' => 'Pinterest',
                            'icon-dribbble' => 'Dribbble',
                            'icon-flickr' => 'Flickr',
                            'icon-tumblr' => 'Tumblr',
                            'icon-dropbox' => 'Dropbox',
                            'icon-foursquare' => 'Foursquare',
                            'icon-instagram' => 'Instagram',
                            'icon-skype' => 'Skype',
                            'icon-youtube' => 'Youtube',
                            'icon-twitter' => 'Twitter',
                            'icon-trello' => 'Trello',
                        ),
                        'default_value' => '',
                        'allow_null' => 0,
                        'multiple' => 0,
                    ),
                    array (
                        'key' => 'field_51deb633a26ba',
                        'label' => 'Social Network URL',
                        'name' => 'social_network_url',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'formatting' => 'html',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array (
                'key' => 'field_51deb6fbc784c',
                'label' => 'Footer Text',
                'name' => 'footer_text',
                'type' => 'textarea',
                'default_value' => '',
                'formatting' => 'html',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-footer',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_front-end-submission',
        'title' => 'Front End Submission',
        'fields' => array (
            array (
                'key' => 'field_51e50eab7f14c',
                'label' => 'Allow users to publish posts',
                'name' => 'allow_users_to_publish_posts',
                'type' => 'radio',
                'instructions' => 'Allow users to register and publish posts from front-end.',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Enabled',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51e50edb7f802',
                'label' => 'Allow users to register and login with Facebook',
                'name' => 'allow_users_to_register_and_login_with_facebook',
                'type' => 'radio',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Enabled',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51e50f047f803',
                'label' => 'Facebook App ID',
                'name' => 'facebook_app_id',
                'type' => 'text',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51e50edb7f802',
                            'operator' => '==',
                            'value' => 'Enabled',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51e50f16a1021',
                'label' => 'Default Users Role',
                'name' => 'default_users_role',
                'type' => 'select',
                'instructions' => 'Choose the default role of Users when they register from front-end.',
                'choices' => array (
                    'administrator' => 'Administrator',
                    'editor' => 'Editor',
                    'author' => 'Author',
                    'contributor' => 'Contributor',
                    'subscriber' => 'Subscriber',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51e50f425e654',
                'label' => 'Default Post Status',
                'name' => 'default_post_status',
                'type' => 'select',
                'instructions' => 'Choose the default post status, when they are published from front-end.',
                'choices' => array (
                    'publish' => 'Published',
                    'future' => 'Scheduled',
                    'draft' => 'Draft',
                    'pending' => 'Pending',
                    'private' => 'Private',
                    'trash' => 'Trash',
                    'auto-draft' => 'auto-draft',
                    'inherit' => 'inherit',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51e50f5e5e655',
                'label' => 'Submit Permalink Keyword',
                'name' => 'submit_permalink_keyword',
                'type' => 'text',
                'default_value' => 'submit',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51e50f7b5e656',
                'label' => 'Profile Permalink Keyword',
                'name' => 'profile_permalink_keyword',
                'type' => 'text',
                'default_value' => 'profile',
                'formatting' => 'none',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-front-end-submission',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_home-layout',
        'title' => 'Home Layout',
        'fields' => array (
            array (
                'key' => 'field_51d19470852f9',
                'label' => 'Home Layout',
                'name' => 'home_layout',
                'type' => 'flexible_content',
                'instructions' => 'Choose a layout from drop-down.',
                'layouts' => array (
                    array (
                        'label' => 'Category Full Width',
                        'name' => 'category_full_width',
                        'display' => 'row',
                        'sub_fields' => array (
                            array (
                                'key' => 'field_51d198e2f34f0',
                                'label' => 'Category',
                                'name' => 'category',
                                'type' => 'select',
                                'column_width' => '',
                                'choices' => array (
                                    '' => '---',
                                    27 => '. integer at lor',
                                    12 => 'Audio',
                                    16 => 'Magazine',
                                    25 => 'Rock And Roll',
                                    1 => 'Uncategorized',
                                    3 => 'Video',
                                ),
                                'default_value' => '',
                                'allow_null' => 0,
                                'multiple' => 0,
                            ),
                            array (
                                'key' => 'field_51e5379f2472d1',
                                'label' => 'Number of posts',
                                'name' => 'number_of_posts',
                                'type' => 'number',
                                'instructions' => '',
                                'default_value' => 3,
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                        ),
                    ),
                    array (
                        'label' => 'Category Half Width',
                        'name' => 'category_half_width',
                        'display' => 'row',
                        'sub_fields' => array (
                            array (
                                'key' => 'field_51d198bef34ee',
                                'label' => 'Category',
                                'name' => 'category',
                                'type' => 'select',
                                'column_width' => '',
                                'choices' => array (
                                    '' => '---',
                                    27 => '. integer at lor',
                                    12 => 'Audio',
                                    16 => 'Magazine',
                                    25 => 'Rock And Roll',
                                    1 => 'Uncategorized',
                                    3 => 'Video',
                                ),
                                'default_value' => '',
                                'allow_null' => 0,
                                'multiple' => 0,
                            ),
                            array (
                                'key' => 'field_51e5379f2472d2',
                                'label' => 'Number of posts',
                                'name' => 'number_of_posts',
                                'type' => 'number',
                                'instructions' => '',
                                'default_value' => 3,
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                            array (
                                'key' => 'field_51d198cdf34ef',
                                'label' => 'Category 2',
                                'name' => 'category_2',
                                'type' => 'select',
                                'column_width' => '',
                                'choices' => array (
                                    '' => '---',
                                    27 => '. integer at lor',
                                    12 => 'Audio',
                                    16 => 'Magazine',
                                    25 => 'Rock And Roll',
                                    1 => 'Uncategorized',
                                    3 => 'Video',
                                ),
                                'default_value' => '',
                                'allow_null' => 0,
                                'multiple' => 0,
                            ),
                            array (
                                'key' => 'field_51e5379f2472d3',
                                'label' => 'Number of posts',
                                'name' => 'number_of_posts2',
                                'type' => 'number',
                                'instructions' => '',
                                'default_value' => 3,
                                'min' => '',
                                'max' => '',
                                'step' => '',
                            ),
                        ),
                    ),
                    array (
                        'label' => 'Plain HTML Full Width',
                        'name' => 'plain_html_full_width',
                        'display' => 'row',
                        'sub_fields' => array (
                            array (
                                'key' => 'field_51d19652653c6',
                                'label' => 'HTML Markup',
                                'name' => 'html_markup',
                                'type' => 'textarea',
                                'column_width' => '',
                                'default_value' => '',
                                'formatting' => 'html',
                            ),
                        ),
                    ),
                    array (
                        'label' => 'Plain HTML Half Width',
                        'name' => 'plain_html_half_width',
                        'display' => 'row',
                        'sub_fields' => array (
                            array (
                                'key' => 'field_51d19901f34f2',
                                'label' => 'HTML Markup',
                                'name' => 'html_markup',
                                'type' => 'textarea',
                                'column_width' => '',
                                'default_value' => '',
                                'formatting' => 'html',
                            ),
                            array (
                                'key' => 'field_51d19914f34f3',
                                'label' => 'HTML Markup 2',
                                'name' => 'html_markup_2',
                                'type' => 'textarea',
                                'column_width' => '',
                                'default_value' => '',
                                'formatting' => 'html',
                            ),
                        ),
                    ),
                ),
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-slider.php',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-revolution.php',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-slider-2.php',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_home-masonry',
        'title' => 'Home Masonry',
        'fields' => array (
            array (
                'key' => 'field_51d6c69768b42',
                'label' => 'Heading Page',
                'name' => 'heading_page',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51d6c69f68b43',
                'label' => 'Page Description',
                'name' => 'page_description',
                'type' => 'textarea',
                'default_value' => '',
                'formatting' => 'br',
            ),
            array (
                'key' => 'field_51d6c71c004d8',
                'label' => 'Exclude Categories',
                'name' => 'exclude_categories',
                'type' => 'text',
                'instructions' => 'Type category Slug\'s on a comma separated list. eg: video,audio',
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51d6c72b004d9',
                'label' => 'Include Only Those Categories',
                'name' => 'include_only_those_categories',
                'type' => 'text',
                'instructions' => 'Type category Slug\'s on a comma separated list. eg: video,audio',
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51d6c73a004da',
                'label' => 'Exclude Posts',
                'name' => 'exclude_posts',
                'type' => 'relationship',
                'instructions' => 'Exclude these posts from popular posts.',
                'post_type' => array (
                    0 => 'post',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => '',
            ),
            array (
                'key' => 'field_51d6c74e004db',
                'label' => 'Number of posts',
                'name' => 'number_of_posts',
                'type' => 'number',
                'default_value' => 9,
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_51d6c8d6004dc',
                'label' => 'Order By:',
                'name' => 'order_by',
                'type' => 'select',
                'instructions' => 'Choose posts, order.',
                'choices' => array (
                    'date' => 'Date',
                    'comment_count' => 'Number of comments',
                    'post_view' => 'Post views',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-masonry.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_main',
        'title' => 'Main',
        'fields' => array (
            array (
                'key' => 'field_51e50b69f1ac3',
                'label' => 'Custom CSS',
                'name' => 'custom_css',
                'type' => 'textarea',
                'instructions' => 'Place CSS in this field but don\'t include the Style Tags.',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51e50b85f1ac4',
                'label' => 'Custom Javascript',
                'name' => 'custom_javascript',
                'type' => 'textarea',
                'instructions' => 'Place custom Javascript here but don\'t include Script tags.You can paste Google Analytics also here but without Script Tags.',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51e50bd0f1ac5',
                'label' => 'Search Autocomplete',
                'name' => 'search_autocomplete',
                'type' => 'radio',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51e50bd0f1ac5umb',
                'label' => 'Video Autoplay',
                'name' => 'video_autoplay',
                'type' => 'radio',
                'choices' => array (
                    'Disabled' => 'Disabled',
                    'Enabled' => 'Enabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51e0014cb84f8',
                'label' => 'Comments Type',
                'name' => 'comments_type',
                'type' => 'select',
                'instructions' => 'Select comments type',
                'choices' => array (
                    'Default' => 'Default',
                    'Facebook' => 'Facebook',
                    'Disqus' => 'Disqus',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51e003e3d27f5',
                'label' => 'Disqus Shortname',
                'name' => 'disqus_shortname',
                'type' => 'text',
                'instructions' => 'Place the Disqus short-name from your Disqus account.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51e0014cb84f8',
                            'operator' => '==',
                            'value' => 'Disqus',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51f8fbe724735',
                'label' => 'Post Views',
                'name' => 'post_views',
                'type' => 'radio',
                'instructions' => 'Enable or Disable post views.',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Enabled',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51f8fc0324736',
                'label' => 'Post Likes',
                'name' => 'post_likes',
                'type' => 'radio',
                'instructions' => 'Enable or Disable post likes.',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Enabled',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51fa3dd12201e',
                'label' => 'Sharethis Markup',
                'name' => 'sharethis_markup',
                'type' => 'textarea',
                'instructions' => 'Create a <a href="http://sharethis.com/">Sharethis</a> code, as a Website not WordPress, and paste the Markup on this field.',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51f8fc0324738',
                'label' => 'Site Layout',
                'name' => 'site_layout',
                'type' => 'radio',
                'instructions' => 'Choose the site layout',
                'choices' => array (
                    'Wide' => 'Wide',
                    'Boxed' => 'Boxed',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Wide',
                'layout' => 'vertical',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-main',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));

    register_field_group(array (
        'id' => 'acf_media',
        'title' => 'Media',
        'fields' => array (
            array (
                'key' => 'field_51d16b81fc76d',
                'label' => 'Featured',
                'name' => 'featured',
                'type' => 'true_false',
                'message' => 'Featured',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_51cd735e99615',
                'label' => 'Media Type',
                'name' => 'media_type',
                'type' => 'select',
                'instructions' => 'Select the media type.',
                'choices' => array (
                    'Magazine' => 'Magazine',
                    'Video' => 'Video',
                    'Audio' => 'Audio',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51dd5e6804e14',
                'label' => 'Magazine Gallery',
                'name' => 'magazine_gallery',
                'type' => 'repeater',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Magazine',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'sub_fields' => array (
                    array (
                        'key' => 'field_51dd5e7504e15',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'column_width' => '',
                        'save_format' => 'object',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array (
                'key' => 'field_51cd737d99616',
                'label' => 'Video Type',
                'name' => 'video_type',
                'type' => 'select',
                'instructions' => 'Select the video type.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Video',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array (
                    'Vimeo/Youtube' => 'Vimeo/Youtube',
                    'Self Hosted' => 'Self Hosted',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51cd73bbd5afe',
                'label' => 'Video URL',
                'name' => 'video_url',
                'type' => 'text',
                'instructions' => 'Type the video URL from Vimeo or Youtube.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Video',
                        ),
                        array (
                            'field' => 'field_51cd737d99616',
                            'operator' => '==',
                            'value' => 'Vimeo/Youtube',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51cd73d2d5aff',
                'label' => 'Video MP4',
                'name' => 'video_mp4',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Video',
                        ),
                        array (
                            'field' => 'field_51cd737d99616',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51cd73f3d5b00',
                'label' => 'Video WebM/VP8',
                'name' => 'video_webm/vp8',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Video',
                        ),
                        array (
                            'field' => 'field_51cd737d99616',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51cd7403d5b01',
                'label' => 'Video Ogg/Vorbis',
                'name' => 'video_ogg/vorbis',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Video',
                        ),
                        array (
                            'field' => 'field_51cd737d99616',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51cd742354804',
                'label' => 'Audio Type',
                'name' => 'audio_type',
                'type' => 'select',
                'instructions' => 'Choose the audio type.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Audio',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array (
                    'SoundCloud' => 'SoundCloud',
                    'Self Hosted' => 'Self Hosted',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51cd743b54805',
                'label' => 'SoundCloud',
                'name' => 'soundcloud',
                'type' => 'text',
                'instructions' => 'Enter the sound cloud Widget code.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Audio',
                        ),
                        array (
                            'field' => 'field_51cd742354804',
                            'operator' => '==',
                            'value' => 'SoundCloud',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51cd745854806',
                'label' => 'Audio File MP3',
                'name' => 'audio_file_mp3',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Audio',
                        ),
                        array (
                            'field' => 'field_51cd742354804',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51cd746a54807',
                'label' => 'Audio File Ogg',
                'name' => 'audio_file_ogg',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Audio',
                        ),
                        array (
                            'field' => 'field_51cd742354804',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51cd747954808',
                'label' => 'Audio File Wav',
                'name' => 'audio_file_wav',
                'type' => 'file',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51cd735e99615',
                            'operator' => '==',
                            'value' => 'Audio',
                        ),
                        array (
                            'field' => 'field_51cd742354804',
                            'operator' => '==',
                            'value' => 'Self Hosted',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'save_format' => 'url',
                'library' => 'all',
            ),
            array (
                'key' => 'field_51dd44126dae3',
                'label' => 'Reviews',
                'name' => 'reviews',
                'type' => 'repeater',
                'instructions' => 'Click add row, to add a new review for this media.',
                'sub_fields' => array (
                    array (
                        'key' => 'field_51dd44356dae4',
                        'label' => 'Review Title',
                        'name' => 'review_title',
                        'type' => 'text',
                        'column_width' => 75,
                        'default_value' => '',
                        'formatting' => 'html',
                    ),
                    array (
                        'key' => 'field_51dd443c6dae5',
                        'label' => 'Rating (Number)',
                        'name' => 'rating',
                        'type' => 'number',
                        'column_width' => '',
                        'default_value' => '',
                        'min' => '',
                        'max' => '',
                        'step' => '',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_popular-featured',
        'title' => 'Popular + Featured',
        'fields' => array (
            array (
                'key' => 'field_51d16807ab750',
                'label' => 'Popular',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_51d16811ab751',
                'label' => 'Exclude Categories',
                'name' => 'exclude_categories',
                'type' => 'text',
                'instructions' => 'Type category Slug\'s on a comma separated list. eg: video,audio',
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51d1683cab752',
                'label' => 'Include Only Those Categories',
                'name' => 'include_only_those_categories',
                'type' => 'text',
                'instructions' => 'Type category Slug\'s on a comma separated list. eg: video,audio',
                'default_value' => '',
                'formatting' => 'none',
            ),
            array (
                'key' => 'field_51d16861ab753',
                'label' => 'Exclude Posts',
                'name' => 'exclude_posts',
                'type' => 'relationship',
                'instructions' => 'Exclude these posts from popular posts.',
                'post_type' => array (
                    0 => 'post',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => '',
            ),
            array (
                'key' => 'field_51d1687fab754',
                'label' => 'Number of posts',
                'name' => 'number_of_posts',
                'type' => 'number',
                'instructions' => 'Number of popular posts on home',
                'default_value' => 4,
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_51d16b0075922',
                'label' => 'Featured',
                'name' => '',
                'type' => 'tab',
            ),
            array (
                'key' => 'field_51d16b1675923',
                'label' => 'Featured Control',
                'name' => 'featured_control',
                'type' => 'select',
                'instructions' => 'Select how you want to get featured posts.If automatic all posts with Featured Checkbox will be display on this section.',
                'choices' => array (
                    'Manual' => 'Manual',
                    'Automatic' => 'Automatic',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
            array (
                'key' => 'field_51d16b3675924',
                'label' => 'Featured Posts',
                'name' => 'featured_posts',
                'type' => 'relationship',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51d16b1675923',
                            'operator' => '==',
                            'value' => 'Manual',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'post_type' => array (
                    0 => 'post',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => '',
            ),
            array (
                'key' => 'field_51d17d6b5387e',
                'label' => 'Number Of posts',
                'name' => 'number_of_posts_featured',
                'type' => 'number',
                'default_value' => 4,
                'min' => '',
                'max' => '',
                'step' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_related-posts',
        'title' => 'Related Posts',
        'fields' => array (
            array (
                'key' => 'field_51cd7e0a194de',
                'label' => 'Related Media',
                'name' => 'related_media',
                'type' => 'relationship',
                'instructions' => 'Choose related media\'s according to this one, otherwise if you leave this blank the system will try to generate related media\'s by it\'s self.',
                'post_type' => array (
                    0 => 'post',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_revolution-slider',
        'title' => 'Revolution Slider',
        'fields' => array (
            array (
                'key' => 'field_51e3f02ba4259',
                'label' => 'Revolution Slider Alias',
                'name' => 'revolution_slider_alias',
                'type' => 'textarea',
                'instructions' => 'Type the Revolution Slider alias here.',
                'default_value' => '',
                'formatting' => 'html',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-revolution.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_sidebar',
        'title' => 'Sidebar',
        'fields' => array (
            array (
                'key' => 'field_51dc0cb6b6243',
                'label' => 'Sidebar',
                'name' => 'sidebar',
                'type' => 'select',
                'instructions' => 'Choose a side-bar, or leave blank to use the default one.',
                'choices' => array (
                    '' => '--',
                    'default-sidebar' => 'Default Sidebar',
                    'sidebar-one' => 'Sidebar One',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'category',
                    'order_no' => 0,
                    'group_no' => 1,
                ),
            ),
            array (
                array (
                    'param' => 'ef_taxonomy',
                    'operator' => '==',
                    'value' => 'post_tag',
                    'order_no' => 0,
                    'group_no' => 2,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home.php',
                    'order_no' => 0,
                    'group_no' => 3,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'default',
                    'order_no' => 0,
                    'group_no' => 4,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-slider.php',
                    'order_no' => 0,
                    'group_no' => 5,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-revolution.php',
                    'order_no' => 0,
                    'group_no' => 6,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_sidebars',
        'title' => 'Sidebars',
        'fields' => array (
            array (
                'key' => 'field_51dc0a711df6d',
                'label' => 'Sidebars',
                'name' => 'sidebars',
                'type' => 'repeater',
                'instructions' => 'Click Add Row to add a new Sidebar.Add as many sidebars as you want.',
                'sub_fields' => array (
                    array (
                        'key' => 'field_51dc0a8b1df6e',
                        'label' => 'Sidebar',
                        'name' => 'sidebar',
                        'type' => 'text',
                        'column_width' => '',
                        'default_value' => '',
                        'formatting' => 'html',
                    ),
                ),
                'row_min' => 0,
                'row_limit' => '',
                'layout' => 'table',
                'button_label' => 'Add Row',
            ),
            array (
                'key' => 'field_51dc0ab01250a',
                'label' => 'Blog Posts Sidebar',
                'name' => 'blog_posts_sidebar',
                'type' => 'select',
                'instructions' => 'Choose the blog posts sidebar.',
                'choices' => array (
                    '' => '--',
                    'default-sidebar' => 'Default Sidebar',
                    'sidebar-one' => 'Sidebar One',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-sidebars',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_slider',
        'title' => 'Slider',
        'fields' => array (
            array (
                'key' => 'field_51dbffe1b17b1',
                'label' => 'Slider Posts Logic',
                'name' => 'slider_posts_logic',
                'type' => 'radio',
                'instructions' => 'Choose the way how posts will be queried on slider.',
                'choices' => array (
                    'Latest' => 'Latest',
                    'Popular' => 'Popular',
                    'Featured' => 'Featured',
                    'Manual' => 'Manual',
                    'Category' => 'Category',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'Latest',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51dc00551fee0',
                'label' => 'Slider Posts',
                'name' => 'slider_posts',
                'type' => 'relationship',
                'instructions' => 'Click posts which you want to display.',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51dbffe1b17b1',
                            'operator' => '==',
                            'value' => 'Manual',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'post_type' => array (
                    0 => 'post',
                ),
                'taxonomy' => array (
                    0 => 'all',
                ),
                'filters' => array (
                    0 => 'search',
                ),
                'result_elements' => array (
                    0 => 'post_type',
                    1 => 'post_title',
                ),
                'max' => 5,
            ),
            array (
                'key' => 'field_51dc00b6cae2c',
                'label' => 'Category',
                'name' => 'slider_category',
                'type' => 'select',
                'conditional_logic' => array (
                    'status' => 1,
                    'rules' => array (
                        array (
                            'field' => 'field_51dbffe1b17b1',
                            'operator' => '==',
                            'value' => 'Category',
                        ),
                    ),
                    'allorany' => 'all',
                ),
                'choices' => array (
                    '' => '---',
                    27 => '. integer at lor',
                    12 => 'Audio',
                    16 => 'Magazine',
                    25 => 'Rock And Roll',
                    1 => 'Uncategorized',
                    3 => 'Video',
                ),
                'default_value' => '',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-slider.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
            array (
                array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'template-home-slider-2.php',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'the_content',
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_twitter',
        'title' => 'Twitter',
        'fields' => array (
            array (
                'key' => 'field_51dea4fffeb2a',
                'label' => 'Enable Or Disable Twitter Feed',
                'name' => 'enable_or_disable_twitter_feed',
                'type' => 'radio',
                'choices' => array (
                    'Enabled' => 'Enabled',
                    'Disabled' => 'Disabled',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => '',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_51deac3cb5e31',
                'label' => 'Twitter Username',
                'name' => 'twitter_username',
                'type' => 'text',
                'instructions' => 'Enter twitter username without @ character',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deac08b5e2d',
                'label' => 'Number of Tweets',
                'name' => 'number_of_tweets',
                'type' => 'number',
                'default_value' => 6,
                'min' => '',
                'max' => '',
                'step' => '',
            ),
            array (
                'key' => 'field_51deac19b5e2e',
                'label' => 'Exclude Replies',
                'name' => 'exclude_replies',
                'type' => 'true_false',
                'message' => '',
                'default_value' => 0,
            ),
            array (
                'key' => 'field_51deac29b5e2f',
                'label' => 'Consumer Key',
                'name' => 'consumer_key',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deac2fb5e30',
                'label' => 'Consumer Secret',
                'name' => 'consumer_secret',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deac49b5e32',
                'label' => 'User Token',
                'name' => 'user_token',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
            array (
                'key' => 'field_51deac50b5e33',
                'label' => 'User Secret',
                'name' => 'user_secret',
                'type' => 'text',
                'default_value' => '',
                'formatting' => 'html',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-twitter',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}

?>