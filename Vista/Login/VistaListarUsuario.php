<?php
$titulo = "Listado de Postulantes";

include_once '../../configuracion.php';
include_once '../Estructura/headPrivado.php'; 

$objUsuario=new AbmUsuario();
$listaUsuarios=$objUsuario->buscar(null); 
$listaRolesUsuarios=$objUsuario->listarUsuarioRol(null);

?>
<main>
<div class="container-fluid">
    <div class="col-md-12 mb-3 mt-3 d-flex justify-content-center">
        <a class="btn btn-success" role="button" href="../accion/accionActualizarLogin.php?accion=nuevo">NUEVO</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope=col>Deshabilitado</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!--BUCLE PARA CARGAR A LOS USUARIOS -->
                <?php
                if(count($listaRolesUsuarios)>0){
                    foreach($listaRolesUsuarios as $usuario){?>
                    <tr>
                        <th scope="row"><?php echo($usuario->getObjUsuario()->getNombre()); ?></th>
                        <td><?php echo($usuario->getObjUsuario()->getMail()); ?></td>
                        <td><?php 
                        if ('0000-00-00 00:00:00' === $usuario->getobjUsuario()->getDeshabilitado()){echo "Activo";}else{echo ($usuario->getobjUsuario()->getDeshabilitado());} ?></td>
                        <td><?php echo($usuario->getObjRol()->getDescripcion()); ?></td>
                        <td class="d-flex justify-content-evenly">
                                <div> <!--uso de iconos para mandar a editar o borrar un usuario-->
                                    <a href="../accion/accionActualizarLogin.php?accion=editar" data-bs-toggle="tooltip" data-bs-placement="top" title="editar">
                                        <i class="bi bi-pencil-square"></i> 
                                    </a>
                                </div>
                                <div>
                                    <a href="../accion/accionEliminarLogin.php?usID=<?php echo ($usuario->getObjUsuario()->getId().", "); echo ($usuario->getObjRol()->getId()); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="borrar">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>


                        </td>
                        
                    </tr>

                    <?php
                    }// fin foreach
                }// fin if 
                ?>


            </tbody>

        </table>

    </div>


</div>
</main>




<?php
include_once '../Estructura/footer.php'; 
?>