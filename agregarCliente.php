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

        <div class="container">

            <div class="my-3 d-flex align-items-center justify-content-between">
                <h1 class="text-center text-info-emphasis">Agregar cliente</h1>
                <a href="./clientes.php" class="text-primary text-decoration-none"><i class="bi bi-person-lines-fill fs-1"></i></a>
            </div>

            <?php
            include "./libConectBD.php";
            
            ?>

            <form id="formEditar" class="row g-3 needs-validation" novalidate method="post" action="./controller/agregarCliente.php">

                <!-- Nombre y apellidos del cliente -->
                <div class="col-md-4">
                    <label for="form_nombre_cliente" class="form-label">Nombre(s)</label>
                    <input name="nombre" type="text" class="form-control" id="form_nombre_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>
                <div class="col-md-4">
                    <label for="form_paterno_cliente" class="form-label">Apellidos Paterno</label>
                    <input name="paterno" type="text" class="form-control" id="form_paterno_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>
                <div class="col-md-4">
                    <label for="form_materno_cliente" class="form-label">Apellido Materno</label>
                    <input name="materno" type="text" class="form-control" id="form_materno_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <!-- Sexo, curp y compañia -->
                <div class="col-md-4">
                    <label for="form_sexo_cliente" class="form-label">Sexo</label>
                    <div class="mb-3">
                        <select name="sexo" class="form-select" required aria-label="Seleccionar sexo"
                            id="form_sexo_cliente">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="form_curp_cliente" class="form-label">Curp</label>
                    <input name="curp" type="text" class="form-control" id="form_curp_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>
                <div class="col-md-4">
                    <label for="form_compania_cliente" class="form-label">Compañia cliente</label>
                    <input name="compania" type="text" class="form-control" id="form_compania_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <!-- Dirección del cliente -->
                <div class="col-12">
                    <label for="form_domicilio_prin_cliente" class="form-label">Domicilio principal:</label>
                    <input name="domicilio_prin" type="text" class="form-control" id="form_domicilio_prin_cliente"
                        placeholder="1234 Main St" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>
                <div class="col-12">
                    <label for="form_domicilio_alt_cliente" class="form-label">Domicilio alterno:</label>
                    <input name="domicilio_alt" type="text" class="form-control" id="form_domicilio_alt_cliente"
                        placeholder="Apartment, or floor">
                </div>
                <div class="col-md-6">
                    <label for="form_ciudad_cliente" class="form-label">Ciudad</label>
                    <input name="ciudad" type="text" class="form-control" id="form_ciudad_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <div class="col-md-4">
                    <label for="form_entidad_fed_cliente" class="form-label">Entidad federativa</label>
                    <div class="mb-3">
                        <select name="entidad_fed" class="form-select" required
                            aria-label="Seleccionar entidad federativa" id="form_entidad_fed_cliente">
                            <?php
                            $cn = Conectarse();
                            $query = "SELECT * FROM entidad_federativa ORDER BY 1";
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
                                    echo "<option value='$id'>$nombre</option>";
                                }
                            }
                            //Liberar Result Set
                            ($resultado);
                            Desconectarse($cn);
                            ?>
                        </select>
                        <div class="invalid-feedback">Opción inválida</div>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="form_cp_cliente" class="form-label">Código postal</label>
                    <input name="cp" type="text" class="form-control" id="form_cp_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>

                <!-- Contacto del cliente -->
                <div class="col-md-6">
                    <label for="form_telefono_cliente" class="form-label">Teléfono</label>
                    <input name="telefono" type="text" class="form-control" id="form_telefono_cliente" required>
                    <p class="invalid-feedback ms-2">Campo requerido</p>
                </div>
                <div class="col-md-6">
                    <label for="form_celular_cliente" class="form-label">Celular</label>
                    <input name="celular" type="text" class="form-control" id="form_celular_cliente">
                </div>

                <!-- Datos bancarios del cliente -->
                <div class="col-md-4">
                    <label for="form_banco_cliente" class="form-label">Banco</label>
                    <div class="mb-3">
                        <select name="banco" class="form-select" required aria-label="Seleccionar banco"
                            id="form_banco_cliente">
                            <?php
                            $cn = Conectarse();
                            $query = "SELECT * FROM banco ORDER BY 1";
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
                                    echo "<option value='$id'>$nombre</option>";
                                }
                            }
                            //Liberar Result Set
                            ($resultado);
                            Desconectarse($cn);
                            ?>
                        </select>
                        <div class="invalid-feedback">Opción inválida</div>
                    </div>
                </div>

                <div class="col-md-5">
                    <label for="form_tarjeta_cliente" class="form-label">Tarjeta de crédito</label>
                    <input name="tarjeta" type="text" class="form-control" id="form_tarjeta_cliente">
                </div>
                <div class="col-md-3">
                    <label for="form_expiracion_cliente" class="form-label">Expiración tarjeta</label>
                    <input name="expiracion" type="text" class="form-control" id="form_expiracion_cliente">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success float-end" name="btnregistrarcliente" value="ok">Agregar cliente</button>
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