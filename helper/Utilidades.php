<?php

class Utilidades{

    /**
     * Comprueba la función de los controles (botones)
     * Recupera valores correctos introducidos.
     * comprobar valor boton ratio
     */
     public static function verificaControlRadio( $valor, $valorMenu) {

        $verifica = "";

        if($valor == $valorMenu){
            $verifica = "checked";
        }

        return $verifica;
    }

    /**
     * En el caso de que se tratase de la verificación de botones de un array
     * Se recorre el array y se comprueba
     */

    public static function verificaCheckbox($valores, $valorMenu)
     {
         $verifica = "";

         if($valores !== ""){
            if(is_array($valores)){
                foreach($valores as $valor){
                    if($valor == $valorMenu){
                        $verifica = "checked";
                    }
                }
            }
         }

         return $verifica;
     }

    
}






























?>