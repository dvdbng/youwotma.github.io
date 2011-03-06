<?php

include_once "global.php";
$deph = "";


function content(){
    include("header.php");
    ?>
        <div id="wrapper">
            <div id="twitter">
                <div id="twitter-header">
                    <h2 id="twitter-header-text"><?php t("Ultimos tweets"); ?></h2>
                </div>
                <div id="tweets"></div>
                <div id="otherprofiles">
                    <?php t("Sigue en contacto");?>!
                    <a class="mail" target="_blank" href="mailto:david@bengoarocandio.com">E-mail</a>
                    <a class="last" target="_blank" href="http://last.fm/user/YouWoTMA">Last-fm</a>
                    <a class="face" target="_blank" href="http://facebook.com/bengoa">Facebook</a>
                    <a class="tuen" target="_blank" href="<?php statico("tuenti"); ?>">Tuenti</a>
                    <a class="twit" target="_blank" href="http://twitter.com/dvdbng">Twitter</a>
                    <a class="blog" target="_blank" href="http://hoyga.com">Blog</a>
                    <a class="redd" target="_blank" href="http://www.reddit.com/user/bengoa">Reddit</a>
                    <a class="dias" target="_blank" href="https://joindiaspora.com/people/7765">Diaspora</a>
                </div>
            </div>
            <div id="blog">
                <div id="blog-header">
                    <h2 id="blog-header-text"><?php t("Ultimas entradas de mi blog"); ?></h2>
                </div>
            </div>
            <script type="text/javascript">
                <?php include "prefetch.php"; ?>;
            </script>
        </div>
<?php
}

include_once "base.php";

?>
