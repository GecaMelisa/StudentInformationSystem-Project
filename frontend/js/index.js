window.onload = function () {
    let token = "sfsdf";

function validateToken(jwt) {
    return true;
}
if(validateToken(token)){
   // window.location.href = "index.html"
} else {
    window.location.href = "login.html"

}
}