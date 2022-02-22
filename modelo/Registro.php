<?php 
class Registro{
    private $nombre;
    private $apellido1;
    private $apellido2;
    private $dni;
    private $sexo;
    private $telf;
    private $email;
    private $fechaN;
    private $categoria;
    private $lesiones;
    private $privacidad;

 public function __construct($nombre, $apellido1,$apellido2, $dni, $sexo, $telf, $email,$fechaN, $categoria,$lesiones, $privacidad)
 {
     $this->nombre=$nombre;
     $this->apellido1=$apellido1;
     $this->apellido2=$apellido2;
     $this->dni=$dni;
     $this->sexo=$sexo;
     $this->telf=$telf;
     $this->email=$email;
     $this->fechaN=$fechaN;
     $this->categoria=$categoria;
     $this->lesiones=$lesiones;
     $this->privacidad=$privacidad;
 }   

 public function getNombre(){
     return $this->nombre;
 }
 public function setNombre($nombre){
     $this->nombre = $nombre;
}
public function getApellido1(){
    return $this->apellido1;
}
public function setApellido1($apellido1){
    $this->apellido1 = $apellido1;
}
public function getApellido2(){
    return $this->apellido2;
}
public function setApellido2($apellido2){
    $this->apellido2 = $apellido2;
}
public function getDni(){
    return $this->dni;
}
public function setDni($dni){
    $this->dni = $dni;
}
public function getSexo(){
    return $this->sexo;
}
public function setSexo($sexo){
    $this->sexo = $sexo;
}

public function getTelf(){
    return $this->telf;
}
public function setTelf($telf){
    $this->telf= $telf;
}

public function getEmail(){
    return $this->email;
}
public function setEmail($email){
    $this->email= $email;
}
public function getFechaN(){
    return $this->fechaN;
}
public function setFechaN($fechaN){
    $this->fechaN= $fechaN;
}
public function getCategoria(){
    return $this->categoria;
}
public function setCategoria($categoria){
    $this->categoria= $categoria;
}
public function getLesiones(){
    return $this->lesiones;
}
public function setLesiones($lesiones){
    $this->lesiones= $lesiones;
}
public function getPrivacidad(){
    return $this->privacidad;
}
public function setPrivacidad($privacidad){
    $this->privacidad= $privacidad;
}
    
}


?>