<?php
session_start();

if (!empty($_GET["id"])) {
    $campo_1 = $_GET['id'];

    // Validar que el ID del pedido sea un número
    if (!is_numeric($campo_1)) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>ID inválido. Por favor, intente de nuevo.</div>";
        header("Location: ../pedido.php");
        exit;
    }

    include_once __DIR__ . '/../libConectBD.php';

    $cn = Conectarse();

    // Escapar el ID para evitar inyección SQL
    $campo_1 = pg_escape_string($cn, $campo_1);

    // Consulta SQL para eliminar el cliente
    $query = "DELETE FROM pedido WHERE id_pedido = $campo_1";
    $result = pg_query($cn, $query);

    if ($result) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-5' role='alert'>Pedido con ID <b>$campo_1</b> eliminado con éxito.</div>";
        header("Location: ../pedido.php");
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar eliminar el pedido <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
        header("Location: ../pedido.php");
    }

    // Cerrar la conexión
    Desconectarse($cn);
} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Error inesperado. Contacte al administrador.</div>";
    header("Location: ../pedido.php");
}

exit;
?>