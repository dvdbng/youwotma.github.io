<?php
include_once "cv.php";


$image = ImageCreate(100,500);
imagefill($image,0,0,imagecolorallocate($image,255,255,255));

$color_back = imagecolorallocate($image, 0x33, 0x33, 0x33);
$color_gray = imagecolorallocate($image, 0xCC, 0xCC, 0xCC);

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

$isLeft = true;
$periods = 0;
function timeline_period($start, $end, $title, $text){
    global $isLeft, $periods;
    $periods++;
    vert_brace($isLeft?40:60, $start, $end, 150+$periods*75, $periods + 2, $isLeft?1:-1, 'muted');

}
function timeline_right(){
    global $isLeft, $periods;
    $isLeft = false;
    $periods = 0;
}

function skills_start(){}
function skills_end(){
    global $image;
    header('Content-type: image/png');
    imagepng($image);
}



$year_count = (2015 - 2009);
$year_length = 70; //px
$middle = 50;
line($middle, get_y(1991), $middle, get_now_y(), '');
line($middle-1, get_y(1991), $middle-1, get_now_y(), '');
line($middle+1, get_y(1991), $middle+1, get_now_y(), '');

for ($i = 2009; $i <= date('Y'); $i++) {
    line($middle - 5, get_y($i), $middle + 5, get_y($i), '');
}

do_cv();

?>
