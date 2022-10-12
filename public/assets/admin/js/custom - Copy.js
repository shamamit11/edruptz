	(function($) {
    "use strict";
    // Header Sticky
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 30) {
            $('.top-navbar').addClass("is-sticky");
        } else {
            $('.top-navbar').removeClass("is-sticky");
        }
    });
    // Burger Menu JS
    $('.burger-menu').on('click', function() {
        $(this).toggleClass('active');
        $('.main-content').toggleClass('hide-sidemenu-area');
        $('.sidemenu-area').toggleClass('toggle-sidemenu-area');
        $('.top-navbar').toggleClass('toggle-navbar-area');
    });
    $('.responsive-burger-menu').on('click', function() {
        $('.responsive-burger-menu').toggleClass('active');
        $('.sidemenu-area').toggleClass('active-sidemenu-area');
    });
    // Tooltip JS
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
    // Popovers JS
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
    // Metis Menu JS
    $(function() {
        $('#sidemenu-nav').metisMenu();
    });
    // Webpage FullScreen JS
    $("#fullscreen-button").on("click", function toggleFullScreen() {
        if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {
                document.documentElement.requestFullScreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullScreen) {
                document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    });
    $('.bx-fullscreen-btn').on('click', function() {
        $(this).toggleClass('active');
    });
   
	feather.replace();

    var $images = $('.gallery-area');
    var $toggles = $('.gallery-toggles');
    var $buttons = $('.gallery-buttons');
    var options = {
        // inline: true,
        url: 'data-original',
        ready: function(e) {
            console.log(e.type);
        },
        show: function(e) {
            console.log(e.type);
        },
        shown: function(e) {
            console.log(e.type);
        },
        hide: function(e) {
            console.log(e.type);
        },
        hidden: function(e) {
            console.log(e.type);
        },
        view: function(e) {
            console.log(e.type);
        },
        viewed: function(e) {
            console.log(e.type);
        }
    };

    function toggleButtons(mode) {
        if (/modal|inline|none/.test(mode)) {
            $buttons.find('button[data-enable]').prop('disabled', true).filter('[data-enable*="' + mode + '"]').prop('disabled', false);
        }
    }
    $images.on({
        ready: function(e) {
            console.log(e.type);
        },
        show: function(e) {
            console.log(e.type);
        },
        shown: function(e) {
            console.log(e.type);
        },
        hide: function(e) {
            console.log(e.type);
        },
        hidden: function(e) {
            console.log(e.type);
        },
        view: function(e) {
            console.log(e.type);
        },
        viewed: function(e) {
            console.log(e.type);
        }
    }).viewer(options);
    toggleButtons(options.inline ? 'inline' : 'modal');
    $toggles.on('change', 'input', function() {
        var $input = $(this);
        var name = $input.attr('name');
        options[name] = name === 'inline' ? $input.data('value') : $input.prop('checked');
        $images.viewer('destroy').viewer(options);
        toggleButtons(options.inline ? 'inline' : 'modal');
    });
    $buttons.on('click', 'button', function() {
        var data = $(this).data();
        var args = data.arguments || [];
        if (data.method) {
            if (data.target) {
                $images.viewer(data.method, $(data.target).val());
            } else {
                $images.viewer(data.method, args[0], args[1]);
            }
            switch (data.method) {
                case 'scaleX':
                case 'scaleY':
                    args[0] = -args[0];
                    break;
                case 'destroy':
                    toggleButtons('none');
                    break;
            }
        }
    });
 
}(jQuery));