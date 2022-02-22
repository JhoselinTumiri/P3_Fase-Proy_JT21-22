<?php 
include "IDataBase.php";
include "config/config.php";

class DataBase implements IDataBase{
    private $conexion;

    /**
     * Función que llamas para conectarte a la base de datos, cogiendo los datos desde config.php
     * Lo hace mediante new PDO, https://www.php.net/manual/es/pdo.connections.php
     * 
     * Comprueba si la conexión se ha relacionado con exito, si no captura el error y lo envia a vistas/error
     * para que pueda ser visualizado.
     */

    public function conectar(){
        try{
            $this->conexion = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conexion->exec('SET names utf8');
        }
        catch (Exception $exception) { // No se ha podido completar la conexión y capturamos el error que ha dado
            return $exception->getMessage();
        }
    
    }

    /**
     * Función que desconecta la base de datos
     */
    public function desconectar(){
        $this->conexion=null;
    }


     // query() ejecuta una sentencia sql que devuelve un conjunto de valores.
    // Explicación más detallada https://www.php.net/manual/es/pdo.query.php
    // Hemos decidido no usarla porque query() no evita los ataques de tipo SQL injection,
    // usaremos el metodo más abajo para hacer todos los tipos de consultas.
    
    public function ejecutarSql($sql){

        try {
            $resul = $this->conexion->query($sql);
            return $resul;
        } catch (Exception $exception){
            return $exception->getMessage();
        }
    }

      /**
     * prepare() prepara una sentencia sql para ser ejecutada por el metodo execute().
     * Explicación más detallada https://www.php.net/manual/es/pdo.prepare.php
     * 
     * @param string $sentencia sql que se pasará hecha mediante parametros de sustitución o parametros de signos de interrogación
     * @param array $args que se van a insertar en las condiciones del where en la sentencia sql 
     */
    public function SqlActualizacion($sql, $args){

        try{
            if(isset($this->conexion)){
                $resul=$this->conexion->prepare($sql);
                if(!$resul->execute($args)){
                    return "Ha ocurrido un propblema con la consulta";
                   }
                   
                else{
                   
                    return $resul->fetchAll();
                }
                
            }
            else{
                return "No se ha podido conectar a la Base de Datos";
            }
        }
        catch(Exception $e){
                return $e->getMessage();
        }
    }
}


?>