<?php //if(!$wp_rewrite->using_permalinks()){ wp_die(__("This theme requires permalinks enabled!!","um_lang")); }; ?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

    <?php if($GLOBALS["um_facebook_app_id"]): ?>
        <meta property="fb:app_id" content="<?php echo $GLOBALS["um_facebook_app_id"]; ?>">
    <?php endif; ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <title><?php bloginfo('name'); ?> | <?php if(is_home() || is_front_page()){ bloginfo("description"); } wp_title("",true,""); ?></title>
    <?php if(get_field("site_favico","options")): ?>
        <link rel="icon" type="image/png" href="<?php the_field("site_favico","options"); ?>">
    <?php endif; ?>

    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome-ie7.min.css">
    <![endif]-->

    <?php if(get_field("custom_css","options")): ?>
        <style type="text/css">
            <?php the_field("custom_css","options"); ?>
        </style>
    <?php endif; ?>
    <?php if(get_field("custom_javascript","options")): ?>
        <script type="text/javascript">
            <?php the_field("custom_javascript","options"); ?>
        </script>
    <?php endif; ?>
    <script>
        //<![CDATA[
        var media_autoplay = <?php echo get_field("video_autoplay","options") == "Enabled" ? "true" : "false"; ?>;
        var template_directory = "<?php echo get_template_directory_uri(); ?>";
        var um_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
        var post_permalink = "<?php the_permalink(); ?>";
        var um_message = {
            login_falied : "<?php _e("Login failed, username and password combination missmatch!","um_lang"); ?>",
            user_exists : "<?php _e("This user exists, please choose another one.","um_lang"); ?>",
            email_exists : "<?php _e("This e-mail exists, please choose another one.","um_lang"); ?>",
            facebook_login_fail : "<?php _e("This Facebook account, does not exist on our system.","um_lang"); ?>",
            reset_password_success : "<?php _e("The reset password e-mail was sent successfully","um_lang"); ?>",
            reset_password_error : "<?php _e("This e-mail does not exist on our system!","um_lang"); ?>"
        };
        var search_autocomplete = <?php echo get_field("search_autocomplete","options") == "Disabled" ? "false" : "true" ?>;
        <?php if($GLOBALS["um_facebook_app_id"]): ?>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '<?php echo $GLOBALS["um_facebook_app_id"]; ?>',                    // App ID from the app dashboard
                status     : true,                                 // Check Facebook Login status
                xfbml      : true                                  // Look for social plugins on the page
            });
        };
        <?php endif; ?>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $GLOBALS["um_facebook_app_id"]; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        //]]>
    </script>
    <?php wp_head(); ?>
</head>

<?php
	$background_style = "";
    if(get_field("background_image","options") && get_field("site_layout","options") == "Boxed"){
        if(get_field("background_image_mode","options") == "bgimage"){
            $background_style = 'style="
            background-image:url(\''.get_field("background_image","options").'\');
            background-repeat:no-repeat;
            background-size:cover;
            -webkit-background-size:cover;
            -moz-background-size:cover;
            -o-background-size:cover;
            background-attachment:fixed;
            background-position:center center;
            "';
        }else{
            $background_style = 'style="
            background-image:url(\''.get_field("background_image","options").'\');
            background-repeat:repeat;
            "';
        }
    }
    $body_class = array();
    if(get_field("site_layout","options") == "Boxed"){
        array_push($body_class,"boxed_content");
    }
?>
<body <?php body_class($body_class); ?> <?php echo $background_style; ?>>

<div id="fb-root"></div>
<div id="header">
    <div class="header-top-section">
        <div class="container">
            <div class="row">
                <a href="#" class="menu-trigger"><i class="icon-reorder"></i></a>
                <a href="<?php echo site_url(); ?>" class="logo span2">
                    <img src="<?php the_field("site_logo","options"); ?>" />
                </a>
                <form action="<?php echo site_url(); ?>" class="main-search span5">
                    <p>
                        <input type="text" id="search-input" name="s" placeholder="Type your search here">
                        <button type="submit" id="search-send" name="search-send" value="l" style="font-family: 'FontAwesome';" class="btn btn-success">
                            <i class="icon-search"></i>
                        </button>
                    </p>
                </form>

                <?php if($GLOBALS["allow_users_to_publish"]): ?>
                <div class="account-section span5">
                    <?php if(!is_user_logged_in()): ?>
                    <div class="not-logged visible">
                        <p><a href="#" class="login-button"><?php _e("Login","um_lang"); ?></a> <span><?php _e("or","um_lang"); ?></span> <a href="#" class="signup-button"><?php _e("Create an account","um_lang"); ?></a></p>
                    </div>
                    <?php else: ?>
                    <div class="logged">
                        <p>
                            <a href="<?php echo site_url()."/".$GLOBALS["um_submit"]; ?>" class="new-post-button highlighted-button"><?php _e("New Post","um_lang"); ?></a>
                            <a href="<?php echo site_url()."/".$GLOBALS["um_profile"]; ?>" class="account-button"><?php _e("Account","um_lang"); ?> <i class="icon-user"></i></a>
                            <a href="<?php echo wp_logout_url(site_url()); ?>" class="logout-button"><i class="icon-off"></i></a></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
	
    <div class="menu-section">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <?php wp_nav_menu(array("theme_location" => "main_menu","menu_id"=>"main_menu","menu_class"=>"main_menu")); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu-holder">
		<div class="menu-linkat-container">
			<?php wp_nav_menu(array("theme_location" => "mobile_menu","menu_id"=>"mobile_menu","menu_class"=>"mobile_menu")); ?>
		</div>
	</div>

    <!-- DIALOGS -->

    <div class="dialogs">

        <div class="login">
            <div class="back"></div>
            <div class="l_holder">
                <h4><i class="icon-user"></i><?php _e("Login","um_lang"); ?></h4>
                <form action="#" id="login-form">
                    <p>
                        <input type="text" id="username" name="username" placeholder="Username">
                    </p>
                    <p>
                        <input type="password" id="l-password" name="l-password" placeholder="Password">
                    </p>
                    <p>
                        <input type="submit" name="login" id="login" value="Sign In">
                        <?php if($GLOBALS["um_facebook_app_id"]): ?>
                            <a href="#" class="facebook-login"><?php _e("Facebook","um_lang"); ?></a>
                        <?php endif; ?>
                    </p>
                    <p class="qw"><a href="#" onclick="show_forgot();" ><?php _e("Forgot Password","um_lang"); ?></a> / <a onclick="show_signup();" href="#"><?php _e("New Account","um_lang"); ?></a></p>
                </form>
            </div>
        </div>

        <div class="signup">
            <div class="back"></div>
            <div class="s_holder">
                <h4><i class="icon-user"></i><?php _e("Create an account","um_lang"); ?></h4>
                <form action="#" id="signup-form">
                    <p>
                        <input type="text" id="name" name="name" placeholder="<?php _e("Name","um_lang"); ?>">
                    </p>
                    <p>
                        <input type="email" id="email" name="email" placeholder="<?php _e("Email","um_lang"); ?>">
                    </p>
                    <p>
                        <input type="submit" name="signup" id="signup" value="<?php _e("Sign Up","um_lang"); ?>">
                    </p>
                    <?php if($GLOBALS["um_facebook_app_id"]): ?>
                        <p class="j-text"><?php _e("or connect with","um_lang"); ?></p>
                        <a href="#" class="facebook-signup"><?php _e("Facebook","um_lang"); ?></a>
                    <?php endif; ?>
                    <input type="hidden" id="facebook_id" name="facebook_id"/>
                </form>
            </div>
        </div>

        <div class="forgot-password">
            <div class="back"></div>
            <div class="s_holder">
                <h4><i class="icon-user"></i><?php _e("Forgot Password","um_lang"); ?></h4>
                <form action="#" id="forgot-form">
                    <p>
                        <input type="email" id="email" name="email" placeholder="<?php _e("Email","um_lang"); ?>">
                    </p>
                    <p>
                        <input type="submit" name="signup" id="signup" value="<?php _e("Reset Password","um_lang"); ?>">
                    </p>
                </form>
            </div>
        </div>

        <div class="messages">
            <div class="back"></div>
            <div class="message_holder">
				<h4><i class="icon-user"></i><?php _e("Create an account","um_lang"); ?></h4>
				<p class="message success">

				</p>
            </div>
        </div>

    </div>

</div>