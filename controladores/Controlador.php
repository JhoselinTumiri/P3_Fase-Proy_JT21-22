<?php
class Controlador
{
    public function run()
    {
        if (!isset($_POST['enviar']))//no se ha enviado el formulario
        { // primera petición
            //se llama al método para mostrar el formulario inicial
            $this->mostrarFormulario();
			exit();
        } else
        {
            $resultado ="Bienvenido/a ";
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
            $resultado .= " $apellido1 <br />";
            }

            //Mostrar los 2 apellidos
            if (!empty($_POST['apellido1']) && !empty($_POST['apellido2'])){
                $apellido1=$_POST['apellido1'];
                $apellido2=$_POST['apellido2'];
                $resultado .= " $apellido1 $apellido2 <br />";
                }

            //Mostrar tipo de documento elegido
            if (!empty($_POST['dni'])){
                $dni = $_POST['dni'];
                $resultado .= "</br>DNI/NIF = $dni <br />";
                }
            
            //Mostrar teléfono
            if (!empty($_POST['telf'])){
                $telf = $_POST['telf'];
                $resultado .= "</br>Contacto  = $telf <br />";
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
            
            //fecha de Nacimiento
            if(isset($_POST['fechaN'])){
                $fechaN= $_POST['fechaN'];
                $resultado .= "<br>fecha de Nacimiento: $fechaN";
            }
           
            
             
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
            $this->mostrarResultado($resultado);
			exit();		
        }
    }
    private function mostrarFormulario()
    {
     //se muestra la vista del formulario (la plantilla form_bienvenida.php)   
        include 'vistas/form_bienvenida.php';
    }
    private function mostrarResultado($resultado)
    {
    // y se muestra la vista del resultado (la plantilla resultado.,php)
        include 'vistas/form_bienvenida.php';
    }
}
