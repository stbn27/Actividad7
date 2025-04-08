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
                <h1 class="text-center text-info-emphasis">Listado de pedidos</h1>
                <a href="./pedidoAgregar.php" class="text-primary text-decoration-none">
                    <i class="bi bi-plus-circle fs-1"></i>
                </a>
            </div>

            <div class="table-responsive">

                <?php
                include("./libConectBD.php");
                $cn = Conectarse();

                $rs = pg_exec("SELECT * FROM pedido ORDER BY 1");
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
                                <th scope="col">Id pedido <i class="bi bi-key-fill"></i></th>
                                <th scope="col" class="text-nowrap">Fecha de pedido</th>
                                <th scope="col">Cliente</th>
                                <th scope="col" style="min-width: 160px;">Intrucciones envío</th>
                                <th scope="col">Firma recibido</th>
                                <th scope="col">Número de factura</th>
                                <th scope="col" class="text-nowrap">Fecha envío pedido</th>
                                <th scope="col">Peso de envío</th>
                                <th scope="col">Cargo por envío</th>
                                <th scope="col" class="text-nowrap">Fecha de pago</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //Iterar para reportar registros
                            for ($i = 0; $i < $filas; $i++) {
                                //Obtener columnas
                                $campo_1 = pg_result($rs, $i, 0);
                                $campo_2 = pg_result($rs, $i, 1);
                                $campo_3 = pg_result($rs, $i, 2);
                                $campo_4 = pg_result($rs, $i, 3);
                                $campo_5 = pg_result($rs, $i, 4);
                                $campo_6 = pg_result($rs, $i, 5);
                                $campo_7 = pg_result($rs, $i, 6);
                                $campo_8 = pg_result($rs, $i, 7);
                                $campo_9 = pg_result($rs, $i, 8);
                                $campo_10 = pg_result($rs, $i, 9);

                                echo "
                            <tr>
                                <th scope='row'>$campo_1</th>
                                <td class='text-center'>$campo_2</td>
                                <td class='text-center'><a class='text-decoration-none text-primar y fw-bold' href='./agregarCliente.php?id=$campo_3'>$campo_3</a></td>
                                <td class='text-center'>$campo_4</td>
                                <td class='text-center'>$campo_5</td>
                                <td class='text-center'>$campo_6</td>
                                <td class='text-center'>$campo_7</td>
                                <td class='text-center text-nowrap'>$campo_8</td>
                                <td class='text-center text-nowrap'>$campo_9</td>
                                <td class='text-center'>$campo_10</td>

                                <td class='align-middle'>
                                    <div class='d-flex justify-content-center gap-3'>

                                        <a href='./pedidoAgregar.php?id=$campo_1' class='btn-sm btn btn-primary'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </a>

                                        <a href='./controller/pedidoEliminar.php?id=$campo_1' class='btn btn-danger btn-sm'>
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