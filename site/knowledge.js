var information = {};
var graphics = [];
var dataset_final = [];
function draw_map(div, dataset, title, description) {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('string', 'Manager');
    data.addColumn('string', 'ToolTip');
    data.addRows(dataset);
    data.setProperty(0, 0, "background-color", "red");
    data.setProperty(0, 0, "style", "background-color:#ffcc99;");

    document.getElementById(div).innerHTML = "<h3 style='padding-left: 150px;'>" + title + "</h3><br/>" + description + "<br/><br/><div id='"+ div +"_grafico' align='center'></div><div id='" + div + "_help' style='color: #FF0000'></div><hr style='color: #343a40' />";
    var chart = new google.visualization.OrgChart(document.getElementById(div + "_grafico"));

    // The select handler. Call the chart's getSelection() method
    function selectHandler() {
      var selectedItem = chart.getSelection()[0];
      var selected = dataset[selectedItem.row][0];
      var buffer = "";
      if( information[selected["v"]] != undefined ){
          buffer = information[selected["v"]]["description"];
      }
      document.getElementById(div + "_help").innerHTML = buffer;
    }


    google.visualization.events.addListener(chart, 'select', selectHandler);


    chart.draw(data, {'allowHtml':true});

}

function start() {

  for(var i = 0; i < graphics.length; i++) {
    draw_map('chart_div' + i, graphics[i]["dataset"], graphics[i]["title"], graphics[i]["description"]);
  }
}

function existe(final, id){
  for(var i = 0; i < final.length; i++){
    if( final[i][0]["v"] == id ){
      return true;
    }
  }
  return false;
}
function concatenar(arrais){
  var final = [];
  for(var i = 0; i < arrais.length; i++) {
    for(var j = 0; j < arrais[i].length; j++){
      if( ! existe(final, arrais[i][j]["v"])){
        final.push( arrais[i][j] );
      }
    }
  }
  return final;
}


dataset0 = [
    [{'v':'10000001', 'f':'Curso Hacker'}          ,''          ,'Curso'],

    [{'v':'00000001', 'f':'Conceitos Básicos'}     ,'10000001'  ,'Disciplina'],
    [{'v':'10000003', 'f':'Área de Atuação'}       ,'10000001'  ,'Disciplina'],
    [{'v':'10000004', 'f':'Conceitos Hacker'}      ,'10000001'  ,'Disciplina'],

    [{'v':'00000002', 'f':'Sistemas Operacionais'}, '00000001', 'Disciplina'],
    [{'v':'00000003', 'f':'Hardware'}             , '00000001', 'Disciplina'],
    [{'v':'00000004', 'f':'Network'}              , '00000001', 'Disciplina'],
    [{'v':'00000087', 'f':'Criptografia e encoding'}, '00000001', 'Disciplina'],

    [{'v':'00000034', 'f':'Malwares e Desenvolvimento'}              , '10000004', 'Disciplina'],
    [{'v':'00000005', 'f':'Engenharia Social'}    , '10000004', 'Disciplina'],
    [{'v':'00000085', 'f':'Pentesting e Exploração'}    , '10000004', 'Disciplina'],
    [{'v':'00000086', 'f':'Web hacking'}    , '10000004', 'Disciplina'],

    [{'v':'00000080', 'f':'Cybersecurity'}               , '10000003', 'Disciplina'],
    [{'v':'00000081', 'f':'Hacker e Hacktivismo'}        , '10000003', 'Disciplina'],
    [{'v':'00000082', 'f':'Estado-Nação e Cyberwarfare'} , '10000003', 'Disciplina'],
    [{'v':'00000083', 'f':'Teams em organizações'}       , '10000003', 'Disciplina'],
    [{'v':'00000084', 'f':'Advanced persistent threat (APT)'}, '10000003', 'Disciplina'],

  ];


  dataset1 = [
    [{'v':'10000003', 'f':'Área de Atuação'}, '', 'Disciplina'],

    [{'v':'00000080', 'f':'Cybersecurity'}               , '10000003', 'Disciplina'],
    [{'v':'00000081', 'f':'Hacker e Hacktivismo'}        , '10000003', 'Disciplina'],
    [{'v':'00000082', 'f':'Estado-Nação e Cyberwarfare'} , '10000003', 'Disciplina'],
    [{'v':'00000083', 'f':'Teams em organizações'}       , '10000003', 'Disciplina'],
    [{'v':'00000084', 'f':'Advanced persistent threat (APT)'}, '10000003', 'Disciplina'],


    [{'v':'00000088', 'f':'O mercado Cybersecurity'}         , '00000080', 'Disciplina'],
    [{'v':'00000089', 'f':'O cara mau que faz o mal'}          , '00000081', 'Disciplina'],
    [{'v':'00000090', 'f':'Classificação clássica dos hackers'}, '00000081', 'Disciplina'],
    [{'v':'00000091', 'f':'O que é Hacktivismo'}               , '00000081', 'Disciplina'],
    [{'v':'00000092', 'f':'Exemplos de grupos/coletivos'}      , '00000081', 'Disciplina'],

    [{'v':'00000093', 'f':'Os principais grupos'}         , '00000082', 'Disciplina'],
    [{'v':'00000094', 'f':'Países que investem'}          , '00000082', 'Disciplina'],
    [{'v':'00000095', 'f':'Principais alvos'}             , '00000082', 'Disciplina'],

    [{'v':'00000096', 'f':'Blue Team'}             , '00000083', 'Disciplina'],
    [{'v':'00000097', 'f':'Red Team'}             , '00000083', 'Disciplina'],
    [{'v':'00000098', 'f':'Purple Team'}             , '00000083', 'Disciplina'],

    [{'v':'00000099', 'f':'A História'}             , '00000084', 'Disciplina'],
    [{'v':'00000100', 'f':'Principais grupos'}      , '00000084', 'Disciplina'],
    [{'v':'00000101', 'f':'Como criar um'}          , '00000084', 'Disciplina'],
  ]

dataset2 = [
    [{'v':'00000002', 'f':'Sistemas Operacionais'}, '', 'Disciplina'],

    [{'v':'00000006', 'f':'Linux/GNU e Unix'}         , '00000002', 'Conceito'],
    [{'v':'00000008', 'f':'Microsoft Windows Desktop e Server'}, '00000002', 'Conceito'],


    [{'v':'00000050', 'f':'Distribuições'}             , '00000006', 'Conceito'],
    [{'v':'00000051', 'f':'File System'}               , '00000006', 'Conceito'],
    [{'v':'00000052', 'f':'Usuários e permissão'}      , '00000006', 'Conceito'],
    [{'v':'00000053', 'f':'Processos'}                 , '00000006', 'Conceito'],
    [{'v':'00000054', 'f':'Comandos'}                  , '00000006', 'Conceito'],
    [{'v':'00000055', 'f':'Dispositivos de E/S'}       , '00000006', 'Conceito'],
    [{'v':'00000056', 'f':'Shell e Scripts'}           , '00000006', 'Conceito'],
    [{'v':'00000057', 'f':'Python para Sistemas Operacionais'}  , '00000006', 'Conceito'],
    [{'v':'00000058', 'f':'Arquivos importantes'}               , '00000006', 'Conceito'],
    [{'v':'00000059', 'f':'Logging'}                            , '00000006', 'Conceito'],


    [{'v':'00000060', 'f':'File System'}                     , '00000008', 'Conceito'],
    [{'v':'00000061', 'f':'Ferramentas de gerenciamento'}    , '00000008', 'Conceito'],
    [{'v':'00000062', 'f':'Usuários e permissão'}            , '00000008', 'Conceito'],
    [{'v':'00000063', 'f':'Regedit'}                         , '00000008', 'Conceito'],
    [{'v':'00000064', 'f':'Powershell'}                      , '00000008', 'Conceito'],
    [{'v':'00000065', 'f':'Visual basic Script e Macros'}    , '00000008', 'Conceito'],
    [{'v':'00000066', 'f':'Active Directory'}                , '00000008', 'Conceito'],


    [{'v':'00000067', 'f':'Trusts e Forests'}             , '00000066', 'Conceito'],
    [{'v':'00000068', 'f':'Movimentação Lateral em AD'}   , '00000066', 'Conceito'],
    [{'v':'00000069', 'f':'Ferramentas e uso'}            , '00000066', 'Conceito'],
    [{'v':'00000070', 'f':'Principais tipos de ataques'}  , '00000066', 'Conceito'],
  ];

dataset3 = [
    [{'v':'00000003', 'f':'Hardware'}             , '', 'Disciplina'],

    [{'v':'00000009', 'f':'Desktop & Servidores'}  , '00000003', 'Conceito'],
    [{'v':'00000010', 'f':'Single Board'}          , '00000003', 'Conceito'],
    [{'v':'00000011', 'f':'Arduino'}               , '00000003', 'Conceito'],


    [{'v':'00000115', 'f':'Programação'}               , '00000011', 'Conceito'],
    [{'v':'00000116', 'f':'Atuadores'}               , '00000011', 'Conceito'],
    [{'v':'00000117', 'f':'Comunicação Serial'}               , '00000011', 'Conceito'],
    [{'v':'00000118', 'f':'ESP32 em Wireless'}               , '00000011', 'Conceito'],

    [{'v':'00000119', 'f':'Invasão física'}               , '00000010', 'Conceito'],
    [{'v':'00000120', 'f':'Mantendo uma invasão física'}  , '00000010', 'Conceito'],

    [{'v':'00000121', 'f':'Exposição e acesso'}               , '00000009', 'Conceito'],
    [{'v':'00000122', 'f':'O usuário e práticas ruins'}       , '00000009', 'Conceito'],
  ];

dataset4 = [
    [{'v':'00000004', 'f':'Network'}              , '', 'Disciplina'],

    [{'v':'00000012', 'f':'Meio de Transmissão'}  ,        '00000004', 'Conceito'],
    [{'v':'00000013', 'f':'Protocolos'}          ,         '00000004', 'Conceito'],
    [{'v':'00000014', 'f':'Programas & Serviços'}         ,'00000004', 'Conceito'],
    [{'v':'00000015', 'f':'Desenvolvimento de Aplicações'}  , '00000004', 'Conceito'],
    [{'v':'00000016', 'f':'Critpografia & Canal'}          , '00000004', 'Conceito'],

    [{'v':'00000022', 'f':'Cabo metálico & Fibra'}          ,'00000012', 'Conceito'],
    [{'v':'00000023', 'f':'Radiofrequência'}                ,'00000012', 'Conceito'],

    [{'v':'00000024', 'f':'802.11 Wireless'}                ,'00000023', 'Conceito'],
    [{'v':'00000025', 'f':'802.15.1 Bluetooth'}             ,'00000023', 'Conceito'],

    [{'v':'00000026', 'f':'IP'}                   ,'00000013', 'Conceito'],
    [{'v':'00000027', 'f':'TCP & UDP'}            ,'00000013', 'Conceito'],
    [{'v':'00000028', 'f':'Arquivos'}             ,'00000013', 'Conceito'],
    [{'v':'00000029', 'f':'Mensagens'}            ,'00000013', 'Conceito'],
    [{'v':'00000030', 'f':'Terminal'}             ,'00000013', 'Conceito'],

    [{'v':'00000040', 'f':'Container WEB'}    ,'00000014', 'Conceito'],
    [{'v':'00000041', 'f':'Bind9'}            ,'00000014', 'Conceito'],

    [{'v':'00000042', 'f':'SSL/TLS'}    ,'00000016', 'Conceito'],
    [{'v':'00000043', 'f':'VPN'}        ,'00000016', 'Conceito'],

    [{'v':'00000026', 'f':'IP'}                   ,'00000013', 'Conceito'],
    [{'v':'00000027', 'f':'TCP & UDP'}            ,'00000013', 'Conceito'],
    [{'v':'00000028', 'f':'Arquivos'}             ,'00000013', 'Conceito'],
    [{'v':'00000029', 'f':'Mensagens'}            ,'00000013', 'Conceito'],
    [{'v':'00000030', 'f':'Terminal'}             ,'00000013', 'Conceito'],

    [{'v':'00000031', 'f':'SMB'}             ,'00000028', 'Conceito'],
    [{'v':'00000032', 'f':'FTP'}             ,'00000028', 'Conceito'],
    [{'v':'00000033', 'f':'HTTP'}            ,'00000028', 'Conceito'],

    [{'v':'00000035', 'f':'Pop3'}             ,'00000029', 'Conceito'],
    [{'v':'00000036', 'f':'SMTP'}             ,'00000029', 'Conceito'],
    [{'v':'00000037', 'f':'XMPP'}            ,'00000029', 'Conceito'],
    [{'v':'00000037', 'f':'IRC'}            ,'00000029', 'Conceito'],

    [{'v':'00000038', 'f':'Telnet'}            ,'00000030', 'Conceito'],
    [{'v':'00000039', 'f':'SSH'}            ,'00000030', 'Conceito'],


    [{'v':'00000071', 'f':'Roteadores, Firewall e Gateway'}            ,'00000004', 'Conceito'],
    [{'v':'00000072', 'f':'Network scanning'}            ,'00000004', 'Conceito'],

    [{'v':'00000073', 'f':'TCPdump/Ettercap'}            ,'00000072', 'Conceito'],
    [{'v':'00000074', 'f':'Wireshark'}            ,'00000072', 'Conceito'],
    [{'v':'00000075', 'f':'Aircrak-ng'}            ,'00000072', 'Conceito'],

    [{'v':'00000076', 'f':'Netfilter'}            ,'00000071', 'Conceito'],
    [{'v':'00000077', 'f':'Iptables'}             ,'00000071', 'Conceito'],
    [{'v':'00000078', 'f':'NFtables'}             ,'00000071', 'Conceito'],
  ];

dataset5 = [
    [{'v':'00000087', 'f':'Criptografia e encoding'}              , '', 'Disciplina'],

    [{'v':'00000123', 'f':'Encoding'}       , '00000087', 'Conceito'],
    [{'v':'00000124', 'f':'O que é criptografia'}       , '00000087', 'Conceito'],
    [{'v':'00000125', 'f':'Manifesto Cypherpunk'}       , '00000087', 'Conceito'],
    [{'v':'00000126', 'f':'Tipos de criptografias'}       , '00000087', 'Conceito'],
    [{'v':'00000127', 'f':'Principais algoritmos de criptografia'}       , '00000087', 'Conceito'],
    [{'v':'00000128', 'f':'Diffie-Hellman'}       , '00000087', 'Conceito'],
    [{'v':'00000129', 'f':'Protocolos criptografados'}       , '00000087', 'Conceito'],
    [{'v':'00000130', 'f':'Ferramentas Cypherpunks'}       , '00000087', 'Conceito'],
    [{'v':'00000131', 'f':'Algoritmos pós-quanticos'}       , '00000087', 'Conceito'],

  ];

dataset6 = [
    [{'v':'00000086', 'f':'Web Hacking'}, '', 'Disciplina'],

    [{'v':'00000102', 'f':'Web Recon'}                            ,'00000086', 'Conceito'],
    [{'v':'00000103', 'f':'Owasp Top 10'}                         ,'00000086', 'Conceito'],
    [{'v':'00000104', 'f':'SQL Injection e XSS'}                  ,'00000086', 'Conceito'],
    [{'v':'00000105', 'f':'Injeções avançadas'}                   ,'00000086', 'Conceito'],
    [{'v':'00000106', 'f':'Ataques lógicos'}                      ,'00000086', 'Conceito'],
    [{'v':'00000107', 'f':'Automatizações'}                       ,'00000086', 'Conceito'],
    [{'v':'00000108', 'f':'Principais vulnerabilidades'}          ,'00000086', 'Conceito'],
    [{'v':'00000109', 'f':'API Hacking'}                          ,'00000086', 'Conceito'],
    
    [{'v':'00000110', 'f':'API Basics'}                  ,'00000109', 'Conceito'],
    [{'v':'00000111', 'f':'Fuzzing'}                     ,'00000109', 'Conceito'],
    [{'v':'00000112', 'f':'Ferramentas clássicas'}       ,'00000109', 'Conceito'],
    [{'v':'00000113', 'f':'Principais Vulnerabilidades'} ,'00000109', 'Conceito'],

  ];


  dataset7 = [
    [{'v':'00000085', 'f':'Pentesting e Exploração'}              , '', 'Disciplina'],

    [{'v':'00000154', 'f':'Vulnerabilidade'}              ,'00000085', 'Conceito'],
    [{'v':'00000155', 'f':'CVE'}              ,'00000154', 'Conceito'],
    [{'v':'00000156', 'f':'CWE'}              ,'00000154', 'Conceito'],
    [{'v':'00000157', 'f':'Exploit'}          ,'00000154', 'Conceito'],
    [{'v':'00000158', 'f':'Scripting'}              ,'00000157', 'Conceito'],
    [{'v':'00000159', 'f':'Criação de Payloads'}    ,'00000157', 'Conceito'],
    
    [{'v':'00000160', 'f':'Vetor de ataque'}              ,'00000154', 'Conceito'],
    [{'v':'00000161', 'f':'Frameworks'}              ,'00000085', 'Conceito'],
    [{'v':'00000162', 'f':'Coleta de Informações'}              ,'00000085', 'Conceito'],
    [{'v':'00000163', 'f':'Information Gattering'}              ,'00000162', 'Conceito'],
    [{'v':'00000164', 'f':'OSINT'}              ,'00000162', 'Conceito'],
    [{'v':'00000165', 'f':'Pós exploração e persistência'}              ,'00000085', 'Conceito'],
    [{'v':'00000166', 'f':'Tecnicas de Exfiltração'}              ,'00000165', 'Conceito'],
    [{'v':'00000167', 'f':'Extração de dados sensiveis'}              ,'00000165', 'Conceito'],
    [{'v':'00000168', 'f':'Técnicas de persistência'}              ,'00000165', 'Conceito'],
    [{'v':'00000169', 'f':'Evasão de Defesas'}              ,'00000165', 'Conceito'],
    [{'v':'00000170', 'f':'WAFs'}              ,'00000169', 'Conceito'],
    [{'v':'00000171', 'f':'AV/EDR'}              ,'00000169', 'Conceito'],
    [{'v':'00000172', 'f':'Ofuscações'}              ,'00000169', 'Conceito'],
  ];



dataset8 = [
    [{'v':'00000034', 'f':'Malwares e Desenvolvimento'}              , '', 'Disciplina'],

    [{'v':'00000044', 'f':'Classificação'}              ,'00000034', 'Conceito'],
    [{'v':'00000045', 'f':'Anti-reverse Engineering'}   ,'00000034', 'Conceito'],
    [{'v':'00000046', 'f':'Linguagens e Compilação'}    ,'00000034', 'Conceito'],
    [{'v':'00000134', 'f':'Shell reverso'}                 ,'00000034', 'Conceito'],
    [{'v':'00000135', 'f':'PE-file'}                       ,'00000034', 'Conceito'],
    [{'v':'00000136', 'f':'Malware Injection'}             ,'00000034', 'Conceito'],
    [{'v':'00000137', 'f':'DLL hijacking'}                 ,'00000034', 'Conceito'],
    [{'v':'00000138', 'f':'Microsoft Registry'}            ,'00000034', 'Conceito'],
    [{'v':'00000139', 'f':'Escalar privilégios no Windows'},'00000034', 'Conceito'],
    [{'v':'00000153', 'f':'Servidor de Controle e Botnets'},'00000034', 'Conceito'],

    [{'v':'00000140', 'f':'Vírus'}           ,'00000044', 'Conceito'],
    [{'v':'00000141', 'f':'Worm'}            ,'00000044', 'Conceito'],
    [{'v':'00000142', 'f':'Trojan'}          ,'00000044', 'Conceito'],
    [{'v':'00000143', 'f':'Bot'}             ,'00000044', 'Conceito'],
    [{'v':'00000145', 'f':'Spyware'}         ,'00000044', 'Conceito'],
    [{'v':'00000146', 'f':'Adware'}          ,'00000044', 'Conceito'],
    [{'v':'00000147', 'f':'Ransomware'}      ,'00000044', 'Conceito'],
    [{'v':'00000148', 'f':'Keyloggers'}      ,'00000044', 'Conceito'],
    [{'v':'00000149', 'f':'Rootkits'}        ,'00000044', 'Conceito'],
    [{'v':'00000150', 'f':'Cryptojackers'}   ,'00000044', 'Conceito'],
    [{'v':'00000151', 'f':'Wipers'}          ,'00000044', 'Conceito'],
    [{'v':'00000152', 'f':'Scareware'}       ,'00000044', 'Conceito'],
  ];

dataset9 = [
    [{'v':'00000005', 'f':'Engenharia Social'}         , '', 'Disciplina'],

    [{'v':'00000017', 'f':'O Hacker'}                       ,'00000005', 'Conceito'],
    [{'v':'00000018', 'f':'Comportamento do alvo'}          ,'00000005', 'Conceito'],
    [{'v':'00000019', 'f':'A arte de enganar'}              ,'00000005', 'Conceito'],
    [{'v':'00000020', 'f':'Envolvendo pessoas'}             ,'00000005', 'Conceito'],
    [{'v':'00000021', 'f':'Gestão de grupos'}               ,'00000005', 'Conceito'],
  ];


  information = {
    "00000002" : {"v" : "00000002", "description" : "O sistema operacional é responsável por gerenciar os recursos de hardware e software de um dispositivo, permitindo a interação entre o usuário, os programas e a máquina. É o ponto de partida inicial de todo aspirante hacker."},
    "00000003" : {"v" : "00000003", "description" : "Hardware é uma palavra de origem inglesa que, no âmbito da informática, é utilizada para designar a parte física de um computador. São todos os componentes palpáveis de um dispositivo eletrônico, como placas, memória, processador, teclado, monitor, etc. O hardware não se limita apenas ao PC, se referindo também aos itens físicos que compõem celulares, tablets, smart TVs, entre outros aparelhos. Podem ser divididos em duas grandes categorias: internos e externos."},
    "00000004" : {"v" : "00000004", "description" : "Quando dois ou mais dispositivos de computação se conectam entre si, estamos na presença de uma rede de computadores. Entender o que é esse tipo de estrutura e como funciona é essencial para quem está iniciando no mundo da computação e das telecomunicações. Neste verbete abordaremos os conceitos básicos relacionados às redes de computadores, sua classificação e principais utilizações."},
    "00000087" : {"v" : "", "description" : "A criptografia é um método que converte textos em códigos abstratos conhecidos como ciphertexts ou textos cifrados. O propósito da criptografia é ocultar dados sensíveis, impedindo que usuários não autorizados acessem e roubem as informações."},
    "00000034" : {"v" : "00000034", "description" : "Malware é qualquer software projetado intencionalmente para causar interrupção em um computador, servidor, cliente ou rede de computadores, vazar informações privadas, obter acesso sem autorização a informações ou sistemas, privar o acesso a informações ou que, sem saber, interfira na privacidade e segurança do computador do usuário."},
    "00000005" : {"v" : "00000005", "description" : "Engenharia social é uma técnica de manipulação focada em pessoas, de modo a enganar e induzir vítimas para que elas informem dados sensíveis ou realizem determinadas ações. Esses golpes geralmente resultam em roubos de credenciais e comprometimento de sistemas."},
    "00000085" : {"v" : "00000085", "description" : "A pentesting, abreviatura de testes de penetração, é uma componente crítica no domínio da cibersegurança. Trata-se de um ataque cibernético simulado contra um sistema informático, uma rede ou uma aplicação Web para identificar vulnerabilidades que possam ser exploradas por atacantes. O principal objetivo do pentesting é reforçar a segurança da infraestrutura de TI de uma organização, identificando e resolvendo os pontos fracos da segurança antes de poderem ser explorados por agentes maliciosos."},
    "00000086" : {"v" : "00000086", "description" : "O que é web hacking? O web hacking é uma prática que visa explorar vulnerabilidades em aplicações web para obter acesso não autorizado, manipular dados ou causar danos ao sistema."},
    "00000080" : {"v" : "00000080", "description" : " Cibersegurança é a prática que protege computadores e servidores, dispositivos móveis, sistemas eletrônicos, redes e dados contra ataques maliciosos. Também é chamada de segurança da tecnologia da informação ou segurança de informações eletrônicas."},
    "00000081" : {"v" : "00000081", "description" : "O hacktivismo é um termo que une 'hacking' e 'ativismo'. A prática utiliza as habilidades em cibersegurança para realizar manifestações ideológicas. É uma atividade tecnológica que possibilita aos usuários realizar mobilizações sociais, por meio da internet, principalmente pelo uso das redes."},
    "00000082" : {"v" : "00000082", "description" : "Nos últimos anos, o cenário da cibersegurança tem enfrentado uma ameaça cada vez mais sofisticada e perigosa: os hackers Estado-Nação. Esses grupos cibernéticos, também conhecidos como APTs (Advanced Persistent Threats), são financiados e apoiados por governos ou entidades estatais com a intenção de conduzir ataques cibernéticos em larga escala."},
    "00000084" : {"v" : "00000084", "description" : "Uma ameaça persistente avançada (APT) refere-se a um ataque que continua, secretamente, usando métodos de hacking inovadores para acessar um sistema e permanecer dentro por um longo período. Os invasores típicos são cibercriminosos, como o grupo iraniano APT34, a organização russa APT28 e outros. Embora possam vir de todo o mundo, alguns dos invasores mais notáveis vêm do Irã, de outras áreas do Oriente Médio e da Coreia do Norte."},
    "00000088" : {"v" : "00000088", "description" : "O mercado de segurança cibernética apresenta fortes oportunidades de investimento impulsionadas pela crescente frequência e sofisticação de ameaças cibernéticas, particularmente nos setores de finanças, saúde e governo."},
    "00000096" : {"v" : "00000096", "description" : "Blue Team refere-se ao grupo responsável pela defesa cibernética de uma organização. O Blue Team é formado por pessoas, processos e tecnologias que trabalham juntos para prevenir, detectar, responder e recuperar de incidentes de segurança."},
    "00000090" : {"v" : "00000090", "description" : "Embora muitas vezes sejam associados apenas a atividades criminosas, entenda como eles podem ser classificados e quais são as motivações e os níveis de experiência de cada um."},
    "00000092" : {"v" : "00000092", "description" : "Conheça os grupos de hackers mais procurados - e perigosos - do mundo! Numa sociedade cada vez mais digital, as invasões se tornaram sofisticadas e só aumentam. Além disso, visam sempre a uma pessoa, a uma organização ou a um país."},
    "00000097" : {"v" : "00000097", "description" : "Um Red Team é um grupo de pentesters com habilidades distintas que testam as defesas de uma organização simulando um ataque cibernético ou outra violação de segurança. O objetivo de um Red Team é identificar pontos fracos e vulnerabilidades nos sistemas."},
    "00000098" : {"v" : "00000098", "description" : "O Purple Team é a união entre Blue Team e Red Team. Entenda como esse time ajuda a cibersegurança de empresas."},
    "00000050" : {"v" : "00000050", "description" : "Uma distribuição ou distro Linux é um sistema operativo que é construído em cima Kernel do Linux —a interface central entre o hardware de um computador e seus processos."},
    "00000051" : {"v" : "00000051", "description" : "O file system, ou sistema de arquivos, é uma estrutura que organiza e gerencia a forma como os dados são armazenados e acessados em dispositivos de armazenamento, como discos rígidos, SSDs e dispositivos de armazenamento removíveis."},
    "00000052" : {"v" : "00000052", "description" : "A gestão de Usuários e permissões em um sistema Linux é crucial para segurança e integridade de dados."},
    "00000053" : {"v" : "00000053", "description" : "No sistema operacional um processo é o que representa as operações em execução que estão acontecendo no seu computador."},
    "00000054" : {"v" : "00000054", "description" : "Um comando Linux é uma instrução que você digita na interface de linha de comando (CLI) para que o sistema execute uma ação, como abrir um arquivo, listar pastas ou instalar um programa."},
    "00000055" : {"v" : "00000055", "description" : "Chamamos de dispositivos de entrada e saída os responsáveis por incorporar e extrair informação de um sistema de computador. Eles se adequam dentro da denominada Arquitetura de Von Neumann, que nos informa as principais partes de um computador."},
    "00000056" : {"v" : "00000056", "description" : "O Shell Script é um software para computador de código aberto que foi escrito para ser executado pelo shell do Unix/Linux."},
    "00000057" : {"v" : "00000057", "description" : "Python é uma linguagem de programação gratuita, de código aberto e de propósito geral, que se destaca pela facilidade de uso, versatilidade e portabilidade."},
    "00000059" : {"v" : "00000059", "description" : "Logging é o processo de registrar eventos que ocorrem em um sistema enquanto ele está em execução. Esses registros são chamados de logs e ficam armazenados em arquivos, bancos de dados ou serviços externos."},
    "00000060" : {"v" : "00000060", "description" : "O file system, ou sistema de arquivos, é uma estrutura que organiza e gerencia a forma como os dados são armazenados e acessados em dispositivos de armazenamento, como discos rígidos, SSDs e dispositivos de armazenamento removíveis."},
    "00000063" : {"v" : "00000063", "description" : "O Regedit, ou Editor de Registro, é uma ferramenta essencial do sistema operacional Windows que permite aos usuários visualizar e modificar as configurações do registro do Windows."},
    "00000064" : {"v" : "00000064", "description" : "PowerShell é um shell de linha de comando baseado em tarefas e linguagem de script desenvolvido sobre o.NET. Inicialmente apenas um componente do Windows, tornou-se código aberto e multiplataforma em 18 de agosto de 2016 com a introdução do PowerShell Core."},
    "00000065" : {"v" : "00000065", "description" : "VBScript (Visual Basic Script) é desenvolvido por Microsoft com a intenção de desenvolver páginas web dinâmicas. É uma linguagem de script do lado do cliente como JavaScript. VBScript é uma versão leve de Microsoft Visual básico."},
    "00000066" : {"v" : "00000066", "description" : "O Active Directory é o pilar da gestão de identidade e controle de acessos na maioria das organizações. Ele permite que administradores centralizem o gerenciamento de usuários, dispositivos e permissões, garantindo segurança e eficiência operacional."},
    "00000010" : {"v" : "00000010", "description" : "Os computadores de placa única são projetados de maneira diferente dos desktops ou notebooks padrão, pois são totalmente independentes. Eles costumam fazer uso de uma ampla variedade de microprocessadores e têm densidade aumentada para os circuitos integrados usados."}
  };




graphics.push( { "dataset" : dataset0, "title" : "Estrutura do Curso Hacker", "description" : "Na área de TI, a subárea de segurança é a que exige maior conhecimento e por isso é tão promissora, e nós garantimos que será mais promissor a cada dia que se passa. Escolher trilhar este caminho é escolher o caminho do conhecimento.<br/><br/>Seu percurso será realizado com as seguintes fontes:<br/><ul><li>Livros teóricos de vários temas na área de TI;</li><li>Cursos em vídeo;</li><li>Notícias e acontecimentos hacker.</li></ul>Separei os principais conceitos que deve conhecer para começar na área." } );

graphics.push( { "dataset" : dataset1, "title" : "Área de Atuação", "description" : "Muitas áreas estão saturadas, mas a de segurança não, afinal a disponibilidade e riqueza de variedade garante uma área sempre promissora, tanto para quem ataca quanto para quem defende. E existe um agravante: <b>O jovem não quer mais estudar</b>.<br/><br/>Essa é a área que mais exige conhecimento, conhecimento obtido através de grande esforço acadêmico e prático. Separei uma lista de áreas que podem atuar." } );
graphics.push( { "dataset" : dataset2, "title" : "Sistemas Operacionais", "description" : "" } );
graphics.push( { "dataset" : dataset3, "title" : "Hardware", "description" : "" } );
graphics.push( { "dataset" : dataset4, "title" : "Network", "description" : "" } );
graphics.push( { "dataset" : dataset5, "title" : "Criptografia e encoding", "description" : "" } );
graphics.push( { "dataset" : dataset6, "title" : "Web Hacking", "description" : "" } );
graphics.push( { "dataset" : dataset7, "title" : "Pentesting e Exploração", "description" : "" } );
graphics.push( { "dataset" : dataset8, "title" : "Malwares e Desenvolvimento", "description" : "" } );
graphics.push( { "dataset" : dataset9, "title" : "Engenharia Social", "description" : "" } );

dataset_final = concatenar(graphics);


google.charts.load('current', {packages:["orgchart"]});
google.charts.setOnLoadCallback(start);
  //draw_map('chart_div0', dataset0, "Estrutura do Curso Hacker", "");
  //draw_map('chart_div1', dataset1, "Área de Atuação", "");
  //draw_map('chart_div2', dataset2, "Sistemas Operacionais", "");
  //draw_map('chart_div3', dataset3, "Hardware", "");
  //draw_map('chart_div4', dataset4, "Network", "");
  //draw_map('chart_div5', dataset5, "Criptografia e encoding", "");
  //draw_map('chart_div6', dataset6, "Web Hacking", "");
  //draw_map('chart_div7', dataset7, "Pentesting e Exploração", "");
  //draw_map('chart_div8', dataset8, "Malwares e Desenvolvimento", "");
  //draw_map('chart_div9', dataset9, "Engenharia Social", "");