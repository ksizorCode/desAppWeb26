<?php require '_config.php';?>
<?php
    // if(isset($_SESSION['logueado'])){
    //     header ("Location:laboratoriodelmal.php");
    // }
    // else{
    //     header ("Location:expulsado.php");
    // }


    if(_logueado()){
        header ("Location:laboratoriodelmal.php");
    }
    else{
        header ("Location:expulsado.php");
    }

    