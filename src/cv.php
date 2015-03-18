<?php
include_once "global.php";
$depth = "../";
define("width",1056);
define("height",340);
define("TLY",160);

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
        case "muted": return array(0xCC,0xCC, 0xCC);
        default: return $default;
    }
}


date_default_timezone_set("Europe/Madrid");

function hline($x1,$x2,$y,$c){
    line($x1,$y,$x2,$y,$c);
}

function brazo($x1,$x2,$y,$txt,$c){
    $serif_length = 5;
    line($x1,$y,$x1+$serif_length,$y-$serif_length,$c);
    line($x1+$serif_length,$y-$serif_length, $x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,$c);
    line($x1+($x2-$x1)/2 - $serif_length, $y-$serif_length,$x1+($x2-$x1)/2, $y-2*$serif_length,$c);
    line($x1+($x2-$x1)/2, $y-2*$serif_length,$x1+($x2-$x1)/2 + $serif_length, $y-$serif_length,$c);
    line($x1+($x2-$x1)/2 + $serif_length, $y-$serif_length, $x2-$serif_length, $y-$serif_length,$c);
    line($x2-$serif_length, $y-$serif_length, $x2, $y, $c);
    htext($x1,$y-70,$x2-$x1,85,$txt);
}

function drawLines($points, $c){
    $prev = array_shift($points);
    foreach($points as $i=>$point){
        line($prev[0], $prev[1], $point[0], $point[1], $c);
        $prev = $point;
    }
}

function vert_brace($x, $y1, $y2, $yarrow, $yarrow_bend_x, $dir=1, $c){
    $yBraceArrow = min($y2 - 15, max($y1 + 15, $yarrow));

    $serif_length = 3;

    drawLines(array(
        array($x + $dir*$serif_length, $y1),
        array($x, $y1 + $serif_length),
        array($x, $yBraceArrow - $serif_length),
        array($x - $dir*$serif_length, $yBraceArrow),
        array($x, $yBraceArrow + $serif_length),
        array($x, $y2 - $serif_length),
        array($x + $dir*$serif_length, $y2)
    ), $c);

    drawLines(array(
        array($x - $dir*$serif_length, $yBraceArrow),
        array($x - $dir*$serif_length*$yarrow_bend_x*2, $yBraceArrow),
        array($x - $dir*$serif_length*$yarrow_bend_x*2, $yarrow),
        array($x - $dir*$serif_length*100, $yarrow),
    ), $c);

}

function arrow($x,$h,$txt){
    line($x,TLY,$x,TLY-$h,"timeline");
    text($x,TLY-$h-5,$txt);
}

function get_x($year,$month=1,$day=1){
    $shorted_years = 12;
    $sy = 1991;
    $day += ($month-1)*30 - 1;
    $year_width = 855/(date('Y')-2002);
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

function get_y($year,$month=1,$day=1){
    $shorted_years = 17;
    $sy = 1991;
    $day += ($month-1)*30 - 1;
    $year_width = 500/(date('Y')-2005);
    $offset = 0;
    if($year < 1992){
        return $offset + $year_width*($day/360);
    }
    if($year < ($sy+$shorted_years)){
        return $offset + $year_width*(($year-$sy+$day/360 -1)/$shorted_years +1);
    }
    return $offset + $year_width*($year-$sy-$shorted_years+$day/360+2);
}

function get_now_y(){
    return get_y(date("Y"),date("n"),date("j"));
}

/*
 *
Graduated with honors (best of class) in the following courses:
* Programación Orientada a Objetos (Object oriented Programming)
* Estructura de Datos (Data structures)
* Análisis y Diseño de Algoritmos (Analysis and Design of Algorithms)
* Teoría de Autómatas y Lenguajes Formales (Formal Languages and Automata Theory)
* Programacion de Sistemas y Concurrencia (System Programming and Concurrency)
* Systemas Operativos (Operating Systems)
 *
 *
 *
 *
The Mozilla project is a global community of people who believe that openness, innovation, and opportunity are key to the continued health of the Internet, best known for creating the Mozilla Firefox web browser.

As a Mozilla Hispano Labs member (and eventually coordinator) I developed and assisted developing innovating tools to make the web a better place for everyone. I'm a huge fan of open source, and technological freedom.

Working in open source projects allowed me to gain a lot of experience long before finishing high school, and to work with —and learn from— highly talented persons.
 * */


function do_skills(){
    title("Javascript",99);
        item("Node.js / io.js", 99);
    ftitle();

    title(tr("Frontend"),99);
        item("jQuery",99);
        item("CSS",99);
        item("Angular.js",85);
    ftitle();

    title("Python",97);
        item("Django",85);
    ftitle();

    title("PHP",90);
        item("Wordpress",90);
    ftitle();

    title("Other languages", 0);
        item("C",60);
        item("C++", 30);
        item("Actionscript", 85);
        item("Bash",85);
        item("Scheme",25);
    ftitle();

    title("Databases", 0);
        item("MongoDB", 85);
        item("MySQL", 85);
        item("SQLite",80);
        item("Oracle/PLSQL/JDBC", 45);
    ftitle();

    title("Operating Systems", 85);
        item("GNU/Linux", 95);
        item("Other UNIX", 50);
        item("Windows", 25);
    ftitle();

    title(tr("Sistemas de control de versiones"), 0);
        item("Git", 95);
        item("Mercurial",50);
        item("SVN",50);
    ftitle();

    title(tr("Otros"),0);
        item("Vim","95");
        item(tr("Expresiones regulares"),98);
        item(tr("Protocolo TCP/IP"),80);
        item(tr("Carnet de conducir"),tr("Tipo B"));
    ftitle();

    title(tr("Idiomas"),0);
        item(tr("Español"),96);
        item(tr("Ingles"),87);
    ftitle();
}

function do_cv(){
    timeline_start();

    //timeline_period(get_y(2009, 9), get_y(2012, 7), 'Universidad de Málaga', 'Estudiante de Ingeniería del software.');
    //timeline_period(get_y(2012, 9), get_y(2013, 4), 'Southampton Solent University', 'Estudiante de Ingeniería del software.');
    //timeline_period(get_y(2013, 5), get_y(2013, 11), 'Centro Europeo para el Desarrollo Nuclear (CERN)', 'INSPIRE Developer');
    //timeline_period(get_now_y(), get_now_x()+50, 'Your company', 'Ingeniero del software');

    timeline_period(2008, 2012, 5, 'Mozilla Hispano', 'Coordinador Labs', "Como miembro del area de Mozilla Hispano Labs (y eventualmente coordinador) desarrolle y asisti en el desarrollo de herramientas innovadoras para hacer de la web un lugar mejor para todos. Trabajando en projectos de codigo abierto me permitio obtener mucha experiencia antes de acabar la educación segundaria, y trabajar con —y aprender de— personas con mucho talento.", 'mozilla_logo.png');
    timeline_period(2012, 2013, 50, 'Southampton Solent University', 'Estudiante de Ingeniería del Software', 'Estudiar un año en el extranjero me hizo apreciar profundamente los ambientes internacionales.', 'solent_logo.png');
    timeline_period(2013, 2014, 5, 'MyA.me', "Co-fundador y CTO", "MyA.me una plataforma de computación contextual para el Internet de las Cosas. Los usuarios pueden crear asistentes (A's) que se disparan dependiendo de su localización, de lo que estan haciendo o simplemente hablandole a su telefono. Estos asistentes pueden responder mostrando información relevante o realizando una acción.", 'mya_logo.png');
    timeline_period(2014, 2015, 5, 'Immunity Zone / Amune.org', "Co-fundador y CTO", 'Con immunity zone, yo y mi equipo extendimos los limites de la web como plataforma creando un navegador que funciona en la nuve. El backend descarga la pagina y ejecuta javascript, enviando el resultado al cliente. El resultado es un navegador seguro, privado y rápido que funciona dentro de cualquier navegador moderno.', 'immunityzone_icon.png');

    timeline_right();

    timeline_period(2008, 2013, 60, 'Autonomo', 'Desarrollador freelance', 'Trabajar como freelance me hizo entender como diferentes industrias usas la tecnologia para consegir sus objetivos, ademas de experiencia practiva en diferentes tecnologías.', 'bengoa_logo.png');
    timeline_period(2009, 2012, 15, 'Universidad de Málaga', 'Estudiante de Ingeniería del Software', 'Matricula de Honor (mejor de la clase) en: Programación Orientada a Objetos, Estructura de Datos, Análisis y Diseño de Algoritmos, Teoría de Autómatas y Lenguajes Formales, Programacion de Sistemas/Concurrencia y Sistemas Operativos', 'uma_logo.jpg');
    timeline_period(2013, '',   85, 'CERN', "Desarrollador en Python para Invenio", "Invenio es un projecto Open Source que se usa en el CERN Document Server y INSPIRE, la base de datos que contiene datos bibliograficos de mas de un millon de publicaciones, evolición de SPIRES el primer sitio web fuera de Europa y la primera base de datos servida a traves de la web.\nTrabajando en el CERN aprendi a trabajar confortablemente en grandes equipos cross-funcionales y multi-culturales.", 'cern_logo.jpg');
    timeline_period(date('Y'), tr('…'), 60, 'Tu compañia', 'Ingeniero del Software', "Imagina todo lo que podriamos escribir aquí!");

    timeline_end();

    skills_title();
    skills_start(
        26, //Item count
        10, //Title count
        3  // Number of columns
    );
    do_skills();
    skills_end();
    cv_end();
}


?>
