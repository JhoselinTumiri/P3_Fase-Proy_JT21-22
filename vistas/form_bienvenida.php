<?php
include "cabecera.php";
?>
<form id="form" action="index.php" method="post">

    <div>
        <div class='uno'>
            <label>Nombre</label>
            <input type="text" name="nombre" />
            <label>Apellido 1 </label>
            <input type="text" name="apellido1" />
            <label>Apellido 2 </label>
            <input type="text" name="apellido2" />
            <input type="checkbox" name="sin2AP" value="no2ap" />Sin 2º Apellido<br />
            DNI/NIE<select name="documento" holder="Seleccionar tipo de Documento">
                 <option value="dni" selected>Seleccionar Tipo de Documento</option>    
                <option value="dni">DNI</option>
                <option value="nif" >NIF</option>
                <option value="nie">NIE</option>
            </select>
            <label>telf</label>
            <input type="tel" name="telf" /><br />
            <label>Email</label>
            <input type="email" name="email" /><br />
            <div>
                <div class='uno'>
                    <label>Sexo</label><br />
                    <input type="radio" name="sexo" value="hombre" />Hombre<br />
                    <input type="radio" name="sexo" value="mujer" />Mujer<br />
                    
                    <label>&nbsp;</label>
                   
                </div>
                <label>Fecha/Nac </label>
                <input type="date" name="fechaN" />
                <div class='uno'>
                    <label>Categoria</label><br />
                    <input type="radio" name="categoria" value="cadete" />Cadete<br />
                    <input type="radio" name="categoria" value="juvenil" />Juvenil<br />
                    <input type="radio" name="categoria" value="mayores" />Mayores<br />
                    
                    <label>&nbsp;</label>
                   
                </div>
                <div class='uno'>
                    <label>Presenta Lesiones </label><br />
                    <input type="checkbox" name="lesiones" value="rodilla" />rodilla<br />
                    <input type="checkbox" name="lesiones" value="hombro" />hombro<br />
                    <input type="checkbox" name="lesiones" value="tobillo" />tobillo<br />
                    <input type="checkbox" name="lesiones" value="dedos" />dedos<br />
                    
                    <label>&nbsp;</label>
                   
                </div>
            </div>

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