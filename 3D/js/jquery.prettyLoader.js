(function(e) {
    e.prettyLoader = {
        version: "1.0.1"
    };
    e.prettyLoader = function(t) {
        function n() {
            if (self.pageYOffset) {
                return {
                    scrollTop: self.pageYOffset,
                    scrollLeft: self.pageXOffset
                };
            } else if (document.documentElement && document.documentElement.scrollTop) {
                return {
                    scrollTop: document.documentElement.scrollTop,
                    scrollLeft: document.documentElement.scrollLeft
                };
            } else if (document.body) {
                return {
                    scrollTop: document.body.scrollTop,
                    scrollLeft: document.body.scrollLeft
                };
            }
        }
        t = jQuery.extend({
            animation_speed: "fast",
            bind_to_ajax: false,
            delay: false,
            loader: "/_ui/images/prettyLoader/loading.gif",
            offset_top: 13,
            offset_left: 10
        }, t);
        scrollPos = n();
        imgLoader = new Image;
        imgLoader.onerror = function() {
            alert("Preloader image cannot be loaded. Make sure the path is correct in the settings and that the image is reachable.");
        };
        imgLoader.src = t.loader;
        if (t.bind_to_ajax) jQuery(document).ajaxStart(function() {
            e.prettyLoader.show();
        }).ajaxStop(function() {
            e.prettyLoader.hide();
        });
        e.prettyLoader.positionLoader = function(n) {
            var topData = Math.max(0, ($(window).height() -  70) / 2 + $(document).scrollTop());
            var leftData = ($(window).width() -  70) / 2 + $(document).scrollLeft();
            e(".prettyLoader").css({
                top: topData,
                left: leftData
            });
        };
        e.prettyLoader.show = function(r) {
            if (e(".prettyLoader").size() > 0) return;
            scrollPos = n();
            e("<div></div>").addClass("prettyLoader").addClass("prettyLoader_" + t.theme).appendTo("body").hide();
            if (e.browser.msie && e.browser.version == 6) e(".prettyLoader").addClass("pl_ie6");
            e("<img />").attr("src", t.loader).appendTo(".prettyLoader");
            e(".prettyLoader").fadeIn(t.animation_speed);
            e(document).bind("click", e.prettyLoader.positionLoader);
            e(document).bind("mousemove", e.prettyLoader.positionLoader);
            e(window).scroll(function() {
                scrollPos = n();
                e(document).triggerHandler("mousemove");
            });
            r = r ? r : t.delay;
            if (r) {
                setTimeout(function() {
                    e.prettyLoader.hide();
                }, r);
            }
        };
        e.prettyLoader.hide = function() {
            e(document).unbind("click", e.prettyLoader.positionLoader);
            e(document).unbind("mousemove", e.prettyLoader.positionLoader);
            e(".prettyLoader").fadeOut(t.animation_speed, function() {
                e(this).remove();
            });
        };
        return this;
    };
})(jQuery);