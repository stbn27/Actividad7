<?php
session_start();


//Coloca el name de tu boton submit del  formulario
if (!empty($_POST["btnAgregarCatalogo"])) {

    include_once("../libConectBD.php");
    $cn = Conectarse();

    // Validar si será inserción o modificación ademas eliminados los espacios en blanco
    $tipo = $_POST['tipo'];


    $campo_1 = trim($_POST['id_catalogo']);
    $campo_2 = trim($_POST['id_inventario']);
    $campo_3 = trim($_POST['id_proveedor']);
    $campo_4 = trim($_POST['descripcion_catalogo']);
    //$campo_5 = trim($_POST['foto_catalogo']);
    $campo_6 = trim($_POST['instrucciones_catalogo']);


    $oid_foto = null;

    if (isset($_FILES['foto_catalogo']) && $_FILES['foto_catalogo']['error'] == UPLOAD_ERR_OK) {
        $tmp = $_FILES['foto_catalogo']['tmp_name'];
        $file = fopen($tmp, 'rb');

        if ($file) {
            pg_query($cn, 'BEGIN'); // Necesario para trabajar con Large Objects

            $oid_foto = pg_lo_create($cn);
            $lo = pg_lo_open($cn, $oid_foto, 'w');

            while (!feof($file)) {
                $data = fread($file, 8192);
                pg_lo_write($lo, $data);
            }

            fclose($file);
            pg_lo_close($lo);

            pg_query($cn, 'COMMIT');
        }
    }



    if ($tipo == "update") {
        // Modificación
        $query = "UPDATE catalogo SET 
            id_inventario = $campo_2, 
            id_proveedor = '$campo_3', 
            descripcion_catalogo = '$campo_4', 
            instrucciones_catalogo = '$campo_6', 
                WHERE id_catalogo = $campo_1";

        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-info mt-5' role='alert'>Actualización exitosa</div>";
            header("Location: ../catalogo.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar Actualizar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../catalogoAgregar.php?id=$campo_1");
        }

    } else {
        $query = "INSERT INTO catalogo (
            id_catalogo, 
            id_inventario, 
            id_proveedor, 
            descripcion_catalogo, 
            instrucciones_catalogo,
            foto_catalogo
        ) VALUES (
            $campo_1, 
            $campo_2, 
            '$campo_3', 
            '$campo_4', 
            '$campo_6',
            " . ($oid_foto !== null ? $oid_foto : 'NULL') . "
        )";
        
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../catalogo.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar($tipo) <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../catalogoAgregar.php?id=$campo_1");
        }
    }

} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
    header("Location: ../catalogoAgregar.php?id=$campo_1");
}

?>