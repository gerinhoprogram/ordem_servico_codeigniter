// const BASE_URL = "http://localhost/ordem/";
//const BASE_URL = "https://erp-rogerio.000webhostapp.com/";
const BASE_URL = "http://www.rogerioweb.com/ordem";


$(function() {
    function blinker() {
        $('.blink_me').fadeOut(1000);
        $('.blink_me').fadeIn(1000);
    }
    setInterval(blinker, 1000);
}); //]]>