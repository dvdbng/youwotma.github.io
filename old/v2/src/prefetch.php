<?php

include_once "global.php";

$urls = array(
    "http://api.twitter.com/1/statuses/user_timeline.json?include_rts=1&screen_name=dvdbng&callback=render_tweets",
    "http://www.hoyga.com/?feed=json&callback=render_posts",
    "http://api.picplz.com/api/v2/user.json?username=dvdbng&include_pics=1&callback=render_photos"
);

$ttl = 60*5;
$file = "/tmp/brweb-cache.js";


if(!file_exists($file) || time()-filemtime($file)>$ttl){
    $data = "";
    foreach($urls as $k=>$url){
        $data .= file_get_contents($url);
        $data .= ";\n";
    }
    file_put_contents($file,$data);
    echo $data;
}else{
    echo file_get_contents($file);
}

//*/
?>
