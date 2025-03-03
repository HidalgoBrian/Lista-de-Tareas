<?php
require_once __DIR__ . '/../models/Tarea.php';
require_once __DIR__ . '/../config/mustache.php';

class TareaController {
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Llamar al modelo para agregar la tarea
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            // Agregar la tarea a la base de datos
            $tarea = Tarea::agregar($titulo, $descripcion);

            // Devolver la respuesta en formato JSON
            echo json_encode(['success' => true, 'tarea' => $tarea]); // Devuelve la tarea recién agregada
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }


    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Tarea::eliminar($id);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }

    public function completar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            Tarea::completar($id);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        exit;
    }



    public function index() {
        $tareas = Tarea::obtenerTodas();
        global $mustache;
        echo $mustache->render('index', ['tareas' => $tareas]);
    }
}
