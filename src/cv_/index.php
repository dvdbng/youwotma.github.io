<?php
$deph = "";
include_once "{$deph}global.php";

function line($x1,$y1,$x2,$y2,$c){
    echo "<line x1='$x1' y1='$y1' x2='$x2' y2='$y2' class='$c'/>\n";
}

function text($x,$y,$t){
    echo "<text x='$x' y='$y' text-anchor='middle'>$t</text>\n";
}

function brazo($x1,$x2,$y,$c){
    $serif_length = 5;
    echo "<g class='$c'>";
    line($x1,$y,$x1+$serif_length,$y-$serif_length,$c);
    line($x1+$serif_length,$y-$serif_length, $x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,   $c);
    line($x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,$x1+($x2-$x1)/2, $y-2*$serif_length,   $c);
    line($x1+($x2-$x1)/2, $y-2*$serif_length,$x1+($x2-$x1)/2 + $serif_length, $y-$serif_length,   $c);
    line($x1+($x2-$x1)/2 + $serif_length, $y-$serif_length, $x2-$serif_length, $y-$serif_length, $c);
    line($x2-$serif_length, $y-$serif_length, $x2, $y, $c);
    echo "</g>";
}
function year(){

}
function short_year(){

}
function get_x($year,$month=0,$day=0){
    $shorted_years = 10;
    $sy = 1991;
    $sd = 12*30 + 24;
    $day += $month*30;
    $year_width = 120;
    $offset = 0;
    if($year < 1992){
        return 0;
    }
    if($year < ($sy+$shorted_years)){
        return $offset + $year_width*(($year-$sy+$day/360)/$shorted_years +1);
    }
    return $offset + $year_width*($year-$sy-$shorted_years+$day/360+2);
}

function content(){
?>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width='2000px' height='420px'>
<?php
    $tmy = 100;
    for($i = 1991; $i<=2012; $i++){
        if($i>1992 && $i<2001)continue;
        if($i!=1991)line(get_x($i),$tmy-5,get_x($i),$tmy+5,"timeline timeline-mark");
        if($i!=1992 && $i!=2012)text((get_x($i)+get_x($i+1))/2,$tmy+20,$i);
    }
    line(0,$tmy,get_x(2012),$tmy,"timeline");
    brazo(get_x(1992),get_x(2001),$tmy-10,"timeline");
    //arrow(get_x(199))

?>
</svg>
<?php
}

function css(){
    ?><link href="<?php echo d(); ?>css/cv.css" rel="stylesheet" /><?php
}

include_once "{$deph}base.php";

?>
