<?php
$lang = array(
    "Blog"=>"Blog",
    "Currículum vítae"=>"Curriculum vitae",
    "David Bengoa - Currículum Vítae"=>"David Bengoa - Curriculum Vitae",
    "English"=>"Español",
    "Tal vez quieras leer <span class='subpart'>lo que escribo</span> en <a href='http://twitter.com/DvdBng'>twitter</a>"=>"You might want to read <span class='subpart'>my tweets</span> on <a href='http://twitter.com/DvdBng'>twitter</a>",
    "Hago y uso software libre"=>"I make and use free software",
    "Proyectos/programas que uso habitualmente:"=>"Projects/programs I often use:",
    "Sé hacer muchas cosas.<br/><span class='subpart'><a href='cv'>Mira mi currículum</a></span>"=>"I can do many things.<br/><span class='subpart'><a href='cv'>Take a look at my CV</a></span>",
    "Algunos días, <span class='subpart'>paso mas tiempo</span> en una shell de Unix <span class='subpart'>que durmiendo</span>"=>"Some days, <span class='subpart'>I spend more time</span> in a Unix shell <span class='subpart'>than sleeping</span>",
    "Tenía un blog"=>"I had a blog",
    "Espera, <a href='http://hoyga.com'>todavia lo tengo</a>, solo que no encuentro tiempo para escribir en el."=>"Wait, <a href='http://hoyga.com'>I still have it</a>, just can't find time to write in it.",
    "Me encantan las matemáticas"=>"I love math",
    "Hago listas para todo"=>"I make lists for everything",
    "Amo la música"=>"I love Music",
    "Hago scrobbing en <a href='http://www.last.fm/user/YouWoTMA'>last.fm</a> de las canciones que escucho en <a href='http://banshee.fm/'>Banshee</a>"=>"I scrob to <a href='http://www.last.fm/user/YouWoTMA'>last.fm</a> the songs I listen in <a href='http://banshee.fm/'>Banshee</a>",
    "David Bengoa - Currículum vítae"=>"David Bengoa - Curriculum vitae",
    "Resumen de habilidades:"=>"Skills:",
    "Carnet de conducir"=>"Driving license",
    "Tipo B"=>"Type B",
    "Resumen de habilidades"=>"Skills",
    "No recuerdo mucho de esta época. Fue hace muuucho tiempo."=>"I don't remember much about this period. It was a long time ago.",
    "Nací"=>"I was born",
    "Me mudo a Málaga"=>"Moved to Málaga",
    "Mayor de edad"=>"Adult",
    "Me paso a GNU/Linux"=>"Switched to GNU/Linux",
    "Hoy"=>"Today",
    "ESO"=>"ESO",
    "Bachiller"=>"Bachiller",
    "Universidad"=>"University",
    "Compiladores"=>"Compilers",
    "Tecnologias web"=>"Web technologies",
    "APIs del navegador"=>"Browser APIs",
    "Config. y compilación del kernel"=>"Kernel config & compilation",
    "Binarios standard Unix"=>"Standard Unix Binaries",
    "Tecnologias Mozilla"=>"Mozilla Technologies",
    "Extensiones CSS de mozilla"=>"Mozilla css extensiong",
    "Extensiones js de Spidermonkey"=>"Spidermonkey js extensions",
    "Compilación apps xulrunner "=>"Xulrunner apps compilation",
    "Otros"=>"Other",
    "Expresiones regulares"=>"Regular expressions",
    "Vim (editing)"=>"Vim (editing)",
    "Vim (scripting)"=>"Vim (scripting)",
    "Protocolo TCP/IP"=>"TCP/IP protocol",
    "Twitter API"=>"Twitter API",
    "Idiomas"=>"Languages",
    "Español"=>"Spanish",
    "Ingles"=>"English",
    "Protocolo HTTP"=>"HTTP protocol",
    "Ultimos tweets"=>"Last tweets",
    "Ultimas entradas de mi blog"=>"Last posts on my blog",
    "Solo algunos días, no soy tan raro."=>"Only some days, I'm not so weird.",
    "en"=>"es",
    "es"=>"en",
    "Página principal"=>"Home page",
    "Descarga mi CV en PDF"=>"Download my CV in PDF",
    "PDF generado el"=>"PDF generated on",
    "Este currículum se actualiza frecuentemente, puedes ver la versión online actualizada en"=>"This CV is updated frequently, you may view the updated online version at",
    "Sigue en contacto"=>"Keep in touch",
    "Sobre mí"=>"About me",
    "Soy un emprendedor y programador, ademas de estudiante de Ingeniería del Software."=>"I'm a entrepreneur and programmer, in addition to a Software Engineering student.",
    "Tengo"=>"I'm",
    "años. Vivo en Málaga."=>"years old. I live in Málaga.",
    "Me gusta crear cosas."=>"I like to create things.",
    "Soy un fan del software libre y los estándares abiertos. He colaborado con varios proyectos de software libre, con los que he aprendido mas de lo imaginable."=>"I'm a free software and open standards enthusiast. I have collaborated with several free software projects, with whom I have learned more than you can imagine.",
    "En cuanto a hobbys, a parte de lo típico (leer, viajar, música y películas) me gusta hacer snowboard."=>"About hobbys, apart from the typical (reading, traveling, music and films) I do snowboard.",
    "A veces hago cosas inservibles."=>"Sometime I build useless stuff.",
    'Como una <a href="http://bengoarocandio.com/html5tweets/">visualización de tweets en HTML5</a>, un <a href="http://bengoarocandio.com/clock/">reloj RGB</a> o un <a href="http://hoyga.com/circulos/">pasatiempo tonto</a>'=>'Like a <a href="http://bengoarocandio.com/html5tweets/">HTML5 tweet visualization</a>, a <a href="http://bengoarocandio.com/clock/">RGB clock</a> and a <a href="http://hoyga.com/circulos/">stupid game</a>',
    "Código fuente de la pagina (GPL)"=>"Page source code (GPL)",

);


function is_cli(){
    return isset($_SERVER['argc']) && $_SERVER['argc']>=1;
}
function has_arg($arg){
    return is_cli() && in_array($arg,$_SERVER['argv']);
}

$strs = array();
function t($x){
    echo tr($x);
}
function tr($x){
    global $strs,$lang;
    if(!isset($lang[$x])){
        $strs[$x] = $x;
    }else{
        if((isset($_GET["lang"]) && $_GET["lang"]=="en") || has_arg("--lang=en")){
            return $lang[$x];
        }
    }
    return $x;

}
$indent_lvl = 0;
function pprt($str,$ia=0,$id=0){
    global $indent_lvl;
    $indent_lvl += $ia;
    echo str_repeat(" ",$indent_lvl*4);
    echo $str;
    echo "\n";
    $indent_lvl += $id;
}
function pprti($str){pprt($str,0,1);}
function pprtu($str){pprt($str,-1,0);}
function indent($n){
    global $indent_lvl;
    $indent_lvl = $n;
}
function statico($path){
    if(isset($_GET["comp"]) || is_cli()){
        echo "../$path";
    }else{
        echo $path;
    }
}

include_once("functions.php");
?>
