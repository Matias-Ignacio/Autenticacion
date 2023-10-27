<?php
$variableSalida='Ver Registro';
include_once '../../configuracion.php'; 
$objSession=new Session();

?>
<!DOCTYPE html>
<html lang="en" style="min-height: 100%;  position: relative;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--LINK DE BOOSTRAP-->
    <link rel="stylesheet" href="../librerias/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <!--LINK CSS-->
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <!--LINK ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title></title>
     <!-- LINK JS BOOSTRAP -->
    <script src="../librerias/bootstrap-5.2.0-dist/js/bootstrap.min.js"></script>
        <!-- LINK JS JQuery -->
        <script src="../librerias/node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body style="margin-bottom:100px;">
    <!--HEDAER -->
    <header class="container-fluid bg-light p-3 shadow">
        <div class="d-flex justify-content-evenly">
            <div><h1>Autenticacion</h1></div>
             <div><h4><a href="../main/VistaListarUsuario.php"> Ver Registros </a> </h4></div>
            <div class="">
                <h4>
                    <?php
                    if($objSession->activa()){
                        $objSession->cerrar();
                        header('Location:../main/VistaLogin.php'); 
                    } // fin if 
                    ?>
                    <a href="../main/VistaLogin.php">Salir</a>
                </h4>
            </div>

        </div>

    </header>    
