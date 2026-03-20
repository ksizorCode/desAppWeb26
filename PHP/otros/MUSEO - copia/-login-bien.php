<? require 'bloques/config.php'; ?>
<? include 'bloques/header.php'; ?>


<?
session_start();    // Iniciamos Sesión

//Este array contiene los datos de acceso del 
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
//SI EL USUARIO HA RELLENADO EL FORMULARIO DE USUARIO/CONTRASEÑA haces todo esto:
        //Comprobamos si el formulario ha sido rellenado (via POST)
        if(isset($_POST['usuario']) && isset($_POST['password'])){
            //Guardamos los datos introducidos por el usuario en variables
        $usuarioIngresado  = $_POST['usuario'];
        $passwordIngresado = $_POST['password'];

        //Mostramos esos datos en Debug
        _debug("El usuario es: $usuarioIngresado <br>");  //debuggin / testeo
        _debug("El password es: $passwordIngresado <br>"); //debuggin / testeo

            //Comprobación de credenciales
            foreach($datosUsuario as $valor){
                if($valor['user']==$usuarioIngresado && $valor['pass']==$passwordIngresado){
                    $logueado=true;
                    $_SESSION['logueado']=true;
                    $_SESSION['usuario']=$_POST['usuario'];
                    break; //Salimos de el bucle
                }
            }
            // si no es correcta la contraseña mostramos mensaje de error
            if(!isset($logueado)){
                echo "<div class='aviso'>Los datos de acceso son erróneos</div>";
            }
       
        //Si el usuario ha introducido correctamente los datos, mostramos un mensaje de bienvenida
        }











//COMPROBACIÓN DE SI EL USUARIO ESTÁ LOGUEADO O SE HA LOGUEADO AYER

if(isset($_SESSION['logueado'])){ // Si ya nos habíamos logueado antes...
    $logueado=true; //igualamos la variable PHP a true
    echo "🥝 Estás Logueado y login es igual a: $logueado";
}
else{       // si no 
    $logueado=false; // igualamos la variable PHP a false
    echo "🍅 No estas logueado";
}

// CARGAMOS CONTENIDO EN FUNCIÓN DE SI SE HA LOGUEADO O NO
if($logueado){
    //header ('Location: contacto.php');
    include 'bloques/admin.php';            // si está logueado cargamos admin.php
    }
else{               // si no está logueado cargamos el formulario de usuario / contraseña
    ?>
        <form action="" method="post" class="form-login">
            <h1>Acceso al depósito del museo</h1>
            <label for="usuario">usuario</label>
            <input type="text" name="usuario" id="usuario">
    
            <label for="password">password</label>
            <input type="password" name="password" id="password">
    
            <input type="submit" value="Acceder">
        </form>
    <?
    }












?>

<? include 'bloques/footer.php'; ?>
    
