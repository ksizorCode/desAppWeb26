<?php require '_config.php';?>
<?php
    if(!_logueado()){
        header('Location: expulsado.php');
    }
?>
<?php include '_header.php';?>

<h1>Estas en el laboratorio dle mal ☠</h1>
<p>Estas en una zona super secreta</p>

<?php include '_footer.php';?>
