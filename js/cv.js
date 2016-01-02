
function init(){
    var svg = document.getElementById("svgnode");
    if(!(SVGSVGElement && svg instanceof SVGSVGElement)){
        var container = svg.parentNode;
        container.removeChild(svg);
        var img = document.createElement("img");
        img.setAttribute("src",svg_image);
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
