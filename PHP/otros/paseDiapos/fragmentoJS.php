
<?php 

$idioma = 'fr'; // puede ser es / fr / en / ast

$traducciones = [
    'es' => [
        'Vista desde Cabo Peñas', 
        'Mar Cantábrico', 
        'Faro de Langreo', 
        'Playa de Mieres', 
        'Paseo de Begoña', 
        'Catedral de Oviedo', 
        'Calle Corrida de Gijón', 
        'Gascona en Avilés'
    ],
    'fr' => [
        'Vue depuis Cabo Peñas', 
        'Mer Cantabrique', 
        'Phare de Langreo', 
        'Plage de Mieres', 
        'Promenade de Begoña', 
        'Cathédrale d Oviedo', 
        'Rue Corrida de Gijón', 
        'Gascona à Avilés'
    ],
    'en' => [
        'View from Cabo Peñas', 
        'Cantabrian Sea', 
        'Langreo Lighthouse', 
        'Mieres Beach', 
        'Begoña Promenade', 
        'Oviedo Cathedral', 
        'Corrida Street in Gijón', 
        'Gascona in Avilés'
    ],
    'ast' => [
        'Vista dende Cabu Peñes', 
        'Mar Cantábricu', 
        'Faru de Langreo', 
        'Playa de Mieres', 
        'Paseu de Begoña', 
        'Catedral d Uviéu', 
        'Cai Corrida de Xixón', 
        'Gascona n Avilés'
    ]
];


$textos=[]; // Array con los textos en el idioma que corresponda en este caso

//Vuelca del array traducciones con todas las traducciones SÓLO los textos del idioma que nos intersa
$textos = $traducciones[$idioma] ?? []; // Obtiene solo los textos del idioma seleccionado


// echo '<pre>';
// print_r($textos);
// echo '</pre>';




?>





<script>
    //// SOY JAVASCRIPT
    let fotos = [

<?php 

$numerito=50;

foreach($textos as $diapositiva){
    echo "['https://picsum.photos/id/$numerito/300/300','$diapositiva'],";
    $numerito++;
}
?> 
    ['https://picsum.photos/id/87/300/300','Titulo 8']
];

let miHTML = '<ul>';

fotos.forEach(foto => miHTML += `<li><img src="${foto[0]}"><p>${foto[1]}</p></li>`);

miHTML += '</ul>'; // Cierra la etiqueta correctamente (antes estaba `<ul>` en lugar de `</ul>`)

document.querySelector('#paseDiapos').innerHTML = miHTML;
  </script>