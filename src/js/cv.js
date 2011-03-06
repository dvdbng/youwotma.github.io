function haveSVG(){
    return document.implementation &&
           document.implementation.hasFeature &&
           document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1") &&
           !window.opera; // Something goes very wrong with this svg in opera
}


function init(){
    if(!haveSVG()){
        var svg = document.getElementById("svgnode");
        var container = svg.parentNode;
        container.removeChild(svg);
        var img = document.createElement("img");
        img.setAttribute("src","cvimage.png");
        container.appendChild(img);
        for(var i = 0, l = accesible_texts.length; i<l; ++i){
            var text = accesible_texts[i];
            var elm = document.createElement("div");
            elm.appendChild(document.createTextNode(text[3]));
            elm.setAttribute("class","accessibletxt " + text[4] + " " + text[0]);
            elm.style.top = (text[2]-10) + "px";
            elm.style.left = (text[1]-(text[0]==="middle"?150:300)) + "px";
            container.appendChild(elm);
        }
    }
}
init();
