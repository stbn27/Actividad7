<?php
include '../libConectBD.php';
$cn = Conectarse();

// Verificar si se recibió el ID de la imagen
if (isset($_GET['id_imagen'])) {
    $oid_imagen = $_GET['id_imagen'];

    // Iniciar una transacción
    pg_query($cn, 'BEGIN');

    $rs = pg_query($cn, "SELECT foto_catalogo FROM catalogo WHERE id_catalogo = $oid_imagen");

    if ($rs && pg_num_rows($rs) > 0) {
        $fila = pg_fetch_assoc($rs);
        $oid = $fila['foto_catalogo'];

        if (!empty($oid) && $oid != 0) {
            $lo = pg_lo_open($cn, $oid, 'r');

            if ($lo) {
                // Mover al final para saber tamaño
                pg_lo_seek($lo, 0, PGSQL_SEEK_END);
                $tamaño = pg_lo_tell($lo);
                pg_lo_seek($lo, 0, PGSQL_SEEK_SET);

                // Leer en buffer
                $buffer_size = 4096;
                $contenido = '';
                while ($pedazo = pg_lo_read($lo, $buffer_size)) {
                    $contenido .= $pedazo;
                }

                pg_lo_close($lo);
                pg_query($cn, 'COMMIT'); // Finalizar transacción

                // Asumimos imagen .gif como indicaste, puedes adaptar a otro mime si necesario
                header('Content-Type: image/gif');
                header('Content-Length: ' . $tamaño);
                echo $contenido;
                exit;

            } else {
                echo "Error al acceder a la imagen.";
                pg_query($cn, 'ROLLBACK');
            }
        } else {
            echo "No hay imagen disponible.";
            pg_query($cn, 'ROLLBACK');
        }
    } else {
        echo "Registro de imagen no encontrado.";
        pg_query($cn, 'ROLLBACK');
    }

    pg_free_result($rs);
} else {
    echo "ID de imagen no proporcionado.";
}

Desconectarse($cn);
?>
