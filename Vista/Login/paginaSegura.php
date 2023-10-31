<?php 
include_once '../../configuracion.php';  
include_once '../Estructura/headPrivado.php';

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
            <h3>Bienvenido <?php echo($_SESSION['nombreUsuario']);?> Estas en una pagina segura</h3>
        </div>
        <div class="btn btn-"></div>
    </div>
</main>

