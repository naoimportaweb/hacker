const validateEmail = (email) => {
  return String(email)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
};

function post1(path, routine, input, callback){
    $.ajax({
        type       : 'POST',
        url        : path  ,
        data       : JSON.stringify({ "method" : routine, "parameters" : input }) ,
        contentType: "application/json",
        dataType   : 'json',
        success: function(output) { 
            callback(output, input, true, null);
        },
        error: function (err) {
            callback(null,   input, false, err);
        }
    });
}

function message(div, text, time, color){
    time = time || 3;
    time = time * 1000;
    color = color || "FFFFFF";

    div.html("<div style='color : #"+ color +"; padding-left: 50px;' >"+ text +"</div>");
    setTimeout(function(){
        div.html("");
    }, time);
}

function error(div, text, time){
    message(div, text, time, "FF0000");
}

function sucess(div, text, time){
    message(div, text, time, "00FF00");
}

function main(){
    var btn_newsletter = $("#btn_newsletter");
    var txt_newsletter = $("#txt_newsletter");
    var div_newsletter_message = $("#div_newsletter_message");

    btn_newsletter.on( "click", function() {
        div_newsletter_message.html( "" );
        if( validateEmail(txt_newsletter.val()) == null ){
            error(div_newsletter_message, "Informe um e-mail válido.", 5 );
            return;
        }

        post1("/routine/newletter.php", "add", {"email" : txt_newsletter.val() }, function(o, i, s, e){
            if( s == true ) {
                sucess(div_newsletter_message, "Sucesso, cadastrado.", 10 );
                txt_newsletter.val("");
            } else {
                error( div_newsletter_message, "Falha ao cadastrar seu e-mail na Newsletter.", 10 );
            }
        });
    });
}







main();

