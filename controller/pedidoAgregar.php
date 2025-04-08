<?php
session_start();


//Coloca el name de tu boton submit del  formulario
if (!empty($_POST["btnAgregarLlamada"])) {

    include_once("../libConectBD.php");
    $cn = Conectarse();

    // Validar si será inserción o modificación ademas eliminados los espacios en blanco
    $tipo = $_POST['tipo'];


    $campo_1 = trim($_POST['id_pedido']);
    $campo_2 = trim($_POST['fecha_pedido']);
    $campo_3 = trim($_POST['id_cliente']);
    $campo_4 = trim($_POST['instrucciones_envio_pedido']);
    $campo_5 = trim($_POST['firma_recibido_pedido']);
    $campo_6 = trim($_POST['numero_factura_pedido']);
    $campo_7 = trim($_POST['fecha_envio_pedido']);
    $campo_8 = trim($_POST['peso_envio_pedido']);
    $campo_9 = trim($_POST['cargo_envio_pedido']);
    $campo_10 = trim($_POST['fecha_pago_pedido']);


    if ($tipo == "update") {
        // Modificación
        $query = "UPDATE pedido SET 
            fecha_pedido = '$campo_2', 
            id_cliente = '$campo_3', 
            instrucciones_envio_pedido = '$campo_4', 
            firma_recibido_pedido = '$campo_5', 
            numero_factura_pedido = '$campo_6', 
            fecha_envio_pedido = '$campo_7', 
            peso_envio_pedido = '$campo_8', 
            cargo_envio_pedido = '$campo_9', 
            fecha_pago_pedido = '$campo_10' 
              WHERE id_pedido = '$campo_1'";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-info mt-5' role='alert'>Actualización exitosa</div>";
            header("Location: ../pedido.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar Actualizar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../pedidoAgregar.php?id=$campo_1");
        }

    } else {
        $query = "INSERT INTO 
        pedido (id_pedido, 
        fecha_pedido, 
        id_cliente, 
        instrucciones_envio_pedido, 
        firma_recibido_pedido, 
        numero_factura_pedido, 
        fecha_envio_pedido, 
        peso_envio_pedido, 
        cargo_envio_pedido, 
        fecha_pago_pedido) 
              VALUES ('$campo_1', '$campo_2', '$campo_3', '$campo_4', '$campo_5', '$campo_6', '$campo_7', '$campo_8', '$campo_9', '$campo_10')";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../pedido.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar($tipo) <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../pedidoAgregar.php?id=$campo_1");
        }
    }

} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
    header("Location: ../pedidoAgregar.php?id=$campo_1");
}

?>