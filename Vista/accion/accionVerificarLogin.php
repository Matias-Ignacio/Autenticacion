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
    echo "AVL 11 Validamos";
    
    header('Location: ../Login/paginaSegura.php'); 

}// fin if 
else{
  echo "No Validamos";
        $_GET['error']="compruebe los datos ingresados";
       header('Location: ../Login/VistaLogin.php?error=compruebe los datos');
    
}// fin else


$objSession->cerrar();




?>

