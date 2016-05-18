var pgw;
var mLeft;
function reCenter() {
    pgw = window.outerWidth;
    mLeft = String((pgw - 300) / 2) + "px";
    document.getElementById("MTitle").style.marginLeft = mLeft;
}