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
include("head.php");

$token = $_GET['list'];
$search = urlencode($_GET['q']);

$url = "https://www.googleapis.com/youtube/v3/search?order=relevance&part=snippet&q=$search&maxResults=5&key=AIzaSyBx3_hpU9RIT-yN1z2F8T28fghQG5klYsU&pageToken=$token";

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$json_response = curl_exec($curl);

curl_close($curl);

$result = json_decode($json_response, true);
$result1 = $result['pageInfo']['totalResults'];
echo '<div class="up">Tottal Results : (' . $result1 . ')</div>';
foreach ($result['items'] as $data) {
    $vtittle = $data['snippet']['title'];
    $gvtittle = urlencode($vtittle);

    $vid = $data['id']['videoId'];
    $videoThumb = $data['snippet']['thumbnails']['default']['url'];


    echo '<h2 class="title">' . $vtittle . '</h2>';
    echo "<div class='thumb'><img src='" . $videoThumb . "' />";



    echo "<div class='link'><a class=\"sublink\" href=\"./getvideo.php?videoid=$vid&type=Download\"><button type='button'>Download Video</button></a>";

    echo '</div></div>';
}
if (isset($result['nextPageToken'])) {
    $_SESSION[nextToken] = $result['nextPageToken'];
}

if (isset($result['prevPageToken'])) {
    $_SESSION[prevToken] = $result['prevPageToken'];
}


$next = $_SESSION[nextToken];

$prev = $_SESSION[prevToken];
echo "<div class=\"sort\">";
print '<a href="index.php?list=' . $next . '&q=' . $search . '">Next Page</a> | ';
print '<a href="index.php?list=' . $prev . '&q=' . $search . '">Back Page</a>';
echo"</div>";

include("footer.php");
?>