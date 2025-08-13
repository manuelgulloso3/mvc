<?php
require_once 'models/TareaModel.php';
require_once 'config/Database.php';

class TareaController {
    private $db;
    private $tareaModel;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->tareaModel = new TareaModel($this->db);
    }

    public function index(){
        $tareas = $this->tareaModel->leer();
        include 'views/home.php';
    }

    public function crear(){
        include 'views/crear.php';
    }

    public function guardar(){
        if ($_POST){
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            if ($this->tareaModel->crear($titulo, $descripcion)){
                header("Location: index.php");
                exit();
            } else {
                echo "Error al crear la tarea.";
            }
        } else {
            include 'views/crear.php'; // Mostrar formulario si no hay POST
        }
    }

    public function editar(){
        if ($_POST) {
            $id = $_POST['id'];
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            if ($this->tareaModel->actualizar($id, $titulo, $descripcion)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error al actualizar la tarea.";
            }
        } else {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $tarea = $this->tareaModel->leerUno($id);
                if ($tarea) {
                    include 'views/editar.php';
                } else {
                    echo "Tarea no encontrada.";
                }
            } else {
                echo "ID de tarea no encontrada.";
            }
        }
    }
}
?>
