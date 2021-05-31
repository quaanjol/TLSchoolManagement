$(document).ready(function () {
    if ($(window).width() < 479 || $(window).width() < 1023) {
        let handl_show_menu = () => {
            $('.viva__header').each(function () {
                var _this = $(this);
                $(this)
                    .children('.viva-bar-clickjs')
                    .on('click', function () {
                        _this.addClass('show-menu');
                    });
            });
        };
        handl_show_menu();

        let hand_hiden_menu = () => {
            var get_dom_header = $('.viva__header');
            $('.fa--close').on('click', function () {
                if (get_dom_header.hasClass('show-menu')) {
                    get_dom_header.removeClass('show-menu');
                }
            });
        };
        hand_hiden_menu();
        let hand_height_menu = () => {
            var height_menu = $(window).height();
            $('.viva__nav').css('height', height_menu);
        };
        hand_height_menu();

        // handl menu toggle mobile
        let hand_toggle_menu = () => {
            $('.nav-container-js').each(function () {
                if ($(this).find('a').next()) {
                    $(this).find('a').next().addClass('menu-toggle');
                    $('.menu-toggle').slideUp();
                    if ($('.ul-menu').hasClass('menu-toggle')) {
                        $('.menu-toggle')
                            .prev()
                            .append(
                                '<i class="fas fa-plus fa-item fa-plus-js"></i>',
                            );
                    }
                    $('.fa-plus-js').on('click', function () {
                        event.preventDefault();
                        $(this).parent().toggleClass('menu-tg-text');
                        $(this).parent().next().slideToggle();
                        $(this).toggleClass('fa-minus').toggleClass('fa-plus');
                    });
                }
            });
        };
        hand_toggle_menu();

        let handl_language_mb = () => {
            $('.viva__nav').each(function () {
                let get_dom_lang = $(this).find('.viva-language-js').get(0);
            });
        };
        handl_language_mb();
    }

    // handl scroll page contact us
    $('.timeline-wrap').each(function () {
        var _this = $(this);
        var top_point = 0;
        var get_height = _this.find('ul').height();
        _this.find('.timeline-btn-js').click(function () {
            top_point = top_point += 290;
            _this.find('ul').animate(
                {
                    scrollTop: top_point,
                },
                500,
            );
        });
    });

    // handl language
    let handl_lang = () => {
        let lang = $('html').attr('lang');
        if (lang != `en-US`) {
            $('body').addClass('lang-cn');
        }
    };
    handl_lang();

    // add class active tab business
    // $('.viva_business .nav-tabs').find('li:first-child a').addClass('test');	
    $('.viva_performance .nav-pills').find('li:first-child a').addClass('active');
    $('.viva__chairman .nav-tabs').find('li:first-child a').addClass('active');

    $(".toggle").click(function() {
        $(this).toggleClass("test");
        $(".nav-tabs").slideToggle();
        return false;
    });
      
    //handle scroll homepage
    $('.scroll_item').on('click', function() {
        var elem   = $('#' + $(this).data('page')),
            scroll = elem.offset().top;
        
        $('body, html').animate({scrollTop : scroll}, 1000);
        
        $(this).addClass('scroll_item_active')
               .siblings('.scroll_item_active')
               .removeClass('scroll_item_active');
    });
    
    $(window).on('scroll', function(e) {
        var elems    = $('#first, #second, #third, #fourth, #five'),
            scrolled = $(this).scrollTop();
        
        var dataPage = elems.filter(function() {
            return $(this).offset().top + ($(this).height() / 2) >= scrolled;
        }).first();
    
        $('.scroll_item[data-page="'+dataPage.prop('id')+'"]').addClass('scroll_item_active')
                        .siblings('.scroll_item_active')
                        .removeClass('scroll_item_active');
    }).trigger('scroll');

    // add header fixed
    $(window).scroll(function(){
        var sticky = $('.viva__header'),
            scroll = $(window).scrollTop();
        
        if (scroll > 0) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });

    var hash = location.hash.substr(1);
    if (hash.length > 0) {
        $(".viva_business .nav li a").removeClass("selected");
        $(".viva_business .nav li a[href='#" + hash.toLowerCase() + "']").parent().addClass('selected');
        $(".tab-content .tab-pane").removeClass("active show");
        var targetActive = $(".tab-content #" + hash.toLowerCase());
        targetActive.addClass("active show");
    }
});
