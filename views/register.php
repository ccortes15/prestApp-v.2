<?php
    include('../includes/db.php');
    session_start();
    error_reporting(0);

    $nombre = $_SESSION['nombre'];
    $correo = $_SESSION['correo'];
    $telefono = $_SESSION['telefono'];
    $pagos = array();

    $sql_pago = "SELECT cantidad,fecha FROM pago inner join usuario
            on pago.id_usuario = usuario.id WHERE usuario.telefono = '$telefono'";
    $sql_cobro = "SELECT cantidad as deuda FROM cobro inner join usuario
            on cobro.id_usuario = usuario.id WHERE usuario.telefono = '$telefono'";
    $consulta_pago = mysqli_query($conn,$sql_pago) or die(mysqli_error($conn));
    $consulta_cobro = mysqli_query($conn,$sql_cobro) or die(mysqli_error($conn));

    if(mysqli_num_rows($consulta_pago) > 0){
        while($row = mysqli_fetch_assoc($consulta_pago)){
            $pagos[] = array($row['cantidad'],$row['fecha']);
        }
    }
    if(mysqli_num_rows($consulta_cobro) > 0){
        while($row2 = mysqli_fetch_assoc($consulta_cobro)){
            $deuda = $row2['deuda'];
        }
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
    <title>Estado de cuenta</title>
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
            <article>
                <div class="w-75 mx-auto"> 
                    <h2 class="text-center">Pagos Realizados</h2>
                </div>

                <table class="w-75 mx-auto table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><?php echo $pagos[0][0]; ?></td>
                        <td><?php echo $pagos[0][1]; ?></td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td><?php echo $pagos[1][0]; ?></td>
                        <td><?php echo $pagos[1][1]; ?></td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><?php echo $pagos[2][0]; ?></td>
                        <td><?php echo $pagos[2][1]; ?></td>
                        </tr>
                    </tbody>
                </table>
            </article>

            <hr>

            <article>
                <div class="mx-auto">
                        <h2 class="display-4 text-center text-break">Deuda pendiente</h2>
                        <br>
                        <h2 id="total_clientes" class="display-4 text-center text-break"><?php echo $deuda ?></h2>
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