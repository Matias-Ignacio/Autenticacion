<?php 
class Session{
    
    public function __construct()
    {
        session_start(); // Inicia la sessión 
    }// fin metodo constructor 


    
    /** METODO INICIAR 
     * @param string $nombreUsuario 
     * @param string $pws
    */
    public function iniciar($nombreUsuario, $pws){
        
        $objAbmUsuario=new AbmUsuario(); 
        $param['usnombre'] = $nombreUsuario;
        $param['uspass'] = $pws;
        $param['usdeshabilitado'] = '0000-00-00 00:00:00';
        $usuarios=$objAbmUsuario->buscar_2($param);  
        if(count($usuarios)>=1){
            $_SESSION['idusuario']=$usuarios[0]->getId(); // guarda el Id del usuario en la session      
        }
   
    }// fin metodo iniciar 

    /**
     * METODO VALIDAR
     * valida la session actual, si tiene usuario y pws válidos
     * @return boolean
     */
    public function validar(){
        $salida=false;   
        if($this->activa() && (isset($_SESSION['idusuario']))){
            $salida=true; 
        }
        return $salida; 
    }// fin metodo validar

    /**
     * METODO ACTIVA
     * @return boolean
     */
    public function activa(){
        $salida=false;
        //if(session_start()){
        if(session_status() === PHP_SESSION_ACTIVE){    
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
        $consulta=['idusuario'=>$_SESSION['idusuario']];// pregunto si el usuario con 
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
            $dato['idrol']=$objRolUser->getObjRol()->getId();
            $objRol=new Rol();
            $objRol->setId($dato['idrol']);
            $objRol->Cargar();
        }// fin if 
        $_SESSION['idRol']=$objRol->getId();
        $_SESSION['idDescripcion']=$objRol->getDescripcion();
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