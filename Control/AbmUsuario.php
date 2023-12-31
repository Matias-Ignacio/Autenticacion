<?php

class AbmUsuario{

    /** METODOS DE LA CLASE */
    // METODO ABM QUE LLAMA A LOS METODOS CORRESPONDIENTES SEGUN SI SE DA DE ALTA
    // BAJA O MODIFICA
    /**@return boolean */
    public function abmUsuario($datos){
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
     * @return Usuario
     */
    private function cargarObjeto($datos){
        $obj=null; 
        
        if(array_key_exists('idusuario',$datos) && array_key_exists('idrol',$datos)){
            
            $obj=new Usuario();
            $obj->setear($datos['idusuario'],$datos['usnombre'],$datos['uspass'],$datos['usmail'],$datos['usdeshabilitado']);
            
            
            
        }// fin if 
        return $obj; 
    }// fin function 


    /**
     * Espera como parametro un array asociativo donde las claves coinciden  con los atributos 
     * @param array $datos
     * @return Usuario
     */
    private function cargarObjetoConClave($datos){
        $obj=null;
        if(isset($datos['idusuario'])){
            $obj=new Usuario();
            $obj->setear($datos['idusuario'],$datos['usnombre'],$datos['uspass'],$datos['usmail'],$datos['usdeshabilitado']);

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
        if(isset($datos['idusuario']) && isset($datos['usnombre']) && isset($datos['uspass']) && isset($datos['usmail']) && isset($datos['usdeshabilitado'])){
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
        $objUsuario=$this->cargarObjeto($datos);
        if($objUsuario!=null && $objUsuario->insertar()){
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
            $objUsuario=$this->cargarObjetoConClave($datos);
            if($objUsuario!=null && $objUsuario->eliminar()){
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
            $objUsuario=$this->cargarObjeto($datos);
            if($objUsuario!=null && $objUsuario->modificar()){
                $resp=true; 

            }// fin if 

        }// fin if 

        return $resp; 

    }// fin function 

 /**
     * METODO BUSCAR
     * Si el parametro es null, devolverá todos los registros de la tabla usuario 
     * si se llena con los campos de la tabla devolverá el registro pedido
     * @param array $param
     * @return array
     */
    public function buscar ($param){
        $objUsuario=new Usuario();
        $where=" true ";
        if($param<>null){
            // Va preguntando si existe los campos de la tabla 
            if(isset($param['idusuario'])){ // evalua si existe el usuario con la primary key
                $where.="and idusuario='".$param['idusuario']."'";
                if(isset($param['usnombre'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and usnombre ='".$param['usnombre']."'";
                }// fin if 
                if(isset($param['uspass'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and uspass ='".$param['uspass']."'";
                }// fin if 
                if(isset($param['usmail'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and usmail ='".$param['usmail']."'";
                }// fin if 
                if(isset($param['usdeshabilitado'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and usdeshabilitado ='".$param['usdeshabilitado']."'";
                }// fin if 

            }// fin if 
        }// fin if
        $arreglo=$objUsuario->listar($where);
        return $arreglo; 

    }// fin funcion     


    /** METODO USUARIO 
     * @return array
     */
    public function listarUsuarioRol($param){
        $objUsuarioRol=new UsuarioRol();
        $where=' true '; 
        if($param!=null){
            if(isset($param['idusuario'])){
                $where.=" and idusuario='".$param['idusuario']."'";
            }// fin if 
            if(isset($param['idrol'])){
                $where.=" and idrol='".$param['idrol']."'";
            }// fin if 

        }// fin if 
        $arrayRolUsuarios=$objUsuarioRol->listar($where);
        return $arrayRolUsuarios; 
    }// fin function 






 /**
     * METODO BUSCAR
     * Si el parametro es null, devolverá todos los registros de la tabla usuario 
     * si se llena con los campos de la tabla devolverá el registro pedido
     * @param array $param
     * @return array
     */
    public function buscar_2 ($param){
        $objUsuario=new Usuario();
        $where=" true ";
        if($param<>null){
            // Va preguntando si existe los campos de la tabla 
            if(isset($param['idusuario'])){
                $where.="and idusuario='".$param['idusuario']."'";
            }
            if(isset($param['usnombre'])){
                $where.=" and usnombre ='".$param['usnombre']."'";
            }// fin if 
            if(isset($param['uspass'])){
                $where.=" and uspass ='".$param['uspass']."'";
            }// fin if 
            if(isset($param['usmail'])){
                $where.=" and usmail ='".$param['usmail']."'";
            }
            if(isset($param['usdeshabilitado'])){
                $where.=" and usdeshabilitado ='".$param['usdeshabilitado']."'";
            }


        }// fin if
        //var_dump($where);
        $arreglo=$objUsuario->listar($where);
        
        return $arreglo; 

    }// fin funcion    



}// fin clase AbmUsuario

?>