<?
//cargamos las funciones
require_once '_funciones.php';

// Objtenemos el id de la obra
$s='La Mona Lisa';

if(isset($_GET['s'])){
    $s =$_GET['s'];
}

$sql="SELECT * FROM obras WHERE titulo LIKE '%$s%'";
$resultado = consulta($sql);

?>



<form>
    <label>
        Buscar
        <input type="search" name="s">
    </label>

    <input type="submit" value="Buscar">
</form>


<pre>
    <code>
        <? print_r($resultado);?>
    </code>
</pre>