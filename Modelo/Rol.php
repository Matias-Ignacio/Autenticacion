<?php
class Rol{
    // ATRIBUTOS 
    private $idRol;
    private $descripcion;
    private $mensaje; 

    //CONSTRUCTOR 
    public function __construct(){
        //parent::__construct();
        $this->idRol=0;
        $this->descripcion="";
        $this->mensaje="";       
    }// fin metodo constructor 

    // METODO SETEAR
    public function setear($id,$descrip){
        $this->idRol=$id;
        $this->descripcion=$descrip;

    }// fin metodo setear 

    // METODO GET
    public function getId(){
        return $this->idRol; 
    }// fin metodo get

    public function getDescripcion(){
        return $this->descripcion; 
    }// fin metodo get

    public function getMensaje(){
        return $this->mensaje; 
    }// fin metodo get

    //METODO SET

    public function setId($id){
        $this->idRol=$id;
    }// fin metodo set

    public function setDescripcion($descr){
        $this->descripcion=$descr;
    }// fin metodo set

    public function setMensaje($msj){
        $this->mensaje=$msj;
    }// fin metodo set

    
    /******** METODOS INGRESAR - MODIFICAR - ELIMINAR - LISTAR ********** */


    /** METODO BUSCAR: EN FUNCION DEL ID, BUSCA A LA PERSONA EN LA BASE DE DATOS
     * @return boolean
     */
    public function cargar(){
        $bd=new BaseDatos();
        $salida=false; // inicializacion del valor de retorno
        $sql = "SELECT * FROM rol WHERE idrol = ".$this->getId();
        if($bd->Iniciar()){// inicializa la conexion
            $salida=$bd->Ejecutar($sql); 
            if($salida>-1){
                if($salida>0){
                    $salida=true; 
                    $R=$bd->Registro(); // recupera los registros de la tabla  con la ID dada                  
                    $this->setear($R['idrol'],$R['rodescripcion']);
                }// fin if 
            }// fin if
        }// fin if 
        else{
            $this->setMensaje("Error en la Tabla rol").$bd->getError();
        }// fin else
        return $salida; 
    }// fin function 


    /** METODO INSERTAR 
     * Ingresa un registro en la base de datos 
     * @return boolean
     */
    public function insertar(){
        $salida=false; // inicializacion del valor de retorno
        $sql="INSERT INTO rol (idrol,rodescripcion)
        VALUES (".$this->getId().",'".$this->getDescripcion()."',);"; 
        $bd=new BaseDatos();
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
     * METODO MODIFICAR
     * @return boolean
     */
    public function modificar(){
        $salida=false;
        $sql="UPDATE rol SET rodescripcion = '".$this->getDescripcion()."'  WHERE idusuario = ".$this->getId();
        $bd=new BaseDatos();
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;
            }// fin if 
            else{
                $this->setMensaje("Tabla rol Modificar ").$bd->getError();
            }// fin else
        } // fin if
        else{
            $this->setMensaje("Tabla rol Modificar ").$bd->getError();
        } // fin else
        return $salida; 
    }// fin function modificar

    /**
     * METODO ELIMINAR 
     * @return boolean
     */
    
    public function eliminar(){
        $salida=false;
        $sql="DELETE FROM rol WHERE idrol= ".$this->getId();
        $bd=new BaseDatos();
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;
            }// fin if
            else{
                $this->setMensaje("Tabla rol-> eliminar".$bd->getError()); 
            }// fin else
        }// fin if
        else{
            $this->setMensaje("Tabla rol-> eliminar".$bd->getError());
        }// fin else
        return $salida; 
    }// fin function eliminar


    /**
     * METODO LISTAR 
     * DEVUELVE TODOS LOS ROLES EN LA BASE DE DATOS
     * @param $parametro
     * @return array 
     */
    public function listar($parametro=""){
        //var_dump($parametro);
        $bd=new BaseDatos();
        $arrayUsuarios=array();
        $sql="SELECT * FROM rol";
        if($parametro!=""){
            $sql.=' WHERE '.$parametro;
        }// fin if 
        if($bd->Iniciar()){
            $respuesta=$bd->Ejecutar($sql);
            if($respuesta>-1){
                if($respuesta>0){
                // creo un obj nuevo de postulante ? o lo hago directo con this?
                    while($row=$bd->Registro()){
                    $obj=new Rol();
                    $obj->setear($row['idrol'],$row['rodescripcion']);
                    array_push($arrayUsuarios,$obj);   // opcion con this. Sino creo un obj y lo reemplazo por el this
                    }// fin while 
                }// fin if 
            }// fin if 
        }// fin if 
        return $arrayUsuarios; 
    }// fin function listar

}// fin clase rol


?>