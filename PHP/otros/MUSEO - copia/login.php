<?php
require_once 'bloques/config.php';

_session_logueado();

// Array con datos de usuarios (debería estar en una base de datos)
$datosUsuario = [
    [
        'user' => 'Richard',
        'pass' => 'mate',
        'mail' => 'richard@rdfitness.com',
        'role' => 'admin'
    ],
    [
        'user' => 'Daniel',
        'pass' => 'Canva',
        'mail' => 'danic@rdfitness.com',
        'role' => 'usuario'
    ]
];

include 'bloques/header.php';


// Si el usuario ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        $usuarioIngresado  = trim($_POST['usuario']);
        $passwordIngresado = trim($_POST['password']);

        _debug("Usuario ingresado: $usuarioIngresado <br>");
        _debug("Password ingresado: $passwordIngresado <br>");

        // Comprobar credenciales
        foreach ($datosUsuario as $usuario) {
            if ($usuario['user'] === $usuarioIngresado && $usuario['pass'] === $passwordIngresado) {
                $_SESSION['logueado'] = true;
                $_SESSION['usuario'] = $usuarioIngresado;
                $_SESSION['rol'] = $usuario['role'];

                _debug("🟢 Usuario autenticado como: $usuarioIngresado");

                // Redirigir a admin.php si está autenticado
                header("Location: admin.php");
                exit();
            }
        }

        // Si no se encontró el usuario
        echo "<div class='aviso'>⛔ Datos de acceso incorrectos</div>";
    } else {
        echo "<div class='aviso'>⛔ Rellena todos los campos</div>";
    }
}


// Si no está logueado, mostrar formulario
if (!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true) {
?>
    <form action="" method="post" class="form-login">
        <h1>Acceso al depósito del museo</h1>
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Acceder">
    </form>
<?php
}

include 'bloques/footer.php';
?>
s