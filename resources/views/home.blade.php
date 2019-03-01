<!DOCTYPE html>
<html>
    <head>
        <title>LingFM</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="lingfm.css">
    </head>
    <body>
        <div id="player"></div>
        <div id="player-wrapper">
            <div class="m-seek-bar jp-seek-bar" style="width:100%;">
                <div class="m-play-bar jp-play-bar" style="width:0;overflow:hidden;"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="left">
                        <span id="name">LingFM</span>
                    </div>
                    <div class="right">
      	                <span class="glyphicon glyphicon-search fm-icon" id="sicon" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-random jp-repeat fm-icon" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-repeat jp-repeat-off fm-icon" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-play jp-play fm-icon" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-pause jp-pause fm-icon" aria-hidden="true"></span>
                        <span class="glyphicon glyphicon-forward fm-icon" id="next" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="search-box">
            <input type="text" class="sinput" value="Serach...">
            <div id="sline-box">
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jplayer@2.9.2/dist/jplayer/jquery.jplayer.min.js"></script>
        <script src="lingfm.js"></script>
    </body>
</html>