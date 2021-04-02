require(['jquery', 'jquery/ui', 'mage/url'], function($){
    $("#element").on("dimensionsChanged", function (event, data) {
        var opened = data.opened;

        if (opened) {
            // do something when the content is opened
            $.ajax({
                showLoader: true,
                url: '/widget/index/ResultJson',
                data: 'ajax=1',
                type: "POST",
                dataType: 'json'
            }).done(function (data) {
                $('#jsonresponse').prepend('<p>'+JSON.stringify(data)+'</p>');
            });

            return;
        }
        // do something when the content is closed
            $('#jsonresponse>p:first-child').remove();
    });
});
