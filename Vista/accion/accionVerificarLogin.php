<?php
// VERIFICACION DE DATOS 
include_once '../../configuracion.php';
// llamado a los obj de la clase session , usuario y rol
// inicia la session 
$objSession=new Session(); 

$datos=data_submitted(); 
$objSession->iniciar($datos['nombre'],$datos['password']);
// validacion de session 

if($objSession->validar()){
 header('Location: ../Login/paginaSegura.php'); 

}// fin if 
else{

        $_GET['error']="compruebe los datos ingresados";
       header('Location: ../Login/VistaLogin.php?error=compruebe los datos');
    
}// fin else





?>

