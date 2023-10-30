<?php

class AbmRolUsuario{
      /** METODOS DE LA CLASE */
    // METODO ABM QUE LLAMA A LOS METODOS CORRESPONDIENTES SEGUN SI SE DA DE ALTA
    // BAJA O MODIFICA
    /**@return boolean */
    public function abmRolUsuario($datos){
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
     * @return UsuarioRol
     */
    private function cargarObjeto($datos){
        $objUser=null;
        $objRol=null;
        $objUserRol=null; 
        
        if(array_key_exists('idusuario',$datos) && $datos['idusuario']!=null){
            
            $objUser=new Usuario();
            $objUser->setId($datos['idusuario']);// para que despues pueda usar el metodo cargar que buscar por ID
            $objUser->cargar(); // carga los demas datos del usuario
        }// fin if 

        if(array_key_exists('idrol',$datos) && $datos['idrol']!=null){
            $objRol=new Rol();
            $objRol->setId($datos['idrol']); // seteo el id de rol para despues buscarlo con el metodo cargar
            $objRol->cargar();  
        }// fin if
        
        $objUserRol=new UsuarioRol();
        $objUserRol->setear($objUser,$objRol); 

        return $objUserRol;
    }// fin function 


    /**
     * Espera como parametro un array asociativo donde las claves coinciden  con los atributos 
     * @param array $datos
     * @return UsuarioRol
     */
    private function cargarObjetoConClave($datos){
        $obj=null;
        if(isset($datos['idusuario']) && isset($datos['idrol'])){
            $objUser=new Usuario();
            $objRol=new Rol();
            $objUser->setId($datos['idusuario']); 
            $objRol->setId($datos['idrol']);
            // carga los obj con el ID
            $objUser->cargar(); 
            $objRol->cargar();  
            $obj = new UsuarioRol;
            $obj->setear($objUser,$objRol);

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
        if(isset($datos['idusuario']) && isset($datos['idrol']) ){
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
        $objUsuarioRol=$this->cargarObjeto($datos);
        if($objUsuarioRol!=null && $objUsuarioRol->insertar()){
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
            $objUsuarioRol=$this->cargarObjetoConClave($datos);
            if($objUsuarioRol!=null && $objUsuarioRol->eliminar()){
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
            $objUsuarioRol=$this->cargarObjeto($datos);
            if($objUsuarioRol!=null && $objUsuarioRol->modificar()){
                $resp=true; 

            }// fin if 

        }// fin if 

        return $resp; 

    }// fin function 

 /**
     * METODO BUSCAR
     * Si el parametro es null, devolverá todos los registros de la tabla auto 
     * si se llena con los campos de la tabla devolverá el registro pedido
     * @param array $param
     * @return array
     */
    public function buscar ($param){

        $objUsuarioRol=new UsuarioRol();
        $where=" true ";
        if($param<>null){
            // Va preguntando si existe los campos de la tabla 
            if(isset($param['idusuario'])){ // evalua si existe el auto con la primary key
                $where.="and idusuario='".$param['idusuario']."'";
                if(isset($param['idrol'])){// identifica si esta la clave (atributo de la tabla)
                    $where.="and idrol ='".$param['idrol']."'";
                }// fin if 

            }// fin if 
        }// fin if
        $arreglo=$objUsuarioRol->listar($where);

        return $arreglo; 

    }// fin funcion     


}// fin clase AbmUsuarioRol



?>