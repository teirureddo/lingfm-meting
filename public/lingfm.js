var historylist = [];

$(document).ready(function() {
    var player = $("#player"),
        next = $("#player-wrapper #next"),
        name = $("#player-wrapper #name"),
        sicon = $("#player-wrapper #sicon"),
        img = $("body"),
        repeat = $(".jp-repeat"),
        title = $("title").html();
    var count = 0, stime, pxhr;
    var timeoutImage = "";
    var errorlimit = 0; //错误次数限制

    //是否是已播放的ID
    function isHistoryID(id) {
        if(historylist.length == count){
            historylist = [];
        }
        for (var i = historylist.length - 1; i >= 0; i--) {
            if (id == historylist[i]) {
                return true;
            }
        }
        return false;
    }

    //取随机不重复ID
    function randomID() {
        var id = Math.ceil(Math.random() * count);
        if (isHistoryID(id)) {
            return randomID();
        }
        else{
            return id;
        }
    }

    //获取信息并播放音乐
    function playMusic(id) {
        if(pxhr){
            pxhr.abort();
        }
        pxhr = $.ajax({
            url: "/api/music",
            data:{ id:id },
            dataType: "json",
            timeout: 30000,
            success: function (result) {
                name.text(result.name);
                player.jPlayer("setMedia", { oga:result.music }).jPlayer("play");

                if (document.hidden) { //如果此标签页未显示则不加载图片
                    timeoutImage = result.image; //设定延迟加载图片
                } else {
                    img.css("background-image", "url(" + result.image + ")");
                }

                if (!isHistoryID(result.id)) {
                    window.history.pushState({}, "", "#" + result.id);
                    historylist.push(result.id);
                }

                $("title").html(result.name + " - " + title);
            },
            error: function(textStatus) {
                if (textStatus == "abort") {
                    name.text("Canceled");
                }
                else {
                    if (errorlimit < 4) {
                        errorlimit = errorlimit + 1;
                        playMusic(randomID());
                    }
                    else {
                        name.text("Error(1)");
                        errorlimit = 0;
                    }
                }
            }
        });
    }

    //获取最大ID并播放初始音乐
    $.ajax({
        url: "/api/count",
        dataType: "json",
        success: function (result) {
            count = result.count;

            //因为异步请求，等这个请求返回后再初始音乐
            if(window.location.hash) {
                playMusic(window.location.hash.replace(/#/,""));
            }
            else {
                playMusic(randomID());
            }
        }
    });

    //播放完毕切歌 (这是播放器对象)
    player.jPlayer({
        ended: function() {
            if (repeat.css("display") == "none") {
                player.jPlayer("play");
            }else {
                playMusic(randomID());
            }
        },
        error: function() {    
            if (errorlimit < 4) {
                errorlimit = errorlimit + 1;
                playMusic(randomID());
            }
            else {
                name.text("Error(2)");
                errorlimit = 0;
            }      
        },
        supplied:"oga",
        solution:"html",
        volume: 1,
        cssSelectorAncestor: "#player-wrapper"
    });

    //下一个
    next.click(function() {
        player.jPlayer("pause");
        name.text("Loading...");
        playMusic(randomID());
    });

    //Hash改变后playMusic
    window.onhashchange = function(){
        if(window.location.hash) {
            player.jPlayer("pause");
            name.text("Loading...");
            playMusic(window.location.hash.replace(/#/,""));
        }
    };

    //搜索
    function serach(searchString) {
        $("#sline-box").html("");
        $("#sline-box").append("<div class=\"sline\">Serach...</div>");

        $.ajax({
            url: "/api/search",
            data: { name:searchString },
            dataType: "json",
            timeout: 30000,
            success: function (result) {
                $("#sline-box").html("");
                if (result.length == 0) {
                    $("#sline-box").append("<div class=\"sline\">None...</div>");
                }
                else{
                    $(result).each(function () {
                        $("#sline-box").append("<div class=\"sline\"><a href=\"#" + this.id + "\">" + this.name + "</a></div>");
                    });
                }
            },
            error: function() {
                $("#sline-box").html("");
                $("#sline-box").append("<div class=\"sline\">Error...</div>");
            }
        });
    }

    //回车搜索
    $(".sinput").on("keypress",function(event){
        clearTimeout(stime);
        stime = setTimeout(function () {
            var sinputVal = $(".sinput").val();
            if (event.keyCode == 13 && sinputVal != "") {
                serach(sinputVal);
            }
        }, 500);
    });

    //搜索图标
    sicon.click(function() {
        if ($("#search-box").css("display") == "none") {
            $("#search-box").css("display","block");
        }else {
            $("#search-box").css("display","none");
        }
    });

    //空格播放暂停
    $(document).on("keypress",function(event){
        if (event.keyCode == 32 && event.target.nodeName != "INPUT") {
            if ($(".jp-pause").css("display") == "none") {
                //如果暂停按钮不显示 未播放
                $(".jp-play").click();
            }else {
                //如果暂停按钮显示 播放中
                $(".jp-pause").click();
            }
        }
    });

    //打开标签页后加载被延迟图片
    $(document).on("visibilitychange", function (event) {
        if (event.target.visibilityState === "visible") {
            if (timeoutImage != "") {
                img.css("background-image", "url(" + timeoutImage + ")");
                timeoutImage = "";
            }
        }
    });

});