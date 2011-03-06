<?php
    function emerge($w,$a = ""){
        global $debug;
        if(is_callable($w)){
            if(isset($debug) and $debug){
                slog("Emerge: $w($a);");
            }
            return $w($a);
        }
        return false;
    }
    $log = "";
    function slog($s){
        global $log;
        $log .= $s."\n";
    }
    function dlog(){
        echo "<!-- \n";
        echo $log;
        echo " -->";
    }
    function ifprint($c,$t="",$f=""){
        if($c){
            echo $t;
        }else{
            echo $f;
        }
    }
    $page = emerge("page");
    function d(){
        echo "<h1>D LLAMADO</h1>";
    }
?>
