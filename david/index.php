<?php

include_once "global.php";
$deph = "";


function content(){
    include("header.php");
    ?>
    <div id="wrapper">
        <div id="twitter">
            <div id="twitter-header">
                <h2 id="twitter-header-text">Ultimos tweets</h2>
            </div>
        </div>
        <div id="blog">
            <div id="blog-header">
                <h2 id="blog-header-text">Ultimas entradas de mi blog</h2>
            </div>
        </div>
        <script type="text/javascript">
            <?php include "prefetch.php"; ?>
        </script>
    </div>
    <?php
}

include_once "base.php";

?>
