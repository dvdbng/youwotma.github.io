<?php
include_once "cv.php";

function line($x1,$y1,$x2,$y2,$c){
    pprt("<line x1='$x1' y1='$y1' x2='$x2' y2='$y2' class='$c'/>");
}

function text($x,$y,$t){
    pprt("<text x='$x' y='$y' text-anchor='middle'>$t</text>");
}

$accesible_texts = array();
function ratext($x,$y,$t,$c){
    $y += 3;
    $x -= 5;
    pprt("<text x='$x' y='$y' text-anchor='end' class='$c'>$t</text>");
    $accesible_texts[] = array("end",$x,$y,$t,$c);
}

$htexts = array();
function htext($x,$y,$w,$h,$t){
    global $htexts;
    $htexts[] = array($x,$y,$w,$h,$t);
}

function item($name,$pc){
    pprti("<div class='item title'>");
    pprt("<div class='itemname'>$name</div>");
    if(is_numeric($pc)){
        $pc /= 2;
        pprt('<div class="metter"><div class="metter-inner" style="width: '.$pc.'px;"></div></div>');
    }else{
        pprt('<div class="itemdata">'.$pc.'</div>');
    }
    pprtu("</div>");
    pprt("<div class='clearfix'></div>");
}
function title($name,$pc){
    $pc /= 2;
    pprti('<div class="item">');
    pprt("<div class='itemname'><h2>$name</h2></div>");
    if($pc != 0) pprt('<div class="metter"><div class="metter-inner" style="width: '.$pc.'px;"></div></div>');
    pprtu("</div>");
    pprt("<div class='clearfix'></div>");
}

function ftitle(){}

function timeline_start(){?>
        <div id="timeline">
            <svg id="svgnode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width='<?php echo width; ?>px' height='<?php echo height; ?>px'>
<?php
    indent(4);
}
function timeline_end(){
    pprtu("</svg>");
    global $htexts;
    foreach($htexts as $k=>$v){
        pprt("<div class='htext' style='position:absolute; left: {$v[0]}px; top: {$v[1]}px; width: {$v[2]}px; height: {$v[3]}px;'>{$v[4]}</div>");
    }
    ?>
        </div>
        <script type="text/javascript">
            var accesible_texts = <?php global $accesible_texts; echo json_encode($accesible_texts); ?>;
        </script>
        <script type="text/javascript" src="js/cv.js"></script>
<?php
}
function skills_start(){?>
        <h1><?php t("Resumen de habilidades:"); ?></h1>
        <div id="arem">
<?php
}
function skills_end(){?>
        </div>
        <div id="fotter">David Bengoa - <a href="mailto:david@bengoarocandio.com">david@bengoarocandio.com</a> - <a href="http://twitter.com/DvdBng">@DvdBng</a></div>
<?php
}

function content(){ ?>
        <h1 id="maintitle"><?php t("David Bengoa - Currículum vítae"); ?></h1>
        <div id="nav">
            <a href="../<?php t("en"); ?>/cv"><?php t("English"); ?></a>
            <a href="."><?php t("Página principal") ?></a>
            <a href="david-bengoa-cv-<?php t("es"); ?>.pdf" class="last"><?php t("Descarga mi CV en PDF"); ?></a>
        </div>
        <div class="clearfix"></div>
<?php
    do_cv();
}

function css(){
    ?>
        <link href="<?php echo d(); ?>css/cv.css" rel="stylesheet" />
<?php
}

include_once "base.php";

?>
