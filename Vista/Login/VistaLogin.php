<?php
$titulo="Login";
include_once '../Estructura/headLibre.php'; 
?>
 

<main>
    <div class="container bg-white-50 d-flex justify-content-center mt-5">
        <form  action="../accion/accionVerificarLogin.php" method="post" name="formRegistro" id="formRegistro">
            <div class="card" style="width: 18rem;">
                <img src="../imagenes/autenticacion.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-center">Registro</h5>

                    <div class="mb-3 mt-3">
                        <label for="floatingInputValue">Ingrese su Nombre</label> 
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Fulanito">
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="floatingInputValue">Ingrese su Password</label> 
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <button type="submit" class="btn btn-primary">Ingresar </button>
                </div>
            </div> 

        </form>




    </div>

    
</main>
<!--LINK JS -->

<script src="../Js/main.js"></script>



<?php
include_once "../Estructura/footer.php"; 
?>

