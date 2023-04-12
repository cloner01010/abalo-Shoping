function saveCookies(){
    document.cookie = "saveCookies=true";
    document.getElementById("cookie-popup").classList.add("hidden");
}
function dontSaveCookies(){
    document.cookie = "saveCookies=false";
    document.getElementById("cookie-popup").classList.add("hidden");
}
