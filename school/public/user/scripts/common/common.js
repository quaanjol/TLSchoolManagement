
$(document).ready(function () {

    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if (activeTab) {       
        $('#myTabs a[href="' + activeTab + '"]').tab('show');
    }  
});

//local active
function activaTab(tab) {
    //$('#myTabs li:eq(1) a').tab('show');

    var hash = location.hash.substr(1);
    console.log(hash);

    $("#myTabs li").removeClass("active");
    $("#myTabs li a[href='#" + hash.toLowerCase() + "']").parent().addClass('active');

    $(".tab-content .tab-pane").removeClass("active in");
    var targetActive = $(".tab-content #" + hash.toLowerCase());
    targetActive.addClass("active in");

   // $('#myTabs a[href="#' + tab + '"]').tab('show');
    //$('#myTabs a[href="#name"]').tab('show');
    //$('.tab-head .nav a[href="#' + tab + '"]').tab('show');
};

function ChangeUrl(page, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Page: page, Url: url };
        history.pushState(obj, obj.Page, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}
function naviTab() {
    var hash = location.hash.substr(1);
    if (hash.length > 0) {
        $(".tab-head .nav li").removeClass("active");
        $(".tab-head .nav li a[href='#" + hash.toLowerCase() + "']").parent().addClass('active');
        $(".tab-content .tab-pane").removeClass("active in");
        var targetActive = $(".tab-content #" + hash.toLowerCase());
        targetActive.addClass("active in");

        targetActive = targetActive.find("iframe");
        if (targetActive.attr("data-src") !== undefined && targetActive.attr("data-src").length > 0) {
            targetActive.attr('src', targetActive.attr("data-src"));
        }
        if (targetActive.attr("ea-src") !== undefined && targetActive.attr("ea-src").length > 0) {
            targetActive.attr('src', targetActive.attr("ea-src"));
        }
        //$('iframe.eurolandtool').on('load', function () {

        targetActive.on('load', function () {
            if ($('.loading-icon').length > 0) {
                $('.loading-icon').hide();
            }
        });
    }
}