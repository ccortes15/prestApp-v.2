<?php
    include("db.php");
    $nombre = $_POST['nameUser'];
    $telefono = $_POST['telUser'];
    $correo = $_POST['mailUser'];
    $contraseña = $_POST['passUser'];

    $sql = "INSERT INTO bsjoc29n2gfuxyr4bn8l.usuario (id,nombre,telefono,correo,id_rol,contraseña) 
            values (null, '$nombre', '$telefono', '$correo', 2, '$contraseña')";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    echo("<button onclick=\"location.href='../views/admin.php'\">Regresar</button>");
?>