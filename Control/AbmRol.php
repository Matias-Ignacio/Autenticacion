<?php

class AbmRol {
    /** METODOS DE LA CLASE */
    // METODO ABM QUE LLAMA A LOS METODOS CORRESPONDIENTES SEGUN SI SE DA DE ALTA
    // BAJA O MODIFICA
    /**@return boolean */
    public function abmRol($datos){
        $resp = false;
        if($datos['accion']=='editar'){
            if($this->modificacion($datos)){
                $resp = true;
            }
        }
        if($datos['accion']=='borrar'){
            if($this->baja($datos)){
                $resp =true;
            }
        }
        if($datos['accion']=='nuevo'){
            if($this->alta($datos)){
                $resp =true;
            }
            
        }
        return $resp;

    }// fin metodo abmRol

    /**
     * Espera un Array asociativo y devuelve el obj de la tabla
     * @param array $datos
     * @return Rol
     */
    private function cargarObjeto($datos){
        $obj=null; 
        
        if(array_key_exists('idusuario',$datos) && array_key_exists('idrol',$datos)){
            
            $obj=new Rol();
            $obj->setear($datos['idusuario'],$datos['idrol']);
            
            
            
        }// fin if 
        return $obj; 
    }// fin function 


    /**
     * Espera como parametro un array asociativo donde las claves coinciden  con los atributos 
     * @param array $datos
     * @return Rol
     */
    private function cargarObjetoConClave($datos){
        $obj=null;
        if(isset($datos['idrol'])){
            $obj=new Rol();
            $obj->setear($datos['idrol'],$datos['rodescripcion']);

        }// fin if 
        return $obj;

    }// fin function 

    /**
     * corrobora que dentro del array asociativo estan seteados los campos
     * @param array $datos
     * @return boolean
     */
    private function setadosCamposClaves($datos){
        $resp=false;
        if(isset($datos['idrol']) && isset($datos['rodesripcion'])){
            $resp=true;

        }// fin if 

        return $resp;

    }// fin function 

    /**
     * METODO ALTA
     * @param array $datos
     * @return boolean
     */
    public function alta($datos){
        $resp=false;
        $objRol=$this->cargarObjeto($datos);
        if($objRol!=null && $objRol->insertar()){
            $resp=true;

        }// fin if 
        return $resp;

    }// fin function 

    /**
     * PERMITE ELIMINAR UN OBJ AUTO
     * @param array $datos
     * @return boolean
     */
    public function baja($datos){
        $resp=false;
        if($this->setadosCamposClaves($datos)){
            $objRol=$this->cargarObjetoConClave($datos);
            if($objRol!=null && $objRol->eliminar()){
                $resp=true;

            }// fin if 


        }// fin if 

        return $resp; 

    }// fin function 

    /**
     * MOFICAR EL OBJ AUTO
     * @param array $datos
     * @return boolean
     */
    public function modificacion($datos){
        $resp=false;
        if($this->setadosCamposClaves($datos)){
            $objRol=$this->cargarObjeto($datos);
            if($objRol!=null && $objRol->modificar()){
                $resp=true; 

            }// fin if 

        }// fin if 

        return $resp; 

    }// fin function 

 /**
     * METODO BUSCAR
     * Si el parametro es null, devolverá todos los registros de la tabla rol
     * si se llena con los campos de la tabla devolverá el registro pedido
     * @param array $param
     * @return Rol
     */
    public function buscar ($param){
        $objRol=new Rol();
        $where=" true ";
        if($param<>null){
            // Va preguntando si existe los campos de la tabla 
            if(isset($param['idrol'])){ // evalua si existe el rol con la primary key
                $where.="and idrol = ".$param['idrol']." ";
               /*
                if(isset($param['rodescripcion'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and rodescripcion ='".$param['rodescripcion']."'";
                }// fin if 
                */

            }// fin if 
        }// fin if
        
        $objRol->listar($where);

        return $objRol; 

    }// fin funcion     



}// fin clase AbmRol

?>