<?php
    include('../includes/db.php');
    session_start();
    error_reporting(0);

    $nombre = $_SESSION['nombre'];
    $correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];
    $cantidad_ingr = 0;
    $cantidad_pend = 0;

    $sql_pend = "SELECT cantidad as cant_pend FROM cobro";
    $sql_ingr = "SELECT cantidad as cant_ingr FROM pago";
    $consulta_ingr = mysqli_query($conn, $sql_ingr) or die(mysqli_error($conn));
    $consulta_pend = mysqli_query($conn, $sql_pend) or die(mysqli_error($conn));

    while($row_ingr = mysqli_fetch_assoc($consulta_ingr)){
        $cantidad_ingr = $cantidad_ingr + $row_ingr['cant_ingr'];
    }
    while($row_pend = mysqli_fetch_assoc($consulta_pend)){
        $cantidad_pend = $cantidad_pend + $row_pend['cant_pend'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../public/css/admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark float-right">
        <span class="navbar-text">
            Dashboard
        </span>

        <ul class="navbar-nav d-flex justify-content-end">
            <li class="nav-item">
                <a class="nav-link text-white" href="#!">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#!">Configuración</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="../includes/logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </nav>

    <aside class="float-left bg-success">
        <div class="w-100 mx-auto d-flex justify-content-center mt-2">
            <img src="../public/img/user.jpg" class="rounded-circle w-50">
        </div>
        
        <hr>

        <div class="w-100 mx-auto text-center">
            <p class="text-white"><?php echo $nombre; ?></p>
            <p class="text-white"><?php echo $telefono; ?></p>
            <p class="text-white"><?php echo $correo; ?></p>
        </div>

        <hr>
    </aside>

    <section class=" float-right">
        <article class="jumbotron m-0 p-4">
            <h2 class="display-4">Hola de nuevo :)</h2>
            <p class="lead">¿Que planeas hacer hoy?</p>

            <hr>

            <div class=" w-50 mx-auto d-flex justify-content-between">
                <div class="modal fade" id="modalForm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="../includes/insert_user.php" method="POST" class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Registrar Cliente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="nameUser">Nombre de Cliente</label>
                                    <input type="text" name="nameUser" class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="telUser">Teléfono</label>
                                    <input type="tel" name="telUser" maxlength="10" class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <i class="fas fa-tag prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="mailUser">Correro Electrónico</label>
                                    <input type="email" name="mailUser" class="form-control validate">
                                </div>

                                <div class="md-form">
                                    <i class="fas fa-pencil prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="passUser">Contraseña</label>
                                    <input type="password" name="passUser" class="form-control validate">
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-unique" type="submit">Registrar<i class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="../includes/insert_cobro.php" method="POST"  class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Cobro</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="nameUser">Cantidad</label>
                                    <input type="number" name="cantCobro" placeholder="Ingrese cantidad de cobro"
                                        class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="selUser">Cliente</label>
                                    <input type="tel" name="telCobro" placeholder="Ingrese telefono de usuario" 
                                        class="form-control validate" maxlength="10">
                                </div>

                                <div class="md-form mb-5 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="allUsers" id="switch1">
                                    <label class="custom-control-label" for="switch1">Añadir a todos los
                                        clientes</label>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-unique" type="submit">Añadir<i
                                        class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalForm3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="../includes/insert_pago.php" method="POST" class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Pago</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="quantityPay">Cantidad</label>
                                    <input type="number" id="quantityPay" name="cantPago"
                                        placeholder="Ingrese cantidad de pago" class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="payUser">Cliente</label>
                                    <input type="tel" id="payUser" name="telUser" maxlength="10"
                                        placeholder="Ingrese telefono de usuario" class="form-control validate">
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-unique" type="submit">Añadir<i class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#modalForm1">Añadir usuario</button>

                <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#modalForm2">Añadir cobro</button>

                <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#modalForm3">Añadir pago</button>
            </div>
        </article>

        <article class="container-fluid w-100 mt-3 p-4">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="mx-auto">
                        <h2 class="display-4 text-center text-break">Ingresos</h2>
                        <br>
                        <h2 id="total_clientes" class="display-4 text-center text-break"><?php echo $cantidad_ingr ?></h2>
                    </div>
                </div>

                <div class="col-md-6 d-flex justify-content-center">
                    <div class="mx-auto">
                        <h2 class="display-4 text-center text-break">Pendiente</h2>
                        <br>
                        <h2 id="total_clientes" class="display-4 text-center text-break"><?php echo $cantidad_pend ?></h2>
                    </div>
                </div>
            </div>
        </article>

        <article class="mt-3 p-4">
            <div class=" w-50 mx-auto d-flex justify-content-between">
                <div class="modal fade" id="modalForm4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="../includes/consult_user.php" method="GET" class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Consultar Cliente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-envelope prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="payUser">Cliente</label>
                                    <input type="tel" id="payUser" name="telUser" maxlength="10"
                                        placeholder="Ingrese telefono de usuario" class="form-control validate">
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-unique" type="submit">Consultar<i
                                        class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modalForm5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="../includes/consult_user.php" method="POST" class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Consultar Cliente</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="startDate">Fecha de
                                        inicio</label>
                                    <input type="date" id="startDate" name="startDate"
                                        placeholder="Ingrese fecha de inicio" class="form-control validate">
                                </div>

                                <div class="md-form mb-5">
                                    <i class="fas fa-user prefix grey-text"></i>
                                    <label data-error="wrong" data-success="right" for="endDate">Fecha de cierre</label>
                                    <input type="date" id="endDate" name="endDate" placeholder="Ingrese fecha de cierre"
                                        class="form-control validate">
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button class="btn btn-unique" type="submit">Consultar<i
                                        class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#modalForm4">Consultar por cliente</button>

                <button type="button" class="btn btn-outline-success btn-lg" data-toggle="modal"
                    data-target="#modalForm5">Consultar por fecha</button>
            </div>
        </article>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>