<?php header('Content-Type: text/html; charset=utf-8');
header ("Cache-Control: no-cache, must-revalidate ");

/////////////////////////////
// CONFIGURACION APP//
/////////////////////////////

$PROYECTO ='Autenticacion';

//variable que almacena el directorio del proyecto
$ROOT =$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";
include_once($ROOT.'util/funciones.php'); // CONCATENA EL DIRECTORIO ROOT CON EL SCRIPT FUNCIONES.PHP
//var_dump($ROOT);
$GLOBALS['ROOT']=$_SERVER['DOCUMENT_ROOT']."/$PROYECTO/";

// Variable que define la pagina de autenticacion del proyecto
//$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/vista/login/login.php";
//$INICIO = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/index.php";

// variable que define la pagina principal del proyecto (menu principal)
//$PRINCIPAL = "Location:http://".$_SERVER['HTTP_HOST']."/$PROYECTO/View/main.php";

$_SESSION['ROOT']=$ROOT;

?>