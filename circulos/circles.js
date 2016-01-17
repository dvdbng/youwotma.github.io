/*
 *   Copyright (C) 2011  David Bengoa <david@bengoarocandio.com>
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

var SQRT2_2 = Math.sqrt(2)/2;
var ANIMATION_DURATION = 500;
var pow = Math.pow;

function get_random_color(){
    var r=255,g=255,b=255;
    while((r+g+b) > 230*3){ //No queremos un color demaseado claro
        r = Math.floor(Math.random()*256);
        g = Math.floor(Math.random()*256);
        b = Math.floor(Math.random()*256);
    }
    return [r,g,b];
}

function rgb_to_css(rgb){
    return "rgb(" + rgb.join(",") + ")";
}

function get_offset(offset,cuadrant){
    var offsetx = offset*SQRT2_2 || 0;
    return [
        offsetx*(cuadrant<2?1:-1),
        offsetx*(cuadrant%2?-1:1)
    ];
}

function get_circle(color,offset,cuadrant){
    var colorend = get_random_color();
    return {
        color: colorend,
        animst: window.mozAnimationStartTime || +(new Date()),
        colorstart: color || colorend,
        offset: get_offset(offset,cuadrant),
        animating: true,
    };
}

function get_four_circles(color,offset){
    return [
        get_circle(color,offset,0),
        get_circle(color,offset,1),
        get_circle(color,offset,2),
        get_circle(color,offset,3)
    ];
}

var circles = get_four_circles(), width, offsetx, offsety;
var canvas = document.getElementById("canvas");
var ctx = canvas.getContext("2d");
var cn = 4;

function distance(x1,y1,x2,y2){
    return Math.sqrt(pow(x1-x2,2)+pow(y1-y2,2));
}

function draw_circle(x,y,r){
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI*2, true);
    ctx.closePath();
    ctx.fill();
}

var dirty_areas = [];
function mark_dirty(x,y,w,circles){
    dirty_areas.push([x,y,w,circles]);
    start_draw_loop();
}

function easeInOut(minValue,maxValue,totalSteps,actualStep) {
    var t = Math.min(actualStep/totalSteps,1)*2, c = maxValue-minValue;
    if(t < 1){
        return c/2*(pow(t,3)) + minValue;
    }else{
        return c/2*(pow(t-2,3)+2) + minValue;
    }
}

function animate_color(st,en,dt){
    return[
        Math.floor(easeInOut(st[0],en[0],ANIMATION_DURATION,dt)),
        Math.floor(easeInOut(st[1],en[1],ANIMATION_DURATION,dt)),
        Math.floor(easeInOut(st[2],en[2],ANIMATION_DURATION,dt))
    ];
}

function redraw(x,y,w,circles,clear){
    if(clear){
        ctx.fillStyle="#fff";
        ctx.fillRect(x,y,w,w);
    }
    var radius = w/2;
    if(circles.length){
        var res = true;
        res = redraw(x,y,radius,circles[0]) && res;
        res = redraw(x,y+radius,radius,circles[1]) && res;
        res = redraw(x+radius,y,radius,circles[2]) && res;
        res = redraw(x+radius,y+radius,radius,circles[3]) && res;
        return res;
    }else{
        var dt = new Date() - circles.animst;
        ctx.fillStyle=rgb_to_css(animate_color(circles.colorstart,circles.color,dt));
        draw_circle(
            x+radius+easeInOut(circles.offset[0],0,ANIMATION_DURATION,dt),
            y+radius+easeInOut(circles.offset[1],0,ANIMATION_DURATION,dt),
            radius
        );
        if(dt >= ANIMATION_DURATION){
            circles["animating"] = false;
            return true;
        }
    }
    //return false;
}

function start_draw_loop(){
    if(!draw_looping)draw();
}

var draw_looping = false;
function draw(){
    var area,rem;
    for(var i=0, l=dirty_areas.length; i<l; ++i){
        area = dirty_areas[i];
        rem = redraw(area[0],area[1],area[2],area[3],true);
        if(rem){
            dirty_areas.splice(i,1);
            i--; l--;
        }
    }
    if(dirty_areas.length === 0){
        draw_looping = false;
    }else{
        draw_looping = true;
        scheduleAnimationFrame(draw);
    }
}

//function scheduleAnimationFrame(){
//    if("mozRequestAnimationFrame" in window){
//        window.mozRequestAnimationFrame();
//    }else if("webkitRequestAnimationFrame" in window){
//        setTimeout(draw,16); //TODO: investigar esto
//    }else{
//        setTimeout(draw,16); //Not awesome browsers
//    }
//}


//http://paulirish.com/2011/requestanimationframe-for-smart-animating/
var scheduleAnimationFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          window.oRequestAnimationFrame      ||
          window.msRequestAnimationFrame     ||
          function(callback, element){
                window.setTimeout(callback, 1000 / 60);
          };
})();

function canvasmv(e){
    var x,y;
    if ("layerX" in e){
        expand(e.layerX,e.layerY);
    }else if ("offsetX" in e){
        expand(e.offsetX,e.offsetY);
    }else{
        return;
    }
}
canvas.addEventListener("mousemove",canvasmv,false);
canvas.addEventListener("MozTouchDown",canvasmv,false);
canvas.addEventListener("MozTouchMove",canvasmv,false);
canvas.addEventListener("MozTouchUp",canvasmv,false);

function touch_event(event){
    event.preventDefault();
    for ( var i = 0, l=event.touches.length; i < l; i++){
        expand(event.touches[i].pageX, event.touches[i].pageY);
    }
}
canvas.addEventListener('mousemove', touch_event, false);
canvas.addEventListener('touchstart', touch_event, false);
canvas.addEventListener('touchmove', touch_event, false);


function expand(x,y){
    x -= offsetx;
    y -= offsety;
    //Buscar circulo
    var ant=null, val=circles;
    var sx=0,sy=0,fx=width,fy=fx,cx,cy,cuadrant;
    while(val.length){
        ant=val;
        cx=sx+((fx-sx)/2);
        cy=sy+((fy-sy)/2);
        cuadrant = (x>cx)*2 + (y>cy);
        val = val[cuadrant];
        sx = (cuadrant<2)?sx:cx;
        fx = (cuadrant<2)?cx:fx;
        sy = (cuadrant%2)?cy:sy;
        fy = (cuadrant%2)?fy:cy;
    }
    cx=sx+((fx-sx)/2);
    cy=sy+((fy-sy)/2);

    if(val.animating){
        return;
    }

    var radius = cx-sx;
    if(distance(cx,cy,x,y) < radius){
        //Divide in 4 circles
        ant[cuadrant] = get_four_circles(val.color,0.1*(fx-sx));
        mark_dirty(sx,sy,fx-sx,ant[cuadrant]);
        cn += 3;
    }
}

function updateWidth(){
    width = Math.min(window.innerWidth, window.innerHeight);
    offsetx = Math.round((window.innerWidth-width)/2);
    offsety = Math.round((window.innerHeight-width)/2);
    canvas.setAttribute("width", width);
    canvas.setAttribute("height", width);

    canvas.style.marginLeft = offsetx + "px";
    canvas.style.marginTop = offsety + "px";
    mark_dirty(0,0,width,circles);
}

updateWidth();

window.addEventListener("resize", updateWidth, true);

//canvas.removeEventListener("mousemove",canvasmv,true);
//canvas.addEventListener("click",canvasmv,true);
