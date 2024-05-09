<?php
$archivoTareas = "tareas.txt";

if (!file_exists($archivoTareas)) {
    $file = fopen($archivoTareas, "w") or die("No se pudo crear el archivo tareas.txt");
    fclose($file);
    // No imprimimos nada aquí para que sea un proceso oculto
}
?>
