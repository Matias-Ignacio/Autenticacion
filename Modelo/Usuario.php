<?php

class Usuario{

    // ATRIBUTOS 
    private $idUsuario;
    private $nombre; 
    private $password; 
    private $mail;
    private $deshabilitado;
    private $mensaje;  


    // CONSTRUCTOR 
    public function __construct(){

        $this->idUsuario=0;
        $this->password="";
        $this->nombre="";
        $this->mail="";
        $this->deshabilitado=null;
        $this->mensaje="";

    }// fin constructor 


    // METODO SETEAR
    public function setear($id,$nombre,$pass,$mail,$deshabilitado){
        $this->idUsuario=$id;
        $this->nombre=$nombre;
        $this->password=$pass;
        $this->mail=$mail;
        $this->deshabilitado=$deshabilitado;

    }// fin metodo setear

    // METODOS GET
    public function getId(){
        return $this->idUsuario; 
    }// fin metodo get

    public function getNombre(){
        return $this->nombre; 
    }// fin metodo get

    public function getMail(){
        return $this->mail; 
    }// fin metodo get

    public function getDeshabilitado(){
        return $this->deshabilitado; 
    }// fin metodo get

    public function getMensaje(){
        return $this->mensaje; 
    }// fin metodo get

    public function getPassword(){
        return $this->password; 
    }// fin metodo get


    

    // METODOS SET 

    public function setId($id){
        $this->idUsuario=$id;
    }// fin metodo set 

    public function setNombre($name){
        $this->nombre=$name;
    }// fin metodo set 

    public function setPassword($pass){
        $this->password=$pass;
    }// fin metodo set 

    public function setMail($mail){
        $this->mail=$mail;
    }// fin metodo set 

    public function setMensaje($msj){
        $this->mensaje=$msj;
    }// fin metodo set 

    public function setDeshabilitado($des){
        $this->deshabilitado=$des;
    }// fin metodo set 




    /******** METODOS INGRESAR - MODIFICAR - ELIMINAR - LISTAR ********** */
    /** METODO BUSCAR: EN FUNCION DEL ID (DNI), BUSCA A LA PERSONA EN LA BASE DE DATOS
     * @return boolean
     */
    public function cargar(){
        $salida=false; // inicializacion del valor de retorno
        $sql = "SELECT * FROM usuario WHERE idusuario=".$this->getId();
        $bd=new BaseDatos();
        if($bd->Iniciar()){// inicializa la conexion
            $salida=$bd->Ejecutar($sql); 
            if($salida>-1){
                if($salida>0){
                    $salida=true; 
                    $R=$bd->Registro(); // recupera los registros de la tabla  con la ID dada
                    
                    $this->setear($R['idusuario'],$R['usnombre'],$R['uspass'],$R['usmail'],$R['usdeshabilitado']);

                }// fin if 

            }// fin if


        }// fin if 
        else{
            $this->setMensaje("Error en la Tabla usuario").$bd->getError();
        }// fin else

        return $salida; 

    }// fin function 


    /** METODO INSERTAR 
     * Ingresa un registro en la base de datos 
     * @return boolean
     */
    public function insertar(){
        $salida=false; // inicializacion del valor de retorno
        $id=$this->getId();
        $sql="INSERT INTO usuario (idusuario,usnombre,uspass,usmail,usdeshabilitado)
        VALUES ($id,'".$this->getNombre()."','".$this->getPassword()."','".$this->getMail()."','".$this->getDeshabilitado()."');"; 
        $bd=new BaseDatos();
        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;

            }// fin if 
            else{
                $this->setMensaje("usuario - > Insertar").$bd->getError();
            }// fin else

        }// fin if 
        else{
            $this->setMensaje("usuario - > Insertar").$bd->getError();

        }// fin else

        return $salida; 


    }// fin function insertar 

    /**
     * METODO MODIFICAR
     * @return boolean
     */
    public function modificar(){
        $salida=false;
        $sql="UPDATE usuario SET usnombre='".$this->getNombre()."', uspass=".$this->getPassword().", usdeshabilitado='".$this->getDeshabilitado()."' WHERE idusuario=".$this->getId();
        $bd=new BaseDatos();

        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;

            }// fin if 
            else{
                $this->setMensaje("Tabla usuario Modificar ").$bd->getError();

            }// fin else


        } // fin if
        else{
            $this->setMensaje("Tabla usuario Modificar ").$bd->getError();

        } // fin else

        return $salida; 


    }// fin function modificar


    /**
     * METODO LISTAR POSTULANTE
     * DEVUELVE TODOS LOS POSTULANTES EN LA BASE DE DATOS
     * @param $parametro
     * @return array 
     */
    public function listar($parametro=""){
        $arrayUsuarios=array();
        $bd=new BaseDatos();
        $sql="SELECT * FROM usuario";
        if($parametro!=""){
            $sql.=' WHERE'.$parametro;
        }// fin if 
        //var_dump($this->Iniciar());
        if($bd->Iniciar()){
           // echo("Entro al iniciar <br>");
            $respuesta=$bd->Ejecutar($sql);
            if($respuesta>-1){
                if($respuesta>0){
                    //echo("entro al ejecutar <br>");
                // creo un obj nuevo de postulante ? o lo hago directo con this?
                    while($row=$bd->Registro()){
                    $obj=new Usuario();
                    $obj->setear($row['idusuario'],$row['usnombre'],$row['uspass'],$row['usmail'],$row['usdeshabilitado']);
                    if(!$row['usdeshabilitado']){
                        array_push($arrayUsuarios,$obj);   // opcion con this. Sino creo un obj y lo reemplazo por el this
                    }
                    }// fin while 


                }// fin if 
            }// fin if 
        }// fin if 
        return $arrayUsuarios; 
        //var_dump($arrayUsuarios);
    }// fin function listar

 /**
     * METODO BORRADO LOGICO
     * @return boolean
     */
    public function eliminar(){
        $salida=false;
        $sql="UPDATE usuario SET usnombre='".$this->getNombre()."', uspass=".$this->getPassword().", usdeshabilitado=' NULL ' WHERE idusuario=".$this->getId();
        $bd=new BaseDatos();

        if($bd->Iniciar()){
            if($bd->Ejecutar($sql)){
                $salida=true;
            }// fin if 
            else{
                $this->setMensaje("Tabla usuario Borrado logico ").$bd->getError();
            }// fin else

        } // fin if
        else{
            $this->setMensaje("Tabla usuario Borrado logico ").$bd->getError();
        } // fin else
        return $salida; 
    }// fin function Borrado logico



}// fin clase Usuario 


?>