<?php
include_once "cv.php";

define('FPDF_FONTPATH','./font/');
define('RATIO',0.177);
define('OFFSETX',10);
define('OFFSETY',17);

require('fpdf.php');

class ColFPDF extends FPDF{
    public function ColumnPos(){
        $this->SetXY($this->ColumnGetX(),$this->ColumnGetY());
    }
    public function ColumnGetX(){return 20+$this->col_pos*$this->column_width;}
    public function ColumnGetY(){return $this->pos;}
    public function ColumnPutHeight($h){
        $this->pos += $h;
        if($this->pos >= $this->column_end){
            $this->pos = $this->column_start;
            $this->col_pos++;
        }
        $this->ColumnPos();
    }
    public function ColumnInit($height,$start_y,$column_width){
        $this->pos = $start_y;
        $this->column_start = $start_y;
        $this->column_end = $start_y + $height;
        $this->col_pos = 0;
        $this->column_width = $column_width;
        $this->ColumnPos();
    }
}

$pdf=new ColFPDF("P","mm","A4");
$pdf->AddPage();
$pdf->SetAutoPageBreak(false);

$pdf->AddFont('Ubuntu','','ubuntu.php');
$pdf->AddFont('Ubuntu','I','ubuntui.php');
$pdf->AddFont('Droid','BI','droidbi.php');

$pdf->SetFont('Droid','BI',16);
$pdf->SetX(10);
$pdf->Cell(40,10,utf8_decode(tr('David Bengoa - Currículum Vítae')));

function scale($pc){
    global $pdf;
    $x = $pdf->ColumnGetX()+55;
    $y = $pdf->ColumnGetY()-0.5;
    if(is_numeric($pc)){
        if($pc == 0)return;
        $lw = 0.1;
        $pdf->SetDrawColor(0xCC,0xCC,0xCC);
        $pdf->SetFillColor(0x33,0x33,0x33);
        $pdf->Rect($x,$y,10,1);
        $pdf->Rect($x+$lw,$y+$lw,(10-$lw*2)*($pc/100),1-$lw*2,"F");
    }else{
        $pdf->SetFont('Ubuntu','',9);
        $pdf->SetXY($x,$y);
        $pdf->Cell(0,0,utf8_decode($pc));
    }
}

function setPdfColorByClass($class){
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
    global $pdf;
    $pdf->SetTextColor($color[0],$color[1],$color[2]);
}

function line($x1,$y1,$x2,$y2,$c){
    global $pdf;
    $color = getColorByClass($c);
    $pdf->SetDrawColor($color[0],$color[1],$color[2]);
    $pdf->Line(OFFSETX+$x1*RATIO,OFFSETY+$y1*RATIO,OFFSETX+$x2*RATIO,OFFSETY+$y2*RATIO);
}

function text($x,$y,$t){
    global $pdf;
    setPdfColorByClass("");
    $pdf->SetFont('Ubuntu','',7.5);
    $pdf->SetXY(OFFSETX+$x*RATIO -15 +0.5,OFFSETY+$y*RATIO-1);
    $pdf->Cell(30,0,utf8_decode($t),0,0,"C");
}

$accesible_texts = array();
function ratext($x,$y,$t,$c){
    global $pdf;
    $y += 3;
    $x -= 5;
    setPdfColorByClass($c);
    $pdf->SetFont('ubuntu','',6);
    $pdf->SetXY(OFFSETX+$x*RATIO -30 +0.5,OFFSETY+$y*RATIO-0.3);
    $pdf->Cell(30,0,utf8_decode($t),0,0,"R");
}

function htext($x,$y,$w,$h,$t){
    global $pdf;
    setPdfColorByClass("");
    $pdf->SetFont('Ubuntu','I',6);
    $pdf->SetXY(OFFSETX+$x*RATIO,OFFSETY+$y*RATIO-1.5);
    $pdf->MultiCell($w*RATIO,2,utf8_decode($t),0,"C");
}

function item($name,$pc,$f='Ubuntu',$v='',$z=9,$offset=true){
    global $pdf;
    if($offset){
        $pdf->Cell(3);
    }
    $pdf->SetFont($f,$v,$z);
    $pdf->Cell(0,0,utf8_decode($name));
    scale($pc);
    $pdf->ColumnPutHeight(4);
}
function title($name,$pc){
    item($name,$pc,'Droid','BI',11,false);
}
function ftitle(){
    global $pdf;
    $pdf->ColumnPutHeight(1);
}
function timeline_start(){

}
function timeline_end(){

}

function skills_start($items,$titles){
    global $pdf;
    $pdf->SetXY(10,75);
    $pdf->SetFont('Droid','BI',16);
    $pdf->Cell(40,10,utf8_decode(tr('Resumen de habilidades')));
    $pdf->ColumnInit(($items*4 + $titles*5)/2,90,90);
}

function skills_end(){
    global $pdf;
    $pdf->SetFont('Ubuntu','',9);
    $pdf->SetDrawColor(0x33,0x33,0x33);
    $pdf->Line(10,297-30,210-20,297-30);
    $pdf->SetXY(15,297-26);
    $pdf->MultiCell(210-30,4,
        utf8_decode(
            "David Bengoa, E-mail: david@bengoarocandio.com, Twitter: @DvdBng.\n".
            tr("PDF generado el").date(" d/m/y. ").
            tr("Este currículum se actualiza frecuentemente, puedes ver la versión online actualizada en").
            " http://david.bengoarocandio.com/".tr("es")."/cv"
        )
    );
}

function generate_pdf(){
    foreach($skills as $k=>$v){
        if($v[0] == "title"){
        }else{
        }
    }

    $pdf->Output("david-bengoa-cv-".tr("es").".pdf","F");
}
do_cv();
//$pdf->Output("david-bengoa-cv-".tr("es").".pdf","F");
$pdf->Output();

?>
