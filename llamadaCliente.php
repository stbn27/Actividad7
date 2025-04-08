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
                <h1 class="text-center text-info-emphasis">Listado de llamada de los clientes</h1>
                <a href="./llamadaClienteAgregar.php" class="text-primary text-decoration-none">
                    <i class="bi bi-plus-circle fs-1"></i>
                </a>
            </div>

            <div class="table-responsive">

                <?php
                include("./libConectBD.php");
                $cn = Conectarse();

                $rs = pg_exec("SELECT * FROM llamada_cliente ORDER BY 1");
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
                                <th scope="col">Id cliente <i class="bi bi-key-fill"></i></th>
                                <th scope="col">Hora llamada cliente <i class="bi bi-key-fill"></i></th>
                                <th scope="col">Empleado atendio</th>
                                <th scope="col">Id tipo de llamada</th>
                                <th scope="col">Motivo de llamada</th>
                                <th scope="col">Tiempo de respuesta</th>
                                <th scope="col">Respuesta a la llamada</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            //Iterar para reportar registros
                            for ($i = 0; $i < $filas; $i++) {
                                //Obtener columnas
                                $id_cliente = pg_result($rs, $i, 0);
                                $hora_llamada_cliente = pg_result($rs, $i, 1);
                                $empleado_llamada_cliente = pg_result($rs, $i, 2);
                                $id_tipo_llamada_cliente = pg_result($rs, $i, 3);
                                $motivo_llamada_cliente = pg_result($rs, $i, 4);
                                $tiempo_respuesta_llamada_cliente = pg_result($rs, $i, 5);
                                $descripcion_respuesta_llamada_cliente = pg_result($rs, $i, 6);

                                echo "
                            <tr>
                                <th scope='row'>$id_cliente</th>

                                <td class='text-center'>$hora_llamada_cliente</td>
                                <td class='text-center'>$empleado_llamada_cliente</td>
                                <td class='text-center'><a class='text-decoration-none text-primary fw-bold' href='./agregarTipoLlamada?id=$id_tipo_llamada_cliente'>$id_tipo_llamada_cliente</a></td>
                                <td class='text-center'>$motivo_llamada_cliente</td>
                                <td class='text-center'>$tiempo_respuesta_llamada_cliente</td>
                                <td class='text-center'>$descripcion_respuesta_llamada_cliente</td>

                                <td class='align-middle'>
                                    <div class='d-flex justify-content-center gap-3'>

                                        <a href='./llamadaClienteAgregar.php?id1=$id_cliente&id2=$hora_llamada_cliente' class='btn-sm btn btn-primary'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </a>

                                        <a href='./controller/llamadaClienteEliminar.php?id1=$id_cliente&id2=$hora_llamada_cliente' class='btn btn-danger btn-sm'>
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