<?php

$image = imagecreate(width,height);
imagefill($image,0,0,imagecolorallocate($image,255,255,255));
$color_back = imagecolorallocate($image,0x33,0x33,0x33);
$actualcolor = $color_back;

function setColor($color){
    global $actualcolor;
    $actualcolor = $color;
}

function setColorByClass($class){
    global $image;
    $color = getColorByClass($class);
    setColor(imagecolorallocate($image,$color[0],$color[1],$color[2]));
}
?>
