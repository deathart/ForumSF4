let App;
App = (function () {

    const that = {};

    /**
     * @return {string}
     */
    that.GetBaseUrl = function () {
        return window.location.protocol + "//" + window.location.host + "/";
    };

    /**
     * @return {string}
     */
    that.GetSegmentUrl = function (segment) {
        const pathArray = window.location.pathname.split('/');
        return pathArray[segment];
    };

    that.init = function () {

        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                container: "body"
            })
        });

        that.DeleteAllCookies();
        that.scroll_top();

        if (that.GetSegmentUrl(1) !== "topic") {
            that.ChatBox();
        }

        that.Auth();
    };

    that.ChatBox = function () {
        const divmessages = $('.scroll-chatbox-messages');
        const divusers = $('.scroll-chatbox-users');
        const divbloc = $(".chatbox-bloc");
        const expandbtn = $('.expand-chat');
        const collapsebtn = $('.collapse-chat');

        //Initialize scrollbar
        divmessages.scrollbar();
        divusers.scrollbar();

        //Collapse chatbox
        if(!Cookies.get('chatbox_collapse')) {
            Cookies.set('chatbox_collapse', 'minus');
            collapsebtn.addClass("fa-minus");
        }
        else {
            if(Cookies.get('chatbox_collapse') === "minus") {
                collapsebtn.addClass("fa-minus");
                divbloc.children('.content').addClass("show");
            }
            else {
                collapsebtn.addClass("fa-plus");
                divbloc.children('.content').removeClass("show");
            }
        }

        collapsebtn.click(function() {
            if(collapsebtn.hasClass("fa-minus")) {
                collapsebtn.removeClass("fa-minus").addClass("fa-plus");
                Cookies.set('chatbox_collapse', 'plus');
                divbloc.children('.content').collapse('toggle');
            }
            else {
                collapsebtn.removeClass("fa-plus").addClass("fa-minus");
                Cookies.set('chatbox_collapse', 'minus');
                divbloc.children('.content').collapse('toggle');
            }
        });

        //Expand chatbox
        if (!Cookies.get('chatbox_expanded')) {
            Cookies.set("chatbox_expanded", "container-fluid")
        }

        divbloc.parent().addClass(Cookies.get('chatbox_expanded'));

        divbloc.slideToggle();

        expandbtn.click(function () {
            if (divbloc.parent().hasClass("container")) {
                divbloc.parent().removeClass("container").addClass("container-fluid");
                Cookies.set("chatbox_expanded", "container-fluid")
            }
            else {
                divbloc.parent().removeClass("container-fluid").addClass("container");
                Cookies.set("chatbox_expanded", "container")
            }
        });

        divmessages.scrollTop(divmessages[0].scrollHeight);

    };
    that.scroll_top = function () {

        const scrollwrapper = $('.scroll-top-wrapper');

        $(window).on('scroll', function () {
            if ($(this).scrollTop() > 100) {
                if($(this).scrollTop() > $(document).height() - $(this).height() - 100) {
                    scrollwrapper.css("bottom", "230px");
                }
                else {
                    scrollwrapper.css("bottom", "30px");
                }
                scrollwrapper.show();
                $("header").addClass("fixed");
                $("body").css("margin-top", "25px");
            } else {
                scrollwrapper.hide();
                $("header").removeClass("fixed");
                $("body").css("margin-top", "56px");
            }
        });

        scrollwrapper.click(function () {
            $("html, body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });

    };

    that.DeleteAllCookies = function() {
        $(".delallcookies").click(function() {
            Object.keys(Cookies.get()).forEach(function(cookieName) {
                Cookies.remove(cookieName);
            });
            that.Notifications('success', 'Remove cookies', 'All cookies have been successfully deleted page reload in 3 seconds.');
            setTimeout(function() {
                location.reload();
            }, 3000);
        });
    };

    that.Auth = function() {

        const is_authenticated = $(".navbar-login").data('is-authenticated');

        if(is_authenticated) {
            //IF LOGIN
        }
        else {
            $(".modal-login-btn").click(function() {
                $(".modal-login").modal('show');
            });
        }

    };

    that.Notifications = function(type, title, content, position) {
        return $.toast({
            text: content,
            heading: title,
            icon: type,
            showHideTransition: 'fade',
            allowToastClose: true,
            hideAfter: 5000,
            stack: 5,
            position: position || 'bottom-center',
            textAlign: 'center',
            loader: true,
            loaderBg: '#9EC600'
        });
    };

    return that;

})();

$(document).ready(function() {
    App.init();
});