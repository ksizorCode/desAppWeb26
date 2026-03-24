<?php require '_config.php';?>
<?php include '_header.php';?>
<h1>Cerrar</h1>
<?php

if(_logueado()){
 session_unset();
 session_destroy();
}
 ?>
<?php include '_footer.php';?>
