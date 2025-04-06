<?php
session_start();


//Coloca el name de tu boton submit del  formulario
if (!empty($_POST["btnagregarInvenrio"])) {

    include_once("../libConectBD.php");
    $cn = Conectarse();

    // Validar si será inserción o modificación ademas eliminados los espacios en blanco
    $tipo = $_POST['tipo'];

    //Usa el valor que colocaste en el name del input del formulario
    $id_inventario = trim($_POST['id_inventario']);
    $id_proveedor = trim($_POST['id_proveedor']);
    $descripcion_inventario = trim($_POST['descripcion_inventario']);
    $precio_unitario_inventario = trim($_POST['precio_unitario_inventario']);
    $empaque_inventario = trim($_POST['empaque_inventario']);
    $descripcion_empaque_inventario = trim($_POST['descripcion_empaque_inventario']);


    if ($tipo == "update") {
        // Modificación
        $query = "UPDATE inventario SET 
                descripcion_inventario = '$descripcion_inventario', 
                precio_unitario_inventario = '$precio_unitario_inventario', 
                empaque_inventario = '$empaque_inventario', 
                descripcion_empaque_inventario = '$descripcion_empaque_inventario' 
              WHERE id_inventario = '$id_inventario' AND id_proveedor = '$id_proveedor'";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-info mt-5' role='alert'>Actualización exitosa</div>";
            header("Location: ../inventario.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar Actualizar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../agregarInventario.php?id1=$id_inventario&id2=$id_proveedor");
        }

    } else {
        $query = "INSERT INTO inventario (id_inventario, id_proveedor, descripcion_inventario, precio_unitario_inventario, empaque_inventario, descripcion_empaque_inventario) 
              VALUES ('$id_inventario', '$id_proveedor', '$descripcion_inventario', '$precio_unitario_inventario', '$empaque_inventario', '$descripcion_empaque_inventario')";
        $rs = pg_query($cn, $query);


        if ($rs) {
            $_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../inventario.php");
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar($tipo) <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../agregarInventario.php?id1=$id_inventario&id2=$id_proveedor");
        }
    }

} else {
    $_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
    header("Location: ../agregarInventario.php?id1=$id_inventario&id2=$id_proveedor");
}

?>