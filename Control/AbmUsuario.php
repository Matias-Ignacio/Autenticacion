<?php

    class AbmReloj{

        /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return Reloj
     */
    private function cargarObjeto($param){
        $obj = null;
           
        if( array_key_exists('idReloj',$param) and array_key_exists('nombreReloj',$param) and 
        array_key_exists('precio',$param) and array_key_exists('idTipo',$param) and 
        array_key_exists('idMarca',$param) and array_key_exists('precio',$param) ){
            $obj = new Reloj(); 
            $objTipo = new Tipo();
            $objTipo->setidTipo($param['idTipo']);
            $objMarca = new Marca();
            $objMarca->setidMarca($param['idMarca']);
            $obj->setear($param["idReloj"],$param["nombreReloj"],$param["precio"],$objTipo,$objMarca);

        }
        return $obj;
    }// fin cargarObjeto




    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto que son claves
     * @param array $param
     * @return Reloj
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        
        if( isset($param['idReloj']) ){
            $obj = new Reloj();
            $obj->setear($param['idReloj'],null,null,null,null);
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
        if (isset($param['idReloj']))
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
        $elObjReloj = $this->cargarObjeto($param);
        if ($elObjReloj!=null and $elObjReloj->insertar()){
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
            $elObjReloj = $this->cargarObjetoConClave($param);
            if ($elObjReloj!=null and $elObjReloj->eliminar()){
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
            $elObjReloj = $this->cargarObjeto($param);
            if($elObjReloj!=null and $elObjReloj->modificar()){
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
            if  (isset($param['idReloj']))
            $where.=" and idReloj = '".$param['idReloj']."'";
            if  (isset($param['nombreReloj']))
                 $where.=" and nombreReloj = '".$param['nombreReloj']."'";
            if  (isset($param['precio']))
                 $where.=" and precio = '".$param['precio']."'";
            if  (isset($param['idTipo']))
                 $where.=" and idTipo = '".$param['idTipo']."'";    
            if  (isset($param['idMarca']))
                 $where.=" and idMarca = '".$param['idMarca']."'";                     
            }// fin if <> null
            echo("<br>"); 
           // var_dump($where); 
            $arreglo = reloj::listar($where);  
            
        return $arreglo;
    }// fin function buscar


    }// fin clase 

?>