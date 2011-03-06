#!/bin/sh
set -e

function static(){
    cp "src/$1" "prod/$1"
}

function getdin(){
    php "src/$2" "--lang=$1" > prod/$1/$3
}

rm -r prod
mkdir -p prod/david/es prod/david/en prod/david/css prod/david/img prod/david/css/img prod/david/js

# Archivos de redirección, redireccionan el navegador como sea necesario
# teniendo en cuenta el idioma
cp src/redirect.php prod/index.php
cp src/redirect.php prod/david/index.php

#archivos estaticos
static js/cv.js
static js/global.js
static tuenti.html
static img/Laughing.png
static img/clef.png
static img/feed.png
static img/gnu.png
static img/pajaro.png
static img/pi.gif
static img/terminal.png
static img/twitter.png
static css/cv.css
static css/global.css
static css/img/header-blog.png
static css/img/pattern11.jpg
static css/img/pattern15.jpg
static css/img/pattern3-1.jpg
static css/img/pattern8-0.jpg
static css/img/mask.png
static css/img/pattern12.png
static css/img/pattern1.jpg
static css/img/pattern4-1.jpg
static css/img/pattern9.gif
static css/img/twitter-header.png
static css/img/pattern10.png
static css/img/pattern14.jpg
static css/img/pattern2-0.jpg
static css/img/pattern5-0.jpg

#archivos dinamicos
getdin es index.php index.html
getdin en index.php index.html

getdin es cvhtml.php cv.html
getdin en cvhtml.php cv.html
getdin es cvpdf.php david-bengoa-cv-es.pdf
getdin en cvpdf.php david-bengoa-cv-en.pdf

php "src/cvimg.php" "--lang=es" > prod/img/cvimage.png
