<?php
include "modelo/Registro.php";
include "helper/ValidadorForm.php";
include 'modelo/DaoRegistro.php';

class Controlador{

    private $daoRG;

    function __construct()
    {
        $this->daoRG= new DaoRegistro();
    }

    public function run()
    {
        if (!isset($_POST['enviar']))//no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario("validar",null,null);
			exit();
        } 
        if(isset($_POST['enviar']) && ($_POST['enviar']) == 'validar'){
            //valida formulario
            $this->validar();
            exit();
        }
        if(isset($_POST['enviar']) && ($_POST['enviar']) == 'continuar'){
           //terminar
           unset($_POST);//se deja limpio $_POST, un formulario limpio
           //echo 'Programa Finalizado';
           $this->mostrarFormulario("validar", null, null);
           exit();
           //
        }
       
    }
    
    /*private function mostrarFormulario()
    {
     //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_bienvenida.php';
    }*/
    private function mostrarFormulario($fase, $validador, $resultado)
    {
    // y se muestra la vista del formulario (la plantilla form_bienvenida.php)
        include 'vistas/form_bienvenida.php';
    }


    /**
     * Creamos un método para crear un array con  las reglas de validación que sean necesarias
     * las reglas de validación contirnrn restricciones pattern, required, maxLength, datosValidos 
     * tipoDocumentoValido(verificará si el documento dependiendo el que sea es válido con un pattern)
     * 
     */

     public function crearReglasDeValidacion(){
         $reglasValidacion = array(
             "nombre"=>array("maxLength"=> 30, "required"=>true),
             "apellido1"=>array("maxLength"=> 15, "required"=>true),
             "apellido2"=>array("maxLength"=> 15, "required"=>false),
             //"DNI"=>array("pattern" => "/^[0-9]{8}[a-z,A-Z]$/", "required"=>true),
             "dni"=>array("pattern" => "/^[0-9]{8}[a-z,A-Z]$/", "maxLength"=> 9,"required"=>true),
             "telf"=>array("pattern"=> "/^(6|9)[ -]*([0-9][ -]*){8}/", "maxLength" => 9,"required"=>true),//"/^(6|9)[ -]*([0-9][ -]*){8}/", "maxlength" => 9,
             "email"=>array("pattern" =>"/[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?/", "required"=>true),//"filtradoPHP"=> true
             "sexo"=>array("datosValidos"=>array("Hombre", "Mujer"),"required"=>true),
             "fechaN"=>array("pattern"=> "/^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/","required"=>true),
             "categoria"=>array("datosValidos"=>array("Cadete", "Juvenil", "Mayores"),"required"=>true),
             "lesiones[]"=>array("datosValidos"=>array("rodilla", "hombro", "tobillo", "dedos"),"required"=>false),
       
             "privacidad"=>array("required"=>true)
            );
         return $reglasValidacion;
     }

    /**
     * Método validar 
     * Realiza el proceso de validacion utilizando un Objeto de clase y el método reglasDeValidacion, creada anteriormente 
     */
    public function validar(){
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
        $datosAvalidar = $_POST;
        $validador->validar($datosAvalidar, $reglasValidacion);
        if($validador->esValido()){

            $resul = $this->daoRG->existeDeportista($datosAvalidar['dni']);
            if(is_string($resul)){
                $resultado = $resul;
            } else {
                if(!$resul){
                    $deportista = $this->crearDeportista($datosAvalidar);
                    $resultado = $this->daoRG->insertarDeportista($deportista);
                } else {
                    $resultado = "Ya existe un deportista registrado con el DNI: " . $datosAvalidar['dni'] . ", solo se pude registrar un deportista por DNI.";
                }
            }
          

            $this->mostrarFormulario("continuar", $validador, $resultado);
            exit();
        }  
        //Si el formulario no es válido, mostrarlo nuevamente con los errores
        $this->mostrarFormulario("validar", $validador, null);
        exit();                                                                                                                                                                                                                                                                                                                                                      
    }

    
    /**
     * Función que filtra los datos y crea un obj Registro
     * 
     * @param array $datos array con los datos validados del $_POST(datos del formulario para crear el registro de deportistas)
     * 
     * @return Registro devuelve un obj Registro
     */

    private function crearDeportista($datos){
        foreach ($datos as $value) {
            $datos[] = Input::filtrarDato($value);
        }
        return new Registro($datos['nombre'], $datos['apellido1'], $datos['apellido2'], $datos['dni'], $datos['sexo'], $datos['telf'], $datos['email'],$datos['fechaN'], $datos['categoria'], (isset($datos['lesiones']) ? implode(', ',$datos['lesiones']) : null), $datos['privacidad']);
    }
}
