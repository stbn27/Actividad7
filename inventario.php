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
                <h1 class="text-center text-info-emphasis">Listado de inventario</h1>
                <a href="./agregarInventario.php" class="text-primary text-decoration-none">
                    <i class="bi bi-plus-circle fs-1"></i>
                </a>
            </div>

            <div class="table-responsive">

                <?php
                include("./libConectBD.php");
                $cn = Conectarse();

                $rs = pg_exec("SELECT * FROM inventario ORDER BY 1");
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
                                <th scope="col">Id inventario</th>
                                <th scope="col">Id proveedor</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Precio unitario</th>
                                <th scope="col">Empaque</th>
                                <th scope="col">Descripcion inventario</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //Iterar para reportar registros
                            for ($i = 0; $i < $filas; $i++) {
                                //Obtener columnas
                                $id_inventario = pg_result($rs, $i, 0);
                                $id_proveedor = pg_result($rs, $i, 1);
                                $descripcion_inventario = pg_result($rs, $i, 2);
                                $precio_unitario_inventario = pg_result($rs, $i, 3);
                                $empaque_inventario = pg_result($rs, $i, 4);
                                $descripcion_empaque_inventario = pg_result($rs, $i, 5);

                                echo "
                            <tr>
                                <th scope='row'>$id_inventario</th>

                                <td class='text-center'>$id_proveedor</td>
                                <td class='text-center'>$descripcion_inventario</td>
                                <td class='text-center'>$precio_unitario_inventario</td>
                                <td class='text-center'>$empaque_inventario</td>
                                <td class='text-center'>$descripcion_empaque_inventario</td>

                                <td class='align-middle'>
                                    <div class='d-flex justify-content-center gap-3'>

                                        <a href='./agregarInventario.php?id1=$id_inventario&id2=$id_proveedor' class='btn-sm btn btn-primary'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </a>

                                        <a href='./controller/eliminarInventario.php?id1=$id_inventario&id2=$id_proveedor' class='btn btn-danger btn-sm'>
                                            <i class='bi bi-trash fs-5'></i>
                                        </a>
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