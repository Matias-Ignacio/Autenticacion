<?php
class Usuario{

    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensaje; 

    // Constructor
    public function __construct()
    {
        $this->idusuario=0;
        $this->usnombre="";
        $this->uspass = 0;
        $this->usmail = "";
        $this->usdeshabilitado = "";
        
    }//  fin cinstructor

    public function setear($idusuario,$usnombre,$uspass,$usmail,$usdeshabilitado){
        $this->setidusuario($idusuario);
        $this->setusnombre($usnombre);
        $this->setuspass($uspass);
        $this->setusmail($usmail);
        $this->setusdeshabilitado($usdeshabilitado);
    }// fin function 

    //  METODO GET
    public function getidusuario(){
        return $this->idusuario; 
    }

    public function getusnombre(){
        return $this->usnombre; 
    }
    public function getuspass(){
        return $this->uspass; 
    }

    public function getusmail(){
        return $this->usmail; 
    }

    public function getusdeshabilitado(){
        return $this->usdeshabilitado; 
    }
    public function getMensaje(){
        return $this->mensaje;
    }// fin mensaje


    //  METODO SET
    public function setidusuario($p){
        $this->idusuario=$p;
    }

    public function setusnombre($usnombre){
        $this->usnombre=$usnombre;
    }

    public function setuspass($uspass){
        $this->uspass=$uspass;
    }

    public function setusmail($mail){
        $this->usmail=$mail;
    }

    public function setusdeshabilitado($p){
        $this->usdeshabilitado=$p;
    }
    public function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }// fin 
   /**
     * retorna un arreglo con los atributos del objeto
     * @return array
     */
    public function getDatos(){
        $ID = $this->getidusuario();
        $nom = $this->getusnombre();
        $pass = $this->getuspass();
        $mail = $this->getusmail();
        $hab = $this->getusdeshabilitado();
        $array = ["$ID","$nom","$pass","$mail","$hab"];

        return $array;
    }

    

    // METODO CARGAR
    /**
     * @return boolean
     */
    public function cargar(){
        $resp=false; 
       $base=new BaseDatos("autenticacion");
       $sql="SELECT * FROM usuario WHERE idusuario='".$this->getidusuario()."'";
       if($base->Iniciar()){
        $res=$base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                $row=$base->Registro();
                // setear($idusuario,$usnombre,$usdeshabilitado,$uspass,$usmail)
                $this->setear($row["idusuario"],$row["usnombre"],$row["uspass"],$row["usmail"],$row["usdeshabilitado"]);
                $resp=true; 
            }// fin if 
        }// fin if
       }// fin if 
       else{
        $this->setMensaje(" usuario ->".$base->getError());
       }

       return $resp; 

    }// fin function cargar



    
    // FUNCION INSERTAR 
    /**
     * @return boolean
     */
    public function insertar(){
        $resp=false;
        $base=new BaseDatos("autenticacion");
        $sql="INSERT INTO usuario (idusuario,usnombre,uspass,usmail,usdeshabilitado) VALUES('".$this->getidusuario()."','".$this->getusnombre()."',
        ".$this->getuspass().",".$this->getusmail().",".$this->getusdeshabilitado().");";

        if($base->Iniciar()){
            if($elid=$base->Ejecutar($sql)){
                $this->setidusuario($elid);// id 
                $resp=true;
            }    
            else{
                $this->setMensaje("usuario -> insertar ".$base->getError());
            }

        }// fin if 
        else{
            $this->setMensaje("usuario -> Insertar ".$base->getError());
        }
        return $resp; 

    }// fin function insertar
    


    // FUNCION MODIFICAR 
    /**
     * @return boolean
     */
    public function modificar(){
        $res=false;
        $base=new BaseDatos("autenticacion");
        $sql="UPDATE usuario SET usnombre='".$this->getusnombre()."', uspass=".$this->getuspass()."
        , usmail=".$this->getusmail().", usdeshabilitado=".$this->getusdeshabilitado()." WHERE idusuario=".$this->getidusuario()."";

        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                  $res=true;
            }
            else{
                $this->setMensaje("usuario -> Modificar ".$base->getError());
            }        
        }
        else{
            $this->setMensaje("usuario -> Modificar".$base->getError());
        }

        return $res; 
    }// fin modificar



    // FUNCION ELIMINAR 
    /**
     * @return boolean
     */
    public function eliminar(){
        $res=false; 
        $base=new BaseDatos("autenticacion");
        $sql="DELETE FROM usuario WHERE idusuario='".$this->getidusuario()."'";
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $res=true;
            }
            else{
                $this->setMensaje("Eliminar -> ".$base->getError());
            }
        }
        else{
            $this->setMensaje("Eliminar -> ".$base->getError());
        }
        return $res;
    }// fin eliminar


    // FUNCION LISTAR
    /**
     * @return array
     */
    public static function listar($parametro=""){
        $arreglo=array ();
        $base=new BaseDatos("autenticacion");
        
        $sql="SELECT * FROM usuario";
        if($parametro!=""){
            $sql.=' WHERE '.$parametro;
            
        }
        $res=$base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while($row=$base->Registro()){
                    $obj=new Usuario();
                    // setear($idusuario,$usnombre,$uspass,$usmail,$usdeshabilitado)
                    $obj->setear($row["idusuario"],$row["usnombre"],$row["uspass"],$row["usmail"],$row["usdeshabilitado"]);
                    array_push($arreglo,$obj); // carga el obj en el array 
                    
                }
            }
        }
        else{
            //$this->setMensaje("usuario -> listar".$base->getError());
        }
        return $arreglo; 
    }// fin function 


}// fin clase 

   
?>