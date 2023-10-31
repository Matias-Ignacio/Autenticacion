<?php
class UsuarioRol{

    // ATRIBUTOS
    private $objUsuario; // delegacion con la clase usuario
    private $objRol; // delegacion con la clase rol
    private $mensaje; 
    

    // CONSTRUCTOR 
    public function __construct() { 
        $this->objUsuario=new Usuario();
        $this->objRol=new Rol();
        $this->mensaje=""; 
    }// fin constructor 

    // METODO SETEAR
    public function setear($usuario,$rol){
        $this->objUsuario=$usuario;
        $this->objRol=$rol;
    } // fin function 

    // METODOS GET
    public function getObjUsuario(){
        return $this->objUsuario; 
    }// fin function 

    public function getObjRol(){
        return $this->objRol; 
    }// fin function

    public function getObjMensaje(){
        return $this->mensaje; 
    }// fin function


    //METODOS SET
    public function setObjUsuario($usuario){
        $this->objUsuario=$usuario;
    }// fin function set


    public function setObjRol($rol){
        $this->objRol=$rol;
    }// fin function set

    public function setMensaje($msj){
        $this->mensaje=$msj;
    }// fin function set


    /** METODOS INSERTAR - MODOFICAR - ELIMINAR - BUSCAR - LISTAR  */
    
    /** METODO BUSCAR: 
     * EN FUNCION DEL ID (DNI), BUSCA A LA PERSONA EN LA BASE DE DATOS
    * @return boolean
    */
    public function cargar(){

        $salida=false; // inicializacion del valor de retorno
        $idUsuario=$this->getObjUsuario()->getId();
        $idRol=$this->getObjRol()->getId();
        $bd=new BaseDatos();
        $sql = "SELECT * FROM usuariorol WHERE idusuario=".$idUsuario." and idrol=".$idRol;
        if($bd->Iniciar()){// inicializa la conexion
            $salida=$bd->Ejecutar($sql); 

            if($salida>-1){
                if($salida>0){
                    $salida=true; 
                    $R=$bd->Registro(); // recupera los registros de la tabla  con la ID dada
                    $newObjUsuario=new Usuario(); // creo un obj usario
                    $newObjUsuario->setId($R['idusuario']);// seteo su id 
                    $newObjUsuario->cargar();
                    $newObjRol=new Rol();// crea un ob rol
                    $newObjRol->setId($R['idrol']);// seteo su id
                    $newObjRol->cargar(); 
                    $this->setear($newObjUsuario,$newObjRol);
                }// fin if 
            }// fin if
        }// fin if 
        else{
            $this->setMensaje("Error en la Tabla rol").$bd->getError();
        }// fin else
        return $salida; 

    }// fin function

    // LAS FUNIONES MODIFICAR, INSERTAR Y ELIMINAR LAS REALIZA EN FUNCION DEL ID DEL USUARIO

    /** METODO INSERTAR 
     * Ingresa un registro en la base de datos 
     * @return boolean
     */
    public function insertar(){
        $salida=false; // inicializacion del valor de retorno
        $bd=new BaseDatos();
        $sql="INSERT INTO usuariorol (idusuario,idrol)
        VALUES (".$this->getObjUsuario()->getId().",".$this->getObjRol()->getId().");"; 
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;
            }// fin if 
            else{
                $this->setMensaje("rol - > Insertar").$bd->getError();
            }// fin else
        }// fin if 
        else{
            $this->setMensaje("rol - > Insertar").$bd->getError();
        }// fin else
        return $salida; 
    }// fin function insertar 

     /**
     * METODO MODIFICAR (EN ESTE CASO EL MODIFCAR SI NO TIENE CAMPOS PROPIOS NO SE USA)
     * @return boolean
     */
    public function modificar(){
        $salida=false;
        $bd=new BaseDatos();
        $sql="UPDATE usuariorol SET idrol=".$this->getObjRol()->getId()." WHERE idusuario=".$this->getObjUsuario()->getId();
        // el modoficar no se usa si NO tengo campos propios en las relaciones muchos muchos 
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;
            }// fin if 
            else{
                $this->setMensaje("Tabla usuariorol Modificar ").$bd->getError();
            }// fin else
        } // fin if
        else{
            $this->setMensaje("Tabla usuariorol Modificar ").$bd->getError();
        } // fin else
        return $salida; 
    }// fin function modificar


    /**
     * METODO LISTAR POSTULANTE
     * DEVUELVE TODOS LOS USUARIOS CON SU ROL  EN LA BASE DE DATOS
     * @param $parametro
     * @return array 
     */
    public function listar($parametro=""){ // significa que el $parametro es opcional 
        
        $bd=new BaseDatos();
        $arrayUsuarios=array();
        $sql="SELECT * FROM usuariorol";
        if($parametro!=""){
            $sql.=' WHERE '.$parametro;
        }// fin if 
        if($bd->Iniciar()){
            $respuesta=$bd->Ejecutar($sql);
            if($respuesta>-1){
                if($respuesta>0){
                    // creo un obj nuevo de postulante ? o lo hago directo con this?
                    while($row=$bd->Registro()){
                        $obj=new UsuarioRol();
                        $objUsuario=new Usuario(); // creacion de los obj usuarios y rol
                        $objRol=new Rol();
                        $objUsuario->setId($row['idusuario']); // seteado del id de ambos
                        $objRol->setId($row['idrol']); 
                        $objUsuario->cargar(); // carga el obj 
                        $objRol->cargar(); 
                    $obj->setear($objUsuario,$objRol);
                    // llamamos al cargar creo un obj usuarioRol
                    array_push($arrayUsuarios,$obj);  
                     // opcion con this. Sino creo un obj y lo reemplazo por el this
                    }// fin while 


                }// fin if 
            }// fin if 
        }// fin if 
        return $arrayUsuarios; 
    }// fin function listar
    


    
    /**
     * METODO ELIMINAR 
     * @return boolean
     */
    
     public function eliminar(){
        $salida=false;
        $sql="DELETE FROM usuariorol WHERE idusuario = ".$this->getObjUsuario()->getId()." AND idrol = ".$this->getObjRol()->getId();
        $bd=new BaseDatos();
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;

            }// fin if
            else{
                $this->setMensaje("Tabla Usuariorol-> eliminar".$bd->getError()); 
            }// fin else

        }// fin if
        else{
            $this->setMensaje("Tabla Usuariorol-> eliminar".$bd->getError());
        }// fin else

        return $salida; 
    }// fin function eliminar
    
}// fin clase UsuarioRol





?>