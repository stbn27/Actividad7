<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Master | A7</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Bootstrap Iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>

<body data-bs-theme="dark">

    <?php
    session_start();
    include("plantilla.php");

    echo header_plantilla();


    ?>


    <main class="px-4 my-4" style="min-height: calc(100vh - 210px);">

        <div class="container mx-auto">

            <div class="my-3 d-flex align-items-center justify-content-between">
                <h1 class="text-center text-info-emphasis">Agregar llamada cliente</h1>
                <a href="./llamadaCliente.php" class="text-primary text-decoration-none">
                    <i class="bi bi-list-columns-reverse fs-1"></i>
                </a>
            </div>

            <?php
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
        </div>

        <!-- Verificar si es modificación o agregación -->
        <?php
        include "./libConectBD.php";

        $campo_1 = "";
        $campo_2 = "";
        $campo_3 = "";
        $campo_4 = "";
        $campo_5 = "";
        $campo_6 = "";

        if (isset($_GET['id1']) AND isset($_GET['id2'])) {

            $id_cliente = $_GET['id1'];
            $hora_llamada_cliente = $_GET['id2'];

            $cn = Conectarse();

            $rs = pg_query("SELECT * FROM llamada_cliente WHERE id_cliente = '$id_cliente' AND hora_llamada_cliente = '$hora_llamada_cliente'");
            if (!$rs) {
                alerta("danger", "Error de busqueda");
                exit;
            }
            $filas = pg_numrows($rs);
            if ($filas == 0) {
                alerta("info", "No se hallo algún registro");
                exit;
            }

            /**
             * Usamos trim para eliminar los espacios blancos al principio y al final si es que se encontro en la bd.
             */

            // Recuperados los datos de la BD
            $campo_1 = trim(pg_fetch_result($rs, 0, 0));
            $campo_2 = trim(pg_fetch_result($rs, 0, 1));
            $campo_3 = trim(pg_fetch_result($rs, 0, 2));
            $campo_4 = trim(pg_fetch_result($rs, 0, 3));
            $campo_5 = trim(pg_fetch_result($rs, 0, 4));
            $campo_6 = trim(pg_fetch_result($rs, 0, 5));
            $campo_7 = trim(pg_fetch_result($rs, 0, 6));

        } 

        ?>

        <form class="row g-3 needs-validation" novalidate method="post" action="./controller/llamadaClienteAgregar.php"> 


                <input type="hidden" name="tipo" value="<?php echo ($campo_1 != "" AND $campo_2) != "" ? 'update' : 'insert'; ?>">

                <!-- id del cliente -->
                <div class="col-md-6">
                    <label for="id_cliente" class="form-label">Id cliente</label>
                    <input name="id_cliente" type="number" class="form-control" id="id_cliente" <?php if($campo_1 != ""){echo "readonly value='$campo_1'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="hora_llamada_cliente" class="form-label">Hora llamada cliente</label>
                    <input name="hora_llamada_cliente" type="datetime" placeholder="yyyy/mm/dd hh:mm:ss" class="form-control" id="hora_llamada_cliente" <?php if($campo_2 != ""){echo "readonly value='$campo_2'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="empleado_llamada_cliente" class="form-label">Empleado que atendio la llamada</label>
                    <input name="empleado_llamada_cliente" type="text" class="form-control" id="empleado_llamada_cliente" <?php if($campo_3 != ""){echo "value='$campo_3'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                <label for="id_tipo_llamada_cliente" class="form-label">Tipo de llamada</label>
                    <div class="mb-3">
                        <select name="id_tipo_llamada_cliente" class="form-select" required aria-label="Seleccionar tipo de llamada" id="form_id_tipo_llamada_cliente">
                            <?php
                            $cn = Conectarse();
                            $query = "SELECT * FROM tipo_llamada ORDER BY 1";
                            $resultado = pg_exec($query);
                            if (!$resultado) {
                                alerta("danger", "Error de busqueda");
                                exit;
                            }
                            //Obtener el numero de filas de la consulta
                            $filas = pg_numrows($resultado);
                            if ($filas == 0) {
                                alerta("info", "No se hallo algún registro");
                                exit;
                            } else {
                                for ($i = 0; $i < $filas; $i++) {
                                    $id = pg_result($resultado, $i, 0);
                                    $nombre = pg_result($resultado, $i, 1);
                                    // Si el campo_4 es igual al id, se selecciona
                                    if ($campo_4 == $id) {
                                        echo "<option value='$id' selected>$nombre</option>";
                                    } else
                                    echo "<option value='$id' if>$nombre</option>";
                                }
                            }
                            //Liberar Result Set
                            ($resultado);
                            Desconectarse($cn);
                            ?>
                        </select>
                        <p class="invalid-feedback ms-2">Campo requerido</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="motivo_llamada_cliente" class="form-label" >Motivo de la llamada</label>
                    <input name="motivo_llamada_cliente" type="text" class="form-control" id="motivo_llamada_cliente" <?php if($campo_5 != ""){echo "value='$campo_5'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="tiempo_respuesta_llamada_cliente" class="form-label" >Tiempo de respuesta a la llamada</label>
                    <input name="tiempo_respuesta_llamada_cliente" placeholder="yyyy/mm/dd hh:mm:ss" type="text" class="form-control" id="tiempo_respuesta_llamada_cliente" <?php if($campo_6 != ""){echo "value='$campo_6'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="descripcion_respuesta_llamada_cliente" class="form-label">Descripción de la respuesta</label>
                    <textarea class="form-control" rows="3" name="descripcion_respuesta_llamada_cliente"><?php if($campo_7 != ""){echo$campo_7;} ?></textarea>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success float-end" name="btnAgregarLlamada" value="ok">
                        <?php echo $campo_1 != "" ? 'Modificar llamada' : 'Agregar llamada'; ?>
                    </button>
                </div>
        </form> 

    </main>

    <?php
    echo footer_plantilla();
    ?>

    <script>

        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        } else {
                            handleFormSubmit(form.id)
                            event.preventDefault()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();
    </script>

</body>

</html>