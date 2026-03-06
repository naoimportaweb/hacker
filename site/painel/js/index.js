
function GET(name, url = window.location.href) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}


var txt_email = $("#txt_email");
var txt_password = $("#txt_password");
$("#txt_email").focus();

if( GET("email") != null ){
    txt_email.val(GET("email"));
    $("#txt_password").focus();
}




$('#txt_password').keypress(
    function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
            enviar();
}); 

$("#submit1").on("click", function(){
    window.location.href = "cadastro.php";
});

$("#submit2").on("click", function(){
    enviar();
});

$("#submit3").on("click", function(){
    recuperar();
});



function enviar(){
    post1("/routine/cadastro.php", "find_salt", {"email" : txt_email.val()}, 
    function(o1, i1, s1, e1){ 
        var salt = o1["salt"];
        var password = CryptoJS.MD5(salt + txt_password.val()).toString();
        post1("/routine/cadastro.php", "load_person", {"email" : txt_email.val(), "password" : password }, 
        function(o2, i2, s2, e2){ 
            if( o2.id != undefined ) {
                window.location.href = "./cursos.php";
            } else {
                alert("Não foi possível entrar com os dados informado.");
            }
        });
    })   
}

function recuperar(){
    post1("/routine/cadastro.php", "enviar_recuperacao", {"email" : txt_email.val()}, 
    function(o2, i2, s2, e2){ 
        console.log(o2, i2, s2, e2);
        if( s2 == true ) {
            alert("Um e-mail foi enviado com um link, clique e redefina sua senha.");
        } else {
            alert("Não foi possível entrar com os dados informado.");
        }
    });  
}