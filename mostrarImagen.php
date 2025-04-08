<?php
include("./libConectBD.php");

// Conexión a la base de datos
$cn = Conectarse();

// Obtener el OID desde la URL
if (isset($_GET['oid'])) {
    $oid = $_GET['oid'];

    // Abrir el objeto grande
    $lo = pg_lo_open($cn, $oid, "r");

    if ($lo) {
        // Configurar el encabezado para la imagen
        header("Content-Type: image/jpeg"); // Cambia a image/png si es necesario

        // Leer y enviar el contenido del objeto grande
        pg_lo_read_all($lo);

        // Cerrar el objeto grande
        pg_lo_close($lo);
    } else {
        // Si no se puede abrir el objeto, mostrar un error
        header("Content-Type: text/plain");
        echo "Error al cargar la imagen.";
    }
} else {
    echo "OID no especificado.";
}

// Cerrar la conexión
Desconectarse($cn);
?>