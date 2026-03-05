
var txt_email = $("#txt_email");
var txt_password = $("#txt_password");

$("#txt_email").focus();

$("#submit1").on("click", function(){
    window.location.href = "index.php";
});

$("#submit2").on("click", function(){
    enviar();
});


$('#txt_password').keypress(
    function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
            enviar();
}); 

function enviar(){
    post1("/routine/cadastro.php", "new_salt", {}, function(o1, i1, s1, e1){ 
        var salt = o1["salt"];
        var password = CryptoJS.MD5(salt + txt_password.val()).toString();
        post1("/routine/cadastro.php", "new_person", {"email" : txt_email.val(), "password" : password, "salt" : salt }, function(o2, i2, s2, e2){ 
            if( o2.id != undefined ) {
                window.location.href = "./cursos.php";
            } else {
                alert("Não foi possível entrar com os dados informado.");
            }
        });
    })
}