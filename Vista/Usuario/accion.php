<?php
    include_once '../../configuracion.php';
    $Titulo='Accion';

    $datos=data_submitted();
    $resp=false;
    $objUsuario=new AbmUsuario();
    
    if(isset($datos['accion'])){
        if($datos['accion']=='editar'){
            if($objUsuario->modificacion($datos)){
                $resp=true;
            }// fin if 

        }// fin if

         

    }// fin if 

?>