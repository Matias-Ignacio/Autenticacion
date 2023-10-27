<?php
    class AbmMarca{

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return $obj
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idMarca',$param) and array_key_exists('nombreMarca',$param)){
            $obj = new Marca(); // llama a la capa modelo 
            $obj->setear($param["idMarca"],$param["nombreMarca"]);

        }
        return $obj;
    }// fin cargarObjeto

    
    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return $obj
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idMarca']) ){
            $obj = new Marca();
            $obj->setear($param['idMarca'], null);
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
        if (isset($param['idMarca']))
            $resp = true;
        return $resp;
    }// fin seteadoCamposClaves

    /**
     * METODO ALTA Marca
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $elObjtMarca = $this->cargarObjeto($param);
        if ($elObjtMarca!=null and $elObjtMarca->insertar()){
            $resp = true;
        }
        return $resp;
        
    } // fin function alta

    /**
     * METODO ELIMINAR Marca 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjMarca = $this->cargarObjetoConClave($param);
            if ($elObjMarca!=null and $elObjMarca->eliminar()){
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
            $elObjMarca = $this->cargarObjeto($param);
            if($elObjMarca!=null and $elObjMarca->modificar()){
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
            if  (isset($param['idMarca']))
                $where.=" and idMarca = '".$param['idMarca']."'";
            if  (isset($param['nombreMarca']))
                 $where.=" and nombreMarca = '".$param['nombreMarca']."'";                 
        }// fin if <> null
        $arreglo = marca::listar($where);  
       // var_dump($where);
        return $arreglo;
    }// fin function buscar


    }// fin clase 

?>
