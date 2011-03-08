//var banners = document.getElementsByClassName("header-banner");
//Brrr! no getElementsByClassName in IE8 :(
var banners = [4,7,9,3,8,10,5,2];
for(var i=0,l=banners.length; i<l; ++i){
    banners[i] = document.getElementById("banner_" + banners[i]);
}


function attach_event(elm,ev,fn){
    if(elm.attachEvent){
        elm.attachEvent(ev,fn);
    }else{
        elm.addEventListener(ev,fn,false);
    }
}

var actual_banner=0,tid=null;
var animations = [];

function setOpacity(elm,value){
    elm.style.display = value===0?"none":"block";
    elm.style.opacity = value;
    elm.style.filter = 'alpha(opacity=' + value*100 + ')';
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
//      TODO: investigate witch event you need to listen to use these
//      window.requestAnimationFrame       ||
//      window.webkitRequestAnimationFrame ||
//      window.oRequestAnimationFrame      ||
//      window.msRequestAnimationFrame     ||
      window.mozRequestAnimationFrame    ||
      function(callback, element){
            setTimeout(animate, 16);
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
        scheduleAnimationFrame();
    }
}
("addEventListener" in window) && window.addEventListener("MozBeforePaint", animate, false);

function change_banner(delta){
    if(banners.length === 0 || animations.length >0)return;
    if(tid){
        clearTimeout(tid);
    }

    delta = delta||1;
    var ant_banner = actual_banner;
    actual_banner = (actual_banner+delta+banners.length)%banners.length;
    fadeOut(banners[ant_banner]);
    fadeIn(banners[actual_banner]);
    scheduleAnimationFrame();
    tid = setTimeout(change_banner,1000*4);
}

attach_event(document.getElementById("flecha-izq"),"click",function(){change_banner(-1);});
attach_event(document.getElementById("flecha-der"),"click",function(){change_banner(1);});

var header = document.getElementById("header");
attach_event(header,"mouseenter",function(){clearTimeout(tid);});
attach_event(header,"mouseleave",function(){setTimeout(change_banner,1000*3)});

var pi = document.getElementById("banner_10_inner");
var pitxt = pi.firstChild.nodeValue;
pi.firstChild.nodeValue = pitxt.split("").join(String.fromCharCode(8203));

var tid = setTimeout(change_banner,1000*2);

var LINK_RX = /http:\/\/\S+/,
    USER_RX = /@[a-zA-Z0-9_]+/,
    HASH_RX = /#\S+/;
function render_tweets(tweets){
    var target = document.getElementById("tweets");
    for(var i=0,l=tweets.length; i<l; ++i){
        var txt = tweets[i]["text"].split(/\s+/);
        var elm = document.createElement("div");
        elm.setAttribute("class","tweet");
        var img  = document.createElement("img");
        img.setAttribute("src",twt_logo_img);
        img.setAttribute("class","tweetbird");
        elm.appendChild(img);
        for(var k=0, m=txt.length; k<m; ++k){
            var token = txt[k];
            if(LINK_RX.test(token)){
                var a  = document.createElement("a");
                a.setAttribute("href",token);
                a.setAttribute("target","_blank");
                a.appendChild(document.createTextNode(token));
                elm.appendChild(a);
                elm.appendChild(document.createTextNode(" "));
            }else if(HASH_RX.test(token)){
                var a  = document.createElement("a");
                a.setAttribute("href","http://twitter.com/#!/search?q=" + encodeURIComponent(token));
                a.setAttribute("target","_blank");
                a.appendChild(document.createTextNode(token));
                elm.appendChild(a);
                elm.appendChild(document.createTextNode(" "));
            }else if(USER_RX.test(token)){
                elm.appendChild(document.createTextNode("@"));
                token = token.substring(1); //remove the @
                var a  = document.createElement("a");
                a.setAttribute("href","http://twitter.com/" + token);
                a.setAttribute("target","_blank");
                a.appendChild(document.createTextNode(token));
                elm.appendChild(a);
                elm.appendChild(document.createTextNode(" "));
            }else{
                if(token){
                    elm.appendChild(document.createTextNode(token+" "));
                }
            }
        }
        target.appendChild(elm);
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
