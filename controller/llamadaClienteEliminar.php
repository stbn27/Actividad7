<?php
session_start();

if (!empty($_GET["id1"]) && !empty($_GET["id2"])) {
    $campo_1 = $_GET['id1'];
    $campo_2 = $_GET['id2'];

    // Validar que el ID del cliente sea un número
    if (!is_numeric($campo_1)) {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>ID inválido. Por favor, intente de nuevo.</div>";
        header("Location: ../llamadaCliente.php");
        exit;
    }

    include_once __DIR__ . '/../libConectBD.php';

    $cn = Conectarse();

    // Escapar el ID para evitar inyección SQL
    $campo_1 = pg_escape_string($cn, $campo_1);
    $campo_2 = pg_escape_string($cn, $campo_2);

    // Consulta SQL para eliminar el cliente
    $query = "DELETE FROM llamada_Cliente WHERE id_cliente = $campo_1 AND hora_llamada_cliente = '$campo_2'";
    $result = pg_query($cn, $query);

    if ($result) {
        $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Llamada cliente con ID <b>$campo_1</b> y hora <b>$campo_2</b> eliminado con éxito.</div>";
        header("Location: ../llamadaCliente.php");
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar eliminar la llamada del cliente. <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
        header("Location: ../llamadaCliente.php");
    }

    // Cerrar la conexión
    Desconectarse($cn);
} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Error inesperado. Contacte al administrador.</div>";
    header("Location: ../llamadaCliente.php");
}

exit;
?>