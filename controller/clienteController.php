<?php
include_once("../libConectBD.php");

switch ($_GET['action']) {
    case 'get':

        $cn = Conectarse();

        if (!isset($_GET['id'])) {
            echo json_encode(['error' => 'ID no proporcionado']);
            exit;
        }

        $id = intval($_GET['id']);
        $sql = "SELECT * FROM cliente WHERE id_cliente = $id";
        $rs = pg_query($cn, $sql);
        if (!$rs || pg_num_rows($rs) === 0) {
            echo json_encode(['error' => 'Cliente no encontrado']);
            exit;
        }

        $row = pg_fetch_assoc($rs);
        echo json_encode($row);

        Desconectarse($cn);
        break;

    case 'update':

        $cn = Conectarse();

        $id = $_POST['id_cliente'];
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

        $sql = "UPDATE cliente SET 
            nombre_cliente = '$nombre_cliente',
            apellido_paterno_cliente = '$apellido_paterno_cliente',
            apellido_materno_cliente = '$apellido_materno_cliente',
            sexo_cliente = '$sexo_cliente',
            curp_cliente = '$curp_cliente',
            compania_cliente = '$compania_cliente',
            domicilio_cliente = '$domicilio_cliente',
            domicilio_alterno_cliente = '$domicilio_alterno_cliente',
            ciudad_cliente = '$ciudad_cliente',
            id_entidad_federativa = '$id_entidad_federativa',
            codigo_postal_cliente = '$codigo_postal_cliente',
            telefono_cliente = '$telefono_cliente',
            celular_cliente = '$celular_cliente',
            id_banco = '$id_banco',
            tarjeta_credito_cliente = '$tarjeta_credito_cliente',
            fecha_expiracion_tarjeta_credito_cliente = '$fecha_expiracion_tarjeta_credito_cliente'
        WHERE id_cliente = $id";

        $result = pg_query($cn, $sql);

        if ($result) {
            echo json_encode([
                'success' => true,
                'cliente' => [
                    'id' => $id,
                    'nombre' => $nombre_cliente,
                    'paterno' => $apellido_paterno_cliente,
                    'materno' => $apellido_materno_cliente,
                    'sexo' => $sexo_cliente,
                    'curp' => $curp_cliente,
                    'compania' => $compania_cliente,
                    'domicilio_prin' => $domicilio_cliente,
                    'domicilio_alt' => $domicilio_alterno_cliente,
                    'ciudad' => $ciudad_cliente,
                    'entidad_fed' => $id_entidad_federativa,
                    'cp' => $codigo_postal_cliente,
                    'telefono' => $telefono_cliente,
                    'celular' => $celular_cliente,
                    'banco' => $id_banco,
                    'tarjeta' => $tarjeta_credito_cliente,
                    'expiracion' => $fecha_expiracion_tarjeta_credito_cliente
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error al actualizar el cliente'
            ]);
        }
        Desconectarse($cn);
        break;
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}

?>