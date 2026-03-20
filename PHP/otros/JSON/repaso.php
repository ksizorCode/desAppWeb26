<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>


<?php
// tas en construcción si=1 no=0
$construccion=1;


$miArray=[
    'El elogio del horizonte',
    'Guardián del puerto',
    'El David',
    'La Madre del emigrante',
    'Las chaponas'
];

if($construccion){
    echo '<pre>';
        print_r($miArray);
    echo '</pre>';
}


echo '<ul>';
    //BUCLE que crea tantos lis como elementos tiene el array
    foreach($miArray as $obra){
        echo "
            <li>
                <h2>$obra</h2>
                <a href='#' class='btn'>Ver más</a>
            </li>
            ";
    }
echo '</ul>';
?>


<style>

body{
    font-family: sans-serif;
}

li{ list-style:none; padding:0; }
.btn{
    background: purple;
    border-radius:20px;
    padding: 10px 30px;
    color:white;
    text-decoration:none;

}
    </style>