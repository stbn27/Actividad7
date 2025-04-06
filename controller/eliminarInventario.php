<?php
session_start();

if (!empty($_GET["id1"]) && !empty($_GET["id2"])) {
    $id_inventario = $_GET['id1'];
    $id_proveedor = $_GET['id2'];

    // Validar que el ID sea un número
    if (!is_numeric($id_inventario)) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>ID inválido. Por favor, intente de nuevo.</div>";
        header("Location: ../clientes.php");
        exit;
    }

    include_once __DIR__ . '/../libConectBD.php';

    $cn = Conectarse();

    // Escapar el ID para evitar inyección SQL
    $id_cliente = pg_escape_string($cn, $id_inventario);
    $id_proveedor = pg_escape_string($cn, $id_proveedor);

    // Consulta SQL para eliminar el cliente
    $query = "DELETE FROM inventario WHERE id_inventario = $id_inventario AND id_proveedor = '$id_proveedor'";
    $result = pg_query($cn, $query);

    if ($result) {
        $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Inventario con ID <b>$id_inventario</b> y proveedor <b>$id_proveedor</b> eliminado con éxito.</div>";
        header("Location: ../inventario.php");
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar eliminar el inventario. <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
        header("Location: ../inventario.php");
    }

    // Cerrar la conexión
    Desconectarse($cn);
} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Error inesperado. Contacte al administrador.</div>";
    header("Location: ../inventario.php");
}

exit;
?>