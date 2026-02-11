<?

//Array con los Datos
$datos = [
    [
        "nombre" => "Harry Potter",
        "casa" => "Gryffindor",
        "sangre" => "Mestiza",
        "patronus" => "Ciervo",
        "varita" => "Acebo y pluma de fénix",
        "imagen" => "https://cdn.dribbble.com/userupload/42411940/file/original-5e2045c33658afbe1b8c5d14231af45d.png",
        "descripcion" => "El niño que vivió y el protagonista de la saga. Es conocido por su valentía, su cicatriz en forma de rayo y su lealtad inquebrantable hacia sus amigos."
    ],
    [
        "nombre" => "Ron Weasley",
        "casa" => "Gryffindor",
        "sangre" => "Pura",
        "patronus" => "Jack Russell Terrier",
        "varita" => "Sauce y pelo de unicornio",
        "imagen" => "https://cdn.dribbble.com/userupload/24773649/file/original-067ce25cb602f9e6896b22ecc350dbec.png",
        "descripcion" => "El mejor amigo de Harry y el menor de los varones Weasley. Aunque a veces vive a la sombra de sus amigos, su sentido del humor y valor son fundamentales."
    ],
    [
        "nombre" => "Hermione Granger",
        "casa" => "Gryffindor",
        "sangre" => "Nacida de muggles",
        "patronus" => "Nutria",
        "varita" => "Vid y nervio de dragón",
        "imagen" => "https://cdn.dribbble.com/userupload/24809289/file/original-377095eb6e3f82fa1ebed1ad486c1f33.png",
        "descripcion" => "La bruja más brillante de su generación. Su inteligencia lógica y su dominio de los hechizos salvaron al trío en innumerables ocasiones."
    ],
    [
        "nombre" => "Draco Malfoy",
        "casa" => "Slytherin",
        "sangre" => "Pura",
        "patronus" => "Ninguno",
        "varita" => "Espino y pelo de unicornio",
        "imagen" => "https://cdn.dribbble.com/userupload/24839279/file/original-79413f481b152b00a5f2ce8b841cd725.png",
        "descripcion" => "Hijo de una influyente familia de magos oscuros. Rival de Harry en Hogwarts, cuya moral se ve puesta a prueba durante el ascenso de Voldemort."
    ],
    [
        "nombre" => "Severus Snape",
        "casa" => "Slytherin",
        "sangre" => "Mestiza",
        "patronus" => "Cierva",
        "varita" => "Pino y nervio de dragón",
        "imagen" => "https://cdn.dribbble.com/userupload/24850522/file/original-4f25a6e34ae3725a74dd862cb07567e0.png",
        "descripcion" => "Maestro de Pociones con un pasado complejo y misterioso. Su lealtad es uno de los mayores secretos de la historia mágica."
    ],
    [
        "nombre" => "Rubeus Hagrid",
        "casa" => "Gryffindor",
        "sangre" => "Mestiza (Semi-gigante)",
        "patronus" => "Incapaz de producirlo",
        "varita" => "Roble (oculta en su paraguas)",
        "imagen" => "https://cdn.dribbble.com/userupload/24828711/file/original-fb4077bd4c4fdf8cf7caf777cb271997.png",
        "descripcion" => "El guardián de las llaves y terrenos de Hogwarts. Es un amante de las criaturas peligrosas y el primer amigo que Harry tuvo en el mundo mágico."
    ],
    [
        "nombre" => "Albus Dumbledore",
        "casa" => "Gryffindor",
        "sangre" => "Mestiza",
        "patronus" => "Fénix",
        "varita" => "Saúco",
        "imagen" => "https://cdn.dribbble.com/userupload/36171343/file/original-e4a0005e9ed349f5b6eda174091daefd.png",
        "descripcion" => "Director de Hogwarts y considerado el mago más poderoso de la era moderna. Mentor de Harry y líder en la lucha contra la oscuridad."
    ],
    [
        "nombre" => "Luna Lovegood",
        "casa" => "Ravenclaw",
        "sangre" => "Pura",
        "patronus" => "Liebre",
        "varita" => "Desconocida",
        "imagen" => "https://cdn.dribbble.com/userupload/38953870/file/original-f1696a9031bb1a6f6c8c94292f3e0072.png?resize=1024x1365&vertical=center",
        "descripcion" => "Una estudiante excéntrica y soñadora conocida por su honestidad brutal y su capacidad para ver el mundo de una manera única y mágica."
    ]
];


//funcion desplegar galeria
function mostrarGaleria($datos, $excepcion = null) {
    echo '<ul class="galeria">';
    
    foreach ($datos as $i => $personaje) {
        // Usamos != para que compare el valor sin importar si es string o int
        // O forzamos a (int) para mantener la comparación estricta
        if ($excepcion !== null && $i === (int)$excepcion) {
            continue; 
        }

        echo "
        <li>
            <a href='info.php?p=$i'>
            <h2 style='view-transition-name:title-{$i}'>{$personaje['nombre']}</h2>
                <img src='{$personaje['imagen']}' alt='{$personaje['nombre']}' style='view-transition-name:image-{$i}'>
                <p>{$personaje['casa']}</p>
            </a>
        </li>";
    }
    
    echo '</ul>';
}