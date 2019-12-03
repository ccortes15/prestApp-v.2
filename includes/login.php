<?php
    include("db.php");
    session_start();
    error_reporting(0);

    $usuario = $_POST['user'];
    $contraseña = $_POST['pass'];

    $query = "SELECT * FROM usuario WHERE telefono = '$usuario' AND contraseña = '$contraseña'";
    $consulta = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if(mysqli_num_rows($consulta) > 0){
        while($row = mysqli_fetch_assoc($consulta)){
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['telefono'] = $row['telefono'];
                $_SESSION['correo'] = $row['correo'];
                $tipo = $row['id_rol'];
            }
        if($tipo == 1){
            header("location: ../views/admin.php");
        }else{
            header("location: ../views/register.php");
        }
    }
    else{
        echo "Usuario no registrado <br>";
        echo("<button onclick=\"location.href='../index.html'\">Regresar</button>");
    };
?>