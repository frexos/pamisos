<?php header('Content-Type: text/css; charset: UTF-8'); ?>
<?php if(isset($_GET["preset"]) && $_GET["preset"]): ?>
    .menu-section .row > .span12 > div > ul > li:hover, .current-menu-item {
    border-bottom: 4px solid <?php echo $_GET["preset"];  ?>;
    }

    #header .header-top-section form button[type=submit]:hover ,#header .header-top-section .account-section a:hover, .highlighted-button, .newsletter.newsletter-widget input[type=submit]:hover {
    background-color: <?php echo $_GET["preset"];  ?> !important;
    }

    .span6.feat-post .post-title {
    background-color: <?php echo $_GET["preset"];  ?>;
    }

    .category-title span, .widget-title span, .edit-dialog .dialog-title span {
    border-bottom: 2px solid <?php echo $_GET["preset"];  ?>;
    }

    #subscribe-form button[type=submit]:hover, .widget.widget_search input[type=submit]:hover {
    background-color:<?php echo $_GET["preset"];  ?>;
    }

    .login .l_holder form input[type=submit],.signup .s_holder form input[type=submit], .signup .s_holder form a.facebook-signup, a.facebook-login, .edit-profile input[type=submit], .forgot-password .s_holder form input[type=submit] {
    background-color:<?php echo $_GET["preset"];  ?>;
    }

    .article.single-post ul.informations li.liked *, .video-section ul.informations li.liked *, .audio-section ul.informations li.liked * {
    color: <?php echo $_GET["preset"];  ?>;
    }

    .article.single-post .post-content .main-content .article-content .post-title {
    background-color: <?php echo $_GET["preset"];  ?>;
    }

    .mag-gallery a.prev:hover, .mag-gallery a.next:hover {
    color: <?php echo $_GET["preset"];  ?>;
    }

    .mag-review table td.cell-value.overall {
    background-color: <?php echo $_GET["preset"];  ?>;
    border-color: <?php echo $_GET["preset"];  ?>;
    }

    #commentform input[type=submit], .contact-form form input[type=submit] {
    background-color: <?php echo $_GET["preset"];  ?>;
    }

    #footer .top-footer {
    background-color: <?php echo $_GET["preset"];  ?>;
    }

    .mejs-controls .mejs-time-rail .mejs-time-current {
    background: <?php echo $_GET["preset"];  ?>;
    }

    .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current {
    background: <?php echo $_GET["preset"];  ?>;
    }

    .widget.widget_calendar table a {
    color: <?php echo $_GET["preset"];  ?>;
    }

    .widget.widget_nav_menu ul .current-menu-item {
    border-bottom: 0px solid <?php echo $_GET["preset"];  ?>;
    }

    .pagination span.page-numbers.current, .pagination a.page-numbers:hover {
    background-color: <?php echo $_GET["preset"];  ?>;
    }

    .accordion li > a i, .toggle li > a i {
    color: <?php echo $_GET["preset"];  ?>;
    }

    .tabs .tab_buttons li.active-p, .tabs .tab_buttons li:hover {
    border-top: 3px solid <?php echo $_GET["preset"];  ?>;
    }

    .main_menu li.menu-item .sub-menu .current-menu-item {
    border-bottom: 0px solid <?php echo $_GET["preset"];  ?>;
    }

    #poststuff input[type=submit] {
    background-color: <?php echo $_GET["preset"];  ?>;
    }
<?php endif; ?>

<?php if(isset($_GET["font"]) && $_GET["font"]): ?>
    body{
        font-family: '<?php echo $_GET["font"]; ?>', sans-serif;
    }
	.menu-section {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.span6.feat-post .post-title h4 a {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.category-title span, .widget-title span, .edit-dialog .dialog-title span {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.user-profile-top .user-pic > h4, .add-post-top .span12 h5 {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.login .l_holder form input[type=submit],.signup .s_holder form input[type=submit], .signup .s_holder form a.facebook-signup, a.facebook-login, .edit-profile input[type=submit], .forgot-password .s_holder form input[type=submit] {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.home-type > h3 {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.article.single-post .post-content .main-content .article-content .post-title h4 {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.video-section .video-title, .audio-section .audio-title {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.post-comments a.show-hide-comments, h3#reply-title, .video.single-post .span8.main-content .toggle-button, .audio.single-post .span8.main-content .toggle-button {
	font-family: '<?php echo $_GET["font"]; ?>';
}
#commentform input[type=submit], .contact-form form input[type=submit] {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.widget.widget_calendar table caption {
	font-family: '<?php echo $_GET["font"]; ?>';
}
.mobile-menu-holder ul li a {
	font-family: "<?php echo $_GET["font"]; ?>";
}
#poststuff input[type=submit] {
	font-family: "<?php echo $_GET["font"]; ?>";
}
.slider-two > .container > .row > div .post-title {
	font-family: '<?php echo $_GET["font"]; ?>';
}
<?php endif; ?>

<?php if(isset($_GET["post_views"]) && $_GET["post_views"]): ?>
    .views-counter, .views, .views-count, .related-views, .post-views {
    display: none !important;
    }
<?php endif; ?>