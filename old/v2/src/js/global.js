"use strict";
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

$("#flecha-ize").click(function(){change_banner(-1,true);});
$("#flecha-der").click(function(){change_banner(1,true);});

$("#header").hover(function(){
    tid && clearTimeout(tid);
    tid = null;
},function(){
    tid && clearTimeout(tid);
    tid = setTimeout(change_banner,1000*1);
});

// Insertar ZERO_WIDTH_SPACE entre todos los caracteres,
// para que el navegador parta la cadena en cualquier lugar
var pi = document.getElementById("banner_10_inner");
var pitxt = pi.firstChild.nodeValue;
pi.firstChild.nodeValue = pitxt.split("").join(String.fromCharCode(8203));

var tid = setTimeout(next_banner,1000*2);

var LINK_RX = /http:\/\/\S+/,
    USER_RX = /@[a-zA-Z0-9_]+/,
    HASH_RX = /#\S+/;
function render_tweets(tweets){
    var $target = $("#tweets");
    for(var i=0,l=tweets.length; i<l; ++i){
        var txt = tweets[i]["text"].split(/\s+/);
        var $elm = $("<div/>").attr("class","tweet");
        var $img  = $("<img/>").attr("src",twt_logo_img).attr("class","tweetbird").appendTo($elm);

        for(var k=0, m=txt.length; k<m; ++k){
            var token = txt[k];
            if(LINK_RX.test(token)){
                $("<a/>").attr("href",token)
                         .attr("target","_blank")
                         .text(token)
                         .appendTo($elm);
            }else if(HASH_RX.test(token)){
                $("<a/>").attr("href","http://twitter.com/#!/search?q=" + encodeURIComponent(token))
                         .attr("target","_blank")
                         .text(token)
                         .appendTo($elm);
            }else if(USER_RX.test(token)){
                $elm.append("@");
                token = token.substring(1); //remove the @
                $("<a/>").attr("href","http://twitter.com/" + token)
                      .attr("target","_blank")
                      .text(token)
                      .appendTo($elm);
            }else if(token){
                $elm.append(document.createTextNode(token));
            }
            $elm.append(" ");
        }
        $target.append($elm);
    }
}


function render_posts(data){
    var blog = document.getElementById("blog");
    for(var i = 0, l = data.length; i<l; ++i){
        var postdata = data[i];
        var link = mkElement("a",{"href":postdata["permalink"]});
        link.innerHTML = postdata["title"];
        blog.appendChild(mkElement("h2",{"class":"blogtitle"},[link]));
        var p = mkElement("p",{"class":"blogtxt"});
        p.innerHTML = data[i]["excerpt"];
        blog.appendChild(p);
    }
}

function render_photos(){}


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
setInterval(update_date,50);

$("#photo-1").hover(function(){
    $("#photos").addClass("over");
},function(){
    $("#photos").removeClass("over");
});
