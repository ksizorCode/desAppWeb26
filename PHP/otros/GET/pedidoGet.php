<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body{
            font-family: sans-serif;
            max-width:560px;
            margin:20px auto;
        }

        .pedido{
            border: solid 1px black;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2>Inserte Dirección para enviar su pedido</h2>
    
    <form action="pedidoGet.php" method="get">
        <label>Nombre:      <input type="text"   name="nombre"       required></label>
        <label>Apellidos:   <input type="text"   name="apellidos"    required></label>
        <label>Dirección:   <input type="text"   name="direccion"    required></label>
        <label>Email:       <input type="email"  name="mail"         required></label>
        <label>Teléfono:    <input type="tel" pattern="^[967]\d{8}$" name="telefono"     required></label>

        <input type="submit" value="Enviar Pedido 🤠">
    </form>


    <div class="pedido">
    <h2>Datos de su pedido</h2>
    <p>Hola Fulanito</p>
    <p>Enviaremos su pedido a la C/uria 22, a la atención de Fulanito García. Email <a href="mailto:fulanito@cosa.com">fulanito@cosa.com</a> y teléfono <a href="tel:666777888">666777888</a></p>
</div>

</body>
</html>