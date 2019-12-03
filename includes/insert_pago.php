<?php
    include("db.php");

    $cantidad = $_POST['cantPago'];
    $telefono = $_POST['telUser'];
    $fecha = date("Y/m/d");
    
    //revisar si existe algun cobro de dicho usuario
    $filas = "SELECT * FROM cobro inner Join usuario on cobro.id_usuario=usuario.id where usuario.telefono = '$telefono'";
    $consulta = mysqli_query($conn,$filas) or die(mysqli_error($conn));
    $contenido = mysqli_fetch_array($consulta);

    if($contenido > 0){
        $sql = "UPDATE cobro SET cantidad = (cantidad - '$cantidad'), fecha = '$fecha' where id_usuario = '$contenido[3]'";
        $consulta = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        $sql2 = "INSERT INTO pago(id_pago,cantidad,fecha,id_usuario) values (null, '$cantidad', '$fecha', '$contenido[3]')";
        $consulta2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        echo "Pago agregado.";
        echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
    }
    else{
        echo "Usuario no encontrado";
        echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
    }
?>