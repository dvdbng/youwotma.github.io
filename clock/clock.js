"use strict";

function get_now(){
    var now = new Date();
    return [
        now.getHours(),
        now.getMinutes(),
        now.getSeconds()
    ];
}

function hour_to_color(hour){
    return [
        (hour[0]/24)*255,
        (hour[1]/60)*255,
        (hour[2]/60)*255,
    ]
}

function update_hour(){
    var hour = get_now();
    document.getElementById("date").firstChild.nodeValue = format_hour(hour);
    animate_to_color(hour_to_color(hour));
}

function init(){
    var now = hour_to_color(get_now());
    endcolor = now;
    set_body_color(now);
    update_hour();
    setInterval(update_hour,1000);
}

var pow = Math.pow;
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
        Math.floor(easeInOut(st[0],en[0],500,dt)),
        Math.floor(easeInOut(st[1],en[1],500,dt)),
        Math.floor(easeInOut(st[2],en[2],500,dt))
    ];
}

function pad(x){
    if(x<10){
        return "0"+x;
    }
    return ""+x;
}

function format_hour(hour){
    return pad(hour[0]) + ":" + pad(hour[1]) + ":" + pad(hour[2]);
}

function darken(rgb){
    return [
        Math.floor(Math.min(rgb[0]*0.5,255)),
        Math.floor(Math.min(rgb[1]*0.5,255)),
        Math.floor(Math.min(rgb[2]*0.5,255))
    ];
}
function rgb_to_css_gradient(rgb){
    return "-moz-radial-gradient(center 45deg, circle cover, rgb(" + rgb.join(",") + ") 0%, rgb(" + darken(rgb).join(",") + ") 100%)";
}

function rgb_to_css_color(rgb){
    return "rgb(" + rgb.join(",") + ")";
}

function set_body_color(color){
    document.body.style.background = rgb_to_css_gradient(color);
    document.body.style.backgroundColor = rgb_to_css_color(color);
}

var startcolor,endcolor,anim_start;
function animatebg(){
    if(startcolor){
        var delta = new Date() - anim_start;
        if(delta < 500){
            set_body_color(animate_color(startcolor,endcolor,delta));
            scheduleAnimationFrame(animatebg);
        }else{
            set_body_color(endcolor);
            startcolor = null;
        }
    }
}

function animate_to_color(color){
    startcolor = endcolor;
    endcolor = color;
    anim_start = +new Date();
    scheduleAnimationFrame(animatebg);
}

var scheduleAnimationFrame =
      window.requestAnimationFrame       ||
      window.webkitRequestAnimationFrame ||
      window.oRequestAnimationFrame      ||
      window.msRequestAnimationFrame     ||
      window.mozRequestAnimationFrame    ||
      function(callback, element){
            setTimeout(callback, 16);
      };

init();
