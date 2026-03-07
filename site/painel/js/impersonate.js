var txt_email = $("#txt_email");

$("#txt_email").focus();

$("#submit1").on("click", function(){
    enviar();
});

function enviar(){

        post1("/routine/cadastro.php", "impersonate", {"email" : txt_email.val() }, 
        function(o2, i2, s2, e2){ 

            if( s2 ) {
                window.location.href = "./cursos.php";
            } else {
                alert("Não foi possível entrar com os dados informado.");
            }
        });
 
}
