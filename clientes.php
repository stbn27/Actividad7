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

    if (isset($_SESSION['mensaje'])) {
        echo $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
    }
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
                            <!-- <th scope="col">Nombre</th>
                        <th scope="col">Apellido paterno</th>
                        <th scope="col">Apellido materno</th> -->
                            <th scope="col">Nombre completo</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Curp</th>
                            <th scope="col">Compañia cliente</th>
                            <!-- <th scope="col">Domicilio 1</th>
                        <th scope="col">Domicilio 2</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Entidad federativa</th>
                        <th scope="col">C. P.</th> -->
                            <th scope="col">Dirección</th>
                            <!-- <th scope="col">Teléfono</th>
                        <th scope="col">Celular</th> -->
                            <th>Contacto</th>
                            <!-- <th scope="col">Banco</th>
                        <th scope="col">Tajeta crédito</th>
                        <th scope="col">Expiración tarjeta</th> -->
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
                            echo "
                            <tr id='cliente-row-$id'>
                                <th scope='row'>$id</th>
                                <td>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Nombre(s):
                                        </span><span>$nombre</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Apellido materno:
                                        </span><span>$ap1</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Apellido paterno:
                                        </span><span>$ap2</span>
                                    </p>
                                </td>
                                <td class='text-center'>$sexo</td>
                                <td>$curp</td>
                                <td class='text-center'>$comp</td>
                                <td>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Domicilio 1: </span><span>$dom1</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Domicilio 2: </span><span>$dom2</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Ciudad:</span><span>$ciudad</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Entidad federativa:
                                        </span><span><a href='./agregarEntidadFederativa.php?id=$entidad'>$entidad</a></span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Código postal:
                                        </span><span>$cp</span>
                                    </p>
                                </td>
                                <td>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Celular: </span><span>$celular</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary small d-block'>Teléfono: </span><span>$telefono</span>
                                    </p>
                                </td>
                                <td>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Banco: </span><a
                                            class='text-primary' href='#'>$banco</a>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Tarjeta de crédito:
                                        </span><span>$tarjeta</span>
                                    </p>
                                    <p class='m-0'>
                                        <span class='text-secondary d-block small'>Expiración tarjeta:
                                        </span><span>$fechaExp</span>
                                    </p>
                                </td>
                                <td class='align-middle'>
                                    <div class='d-flex flex-column justify-content-center gap-3'>

                                        <button type='button' class='btn-sm btn btn-primary' data-id='$id' data-bs-toggle='modal' data-bs-target='#edicionCliente'>
                                            <i class='bi bi-pencil fs-5'></i>
                                        </button>

                                        <a href='./controller/eliminarCliente.php?id=$id' class='btn btn-danger btn-sm'>
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
    </main>

    <!-- Modal de edición de datos -->
    <div class="modal fade" id="edicionCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edicionClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edicionClienteLabel">
                        Editar cliente
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formEditar" class="row g-3 needs-validation" novalidate method="post">
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
                            <input name="domicilio_prin" type="text" class="form-control"
                                id="form_domicilio_prin_cliente" placeholder="1234 Main St" required>
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

                        <input name="id_cliente" type="hidden" id="form_cliente_id" name="id">

                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-end" id="form_id_cliente">Actualizar
                                información</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>


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

        function handleFormSubmit(formId) {
            const form = document.getElementById(formId);
            const formData = new FormData(form);

            fetch('./controller/clienteController.php?action=update', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Oculta el modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('edicionCliente'));
                        modal.hide();

                        console.log(data.cliente);
                        // Actualiza la fila en la tabla
                        actualizarFilaCliente(data.cliente);

                        // Opcional: mensaje de éxito
                        alert('Cliente actualizado correctamente');
                    } else {
                        alert('Error al actualizar: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function actualizarFilaCliente(cliente) {
            const fila = document.getElementById(`cliente-row-${cliente.id}`);
            if (fila) {
                const celdas = fila.querySelectorAll('td');

                // Actualizar la información en las celdas
                fila.querySelector('th[scope="row"]').textContent = cliente.id; // ID

                // Celda de Nombre
                celdas[0].querySelector('span:nth-child(2)').textContent = cliente.nombre;
                celdas[0].querySelector('p:nth-child(2) span:nth-child(2)').textContent = cliente.materno;
                celdas[0].querySelector('p:nth-child(3) span:nth-child(2)').textContent = cliente.paterno;

                celdas[1].textContent = cliente.sexo; // Sexo
                celdas[2].textContent = cliente.curp; // CURP
                celdas[3].textContent = cliente.compania; // Compañía

                // Celda de Domicilio
                celdas[4].querySelector('p:nth-child(1) span:nth-child(2)').textContent = cliente.domicilio_prin;
                celdas[4].querySelector('p:nth-child(2) span:nth-child(2)').textContent = cliente.domicilio_alt;
                celdas[4].querySelector('p:nth-child(3) span:nth-child(2)').textContent = cliente.ciudad;
                celdas[4].querySelector('p:nth-child(4) a').textContent = cliente.entidad_fed;
                celdas[4].querySelector('p:nth-child(5) span:nth-child(2)').textContent = cliente.cp;

                // Celda de Contacto
                celdas[5].querySelector('p:nth-child(1) span:nth-child(2)').textContent = cliente.celular;
                celdas[5].querySelector('p:nth-child(2) span:nth-child(2)').textContent = cliente.telefono;

                // Celda de Banco
                celdas[6].querySelector('p:nth-child(1) a').textContent = cliente.banco;
                celdas[6].querySelector('p:nth-child(2) span:nth-child(2)').textContent = cliente.tarjeta;
                celdas[6].querySelector('p:nth-child(3) span:nth-child(2)').textContent = cliente.expiracion;
            }
        }


        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('edicionCliente');

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const clienteId = button.getAttribute('data-id');

                // Consulta AJAX al servidor
                fetch(`./controller/clienteController.php?action=get&id=${clienteId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('form_cliente_id').value = data.id_cliente.trim();
                        document.getElementById('form_nombre_cliente').value = data.nombre_cliente.trim();
                        document.getElementById('form_paterno_cliente').value = data.apellido_paterno_cliente.trim();
                        document.getElementById('form_materno_cliente').value = data.apellido_materno_cliente.trim();
                        document.getElementById('form_sexo_cliente').value = data.sexo_cliente.trim();
                        document.getElementById('form_curp_cliente').value = data.curp_cliente.trim();
                        document.getElementById('form_compania_cliente').value = data.compania_cliente.trim();
                        document.getElementById('form_domicilio_prin_cliente').value = data.domicilio_cliente.trim();
                        document.getElementById('form_domicilio_alt_cliente').value = data.domicilio_alterno_cliente;
                        document.getElementById('form_ciudad_cliente').value = data.ciudad_cliente.trim();
                        document.getElementById('form_entidad_fed_cliente').value = data.id_entidad_federativa.trim();
                        document.getElementById('form_cp_cliente').value = data.codigo_postal_cliente.trim();
                        document.getElementById('form_telefono_cliente').value = data.telefono_cliente.trim();
                        document.getElementById('form_celular_cliente').value = data.celular_cliente;
                        document.getElementById('form_banco_cliente').value = data.id_banco.trim();
                        document.getElementById('form_tarjeta_cliente').value = data.tarjeta_credito_cliente.trim();
                        document.getElementById('form_expiracion_cliente').value = data.fecha_expiracion_tarjeta_credito_cliente.trim();

                    })
                    .catch(error => {
                        console.error('Error al obtener cliente:', error);
                    });
            });
        });
    </script>


</body>

</html>