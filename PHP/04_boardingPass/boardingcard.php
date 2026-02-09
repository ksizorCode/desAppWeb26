<?php
//http://localhost:10017/get/1/boardingcard.php?o=Palma&d=Oviedo&p=Sergio+Mor%C3%ADs&s=M&f=2026-06-24
// boardingcard.php? o=Palma & d=Oviedo & p=Sergio & s=M & f=2026-06-24
    $origen =   $_GET['o'];
    $destino =  $_GET['d'];
    $pasajero = $_GET['p'];
    $sexo   =   $_GET['s'];
    $fecha  =   $_GET['f'];
?>

<h1><?=$origen?> - <?=$destino; ?></h1>
<p><? echo $pasajero; ?></p>

<!-- desde aquí esto no varía -->
<p><?=$fecha; ?></p>


<style>
    html{
        background-color:lightyellow;
    }
    body{
        max-width:330px;
        margin:20px auto;
        font-family: sans-serif;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 3px 4px 8px #00000088;
        background: white;
        text-align: center;
    }
    h1{
        border-bottom: solid 2px black;
    }
    </style>