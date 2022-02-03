<?php

class ValidadorForm{
    private $errores;
    private $reglasValidacion;
    private $valido;

    public function __construct()
    {
       $this->errores = array();
       $this->reglasValidacion = null;
       $this->valido = false; 
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
                        $this->valido= false;
                    }
                }
                if ($nombre == 'pattern') {
                    if(preg_match($regla, $dato) === 0){
                        if ($campo === 'dni') {
                            $this->addErrores($campo, "El patron de DNI no es correcto, debe consistir en 8 números y 1 letra.");
                            $this->valido = false;
                        }
                        if ($campo === 'telf') {
                            $this->addErrores($campo, "El patron del teléfono no es correcto, debe consistir en 9 números y que empieze por 6 o 9.");
                            $this->valido = false;
                        }
                        if ($campo === 'email') {
                            $this->addErrores($campo, "Por favor, introduzca un $campo valido.");
                            $this->valido = false;
                        }
                    }
                }

                if($nombre === "maxLength" ){
                    if(strlen($dato) > $regla){
                        $this->addErrores($campo, "El campo $campo no debe contener más de $regla caracteres");
                        $this->valido= false;
                    }
                }
                if ($nombre === 'datosValidos') {
                    if(is_array($dato)){
                        foreach ($dato as $value) {
                            if($value !== ""){
                                if(!in_array($value, $regla)) {
                                    $this->addErrores($campo, "El campo $campo no contiene ese valor.");
                                    $this->valido = false;
                                }
                            }
                        }
                    } else {
                        if($dato !== ""){
                            if(!in_array($dato, $regla)) {
                                $this->addErrores($campo, "El campo $campo no contiene ese valor.");
                                $this->valido = false;
                            }
                        }
                    }
                }

                if($nombre === "tipoDocumentoValido"){
                    
                    if (!empty($_POST['documento'])){
                        $documento = $_POST['documento'];
                        $dni = $_POST['dni'];
                        if($documento == "dni"){
                           if( !validarDni($dni)){
                            $this->addErrores($campo, "El campo $campo no cumple con el formato correcto");
                           
                        }}
                            
                        }  


                }
          }
        }
        //si no contiene errores se da por valido, y el parametro valido pasa a ser true
        if(count($this->errores) == 0){
        $this->valido =true;
        }
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
    
    /**
     * Devuelve los errores encontrados
     */
    public function getErrores(){
        return $this->errores;
    
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