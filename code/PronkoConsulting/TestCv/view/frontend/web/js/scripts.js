require(['jquery', 'jquery/ui', 'PronkoConsulting_TestCv/js/bootstrap.bundle.min'], function ($, bootstrap) {
    $('a').click(function() {
        return false;
    }).dblclick(function() {
        a = this.elem.getAttribute('target');
        console.log(a);
        window.open(this.href, 'a');
        return false;
    });

    $("#sidepanel").click(function () {
        if ($(".main").css("left") == "-215px") {
            $(".main").css({left: "initial"});
            $("#sidepanel").css({transform: "rotate(180deg)"});
        } else {
            $(".main").css({left: "-215px"});
            $("#sidepanel").css({transform: "initial"});
        }
    });

    $("#return").hide();
    $(window).scroll(function () {
        $(this).scrollTop() > 450 ? $("#return").fadeIn() : $("#return").fadeOut()
    });
    $("#return").click(function () {
        $("html, body").animate({scrollTop:0}, 1000, 'swing')
    });

    if ($(window).width() < 1000) {
        $("#sidepanel").remove();
    } else {
        if ($("#sidepanel").length < 1){
            $("h2").prepend('<button id="sidepanel"><svg x="0px" y="0px" viewBox="0 0 337.792 337.792"><path d="M337.792,134.824l-130.824,99.441v-52.216C117.061,173.419,30.735,207.817,0.001,302.41 C-0.337,180.728,99.895,111.781,206.968,88.488V35.382L337.792,134.824z"/></svg></button>')
        }
    }

    if ($(window).width() > 1000) {
        $("header").draggable({
            cursor: "ew-resize",
            axis: "x",
            cursorAt: {right: 0},
            distance: 0,
            containment: [0,0,210,0],
            drag: function () {
                $('body').draggable({ axis: "x"});
            }
        });
    }
});


