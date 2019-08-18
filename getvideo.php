<?php
/* =================================================================#
  # Script Name = youtube api v3 mobile 2015                  #
  # Script version = 1.1                                            #
  # Licence = FREE to Distribute                                    #
  # Script Created By = RdxHere                                                                #
  # Email : rdxmob@gmail.com                                   #
  # NOTE:   #
  # Replace Ur Api key with &key=AIzaSyBCLxHPgsISSgx0asL7dBit5u-1NIfFX3 #
  # Reg Ur Api Key Here : https://console.developers.google.com/project #
  # If you are facing any problem , please feel free to contact us. #
  # Script by :-                                                    #
  #========================    Rdx    ============================#
  #========================    Here    ============================#
  #                          My Gtalk Id Rdxmob@gmail.com add me #                                       #
  #=================================================================#
 */

include_once('config.php');
ob_start(); // if not, some servers will show this php warning: header is already set in line 46...

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . '' . $units[$pow];
}

function is_chrome() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match("/like\sGecko\)\sChrome\//", $agent)) { // if user agent is google chrome
        if (!strstr($agent, 'Iron')) // but not Iron
            return true;
    }
    return false; // if isn't chrome return false
}

if (isset($_REQUEST['videoid'])) {
    $my_id = $_REQUEST['videoid'];
    if (strlen($my_id) > 11) {
        $url = parse_url($my_id);
        $my_id = NULL;
        if (is_array($url) && count($url) > 0 && isset($url['query']) && !empty($url['query'])) {
            $parts = explode('&', $url['query']);
            if (is_array($parts) && count($parts) > 0) {
                foreach ($parts as $p) {
                    $pattern = '/^v\=/';
                    if (preg_match($pattern, $p)) {
                        $my_id = preg_replace($pattern, '', $p);
                        break;
                    }
                }
            }
            if (!$my_id) {
                echo '<p>No video id passed in</p>';
                exit;
            }
        } else {
            echo '<p>Invalid url</p>';
            exit;
        }
    }
} else {
    echo '<p>No video id passed in</p>';
    exit;
}

if (isset($_REQUEST['type'])) {
    $my_type = $_REQUEST['type'];
} else {
    $my_type = 'redirect';
}

if ($my_type == 'Download') {
    ?>



    <?php
} // end of if for type=Download

/* First get the video info page for this video id */
//$my_video_info = 'http://www.youtube.com/get_video_info?&video_id='. $my_id;
$my_video_info = 'http://www.youtube.com/get_video_info?&video_id=' . $my_id . '&asv=3&el=detailpage&hl=en_US'; //video details fix *1
$my_video_info = curlGet($my_video_info);

/* TODO: Check return from curl for status code */

$thumbnail_url = $title = $url_encoded_fmt_stream_map = $type = $url = '';

parse_str($my_video_info);
include("head1.php");

echo '<h1 class="up">' . $title . '</h1>';

echo '';
switch ($config['ThumbnailImageMode']) {
    case 2: echo '<a href="getimage.php?videoid=' . $my_id . '&sz=hd" target="_blank"><img src="getimage.php?videoid=' . $my_id . '" border="0" hspace="2" vspace="2"></a>';
        break;
    case 1: echo '<a href="getimage.php?videoid=' . $my_id . '&sz=hd" target="_blank"><img src="' . $thumbnail_url . '" border="0" hspace="2" vspace="2"></a>';
        break;
    case 0: default:  // nothing
}
echo '';

$my_title = $title;
$cleanedtitle = clean($title);

if (isset($url_encoded_fmt_stream_map)) {
    /* Now get the url_encoded_fmt_stream_map, and explode on comma */
    $my_formats_array = explode(',', $url_encoded_fmt_stream_map);
    if ($debug) {
        echo '<pre>';
        print_r($my_formats_array);
        echo '</pre>';
    }
} else {
    echo '<p>No encoded format stream found.</p>';
    echo '<p>Here is what we got from YouTube:</p>';
    echo $my_video_info;
}
if (count($my_formats_array) == 0) {
    echo '<p>No format stream map found - was the video id correct?</p>';
    exit;
}

/* create an array of available download formats */
$avail_formats[] = '';
$i = 0;
$ipbits = $ip = $itag = $sig = $quality = '';
$expire = time();

foreach ($my_formats_array as $format) {
    parse_str($format);
    $avail_formats[$i]['itag'] = $itag;
    $avail_formats[$i]['quality'] = $quality;
    $type = explode(';', $type);
    $avail_formats[$i]['type'] = $type[0];
    $avail_formats[$i]['url'] = urldecode($url) . '&signature=' . $sig;
    parse_str(urldecode($url));
    $avail_formats[$i]['expires'] = date("G:i:s T", $expire);
    $avail_formats[$i]['ipbits'] = $ipbits;
    $avail_formats[$i]['ip'] = $ip;
    $i++;
}

if ($debug) {
    echo '<p>These links will expire at ' . $avail_formats[0]['expires'] . '</p>';
    echo '<p>The server was at IP address ' . $avail_formats[0]['ip'] . ' which is an ' . $avail_formats[0]['ipbits'] . ' bit IP address. ';
    echo 'Note that when 8 bit IP addresses are used, the download links may fail.</p>';
}
if ($my_type == 'Download') {
    echo '<div class="title">Videos Formats For Download:
		</div>';

    /* now that we have the array, print the options */
    for ($i = 0; $i < count($avail_formats); $i++) {
        echo '<div class="link">';
        echo '' . $avail_formats[$i]['itag'] . ' ';
        if ($config['VideoLinkMode'] == 'direct' || $config['VideoLinkMode'] == 'both')
            echo '<a href="' . $avail_formats[$i]['url'] . '&title=' . $cleanedtitle . '" class="mime">' . $avail_formats[$i]['type'] . '</a> ';
        else
            echo '' . $avail_formats[$i]['type'] . '';
        echo '(' . $avail_formats[$i]['quality'];
        if ($config['VideoLinkMode'] == 'proxy' || $config['VideoLinkMode'] == 'both')
            echo ' / ' . '<a href="download.php?mime=' . $avail_formats[$i]['type'] . '&title=' . urlencode($my_title) . '&token=' . base64_encode($avail_formats[$i]['url']) . '" class="dl">download</a>';
        echo ') ' .
        '' . formatBytes(get_size($avail_formats[$i]['url'])) . '' .
        '</div>';
    }

    if (($config['feature']['browserExtensions'] == true) && (is_chrome()))
        echo '<div class="link"><a href="javascript:history.back(1)">Back To Page</a></div>';
    ?>

    <div class="rdx"><img alt="" src="http://whatsapp8.com/Funny%20Prank%20Video/home.png"> <a style="font-weight: bold;"
                                                                                               href="http://whatsapp8.com">Home</a></div>
    <div class="down">WhatsApp8.Com 2014
    </div><center><img src='http://c.wen.ru/2648507.wbmp?' alt=''></a></center>
    </body>
    </html>

    <?php
} else {

    /* In this else, the request didn't come from a form but from something else
     * like an RSS feed.
     * As a result, we just want to return the best format, which depends on what
     * the user provided in the url.
     * If they provided "format=best" we just use the largest.
     * If they provided "format=free" we provide the best non-flash version
     * If they provided "format=ipad" we pull the best MP4 version
     *
     * Thanks to the python based youtube-dl for info on the formats
     *   							http://rg3.github.com/youtube-dl/
     */

    $format = $_REQUEST['format'];
    $target_formats = '';
    switch ($format) {
        case "best":
            /* largest formats first */
            $target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
            break;
        case "free":
            /* Here we include WebM but prefer it over FLV */
            $target_formats = array('38', '46', '37', '45', '22', '44', '35', '43', '34', '18', '6', '5', '17', '13');
            break;
        case "ipad":
            /* here we leave out WebM video and FLV - looking for MP4 */
            $target_formats = array('37', '22', '18', '17');
            break;
        default:
            /* If they passed in a number use it */
            if (is_numeric($format)) {
                $target_formats[] = $format;
            } else {
                $target_formats = array('38', '37', '46', '22', '45', '35', '44', '34', '18', '43', '6', '5', '17', '13');
            }
            break;
    }

    /* Now we need to find our best format in the list of available formats */
    $best_format = '';
    for ($i = 0; $i < count($target_formats); $i++) {
        for($j = 0;
        $j < count($avai l_formats);
        $j++) {
            if($tar get_formats[$i] == $avail_formats[$j]['itag'] ) {
                //echo '<p>Target format found, it is '. $avail_formats[$j]['itag'] .'</p>';
                $best_format = $j;
                break 2;
            }
        }
    }

//echo '<p>Out of loop, best_format is '. $best_format .'</p>';
    if ((isset($best_format)) &&
            (isset($avail_formats [$best_format]['url'])) &&
            (isset($avail_formats [$best_format]['type']))
    ) {
        $redirect_url = $avail_formats[$best_format]['url'] . '&title=' . $cleanedtitle;
        $content_type = $avail_formats[$best_format]['type'];
    }
    if (isset($redirect_url)) {
        header("Location: $redirect_url");
    }
} // end of else for type not being Download
// *1 = thanks to amit kumar @ bloggertale.com for sharing the fix
?><?php ?>
