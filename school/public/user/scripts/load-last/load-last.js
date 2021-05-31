function configIframe() {
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        //var target = $(e.target);
        var href = $(e.target).attr("href");
        var targetIframe = $(href).find('iframe');
        if (targetIframe.attr('src') !== undefined && targetIframe.attr('src').length > 0) {
            return;
        }
        if ($(href).find('.loading-icon').length > 0) {
            $(href).find('.loading-icon').show();
        }
        if (targetIframe.attr("data-src") !== undefined && targetIframe.attr("data-src").length > 0) {
            targetIframe.attr('src', targetIframe.attr("data-src"));
        }
        $(href).find('iframe').on('load',function () {
            if ($('.loading-icon').length > 0) {
                $('.loading-icon').hide();
            }
        });
    });

    // Write the following loading in $(window).load we can hide loading-icon with iframe.load
    // this use for loading all tools
    $('iframe').each(function () {
        var iframe = $(this);
        if (iframe.attr("ea-src") !== undefined && iframe.attr("ea-src").length > 0) {
            this.src = iframe.attr("ea-src");
        }
        //this.src = this.src;
    });
    $('iframe.eurolandtool').on('load', function(){
        if ($('.loading-icon').length > 0) {
                $('.loading-icon').hide();
            }
    })
    $(".eurolandtool").each(function () {
        var iframe = $(this);
        EurolandToolIntegrationObject.set(iframe.attr("id"));
    });
}

$(document).ready(function () {
    configIframe();
});           
                
                