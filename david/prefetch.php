<?php
$urls = array(
    "http://twitter.com/status/user_timeline/DvdBng.json?count=10&callback=render_tweets",
    "http://www.hoyga.com/?feed=json&callback=render_posts"
);

$ttl = 60*5;
$file = "cache.js";
echo file_get_contents($file);


/*
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
