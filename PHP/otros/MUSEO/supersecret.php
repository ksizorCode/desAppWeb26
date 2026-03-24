<? require 'bloques/config.php'; ?>
<?
if(!$logueado){
    header ("Location:expulsado.php");
}
?>



<? include 'bloques/header.php'; ?>



<h1>Estas en una zona restringida</h1>
<img src="assets/img/avengers.jpg"
<p>Si has llegado hasta aquí eres parte de los Vengadores</p>
<a href="logout.php">Salir de esta zona</a>


<? include 'bloques/footer.php'; ?>