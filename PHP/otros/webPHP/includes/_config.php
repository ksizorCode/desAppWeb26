<?php
// especifica si estamos en modo desarrollo
$debug=true;

//Array con elemntos a utilizar
$menu =[
    // texto del link          // url del link               // title                               // target     // class
    ['txt'=>'Home',           'Lkn'=>'index.php',            'title'=>'Ir al Inicio',               'tar'=>0,   'cls'=>'elemento'],
    ['txt'=>'La galaxia hoy', 'Lkn'=>'blog.php',             'title'=>'Novedades Astronómicas',     'tar'=>0,   'cls'=>'elemento'],
    ['txt'=>'Nosotros',       'Lkn'=>'nosotros.php',         'title'=>'Sobre Nosotros',             'tar'=>0,   'cls'=>'elemento'],
    ['txt'=>'Calendario',     'Lkn'=>'calendario.php',       'title'=>'Calendario Astronómico',     'tar'=>0,   'cls'=>'elemento'],
    ['txt'=>'Facebook',       'Lkn'=>'https://facebook.com', 'title'=>'Nuestro Facebook',           'tar'=>1,   'cls'=>'elemento facebook'],
    ['txt'=>'Contacto',       'Lkn'=>'contacto.php',         'title'=>'Contacta con los Astros',    'tar'=>0,   'cls'=>'elemento']
];

//config y datos de la web generales
$datos = [
    // Configuración general
    'tituloSite'      => 'AstraLavista',
    'descripcion'     => 'Grupo de astrónomos entusiastas en Asturias, explorando el cosmos desde la tierra.',
    'lang'           => 'es',
    'autor'          => 'Miguel Esteban Corporation International',
    'charset'        => 'UTF-8',
    'timezone'       => 'Europe/Madrid',

    // Rutas de archivos y directorios
    'baseURL'        => 'https://www.astralavista.com/',
    'imgFolder'      => 'assets/img/',

    // Metaetiquetas para SEO
    'metaKeywords'   => 'astronomía, astrofotografía, planetas, cosmos, telescopios, observaciones',
    'metaDescription'=> 'AstraLavista',
    // Redes sociales
    'socials' => [
        'facebook'  => 'https://facebook.com/AstraLavistaAsturias',
        'twitter'   => 'https://twitter.com/AstraLavista',
        'instagram' => 'https://instagram.com/AstraLavistaAsturias',
        'youtube'   => 'https://youtube.com/AstraLavista',
        'tiktok'    => 'https://tiktok.com/@AstraLavista'
    ],

    // Datos de contacto
    'contacto' => [
        'email'     => 'contacto@astralavista.com',
        'telefono'  => '+34 600 123 456',
        'direccion' => 'C/ Observatorio, 12, Oviedo, Asturias, España',
        'mapa'      => 'https://maps.google.com/?q=C%2F+Observatorio,+12+Oviedo+Asturias+España'
    ],

   
    // Parámetros visuales
    'logo'          => 'assets/img/logo.png',
    'logoFooter'    => 'assets/img/logo-footer.png',
    'favicon'       => 'assets/img/favicon.ico',

];

/* FUNCIONES */

// Función constructora de Menús
function constructorMenu(){
    global $menu;

    echo "<nav><ul>";
    //   "<li><a href='COSA.PHP' class='COSA' title='DESCRIPCION DEL APARTADO' target='_blank'>COSA</a></li>";
    foreach($menu as $elemento){
       // echo "<li><a href='{$elemento['Lkn']}' class='{$elemento['cls']}' title='{$elemento['title']}' target='_blank'>{$elemento['txt']}</a></li>";
        echo "<li><a href='{$elemento['Lkn']}' class='{$elemento['cls']}' title='{$elemento['title']}'";
      
        //comrpobamos si tar es igual a 0 o a 1 
        if($elemento['tar']){
            //si lo es escribe esto
        echo " target='_blank' ";        
        }     
      
        //seguimos palante
        echo ">{$elemento['txt']}</a></li>";
    }
    echo "</ul></nav>";

}


//Convertir formato teléfono a numero limpio +34 666 555 888 -> 3466655588
// formatNumTel('+34 666 555 777');
function formatNumTel($numero) {
    // Eliminar espacios y el signo +
    $numeroFormateado = str_replace([' ', '+'], '', $numero);
    
    // Añadir el prefijo "tel:"
    return $numeroFormateado;
}