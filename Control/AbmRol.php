<?php
    class AbmRol{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Rol
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idrol',$param) and array_key_exists('rodescripcion',$param)){
            $obj = new Rol(); // llama a la capa modelo 
            $obj->setear($param["idrol"],$param["rodescripcion"]);

        }
        return $obj;
    }// fin cargarObjeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Rol
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idrol']) ){
            $obj = new Rol();
            $obj->setear($param['idrol'], null);
        }
        return $obj;
    }// fin function cargarObjetoConClave


    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
     private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idrol']))
            $resp = true;
        return $resp;
    }// fin seteadoCamposClaves

    /**
     * METODO ALTA Rol
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $elObjtRol = $this->cargarObjeto($param);
        if ($elObjtRol!=null and $elObjtRol->insertar()){
            $resp = true;
        }
        return $resp;
        
    } // fin function alta

    /**
     * METODO ELIMINAR Rol 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjRol = $this->cargarObjetoConClave($param);
            if ($elObjRol!=null and $elObjRol->eliminar()){
                $resp = true;
            }
        } 
        return $resp;
    }// fin functio baja
        
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjRol = $this->cargarObjeto($param);
            if($elObjRol!=null and $elObjRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }// fin function modificacion


    /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where =" true ";
        if ($param<>NULL){
            if  (isset($param['idrol']))
                $where.=" and idrol = '".$param['idrol']."'";
            if  (isset($param['rodescripcion']))
                 $where.=" and rodescripcion = '".$param['rodescripcion']."'";                 
        }// fin if <> null
        $arreglo = Rol::listar($where);  
    
        return $arreglo;
    }// fin function buscar


    }// fin clase 

?>
