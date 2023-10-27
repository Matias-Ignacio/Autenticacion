<?php
class Usuariorol{

    private $objUsuario;
    private $objRol;
    private $mensaje;

    // Constructor
    public function __construct()
    {
        $this->objUsuario= new Usuario();
        $this->objRol= new Rol();
        
    }//  fin cinstructor

    public function setear($objUsuario,$objRol){
        $this->setobjUsuario($objUsuario);
        $this->setobjRol($objRol);
    }// fin function 

    //  METODO GET
    public function getobjUsuario(){
        return $this->objUsuario; 
    }
    public function getobjRol(){
        return $this->objRol; 
    }
    public function getMensaje(){
        return $this->mensaje;
    }// fin mensaje

    //  METODO SET
    public function setobjUsuario($obj){
        $this->objUsuario=$obj;
    }
    public function setobjRol($obj){
        $this->objRol=$obj;
    }
    public function setMensaje($mensaje){
        $this->mensaje=$mensaje;
    }// fin 

    /**
     * retorna un arreglo con los atributos del objeto
     * @return array
     */
    public function getDatos(){
        $objUs = $this->getobjUsuario();
        $objRol = $this->getobjRol();
        $array = ["$objUs","$objRol"];
        return $array;
    }
    







    //  de aca hacia abajo revisar




    // METODO CARGAR
    /**
     * @return boolean
     */
    public function cargar(){
        $resp=false; 
       $base=new BaseDatos("autenticacion");
       $sql="SELECT * FROM Usuariorol WHERE objUsuario='".$this->getobjUsuario()."'";
       if($base->Iniciar()){
        $res=$base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                $row=$base->Registro();
                $this->setear($row["objUsuario"],$row["objRol"]);
                $resp=true; 
            }// fin if 
        }// fin if
       }// fin if 
       else{
        $this->setMensaje(" Usuariorol ->".$base->getError());
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
        $sql="INSERT INTO Usuariorol(objUsuario,objRol) VALUES('".$this->getobjUsuario()."','".$this->getobjRol().");";
        if($base->Iniciar()){
            if($elid=$base->Ejecutar($sql)){
                $this->setobjUsuario($elid);// id 
                $resp=true;
            }    
            else{
                $this->setMensaje("Usuariorol -> insertar ".$base->getError());
            }

        }// fin if 
        else{
            $this->setMensaje("Usuariorol -> Insertar ".$base->getError());
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

        $sql="UPDATE Usuariorol SET objRol='".$this->getobjRol()."' WHERE objUsuario='".$this->getobjUsuario()."'";
        if($base->Iniciar()){
            if($base->Ejecutar($sql)){
                $res=true;
            }
            else{
                $this->setMensaje("Usuariorol -> Modificar ".$base->getError());
            }        
        }
        else{
            $this->setMensaje("Usuariorol -> Modificar".$base->getError());
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
        $sql="DELETE FROM Usuariorol WHERE objUsuario='".$this->getobjUsuario()."'";
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
        $sql="SELECT * FROM Usuariorol";
        if($parametro!=""){
            $sql.=' WHERE '.$parametro;
            
        }
        $res=$base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while($row=$base->Registro()){
                    $obj=new Usuariorol();
                    //$objPersona = new Persona();
                    $obj->setear($row["objUsuario"],$row["objRol"]);
                    array_push($arreglo,$obj); // carga el obj en el array 
                    
                }
            }
        }
        else{
            //$this->setMensaje("Usuariorol -> listar".$base->getError());
        }
        return $arreglo; 
    }// fin function 


}// fin clase 

   
?>