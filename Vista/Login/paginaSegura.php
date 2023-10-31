<?php 
include_once '../Estructura/headPrivado.php';
include_once '../../configuracion.php';  

// inicio de la session 
$session=new Session();
/*
if($resp){
    header('Location:../Login/paginaSegura.php');

}// fin if 
else{
    header('Location:../Login/VistaLogin.php');

}// fin else
*/
?>



<main>
    <div class="container-fluid">
        <div class="mb-3 mt-3">
            <h4>Bienvenido <?php echo($_SESSION['nombreUsuario']);?> Estas en una pagina segura</h4>
        </div>
        <div class="btn btn-"></div>
    </div>
</main>

