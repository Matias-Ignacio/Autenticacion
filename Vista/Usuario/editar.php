<?php
    include_once '../../configuracion.php';
    include_once '../Estructura/headLibre.php';
    $Titulo='Editar Usuario';

    // probar lo mismo pero llamando a usuariorol
    $objUsuario=new AbmUsuario();
    $datos=data_submitted();
    $obj=null;
    if(isset($datos['idUsuario'])){
        $listaUsuarios=$objUsuario->buscar($datos);
        if(count($listaUsuarios)==1){
            $obj=$listaUsuarios[0];
        }// fin if 

    }// fin if 

?>

<?php if($obj!=null){ ?>
    <section>
        <div class="container mt-3 p-3">
            <form action="" method="post">
                <label for="">ID Usuario</label>
                <input type="number" name="idusuario" id="idusuario" readonly value="<?php echo($obj->getId())  ?>">
                <label for="nombre"></label>
                <input type="text" name="usnombre" id="usnombre" value="<?php echo($obj->getNombre()) ?>">
                <label for="mail"></label>
                <input type="text" name="usmail" id="usmail" value="<?php echo($obj->getMail()) ?>">
                <label for="deshabilitado"></label>
                <input type="text" name="usdeshabilitado" id="usdeshabilitado" value="<?php echo($obj->getDeshabilitado()) ?>">
                <label for="password"></label>
                <input type="text" name="uspass" id="uspass" value="<?php echo($obj->getPassword()) ?>">
                <input type="submit" name="accion" id="deshabilitar" class="btn btn-danger" value="deshabilitar">
                <input type="submit" name="accion" id="editar" class="btn btn-info" value="editar">
            </form>
        </div>
    

<?php } else{
    echo("<p> No se encontro el campo a modificar </p>");
} ?>
    </section>    



<?php
    include_once '../Estructura/footer.php';

?>