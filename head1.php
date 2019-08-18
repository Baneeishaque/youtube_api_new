<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Cache-Control" content="max-age=600" />
        <?php print'<title>' . $title . ' - Download</title>'; ?>

        <?php print'<meta name="keywords" content="' . $title . ', Download On Mobile, search youtube videos, youtube downloader, youtube hd videos, search mobile vdeos, youtube mp3"/>'; ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <link rel="icon" href="http://whatsapp8.com/favicon.ico" type="image/x-icon"/>
        <?php print'<meta name="description" content="' . $title . ' Download this video on mobile"/>'; ?>
        <meta name="robots" content="all,index,follow" />
        <meta name="googlebot" content="all,index,follow"/>

        <meta http-equiv="content-language" content="en"/>


        <meta name="copyright" content="(c) WhatsApp8.com"/>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-54343146-1', 'auto');
            ga('send', 'pageview');

        </script>
        <style type="text/css">
            body
            {
                max-width : 728px;
                font-family : Verdana , arial;
                font-weight : 400;

                color : rgb(51 , 51 , 51);
                background-color : rgb(255 , 255 , 255);
            }
            a:active, a:visited, a:link
            {
                color : rgb(41 , 74 , 156);
                text-decoration : none;
            }
            a:hover
            {
                color : rgb(78 , 114 , 162);
                text-decoration : underline;
            }
            hr
            {
                margin-top : 2px;
                margin-bottom : 2px;
                background-color : rgb(194 , 203 , 223);
                color : rgb(188 , 197 , 217);
                border : none;
                height : 1px;
                padding : 0;
            }
            .title
            {
                border: 1px solid black;
                text-align: left;
                background-color: #ededed;
                font-weight: bold;
                font-style: normal;
                text-transform: capitalize;
                color: black;
                font-size: x-small;
                margin-bottom: 4px;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 4px;
            }
            .up
            {
                border: 1px solid silver;
                text-align: left;
                background-color: #24C110;
                font-weight: bold;
                font-style: normal;
                text-transform: capitalize;
                color: black;
                font-size: x-small;
                margin-bottom: 4px;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 4px;
            }
            .down
            {
                border: 1px solid silver;
                text-align: center;
                background-color: #24C110;
                font-weight: bold;
                font-style: normal;
                text-transform: capitalize;
                color: black;
                font-size: x-small;
                margin-bottom: 4px;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 4px;
            }

            .thumb
            {
                border: 1px solid #33cc00;
                text-align: left;
                font-weight: bold;
                font-style: normal;
                font-size: x-small;
                margin-bottom: 4px;
                padding-top: 4px;
                padding-bottom: 3px;
            }

            .link
            {
                border: 1px solid grey;
                text-align: left;
                background-color: white;
                font-weight: bold;
                font-style: normal;
                text-transform: capitalize;
                color: black;
                font-size: x-small;
                margin-bottom: 4px;
                margin-top: 4px;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 4px;
            }
            .pag {background-color:#24C110; padding:3px; color:#ffffff;}
            .border_4 {
                padding: 3px;
                border: 1px solid #D3D3D3;
                background-color: white;
            }
            .s {background-color:#24C110; border: 1px solid #D3D3D3; color:#ffffff;}
            .sb {
                padding: 2px;
                font-weight: bold;
                border: 1px solid #D3D3D3;
                background-color: white;

            }
            .sort {
                border: 1px solid silver;
                text-align: left;
                font-size: x-small;
                line-height: 2em;
                text-transform: capitalize;
                font-weight: bold;
                background-color: #EBEBEB;
                padding-bottom: 3px;
                padding-left: 3px;
                padding-top: 5px;
                margin-bottom: 5px;
                margin-top: 5px;
            }
            .sort1 {
                border: 1px solid silver;
                text-align: left;
                font-size: x-small;
                line-height: 2em;
                text-transform: capitalize;
                font-weight: bold;
                background-color: #EBEBEB;
                margin-bottom: 5px;
                margin-top: 5px;
                padding-top: 5px;
                padding-bottom: 3px;
                padding-left: 3px;
            }
            .rdx {
                border: 1px solid #999999;
                text-align: left;
                font-size: x-small;
                line-height: 2em;
                text-transform: capitalize;
                font-weight: bold;
                height: 24px;
                padding-top: 3px;
                margin-top: 3px;
                padding-left: 8px;
            }
            .rdx2 {
                border: 2px groove #24C110;
                color: #24C110;
                font-weight: bold;
            }
            .left {
                border: 1px solid silver;
                text-align: left;
                font-size: x-small;
                line-height: 2em;
                color: black;
                text-transform: capitalize;
                font-weight: bold;
                background-color: #f2f2f2;
                margin-top: 2px;
                margin-bottom: 3px;
                padding-top: 5px;
                padding-bottom: 5px;
                padding-left: 4px;
            }
        </style>
    </head><body style="color: rgb(0, 0, 0);" alink="#ee0000" link="#0000ee" vlink="#551a8b">
        <img style="width: 179px; height: 34px;" alt="logo" src="http://whatsapp8.com/search/logo.png"><br><div class="link"><img style="width: 16px; height: 16px;" alt=""
                                                                                                                                  src="search.png">Search Videos
                        <form action="./index.php" method="get"><input
                                style="border: 2px solid rgb(51, 204, 0); color: rgb(0, 153, 0); font-weight: bold;"
                                name="q" type="text"> <input value="Videos Search" type="submit"></form>

                                    </div>