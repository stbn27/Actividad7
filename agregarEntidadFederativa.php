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

    include("plantilla.php");

    echo header_plantilla();


    ?>


    <main class="px-4 my-4" style="min-height: calc(100vh - 210px);">

        <div class="container mx-auto">

            <div class="my-3 d-flex align-items-center justify-content-between">
                <h1 class="text-center text-info-emphasis">Agregar entidadad federativa</h1>
                <a href="./entidadFederativa.php" class="text-primary text-decoration-none">
                    <i class="bi bi-list-columns-reverse fs-1"></i>
                </a>
            </div>

        </div>

        <!-- Verificar si es modificación o agregación -->
        <?php
        include "./libConectBD.php";
        // Creamos las variables (SIEMPRE MANTIENE EL MISMO NOMBRE EN TODO.)
        $campo_1 = "";
        $campo_2 = "";

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $cn = Conectarse();

            $rs = pg_exec("SELECT * FROM entidad_federativa WHERE id_entidad_federativa = '$id'");
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
        } 

        ?>

        <form class="row g-3 needs-validation" novalidate method="post" action="./controller/agregarEntidadFederativa.php"> 


                <input type="hidden" name="tipo" value="<?php echo $campo_1 != "" ? 'update' : 'insert'; ?>">

                <!-- id de la entidad Federativa -->
                <div class="col-md-6">
                    <label for="id_entidad" class="form-label">Id Entidad federativa</label>
                    <input name="id_entidad" type="text" class="form-control" id="id_entidad" <?php if($campo_1 != ""){echo "disabled value='$campo_1'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <!-- Nombre de la entidad federativa -->
                <div class="col-md-6">
                    <label for="nombre_entidad" class="form-label">Nombre Entidad Federativa</label>
                    <input name="nombre_entidad" type="text" class="form-control" id="nombre_entidad" <?php if($campo_2 != ""){echo "value='$campo_2'";} ?> required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success float-end" name="btnagregar" value="ok">
                        <?php echo $campo_1 != "" ? 'Modificar' : 'Agregar'; ?>
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