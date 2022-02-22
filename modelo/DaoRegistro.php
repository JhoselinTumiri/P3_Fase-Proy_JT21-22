<?php 
include "modelo/DataBase.php";

class DaoRegistro{
private $db;

//Se crea un objeto database
public function __construct()
{
    $this->db = new DataBase();
}

public function existeDeportista($DNI){
    
   $this->db->conectar();
   $sql= "Select * from deportistas WHERE dni = :dni";
   $args= array(":dni" =>$DNI);
   $resul = $this->db->SqlActualizacion($sql, $args);

   if(is_string($resul)){
      $this->db->desconectar();
      return $resul;
   }
   else{
      if(count($resul)>0){
         $this->db->desconectar();
         return true;
      }
      else{
         $this->db->desconectar();
         return false;
      }
   }
  
}

public function insertarDeportista($deportista){
   
   $this->db->conectar();
   $sql='INSERT INTO deportistas(nombre, apellido1, apellido2, dni,sexo, telf, email,fechaN,categoria,lesiones,privacidad) VALUES(?, ?, ?,?,?, ?,?,?,?,?,?)';
   //hacer un insert sql="inser into alumnos";
   $args= array($deportista->getNombre(), $deportista->getApellido1(), $deportista->getApellido2(), $deportista->getDni(),$deportista->getSexo(),$deportista->getTelf(),$deportista->getEmail(), $deportista->getFechaN(), $deportista->getCategoria(),$deportista->getLesiones(),$deportista->getPrivacidad()); 
   
   $resul = $this->db->SqlActualizacion($sql, $args);
   if(is_string($resul)){
      $this->db->desconectar();
      return $resul;
   }
   else{
      if(count($resul)>0){
         $this->db->desconectar();
         return "No se ha podido insertar correctamente ";
      }
      else{
         $this->db->desconectar();
         return "Se ha realizado correctamente la inserción";
      }
   }
  
   //array args
}

}


?>