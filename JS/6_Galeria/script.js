const datos= [
    ["Dingo","dingo.jpg","Canino"],
    ["León","leon.jpg","Felino"],
    ["Zebra","zebra.jpg","Equino"],
    ["Aguila","aguila.jpg","Ave"],
    ["Cobra","zebra.jpg","Reptil"],
    ["Tiburón","zebra.jpg","Pez"]
]

const carpetaimg="img/";
let indice=0;

function sig(){
    document.querySelector("img").src=carpetaimg+datos[indice][1];
document.querySelector("img").alt=datos[indice][0];
document.querySelector("h1").innerText=datos[indice][0];
document.querySelector("p").innerText=datos[indice][2];
document.querySelector("h2").innerText=indice;
indice++

if(indice>datos.length-1){
    indice=0;
}
}

setInterval(sig,1000);