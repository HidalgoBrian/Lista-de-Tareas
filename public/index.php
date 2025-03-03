<?php
require_once __DIR__ . '/../app/controllers/TareaController.php';

$controller = new TareaController();
$action = $_GET['action'] ?? 'index';

if (method_exists($controller, $action)) {
    $controller->$action();
} else {
    echo "Acción no válida.";
}

