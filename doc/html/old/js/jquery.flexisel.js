(function ($) {
    $.fn.flexisel = function (options) {
        var defaults = $.extend({
            visibleItems: 5,
            animationSpeed: 200,
            autoPlay: false,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            setMaxWidthAndHeight: false,
            enableResponsiveBreakpoints: true,
            clone: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint: 480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint: 640,
                    visibleItems: 2
                },
                tablet: {
                    changePoint: 768,
                    visibleItems: 4
                }
            }
        }, options);
        var object = $(this);
        var settings = $.extend(defaults, options);
        var itemsWidth;
        var canNavigate = true;
        var itemsVisible = settings.visibleItems;
        var totalItems = object.children().length;
        var responsivePoints = [];
        var methods = {
            init: function () {
                return this.each(function () {
                    methods.appendHTML();
                    methods.setEventHandlers();
                    methods.initializeItems();
                });
            },
            initializeItems: function () {
                var listParent = object.parent();
                var innerHeight = listParent.height();
                var childSet = object.children();
                methods.sortResponsiveObject(settings.responsiveBreakpoints);
                var innerWidth = listParent.width();
                itemsWidth = (innerWidth) / itemsVisible;
                childSet.width(itemsWidth);
                if (settings.clone) {
                    childSet.last().insertBefore(childSet.first());
                    childSet.last().insertBefore(childSet.first());
                    object.css({
                        'left': -itemsWidth
                    });
                }
                object.fadeIn();
                $(window).trigger("resize");
            },
            appendHTML: function () {
                object.addClass("nbs-flexisel-ul");
                object.wrap("<div class='nbs-flexisel-container'><div class='nbs-flexisel-inner'></div></div>");
                object.find("li").addClass("nbs-flexisel-item");
                if (settings.setMaxWidthAndHeight) {
                    var baseWidth = $(".nbs-flexisel-item img").width();
                    var baseHeight = $(".nbs-flexisel-item img").height();
                    $(".nbs-flexisel-item img").css("max-width", baseWidth);
                    $(".nbs-flexisel-item img").css("max-height", baseHeight);
                }
                $("<div class='nbs-flexisel-nav-left'></div><div class='nbs-flexisel-nav-right'></div>").insertAfter(object);
                if (settings.clone) {
                    var cloneContent = object.children().clone();
                    object.append(cloneContent);
                }
            },
            setEventHandlers: function () {
                var listParent = object.parent();
                var childSet = object.children();
                var leftArrow = listParent.find($(".nbs-flexisel-nav-left"));
                var rightArrow = listParent.find($(".nbs-flexisel-nav-right"));
                $(window).on("resize", function (event) {
                    methods.setResponsiveEvents();
                    var innerWidth = $(listParent).width();
                    var innerHeight = $(listParent).height();
                    itemsWidth = (innerWidth) / itemsVisible;
                    childSet.width(itemsWidth);
                    if (settings.clone) {
                        object.css({
                            'left': -itemsWidth
                        });
                    } else {
                        object.css({
                            'left': 0
                        });
                    }
                    var halfArrowHeight = (leftArrow.height()) / 2;
                    var arrowMargin = (innerHeight / 2) - halfArrowHeight;
                    leftArrow.css("top", arrowMargin + "px");
                    rightArrow.css("top", arrowMargin + "px");
                });
                $(leftArrow).on("click", function (event) {
                    methods.scrollLeft();
                });
                $(rightArrow).on("click", function (event) {
                    methods.scrollRight();
                });
                if (settings.pauseOnHover == true) {
                    $(".nbs-flexisel-item").on({
                        mouseenter: function () {
                            canNavigate = false;
                        },
                        mouseleave: function () {
                            canNavigate = true;
                        }
                    });
                }
                if (settings.autoPlay == true) {
                    setInterval(function () {
                        if (canNavigate == true)
                            methods.scrollRight();
                    }, settings.autoPlaySpeed);
                }
            },
            setResponsiveEvents: function () {
                var contentWidth = $('html').width();
                if (settings.enableResponsiveBreakpoints) {
                    var largestCustom = responsivePoints[responsivePoints.length - 1].changePoint;
                    for (var i in responsivePoints) {
                        if (contentWidth >= largestCustom) {
                            itemsVisible = settings.visibleItems;
                            break;
                        } else {
                            if (contentWidth < responsivePoints[i].changePoint) {
                                itemsVisible = responsivePoints[i].visibleItems;
                                break;
                            } else
                                continue;
                        }
                    }
                }
            },
            sortResponsiveObject: function (obj) {
                var responsiveObjects = [];
                for (var i in obj) {
                    responsiveObjects.push(obj[i]);
                }
                responsiveObjects.sort(function (a, b) {
                    return a.changePoint - b.changePoint;
                });
                responsivePoints = responsiveObjects;
            },
            scrollLeft: function () {
                if (object.position().left < 0) {
                    if (canNavigate == true) {
                        canNavigate = false;
                        var listParent = object.parent();
                        var innerWidth = listParent.width();
                        itemsWidth = (innerWidth) / itemsVisible;
                        var childSet = object.children();
                        object.animate({
                            'left': "+=" + itemsWidth
                        }, {
                            queue: false,
                            duration: settings.animationSpeed,
                            easing: "linear",
                            complete: function () {
                                if (settings.clone) {
                                    childSet.last().insertBefore(childSet.first());
                                }
                                methods.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                }
            },
            scrollRight: function () {
                var listParent = object.parent();
                var innerWidth = listParent.width();
                itemsWidth = (innerWidth) / itemsVisible;
                var difObject = (itemsWidth - innerWidth);
                var objPosition = (object.position().left + ((totalItems - itemsVisible) * itemsWidth) - innerWidth);
                if ((difObject < Math.ceil(objPosition)) && (!settings.clone)) {
                    if (canNavigate == true) {
                        canNavigate = false;
                        object.animate({
                            'left': "-=" + itemsWidth
                        }, {
                            queue: false,
                            duration: settings.animationSpeed,
                            easing: "linear",
                            complete: function () {
                                methods.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                } else if (settings.clone) {
                    if (canNavigate == true) {
                        canNavigate = false;
                        var childSet = object.children();
                        object.animate({
                            'left': "-=" + itemsWidth
                        }, {
                            queue: false,
                            duration: settings.animationSpeed,
                            easing: "linear",
                            complete: function () {
                                childSet.first().insertAfter(childSet.last());
                                methods.adjustScroll();
                                canNavigate = true;
                            }
                        });
                    }
                };
            },
            adjustScroll: function () {
                var listParent = object.parent();
                var childSet = object.children();
                var innerWidth = listParent.width();
                itemsWidth = (innerWidth) / itemsVisible;
                childSet.width(itemsWidth);
                if (settings.clone) {
                    object.css({
                        'left': -itemsWidth
                    });
                }
            }
        };
        if (methods[options]) {
            return methods[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof options === 'object' || !options) {
            return methods.init.apply(this);
        } else {
            $.error('Method "' + method + '" does not exist in flexisel plugin!');
        }
    };
})(jQuery);
$(window).load(function () {
    $("#flexiselDemo1").flexisel({
        visibleItems: 4,
        animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 991,
                visibleItems: 2
            },
            laptop: {
                changePoint: 1200,
                visibleItems: 3
            }
        }
    });
    
        $("#flexiselDemo2").flexisel({
        visibleItems: 4,
        animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 991,
                visibleItems: 2
            },
            laptop: {
                changePoint: 1200,
                visibleItems: 3
            }
        }
    });
    
    $("#flexiselDemo3").flexisel({
        visibleItems: 5,
        animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
            portrait: {
                changePoint: 480,
                visibleItems: 1
            },
            landscape: {
                changePoint: 640,
                visibleItems: 2
            },
            tablet: {
                changePoint: 991,
                visibleItems: 2
            },
            laptop: {
                changePoint: 1200,
                visibleItems: 3
            }
        }
    });
  
});