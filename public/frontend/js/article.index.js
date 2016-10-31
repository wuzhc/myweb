$(document).ready(function () {

    $.goup({
        trigger: 100,
        bottomOffset: 150,
        locationOffset: 80,
        title: '',
        titleAsText: true,
        goupSpeed:'fast',
    });

    $("#search-article").on("click",function(){
        $("#form-search").submit();
    });

});

function onKeyDown(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if(e && e.keyCode==27){ // 按 Esc
        //要做的事情
    }
    if(e && e.keyCode==113){ // 按 F2
        //要做的事情
    }
    if(e && e.keyCode==13){ // enter 键
        $("#form-search").submit();
    }

}