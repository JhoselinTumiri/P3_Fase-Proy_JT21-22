<?php
include "includes/funciones.php";
include "helper/Input.php";
include "helper/ValidadorForm.php";
class Controlador
{
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
        $validador->validar($_POST, $reglasValidacion);
        if($validador->esValido()){
            //Formulario correcto, recoger datos
            //volver a mostrar formulario con resultado correcto
    
            $resultado = "";
            //el formulario ya se ha enviado
            //se recogen y procesan los datos
            
            if (!empty($_POST['apellido1']) && !empty($_POST['apellido2']) && !isset($_POST['sin2AP'])){
                $nombre = Input::filtrarDato($_POST['nombre']);
                $apellido1=Input::filtrarDato($_POST['apellido1']);
                $apellido2 = Input::filtrarDato($_POST['apellido2']); 
                $completo= "$nombre $apellido1 $apellido2 se ha resgistrado correctamente<br />";
                }
             if(!empty($_POST['apellido1']) && isset($_POST['sin2AP'])){
                    $nombre = Input::filtrarDato($_POST['nombre']);
                    $apellido1=Input::filtrarDato($_POST['apellido1']);
                    $completo = "$nombre $apellido1 se ha registrado correctamente"; 
                }
            else if(!empty($_POST['apellido1']) && empty($_POST['apellido2'])){
                $nombre = Input::filtrarDato($_POST['nombre']);
                $apellido1=Input::filtrarDato($_POST['apellido1']);
                $completo = "$nombre $apellido1 se ha registrado correctamente"; 
            }
            $resultado .=  strtoupper($completo);
            $resultado .= "<p>Los datos registrados son los siguientes</p> ";
           
            $array = array(
                
               
                "DNI: " => Input::filtrarDato($_POST['dni']) ?? "",
                "Genero: " => Input::filtrarDato($_POST['sexo']) ?? "",
                "Teléfono: " => Input::filtrarDato($_POST['telf']) ?? "",
                "Direccion: " =>Input::filtrarDato( $_POST['email']) ?? "",
                "Fecha de Nacimiento: " => Input::filtrarDato($_POST['fechaN']) ?? "",
                "Categoria : " => Input::filtrarDato($_POST['categoria']) ?? "",
                "Email: " => Input::filtrarDato($_POST['email']) ?? "",
                "Presenta las siguientes lesiones: <br>Lesión en:" => isset($_POST['lesiones'])? implode(', ',$_POST['lesiones']) : "NO PRESENTA LESIÓN ALGUNA" 
            );
            foreach ($array as $key => $value) {
                
                if(isset($value) && $value !== ""){
                    $resultado .= "$key $value <br>";
                
                }
            }

          

            $this->mostrarFormulario("continuar", $validador, $resultado);
            exit();
        }  
        //Si el formulario no es válido, mostrarlo nuevamente con los errores
        $this->mostrarFormulario("validar", $validador, null);
        exit();                                                                                                                                                                                                                                                                                                                                                      
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
}
