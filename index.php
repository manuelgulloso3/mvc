<?php
require_once 'controllers/TareaController.php';

$controller = new TareaController();
$accion = $_GET['accion'] ?? 'index';

switch ($accion) {
    case 'crear':
        $controller->crear();  // Muestra el formulario para crear tarea
        break;

    case 'guardar':
        $controller->guardar();  // Procesa el formulario para guardar tarea
        break;

    case 'editar':
        $controller->editar();  // Muestra o procesa la edición de tarea
        break;

    default:
        $controller->index();  // Muestra la lista de tareas
        break;
}
?>
