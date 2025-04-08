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
                <h1 class="text-center text-info-emphasis">Agregar pedido</h1>
                <a href="./pedido.php" class="text-primary text-decoration-none">
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
        $campo_7 = "";
        $campo_8 = "";
        $campo_9 = "";
        $campo_10 = "";

        if (isset($_GET['id'])) {

            $id_pedido = $_GET['id'];

            $cn = Conectarse();

            $rs = pg_query("SELECT * FROM pedido WHERE id_pedido = $id_pedido");
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
            $campo_8 = trim(pg_fetch_result($rs, 0, 7));
            $campo_9 = trim(pg_fetch_result($rs, 0, 8));
            $campo_10 = trim(pg_fetch_result($rs, 0, 9));

            $campo_9 = preg_replace('/[^\d\.]/', '', $campo_9);
        } 

        ?>

        <form class="row g-3 needs-validation" novalidate method="post" action="./controller/pedidoAgregar.php"> 


                <input type="hidden" name="tipo" value="<?php echo ($campo_1 != "" AND $campo_2) != "" ? 'update' : 'insert'; ?>">

                <div class="col-md-6">
                    <label for="id_pedido" class="form-label">Id pedido</label>
                    <input name="id_pedido" type="number" class="form-control" id="id_pedido" <?php if($campo_1 != ""){echo "readonly value='$campo_1'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="fecha_pedido" class="form-label">Fecha pedido</label>
                    <input name="fecha_pedido" type="date" placeholder="yyyy/mm/dd" class="form-control" id="fecha_pedido" <?php if($campo_2 != ""){echo "value='$campo_2'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="id_cliente" class="form-label">Id cliente</label>
                    <input name="id_cliente" type="number" class="form-control" id="id_cliente" <?php if($campo_3 != ""){echo "value='$campo_3'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="instrucciones_envio_pedido" class="form-label">Instrucciones de envío</label>
                    <input name="instrucciones_envio_pedido" type="text" maxlength="60" class="form-control" id="instrucciones_envio_pedido" <?php if($campo_4 != ""){echo "value='$campo_4'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>


                <div class="col-md-6">
                    <label for="firma_recibido_pedido" class="form-label" >Firma de recibido</label>
                    <input name="firma_recibido_pedido" type="text" maxlength="1" class="form-control" id="firma_recibido_pedido" <?php if($campo_5 != ""){echo "value='$campo_5'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="numero_factura_pedido" class="form-label" >Número de factura</label>
                    <input name="numero_factura_pedido" type="text" class="form-control" id="numero_factura_pedido" <?php if($campo_6 != ""){echo "value='$campo_6'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="fecha_envio_pedido" class="form-label">Fecha de envío</label>
                    <input name="fecha_envio_pedido" type="date" placeholder="yyyy/mm/dd" class="form-control" id="fecha_envio_pedido" <?php if($campo_7 != ""){echo "value='$campo_7'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="peso_envio_pedido" class="form-label">Peso de envío</label>
                    <input name="peso_envio_pedido" type="number" placeholder="000.00" class="form-control" id="peso_envio_pedido" <?php if($campo_8 != ""){echo "value='$campo_8'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="cargo_envio_pedido" class="form-label">Cargo envío</label>
                    <input name="cargo_envio_pedido" type="text" placeholder="000.00" class="form-control" id="cargo_envio_pedido" <?php if($campo_9 != ""){echo "value='$campo_9'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="fecha_pago_pedido" class="form-label">Fecha de envío</label>
                    <input name="fecha_pago_pedido" type="date" placeholder="yyyy/mm/dd" class="form-control" id="fecha_pago_pedido" <?php if($campo_10 != ""){echo "value='$campo_10'";} ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>



                <div class="col-12">
                    <button type="submit" class="btn btn-success float-end" name="btnAgregarLlamada" value="ok">
                        <?php echo $campo_1 != "" ? 'Modificar pedido' : 'Agregar pedido'; ?>
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