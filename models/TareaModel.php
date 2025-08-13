<?php
class TareaModel {
    private $conn;
    private $table_name = "tareas";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Consultar tareas
    public function leer() {
        $query = "SELECT id, titulo, descripcion, fecha_creacion 
                  FROM " . $this->table_name . " 
                  ORDER BY fecha_creacion DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Crear tarea
    public function crear($titulo, $descripcion) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (titulo, descripcion) 
                  VALUES (:titulo, :descripcion)";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $titulo = htmlspecialchars(strip_tags($titulo));
        $descripcion = htmlspecialchars(strip_tags($descripcion));

        // Bind
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descripcion", $descripcion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
