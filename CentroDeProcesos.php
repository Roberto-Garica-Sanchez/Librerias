<?php
    #dia o mysql workbench para mysql 
    #js react jquerry angular
    #css materialize boostrap

    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set("Mexico/General");
    #header ('Content-type: text/html; charset=utf-8');
    #echo'<script src="https://kit.fontawesome.com/6f073fec6c.js" crossorigin="anonymous"></script>';


	$phpv='php7';
    include_once($_SERVER["DOCUMENT_ROOT"]."/login_tem.php");
    #include_once($_SERVER["DOCUMENT_ROOT"].'/PHPExcel/Classes/PHPExcel/IOFactory.php');
    include_once($_SERVER["DOCUMENT_ROOT"]."/libre_v1.php");
    include_once($_SERVER["DOCUMENT_ROOT"]."/libre_v2.php");
    include_once($_SERVER["DOCUMENT_ROOT"]."/libre_v3.php");
    include_once($_SERVER["DOCUMENT_ROOT"]."/libre_v4.php");
    include_once($_SERVER["DOCUMENT_ROOT"]."/libre_v5.php");
    
    echo"<LINK REL='STYLESHEET' HREF='/Estilos_v5.css' />";
    echo"<link rel='stylesheet' href='/fontawesome/css/all.css' >";
#    echo"<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">";
    echo"<LINK REL='STYLESHEET' HREF='../estilo.css' />";
    #echo"<LINK REL='STYLESHEET' HREF='../estilo2.css' />";
    echo"<LINK REL='STYLESHEET' HREF='../conte_v1.css' />";

    //echo"<script type='text/javascript' language='javascript' src='../cargar_archivos/Backen/subir.js'></script> ";		
    
    echo"<script type='text/javascript' language='javascript' src='../libre_v1.js'></script> ";	
    echo"<script type='text/javascript' language='javascript' src='../libre_v2.js'></script> ";	
    echo"<script type='text/javascript' language='javascript' src='../libre_v5.js'></script> ";	      
    
    if(empty($Excel))$Excel= new Excel();	
    if(empty($Ares_v1))$Ares_v1= new Ares_v1();
    if(empty($tablas_v2))$tablas_v2= new tablas_v2();
    if(empty($ProcesosMysql))$ProcesosMysql= new ProcesosMysql('php7',$conexion);
    if(empty($libre_v1))$libre_v1= new libre_v1();
    if(empty($libre_v2))$libre_v2= new libre_v2('php7',$conexion);
    if(empty($libre_v4))$libre_v4= new libre_v4('php7',$conexion); 
    if(empty($libre_v5))$libre_v5= new libre_v5('php7',$conexion,'');
    #if(empty($Archivos))$Archivos= new Archivos('php7',$conexion,'');
?>