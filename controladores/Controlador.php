<?php
include "includes/funciones.php";
class Controlador
{
    public function run()
    {
        if (!isset($_POST['enviar']))//no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario(null);
			exit();
        } else
        {
            $resultado ="<center><b> COMPROBANTE DE INSCRIPCIÓN</b></center></br>";
            //el formulario ya se ha enviado
            //se recogen y procesan los datos
            //se llama al método para mostrar el resultado
            if (!empty($_POST['nombre'])){
            $nombre=$_POST['nombre'];
            $resultado .= " $nombre ";
            }

            //Mostrar un apellido
            //Se registra el primer apellido en caso de que se haya marcado la casilla Sin 2Ap 
            if (!empty($_POST['apellido1']) && empty($_POST['apellido2']) && isset($_POST['sin2AP'])){
            $apellido1=$_POST['apellido1'];
            $resultado .= " $apellido1 se ha registrado correctamente <br />";
            }

            //Mostrar los 2 apellidos
            if (!empty($_POST['apellido1']) && !empty($_POST['apellido2'])){
                $apellido1=$_POST['apellido1'];
                $apellido2=$_POST['apellido2'];
                $resultado .= " $apellido1 $apellido2 se ha resgidtrado correctamente<br />";
                }

            //Mostrar tipo de documento elegido
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
               
                 

                $resultado .= "</br>DNI/NIF = $tipo <br />";
                }  
            
            //Mostrar teléfono
            if (!empty($_POST['telf'])){
                $telf = $_POST['telf'];
                $resultado .= "</br>Contacto  = $telf <br />";
                }
            
            //Mostrar Correo, comprobando que se encuentre. 
            if (!empty($_POST['email'])){
                $email = $_POST['email'];
                $resultado .= "</br>Correo electrónico = $email <br />";
                }
            //Comprobar el tipo de sexo
            if (isset($_POST['sexo'])) {
                $sexo = $_POST['sexo'];
                $resultado .= " <br>Sexo:  ";
                switch ($sexo) {
                    case "hombre":
                        $resultado .= "HOMBRE ";
                        break;
                    case "mujer":
                        $resultado .= "MUJER";
                        break;
                }
            }

            //Comprobar la categoria a la que corresponde
            if (isset($_POST['categoria'])) {
                $categoria = $_POST['categoria'];
                $resultado .= " <br>Categoria a la que corresponde:  ";
                switch ($categoria) {
                    case "cadete":
                        $resultado .= "CADETE ";
                        break;
                    case "juvenil":
                        $resultado .= "JUVENIL";
                        break;
                    case "mayores":
                        $resultado .= "MAYORES";
                        break;
                }
            }
            /*
             * Comprobar fecha de Nacimiento(obligatorio en html por defecto)
            */
            if(isset($_POST['fechaN'])){
                $fechaN= $_POST['fechaN'];
                $resultado .= "<br>fecha de Nacimiento: $fechaN";
            }
           
            /*
             *Comprobar casillas elegidas, se trata como un array, se recorre el array y se muestra
             *aquellas casillas que se hayan seleccionado, si se encuentra vacia se muestra otro mensaje
            */

            if(isset($_POST["lesiones"])){
                $lesiones = $_POST["lesiones"];
                $resultado .= "</br>Presenta las siguientes lesiones: ";
                foreach($lesiones as $lesion){
                    $resultado .= "<br>Lesión en $lesion";
                }
                
            }
            else{
                $resultado .= "</br>NO PRESENTA LESIÓN ALGUNA ";
            }
             
            $resultado .= "<br />";
            $this->mostrarFormulario($resultado);
			exit();		
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
             "apellido1"=>array("maxLength"=> 20, "required"=>true),
             "apellido2"=>array("maxLength"=> 20, "required"=>false),
             "documento"=>array("tipoDocumentoValido"=>true, "required"=>true),
             "telf"=>array("pattern" => "/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/","required"=>true),//"/^(6|9)[ -]*([0-9][ -]*){8}/", "maxlength" => 9,
             "email"=>array("filtradoPHP"=> true, "required"=>true),//"/[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?/"
             "sexo"=>array("datosValidos"=>array("mujer", "hombre"),"required"=>true),
             "fechaN"=>array("pattern"=> "/^(0[1-9]|[1-2]\d|3[01])(\/)(0[1-9]|1[012])\2(\d{4})$/","required"=>true),
             "categoria"=>array("datosValidos"=>array("cadete", "juvenil", "mayores"),"required"=>true),
             "lesiones[]"=>array("datosValidos"=>array("rodilla", "hombro", "tobillo", "dedos"),"required"=>false)
         );
     }

    /**
     * Método validar 
     * Realiza el proceso de validacion utilizando un Objeto de clase y el método reglasDeValidacion, creada anteriormente 
     */
    public function validar(){
        $validador = new ValidadorForm();
        $reglasValidacion = $this->crearReglasDeValidacion();
                                                                                                                                                                                                                                                                                                                                                                
    }

    /*private function mostrarFormulario()
    {
     //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_bienvenida.php';
    }*/
    private function mostrarFormulario($resultado)
    {
    // y se muestra la vista del resultado (la plantilla resultado.php)
        include 'vistas/form_bienvenida.php';
    }
}
