<?php

include_once "global.php";
$deph = "";


function content(){
    include("header.php");
    ?>
        <div id="wrapper">
            <div id="aboutme">
                <div class="separator"></div>
                <div class="photos" id="photos">
                    <div class="photo photo-2" id="photo-2">
                        <img class="proto-img" src="<?php statico("img/avatar3.jpg"); ?>" alt="David Bengoa" />
                    </div>
                    <div class="photo photo-3" id="photo-3">
                        <img class="proto-img" src="<?php statico("img/avatar1.jpg"); ?>" alt="David Bengoa" />
                    </div>
                    <div class="photo photo-1" id="photo-1">
                        <img class="proto-img" src="<?php statico("img/avatar4.jpg"); ?>" alt="David Bengoa" />
                    </div>
                </div>
                <div id="about-me-right">
                    <h2><?php t("Sobre mí"); ?></h2>
                    <div id="about-me-text">
                        <p><?php t("Soy un emprendedor y programador, ademas de estudiante de Ingeniería del Software."); ?> <?php t("Desde que nací, la tierra ha completado"); ?> <span id="date">20.00000000</span> <?php t("revoluciones alrrededor del Sol. Vivo en Málaga."); ?></p>
                        <p><?php t("Me gusta crear cosas."); ?></p>
                        <p><?php t("Soy un fan del software libre y los estándares abiertos. He colaborado con varios proyectos de software libre, con los que he aprendido mas de lo imaginable."); ?></p>
                        <p><?php t("En cuanto a hobbys, a parte de lo típico (leer, viajar, música y películas) me gusta hacer snowboard."); ?></p>
                        <p id="otherprofiles">
                            <?php t("Sigue en contacto");?>!
                            <a class="mail" target="_blank" href="mailto:david@bengoarocandio.com">E-mail</a>
                            <a class="last" target="_blank" href="http://last.fm/user/YouWoTMA">Last-fm</a>
                            <a class="face" target="_blank" href="http://facebook.com/bengoa">Facebook</a>
                            <a class="tuen" target="_blank" href="<?php statico("tuenti"); ?>">Tuenti</a>
                            <a class="pcpl" target="_blank" href="http://picplz.com/user/dvdbng/">Picplz</a>
                            <a class="blog" target="_blank" href="http://hoyga.com">Blog</a>
                            <a class="redd" target="_blank" href="http://www.reddit.com/user/bengoa">Reddit</a>
                            <a class="gith" target="_blank" href="http://github.com/YouWoTMA/">Github</a>
                            <a class="dias" target="_blank" href="https://joindiaspora.com/people/7765">Diaspora</a>
                            <a class="plus" target="_blank" href="https://plus.google.com/u/0/106806585578290774069">Google+</a>
                            <a class="four" target="_blank" href="https://foursquare.com/dvdbng">Foursquare</a>
                            <a class="twit" target="_blank" href="http://twitter.com/dvdbng">Twitter</a>
                        </p>
                    </div>
                </div>
                <div class="separator"></div>
            </div>
            <div id="twitter">
                <div id="twitter-header">
                    <h2 id="twitter-header-text"><?php t("Ultimos tweets"); ?></h2>
                </div>
                <div id="tweets"></div>
            </div>
            <div id="blog">
                <div id="blog-header">
                    <h2 id="blog-header-text"><?php t("Ultimas entradas de mi blog"); ?></h2>
                </div>
            </div>
            <script type="text/javascript">
                var twt_logo_img = "<?php statico("img/pajaro.png"); ?>";
            </script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
            <script type="text/javascript" src="<?php statico("js/global.js"); ?>"></script>
            <script type="text/javascript" src="<?php is_cli()?statico("prefetch.php"):print("data:text/js;urlencode,"); ?>"></script>
        </div>

        <div id="footer">
            &copy; 2011 David Bengoa Rocandio<br/>
            <a href="https://github.com/YouWoTMA/brweb"><?php t("Código fuente de la pagina (GPL)"); ?></a>
        </div>
<?php
}

include_once "base.php";

?>
