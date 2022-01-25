<?php

class ValidadorForm{
    private $errores;
    private $reglasValidacion;
    private $valido;

    public function __construct()
    {
       $errores = array();
       $reglasValidacion = null;
       $valido = false; 
    }

    public function validar($fuente, $reglasValidacion){

        $this->reglasValidacion = $reglasValidacion;
        //Se recorre las reglasValidacion 
        foreach($this->reglasValidacion as $campo => $reglas){
        //recorre el array de reglas entre el nombre y la regla
          foreach($reglas as $nombre => $regla){
            //En caso de ser un array se quitan los corchetes 
            if($campo =="lesiones[]"){
                $campo = "lesiones";
            }

            //Se comprueba si los datos estan definidos
            if(isset($fuente[$campo])){
                $dato = $fuente[$campo];
            }
            else{
                $dato = "";
            }

            //Comprobamos si las reglas de validacion son correctas y cumplen la validacion
            //caso contrario se añade al array errores el error en el campo correspondiente. 
                if( $nombre == "required" && $regla == true){
                    if (empty($dato)){
                        $this->addErrores($campo, "El campo $campo es requerido");
                    }
                }

                if($nombre == "maxLength" && $regla == $fuente[$campo]){
                    if($dato < $fuente[$campo]){
                        $this->addErrores($campo, "El campo $campo debe ser mayor a $fuente[$campo] caracteres");
                    }
                }

                if($nombre == "tipoDocumentoValido" && $regla == true){
                    
                    if (!empty($_POST['documento'])){
                        $documento = $_POST['documento'];
                        $tipo="";
                        switch($documento){
                            CASE "dni": $tipo= "dni";
                            break;
                            CASE "nif": $tipo = "nif";
                            break;
                            
                        }
                        if($tipo == "dni"){
                          if( !validarDni("dni")){
                               $error="Introduzca un dni correcto";
                            }
                        }
                        if($tipo == "nif"){
                            if( !validarNif("nif")){
                                 $error="Introduzca un nif correcto";
                              }
                          }
                         
                        }  
                }
          }
        }
       // $this->valido
    }
    /**
     * Añade error al array $errores en la clave asignada campos 
     */
    public function addErrores($nombreCampo, $error){

        $this->errores[$nombreCampo] = $error;

    }

    /**
     * Devuelve el valor de la propiedad valido
     */
    public function esValido(){
        return $this->valido;
    }

    public function getErrores(){
        return $this-> errores;
    
    }
    /**
     * Si esta definido en el array $errores la clave $campo devuelve el valor del array de esa clave
     */
    public function getMesajeErrores($campo){
            $error = "";
            if(isset($this->errores)){
                $error = $this->errores[$campo];
            }
            return $error;
    }
}

?>