<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Tareas</title>
</head>
<body>
    <h1>Lista de Tareas</h1>

    <?php
    // Función para cargar tareas desde el archivo de texto
    function cargarTareas($archivo) {
        $tareas = [];

        if (file_exists($archivo)) {
            $contenido = file_get_contents($archivo);
            $tareas = unserialize($contenido);
        }

        return $tareas;
    }

    // Función para guardar tareas en el archivo de texto
    function guardarTareas($tareas, $archivo) {
        file_put_contents($archivo, serialize($tareas));
    }

    // Ruta al archivo de texto donde se almacenarán las tareas
    $archivoTareas = "tareas.txt";

    // Cargar tareas pendientes y completadas
    $tareas = cargarTareas($archivoTareas);
    $tareasPendientes = [];
    $tareasCompletadas = [];

    foreach ($tareas as $tarea) {
        if ($tarea['completada']) {
            $tareasCompletadas[] = $tarea;
        } else {
            $tareasPendientes[] = $tarea;
        }
    }
    ?>

    <h2>Tareas Pendientes</h2>
    <ul>
        <?php foreach ($tareasPendientes as $tarea): ?>
            <li><?php echo $tarea['nombre']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Tareas Completadas</h2>
    <ul>
        <?php foreach ($tareasCompletadas as $tarea): ?>
            <li><?php echo $tarea['nombre']; ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="agregar_tarea.php">Agregar Nueva Tarea</a>

</body>
</html>
