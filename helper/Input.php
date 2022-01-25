<?php
//include "index.php";

class Input{
    /**
     * Devuelve true si hay datos, cuando se hecho un envio de datos por $_POST
     * Si no se ha enviado devuelve false
     */

    public static function  siEnviado(){

        // return (!empty($_POST)) ? true : false;
        
        if (!isset($_POST)){
            return false;
        }
        else{
            return true;
        }
    }

    /** 
     * El método con párametro get($dato) devuelve el dato saneado y filtrado
     * En caso de que el dato esté definido lo devuelve, caso contrario devuelve ""
     * @return string o array $campo : limpio y filtrado
     */

    public static function get($dato){

        if(isset($_POST[$dato])){
            $campo = $_POST[$dato];
            $campos = Input::filtrarDato($campo);
        }
        else{
            $campos = "";
        }
        return $campos;
    }

    /**
     * Devuelve $datos saneados diferenciando si es un ARRAY o un dato simple 
     * 
     */
    public static function filtrarDato($datos){
        
        if(is_array($datos)){
            if(isset($datos)){
                $datosFiltrados=array();
                foreach($datos as $dato){
                    /**
                     * htmlspecialchars(), devuelve un string libre de carácteres especiales, convirtiendo estos de html(maliciosos o no)
                     * que cuando se muestre por pantalla o se guarde sea como un string.
                     */
                    $dato = htmlspecialchars($dato);

                    // Retira las etiquetas HTML y PHP de un string
                    // Esta función intenta devolver un string con todos los bytes NULL y las etiquetas HTML y PHP retirados de un str
                    // dado. Se utiliza la misma máquina de estado de retirado de etiquetas que la función fgetss().
                    $dato = strip_tags($dato);
                    //trim(), su función es eliminar espacios en blanco, tabulaciones, saltos de linea, nulls, retornos de carro en un string 
                    //$dato = trim($dato);
                    //array_push - Inserta uno o más elemntos al final de un array.
                    array_push($datosFiltrados, $dato);
                }
            }
         }
         else {
            //En el caso de que no se tratase de un array
            $datos = htmlspecialchars($datos);
            $datos = strip_tags($datos);
            $datos = trim($datos);
            $datosFiltrados = $datos;

         }
        return $datosFiltrados;
    }
}

?>