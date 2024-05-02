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

// Verificar si se recibieron tareas para marcar como completadas
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tareas_completadas"])) {
    // Obtener las tareas completadas del formulario
    $tareasCompletadas = $_POST["tareas_completadas"];
    
    // Cargar tareas existentes
    $tareas = cargarTareas($archivoTareas);

    // Marcar las tareas seleccionadas como completadas
    foreach ($tareasCompletadas as $idTarea) {
        if (array_key_exists($idTarea, $tareas)) {
            $tareas[$idTarea]['completada'] = true;
        }
    }

    // Guardar las tareas actualizadas
    guardarTareas($tareas, $archivoTareas);

    // Redirigir de vuelta a index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar Tareas</title>
</head>
<body>
    <h1>Completar Tareas</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Tareas Pendientes</h2>
        <ul>
            <?php 
            $tareasPendientes = cargarTareas($archivoTareas);
            foreach ($tareasPendientes as $id => $tarea): 
                if (!$tarea['completada']): ?>
                <li>
                    <input type="checkbox" name="tareas_completadas[]" value="<?php echo $id; ?>" onchange="this.form.submit()" />
                    <?php echo $tarea['nombre']; ?>
                </li>
            <?php endif; endforeach; ?>
        </ul>
    </form>

    <a href="index.php">Volver a la Lista de Tareas</a>
</body>
</html>
