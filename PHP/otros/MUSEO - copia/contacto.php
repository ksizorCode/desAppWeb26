<? require 'bloques/config.php'; ?>
<? include 'bloques/header.php'; ?>

<h1>Contacto</h1>

<form>

    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" required>
    <br><br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="mensaje">Mensaje:</label><br>
    <textarea id="mensaje" name="mensaje" rows="4" cols="50" required>
       </textarea><br><br> <input type="submit" value="Enviar">

</form>



<? include 'bloques/footer.php'; ?>