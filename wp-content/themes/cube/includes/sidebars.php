<?php
add_action('init', 'um_dynamicsidebars');

function um_dynamicsidebars(){
    register_sidebar(array(
        'name' => __( 'Default Sidebar' , 'um_lang'),
        'id' => 'default-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title"><span>',
        'after_title' => '</span></h5>',
    ));

    if(!isACFActive()){
        $sidebars = get_field("sidebars","options");
    }
    if($sidebars){
        foreach($sidebars as $sidebar){
            $sidebar_name = toAscii($sidebar["sidebar"]);
            if($sidebar_name){
                register_sidebar(array(
                    'name' => $sidebar["sidebar"],
                    'id' => $sidebar_name,
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h5 class="widget-title"><span>',
                    'after_title' => '</span></h5>',
                ));
            }
        }
    }
}

function my_acf_load_field_sidebars( $field ){
    // reset choices
    $field['choices'] = array();
    $field['choices'][''] = "--";
    $field['choices']['default-sidebar'] = __("Default Sidebar","um_lang");

    $sidebars = get_field("sidebars","options");
    if($sidebars){
        foreach($sidebars as $sidebar){
            $sidebar_name = toAscii($sidebar["sidebar"]);
            if($sidebar_name){
                $field['choices'][$sidebar_name] = $sidebar["sidebar"];
            }
        }
    }
    // Important: return the field
    return $field;
}
add_action('acf/load_field/key=field_51dc0ab01250a', 'my_acf_load_field_sidebars');
add_action('acf/load_field/key=field_51dc0cb6b6243', 'my_acf_load_field_sidebars');
?>