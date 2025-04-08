<?php
session_start();


//Coloca el name de tu boton submit del  formulario
if (!empty($_POST["btnAgregarLlamada"])) {

    include_once("../libConectBD.php");
    $cn = Conectarse();

    // Validar si será inserción o modificación ademas eliminados los espacios en blanco
    $tipo = $_POST['tipo'];


    $campo_1 = trim($_POST['id_cliente']);
    $campo_2 = trim($_POST['hora_llamada_cliente']);
    $campo_3 = trim($_POST['empleado_llamada_cliente']);
    $campo_4 = trim($_POST['id_tipo_llamada_cliente']);
    $campo_5 = trim($_POST['motivo_llamada_cliente']);
    $campo_6 = trim($_POST['tiempo_respuesta_llamada_cliente']);
    $campo_7 = trim($_POST['descripcion_respuesta_llamada_cliente']);


    if ($tipo == "update") {
        // Modificación
        $query = "UPDATE llamada_cliente SET 
            empleado_llamada_cliente = '$campo_3', 
            id_tipo_llamada = '$campo_4', 
            motivo_llamada_cliente = '$campo_5', 
            tiempo_respuesta_llamada_cliente = '$campo_6', 
            descripcion_respuesta_llamada_cliente = '$campo_7' 
              WHERE id_cliente = '$campo_1' AND hora_llamada_cliente = '$campo_2'";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-info mt-5' role='alert'>Actualización exitosa</div>";
            header("Location: ../llamadaCliente.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar Actualizar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../llamadaClienteAgregar.php?id1=$campo_1&id2=$campo2");
        }

    } else {
        $query = "INSERT INTO 
        llamada_cliente (id_cliente, 
        hora_llamada_cliente, 
        empleado_llamada_cliente, 
        id_tipo_llamada, 
        motivo_llamada_cliente, 
        tiempo_respuesta_llamada_cliente, 
        descripcion_respuesta_llamada_cliente) 
              VALUES ('$campo_1', '$campo_2', '$campo_3', '$campo_4', '$campo_5', '$campo_6', '$campo_7')";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../llamadaCliente.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar($tipo) <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../llamadaClienteAgregar.php?id1=$campo_1&id2=$campo2");
        }
    }

} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
    header("Location: ../llamadaClienteAgregar.php?id1=$campo_1&id2=$campo2");
}

?>