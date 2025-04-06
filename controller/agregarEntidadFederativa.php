<?php
//session_start();


//Coloca el name de tu boton submit del  formulario
if (!empty($_POST["btnagregar"])) {

    include_once("../libConectBD.php");
    $cn = Conectarse();

    // Validar si será inserción o modificación ademas eliminados los espacios en blanco
    $tipo = $_POST['tipo'];

    //Usa el valor que colocaste en el name del input del formulario
    $id = trim($_POST['id_entidad']);
    $entidad = trim($_POST['nombre_entidad']);


    if ($tipo == "update") {
        // Modificación
        $query = "UPDATE entidad_federativa SET nombre_entidad_federativa = '$entidad' WHERE id_entidad_federativa = '$id'";
        $rs = pg_query($cn, $query);


        //Esto no lo modifiques son alertas.
        if ($rs) {
            //$_SESSION['mensaje'] = "<div class='alert alert-info mt-5' role='alert'>Actualización exitosa</div>";
            header("Location: ../entidadFederativa.php");
        } else {
            //$_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar Actualizar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../agregarEntidadFederativa.php?id=$id");
        }

    } else {
        $query = "INSERT INTO entidad_federativa VALUES ('$id', '$entidad')";
        $rs = pg_query($cn, $query);


        //Esto no lo modifiques son alertas.
        if ($rs) {
            //$_SESSION['mensaje'] = "<div class='alert alert-success mt-5' role='alert'>Registro exitoso</div>";
            header("Location: ../entidadFederativa.php");
        } else {
            //$_SESSION['mensaje'] = "<div class='alert alert-danger mt-5' role='alert'>Ocurrió un error al intentar registrar <br> <p>Error: " . pg_last_error($cn) . "</p></div>";
            header("Location: ../entidadFederativa.php?id=$id");
        }
    }

} else {
    //$_SESSION['mensaje'] = "<div class='alert alert-warning mt-3' role='alert'>Rellene todos los campos requeridos</div>";
    header("Location: ../agregarEntidadFederativa.php?id=$id");
}

?>