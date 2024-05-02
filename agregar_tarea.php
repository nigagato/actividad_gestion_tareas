<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Tarea</title>
</head>
<body>
    <h1>Agregar Nueva Tarea</h1>

    <?php
    // Función para guardar tareas en el archivo de texto
    function guardarTareas($tareas, $archivo) {
        file_put_contents($archivo, serialize($tareas));
    }

    // Ruta al archivo de texto donde se almacenarán las tareas
    $archivoTareas = "tareas.txt";

    // Verificar si el formulario fue enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nombre_tarea"])) {
        // Obtener el nombre de la tarea del formulario
        $nombreTarea = $_POST["nombre_tarea"];

        // Cargar tareas existentes
        $tareas = [];

        if (file_exists($archivoTareas)) {
            $contenido = file_get_contents($archivoTareas);
            $tareas = unserialize($contenido);
        }

        // Agregar la nueva tarea
        $tareas[] = array("nombre" => $nombreTarea, "completada" => false);

        // Guardar las tareas actualizadas
        guardarTareas($tareas, $archivoTareas);

        echo "<p>Tarea agregada exitosamente.</p>";
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre_tarea">Nombre de la Tarea:</label><br>
        <input type="text" id="nombre_tarea" name="nombre_tarea"><br>
        <input type="submit" value="Agregar Tarea">
    </form>

    <a href="index.php">Volver a la Lista de Tareas</a>

</body>
</html>
