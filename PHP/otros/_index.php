<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.n1, .n5{
			font-family: sans-serif;
		}

		.n5{
			color:red;
		}

		.n3{
			color:orange
		}

		.n2{
			color:green;
		}
	</style>
</head>
<body>
	
</body>
</html>


<?php

 $nombre = "Juan";
 $apellido='García';
 $lugar='Gijón';
 $nacimiento=1991;
 $actualyear=date('Y');
 $edad = $actualyear - $nacimiento;

 $texto='Eres '.$nombre.' '.$apellido.', de '.$lugar.' con '.(2025-$nacimiento).' años';
 $texto= "Eres $nombre $apellido de $lugar con $edad años";

// Tu nombre es Juan García, eres de Gijón y tienes 34 años

//PARTE 2

// meter todos los datos en array declarativo 'nombre'=>'Juan',

$datos =[ //array declarativo
	'nombre' 	=> 'Juan',
	'apellido'	=> 'García',
	'lugar'		=> 'Gijón',
	'nacim'		=>  1991
];
$edad = date('Y') - $datos['nacim'];

$texto ="Eres ".$datos['nombre'];
$texto="Eres {$datos['nombre']} {$datos['apellido']} de {$datos['lugar']} y tienes $edad";




$alumnos=[
	'Juan',
	'García',
	'Gijón'
];

$alumnos[1]; // Esto llama a los elementos de un array normal

$students =[
	['nombre' 	=> 'Juan',
	'lugar'		=> 'Gijón',
	'nacim'		=>  1991,
	'apellido'	=> 'García'
	],

	['nombre' 	=> 'María',
	'apellido'	=> 'de la Vega',
	'lugar'		=> 'Oviedo',
	'nacim'		=>  1992],
	
	['nombre' 	=> 'Max',
	'apellido'	=> 'Luengo',
	'lugar'		=> 'Mieres',
	'nacim'		=>  1997]
];

//echo $students[0]['nombre'];
// echo '<pre>';
// echo var_dump($students);
// echo '</pre>';
// echo '<br>';
// echo '<pre>';
// echo print_r($students);
// echo '</pre>';

for($i=0; $i<count($students);$i++){
	//echo "<li>".$students[$i]['nombre']."</li>";
	//echo "<li> {$students[$i]['nombre']}</li>";
}





//FUNCIONES

// function saludar($valor){
// 	echo "<li>Hola mundo nº$valor</li>";
// }

// //saludar();

// echo '<ol>';
// 	for($j=1;$j<=200;$j++){
// 		saludar($j);
// 	}
// echo '</ol>';







// function saludo2($valor){
// 	return "Buenos días $valor";
// }	

// for($k=0; $k<5; $k++){
// 	$libreta = "<li>";
// 	$libreta .= saludo2($k);
// 	$libreta .= "</li>";

// 	echo $libreta;
// }


$personas=[
	'Juan',
	'María',
	'Antonio',
	'Marta',
	'Carolina',
	'Carla',
	'Mateo'
];

$saludos =['Hola','Buenos días','Qué tal','Como estás','Hi!', 'Pírate'];


function saludando($nombre){
	global $saludos; // importamos saludos dentro de la función

	
	$numSaludos = count($saludos)-1; // nº elementos de array $saludos
	$numAleatorio = rand(0,$numSaludos); // nº entre 0 y el max. elem. en $saludos
	
	//Seleccionamos un saludo del array
	$miSaludo = $saludos[$numAleatorio];
	$miTexto2=$miSaludo .' '. $nombre;
	
	return $miTexto2;

	//return $saludos[rand(0, count($saludos)-1)] .' '.$nombre;
}

for($L=0;$L<count($personas);$L++){
	echo '<li class="n'.rand(0,5).'">'.saludando($personas[$L]).'</li>';
}









//echo $texto;

// volver a construir la frase

?>