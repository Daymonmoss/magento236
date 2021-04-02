require(['jquery', 'mage/url', 'Konsol_Landing/js/bootstrap.bundle.min'], function ($, urlBuilder, bootstrap) {
        //$(".loading-mask").loader("hide");
        $("#return").hide();
        $(function () {
            $(window).scroll(function () {
                $(this).scrollTop() > 450 ? $("#return").fadeIn() : $("#return").fadeOut()
            });
        });

        $(function () {

            $(".button").click(function () {

                var name = $("input#name").val();
                if (name == "") {

                    $("input#name").focus();
                    return false;
                }
                var email = $("input#email").val();
                if (email == "") {

                    $("input#email").focus();
                    return false;
                }
                var name = $("input#subject").val();
                if (name == "") {

                    $("input#subject").focus();
                    return false;
                }
                var name = $("input#message").val();
                if (name == "") {

                    $("input#message").focus();
                    return false;
                }

            });

        });

        $(function () {
            var dataString = 'name=' + name + '&email=' + email + '&subject=' + subject + '&message=' + message;
            $.ajax({
                type: "POST",
                url: "Konsol_Landing::php/mailer.php",
                data: dataString,
                success:
                    console.log("OK")
            });
            return false;
        });

});


