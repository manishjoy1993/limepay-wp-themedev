;(function ($) {
    "use strict"; // Start of use strict
    /* ---------------------------------------------
     Resize mega menu
     --------------------------------------------- */
    function responsive_megamenu_item(container, element) {
        if ( container != 'undefined' ) {
            var container_width  = 0,
                container_offset = container.offset();

            if ( typeof container_offset != 'undefined' ) {
                container_width = container.innerWidth();
                setTimeout(function () {
                    $(element).children('.megamenu').css({'max-width': container_width + 'px'});
                    var sub_menu_width = $(element).children('.megamenu').outerWidth(),
                        item_width     = $(element).outerWidth();
                    $(element).children('.megamenu').css({'left': '-' + (sub_menu_width / 2 - item_width / 2) + 'px'});
                    var container_left  = container_offset.left,
                        container_right = (container_left + container_width),
                        item_left       = $(element).offset().left,
                        overflow_left   = (sub_menu_width / 2 > (item_left - container_left)),
                        overflow_right  = ((sub_menu_width / 2 + item_left) > container_right),
                        left = null;

                    if ( overflow_left ) {
                        left = (item_left - container_left);
                        $(element).children('.megamenu').css({'left': -left + 'px'});
                    }
                    if ( overflow_right && !overflow_left ) {
                        left = (item_left - container_left) - (container_width - sub_menu_width);
                        $(element).children('.megamenu').css({'left': -left + 'px'});
                    }
                }, 100);
            }
        }
    }

    $.fn.urus_resize_megamenu = function () {
        var _this = $(this);
        _this.on('urus_resize_megamenu', function () {
            var window_size = $('body').innerWidth();
            window_size += urus_get_scrollbar_width();
            if ( $(this).length > 0 && window_size > 991 ) {
                $(this).each(function () {
                    var _container        = $('#urus-menu-wapper');

                    responsive_megamenu_item(_container, $(this));
                });
            }
        }).trigger('urus_resize_megamenu');
        $(window).on('resize', function () {
            _this.trigger('urus_resize_megamenu');
        });
    };

    /**==============================
     Auto width Vertical menu
     ===============================**/
    $.fn.urus_auto_width_vertical_menu = function () {
        var _this = $(this);
        _this.on('urus_auto_width_vertical_menu', function () {
            $(this).each(function () {
                var menu_offset = $(this).offset(),
                    menu_width  = parseInt($(this).actual('width')),
                    menu_left   = menu_offset.left + menu_width;

                $(this).find('.megamenu').each(function () {
                    var class_responsive  = $(this).data('responsive'),
                        element_caculator = $(this).closest('.container');
                    if ( class_responsive != '' )
                        element_caculator = $(this).closest(class_responsive);

                    if ( element_caculator.length > 0 ) {
                        var container_width  = parseInt(element_caculator.innerWidth()) - 30,
                            container_offset = element_caculator.offset(),
                            container_left   = container_offset.left + container_width,
                            width            = (container_width - menu_width);

                        if ( menu_offset.left > container_left || menu_left < container_offset.left )
                            width = container_width;
                        if ( menu_left > container_left )
                            width = container_width - (menu_width - (menu_left - container_left)) - 30;

                        if ( width > 0 )
                            $(this).css('max-width', width + 'px');
                    }
                });
            });
        }).trigger('urus_auto_width_vertical_menu');
        $(window).on('resize', function () {
            _this.trigger('urus_auto_width_vertical_menu');
        });
    };

    $.fn.urus_responsive_vertical_menu_width = function () {
        var _this = $(this);
        var window_w = $(window).width();
        _this.on('urus_responsive_vertical_menu_width', function () {
            $(this).each(function () {
                var menu_offset = $(this).offset();
                window_w = $(window).width();
                $(this).find('.megamenu').each(function () {
                   var  element_w = $(this).width(),
                        element_offset = $(this).offset(),
                        element_offset_r = element_offset.left + element_w;
                   var space_window_left = window_w - element_offset_r;
                   if (element_offset_r >= window_w || space_window_left > 30){
                       var element_w_responsive = window_w - (element_offset.left + 3) - 30;
                       $(this).css("max-width", element_w_responsive + "px");
                   }
                });
            });
        }).trigger('urus_responsive_vertical_menu_width');
        $(window).on('resize', function () {
            _this.trigger('urus_responsive_vertical_menu_width');
        });
    };
    function urus_get_scrollbar_width() {
        var $inner = $('<div style="width: 100%; height:200px;">test</div>'),
            $outer = $('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
            inner  = $inner[ 0 ],
            outer  = $outer[ 0 ];
        $('body').append(outer);
        var width1 = inner.offsetWidth;
        $outer.css('overflow', 'scroll');
        var width2 = outer.clientWidth;
        $outer.remove();
        return (width1 - width2);
    }

    /* ---------------------------------------------
     MOBILE MENU
     --------------------------------------------- */
    $.fn.urus_menuclone_all_menus = function () {
        var _this = $(this);
        _this.on('urus_menuclone_all_menus', function () {
            if ( !$('.urus-menu-clone-wrap').length && $('.urus-clone-mobile-menu').length > 0 ) {
                $('body').prepend('<div class="urus-menu-clone-wrap">' +
                    '<div class="urus-menu-panels-actions-wrap">' +
                    '<span class="urus-menu-current-panel-title">MAIN MENU</span>' +
                    '<a class="urus-menu-close-btn urus-menu-close-panels" href="#">x</a></div>' +
                    '<div class="urus-menu-panels"></div>' +
                    '</div>');
            }
            var i                = 0,
                panels_html_args = Array();
            if ( !$('.urus-menu-clone-wrap .urus-menu-panels #urus-menu-panel-main').length ) {
                $('.urus-menu-clone-wrap .urus-menu-panels').append('<div id="urus-menu-panel-main" class="urus-menu-panel urus-menu-panel-main"><ul class="depth-01"></ul></div>');
            }
            $(this).each(function () {
                var $this              = $(this),
                    thisMenu           = $this,
                    this_menu_id       = thisMenu.attr('id'),
                    this_menu_clone_id = 'urus-menu-clone-' + this_menu_id;

                if ( !$('#' + this_menu_clone_id).length ) {
                    var thisClone = $this.clone(true); // Clone Wrap
                    thisClone.find('.menu-item').addClass('clone-menu-item');

                    thisClone.find('[id]').each(function () {
                        // Change all tab links with href = this id
                        thisClone.find('.vc_tta-panel-heading a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + urus_menuadd_string_prefix($(this).attr('id'), 'urus-menu-clone-'));
                        thisClone.find('.urus-menu-tabs .tabs-link a[href="#' + $(this).attr('id') + '"]').attr('href', '#' + urus_menuadd_string_prefix($(this).attr('id'), 'urus-menu-clone-'));
                        $(this).attr('id', urus_menuadd_string_prefix($(this).attr('id'), 'urus-menu-clone-'));
                    });

                    thisClone.find('.urus-menu-menu').addClass('urus-menu-menu-clone');

                    // Create main panel if not exists

                    var thisMainPanel = $('.urus-menu-clone-wrap .urus-menu-panels #urus-menu-panel-main ul');
                    thisMainPanel.append(thisClone.html());

                    urus_menu_insert_children_panels_html_by_elem(thisMainPanel, i);
                }
            });
        }).trigger('urus_menuclone_all_menus');
    };

    // i: For next nav target
    function urus_menu_insert_children_panels_html_by_elem($elem, i) {
        if ( $elem.find('.menu-item-has-children').length ) {
            $elem.find('.menu-item-has-children').each(function () {
                var thisChildItem = $(this);
                urus_menu_insert_children_panels_html_by_elem(thisChildItem, i);
                var next_nav_target = 'urus-menu-panel-' + i;

                // Make sure there is no duplicate panel id
                while ( $('#' + next_nav_target).length ) {
                    i++;
                    next_nav_target = 'urus-menu-panel-' + i;
                }
                // Insert Next Nav
                thisChildItem.prepend('<a class="urus-menu-next-panel" href="#' + next_nav_target + '" data-target="#' + next_nav_target + '"></a>');

                // Get sub menu html
                var sub_menu_html = $('<div>').append(thisChildItem.find('> .sub-menu').clone()).html();
                thisChildItem.find('> .sub-menu').remove();

                $('.urus-menu-clone-wrap .urus-menu-panels').append('<div id="' + next_nav_target + '" class="urus-menu-panel urus-menu-sub-panel urus-menu-hidden">' + sub_menu_html + '</div>');
            });
        }
    }

    function urus_menuadd_string_prefix(str, prefix) {
        return prefix + str;
    }

    function urus_menuget_url_var(key, url) {
        var result = new RegExp(key + "=([^&]*)", "i").exec(url);
        return result && result[ 1 ] || "";
    }

    // BOX MOBILE MENU
    $(document).on('click', '.menu-toggle', function (e) {
        $('.urus-menu-clone-wrap').addClass('open');
        e.preventDefault();
    });
    // Close box menu
    $(document).on('click', '.urus-menu-clone-wrap .urus-menu-close-panels', function (e) {
        $('.urus-menu-clone-wrap').removeClass('open');
        e.preventDefault();
    });
    $(document).on('click', function (event) {
        if ( $('body').hasClass('rtl') ) {
            if ( event.offsetX < 0 )
                $('.urus-menu-clone-wrap').removeClass('open');
        } else {
            if ( event.offsetX > $('.urus-menu-clone-wrap').width() )
                $('.urus-menu-clone-wrap').removeClass('open');
        }
    });

    // Open next panel
    $(document).on('click', '.urus-menu-next-panel', function (e) {
        var $this     = $(this),
            thisItem  = $this.closest('.menu-item'),
            thisPanel = $this.closest('.urus-menu-panel'),
            target_id = $this.attr('href');

        if ( $(target_id).length ) {
            thisPanel.addClass('urus-menu-sub-opened');
            $(target_id).addClass('urus-menu-panel-opened').removeClass('urus-menu-hidden').attr('data-parent-panel', thisPanel.attr('id'));
            // Insert current panel title
            var item_title     = thisItem.children('a').text(),
                firstItemTitle = '';

            if ( $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').length > 0 ) {
                firstItemTitle = $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').html();
            }

            if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                if ( !$('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').length ) {
                    $('.urus-menu-panels-actions-wrap').prepend('<span class="urus-menu-current-panel-title"></span>');
                }
                $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').html(item_title);
            }
            else {
                $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').remove();
            }

            // Back to previous panel
            $('.urus-menu-panels-actions-wrap .urus-menu-prev-panel').remove();
            $('.urus-menu-panels-actions-wrap').prepend('<a data-prenttitle="' + firstItemTitle + '" class="urus-menu-prev-panel" href="#' + thisPanel.attr('id') + '" data-cur-panel="' + target_id + '" data-target="#' + thisPanel.attr('id') + '"></a>');
        }

        e.preventDefault();
    });

    // Go to previous panel
    $(document).on('click', '.urus-menu-prev-panel', function (e) {
        var $this        = $(this),
            cur_panel_id = $this.attr('data-cur-panel'),
            target_id    = $this.attr('href');

        $(cur_panel_id).removeClass('urus-menu-panel-opened').addClass('urus-menu-hidden');
        $(target_id).addClass('urus-menu-panel-opened').removeClass('urus-menu-sub-opened');

        // Set new back button
        var new_parent_panel_id = $(target_id).attr('data-parent-panel');
        if ( typeof new_parent_panel_id == 'undefined' || typeof new_parent_panel_id == false ) {
            $('.urus-menu-panels-actions-wrap .urus-menu-prev-panel').remove();
            $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').html('MAIN MENU');
        }
        else {
            $('.urus-menu-panels-actions-wrap .urus-menu-prev-panel').attr('href', '#' + new_parent_panel_id).attr('data-cur-panel', target_id).attr('data-target', '#' + new_parent_panel_id);
            // Insert new panel title
            var item_title = $('#' + new_parent_panel_id).find('.urus-menu-next-panel[data-target="' + target_id + '"]').closest('.menu-item').find('.urus-menu-item-title').attr('data-title');
            item_title     = $(this).data('prenttitle');
            if ( typeof item_title != 'undefined' && typeof item_title != false ) {
                if ( !$('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').length ) {
                    $('.urus-menu-panels-actions-wrap').prepend('<span class="urus-menu-current-panel-title"></span>');
                }
                $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').html(item_title);
            }
            else {
                $('.urus-menu-panels-actions-wrap .urus-menu-current-panel-title').remove();
            }
        }

        e.preventDefault();
    });

    // Open vartical menu
    $(document).on('click', '.block-title', function () {
        $(this).closest('.vertical-wrapper').find('.urus-menu-wapper.vertical.support-mega-menu').urus_auto_width_vertical_menu();
    });
    /* ---------------------------------------------
     Scripts load
     --------------------------------------------- */
    window.addEventListener('load',
        function (ev) {
            $('.urus-clone-mobile-menu').urus_menuclone_all_menus();
            $('.main-menu .item-megamenu').urus_resize_megamenu();
            $('.vertical-menu .item-megamenu').urus_responsive_vertical_menu_width();
        }, false);

})(jQuery); // End of use strict