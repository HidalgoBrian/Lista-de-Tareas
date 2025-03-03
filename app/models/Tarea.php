<?php
class Tarea {
    private static $conn;

    public static function init() {
        if (!self::$conn) {
            self::$conn = require __DIR__ . '/../config/database.php';
        }
    }

    public static function agregar($titulo, $descripcion) {
        self::init();
        $stmt = self::$conn->prepare("INSERT INTO tareas (titulo, descripcion) VALUES (?, ?)");
        $stmt->bind_param("ss", $titulo, $descripcion);
        return $stmt->execute();
    }

    public static function eliminar($id) {
        self::init();
        $stmt = self::$conn->prepare("DELETE FROM tareas WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function completar($id) {
        self::init();
        $stmt = self::$conn->prepare("UPDATE tareas SET completada = 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function obtenerTodas() {
        self::init();
        $result = self::$conn->query("SELECT * FROM tareas");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

