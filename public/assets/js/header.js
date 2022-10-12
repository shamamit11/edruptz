(function() {}).call(this);
jQuery(function($) {
    var header_pos = $('header');
    var pos = header_pos.outerHeight();
    $(window).on('load scroll', function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos) {
            $('.header').removeClass('ani_start');
        } else {
            $('.header').addClass('ani_start');
        }
    });
});
jQuery(document).ready(function() {
    function header_height() {
        var header_main_height = $('header').outerHeight(),
            top_header_height = $('.header-top').outerHeight(),
            total_header_height = header_main_height + top_header_height;
        $('.paral-content-wrap').css({
            'padding-top': header_main_height
        });
        $('.paral-content-header .content > table td').css({
            'padding-top': header_main_height
        });
        var paral_content_height = $('.paral-content-header').outerHeight();
        $('#body-wrap').css({
            'margin-top': paral_content_height
        });
        $('.transparent_header .et_pb_section:first-of-type .et_pb_slide,.transparent_header .et_pb_section:first-of-type').css({
            'padding-top': total_header_height
        });
        $('.main .padding_header_height').css({
            'padding-top': total_header_height
        });
    }
    header_height();
    $(window).resize(function() {
        header_height()
    });

    function header_effect() {
        var scrollTop = $(this).scrollTop();
        var mainTop = $('main.main').offset().top;
        var opacity = (scrollTop * 1.5) / mainTop;
        var height = mainTop - scrollTop;
        var transheader_top_margin = height / 2;
        var header_main_height = $('header').outerHeight();
        var section_height = $('.et_pb_section:first-of-type').height();
        $('.paral-header-wrap').css({
            'height': mainTop - scrollTop + 10
        });
        $('.scroll_opacity').css({
            'opacity': 1 - opacity
        });
        if (transheader_top_margin < 0) {
            $('header.transparent ').css({
                'margin-top': transheader_top_margin
            });
        } else {
            $('header.transparent ').css({
                'margin-top': 0
            });
        }
        $('.transparent .scroll_opacity').css({
            'opacity': (header_main_height + height) / 125 + 0.1
        });
        $('.paral-content-wrap > .full_position').css({
            'height': height + 10
        });
        $('.transparent_header .et_pb_section:first-of-type .et_pb_slide .et_parallax_bg').css({
            height: section_height + header_main_height - scrollTop
        });
    }
    header_effect();
    $(window).on('load resize scroll', function() {
        header_effect();
    });
    $(".go-to-main").click(function() {
        $('html, body').animate({
            scrollTop: $("main.main").offset().top - 42
        }, 800);
    });
    $('.header-top .mobile-menu-button').click(function() {
        $(this).parents('.header-top').toggleClass('mobile-menu-on').removeClass('search-on');
        $('body').toggleClass('mobile_no_scroll').removeClass('search_no_scroll');
    });
    var header_pos = $('header');
    var pos = header_pos.outerHeight();
    $(window).scroll(function() {
        var windowpos = $(window).scrollTop();
        if (windowpos >= pos) {
            $('.header-top').addClass('show-icons');
        } else {
            $('.header-top').removeClass('show-icons');
        }
    });
});