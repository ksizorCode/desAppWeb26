<!-- desde aquí index.php-->
<!-- primer bloque de inclues (a data y a header)-->
<?
include '_data.php';   //llamamos a los datos generales
include 'inc/_header.php'; //llamamos al inicio de HTML + cabecera
?>
<!-- --- fin de includes (data y header) -->

<h1> Bienvenidos a <?php echo $data['titulo_site'];?></h1>
<img src="<?php echo $data['logo'];?>" alt="<?php echo $data['titulo_site'];?>">


<p>Puedes encontrarnos en:</p>
<address><?php echo $data['direccion'];?></address>
<a href="tel:<?php echo $data['telefono1'];?>"><?php echo $data['telefono1'];?></a>

<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus at aut facere expedita assumenda quasi aliquam, id cum blanditiis. Nisi inventore fugit corporis quae deserunt veniam vero libero assumenda dolorum.</p>


<!-- segundo bloque de inclues (a footer)-->
<? include 'inc/_footer.php'; //llamamos al pie de página ?> 
<!-- fin de bloque de includes (footer) -->
<!-- hasta aquí index.php FIN DE INDEX-->