
function isoToBr(isoString) {  
  const date = new Date(isoString);  
 
  // Check if the date is valid  
  if (isNaN(date.getTime())) {  
    throw new Error("Invalid ISO date string");  
  }  
 
  const day = String(date.getDate()).padStart(2, "0"); // 1 → "01", 15 → "15"  
  const month = String(date.getMonth() + 1).padStart(2, "0"); // 0 → "01" (January)  
  const year = date.getFullYear();  
 
  return `${day}-${month}-${year}`;  
} 

function main(){
    var tbody = $("#tabela_tbody");
    tbody.html("");
    post1("/routine/pagamento.php", "listar", {}, function(o1, i1, s1, e1){  
        for(var i = 0; i < o1.length; i++) {
            var data_inicio = "-";
            var data_fim = "-";
            var data = isoToBr(o1[i].data);
            var valor = 'Ainda não processado';
            //var hash_pagamento = o1[i].hash.substring(0,5) + "...." + o1[i].hash.substring(o1[i].hash.length - 6, o1[i].hash.length - 1);
            if (o1[i].data_inicio != null){
                data_inicio = isoToBr(o1[i].data_inicio)
            }
            if (o1[i].data_fim != null){
                data_fim = isoToBr(o1[i].data_fim)
            }
            if( o1[i].metodo == 1 ) {
                valor = "0 (convite)";
            } else if( o1[i].metodo == 2 ) {
                valor = "BTC " + valor;
            } else if( o1[i].metodo == 3 ) {
                valor = "XMR " + valor;
            }

            var html = '<tr data-index="'+ i +'"> <td>' + o1[i].hash + '</td> <td>'+ data +'</td> <td>'+ data_inicio +'</td> <td>'+ data_fim +'</td> <td>'+ valor +'</td> </tr>';
            tbody.append(html);
        }

    });

    $("#btn_enviar_pagamento").on("click", function(){

        if( $("#txt_pagamento").val() == ""){
            alert("Informe o TX ID da transação.");
            return;
        }
        post1("/routine/pagamento.php", "enviar", {"tx_id" : $("#txt_pagamento").val()}, function(o1, i1, s1, e1){  
            if( o1.status == true) {
                alert("SUCESSO: foi salvo com sucesso.");
                $("#txt_pagamento").val("");
                main();
            } else {
                alert("FALHA: " + o1.message);
            }
        });
    });
}

main();