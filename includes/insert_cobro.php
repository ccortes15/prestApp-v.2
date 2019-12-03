<?php
    include("db.php");
    $cantidad = $_POST['cantCobro'];
    $telefono = $_POST['telCobro'];
    $fecha = date("Y/m/d");
    $checkb = $_POST['allUsers'];

    //si esta vacio se aplica a un solo usuario
    if($checkb == '')
    {
        //revisar si existe algun cobro de dicho usuario
        $filas = "SELECT * FROM cobro inner Join usuario on cobro.id_usuario=usuario.id where usuario.telefono = '$telefono'";
        $sql_id = "SELECT id FROM usuario WHERE telefono = '$telefono'";
        $consulta = mysqli_query($conn,$filas) or die(mysqli_error($conn));
        $consulta_id = mysqli_query($conn,$sql_id) or die(mysqli_error($conn));
        $contenido = mysqli_fetch_array($consulta);
        $id = mysqli_fetch_array($consulta_id);

        if($contenido > 0)
        {
            $sql = "UPDATE cobro SET cantidad = (cantidad + '$cantidad'), fecha = '$fecha' where id_usuario = '$id[0]'";
            $consulta = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            echo "Cobro actualizado";
            echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
        }else{
            $sql = "INSERT INTO cobro(id_cobro,cantidad,fecha,id_usuario) 
            values (null, '$cantidad', '$fecha', '$id[0]')";
            $consulta = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            echo "Cobro agregado.";
            echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
        }

    }else{
        $filas = "SELECT id FROM usuario WHERE id_rol = 2";
        $consulta = mysqli_query($conn,$filas);
        $all_id = array();
        
        while($row = mysqli_fetch_assoc($consulta))
        {
            $all_id[] = $row;
        }

         foreach ($all_id as $row) 
        { 
            foreach ($row as $element)
            {
                $sql = "UPDATE cobro SET cantidad = (cantidad + '$cantidad'), fecha = '$fecha' where id_usuario = '$element'";
                $consulta = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            }
        }

        echo "Cobro actualizado";
        echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
    }
?>