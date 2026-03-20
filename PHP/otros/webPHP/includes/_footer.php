</main>
<footer>
    <? constructorMenu();?>
    <p>
        <a href="tel:<? echo formatNumTel($datos['contacto']['telefono']); ?>"><? echo $datos['contacto']['telefono'] ?></a>
    </p>
    
    <p>&copy; Copyright <? echo date('Y')?> -  <? echo $datos['tituloSite']?></p>
</footer>

</body>
</html>