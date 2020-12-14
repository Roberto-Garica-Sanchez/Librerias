<?php
    //host: localhost  
    //usuario: gps
    //constraseña: gps1234
    //Base de datos: gps
    //Acceso_sistema Mv4d536et4Ex6ro3
    #$conexion = mysqli_connect('localhost','transpor_gloatin','Taiga3823',''); //inicia comunicasion a  servidor 
    $conexion = mysqli_connect('localhost','Acceso_sistema','Mv4d536et4Ex6ro3',''); //inicia comunicasion a  servidor 
    if (!$conexion) {  //verifica la conexion, si detecta un error devulve una mensaje, y el error 
        die("Connection failed: " . mysqli_connect_error());
    }
?>  