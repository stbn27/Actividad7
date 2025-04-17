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
    include "plantilla.php";
    echo header_plantilla();
    ?>


    <main class="px-4 my-4" style="min-height: calc(100vh - 210px);">

        <div class="container mx-auto">

            <?php
            if (isset($_SESSION['mensaje'])) {
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            ?>
            <div class="my-3 d-flex align-items-center justify-content-between">
                <h1 class="text-center text-info-emphasis">Listado de proveedores</h1>
                <a href="./agregarEntidadFederativa.php" class="text-primary text-decoration-none">
                    <i class="bi bi-plus-circle fs-1"></i>
                </a>
            </div>

            <div class="table-responsive">

                <?php
                include("./libConectBD.php");
                $cn = Conectarse();

                $rs = pg_exec("SELECT * FROM proveedor ORDER BY 1");
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
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre del proveedor</th>
                                <th class="text-center" scope="col">Tiempo de entrega</th>
                                <th class="text-end" >Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //Iterar para reportar registros
                            for ($i = 0; $i < $filas; $i++) {
                                //Obtener columnas
                                $id = pg_result($rs, $i, 0);
                                $nombre = pg_result($rs, $i, 1);
                                $tiempo = pg_result($rs, $i, 2);

                                echo "
                            <tr>
                                <th scope='row'>$id</th>

                                <td >$nombre</td>

                                <td class='text-center text-warning'>$tiempo</td>

                                <td class='align-middle text-end'>
                                    <div class='d-flex justify-content-center gap-3'>

                                        <a href='./agregarEntidadFederativa.php?id=$id' class='btn-sm btn btn-primary'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </a>

                                        <button class='btn btn-danger btn-sm' disabled>
                                            <i class='bi bi-trash fs-5'></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        ";
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
        </div>
    </main>


    <?php
    echo footer_plantilla();
    ?>


    </body>

</html>