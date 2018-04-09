var show_login = "";
var show_signup = "";
var show_message = "";
var show_forgot = "";
var animate_tweets = "";
var center_dialog = "";
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
jQuery(document).ready(function($){

    /*Check for retina*/
    if(window.devicePixelRatio > 1){
        $("img[data-retina]").each(function(){
            $(this).attr("src",$(this).data("retina"));
        });
    }
    /*Check for retina*/

    /*Home Slider Featured-Popular Switch*/
    $("a.pop-button").on("click",function(e){
        e.preventDefault();
        var this_anchor = $(this);
        this_anchor.addClass("active");
        $("a.feat-button").removeClass("active");
        $("div.featured").stop(true,true).fadeOut("fast",function(){
            $("div.popular").stop(true,true).fadeIn("fast");
        });
    });

    $("a.feat-button").on("click",function(e){
        e.preventDefault();
        var this_anchor = $(this);
        this_anchor.addClass("active");
        $("a.pop-button").removeClass("active");
        $("div.popular").stop(true,true).fadeOut("fast",function(){
            $("div.featured").stop(true,true).fadeIn("fast");
        });
    });

    $("a.menu-trigger").on("click", function(e) {
        e.preventDefault();
        if($('body').hasClass('open')) {
            $('body').css('right', "0px").removeClass('open');
            $('html').css('right', "0px");
            $('.mobile-menu-holder').css('right', '-300px').delay(500).hide(0);
        } else {
            $('body').css('right', "300px").addClass('open');
            $('html').css('right', "300px");
            $('.mobile-menu-holder').css('right', '-300px').show(0);
        }
    });

    $(".mobile_menu").on("swiperight",function(){
        $('body').css('right', "0px").removeClass('open');
        $('html').css('right', "0px");
        $('.mobile-menu-holder').css('right', '-300px').delay(500).hide(0);
    });
    /*Home Slider Featured-Popular Switch*/

    /*Search Autocomplete*/
    if(search_autocomplete){
        $( "#search-input,input:text#s" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    type:"GET",
                    url: um_ajaxurl,
                    data: {
                        action: "get_autocomplete",
                        um_search: request.term
                    },
                    success: function( data ) {
                        data = $.parseJSON(data);
                        response( $.map( data, function( item ) {
                            return {
                                label: item.title,
                                value: item.title,
                                permalink : item.permalink
                            }
                        }));
                    }
                });
            },
            select: function( event, ui ) {
                window.location = ui.item.permalink;
                event.preventDefault();
            }
        });
    }
    /*Search Autocomplete*/

    /*Login + Create Account Handling*/
    $(document).keyup(function(e){
        if (e.keyCode == 27){
            $(".login,.signup,.messages,.dialogs").stop(true,true).fadeOut("fast");
        }
    });

    $(".back").on("click", function() {
        $(".login,.signup,.messages,.dialogs").stop(true,true).fadeOut("fast");
    });

    /*$(".login,.signup,.messages").click(function(e){
        e.stopPropagation();
        return false;
    });

    $(document).click(function(){
        $(".login,.signup,.messages,.dialogs").stop(true,true).fadeOut("fast");
    });*/

    /*Login User*/
    $("form#login-form").on("submit",function(){
        var username = $(this).find("#username").val();
        var password = $(this).find("#l-password").val();
        var ajax_data = {
            action : "auth_user",
            um_username : username,
            um_pass : password
        };
        $.post(um_ajaxurl,ajax_data,function(data){
            if(!data){
                show_message(false,um_message.login_falied);
            }else{
                location.reload();
            }
        });
        return false;
    });
    /*Login User*/

    /*Signup User*/
    $("form#signup-form").on("submit",function(){
        var name = $(this).find("#name").val();
        var email = $(this).find("#email").val();
        var ajax_data = {
            action : "signup_user",
            um_username : name,
            um_email : email
        };
        $.post(um_ajaxurl,ajax_data,function(data){
            if(data != "1"){
                show_message(false,um_message[data]);
            }else{
                location.reload();
            }
        });
        return false;
    });
    

    $("a.facebook-login").on("click",function(e){
        e.preventDefault();
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', function(response) {
                    var userid = response.id
                    var ajax_data = {
                        action : "auth_user_fb",
                        facebook_id : userid
                    };
                    $.post(um_ajaxurl,ajax_data,function(data){
                        if(data == "1"){
                            location.reload();
                        }else{
                            show_message(false,um_message.facebook_login_fail);
                        }
                    });
                });
            }
        },{scope: 'email'});
    });

    $("a.facebook-signup").on("click",function(e){
        e.preventDefault();
        FB.login(function(response) {
            if (response.authResponse) {
                FB.api('/me', { fields: 'name, email' }, function(response) {
                    $("form#signup-form").find("#name").val(response.name);
                    $("form#signup-form").find("#email").val(response.email);
                    $("form#signup-form").find("#facebook_id").val(response.id);
                    var ajax_data = {
                        action : "signup_user",
                        um_username : response.name,
                        um_email : response.email,
                        um_facebookid : response.id
                    };
                    $.post(um_ajaxurl,ajax_data,function(data){
                        if(!data){
                            show_message(false,um_message.login_falied);
                        }else{
                            location.reload();
                        }
                    });
                });
            }
        },{scope: 'email'});
    });
    /*Signup User*/

    $(".btn-pending").on("click",function(){
        console.log('show popup');
        $("html").addClass("has-popup");
    });

    $(".submit-new input").on("click",function(){
        $("html").removeClass("has-popup");
    });

    $(".login-button").on("click",function(e){
        e.preventDefault();
        show_login();
    });

    $(".signup-button").on("click",function(e){
        e.preventDefault();
        show_signup();
    });
    /*Login + Create Account Handling*/
    
    /*Forgot Password*/
    $("form#forgot-form").on("submit",function(){
        var email = $(this).find("#email").val();
        var ajax_data = {
            action : "um_reset_password",
            um_email : email
        };
        $.post(um_ajaxurl,ajax_data,function(data){
            if(data == "-1"){
                show_message(false,um_message.reset_password_error);
            }else{
                show_message(true,um_message.reset_password_success);
            }
        });
        return false;
    });
    /*Forgot Password*/

    /*Custom Functions*/
    show_forgot = function(){
        hide_all();
        $(".dialogs").stop(true,true).fadeIn("fast");
        $(".forgot-password").stop(true,true).fadeIn("fast");
        center_dialog();
    }

    show_login = function(){
        hide_all();
        $(".dialogs").stop(true,true).fadeIn("fast");
        $(".login").stop(true,true).fadeIn("fast");
        center_dialog();
    }

    show_signup = function(){
        hide_all();
        $(".dialogs").stop(true,true).fadeIn("fast");
        $(".signup").stop(true,true).fadeIn("fast");
        center_dialog();
    }

    show_message = function(success,message){
        hide_all();
        if(success){
            $(".messages").find("p.message").addClass("success");
        }else{
            $(".messages").find("p.message").removeClass("success");
        }
        $(".messages").find("p.message").text(message);
        $(".dialogs").stop(true,true).fadeIn("fast");
        $(".messages").stop(true,true).fadeIn("fast");
        center_dialog();
    }

    var hide_all = function(){
        $(".login,.signup,.messages,.forgot-password").hide();
    }

    center_dialog = function(){
        $(".login .l_holder, .signup .s_holder, .forgot-password .s_holder, .messages .message_holder").each(function () {
            var height = $(this).outerHeight();
            var containerHeight = $(window).height();
            var minHeight = height - containerHeight;
            var centerH = minHeight / 2;

            $(this).css("marginTop", -centerH);
        });
    };
    /*$("div.l_holder,div.s_holder,div.message_holder").click(function(e){
        e.preventDefault();
        e.stopPropagation();
    });

    $("div.dialogs").click(function(e){
        e.preventDefault();
        hide_all();
    });*/
    /*Custom Functions*/

    var current_page = 2;

    /*Like System*/
    $("li.like a").live("click",function(e){
        e.preventDefault();
        var post_id = $(this).attr("href");
        var ajax_data = {
            action : "um_like_post",
            to_like : post_id
        };

        $.ajax({
            type: "POST",
            url: um_ajaxurl,
            data: ajax_data,
            success: function(data){
                if(data == "-1" || data == "0"){
                    show_login();
                }else{
                    get_post_views();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                show_login();
            }
        });
        /*$.post(um_ajaxurl,ajax_data,function(data){
            if(data == -1){
                show_login();
            }else{
                get_post_views();
            }
        });*/
    });

    $("li.dislike a").live("click",function(e){
        e.preventDefault();
        var post_id = $(this).attr("href");
        var ajax_data = {
            action : "um_dislike_post",
            to_like : post_id
        };

        $.ajax({
            type: "POST",
            url: um_ajaxurl,
            data: ajax_data,
            success: function(data){
                if(data == "-1" || data == "0"){
                    show_login();
                }else{
                    get_post_views();
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                show_login();
            }
        });

        /*$.post(um_ajaxurl,ajax_data,function(data){
            if(data == -1 || !data){
                show_login();
            }else{
                get_post_views();
            }
            console.log("Qka je tu thon");
        });*/
    });

    function get_post_views(){
        $.get(post_permalink,{get_article_info:true},function(data){
            $("ul.informations").parent().html(data);
        });
    }
    /*Like System*/

    /*Mark Last Rating Cell as Overall*/
    $(".mag-review").find("td.cell:last").addClass("overall");
    $(".mag-review").find("td.cell-value:last").addClass("overall");
    $(".mag-review").find("td.cell-value:last").text($("#overall_rating").val());
    /*Mark Last Rating Cell as Overall*/

    /*Magazine Gallery*/
    $(".gallery-continer li a").attr('rel', 'gallery').fancybox();
    /*Magazine Gallery*/

    /*Twitter Widget*/
    var tweets = "";

    $.get(um_ajaxurl,{action:"um_get_tweets"},function(data){
        tweets = $.parseJSON(data);
        if(tweets && typeof tweets.errors === 'undefined'){
            tweets = tweets;
            fill_container_with_tweets();
        }else{
            $(".twitter-widget").hide();
        }
    });

    function fill_container_with_tweets(){
        $.each(tweets,function(i,tweet){
            var text = tweet['text'];
            text = twttr.txt.autoLink(text);
            $("div.tweets").append("<p class='tweet'>"+text+"</p>");
        });
        $("div.tweets").find("p.tweet").eq(0).show();
        window.setTimeout("animate_tweets()",5000);
    }

    animate_tweets = function animate_tweets(){
        var current_tweet = $("div.tweets").find("p.tweet:visible");
        var next_tweet = current_tweet.next();
        if(!next_tweet[0]){
            var next_tweet = $("div.tweets").find("p.tweet").eq(0);
        }
        current_tweet.fadeOut("normal",function(){
            next_tweet.fadeIn("normal");
        });
        window.setTimeout("animate_tweets()",5000);
    }
    /*Twitter Widget*/

    /*Scroll To Top*/
    $("a.to_top").click(function(e){
        e.preventDefault();
        $(window).scrollTo({top:0,left:0},300);
    });
    /*Scroll To Top*/

    /*Media Element*/
    $('video,audio').mediaelementplayer({
        pluginPath : template_directory+"/assets/mediaelement/"
    });
    /*Media Element*/

    $("a.show-hide-comments").click(function(e){
        e.preventDefault();
        $(".comments-fb").stop(true,true).fadeToggle("normal");
    });

    $("a.toggle-button").click(function(e){
        e.preventDefault();
        $(".toggle-content").stop(true,true).fadeToggle("normal");
    });

    /*Shortcodes*/

    /*Accordions*/
    $('.accordion li').find('.section_content').hide();
    $('.accordion li:first-child').find('a').addClass('active').find('i').removeClass('icon-plus-sign').addClass('icon-minus-sign');
    $('.accordion li:first-child').find('.section_content').show();

    $("ul.accordion li a").on("click",function(e){
        e.preventDefault();
        var parent = $(this).closest("ul.accordion");
        var this_element = $(this);
        parent.find("a.active").removeClass("active").find('i').removeClass('icon-minus-sign').addClass('icon-plus-sign').parent().siblings(".section_content").stop(true,true).slideUp({
            duration : 200 ,
            easing:"easeOutSine",
            complete : function(){
                this_element.addClass("active").find('i').removeClass('icon-plus-sign').addClass('icon-minus-sign').parent().siblings(".section_content").stop(true,true).slideDown({
                    easing : "easeInSine"
                });
            }
        });
    });

    /*Tabs*/
    $(".tabs .tab_content li").hide();
    $('.tabs .tab_buttons > li:first-child').addClass('active-p').find('a').addClass('active');
    $('.tabs .tab_content li:first-child').show();

    $("div.tabs ul.tab_buttons li a").on("click",function(e){
        e.preventDefault();
        var parent = $(this).parent().parent();
        var this_index = $(this).parent().index();
        parent.find('li').removeClass('active-p').find("a").removeClass("active");
        $(this).addClass("active").parent().addClass('active-p');
        parent.next().children("li").stop(true,true).fadeOut({
            easing : "easeOutSine",
            duration : 200 ,
            complete : function(){
                parent.next().children("li").eq(this_index).stop(true,true).fadeIn({
                    easing : "easeInSine",
                    duration : 200
                });
            }
        });
    });

    /*Toggles*/
    $(".toggle li").find(".section_content").hide();

    $(".toggle li a").on("click",function(e){
        e.preventDefault();
        var section_content = $(this).siblings(".section_content");
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(this).find("i").removeClass("icon-minus-sign").addClass("icon-plus-sign");
        }else{
            $(this).addClass("active");
            $(this).find("i").removeClass("icon-plus-sign").addClass("icon-minus-sign");
        }
        section_content.stop(true,true).slideToggle({
            easing : "easeInOutSine",
            duration : 200
        });
    });

    $("div.alert_container a.close").on("click",function(e){
        e.preventDefault();
        $(this).parent().fadeOut({
            duration : 800,
            easing : "easeOutSine"
        });
    });
    /*Alerts*/

    /*Shortcodes*/

    function initialize() {
        var lat = parseFloat($("#map").data("lat"));
        var lang = parseFloat($("#map").data("lang"));
        var title = $("#map").data("title");
        var zoom = parseInt($("#map").data("zoom"));
        var mapOptions = {
            center: new google.maps.LatLng(lat, lang),
            zoom: zoom,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"),
            mapOptions);
        marker = new google.maps.Marker({
            title : title,
            position: new google.maps.LatLng(lat, lang),
            map: map
        });
    }

    /*Contact Form*/
    $("div.contact-form form").submit(function(){
        var name = $(this).find("#cont-auth");
        var email = $(this).find("#cont-email");
        var message = $(this).find("#cont-message");
        var return_state = true;

        if(name.val() == ""){
            name.addClass("error");
            return_state = false;
        }
        if(email.val() == "" || !validateEmail(email.val())){
            email.addClass("error");
            return_state = false;
        }
        if(message.val() == ""){
            message.addClass("error");
            return_state = false;
        }

        if(return_state){
            var action = $(this).attr("action");
            var ajax_data = {
                um_name : name.val(),
                um_email : email.val(),
                um_message : message.val()
            };
            $.post(action,ajax_data,function(data){
                $("div.contact-form form").fadeOut("normal",function(){
                    $(".success-message").fadeIn("normal");
                });
            });
        }
        return false;
    });

    $("div.contact-form form :input, div.contact-form form textarea").click(function(){
        $(this).removeClass("error");
    });
    /*Contact Form*/

    $(window).load(function(){

        // jQuery(".feat-posts-list").mCustomScrollbar({
        //         advanced:{
        //             updateOnContentResize: true
        //         }
        //     });
        // window.setTimeout(function(){
        //     jQuery(".popular .feat-posts-list").mCustomScrollbar("update");
        // },100);

        $(".mag-gallery").serialScroll({
            target:'.gallery-holder',
            items:'ul li',
            prev:'a.prev',
            next:'a.next',
            margin: false,
            constant : true,
            duration : 300
        });

        var homeFeatHeight = $('.span6.feat-post.video:visible').eq(0).height();
        $('.feat-pop-posts > .row > .span2').css({'height': homeFeatHeight + 'px'}).find('a').css({'height': '50%'});
        $('.feat-posts-list').css({'height': homeFeatHeight + 'px'});

        if(document.getElementById("map")) {
            initialize();
        };

        $(".span6.feat-post .post-img > a").find("img").each(function () {
            var width = $(this).width();
            var containerWidth = $(".span6.feat-post .post-img").width();
            var minWidth = width - containerWidth;
            var center = minWidth / 2;

            $(this).css("marginLeft", -center);
        });

        /*Load More*/
        $("a.load-more").on("click",function(e){
            e.preventDefault();
            var the_url = $(this).attr("href");
            var this_obj = $(this);
            $.post(the_url,{um_paged : current_page},function(data){
                if(data){
                    data = $(data);
                    current_page++;
                    $("div.page-posts").masonry()
                        .append( data )
                        .masonry( 'appended', data );
                }else{
                    this_obj.fadeOut("slow",function(){
                        $(this).remove();
                    });
                }
            });
            $("div.page-posts").masonry( 'reload' );
            $("div.page-posts").masonry( 'reload' );
        });

        $("div.page-posts").masonry({
            itemSelector : ".post"
        });

        $("div.user-posts .span8 .row").masonry({
            itemSelector : ".post"
        });

        $("div.category-posts-list").masonry({
            itemSelector : ".post"
        });
        /*Load More*/

        $("div.featured").hide();
    });

    $(window).resize(function(){
        var homeFeatHeight = $('.span6.feat-post.video:visible').eq(0).height();
        $('.feat-pop-posts > .row > .span2').css({'height': homeFeatHeight + 'px'}).find('a').css({'height': '50%'});
        $('.feat-posts-list').css({'height': homeFeatHeight + 'px'});

        center_dialog();

        $(".span6.feat-post .post-img > a").find("img").each(function () {
            var width = $(this).width();
            var containerWidth = $(".span6.feat-post .post-img").width();
            var minWidth = width - containerWidth;
            var center = minWidth / 2;

            $(this).css("marginLeft", -center);
        });
    });

    var file = document.getElementById('avatar-edit');
    var f = jQuery('#avatar-edit');
    if(f.length != 0){
    file.onchange = function(e){
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch(ext)
        {
            case 'jpg':
            case 'jpeg':
            case 'png':
                break;
            default:
                alert('Only JPG, JPEG and PNG files are allowed.');
                this.value='';
        }
    };
    }
});