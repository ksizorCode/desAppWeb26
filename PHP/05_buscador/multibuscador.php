<?

//webs con metodo get
$webs = [
    [
        'nombre' => 'Google',
        'url'    => 'https://google.es/search?q='
    ],
    [
        'nombre' => 'IMDB',
        'url'    => 'https://imdb.com/find?q='
    ],
    [
        'nombre' => 'Amazon',
        'url'    => 'https://amazon.es/s?k='
    ],
      [
        'nombre' => 'Festival Cine Gijón',
        'url'    => 'https://ficx.tv/?s='
    ],
    [
        'nombre' => 'Translate',
        'url'    => 'https://translate.google.com/?sl=es&tl=en&text='
    ],
    [
        'nombre' => 'eBay',
        'url'    => 'https://www.ebay.es/sch/i.html?_nkw='
    ],
    [
        'nombre' => 'AliExpress',
        'url'    => 'https://www.aliexpress.com/wholesale?SearchText='
    ],
    [
        'nombre' => 'FICX TV',
        'url'    => 'https://ficx.tv/?s='
    ],
    [
        'nombre' => 'Behance',
        'url'    => 'https://www.behance.net/search/projects?search='
    ],
    [
        'nombre' => 'Dribbble',
        'url'    => 'https://dribbble.com/search/'
    ],
    [
        'nombre' => 'ArtStation',
        'url'    => 'https://www.artstation.com/search?sort_by=relevance&query='
    ],
    [
        'nombre' => 'DeviantArt',
        'url'    => 'https://www.deviantart.com/search?q='
    ],
    [
        'nombre' => 'Canva',
        'url'    => 'https://www.canva.com/templates/search?query='
    ],
    [
        'nombre' => 'Sketchfab',
        'url'    => 'https://sketchfab.com/search?type=models&q='
    ],
    [
        'nombre' => 'TurboSquid',
        'url'    => 'https://www.turbosquid.com/Search/Index.cfm?media_typeid=2&keyword='
    ],
    [
        'nombre' => 'CGTrader',
        'url'    => 'https://www.cgtrader.com/3d-models?keywords='
    ],
    [
        'nombre' => 'Free3D',
        'url'    => 'https://free3d.com/3d-models/'
    ],
    [
        'nombre' => 'Pexels',
        'url'    => 'https://www.pexels.com/search/'
    ],
    [
        'nombre' => 'Shutterstock',
        'url'    => 'https://www.shutterstock.com/search/'
    ],
    [
        'nombre' => 'Getty Images',
        'url'    => 'https://www.gettyimages.es/fotos/'
    ],
];




function desplegar(){
    // importar variables externas
    global $webs;
    global $terminoConsuta;

    //recorrer array
    foreach($webs as $elemento){
            echo "<li><a href='{$elemento['url']}{$terminoConsuta}' target='_blank'>{$elemento['nombre']}</a></li>";
        } 
} // fin de desplegar();


// multibuscador.php?consulta=michi

if(isset($_GET['consulta'])){
    $terminoConsuta = $_GET['consulta'];
    echo "<h1>Consulta es igual a {$terminoConsuta}</h1>";

   /*  foreach($webs as $elemento){
        echo "<li><a href='{$elemento['url']}{$terminoConsuta}' target='_blank'>{$elemento['nombre']}</a></li>";
    } */

        desplegar();
}

else{
    echo '<h1>inserta término de búsqueda para buscar en varias webs</h1>';
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>multibuscador</title>
</head>
<body>
    
<form>
    <label>Buscar en varios navegadores:
        <input type="text" name="consulta" placeholder="Escribe un término">
    </label>
    <input type="submit" value="Buscar">
</form>


</body>
</html>