    var preco_apro = undefined;
    const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=brl', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const data = await response.json();
    var valor = (data["bitcoin"]["brl"] * 0.0001416).toString();
    if( valor.indexOf(".") > 0){
        valor = valor.split(".")[0];
    }
    $("#aproximado").html("Aproximadamente " + valor + " Reais dependendo da exchange");