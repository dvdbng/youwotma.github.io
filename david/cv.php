<?php
$deph = "";
define("width",1322);
define("height",340);
define('FPDF_FONTPATH','./font/');

require('fpdf.php');

function pdfScale($pdf,$x,$y,$pc){
    if(is_numeric($pc)){
        $lw = 0.1;
        $pdf->SetDrawColor(0xcc,0xcc,0xcc);
        $pdf->SetFillColor(0x33,0x33,0x33);
        $pdf->Rect($x,$y,10,1);
        $pdf->Rect($x+$lw,$y+$lw,(10-$lw*2)*($pc/100),1-$lw*2,"F");
    }else{
        $pdf->SetFont('Ubuntu','',9);
        $pdf->SetXY($x,$y);
        $pdf->Cell(0,0,utf8_decode($pc));
    }
}

function generate_pdf(){
    global $accesible_texts, $htexts, $skills;
    $ratio = 0.145;
    $pdf=new FPDF("P","mm","A4");
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $pdf->AddFont('Ubuntu','','ubuntu.php');
    $pdf->AddFont('Ubuntu','I','ubuntui.php');
    $pdf->AddFont('Droid','BI','droidbi.php');

    $pdf->SetFont('Droid','BI',16);
    $pdf->SetX(10);
    $pdf->Cell(40,10,utf8_decode('David Bengoa - Currículum Vítae'));
    $pdf->Image("cvimage.png",10,30,width*$ratio,height*$ratio);
    $afterimg = $pdf->GetX();

    foreach($accesible_texts as $k=>$v){
        setPdfColorByClass($pdf,$v[4]);
        if($v["0"] == "middle"){
            $pdf->SetFont('Ubuntu','',7.5);
            $pdf->SetXY(10+$v[1]*$ratio -15 +0.5,30+$v[2]*$ratio-1);
            $pdf->Cell(30,0,utf8_decode($v[3]),0,0,"C");
        }else{
            $pdf->SetFont('ubuntu','',6);
            $pdf->SetXY(10+$v[1]*$ratio -30 +0.5,30+$v[2]*$ratio-0.3);
            $pdf->Cell(30,0,utf8_decode($v[3]),0,0,"R");
        }
    }
    foreach($htexts as $k=>$v){
        setPdfColorByClass($pdf,"");
        $pdf->SetFont('Ubuntu','I',6);
        $pdf->SetXY(10+$v[0]*$ratio,30+$v[1]*$ratio-1.5);
        $pdf->MultiCell($v[2]*$ratio,2,utf8_decode($v[4]),0,"C");
    }
    $pdf->SetXY(10,75);
    $pdf->SetFont('Droid','BI',16);
    $pdf->Cell(40,10,utf8_decode(tr('Resumen de habilidades')));
    $pos = 90;
    $total_height = 0;
    foreach($skills as $k=>$v){
        $total_height += $v[0]=="title"?5:4;
    }
    $column_height = $total_height/2;
    $column_end = 90 + $column_height;
    $c = 0; //ActualColumn
    $cw = 90; //ColumnWidth
    foreach($skills as $k=>$v){
        if($v[0] == "title"){
            $pos += 1;
            $pdf->SetFont('Droid','BI',11);
            $pdf->SetXY(20 + $c*$cw,$pos);
        }else{
            $pdf->SetFont('Ubuntu','',9);
            $pdf->SetXY(25 + $c*$cw,$pos);
        }
        $pdf->Cell(0,0,utf8_decode($v[1]));
        pdfScale($pdf,80 + $c*$cw,$pos,$v[2]);
        $pos += 4;
        if($pos >= $column_end){
            $c++;
            $pos = 90;
        }
    }


    $pdf->Output("david-bengoa-cv.pdf","F");
}


$image = imagecreate(width,height);
imagefill($image,0,0,imagecolorallocate($image,255,255,255));
$color_back = imagecolorallocate($image,0x33,0x33,0x33);
$actualcolor = $color_back;
function setColor($color){
    global $actualcolor;
    $actualcolor = $color;
}
function getColorByClass($class,$default=array(0x33,0x33,0x33)){
    switch($class){
        case "eso": return array(0xaa,0xaa,0xaa);
        case "bachiller": return array(0x66,0x66,0x66);
        case "uni": return array(0x22,0x22,0x22);
        case "html": return array(0x23,0x81,0x9c);
        case "js": return array(0x23,0x81,0x9c);
        case "php": return array(0x23,0x81,0x9c);
        case "flash": return array(0x23,0x81,0x9c);
        case "vb": return array(0x23,0x81,0x9c);
        case "java": return array(0x23,0x81,0x9c);
        case "bash": return array(0x23,0x81,0x9c);
        case "python": return array(0x23,0x81,0x9c);
        default: return $default;
    }
}
function setColorByClass($class){
    global $image;
    $color = getColorByClass($class);
    setColor(imagecolorallocate($image,$color[0],$color[1],$color[2]));
}
function setPdfColorByClass($pdf,$class){
    $classes = explode(" ",$class);
    $color = false;
    foreach($classes as $k=>$v){
        $color = getColorByClass($v,false);
        if($color){
            break;
        }
    }
    if(!$color){
        $color = array(0x33,0x33,0x33);
    }
    $pdf->SetTextColor($color[0],$color[1],$color[2]);
}

include_once "{$deph}global.php";

date_default_timezone_set("Europe/Madrid");

function line($x1,$y1,$x2,$y2,$c){
    setColorByClass($c);
    global $image, $actualcolor;
    imageline($image,$x1,$y1,$x2,$y2,$actualcolor);
    echo "<line x1='$x1' y1='$y1' x2='$x2' y2='$y2' class='$c'/>\n";
}
function hline($x1,$x2,$y,$c){
    line($x1,$y,$x2,$y,$c);
}

function text($x,$y,$t){
    echo "<text x='$x' y='$y' text-anchor='middle'>$t</text>\n";
    global $accesible_texts;
    $accesible_texts[] = array("middle",$x,$y,$t,"");
}
$accesible_texts = array();
function ratext($x,$y,$t,$c){
    $y += 3;
    $x -= 5;
    echo "<text x='$x' y='$y' text-anchor='end' class='$c'>$t</text>\n";
    global $accesible_texts;
    $accesible_texts[] = array("end",$x,$y,$t,$c);
}
$htexts = array();
function htext($x,$y,$w,$h,$t){
    global $htexts;
    $htexts[] = array($x,$y,$w,$h,$t);
}

function brazo($x1,$x2,$y,$txt,$c){
    $serif_length = 5;
    echo "<g class='$c'>";
    line($x1,$y,$x1+$serif_length,$y-$serif_length,$c);
    line($x1+$serif_length,$y-$serif_length, $x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,$c);
    line($x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,$x1+($x2-$x1)/2, $y-2*$serif_length,$c);
    line($x1+($x2-$x1)/2, $y-2*$serif_length,$x1+($x2-$x1)/2 + $serif_length, $y-$serif_length,$c);
    line($x1+($x2-$x1)/2 + $serif_length, $y-$serif_length, $x2-$serif_length, $y-$serif_length,$c);
    line($x2-$serif_length, $y-$serif_length, $x2, $y, $c);
    echo "</g>";
    htext($x1,$y-85,$x2-$x1,85,$txt);
}

$tmy = 160;
function arrow($x,$h,$txt){
    global $tmy;
    //echo "$x $h";
    line($x,$tmy,$x,$tmy-$h,"timeline");
    text($x,$tmy-$h-5,$txt);
}

function get_x($year,$month=1,$day=1){
    $shorted_years = 12;
    $sy = 1991;
    $day += ($month-1)*30 - 1;
    $year_width = 120;
    $offset = 0;
    if($year < 1992){
        return $offset + $year_width*($day/360);
    }
    if($year < ($sy+$shorted_years)){
        return $offset + $year_width*(($year-$sy+$day/360 -1)/$shorted_years +1);
    }
    return $offset + $year_width*($year-$sy-$shorted_years+$day/360+2);
}
function get_now_x(){
    return get_x(date("Y"),date("n"),date("j"));
}
$skills = array();
function item($name,$pc){
    global $skills;
    $skills[] = array("item",$name,$pc);
    $pc /= 2;
    echo "<div class='item title'><div class='itemname'>$name</div>";
    echo '<div class="metter"><div class="metter-inner" style="width: '.$pc.'px;"></div></div>';
    echo "</div><div class='clearfix'></div>\n";
}
function title($name,$pc){
    global $skills;
    $skills[] = array("title",$name,$pc);
    $pc /= 2;
    echo '<div class="item">';
    echo "<div class='itemname'><h2>$name</h2></div>";
    if($pc != 0)echo '<div class="metter"><div class="metter-inner" style="width: '.$pc.'px;"></div></div>';
    echo "</div><div class='clearfix'></div>\n";
}
function ftitle(){
}

function content(){
    echo '<h1>';
    t("David Bengoa - Currículum vítae");
    echo '</h1>';
?>
<div id="timeline">
<svg id="svgnode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width='<?php echo width; ?>px' height='<?php echo height; ?>px'>
<?php
    global $tmy;
    for($i = 1991; $i<=2012; $i++){
        if($i>1992 && $i<2003)continue;
        if($i!=1991)line(get_x($i),$tmy-5,get_x($i),$tmy+5,"timeline timeline-mark");
        if($i!=1992 && $i!=2012)text((get_x($i)+get_x($i+1))/2,$tmy+20,$i);
    }

    $shry = 1995.55;
    $ampl = 8;
    line(0,$tmy,get_x($shry+1),$tmy,"timeline");
    line(get_x(++$shry),$tmy,get_x($shry,6),$tmy-$ampl,"timeline");
    line(get_x($shry,6),$tmy-$ampl,get_x(++$shry),$tmy+$ampl,"timeline");
    line(get_x($shry),$tmy+$ampl,get_x($shry,6),$tmy-$ampl,"timeline");
    line(get_x($shry,6),$tmy-$ampl,get_x(++$shry),$tmy+$ampl,"timeline");
    line(get_x($shry),$tmy+$ampl,get_x($shry,6),$tmy-$ampl,"timeline");
    line(get_x($shry,6),$tmy-$ampl,get_x(++$shry),$tmy+$ampl,"timeline");
    line(get_x($shry),$tmy+$ampl,get_x($shry,6),$tmy,"timeline");
    line(get_x($shry,6),$tmy,get_x(2012),$tmy,"timeline");

    brazo(get_x(1992),get_x(2003),$tmy-10,"No recuerdo mucho de esta epoca. Fue hace mucho tiempo y era muy pequeño.","timeline");
    arrow(get_x(1991,12,24),110,"Nací");
    arrow(get_x(2006,9,15),50,"Me mudo a Málaga");
    arrow(get_x(2009,12,24),50,"Mayor de edad");
    arrow(get_x(2009,6,18),110,"Me paso a GNU/Linux");
    arrow(get_now_x(),50,"Hoy");

    ratext(get_x(2003,7,0),$tmy+70,"HTML","tlinline html");
    hline(get_x(2003,7,0),get_now_x(),$tmy+70,"html");
    ratext(get_x(2003,9,0),$tmy+80,"Javascript","tlinline js");
    hline(get_x(2003,9,0),get_now_x(),$tmy+80,"js");

    ratext(get_x(2004,9,0),$tmy+90,"PHP","tlinline php");
    hline(get_x(2004,9,0),get_x(2008,4),$tmy+90,"php");
    hline(get_x(2009,10,0),get_now_x(),$tmy+90,"php");

    ratext(get_x(2005,9,0),$tmy+100,"Flash & actionscript","tlinline flash");
    hline(get_x(2005,9,0),get_x(2007,0,0),$tmy+100,"flash");
    hline(get_x(2008,0,0),get_x(2008,3,0),$tmy+100,"flash");
    hline(get_x(2010,9,0),get_x(2011),$tmy+100,"flash");

    ratext(get_x(2006,5,0),$tmy+110,"Visual basic, C#","tlinline vb");
    hline(get_x(2006,5,0),get_x(2008,6),$tmy+110,"vb");

    ratext(get_x(2007,8,0),$tmy+120,"Java","tlinline java");
    hline(get_x(2007,8,0),get_x(2009),$tmy+120,"java");
    hline(get_x(2011,2,0),get_now_x(),$tmy+120,"java");

    ratext(get_x(2009,6,18),$tmy+130,"Bash","tlinline bash");
    hline(get_x(2009,6,18),get_now_x(),$tmy+130,"bash");

    ratext(get_x(2009,10,0),$tmy+140,"Python","tlinline python");
    hline(get_x(2009,10,0),get_now_x(),$tmy+140,"python");

    //ESO
    ratext(get_x(2003,9,10),$tmy+40,"ESO","tlinline eso");
    hline(get_x(2003,9,10),get_x(2004,6,15),$tmy+40,"eso");
    hline(get_x(2004,9,10),get_x(2005,6,15),$tmy+40,"eso");
    hline(get_x(2005,9,10),get_x(2006,6,15),$tmy+40,"eso");
    hline(get_x(2006,9,10),get_x(2007,6,15),$tmy+40,"eso");
    //Bachillerato
    ratext(get_x(2007,9,10),$tmy+50,"Bachiller","tlinline bachiller");
    hline(get_x(2007,9,10),get_x(2008,6,15),$tmy+50,"bachiller");
    hline(get_x(2008,9,10),get_x(2009,6,15),$tmy+50,"bachiller");
    //Uni
    ratext(get_x(2009,9,28),$tmy+60,"Universidad","tlinline uni");
    hline(get_x(2009,9,28),get_x(2010,6,25),$tmy+60,"uni");
    hline(get_x(2010,9,28),get_now_x(),$tmy+60,"uni");

?>
</svg>
    <script type="text/javascript">
        var accesible_texts = <?php global $accesible_texts; echo json_encode($accesible_texts); ?>;
    </script>
    <script type="text/javascript" src="js/cv.js"></script>
<?php
    global $htexts;
    foreach($htexts as $k=>$v){
        echo "<div class='htext' style='position:absolute; left: {$v[0]}px; top: {$v[1]}px; width: {$v[2]}px; height: {$v[3]}px;'>{$v[4]}</div>";
    }
    echo '</div><h1>';
    t("Resumen de habilidades:");
    echo '</h1>';
    echo '<div id="arem">';
    title("Javascript",98);
        item("jQuery",95);
        item("Node.js",85);
        item("ECMA 5",90);
        item("Jetpack",60);
        item(_("Compiladores"),94);
    ftitle();

    title(_("Tecnologias web"),98);
        item("Protocolo HTTP",99);
        item("HTML",99);
        item("CSS",99);
        item("SVG",80);
        item("Canvas",95);
        item("XMLHttpRequest & COMET",95);
        item(_("APIs del navegador"),95);
    ftitle();

    title("Python",97);
        item("Django",95);
        item("South",70);
        item("WSGI",60);
        item("PyCairo",70);
        item("PyCurl",75);
        item("PyGTK",60);
        item("PyQt",50);
        item("Gnome API",55);
        item("Gimp API",40);
        item("Vim API",40);
    ftitle();

    title("C & C++",70);
        item("Xlib",50);
        item("GTK+",55);
        item("Gcc",60);
        item("Cairo",62);
    ftitle();

    title("Java",50);
        item("Swing",70);
    ftitle();

    title("PHP",90);
        item("Wordpress",90);
        item("Drupal",20);
    ftitle();

    title("Flash & actionscript",50);
        item("as2",70);
        item("as3",95);
        item("papervision3D",70);
        item("away3D",75);
    ftitle();

    title("Unix - GNU/linux",70);
        item("Unix API",50);
        item(_("Config. y compilación del kernel"),40);
        item(_("Binarios standard Unix"),90);
        item("Gentoo",85);
        item("Ubuntu/Debian",80);
    ftitle();

    title(_("Tecnologias Mozilla"),80);
        item("XUL",85);
        item("XBL",95);
        item(_("Extensiones CSS de mozilla"),90);
        item(_("Extensiones js de Spidermonkey"),90);
        item("XPCOM",90);
        item(_("Compilación apps xulrunner "),90);
        item("Mercurial",75);
    ftitle();

    title(_("Otros"),0);
        item(_("Expresiones regulares"),98);
        item("Makefile",10);
        item("Bash",85);
        item("Git",75);
        item(_("Vim (editing)"),"95");
        item(_("Vim (scripting)"),"65");
        item("Latex",15);
        item("Tex",20);
        item("MySQL",80);
        item("SQLite",80);
        item("MongoDB",30);
        item("Scheme",25);
        item("Sockets",80);
        item(_("Protocolo TCP/IP"),"30");
        item(_("Twitter API"),"90");
    ?>
        <div class='item'><div class='itemname'><?php t("Carnet de conducir"); ?></div><div class="itemdata"><?php t("Tipo B"); ?></div></div><div class='clearfix'></div>
    <?php
        global $skills;
        $skills[] = array("item",tr("Carnet de conducir"),tr("Tipo B"));
    ftitle();

    title(_("Idiomas"),0);
        item(_("Español"),96);
        item(_("Ingles"),"25");
    ftitle();
    echo "</div>";
    ?>
    <div id="fotter">David Bengoa - <a href="mailto:david@bengoarocandio.com">david@bengoarocandio.com</a> - <a href="http://twitter.com/DvdBng">@DvdBng</a></div>
    <?php
    global $image;
    if(!imagepng($image,"cvimage.png")){
        echo "<h1>Error guardando la imagen</h1>";
    }
    generate_pdf();
}

function css(){
    ?><link href="<?php echo d(); ?>css/cv.css" rel="stylesheet" /><?php
}

include_once "{$deph}base.php";

?>
