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
    post1("/routine/aula.php", "historico", {}, function(o1, i1, s1, e1){  

        for(var i = 0; i < o1.length; i++) {
            var data = isoToBr(o1[i].data);
            
            var html = '<tr data-index="'+ i +'"> <td>' + o1[i].titulo + '</td> <td>'+ o1[i].curso +'</td> <td>'+ data +'</td></tr>';
            tbody.append(html);
        }

    });
}

main();