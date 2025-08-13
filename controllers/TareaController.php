<?php
require_once 'models/TareaModel.php';
require_once 'config/Database.php';

class TareaController {
    private $db;
    private $tareaModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tareaModel = new TareaModel($this->db);
    }

    // Mostrar todas las tareas
    public function index() {
        $tareas = $this->tareaModel->leer();
        include 'views/home.php';
    }

    // Crear tarea
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $descripcion = $_POST['descripcion'] ?? '';

            if (!empty($titulo) && !empty($descripcion)) {
                if ($this->tareaModel->crear($titulo, $descripcion)) {
                    // Redirige a la lista de tareas
                    header("Location: index.php");
                    exit;
                } else {
                    $error = "Error al guardar la tarea.";
                }
            } else {
                $error = "Todos los campos son obligatorios.";
            }
        }

        include 'views/crear.php';
    }


     // guardar tarea
     public function guardar() {
        if($_POST)
            $titulo = $_POST('titulo');
       if ($this->tareaModel->crear($titulo, $descripcion)) {

       header("location:index.php");}

       else{
        echo"Error al crear la tarea.";
       }

}

}
