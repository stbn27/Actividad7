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

        <div class="my-3 d-flex align-items-center justify-content-between">
            <h1 class="text-center text-info-emphasis">Listado de clientes</h1>
            <a href="./agregarCliente.php" class="text-primary text-decoration-none"><i
                    class="bi bi-person-add fs-1"></i></a>
        </div>
        <div class="table-responsive">

            <?php
            include("./libConectBD.php");
            $cn = Conectarse();

            $rs = pg_exec("SELECT * FROM cliente ORDER BY 1 DESC");
            if (!$rs) {
                alerta("danger", "Error de busqueda");
                exit;
            }

            //Obtener el numero de filas de la consulta
            $filas = pg_numrows($rs);
            if ($filas == 0) {
                alerta("info", "No se hallo algún registro");
                exit;
            } else {
                ?>

                <table class="table table-dark table-hover align-top">

                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Curp</th>
                            <th scope="col">Compañia cliente</th>
                            <th scope="col">Dirección</th>
                            <th>Contacto</th>
                            <th scope="col">Entidad bancaria</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        //Iterar para reportar registros
                        for ($i = 0; $i < $filas; $i++) {
                            //Obtener columnas
                            $id = pg_result($rs, $i, 0);
                            $nombre = pg_result($rs, $i, 1);
                            $ap1 = pg_result($rs, $i, 2);
                            $ap2 = pg_result($rs, $i, 3);
                            $sexo = pg_result($rs, $i, 4);
                            $curp = pg_result($rs, $i, 5);
                            $comp = pg_result($rs, $i, 6);
                            $dom1 = pg_result($rs, $i, 7);
                            $dom2 = pg_result($rs, $i, 8);
                            $ciudad = pg_result($rs, $i, 9);
                            $entidad = pg_result($rs, $i, 10);
                            $cp = pg_result($rs, $i, 11);
                            $telefono = pg_result($rs, $i, 12);
                            $celular = pg_result($rs, $i, 13);
                            $tarjeta = pg_result($rs, $i, 14);
                            $banco = pg_result($rs, $i, 15);
                            $fechaExp = pg_result($rs, $i, 16);
                            echo <<<EOT
                            <tr id="cliente-row-$id">
                                <th scope="row">$id</th>
                                <td>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Nombre(s):
                                        </span><span>$nombre</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Apellido materno:
                                        </span><span>$ap1</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Apelido paterno:
                                        </span><span>$ap2</span>
                                    </p>
                                </td>
                                <td class="text-center">$sexo</td>
                                <td>$curp</td>
                                <td class="text-center">$comp</td>
                                <td>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Domicilio 1: </span><span>$dom1</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Domicilio 2: </span><span>$dom2</span>
                                    </p>
                                    <p class="m-0">
                                        <span
                                            class="text-secondary small d-block">Ciudad:</span><span>$ciudad</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Entidad federativa:
                                        </span><span><a href="./agregarEntidadFederativa.php?id=$entidad">$entidad</a></span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Código postal:
                                        </span><span>$cp</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Celular: </span><span>$celular</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary small d-block">Télefono: </span><span>$telefono</span>
                                    </p>
                                </td>
                                <td>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Banco: </span><a
                                            class="text-primary" href="#">$banco</a>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Tarjeta de crédito:
                                        </span><span>$tarjeta</span>
                                    </p>
                                    <p class="m-0">
                                        <span class="text-secondary d-block small">Expiración tarjeta:
                                        </span><span>$fechaExp</span>
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex flex-column justify-content-center gap-3">

                                        <a href="./agregarCliente.php?id=$id" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil fs-5"></i>
                                        </a>

                                        <button class="btn btn-danger btn-sm" disabled>
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        EOT;
                        }
                        ?>
                    </tbody>
                </table>

                <?php
            }
            //Liberar Result Set
            ($resultado);
            Desconectarse($cn);
            ?>
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