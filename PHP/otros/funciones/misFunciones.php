    <?php


function e($valor){
    echo $valor;
}


e("Hola Mundo");


function h1($v, $class="titulo1"){
    echo "<h1 class='$class'>$v</h1>";
}

h1("Hola Mundo");



function img($src, $alt, $class, $title=false){
    if(!$title){
        $title=$alt;
    }

    echo "<figure class='$class'>
    <picture>
        <source srcset='$src.avif' type='image/avif'>
        <source srcset='$src.webp' type='image/webp'>
        <img src='$src.jpg' alt='$alt' title='$title'>
    </picture>
    <figcaption>$title</figcaption>
    </figure>";
    }


$miImg='miImagen001';
img($miImg, "Imagen de prueba", "imagen","bla bla");






function _header(){
    include_once 'bloques/header.php';
}



function _footer(){
    include_once 'bloques/footer.php';
}

$them="TwentyTwelve";
$carpetaIncludes ="fragmentos";
$carpetaImágenes ="img";
$carpetaEstilos ="css";
$carpetaJavaScript="js";

function inc($v){
    global $carpetaIncludes;
    switch ($v){
        case 'cabecera':
        case 'header':
            include "$carpetaIncludes/_header.php";
            break;
        case 'pie':
        case 'footer':
            include "$carpetaIncludes/_footer.php";
            break;
        case 'lateral':
        case 'aside':
            include "$carpetaIncludes/_footer.php";
            break;
  
        default:
            include "$carpetaIncludes/$v";
        }
}


// inc('cabecera');
// inc('footer');
// inc('aside');
// inc('cosa.php');







function a($texto, $url,$class,$target){
    milink($texto, $url,$class,$target);
}


function milink($texto, $url,$class,$target){
    if($target){
        $target='_blank';
    }
    else{
        $target='_self';
    }
echo "<a href='$url' class='$class enlaces' target='$target'>$texto</a>";
}

milink('Click Aquí','www.google.es','miEnlace',1);

a('Haz una busqueda mala','www.yahoo.com','yahoo',0);






