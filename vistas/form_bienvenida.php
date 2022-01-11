<?php
include "cabecera.php";
?>
<form id="form" action="index.php" method="post">
    
    <div>
     <center><h2>Inscripciones Club <br>Navarra Voleibol</h2></center>
        <div class='uno'>
            <label>Nombre</label>
            <input type="text" name="nombre" />
            <label>Apellido 1 </label>
            <input type="text" name="apellido1" />
            
            <label>Apellido 2 </label>
            <input type="text" name="apellido2" />
            <input type="checkbox" name="sin2AP" value="no2ap" />Sin 2º Apellido<br />
            <div class="datos">
            DNI/NIE<select class= "dniCasilla" name="documento" holder="Seleccionar tipo de Documento">
                 <option value="dni" selected>Seleccionar Tipo de Documento</option>    
                <option value="dni">DNI</option>
                <option value="nif" >NIF</option>
                <option value="nie">NIE</option>
            </select>
            <input type="text" name="dni" /><br /><br>

            <label>telf</label>
            <input type="tel" name="telf" />
            <label>Email</label>
            <input type="email" name="email" /><br />
            </div>
        </div>
            <div>
                <div class='uno'>
                    <section>
                    <label>Sexo</label><br />
                    <input type="radio" name="sexo" value="hombre" />Hombre
                    <input type="radio" name="sexo" value="mujer" />Mujer<br />
                    </section>
                    <section>
                    <label>&nbsp;</label>
                    <label>Fecha/Nac </label>
                    <input type="date" name="fechaN" required/>
                    </section>
                   
                </div>
                
                <div class='categoria'>
                    <h4>Categoria</h4><br />
                    <input type="radio" name="categoria" value="cadete" />Cadete
                    <input type="radio" name="categoria" value="juvenil" />Juvenil
                    <input type="radio" name="categoria" value="mayores" />Mayores<br />
                     <label>&nbsp;</label>
                   
                </div>
                <div class='uno'>
                    <label>Presenta Lesiones </label><br />
                    <input type="checkbox" name="lesiones[]" value="rodilla" />rodilla<br />
                    <input type="checkbox" name="lesiones[]" value="hombro" />hombro<br />
                    <input type="checkbox" name="lesiones[]" value="tobillo" />tobillo<br />
                    <input type="checkbox" name="lesiones[]" value="dedos" />dedos<br />
                    
                    <label>&nbsp;</label>
                   
                </div>
                </div>
                <input class="priv" type="checkbox" name="privacidad" value="privacidad" />Acepto las condiciones de Política de Privacidad ..<br />
           
            <input type="submit" name="enviar" value="Inscribirse" />

</form>
<?php
if(!empty($resultado)){

    echo "<div class='texto' />";
      echo $resultado;
      echo "</div>";
}
include "pie.php";
?>