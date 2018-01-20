var App;
App = (function() {

    var that = {};

    /**
     * @return {string}
     */
    that.GetBaseUrl = function() {
        return window.location.protocol + "//" + window.location.host + "/";
    };

    /**
     * @return {string}
     */
    that.GetSegmentUrl = function(segment) {
        var pathArray = window.location.pathname.split('/');
        return pathArray[segment];
    };

    that.init = function() {
        $(function() {
            $('[data-toggle="tooltip"]').tooltip({
                container: "body"
            })
        });
        that.scroll_top();
        if (that.GetSegmentUrl(1) != "topic") {
            that.ChatBox();
        }
    };

    that.ChatBox = function() {
        var divmessages = $('.scroll-chatbox-messages');
        var divusers = $('.scroll-chatbox-users');
        var expandbtn = $('.expand-chat');

        //Initialize scrollbar
        divmessages.scrollTop(divmessages[0].scrollHeight);
        divmessages.scrollbar();
        divusers.scrollbar();

        //Expand chatbox
        if (!Cookies.get('chatbox_expanded')) {
            Cookies.set("chatbox_expanded", "container")
        }

        $(".chatbox-bloc").parent().addClass(Cookies.get('chatbox_expanded'));

        $(".chatbox-bloc").slideToggle();

        expandbtn.click(function() {
            if ($(".chatbox-bloc").parent().hasClass("container")) {
                $(".chatbox-bloc").parent().removeClass("container").addClass("container-fluid");
                Cookies.set("chatbox_expanded", "container-fluid")
            } else {
                $(".chatbox-bloc").parent().removeClass("container-fluid").addClass("container");
                Cookies.set("chatbox_expanded", "container")
            }
        });

    };
    that.scroll_top = function() {
        $(document).on('scroll', function() {
            if ($(window).scrollTop() > 100) {
                $('.scroll-top-wrapper').addClass('show');
                $("header").addClass("fixed");
                $("body").css("margin-top", "25px");
            } else {
                $('.scroll-top-wrapper').removeClass('show');
                $("header").removeClass("fixed");
                $("body").css("margin-top", "56px");
            }
        });

        $('.scroll-top-wrapper').on('click', scrollToTop);

        function scrollToTop() {
            verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
            element = $('body');
            offset = element.offset();
            offsetTop = offset.top;
            $('html, body').animate({
                scrollTop: offsetTop
            }, 500, 'linear');
        }
    };


    return that;

})();

$(document).ready(function() {
    App.init();
});