#!/bin/sh
function crop(){
    convert "source/$1" -crop $2 -quality 80 +repage $3
}
function tojpg(){
    convert "source/$1.png" -quality 80 "$1.jpg"
}


HEIGHT="435"
WIDTH="960"
crop backgrounsetc-starfield-1.jpg 512x$HEIGHT pattern2.jpg
crop backgrounsetc-starfield-2.jpg 512x$HEIGHT pattern3.jpg
crop backgrounsetc-starfield-3.jpg 512x$HEIGHT pattern4.jpg
crop backgrounsetc-starfield-4.jpg 512x$HEIGHT pattern5.jpg
crop backgrounsetc-starfield-4.jpg 512x$HEIGHT pattern5.jpg
#crop backgrounsetc-starfield-5.jpg 512x$HEIGHT pattern6.jpg
crop pattern-8-big.jpg $WIDTH"x"$HEIGHT pattern8.jpg

crop texture3.jpg $WIDTH"x"$HEIGHT pattern15.jpg
mv pattern15-0.jpg pattern15.jpg
rm pattern15-*

#tojpg pattern13
tojpg pattern11
tojpg pattern14

RMFILES=""
RMFILES="$RMFILES pattern2-2.jpg"
RMFILES="$RMFILES pattern3-2.jpg"
RMFILES="$RMFILES pattern4-2.jpg"
RMFILES="$RMFILES pattern5-2.jpg"

RMFILES="$RMFILES pattern2-1.jpg"
RMFILES="$RMFILES pattern3-0.jpg"
RMFILES="$RMFILES pattern4-0.jpg"
RMFILES="$RMFILES pattern5-1.jpg"

RMFILES="$RMFILES pattern8-1.jpg"
RMFILES="$RMFILES pattern8-2.jpg"
RMFILES="$RMFILES pattern8-3.jpg"

rm $RMFILES
