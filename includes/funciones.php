<?php
    // fichero con funciones de ayuda (helpers)
    function verArray($array)
    {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

    // Validar dni con php
    function validarDni($dni){
        $letra = substr($dni, -1);
        $numeros = substr($dni, 0, -1);
        $valido =true;
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
          $valido=true;
        }else{
          $valido=false;
        }
        return $valido;
      }

?>
