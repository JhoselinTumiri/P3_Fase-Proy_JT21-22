<?php

/**
 * Permiten crear código con el cuál especificar qué métodos deben ser implementados por una clase
 * sin tener qué definir como estos metodos son manipulados
 * Todo los métodos debe ser públicos.
 */
Interface IDataBase{

    public function conectar();
    public function desconectar();

     // no la usamos
     public function ejecutarSql($sql);
    
     public function SqlActualizacion($sql, $args);
}

?>