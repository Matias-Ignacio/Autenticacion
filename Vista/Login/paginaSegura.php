<?php 
include_once '../../configuracion.php';  
include_once '../Estructura/headPrivado.php';


?>



<main>
    <div class="container-fluid">
        <div class="mb-3 mt-3">
            <h3>Bienvenido <?php echo($_SESSION['nombreUsuario']);?> Estas en una pagina segura</h3>
            <div class="">
                    <h4>Usuario: <?php echo($_SESSION['nombreUsuario']);
                    echo " (".$objSession->getRol()->getDescripcion().")" ;?></h4>
                    
            </div>



        </div>
        <div class="btn btn-"></div>
    </div>
</main>

