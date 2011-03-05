        <div id="header">
            <div id="header-nav">
                <a href="http://hoyga.com" class="last"><?php t("Blog"); ?></a>
                <a href="<?php echo d(); ?>cv"><?php t("Currículum vítae");?></a>
                <a href="../en"><?php t("English"); ?></a>
            </div>
            <h1 id="header-mask">David Bengoa</h1>
            <div id="banner_4" class="header-banner">
                <img src="<?php echo d(); ?>img/twitter.png" alt="twitter" class="banner-image"/>
                <div class="textcontent"><h2><?php t("Tal vez quieras leer <span class='subpart'>lo que escribo</span> en <a href='http://twitter.com/DvdBng'>twitter</a>"); ?></h2></div>
            </div>
            <div id="banner_7" style="display:none" class="header-banner">
                <img src="<?php echo d(); ?>img/gnu.png" alt="GNU" class="banner-image"/>
                <div class="textcontent">
                    <h2><?php t("Hago y uso software libre"); ?></h2>
                    <p>
                        <?php
                            function fs_icon($url,$name){
                                echo "<a target='_blank' href='$url'>$name</a> ";
                            }
                            echo "<br/>";
                            t("Proyectos/programas que uso habitualmente:");
                            echo "<br/>";
                            fs_icon("http://www.mozilla.org/","Mozilla");
                            fs_icon("http://www.kernel.org/","Linux");
                            fs_icon("http://www.ubuntu.com/","Ubuntu");
                            fs_icon("http://www.gentoo.org/","Gentoo");
                            fs_icon("http://www.gnu.org/","GNU");
                            fs_icon("http://www.gnome.org/","Gnome");
                            fs_icon("http://www.nongnu.org/ratpoison/","Ratpoison");
                            fs_icon("http://www.mozillamessaging.com","Thunderbird");
                            fs_icon("http://mozilla.com/firefox","Firefox");
                            fs_icon("http://www.videolan.org/vlc/","VLC");
                            fs_icon("http://jdownloader.org/","Jdownloader");
                            fs_icon("http://inkscape.org/","Inkscape");
                            fs_icon("http://www.gimp.org/","GIMP");
                            fs_icon("http://webkit.org/","Webkit");
                            fs_icon("http://www.android.com/","Android");
                            fs_icon("http://git-scm.com/","Git");
                            fs_icon("http://mercurial.selenic.com/","Mercurial");
                            fs_icon("http://www.vim.org/","Vim");
                            fs_icon("http://meld.sourceforge.net/","Meld");
                            fs_icon("http://www.python.org/","Python");
                            fs_icon("http://htop.sourceforge.net/","htop");
                            fs_icon("http://gcc.gnu.org/","gcc");
                            fs_icon("http://code.reddit.com/","Reddit");
                            fs_icon("http://www.transmissionbt.com/","Transmission");
                            fs_icon("http://www.imagemagick.org","Imagemagick");
                            fs_icon("http://www.gnu.org/software/wget/","wget");
                            fs_icon("http://curl.haxx.se/","curl");
                            fs_icon("http://www.chromium.org/","Chromium");
                            fs_icon("http://www.djangoproject.com/","Django");
                            fs_icon("http://wordpress.com/","Wordpress");
                            fs_icon("http://www.php.net/","PHP");
                            fs_icon("http://sass-lang.com/","Sass");
                            fs_icon("http://banshee.fm/","Banshee");
                            fs_icon("http://www.virtualbox.org/","Virtualbox");
                            fs_icon("http://www.mysql.com/","MySQL");
                            fs_icon("http://www.pidgin.im/","Pidgin");
                            fs_icon("http://www.gtk.org/","GTK+");
                            fs_icon("http://www.mono-project.com/","Mono");
                            fs_icon("http://www.phonegap.com/","Phonegap");
                            fs_icon("http://drupal.org/","Drupal");
                        ?>
                    </p>
                </div>
            </div>
            <div id="banner_9" style="display:none" class="header-banner">
                <!-- Original bg image: http://jsonsw-7.deviantart.com/art/We-Own-The-Sky-v-2-85852754 -->
                <div class="textcontent"><h2><?php t("Sé hacer muchas cosas.<br/><span class='subpart'><a href='cv'>Mira mi currículum</a></span>"); ?></h2></div>
            </div>
            <div id="banner_3" style="display:none" class="header-banner">
                <img src="<?php echo d(); ?>img/terminal.png" alt="terminal" class="banner-image"/>
                <div class="textcontent"><h2><?php t("Algunos días, <span class='subpart'>paso mas tiempo</span> en una shell de Unix <span class='subpart'>que durmiendo</span>"); ?></h2></div>
            </div>
            <div id="banner_8" style="display:none" class="header-banner">
                <img src="<?php echo d(); ?>img/feed.png" alt="RSS" class="banner-image"/>
                <div class="textcontent">
                    <h2><?php t("Tenía un blog"); ?></h2>
                    <p><?php t("Espera, <a href='http://hoyga.com'>todavia lo tengo</a>, solo que no encuentro tiempo para escribir en el."); ?></p>
                </div>
            </div>
            <div id="banner_10" style="display:none" class="header-banner">
                <img class="banner-image" src="<?php echo d(); ?>img/pi.gif" alt="PI"/>
                <div class="textcontent">
                    <h2><?php t("Me encantan las matemáticas"); ?></h2>
                    <p>Solo algunos días, no soy tan raro.</p>
                </div>
                <div id="banner_10_inner">3.141592653589793238462643383279502884197169399375105820974944592307816406286208998628034825342117067982148086513282306647093844609550582231725359408128481117450284102701938521105559644622948954930381964428810975665933446128475648233786783165271201909145648566923460348610454326648213393607260249141273724587006606315588174881520920962829254091715364367892590360011330530548820466521384146951941511609433057270365759591953092186117381932611793105118548074462379962749567351885752724891227938183011949129833673362440656643086021394946395224737190702179860943702770539217176293176752384674818467669405132000568127145263560827785771342757789609173637178721468440901224953430146549585371050792279689258923542019956112129021960864034418159813629774771309960518707211349999998372978049951059731732816096318595024459455346908302642522308253344685035261931188171010003137838752886587533208381420617177669147303598253490428755468731159562863882353787593751957781857780532171226806613001927876611195909216420198938095257201065485863278865936153381827968230301952035301852968995773622599413891249721775283479131515574857242454150695950829533116861727855889075098381754637464939319255060400927701671139009848824012858361603563707660104710181942955596198946767837449448255379774726847104047534646208046684259069491293313677028989152104752162056966024058038150193511253382430035587640247496473263914199272604269922796782354781636009341721641219924586315030286182974555706749838505494588586926995690927210797509302955321165344987202755960236480665499119881834797753566369807426542527862551818417574672890977772793800081647060016145249192173217214772350141441973568548161361157352552133475741849468438523323907394143334547762416862518983569485562099219222184272550254256887671790494601653466804988627232791786085784383827967976681454100953883786360950680064225125205117392984896084128488626945604241965285022210661186306744278622039194945047123713786960956364371917287467764657573962413890865832645995813390478027590099465764078951269468398352595709825822620522489407726719478268482601476990902640136394437455305068203496252451749399651431429809190659250937221696461515709858387410597885959772975498930161753928468138268683868942774155991855925245953959431049972524680845987273644695848653836736222626099124608051243884390451244136549762780797715691435997700129616</div>
            </div>
            <div id="banner_5" style="display:none" class="header-banner">
                <div class="textcontent"><h2><?php t("Hago listas para todo"); ?></h2></div>
            </div>
            <div id="banner_2" style="display:none" class="header-banner">
                <img src="<?php echo d(); ?>img/clef.png" alt="Bass clef" class="banner-image"/>
                <div class="textcontent"><h2><?php t("Amo la música"); ?></h2><p><?php t("Hago scrobbing en <a href='http://www.last.fm/user/YouWoTMA'>last.fm</a> de las canciones que escucho en <a href='http://banshee.fm/'>Banshee</a>");?></div>
            </div>
        </div>

        <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php echo d(); ?>js/global.js"></script>
