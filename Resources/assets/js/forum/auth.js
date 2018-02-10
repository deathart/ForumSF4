let Auth;
Auth = (function () {

    const that = {};

    /**
     * Init
     */
    that.init = function () {
        that.register();
    };

    /**
     * Registration management
     */
    that.register = function() {

        const bloc_charter = $(".charter");
        const bloc_form_register = $(".form-register-bloc");

        $(".next-go-form").click(function() {
            bloc_charter.fadeOut("slow", function() {
                bloc_form_register.fadeIn("slow")
            });
        });

    };

    return that;

})();

$(document).ready(function() {
    Auth.init();
});