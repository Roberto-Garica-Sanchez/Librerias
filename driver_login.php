<?php 
  require_once("/nucleoa.php");
  /*
    $login['host']='localhost';
    $login['user']='root';
    $login['pass']='';
    $login['db']='control_gastos_operativos';
    $function['clave']='libre';
    include("../driver_login.php");    
  */
  $conexion=mysql::login($login,$function);
  if ($conexion){
      //echo "conectado";
  }
  else if($conexion=="error"){

  }
?>