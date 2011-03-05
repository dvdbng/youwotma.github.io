<?php
include_once "cv.php";

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

function line($x1,$y1,$x2,$y2,$c){
    setColorByClass($c);
    global $image, $actualcolor;
    imageline($image,$x1,$y1,$x2,$y2,$actualcolor);
}

function text($x,$y,$t){}
function ratext($x,$y,$t,$c){}
function htext($x,$y,$w,$h,$t){}
function item($name,$pc){}
function title($name,$pc){}
function ftitle(){}
function timeline_start(){}
function timeline_end(){}
function skills_start(){}
function skills_end(){
    global $image;
    if(imagepng($image,"cvimage.png")){
        echo "Guardado OK";
    }else{
        echo "Guardado FAIL";
    }
}
do_cv();
?>
