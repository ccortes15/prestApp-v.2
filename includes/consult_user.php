<?php
    include('db.php');
    session_start();
    error_reporting(0);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha_inicio = $_POST['startDate'];
        $fecha_final = $_POST['endDate'];
        $cliente = array();

        $sql = "SELECT usuario.nombre as nombre,cobro.cantidad as cantidad,cobro.fecha as fecha FROM cobro INNER JOIN usuario 
                ON cobro.id_usuario = usuario.id WHERE cobro.fecha between '$fecha_inicio' AND '$fecha_final'";
        $consulta = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if (mysqli_num_rows($consulta) > 0){
            while($row = mysqli_fetch_assoc($consulta)){
                $cliente[] = array($row['nombre'],$row['cantidad'],$row['fecha']);
            }
        }else{
            echo "0 resultados";
            echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
        }
    }else{
        $telefono = $_GET['telUser'];
        
        $sql = "SELECT usuario.nombre as nombre,cobro.cantidad as cantidad,cobro.fecha as fecha FROM cobro INNER JOIN usuario 
                ON cobro.id_usuario = usuario.id WHERE usuario.telefono = '$telefono'";
        $consulta = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if (mysqli_num_rows($consulta) > 0){
            while($row = mysqli_fetch_assoc($consulta)){
                $cliente[] = array($row['nombre'],$row['cantidad'],$row['fecha']);
            }
        }else{
            echo "Usuario no encontrado";
            echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Consulta</title>
</head>
<body>
        <section class="">
            <article>
                <div class="w-75 mx-auto"> 
                    <h2 class="text-center">Cliente</h2>
                </div>

                <table class="w-75 mx-auto table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td><?php echo $cliente[0][0]; ?></td>
                        <td><?php echo $cliente[0][1]; ?></td>
                        <td><?php echo $cliente[0][2]; ?></td>
                        </tr>
                        <tr>
                        <th scope="row">2</th>
                        <td><?php echo $cliente[1][0]; ?></td>
                        <td><?php echo $cliente[1][1]; ?></td>
                        <td><?php echo $cliente[1][2]; ?></td>
                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><?php echo $cliente[2][0]; ?></td>
                        <td><?php echo $cliente[2][1]; ?></td>
                        <td><?php echo $cliente[2][2]; ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="w-75 mx-auto d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-info btn-lg"><a href="../views/admin.php">Regresar</a></button>
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