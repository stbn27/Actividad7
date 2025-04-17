<?php

// plantilla para el header
function head_plantilla()
{
    return '
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
        ';
}

// plantilla header
function header_plantilla()
{
    return '
            <header class="bg-body-tertiary">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between w-100">
                        <button class="btn btn-outline-secondary border-0" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#menu">
                            <i class="bi bi-list fs-3"></i>
                        </button>

                        <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="menu" style="width: 250px;">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title text-primary">BASE MASTER</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="list-unstyled ps-0">

                                    <li class="mb-1">
                                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#usuario-collapse">
                                            Clientes
                                            <i class="bi bi-caret-left-fill"></i>
                                        </button>
                                        <div class="collapse show" id="usuario-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li class="mt-2">
                                                    <a href="./clientes.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Listado</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./agregarCliente.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar usuario</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./entidadFederativa.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Entidades Federativas</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./agregarEntidadFederativa.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar Entidad F.</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="mb-1">
                                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#llamada-collapse">
                                            Llamadas
                                            <i class="bi bi-caret-left-fill"></i>
                                        </button>
                                        <div class="collapse show" id="llamada-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li class="mt-2">
                                                    <a href="./llamadaCliente.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Listado</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./llamadaClienteAgregar.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar llamada</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./tipoLlamadaCliente" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Tipos de llamdas</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./tipoLlamadaClienteAgregar" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar tipo de llamada</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> 

                                    <li class="mb-1">
                                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#inventario-collapse">
                                            Inventario
                                            <i class="bi bi-caret-left-fill"></i>
                                        </button>
                                        <div class="collapse show" id="inventario-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li class="mt-2">
                                                    <a href="./inventario.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Listado</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./agregarInventario.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar inventario</a>
                                                </li>
                                                <li>
                                                    <div class="text-muted ps-4">
                                                        <hr>
                                                    </div>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Artículos</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar artículo</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./catalogo.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Catálogo</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./catalogoAgregar.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar Catálogo</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./proveedor.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Proveedor</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="#" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar proveedor</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> 

                                    <li class="mb-1">
                                        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#pedido-collapse">
                                            Pedidos
                                            <i class="bi bi-caret-left-fill"></i>
                                        </button>
                                        <div class="collapse show" id="pedido-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                <li class="mt-2">
                                                    <a href="./pedido.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Listado</a>
                                                </li>
                                                <li class="mt-2">
                                                    <a href="./pedidoAgregar.php" class="link-body-emphasis d-inline-flex text-decoration-none ms-4">Agregar pedido</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <a class="navbar-brand" href="#">
                            <img src="./img/logo_120x35.svg" alt="Logo" class="d-inline-block align-text-top">
                        </a>
                    </div>
                </div>
            </nav>
        </header>
    ';
}

// plantilla footer
function footer_plantilla()
{
    return '
            <footer class="d-flex flex-wrap justify-content-between align-items-center p-3 my-4 border-top bg-black">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2026 || BASE MASTER</span>
                </div>
            
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li><img src="./img/logo_120x35.svg" alt=""></li>
                </ul>
            </footer>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
        ';
}

function alerta($tipo, $mensaje)
{
    return '
            <div class="alert alert-$tipo alert-dismissible fade show" role="alert">
                <strong>$mensaje</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
}

?>