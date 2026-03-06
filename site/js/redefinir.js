var txt_password = $("#txt_password");

$("#submit2").on("click", function(){
    enviar();
});


function GET(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

//function enviar(){
//    post1("/routine/cadastro.php", "redefinir", {"email" : txt_email.val(), "id" : GET("id") }, function(o2, i2, s2, e2){ 
//        if( o2.id != undefined ) {
//            window.location.href = "/painel/index.php";
//        } else {
//            alert("Não foi possível, entre em contato usando dados abaixo.");
//        }
//    });
//}

function enviar(){
    post1("/routine/cadastro.php", "find_salt_recuperar", {"id" : GET("id")}, 
    function(o1, i1, s1, e1){ 
        var salt = o1["salt"];
        var password = CryptoJS.MD5(salt + txt_password.val()).toString();
        post1("/routine/cadastro.php", "redefinir", {"password" : password, "id" : GET("id") }, 
        function(o2, i2, s2, e2){ 
            if( s2 ) {
                window.location.href = "/painel/index.php?email=" + o2.email;
            } else {
                alert("Não foi possível, entre em contato usando dados abaixo.");
            }
        });
    })   
}

