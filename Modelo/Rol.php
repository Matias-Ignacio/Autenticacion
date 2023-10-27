<?php
    class Rol{
        private $idrol;
        private $rodescripcion;
        private $mensaje;

        // constructor
        public function __construct()
        {
            $this->idrol=0;
            $this->rodescripcion="";
    
        }// fin constructor 

        // METODO SETEAR
        public function setear($idrol,$rodescripcion){
            $this->setidrol($idrol);
            $this->setrodescripcion($rodescripcion);

        }// fin setear

        // METODOS GET
        public function getidrol(){
            return $this->idrol; 
        }
        public function getrodescripcion(){
            return $this->rodescripcion; 
        }
        public function getMensaje(){
            return $this->mensaje; 
        }
        

        // METODOS SET
        public function setidrol($nro){
            $this->idrol=$nro;
        }
        public function setrodescripcion($name){
            $this->rodescripcion=$name;
        }
        public function setMensaje($msj){
            $this->mensaje=$msj;
        }
   /**
     * retorna un arreglo con los atributos del objeto
     * @return array
     */
    public function getDatos(){
        $ID = $this->getidrol();
        $nom = $this->getrodescripcion();
        $array = ["$ID","$nom"];
        return $array;
    }


        // METODO CARGAR
        public function cargar(){
            $resp=false;
            $base=new BaseDatos("autenticacion");
            $sql="SELECT * FROM rol WHERE idrol=".$this->getidrol();  
            if($base->Iniciar()){
                $res=$base->Ejecutar($sql);
                if($res>-1){
                    if($res>0){
                        $row=$base->Registro();
                        $this->setear($row["idrol"], $row["rodescripcion"]);
                        $resp=true; 

                    }
                }
            }
            else{
                $this->setMensaje("rol -> ".$base->getError());
            }
            return $resp; 
        }// fin function cargar            

        
        // METODO INSERTAR 
        public function insertar(){
            $resp=false;
            $base=new BaseDatos("autenticacion");
            $sql="INSERT INTO rol (idrol, rodescripcion) 
            VALUES (".$this->getidrol()."','".$this->getrodescripcion()."')";
            if($base->Iniciar()){
                if($elid=$base->Ejecutar($sql)){
                    $this->setidrol($elid); 
                    $resp=true;

                }
                else{
                    $this->setMensaje("rol -> insertar ".$base->getError());
                }

            }
            else{
                $this->setMensaje("rol -> Insertar".$base->getError());
            }
            return $resp;

        }// fin insertar

        // METODO MODIFICAR
        public function modificar(){
            $resp=false; 
            $base=new BaseDatos("autenticacion");
            $sql="UPDATE rol SET idrol='".$this->getidrol()."' WHERE rodescripcion=".$this->getrodescripcion();
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $resp=true;
                }
                else{
                    $this->setMensaje("rol -> Modificar".$base->getError());
                }
            }
            else{
                $this->setMensaje("rol -> Modificar".$base->getError());
            }
            return $resp;
        }// fin modificar


        // METODO ELIMINAR 
        public function eliminar(){
            $resp=false;
            $base=new BaseDatos("autenticacion");
            $sql="DELETE FROM rol WHERE idrol=".$this->getidrol()."";
            if($base->Iniciar()){
                if($base->Ejecutar($sql)){
                    $resp=true;
                }
                else{
                    $this->setMensaje("rol -> Eliminar ".$base->getError());
                }
                
            }
            else{
                $this->setMensaje("rol -> Eliminar ".$base->getError());
            }
            return $resp;
        }// fin eliminar

        // METODO LISTAR
        public static function listar($parametro=""){
            $arreglo=array();
            $base=new BaseDatos("autenticacion");
            $sql="SELECT * FROM rol ";
            if($parametro!=""){
                $sql.='WHERE '.$parametro;
            }
            $res=$base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    while($row=$base->Registro()){
                        $obj=new Rol();
                        $obj->setear($row["idrol"], $row["rodescripcion"]);
                        array_push($arreglo,$obj);
                    }
                }
            }
            return $arreglo; 
        }// fin listar

    }// fin clase 
  
?>