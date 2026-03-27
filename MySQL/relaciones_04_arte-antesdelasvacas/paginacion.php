<?
//cargamos las funciones
require_once '_funciones.php';


// Limites de la paginación
$cantidad=4; // mostrar 4 obras por pantallazo
$pagina=0; // pagina de comienzo (empieza en 0)

if(isset($_GET['pag'])){ // si recibimos un valor GET miramos que contiene
    $pagina = $_GET['pag'];
}

$offset = $cantidad*$pagina;



$sql="SELECT obras.id, obras.titulo FROM obras LIMIT $cantidad OFFSET $offset";
$obras = consulta($sql);

?>


<pre>
    <code>
        <? print_r($obras);?>
    </code>
</pre>

<?

$siguiente =$pagina+1;


echo "Pagina: ".$pagina.'<br>';
echo "Siguiente: ".$siguiente.'<br>';
echo "Cantidad: ".$cantidad.'<br>';

?>


<a href="?pag=<?echo $siguiente?>">Siguiente</a>