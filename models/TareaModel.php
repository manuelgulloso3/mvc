<?php
class TareaModel {
    private $conn;
    private $table_name = "tareas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function leer(){
        $query = "SELECT id, titulo, descripcion, fecha_creacion 
                  FROM " . $this->table_name . " 
                  ORDER BY fecha_creacion DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function crear($titulo, $descripcion){
        $query = "INSERT INTO " . $this->table_name . " 
                  SET titulo = :titulo, descripcion = :descripcion";
        $stmt = $this->conn->prepare($query);
        $titulo = htmlspecialchars(strip_tags($titulo));
        $descripcion = htmlspecialchars(strip_tags($descripcion));
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descripcion", $descripcion);
        return $stmt->execute();
    }

    public function leerUno($id){
        $query = "SELECT id, titulo, descripcion 
                  FROM " . $this->table_name . " 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $titulo, $descripcion){
        $query = "UPDATE " . $this->table_name . " 
                  SET titulo = :titulo, descripcion = :descripcion 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $titulo = htmlspecialchars(strip_tags($titulo));
        $descripcion = htmlspecialchars(strip_tags($descripcion));
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function eliminar($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $id = htmlspecialchars(strip_tags($id));
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
