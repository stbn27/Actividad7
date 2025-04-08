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
                <h1 class="text-center text-info-emphasis">Listado de catalogos</h1>
                <a href="./catalogoAgregar.php" class="text-primary text-decoration-none">
                    <i class="bi bi-plus-circle fs-1"></i>
                </a>
            </div>

            <div class="table-responsive">

                <?php
                include("./libConectBD.php");
                $cn = Conectarse();

                $rs = pg_exec("SELECT * FROM catalogo ORDER BY 1");
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
                                <th scope="col">Id catalogo<i class="bi bi-key-fill"></i></th>
                                <th scope="col">Inventario</th>
                                <th scope="col">Id proveedor</th>
                                <th scope="col">Descripción catálogo</th>
                                <th scope="col">Foto catalogo</th>
                                <th scope="col">Intrucciones catalogo</th>
                                <th scope="col">Acciones</th>
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

                                echo "
                            <tr>
                                <th scope='row'>$campo_1</th>                                
                                <td class='text-center'><a href='./agregarInventario.php?id1=$campo_2&id2=$campo_3' class='text-text-decoration-none fw-bold text-warning'>$campo_2</a></td>
                                <td class='text-center'><a href='./agregarProveeedor.php?id=$campo_3' class='text-text-decoration-none fw-bold text-warning'>$campo_3</a></td>
                                <td class='text-center'>$campo_4</td>
                                <td class='text-center'>$campo_5</td>
                                <td class='text-center'>$campo_6</td>
                                <td class='align-middle'>
                                    <div class='d-flex justify-content-center gap-3 w-100'>

                                        <a href='./catalogoAgregar.php?id=$campo_1' class='btn-sm btn btn-primary'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </a>

                                        <a href='./controller/catalogoEliminar.php?id=$campo_1' class='btn btn-danger btn-sm'>
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