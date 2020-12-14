<?php
    if (mysqli_query($conexion, $sql)) {                                //Envia las instruciones pa MYSQL para guarda la informacion 
        $consola="<a class='ok'>Registros Moficados: ".mysqli_affected_rows($conexion)."</a>";
    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);       //si la instruciones estan mal el programa devulvera un error 
    }
?>