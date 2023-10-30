<?php 
class Session{
    
    public function __construct()
    {
        session_start(); // Inicia la sessión 
    }// fin metodo constructor 


    
    /** METODO INICIAR 
     * @param $nombreUsuario string
     * @param $pws string
    */
    public function iniciar($nombreUsuario,$pws){
        //$_SESSION['user']=$nombreUsuario; // guarda la variable de session nombre usuario
        $objAbmUsuario=new AbmUsuario();

        $consulta=['usnombre'=>$nombreUsuario,'uspass'=>$pws,'usdeshabilitado'=>null]; // forma la consulta para el metodo buscar de AbmUsuario 
        $usuarios=$objAbmUsuario->buscar($consulta);
        if($usuarios>=1){
            if($this->activa()){
                $_SESSION['idUser']=$usuarios[0]->getId(); // guarda el Id del usuario en la session
                $_SESSION['nombreUsuario']=$usuarios[0]->getNombre(); 

            }// fin if 

        }// fin if 

        return $_SESSION; 



    }// fin metodo iniciar 

    /**
     * METODO VALIDAR
     * valida la session actual, si tiene usuario y pws válidos
     * @return boolean
     */
    public function validar(){
        $salida=false; 
        if(isset($_SESSION['idUser'])){ // pregunta si esta seteado el id del usuario para validarlo
            $salida=true; 
        }// fin if 
        return $salida; 
    }// fin metodo validar

    /**
     * METODO ACTIVA
     * @return boolean
     */
    public function activa(){
        $salida=false;
        if(session_start()){
            $salida=true; // la session esta activa 
        } // fin if 

        return $salida; 

    }// fin metodo activa

    /** 
     * METODO GETUSUARIO 
     * @return Usuario
    */
    public function getUsuario(){
        $objAbmUsuario=new AbmUsuario();
        $consulta=['usnombre'=>$_SESSION['nombreUsuario'],'idusuario'=>$_SESSION['idUser']];// pregunto si el usuario con 
        // esa session esta registrado. Lo busco en la BD
        $usuarios=$objAbmUsuario->buscar($consulta);
        if($usuarios>=1){
            $usuarioRegistrado=$usuarios[0];

        }// fin if 
        return $usuarioRegistrado;
    }// fin metodo getUsuario

    /**
     * METODO GETROL
     * @return Rol
     */
    public function getRol(){
        $objRol=null;
        if($this->getUsuario()!=null){
            $userLog=$this->getUsuario(); // almacena el usuario 
            $datos['idusuario']=$userLog->getId();
            $objRolUsuario=new AbmRolUsuario();
            $listaUsuarios=$objRolUsuario->buscar($datos); // busca en la tabla usuarioRol los que tengan como idusuario
            $objRolUser=$listaUsuarios[0];
            // encuentro el id de usuario , 2° con el Id busco en UsuarioRol que tengan ese id (en teoria solo va a enontrar a uno)
            // 3° recupero el id de rol, 4° creo un obj rol u lo busco con ese ID
            $dato['idrol']=$objRolUser->getId();
            $objAbmRol=new AbmRol();
            $lista=$objAbmRol->buscar($dato);
            $objRol=$lista[0];

        }// fin if 
        return $objRol; 

    }// fin metodo getRol

    /**
     * METODO CERRAR 
     * @return boolean
     */
    public function cerrar(){
        $resp=session_destroy();
        return $resp;  
    }// fin metodo cerrar


}// fin clase Session 

?>