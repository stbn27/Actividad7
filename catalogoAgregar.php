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
                <h1 class="text-center text-info-emphasis">Agregar catalogo</h1>
                <a href="./catalogo.php" class="text-primary text-decoration-none">
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


        <?php
        include "./libConectBD.php";

        $campo_1 = "";
        $campo_2 = "";
        $campo_3 = "";
        $campo_4 = "";
        $campo_5 = "";
        $campo_6 = "";

        if (isset($_GET['id'])) {

            $id_catalogo = $_GET['id'];

            $cn = Conectarse();

            $rs = pg_query("SELECT * FROM catalogo WHERE id_catalogo = $id_catalogo");
            if (!$rs) {
                alerta("danger", "Error de busqueda");
                exit;
            }
            $filas = pg_numrows($rs);
            if ($filas == 0) {
                alerta("info", "No se hallo algún registro");
                exit;
            }

            // Recuperados los datos de la BD
            $campo_1 = trim(pg_fetch_result($rs, 0, 0));
            $campo_2 = trim(pg_fetch_result($rs, 0, 1));
            $campo_3 = trim(pg_fetch_result($rs, 0, 2));
            $campo_4 = trim(pg_fetch_result($rs, 0, 3));
            $campo_5 = trim(pg_fetch_result($rs, 0, 4));
            $campo_6 = trim(pg_fetch_result($rs, 0, 5));
        }

        ?>
        <div class="container mx-auto">
            <form class="row g-3 needs-validation" novalidate method="post" action="./controller/catalogoAgregar.php"
                enctype="multipart/form-data">

                <input type="hidden" name="tipo"
                    value="<?php echo ($campo_1 != "" and $campo_2) != "" ? 'update' : 'insert'; ?>">

                <div class="col-md-6">
                    <label for="id_catalogo" class="form-label">Id catalogo</label>
                    <input name="id_catalogo" type="number" class="form-control" id="id_catalogo" <?php if ($campo_1 != "") {
                        echo "readonly value='$campo_1'";
                    } ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="id_inventario" class="form-label">Inventario</label>
                    <input name="id_inventario" type="number" class="form-control" id="id_inventario" <?php if ($campo_2 != "") {
                        echo "value='$campo_2'";
                    } ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="id_proveedor" class="form-label">Proveedor</label>
                    <input name="id_proveedor" type="text" maxlength="3" class="form-control" id="id_proveedor" <?php if ($campo_3 != "") {
                        echo "value='$campo_3'";
                    } ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="descripcion_catalogo" class="form-label">Descripcion de catálogo</label>
                    <textarea class="form-control" rows="3" name="descripcion_catalogo" id="descripcion_catalogo"><?php if ($campo_4 != "") {
                        echo $campo_4;
                    } ?></textarea>
                    <!-- <input name="descripcion_catalogo" type="text" maxlength="60" class="form-control" id="descripcion_catalogo" <?php if ($campo_4 != "") {
                        echo "value='$campo_4'";
                    } ?> required> -->
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-6">
                    <label for="foto_catalogo" class="form-label">Foto catálogo</label>
                    <input name="foto_catalogo" type="file" accept="image/*" class="form-control" id="foto_catalogo">
                </div>

                <div class="col-md-6">
                    <label for="instrucciones_catalogo" class="form-label">Intrucciones de catalago.</label>
                    <input name="instrucciones_catalogo" type="text" class="form-control" id="instrucciones_catalogo"
                        <?php if ($campo_6 != "") {
                            echo "value='$campo_6'";
                        } ?>>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-success float-end" name="btnAgregarCatalogo" value="ok">
                        <?php echo $campo_1 != "" ? 'Modificar catalogo' : 'Agregar catalogo'; ?>
                    </button>
                </div>
            </form>
        </div>

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