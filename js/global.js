/*
    Copyright (C) 2011 David Bengoa Rocandio

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
var banners = $(".header-banner");

var actual_banner=0,tid=null;
var animations = [];

function setOpacity(elm,value){
    elm.style.opacity = value;
    elm.style.filter = 'alpha(opacity=' + value*100 + ')';
    elm.style.display = value===0?"none":"block";
}
function fadeOut(elm){
    animations.push([setOpacity,1,0,elm,+new Date(),1000]);
}
function fadeIn(elm){
    animations.push([setOpacity,0,1,elm,+new Date(),1000]);
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

var scheduleAnimationFrame =
      window.requestAnimationFrame       ||
      window.webkitRequestAnimationFrame ||
      window.oRequestAnimationFrame      ||
      window.msRequestAnimationFrame     ||
      window.mozRequestAnimationFrame    ||
      function(callback, element){
            setTimeout(callback, 16);
      };

function mkElement(tag,attrs,childs){
    attrs = attrs || {};
    childs = childs || [];
    var elm = document.createElement(tag);
    for(var a in attrs){
        if(attrs.hasOwnProperty(a)){
            elm.setAttribute(a,attrs[a]);
        }
    }
    for(var i=0,l=childs.length; i<l; ++i){
        elm.appendChild(childs[i]);
    }
    return elm;
}
function mkText(t){
    return document.createTextNode(t);
}

function animate(){
    var now = +new Date();
    for(var i=0, l=animations.length; i<l;++i){
        var animdata = animations[i];
        var delta = now-animdata[4];
        var value = easeInOut(animdata[1],animdata[2],animdata[5],delta);
        animdata[0](animdata[3],value);
        if(delta > animdata[5]){
            animations.splice(i,1);
            --i; --l;
        }
    }
    if(animations.length > 0){
        scheduleAnimationFrame(animate);
    }
}

function next_banner(){
    change_banner(1,false);
}

function change_banner(delta,stopped){
    if(banners.length === 0 || animations.length >0)return;
    if(tid){
        clearTimeout(tid);
        tid=null;
    }

    delta = delta||1;
    var ant_banner = actual_banner;
    actual_banner = (actual_banner+delta+banners.length)%banners.length;
    fadeOut(banners[ant_banner]);
    fadeIn(banners[actual_banner]);
    scheduleAnimationFrame(animate);
    if(!stopped){
        tid = setTimeout(next_banner,1000*4);
    }
}

$("#flecha-izq").click(function(){change_banner(-1,true);});
$("#flecha-der").click(function(){change_banner(1,true);});

$("#header").hover(function(){
    if(tid) clearTimeout(tid);
    tid = null;
},function(){
    if(tid) clearTimeout(tid);
    tid = setTimeout(change_banner,1000*3);
});

var tid = setTimeout(next_banner,1000*2);


var $date = $("#date");
function update_date(){
    var date_born = new Date(1991,11,24,20,0,0,0),
        now=new Date(),
        diff=now-date_born,
        years=diff/(365.256363004*24*60*60*1000),
        years_str=(Math.round(years*100000000)/100000000)+"";

    while(years_str.length < 11){
        years_str += "0";
    }

    $date.text(years_str);
}
setInterval(update_date,100);
