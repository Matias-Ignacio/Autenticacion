<?php 
function data_submitted() {
    $_AAux= array();
    if (!empty($_POST))
        $_AAux =$_POST;
        else
            if(!empty($_GET)) {
                $_AAux =$_GET;
            }
        if (count($_AAux)){
            foreach ($_AAux as $indice => $valor) {
                if ($valor=="")
                    $_AAux[$indice] = 'null' ;
            }
        }
        return $_AAux;
        
}
function verEstructura($e){
    echo "<pre>";
    print_r($e);
    echo "</pre>"; 
}


// NUEVA FORMA DE USAR EL METODO AUTOLOAD
spl_autoload_register(function ($clase) {
     //echo "Cargamos la clase  ".$clase."<br>" ;
     //echo($GLOBALS['ROOT']."<br>");
     $directorys = array(
         $GLOBALS['ROOT'].'Modelo/',
         $GLOBALS['ROOT'].'Control/',
         $GLOBALS['ROOT'].'Modelo/conector/',
         $GLOBALS['ROOT'].'util/',
     );
      //print_r($directorys) ;
     foreach($directorys as $directory){
        //echo($directory.$clase.'.php'."<br>");
         if(file_exists($directory.$clase .'.php')){
              //echo "se incluyo".$directory.$clase .'.php <br>';
             require_once($directory.$clase . '.php');
             return;
         }
     }
 
 
 });



?>