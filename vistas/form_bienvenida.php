<?php
include "cabecera.php";
include "helper/Utilidades.php";

//Comprueba si la variable $validador contiene algo y si hay errores
    
    if(isset($validador)){
        $errores = $validador->getErrores();
        if( isset($errores)){
            foreach($errores as $value){
                echo "<p>$value";
            }
        }
    }
?>

<form id="form" action="index.php" method="post">
    
    <div>
     <center><h2>Inscripciones Club <br>Navarra Voleibol</h2></center>
        <div class='uno'>
            <label>Nombre</label>
            <input type="text" name="nombre" value='<?php echo Input::get('nombre')?>'/>
            <label>Apellido 1 </label>
            <input type="text" name="apellido1" value='<?php echo Input::get('apellido1')?>' />
            
            <label>Apellido 2 </label>
            <input type="text" name="apellido2" value='<?php echo Input::get('apellido2')?>'/>
        
            <div class="datos">
            DNI/NIE<select class= "dniCasilla" name="documento" holder="Seleccionar tipo de Documento">
                 <option value="select" selected>Seleccionar Tipo de Documento</option>    
                <option value="dni">DNI</option>
                <option value="nif" >NIF</option>
                <option value="nie">NIE</option>
            </select>
            <input type="text" name="dni" value='<?php echo Input::get('dni')?>' /><br /><br>

            <label>telf</label>
            <input type="tel" name="telf" value='<?php echo Input::get('telf')?>'/>
            <label>Email</label>
            <input  name="email" value='<?php echo Input::get('email')?>' />
            </div>
        </div>
            <div>
                <div class='uno'>
                    <section>
                    <h4>Sexo</h4>

                    <?php
            $generos = array("Hombre", "Mujer");
            foreach ($generos as $value) {
               echo "<input type='radio' id='$value' name='sexo' value='$value'";
               echo Utilidades::verificaControlRadio(Input::get('sexo'), $value);
               echo "/>";
               echo "<label for='$value'>$value</label>";
            }
            echo "<br>";?>
                   
                   
                    </section>
                    <section>
                    <label><b>Fecha de Nacimiento</b></label>
                    <input type="date" name="fechaN" value='<?php echo Input::get('fechaN')?>' />
                    </section>
                   
                </div>
                
                <div class='categoria'>
                <br />
                    <h4>Categoria</h4><br />
                    <?php
            $categoria = array("Cadete", "Juvenil", "Mayores" );
            foreach ($categoria as $value) {
               echo "<input type='radio' id='$value' name='categoria' value='$value'";
               echo Utilidades::verificaControlRadio(Input::get('categoria'), $value);
               echo "/>";
               echo "<label for='$value'>$value</label>";
            }
            echo "<br>";?>
                   
                </div>
                <div class='uno'>
                    <label>&nbsp;</label>
                    <label><b>Presenta Lesiones</b> </label><br />
               
                    <?php
         $lesiones = array("rodilla","hombro", "tobillo", "dedos");
         foreach ($lesiones as $value) {
            echo "<input name='lesiones[]' id='$value' type='checkbox' value='$value'";
            echo Utilidades::verificaCheckbox(Input::get("lesiones"), $value);
            echo "/>";
            
            echo "<label for='$value'>$value</label><br/>";
         }
      ?>
                    
                   
                </div>
                </div>
                <?php
            $value = "Acepto las condiciones de Politica de Privacidad";
               echo "<input type='radio' id='$value' name='privacidad' value='$value'";
               echo Utilidades::verificaControlRadio(Input::get('privacidad'), $value);
               echo "/>";
               echo "<label for='$value'>$value</label>";
            
            echo "<br>";?>
            <input type="submit" name="enviar" value="<?php echo $fase ?>" />

</form>
<?php
if(!empty($resultado)){
    
    echo "<div class='texto' />";
      echo $resultado;
      echo "</div>";
}
include "pie.php";
?>