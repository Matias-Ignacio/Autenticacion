<?php

    class AbmUsuario{

        /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Usuario
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idusuario',$param) and array_key_exists('usnombre',$param) and 
        array_key_exists('uspass',$param) and array_key_exists('usmail',$param) and 
        array_key_exists('usdeshabilitado',$param) ){
            $obj = new Usuario(); 

            $obj->setear($param["idusuario"],$param["usnombre"],$param["uspass"],$param["usmail"],$param["usdeshabilitado"]);

        }
        return $obj;
    }// fin cargarObjeto




    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Usuario
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idusuario']) ){
            $obj = new Usuario();
            $obj->setear($param['idusuario'],null,null,null,null);
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
        if (isset($param['idusuario']))
            $resp = true;
        return $resp;
    }// fin seteadoCamposClaves


    /**
     * METODO ALTA Tipo
     * @param array $param
     * @return boolean
     */
    public function alta($param){
        $resp = false;
        $elObjUsuario = $this->cargarObjeto($param);
        if ($elObjUsuario!=null and $elObjUsuario->insertar()){
            $resp = true;
        }
        return $resp;
        
    } // fin function alta



    /**
     * METODO ELIMINAR Tipo 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjUsuario = $this->cargarObjetoConClave($param);
            if ($elObjUsuario!=null and $elObjUsuario->eliminar()){
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
            $elObjUsuario = $this->cargarObjeto($param);
            if($elObjUsuario!=null and $elObjUsuario->modificar()){
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
            if  (isset($param['idusuario']))
            $where.=" and idusuario = '".$param['idusuario']."'";
            if  (isset($param['usnombre']))
                 $where.=" and usnombre = '".$param['usnombre']."'";
            if  (isset($param['uspass']))
                 $where.=" and uspass = '".$param['uspass']."'";
            if  (isset($param['usmail']))
                 $where.=" and usmail = '".$param['usmail']."'";    
            if  (isset($param['usdeshabilitado']))
                 $where.=" and usdeshabilitado = '".$param['usdeshabilitado']."'";                     
            }// fin if <> null
            echo("<br>"); 
           
            $arreglo = Usuario::listar($where);  
            
        return $arreglo;
    }// fin function buscar


    }// fin clase 

?>