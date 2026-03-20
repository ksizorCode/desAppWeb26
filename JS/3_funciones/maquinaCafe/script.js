let contenido = "";
let mivaso = false;
let credito = 0;

let productos = {
  solo: 0.4,
  conleche: 0.55,
  americano: 0.55,
  chocolate: 0.5,
  te: 0.25,
  bonbon: 1,
  leche: 0.5,
};


function pantallita(texto){
    document.querySelector("#pantallita").innerText = texto;
}



// ver si metieron perres

function moneda(perres) {
  console.warn(perres);
  credito += perres;
  //sacar pon pantallita redondeando con 2 decimales:
  let apantallita=Number(credito.toFixed(2)) + " €";
  pantallita(apantallita);
}

// Contenido -  -  -  -  -  -  -  -  -

function leche() {
  contenido += '<div class="leche">Leche</div>';
}

function te() {
  contenido += '<div class="te">te</div>';
}

function nata() {
  contenido += '<div class="nata">nata</div>';
}

function chocolate() {
  contenido += '<div class="chocolate">choco</div>';
}

function cafe() {
  contenido += '<div class="cafe">cafe</div>';
}

function azucar() {
  contenido += '<div class="azucar">azucar</div>';
  console.log("+Azucar");
}

function vaso() {
  contenido += '<div class="vaso">';
  mivaso = true;
}

function preparar() {


  if (mivaso) {
    contenido += "</div><!-- cierre vaso -->";
  }
  document.querySelector("#maquinacafe").innerHTML = contenido;
  contenido = "";
  mivaso = false;
}






function menu(tipo) {

     // REVISAR SI HAY PERRES!!!!
  if (credito >= productos[tipo]) {
    console.log("hay perres");
    pantallita('Preparando '+tipo)
    ingredientes(tipo);
  } else {
    console.log("No hay plata");
    pantallita(tipo+" "+productos[tipo])
  }

 
  console.log("--> coste de " + tipo + " es:" + productos[tipo]);
}







  function ingredientes(tipo){
  //lanzamos vaso
  let quierevaso = document.querySelector("#nvaso").checked;

  if (quierevaso) {
    vaso();
    console.log("checkbox esta seleccionado");
  } else {
    alert("Inserte vaso");
    console.log("NO HAY VASO");
  }

  switch (tipo) {
    case "solo":
      cafe();
      console.log("café seleccionado en menú");
      break;

    case "conleche":
      leche();
      cafe();
      break;

    case "americano":
      cafe();
      cafe();
      break;
    case "chocolate":
      chocolate();
      leche();
      break;
    case "te":
      te();
      break;
    case "bombom":
      nata();
      chocolate();
      leche();
      cafe();

      break;
    case "leche":
      leche();
      leche();
      break;
  }

  //AZUCAR · · · · · · · · ·
  let nivelazucar = document.querySelector("#nazucar").value;
  console.log("Nivel azucar:" + nivelazucar);

  for (let i = 0; i < nivelazucar; i++) {
    azucar();
  }
  // fin de azucar · · · · · · · · ·

  preparar();
}
