define('FPDF_FONTPATH','./font/');

require('fpdf.php');

function pdfScale($pdf,$x,$y,$pc){
    if(is_numeric($pc)){
        if($pc == 0)return;
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

function generate_pdf(){
    global $accesible_texts, $htexts, $skills, $lines;
    $ratio = 0.145;
    $pdf=new FPDF("P","mm","A4");
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);

    $pdf->AddFont('Ubuntu','','ubuntu.php');
    $pdf->AddFont('Ubuntu','I','ubuntui.php');
    $pdf->AddFont('Droid','BI','droidbi.php');

    $pdf->SetFont('Droid','BI',16);
    $pdf->SetX(10);
    $pdf->Cell(40,10,utf8_decode(tr('David Bengoa - Currículum Vítae')));
    //$pdf->Image("cvimage.png",10,30,width*$ratio,height*$ratio);
    foreach($lines as $k=>$line){
        $color = $line[4];
        $pdf->SetDrawColor($color[0],$color[1],$color[2]);
        $pdf->Line(10+$line[0]*$ratio,30+$line[1]*$ratio,10+$line[2]*$ratio,30+$line[3]*$ratio);
    }

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
    $pdf->SetDrawColor(0x33,0x33,0x33);
    $pdf->Line(10,297-30,210-20,297-30);
    $pdf->SetXY(15,297-26);
    $pdf->MultiCell(210-30,4,
        utf8_decode(
            "David Bengoa, E-mail: david@bengoarocandio.com, Twitter: @DvdBng.\n".
            tr("PDF genereado el").date(" d/m/y. ").
            tr("Este currículum se actualiza frecuentemente, puedes ver la versión online actualizada en").
            " http://david.bengoarocandio.com/".tr("es")."/cv"
        )
    );

    $pdf->Output("david-bengoa-cv-".tr("es").".pdf","F");
}
