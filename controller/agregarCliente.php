<?php
session_start();

if (!empty($_POST["btnregistrarcliente"])) {
    $nombre_cliente = $_POST['nombre'];
    $apellido_paterno_cliente = $_POST['paterno'];
    $apellido_materno_cliente = $_POST['materno'];
    $sexo_cliente = $_POST['sexo'];
    $curp_cliente = $_POST['curp'];
    $compania_cliente = $_POST['compania'];
    $domicilio_cliente = $_POST['domicilio_prin'];
    $domicilio_alterno_cliente = $_POST['domicilio_alt'];
    $ciudad_cliente = $_POST['ciudad'];
    $id_entidad_federativa = $_POST['entidad_fed'];
    $codigo_postal_cliente = $_POST['cp'];
    $telefono_cliente = $_POST['telefono'];
    $celular_cliente = $_POST['celular'];
    $id_banco = $_POST['banco'];
    $tarjeta_credito_cliente = $_POST['tarjeta'];
    $fecha_expiracion_tarjeta_credito_cliente = $_POST['expiracion'];

    if (
        !empty($nombre_cliente) and !empty($apellido_paterno_cliente) and
        !empty($apellido_materno_cliente) and !empty($sexo_cliente) and
        !empty($curp_cliente) and !empty($compania_cliente) and !empty($domicilio_cliente)
        and !empty($ciudad_cliente) and !empty($id_entidad_federativa)
        and !empty($codigo_postal_cliente) and !empty($telefono_cliente)
        and !empty($id_banco)
    ) {

        include_once __DIR__ . '/../libConectBD.php';

        $cn = Conectarse();
        $query = "INSERT INTO cliente (
            nombre_cliente,
            apellido_paterno_cliente,
            apellido_materno_cliente,
            sexo_cliente,
            curp_cliente,
            compania_cliente,
            domicilio_cliente,
            domicilio_alterno_cliente,
            ciudad_cliente,
            id_entidad_federativa,
            codigo_postal_cliente,
            telefono_cliente,
            celular_cliente,
            id_banco,
            tarjeta_credito_cliente,
            fecha_expiracion_tarjeta_credito_cliente
        ) VALUES (
            '$nombre_cliente',
            '$apellido_paterno_cliente',
            '$apellido_materno_cliente',
            '$sexo_cliente',
            '$curp_cliente',
            '$compania_cliente',
            '$domicilio_cliente',
            '$domicilio_alterno_cliente',
            '$ciudad_cliente',
            '$id_entidad_federativa',
            '$codigo_postal_cliente',
            '$telefono_cliente',
            '$celular_cliente',
            '$id_banco',
            '$tarjeta_credito_cliente',
            '$fecha_expiracion_tarjeta_credito_cliente'
        )";
        $result = pg_query($cn, $query);

        if ($result) {
            $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../clientes.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../agregarCliente.php");
        }

        Desconectarse($cn);
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
        header("Location: ../agregarCliente.php");
    }
}

exit;
?>