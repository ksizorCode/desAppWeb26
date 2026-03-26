<? require 'functions.php'?>
<? getheader();?>


<?php
if(isset($_POST["true"])){
    // Abrir DB (con funcion.php)
    $conn = conn();

    // Leer archivo SQL
    $sql = file_get_contents("arte.sql");

    // Ejecutar múltiples queries
    if ($conn->multi_query($sql)) {?>
    
        <h1>✅ Base de datos reseteada</h1>
        <p>Felicidades, la base de datos se ha actualizado correctamente</p>
        <a href="index.php" class="btn">❮❮ Volver</a>
    
    <?
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $conn->close();
}

else{
?>
    <h1>Reset</h1>
    <p>Cuidado, estás apunto de inciar el reseteo de la base de datos. Sal de aquí si no estas seguro de querer hacer nada de esto.</p>
    <p>Si es la primera vez que isntalas esto, crea la base de datos "arte"</p>
    <a href="index.php" class="btn">❮❮ Woops!, mejor me vuelvo</a>


    <form method="POST">
        <input type="hidden" name="true">
        <label><input type="checkbox" name="true" required>Soy consicente de lo que esto implica y voy a proceder</label>
        <input type="submit" value="Resetar Base de Datos bajo mi cuenta y riesgo">
    </form>

<? }?>

<? getfooter();?>
