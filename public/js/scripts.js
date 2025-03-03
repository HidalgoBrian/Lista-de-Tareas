document.getElementById("formAgregar").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita que el formulario se envíe normalmente

    let titulo = document.getElementById("titulo").value;
    let descripcion = document.getElementById("descripcion").value;

    fetch("index.php?action=agregar", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `titulo=${encodeURIComponent(titulo)}&descripcion=${encodeURIComponent(descripcion)}`
    })
        .then(response => response.text())
        .then(() => {
            location.reload(); // Recargar la página para ver la nueva tarea
        });
});


// Manejo de la eliminación de tarea
document.querySelectorAll('.eliminar-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();  // Evitar la acción por defecto
        const tareaId = e.target.closest('a').dataset.id;  // Obtener el id de la tarea

        fetch(`index.php?action=eliminar&id=${tareaId}`, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                // Eliminar el elemento del DOM
                if (data.success) {
                    const tareaElement = e.target.closest('li');
                    tareaElement.remove();
                } else {
                    alert("Hubo un problema al eliminar la tarea.");
                }
            })
            .catch(error => console.error('Error al eliminar:', error));
    });
});


// Manejo de la actualización de tarea a "completada"
document.querySelectorAll('.completar-btn').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();  // Evitar la acción por defecto
        const tareaId = e.target.closest('a').dataset.id;  // Obtener el id de la tarea

        fetch(`index.php?action=completar&id=${tareaId}`, {
            method: 'GET',
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const tareaElement = e.target.closest('li');

                    // Mover la tarea a la columna de "Completadas"
                    const completadasList = document.querySelector('.tareas-completadas ul');
                    completadasList.appendChild(tareaElement); // Mover el <li> a la lista de completadas

                    // Eliminar el botón "Completada" y añadir una clase visual
                    e.target.remove();
                    tareaElement.classList.add('completada');
                } else {
                    alert("Hubo un problema al completar la tarea.");
                }
            })
            .catch(error => console.error('Error al completar:', error));
    });
});
