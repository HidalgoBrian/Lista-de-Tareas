CREATE TABLE tareas (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        titulo VARCHAR(255) NOT NULL,
                        descripcion TEXT NOT NULL,
                        completada BOOLEAN DEFAULT FALSE
);
