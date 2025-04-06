<?php
session_start();

if (!empty($_GET["id"])) {
    $id_cliente = $_GET['id'];

    // Validar que el ID sea un número
    if (!is_numeric($id_cliente)) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>ID inválido. Por favor, intente de nuevo.</div>";
        header("Location: ../clientes.php");
        exit;
    }

    include_once __DIR__ . '/../libConectBD.php';

    $cn = Conectarse();

    // Escapar el ID para evitar inyección SQL
    $id_cliente = pg_escape_string($cn, $id_cliente);

    // Consulta SQL para eliminar el cliente
    $query = "DELETE FROM cliente WHERE id_cliente = $id_cliente";
    $result = pg_query($cn, $query);

    if ($result) {
        $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Cliente con ID <b>$id_cliente</b> eliminado con éxito.</div>";
        header("Location: ../clientes.php");
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar eliminar el cliente. <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
        header("Location: ../clientes.php");
    }

    // Cerrar la conexión
    Desconectarse($cn);
} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Error inesperado. Contacte al administrador.</div>";
    header("Location: ../clientes.php");
}

exit;
?>